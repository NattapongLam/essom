<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductionCalendar extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = DB::table('productionopenjob_status')->get();
        $status_filter = null;
        return view('productions.form-open-productioncalendar',compact('status', 'status_filter'));
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
    public function getDataProductioncalendar(Request $request)
    {
        if($request->type_filter == '' || $request->type_filter == null){
        $due = DB::table('productionopenjob_hd')->get();
        }else{
            $due = DB::table('productionopenjob_hd')
            ->whereIN('productionopenjob_status_id',$request->type_filter)
            ->get();
        }        
        return response()->json($due);
    }
    public function popupCalendar(Request $request)
    {
        $due = DB::table('vw_productionopenjob_docuall')
        ->where('productionopenjob_hd_docuno',$request->docs)
        ->get();
        return response()->json($due);
    }

    public function filterCalendar(Request $request)
    {
        $status = DB::table('productionopenjob_status')->get();
        $status_filter = $request->filter;
        return view('productions.form-open-productioncalendar',compact('status', 'status_filter'));
    }
}
