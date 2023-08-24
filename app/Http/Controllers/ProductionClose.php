<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProductionClose extends Controller
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
        $hd = DB::table('productionopenjob_hd')
        ->leftjoin('productionopenjob_status','productionopenjob_hd.productionopenjob_status_id','=','productionopenjob_status.productionopenjob_status_id')
        ->whereIn('productionopenjob_hd.productionopenjob_status_id',[9,13,14])->get();
        return view('productions.form-open-productionclosejob',compact('hd'));
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
    public function getDataClose(Request $request)
    {
        $dt = DB::table('productionopenjob_dt')
        ->leftjoin('productionopenjob_status','productionopenjob_dt.productionopenjob_status_id','=','productionopenjob_status.productionopenjob_status_id')
        ->leftjoin('ms_department','productionopenjob_dt.ms_department_id','=','ms_department.ms_department_id')
        ->where('productionopenjob_dt.productionopenjob_hd_id', $request->refid)
        ->where('productionopenjob_dt.productionopenjob_dt_flag',true)
        ->get(); 
        return response()->json(
            [
                'status' => true,
                'dt' => $dt,

            ]);
    }
}
