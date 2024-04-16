<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductionWorkOrderDt;
use App\Models\ProductionWorkOrderHd;
use App\Models\ProductionWorkOrderCheck;
use App\Models\ProductionWorkOrderStatus;

class ProductionWorkOrder extends Controller
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
        $hd = DB::table('workorder_hd')
        ->leftjoin('workorder_status','workorder_hd.workorder_status_id','=','workorder_status.workorder_status_id')
        ->where('workorder_hd.workorder_status_id','<>',2)
        ->whereBetween('workorder_hd.workorder_hd_date',[$datestart,$dateend])
        ->orderBy('workorder_hd.workorder_status_id','asc')
        ->get();
        return view('productions.form-open-productionworkorder',compact('hd','dateend','datestart'));
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
        $cks = ProductionWorkOrderHd::where('workorder_hd_docuno',$id)->first();
        if($cks){
            $hd = ProductionWorkOrderHd::where('workorder_hd_id',$cks->workorder_hd_id)
            ->leftjoin('ms_department','workorder_hd.ms_department_id','=','ms_department.ms_department_id')
            ->first();
            $dt = ProductionWorkOrderDt::where('workorder_hd_id', $cks->workorder_hd_id)
            ->where('workorder_dt_flag',true)
            ->get();  
            if ($hd->workorder_status_id == 1) {
                $sta = ProductionWorkOrderStatus::whereIn('workorder_status_id',[2,3])->get();
            } else if ($hd->workorder_status_id == 3){
                $sta = ProductionWorkOrderStatus::whereIn('workorder_status_id',[2,4])->get();
            }
            else{
                $sta = ProductionWorkOrderStatus::whereIn('workorder_status_id',[7])->get();
            }
            $total = ProductionWorkOrderDt::where('workorder_hd_id',$cks->workorder_hd_id)       
            ->where('workorder_dt_flag',true)
            ->sum('workorder_dt_total');
            $ck = ProductionWorkOrderCheck::where('workorder_hd_id', $cks->workorder_hd_id)    
            ->first();
            return view('productions.form-edit-productionworkorder', compact('hd','dt','sta','total','ck'));
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
        $hd = ProductionWorkOrderHd::where('workorder_hd_id',$id)
        ->leftjoin('ms_department','workorder_hd.ms_department_id','=','ms_department.ms_department_id')
        ->select('workorder_hd.*','ms_department.ms_department_name')
        ->first();
        $dt = ProductionWorkOrderDt::where('workorder_hd_id', $id)
        ->where('workorder_dt_flag',true)
        ->get();  
        if ($hd->workorder_status_id == 1) {
            $sta = ProductionWorkOrderStatus::whereIn('workorder_status_id',[2,3])->get();
        } else if ($hd->workorder_status_id == 3){
            $sta = ProductionWorkOrderStatus::whereIn('workorder_status_id',[2,4])->get();
        }
        else{
            $sta = ProductionWorkOrderStatus::whereIn('workorder_status_id',[7])->get();
        }
        $total = ProductionWorkOrderDt::where('workorder_hd_id', $id)       
        ->where('workorder_dt_flag',true)
        ->sum('workorder_dt_total');
        $ck = ProductionWorkOrderCheck::where('workorder_hd_id', $id)    
        ->first();
        return view('productions.form-edit-productionworkorder', compact('hd','dt','sta','total','ck'));
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
        $hd = ProductionWorkOrderHd::where('workorder_hd_id',$id)->first();
        if($hd->workorder_status_id == 1){
            try{
                DB::beginTransaction();
                    $uphd = ProductionWorkOrderHd::where('workorder_hd_id',$id)->update([
                        'workorder_status_id' => $request->workorder_status_id,
                        'checked_by' => Auth::user()->name,
                        'checked_date' => Carbon::now(),
                        'checked_note' => $request->note
                    ]);              
                    $dt = ProductionWorkOrderDt::where('workorder_hd_id',$id)->get();
                    foreach ($dt as $key => $value) {
                        $updt = ProductionWorkOrderDt::where('workorder_dt_id',$value->workorder_dt_id)->update([
                            'workorder_status_id' => $request->workorder_status_id
                        ]);
                    }
                DB::commit();
                return redirect()->route('pd-work.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('pd-work.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
            }
        }else if($hd->workorder_status_id == 3){
            try{
                DB::beginTransaction();
                    $uphd = ProductionWorkOrderHd::where('workorder_hd_id',$id)->update([
                        'workorder_status_id' => $request->workorder_status_id,
                        'approved_by' => Auth::user()->name,
                        'approved_date' => Carbon::now(),
                        'approved_note' => $request->note
                    ]);              
                    $dt = ProductionWorkOrderDt::where('workorder_hd_id',$id)->get();
                    foreach ($dt as $key => $value) {
                        $updt = ProductionWorkOrderDt::where('workorder_dt_id',$value->workorder_dt_id)->update([
                            'workorder_status_id' => $request->workorder_status_id
                        ]);
                    }
                DB::commit();
                return redirect()->route('pd-work.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('pd-work.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
            }
        }else{
            try{
                DB::beginTransaction();
                    $uphd = ProductionWorkOrderHd::where('workorder_hd_id',$id)->update([
                        'workorder_status_id' => $request->workorder_status_id,                       
                    ]);  
                    $upck = ProductionWorkOrderCheck::where('workorder_hd_id',$id)->update([
                        'approved_by' => Auth::user()->name,
                        'approved_date' => Carbon::now(),
                        'approved_note' => $request->note
                    ]);       
                DB::commit();
                return redirect()->route('pd-work.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('pd-work.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    public function getDataWork(Request $request)
    {
        $dt = DB::table('workorder_dt')
        ->where('workorder_hd_id', $request->refid)
        ->where('workorder_dt_flag',true)
        ->get(); 
        return response()->json(
            [
                'status' => true,
                'dt' => $dt,
            ]);
    }
}
