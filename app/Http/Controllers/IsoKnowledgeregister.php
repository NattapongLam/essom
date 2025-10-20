<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KnowledgeRegister;

class IsoKnowledgeregister extends Controller
{
    public function index()
    {
        $records = KnowledgeRegister::all();

        foreach ($records as $record) {
            $document_code = $record->document_code ?? [];
            $received_date = $record->received_date ?? [];
            $doc_title = $record->doc_title ?? [];

            $record->documents = collect($document_code)->map(function ($code, $i) use ($received_date, $doc_title) {
                return (object)[
                    'document_code' => $code,
                    'received_date' => $received_date[$i] ?? '',
                    'doc_title' => $doc_title[$i] ?? '',
                ];
            });
        }

        return view('iso.knowledge-register-list', compact('records'));
    }
    public function create()
    {
        return view('iso.knowledge-register-create');
    }

    public function store(Request $request)
    {
        KnowledgeRegister::create([
            'document_code' => $request->document_code ?? [],
            'received_date' => $request->received_date ?? [],
            'doc_title' => $request->doc_title ?? [],
        ]);

        return redirect()->route('knowledge-register.index')
                         ->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function edit($id)
    {
        $record = KnowledgeRegister::findOrFail($id);

        $document_code = $record->document_code ?? [];
        $received_date = $record->received_date ?? [];
        $doc_title = $record->doc_title ?? [];

        $record->documents = collect($document_code)->map(function ($code, $i) use ($received_date, $doc_title) {
            return (object)[
                'document_code' => $code,
                'received_date' => $received_date[$i] ?? '',
                'doc_title' => $doc_title[$i] ?? '',
            ];
        });

        return view('iso.knowledge-register-edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $record = KnowledgeRegister::findOrFail($id);

        $record->update([
            'document_code' => $request->document_code ?? [],
            'received_date' => $request->received_date ?? [],
            'doc_title' => $request->doc_title ?? [],
        ]);

        return redirect()->route('knowledge-register.index')
                         ->with('success', 'อัปเดตข้อมูลสำเร็จ');
    }

    public function destroy($id)
    {
        KnowledgeRegister::findOrFail($id)->delete();

        return redirect()->route('knowledge-register.index')
                         ->with('success', 'ลบข้อมูลสำเร็จ');
    }
}
