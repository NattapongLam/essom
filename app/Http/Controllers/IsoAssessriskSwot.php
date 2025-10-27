<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssessriskSwot;

class IsoAssessriskSwot extends Controller
{
    public function index()
    {
        $swots = AssessriskSwot::all();
        return view('iso.assessrisk-swot-list', ['records' => $swots]);
    }

    public function create()
    {
        return view('iso.assessrisk-swot-create');
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
                        'risk'              => $risk,
                        'accept'            => $request->{$section . '_accept'}[$key] ?? '',
                        'non_accept'        => $request->{$section . '_non_accept'}[$key] ?? '',
                        'measure'           => $request->{$section . '_measure'}[$key] ?? '',
                        'activity'          => $request->{$section . '_activity'}[$key] ?? '',
                        'responsible'       => $request->{$section . '_responsible'}[$key] ?? '',
                        'review_non_accept' => $request->{$section . '_review_non_accept'}[$key] ?? '',
                        'review_accept'     => $request->{$section . '_review_accept'}[$key] ?? '',
                    ];
                }
            }

            $data[$section] = $sectionArray;
        }

     
        AssessriskSwot::create([
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
    $record = AssessriskSwot::findOrFail($id);

    $strengths = is_string($record->strength) 
                    ? json_decode($record->strength, true) 
                    : $record->strength ?? [];

    $weaknesses = is_string($record->weakness) 
                    ? json_decode($record->weakness, true) 
                    : $record->weakness ?? [];

    $opportunities = is_string($record->opportunity) 
                    ? json_decode($record->opportunity, true) 
                    : $record->opportunity ?? [];

    $threats = is_string($record->threat) 
                    ? json_decode($record->threat, true) 
                    : $record->threat ?? [];

    $report_by   = $record->report_by;
    $report_date = $record->report_date;
    $ack_by      = $record->ack_by;
    $ack_date    = $record->ack_date;

    return view('iso.assessrisk-swot-show', compact(
        'record', 'strengths', 'weaknesses', 'opportunities', 'threats',
        'report_by', 'report_date', 'ack_by', 'ack_date'
    ));
}
    public function edit($id)
    {
        $record = AssessriskSwot::findOrFail($id);
        return view('iso.assessrisk-swot-edit', compact('record'));
    }
    public function update(Request $request, $id)
    {
        $record = AssessriskSwot::findOrFail($id);
        $sections = ['strength', 'weakness', 'opportunity', 'threat'];
        $data = [];

        foreach ($sections as $section) {
            $riskField = $section . '_risk';
            $sectionArray = [];

            if ($request->has($riskField)) {
                foreach ($request->$riskField as $key => $risk) {
                    if (empty($risk)) continue;

                    $sectionArray[] = [
                        'risk'              => $risk,
                        'accept'            => $request->{$section . '_accept'}[$key] ?? '',
                        'non_accept'        => $request->{$section . '_non_accept'}[$key] ?? '',
                        'measure'           => $request->{$section . '_measure'}[$key] ?? '',
                        'activity'          => $request->{$section . '_activity'}[$key] ?? '',
                        'responsible'       => $request->{$section . '_responsible'}[$key] ?? '',
                        'review_non_accept' => $request->{$section . '_review_non_accept'}[$key] ?? '',
                        'review_accept'     => $request->{$section . '_review_accept'}[$key] ?? '',
                    ];
                }
            }

            $data[$section] = $sectionArray;
        }
        $record->update([
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

        return redirect()->route('assessrisk-swot.index')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
    }
    public function destroy($id)
    {
        $record = AssessriskSwot::findOrFail($id);
        $record->delete();
        return redirect()->route('assessrisk-swot.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');
    }
}
