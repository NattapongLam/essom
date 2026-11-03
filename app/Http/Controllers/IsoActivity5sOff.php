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
}
