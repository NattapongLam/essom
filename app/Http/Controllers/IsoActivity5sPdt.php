<?php

namespace App\Http\Controllers;

use App\Models\ActivitysPdtDt;
use App\Models\ActivitysPdtHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IsoActivity5sPdt extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = ActivitysPdtHd::where('activitys_pdt_hds_flag',true)->get();
        return view('iso.activity-5spdt-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function create1()
    {
        $hd = null;
        return view('iso.activity-5spdt-create1', compact('hd'));
    }

    public function create2()
    {
        $hd = null;
        return view('iso.activity-5spdt-create2', compact('hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // 1. ตรวจสอบ docutype เบื้องต้น
    $docutype = $request->docutype;

    if (!in_array($docutype, ["GF113.1-F", "GF113.2-F"])) {
        return redirect()->back()->with('error', 'ประเภทเอกสารไม่ถูกต้อง')->withInput();
    }

    // 2. Validate ข้อมูล
    $request->validate([
        'time_no'    => 'nullable|string',
        'department' => 'nullable|string',
        'floor'      => 'nullable|string',
        'audit_date' => 'nullable|date',
        'score'      => 'required|array',
    ]);

    try {
        DB::beginTransaction();

        // 3. กำหนดโครงสร้างข้อสอบ/หัวข้อตรวจแยกตาม docutype
        $auditStructures = [
            "GF113.1-F" => [
                'สะสาง' => [
                    1 => 'มีเอกสาร ที่ไม่ใช้งานหรือเกินความจำเป็นอยู่ในพื้นที่หรือไม่',
                    2 => 'มีสิ่งของไม่เกี่ยวข้อง เครื่องใช้ส่วนตัวปะปนกับงานหรือไม่',
                    3 => 'มีวัสดุอุปกรณ์ที่ไม่ใช้งานหรือเกินความจำเป็นอยู่ในพื้นที่หรือไม่',
                    4 => 'การวางและจัดเก็บเครื่องมือเครื่องใช้สามารถหยิบใช้งานได้สะดวก',
                ],
                'สะดวก' => [
                    1 => 'การจัดเก็บเอกสารวัสดุต่างๆ เป็นระเบียบหยิบใช้งานได้สะดวก',
                    2 => 'การจัดเก็บวัสดุอุปกรณ์จัดวางเป็นหมวดหมู่',
                    3 => 'มีการกำหนดที่วางสิ่งของและมีป้ายชี้บ่ง รวมทั้งการจัดวางถูกตำแหน่งที่กำหนดหรือไม่',
                    4 => 'วิธีการทำงานสะดวกหรือไม่ เช่น เอื้อมหยิบ มุดเข้าหรือที่อื่นๆ ที่ทำให้เสียเวลา',
                    5 => 'เอกสารต่างๆ ที่ใช้ในการทำงาน หยิบได้สะดวก',
                ],
                'สะอาด' => [
                    1 => 'มีฝุ่น คราบสกปรก คราบน้ำมัน หยากไย่ ฯลฯ หรือไม่',
                    2 => 'วัสดุอุปกรณ์ที่จัดเก็บมีการทำความสะอาดหรือไม่',
                    3 => 'ชั้นวางวัสดุอุปกรณ์มีการทำความสะอาดหรือไม่',
                    4 => 'ความสะอาดโดยรวมของพื้นที่',
                ],
                'สุขลักษณะ' => [
                    1 => 'ตัวอาคาร ฝ้าเพดาน พื้น ผนัง ชั้นวางของ ตู้อุปกรณ์มีการชำรุด สีหลุดร่อนและไม่ได้รับการซ่อมแซมหรือไม่',
                    2 => 'มีการติดป้ายชื่อบอกหน่วยงานหรือไม่',
                    3 => 'มีวัสดุสิ่งของวางขวางทางเดินหรือไม่',
                    4 => 'ตู้เก็บวัสดุอุปกรณ์มีกุญแจล็อคและมีชื่อผู้รับผิดชอบหรือไม่',
                    5 => 'อุปกรณ์เครื่องมือที่ใช้ในการทำงานมีความปลอดภัยหรือไม่',
                ],
                'สร้างนิสัย' => [
                    1 => 'มีความพยายาม ความร่วมมือในการปรับปรุงพื้นที่หรือไม่',
                    2 => 'สอบถามความรู้ความเข้าใจพนักงานต่อการทำกิจกรรม 5 ส',
                ]
            ],
            "GF113.2-F" => [
                '1.บริเวณทำงาน' => [
                    '1.1' => 'ไม่วางสิ่งของไว้ใต้โต๊ะหรือบนพนักพิงเก้าอี้',
                    '1.2' => 'ของบนโต๊ะทำงาน จัดวางเป็นระเบียบนำมาใช้ได้สะดวก',
                    '1.3' => 'ไม่มีเศษขยะบริเวณโต๊ะทำงาน',
                    '1.4' => 'เครื่องใช้สำนักงานส่วนกลางต้องไม่มีสิ่งของที่ไม่เกี่ยวข้องปะปนบริเวณเครื่องใช้มีชื่อผู้รับผิดชอบ มีความสะอาดพร้อมใช้งาน',
                ],
                '2.ห้องพัสดุ' => [
                    '2.1' => 'ตู้เอกสาร / ตู้เก็บอุปกรณ์ / ชั้นเก็บของ วางแบ่งหมวดหมู่ชัดเจนไม่มีของอื่นปะปน',
                    '2.2' => 'ไม่มีของที่ไม่เกี่ยวข้องเก็บในตู้',
                    '2.3' => 'จัดแบ่งพื้นที่ในตู้และชั้นวางของให้เป็นระเบียบมีป้ายชี้บ่งให้เข้าใจ',
                    '2.4' => 'รักษาความสะอาดบริเวณตู้เอกสารไม่มีเทป/คราบกาวติดตู้',
                    '2.5' => 'ไม่วางสิ่งของขวางหน้าตู้เอกสาร',
                ],
                '3.ห้องครัว' => [
                    '3.1' => 'โต๊ะห้องครัวและเครื่องใช้ไฟฟ้ามีความสะอาด',
                    '3.2' => 'ห้องครัวจัดเก็บสิ่งของเป็นระเบียบ และเป็นหมวดหมู่ตามชั้นวางหยิบใช้ได้สะดวก',
                    '3.3' => 'ตู้เย็นต้องไม่มีอาหารเหลือเก็บไว้นาน',
                ],
                '4.ห้องน้ำ' => [
                    '4.1' => 'พื้นที่ห้องน้ำมีความสะอาด ไม่มีขยะนอกถังขยะ',
                    '4.2' => 'มีกระดาษชำระสำรองตลอดเวลา',
                    '4.3' => 'สิ่งของเครื่องใช้ส่วนตัววางไว้ในห้องน้ำแบบเป็นระเบียบเรียบร้อย',
                ],
                '5.พื้นที่ส่วนกลาง' => [
                    '5.1' => 'พื้นที่มีความสะอาดไม่มีเศษขยะเช่นทางเดิน ห้องโถง บันได พื้นที่โดยรอบสำนักงาน',
                    '5.2' => 'วางสิ่งของเป็นระเบียบในบริเวณพื้นที่ที่กำหนด',
                    '5.3' => 'ห้องประชุม กระดานไวท์บอร์ด ต้องสะอาดและดต๊ะประชุม,เก้าอี้จัดวางเรียบร้อยอยู่ในสภาพพร้อมใช้งาน',
                    '5.4' => 'บอร์ดติดประกาศมีข้อมูลที่เป็นปัจุบัน',
                    '5.5' => 'บริเวณวางรองเท้าเข้าห้องทำงานมีความเป็นระเบียบเรียบร้อย',
                ]
            ]
        ];

        $auditStructure = $auditStructures[$docutype];

        // 4. บันทึกข้อมูล Header
        $header = ActivitysPdtHd::create([
            'docutype'               => $docutype,
            'time_no'                => $request->time_no,
            'department'             => $request->department,
            'floor'                  => $request->floor ?? null,
            'audit_date'             => $request->audit_date,
            'employee_name'          => $request->employee_name,
            'strengths'              => $request->strengths,
            'improvements'           => $request->improvements,
            'total_score'            => 0, 
            'prepared_by'            => $request->prepared_by ?? (auth()->user()->name ?? null),
            'prepared_date'          => $request->prepared_date ?? now(),
            'checked_by'             => $request->checked_by,
            'checked_date'           => $request->checked_date,
            'activitys_pdt_hds_flag' => true,
        ]);

        $totalScore = 0;
        $scoreKeys = array_keys($request->score ?? []);
        $index = 0;

        // 5. วนลูปบันทึก Detail
        foreach ($auditStructure as $categoryName => $items) {
            foreach ($items as $itemNo => $descText) {
                if (isset($scoreKeys[$index])) {
                    $key = $scoreKeys[$index];
                    $scoreValue = (int) $request->score[$key];
                    $totalScore += $scoreValue;

                    ActivitysPdtDt::create([
                        'activitys_pdt_hds_id' => $header->activitys_pdt_hds_id,
                        'category'             => $categoryName,
                        'item_no'              => $itemNo,
                        'description'          => $descText,
                        'max_score'            => 5,
                        'score'                => $scoreValue,
                    ]);

                    $index++;
                }
            }
        }

        // 6. อัปเดตคะแนนรวม
        $header->update([
            'total_score' => $totalScore
        ]);

        DB::commit();

        return redirect()->back()->with('success', 'บันทึกผลการตรวจประเมินเรียบร้อยแล้ว');

    } catch (\Exception $e) {
        DB::rollBack();
        dd($e->getMessage(), $e->getLine(), $e->getFile());
        return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage())->withInput();
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
        $hd = ActivitysPdtHd::find($id);
        if($hd->docutype == "GF113.1-F"){
            return view('iso.activity-5spdt-edit1', compact('hd'));
        }elseif($hd->docutype == "GF113.2-F"){
            return view('iso.activity-5spdt-edit2', compact('hd'));
        }
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
    // 1. ค้นหาข้อมูล Header เดิมตาม ID
    $header = ActivitysPdtHd::findOrFail($id);
    
    $docutype = $request->docutype ?? $header->docutype;

    if (!in_array($docutype, ["GF113.1-F", "GF113.2-F"])) {
        return redirect()->back()->with('error', 'ประเภทเอกสารไม่ถูกต้อง')->withInput();
    }

    // 2. Validate ข้อมูล
    $request->validate([
        'time_no'    => 'nullable|string',
        'department' => 'nullable|string',
        'floor'      => 'nullable|string',
        'audit_date' => 'nullable|date',
        'score'      => 'required|array',
    ]);

    try {
        DB::beginTransaction();

        // 3. กำหนดโครงสร้างข้อตรวจแยกตาม docutype (ให้ตรงกับตอนบันทึกข้อมูลใหม่)
        $auditStructures = [
            "GF113.1-F" => [
                'สะสาง' => [
                    1 => 'มีเอกสาร ที่ไม่ใช้งานหรือเกินความจำเป็นอยู่ในพื้นที่หรือไม่',
                    2 => 'มีสิ่งของไม่เกี่ยวข้อง เครื่องใช้ส่วนตัวปะปนกับงานหรือไม่',
                    3 => 'มีวัสดุอุปกรณ์ที่ไม่ใช้งานหรือเกินความจำเป็นอยู่ในพื้นที่หรือไม่',
                    4 => 'การวางและจัดเก็บเครื่องมือเครื่องใช้สามารถหยิบใช้งานได้สะดวก',
                ],
                'สะดวก' => [
                    1 => 'การจัดเก็บเอกสารวัสดุต่างๆ เป็นระเบียบหยิบใช้งานได้สะดวก',
                    2 => 'การจัดเก็บวัสดุอุปกรณ์จัดวางเป็นหมวดหมู่',
                    3 => 'มีการกำหนดที่วางสิ่งของและมีป้ายชี้บ่ง รวมทั้งการจัดวางถูกตำแหน่งที่กำหนดหรือไม่',
                    4 => 'วิธีการทำงานสะดวกหรือไม่ เช่น เอื้อมหยิบ มุดเข้าหรือที่อื่นๆ ที่ทำให้เสียเวลา',
                    5 => 'เอกสารต่างๆ ที่ใช้ในการทำงาน หยิบได้สะดวก',
                ],
                'สะอาด' => [
                    1 => 'มีฝุ่น คราบสกปรก คราบน้ำมัน หยากไย่ ฯลฯ หรือไม่',
                    2 => 'วัสดุอุปกรณ์ที่จัดเก็บมีการทำความสะอาดหรือไม่',
                    3 => 'ชั้นวางวัสดุอุปกรณ์มีการทำความสะอาดหรือไม่',
                    4 => 'ความสะอาดโดยรวมของพื้นที่',
                ],
                'สุขลักษณะ' => [
                    1 => 'ตัวอาคาร ฝ้าเพดาน พื้น ผนัง ชั้นวางของ ตู้อุปกรณ์มีการชำรุด สีหลุดร่อนและไม่ได้รับการซ่อมแซมหรือไม่',
                    2 => 'มีการติดป้ายชื่อบอกหน่วยงานหรือไม่',
                    3 => 'มีวัสดุสิ่งของวางขวางทางเดินหรือไม่',
                    4 => 'ตู้เก็บวัสดุอุปกรณ์มีกุญแจล็อคและมีชื่อผู้รับผิดชอบหรือไม่',
                    5 => 'อุปกรณ์เครื่องมือที่ใช้ในการทำงานมีความปลอดภัยหรือไม่',
                ],
                'สร้างนิสัย' => [
                    1 => 'มีความพยายาม ความร่วมมือในการปรับปรุงพื้นที่หรือไม่',
                    2 => 'สอบถามความรู้ความเข้าใจพนักงานต่อการทำกิจกรรม 5 ส',
                ]
            ],
            "GF113.2-F" => [
                '1.บริเวณทำงาน' => [
                    '1.1' => 'ไม่วางสิ่งของไว้ใต้โต๊ะหรือบนพนักพิงเก้าอี้',
                    '1.2' => 'ของบนโต๊ะทำงาน จัดวางเป็นระเบียบนำมาใช้ได้สะดวก',
                    '1.3' => 'ไม่มีเศษขยะบริเวณโต๊ะทำงาน',
                    '1.4' => 'เครื่องใช้สำนักงานส่วนกลางต้องไม่มีสิ่งของที่ไม่เกี่ยวข้องปะปนบริเวณเครื่องใช้มีชื่อผู้รับผิดชอบ มีความสะอาดพร้อมใช้งาน',
                ],
                '2.ห้องพัสดุ' => [
                    '2.1' => 'ตู้เอกสาร / ตู้เก็บอุปกรณ์ / ชั้นเก็บของ วางแบ่งหมวดหมู่ชัดเจนไม่มีของอื่นปะปน',
                    '2.2' => 'ไม่มีของที่ไม่เกี่ยวข้องเก็บในตู้',
                    '2.3' => 'จัดแบ่งพื้นที่ในตู้และชั้นวางของให้เป็นระเบียบมีป้ายชี้บ่งให้เข้าใจ',
                    '2.4' => 'รักษาความสะอาดบริเวณตู้เอกสารไม่มีเทป/คราบกาวติดตู้',
                    '2.5' => 'ไม่วางสิ่งของขวางหน้าตู้เอกสาร',
                ],
                '3.ห้องครัว' => [
                    '3.1' => 'โต๊ะห้องครัวและเครื่องใช้ไฟฟ้ามีความสะอาด',
                    '3.2' => 'ห้องครัวจัดเก็บสิ่งของเป็นระเบียบ และเป็นหมวดหมู่ตามชั้นวางหยิบใช้ได้สะดวก',
                    '3.3' => 'ตู้เย็นต้องไม่มีอาหารเหลือเก็บไว้นาน',
                ],
                '4.ห้องน้ำ' => [
                    '4.1' => 'พื้นที่ห้องน้ำมีความสะอาด ไม่มีขยะนอกถังขยะ',
                    '4.2' => 'มีกระดาษชำระสำรองตลอดเวลา',
                    '4.3' => 'สิ่งของเครื่องใช้ส่วนตัววางไว้ในห้องน้ำแบบเป็นระเบียบเรียบร้อย',
                ],
                '5.พื้นที่ส่วนกลาง' => [
                    '5.1' => 'พื้นที่มีความสะอาดไม่มีเศษขยะเช่นทางเดิน ห้องโถง บันได พื้นที่โดยรอบสำนักงาน',
                    '5.2' => 'วางสิ่งของเป็นระเบียบในบริเวณพื้นที่ที่กำหนด',
                    '5.3' => 'ห้องประชุม กระดานไวท์บอร์ด ต้องสะอาดและดต๊ะประชุม,เก้าอี้จัดวางเรียบร้อยอยู่ในสภาพพร้อมใช้งาน',
                    '5.4' => 'บอร์ดติดประกาศมีข้อมูลที่เป็นปัจุบัน',
                    '5.5' => 'บริเวณวางรองเท้าเข้าห้องทำงานมีความเป็นระเบียบเรียบร้อย',
                ]
            ]
        ];

        $auditStructure = $auditStructures[$docutype];

        // 4. อัปเดตข้อมูลส่วน Header
        $header->update([
            'docutype'      => $docutype,
            'time_no'       => $request->time_no,
            'department'    => $request->department,
            'floor'         => $request->floor ?? $header->floor,
            'audit_date'    => $request->audit_date,
            'employee_name' => $request->employee_name,
            'strengths'     => $request->strengths,
            'improvements'  => $request->improvements,
            'checked_by'    => $request->checked_by,
            'checked_date'  => $request->checked_date,
        ]);

        // 5. ลบรายการ Details เก่าทิ้งทั้งหมด เพื่อบันทึกชุดคะแนนใหม่ที่แก้ไขเข้าไปแทน
        $header->details()->delete();

        $totalScore = 0;
        $scoreKeys = array_keys($request->score ?? []);
        $index = 0;

        // 6. วนลูปสร้างรายการ Details ใหม่
        foreach ($auditStructure as $categoryName => $items) {
            foreach ($items as $itemNo => $descText) {
                if (isset($scoreKeys[$index])) {
                    $key = $scoreKeys[$index];
                    $scoreValue = (int) $request->score[$key];
                    $totalScore += $scoreValue;

                    ActivitysPdtDt::create([
                        'activitys_pdt_hds_id' => $header->activitys_pdt_hds_id,
                        'category'             => $categoryName,
                        'item_no'              => $itemNo,
                        'description'          => $descText,
                        'max_score'            => 5,
                        'score'                => $scoreValue,
                    ]);

                    $index++;
                }
            }
        }

        // 7. อัปเดตคะแนนรวม (Total Score) ล่าสุดกลับไปที่ Header
        $header->update([
            'total_score' => $totalScore
        ]);

        DB::commit();

        return redirect()->back()->with('success', 'อัปเดตผลการตรวจประเมินเรียบร้อยแล้ว');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล: ' . $e->getMessage())->withInput();
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

    public function cancelActivity5spdt(Request $request)
    {
        $hd = ActivitysPdtHd::where('activitys_pdt_hds_id',$request->refid)->update([
            'activitys_pdt_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
