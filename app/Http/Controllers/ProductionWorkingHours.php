<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DepartmentList;
use App\Models\WorkingHoursType;
use Illuminate\Support\Facades\DB;
use App\Models\ProductionOpenjobHd;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProductionWorkingHours extends Controller
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
        $hd = DB::table('workinghours_hd')
        ->leftjoin('workinghours_status','workinghours_hd.workinghours_status_id','=','workinghours_status.workinghours_status_id')
        ->leftjoin('ms_department','workinghours_hd.ms_department_id','=','ms_department.ms_department_id')
        ->get();
        return view('productions.form-open-productionworkinghours',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docs_last = DB::table('workinghours_hd')
        ->where('workinghours_hd_docuno', 'like', '%' . date('Ymd') . '%')
        ->orderBy('workinghours_hd_id', 'desc')->first();
        if ($docs_last) {
        $docs = 'MAN-' . date('Ymd').'-'. str_pad($docs_last->workinghours_hd_number + 1, 4, '0', STR_PAD_LEFT);
        $docs_number = $docs_last->workinghours_hd_number + 1;
        } else {
        $docs = 'MAN-' . date('Ymd').'-'. str_pad(1, 4, '0', STR_PAD_LEFT);
        $docs_number = 1;
        }
        $dep = DepartmentList::get();
        $typ = WorkingHoursType::get();
        $jobdoc = ProductionOpenjobHd::get();
        return view('productions.form-create-productionworkinghours',compact('docs', 'docs_number','dep','typ','jobdoc'));
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
    public function getDataWoho(Request $request)
    {
        $dt = DB::table('workinghours_dt')
        ->where('workinghours_hd_id', $request->refid)
        ->where('workinghours_dt_flag',true)
        ->get(); 
        return response()->json(
            [
                'status' => true,
                'dt' => $dt,
            ]);
    }
    public function getjobDocu(Request $request)
    {
        if($request->workinghours_type == 'Product'){
            $jobdoc = ProductionOpenjobHd::get();
            return response()->json(['status' => true , 'jobdoc' => $jobdoc]);
        }
       
    }
}
