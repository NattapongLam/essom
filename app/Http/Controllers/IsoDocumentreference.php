<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Documentreference;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class IsoDocumentreference extends Controller
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
        $hd = Documentreference::where('documentreferences_flag',true)->get();     
        return view('iso.form-document-reference-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = Documentreference::orderby('documentreferences_listno','DESC')->first();
        $listno = 0;
        if($hd){
            $listno = $hd->documentreferences_listno+1;
        }else{
            $listno = 1;
        }
        return view('iso.form-document-reference-create',compact('listno'));
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
            'documentreferences_listno' => ['required'],
            'documentreferences_receivedate' => ['required'],
        ]);
        $data =[
                'documentreferences_listno' => $request->documentreferences_listno,
                'documentreferences_receivedate' => $request->documentreferences_receivedate,
                'documentreferences_department' => $request->documentreferences_department,
                'documentreferences_name' => $request->documentreferences_name,
                'documentreferences_code' => $request->documentreferences_code,
                'documentreferences_date' => $request->documentreferences_date,
                'person_at' => Auth::user()->name,
                'documentreferences_flag' => true,
                'created_at'=> Carbon::now(),
        ];
        if ($request->hasFile('documentreferences_file')) {
            $data['documentreferences_file'] = $request->file('documentreferences_file')->storeAs('img/documentreferences', "IMG_" . carbon::now()->format('Ymdhis') . "_" . Str::random(5) . "." . $request->file('documentreferences_file')->extension());
        }
        try{
            DB::beginTransaction();
            $insertHD = Documentreference::create($data);
            DB::commit();
            return redirect()->route('document-reference.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('document-reference.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = Documentreference::find($id);
        return view('iso.form-document-reference-edit',compact('hd'));
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
            'documentreferences_listno' => ['required'],
            'documentreferences_receivedate' => ['required'],
        ]);
        $data =[
                'documentreferences_listno' => $request->documentreferences_listno,
                'documentreferences_receivedate' => $request->documentreferences_receivedate,
                'documentreferences_department' => $request->documentreferences_department,
                'documentreferences_name' => $request->documentreferences_name,
                'documentreferences_code' => $request->documentreferences_code,
                'documentreferences_date' => $request->documentreferences_date,
                'person_at' => Auth::user()->name,
                'documentreferences_flag' => true,
                'updated_at'=> Carbon::now(),
        ];
        if ($request->hasFile('documentreferences_file')) {
            $data['documentreferences_file'] = $request->file('documentreferences_file')->storeAs('img/documentreferences', "IMG_" . carbon::now()->format('Ymdhis') . "_" . Str::random(5) . "." . $request->file('documentreferences_file')->extension());
        }
        try{
            DB::beginTransaction();
            $insertHD = Documentreference::where('documentreferences_id',$id)->update($data);
            DB::commit();
            return redirect()->route('document-reference.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('document-reference.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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

    public function cancelReference(Request $request)
    {
        $hd = Documentreference::where('documentreferences_id',$request->refid)->update([
            'documentreferences_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
    
}
