<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\IsoNcr;
use Illuminate\Support\Str;
use App\Models\EmployeeList;
use Illuminate\Http\Request;
use App\Models\DepartmentList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class NcrReport extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
            $hd = IsoNcr::leftjoin('iso_status','iso_ncr.iso_status_id','=','iso_status.iso_status_id')
            ->whereIN('iso_ncr.iso_status_id',[2])
            ->get();
        }else {
            $hd = IsoNcr::leftjoin('iso_status','iso_ncr.iso_status_id','=','iso_status.iso_status_id')
            ->where('iso_ncr.iso_status_id','<>',5)
            ->whereBetween('iso_ncr.reported_date',[$datestart,$dateend])
            ->get();
        }     
        return view('iso.form-open-ncrlist',compact('hd','dateend','datestart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docs_last = DB::table('iso_ncr')
        ->where('iso_ncr_docuno', 'like', '%' . date('y') . '%')
        ->orderBy('iso_ncr_id', 'desc')->first();
        if ($docs_last) {
        $docs = date('y').'-'. str_pad($docs_last->iso_ncr_number + 1, 5, '0', STR_PAD_LEFT);
        $docs_number = $docs_last->iso_ncr_number + 1;
        } else {
        $docs = date('y').'-'. str_pad(1, 5, '0', STR_PAD_LEFT);
        $docs_number = 1;
        }
        $emp = EmployeeList::where('ms_employee_flag',true)
        ->OrderBy('ms_employee.ms_employeegroup_id','asc')
        ->OrderBy('ms_employee.ms_employee_listno','asc')
        ->get();
        $dep = DepartmentList::get();
        return view('iso.form-create-ncr',compact('emp','dep','docs','docs_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $docs_last = DB::table('iso_ncr')
        ->where('iso_ncr_docuno', 'like', '%' . date('y') . '%')
        ->orderBy('iso_ncr_id', 'desc')->first();
        if ($docs_last) {
        $docs = date('y').'-'. str_pad($docs_last->iso_ncr_number + 1, 5, '0', STR_PAD_LEFT);
        $docs_number = $docs_last->iso_ncr_number + 1;
        } else {
        $docs = date('y').'-'. str_pad(1, 5, '0', STR_PAD_LEFT);
        $docs_number = 1;
        }
        $request->validate([
            'iso_ncr_docuno' => ['required'],
            'reported_date' => ['required'],
        ]);
        $hd = [
            'iso_ncr_observer' => $request->iso_ncr_observer,
            'iso_ncr_docuno' => $docs,
            'iso_ncr_jobnumber' => $request->iso_ncr_jobnumber,
            'iso_ncr_productname' => $request->iso_ncr_productname,
            'iso_ncr_productcode' => $request->iso_ncr_productcode,
            'iso_ncr_refer' => $request->iso_ncr_refer,
            'iso_ncr_nonconformity' => $request->iso_ncr_nonconformity,
            'offender_by' => $request->offender_by,
            'offender_job' => $request->offender_job,
            'reported_by' => $request->reported_by,
            'reported_job' => $request->reported_job,
            'reported_date' => $request->reported_date,
            'created_at' => Carbon::now(),
            'created_person' => Auth::user()->name,
            'iso_ncr_number' => $docs_number,
            'iso_status_id' => 1,
            'iso_ncr_department' => $request->iso_ncr_department,
            'iso_ncr_note' => $request->iso_ncr_note,
        ];
        try{

            DB::beginTransaction();
            $insertHD = IsoNcr::create($hd);
            // define('LINE_API', "https://notify-api.line.me/api/notify");
            //     $token = "bz5HNGdmNUwOZ4z44oxTsoi1iJ74RJqPmvyHAfTX3SS";
            //     $params = array(
            //     "message"  => "แจ้งเตือนเปิดเอกสาร NCR"."\n"
            //     ."เลขที่ : ". $docs ."\n"
            //     ."ผู้เปิดเอกสาร : ".Auth::user()->name."\n"
            //     ."วันที่เปิดเอกสาร : ".Carbon::now()->format('d/m/Y')."\n",
            //     "stickerPkg"     => 446,
            //     "stickerId"      => 1988,
            //     );
            //     $res = $this->notify_message($params, $token);
            $token = "7689108238:AAHXaHiXRgM1PmAWh28Pjb5KQ4MApKCjhgM";  // 🔹 ใส่ Token ที่ได้จาก BotFather
            $chatId = "-4790813354";            // 🔹 ใส่ Chat ID ของกลุ่มหรือผู้ใช้
            $message = "📢 แจ้งเตือนเปิดเอกสาร NCR" . "\n"
                . "🔹 เลขที่ : ". $docs . "\n"
                . "📅 วันที่เปิดเอกสาร : " . Carbon::now()->format('d/m/Y') . "\n"
                . "👤 ผู้เปิดเอกสาร : " . Auth::user()->name . "\n";
    
            // เรียกใช้ฟังก์ชัน notifyTelegram() ภายใน Controller
            $this->notifyTelegram($message, $token, $chatId);
            DB::commit();
            return redirect()->route('ncr-report.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('ncr-report.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = IsoNcr::where('iso_ncr_id',$id)->first();
        $emp = EmployeeList::where('ms_employee_flag',true)
        ->leftjoin('ms_department','ms_employee.ms_department_id','=','ms_department.ms_department_id')
        ->leftjoin('ms_employeegroup','ms_employee.ms_employeegroup_id','=','ms_employeegroup.ms_employeegroup_id')
        ->OrderBy('ms_employee.ms_employeegroup_id','asc')
        ->OrderBy('ms_employee.ms_employee_listno','asc')
        ->get();
        $dep = DepartmentList::get();
        return view('iso.form-edit-ncr',compact('hd','emp','dep'));
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
        $hd = IsoNcr::where('iso_ncr_id',$id)->first();
        try{

            DB::beginTransaction();
            if($hd->iso_status_id == 1){          
                if($request->iso_ncr_why){
                    $ck1 = 1;
                }  
                else{
                    $ck1 = 0;
                }
                if($request->iso_ncr_cause1){
                    $ck2 = 'ซ่อมแซม';
                }elseif($request->iso_ncr_cause2){
                    $ck2 = 'ใช้ตามสภาพ';
                }elseif($request->iso_ncr_cause3){
                    $ck2 = 'ทำลาย';
                }elseif($request->iso_ncr_cause4){
                    $ck2 = 'นำไปใช้งานอื่น';
                }
                $up = IsoNcr::where('iso_ncr_id',$id)->update([
                    'iso_ncr_why' => $ck1,
                    'iso_ncr_cause' => $ck2,
                    'iso_ncr_other' => $request->iso_ncr_other,
                    'offered_by' => $request->offered_by,
                    'offered_job' => $request->offered_job,
                    'offered_date' => $request->offered_date,
                    'iso_status_id' => 2,
                    'updated_at' => Carbon::now(),
                ]);
                // define('LINE_API', "https://notify-api.line.me/api/notify");
                // $token = "bz5HNGdmNUwOZ4z44oxTsoi1iJ74RJqPmvyHAfTX3SS";
                // $params = array(
                // "message"  => "แจ้งเตือนเสนอแนวทาง NCR"."\n"
                // ."เลขที่ : ". $hd->iso_ncr_docuno ."\n"
                // ."วันที่เสนอแนวทาง : ".Auth::user()->name."\n"
                // ."ผู้เสนอแนวทาง : ".Carbon::now()->format('d/m/Y')."\n",
                // "stickerPkg"     => 446,
                // "stickerId"      => 1988,
                // );
                // $res = $this->notify_message($params, $token);
                $token = "7689108238:AAHXaHiXRgM1PmAWh28Pjb5KQ4MApKCjhgM";  // 🔹 ใส่ Token ที่ได้จาก BotFather
                $chatId = "-4790813354";            // 🔹 ใส่ Chat ID ของกลุ่มหรือผู้ใช้
                $message = "📢 แจ้งเตือนเสนอแนวทาง NCR" . "\n"
                    . "🔹 เลขที่ : ". $hd->iso_ncr_docuno . "\n"
                    . "📅 วันที่เสนอแนวทาง : " . Carbon::now()->format('d/m/Y') . "\n"
                    . "👤 ผู้เสนอแนวทาง : " . Auth::user()->name . "\n";
        
                // เรียกใช้ฟังก์ชัน notifyTelegram() ภายใน Controller
                $this->notifyTelegram($message, $token, $chatId);
            }elseif ($hd->iso_status_id == 2) {
                if($request->approval_status1){
                    $ck1 = 'อนุมัติตามเสนอ';
                }elseif($request->approval_status2){
                    $ck1 = 'ไม่อนุมัติตามเสนอ';
                }
                $up = IsoNcr::where('iso_ncr_id',$id)->update([
                    'approval_status' => $ck1,
                    'approval_remark' => $request->approval_remark,
                    'iso_ncr_order' => $request->iso_ncr_order,
                    'customer_docuno' => $request->customer_docuno,
                    'customer_date' => $request->customer_date,
                    'approved_by' => $request->approved_by,
                    'approved_job' => $request->approved_job,
                    'approved_date' => $request->approved_date,
                    'iso_status_id' => 3,
                    'updated_at' => Carbon::now(),
                ]);
                // define('LINE_API', "https://notify-api.line.me/api/notify");
                // $token = "bz5HNGdmNUwOZ4z44oxTsoi1iJ74RJqPmvyHAfTX3SS";
                // $params = array(
                // "message"  => "แจ้งเตือนอนุมัติ NCR"."\n"
                // ."เลขที่ : ". $hd->iso_ncr_docuno ."\n"
                // ."วันที่อนุมัติ : ".Auth::user()->name. " -"  .$request->approval_remark."\n"
                // ."ผู้อนุมัติ : ".Carbon::now()->format('d/m/Y')."\n",
                // "stickerPkg"     => 446,
                // "stickerId"      => 1988,
                // );
                // $res = $this->notify_message($params, $token);
                $token = "7689108238:AAHXaHiXRgM1PmAWh28Pjb5KQ4MApKCjhgM";  // 🔹 ใส่ Token ที่ได้จาก BotFather
                $chatId = "-4790813354";            // 🔹 ใส่ Chat ID ของกลุ่มหรือผู้ใช้
                $message = "📢 แจ้งเตือนอนุมัติ NCR" . "\n"
                    . "🔹 เลขที่ : ". $hd->iso_ncr_docuno . "\n"
                    . "📅 วันที่อนุมัติ : " . Carbon::now()->format('d/m/Y') . "\n"
                    . "👤 ผู้อนุมัติ : " . Auth::user()->name . "\n";
        
                // เรียกใช้ฟังก์ชัน notifyTelegram() ภายใน Controller
                $this->notifyTelegram($message, $token, $chatId);
            }elseif ($hd->iso_status_id == 3) {
                $up = IsoNcr::where('iso_ncr_id',$id)->update([
                    'iso_ncr_remark' => $request->iso_ncr_remark,
                    'checked_by' => $request->checked_by,
                    'checked_date' => $request->checked_date,
                    'checked_job' => $request->checked_job,
                    'iso_status_id' => 4,
                    'updated_at' => Carbon::now(),
                ]);
                // define('LINE_API', "https://notify-api.line.me/api/notify");
                // $token = "bz5HNGdmNUwOZ4z44oxTsoi1iJ74RJqPmvyHAfTX3SS";
                // $params = array(
                // "message"  => "แจ้งเตือนตรวจสอบ NCR"."\n"
                // ."เลขที่ : ". $hd->iso_ncr_docuno ."\n"
                // ."วันที่ตรวจสอบ : ".Auth::user()->name."\n"
                // ."ผู้ตรวจสอบ : ".Carbon::now()->format('d/m/Y')."\n",
                // "stickerPkg"     => 446,
                // "stickerId"      => 1988,
                // );
                // $res = $this->notify_message($params, $token);
                $token = "7689108238:AAHXaHiXRgM1PmAWh28Pjb5KQ4MApKCjhgM";  // 🔹 ใส่ Token ที่ได้จาก BotFather
                $chatId = "-4790813354";            // 🔹 ใส่ Chat ID ของกลุ่มหรือผู้ใช้
                $message = "📢 แจ้งเตือนตรวจสอบ NCR" . "\n"
                    . "🔹 เลขที่ : ". $hd->iso_ncr_docuno . "\n"
                    . "📅 วันที่ตรวจสอบ : " . Carbon::now()->format('d/m/Y') . "\n"
                    . "👤 ผู้ตรวจสอบ : " . Auth::user()->name . "\n";
        
                // เรียกใช้ฟังก์ชัน notifyTelegram() ภายใน Controller
                $this->notifyTelegram($message, $token, $chatId);
            }
            DB::commit();
            return redirect()->route('ncr-report.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('ncr-report.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    public function cancelDocsNcr(Request $request)
    {
        $hd = DB::table('iso_ncr')->where('iso_ncr_id',$request->refid)->update([
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
