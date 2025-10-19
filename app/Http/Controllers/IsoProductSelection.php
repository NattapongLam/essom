<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ProductSelectionDt;
use App\Models\ProductSelectionHd;
use Illuminate\Support\Facades\DB;
use App\Models\ProductSelectionSub;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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
        return view('iso.form-product-selection-create',compact('hd'));
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
        ];
        try{
            DB::beginTransaction();
            $insertHD = ProductSelectionHd::create($data);
            foreach ($request->product_selection_dt_listno as $key => $value) {      
                ProductSelectionDt::insert([
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
                ]);
            }
            foreach ($request->product_selection_sub_listno as $key => $value) {
                ProductSelectionSub::insert([
                    'product_selection_hd_id' => $insertHD->product_selection_hd_id,
                    'product_selection_sub_listno' => $request->product_selection_sub_listno[$key],
                    'product_selection_sub_name' => $request->product_selection_sub_name[$key],
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
                    'created_at' => Carbon::now(),
                ]);
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
        $sub = ProductSelectionSub::where('product_selection_hd_id',$id)->get();  
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
        $sub = ProductSelectionSub::where('product_selection_hd_id',$id)->get();  
        return view('iso.form-product-selection-edit',compact('hd','dt','sub'));
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
                'assessor_date' => $request->assessor_date
            ];
            try{
                DB::beginTransaction();
                $insertHD = ProductSelectionHd::where('product_selection_hd_id',$id)->update($data);
                foreach ($request->product_selection_dt_id as $key => $value) {
                    ProductSelectionDt::where('product_selection_dt_id',$value)->update([
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
                    ]);
                }
                foreach ($request->product_selection_dt_listno as $key => $value) {      
                    ProductSelectionDt::insert([
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
                    ]);
                }
                foreach ($request->product_selection_sub_id as $key => $value) {
                    ProductSelectionSub::where('product_selection_sub_id',$value)->update([
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
                    ]);
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
        $hd = ProductSelectionHd::where('documentexternal_hd_id',$request->refid)->update([
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
        $hd = ProductSelectionDt::where('documentexternal_dt_id',$request->refid)->update([
            'product_selection_dt_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
