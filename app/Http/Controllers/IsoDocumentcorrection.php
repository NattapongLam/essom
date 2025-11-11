<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Documentregister;
use App\Models\Documentcorrection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class IsoDocumentcorrection extends Controller
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
        $hd = Documentcorrection::where('documentcorrections_flag',true)->get();
        return view('iso.form-document-correction-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = Documentregister::where('documentregisters_flag',true)->get(); 
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get(); 
        return view('iso.form-document-correction-create',compact('hd','emp'));
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
            'documentcorrections_type' => ['required'],
            'documentcorrections_docuno' => ['required'],
            'documentcorrections_date' => ['required'],
            'documentcorrections_to' => ['required'],
            'documentcorrections_from' => ['required'],
            'documentcorrections_effectivedate' => ['required'],
            ]);
            $data = [
                'documentcorrections_type' => $request->documentcorrections_type,
                'documentcorrections_docuno' => $request->documentcorrections_docuno,
                'documentcorrections_date' => $request->documentcorrections_date,
                'documentcorrections_to' => $request->documentcorrections_to,
                'documentcorrections_from' => $request->documentcorrections_from,
                'documentregisters_id' => $request->documentregisters_id,
                'documentcorrections_name' => $request->documentcorrections_name,
                'documentcorrections_torev' => $request->documentcorrections_torev,
                'documentcorrections_fromrev' => $request->documentcorrections_fromrev,
                'documentcorrections_effectivedate' => $request->documentcorrections_effectivedate,
                'documentcorrections_previous' => $request->documentcorrections_previous,       
                'documentcorrections_revision' => $request->documentcorrections_revision,
                'documentcorrections_note' => $request->documentcorrections_note,
                'requested_by' => $request->requested_by,
                'requested_date' => $request->requested_date,
                'documentcorrections_flag' => true,
                'created_at' => Carbon::now(),
                'reviewed_by' => $request->reviewed_by,
                'approved_by' => $request->approved_by,
                'reviewed_status' => 'N',
                'approved_status' => 'N'
            ];
            try{

                DB::beginTransaction();
                $insertHD = Documentcorrection::create($data);
                DB::commit();
                return redirect()->route('document-correction.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('document-correction.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = Documentregister::where('documentregisters_flag',true)->get(); 
        $doc = Documentcorrection::find($id);
       
        return view('iso.form-document-correction-update',compact('hd','doc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = Documentregister::where('documentregisters_flag',true)->get(); 
        $doc = Documentcorrection::find($id);
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get(); 
        return view('iso.form-document-correction-edit',compact('hd','doc','emp'));
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
        if($request->checkdoc == "Edit"){
            $request->validate([
                'documentcorrections_type' => ['required'],
                'documentcorrections_docuno' => ['required'],
                'documentcorrections_date' => ['required'],
                'documentcorrections_to' => ['required'],
                'documentcorrections_from' => ['required'],
                'documentcorrections_effectivedate' => ['required'],
            ]);
            $data = [
                'documentcorrections_type' => $request->documentcorrections_type,
                'documentcorrections_docuno' => $request->documentcorrections_docuno,
                'documentcorrections_date' => $request->documentcorrections_date,
                'documentcorrections_to' => $request->documentcorrections_to,
                'documentcorrections_from' => $request->documentcorrections_from,
                'documentregisters_id' => $request->documentregisters_id,
                'documentcorrections_name' => $request->documentcorrections_name,
                'documentcorrections_torev' => $request->documentcorrections_torev,
                'documentcorrections_fromrev' => $request->documentcorrections_fromrev,
                'documentcorrections_effectivedate' => $request->documentcorrections_effectivedate,
                'documentcorrections_previous' => $request->documentcorrections_previous,       
                'documentcorrections_revision' => $request->documentcorrections_revision,
                'documentcorrections_note' => $request->documentcorrections_note,
                'requested_by' => $request->requested_by,
                'requested_date' => $request->requested_date,
                'documentcorrections_flag' => true,
                'updated_at' => Carbon::now(),
                'reviewed_by' => $request->reviewed_by,
                'approved_by' => $request->approved_by,
                'reviewed_status' => 'N',
                'approved_status' => 'N'
            ];
            try{

                DB::beginTransaction();
                $insertHD = Documentcorrection::where('documentcorrections_id',$id)->update($data);
                DB::commit();
                return redirect()->route('document-correction.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('document-correction.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
            }
        }
        else if($request->checkdoc == "Update"){
            $data = [
                'documentcorrections_auditcheck' => $request->documentcorrections_auditcheck,
                'reviewed_by' => $request->reviewed_by,
                'reviewed_date' => $request->reviewed_date,
                'reviewed_comment' => $request->reviewed_comment,
                'approved_by' => $request->approved_by,
                'approved_date' => $request->approved_date,
                'reviewed_status' => $request->reviewed_status,
                'approved_status' => $request->approved_status
            ];
            try{

                DB::beginTransaction();
                $insertHD = Documentcorrection::where('documentcorrections_id',$id)->update($data);
                DB::commit();
                return redirect()->route('document-correction.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('document-correction.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
            }
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
    public function cancelCorrection(Request $request)
    {
        $hd = Documentcorrection::where('documentcorrections_id',$request->refid)->update([
            'documentcorrections_flag' => 0,
            'updated_at' => Carbon::now(),
            'requested_by' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
