<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KnowledgeTransfer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IsoKnowledgeTransfer extends Controller
{

    public function index()
    {
        $records = KnowledgeTransfer::all();
        return view('iso.knowledge-transfer-list', compact('records'));
    }


    public function create()
    {
        $emp = DB::table('ms_employee')
        ->leftjoin('ms_department','ms_employee.ms_department_id','=','ms_department.ms_department_id')
        ->where('ms_employee_code',Auth::user()->code)
        ->first();
        $list = DB::table('ms_employee')->where('ms_employee_flag', true)->get();
        return view('iso.knowledge-transfer-create', compact('emp','list'));
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
        $list = DB::table('ms_employee')->where('ms_employee_flag', true)->get();
        return view('iso.knowledge-transfer-edit', compact('knowledgeTransfer','list'));
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
      function show(KnowledgeTransfer $knowledgeTransfer)
    {
        $list = DB::table('ms_employee')->where('ms_employee_flag', true)->get();
        return view('iso.knowledge-transfer-show', compact('knowledgeTransfer','list'));
    }
}
