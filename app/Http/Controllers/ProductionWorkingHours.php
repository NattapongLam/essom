<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\EmployeeList;
use Illuminate\Http\Request;
use App\Models\DepartmentList;
use App\Models\WorkingHoursType;
use Illuminate\Support\Facades\DB;
use App\Models\ProductionOpenjobHd;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductionWorkingHoursDt;
use App\Models\ProductionWorkingHoursHd;

class ProductionWorkingHours extends Controller
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
        $hd = DB::table('workinghours_hd')
        ->leftjoin('workinghours_status','workinghours_hd.workinghours_status_id','=','workinghours_status.workinghours_status_id')
        ->leftjoin('ms_department','workinghours_hd.ms_department_id','=','ms_department.ms_department_id')
        ->select('workinghours_hd.*','ms_department.ms_department_name','workinghours_status.workinghours_status_name')
        ->where('workinghours_hd.workinghours_status_id','<>',2)
        ->whereBetween('workinghours_hd.workinghours_hd_date',[$datestart,$dateend])
        ->get();
        return view('productions.form-open-productionworkinghours',compact('hd','dateend','datestart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docs_last = DB::table('workinghours_hd')
        ->where('workinghours_hd_docuno', 'like', '%' . date('Ymd') . '%')
        ->orderBy('workinghours_hd_id', 'desc')->first();
        if ($docs_last) {
        $docs = 'MAN-' . date('Ymd').'-'. str_pad($docs_last->workinghours_hd_number + 1, 4, '0', STR_PAD_LEFT);
        $docs_number = $docs_last->workinghours_hd_number + 1;
        } else {
        $docs = 'MAN-' . date('Ymd').'-'. str_pad(1, 4, '0', STR_PAD_LEFT);
        $docs_number = 1;
        }
        $emp = DB::table('ms_employee')->where('ms_employee_code',Auth::user()->code)->first();
        $dep = DepartmentList::get();
        $typ = WorkingHoursType::get();
        $emps = DB::table('ms_employee')->get();
        $jobdoc = DB::table('vw_workinghours_job')->get();
        $lar = EmployeeList::where('ms_department_id',2)->get();
        $sm1 = EmployeeList::where('ms_department_id',3)->get();
        $sm2 = EmployeeList::where('ms_department_id',4)->get();
        $ele = EmployeeList::where('ms_department_id',5)->get();
        $mac = EmployeeList::where('ms_department_id',6)->get();
        $pai = EmployeeList::where('ms_department_id',7)->get();
        $ser = EmployeeList::where('ms_department_id',8)->get();
        $del = EmployeeList::where('ms_department_id',11)->get();
        $sto = EmployeeList::where('ms_department_id',12)->get();
        $des = EmployeeList::where('ms_department_id',14)->get();
        $eng = EmployeeList::where('ms_department_id',15)->get();    
        $job = DB::table('vw_jobmandaylistv1')->get(); 
        return view('productions.form-create-productionworkinghours',compact('docs', 'docs_number','dep','typ','jobdoc','lar','sm1','sm2','ele','mac','pai','ser','del','sto','des','eng','emp','job','emps'));
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
            'ms_employee_id' => ['required'],
        ]);
        $doc = DB::table('vw_workinghours_job')->where('productionopenjob_dt_id',$request->productionopenjob_dt_id)->first();
        $hd = [
            'workinghours_hd_date' => $request->workinghours_hd_date,
            'workinghours_hd_docuno' => $request->workinghours_hd_docuno,
            'workinghours_hd_number' => $request->workinghours_hd_number,
            'ms_department_id' => $request->ms_department_id,
            //'productionopenjob_hd_docuno' => $doc->productionopenjob_hd_docuno,
            'productionopenjob_dt_id' => 0,
            //'ms_product_name' => $doc->ms_product_name,
            //'ms_customer_name' => $doc->ms_customer_name,
            'workinghours_hd_remark' => $request->workinghours_hd_remark,
            'other_hours' => 0,
            'created_at' => Carbon::now(),
            'created_person' => Auth::user()->name,
            'workinghours_status_id' => 1,
            //'workinghours_hd_type' => $doc->types
        ];
        try{

            DB::beginTransaction();
            $insertHD = ProductionWorkingHoursHd::create($hd);
            foreach($request->job_id as $key => $value){               
                $emp = EmployeeList::where('ms_employee_id',$request->ms_employee_id)->first();
                if($emp){ 
                    $job = DB::table('vw_jobmandaylistv1')->where('id',$value)->first();  
                    if($job){
                        $dt[] = [
                            'workinghours_hd_id' => $insertHD->workinghours_hd_id,
                            'workinghours_dt_listno' => $key + 1,
                            'ms_employee_id' => $emp->ms_employee_id,
                            'ms_employee_code' => $emp->ms_employee_code,
                            'ms_employee_fullname' => $emp->ms_employee_fullname,
                            'workinghours_dt_hours' =>  $request->workinghours_dt_hours[$key] . "." . $request->workinghours_dt_time[$key],
                            'workinghours_dt_flag' => true,
                            'created_at' => $insertHD->created_at,
                            'created_person' => $insertHD->created_person,
                            'workinghours_status_id' => $insertHD->workinghours_status_id,
                            'workinghours_dt_other' =>  0,
                            'productionopenjob_hd_docuno' => $job->productionopenjob_hd_docuno,
                            'workinghours_type_name' => $job->workinghours_type_name
                        ];
                    }                                                        
                }                    
            }
            $insertDT = ProductionWorkingHoursDt::insert($dt);
            DB::commit();
            return redirect()->route('pd-woho.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('pd-woho.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $ck = ProductionWorkingHoursHd::where('workinghours_hd_docuno',$id)->first();
        $hd = ProductionWorkingHoursHd::where('workinghours_hd_id',$ck->workinghours_hd_id)
        ->leftjoin('ms_department','workinghours_hd.ms_department_id','=','ms_department.ms_department_id')
        ->first();
        $dt = ProductionWorkingHoursDt::where('workinghours_hd_id', $ck->workinghours_hd_id)
        ->where('workinghours_dt_flag',true)
        ->get();  
        $dep = DepartmentList::get();
        $typ = WorkingHoursType::get();
        $jobdoc = DB::table('vw_workinghours_job')->get();
        $emps = DB::table('ms_employee')->get();
        return view('productions.form-edit-productionworkinghours', compact('hd','dt','dep','typ','jobdoc','emps'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = ProductionWorkingHoursHd::where('workinghours_hd_id',$id)
        ->leftjoin('ms_department','workinghours_hd.ms_department_id','=','ms_department.ms_department_id')
        ->select('workinghours_hd.*','ms_department.ms_department_name')
        ->first();
        $dt = ProductionWorkingHoursDt::where('workinghours_hd_id', $id)
        ->where('workinghours_dt_flag',true)
        ->get();  
        $dep = DepartmentList::get();
        $typ = WorkingHoursType::get();
        $jobdoc = DB::table('vw_workinghours_job')->get();
        $emps = DB::table('ms_employee')->get();
        return view('productions.form-edit-productionworkinghours', compact('hd','dt','dep','typ','jobdoc','emps'));
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
        $hd = ProductionWorkingHoursHd::where('workinghours_hd_id',$id)->first();
        if($hd){
            try{
                DB::beginTransaction();
                $uphd = ProductionWorkingHoursHd::where('workinghours_hd_id',$id)->update([
                    'ms_department_id' => $request->ms_department_id,
                    'workinghours_hd_remark' => $request->workinghours_hd_remark,
                    'other_hours' => 0,
                    'updated_at' => Carbon::now(),
                    'created_person' => Auth::user()->name,
                ]);
                foreach($request->dt_id as $key => $value){
                    $updt = ProductionWorkingHoursDt::where('workinghours_dt_id',$value)->update([
                        'updated_at' => Carbon::now(),
                        'created_person' => Auth::user()->name,
                        'workinghours_dt_hours' => $request->dt_qty[$key],
                        'workinghours_dt_other' => 0
                    ]);
                }
                DB::commit();
                return redirect()->route('pd-woho.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('pd-woho.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    public function getDataWoho(Request $request)
    {
        $dt = DB::table('workinghours_dt')
        ->where('workinghours_hd_id', $request->refid)
        ->where('workinghours_dt_flag',true)
        ->get(); 
        return response()->json(
            [
                'status' => true,
                'dt' => $dt,
            ]);
    }
    public function getEmployee(Request $request)
    {
        $emp = DB::table('vw_jobmandaylistv1')->where('id',$request->id)->first();
        return response()->json([
            'emp' => $emp,
        ]);
    }
    public function cancelDocsMan(Request $request)
    {
        $hd = ProductionWorkingHoursHd::where('workinghours_hd_id',$request->refid)->update([
            'workinghours_status_id' => 2,
            'updated_at' => Carbon::now(),
            'created_person' => Auth::user()->name,
        ]);
        $dt = ProductionWorkingHoursDt::where('workinghours_hd_id',$request->refid)->update([
            'workinghours_status_id' => 2,
            'updated_at' => Carbon::now(),
            'created_person' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);     
    }
}
