<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailRegistry;

class IsoEmailRegistration extends Controller
{
  
    public function index()
    {
        $records = EmailRegistry::all();
        return view('iso.email-registration-list', compact('records'));
    }
    public function create()
    {
        return view('iso.email-registration');
    }

    public function store(Request $request)
    {
        foreach ($request->email_account as $i => $emailAccount) {
            if (empty($emailAccount)) continue;

            EmailRegistry::create([
                'email_account' => $emailAccount,
                'password'      => $request->password[$i],
                'user_name'     => $request->user_name[$i],
                'position'      => $request->position[$i],
                'department'    => $request->department[$i],
                'approved_by'   => $request->approved_by[$i],
                'date'          => $request->date[$i],
                'remark'        => $request->remark[$i],
                'item'          => $request->item[$i],
            ]);
        }


        return redirect()->route('email-registration.index')
                         ->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว!');
    }

    public function edit($id)
    {
        $record = EmailRegistry::findOrFail($id);
        return view('iso.email-registration-edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $record = EmailRegistry::findOrFail($id);

        $record->update($request->only([
            'item', 'email_account', 'password', 'user_name',
            'position', 'department', 'approved_by', 'date', 'remark'
        ]));

        return redirect()->route('email-registration.index')
                         ->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว!');
    }

    // ✅ destroy
    public function destroy($id)
    {
        EmailRegistry::findOrFail($id)->delete();
        
        return redirect()->route('email-registration.index')
                         ->with('success', 'ลบข้อมูลเรียบร้อยแล้ว!');
    }
    
    public function show($id)
    {
        $record = EmailRegistry::findOrFail($id);
        return view('iso.email-registration-show', compact('record'));
    }
}
