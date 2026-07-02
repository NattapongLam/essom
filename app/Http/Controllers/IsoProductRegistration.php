<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductRegistrationDt;
use App\Models\ProductRegistrationHd;

class IsoProductRegistration extends Controller
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
        $hd = ProductRegistrationHd::where('product_registration_hd_flag',true)->get();      
        return view('iso.form-product-registration-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;      
        return view('iso.form-product-registration-create',compact('hd'));
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
            'product_registration_hd_name' => ['required'],
            'product_registration_dt_listno' => ['required'],
            'product_registration_dt_dwgno' => ['required'],
        ]);
        $data = [
            'product_registration_hd_name' => $request->product_registration_hd_name,
            'product_registration_hd_subcode' => $request->product_registration_hd_subcode,
            'product_registration_hd_flag' => true,
            'person_at' => Auth::user()->name,
            'created_at' => Carbon::now(),
        ];
        try{
            DB::beginTransaction();
            $insertHD = ProductRegistrationHd::create($data);
            foreach ($request->product_registration_dt_listno as $key => $value) {
                ProductRegistrationDt::insert([
                    'product_registration_hd_id' => $insertHD->product_registration_hd_id,
                    'product_registration_dt_listno' => $request->product_registration_dt_listno[$key],
                    'product_registration_dt_dwgno' => $request->product_registration_dt_dwgno[$key],
                    'product_registration_dt_description' => $request->product_registration_dt_description[$key],
                    'product_registration_dt_rev00' => $request->product_registration_dt_rev00[$key],
                    'product_registration_dt_rev01' => $request->product_registration_dt_rev01[$key],
                    'product_registration_dt_rev02' => $request->product_registration_dt_rev02[$key],
                    'product_registration_dt_rev03' => $request->product_registration_dt_rev03[$key],
                    'product_registration_dt_rev04' => $request->product_registration_dt_rev04[$key],
                    'product_registration_dt_rev05' => $request->product_registration_dt_rev05[$key],
                    'product_registration_dt_rev06' => $request->product_registration_dt_rev06[$key],
                    'product_registration_dt_rev07' => $request->product_registration_dt_rev07[$key],
                    'product_registration_dt_rev08' => $request->product_registration_dt_rev08[$key],
                    'product_registration_dt_rev09' => $request->product_registration_dt_rev09[$key],
                    'product_registration_dt_rev10' => $request->product_registration_dt_rev10[$key],
                    'product_registration_dt_flag' => true,
                    'person_at' => Auth::user()->name,
                    'created_at'  => Carbon::now(),
                ]);
            }
            DB::commit();
            return redirect()->route('product-registration.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('product-registration.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = ProductRegistrationHd::find($id);   
        $dt = ProductRegistrationDt::where('product_registration_dt_flag',true)->where('product_registration_hd_id',$id)->get();
        return view('iso.form-product-registration-edit',compact('hd','dt'));
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
        try {
            DB::beginTransaction();

            // ✅ แก้ปัญหาที่ 1: ใช้ Model ในการหาข้อมูลและอัปเดต เพื่อให้ได้ Object ตัวเดิมกลับมาใช้งานต่อ
            $hd = ProductRegistrationHd::findOrFail($id);
            $hd->update([
                'product_registration_hd_name' => $request->product_registration_hd_name,
                'product_registration_hd_flag' => true,
                'person_at' => Auth::user()->name,
                'updated_at'  => Carbon::now(),
                'product_registration_hd_subcode' => $request->product_registration_hd_subcode,
            ]);

            // ✅ แก้ปัญหาที่ 2: เช็กว่ามีการส่งข้อมูลตาราง (Array) เข้ามาหรือไม่ ป้องกัน Error จาก null
            if ($request->has('product_registration_dt_listno')) {
                
                foreach ($request->product_registration_dt_listno as $key => $value) {
                    
                    // ตรวจสอบว่าแถวนี้เป็นแถวเก่าที่มีในระบบอยู่แล้วหรือไม่ (ดูจาก dt_id)
                    $dt_id = $request->product_registration_dt_id[$key] ?? null;

                    if ($dt_id) {
                        // 🔄 เคสที่ 1: เป็นแถวเดิมที่มีในระบบ -> ให้ทำ "อัปเดต (Update)"
                        ProductRegistrationDt::where('product_registration_dt_id', $dt_id)
                        ->update([
                            'product_registration_dt_listno' => $request->product_registration_dt_listno[$key],
                            'product_registration_dt_dwgno' => $request->product_registration_dt_dwgno[$key],
                            'product_registration_dt_description' => $request->product_registration_dt_description[$key],
                            'product_registration_dt_rev00' => $request->product_registration_dt_rev00[$key],
                            'product_registration_dt_rev01' => $request->product_registration_dt_rev01[$key],
                            'product_registration_dt_rev02' => $request->product_registration_dt_rev02[$key],
                            'product_registration_dt_rev03' => $request->product_registration_dt_rev03[$key],
                            'product_registration_dt_rev04' => $request->product_registration_dt_rev04[$key],
                            'product_registration_dt_rev05' => $request->product_registration_dt_rev05[$key],
                            'product_registration_dt_rev06' => $request->product_registration_dt_rev06[$key],
                            'product_registration_dt_rev07' => $request->product_registration_dt_rev07[$key],
                            'product_registration_dt_rev08' => $request->product_registration_dt_rev08[$key],
                            'product_registration_dt_rev09' => $request->product_registration_dt_rev09[$key],
                            'product_registration_dt_rev10' => $request->product_registration_dt_rev10[$key],
                            'product_registration_dt_flag' => true,
                            'person_at' => Auth::user()->name,
                            'updated_at' => Carbon::now(),
                        ]);
                    } else {
                        // ➕ เคสที่ 2: เป็นแถวใหม่ที่ผู้ใช้เพิ่งกดเพิ่มมา (ไม่มี dt_id) -> ให้ทำ "เพิ่มใหม่ (Insert)"
                        ProductRegistrationDt::create([
                            'product_registration_hd_id' => $hd->product_registration_hd_id, // เรียกใช้จากวัตถุที่ดึงมาตรงๆ
                            'product_registration_dt_listno' => $request->product_registration_dt_listno[$key],
                            'product_registration_dt_dwgno' => $request->product_registration_dt_dwgno[$key],
                            'product_registration_dt_description' => $request->product_registration_dt_description[$key],
                            'product_registration_dt_rev00' => $request->product_registration_dt_rev00[$key],
                            'product_registration_dt_rev01' => $request->product_registration_dt_rev01[$key],
                            'product_registration_dt_rev02' => $request->product_registration_dt_rev02[$key],
                            'product_registration_dt_rev03' => $request->product_registration_dt_rev03[$key],
                            'product_registration_dt_rev04' => $request->product_registration_dt_rev04[$key],
                            'product_registration_dt_rev05' => $request->product_registration_dt_rev05[$key],
                            'product_registration_dt_rev06' => $request->product_registration_dt_rev06[$key],
                            'product_registration_dt_rev07' => $request->product_registration_dt_rev07[$key],
                            'product_registration_dt_rev08' => $request->product_registration_dt_rev08[$key],
                            'product_registration_dt_rev09' => $request->product_registration_dt_rev09[$key],
                            'product_registration_dt_rev10' => $request->product_registration_dt_rev10[$key],
                            'product_registration_dt_flag' => true,
                            'person_at' => Auth::user()->name,
                            'created_at' => Carbon::now(),
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('product-registration.index')->with('success', 'บันทึกข้อมูลสำเร็จ');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('product-registration.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ: ' . $e->getMessage());
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

    public function cancelRegistrationHd(Request $request)
    {
        $hd = ProductRegistrationHd::where('product_registration_hd_id',$request->refid)->update([
            'product_registration_hd_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }

    public function cancelRegistrationDt(Request $request)
    {
        $hd = ProductRegistrationDt::where('product_registration_dt_id',$request->refid)->update([
            'product_registration_dt_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
