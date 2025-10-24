<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeTransfer;
use Illuminate\Http\Request;

class IsoKnowledgeTransfer extends Controller
{

    public function index()
    {
        $records = KnowledgeTransfer::all();
        return view('iso.knowledge-transfer-list', compact('records'));
    }


    public function create()
    {
        return view('iso.knowledge-transfer-create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $checkboxFields = [
            'status_sent','status_pending','status_planning',
            'eval_understanding_good','eval_understanding_partial','eval_understanding_none',
            'eval_result_pass','eval_result_fail','eval_not_yet','eval_not_done',
            'review_current','review_outdated','review_replace',
            'review_freq_monthly','review_freq_6months','review_freq_yearly','review_freq_none'
        ];

        foreach ($checkboxFields as $field) {
            $data[$field] = $request->has($field) ? 1 : 0;
        }

        KnowledgeTransfer::create($data);

        return redirect()->route('knowledge-transfer.index')
                         ->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }


    public function edit(KnowledgeTransfer $knowledgeTransfer)
    {
        return view('iso.knowledge-transfer-edit', compact('knowledgeTransfer'));
    }

    public function update(Request $request, KnowledgeTransfer $knowledgeTransfer)
    {
        $data = $request->all();

        $checkboxFields = [
            'status_sent','status_pending','status_planning',
            'eval_understanding_good','eval_understanding_partial','eval_understanding_none',
            'eval_result_pass','eval_result_fail','eval_not_yet','eval_not_done',
            'review_current','review_outdated','review_replace',
            'review_freq_monthly','review_freq_6months','review_freq_yearly','review_freq_none'
        ];

        foreach ($checkboxFields as $field) {
            $data[$field] = $request->has($field) ? 1 : 0;
        }

        $knowledgeTransfer->update($data);

        return redirect()->route('knowledge-transfer.index')
                         ->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
    }

    public function destroy(KnowledgeTransfer $knowledgeTransfer)
    {
        $knowledgeTransfer->delete();
        return redirect()->route('knowledge-transfer.index')
                         ->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');
    }
}
