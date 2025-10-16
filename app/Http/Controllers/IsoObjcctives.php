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
        $data = $request->all();
        $activities = [];

        if (!empty($data['description'])) {
            foreach ($data['description'] as $i => $desc) {
                if (empty($desc) && empty($data['resp_person'][$i])) continue;

                $activities[] = [
                    'no' => $i + 1,
                    'description' => $desc ?? null,
                    'resp_person' => $data['resp_person'][$i] ?? null,
                    'previous' => $data['previous'][$i] ?? null,
                    'plan' => $data['plan'][$i] ?? null,
                    'results' => $data['results'][$i] ?? null,
                    'remarks' => $data['remarks'][$i] ?? null,
                    'section' => $data['section'][0] ?? null,
                    'period' => $data['period'][0] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if (!empty($activities)) {
            Objective::insert($activities);
            return redirect()->route('objcctives.index')->with('success', 'Saved successfully!');
        }

        return redirect()->back()->with('error', 'No data to save.');
    }

   public function edit(Objective $objcctive)
{
    return view('iso.objcctives-edit', compact('objcctive'));
}

public function update(Request $request, Objective $objcctive)
{
    $validated = $request->validate([
        'no' => 'required|integer',
        'section' => 'required|string',
        'period' => 'required|string',
        'description' => 'required|string',
        'resp_person' => 'nullable|string',
        'previous' => 'nullable|string',
        'plan' => 'nullable|string',
        'results' => 'nullable|string',
        'remarks' => 'nullable|string',
    ]);

    $objcctive->update($validated);

    return redirect()->route('objcctives.index')->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว!');
}

    public function show(Objective $objective)
    {
        return view('iso.objcctives-show', compact('objective'));
    }

    public function destroy(Objective $objcctive)
{
    $objcctive->delete();
    return redirect()->route('objcctives.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว!');
}
}
