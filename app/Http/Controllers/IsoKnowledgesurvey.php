<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KnowledgeSurvey;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IsoKnowledgesurvey extends Controller
{

    public function index()
    {
        $surveys = KnowledgeSurvey::latest()->get();
        return view('iso.knowledge-survey-list', compact('surveys'));
    }

    public function create()
    {
        $emp = DB::table('ms_employee')
        ->leftjoin('ms_department','ms_employee.ms_department_id','=','ms_department.ms_department_id')
        ->where('ms_employee_code',Auth::user()->code)
        ->first();
        return view('iso.knowledge-survey-create', compact('emp'));
    }

    public function store(Request $request)
    {
        $data = [
            'surveyor_name' => $request->surveyor_name,
            'department' => $request->department,
            'position' => $request->position,
            'survey_date' => $request->survey_date,
            'survey_number' => $request->survey_number,

            'q1_department_field' => $request->q1_department_field,
            'q1_status' => json_encode($request->q1_status ?? []),
            'q1_doc_no' => $request->q1_doc_no,
            'q1_storage_location' => $request->q1_storage_location,
            'q1_transfer_date' => $request->q1_transfer_date,
            'q1_comment' => $request->q1_comment,
            'q1_progress_date' => $request->q1_progress_date,

            'q2_department_field' => $request->q2_department_field,
            'q2_status' => json_encode($request->q2_status ?? []),
            'q2_doc_no' => $request->q2_doc_no,
            'q2_storage_location' => $request->q2_storage_location,
            'q2_transfer_method' => $request->q2_transfer_method,
            'q2_transfer_date' => $request->q2_transfer_date,
            'q2_comment' => $request->q2_comment,
            'q2_comment_date' => $request->q2_comment_date,
            'q2_progress_detail' => $request->q2_progress_detail,
            'q2_progress_date' => $request->q2_progress_date,

            'q3_need' => json_encode($request->q3_need ?? []),
            'q3_topic' => $request->q3_topic,
            'q3_reason' => json_encode($request->q3_reason ?? []),

            'approved_by' => $request->approved_by,
            'approved_date' => $request->approved_date,
        ];

        KnowledgeSurvey::create($data);

        return redirect()->route('knowledge-survey.index')
                         ->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function edit($id)
    {
        $survey = KnowledgeSurvey::findOrFail($id);

        $survey->q1_status = json_decode($survey->q1_status ?? '[]', true);
        $survey->q2_status = json_decode($survey->q2_status ?? '[]', true);
        $survey->q3_need = json_decode($survey->q3_need ?? '[]', true);
        $survey->q3_reason = json_decode($survey->q3_reason ?? '[]', true);

        return view('iso.knowledge-survey-edit', compact('survey'));
    }

    public function update(Request $request, $id)
    {
        if($request->checkdoc == "Edit"){
            $survey = KnowledgeSurvey::findOrFail($id);

        $survey->update([
            'surveyor_name' => $request->surveyor_name,
            'department' => $request->department,
            'position' => $request->position,
            'survey_date' => $request->survey_date,
            'survey_number' => $request->survey_number,

            'q1_department_field' => $request->q1_department_field,
            'q1_status' => json_encode($request->q1_status ?? []),
            'q1_doc_no' => $request->q1_doc_no,
            'q1_storage_location' => $request->q1_storage_location,
            'q1_transfer_date' => $request->q1_transfer_date,
            'q1_comment' => $request->q1_comment,
            'q1_progress_date' => $request->q1_progress_date,

            'q2_department_field' => $request->q2_department_field,
            'q2_status' => json_encode($request->q2_status ?? []),
            'q2_doc_no' => $request->q2_doc_no,
            'q2_storage_location' => $request->q2_storage_location,
            'q2_transfer_method' => $request->q2_transfer_method,
            'q2_transfer_date' => $request->q2_transfer_date,
            'q2_comment' => $request->q2_comment,
            'q2_comment_date' => $request->q2_comment_date,
            'q2_progress_detail' => $request->q2_progress_detail,
            'q2_progress_date' => $request->q2_progress_date,

            'q3_need' => json_encode($request->q3_need ?? []),
            'q3_topic' => $request->q3_topic,
            'q3_reason' => json_encode($request->q3_reason ?? []),

            'approved_by' => $request->approved_by,
            'approved_date' => $request->approved_date,
        ]);

        return redirect()->route('knowledge-survey.index')
                         ->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
        }
        else if($request->checkdoc == "Update"){
            $survey = KnowledgeSurvey::findOrFail($id);
            $survey->update([
                'approved_by' => $request->approved_by,
                'approved_date' => $request->approved_date,
            ]);
            return redirect()->route('knowledge-survey.index')->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
        }
        
    }

    public function show($id)
    {
        $survey = KnowledgeSurvey::findOrFail($id);

        $survey->q1_status = json_decode($survey->q1_status ?? '[]', true);
        $survey->q2_status = json_decode($survey->q2_status ?? '[]', true);
        $survey->q3_need = json_decode($survey->q3_need ?? '[]', true);
        $survey->q3_reason = json_decode($survey->q3_reason ?? '[]', true);

        return view('iso.knowledge-survey-update', compact('survey'));
    }

    public function destroy($id)
    {
        $survey = KnowledgeSurvey::findOrFail($id);
        $survey->delete();

        return redirect()->route('knowledge-survey.index')
                         ->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');
    }
}
