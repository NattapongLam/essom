<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class FinalInspection extends Controller
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
        $hd = DB::table('finalInspection_hd')
        ->leftjoin('finalInspection_status','finalInspection_hd.finalInspection_status_id','=','finalInspection_status.finalInspection_status_id')
        ->leftjoin('ms_finalspec_hd','finalInspection_hd.ms_finalspec_hd_id','=','ms_finalspec_hd.ms_finalspec_hd_id')
        ->get();
        return view('productions.form-open-finalinspection',compact('hd'));
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
    public function getDataInst(Request $request)
    {
        $dt1 = DB::table('finalInspection_dt1')
        ->where('finalInspection_hd_id', $request->refid)
        ->where('finalInspection_dt1_flag',true)
        ->get(); 
        $dt2 = DB::table('finalInspection_dt2')
        ->where('finalInspection_hd_id', $request->refid)
        ->where('finalInspection_dt2_flag',true)
        ->get();
        return response()->json(
        [
            'status' => true,
            'dt1' => $dt1,
            'dt2' => $dt2
        ]);
    }
}
