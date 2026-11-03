<?php

namespace App\Http\Controllers;

use App\Models\ActivitysoffMasterDt;
use App\Models\ActivitysoffMasterHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IsoActivityOffMaster extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = ActivitysoffMasterHd::where('activitysoff_master_hds_flag',true)->get();
        return view('iso.activityoff-master-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;
        return view('iso.activityoff-master-create', compact('hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. ตรวจสอบข้อมูลเบื้องต้น (Validation)
        $request->validate([
            'department_name' => 'required|string|max:255',
            'floor' => 'required|string|max:255',
            'item' => 'required|array', // ตรวจสอบว่ามีข้อมูลรายการส่งมาหรือไม่
        ], [
            'department_name.required' => 'กรุณาระบุหน่วยงานที่ถูกตรวจ',
            'floor.required' => 'กรุณาระบุชั้นที่ถูกตรวจ',
            'item.required' => 'กรุณากรอกรายการตรวจสอบอย่างน้อย 1 รายการ',
        ]);

        // เริ่มต้น Transaction เพื่อป้องกันข้อมูลพังกรณีเกิดข้อผิดพลาดกลางคัน
        DB::beginTransaction();

        try {
            // 2. บันทึกข้อมูลส่วนหัว (Header)
            $header = ActivitysoffMasterHd::create([
                'department_name' => $request->department_name,
                'floor' => $request->floor,
                'activitysoff_master_hds_flag' => true,
            ]);

            // 3. วนลูปบันทึกข้อมูลรายละเอียด (Details) ตามโครงสร้าง item[section][code/detail/score]
            if ($request->has('item')) {
                foreach ($request->item as $sectionIndex => $sectionData) {
                    // เช็คว่ามี code หรือ detail ส่งมาหรือไม่
                    if (isset($sectionData['code']) && is_array($sectionData['code'])) {
                        for ($i = 0; $i < count($sectionData['code']); $i++) {
                            // เช็คว่ามีค่า detail กรอกมาหรือไม่ (ถ้าเว้นว่างไว้ อาจข้ามหรือบันทึกก็ได้)
                            if (!empty($sectionData['detail'][$i])) {
                                ActivitysoffMasterDt::create([
                                    'activitysoff_master_hds_id' => $header->activitysoff_master_hds_id,
                                    'code' => $sectionData['code'][$i] ?? '',
                                    'detail' => $sectionData['detail'][$i] ?? '',
                                    'score' => $sectionData['score'][$i] ?? 5,
                                    'activitysoff_master_dts_flag' => true,
                                ]);
                            }
                        }
                    }
                }
            }

            // ยืนยันการบันทึกข้อมูลทั้งหมด
            DB::commit();

            return redirect()->route('activityoff-masters.index')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');

        } catch (\Exception $e) {
            // หากเกิดข้อผิดพลาด ให้ rollback ข้อมูลกลับทั้งหมด
            DB::rollback();
            Log::error('Error inserting activity 5soff: ' . $e->getMessage());

            return redirect()->back()->withInput()->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // ดึงข้อมูล Header พร้อม Details
        $hd = ActivitysoffMasterHd::with('details')->findOrFail($id);

        // จัดกลุ่ม Details ตามหมวดหมู่หลัก (ดูจากตัวเลขตัวแรกของ code เช่น '1.1' -> '1')
        $detailsGrouped = $hd->details->groupBy(function ($item) {
            return explode('.', $item->code)[0]; 
        });

        return view('iso.activityoff-master-edit', compact('hd', 'detailsGrouped'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
            'floor' => 'required|string|max:255',
            'item' => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            // 1. อัปเดต Header
            $hd = ActivitysoffMasterHd::findOrFail($id);
            $hd->update([
                'department_name' => $request->department_name,
                'floor' => $request->floor,
            ]);

            // 2. ลบ Detail เก่าออกทั้งหมดก่อน
            $hd->details()->delete();

            // 3. Insert Detail ชุดใหม่เข้าไป
            if ($request->has('item')) {
                foreach ($request->item as $sectionIndex => $sectionData) {
                    if (isset($sectionData['code']) && is_array($sectionData['code'])) {
                        for ($i = 0; $i < count($sectionData['code']); $i++) {
                            if (!empty($sectionData['detail'][$i])) {
                                $hd->details()->create([
                                    'code' => $sectionData['code'][$i] ?? '',
                                    'detail' => $sectionData['detail'][$i] ?? '',
                                    'score' => $sectionData['score'][$i] ?? 5,
                                    'activitysoff_master_dts_flag' => true,
                                ]);
                            }
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->route('activityoff-masters.index')->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cancelActivityoffmaster(Request $request)
    {
        $hd = ActivitysoffMasterHd::where('activitysoff_master_hds_id',$request->refid)->update([
            'activitysoff_master_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
