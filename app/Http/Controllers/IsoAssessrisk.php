<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Assessrisk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IsoAssessrisk extends Controller
{
    public function index()
    {
        $risks = Assessrisk::latest()->get();
        return view('iso.assessrisk-list', compact('risks'));
    }

    public function create()
    {
        $risks[] = [
            'process' => '',
            'proposed_by' => '',
            'date' => '',
            'issues' => ['', '', '', ''],
            'measures' => ['', '', ''],
            'before_assess' => [
                ['I'=>'','L'=>'','Level'=>'','Result'=>'','By'=>'','Date'=>''],
                ['I'=>'','L'=>'','Level'=>'','Result'=>'','By'=>'','Date'=>''],
                ['I'=>'','L'=>'','Level'=>'','Result'=>'','By'=>'','Date'=>'']
            ],
            'summary' => ['', '', ''],
            'dates' => [['text'=>'','date'=>''],['text'=>'','date'=>''],['text'=>'','date'=>'']],
            'follow_up' => ['','',''],
            'acknowledged' => [['name'=>'','date'=>''],['name'=>'','date'=>''],['name'=>'','date'=>'']],
            'approved' => [['name'=>'','date'=>''],['name'=>'','date'=>''],['name'=>'','date'=>'']],
            'after_assess' => [
                ['I'=>'','L'=>'','Level'=>'','Result'=>'','By'=>'','Date'=>''],
                ['I'=>'','L'=>'','Level'=>'','Result'=>'','By'=>'','Date'=>''],
                ['I'=>'','L'=>'','Level'=>'','Result'=>'','By'=>'','Date'=>'']
            ]
        ];

        $emp = DB::table('ms_employee')->where('ms_employee_flag', true)->get();
        return view('iso.assessrisk-create', compact('risks','emp'));
    }

    public function store(Request $request)
    {
        $risks = $request->input('risks');

        foreach ($risks as $riskData) {
            Assessrisk::create([
                'process_ref'    => $riskData['process'] ?? '',
                'proposed_by'    => $riskData['proposed_by'] ?? '',
                'proposed_date'  => $riskData['date'] ?? null,

                'risk_issue'     => $riskData['issues'][0] ?? '',
                'risk_cause'     => $riskData['issues'][1] ?? '',
                'risk_impact'    => $riskData['issues'][2] ?? '',
                'risk_accept_reason' => $riskData['issues'][3] ?? '',

                'pre_i_1'        => $riskData['before_assess'][0]['I'] ?? '',
                'pre_l_1'        => $riskData['before_assess'][0]['L'] ?? '',
                'pre_level_1'    => $riskData['before_assess'][0]['Level'] ?? '',
                'pre_result_1'   => $riskData['before_assess'][0]['Result'] ?? '',
                'pre_by_1'       => $riskData['before_assess'][0]['By'] ?? '',
                'pre_date_1'     => $riskData['before_assess'][0]['Date'] ?: null,

                'pre_i_2'        => $riskData['before_assess'][1]['I'] ?? '',
                'pre_l_2'        => $riskData['before_assess'][1]['L'] ?? '',
                'pre_level_2'    => $riskData['before_assess'][1]['Level'] ?? '',
                'pre_result_2'   => $riskData['before_assess'][1]['Result'] ?? '',
                'pre_by_2'       => $riskData['before_assess'][1]['By'] ?? '',
                'pre_date_2'     => $riskData['before_assess'][1]['Date'] ?: null,

                'pre_i_3'        => $riskData['before_assess'][2]['I'] ?? '',
                'pre_l_3'        => $riskData['before_assess'][2]['L'] ?? '',
                'pre_level_3'    => $riskData['before_assess'][2]['Level'] ?? '',
                'pre_result_3'   => $riskData['before_assess'][2]['Result'] ?? '',
                'pre_by_3'       => $riskData['before_assess'][2]['By'] ?? '',
                'pre_date_3'     => $riskData['before_assess'][2]['Date'] ?: null,

                'mitigation_1'   => $riskData['measures'][0] ?? '',
                'mitigation_2'   => $riskData['measures'][1] ?? '',
                'mitigation_3'   => $riskData['measures'][2] ?? '',

                'summary_1'      => $riskData['summary'][0] ?? '',
                'summary_2'      => $riskData['summary'][1] ?? '',
                'summary_3'      => $riskData['summary'][2] ?? '',

                'followup_1'     => $riskData['follow_up'][0] ?? '',
                'followup_2'     => $riskData['follow_up'][1] ?? '',
                'followup_3'     => $riskData['follow_up'][2] ?? '',

                'approved_by_1'  => $riskData['approved'][0]['name'] ?? '',
                'approved_date_1'=> $riskData['approved'][0]['date'] ?: null,
                'approved_by_2'  => $riskData['approved'][1]['name'] ?? '',
                'approved_date_2'=> $riskData['approved'][1]['date'] ?: null,
                'approved_by_3'  => $riskData['approved'][2]['name'] ?? '',
                'approved_date_3'=> $riskData['approved'][2]['date'] ?: null,

                'post_i_1'       => $riskData['after_assess'][0]['I'] ?? '',
                'post_l_1'       => $riskData['after_assess'][0]['L'] ?? '',
                'post_level_1'   => $riskData['after_assess'][0]['Level'] ?? '',
                'post_result_1'  => $riskData['after_assess'][0]['Result'] ?? '',
                'post_by_1'      => $riskData['after_assess'][0]['By'] ?? '',
                'post_date_1'    => $riskData['after_assess'][0]['Date'] ?: null,

                'post_i_2'       => $riskData['after_assess'][1]['I'] ?? '',
                'post_l_2'       => $riskData['after_assess'][1]['L'] ?? '',
                'post_level_2'   => $riskData['after_assess'][1]['Level'] ?? '',
                'post_result_2'  => $riskData['after_assess'][1]['Result'] ?? '',
                'post_by_2'      => $riskData['after_assess'][1]['By'] ?? '',
                'post_date_2'    => $riskData['after_assess'][1]['Date'] ?: null,

                'post_i_3'       => $riskData['after_assess'][2]['I'] ?? '',
                'post_l_3'       => $riskData['after_assess'][2]['L'] ?? '',
                'post_level_3'   => $riskData['after_assess'][2]['Level'] ?? '',
                'post_result_3'  => $riskData['after_assess'][2]['Result'] ?? '',
                'post_by_3'      => $riskData['after_assess'][2]['By'] ?? '',
                'post_date_3'    => $riskData['after_assess'][2]['Date'] ?: null,

                'ack_name_1'     => $riskData['acknowledged'][0]['name'] ?? '',
                'ack_date_1'     => $riskData['acknowledged'][0]['date'] ?? null,
                'ack_name_2'     => $riskData['acknowledged'][1]['name'] ?? '',
                'ack_date_2'     => $riskData['acknowledged'][1]['date'] ?? null,
                'ack_name_3'     => $riskData['acknowledged'][2]['name'] ?? '',
                'ack_date_3'     => $riskData['acknowledged'][2]['date'] ?? null,

                'ack_final_name_1' => $riskData['dates'][0]['text'] ?? '',
                'ack_final_date_1' => $riskData['dates'][0]['date'] ?? null,
                'ack_final_name_2' => $riskData['dates'][1]['text'] ?? '',
                'ack_final_date_2' => $riskData['dates'][1]['date'] ?? null,
                'ack_final_name_3' => $riskData['dates'][2]['text'] ?? '',
                'ack_final_date_3' => $riskData['dates'][2]['date'] ?? null,
            ]);
        }

        return redirect()->route('assessrisk.index')->with('success', 'บันทึกข้อมูลความเสี่ยงเรียบร้อยแล้ว');
    }
public function edit($id)
{
    $risk = Assessrisk::findOrFail($id);

    $risks[] = [
        'process'      => $risk->process_ref ?? '',
        'proposed_by'  => $risk->proposed_by ?? '',
        'date'         => !empty($risk->proposed_date) ? $risk->proposed_date : '',

        'issues'       => [
            $risk->risk_issue ?? '',
            $risk->risk_cause ?? '',
            $risk->risk_impact ?? '',
            $risk->risk_accept_reason ?? ''
        ],

        'measures'     => [
            $risk->mitigation_1 ?? '',
            $risk->mitigation_2 ?? '',
            $risk->mitigation_3 ?? ''
        ],

        'before_assess'=> [
            ['I'=>$risk->pre_i_1 ?? '', 'L'=>$risk->pre_l_1 ?? '', 'Level'=>$risk->pre_level_1 ?? '', 'Result'=>$risk->pre_result_1 ?? '', 'By'=>$risk->pre_by_1 ?? '', 'Date'=>$risk->pre_date_1 ?? ''],
            ['I'=>$risk->pre_i_2 ?? '', 'L'=>$risk->pre_l_2 ?? '', 'Level'=>$risk->pre_level_2 ?? '', 'Result'=>$risk->pre_result_2 ?? '', 'By'=>$risk->pre_by_2 ?? '', 'Date'=>$risk->pre_date_2 ?? ''],
            ['I'=>$risk->pre_i_3 ?? '', 'L'=>$risk->pre_l_3 ?? '', 'Level'=>$risk->pre_level_3 ?? '', 'Result'=>$risk->pre_result_3 ?? '', 'By'=>$risk->pre_by_3 ?? '', 'Date'=>$risk->pre_date_3 ?? ''],
        ],

        'summary'      => [
            $risk->summary_1 ?? '',
            $risk->summary_2 ?? '',
            $risk->summary_3 ?? ''
        ],

        'follow_up'    => [
            $risk->followup_1 ?? '',
            $risk->followup_2 ?? '',
            $risk->followup_3 ?? ''
        ],

        'acknowledged' => [
            ['name'=>$risk->ack_name_1 ?? '', 'date'=>$risk->ack_date_1 ?? ''],
            ['name'=>$risk->ack_name_2 ?? '', 'date'=>$risk->ack_date_2 ?? ''],
            ['name'=>$risk->ack_name_3 ?? '', 'date'=>$risk->ack_date_3 ?? ''],
        ],

        'approved'     => [
            ['name'=>$risk->approved_by_1 ?? '', 'date'=>$risk->approved_date_1 ?? ''],
            ['name'=>$risk->approved_by_2 ?? '', 'date'=>$risk->approved_date_2 ?? ''],
            ['name'=>$risk->approved_by_3 ?? '', 'date'=>$risk->approved_date_3 ?? ''],
        ],

        'dates' => [
            ['text'=>$risk->ack_final_name_1 ?? '', 'date'=>$risk->ack_final_date_1 ?? ''],
            ['text'=>$risk->ack_final_name_2 ?? '', 'date'=>$risk->ack_final_date_2 ?? ''],
            ['text'=>$risk->ack_final_name_3 ?? '', 'date'=>$risk->ack_final_date_3 ?? ''],
        ],

        'after_assess' => [
            ['I'=>$risk->post_i_1 ?? '', 'L'=>$risk->post_l_1 ?? '', 'Level'=>$risk->post_level_1 ?? '', 'Result'=>$risk->post_result_1 ?? '', 'By'=>$risk->post_by_1 ?? '', 'Date'=>$risk->post_date_1 ?? ''],
            ['I'=>$risk->post_i_2 ?? '', 'L'=>$risk->post_l_2 ?? '', 'Level'=>$risk->post_level_2 ?? '', 'Result'=>$risk->post_result_2 ?? '', 'By'=>$risk->post_by_2 ?? '', 'Date'=>$risk->post_date_2 ?? ''],
            ['I'=>$risk->post_i_3 ?? '', 'L'=>$risk->post_l_3 ?? '', 'Level'=>$risk->post_level_3 ?? '', 'Result'=>$risk->post_result_3 ?? '', 'By'=>$risk->post_by_3 ?? '', 'Date'=>$risk->post_date_3 ?? ''],
        ]
    ];

    $emp = DB::table('ms_employee')->where('ms_employee_flag', true)->get();

    return view('iso.assessrisk-edit', compact('risks', 'risk', 'emp'));
}

public function update(Request $request, $id)
{
    $risk = Assessrisk::findOrFail($id);
    $riskData = $request->input('risks', [])[0] ?? [];

    $risk->process_ref   = $riskData['process'] ?? $risk->process_ref;
    $risk->proposed_by   = $riskData['proposed_by'] ?? $risk->proposed_by;
    $risk->proposed_date = !empty($riskData['date']) ? $riskData['date'] : $risk->proposed_date;

    $risk->risk_issue        = $riskData['issues'][0] ?? $risk->risk_issue;
    $risk->risk_cause        = $riskData['issues'][1] ?? $risk->risk_cause;
    $risk->risk_impact       = $riskData['issues'][2] ?? $risk->risk_impact;
    $risk->risk_accept_reason= $riskData['issues'][3] ?? $risk->risk_accept_reason;

    $risk->mitigation_1 = $riskData['measures'][0] ?? $risk->mitigation_1;
    $risk->mitigation_2 = $riskData['measures'][1] ?? $risk->mitigation_2;
    $risk->mitigation_3 = $riskData['measures'][2] ?? $risk->mitigation_3;

    $risk->summary_1 = $riskData['summary'][0] ?? $risk->summary_1;
    $risk->summary_2 = $riskData['summary'][1] ?? $risk->summary_2;
    $risk->summary_3 = $riskData['summary'][2] ?? $risk->summary_3;

    $risk->followup_1 = $riskData['follow_up'][0] ?? $risk->followup_1;
    $risk->followup_2 = $riskData['follow_up'][1] ?? $risk->followup_2;
    $risk->followup_3 = $riskData['follow_up'][2] ?? $risk->followup_3;
    if(!empty($riskData['before_assess'])) {
        foreach($riskData['before_assess'] as $i => $before) {
            $risk->{'pre_i_'.($i+1)}      = $before['I'] !== null && $before['I'] !== '' ? $before['I'] : $risk->{'pre_i_'.($i+1)};
            $risk->{'pre_l_'.($i+1)}      = $before['L'] !== null && $before['L'] !== '' ? $before['L'] : $risk->{'pre_l_'.($i+1)};
            $risk->{'pre_level_'.($i+1)}  = $before['Level'] !== null && $before['Level'] !== '' ? $before['Level'] : $risk->{'pre_level_'.($i+1)};
            $risk->{'pre_result_'.($i+1)} = $before['Result'] !== null && $before['Result'] !== '' ? $before['Result'] : $risk->{'pre_result_'.($i+1)};
            $risk->{'pre_by_'.($i+1)}     = $before['By'] !== null && $before['By'] !== '' ? $before['By'] : $risk->{'pre_by_'.($i+1)};
            $risk->{'pre_date_'.($i+1)}   = !empty($before['Date']) ? $before['Date'] : $risk->{'pre_date_'.($i+1)};
        }
    }

    if(!empty($riskData['after_assess'])) {
        foreach($riskData['after_assess'] as $i => $after) {
            $risk->{'post_i_'.($i+1)}      = $after['I'] !== null && $after['I'] !== '' ? $after['I'] : $risk->{'post_i_'.($i+1)};
            $risk->{'post_l_'.($i+1)}      = $after['L'] !== null && $after['L'] !== '' ? $after['L'] : $risk->{'post_l_'.($i+1)};
            $risk->{'post_level_'.($i+1)}  = $after['Level'] !== null && $after['Level'] !== '' ? $after['Level'] : $risk->{'post_level_'.($i+1)};
            $risk->{'post_result_'.($i+1)} = $after['Result'] !== null && $after['Result'] !== '' ? $after['Result'] : $risk->{'post_result_'.($i+1)};
            $risk->{'post_by_'.($i+1)}     = $after['By'] !== null && $after['By'] !== '' ? $after['By'] : $risk->{'post_by_'.($i+1)};
            $risk->{'post_date_'.($i+1)}   = !empty($after['Date']) ? $after['Date'] : $risk->{'post_date_'.($i+1)};
        }
    }

    if(!empty($riskData['acknowledged'])) {
        foreach($riskData['acknowledged'] as $i => $ack) {
            $risk->{'ack_name_'.($i+1)} = $ack['name'] !== null && $ack['name'] !== '' ? $ack['name'] : $risk->{'ack_name_'.($i+1)};
            $risk->{'ack_date_'.($i+1)} = !empty($ack['date']) ? $ack['date'] : $risk->{'ack_date_'.($i+1)};
        }
    }

    if(!empty($riskData['approved'])) {
        foreach($riskData['approved'] as $i => $app) {
            $risk->{'approved_by_'.($i+1)}   = $app['name'] !== null && $app['name'] !== '' ? $app['name'] : $risk->{'approved_by_'.($i+1)};
            $risk->{'approved_date_'.($i+1)} = !empty($app['date']) ? $app['date'] : $risk->{'approved_date_'.($i+1)};
        }
    }

    if(!empty($riskData['dates'])) {
        foreach($riskData['dates'] as $i => $dt) {
            $risk->{'ack_final_name_'.($i+1)} = $dt['text'] !== null && $dt['text'] !== '' ? $dt['text'] : $risk->{'ack_final_name_'.($i+1)};
            $risk->{'ack_final_date_'.($i+1)} = !empty($dt['date']) ? $dt['date'] : $risk->{'ack_final_date_'.($i+1)};
        }
    }

    $risk->save();

    return redirect()->route('assessrisk.index')->with('success','อัปเดตข้อมูลเรียบร้อยแล้ว');
}
   public function show($id)
{
    $risk = Assessrisk::find($id);

    if (!$risk) {
        return redirect()->route('assessrisk.index')->with('error', 'ไม่พบข้อมูลที่เลือก');
    }

    $risks[] = [
        'id'           => $risk->id,
        'process'      => $risk->process_ref ?? '',
        'proposed_by'  => $risk->proposed_by ?? '',
        'date'         => $risk->proposed_date ?? '',

        'issues'       => [
            $risk->risk_issue ?? '',
            $risk->risk_cause ?? '',
            $risk->risk_impact ?? '',
            $risk->risk_accept_reason ?? ''
        ],

        'measures'     => [
            $risk->mitigation_1 ?? '',
            $risk->mitigation_2 ?? '',
            $risk->mitigation_3 ?? ''
        ],

        'before_assess'=> [
            ['I'=>$risk->pre_i_1 ?? '', 'L'=>$risk->pre_l_1 ?? '', 'Level'=>$risk->pre_level_1 ?? '', 'Result'=>$risk->pre_result_1 ?? '', 'By'=>$risk->pre_by_1 ?? '', 'Date'=>$risk->pre_date_1 ?? ''],
            ['I'=>$risk->pre_i_2 ?? '', 'L'=>$risk->pre_l_2 ?? '', 'Level'=>$risk->pre_level_2 ?? '', 'Result'=>$risk->pre_result_2 ?? '', 'By'=>$risk->pre_by_2 ?? '', 'Date'=>$risk->pre_date_2 ?? ''],
            ['I'=>$risk->pre_i_3 ?? '', 'L'=>$risk->pre_l_3 ?? '', 'Level'=>$risk->pre_level_3 ?? '', 'Result'=>$risk->pre_result_3 ?? '', 'By'=>$risk->pre_by_3 ?? '', 'Date'=>$risk->pre_date_3 ?? ''],
        ],

        'summary'      => [
            $risk->summary_1 ?? '',
            $risk->summary_2 ?? '',
            $risk->summary_3 ?? ''
        ],

        'follow_up'    => [
            $risk->followup_1 ?? '',
            $risk->followup_2 ?? '',
            $risk->followup_3 ?? ''
        ],

        'acknowledged' => [
            ['name'=>$risk->ack_name_1 ?? '', 'date'=>$risk->ack_date_1 ?? ''],
            ['name'=>$risk->ack_name_2 ?? '', 'date'=>$risk->ack_date_2 ?? ''],
            ['name'=>$risk->ack_name_3 ?? '', 'date'=>$risk->ack_date_3 ?? ''],
        ],

        'approved'     => [
            ['name'=>$risk->approved_by_1 ?? '', 'date'=>$risk->approved_date_1 ?? ''],
            ['name'=>$risk->approved_by_2 ?? '', 'date'=>$risk->approved_date_2 ?? ''],
            ['name'=>$risk->approved_by_3 ?? '', 'date'=>$risk->approved_date_3 ?? ''],
        ],

        'dates' => [
            ['text'=>$risk->ack_final_name_1 ?? '', 'date'=>$risk->ack_final_date_1 ?? ''],
            ['text'=>$risk->ack_final_name_2 ?? '', 'date'=>$risk->ack_final_date_2 ?? ''],
            ['text'=>$risk->ack_final_name_3 ?? '', 'date'=>$risk->ack_final_date_3 ?? ''],
        ],

        'after_assess' => [
            ['I'=>$risk->post_i_1 ?? '', 'L'=>$risk->post_l_1 ?? '', 'Level'=>$risk->post_level_1 ?? '', 'Result'=>$risk->post_result_1 ?? '', 'By'=>$risk->post_by_1 ?? '', 'Date'=>$risk->post_date_1 ?? ''],
            ['I'=>$risk->post_i_2 ?? '', 'L'=>$risk->post_l_2 ?? '', 'Level'=>$risk->post_level_2 ?? '', 'Result'=>$risk->post_result_2 ?? '', 'By'=>$risk->post_by_2 ?? '', 'Date'=>$risk->post_date_2 ?? ''],
            ['I'=>$risk->post_i_3 ?? '', 'L'=>$risk->post_l_3 ?? '', 'Level'=>$risk->post_level_3 ?? '', 'Result'=>$risk->post_result_3 ?? '', 'By'=>$risk->post_by_3 ?? '', 'Date'=>$risk->post_date_3 ?? ''],
        ]
    ];

    $emp = DB::table('ms_employee')->where('ms_employee_flag', true)->get();

    return view('iso.assessrisk-show', compact('risks', 'risk', 'emp'));
}



    public function cancelAssessrisk(Request $request)
    {
    
        DB::table('assessrisks')
            ->where('id', $request->refid)
            ->delete();

        return response()->json(['success' => true, 'message' => 'ลบข้อมูลเรียบร้อยแล้ว']);
    }
}
