<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductionReturnOrderDt;
use App\Models\ProductionReturnOrderHd;
use App\Models\ProductionReturnOrderStatus;

class ProductionReturnOrder extends Controller
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
    public function index(Request $request)
    {
        if($request->dateend){
            $dateend = $request->dateend;
        }
        else{
            $dateend = date("Y-m-d");
        }
        if($request->datestart){
            $datestart = $request->datestart;
        }
        else{
            $datestart = date("Y-m-d",strtotime("-6 month",strtotime($dateend))); 
        } 
        $hd = DB::table('returnorder_hd')
        ->leftjoin('returnorder_status','returnorder_hd.returnorder_status_id','=','returnorder_status.returnorder_status_id')
        ->whereBetween('returnorder_hd.returnorder_hd_date',[$datestart,$dateend])
        ->get();
        return view('productions.form-open-productionreturnorder',compact('hd','dateend','datestart'));
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
        $ck = ProductionReturnOrderHd::where('returnorder_hd_docuno',$id)->first();
        if($ck){
            $hd = ProductionReturnOrderHd::where('returnorder_hd_id', $ck->returnorder_hd_id)->first();
            $dt = ProductionReturnOrderDt::where('returnorder_hd_id', $ck->returnorder_hd_id)
            ->where('returnorder_dt_flag',true)
            ->get();  
            $sta = ProductionReturnOrderStatus::whereIn('returnorder_status_id',[2,3])->get();
            return view('productions.form-edit-productionreturnorder', compact('hd','dt','sta'));
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
        $hd = ProductionReturnOrderHd::where('returnorder_hd_id',$id)->first();
        $dt = ProductionReturnOrderDt::where('returnorder_hd_id', $id)
        ->where('returnorder_dt_flag',true)
        ->get();  
        $sta = ProductionReturnOrderStatus::whereIn('returnorder_status_id',[2,3])->get();
        return view('productions.form-edit-productionreturnorder', compact('hd','dt','sta'));
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
        $hd = ProductionReturnOrderHd::where('returnorder_hd_id',$id)->first();
        if($hd){
            try{
                DB::beginTransaction();
                $up = ProductionReturnOrderHd::where('returnorder_hd_id',$id)->update([
                    'returnorder_status_id' => $request->returnorder_status_id,
                    'approved_date' => Carbon::now(),
                    'approved_by' => Auth::user()->name,
                    'approved_note' => $request->note
                ]);               
                $dt = ProductionReturnOrderDt::where('returnorder_hd_id',$id)->get();
                foreach($dt as $key => $value){
                    $updt = ProductionRequestOrderDt::where('requestorder_dt_id',$value->requestorder_dt_id)->update([
                    'returnorder_status_id' => $request->requestorder_status_id,
                    ]);
                }             
                DB::commit();
                return redirect()->route('pd-retu.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('pd-retu.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    public function getDataRetu(Request $request)
    {
        $dt = DB::table('returnorder_dt')
        ->where('returnorder_hd_id', $request->refid)
        ->where('returnorder_dt_flag',true)
        ->get(); 
        return response()->json(
            [
                'status' => true,
                'dt' => $dt,
            ]);
    }
}
