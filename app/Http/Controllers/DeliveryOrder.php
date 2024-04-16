<?php

namespace App\Http\Controllers;

use App\Models\EmployeeList;
use Illuminate\Http\Request;
use App\Models\DeliveryOrderDt;
use App\Models\DeliveryOrderHd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DeliveryOrder extends Controller
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
        $hd = DB::table('deliveryorder_hd')
        ->leftjoin('deliveryorder_status','deliveryorder_hd.deliveryorder_status_id','=','deliveryorder_status.deliveryorder_status_id')
        ->whereBetween('deliveryorder_hd.deliveryorder_hd_date',[$datestart,$dateend])
        ->get();
        return view('sales.form-open-deliveryorder',compact('hd','dateend','datestart'));
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
        $hd = DeliveryOrderHd::where('deliveryorder_hd_id',$id)->first();
        $dt = DeliveryOrderDt::where('deliveryorder_hd_id', $id)
        ->where('deliveryorder_dt_flag',true)
        ->get();  
        $emp = EmployeeList::get();
        return view('sales.form-edit-deliveryorder', compact('hd','dt','emp'));
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
        $hd = DeliveryOrderHd::where('deliveryorder_hd_id',$id)->first();
        if($hd){
            try{
            DB::beginTransaction();
            $up = DeliveryOrderHd::where('deliveryorder_hd_id',$id)->update([
                'updated_at' =>Carbon::now(),
                'checked_by' => $request->checked_by,
                'checked_date' => $request->checked_date,
                'delivery_by' => $request->delivery_by,
                'delivery_date' => $request->delivery_date,
                'deliveryorder_status_id' => 3              
            ]);
            foreach($request->deliveryorder_dt_id as $key => $value){
                $dt = DeliveryOrderDt::where('deliveryorder_dt_id',$value)->update([
                    'del_checke' => true,
                    'rec_checked' => $request->rec_checked[$key]
                ]);               
            }
            DB::commit();
                return redirect()->route('del-order.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('del-order.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    public function getDataDel(Request $request)
    {
        $dt = DB::table('deliveryorder_dt')
        ->where('deliveryorder_hd_id', $request->refid)
        ->where('deliveryorder_dt_flag',true)
        ->get(); 
        return response()->json(
            [
                'status' => true,
                'dt' => $dt,
            ]);
    }
}
