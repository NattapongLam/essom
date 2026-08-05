<?php

namespace App\Http\Controllers;

use App\Models\DocumentexternalDt;
use App\Models\DocumentexternalHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IsoDocumentexternal extends Controller
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
        $hd = DocumentexternalHd::where('documentexternal_hd_flag',true)->get();     
        return view('iso.form-document-external-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = DB::table('ms_year')->get();
        return view('iso.form-document-external-create',compact('hd'));
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
            'ms_year_name' => ['required'],
            'listno' => ['required'],
        ]);
        $data = [
            'ms_year_name' => $request->ms_year_name,
            'person_at' => Auth::user()->name,
            'documentexternal_hd_flag' => true,
            'created_at' => Carbon::now(),   
        ];
        try{
            DB::beginTransaction();
            $insertHD = DocumentexternalHd::create($data);
            foreach ($request->listno as $key => $value) {
                DocumentexternalDt::insert([
                    'documentexternal_hd_id' => $insertHD->documentexternal_hd_id,
                    'documentdestruction_dt_receive' => $request->documentdestruction_dt_receive[$key],
                    'documentdestruction_dt_sentfrom' => $request->documentdestruction_dt_sentfrom[$key],
                    'documentdestruction_dt_department' => $request->documentdestruction_dt_department[$key],
                    'documentdestruction_dt_subject' => $request->documentdestruction_dt_subject[$key],
                    'documentdestruction_dt_howtosend' => $request->documentdestruction_dt_howtosend[$key],
                    'documentdestruction_dt_until' => $request->documentdestruction_dt_until[$key],
                    'documentdestruction_dt_set' => $request->documentdestruction_dt_set[$key],
                    'documentdestruction_dt_recipient' => $request->documentdestruction_dt_recipient[$key],
                    'person_at' => Auth::user()->name,
                    'documentexternal_dt_flag' => true,
                    'created_at' => Carbon::now(),   
                ]);
            }
            DB::commit();
            return redirect()->route('document-external.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('document-external.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = DocumentexternalHd::where('documentexternal_hd_id',$id)->first();  
        $dt = DocumentexternalDt::where('documentexternal_dt_flag',true)
        ->where('documentexternal_hd_id',$id)
        ->get();
        $year = DB::table('ms_year')->get();
        return view('iso.form-document-external-edit',compact('hd','dt','year'));
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
    $request->validate([
        'listno' => ['required'],
        'ms_year_name' => ['required'],
    ]);

    try {
        DB::beginTransaction();

        // 1. อัปเดตข้อมูลส่วนหัว (Header)
        $hd = DocumentexternalHd::where('documentexternal_hd_id', $id)->firstOrFail();
        $hd->update([
            'ms_year_name' => $request->ms_year_name,
            // เพิ่มฟิลด์อื่นๆ ของ Header ตรงนี้ถ้ามี
        ]);

        // 2. วนลูปจัดการข้อมูลย่อย (Detail)
        if ($request->has('listno')) {
            foreach ($request->listno as $key => $value) {
                $dtId = $request->dt_id[$key] ?? null;

                $data = [
                    'documentexternal_hd_id' => $hd->documentexternal_hd_id,
                    'documentdestruction_dt_receive' => $request->documentdestruction_dt_receive[$key] ?? null,
                    'documentdestruction_dt_sentfrom' => $request->documentdestruction_dt_sentfrom[$key] ?? null,
                    'documentdestruction_dt_department' => $request->documentdestruction_dt_department[$key] ?? null,
                    'documentdestruction_dt_subject' => $request->documentdestruction_dt_subject[$key] ?? null,
                    'documentdestruction_dt_howtosend' => $request->documentdestruction_dt_howtosend[$key] ?? null,
                    'documentdestruction_dt_until' => $request->documentdestruction_dt_until[$key] ?? null,
                    'documentdestruction_dt_set' => $request->documentdestruction_dt_set[$key] ?? null,
                    'documentdestruction_dt_recipient' => $request->documentdestruction_dt_recipient[$key] ?? null,
                    'person_at' => Auth::user()->name,
                    'documentexternal_dt_flag' => true,
                ];

                if (!empty($dtId)) {
                    // ถ้ามี dt_id แสดงว่าเป็นข้อมูลเดิม ให้ทำการอัปเดต (Update)
                    DocumentexternalDt::where('documentexternal_dt_id', $dtId)->update($data);
                } else {
                    // ถ้าไม่มี dt_id แสดงว่าเป็นแถวที่เพิ่มใหม่ ให้บันทึกเพิ่มเข้าไป (Insert)
                    $data['created_at'] = Carbon::now();
                    DocumentexternalDt::create($data);
                }
            }
        }

        DB::commit();
        return redirect()->route('document-external.index')->with('success', 'อัปเดตข้อมูลสำเร็จ');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'บันทึกข้อมูลไม่สำเร็จ: ' . $e->getMessage())->withInput();
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

    public function cancelExternalHd(Request $request)
    {
        $hd = DocumentexternalHd::where('documentexternal_hd_id',$request->refid)->update([
            'documentexternal_hd_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }

    public function cancelExternalDt(Request $request)
    {
        $hd = DocumentexternalDt::where('documentexternal_dt_id',$request->refid)->update([
            'documentexternal_dt_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
