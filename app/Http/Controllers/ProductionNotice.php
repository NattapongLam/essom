<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ProductionNoticeDt;
use App\Models\ProductionNoticeHd;
use App\Models\ProductionNoticeOp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductionNoticeStatus;

class ProductionNotice extends Controller
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
        $hd = DB::table('productionnotice_hd')
        ->leftjoin('ms_specpage','productionnotice_hd.ms_specpage_id','=','ms_specpage.ms_specpage_id')
        ->leftjoin('productionnotice_status','productionnotice_hd.productionnotice_status_id','=','productionnotice_status.productionnotice_status_id')
        ->where('productionnotice_hd.productionnotice_status_id','<>',2)
        ->orderBy('productionnotice_hd.productionnotice_status_id','asc')
        ->get();
        return view('productions.form-open-productionnotice',compact('hd'));
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
        $hd = ProductionNoticeHd::leftjoin('ms_specpage','productionnotice_hd.ms_specpage_id','=','ms_specpage.ms_specpage_id')
        ->where('productionnotice_hd.productionnotice_hd_id',$id)
        ->where('productionnotice_hd.productionnotice_status_id',1)
        ->first();
        $dt = ProductionNoticeDt::leftjoin('ms_specpage','productionnotice_dt.ms_specpage_id','=','ms_specpage.ms_specpage_id')
        ->where('productionnotice_dt.productionnotice_hd_id',$id)
        ->where('productionnotice_dt.productionnotice_dt_flag',true)
        
        ->get();
        $op = ProductionNoticeOp::where('productionnotice_hd_id',$id)
        ->where('productionnotice_op_flag',true)
        ->get();
        $sta = ProductionNoticeStatus::whereIn('productionnotice_status_id',[2,4,5])->get();
        return view('productions.form-edit-productionnotice', compact('hd','dt','sta','op'));
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
        try{
            DB::beginTransaction();
                $uphd = ProductionNoticeHd::where('productionnotice_hd_id',$id)->update([
                    'productionnotice_status_id' => $request->productionnotice_status_id,
                    'approved_by' => Auth::user()->name,
                    'approved_date' => Carbon::now(),
                    'approved_note' => $request->approved_note
                ]);
                $hd = ProductionNoticeHd::leftjoin('ms_specpage','productionnotice_hd.ms_specpage_id','=','ms_specpage.ms_specpage_id')
                ->where('productionnotice_hd.productionnotice_hd_id',$id)->first();
                $dt = ProductionNoticeDt::where('productionnotice_hd_id',$id)->get();
                foreach ($dt as $key => $value) {
                    $updt = ProductionNoticeDt::where('productionnotice_dt_id',$value->productionnotice_dt_id)->update([
                        'productionnotice_status_id' => $request->productionnotice_status_id
                    ]);
                }
            DB::commit();
            define('LINE_API', "https://notify-api.line.me/api/notify");
            $token = "bz5HNGdmNUwOZ4z44oxTsoi1iJ74RJqPmvyHAfTX3SS";
            $params = array(
            "message"  => "แจ้งเตือนเอกสารแจ้งผลิต"."\n"
            ."กำหนดส่ง : ".date("d-m-Y",strtotime($hd->productionnotice_hd_duedate))."\n"
            ."เลขที่ : ".$hd->productionnotice_hd_docuno."\n"
            ."ลูกค้า : ".str_replace(' ','',$hd->ms_customer_name)."\n"
            ."สินค้า : ".$hd->ms_product_name."\n"
            ."Spec Page : ".$hd->ms_specpage_name."\n"
            ."ผู้อนุมัติแจ้งผลิต : ".Auth::user()->name."\n",
            "stickerPkg"     => 446,
            "stickerId"      => 1988,
            );
            $res = $this->notify_message($params, $token);
            return redirect()->route('pd-noti.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('pd-noti.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    public function getData(Request $request)
    {
        $dt = DB::table('productionnotice_dt')
        ->leftjoin('ms_specpage','productionnotice_dt.ms_specpage_id','=','ms_specpage.ms_specpage_id')
        ->where('productionnotice_dt.productionnotice_hd_id', $request->refid)
        ->where('productionnotice_dt.productionnotice_dt_flag',true)
        ->get();   
        $op = DB::table('productionnotice_op')
        ->where('productionnotice_hd_id',$request->refid)     
        ->where('productionnotice_op_flag',true)  
        ->get();   
        return response()->json(
            [
                'status' => true,
                'dt' => $dt,
                'op' => $op
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
