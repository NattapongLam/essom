<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DetailedTesting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class IsoDetailedTesting extends Controller
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
        $hd = DetailedTesting::where('detailed_testings_flag',true)->get();   
        return view('iso.form-detailed-testing-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();   
        return view('iso.form-detailed-testing-create',compact('emp'));
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
            'detailed_testings_product' => ['required'],
            'detailed_testings_code' => ['required'],
            'tested_by' => ['required'],
        ]);
        $data =[
            'detailed_testings_product' => $request->detailed_testings_product,
            'detailed_testings_code' => $request->detailed_testings_code,
            'detailed_testings_serial' => $request->detailed_testings_serial,
            'tested_by' => $request->tested_by,
            'tested_date' => $request->tested_date,
            'detailed_testings_testdata' => $request->detailed_testings_testdata,
            'detailed_testings_data' => $request->detailed_testings_data,
            'detailed_testings_sample' => $request->detailed_testings_sample,
            'detailed_testings_drawn' => $request->detailed_testings_drawn,
            'detailed_testings_flag' => true,
            'created_at' => Carbon::now(),
            'person_at' =>  Auth::user()->name,    
        ];
        if ($request->hasFile('detailed_testings_file')) {
            $data['detailed_testings_file'] = $request->file('detailed_testings_file')->storeAs('img/detailedtestings', "IMG_" . carbon::now()->format('Ymdhis') . "_" . Str::random(5) . "." . $request->file('detailed_testings_file')->extension());
        }
        try
        {
            DB::beginTransaction();
            $insertHD = DetailedTesting::create($data);
            DB::commit();
            return redirect()->route('detailed-testing.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('detailed-testing.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = DetailedTesting::find($id); 
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();  
        return view('iso.form-detailed-testing-update',compact('hd','emp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd =  DetailedTesting::find($id);   
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();   
        return view('iso.form-detailed-testing-edit',compact('hd','emp'));
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
        if($request->docuref == "Edit"){
             $request->validate([
            'detailed_testings_product' => ['required'],
            'detailed_testings_code' => ['required'],
            'tested_by' => ['required'],
        ]);
        $data =[
            'detailed_testings_product' => $request->detailed_testings_product,
            'detailed_testings_code' => $request->detailed_testings_code,
            'detailed_testings_serial' => $request->detailed_testings_serial,
            'tested_by' => $request->tested_by,
            'tested_date' => $request->tested_date,
            'detailed_testings_testdata' => $request->detailed_testings_testdata,
            'detailed_testings_data' => $request->detailed_testings_data,
            'detailed_testings_sample' => $request->detailed_testings_sample,
            'detailed_testings_drawn' => $request->detailed_testings_drawn,
            'detailed_testings_flag' => true,
            'updated_at' => Carbon::now(),
            'person_at' =>  Auth::user()->name,    
        ];
        if ($request->hasFile('detailed_testings_file')) {
            $data['detailed_testings_file'] = $request->file('detailed_testings_file')->storeAs('img/detailedtestings', "IMG_" . carbon::now()->format('Ymdhis') . "_" . Str::random(5) . "." . $request->file('detailed_testings_file')->extension());
        }
        try
        {
            DB::beginTransaction();
            $insertHD = DetailedTesting::where('detailed_testings_id',$id)->update($data);
            DB::commit();
            return redirect()->route('detailed-testing.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('detailed-testing.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
        }
        }elseif($request->docuref == "Update"){
            $data = [
                'checked_by' => $request->checked_by,
                'checked_date' => $request->checked_date,
                'detailed_testings_comments' => $request->detailed_testings_comments,
                'signature_by' => $request->signature_by,
                'signature_date' => $request->signature_date
            ];
            try
            {
                DB::beginTransaction();
                $insertHD = DetailedTesting::where('detailed_testings_id',$id)->update($data);
                DB::commit();
                return redirect()->route('detailed-testing.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('detailed-testing.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    public function cancelTesting(Request $request)
    {
        $hd = DetailedTesting::where('detailed_testings_id',$request->refid)->update([
            'detailed_testings_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
