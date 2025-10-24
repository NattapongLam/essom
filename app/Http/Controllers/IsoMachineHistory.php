<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MachineHistory;

class IsoMachineHistory extends Controller
{
    public function index()
    {
        $machines = MachineHistory::orderBy('id', 'desc')->get();
        return view('iso.machine-history-list', compact('machines'));
    }

    public function create()
    {
        return view('iso.machine-history-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'machine_name' => 'required|string|max:255',
            'machine_number' => 'required|string|max:255',
            'date_start' => 'required|date',
            'department' => 'required|string|max:255',
            'repair_date.*' => 'nullable|date',
            'repair_description.*' => 'nullable|string|max:255',
            'repair_person.*' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        $repairs = [];
        if ($request->repair_date && count($request->repair_date) > 0) {
            for ($i = 0; $i < count($request->repair_date); $i++) {
                if (($request->repair_date[$i] ?? false) ||
                    ($request->repair_description[$i] ?? false) ||
                    ($request->repair_person[$i] ?? false)) {
                    $repairs[] = [
                        'date' => $request->repair_date[$i] ?? null,
                        'description' => $request->repair_description[$i] ?? null,
                        'person' => $request->repair_person[$i] ?? null,
                    ];
                }
            }
        }

        MachineHistory::create([
            'machine_name' => $validated['machine_name'],
            'machine_number' => $validated['machine_number'],
            'date_start' => $validated['date_start'],
            'department' => $validated['department'],
            'repair_date' => $repairs ? json_encode(array_column($repairs, 'date')) : null,
            'repair_description' => $repairs ? json_encode(array_column($repairs, 'description')) : null,
            'repair_person' => $repairs ? json_encode(array_column($repairs, 'person')) : null,
            'remarks' => $validated['remarks'] ?? null,
        ]);

        return redirect()->route('machine-history.index')
                         ->with('success', 'Machine added successfully!');
    }

    public function edit(MachineHistory $machine_history)
    {
        $machine_history->repair_date = json_decode($machine_history->repair_date ?? '[]', true);
        $machine_history->repair_description = json_decode($machine_history->repair_description ?? '[]', true);
        $machine_history->repair_person = json_decode($machine_history->repair_person ?? '[]', true);

        return view('iso.machine-history-edit', compact('machine_history'));
    }

    public function update(Request $request, MachineHistory $machine_history)
    {
        $validated = $request->validate([
            'machine_name' => 'required|string|max:255',
            'machine_number' => 'required|string|max:255',
            'date_start' => 'required|date',
            'department' => 'required|string|max:255',
            'repair_date.*' => 'nullable|date',
            'repair_description.*' => 'nullable|string|max:255',
            'repair_person.*' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        $repairs = [];
        if ($request->repair_date && count($request->repair_date) > 0) {
            for ($i = 0; $i < count($request->repair_date); $i++) {
                if (($request->repair_date[$i] ?? false) ||
                    ($request->repair_description[$i] ?? false) ||
                    ($request->repair_person[$i] ?? false)) {
                    $repairs[] = [
                        'date' => $request->repair_date[$i] ?? null,
                        'description' => $request->repair_description[$i] ?? null,
                        'person' => $request->repair_person[$i] ?? null,
                    ];
                }
            }
        }

        $machine_history->update([
            'machine_name' => $validated['machine_name'],
            'machine_number' => $validated['machine_number'],
            'date_start' => $validated['date_start'],
            'department' => $validated['department'],
            'repair_date' => $repairs ? json_encode(array_column($repairs, 'date')) : null,
            'repair_description' => $repairs ? json_encode(array_column($repairs, 'description')) : null,
            'repair_person' => $repairs ? json_encode(array_column($repairs, 'person')) : null,
            'remarks' => $validated['remarks'] ?? null,
        ]);

        return redirect()->route('machine-history.index')
                         ->with('success', 'Machine updated successfully!');
    }

    public function destroy(MachineHistory $machine_history)
    {
        $machine_history->delete();
        return redirect()->route('machine-history.index')
                         ->with('success', 'Machine deleted successfully!');
    }
}
