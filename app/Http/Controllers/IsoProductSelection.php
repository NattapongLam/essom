<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductSelectionDt;
use App\Models\ProductSelectionHd;
use Illuminate\Support\Facades\DB;
use App\Models\ProductSelectionSub;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductListSelectedDt;
use App\Models\ProductListSelectedHd;

class IsoProductSelection extends Controller
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
        $hd = ProductSelectionHd::where('product_selection_hd_flag',true)->get(); 
        return view('iso.form-product-selection-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();      
        return view('iso.form-product-selection-create',compact('hd','emp'));
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
            'product_type1' => ['required'],
            'requested_by' => ['required'],
            'requested_date' => ['required'],
        ]);
        $data = [
            'product_type1' => $request->product_type1,
            'product_type2' => $request->product_type2,
            'product_type3' => $request->product_type3,
            'product_type4' => $request->product_type4,
            'requested_by' => $request->requested_by,
            'requested_date' => $request->requested_date,
            'product_selection_hd_flag' => true,
            'created_at' => Carbon::now(),
            'reviewed_by' => $request->reviewed_by,
            'approved_by1' => $request->approved_by1,
            'assessor_by' => $request->assessor_by,
            'approved_by2' => $request->approved_by2,
            'reviewed_status' => "N",
            'approved_status1' => "N",
            'assessor_status' => "N",
            'approved_status2' => "N",
            'product_selection_hd_type' => $request->product_selection_hd_type,
            'purchase_by' => $request->purchase_by
        ];
        try{
            DB::beginTransaction();
            $insertHD = ProductSelectionHd::create($data);
            foreach ($request->product_selection_dt_listno as $key => $value) { 
                $data_dt = [
                    'product_selection_hd_id' => $insertHD->product_selection_hd_id,
                    'product_selection_dt_listno' => $request->product_selection_dt_listno[$key],
                    'product_selection_dt_vendor' => $request->product_selection_dt_vendor[$key],
                    'product_selection_dt_brand' => $request->product_selection_dt_brand[$key],
                    'product_selection_hd_grade_a' => $request->product_selection_hd_grade_a[$key],
                    'product_selection_hd_grade_b' => $request->product_selection_hd_grade_b[$key],
                    'product_selection_hd_grade_c' => $request->product_selection_hd_grade_c[$key],
                    'product_selection_hd_results1' => $request->product_selection_hd_results1[$key],
                    'product_selection_hd_results2' => $request->product_selection_hd_results2[$key],
                    'product_selection_hd_results3' => $request->product_selection_hd_results3[$key],
                    'product_selection_dt_remark' => $request->product_selection_dt_remark[$key],
                    'product_selection_dt_flag' => true,
                    'person_at' => Auth::user()->name,
                    'created_at'  => Carbon::now(),
                    'product_selection_dt_vendor_name' => $request->product_selection_dt_vendor_name[$key],
                    'product_selection_dt_vendor_tel' => $request->product_selection_dt_vendor_tel[$key],
                    'product_selection_dt_vendor_email' => $request->product_selection_dt_vendor_email[$key],
                    'product_selection_dt_vendor_remark' => $request->product_selection_dt_vendor_remark[$key],
                ]; 
                if ($request->hasFile('product_selection_dt_file') 
                    && isset($request->file('product_selection_dt_file')[$key])) {

                    $file = $request->file('product_selection_dt_file')[$key];

                    $data_dt['product_selection_dt_file'] = $file->storeAs(
                        'img/productselection',
                        'IMG_' . Carbon::now()->format('YmdHis') . '_' . Str::random(5) . '.' . $file->extension()
                    );
                }
                ProductSelectionDt::create($data_dt);
            }
            if ($request->has('evaluation')) {
            foreach ($request->evaluation as $vendorIndex => $rows) {

                // จำนวนรายการประเมิน เช่น 1–4
                foreach ($rows['sub_listno'] as $i => $subListNo) {

                    ProductSelectionSub::insert([
                        'product_selection_hd_id' => $insertHD->product_selection_hd_id,
                        'product_selection_sub_vendorlistno' => $rows['vendorlistno'][$key], 
                        'product_selection_sub_listno' => $rows['sub_listno'][$i],
                        'product_selection_sub_name' => $rows['sub_name'][$i],

                        // results group 1 (ดี / พอใช้ / ไม่ดี)
                        'product_selection_hd_results1_1' => $rows['results1_'.$subListNo][$i] ?? 0,
                        'product_selection_hd_results1_2' => $rows['results1_'.$subListNo][$i] ?? 0,
                        'product_selection_hd_results1_3' => $rows['results1_'.$subListNo][$i] ?? 0,

                        // results group 2
                        'product_selection_hd_results2_1' => $rows['results2_'.$subListNo][$i] ?? 0,
                        'product_selection_hd_results2_2' => $rows['results2_'.$subListNo][$i] ?? 0,
                        'product_selection_hd_results2_3' => $rows['results2_'.$subListNo][$i] ?? 0,

                        // results group 3
                        'product_selection_hd_results3_1' => $rows['results3_'.$subListNo][$i] ?? 0,
                        'product_selection_hd_results3_2' => $rows['results3_'.$subListNo][$i] ?? 0,
                        'product_selection_hd_results3_3' => $rows['results3_'.$subListNo][$i] ?? 0,

                        // results group 4
                        'product_selection_hd_results4_1' => $rows['results4_'.$subListNo][$i] ?? 0,
                        'product_selection_hd_results4_2' => $rows['results4_'.$subListNo][$i] ?? 0,
                        'product_selection_hd_results4_3' => $rows['results4_'.$subListNo][$i] ?? 0,

                        'person_at' => Auth::user()->name,
                        'created_at' => Carbon::now(),
                    ]);
                }
            }
        }
            DB::commit();
            return redirect()->route('product-selection.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('product-selection.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = ProductSelectionHd::find($id);    
        $dt = ProductSelectionDt::where('product_selection_hd_id',$id)->where('product_selection_dt_flag',true)->get();  
        $sub = ProductSelectionSub::where('product_selection_hd_id', $id)
            ->orderBy('product_selection_sub_vendorlistno')
            ->get()
            ->groupBy('product_selection_sub_vendorlistno');  
        return view('iso.form-product-selection-update',compact('hd','dt','sub'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = ProductSelectionHd::find($id);    
        $dt = ProductSelectionDt::where('product_selection_hd_id',$id)->where('product_selection_dt_flag',true)->get();  
        $sub = ProductSelectionSub::where('product_selection_hd_id', $id)
            ->orderBy('product_selection_sub_vendorlistno')
            ->get()
            ->groupBy('product_selection_sub_vendorlistno');  
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();      
        return view('iso.form-product-selection-edit',compact('hd','dt','sub','emp'));
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
        if($request->checkdoc == "Edit"){
            $request->validate([
                'product_type1' => ['required'],
                'requested_by' => ['required'],
                'requested_date' => ['required'],
            ]);
            $data = [
                'product_type1' => $request->product_type1,
                'product_type2' => $request->product_type2,
                'product_type3' => $request->product_type3,
                'product_type4' => $request->product_type4,
                'requested_by' => $request->requested_by,
                'requested_date' => $request->requested_date,
                'product_selection_hd_flag' => true,
                'updated_at' => Carbon::now(),
                'assessor_by' => $request->assessor_by,
                'assessor_date' => $request->assessor_date,
                'purchase_by' => $request->purchase_by,
                'purchase_date' => $request->purchase_date,
                'approved_by1' => $request->approved_by1
            ];
            try{
                DB::beginTransaction();
                $insertHD = ProductSelectionHd::where('product_selection_hd_id',$id)->update($data);
                foreach ($request->product_selection_dt_id as $key => $value) {
                    $data_up = [
                        'product_selection_dt_vendor' => $request->product_selection_dt_vendor[$key],
                        'product_selection_dt_brand' => $request->product_selection_dt_brand[$key],
                        'product_selection_hd_grade_a' => $request->product_selection_hd_grade_a[$key],
                        'product_selection_hd_grade_b' => $request->product_selection_hd_grade_b[$key],
                        'product_selection_hd_grade_c' => $request->product_selection_hd_grade_c[$key],
                        'product_selection_hd_results1' => $request->product_selection_hd_results1[$key],
                        'product_selection_hd_results2' => $request->product_selection_hd_results2[$key],
                        'product_selection_hd_results3' => $request->product_selection_hd_results3[$key],
                        'product_selection_dt_remark' => $request->product_selection_dt_remark[$key],
                        'product_selection_dt_flag' => true,
                        'person_at' => Auth::user()->name,
                        'updated_at'  => Carbon::now(),
                        'product_selection_dt_vendor_name' => $request->product_selection_dt_vendor_name[$key],
                        'product_selection_dt_vendor_tel' => $request->product_selection_dt_vendor_tel[$key],
                        'product_selection_dt_vendor_email' => $request->product_selection_dt_vendor_email[$key],
                        'product_selection_dt_vendor_remark' => $request->product_selection_dt_vendor_remark[$key],
                    ];
                    if ($request->hasFile('product_selection_dt_file') 
                            && isset($request->file('product_selection_dt_file')[$key])) {

                            $file = $request->file('product_selection_dt_file')[$key];

                            $data_up['product_selection_dt_file'] = $file->storeAs(
                                'img/productselection',
                                'IMG_' . Carbon::now()->format('YmdHis') . '_' . Str::random(5) . '.' . $file->extension()
                            );
                        }
                    ProductSelectionDt::where('product_selection_dt_id',$value)->update($data_up);
                }
                if($request->product_selection_dt_listno){
                    foreach ($request->product_selection_dt_listno as $key => $value) {      
                       $data_dt = [
                            'product_selection_hd_id' => $insertHD->product_selection_hd_id,
                            'product_selection_dt_listno' => $request->product_selection_dt_listno[$key],
                            'product_selection_dt_vendor' => $request->product_selection_dt_vendor[$key],
                            'product_selection_dt_brand' => $request->product_selection_dt_brand[$key],
                            'product_selection_hd_grade_a' => $request->product_selection_hd_grade_a[$key],
                            'product_selection_hd_grade_b' => $request->product_selection_hd_grade_b[$key],
                            'product_selection_hd_grade_c' => $request->product_selection_hd_grade_c[$key],
                            'product_selection_hd_results1' => $request->product_selection_hd_results1[$key],
                            'product_selection_hd_results2' => $request->product_selection_hd_results2[$key],
                            'product_selection_hd_results3' => $request->product_selection_hd_results3[$key],
                            'product_selection_dt_remark' => $request->product_selection_dt_remark[$key],
                            'product_selection_dt_flag' => true,
                            'person_at' => Auth::user()->name,
                            'created_at'  => Carbon::now(),
                            'product_selection_dt_vendor_name' => $request->product_selection_dt_vendor_name[$key],
                            'product_selection_dt_vendor_tel' => $request->product_selection_dt_vendor_tel[$key],
                            'product_selection_dt_vendor_email' => $request->product_selection_dt_vendor_email[$key],
                            'product_selection_dt_vendor_remark' => $request->product_selection_dt_vendor_remark[$key],
                        ]; 
                        dd($data_dt);
                        if ($request->hasFile('product_selection_dt_file') 
                            && isset($request->file('product_selection_dt_file')[$key])) {

                            $file = $request->file('product_selection_dt_file')[$key];

                            $data_dt['product_selection_dt_file'] = $file->storeAs(
                                'img/productselection',
                                'IMG_' . Carbon::now()->format('YmdHis') . '_' . Str::random(5) . '.' . $file->extension()
                            );
                        }
                        ProductSelectionDt::create($data_dt);
                    }   
                }               
                foreach ($request->product_selection_sub_id as $key => $value) {
                    $data_up = [
                        'product_selection_hd_results1_1' => $request->product_selection_hd_results1_1[$key],
                        'product_selection_hd_results1_2' => $request->product_selection_hd_results1_2[$key],
                        'product_selection_hd_results1_3' => $request->product_selection_hd_results1_3[$key],
                        'product_selection_hd_results2_1' => $request->product_selection_hd_results2_1[$key],
                        'product_selection_hd_results2_2' => $request->product_selection_hd_results2_2[$key],
                        'product_selection_hd_results2_3' => $request->product_selection_hd_results2_3[$key],
                        'product_selection_hd_results3_1' => $request->product_selection_hd_results3_1[$key],
                        'product_selection_hd_results3_2' => $request->product_selection_hd_results3_2[$key],
                        'product_selection_hd_results3_3' => $request->product_selection_hd_results3_3[$key],
                        'product_selection_hd_results4_1' => $request->product_selection_hd_results4_1[$key],
                        'product_selection_hd_results4_2' => $request->product_selection_hd_results4_2[$key],
                        'product_selection_hd_results4_3' => $request->product_selection_hd_results4_3[$key],
                        'person_at' => Auth::user()->name,
                        'updated_at' => Carbon::now(),
                    ];
                    ProductSelectionSub::where('product_selection_sub_id',$value)->update($data_up);
                }
                DB::commit();
                return redirect()->route('product-selection.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('product-selection.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
            }
        }elseif($request->checkdoc == "Update"){
            $data = [
                'reviewed_by' => $request->reviewed_by,
                'reviewed_date' => $request->reviewed_date,
                'approved_by1' => $request->approved_by1,
                'approved_date1' => $request->approved_date1,
                'approved_by2' => $request->approved_by2,
                'approved_date2' => $request->approved_date2
            ];
            try{
                DB::beginTransaction();
                $insertHD = ProductSelectionHd::where('product_selection_hd_id',$id)->update($data);
                DB::commit();
                return redirect()->route('product-selection.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('product-selection.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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

    public function cancelProductSelectionHd(Request $request)
    {
        $hd = ProductSelectionHd::where('product_selection_hd_id',$request->refid)->update([
            'product_selection_hd_flag' => 0,
            'updated_at' => Carbon::now(),
            'requested_by' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }

    public function cancelProductSelectionDt(Request $request)
    {
        $hd = ProductSelectionDt::where('product_selection_dt_id',$request->refid)->update([
            'product_selection_dt_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
    public function ApprovedProductSelectionHd(Request $request)
    {
        if($request->status == "reviewed"){
            $hd = ProductSelectionHd::where('product_selection_hd_id',$request->refid)
            ->update([
            'reviewed_status' => "Y",
            'reviewed_date' => Carbon::now(),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'อนุมัติเอกสารเรียบร้อยแล้ว'
            ]);    
        }else if($request->status == "approved1"){
            $hd = ProductSelectionHd::where('product_selection_hd_id',$request->refid)
            ->update([
            'approved_status1' => "Y",
            'approved_date1' =>Carbon::now(),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'อนุมัติเอกสารเรียบร้อยแล้ว'
            ]);    

        }else if($request->status == "approved2"){
            $hd = ProductSelectionHd::where('product_selection_hd_id',$request->refid)
            ->update([
            'approved_status2' => "Y",
            'approved_date2' => Carbon::now(),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'อนุมัติเอกสารเรียบร้อยแล้ว'
            ]);    
        }
        
    }

    public function updateProductSelection(Request $request)
    {
        try {
            $hd = ProductSelectionHd::findOrFail($request->refid);

            $ckhd = ProductListSelectedHd::where(
                'product_list_selected_hd_product',
                $hd->product_type1
            )->first();

            // ถ้ามีแล้ว ไม่ต้องทำซ้ำ
            if ($ckhd) {
                return response()->json([
                    'status' => false,
                    'message' => 'มีข้อมูลนี้แล้ว'
                ]);
            }

            DB::beginTransaction();

            $insertHD = ProductListSelectedHd::create([
                'product_list_selected_hd_product' => $hd->product_type1,
                'person_at' => Auth::user()->name,
                'product_list_selected_hd_flag' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $ckdt = ProductSelectionDt::where('product_selection_dt_flag', true)
                ->where('product_selection_hd_id', $hd->product_selection_hd_id)
                ->get();

            foreach ($ckdt as $value) {
                ProductListSelectedDt::create([
                    'product_list_selected_hd_id' => $insertHD->product_list_selected_hd_id,
                    'product_list_selected_dt_listno' => $value->product_selection_dt_listno,
                    'product_list_selected_dt_vendor' => $value->product_selection_dt_vendor,
                    'product_list_selected_dt_product' => $hd->product_type1,
                    'product_list_selected_dt_results1' => 0,
                    'product_list_selected_dt_results2' => 0,
                    'product_list_selected_dt_results3' => 0,
                    'product_list_selected_dt_results4' => 0,
                    'product_list_selected_dt_results5' => 1,
                    'person_at' => Auth::user()->name,
                    'product_list_selected_dt_flag' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'อัพเดทเรียบร้อยแล้ว'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
