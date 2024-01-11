<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DepartmentList;
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
            $datestart = date("Y-m-d",strtotime("-3 month",strtotime($dateend))); 
        } 
        $hd = DB::table('ladingorder_hd')
        ->leftjoin('ladingorder_status','ladingorder_hd.ladingorder_status_id','=','ladingorder_status.ladingorder_status_id')
        ->leftjoin('ms_department','ladingorder_hd.ms_department_id','=','ms_department.ms_department_id')
        ->select('ladingorder_hd.*','ladingorder_status.ladingorder_status_name','ms_department.ms_department_name')
        ->where('ladingorder_hd.ladingorder_status_id','<>',2)
        ->whereBetween('ladingorder_hd.ladingorder_hd_date',[$datestart,$dateend])
        ->orderBy('ladingorder_hd.ladingorder_status_id','asc')
        ->get();
        return view('productions.form-open-productionladingorder',compact('hd','dateend','datestart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docs_last = DB::table('ladingorder_hd')
        ->where('ladingorder_hd_docuno', 'like', '%' . date('Ymd') . '%')
        ->orderBy('ladingorder_hd_id', 'desc')->first();
        if ($docs_last) {
        $docs = 'ISS-' . date('Ymd').'-'. str_pad($docs_last->ladingorder_hd_number + 1, 4, '0', STR_PAD_LEFT);
        $docs_number = $docs_last->ladingorder_hd_number + 1;
        } else {
        $docs = 'ISS-' . date('Ymd').'-'. str_pad(1, 4, '0', STR_PAD_LEFT);
        $docs_number = 1;
        }
        $dep = DepartmentList::get();
        $jobdoc = DB::table('productionopenjob_hd')->where('productionopenjob_status_id',4)->get();
        $stc = DB::table('vw_ms_product1')->get();
        $emp = DB::table('ms_employee')->where('ms_employee_code',Auth::user()->code)->first();
        return view('productions.form-create-productionladingorder',compact('docs','docs_number','dep','jobdoc','stc','emp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ms_department_id' => ['required'],
            'productionopenjob_dt_id' => ['required'],
        ]);
        //$doc = DB::table('vw_ladingorder_job')->where('productionopenjob_dt_id',$request->productionopenjob_dt_id)->first();
        $hd = [
            'ladingorder_hd_date' => $request->ladingorder_hd_date,
            'ladingorder_hd_docuno' => $request->ladingorder_hd_docuno,
            'ladingorder_hd_number' => $request->ladingorder_hd_number,
            'ms_department_id' => $request->ms_department_id,
            'productionopenjob_hd_docuno' => $request->productionopenjob_hd_docuno,
            'productionopenjob_dt_id' => 0,
            //'ms_product_name' => $doc->ms_product_name,
            'ms_product_qty' => 0,
            //'productionnotice_dt_duedate' => $doc->productionnotice_dt_duedate,
            'ladingorder_hd_note' => $request->ladingorder_hd_note,
            'created_at' => Carbon::now(),
            'created_person' => Auth::user()->name,
            'ladingorder_status_id' => 1,
        ];
        try{

            DB::beginTransaction();
            $insertHD = ProductionLadingOrderHd::create($hd);
            foreach($request->pd_id as $key => $value){
                $pd = DB::table('vw_ms_product1')->where('id',$value)->first();
                if($pd){
                    $dt[] = [
                        'ladingorder_hd_id' => $insertHD->ladingorder_hd_id,
                        'ladingorder_dt_listno' => $key + 1,
                        'ladingorder_dt_issuedate' => $insertHD->ladingorder_hd_date,
                        'ms_product_id' => $pd->ms_product_id,
                        'ms_product_code' => trim($pd->ms_product_code),
                        'ms_product_name' =>  trim($pd->ms_product_name),
                        'ms_product_unit' => trim($pd->ms_productunit_name),
                        'ms_product_qty' => $request->pd_qty[$key],
                        'ms_product_price' => $pd->ms_producttype_price,
                        'created_at' => Carbon::now(),
                        'created_person' => Auth::user()->name,
                        'ladingorder_dt_flag' => true,
                        'ladingorder_status_id' => 1,
                        'ms_warehouse_name' => trim($pd->ms_warehouse_name),
                        'stcqty' => $pd->stcqty,
                        'returnqty' => 0,
                        'approvedcheck' => false
                    ];
                }
            }
            $insertDT = ProductionLadingOrderDt::insert($dt);
            DB::commit();
            return redirect()->route('pd-ladi.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('pd-ladi.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
        }
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
            ->select('ladingorder_hd.*','ms_department.ms_department_name')
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
        ->select('ladingorder_hd.*','ms_department.ms_department_name')
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
                $ck = ProductionLadingOrderDt::where('ladingorder_hd_id',$id)
                ->where('approvedcheck', false)
                ->where('ladingorder_dt_flag',true)
                ->first();
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
    public function getProduct(Request $request)
    {
        $pd = DB::table('vw_ms_product1')->where('id',$request->id)->first();
        return response()->json([
            'pd' => $pd,
        ]);
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
