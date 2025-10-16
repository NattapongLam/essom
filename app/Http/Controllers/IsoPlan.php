<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class IsoPlan extends Controller
{
   
    public function index()
    {
        $plans = Plan::all();
        return view('iso.iso-plan-list', compact('plans')); 
    }

    public function create()
    {
        return view('iso.iso-plan-create'); 
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'project_name' => 'required|string|max:255',
        'responsible_section' => 'required|string|max:255',
        'DA' => 'array',
        'RP' => 'array',
        'date_start' => 'array',
        'date_end' => 'array',
        'RS' => 'array',
        'Remark' => 'array',
    ]);

    $activities = [];
    foreach ($request->DA as $index => $desc) {
        if (!empty($desc) || !empty($request->RP[$index])) {
            $activities[] = [
                'description' => $desc,
                'responsible_person' => $request->RP[$index] ?? null,
                'date_start' => $request->date_start[$index] ?? null,
                'date_end' => $request->date_end[$index] ?? null,
                'status' => $request->RS[$index] ?? null,
                'remark' => $request->Remark[$index] ?? null,
            ];
        }
    }

    Plan::create([
        'project_name' => $request->project_name,
        'responsible_section' => $request->responsible_section,
        'activities' => json_encode($activities, JSON_UNESCAPED_UNICODE),
    ]);
    return redirect()->route('iso-plan.index')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว!');
}
public function edit($id)
{
    $plan = Plan::findOrFail($id);

    $activity = json_decode($plan->activities, true)[0] ?? [];

    return view('iso.iso-plan-edit', compact('plan', 'activity'));
}

public function update(Request $request, $id)
{
    $plan = Plan::findOrFail($id);

    $validated = $request->validate([
        'project_name' => 'required|string',
        'responsible_section' => 'required|string',
        'description_of_activities' => 'nullable|string',
        'responsible_person' => 'nullable|string',
        'date_start' => 'nullable|date',
        'date_end' => 'nullable|date',
        'status' => 'nullable|string',
        'remarks' => 'nullable|string',
    ]);

    $activities = [[
        'description' => $request->description_of_activities,
        'responsible_person' => $request->responsible_person,
        'date_start' => $request->date_start,
        'date_end' => $request->date_end,
        'status' => $request->status,
        'remark' => $request->remarks,
    ]];

    $plan->update([
        'project_name' => $request->project_name,
        'responsible_section' => $request->responsible_section,
        'activities' => json_encode($activities, JSON_UNESCAPED_UNICODE),
    ]);

    return redirect()
        ->route('iso-plan.index')
        ->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว!');
}
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return redirect()->route('iso-plan.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว!');
    }
}
