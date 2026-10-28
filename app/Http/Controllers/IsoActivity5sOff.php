<?php

namespace App\Http\Controllers;

use App\Models\ActivitysOffDt;
use App\Models\ActivitysOffHd;
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
        $hd = null;
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
        // 1. Validate ข้อมูล
        $validated = $request->validate([
            'department_name' => 'required|string|max:255',
            'floor'           => 'required|string|max:255',
            'score'           => 'required|array',
            'auditor_1'       => 'required|string|max:255',
            'audit_date'      => 'required|date',
        ]);

        $scores = $request->input('score');
        $totalScore = 0;
        
        // คำนวณคะแนนรวมจากข้อมูลที่ส่งมา
        foreach ($scores as $val) {
            $valInt = intval($val);
            if ($valInt >= 1 && $valInt <= 5) {
                $totalScore += $valInt;
            }
        }
        $percentageScore = round(($totalScore / 105) * 100, 2);

        DB::beginTransaction();
        try {
            // 2. บันทึกข้อมูลลงตารางหลัก (Header)
            $header = ActivitysOffHd::create([
                'activitys_off_hds_flag' => true,
                'department_name'        => $request->department_name,
                'floor'                  => $request->floor,
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

            // Map key ของ array (1 ถึง 21) ให้เป็นรหัสข้อ (1.1 ถึง 3.6)
            $itemCodesMap = [
                1 => '1.1',  2 => '1.2',  3 => '1.3',  4 => '1.4.1', 5 => '1.4.2', 
                6 => '1.4.3', 7 => '1.4.4', 8 => '1.4.5', 9 => '1.4.6',
                10 => '2.1', 11 => '2.2', 12 => '2.3', 13 => '2.4', 14 => '2.5', 15 => '2.6',
                16 => '3.1', 17 => '3.2', 18 => '3.3', 19 => '3.4', 20 => '3.5', 21 => '3.6'
            ];

            // 3. วนลูปบันทึกคะแนนรายข้อลงตารางย่อย (Detail)
            foreach ($scores as $key => $scoreVal) {
                if (isset($itemCodesMap[$key]) && !is_null($scoreVal) && $scoreVal !== '') {
                    ActivitysOffDt::create([
                        'activitys_off_hds_id' => $header->activitys_off_hds_id,
                        'item_code'            => $itemCodesMap[$key],
                        'max_score'            => 5,
                        'score'                => intval($scoreVal),
                    ]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'บันทึกผลการตรวจพื้นที่เรียบร้อยแล้ว');

        } catch (\Exception $e) {
            DB::rollBack();
            // หากยังมีจุดที่ผิดพลาดตรงฐานข้อมูล จะเด้งข้อความนี้ขึ้นมาให้เห็นทันที
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
            'score'           => 'required|array',
            'auditor_1'       => 'required|string|max:255',
            'audit_date'      => 'required|date',
        ]);

        $scores = $request->input('score');
        $totalScore = 0;
        
        // คำนวณคะแนนรวมใหม่
        foreach ($scores as $val) {
            $valInt = intval($val);
            if ($valInt >= 1 && $valInt <= 5) {
                $totalScore += $valInt;
            }
        }
        $percentageScore = round(($totalScore / 105) * 100, 2);

        DB::beginTransaction();
        try {
            // 2. ค้นหา Header เดิม
            $header = ActivitysOffHd::findOrFail($id);

            // 3. อัปเดตข้อมูลตารางหลัก
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

            // 4. ลบรายการคะแนนข้อย่อยเดิมทิ้ง แล้วสร้างใหม่ (หรือจะใช้วิธี updateOrCreate ก็ได้)
            $header->details()->delete();

            $itemCodesMap = [
                1 => '1.1',  2 => '1.2',  3 => '1.3',  4 => '1.4.1', 5 => '1.4.2', 
                6 => '1.4.3', 7 => '1.4.4', 8 => '1.4.5', 9 => '1.4.6',
                10 => '2.1', 11 => '2.2', 12 => '2.3', 13 => '2.4', 14 => '2.5', 15 => '2.6',
                16 => '3.1', 17 => '3.2', 18 => '3.3', 19 => '3.4', 20 => '3.5', 21 => '3.6'
            ];

            foreach ($scores as $key => $scoreVal) {
                if (isset($itemCodesMap[$key]) && !is_null($scoreVal) && $scoreVal !== '') {
                    ActivitysOffDt::create([
                        'activitys_off_hds_id' => $header->activitys_off_hds_id,
                        'item_code'            => $itemCodesMap[$key],
                        'max_score'            => 5,
                        'score'                => intval($scoreVal),
                    ]);
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
    public function cancelActivity5spdt(Request $request)
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
