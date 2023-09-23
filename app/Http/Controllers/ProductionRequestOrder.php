<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductionRequestOrderDt;
use App\Models\ProductionRequestOrderHd;
use App\Models\ProductionRequestOrderStatus;

class ProductionRequestOrder extends Controller
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
        $hd = DB::table('requestorder_hd')
        ->leftjoin('requestorder_status','requestorder_hd.requestorder_status_id','=','requestorder_status.requestorder_status_id')
        ->leftjoin('ms_department','requestorder_hd.ms_department_id','=','ms_department.ms_department_id')
        ->select('requestorder_hd.*','requestorder_status.requestorder_status_name','ms_department.ms_department_name')
        ->where('requestorder_hd.requestorder_status_id','<>',2)
        ->get();
        return view('productions.form-open-productionrequestorder',compact('hd'));
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
        $ck = ProductionRequestOrderHd::where('requestorder_hd_docuno',$id)->first();
        if($ck){
            $hd = ProductionRequestOrderHd::where('requestorder_hd_id',$ck->requestorder_hd_id)
            ->leftjoin('ms_department','requestorder_hd.ms_department_id','=','ms_department.ms_department_id')
            ->first();
            $dt = ProductionRequestOrderDt::where('requestorder_hd_id', $ck->requestorder_hd_id)
            ->where('requestorder_dt_flag',true)
            ->get();  
            $sta = ProductionRequestOrderStatus::whereIn('requestorder_status_id',[2,3])->get();
            return view('productions.form-edit-productionrequestorder', compact('hd','dt','sta'));
        }       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = ProductionRequestOrderHd::where('requestorder_hd_id',$id)
        ->leftjoin('ms_department','requestorder_hd.ms_department_id','=','ms_department.ms_department_id')
        ->select('requestorder_hd.*','ms_department.ms_department_name')
        ->first();
        $dt = ProductionRequestOrderDt::where('requestorder_hd_id', $id)
        ->where('requestorder_dt_flag',true)
        ->get();  
        $sta = ProductionRequestOrderStatus::whereIn('requestorder_status_id',[2,3])->get();
        return view('productions.form-edit-productionrequestorder', compact('hd','dt','sta'));
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
        $hd = ProductionRequestOrderHd::where('requestorder_hd_id',$id)->first();
        if($hd){
            try{
                DB::beginTransaction();
                $up = ProductionRequestOrderHd::where('requestorder_hd_id',$id)->update([
                    'requestorder_status_id' => 3,
                    'approved_date' => Carbon::now(),
                    'approved_by' => Auth::user()->name,
                    'approved_note' => $request->note
                ]);              
                $dt = ProductionRequestOrderDt::where('requestorder_hd_id',$id)->get();
                foreach($dt as $key => $value){
                    $updt = ProductionRequestOrderDt::where('requestorder_dt_id',$value->requestorder_dt_id)->update([
                    'requestorder_status_id' => 3,
                    'approveddate' => Carbon::now(),
                    'approvedby' => Auth::user()->name,
                    ]);
                }             
                DB::commit();
                return redirect()->route('pd-requ.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('pd-requ.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    public function getDataRequ(Request $request)
    {
        $dt = DB::table('requestorder_dt')
        ->where('requestorder_hd_id', $request->refid)
        ->where('requestorder_dt_flag',true)
        ->get(); 
        return response()->json(
            [
                'status' => true,
                'dt' => $dt,
            ]);
    }
}
