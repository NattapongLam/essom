<?php

namespace App\Http\Controllers;

use App\Models\InspectionRecordhbHd;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IsoInspectionRecordHb extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = InspectionRecordhbHd::where('inspection_recordhb_hds_flag',true)->get();
        return view('iso.inspection-recordhd-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;
        return view('iso.inspection-recordhd-create', compact('hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. บันทึกข้อมูลส่วนหัว (Header)
        $header = InspectionRecordhbHd::create([
            'document_code' => 'GF409.1',
            'company_name'  => 'บริษัท เอสซอม จำกัด',
            'product_name'  => 'HB100 HYDRAULICS BENCH',
            'checked_by'    => $request->checked_by,
            'checked_job'   => $request->checked_job,
            'checked_date'  => $request->checked_date,
            // 'approved_by'   => $request->approved_by,
            // 'approved_job'  => $request->approved_job,
            // 'approved_date' => $request->approved_date,
            'status'        => '1',
            'inspection_recordhb_hds_flag' => true
        ]);

        // 2. วนลูปบันทึกข้อมูลรายการตรวจ (Details)
        if ($request->has('sections')) {
            foreach ($request->sections as $secNum => $secData) {
                $passFail = $secData['pass_fail'] ?? null;
                $remarks  = $secData['remarks'] ?? null;
                
                // แยกค่าสถานะกับหมายเหตุออก เพื่อให้เหลือแต่มิติข้อมูลที่จะเก็บลง JSON
                unset($secData['pass_fail'], $secData['remarks']);

                $header->details()->create([
                    'section_number' => $secNum,
                    'section_title'  => $secNum == 1 ? 'ถังน้ำโต๊ะชลศาสตร์' : 'ฝาถังโต๊ะชลศาสตร์',
                    'measurements'   => $secData, // Laravel จะจัดการแปลงเป็น JSON ให้เอง
                    'pass_fail'      => $passFail,
                    'remarks'        => $remarks,
                ]);
            }
        }

        return redirect()->back()->with('success', 'บันทึกข้อมูลการตรวจสอบสำเร็จ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hd = InspectionRecordhbHd::find($id);
        return view('iso.inspection-recordhd-update', compact('hd'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = InspectionRecordhbHd::find($id);
        return view('iso.inspection-recordhd-edit', compact('hd'));
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
            // 1. ค้นหาข้อมูล Header ตาม Primary Key ของคุณ
            $header = InspectionRecordhbHd::findOrFail($id);

            // 2. อัปเดตข้อมูลส่วนหัว (Header)
            $header->update([
                'checked_job'   => $request->checked_job,
                'checked_date'  => $request->checked_date,
                'status'        => '1',
                // หากต้องการให้อัปเดตสถานะหรือฟิลด์อื่นๆ เพิ่มเติม สามารถใส่ตรงนี้ได้ครับ
            ]);

            // 3. วนลูปจัดการข้อมูลรายการตรวจ (Details / Sections)
            if ($request->has('sections')) {
                foreach ($request->sections as $secNum => $secData) {
                    $passFail = $secData['pass_fail'] ?? null;
                    $remarks  = $secData['remarks'] ?? null;
                    
                    // แยกค่า pass_fail และ remarks ออกจากข้อมูลมิติ (เพื่อให้เหลือแต่มิติที่จะเก็บลง JSON)
                    unset($secData['pass_fail'], $secData['remarks']);

                    // ใช้ updateOrCreate เพื่อเช็กว่าถ้ามี section_number นี้อยู่แล้วให้อัปเดต ถ้ายังไม่มีให้สร้างใหม่
                    $header->details()->updateOrCreate(
                        [
                            'section_number' => $secNum
                        ],
                        [
                            'section_title'  => $secNum == 1 ? 'ถังน้ำโต๊ะชลศาสตร์' : 'ฝาถังโต๊ะชลศาสตร์',
                            'measurements'   => $secData, // Laravel จะแปลงเป็น JSON ให้เองอัตโนมัติ
                            'pass_fail'      => $passFail,
                            'remarks'        => $remarks,
                        ]
                    );
                }
            }

            // 4. ส่งกลับพร้อมข้อความแจ้งเตือน (สามารถปรับเปลี่ยน Route ตามที่คุณใช้งานจริงได้เลยครับ)
            return redirect()->route('inspection-record-hbs.index')->with('success', 'อัปเดตข้อมูลการตรวจสอบเรียบร้อยแล้ว');
        }elseif($request->doc_ref == "Update"){
            $header = InspectionRecordhbHd::findOrFail($id);
            $header->update([
                'approved_by'   => $request->approved_by,
                'approved_job'  => $request->approved_job,
                'approved_date' => $request->approved_date,
                'status'        => '2',
            ]);
            return redirect()->route('inspection-record-hbs.index')->with('success', 'อัปเดตข้อมูลการตรวจสอบเรียบร้อยแล้ว');
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
    public function cancelInspectionrecordhb(Request $request)
    {
        $hd = InspectionRecordhbHd::where('inspection_recordhb_hds_id',$request->refid)->update([
            'inspection_recordhb_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
