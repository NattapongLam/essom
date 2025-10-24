<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Documentregister;
use Illuminate\Support\Facades\DB;
use App\Models\Documentdistribution;
use Illuminate\Support\Facades\Auth;

class IsoDocumentdistribution extends Controller
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
        $hd = Documentregister::where('documentregisters_flag',true)->get();       
        return view('iso.form-document-distribution-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emp = DB::table('ms_employee')
        ->where('ms_employee_code',Auth::user()->code)
        ->first();
        if($emp){
            $list = Documentdistribution::leftjoin('documentregisters','documentdistributions.documentregisters_id','=','documentregisters.documentregisters_id')
            ->where('documentdistributions.documentdistributions_flag',true)
            ->where('documentdistributions.ms_employee_id',$emp->ms_employee_id)
            ->get();
        }else{
            return redirect()->route('document-distribution.index');
        }    
        return view('iso.form-document-distribution-edit',compact('list'));
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
            'documentregisters_id' => ['required'],
            'ms_department_name' => ['required'],
            'documentdistributions_type' => ['required'],
            'documentdistributions_date' => ['required'],
        ]);      
        try{

            DB::beginTransaction();
            foreach ($request->ms_employee_id as $key => $value) {
                $hd = Documentdistribution::insert([
                    'documentdistributions_listno' => $request->documentdistributions_listno[$key],
                    'documentregisters_id' => $request->documentregisters_id,
                    'ms_employee_id' => $request->ms_employee_id[$key],
                    'person_at' =>  Auth::user()->name,
                    'documentdistributions_flag' => true,
                    'created_at' => Carbon::now(),
                    'documentdistributions_type' => $request->documentdistributions_type[$key],
                    'documentdistributions_date' => $request->documentdistributions_date[$key],
                    'ms_department_name' => $request->ms_department_name[$key],
                ]);
            }
            DB::commit();
            return redirect()->route('document-distribution.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('document-distribution.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = Documentregister::find($id);
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();
        $list = Documentdistribution::leftjoin('ms_employee','documentdistributions.ms_employee_id','=','ms_employee.ms_employee_id')
        ->where('documentdistributions.documentdistributions_flag',true)
        ->where('documentdistributions.documentregisters_id',$id)
        ->get();
        $dep = DB::table('ms_department')->where('ms_department_flag',true)->get();
        return view('iso.form-document-distribution-create',compact('hd','emp','list','dep'));
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
        //
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

    public function cancelDistribution(Request $request)
    {
        $hd = Documentdistribution::where('documentdistributions_id',$request->refid)->update([
            'documentdistributions_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }

    public function approvedDistribution(Request $request)
    {
        $hd = Documentdistribution::where('documentdistributions_id',$request->refid)->update([
            'updated_at' => Carbon::now(),
            'approved_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
