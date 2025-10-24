<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class IsoPlan extends Controller
{

    public function index()
    {
        $records = Plan::all();
        return view('iso.iso-plan-list', compact('records'));
    }

    public function create()
    {
        return view('iso.iso-plan-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'responsible_section' => 'required|string|max:255',
            'DA' => 'array',
            'RP' => 'array',
            'date_start' => 'array',
            'date_end' => 'array',
            'RS' => 'array',
            'Remark' => 'array',
            'prepared_by' => 'required|string|max:255',
            'prepared_date' => 'required|date',
            'prepared_progress_review' => 'required|string|max:255',
            'prepared_progress_date' => 'required|date',
            'reported_progress_review' => 'required|string|max:255',
            'reported_date' => 'required|date',
            'reported_by' => 'required|string|max:255',
            'reported_progress_date' => 'required|date',
            'approved_by' => 'required|string|max:255',
            'approved_date' => 'required|date',
            'acknowledged_by' => 'required|string|max:255',
            'acknowledged_date' => 'required|date',
        ]);

        $activities = [];
        $DA = $request->input('DA', []);
        $RP = $request->input('RP', []);
        $date_start = $request->input('date_start', []);
        $date_end = $request->input('date_end', []);
        $RS = $request->input('RS', []);
        $Remark = $request->input('Remark', []);

        for ($i = 0; $i < count($DA); $i++) {
            if (!empty($DA[$i]) || !empty($RP[$i])) {
                $activities[] = [
                    'description' => $DA[$i],
                    'responsible_person' => $RP[$i] ?? null,
                    'date_start' => $date_start[$i] ?? null,
                    'date_end' => $date_end[$i] ?? null,
                    'status' => $RS[$i] ?? null,
                    'remark' => $Remark[$i] ?? null,
                ];
            }
        }

        Plan::create([
            'project_name' => $request->project_name,
            'responsible_section' => $request->responsible_section,
            'activities' => json_encode($activities, JSON_UNESCAPED_UNICODE),
            'prepared_by' => $request->prepared_by,
            'prepared_date' => $request->prepared_date,
            'prepared_progress_review' => $request->prepared_progress_review,
            'prepared_progress_date' => $request->prepared_progress_date,
            'reported_progress_review' => $request->reported_progress_review,
            'reported_date' => $request->reported_date,
            'reported_by' => $request->reported_by,
            'reported_progress_date' => $request->reported_progress_date,
            'approved_by' => $request->approved_by,
            'approved_date' => $request->approved_date,
            'acknowledged_by' => $request->acknowledged_by,
            'acknowledged_date' => $request->acknowledged_date,
        ]);

        return redirect()->route('iso-plan.index')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว!');
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        $activities = json_decode($plan->activities, true) ?? [];

        return view('iso.iso-plan-edit', compact('plan', 'activities'));
    }

    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);

        $request->validate([
            'project_name' => 'required|string|max:255',
            'responsible_section' => 'required|string|max:255',
            'DA' => 'array',
            'RP' => 'array',
            'date_start' => 'array',
            'date_end' => 'array',
            'RS' => 'array',
            'Remark' => 'array',
            'prepared_by' => 'required|string|max:255',
            'prepared_date' => 'required|date',
            'prepared_progress_review' => 'required|string|max:255',
            'prepared_progress_date' => 'required|date',
            'reported_progress_review' => 'required|string|max:255',
            'reported_date' => 'required|date',
            'reported_by' => 'required|string|max:255',
            'reported_progress_date' => 'required|date',
            'approved_by' => 'required|string|max:255',
            'approved_date' => 'required|date',
            'acknowledged_by' => 'required|string|max:255',
            'acknowledged_date' => 'required|date',
        ]);

        $activities = [];
        $DA = $request->input('DA', []);
        $RP = $request->input('RP', []);
        $date_start = $request->input('date_start', []);
        $date_end = $request->input('date_end', []);
        $RS = $request->input('RS', []);
        $Remark = $request->input('Remark', []);

        for ($i = 0; $i < count($DA); $i++) {
            if (!empty($DA[$i]) || !empty($RP[$i])) {
                $activities[] = [
                    'description' => $DA[$i],
                    'responsible_person' => $RP[$i] ?? null,
                    'date_start' => $date_start[$i] ?? null,
                    'date_end' => $date_end[$i] ?? null,
                    'status' => $RS[$i] ?? null,
                    'remark' => $Remark[$i] ?? null,
                ];
            }
        }

        $plan->update([
            'project_name' => $request->project_name,
            'responsible_section' => $request->responsible_section,
            'activities' => json_encode($activities, JSON_UNESCAPED_UNICODE),
            'prepared_by' => $request->prepared_by,
            'prepared_date' => $request->prepared_date,
            'prepared_progress_review' => $request->prepared_progress_review,
            'prepared_progress_date' => $request->prepared_progress_date,
            'reported_progress_review' => $request->reported_progress_review,
            'reported_date' => $request->reported_date,
            'reported_by' => $request->reported_by,
            'reported_progress_date' => $request->reported_progress_date,
            'approved_by' => $request->approved_by,
            'approved_date' => $request->approved_date,
            'acknowledged_by' => $request->acknowledged_by,
            'acknowledged_date' => $request->acknowledged_date,
        ]);

        return redirect()->route('iso-plan.index')->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว!');
    }
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return redirect()->route('iso-plan.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว!');
    }
}
