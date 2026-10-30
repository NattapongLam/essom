<?php

namespace App\Http\Controllers;

use App\Models\InternalauditMasterHd;
use App\Models\InternalauditReportDt;
use App\Models\InternalauditReportHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IsoInternalAuditReport extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = InternalauditReportHd::where('internalaudit_report_hds_flag',true)->get();
        return view('iso.internalaudit-report-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = InternalauditMasterHd::where('internalaudit_master_hds_flag',true)->get();
        return view('iso.internalaudit-report-create', compact('hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'document_no' => ['required'],
        //     'document_name' => ['required'],
        //     'revision' => ['required'],
        //     'effective_date' => ['required'],
        // ]);
        $hd = InternalauditMasterHd::find($request->internalaudit_master_hds_id);
        $data = [
            'internalaudit_report_hds_flag' => true,
            'document_no' => $hd->document_no,
            'document_name' => $hd->document_name,
            'revision' => $hd->revision,
            'effective_date' => $hd->effective_date,
            'auditor_name' => $request->auditor_name,
            'auditor_date' => $request->auditor_date,
            'auditee_name' => $request->auditee_name,
            'auditee_date' => $request->auditee_date,
            'docs_status' => "1",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'document_type' => $hd->document_type
        ];
        try {
            DB::beginTransaction();

            // 1. บันทึก Header
            $insertHD = InternalauditReportHd::create($data);

            // 2. บันทึก Detail
            $items = $request->input('audit', []);
            foreach ($items as $item) {
                InternalauditReportDt::create([
                        'internalaudit_report_hds_id' => $insertHD->internalaudit_report_hds_id,
                        'checklist' => $item['checklist'] ?? null,
                        'finding'  => $item['finding'] ?? null,
                        'conclusion' => $item['conclusion'] ?? null,
                        'comment'  => $item['comment'] ?? null,
                        'acknowledgement' => $item['acknowledgement'] ?? null,
                        'person_at' => auth()->user()->name ?? null,
                        'internalaudit_report_dts_flag' => true,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                ]);  
            }
            DB::commit();
            return redirect()->route('internalaudit-reports.index')->with('success', 'บันทึกข้อมูลสำเร็จ');

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
        $hd = InternalauditReportHd::find($id);
        $dt = InternalauditReportDt::where('internalaudit_report_dts_flag',true)->where('internalaudit_report_hds_id',$id)->get();
        return view('iso.internalaudit-report-update', compact('hd','dt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = InternalauditReportHd::find($id);
        $dt = InternalauditReportDt::where('internalaudit_report_dts_flag',true)->where('internalaudit_report_hds_id',$id)->get();
        return view('iso.internalaudit-report-edit', compact('hd','dt'));
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
        // 1. ค้นหาข้อมูล Header เดิม
        $hd = InternalauditReportHd::findOrFail($id);
        if($request->doc_ref == "Edit"){
            // เริ่มต้น Database Transaction เพื่อความปลอดภัยของข้อมูล
            DB::beginTransaction();
            try {
                // 2. อัปเดตข้อมูล Header
                $hd->update([
                    'document_no'   => $request->document_no,
                    'document_name' => $request->document_name,
                    'revision'      => $request->revision,
                    'effective_date'=> $request->effective_date,
                    'auditor_name'  => $request->auditor_name,
                    'auditor_date'  => $request->auditor_date,
                    'auditee_name' => $request->auditee_name,
                    'auditee_date' => $request->auditee_date,
                    'docs_status' => "1",
                    'updated_at' => Carbon::now(),
                    'document_type' => $hd->document_type
                ]);

                // 3. จัดการข้อมูล Detail (รายการตรวจสอบในตาราง)
                // แนวทางที่นิยมสำหรับตาราง Dynamic แบบนี้คือ: 
                // ลบข้อมูลเดิมที่ Flag เป็น true ออก (หรือจะใช้วิธี Soft Delete / Update ทีละรายการก็ได้)
                
                // ตัวอย่างแบบลบรายการเดิมแล้วสร้างใหม่ตามที่ส่งมาจากฟอร์ม:
                InternalauditReportDt::where('internalaudit_report_hds_id', $id)->delete();

                // ตรวจสอบว่ามีข้อมูล audit ส่งมาหรือไม่
                if ($request->has('audit') && is_array($request->audit)) {
                    foreach ($request->audit as $item) {
                        // ตรวจสอบว่ามีข้อมูลในแถวนั้นจริงๆ (เช่น มี checklist หรือ finding)
                        if (!empty($item['checklist']) || !empty($item['finding'])) {
                            InternalauditReportDt::create([
                                'internalaudit_report_hds_id' => $hd->internalaudit_report_hds_id,
                                'checklist'                   => $item['checklist'] ?? null,
                                'finding'                     => $item['finding'] ?? null,
                                'conclusion'                  => $item['conclusion'] ?? null,
                                'comment'                     => $item['comment'] ?? null,
                                'acknowledgement'             => $item['acknowledgement'] ?? null,
                                'internalaudit_report_dts_flag' => true, // หรือค่าเริ่มต้นตามตารางของคุณ
                                'person_at' => auth()->user()->name ?? null,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    }
                }

                DB::commit();

                // ส่งกลับพร้อมแจ้งเตือนความสำเร็จ (สามารถปรับใช้กับ SweetAlert หรือ Toast ของคุณได้)
                return redirect()->route('internalaudit-reports.index')->with('success', 'อัปเดตข้อมูลรายงานการตรวจสอบภายในสำเร็จ');

            } catch (\Exception $e) {
                DB::rollBack();
                // หากเกิดข้อผิดพลาด ให้กลับไปหน้าเดิมพร้อมแสดง Error
                return redirect()->back()->withInput()->with('error', 'เกิดข้อผิดพลาดในการบันทึก: ' . $e->getMessage());
            }
        }elseif($request->doc_ref == "Update"){
             // เริ่มต้น Database Transaction เพื่อความปลอดภัยของข้อมูล
            DB::beginTransaction();
            try {
                // 2. อัปเดตข้อมูล Header
                $hd->update([
                    'approver_name' => $request->approver_name,
                    'approver_date' => $request->approver_date,
                    'docs_status' => "2",
                ]);

                // 3. จัดการข้อมูล Detail (รายการตรวจสอบในตาราง)
                // แนวทางที่นิยมสำหรับตาราง Dynamic แบบนี้คือ: 
                // ลบข้อมูลเดิมที่ Flag เป็น true ออก (หรือจะใช้วิธี Soft Delete / Update ทีละรายการก็ได้)
                
                // ตัวอย่างแบบลบรายการเดิมแล้วสร้างใหม่ตามที่ส่งมาจากฟอร์ม:
                InternalauditReportDt::where('internalaudit_report_hds_id', $id)->delete();

                // ตรวจสอบว่ามีข้อมูล audit ส่งมาหรือไม่
                if ($request->has('audit') && is_array($request->audit)) {
                    foreach ($request->audit as $item) {
                        // ตรวจสอบว่ามีข้อมูลในแถวนั้นจริงๆ (เช่น มี checklist หรือ finding)
                        if (!empty($item['checklist']) || !empty($item['finding'])) {
                            InternalauditReportDt::where('internalaudit_report_dts_id',$item['internalaudit_report_dts_id'])->update([
                                'comment'                     => $item['comment'] ?? null,
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    }
                }

                DB::commit();

                // ส่งกลับพร้อมแจ้งเตือนความสำเร็จ (สามารถปรับใช้กับ SweetAlert หรือ Toast ของคุณได้)
                return redirect()->route('internalaudit-reports.index')->with('success', 'อัปเดตข้อมูลรายงานการตรวจสอบภายในสำเร็จ');

            } catch (\Exception $e) {
                DB::rollBack();
                // หากเกิดข้อผิดพลาด ให้กลับไปหน้าเดิมพร้อมแสดง Error
                return redirect()->back()->withInput()->with('error', 'เกิดข้อผิดพลาดในการบันทึก: ' . $e->getMessage());
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
    public function cancelInternalauditreport(Request $request)
    {
        $hd = InternalauditReportHd::where('internalaudit_report_hds_id',$request->refid)->update([
            'internalaudit_report_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
