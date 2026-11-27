<?php

namespace App\Http\Controllers;

use App\Models\ActivitysOffDt;
use App\Models\ActivitysOffHd;
use App\Models\ActivitysoffMasterHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IsoActivity5sOff extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = ActivitysOffHd::where('activitys_off_hds_flag',true)->get();
        return view('iso.activity-5soff-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = ActivitysoffMasterHd::with('details')->where('activitysoff_master_hds_flag', true)->get();
        return view('iso.activity-5soff-create', compact('hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Validate ข้อมูลพื้นฐาน
        $validated = $request->validate([
            'activitysoff_master_hds_id' => 'required',
            'items'                     => 'required|array',
            'items.*.score'             => 'nullable|integer|min:0|max:5', // อนุญาตให้คะแนนเป็น 0, ค่าว่าง, หรือ 1-5 ได้
            'auditor_1'                 => 'required|string|max:255',
            'audit_date'                => 'required|date',
        ]);

        $items = $request->input('items', []);
        $totalScore = 0;
        $totalMaxScore = 0; // คะแนนเต็มรวม (คำนวณจาก Master จริง เพื่อความยืดหยุ่น)

        // ดึงข้อมูล Master และ Details มาตรวจสอบคะแนนเต็ม
        $masterHd = ActivitysoffMasterHd::with('details')->findOrFail($request->activitysoff_master_hds_id);

        DB::beginTransaction();
        try {
            // วนลูปคำนวณคะแนนรวมและคะแนนเต็ม
            foreach ($items as $index => $itemData) {
                $scoreVal = isset($itemData['score']) ? intval($itemData['score']) : 0;
                if ($scoreVal >= 1 && $scoreVal <= 5) {
                    $totalScore += $scoreVal;
                }
                
                // หาคะแนนเต็มของข้อนั้นๆ จากฐานข้อมูล Master Detail
                if (isset($itemData['activitysoff_master_dts_id'])) {
                    $detailMaster = $masterHd->details->where('activitysoff_master_dts_id', $itemData['activitysoff_master_dts_id'])->first();
                    if ($detailMaster) {
                        $totalMaxScore += intval($detailMaster->score);
                    }
                }
            }

            // ป้องกันผลหารด้วย 0 กรณีคะแนนเต็มรวมเป็น 0
            $percentageScore = $totalMaxScore > 0 ? round(($totalScore / $totalMaxScore) * 100, 2) : 0;

            // 2. บันทึกข้อมูลลงตารางหลัก (Header)
            $header = ActivitysOffHd::create([
                'activitys_off_hds_flag' => true,
                'department_name'        => $masterHd->department_name,
                'floor'                  => $masterHd->floor,
                'total_score'            => $totalScore,
                'percentage_score'       => $percentageScore,
                'strength'               => $request->strength,
                'weakness'               => $request->weakness,
                'suggestion'             => $request->suggestion,
                'auditor_1'              => $request->auditor_1,
                'auditor_2'              => $request->auditor_2,
                'audit_date'             => $request->audit_date,
                'scores'                 => '-'
            ]);

            // 3. วนลูปบันทึกคะแนนรายข้อลงตารางย่อย (Detail) ตามข้อมูลที่ส่งมาจากหน้าฟอร์ม
            foreach ($items as $itemData) {
                if (isset($itemData['activitysoff_master_dts_id'])) {
                    $detailMaster = $masterHd->details->where('activitysoff_master_dts_id', $itemData['activitysoff_master_dts_id'])->first();
                    
                    if ($detailMaster) {
                        $scoreVal = isset($itemData['score']) ? intval($itemData['score']) : 0;

                        ActivitysOffDt::create([
                            'activitys_off_hds_id' => $header->activitys_off_hds_id,
                            'item_code'            => $detailMaster->code,
                            'max_score'            => $detailMaster->score,
                            'score'                => $scoreVal,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'บันทึกผลการตรวจพื้นที่เรียบร้อยแล้ว');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage())->withInput();
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
        $hd = ActivitysOffHd::find($id);
        return view('iso.activity-5soff-edit', compact('hd'));
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
        // 1. Validate ข้อมูล
        $validated = $request->validate([
            'department_name' => 'required|string|max:255',
            'floor'           => 'required|string|max:255',
            'items'           => 'required|array',
            'items.*.score'   => 'nullable|integer|min:0|max:5', // รองรับคะแนน 0, ว่าง หรือ 1-5
            'auditor_1'       => 'required|string|max:255',
            'audit_date'      => 'required|date',
        ]);

        $items = $request->input('items', []);
        $totalScore = 0;
        $totalMaxScore = 0;

        // ค้นหา Header เดิม
        $header = ActivitysOffHd::findOrFail($id);

        // ค้นหา Master Details เพื่อดึงคะแนนเต็ม (max_score) และ item_code ตามหน่วยงานและชั้น
        $masterDetails = \App\Models\ActivitysoffMasterDt::whereHas('header', function($q) use ($request) {
            $q->where('department_name', $request->department_name)
            ->where('floor', $request->floor);
        })->get()->keyBy('activitysoff_master_dts_id');

        DB::beginTransaction();
        try {
            // วนลูปคำนวณคะแนนรวมและคะแนนเต็มจริง
            foreach ($items as $itemData) {
                $scoreVal = isset($itemData['score']) ? intval($itemData['score']) : 0;
                if ($scoreVal >= 1 && $scoreVal <= 5) {
                    $totalScore += $scoreVal;
                }

                if (isset($itemData['activitysoff_master_dts_id'])) {
                    $masterDetail = $masterDetails->get($itemData['activitysoff_master_dts_id']);
                    if ($masterDetail) {
                        $totalMaxScore += intval($masterDetail->score);
                    }
                }
            }

            // ป้องกันหารด้วย 0
            $percentageScore = $totalMaxScore > 0 ? round(($totalScore / $totalMaxScore) * 100, 2) : 0;

            // 2. อัปเดตข้อมูลตารางหลัก (Header)
            $header->update([
                'department_name'  => $request->department_name,
                'floor'            => $request->floor,
                'total_score'      => $totalScore,
                'percentage_score' => $percentageScore,
                'strength'         => $request->strength,
                'weakness'         => $request->weakness,
                'suggestion'       => $request->suggestion,
                'auditor_1'        => $request->auditor_1,
                'auditor_2'        => $request->auditor_2,
                'audit_date'       => $request->audit_date,
            ]);

            // 3. ลบรายการคะแนนข้อย่อยเดิมทิ้ง แล้วสร้างใหม่ตาม Master ปัจจุบัน
            $header->details()->delete();

            foreach ($items as $itemData) {
                if (isset($itemData['activitysoff_master_dts_id'])) {
                    $masterDetail = $masterDetails->get($itemData['activitysoff_master_dts_id']);

                    if ($masterDetail) {
                        $scoreVal = isset($itemData['score']) ? intval($itemData['score']) : 0;

                        ActivitysOffDt::create([
                            'activitys_off_hds_id' => $header->activitys_off_hds_id,
                            'item_code'            => $masterDetail->code,
                            'max_score'            => $masterDetail->score,
                            'score'                => $scoreVal,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('activity-5soffs.index')->with('success', 'อัปเดตผลการตรวจพื้นที่เรียบร้อยแล้ว');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage())->withInput();
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

    public function cancelActivity5off(Request $request)
    {
        $hd = ActivitysOffHd::where('activitys_off_hds_id',$request->refid)->update([
            'activitys_off_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }

    public function printQuarter(Request $request)
    {
        $year = (int) $request->input('year', date('Y'));
        $selectedQuarter = (int) $request->input('quarter', 4);

        // ดึงข้อมูลจาก SQL Server ตามปีที่เลือก
        // *หมายเหตุ: หากมีค่า flag ที่หมายถึงยกเลิก (เช่น 'C' หรือ '0') ให้เพิ่ม ->where('activitys_off_hds_flag', '!=', 'C') ตามจริง
        $records = DB::table('activitys_off_hds')
            ->whereRaw('YEAR(audit_date) = ?', [$year])
            ->where('activitys_off_hds_flag',true)
            ->orderBy('department_name', 'asc')
            ->orderBy('floor', 'asc')
            ->orderBy('audit_date', 'asc')
            ->get();

        $groupedData = [];

        foreach ($records as $row) {
            if (empty($row->audit_date)) {
                continue;
            }

            $timestamp = strtotime($row->audit_date);
            $month = (int) date('n', $timestamp);
            $quarter = (int) ceil($month / 3); // 1-3 => Q1, 4-6 => Q2, 7-9 => Q3, 10-12 => Q4

            // รวมกลุ่มตามหน่วยงานและชั้น
            $dept = trim((string) ($row->department_name ?? ''));
            $floor = trim((string) ($row->floor ?? ''));
            $key = $dept . '|' . $floor;

            if (!isset($groupedData[$key])) {
                $areaLabel = [];
                if ($floor !== '') {
                    $areaLabel[] = "ชั้น {$floor}";
                }
                if ($dept !== '') {
                    $areaLabel[] = $dept;
                }

                $groupedData[$key] = [
                    'area'            => implode(' ', $areaLabel) ?: '-',
                    'department_name' => $dept !== '' ? $dept : '-',
                    'auditors'        => [],
                    'auditees'        => [],
                    'q1'              => null,
                    'q2'              => null,
                    'q3'              => null,
                    'q4'              => null,
                    'audit_date'      => null,
                    'strength'        => '',
                    'weakness'        => '',
                    'suggestion'      => '',
                    'avr'             => 0,
                    'rank'            => '-',
                ];
            }

            // เก็บคะแนน % ของแต่ละไตรมาส
            if (!is_null($row->percentage_score) && is_numeric($row->percentage_score)) {
                $score = (float) $row->percentage_score;
                $groupedData[$key]["q{$quarter}"] = rtrim(rtrim(number_format($score, 2, '.', ''), '0'), '.');
            }

            // อัปเดตข้อมูล Auditor, วันที่ และหมายเหตุ เมื่อตรงกับไตรมาสที่เลือก (หรือไตรมาสก่อนหน้าที่ตรวจล่าสุด)
            if ($quarter <= $selectedQuarter) {
                $thaiShortYear = substr((string) ((int) date('Y', $timestamp) + 543), -2);
                $groupedData[$key]['audit_date'] = date('d-m-', $timestamp) . $thaiShortYear;

                $auditors = [];
                if (!empty($row->auditor_1)) {
                    $auditors[] = trim((string) $row->auditor_1);
                }
                if (!empty($row->auditor_2)) {
                    $auditors[] = trim((string) $row->auditor_2);
                }
                $groupedData[$key]['auditors'] = $auditors;

                $groupedData[$key]['strength']   = (string) ($row->strength ?? '');
                $groupedData[$key]['weakness']   = (string) ($row->weakness ?? '');
                $groupedData[$key]['suggestion'] = (string) ($row->suggestion ?? '');
            }
        }

        // คำนวณค่าเฉลี่ย AVR จากไตรมาสที่มีคะแนน
        foreach ($groupedData as &$item) {
            $validScores = [];
            foreach (['q1', 'q2', 'q3', 'q4'] as $qKey) {
                if (!is_null($item[$qKey]) && $item[$qKey] !== '') {
                    $validScores[] = (float) $item[$qKey];
                }
            }
            $item['avr'] = count($validScores) > 0
                ? (int) round(array_sum($validScores) / count($validScores))
                : 0;
        }
        unset($item);

        // จัดอันดับ (Rank) จากคะแนน AVR มากไปน้อย
        $avrValues = array_column($groupedData, 'avr');
        rsort($avrValues);

        foreach ($groupedData as &$item) {
            $pos = array_search($item['avr'], $avrValues);
            $item['rank'] = ($pos !== false) ? ($pos + 1) : '-';
        }
        unset($item);

        return view('iso.activity-5soff-print', [
            'rows'            => array_values($groupedData),
            'year'            => $year,
            'thaiYear'        => $year + 543,
            'selectedQuarter' => $selectedQuarter,
        ]);
    }
}
