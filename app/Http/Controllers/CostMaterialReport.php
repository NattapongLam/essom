<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CostMaterialReport extends Controller
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
        $hd = DB::table('costmaterial_report')->get();
        return view('productions.form-open-costmaterialreport',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $hd = DB::table('costmaterial_report')->where('costmaterial_report_id',$id)->first();
        $dt = DB::table('costmaterial_reportsub')->where('costmaterial_report_id',$id)->get();
        return view('productions.form-edit-costmaterialreport',compact('hd','dt'));
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
        $hd = DB::table('costmaterial_report')->where('costmaterial_report_id',$id)->first();
        try{
            DB::beginTransaction();
            if($hd->reviewed_by == null){
                $up = DB::table('costmaterial_report')
                ->where('costmaterial_report_id',$id)
                ->update([
                    'reviewed_by' => Auth::user()->name,
                    'reviewed_date' => Carbon::now()
                ]);
    
            }elseif($hd->acknowledges_by == null){
                $up = DB::table('costmaterial_report')
                ->where('costmaterial_report_id',$id)
                ->update([
                    'acknowledges_by' => Auth::user()->name,
                    'acknowledges_date' => Carbon::now()
                ]);
            }
            DB::commit();
            return redirect()->route('cm-report.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('cm-report.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    public function getDataCost(Request $request)
    {
        $dt = DB::table('costmaterial_reportsub')
        ->where('costmaterial_report_id', $request->refid)
        ->where('costmaterial_reportsub_flag',true)
        ->get();  
        return response()->json(
            [
                'status' => true,
                'dt' => $dt,
            ]);
    }
}
