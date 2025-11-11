<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KnowledgeRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IsoKnowledgerecord extends Controller
{
    public function index()
    {
        $records = KnowledgeRecord::latest()->get();
        return view('iso.knowledge-record-list', compact('records'));
    }

    public function create()
    {
        $emp = DB::table('ms_employee')
        ->leftjoin('ms_department','ms_employee.ms_department_id','=','ms_department.ms_department_id')
        ->where('ms_employee_code',Auth::user()->code)
        ->first();
        $list = DB::table('ms_employee')->where('ms_employee_flag', true)->get();
        return view('iso.knowledge-record-create', compact('emp','list'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'request_date' => 'required|date',
            'documentKM_no' => 'required|string|max:255',
            'document_no' => 'nullable|string|max:255',
            'OZN' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'details' => 'nullable|string',
            'attached_file' => 'nullable|file',
            'approval' => 'nullable|array',
            'transfer_date' => 'nullable|date',
            'NameCF' => 'nullable|string|max:255',
            'approval_date' => 'nullable|date',
            'approval_status' => 'nullable|string|max:255',
        ]);
        if ($request->hasFile('attached_file')) {
            $file  = $request->file('attached_file')->storeAs('img/knowledge_files', "IMG_" . Carbon::now()->format('Ymdhis') . "_" . Str::random(5) . "." . $request->file('attached_file')->extension());
            $data['attached_file'] = $file;
        }
        // if ($request->hasFile('attached_file')) {
        //     $file = $request->file('attached_file')->store('knowledge_files', 'public');
        //     $data['attached_file'] = $file;
        // }

        if (isset($data['approval'])) {
            $data['approval'] = json_encode($data['approval']);
        }

        KnowledgeRecord::create($data);

        return redirect()->route('knowledge-record.index')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function edit(KnowledgeRecord $knowledgeRecord)
    {      
        $lists = DB::table('ms_employee')->where('ms_employee_flag', true)->get();
        return view('iso.knowledge-record-create', ['record' => $knowledgeRecord,'list' => $lists]);
    }

    public function update(Request $request, KnowledgeRecord $knowledgeRecord)
{

    $data = $request->only(['NameCF', 'approval_date','approval_status','approval','transfer_date']); 


    if ($request->hasFile('attached_file')) {
        $file = $request->file('attached_file')->store('knowledge_files', 'public');
        $data['attached_file'] = $file;
    }

    if ($request->has('approval')) {
        $data['approval'] = json_encode($request->approval);
    }

    $knowledgeRecord->update($data);

    return redirect()->route('knowledge-record.index')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
}


    public function destroy(KnowledgeRecord $knowledgeRecord)
    {
        $knowledgeRecord->delete();
        return redirect()->route('knowledge-record.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');
    }


    public function show(KnowledgeRecord $knowledgeRecord)
    {
        
        return view('iso.knowledge-record-show', ['record' => $knowledgeRecord]);
    }
}
