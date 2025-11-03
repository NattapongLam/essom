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
        $activities = [];
        if ($request->has('DA')) {
            $DA = $request->DA;
            $RP = $request->RP;
            $date_start = $request->date_start;
            $date_end = $request->date_end;
            $RS = $request->RS;
            $Remark = $request->Remark;

            for ($i = 0; $i < count($DA); $i++) {
                $activities[] = [
                    'description' => $DA[$i],
                    'responsible_person' => $RP[$i],
                    'date_start' => $date_start[$i],
                    'date_end' => $date_end[$i],
                    'status' => $RS[$i],
                    'remark' => $Remark[$i],
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
            'reported_by' => $request->reported_by,
            'reported_date' => $request->reported_date,
            'approved_by' => $request->approved_by,
            'approved_date' => $request->approved_date,
            'acknowledged_by' => $request->acknowledged_by,
            'acknowledged_date' => $request->acknowledged_date,
        ]);

        return redirect()->route('iso-plan.index')
            ->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
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
        $activities = $this->processActivities($request);

        $updateData = [];

        if ($request->filled('prepared_by')) {
            $updateData['prepared_by'] = $request->prepared_by;
            $updateData['prepared_date'] = $request->prepared_date;
        }

        if ($request->filled('prepared_progress_review')) {
            $updateData['prepared_progress_review'] = $request->prepared_progress_review;
            $updateData['prepared_progress_date'] = $request->prepared_progress_date;
        }

        if ($request->filled('reviewed_by')) {
            $updateData['reviewed_by'] = $request->reviewed_by;
            $updateData['reviewed_date'] = $request->reviewed_date;
        }

        // Reported
        if ($request->filled('reported_by')) {
            $updateData['reported_by'] = $request->reported_by;
            $updateData['reported_date'] = $request->reported_date;
        }

        if ($request->filled('approved_by')) {
            $updateData['approved_by'] = $request->approved_by;
            $updateData['approved_date'] = $request->approved_date;
        }
        if ($request->filled('acknowledged_by')) {
            $updateData['acknowledged_by'] = $request->acknowledged_by;
            $updateData['acknowledged_date'] = $request->acknowledged_date;
        }

        if (!empty($activities)) {
            $updateData['activities'] = json_encode($activities, JSON_UNESCAPED_UNICODE);
        }

        $plan->update($updateData);

        return redirect()->route('iso-plan.index')->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว!');
    }

    private function processActivities($request)
    {
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
                    'description' => $DA[$i] ?? null,
                    'responsible_person' => $RP[$i] ?? null,
                    'date_start' => $date_start[$i] ?? null,
                    'date_end' => $date_end[$i] ?? null,
                    'status' => $RS[$i] ?? null,
                    'remark' => $Remark[$i] ?? null,
                ];
            }
        }

        return $activities;
    }

    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();
        return redirect()->route('iso-plan.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว!');
    }

    public function show($id)
    {
        $plan = Plan::findOrFail($id);
        $activities = json_decode($plan->activities, true) ?? [];
        return view('iso.iso-plan-show', compact('plan', 'activities'));
    }
}
