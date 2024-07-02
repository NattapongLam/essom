<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ProductionNoticeOp;
use Illuminate\Support\Facades\DB;
use App\Models\ProductionOpenjobDt;
use App\Models\ProductionOpenjobHd;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductionOpenjobStatus;

class ProductionOpen extends Controller
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
        if($request->ck_sta){
            $hd = DB::table('productionopenjob_hd')
            ->leftjoin('productionopenjob_status','productionopenjob_hd.productionopenjob_status_id','=','productionopenjob_status.productionopenjob_status_id')
            ->whereIn('productionopenjob_hd.productionopenjob_status_id',[3])
            ->orderBy('productionopenjob_hd.productionopenjob_status_id','asc')
            ->get();
        }
        else {
            $hd = DB::table('productionopenjob_hd')
            ->leftjoin('productionopenjob_status','productionopenjob_hd.productionopenjob_status_id','=','productionopenjob_status.productionopenjob_status_id')
            ->whereIn('productionopenjob_hd.productionopenjob_status_id',[1,3,4,5,11,12])
            ->whereBetween('productionopenjob_hd.productionopenjob_hd_date',[$datestart,$dateend])
            ->orderBy('productionopenjob_hd.productionopenjob_status_id','asc')
            ->get();
        }
        return view('productions.form-open-productionopenjob',compact('hd','dateend','datestart'));
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
        $hd = ProductionOpenjobHd::leftjoin('productionopenjob_status','productionopenjob_hd.productionopenjob_status_id','=','productionopenjob_status.productionopenjob_status_id')
        ->where('productionopenjob_hd_id',$id)       
        ->first();
        $dt = ProductionOpenjobDt::leftjoin('productionopenjob_status','productionopenjob_dt.productionopenjob_status_id','=','productionopenjob_status.productionopenjob_status_id')
        ->leftjoin('ms_department','productionopenjob_dt.ms_department_id','=','ms_department.ms_department_id')       
        ->where('productionopenjob_dt.productionopenjob_hd_id', $id)
        ->where('productionopenjob_dt.productionopenjob_dt_flag',true)
        ->orderBy('productionopenjob_dt.productionopenjob_dt_listno','ASC')
        ->get();  
        if ($hd->productionopenjob_status_id == 1) {
            $sta = ProductionOpenjobStatus::whereIn('productionopenjob_status_id',[2,3,5])->get();
        } else {
            $sta = ProductionOpenjobStatus::whereIn('productionopenjob_status_id',[2,4,5])->get();
        }
        $op = ProductionNoticeOp::leftjoin('productionnotice_hd','productionnotice_op.productionnotice_hd_id','=','productionnotice_hd.productionnotice_hd_id')
        ->where('productionnotice_hd.productionnotice_hd_docuno',$hd->productionnotice_hd_docuno)
        ->where('productionnotice_op.productionnotice_op_flag',true)
        ->where('productionnotice_op.productionnotice_op_main',$hd->ms_product_code)
        ->get();
        $total = ProductionOpenjobDt::where('productionopenjob_hd_id', $id)
        ->where('productionopenjob_dt_flag',true)
        ->sum('estimatecost');
        return view('productions.form-edit-productionopenjob', compact('hd','dt','sta','op','total'));
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
        $hd = ProductionOpenjobHd::where('productionopenjob_hd_id',$id)->first();
        if($hd->productionopenjob_status_id == 1){           
            try{
                DB::beginTransaction();
                    $uphd = ProductionOpenjobHd::where('productionopenjob_hd_id',$id)->update([
                        'productionopenjob_status_id' => $request->productionopenjob_status_id,
                        'checked_by' => Auth::user()->name,
                        'checked_date' => Carbon::now(),
                        'checked_note' => $request->note
                    ]);              
                    $dt = ProductionOpenjobDt::where('productionopenjob_hd_id',$id)->get();
                    foreach ($dt as $key => $value) {
                        $updt = ProductionOpenjobDt::where('productionopenjob_dt_id',$value->productionopenjob_dt_id)->update([
                            'productionopenjob_status_id' => $request->productionopenjob_status_id,
                        ]);
                    }
                DB::commit();
                $sta = DB::table('productionopenjob_status')->where('productionopenjob_status_id',$request->productionopenjob_status_id)->first();
                define('LINE_API', "https://notify-api.line.me/api/notify");
                $token = "bz5HNGdmNUwOZ4z44oxTsoi1iJ74RJqPmvyHAfTX3SS";
                $params = array(
                "message"  => "แจ้งเตือนเอกสารเปิดงาน"."\n"
                ."วันที่เริ่ม - จบ : ".$hd->productionopenjob_hd_startdate." - ".$hd->productionopenjob_hd_enddate."\n"
                ."เลขที่ : ".$hd->productionopenjob_hd_docuno."\n"
                ."ลูกค้า : ".str_replace(' ','',$hd->ms_customer_name)."\n"
                ."สินค้า : ".$hd->ms_product_name."\n"
                ."Spec Page : ".$hd->ms_specpage_name."\n"
                ."ประมาณการต้นทุน : ".$hd->productionopenjob_estimatecost."\n"
                ."ผู้ตรวจสอบ : ".Auth::user()->name. " สถานะ :" . $sta->productionopenjob_status_name ."\n"
                ."หมายเหตุ : ".$request->note."\n",
                "stickerPkg"     => 446,
                "stickerId"      => 1988,
                );
                $res = $this->notify_message($params, $token);
                return redirect()->route('pd-open.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('pd-open.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
            }
        }
        else if($hd->productionopenjob_status_id == 3 || $hd->productionopenjob_status_id == 5){
            try{
                DB::beginTransaction();
                    $uphd = ProductionOpenjobHd::where('productionopenjob_hd_id',$id)->update([
                        'productionopenjob_status_id' => $request->productionopenjob_status_id,
                        'approved_by' => Auth::user()->name,
                        'approved_date' => Carbon::now(),
                        'approved_note' => $request->note
                    ]);              
                    $dt = ProductionOpenjobDt::where('productionopenjob_hd_id',$id)->get();
                    foreach ($dt as $key => $value) {
                        $updt = ProductionOpenjobDt::where('productionopenjob_dt_id',$value->productionopenjob_dt_id)->update([
                            'productionopenjob_status_id' =>$request->productionopenjob_status_id,
                        ]);
                    }
                DB::commit();
                $sta = DB::table('productionopenjob_status')->where('productionopenjob_status_id',$request->productionopenjob_status_id)->first();
                define('LINE_API', "https://notify-api.line.me/api/notify");
                $token = "bz5HNGdmNUwOZ4z44oxTsoi1iJ74RJqPmvyHAfTX3SS";
                $params = array(
                "message"  => "แจ้งเตือนเอกสารเปิดงาน"."\n"
                ."วันที่เริ่ม - จบ : ".date("d-m-Y",strtotime($hd->productionopenjob_hd_startdate))." - ".date("d-m-Y",strtotime($hd->productionopenjob_hd_enddate))."\n"
                ."เลขที่ : ".$hd->productionopenjob_hd_docuno."\n"
                ."ลูกค้า : ".str_replace(' ','',$hd->ms_customer_name)."\n"
                ."สินค้า : ".$hd->ms_product_name."\n"
                ."Spec Page : ".$hd->ms_specpage_name."\n"
                ."ประมาณการต้นทุน : ".$hd->productionopenjob_estimatecost."\n"
                ."ผู้อนุมัติ : ".Auth::user()->name." สถานะ :" . $sta->productionopenjob_status_name. "\n"
                ."หมายเหตุ : ".$request->note."\n",
                "stickerPkg"     => 446,
                "stickerId"      => 1988,
                );
                $res = $this->notify_message($params, $token);
                return redirect()->route('pd-open.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('pd-open.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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

    public function getDataOpen(Request $request)
    {
        $dt = DB::table('productionopenjob_dt')
        ->leftjoin('productionopenjob_status','productionopenjob_dt.productionopenjob_status_id','=','productionopenjob_status.productionopenjob_status_id')
        ->leftjoin('ms_department','productionopenjob_dt.ms_department_id','=','ms_department.ms_department_id')
        ->where('productionopenjob_dt.productionopenjob_hd_id', $request->refid)
        ->where('productionopenjob_dt.productionopenjob_dt_flag',true)
        ->orderBy('productionopenjob_dt.productionopenjob_dt_listno','ASC')
        ->get(); 
        return response()->json(
            [
                'status' => true,
                'dt' => $dt,

            ]);
    }

    function notify_message($params, $token)
    {
        $queryData = array(
            'message'          => $params["message"],
            'stickerPackageId' => $params["stickerPkg"],
            'stickerId'        => $params["stickerId"],
        );
        $queryData = http_build_query($queryData, '', '&');
        $headerOptions = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => "Content-Type: application/x-www-form-urlencoded\r\n"
                    . "Authorization: Bearer " . $token . "\r\n"
                    . "Content-Length: " . strlen($queryData) . "\r\n",
                'content' => $queryData,
            ),
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents(LINE_API, FALSE, $context);
        $res = json_decode($result);
        return $res;
    }
}
