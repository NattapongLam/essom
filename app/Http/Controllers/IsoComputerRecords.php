<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComputerRecords;

class IsoComputerRecords extends Controller
{
    public function index()
    {
        $records = ComputerRecords::latest()->get();
        return view('iso.computer-records-list', compact('records'));
    }

    public function create()
    {
        return view('iso.computer-records-create');
    }

    public function store(Request $request)
    {
        $maintenance = [];
        for ($i = 0; $i < 19; $i++) {
            for ($m = 0; $m < 12; $m++) {
                $maintenance[$i][$m] = $request->input("month_{$i}_{$m}", 0);
            }
        }

        $check_by = [];
        $date_check = [];
        for ($m = 0; $m < 12; $m++) {
            $check_by[$m] = $request->input("check_by_{$m}");
            $date_check[$m] = $request->input("date_check_{$m}");
        }

        ComputerRecords::create([
            'asset_number' => $request->asset_number,
            'user_name' => $request->user_name,
            'period' => $request->period,
            'maintenance_status' => $maintenance,
            'check_by' => $check_by,
            'date_check' => $date_check,
            'remark' => $request->remark,
        ]);

        return redirect()->route('computer-records.index')
            ->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }
public function show($id)
{
    $record = ComputerRecords::findOrFail($id);
    $data = new \stdClass();
    $data->asset_number = $record->asset_number;
    $data->user_name = $record->user_name;
    $data->period = $record->period;
    $data->remark = $record->remark;

    for ($i = 0; $i < count($record->maintenance_status); $i++) {
        for ($m = 0; $m < 12; $m++) {
            $data->{"month_{$i}_{$m}"} = $record->maintenance_status[$i][$m] ?? 0;
        }
    }
    for ($m = 0; $m < 12; $m++) {
        $data->{"check_by_{$m}"} = $record->check_by[$m] ?? '';
        $data->{"date_check_{$m}"} = $record->date_check[$m] ?? '';
    }

    return view('iso.computer-records-show', compact('data'));
}


    public function edit($id)
    {
        $record = ComputerRecords::findOrFail($id);
        return view('iso.computer-records-edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $record = ComputerRecords::findOrFail($id);

        $maintenance = [];
        for ($i = 0; $i < 19; $i++) {
            for ($m = 0; $m < 12; $m++) {
                $maintenance[$i][$m] = $request->input("month_{$i}_{$m}", 0);
            }
        }

        $check_by = [];
        $date_check = [];
        for ($m = 0; $m < 12; $m++) {
            $check_by[$m] = $request->input("check_by_{$m}");
            $date_check[$m] = $request->input("date_check_{$m}");
        }

        $record->update([
            'asset_number' => $request->asset_number,
            'user_name' => $request->user_name,
            'period' => $request->period,
            'maintenance_status' => $maintenance,
            'check_by' => $check_by,
            'date_check' => $date_check,
            'remark' => $request->remark,
        ]);

        return redirect()->route('computer-records.index')
            ->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
    }

    public function destroy($id)
    {
        $record = ComputerRecords::findOrFail($id);
        $record->delete();

        return redirect()->route('computer-records.index')
            ->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');
    }
}
