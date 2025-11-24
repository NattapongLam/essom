<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AssessriskSwot;
use Illuminate\Support\Facades\DB;

class IsoAssessriskSwot extends Controller
{
    public function index()
    {
        $records = DB::table('assessrisk_swot')->get();
        return view('iso.assessrisk-swot-list', compact('records'));
    }

    public function create()
    {
        $emp = DB::table('ms_employee')->where('ms_employee_flag', true)->get();
        return view('iso.assessrisk-swot-create', compact('emp'));
    }

    public function store(Request $request)
    {
        $sections = ['strength', 'weakness', 'opportunity', 'threat'];
        $data = [];

        foreach ($sections as $section) {
            $riskField = $section . '_risk';
            $sectionArray = [];

            if ($request->has($riskField)) {
                foreach ($request->$riskField as $key => $risk) {
                    if (empty($risk)) continue;
                    $sectionArray[] = [
                        'risk' => $risk,
                        'accept' => $request->{$section . '_accept'}[$key] ?? '',
                        'non_accept' => $request->{$section . '_non_accept'}[$key] ?? '',
                        'measure' => $request->{$section . '_measure'}[$key] ?? '',
                        'activity' => $request->{$section . '_activity'}[$key] ?? '',
                        'responsible' => $request->{$section . '_responsible'}[$key] ?? '',
                        'review_non_accept' => $request->{$section . '_review_non_accept'}[$key] ?? '',
                        'review_accept' => $request->{$section . '_review_accept'}[$key] ?? '',
                    ];
                }
            }

            $data[$section] = $sectionArray;
        }

        DB::table('assessrisk_swot')->insert([
            'meeting_date'   => $request->meeting_date,
            'strength'       => json_encode($data['strength']),
            'weakness'       => json_encode($data['weakness']),
            'opportunity'    => json_encode($data['opportunity']),
            'threat'         => json_encode($data['threat']),
            'review_summary' => $request->review_summary ?? null,
            'report_by'      => $request->report_by,
            'report_date'    => $request->report_date,
            'ack_by'         => $request->ack_by,
            'ack_date'       => $request->ack_date,
        ]);

        return redirect()->route('assessrisk-swot.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function show($id)
    {
        $record =  DB::table('assessrisk_swot')->where('id',$id)->first();

        $strengths     = json_decode($record->strength ?? '[]', true);
        $weaknesses    = json_decode($record->weakness ?? '[]', true);
        $opportunities = json_decode($record->opportunity ?? '[]', true);
        $threats       = json_decode($record->threat ?? '[]', true);

        $ackDate = null;
        if (!empty($record->ack_date)) {
            try {
                $ackDate = Carbon::parse($record->ack_date)->format('Y-m-d');
            } catch (\Exception $e) {
                $ackDate = null;
            }
        }

        return view('iso.assessrisk-swot-show', compact(
            'record', 'strengths', 'weaknesses', 'opportunities', 'threats', 'ackDate'
        ));
    }


    public function edit($id)
    {
        $record = DB::table('assessrisk_swot')->where('id',$id)->first();

        foreach (['report_date', 'ack_date', 'meeting_date'] as $field) {
            if (!empty($record->$field)) {
                try {
                    $record->$field = Carbon::parse($record->$field)->format('Y-m-d');
                } catch (\Exception $e) {
                    $record->$field = null;
                }
            }
        }

        $strengths     = json_decode($record->strength ?? '[]', true);
        $weaknesses    = json_decode($record->weakness ?? '[]', true);
        $opportunities = json_decode($record->opportunity ?? '[]', true);
        $threats       = json_decode($record->threat ?? '[]', true);

        return view('iso.assessrisk-swot-edit', compact('record', 'strengths', 'weaknesses', 'opportunities', 'threats'));
    }

public function update(Request $request, $id)
{
    $record = DB::table('assessrisk_swot')->where('id',$id)->first();

    // --- ถ้ามาจากหน้า edit: อัปเดต SWOT + report ---
    if ($request->has('strength_risk') || $request->has('weakness_risk') || 
        $request->has('opportunity_risk') || $request->has('threat_risk')) 
    {
        $sections = ['strength', 'weakness', 'opportunity', 'threat'];
        foreach ($sections as $section) {
            $riskField = $section . '_risk';
            $sectionArray = [];

            if ($request->has($riskField)) {
                foreach ($request->$riskField as $key => $risk) {
                    if (empty($risk)) continue;
                    $sectionArray[] = [
                        'risk' => $risk,
                        'accept' => $request->{$section . '_accept'}[$key] ?? '',
                        'non_accept' => $request->{$section . '_non_accept'}[$key] ?? '',
                        'measure' => $request->{$section . '_measure'}[$key] ?? '',
                        'activity' => $request->{$section . '_activity'}[$key] ?? '',
                        'responsible' => $request->{$section . '_responsible'}[$key] ?? '',
                        'review_non_accept' => $request->{$section . '_review_non_accept'}[$key] ?? '',
                        'review_accept' => $request->{$section . '_review_accept'}[$key] ?? '',
                    ];
                }
            }

            $record->$section = json_encode($sectionArray);
        }

        // อัปเดต report
        if ($request->filled('report_by')) {
            $record->report_by = $request->report_by;
        }
        if ($request->filled('report_date')) {
            try {
                $record->report_date = Carbon::parse($request->report_date)->format('Y-m-d');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'วันที่รายงานไม่ถูกต้อง: ' . $request->report_date);
            }
        }
    }

    // --- อัปเดต ack (ทั้งหน้า edit และ show) ---
    if ($request->filled('ack_by')) {
        $record->ack_by = $request->ack_by;
    }
    if ($request->filled('ack_date')) {
        try {
            $record->ack_date = Carbon::parse($request->ack_date)->format('Y-m-d');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'วันที่รับทราบไม่ถูกต้อง: ' . $request->ack_date);
        }
    }

    $record->save();

    return redirect()->route('assessrisk-swot.index')
                     ->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
}

    public function destroy($id)
    {
        $record = DB::table('assessrisk_swot')->where('id',$id)->first();
        $record->delete();

        return redirect()->route('assessrisk-swot.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');
    }
}
