<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\QualityPlanDt;
use App\Models\QualityPlanHd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class IsoQualityPlan extends Controller
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
        $hd = QualityPlanHd::where('quality_plan_hd_flag',true)->get();     
        return view('iso.form-quality-plan-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;     
        return view('iso.form-quality-plan-create',compact('hd'));
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
            'quality_plan_hd_docno' => ['required'],
            'quality_plan_hd_revno' => ['required'],
            'quality_plan_hd_effecdate' => ['required'],
            'requested_by' => ['required'],
            'requested_date' => ['required'],
            'quality_plan_dt_listno' => ['required'],
        ]);
        $data = [
            'quality_plan_hd_docno' => $request->quality_plan_hd_docno,
            'quality_plan_hd_revno' => $request->quality_plan_hd_revno,
            'quality_plan_hd_effecdate' => $request->quality_plan_hd_effecdate,
            'quality_plan_hd_page' => $request->quality_plan_hd_page,
            'quality_plan_hd_flag' => true,
            'requested_by' => $request->requested_by,
            'requested_date' => $request->requested_date,
            'created_at' => Carbon::now(),
        ];
        try{
            DB::beginTransaction();
            $insertHD = QualityPlanHd::create($data);
            foreach ($request->quality_plan_dt_listno as $key => $value) {
                QualityPlanDt::insert([
                    'quality_plan_hd_id' => $insertHD->quality_plan_hd_id,
                    'quality_plan_dt_listno' => $value,
                    'quality_plan_dt_description' => $request->quality_plan_dt_description[$key],
                    'quality_plan_dt_tool' => $request->quality_plan_dt_tool[$key],
                    'quality_plan_dt_by' => $request->quality_plan_dt_by[$key],
                    'quality_plan_dt_reference' => $request->quality_plan_dt_reference[$key],
                    'quality_plan_dt_flag' => true,
                    'person_at' => Auth::user()->name,
                    'created_at' => Carbon::now(), 
                ]);
            }
            DB::commit();
            return redirect()->route('quality-plan.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('quality-plan.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = QualityPlanHd::find($id);    
        $dt = QualityPlanDt::where('quality_plan_hd_id',$id)->where('quality_plan_dt_flag',true)->get();    
        return view('iso.form-quality-plan-update',compact('hd','dt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = QualityPlanHd::find($id);    
        $dt = QualityPlanDt::where('quality_plan_hd_id',$id)->where('quality_plan_dt_flag',true)->get();    
        return view('iso.form-quality-plan-edit',compact('hd','dt'));
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
        if($request->checkdoc = "Edit"){
            $data = [
                'quality_plan_hd_docno' => $request->quality_plan_hd_docno,
                'quality_plan_hd_revno' => $request->quality_plan_hd_revno,
                'quality_plan_hd_effecdate' => $request->quality_plan_hd_effecdate,
                'quality_plan_hd_page' => $request->quality_plan_hd_page,
                'quality_plan_hd_flag' => true,
                'requested_by' => $request->requested_by,
                'requested_date' => $request->requested_date,
                'updated_at' => Carbon::now(),
            ];
            try{
                DB::beginTransaction();
                $insertHD = QualityPlanHd::where('quality_plan_hd_id',$id)->update($data);
                foreach ($request->quality_plan_dt_id as $key => $value) {
                    QualityPlanDt::where('quality_plan_dt_id',$id)->update([
                        'quality_plan_dt_description' => $request->quality_plan_dt_description[$key],
                        'quality_plan_dt_tool' => $request->quality_plan_dt_tool[$key],
                        'quality_plan_dt_by' => $request->quality_plan_dt_by[$key],
                        'quality_plan_dt_reference' => $request->quality_plan_dt_reference[$key],
                        'quality_plan_dt_flag' => true,
                        'person_at' => Auth::user()->name,
                        'updated_at' => Carbon::now(), 
                    ]);
                }
                foreach ($request->quality_plan_dt_listno as $key => $value) {
                    QualityPlanDt::insert([
                        'quality_plan_hd_id' => $insertHD->quality_plan_hd_id,
                        'quality_plan_dt_listno' => $value,
                        'quality_plan_dt_description' => $request->quality_plan_dt_description[$key],
                        'quality_plan_dt_tool' => $request->quality_plan_dt_tool[$key],
                        'quality_plan_dt_by' => $request->quality_plan_dt_by[$key],
                        'quality_plan_dt_reference' => $request->quality_plan_dt_reference[$key],
                        'quality_plan_dt_flag' => true,
                        'person_at' => Auth::user()->name,
                        'created_at' => Carbon::now(), 
                    ]);
                }
                DB::commit();
                return redirect()->route('quality-plan.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('quality-plan.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
            }
        }else if($request->checkdoc = "Update"){
            $data = [
                'reviewed_by' => $request->reviewed_by,
                'reviewed_date' => $request->reviewed_date,
                'approved_by' => $request->approved_by,
                'approved_date' => $request->approved_date,
                'updated_at' => Carbon::now(),
            ];
              try{
                DB::beginTransaction();
                $insertHD = QualityPlanHd::where('quality_plan_hd_id',$id)->update($data);
                DB::commit();
                return redirect()->route('quality-plan.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('quality-plan.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    public function cancelQualityplanHd(Request $request)
    {
        $hd = QualityPlanHd::where('quality_plan_hd_id',$request->refid)->update([
            'quality_plan_hd_flag' => 0,
            'updated_at' => Carbon::now(),
            'requested_by' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }

    public function cancelQualityplanDt(Request $request)
    {
        $hd = QualityPlanDt::where('quality_plan_dt_id',$request->refid)->update([
            'quality_plan_dt_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
