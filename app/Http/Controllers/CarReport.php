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
    public function index()
    {
        $hd = IsoCar::get();
        return view('iso.form-open-carlist',compact('hd'));
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
        $emp = EmployeeList::get();
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
        $emp = EmployeeList::get();
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
                    'updated_at' => Carbon::now()
                ]);
            }
            elseif($hd->iso_status_id == 6){
                $up = IsoCar::where('iso_car_id',$id)->update([ 
                    'iso_status_id' => 7,
                    'updated_at' => Carbon::now(),
                    'problem_date' => $request->problem_date,
                    'problem_add' => $request->problem_add,
                    'cause_remark' => $request->cause_remark,
                    'prevent_remark' => $request->prevent_remark,
                    'follow_remark' => $request->follow_remark,
                    'iso_car_duedate' => $request->iso_car_duedate,
                    'iso_car_by' => $request->iso_car_by,
                    'iso_car_bydate' => $request->iso_car_bydate
                ]);
            }
            elseif($hd->iso_status_id == 7){
                $up = IsoCar::where('iso_car_id',$id)->update([  
                    'iso_status_id' => 8,
                    'updated_at' => Carbon::now(),
                    'opinion_remark' => $request->opinion_remark,
                    'opinion_date' => Carbon::now(),
                    'opinion_by' => Auth::user()->name,
                ]);
            }
            elseif($hd->iso_status_id == 8){
                $up = IsoCar::where('iso_car_id',$id)->update([ 
                    'iso_status_id' => 9,
                    'updated_at' => Carbon::now(),
                    'followup_remark' => $request->followup_remark,
                    'iso_car_refdocuno' => $request->iso_car_refdocuno,
                    'close_by' => $request->close_by,
                    'close_date' => $request->close_date
                ]);
            }
            elseif($hd->iso_status_id == 9){
                $up = IsoCar::where('iso_car_id',$id)->update([ 
                    'iso_status_id' => 10,
                    'updated_at' => Carbon::now(),
                    'followup_by' => Carbon::now(),
                    'followup_date' => Auth::user()->name,
                ]);
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
}
