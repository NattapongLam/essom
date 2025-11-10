<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IsoPlan extends Controller
{
    public function index()
    {
        $records = Plan::all();
        return view('iso.iso-plan-list', compact('records'));
    }

    public function create()
    {
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();
        return view('iso.iso-plan-create', compact('emp'));
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
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();
        return view('iso.iso-plan-edit', compact('plan', 'activities','emp'));
    }

   public function update(Request $request, $id)
{
    $plan = Plan::findOrFail($id);
    if (isset($request->prepared_by)) {
        $plan->prepared_by = $request->prepared_by;
        $plan->prepared_date = $request->prepared_date;
    }

    $existingActivities = json_decode($plan->activities, true) ?? [];
    $newActivities = $this->processActivities($request);
    if (!empty($newActivities)) {
        $activities = array_merge($existingActivities, $newActivities);
        $plan->activities = json_encode($activities, JSON_UNESCAPED_UNICODE);
    }

    if (isset($request->prepared_progress_review)) {
        $plan->prepared_progress_review = $request->prepared_progress_review;
        $plan->prepared_progress_date = $request->prepared_progress_date;
    }

    if (isset($request->reviewed_by)) {
        $plan->reviewed_by = $request->reviewed_by;
        $plan->reviewed_date = $request->reviewed_date;
    }

    if (isset($request->reported_by)) {
        $plan->reported_by = $request->reported_by;
        $plan->reported_date = $request->reported_date;
    }

    if (isset($request->approved_by)) {
        $plan->approved_by = $request->approved_by;
        $plan->approved_date = $request->approved_date;
    }

    if (isset($request->acknowledged_by)) {
        $plan->acknowledged_by = $request->acknowledged_by;
        $plan->acknowledged_date = $request->acknowledged_date;
    }

    $plan->save();

    if ($plan->acknowledged_by) {
        $currentStep = 5;
    } elseif ($plan->approved_by) {
        $currentStep = 4;
    } elseif ($plan->reported_by) {
        $currentStep = 3;
    } elseif ($plan->reviewed_by) {
        $currentStep = 2;
    } elseif ($plan->prepared_progress_review) {
        $currentStep = 1;
    } else {
        $currentStep = 0;
    }

    return redirect()->route('iso-plan.index')
                     ->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว')
                     ->with('currentStep', $currentStep);
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

    if ($plan->acknowledged_by) {
        $currentStep = 5;
    } elseif ($plan->approved_by) {
        $currentStep = 4;
    } elseif ($plan->reported_by) {
        $currentStep = 3;
    } elseif ($plan->reviewed_by) {
        $currentStep = 2;
    } elseif ($plan->prepared_progress_review) {
        $currentStep = 1;
    } else {
        $currentStep = 0;
    }

    return view('iso.iso-plan-show', compact('plan', 'activities', 'currentStep'));
}
}
