<?php

namespace App\Http\Controllers;

use App\Models\InternalauditPlanDt;
use App\Models\InternalauditPlanHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IsoInternalAuditPlan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = InternalauditPlanHd::where('internalaudit_plan_hds_flag',true)->get();
        return view('iso.internalaudit-plan-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;
        return view('iso.internalaudit-plan-create', compact('hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
            'period' => ['required'],
        ]);

        // ตัด created_at ออกถ้าฐานข้อมูลไม่มีคอลัมน์นี้ (เนื่องจาก Model ตั้ง +timestamps: false)
        $data = [
            'internalaudit_plan_hds_flag' => true,
            'period' => $request->period,
            'prepared_by' => $request->prepared_by,
            'prepared_date' => $request->prepared_date,
            'docs_status' => "1",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        try {
            DB::beginTransaction();

            // 1. บันทึก Header
            $insertHD = InternalauditPlanHd::create($data);

            // 2. บันทึก Detail
            $items = $request->input('audit', []);
            foreach ($items as $item) {
                InternalauditPlanDt::create([
                    'internalaudit_plan_hds_id' => $insertHD->internalaudit_plan_hds_id, // ถูกต้องตาม Primary Key ของคุณ
                    'date' => $item['date'] ?? null,
                    'process' => $item['process'] ?? null,
                    'auditee' => $item['auditee'] ?? null,
                    'auditor' => $item['auditor'] ?? null,
                    'person_at' => auth()->user()->name ?? null,
                    'internalaudit_plan_dts_flag' => true,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);  
            }

            DB::commit();
            return redirect()->route('internalaudit-plans.index')->with('success', 'บันทึกข้อมูลสำเร็จ');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // บรรทัดนี้ช่วยให้คุณเห็น Error ชัดเจนตอนกดบันทึก (สามารถเปิดใช้ชั่วคราวเพื่อ Debug)
            dd($e->getMessage()); 

            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'บันทึกข้อมูลไม่สำเร็จ: ' . $e->getMessage());
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
        $hd = InternalauditPlanHd::find($id);
        $dt = InternalauditPlanDt::where('internalaudit_plan_hds_id',$id)->where('internalaudit_plan_dts_flag',true)->get();
        return view('iso.internalaudit-plan-update', compact('hd','dt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = InternalauditPlanHd::find($id);
        $dt = InternalauditPlanDt::where('internalaudit_plan_hds_id',$id)->where('internalaudit_plan_dts_flag',true)->get();
        return view('iso.internalaudit-plan-edit', compact('hd','dt'));
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
            $request->validate([
                'period' => ['required'],
            ]);

            $data = [
                'period' => $request->period,
                'prepared_by' => $request->prepared_by,
                'prepared_date' => $request->prepared_date,
                'updated_at' => Carbon::now(), // เปิดใช้งานถ้าตารางมีคอลัมน์นี้
                'docs_status' => "1",
            ];

            try {
                DB::beginTransaction();

                // 1. ค้นหาและอัปเดตข้อมูลส่วนหัว (Header)
                $hd = InternalauditPlanHd::findOrFail($id);
                $hd->update($data);

                // 2. จัดการข้อมูลส่วนรายละเอียด (Detail)
                // แนวทางที่นิยมและปลอดภัย: ลบข้อมูลเก่าทั้งหมดของ Header นี้ทิ้ง แล้ว Insert ใหม่จากฟอร์มที่ส่งมาล่าสุด
                InternalauditPlanDt::where('internalaudit_plan_hds_id', $id)->delete();

                // 3. วนลูปบันทึกข้อมูลตารางใหม่ที่ส่งมาจากฟอร์ม
                $items = $request->input('audit', []);
                foreach ($items as $item) {
                    InternalauditPlanDt::create([
                        'internalaudit_plan_hds_id' => $hd->internalaudit_plan_hds_id,
                        'date' => $item['date'] ?? null,
                        'process' => $item['process'] ?? null,
                        'auditee' => $item['auditee'] ?? null,
                        'auditor' => $item['auditor'] ?? null,
                        'person_at' => auth()->user()->name ?? null,
                        'internalaudit_plan_dts_flag' => true,
                        'created_at' => Carbon::now(), // เปิดใช้งานถ้าตารางมีคอลัมน์นี้
                        'updated_at' => Carbon::now(), // เปิดใช้งานถ้าตารางมีคอลัมน์นี้
                    ]);  
                }

                DB::commit();
                return redirect()->route('internalaudit-plans.index')->with('success', 'อัปเดตข้อมูลสำเร็จ');

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Error updating audit plan: ' . $e->getMessage());
                return redirect()->back()->withInput()->with('error', 'อัปเดตข้อมูลไม่สำเร็จ: ' . $e->getMessage());
            }
        }elseif($request->doc_ref == "Update"){
            $hd = InternalauditPlanHd::findOrFail($id);
            if($hd->docs_status == "1"){
                $data = [
                    'checked_by' => $request->checked_by,
                    'checked_date' => $request->checked_date,
                    'docs_status' => "2",
                ];
            }elseif($hd->docs_status == "2"){
                $data = [
                    'approved_by' => $request->approved_by,
                    'approved_date' => $request->approved_date,
                    'docs_status' => "3",
                ];
            }      
            try {
                DB::beginTransaction();
                $hd->update($data);         
                DB::commit();
                return redirect()->route('internalaudit-plans.index')->with('success', 'อัปเดตข้อมูลสำเร็จ');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Error updating audit plan: ' . $e->getMessage());
                return redirect()->back()->withInput()->with('error', 'อัปเดตข้อมูลไม่สำเร็จ: ' . $e->getMessage());
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
    public function cancelInternalauditplan(Request $request)
    {
        $hd = InternalauditPlanHd::where('internalaudit_plan_hds_id',$request->refid)->update([
            'internalaudit_plan_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
