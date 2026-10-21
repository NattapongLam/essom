<?php

namespace App\Http\Controllers;

use App\Models\ElemchptggroupPlanningDt;
use App\Models\ElemchptggroupPlanningHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IsoEleMchPtgPlanning extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $hd = ElemchptggroupPlanningHd::with('details')
            ->where('elemchptggroup_planning_hds_flag', true)
            ->get();
        return view('iso.elemchptg-group-planning-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;
        return view('iso.elemchptg-group-planning-create', compact('hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        // (ทางเลือก) สามารถ Validate ข้อมูลเบื้องต้นได้ที่นี่
        /*
        $request->validate([
            'sets.*.section' => 'nullable|string|max:255',
            'sets.*.product_code' => 'nullable|string|max:255',
            'sets.*.job_no' => 'nullable|string|max:255',
            'sets.*.qty' => 'nullable|integer',
        ]);
        */

        // เริ่มต้น Transaction เพื่อป้องกันข้อมูลบันทึกไม่สมบูรณ์
        DB::beginTransaction();

        try {
            // 1. บันทึกข้อมูลส่วนหัว (Header) ลงตาราง elemchptggroup_planning_hds
            $header = ElemchptggroupPlanningHd::create([
                'elemchptggroup_planning_hds_flag' => true,
                'prepared_by'   => $request->input('prepared_by'),
                'prepared_date' => $request->input('prepared_date'),
                // 'checked_by'    => $request->input('checked_by'),
                // 'checked_date'  => $request->input('checked_date'),
                // 'approved_by'   => $request->input('approved_by'),
                // 'approved_date' => $request->input('approved_date'),
                'docs_status'   => '1', // หรือกำหนดสถานะตามระบบของคุณ
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);

            // 2. ตรวจสอบและวนลูปบันทึกข้อมูลทั้ง 3 ชุดลงตาราง elemchptggroup_planning_dts
            if ($request->has('sets') && is_array($request->input('sets'))) {
                foreach ($request->input('sets') as $setId => $setData) {
                    
                    // ข้ามชุดข้อมูลที่เป็นค่าว่างหรือไม่ถูกส่งมา
                    if (empty($setData)) {
                        continue;
                    }

                    ElemchptggroupPlanningDt::create([
                        'elemchptggroup_planning_hds_id' => $header->elemchptggroup_planning_hds_id,
                        'set_no'        => $setId, // ชุดที่ 1, 2, 3
                        'section'       => $setData['section'] ?? null,
                        'product_code'  => $setData['product_code'] ?? null,
                        'job_no'        => $setData['job_no'] ?? null,
                        'qty'           => $setData['qty'] ?? null,
                        'customer'      => $setData['customer'] ?? null,
                        'responsible'   => $setData['responsible'] ?? null,
                        'budget_time'   => $setData['budget_time'] ?? null,
                        'mh_for_date'   => $setData['mh_for_date'] ?? null,
                        'to_date'       => $setData['to_date'] ?? null,
                        'remark'        => $setData['remark'] ?? null,
                        'month_1'       => $setData['month_1'] ?? null,
                        
                        // ข้อมูลตารางและ Weekly Review จะถูกแปลงเป็น JSON อัตโนมัติเพราะประกาศ $casts ไว้ใน Model แล้ว
                        'details'       => $setData['details'] ?? null,
                        'ack'           => $setData['ack'] ?? null,
                        'ack_date'      => $setData['ack_date'] ?? null,
                        'weekly_review' => $setData['weekly_review'] ?? null,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now(),
                    ]);
                }
            }

            // ยืนยันการบันทึกข้อมูลทั้งหมดลงฐานข้อมูล
            DB::commit();

            return redirect()->back()->with('success', 'บันทึกข้อมูล Group Planning ทั้ง 3 ชุดเรียบร้อยแล้ว!');

        } catch (\Exception $e) {
            // ยกเลิกการเปลี่ยนแปลงทั้งหมดหากเกิดข้อผิดพลาด
            DB::rollBack();
            
            // บันทึก Log ข้อผิดพลาดเพื่อตรวจสอบ
            Log::error('Error saving group planning: ' . $e->getMessage());

            return redirect()->back()
                             ->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage())
                             ->withInput();
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
        $hd = ElemchptggroupPlanningHd::find($id);
        $dt = ElemchptggroupPlanningDt::where('elemchptggroup_planning_hds_id',$id)->get();
        return view('iso.elemchptg-group-planning-update', compact('hd','dt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = ElemchptggroupPlanningHd::find($id);
        $dt = ElemchptggroupPlanningDt::where('elemchptggroup_planning_hds_id',$id)->get();
        return view('iso.elemchptg-group-planning-edit', compact('hd','dt'));
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
        if($request->doc_ref == "Edit"){
            // ค้นหา Header ตาม Primary Key ที่คุณกำหนด
            $header = ElemchptggroupPlanningHd::findOrFail($id);

            // เริ่มต้น Transaction
            DB::beginTransaction();

            try {
                // 1. อัปเดตข้อมูลส่วนหัว (Header)
                $header->update([
                    'prepared_by'   => $request->input('prepared_by'),
                    'prepared_date' => $request->input('prepared_date'),
                    'docs_status'   => '1', // หรือกำหนดสถานะตามระบบของคุณ
                    'updated_at'    => Carbon::now(),
                    // 'checked_by'    => $request->input('checked_by'),
                    // 'checked_date'  => $request->input('checked_date'),
                    // 'approved_by'   => $request->input('approved_by'),
                    // 'approved_date' => $request->input('approved_date'),
                ]);

                // 2. จัดการข้อมูล Detail ทั้ง 3 ชุด
                if ($request->has('sets') && is_array($request->input('sets'))) {
                    foreach ($request->input('sets') as $setId => $setData) {
                        
                        if (empty($setData)) {
                            continue;
                        }

                        // ใช้ updateOrCreate เพื่อเช็คว่าถ้ามี set_no นี้อยู่แล้วให้ทำการอัปเดต ถ้ายังไม่มีให้สร้างใหม่
                        ElemchptggroupPlanningDt::updateOrCreate(
                            [
                                'elemchptggroup_planning_hds_id' => $header->elemchptggroup_planning_hds_id,
                                'set_no'                         => $setId, // ชุดที่ 1, 2, 3
                            ],
                            [
                                'section'       => $setData['section'] ?? null,
                                'product_code'  => $setData['product_code'] ?? null,
                                'job_no'        => $setData['job_no'] ?? null,
                                'qty'           => $setData['qty'] ?? null,
                                'customer'      => $setData['customer'] ?? null,
                                'responsible'   => $setData['responsible'] ?? null,
                                'budget_time'   => $setData['budget_time'] ?? null,
                                'mh_for_date'   => $setData['mh_for_date'] ?? null,
                                'to_date'       => $setData['to_date'] ?? null,
                                'remark'        => $setData['remark'] ?? null,
                                'month_1'       => $setData['month_1'] ?? null,
                                
                                // ข้อมูลตารางและ Weekly Review จะถูกแปลงเป็น JSON อัตโนมัติผ่าน $casts ใน Model
                                'details'       => $setData['details'] ?? null,
                                'ack'           => $setData['ack'] ?? null,
                                'ack_date'      => $setData['ack_date'] ?? null,
                                'weekly_review' => $setData['weekly_review'] ?? null,
                            ]
                        );
                    }
                }

                // ยืนยันการบันทึก
                DB::commit();

                return redirect()->back()->with('success', 'อัปเดตข้อมูล Group Planning ทั้ง 3 ชุดเรียบร้อยแล้ว!');

            } catch (\Exception $e) {
                // ยกเลิกหากเกิดข้อผิดพลาด
                DB::rollBack();
                
                Log::error('Error updating group planning: ' . $e->getMessage());

                return redirect()->back()
                                ->with('error', 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล: ' . $e->getMessage())
                                ->withInput();
            }
        }elseif($request->doc_ref == "Update"){
              // ค้นหา Header ตาม Primary Key ที่คุณกำหนด
            $header = ElemchptggroupPlanningHd::findOrFail($id);

            // เริ่มต้น Transaction
            DB::beginTransaction();

            try {
                // 1. อัปเดตข้อมูลส่วนหัว (Header)
                if( $header->docs_status == "1"){
                    $header->update([
                        'checked_by'    => $request->input('checked_by'),
                        'checked_date'  => $request->input('checked_date'),
                        'docs_status'   => '2',
                        // 'approved_by'   => $request->input('approved_by'),
                        // 'approved_date' => $request->input('approved_date'),
                    ]);


                }elseif($header->docs_status == "2"){
                    $header->update([
                        // 'checked_by'    => $request->input('checked_by'),
                        // 'checked_date'  => $request->input('checked_date'),
                        'docs_status'   => '3',
                        'approved_by'   => $request->input('approved_by'),
                        'approved_date' => $request->input('approved_date'),
                    ]);
                }              
                // ยืนยันการบันทึก
                DB::commit();

                return redirect()->back()->with('success', 'อัปเดตข้อมูล Group Planning ทั้ง 3 ชุดเรียบร้อยแล้ว!');

            } catch (\Exception $e) {
                // ยกเลิกหากเกิดข้อผิดพลาด
                DB::rollBack();
                
                Log::error('Error updating group planning: ' . $e->getMessage());

                return redirect()->back()
                                ->with('error', 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล: ' . $e->getMessage())
                                ->withInput();
            }
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
    public function cancelElemchptgplanning(Request $request)
    {
        $hd = ElemchptggroupPlanningHd::where('elemchptggroup_planning_hds_id',$request->refid)->update([
            'elemchptggroup_planning_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
