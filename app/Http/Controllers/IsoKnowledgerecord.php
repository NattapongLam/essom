<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KnowledgeRecord;

class IsoKnowledgerecord extends Controller
{
    public function index()
    {
        $records = KnowledgeRecord::latest()->get();
        return view('iso.knowledge-record-list', compact('records'));
    }

    public function create()
    {
        return view('iso.knowledge-record-create');
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
        ]);

        if ($request->hasFile('attached_file')) {
            $file = $request->file('attached_file')->store('knowledge_files', 'public');
            $data['attached_file'] = $file;
        }

        if (isset($data['approval'])) {
            $data['approval'] = json_encode($data['approval']);
        }

        KnowledgeRecord::create($data);

        return redirect()->route('knowledge-record.index')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function edit(KnowledgeRecord $knowledgeRecord)
    {
        return view('iso.knowledge-record-create', ['record' => $knowledgeRecord]);
    }

    public function update(Request $request, KnowledgeRecord $knowledgeRecord)
{

    $data = $request->only(['NameCF', 'approval_date']); 


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
