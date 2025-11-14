<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SoftwareDesignDt;
use App\Models\SoftwareDesignHd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class IsoSoftwareDesign extends Controller
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
        $hd = SoftwareDesignHd::where('software_design_hd_flag',true)->get();
        return view('iso.form-software-design-list',compact('hd'));
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
        return view('iso.form-software-design-create',compact('hd','emp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'software_design_hd_no' => $request->software_design_hd_no,
            'software_design_hd_product' => $request->software_design_hd_product,
            'software_design_hd_reference' => $request->software_design_hd_reference,
            'software_design_hd_input' => $request->software_design_hd_input,
            'software_design_hd_output' => $request->software_design_hd_output,
            'software_design_hd_layout' => $request->software_design_hd_layout,
            'prepared_by1' => $request->prepared_by1,
            'prepared_date1' => $request->prepared_date1,
            'software_design_hd_comment' => $request->software_design_hd_comment,
            'prepared_by2' => $request->prepared_by2,
            'prepared_date2' => $request->prepared_date2,
            'software_design_hd_flag' => true,
            'created_at' => Carbon::now(),
            'reviewed_by1' => $request->reviewed_by1,
            'reviewed_by2' => $request->reviewed_by2,
            'initialapproval_by' => $request->initialapproval_by,
            'finalapproval_by' => $request->finalapproval_by,
            'reviewed_status1' => "N",
            'reviewed_status2' => "N",
            'initialapproval_status' => 'N',
            'finalapproval_status' => "N"
        ];
        try{

            DB::beginTransaction();
            $insertHD = SoftwareDesignHd::create($data);
            foreach ($request->listno as $key => $value) {
                SoftwareDesignDt::insert([
                    'software_design_hd_id' => $insertHD->software_design_hd_id,
                    'listno' => $request->listno[$key],
                    'software_design_dt_calculation' => $request->software_design_dt_calculation[$key],
                    'software_design_dt_byhand' => $request->software_design_dt_byhand[$key],
                    'software_design_dt_display' => $request->software_design_dt_display[$key],
                    'software_design_dt_error' => $request->software_design_dt_error[$key],
                    'person_at' => Auth::user()->name,
                    'created_at' => Carbon::now(),
                    'software_design_dt_flag' => true
                ]);
            }
            DB::commit();
            return redirect()->route('software-design.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('software-design.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = SoftwareDesignHd::find($id);
        $dt = SoftwareDesignDt::where('software_design_dt_flag',true)->where('software_design_hd_id',$id)->get();
        return view('iso.form-software-design-update',compact('hd','dt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = SoftwareDesignHd::find($id);
        $dt = SoftwareDesignDt::where('software_design_dt_flag',true)->where('software_design_hd_id',$id)->get();
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();   
        return view('iso.form-software-design-edit',compact('hd','dt','emp'));
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
        $data = [
            'software_design_hd_no' => $request->software_design_hd_no,
            'software_design_hd_product' => $request->software_design_hd_product,
            'software_design_hd_reference' => $request->software_design_hd_reference,
            'software_design_hd_input' => $request->software_design_hd_input,
            'software_design_hd_output' => $request->software_design_hd_output,
            'software_design_hd_layout' => $request->software_design_hd_layout,
            'prepared_by1' => $request->prepared_by1,
            'prepared_date1' => $request->prepared_date1,
            'software_design_hd_comment' => $request->software_design_hd_comment,
            'prepared_by2' => $request->prepared_by2,
            'prepared_date2' => $request->prepared_date2,
            'software_design_hd_flag' => true,
            'created_at' => Carbon::now(),
            'reviewed_by1' => $request->reviewed_by1,
            'reviewed_by2' => $request->reviewed_by2,
            'initialapproval_by' => $request->initialapproval_by,
            'finalapproval_by' => $request->finalapproval_by,
        ];
        try{

            DB::beginTransaction();
            $insertHD = SoftwareDesignHd::where('software_design_hd_id',$id)->update($data);
            foreach ($request->software_design_dt_id as $key => $value) {
                SoftwareDesignDt::where('software_design_dt_id',$value)->update([
                    'software_design_dt_calculation' => $request->software_design_dt_calculation[$key],
                    'software_design_dt_byhand' => $request->software_design_dt_byhand[$key],
                    'software_design_dt_display' => $request->software_design_dt_display[$key],
                    'software_design_dt_error' => $request->software_design_dt_error[$key],
                    'person_at' => Auth::user()->name,
                    'updated_at' => Carbon::now(),
                    'software_design_dt_flag' => true
                ]);
            }
            if($request->listno){
                foreach ($request->listno as $key => $value) {
                    SoftwareDesignDt::insert([
                        'software_design_hd_id' => $insertHD->software_design_hd_id,
                        'listno' => $request->listno[$key],
                        'software_design_dt_calculation' => $request->software_design_dt_calculation[$key],
                        'software_design_dt_byhand' => $request->software_design_dt_byhand[$key],
                        'software_design_dt_display' => $request->software_design_dt_display[$key],
                        'software_design_dt_error' => $request->software_design_dt_error[$key],
                        'person_at' => Auth::user()->name,
                        'created_at' => Carbon::now(),
                        'software_design_dt_flag' => true
                    ]);
                }
            }           
            DB::commit();
            return redirect()->route('software-design.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('software-design.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
        }
        }elseif($request->checkdoc == "Update"){
            $data = [
                'reviewed_by1' => $request->reviewed_by1,
                'reviewed_date1' => $request->reviewed_date1,
                'reviewed_by2' => $request->reviewed_by2,
                'reviewed_date2' => $request->reviewed_date2,
                'initialapproval_by' => $request->initialapproval_by,
                'initialapproval_date' => $request->initialapproval_date,
                'finalapproval_by' => $request->finalapproval_by,
                'finalapproval_date' => $request->finalapproval_date
            ];
            try{
                DB::beginTransaction();
                $insertHD = SoftwareDesignHd::where('software_design_hd_id',$id)->update($data);
                DB::commit();
                return redirect()->route('software-design.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('software-design.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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

    public function cancelSoftwareDesignHd(Request $request)
    {
        $hd = SoftwareDesignHd::where('software_design_hd_id',$request->refid)->update([
            'software_design_hd_flag' => 0,
            'updated_at' => Carbon::now(),
            'prepared_by1' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }

    public function cancelSoftwareDesignDt(Request $request)
    {
        $hd = SoftwareDesignDt::where('software_design_dt_id',$request->refid)->update([
            'software_design_dt_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
    public function approvedSoftwareDesign(Request $request)
    {
        if($request->status == "reviewed1"){
            $hd = SoftwareDesignHd::where('software_design_hd_id',$request->refid)->update([
            'reviewed_status1' => "Y",
            'reviewed_date1' => Carbon::now(),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
            ]);    
        }elseif($request->status == "reviewed2"){
            $hd = SoftwareDesignHd::where('software_design_hd_id',$request->refid)->update([
            'reviewed_status2' => "Y",
            'reviewed_date2' => Carbon::now(),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
            ]);    

        }elseif ($request->status == "initialapproval") {
            $hd = SoftwareDesignHd::where('software_design_hd_id',$request->refid)->update([
            'initialapproval_status' => "Y",
            'initialapproval_date' => Carbon::now(),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
            ]);    
        }elseif($request->status == "finalapproval"){
            $hd = SoftwareDesignHd::where('software_design_hd_id',$request->refid)->update([
            'finalapproval_status' => "Y",
            'finalapproval_date' => Carbon::now(),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
            ]);    
        }
    }
}
