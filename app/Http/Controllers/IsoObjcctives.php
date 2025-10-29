<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objective;

class IsoObjcctives extends Controller
{
    public function index()
    {
        $objectives = Objective::orderBy('id', 'desc')->get();
        return view('iso.objcctives-list', compact('objectives'));
    }

    public function create()
    {
        return view('iso.objcctives-create');
    }

    public function store(Request $request)
    {
        try {
            $activities = [];
            if (!empty($request->description)) {
                foreach ($request->description as $i => $desc) {
                    if (empty($desc) && empty($request->resp_person[$i])) continue;

                    $activities[] = [
                        'no' => $request->no[$i] ?? $i + 1,
                        'description' => $desc,
                        'resp_person' => $request->resp_person[$i] ?? '',
                        'previous' => $request->previous[$i] ?? '',
                        'plan' => $request->plan[$i] ?? '',
                        'results' => $request->results[$i] ?? '',
                        'remarks' => $request->remarks[$i] ?? '',
                    ];
                }
            }

            Objective::create([
                'section' => $request->section[0] ?? null,
                'period' => $request->period[0] ?? null,
                'activity_list' => $activities, // 
                'prepared_by' => $request->prepared_by,
                'prepared_date' => $request->prepared_date,
                'reported_by' => $request->reported_by,
                'reported_date' => $request->reported_date,
                'reviewed_by' => $request->reviewed_by,
                'reviewed_date' => $request->reviewed_date,
                'acknowledged_by' => $request->acknowledged_by,
                'acknowledged_date' => $request->acknowledged_date,
                'approved_by' => $request->approved_by,
                'approved_date' => $request->approved_date,
            ]);

            return redirect()->route('objcctives.index')->with('success', 'บันทึกข้อมูลสำเร็จ!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }

    public function edit(Objective $objcctive)
    {
        
        return view('iso.objcctives-edit', compact('objcctive'));
    }

    public function update(Request $request, Objective $objcctive)
    {
        try {
            $activities = [];
            if (!empty($request->description)) {
                foreach ($request->description as $i => $desc) {
                    if (empty($desc) && empty($request->resp_person[$i])) continue;

                    $activities[] = [
                        'no' => $request->no[$i] ?? $i + 1,
                        'description' => $desc,
                        'resp_person' => $request->resp_person[$i] ?? '',
                        'previous' => $request->previous[$i] ?? '',
                        'plan' => $request->plan[$i] ?? '',
                        'results' => $request->results[$i] ?? '',
                        'remarks' => $request->remarks[$i] ?? '',
                    ];
                }
            }

            $objcctive->update([
                'section' => $request->section[0] ?? null,
                'period' => $request->period[0] ?? null,
                'activity_list' => $activities,
                'prepared_by' => $request->prepared_by,
                'prepared_date' => $request->prepared_date,
                'reported_by' => $request->reported_by,
                'reported_date' => $request->reported_date,
                'reviewed_by' => $request->reviewed_by,
                'reviewed_date' => $request->reviewed_date,
                'acknowledged_by' => $request->acknowledged_by,
                'acknowledged_date' => $request->acknowledged_date,
                'approved_by' => $request->approved_by,
                'approved_date' => $request->approved_date,
            ]);

            return redirect()->route('objcctives.index')->with('success', 'อัปเดตข้อมูลสำเร็จ!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }

    public function destroy(Objective $objcctive)
    {
        try {
            $objcctive->delete();
            return redirect()->route('objcctives.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }
}
