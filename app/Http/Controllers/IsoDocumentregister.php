<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Documentregister;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class IsoDocumentregister extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = Documentregister::get();       
        return view('iso.form-document-register-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = 1;
        $ck = Documentregister::orderBy('documentregisters_listno','DESC')->first();
        if($ck){
            $list = $ck->documentregisters_listno + 1;
        }
        return view('iso.form-document-register-create',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'documentregisters_listno' => ['required'],
            'documentregisters_docuno' => ['required'],
        ]);
        $data = [
            'documentregisters_listno' => $request->documentregisters_listno,
            'documentregisters_docuno' => $request->documentregisters_docuno,
            'documentregisters_remark' => $request->documentregisters_remark,
            'documentregisters_rev01' => $request->documentregisters_rev01,
            'documentregisters_rev02' => $request->documentregisters_rev02,
            'documentregisters_rev03' => $request->documentregisters_rev03,
            'documentregisters_rev04' => $request->documentregisters_rev04,
            'documentregisters_rev05' => $request->documentregisters_rev05,
            'documentregisters_rev06' => $request->documentregisters_rev06,
            'documentregisters_rev07' => $request->documentregisters_rev07,
            'documentregisters_rev08' => $request->documentregisters_rev08,
            'documentregisters_rev09' => $request->documentregisters_rev09,
            'documentregisters_rev10' => $request->documentregisters_rev10,
            'person_at' => Auth::user()->name,
            'created_at' => Carbon::now(),
            'documentregisters_flag' => true
        ];
        if ($request->hasFile('documentregisters_file')) {
            $data['documentregisters_file'] = $request->file('documentregisters_file')->storeAs('img/documentregister', "IMG_" . carbon::now()->format('Ymdhis') . "_" . Str::random(5) . "." . $request->file('documentregisters_file')->extension());
        }
        try{

            DB::beginTransaction();
            $insertHD = Documentregister::create($data);
            DB::commit();
            return redirect()->route('document-register.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('document-register.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = Documentregister::find($id);
        return view('iso.form-document-register-edit',compact('hd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'documentregisters_docuno' => ['required'],
        ]);
         $data = [
            'documentregisters_docuno' => $request->documentregisters_docuno,
            'documentregisters_remark' => $request->documentregisters_remark,
            'documentregisters_rev01' => $request->documentregisters_rev01,
            'documentregisters_rev02' => $request->documentregisters_rev02,
            'documentregisters_rev03' => $request->documentregisters_rev03,
            'documentregisters_rev04' => $request->documentregisters_rev04,
            'documentregisters_rev05' => $request->documentregisters_rev05,
            'documentregisters_rev06' => $request->documentregisters_rev06,
            'documentregisters_rev07' => $request->documentregisters_rev07,
            'documentregisters_rev08' => $request->documentregisters_rev08,
            'documentregisters_rev09' => $request->documentregisters_rev09,
            'documentregisters_rev10' => $request->documentregisters_rev10,
            'person_at' => Auth::user()->name,
            'updated_at' => Carbon::now(),
            'documentregisters_flag' => $request->documentregisters_flag,
        ];
        if ($request->hasFile('documentregisters_file')) {
            $data['documentregisters_file'] = $request->file('documentregisters_file')->storeAs('img/documentregister', "IMG_" . carbon::now()->format('Ymdhis') . "_" . Str::random(5) . "." . $request->file('documentregisters_file')->extension());
        }
        try{

            DB::beginTransaction();
            $insertHD = Documentregister::where('documentregisters_id',$id)->update($data);
            DB::commit();
            return redirect()->route('document-register.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('document-register.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
