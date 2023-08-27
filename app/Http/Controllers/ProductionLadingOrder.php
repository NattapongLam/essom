<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductionLadingOrderDt;
use App\Models\ProductionLadingOrderHd;
use App\Models\ProductionLadingOrderStatus;

class ProductionLadingOrder extends Controller
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
        $hd = DB::table('ladingorder_hd')
        ->leftjoin('ladingorder_status','ladingorder_hd.ladingorder_status_id','=','ladingorder_status.ladingorder_status_id')
        ->leftjoin('ms_department','ladingorder_hd.ms_department_id','=','ms_department.ms_department_id')
        ->select('ladingorder_hd.*','ladingorder_status.ladingorder_status_name','ms_department.ms_department_name')
        ->get();
        return view('productions.form-open-productionladingorder',compact('hd'));
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
        $ck = ProductionLadingOrderHd::where('ladingorder_hd_docuno',$id)->first();
        if($ck){
            $hd = ProductionLadingOrderHd::where('ladingorder_hd_id',$ck->ladingorder_hd_id)
            ->leftjoin('ms_department','ladingorder_hd.ms_department_id','=','ms_department.ms_department_id')
            ->first();
            $dt = ProductionLadingOrderDt::where('ladingorder_hd_id',$ck->ladingorder_hd_id)
            ->where('ladingorder_dt_flag',true)
            ->get();  
            $sta = ProductionLadingOrderStatus::whereIn('ladingorder_status_id',[2,3])->get();
            return view('productions.form-edit-productionladingorder', compact('hd','dt','sta'));
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
        $hd = ProductionLadingOrderHd::where('ladingorder_hd_id',$id)
        ->leftjoin('ms_department','ladingorder_hd.ms_department_id','=','ms_department.ms_department_id')
        ->first();
        $dt = ProductionLadingOrderDt::where('ladingorder_hd_id', $id)
        ->where('ladingorder_dt_flag',true)
        ->get();  
        $sta = ProductionLadingOrderStatus::whereIn('ladingorder_status_id',[2,3])->get();
        return view('productions.form-edit-productionladingorder', compact('hd','dt','sta'));
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
        $hd = ProductionLadingOrderHd::where('ladingorder_hd_id',$id)->first();
        if($hd){
            try{
                DB::beginTransaction();
                foreach($request->ladingorder_dt_id as $key => $value){
                    $dt = ProductionLadingOrderDt::where('ladingorder_dt_id',$value)->update([
                    'approvedcheck' => true,
                    'approveddate' => Carbon::now(),
                    'approvedby' => Auth::user()->name,
                    ]);
                }
                $ck = ProductionLadingOrderDt::where('ladingorder_hd_id',$id)->where('approvedcheck', false)->first();
                if($ck){
                    $up = ProductionLadingOrderHd::where('ladingorder_hd_id',$id)->update([
                        'approved_by' => Auth::user()->name,
                        'approved_date' => Carbon::now(),
                        'approved_note' => $request->note,
                        'ladingorder_status_id' => 5
                    ]);
                }else{
                    $up = ProductionLadingOrderHd::where('ladingorder_hd_id',$id)->update([
                        'approved_by' => Auth::user()->name,
                        'approved_date' => Carbon::now(),
                        'approved_note' => $request->note,
                        'ladingorder_status_id' => 3
                    ]);
                }
                DB::commit();
                return redirect()->route('pd-ladi.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('pd-ladi.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    public function getDataLadi(Request $request)
    {
        $dt = DB::table('ladingorder_dt')
        ->where('ladingorder_hd_id', $request->refid)
        ->where('ladingorder_dt_flag',true)
        ->get(); 
        return response()->json(
            [
                'status' => true,
                'dt' => $dt,
            ]);
    }
}
