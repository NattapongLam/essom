<?php

namespace App\Http\Controllers;

use App\Models\InspectionRecordsdmDt;
use App\Models\InspectionRecordsdmHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IsoInspectionRecordSdm extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = InspectionRecordsdmHd::where('inspection_recordsdm_hds_flag',true)->get();
        return view('iso.inspection-recordsdm-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;
        return view('iso.inspection-recordsdm-create', compact('hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // 1. บันทึกข้อมูลส่วนหัว (Header)
            $header = InspectionRecordsdmHd::create([
                'doc_number' => 'GF409 SDM',
                'company_name' => 'ESSOM CO., LTD',
                'checked_by' => $request->checked_by,
                'checked_job' => $request->checked_job,
                'checked_date' => $request->checked_date,
                // 'approved_by' => $request->approved_by,
                // 'approved_job' => $request->approved_job,
                // 'approved_date' => $request->approved_date,
                'overall_status' => '1', // หรือเช็คว่าผ่านทั้งหมดไหม
                'inspection_recordsdm_hds_flag' => true
            ]);

            // 2. วนลูปบันทึกรายการตรวจเช็คทั้งหมด (Details)
            if ($request->has('items')) {
                $allItems = [
                    1 => [
                        'Flash & Fire Point (Cleveland) (ชุดทดสอบจุดวาบไฟและจุดติดไฟแบบเปิด)',
                        'สภาพสีและอุปกรณ์ประกอบ',
                        'การทำงานและสภาพของชุดฮีทเตอร์ (สามารถปรับอุณหภูมิได้)',
                        'สวิทซ์เปิด-ปิด (ปิดแล้วมีไฟติด และเครื่องทำงาน)',
                        'การหมุนของหัวส่าย (รุ่น 880 เอามือส่ายได้สะดวก,รุ่น 890 กดสวิทซ์ดูว่าส่ายได้)',
                        'คู่มือ'
                    ],
                    2 => [
                        'Flash & Fire Point (Cleveland) (ชุดทดสอบจุดวาบไฟและจุดติดไฟแบบเปิด)',
                        'สภาพสีและอุปกรณ์ประกอบ',
                        'การทำงานของชุดฮีทเตอร์ (สามารถปรับอุณหภูมิได้)',
                        'กลไกการเปิดฝาสามารถทำงานได้สะดวก (เปิดแล้วปล่อยให้สปริงกลับเองได้)',
                        'การทำงานของมอเตอร์กวน',
                        'สวิทซ์เปิด-ปิด (ปิดแล้วมีไฟติด และเครื่องทำงาน)',
                        'คู่มือ'
                    ],
                    3 => [
                        'Kinematic Viscometer (ชุดทดสอบความหนืดของน้ำมัน)',
                        'สภาพ, ผิว และอุปกรณ์ประกอบ',
                        'รอยเชื่อมของสแตนเลส (เรียบร้อยไม่มีเขม่าหรือขี้เชื่อม ไม่มีขอบคม)',
                        'การทำงานของชุดฮีทเตอร์ (ต้องใส่น้ำขณะทดลอง และดูว่าปรับอุณหภูมิได้)',
                        'สวิทซ์เปิด-ปิด (เปิดแล้วมีไฟติด และเครื่องทำงาน)',
                        'การทำงานของระบบไฟแสงสว่าง',
                        'การทำงานของมอเตอร์กวน',
                        'คู่มือ'
                    ],
                    4 => [
                        'Saybolt Viscometer (ชุดทดสอบความหนืดของน้ำมัน)',
                        'สภาพ, ผิวและอุปกรณ์ประกอบ',
                        'การทำงานของชุดฮีทเตอร์ (ต้องใส่น้ำขณะทดลอง และดูว่าปรับอุณหภูมิได้)',
                        'สวิทซ์เปิด-ปิด (เปิดแล้วมีไฟติด และเครื่องทำงาน)',
                        'การทำงานของมอเตอร์กวน',
                        'คู่มือ'
                    ],
                    5 => [
                        'Penetrometer (ชุดทดสอบความเหนียวข้นของจารบี)',
                        'สภาพสีและอุปกรณ์ประกอบ',
                        'กรายทดสอบอยู่ในสภาพดี แกนไม่คด ปลายแหลมไม่หักงอ',
                        'ตัวปล่อยเข็มทำงานได้ทั้งแบบใช้ไฟฟ้าและแบบไม่ใช้ไฟฟ้า',
                        'ตัววัดระดับเลื่อนขึ้น-ลงได้คล่องตัว (ทั้งระบบปรับหยาบและปรับละเอียด)',
                        'การทำงานของ Timer (ตั้งเวลาได้ไม่น้อยกว่า 5 วินาที และตัดการทำงานเมื่อครบเวลา)',
                        'สวิทซ์เปิด-ปิด (เปิดแล้วมีไฟติด และเครื่องทำงาน)',
                        'คู่มือ'
                    ],
                    6 => [
                        'Bomb Calorimeter (ชุดทดสอบหาค่าความร้อนของเชื้อเพลิง)',
                        'สภาพสี, ผิว และอุปกรณ์ประกอบ',
                        'การทำงานของชุดจุดระเบิด (ทดลองใช้ลวดจุดระเบิดจริง เข็มแอมป์ต้องขึ้น)',
                        'การทำงานของมอเตอร์กวน',
                        'ฝาของชุดบอมบ์ขันเข้า-ออกสะดวก',
                        'ขายึดลวดภายใน ไม่หลวมคลอน',
                        'ขั้วไฟฟ้าไม่ลัดวงจร',
                        'สวิทซ์เปิด-ปิด (เปิดแล้วมีไฟติด และเครื่องทำงานปกติ)',
                        'คู่มือ'
                    ]
                ];

                foreach ($request->items as $sectionNo => $items) {
                    foreach ($items as $index => $data) {
                        InspectionRecordsdmDt::create([
                            'inspection_recordsdm_hds_id' => $header->inspection_recordsdm_hds_id,
                            'section_no' => $sectionNo,
                            'item_name' => $allItems[$sectionNo][$index] ?? 'รายการตรวจสอบ',
                            'pass_fail' => $data['pass_fail'] ?? null,
                            'remarks' => $data['remarks'] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
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
        $hd = InspectionRecordsdmHd::find($id);
        return view('iso.inspection-recordsdm-update', compact('hd'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = InspectionRecordsdmHd::find($id);
        return view('iso.inspection-recordsdm-edit', compact('hd'));
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
            DB::beginTransaction();
            try {
                // 1. ค้นหาข้อมูล Header ตาม Primary Key ของคุณ
                $header = InspectionRecordsdmHd::where('inspection_recordsdm_hds_id', $id)->firstOrFail();

                // 2. อัปเดตข้อมูลส่วนหัว
                $header->update([
                    'checked_by' => $request->checked_by,
                    'checked_job' => $request->checked_job,
                    'checked_date' => $request->checked_date,
                    'overall_status' => '1',
                ]);

                // 3. กำหนดชื่อหัวข้อรายการทั้งหมด (โครงสร้างเดียวกับตอนสร้าง)
                $allItems = [
                    1 => [
                        'Flash & Fire Point (Cleveland) (ชุดทดสอบจุดวาบไฟและจุดติดไฟแบบเปิด)',
                        'สภาพสีและอุปกรณ์ประกอบ',
                        'การทำงานและสภาพของชุดฮีทเตอร์ (สามารถปรับอุณหภูมิได้)',
                        'สวิทซ์เปิด-ปิด (ปิดแล้วมีไฟติด และเครื่องทำงาน)',
                        'การหมุนของหัวส่าย (รุ่น 880 เอามือส่ายได้สะดวก,รุ่น 890 กดสวิทซ์ดูว่าส่ายได้)',
                        'คู่มือ'
                    ],
                    2 => [
                        'Flash & Fire Point (Cleveland) (ชุดทดสอบจุดวาบไฟและจุดติดไฟแบบเปิด)',
                        'สภาพสีและอุปกรณ์ประกอบ',
                        'การทำงานของชุดฮีทเตอร์ (สามารถปรับอุณหภูมิได้)',
                        'กลไกการเปิดฝาสามารถทำงานได้สะดวก (เปิดแล้วปล่อยให้สปริงกลับเองได้)',
                        'การทำงานของมอเตอร์กวน',
                        'สวิทซ์เปิด-ปิด (ปิดแล้วมีไฟติด และเครื่องทำงาน)',
                        'คู่มือ'
                    ],
                    3 => [
                        'Kinematic Viscometer (ชุดทดสอบความหนืดของน้ำมัน)',
                        'สภาพ, ผิว และอุปกรณ์ประกอบ',
                        'รอยเชื่อมของสแตนเลส (เรียบร้อยไม่มีเขม่าหรือขี้เชื่อม ไม่มีขอบคม)',
                        'การทำงานของชุดฮีทเตอร์ (ต้องใส่น้ำขณะทดลอง และดูว่าปรับอุณหภูมิได้)',
                        'สวิทซ์เปิด-ปิด (ปิดแล้วมีไฟติด และเครื่องทำงาน)',
                        'การทำงานของระบบไฟแสงสว่าง',
                        'การทำงานของมอเตอร์กวน',
                        'คู่มือ'
                    ],
                    4 => [
                        'Saybolt Viscometer (ชุดทดสอบความหนืดของน้ำมัน)',
                        'สภาพ, ผิวและอุปกรณ์ประกอบ',
                        'การทำงานของชุดฮีทเตอร์ (ต้องใส่น้ำขณะทดลอง และดูว่าปรับอุณหภูมิได้)',
                        'สวิทซ์เปิด-ปิด (ปิดแล้วมีไฟติด และเครื่องทำงาน)',
                        'การทำงานของมอเตอร์กวน',
                        'คู่มือ'
                    ],
                    5 => [
                        'Penetrometer (ชุดทดสอบความเหนียวข้นของจารบี)',
                        'สภาพสีและอุปกรณ์ประกอบ',
                        'กรายทดสอบอยู่ในสภาพดี แกนไม่คด ปลายแหลมไม่หักงอ',
                        'ตัวปล่อยเข็มทำงานได้ทั้งแบบใช้ไฟฟ้าและแบบไม่ใช้ไฟฟ้า',
                        'ตัววัดระดับเลื่อนขึ้น-ลงได้คล่องตัว (ทั้งระบบปรับหยาบและปรับละเอียด)',
                        'การทำงานของ Timer (ตั้งเวลาได้ไม่น้อยกว่า 5 วินาที และตัดการทำงานเมื่อครบเวลา)',
                        'สวิทซ์เปิด-ปิด (ปิดแล้วมีไฟติด และเครื่องทำงาน)',
                        'คู่มือ'
                    ],
                    6 => [
                        'Bomb Calorimeter (ชุดทดสอบหาค่าความร้อนของเชื้อเพลิง)',
                        'สภาพสี, ผิว และอุปกรณ์ประกอบ',
                        'การทำงานของชุดจุดระเบิด (ทดลองใช้ลวดจุดระเบิดจริง เข็มแอมป์ต้องขึ้น)',
                        'การทำงานของมอเตอร์กวน',
                        'ฝาของชุดบอมบ์ขันเข้า-ออกสะดวก',
                        'ขายึดลวดภายใน ไม่หลวมคลอน',
                        'ขั้วไฟฟ้าไม่ลัดวงจร',
                        'สวิทซ์เปิด-ปิด (เปิดแล้วมีไฟติด และเครื่องทำงานปกติ)',
                        'คู่มือ'
                    ]
                ];

                // 4. ลบรายการ Detail เก่าทิ้งทั้งหมด แล้วบันทึกชุดใหม่ลงไปแทน (Clean & Safe Update)
                InspectionRecordsdmDt::where('inspection_recordsdm_hds_id', $header->inspection_recordsdm_hds_id)->delete();

                if ($request->has('items')) {
                    foreach ($request->items as $sectionNo => $items) {
                        foreach ($items as $index => $data) {
                            InspectionRecordsdmDt::create([
                                'inspection_recordsdm_hds_id' => $header->inspection_recordsdm_hds_id,
                                'section_no' => $sectionNo,
                                'item_name' => $allItems[$sectionNo][$index] ?? 'รายการตรวจสอบ',
                                'pass_fail' => $data['pass_fail'] ?? null,
                                'remarks' => $data['remarks'] ?? null,
                            ]);
                        }
                    }
                }

                DB::commit();
                return redirect()->route('inspection-record-sdms.index')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage())->withInput();
            }
        }elseif($request->doc_ref == "Update"){
            DB::beginTransaction();
            try {
                $header = InspectionRecordsdmHd::where('inspection_recordsdm_hds_id', $id)->firstOrFail();
                $header->update([
                    'approved_by' => $request->approved_by,
                    'approved_job' => $request->approved_job,
                    'approved_date' => $request->approved_date,
                    'overall_status' => '2',
                ]);
                DB::commit();
                return redirect()->route('inspection-record-sdms.index')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage())->withInput();
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

    public function cancelInspectionrecordhb(Request $request)
    {
        $hd = InspectionRecordsdmHd::where('inspection_recordsdm_hds_id',$request->refid)->update([
            'inspection_recordsdm_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
