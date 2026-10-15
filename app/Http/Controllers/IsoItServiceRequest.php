<?php

namespace App\Http\Controllers;

use App\Models\ItserviceRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IsoItServiceRequest extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = ItserviceRequest::get();
        return view('iso.itservice-request-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emp = DB::table('ms_employee')->where('ms_employee_code',Auth::user()->code)->first();
        $dep = DB::table('ms_department')->where('ms_department_id',$emp->ms_department_id)->first();
        return view('iso.itservice-request-create', compact('emp','dep'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'objective_status' => $request->objective_status,
            'objective_remark' => $request->objective_remark,
            'itservice_requests_note' => $request->itservice_requests_note,
            'itservice_requests_person' => $request->itservice_requests_person,
            'itservice_requests_department' => $request->itservice_requests_department,
            'itservice_requests_date' => $request->itservice_requests_date,
            'docs_status' => 'N',
            'created_at' => Carbon::now(),
        ];
        try{
            DB::beginTransaction();
            $insertHD = ItserviceRequest::create($data);
            DB::commit();
            return redirect()->route('itservice-requests.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('itservice-requests.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = ItserviceRequest::find($id);
        return view('iso.itservice-request-update', compact('hd'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = ItserviceRequest::find($id);
        return view('iso.itservice-request-edit', compact('hd'));
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
        if ($request->checkdocs == "Edit"){
            $data = [
                'objective_status' => $request->objective_status,
                'objective_remark' => $request->objective_remark,
                'itservice_requests_note' => $request->itservice_requests_note,
                'itservice_requests_person' => $request->itservice_requests_person,
                'itservice_requests_department' => $request->itservice_requests_department,
                'itservice_requests_date' => $request->itservice_requests_date,
                'docs_status' => 'N',
                'updated_at' => Carbon::now(),
            ];
            try{
                DB::beginTransaction();
                $insertHD = ItserviceRequest::where('itservice_requests_id',$id)->update($data);
                DB::commit();
                return redirect()->route('itservice-requests.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('itservice-requests.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
            }
        }elseif($request->checkdocs == "Update"){
            $hd = ItserviceRequest::find($id);
            if($hd->docs_status == "N"){
                $data = [
                    'itservice_requests_causes' => $request->itservice_requests_causes,
                    'itservice_requests_correction' => $request->itservice_requests_correction,
                    'itservice_requests_other' => $request->itservice_requests_other,
                    'operator_at' => $request->operator_at,
                    'operator_date' => $request->operator_date,
                    'docs_status' => 'I',
                    'updated_at' => Carbon::now(),
                ];
                try{
                    DB::beginTransaction();
                    $insertHD = ItserviceRequest::where('itservice_requests_id',$id)->update($data);
                    DB::commit();
                    return redirect()->route('itservice-requests.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
                }catch(\Exception $e){
                    Log::error($e->getMessage());
                    dd($e->getMessage());
                    return redirect()->route('itservice-requests.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
                }
            }elseif($hd->docs_status == "I"){
                $data = [
                    'auditor_at' => $request->auditor_at,
                    'auditor_date' => $request->auditor_date,
                    'docs_status' => 'Y',
                    'updated_at' => Carbon::now(),
                ];
                try{
                    DB::beginTransaction();
                    $insertHD = ItserviceRequest::where('itservice_requests_id',$id)->update($data);
                    DB::commit();
                    return redirect()->route('itservice-requests.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
                }catch(\Exception $e){
                    Log::error($e->getMessage());
                    dd($e->getMessage());
                    return redirect()->route('itservice-requests.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
                }
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
    public function cancelItserviceRequests(Request $request)
    {
        $hd = ItserviceRequest::where('itservice_requests_id',$request->refid)->update([
            'docs_status' => 'C',
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
