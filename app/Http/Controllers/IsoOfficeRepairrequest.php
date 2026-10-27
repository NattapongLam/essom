<?php

namespace App\Http\Controllers;

use App\Models\OfficeRepairrequestDt;
use App\Models\OfficeRepairrequestHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IsoOfficeRepairrequest extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = OfficeRepairrequestHd::get();
        return view('iso.office-repair-request-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;
        return view('iso.office-repair-request-create', compact('hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'equipment_name' => $request->equipment_name,
            'equipment_code' => $request->equipment_code,
            'notification_person' => Auth::user()->name,
            'notification_date' => $request->notification_date,
            'created_at' => Carbon::now(),
            'docs_status' => 'N',
            'approver_status' => 'N',
            'receiver_status' => 'N'
        ];
        try{
            DB::beginTransaction();
            $insertHD = OfficeRepairrequestHd::create($data);
            foreach ($request->detail_no as $key => $value) {
                OfficeRepairrequestDt::insert([
                    'detail_no' =>  $value,
                    'symptom_detail' => $request->symptom_detail[$key],
                    'repair_action' => $request->repair_action[$key],
                    'remark'  => $request->remark[$key],
                    'office_repairrequest_dts_flag' => true,
                    'person_at' => Auth::user()->name,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'office_repairrequest_hds_id' => $insertHD->office_repairrequest_hds_id, 
                    'note'  => $request->note[$key],
                ]);
            }
            DB::commit();
            return redirect()->route('office-repairreques.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('office-repairreques.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = OfficeRepairrequestHd::find($id);
        $dt = OfficeRepairrequestDt::where('office_repairrequest_hds_id',$id)->where('office_repairrequest_dts_flag',true)->get();
        return view('iso.office-repair-request-update', compact('hd','dt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = OfficeRepairrequestHd::find($id);
        $dt = OfficeRepairrequestDt::where('office_repairrequest_hds_id',$id)->where('office_repairrequest_dts_flag',true)->get();
        return view('iso.office-repair-request-edit', compact('hd','dt'));
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
        if ($request->checkdocs == "Edit") {
            $data = [
                'equipment_name' => $request->equipment_name,
                'equipment_code' => $request->equipment_code,
                'notification_person' => Auth::user()->name,
                'notification_date' => $request->notification_date,
                'updated_at' => Carbon::now(),
                'docs_status' => 'N',
                'approver_status' => 'N',
                'receiver_status' => 'N'
            ];

            try {
                DB::beginTransaction();

                // 1. ค้นหา Header Model เดิมขึ้นมาอัปเดต (จะได้ Object กลับมาใช้งานต่อได้)
                $header = OfficeRepairrequestHd::findOrFail($id);
                $header->update($data);

                // 2. วนลูปจัดการข้อมูลตาราง Detail (ทั้งแก้ไขข้อมูลเดิม และเพิ่มข้อมูลใหม่)
                if ($request->has('detail_no')) {
                    foreach ($request->detail_no as $key => $value) {
                        // ตรวจสอบว่ามี ID ของ Detail ส่งมาด้วยหรือไม่ (กรณีข้อมูลเดิม)
                        $detailId = $request->office_repairrequest_dts_id[$key] ?? null;
                        $dt = $detailId ? OfficeRepairrequestDt::find($detailId) : null;

                        if ($dt) {
                            // อัปเดตข้อมูลรายการเดิม
                            $dt->update([
                                'detail_no' => $value,
                                'symptom_detail' => $request->symptom_detail[$key],
                                'repair_action' => $request->repair_action[$key],
                                'remark' => $request->remark[$key] ?? null,
                                'office_repairrequest_dts_flag' => true,
                                'person_at' => Auth::user()->name,
                                'updated_at' => Carbon::now(),
                                'note'  => $request->note[$key],
                            ]);
                        } else {
                            // เพิ่มข้อมูลรายการใหม่ (กรณีผู้ใช้กดปุ่มเพิ่มแถวในหน้าจอ)
                            OfficeRepairrequestDt::create([
                                'office_repairrequest_hds_id' => $header->office_repairrequest_hds_id, // ใช้ ID จาก Header ที่ถูกต้อง
                                'detail_no' => $value,
                                'symptom_detail' => $request->symptom_detail[$key],
                                'repair_action' => $request->repair_action[$key],
                                'remark' => $request->remark[$key] ?? null,
                                'office_repairrequest_dts_flag' => true,
                                'person_at' => Auth::user()->name,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                                'note'  => $request->note[$key],
                            ]);
                        }
                    }
                }

                DB::commit();
                return redirect()->route('office-repairreques.index')->with('success', 'บันทึกข้อมูลสำเร็จ');

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                
                // หากต้องการดีบักสามารถเปิดบรรทัด dd ด้านล่างนี้ดูได้
                // dd($e->getMessage());
                
                return redirect()->back()->withInput()->with('error', 'บันทึกข้อมูลไม่สำเร็จ: ' . $e->getMessage());
            }
        }elseif($request->checkdocs == "Update"){
            try {
            DB::beginTransaction();
            $header = OfficeRepairrequestHd::findOrFail($id);
                if($header->receiver_status == "N"){
                    $header->update([
                        'receiver_name' => Auth::user()->name,
                        'receiver_status' => 'Y',
                        'tracking_status' => $request->tracking_status,
                        'tracking_remark' => $request->tracking_remark,
                        'tracking_remark1' => $request->tracking_remark1,
                        'tracking_remark2' => $request->tracking_remark2,
                        'tracking_remark3' => $request->tracking_remark3
                    ]);
                }elseif($header->approver_status == "N"){
                    $header->update([
                        'approver_name' => Auth::user()->name,
                        'approver_status' => 'Y',
                        'approver_remark' => $request->approver_remark,
                        'docs_status' => 'I',
                    ]);
                }elseif($header->docs_status == "I"){
                    $header->update([
                        'staff_opinion' => $request->staff_opinion,
                        'completed_date' => $request->completed_date,
                        'cannot_repair_reason' => $request->cannot_repair_reason,
                        'docs_status' => 'Y',
                    ]);
                }                
                DB::commit();
                return redirect()->route('office-repairreques.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                return redirect()->back()->withInput()->with('error', 'บันทึกข้อมูลไม่สำเร็จ: ' . $e->getMessage());
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

    public function cancelOfficeRepairrequeHd(Request $request)
    {
        $hd = OfficeRepairrequestHd::where('office_repairrequest_hds_id',$request->refid)->update([
            'docs_status' => 'C',
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }

    public function cancelOfficeRepairrequeDt(Request $request)
    {
        $hd = OfficeRepairrequestDt::where('office_repairrequest_dts_id',$request->refid)->update([
            'office_repairrequest_dts_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
