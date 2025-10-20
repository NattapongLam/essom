<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IsoKnowledgerecord extends Controller
{
    public function index()
{
    
    $records = KnowledgeRecord::orderBy('request_date', 'desc')->get();
    return view('iso.knowledge-record-list', compact('records'));
}

    public function create()
    {
        return view('iso.knowledge-record-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'request_date' => 'required|date',
            'documentKM_no' => 'required|string|max:255',
            'OZN' => 'required|string|max:255',
            'document_no' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'details' => 'nullable|string',
            'attached_file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120',
            'approval' => 'nullable|array', 
            'transfer_date' => 'nullable|date',
            'NameCF' => 'nullable|string|max:255',
            'approval_date' => 'nullable|date',
        ]);

        if ($request->hasFile('attached_file')) {
            $validated['attached_file'] = $request->file('attached_file')->store('attachments', 'public');
        }

        $validated['approval'] = json_encode($request->approval ?? []);

        KnowledgeRecord::create($validated);

        return redirect()->route('knowledge-record.index')->with('success', 'บันทึกความรู้สำเร็จ');
    }

    public function edit(KnowledgeRecord $knowledgeRecord)
    {
        return view('iso.knowledge-record-create', ['record' => $knowledgeRecord]);
    }
    

    public function update(Request $request, KnowledgeRecord $knowledgeRecord)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'request_date' => 'required|date',
            'documentKM_no' => 'required|string|max:255',
            'OZN' => 'required|string|max:255',
            'document_no' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'details' => 'nullable|string',
            'attached_file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120',
            'approval' => 'nullable|array',
            'transfer_date' => 'nullable|date',
            'NameCF' => 'nullable|string|max:255',
            'approval_date' => 'nullable|date',
        ]);
    if ($request->hasFile('attached_file')) {
       
        if ($knowledgeRecord->attached_file) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($knowledgeRecord->attached_file);
        }
        $validated['attached_file'] = $request->file('attached_file')->store('attachments', 'public');
    } else {
        $validated['attached_file'] = $knowledgeRecord->attached_file;
    }
    $validated['approval'] = json_encode($request->approval ?? []);

    $knowledgeRecord->update($validated);

    return redirect()->route('knowledge-record.index')->with('success', 'อัปเดตข้อมูลสำเร็จ');
}

    public function destroy(KnowledgeRecord $knowledgeRecord)
    {
        if ($knowledgeRecord->attached_file) {
            Storage::disk('public')->delete($knowledgeRecord->attached_file);
        }
        $knowledgeRecord->delete();
        return redirect()->route('knowledge-record.index')->with('success', 'ลบข้อมูลสำเร็จ');
    }
}
