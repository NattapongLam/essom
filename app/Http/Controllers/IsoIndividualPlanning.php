<?php

namespace App\Http\Controllers;

use App\Models\IndividualgroupPlanningDt;
use App\Models\IndividualgroupPlanningHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IsoIndividualPlanning extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = IndividualgroupPlanningHd::where('individualgroup_planning_hds_flag',true)->get();
        return view('iso.indivdual-group-planning-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;
        return view('iso.indivdual-group-planning-create', compact('hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // ใช้ Database Transaction ป้องกันข้อมูลพังเวลามีข้อผิดพลาด
    DB::beginTransaction();

    try {
        // 1. เตรียมข้อมูลพื้นฐานสำหรับ Header
        $headerData = [
            'section'       => $request->section,
            'product_code'  => $request->product_code,
            'job_no'        => $request->job_no,
            'qty'           => $request->qty ?? 0,
            'customer'      => $request->customer,
            'responsible'   => $request->responsible,
            'budget_time'   => $request->budget_time,
            'mh_for_date'   => $request->mh_for_date,
            'to_date'       => $request->to_date,
            'remark'        => $request->remark,
            'month_1'       => $request->month_1,
            'month_2'       => $request->month_2,
            'month_3'       => $request->month_3,
            'prepared_by'   => $request->prepared_by,
            'prepared_date' => $request->prepared_date,
            'docs_status'   => '1',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ];

        // 2. นำข้อมูล Weekly Review (1-6) ใส่เข้าไปในอาเรย์ของ Header
        if ($request->has('weekly_review')) {
            foreach ($request->weekly_review as $weekNo => $review) {
                $headerData["weekly_{$weekNo}_col1"] = $review['col1'] ?? null;
                $headerData["weekly_{$weekNo}_col2"] = $review['col2'] ?? null;
                $headerData["weekly_{$weekNo}_col3"] = $review['col3'] ?? null;
            }
        }

        // 3. บันทึกข้อมูล Header ลงฐานข้อมูลครั้งเดียวจบ
        $header = IndividualgroupPlanningHd::create($headerData);

        // 4. บันทึกข้อมูลตาราง Detail (แถวในตารางหลักที่เพิ่ม/ลบได้)
        if ($request->has('details')) {
            foreach ($request->details as $index => $detail) {
                $dtData = [
                    'individualgroup_planning_hds_id' => $header->individualgroup_planning_hds_id,
                    'description'                     => $detail['description'] ?? null,
                ];

                // วนลูปเก็บค่า val_0 ถึง val_17 ของแต่ละแถว
                for ($i = 0; $i < 18; $i++) {
                    $dtData["val_{$i}"] = $detail["val_{$i}"] ?? null;
                }

                // บันทึก Ack และ Date ลงไปทุกแถว (หรือจะบันทึกเฉพาะแถวแรกก็ได้ ขึ้นอยู่กับการใช้งานของคุณ)
                for ($i = 0; $i < 18; $i++) {
                    $dtData["ack_{$i}"]      = $request->ack[$i] ?? null;
                    $dtData["ack_date_{$i}"] = $request->ack_date[$i] ?? null;
                }

                IndividualgroupPlanningDt::create($dtData);
            }
        }

        DB::commit();

        return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จเรียบร้อยแล้ว');

    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการบันทึก: ' . $e->getMessage())->withInput();
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
        $hd = IndividualgroupPlanningHd::find($id);
        $dt = IndividualgroupPlanningDt::where('individualgroup_planning_hds_id',$id)->get();
        return view('iso.indivdual-group-planning-update', compact('hd','dt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = IndividualgroupPlanningHd::find($id);
        $dt = IndividualgroupPlanningDt::where('individualgroup_planning_hds_id',$id)->get();
        return view('iso.indivdual-group-planning-edit', compact('hd','dt'));
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
            // ใช้ Database Transaction ป้องกันข้อมูลพังเวลามีข้อผิดพลาด
            DB::beginTransaction();

            try {
                // 1. ค้นหา Header ตาม ID ที่ต้องการแก้ไข
                $header = IndividualgroupPlanningHd::findOrFail($id);

                // 2. เตรียมข้อมูลสำหรับอัปเดต Header
                $headerData = [
                    'section'       => $request->section,
                    'product_code'  => $request->product_code,
                    'job_no'        => $request->job_no,
                    'qty'           => $request->qty ?? 0,
                    'customer'      => $request->customer,
                    'responsible'   => $request->responsible,
                    'budget_time'   => $request->budget_time,
                    'mh_for_date'   => $request->mh_for_date,
                    'to_date'       => $request->to_date,
                    'remark'        => $request->remark,
                    'month_1'       => $request->month_1,
                    'month_2'       => $request->month_2,
                    'month_3'       => $request->month_3,
                    'prepared_by'   => $request->prepared_by,
                    'prepared_date' => $request->prepared_date,
                    'docs_status'   => '1',
                    'updated_at'    => Carbon::now(),
                ];

                // 3. นำข้อมูล Weekly Review (1-6) ใส่เข้าไปในอาเรย์
                if ($request->has('weekly_review')) {
                    foreach ($request->weekly_review as $weekNo => $review) {
                        $headerData["weekly_{$weekNo}_col1"] = $review['col1'] ?? null;
                        $headerData["weekly_{$weekNo}_col2"] = $review['col2'] ?? null;
                        $headerData["weekly_{$weekNo}_col3"] = $review['col3'] ?? null;
                    }
                }

                // 4. ทำการอัปเดตข้อมูล Header
                $header->update($headerData);

                // 5. จัดการตาราง Detail: ลบรายการเก่าทั้งหมดทิ้งก่อน แล้วบันทึกรายการใหม่เข้าไป
                $header->details()->delete();

                if ($request->has('details')) {
                    foreach ($request->details as $index => $detail) {
                        $dtData = [
                            'individualgroup_planning_hds_id' => $header->individualgroup_planning_hds_id,
                            'description'                     => $detail['description'] ?? null,
                        ];

                        // บันทึกค่า val_0 ถึง val_17 ของแต่ละแถว
                        for ($i = 0; $i < 18; $i++) {
                            $dtData["val_{$i}"] = $detail["val_{$i}"] ?? null;
                        }

                        // บันทึกค่า Ack และ Date ประจำคอลัมน์ (จาก tfoot)
                        for ($i = 0; $i < 18; $i++) {
                            $dtData["ack_{$i}"]      = $request->ack[$i] ?? null;
                            $dtData["ack_date_{$i}"] = $request->ack_date[$i] ?? null;
                        }

                        IndividualgroupPlanningDt::create($dtData);
                    }
                }

                DB::commit();

                return redirect()->route('individual-plannings.index')->with('success', 'อัปเดตข้อมูลสำเร็จเรียบร้อยแล้ว');

            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการอัปเดต: ' . $e->getMessage())->withInput();
            }
        }elseif($request->doc_ref == "Update"){
            DB::beginTransaction();
            try {
                $header = IndividualgroupPlanningHd::findOrFail($id);
                if($header->docs_status =="1"){
                    $headerData = [
                        'checked_by'    => $request->checked_by,
                        'checked_date'  => $request->checked_date,
                        'docs_status'   => '2',
                    ];
                }elseif($header->docs_status =="2"){
                    $headerData = [
                        'approved_by'   => $request->approved_by,
                        'approved_date'  => $request->approved_date,
                        'docs_status'   => '3',
                    ];
                }
               
                $header->update($headerData);
                DB::commit();
                return redirect()->route('individual-plannings.index')->with('success', 'อัปเดตข้อมูลสำเร็จเรียบร้อยแล้ว');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการอัปเดต: ' . $e->getMessage())->withInput();
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

    public function cancelCompanylimited(Request $request)
    {
        $hd = IndividualgroupPlanningHd::where('individualgroup_planning_hds_id',$request->refid)->update([
            'individualgroup_planning_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
