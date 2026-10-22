<?php

namespace App\Http\Controllers;

use App\Models\CustomerserviceComplaintDt;
use App\Models\CustomerserviceComplaintHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IsoCustomerServiceComplaint extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = CustomerserviceComplaintHd::where('customerservice_complaint_hds_flag',true)->get();
        return view('iso.customerservice-complaint-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();
        return view('iso.customerservice-complaint-create', compact('emp'));
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
        'customer_notice_date' => ['required'],
        'notice_no' => ['required'],
    ]);
    $docsStatus = '1'; // ค่าเริ่มต้น (หรือปรับเปลี่ยนตามต้องการ)
    if ($request->evaluation_round == "ออกใบ CAR") {
        $docsStatus = '7'; // หรือค่าที่ต้องการเมื่อตรงเงื่อนไขนี้
    }
    $data = [
        'customerservice_complaint_hds_flag' => true,
        'customer_notice_date' => $request->customer_notice_date,
        'notice_no' => $request->notice_no,
        'customer_name' => $request->customer_name,
        'contact_person' => $request->contact_person,
        'telephone' => $request->telephone,
        'email' => $request->email,
        'evaluation_round' => $request->evaluation_round,
        'car_no' => $request->car_no,
        'car_date' => $request->car_date,
        'recorder' => $request->recorder,
        'recorded_date' => $request->recorded_date,
        'docs_status' => $docsStatus,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
    try {
        DB::beginTransaction();
        $insertHD = CustomerserviceComplaintHd::create($data);

        // 1. วนลูปตารางส่วนที่ 1 (สำนักงาน) โดยใส่ ?? [] ป้องกันค่า null
        $items = $request->input('items', []);
        foreach ($items as $item) {
            // เช็คว่ามีการกรอกรหัสสินค้า หรือ อาการเบื้องต้น ถึงจะบันทึก
            CustomerserviceComplaintDt::create([
                    'customerservice_complaint_hds_id' => $insertHD->customerservice_complaint_hds_id,
                    'listno' => $item['listno_off'] ?? 1,
                    'product_code' => $item['product_code'] ?? '-',
                    'serial_no' => $item['serial_no'] ?? '-',
                    'initial_symptom' => $item['initial_symptom'] ?? '-',
                    'cause' => '-',
                    'solution' => '-',
                    'qty' => 0,
                    'price' => 0,
                    'table_type' => $item['table_type'] ?? 'off',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ]);  
        }

        // 2. วนลูปตารางส่วนที่ 2 (โรงงาน) โดยใส่ ?? [] ป้องกันค่า null เช่นกัน
        $factoryItems = $request->input('factory_items', []);
        foreach ($factoryItems as $item) {
            // บันทึกเฉพาะแถวที่มีการกรอกข้อมูล (รหัสสินค้า, สาเหตุ หรือ แนวทางแก้ไข)
                CustomerserviceComplaintDt::create([
                    'customerservice_complaint_hds_id' => $insertHD->customerservice_complaint_hds_id,
                    'listno'           => $item['listno_fac'] ?? 1,
                    'product_code'     => $item['product_code'] ?? '-',
                    'serial_no'        => '-',
                    'initial_symptom'  => '-',
                    'cause'            => $item['cause'] ?? '-',
                    'solution'         => $item['solution'] ?? '-',
                    'qty'              => $item['qty'] ?? 0,
                    'price'            => $item['price'] ?? 0,
                    'table_type'       => $item['table_type'] ?? 'fac',
                    'created_at'       => Carbon::now(),
                    'updated_at'       => Carbon::now(),
                ]);
        }
        DB::commit();
        return redirect()->route('customerservice-complaints.index')->with('success', 'บันทึกข้อมูลสำเร็จ');

    } catch (\Exception $e) {
        DB::rollBack();
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
        $hd = CustomerserviceComplaintHd::find($id);
        $dt_off = CustomerserviceComplaintDt::where('customerservice_complaint_hds_id',$id)->where('table_type','off')->get();
        $dt_fac = CustomerserviceComplaintDt::where('customerservice_complaint_hds_id',$id)->where('table_type','fac')->get();
        return view('iso.customerservice-complaint-update', compact('hd','dt_off','dt_fac'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = CustomerserviceComplaintHd::find($id);
        $dt_off = CustomerserviceComplaintDt::where('customerservice_complaint_hds_id',$id)->where('table_type','off')->get();
        $dt_fac = CustomerserviceComplaintDt::where('customerservice_complaint_hds_id',$id)->where('table_type','fac')->get();
        return view('iso.customerservice-complaint-edit', compact('hd','dt_off','dt_fac'));
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
            $data = [
                'customerservice_complaint_hds_flag' => true,
                'customer_notice_date' => $request->customer_notice_date,
                'notice_no' => $request->notice_no,
                'customer_name' => $request->customer_name,
                'contact_person' => $request->contact_person,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'evaluation_round' => $request->evaluation_round,
                'car_no' => $request->car_no,
                'car_date' => $request->car_date,
                'recorder' => $request->recorder,
                'recorded_date' => $request->recorded_date,
                'docs_status' => '1',
                'updated_at' => Carbon::now(),
            ];
            try {
                DB::beginTransaction();
                $insertHD = CustomerserviceComplaintHd::where('customerservice_complaint_hds_id',$id)->update($data);
                $items = $request->input('items', []);
                foreach ($items as $item) {
                    CustomerserviceComplaintDt::where('customerservice_complaint_dts_id',$item['customerservice_complaint_dts_id'])->update([
                            'product_code' => $item['product_code'] ?? '-',
                            'serial_no' => $item['serial_no'] ?? '-',
                            'initial_symptom' => $item['initial_symptom'] ?? '-',
                            'cause' => '-',
                            'solution' => '-',
                            'qty' => 0,
                            'price' => 0,
                            'table_type' => $item['table_type'] ?? 'off',
                            'updated_at' => Carbon::now(),
                    ]);  
                }
                DB::commit();
                return redirect()->route('customerservice-complaints.index')->with('success', 'บันทึกข้อมูลสำเร็จ');

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                return redirect()->back()->withInput()->with('error', 'บันทึกข้อมูลไม่สำเร็จ: ' . $e->getMessage());
            }
        }elseif($request->doc_ref == "Update"){
            $hd = CustomerserviceComplaintHd::find($id);
            try {
                DB::beginTransaction();
                if($hd->docs_status == "1"){
                    CustomerserviceComplaintHd::where('customerservice_complaint_hds_id',$id)
                    ->update([
                        'docs_status' => '2',
                        'approver' => $request->approver,
                        'approved_date' => $request->approved_date,
                    ]);
                }elseif($hd->docs_status == "2"){
                    CustomerserviceComplaintHd::where('customerservice_complaint_hds_id',$id)
                    ->update([
                        'docs_status' => '3',
                        'factory_action_type' => $request->factory_action_type,
                        'inspection_date' => $request->inspection_date,
                        'cost_material' => $request->cost_material,
                        'cost_labor' => $request->cost_labor,
                        'cost_transport' => $request->cost_transport,
                        'cost_other' => $request->cost_other,
                        'cost_total' => $request->cost_total,
                        'due_date' => $request->due_date,
                        'factory_reporter' => $request->factory_reporter,
                        'factory_reported_date' => $request->factory_reported_date,
                    ]);
                    $factoryItems = $request->input('factory_items', []);
                    foreach ($factoryItems as $item) {
                        // บันทึกเฉพาะแถวที่มีการกรอกข้อมูล (รหัสสินค้า, สาเหตุ หรือ แนวทางแก้ไข)
                            CustomerserviceComplaintDt::where('customerservice_complaint_dts_id',$item['customerservice_complaint_dts_id'])
                            ->update([
                                'product_code'     => $item['product_code'] ?? '-',
                                'serial_no'        => '-',
                                'initial_symptom'  => '-',
                                'cause'            => $item['cause'] ?? '-',
                                'solution'         => $item['solution'] ?? '-',
                                'qty'              => $item['qty'] ?? 0,
                                'price'            => $item['price'] ?? 0,
                                'table_type'       => $item['table_type'] ?? 'fac',
                                'updated_at'       => Carbon::now(),
                            ]);
                    }
                }elseif($hd->docs_status == "3"){
                    CustomerserviceComplaintHd::where('customerservice_complaint_hds_id',$id)
                    ->update([
                        'docs_status' => '4',
                        'factory_approver' => $request->factory_approver,
                        'factory_approved_date' => $request->factory_approved_date
                    ]);
                }elseif($hd->docs_status == "4"){
                    CustomerserviceComplaintHd::where('customerservice_complaint_hds_id',$id)
                    ->update([
                        'docs_status' => '5',
                        'part3_action_type' => $request->part3_action_type,
                        'part3_factory_signer' => $request->part3_factory_signer,
                        'part3_completed_date' => $request->part3_completed_date,
                        'part3_quotation_date' => $request->part3_quotation_date,
                        'part3_approved_repair_date' => $request->part3_approved_repair_date,
                        'part3_repaired_date' => $request->part3_repaired_date,
                    ]);
                }elseif($hd->docs_status == "5"){
                    CustomerserviceComplaintHd::where('customerservice_complaint_hds_id',$id)
                    ->update([
                        'docs_status' => '6',
                        'part4_action_type' => $request->part4_action_type,
                        'part4_reporter' => $request->part4_reporter,
                        'part4_reported_date' => $request->part4_reported_date
                    ]);
                }elseif($hd->docs_status == "6"){
                    CustomerserviceComplaintHd::where('customerservice_complaint_hds_id',$id)
                    ->update([
                        'docs_status' => '7',
                        'part4_approver' => $request->part4_approver,
                        'part4_approved_date' => $request->part4_approved_date
                    ]);
                }
                DB::commit();
                return redirect()->route('customerservice-complaints.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
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
    
    public function cancelCustomerserviceComplaint(Request $request)
    {
        $hd = CustomerserviceComplaintHd::where('customerservice_complaint_hds_id',$request->refid)->update([
            'customerservice_complaint_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
