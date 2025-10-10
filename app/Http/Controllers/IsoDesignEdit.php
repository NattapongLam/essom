<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DesignEdit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class IsoDesignEdit extends Controller
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
        $hd = DesignEdit::where('design_edits_flag',true)->get();   
        return view('iso.form-design-edit-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();    
        return view('iso.form-design-edit-create',compact('emp'));
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
            'design_edits_product' => ['required'],
            'design_edits_model' => ['required'],
            'design_edits_drawing' => ['required'],
            'design_edits_reasons' => ['required'],
            'requested_by' => ['required'],
            'requested_date' => ['required'],
            'supervisor_by' => ['required'],
            'supervisor_date' => ['required'],
        ]);
        $data = [
            'design_edits_product' => $request->design_edits_product,
            'design_edits_model'=> $request->design_edits_model,
            'design_edits_drawing' => $request->design_edits_drawing,
            'design_edits_reasons' => $request->design_edits_reasons,
            'requested_by' => $request->requested_by,
            'requested_date' => $request->requested_date,
            'supervisor_by' => $request->supervisor_by,
            'supervisor_date' => $request->supervisor_date,
            'design_edits_flag' => true,
            'person_at' => Auth::user()->name,   
            'created_at' => Carbon::now(),
        ];
        try
        {
            DB::beginTransaction();
            $insertHD = DesignEdit::create($data);
            DB::commit();
            return redirect()->route('design-edit.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('design-edit.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = DesignEdit::find($id);
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();    
        return view('iso.form-design-edit-update',compact('emp','hd'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = DesignEdit::find($id);
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();    
        return view('iso.form-design-edit-edit',compact('emp','hd'));
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
        if($request->docuref == "Edit"){
            $request->validate([
                'design_edits_product' => ['required'],
                'design_edits_model' => ['required'],
                'design_edits_drawing' => ['required'],
                'design_edits_reasons' => ['required'],
                'requested_by' => ['required'],
                'requested_date' => ['required'],
                'supervisor_by' => ['required'],
                'supervisor_date' => ['required'],
            ]);
            $data = [
                'design_edits_product' => $request->design_edits_product,
                'design_edits_model'=> $request->design_edits_model,
                'design_edits_drawing' => $request->design_edits_drawing,
                'design_edits_reasons' => $request->design_edits_reasons,
                'requested_by' => $request->requested_by,
                'requested_date' => $request->requested_date,
                'supervisor_by' => $request->supervisor_by,
                'supervisor_date' => $request->supervisor_date,
                'design_edits_flag' => true,
                'person_at' => Auth::user()->name,   
                'created_at' => Carbon::now(),
            ];
            try
            {
                DB::beginTransaction();
                $insertHD = DesignEdit::where('design_edits_id',$id)->update($data);
                DB::commit();
                return redirect()->route('design-edit.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('design-edit.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
            }
        }elseif($request->docuref == "Update"){
            $data = [
                'engineeringsection_comments' => $request->engineeringsection_comments,
                'engineeringsection_by' => $request->engineeringsection_by,
                'engineeringsection_date' => $request->engineeringsection_date,
                'engineer_comments' => $request->engineer_comments,
                'engineer_by' => $request->engineer_by,
                'engineer_date' => $request->engineer_date,
                'seniorengineer_comments' => $request->seniorengineer_comments,
                'seniorengineer_by' => $request->seniorengineer_by,
                'seniorengineer_date' => $request->seniorengineer_date
            ];
            try
            {
                DB::beginTransaction();
                $insertHD = DesignEdit::where('design_edits_id',$id)->update($data);
                DB::commit();
                return redirect()->route('design-edit.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('design-edit.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    public function cancelDesignedit()
    {   
        $hd = DesignEdit::where('design_edits_id',$request->refid)->update([
            'design_edits_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
