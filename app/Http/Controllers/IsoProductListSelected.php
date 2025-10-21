<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductListSelectedDt;
use App\Models\ProductListSelectedHd;

class IsoProductListSelected extends Controller
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
        $hd = ProductListSelectedHd::where('product_list_selected_hd_flag',true)->get(); 
        return view('iso.form-product-list-selected-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null; 
        return view('iso.form-product-list-selected-create',compact('hd'));
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
            'product_list_selected_hd_product' => $request->product_list_selected_hd_product,
            'person_at' => Auth::user()->name,
            'product_list_selected_hd_flag' => true,
            'created_at' => Carbon::now(),
        ];
        try{
            DB::beginTransaction();
            $insertHD = ProductListSelectedHd::create($data);
            foreach ($request->product_list_selected_dt_listno as $key => $value) {
                ProductListSelectedDt::insert([
                    'product_list_selected_hd_id' =>  $insertHD->product_list_selected_hd_id, 
                    'product_list_selected_dt_listno' => $value,
                    'product_list_selected_dt_vendor' => $request->product_list_selected_dt_vendor[$key],
                    'product_list_selected_dt_product' => $request->product_list_selected_dt_product[$key],
                    'product_list_selected_dt_results1' => $request->product_list_selected_dt_results1[$key],
                    'product_list_selected_dt_results2' => $request->product_list_selected_dt_results2[$key],
                    'product_list_selected_dt_results3' => $request->product_list_selected_dt_results3[$key],
                    'product_list_selected_dt_results4' => $request->product_list_selected_dt_results4[$key],
                    'product_list_selected_dt_results5' => $request->product_list_selected_dt_results5[$key],
                    'person_at' => Auth::user()->name,
                    'product_list_selected_dt_flag' => true,
                    'created_at' => Carbon::now(),
                ]);
            }
            DB::commit();
            return redirect()->route('product-list-selected.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('product-list-selected.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = ProductListSelectedHd::find($id);
        $dt = ProductListSelectedDt::where('product_list_selected_dt_flag',true)->where('product_list_selected_hd_id',$id)->get();
        return view('iso.form-product-list-selected-edit',compact('hd','dt'));
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
        $data = [
            'product_list_selected_hd_product' => $request->product_list_selected_hd_product,
            'person_at' => Auth::user()->name,
            'product_list_selected_hd_flag' => true,
            'updated_at' => Carbon::now(),
        ];
        try{
            DB::beginTransaction();
            $insertHD = ProductListSelectedHd::where('product_list_selected_hd_id',$id)->update($data);
            foreach ($request->product_list_selected_dt_id as $key => $value) {
                ProductListSelectedDt::where('product_list_selected_dt_id',$value)->update([
                    'product_list_selected_dt_vendor' => $request->product_list_selected_dt_vendor[$key],
                    'product_list_selected_dt_product' => $request->product_list_selected_dt_product[$key],
                    'product_list_selected_dt_results1' => $request->product_list_selected_dt_results1[$key],
                    'product_list_selected_dt_results2' => $request->product_list_selected_dt_results2[$key],
                    'product_list_selected_dt_results3' => $request->product_list_selected_dt_results3[$key],
                    'product_list_selected_dt_results4' => $request->product_list_selected_dt_results4[$key],
                    'product_list_selected_dt_results5' => $request->product_list_selected_dt_results5[$key],
                    'person_at' => Auth::user()->name,
                    'product_list_selected_dt_flag' => true,
                    'updated_at' => Carbon::now(),
                ]);
            }
            foreach ($request->product_list_selected_dt_listno as $key => $value) {
                ProductListSelectedDt::insert([
                    'product_list_selected_hd_id' =>  $insertHD->product_list_selected_hd_id, 
                    'product_list_selected_dt_listno' => $value,
                    'product_list_selected_dt_vendor' => $request->product_list_selected_dt_vendor[$key],
                    'product_list_selected_dt_product' => $request->product_list_selected_dt_product[$key],
                    'product_list_selected_dt_results1' => $request->product_list_selected_dt_results1[$key],
                    'product_list_selected_dt_results2' => $request->product_list_selected_dt_results2[$key],
                    'product_list_selected_dt_results3' => $request->product_list_selected_dt_results3[$key],
                    'product_list_selected_dt_results4' => $request->product_list_selected_dt_results4[$key],
                    'product_list_selected_dt_results5' => $request->product_list_selected_dt_results5[$key],
                    'person_at' => Auth::user()->name,
                    'product_list_selected_dt_flag' => true,
                    'created_at' => Carbon::now(),
                ]);
            }
            DB::commit();
            return redirect()->route('product-list-selected.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('product-list-selected.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    public function cancelProductListSelectedHd(Request $request)
    {
        $hd = ProductListSelectedHd::where('product_list_selected_hd_id',$request->refid)->update([
            'product_list_selected_hd_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
    public function cancelProductListSelectedDt(Request $request)
    {
        $hd = ProductListSelectedDt::where('product_list_selected_dt_id',$request->refid)->update([
            'product_list_selected_dt_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
