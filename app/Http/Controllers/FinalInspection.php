<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\FinalInspectionHd;
use App\Models\FinalInspectionDt1;
use App\Models\FinalInspectionDt2;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\FinalInspectionStatus;
use Illuminate\Support\Facades\Http;

class FinalInspection extends Controller
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
    private function notifyTelegram($message, $token, $chatId)
    {
        $queryData = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'HTML'
        ];
        $url = "https://api.telegram.org/bot{$token}/sendMessage";
        $response = file_get_contents($url . "?" . http_build_query($queryData));
        return json_decode($response);
    }
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
            $hd = DB::table('finalInspection_hd')
            ->leftjoin('finalInspection_status','finalInspection_hd.finalInspection_status_id','=','finalInspection_status.finalInspection_status_id')
            ->leftjoin('ms_finalspec_hd','finalInspection_hd.ms_finalspec_hd_id','=','ms_finalspec_hd.ms_finalspec_hd_id')
            ->where('finalInspection_hd.finalInspection_status_id',4)
            ->get();
        }else {
            $hd = DB::table('finalInspection_hd')
            ->leftjoin('finalInspection_status','finalInspection_hd.finalInspection_status_id','=','finalInspection_status.finalInspection_status_id')
            ->leftjoin('ms_finalspec_hd','finalInspection_hd.ms_finalspec_hd_id','=','ms_finalspec_hd.ms_finalspec_hd_id')
            ->whereBetween('finalInspection_hd.finalInspection_hd_date',[$datestart,$dateend])
            ->get();
        }
        return view('productions.form-open-finalinspection',compact('hd','dateend','datestart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = DB::table('productionopenjob_hd')
        //->where('productionopenjob_status_id',11)
        ->get();
        return view('productions.form-create-finalinspection',compact('hd'));
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
        $ck = FinalInspectionHd::where('finalInspection_hd_docuno',$id)->first();
        if($ck){
            $hd = FinalInspectionHd::where('finalInspection_hd_id',$ck->finalInspection_hd_id)       
            ->leftjoin('ms_finalspec_hd','finalInspection_hd.ms_finalspec_hd_id','=','ms_finalspec_hd.ms_finalspec_hd_id')
            ->select('finalInspection_hd.*','ms_finalspec_hd.ms_finalspec_hd_code')
            ->first();
            $dt1 = FinalInspectionDt1::where('finalInspection_hd_id',$ck->finalInspection_hd_id)
            ->where('finalInspection_dt1_flag',true)
            ->get();  
            $dt2 = FinalInspectionDt2::where('finalInspection_hd_id',$ck->finalInspection_hd_id)
            ->where('finalInspection_dt2_flag',true)
            ->get(); 
            $dt3 = DB::table('finalInspection_part')
            ->where('finalInspection_hd_id', $ck->finalInspection_hd_id)
            ->where('finalInspection_part_flag',true)
            ->get(); 
            $sta = FinalInspectionStatus::whereIn('finalInspection_status_id',[2,3,5])->get();
            return view('productions.form-edit-finalinspection', compact('hd','dt1','dt2','sta','dt3'));
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
        $hd = FinalInspectionHd::where('finalInspection_hd_id',$id)       
        ->leftjoin('ms_finalspec_hd','finalInspection_hd.ms_finalspec_hd_id','=','ms_finalspec_hd.ms_finalspec_hd_id')
        ->select('finalInspection_hd.*','ms_finalspec_hd.ms_finalspec_hd_code')
        ->first();
        $dt1 = FinalInspectionDt1::where('finalInspection_hd_id', $id)
        ->where('finalInspection_dt1_flag',true)
        ->get();  
        $dt2 = FinalInspectionDt2::where('finalInspection_hd_id', $id)
        ->where('finalInspection_dt2_flag',true)
        ->get(); 
        $dt3 = DB::table('finalInspection_part')
        ->where('finalInspection_hd_id', $id)
        ->where('finalInspection_part_flag',true)
        ->get(); 
        $sta = FinalInspectionStatus::whereIn('finalInspection_status_id',[2,3,5])->get();
        return view('productions.form-edit-finalinspection', compact('hd','dt1','dt2','sta','dt3'));
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
        $hd = FinalInspectionHd::where('finalInspection_hd_id',$id)->first();
        if($hd){
            try{
                DB::beginTransaction();
                $up = FinalInspectionHd::where('finalInspection_hd_id',$id)->update([
                    'finalInspection_status_id' => $request->finalInspection_status_id,
                    'approved_date' => Carbon::now(),
                    'approved_by' => Auth::user()->name,
                    'approved_note' => $request->note
                ]);
                DB::commit();
                $sta = DB::table('finalInspection_status')->where('finalInspection_status_id',$request->finalInspection_status_id)->first();
                // define('LINE_API', "https://notify-api.line.me/api/notify");
                // $token = "bz5HNGdmNUwOZ4z44oxTsoi1iJ74RJqPmvyHAfTX3SS";
                // $params = array(
                // "message"  => "แจ้งเตือนเอกสารตรวจสอบขั้นตอนสุดท้าย"."\n"
                // ."เลขที่ : ".$hd->productionopenjob_hd_docuno."\n"
                // ."ลูกค้า : ".str_replace(' ','',$hd->ms_customer_name)."\n"
                // ."สินค้า : ".$hd->ms_product_name."\n"
                // ."ผู้อนุมัติ : ".Auth::user()->name." สถานะ :" . $sta->finalInspection_status_name. " -"  .$request->note. "\n",
                // "stickerPkg"     => 446,
                // "stickerId"      => 1988,
                // );
                // $res = $this->notify_message($params, $token);
                $token = "7689108238:AAHXaHiXRgM1PmAWh28Pjb5KQ4MApKCjhgM";  // 🔹 ใส่ Token ที่ได้จาก BotFather
                $chatId = "-4790813354";            // 🔹 ใส่ Chat ID ของกลุ่มหรือผู้ใช้
                $message = "📢 แจ้งเตือนเอกสารตรวจสอบขั้นตอนสุดท้าย" . "\n"
                    . "🔹 เลขที่ : ". $hd->productionopenjob_hd_docuno . "\n"
                    . "📅 วันที่เริ่ม - จบ : " .date("d-m-Y",strtotime($hd->productionopenjob_hd_startdate))." - ".date("d-m-Y",strtotime($hd->productionopenjob_hd_enddate)). "\n"
                    . "👤 ผู้อนุมัติ : " .Auth::user()->name." สถานะ :" . $sta->finalInspection_status_name. " -"  .$request->note. "\n"
                    ."ลูกค้า : ".str_replace(' ','',$hd->ms_customer_name)."\n"
                    ."สินค้า : ".$hd->ms_product_name."\n";
        
                // เรียกใช้ฟังก์ชัน notifyTelegram() ภายใน Controller
                $this->notifyTelegram($message, $token, $chatId);
                return redirect()->route('fl-inst.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('fl-inst.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    public function getDataInst(Request $request)
    {
        $dt1 = DB::table('finalInspection_dt1')
        ->where('finalInspection_hd_id', $request->refid)
        ->where('finalInspection_dt1_flag',true)
        ->get(); 
        $dt2 = DB::table('finalInspection_dt2')
        ->where('finalInspection_hd_id', $request->refid)
        ->where('finalInspection_dt2_flag',true)
        ->get();
        $dt3 = DB::table('finalInspection_part')
        ->where('finalInspection_hd_id', $request->refid)
        ->where('finalInspection_part_flag',true)
        ->get(); 
        return response()->json(
        [
            'status' => true,
            'dt1' => $dt1,
            'dt2' => $dt2,
            'dt3' => $dt3
        ]);
    }

    // function notify_message($params, $token)
    // {
    //     $queryData = array(
    //         'message'          => $params["message"],
    //         'stickerPackageId' => $params["stickerPkg"],
    //         'stickerId'        => $params["stickerId"],
    //     );
    //     $queryData = http_build_query($queryData, '', '&');
    //     $headerOptions = array(
    //         'http' => array(
    //             'method'  => 'POST',
    //             'header'  => "Content-Type: application/x-www-form-urlencoded\r\n"
    //                 . "Authorization: Bearer " . $token . "\r\n"
    //                 . "Content-Length: " . strlen($queryData) . "\r\n",
    //             'content' => $queryData,
    //         ),
    //     );
    //     $context = stream_context_create($headerOptions);
    //     $result = file_get_contents(LINE_API, FALSE, $context);
    //     $res = json_decode($result);
    //     return $res;
    // }
}
