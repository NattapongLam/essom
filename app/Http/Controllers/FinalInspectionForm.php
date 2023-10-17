<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class FinalInspectionForm extends Controller
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
        //
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
        $docs_last = DB::table('finalInspection_hd')
        ->where('finalInspection_hd_docuno', 'like', '%' . date('Ymd') . '%')
        ->orderBy('finalInspection_hd_id', 'desc')->first();
        if ($docs_last) {
        $docs = 'QCC-' . date('Ymd').'-'. str_pad($docs_last->finalInspection_number + 1, 4, '0', STR_PAD_LEFT);
        $docs_number = $docs_last->finalInspection_number + 1;
        } else {
        $docs = 'QCC-' . date('Ymd').'-'. str_pad(1, 4, '0', STR_PAD_LEFT);
        $docs_number = 1;
        }
        $hd = DB::table('productionopenjob_hd')->where('productionopenjob_hd_id',$id)->first();
        $msfi = DB::table('ms_finalspec_hd')->where('ms_finalspec_hd_flag',true)->get();
        return view('productions.form-create-finalinspectionform', compact('hd','docs','docs_number','msfi'));
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
}
