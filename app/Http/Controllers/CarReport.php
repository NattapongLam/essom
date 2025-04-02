<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\IsoCar;
use Illuminate\Support\Str;
use App\Models\EmployeeList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class CarReport extends Controller
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
            $hd = IsoCar::leftjoin('iso_status','iso_car.iso_status_id','=','iso_status.iso_status_id')
            ->whereIN('iso_car.iso_status_id',[1,7,9])
            ->get();
        }else {
            $hd = IsoCar::leftjoin('iso_status','iso_car.iso_status_id','=','iso_status.iso_status_id')
            ->where('iso_car.iso_status_id','<>',5)
            ->whereBetween('iso_car.iso_car_date',[$datestart,$dateend])
            ->get();
        }    
        return view('iso.form-open-carlist',compact('hd','dateend','datestart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docs_last = DB::table('iso_car')
        ->where('iso_car_docuno', 'like', '%' . date('y') . '%')
        ->orderBy('iso_car_id', 'desc')->first();
        if ($docs_last) {
        $docs = date('y').'-'. str_pad($docs_last->iso_car_number + 1, 5, '0', STR_PAD_LEFT);
        $docs_number = $docs_last->iso_car_number + 1;
        } else {
        $docs = date('y').'-'. str_pad(1, 5, '0', STR_PAD_LEFT);
        $docs_number = 1;
        }
        $emp = EmployeeList::where('ms_employee_flag',true)
        ->leftjoin('ms_department','ms_employee.ms_department_id','=','ms_department.ms_department_id')       
        ->OrderBy('ms_employee.ms_employeegroup_id','asc')
        ->OrderBy('ms_department.ms_employee_listno','asc')
        ->get();
        return view('iso.form-create-car',compact('emp','docs','docs_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $docs_last = DB::table('iso_car')
        ->where('iso_car_docuno', 'like', '%' . date('y') . '%')
        ->orderBy('iso_car_id', 'desc')->first();
        if ($docs_last) {
        $docs = date('y').'-'. str_pad($docs_last->iso_car_number + 1, 5, '0', STR_PAD_LEFT);
        $docs_number = $docs_last->iso_car_number + 1;
        } else {
        $docs = date('y').'-'. str_pad(1, 5, '0', STR_PAD_LEFT);
        $docs_number = 1;
        }
        $request->validate([
            'iso_car_docuno' => ['required'],
            'iso_car_date' => ['required'],
        ]);
        if($request->iso_car_refertype1){
            $iso_car_refertype = 'คำร้องเรียนจากลูกค้า/บุคคลภายนอก';
        }elseif($request->iso_car_refertype2){
            $iso_car_refertype = 'รายงานความไม่สอดคล้องกับข้อกำหนด (NCR)';
        }elseif($request->iso_car_refertype3){
            $iso_car_refertype = 'การตรวจสอบภายใน';
        }elseif($request->iso_car_refertype4){
            $iso_car_refertype = 'อื่นๆ';
        }
        $hd = [
            'iso_car_refertype' => $iso_car_refertype,
            'iso_car_referremark' => $request->iso_car_referremark,
            'iso_car_refernumber' => $request->iso_car_refernumber,
            'iso_car_referdate' => $request->iso_car_referdate,
            'iso_car_docuno' => $docs,
            'iso_car_date' => $request->iso_car_date,
            'iso_car_number' => $docs_number,
            'problem_by' => $request->problem_by,
            'problem_to' => $request->problem_to,
            'consider_remark' => $request->consider_remark,
            'found_bugs' => $request->found_bugs,
            'characteristics' => $request->characteristics,
            'troublemaker_by' => $request->troublemaker_by,
            'troublemaker_date' => $request->troublemaker_date,
            'created_at' => Carbon::now(),
            'created_person' => Auth::user()->name,
            'iso_status_id' => 1
        ];
        try{

            DB::beginTransaction();
            $insertHD = IsoCar::create($hd);
            // define('LINE_API', "https://notify-api.line.me/api/notify");
            //     $token = "bz5HNGdmNUwOZ4z44oxTsoi1iJ74RJqPmvyHAfTX3SS";
            //     $params = array(
            //     "message"  => "แจ้งเตือนเปิดเอกสาร CAR"."\n"
            //     ."เลขที่ : ". $docs ."\n"
            //     ."ผู้เปิดเอกสาร : ".Auth::user()->name."\n"
            //     ."วันที่เปิดเอกสาร : ".Carbon::now()->format('d/m/Y')."\n",
            //     "stickerPkg"     => 446,
            //     "stickerId"      => 1988,
            //     );
            //     $res = $this->notify_message($params, $token);
            $token = "7689108238:AAHXaHiXRgM1PmAWh28Pjb5KQ4MApKCjhgM";  // 🔹 ใส่ Token ที่ได้จาก BotFather
            $chatId = "-4790813354";            // 🔹 ใส่ Chat ID ของกลุ่มหรือผู้ใช้
            $message = "📢 แจ้งเตือนเปิดเอกสาร CAR" . "\n"
                . "🔹 เลขที่ : ". $docs . "\n"
                . "📅 วันที่เปิดเอกสาร : " . Carbon::now()->format('d/m/Y') . "\n"
                . "👤 ผู้เปิดเอกสาร : " . Auth::user()->name . "\n";
    
            // เรียกใช้ฟังก์ชัน notifyTelegram() ภายใน Controller
            $this->notifyTelegram($message, $token, $chatId);
            DB::commit();
            return redirect()->route('car-report.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('car-report.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = IsoCar::where('iso_car_id',$id)->first();
        $emp = EmployeeList::where('ms_employee_flag',true)
        ->leftjoin('ms_employeegroup','ms_employee.ms_employeegroup_id','=','ms_employeegroup.ms_employeegroup_id')
        ->OrderBy('ms_employee.ms_employeegroup_id','asc')
        ->OrderBy('ms_employee.ms_employee_listno','asc')       
        ->get();
        return view('iso.form-edit-car',compact('hd','emp'));
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
        $hd = IsoCar::where('iso_car_id',$id)->first();
        try{
            DB::beginTransaction();
            if($hd->iso_status_id == 1){
                $up = IsoCar::where('iso_car_id',$id)->update([
                    'troublemaker_dateto' => Carbon::now(),
                    'troublemaker_byto' => Auth::user()->name,
                    'iso_status_id' => 6,
                    'updated_at' => Carbon::now(),
                    'problem_date' => $request->problem_date,
                    'problem_add' => $request->problem_add,
                    'problem_add1' => $request->problem_add1,
                    'problem_add2' => $request->problem_add2,
                ]);
                // define('LINE_API', "https://notify-api.line.me/api/notify");
                // $token = "bz5HNGdmNUwOZ4z44oxTsoi1iJ74RJqPmvyHAfTX3SS";
                // $params = array(
                // "message"  => "แจ้งเตือนกรรมการลงนามเปิดเอกสาร CAR"."\n"
                // ."เลขที่ : ".$hd->iso_car_docuno."\n"
                // ."วันที่กรรมการลงนามเปิดเอกสาร : ".Auth::user()->name."\n"
                // ."กรรมการลงนามเปิดเอกสาร : ".Carbon::now()->format('d/m/Y')."\n",
                // "stickerPkg"     => 446,
                // "stickerId"      => 1988,
                // );
                // $res = $this->notify_message($params, $token);
                $token = "7689108238:AAHXaHiXRgM1PmAWh28Pjb5KQ4MApKCjhgM";  // 🔹 ใส่ Token ที่ได้จาก BotFather
                $chatId = "-4790813354";            // 🔹 ใส่ Chat ID ของกลุ่มหรือผู้ใช้
                $message = "📢 แจ้งเตือนกรรมการลงนามเปิดเอกสาร CAR" . "\n"
                    . "🔹 เลขที่ : ". $hd->iso_car_docuno . "\n"
                    . "📅 วันที่กรรมการลงนามเปิดเอกสาร : " . Carbon::now()->format('d/m/Y') . "\n"
                    . "👤 กรรมการลงนามเปิดเอกสาร : " . Auth::user()->name . "\n";
        
                // เรียกใช้ฟังก์ชัน notifyTelegram() ภายใน Controller
                $this->notifyTelegram($message, $token, $chatId);
            }
            elseif($hd->iso_status_id == 6){
                $up = IsoCar::where('iso_car_id',$id)->update([ 
                    'iso_status_id' => 7,
                    'updated_at' => Carbon::now(),
                    'problem_date' => $request->problem_date,
                    'problem_add' => $request->problem_add,
                    'problem_add1' => $request->problem_add1,
                    'problem_add2' => $request->problem_add2,
                    'cause_remark' => $request->cause_remark,
                    'prevent_remark' => $request->prevent_remark,
                    'follow_remark' => $request->follow_remark,
                    'iso_car_duedate' => $request->iso_car_duedate,
                    'iso_car_by' => $request->iso_car_by,
                    'iso_car_bydate' => $request->iso_car_bydate
                ]);
                // define('LINE_API', "https://notify-api.line.me/api/notify");
                // $token = "bz5HNGdmNUwOZ4z44oxTsoi1iJ74RJqPmvyHAfTX3SS";
                // $params = array(
                // "message"  => "แจ้งเตือนบันทึกแก้ไข/ป้องกันเอกสาร CAR"."\n"
                // ."เลขที่ : ".$hd->iso_car_docuno."\n"
                // ."วันที่แก้ไข/ป้องกัน : ".Auth::user()->name."\n"
                // ."ผู้แก้ไข/ป้องกัน : ".Carbon::now()->format('d/m/Y')."\n",
                // "stickerPkg"     => 446,
                // "stickerId"      => 1988,
                // );
                // $res = $this->notify_message($params, $token);
                $token = "7689108238:AAHXaHiXRgM1PmAWh28Pjb5KQ4MApKCjhgM";  // 🔹 ใส่ Token ที่ได้จาก BotFather
                $chatId = "-4790813354";            // 🔹 ใส่ Chat ID ของกลุ่มหรือผู้ใช้
                $message = "📢 แจ้งเตือนบันทึกแก้ไข/ป้องกันเอกสาร CAR" . "\n"
                    . "🔹 เลขที่ : ". $hd->iso_car_docuno . "\n"
                    . "📅 วันที่แก้ไข/ป้องกัน : " . Carbon::now()->format('d/m/Y') . "\n"
                    . "👤 ผู้แก้ไข/ป้องกัน : " . Auth::user()->name . "\n";
        
                // เรียกใช้ฟังก์ชัน notifyTelegram() ภายใน Controller
                $this->notifyTelegram($message, $token, $chatId);
            }
            elseif($hd->iso_status_id == 7){
                $up = IsoCar::where('iso_car_id',$id)->update([  
                    'iso_status_id' => 8,
                    'updated_at' => Carbon::now(),
                    'opinion_remark' => $request->opinion_remark,
                    'opinion_date' => $request->opinion_date,
                    'opinion_by' => Auth::user()->name,
                ]);
                // define('LINE_API', "https://notify-api.line.me/api/notify");
                // $token = "bz5HNGdmNUwOZ4z44oxTsoi1iJ74RJqPmvyHAfTX3SS";
                // $params = array(
                // "message"  => "แจ้งเตือนกรรมการลงนามแก้ไข/ป้องกันเอกสาร CAR"."\n"
                // ."เลขที่ : ".$hd->iso_car_docuno."\n"
                // ."วันที่กรรมการลงนามแก้ไข/ป้องกัน : ".Auth::user()->name. " -"  .$request->opinion_remark."\n"
                // ."กรรมการลงนามแก้ไข/ป้องกัน : ".Carbon::now()->format('d/m/Y')."\n",
                // "stickerPkg"     => 446,
                // "stickerId"      => 1988,
                // );
                // $res = $this->notify_message($params, $token);
                $token = "7689108238:AAHXaHiXRgM1PmAWh28Pjb5KQ4MApKCjhgM";  // 🔹 ใส่ Token ที่ได้จาก BotFather
                $chatId = "-4790813354";            // 🔹 ใส่ Chat ID ของกลุ่มหรือผู้ใช้
                $message = "📢 แจ้งเตือนกรรมการลงนามแก้ไข/ป้องกันเอกสาร CAR" . "\n"
                    . "🔹 เลขที่ : ". $hd->iso_car_docuno . "\n"
                    . "📅 วันที่กรรมการลงนามแก้ไข/ป้องกัน : " . Carbon::now()->format('d/m/Y') . "\n"
                    . "👤 กรรมการลงนามแก้ไข/ป้องกัน : " . Auth::user()->name . "\n";
        
                // เรียกใช้ฟังก์ชัน notifyTelegram() ภายใน Controller
                $this->notifyTelegram($message, $token, $chatId);
            }
            elseif($hd->iso_status_id == 8){
                $up = IsoCar::where('iso_car_id',$id)->update([ 
                    'iso_status_id' => 9,
                    'updated_at' => Carbon::now(),
                    'followup_remark' => $request->followup_remark,
                    'iso_car_refdocuno' => $request->iso_car_refdocuno,
                    'close_by' => $request->close_by,
                    'close_date' => $request->close_date,
                    'followup_by' => $request->followup_by,
                    'followup_date' => $request->followup_date,
                ]);
                // define('LINE_API', "https://notify-api.line.me/api/notify");
                // $token = "bz5HNGdmNUwOZ4z44oxTsoi1iJ74RJqPmvyHAfTX3SS";
                // $params = array(
                // "message"  => "แจ้งเตือนปิดเอกสาร CAR"."\n"
                // ."เลขที่ : ".$hd->iso_car_docuno."\n"
                // ."วันที่ปิดเอกสาร : ".Auth::user()->name."\n"
                // ."ผู้ปิดเอกสาร : ".Carbon::now()->format('d/m/Y')."\n",
                // "stickerPkg"     => 446,
                // "stickerId"      => 1988,
                // );
                // $res = $this->notify_message($params, $token);
                $token = "7689108238:AAHXaHiXRgM1PmAWh28Pjb5KQ4MApKCjhgM";  // 🔹 ใส่ Token ที่ได้จาก BotFather
                $chatId = "-4790813354";            // 🔹 ใส่ Chat ID ของกลุ่มหรือผู้ใช้
                $message = "📢 แจ้งเตือนปิดเอกสาร CAR" . "\n"
                    . "🔹 เลขที่ : ". $hd->iso_car_docuno . "\n"
                    . "📅 วันที่ปิดเอกสาร : " . Carbon::now()->format('d/m/Y') . "\n"
                    . "👤 ผู้ปิดเอกสาร : " . Auth::user()->name . "\n";
        
                // เรียกใช้ฟังก์ชัน notifyTelegram() ภายใน Controller
                $this->notifyTelegram($message, $token, $chatId);
            }
            elseif($hd->iso_status_id == 9){
                $up = IsoCar::where('iso_car_id',$id)->update([ 
                    'iso_status_id' => 9,
                    'updated_at' => Carbon::now(),
                    'followup_by' => Auth::user()->name,
                    'followup_date' => Carbon::now(),
                ]);
                // define('LINE_API', "https://notify-api.line.me/api/notify");
                // $token = "bz5HNGdmNUwOZ4z44oxTsoi1iJ74RJqPmvyHAfTX3SS";
                // $params = array(
                // "message"  => "แจ้งเตือนกรรมการลงนามปิดเอกสาร CAR"."\n"
                // ."เลขที่ : ".$hd->iso_car_docuno."\n"
                // ."วันที่กรรมการลงนามปิดเอกสาร : ".Carbon::now()->format('d/m/Y')."\n"
                // ."กรรมการลงนามปิดเอกสาร : ".Auth::user()->name."\n",
                // "stickerPkg"     => 446,
                // "stickerId"      => 1988,
                // );
                // $res = $this->notify_message($params, $token);
                $token = "7689108238:AAHXaHiXRgM1PmAWh28Pjb5KQ4MApKCjhgM";  // 🔹 ใส่ Token ที่ได้จาก BotFather
                $chatId = "-4790813354";            // 🔹 ใส่ Chat ID ของกลุ่มหรือผู้ใช้
                $message = "📢 แจ้งเตือนกรรมการลงนามปิดเอกสาร CAR" . "\n"
                    . "🔹 เลขที่ : ". $hd->iso_car_docuno . "\n"
                    . "📅 วันที่กรรมการลงนามปิดเอกสาร : " . Carbon::now()->format('d/m/Y') . "\n"
                    . "👤 กรรมการลงนามปิดเอกสาร : " . Auth::user()->name . "\n";
        
                // เรียกใช้ฟังก์ชัน notifyTelegram() ภายใน Controller
                $this->notifyTelegram($message, $token, $chatId);
            }
            DB::commit();
            return redirect()->route('car-report.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('car-report.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    public function cancelDocsCar(Request $request)
    {
        $hd = DB::table('iso_car')->where('iso_car_id',$request->refid)->update([
            'iso_status_id' => 5,
            'updated_at' => Carbon::now(),
            'created_person' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
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