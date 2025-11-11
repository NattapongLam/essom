<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\DocumentdestructionDt;
use App\Models\DocumentdestructionHd;

class IsoDocumentdestruction extends Controller
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
        $hd = DocumentdestructionHd::where('documentdestruction_hd_flag',true)->get();    
        return view('iso.form-document-destruction-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;     
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();  
        return view('iso.form-document-destruction-create',compact('hd','emp'));
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
            'documentdestruction_hd_to' => ['required'],
            'documentdestruction_hd_from' => ['required'],
            'documentdestruction_hd_date' => ['required'],
            'documentdestruction_dt_listno' => ['required'],
            'requested_by' => ['required'],
            'requested_date' => ['required'],
        ]);
        $data = [
            'documentdestruction_hd_date' => $request->documentdestruction_hd_date,
            'documentdestruction_hd_to' => $request->documentdestruction_hd_to,
            'documentdestruction_hd_from' => $request->documentdestruction_hd_from,
            'requested_by' => $request->requested_by,
            'requested_date' => $request->requested_date,
            'documentdestruction_hd_flag' => true,
            'created_at' => Carbon::now(),
            'reviewed_by' => $request->reviewed_by,
            'approved_by' => $request->approved_by,
            'reviewed_status' => "N",
            'approved_status' => "N"
        ];
        try{
            DB::beginTransaction();
            $insertHD = DocumentdestructionHd::create($data);
            foreach ($request->documentdestruction_dt_listno as $key => $value) {
                DocumentdestructionDt::insert([
                    'documentdestruction_hd_id' => $insertHD->documentdestruction_hd_id,
                    'documentdestruction_dt_listno' => $value,
                    'documentdestruction_dt_code'  => $request->documentdestruction_dt_code[$key],
                    'documentdestruction_dt_name'  => $request->documentdestruction_dt_name[$key],
                    'documentdestruction_dt_note'  => $request->documentdestruction_dt_note[$key],
                    'documentdestruction_dt_flag' => true,
                    'person_at' => Auth::user()->name,
                    'created_at' => Carbon::now(),
                ]);
            }
            DB::commit();
            return redirect()->route('document-destruction.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('document-destruction.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = DocumentdestructionHd::where('documentdestruction_hd_id',$id)->first();
        $dt = DocumentdestructionDt::where('documentdestruction_hd_id',$id)->get();
        return view('iso.form-document-destruction-update',compact('hd','dt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data = [
            'reviewed_by' => $request->reviewed_by,
            'reviewed_date' => $request->reviewed_date,
            'approved_by' => $request->approved_by,
            'approved_date' => $request->approved_date,
            'reviewed_status' => $request->reviewed_status,
            'approved_status' => $request->approved_status
        ];
        try{
            DB::beginTransaction();
            $insertHD = DocumentdestructionHd::where('documentdestruction_hd_id',$id)->update($data);          
            DB::commit();
            return redirect()->route('document-destruction.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('document-destruction.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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

    public function cancelDestruction(Request $request)
    {
        $hd = DocumentdestructionHd::where('documentdestruction_hd_id',$request->refid)->update([
            'documentdestruction_hd_flag' => 0,
            'updated_at' => Carbon::now(),
            'requested_by' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
