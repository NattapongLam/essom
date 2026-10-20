<?php

namespace App\Http\Controllers;

use App\Models\CompanyLimitedDt;
use App\Models\CompanyLimitedHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IsoCompanyLimited extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = CompanyLimitedHd::where('company_limited_hds_flag',true)->get();
        return view('iso.company-limited-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;
        return view('iso.company-limited-create', compact('hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Validate ข้อมูลทั้งส่วน Header และ Detail (products)
        $request->validate([
            'for_month' => ['required'],
            'for_year' => ['required'],
            'products' => ['required', 'array'],
            'products.*.product_code' => ['nullable', 'string', 'max:255'],
            'products.*.product_desc' => ['nullable', 'string', 'max:255'],
            'products.*.min_fin' => ['nullable', 'numeric'],
            'products.*.min_semi' => ['nullable', 'numeric'],
            'products.*.pdo' => ['nullable', 'numeric'],
            'products.*.cur_fin' => ['nullable', 'numeric'],
            'products.*.cur_semi' => ['nullable', 'numeric'],
            'products.*.ord' => ['nullable', 'numeric'],
            'products.*.pto' => ['nullable', 'numeric'],
            'products.*.pp' => ['nullable', 'numeric'],
            'products.*.jun' => ['nullable', 'numeric'],
            'products.*.feb' => ['nullable', 'numeric'],
            'products.*.mar' => ['nullable', 'numeric'],
            'products.*.apr_jun' => ['nullable', 'string', 'max:255'],
        ]);
        $data = [
            'company_limited_hds_flag' => true,
            'for_month' => $request->for_month.'-01', 
            'for_year' => $request->for_year.'-01-01',   
            'prepared_by' => $request->prepared_by,
            'prepared_date' => $request->prepared_date,
            'docs_status' => "1",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        try {
            DB::beginTransaction();
            // 2. บันทึกข้อมูล Header
            $insertHD = CompanyLimitedHd::create($data);

            // 3. วนลูปบันทึกข้อมูล Detail (products) 
            if ($request->has('products')) {
                $details = [];
                foreach ($request->products as $item) {
                    $details[] = [
                        'company_limited_hds_id' => $insertHD->company_limited_hds_id, // ผูกกับ ID ของ Header ที่เพิ่งสร้าง
                        'product_code' => $item['product_code'] ?? null,
                        'product_desc' => $item['product_desc'] ?? null,
                        'min_fin' => $item['min_fin'] ?? 0,
                        'min_semi' => $item['min_semi'] ?? 0,
                        'pdo' => $item['pdo'] ?? 0,
                        'cur_fin' => $item['cur_fin'] ?? 0,
                        'cur_semi' => $item['cur_semi'] ?? 0,
                        'ord' => $item['ord'] ?? 0,
                        'pto' => $item['pto'] ?? 0,
                        'pp' => $item['pp'] ?? 0,
                        'jun' => $item['jun'] ?? 0,
                        'feb' => $item['feb'] ?? 0,
                        'mar' => $item['mar'] ?? 0,
                        'apr_jun' => $item['apr_jun'] ?? null,
                        'person_at' => auth()->user()->name ?? 'System', // ตัวอย่างการใส่ค่า person_at (ปรับเปลี่ยนตามระบบ Login ของคุณ)
                        'company_limited_dts_flag' => true,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }

                // บันทึกแบบ Bulk Insert เพื่อความเร็วและประหยัดการ Query
                CompanyLimitedDt::insert($details);
            }

            DB::commit();
            return redirect()->route('company-limiteds.index')->with('success', 'บันทึกข้อมูลสำเร็จ');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'บันทึกข้อมูลไม่สำเร็จ: ' . $e->getMessage());
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
        $hd = CompanyLimitedHd::find($id);
        $dt = CompanyLimitedDt::where('company_limited_dts_flag',true)->where('company_limited_hds_id',$id)->get();
        return view('iso.company-limited-update', compact('hd','dt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = CompanyLimitedHd::find($id);
        $dt = CompanyLimitedDt::where('company_limited_dts_flag',true)->where('company_limited_hds_id',$id)->get();
        return view('iso.company-limited-edit', compact('hd','dt'));
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
        if($request->doc_ref == "Edit"){
            // 1. Validate ข้อมูล
            $request->validate([
                'for_month' => ['required'],
                'for_year' => ['required'],
                'products' => ['required', 'array'],
                'products.*.product_code' => ['nullable', 'string', 'max:255'],
                'products.*.product_desc' => ['nullable', 'string', 'max:255'],
                'products.*.min_fin' => ['nullable', 'numeric'],
                'products.*.min_semi' => ['nullable', 'numeric'],
                'products.*.pdo' => ['nullable', 'numeric'],
                'products.*.cur_fin' => ['nullable', 'numeric'],
                'products.*.cur_semi' => ['nullable', 'numeric'],
                'products.*.ord' => ['nullable', 'numeric'],
                'products.*.pto' => ['nullable', 'numeric'],
                'products.*.pp' => ['nullable', 'numeric'],
                'products.*.jun' => ['nullable', 'numeric'],
                'products.*.feb' => ['nullable', 'numeric'],
                'products.*.mar' => ['nullable', 'numeric'],
                'products.*.apr_jun' => ['nullable', 'string', 'max:255'],
            ]);

            try {
                DB::beginTransaction();

                // 2. ค้นหาและอัปเดตข้อมูล Header
                $hd = CompanyLimitedHd::findOrFail($id);
                $hd->update([
                    'for_month' => $request->for_month,
                    'for_year' => $request->for_year,
                    'prepared_date' => $request->prepared_date,
                    'updated_at' => Carbon::now(),
                    'docs_status' => "1",
                ]);

                // 3. จัดการข้อมูล Detail (ลบของเก่าทิ้ง แล้วเพิ่มใหม่ตามฟอร์มปัจจุบัน)
                CompanyLimitedDt::where('company_limited_hds_id', $hd->company_limited_hds_id)->delete();

                if ($request->has('products')) {
                    $details = [];
                    foreach ($request->products as $item) {
                        $details[] = [
                            'company_limited_hds_id' => $hd->company_limited_hds_id,
                            'product_code' => $item['product_code'] ?? null,
                            'product_desc' => $item['product_desc'] ?? null,
                            'min_fin' => $item['min_fin'] ?? 0,
                            'min_semi' => $item['min_semi'] ?? 0,
                            'pdo' => $item['pdo'] ?? 0,
                            'cur_fin' => $item['cur_fin'] ?? 0,
                            'cur_semi' => $item['cur_semi'] ?? 0,
                            'ord' => $item['ord'] ?? 0,
                            'pto' => $item['pto'] ?? 0,
                            'pp' => $item['pp'] ?? 0,
                            'jun' => $item['jun'] ?? 0,
                            'feb' => $item['feb'] ?? 0,
                            'mar' => $item['mar'] ?? 0,
                            'apr_jun' => $item['apr_jun'] ?? null,
                            'person_at' => auth()->user()->name ?? 'System',
                            'company_limited_dts_flag' => true,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    }

                    CompanyLimitedDt::insert($details);
                }

                DB::commit();
                return redirect()->route('company-limiteds.index')->with('success', 'อัปเดตข้อมูลสำเร็จ');

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                return redirect()->back()->withInput()->with('error', 'อัปเดตข้อมูลไม่สำเร็จ: ' . $e->getMessage());
            }
        }elseif($request->doc_ref == "Update"){
            try {
                DB::beginTransaction();
                // 2. ค้นหาและอัปเดตข้อมูล Header
                $hd = CompanyLimitedHd::findOrFail($id);
                if($hd->docs_status =="1"){
                    $hd->update([
                        'checked_by' => $request->checked_by,
                        'checked_date' => $request->checked_date,
                        'docs_status' => "2",
                    ]);
                }elseif($hd->docs_status =="2"){
                    $hd->update([
                        'approved_by' => $request->approved_by,
                        'approved_date' => $request->approved_date,
                        'docs_status' => "3",
                    ]);
                }
                
                DB::commit();
                return redirect()->route('company-limiteds.index')->with('success', 'อัปเดตข้อมูลสำเร็จ');

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                return redirect()->back()->withInput()->with('error', 'อัปเดตข้อมูลไม่สำเร็จ: ' . $e->getMessage());
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
    public function cancelCompanylimited(Request $request)
    {
        $hd = CompanyLimitedHd::where('company_limited_hds_id',$request->refid)->update([
            'company_limited_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
