<?php

namespace App\Http\Controllers;

use App\Models\ProductionComment;
use App\Models\ProductionOpenjobHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductionFollow extends Controller
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
        $data = Cache::remember('productionfollowup_dashboard', 30, function () {
            $raw_data = DB::select("
                SELECT 
                    productionnotice_dt_duedate,
                    productionopenjob_hd_docuno,
                    ms_product_code,
                    ms_specpage_name,
                    ms_customer_name,
                    created_person,
                    totaltime,
                    mantime,
                    timeper,
                    productionopenjob_status_name,
                    ms_product_name,
                    machinetime,
                    mach_totals,
                    mach_per,
                    electricitytime,
                    elect_totals,
                    elect_per,
                    painttime,
                    paint_totals,
                    paint_per,
                    assemblytime,
                    assembly_totals,
                    assembly_per
                FROM vw_productionfollowup 
                WHERE productionopenjob_status_name IN (:status1, :status2, :status3, :status4, :status5, :status6, :status7, :status8, :status9, :status10, :status11)
            ", [
                'status1' => 'อนุมัติเรียบร้อย',
                'status2' => 'ตรวจสอบเรียบร้อย',
                'status3' => 'ประกอบเรียบร้อย',
                'status4' => 'ทดสอบเรียบร้อย',
                'status5' => 'รอตรวจสอบ',
                'status6' => 'ออกใบเบิกวัสดุเรียบร้อย',
                'status7' => 'ส่งประกอบเรียบร้อย',
                'status8' => 'อนุมัติทดสอบเรียบร้อย',
                'status9' => 'ส่งกลับแก้ไข',
                'status10' => 'เสนอปิดงาน',
                'status11' => 'ส่งกลับแก้ไข(ปิดงาน)'
            ]);

            $collection = collect($raw_data);

            return [
                'hd1' => $collection->whereIn('productionopenjob_status_name', ['อนุมัติเรียบร้อย', 'ตรวจสอบเรียบร้อย', 'รอตรวจสอบ', 'ส่งกลับแก้ไข'])->values(),
                'hd2' => $collection->whereIn('productionopenjob_status_name', ['ประกอบเรียบร้อย', 'ออกใบเบิกวัสดุเรียบร้อย', 'ส่งประกอบเรียบร้อย'])->values(),
                'hd3' => $collection->whereIn('productionopenjob_status_name', ['ทดสอบเรียบร้อย', 'อนุมัติทดสอบเรียบร้อย'])->values(),
                'hd4' => $collection->whereIn('productionopenjob_status_name', ['เสนอปิดงาน', 'ส่งกลับแก้ไข(ปิดงาน)'])->values(),
            ];
        });

        return view('productions.form-open-productionfollow', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'comment' => ['required'],
            'productionopenjob_hd_docuno' => ['required'],
        ]);
        $data =[
            'comment' => $request->comment,
            'productionopenjob_hd_docuno' => $request->productionopenjob_hd_docuno,
            'created_at' => Carbon::now(),
            'created_save' => Auth::user()->name,
        ];
        if($request->hasFile('filename')){
            $data['filename'] = $request->file('filename')->storeAs('img/comments', "IMG_" . Carbon::now()->format('Ymdhis') . "_" . Str::random(5) . "." . $request->file('filename')->extension());
        }
        try {
            DB::beginTransaction();
            ProductionComment::create($data);
            DB::commit();
            return redirect()->route('pd-follow.show',$request->productionopenjob_hd_docuno)->with('success', 'บันทึกข้อมูลสำเร็จ');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('pd-follow.show',$request->productionopenjob_hd_docuno)->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $job = ProductionOpenjobHd::where('productionopenjob_hd_docuno',$id)->first();
        $doc = DB::table('vw_productionopenjob_docuall')->where('productionopenjob_hd_docuno',$job->productionopenjob_hd_docuno)->get();
        $comm = ProductionComment::where('productionopenjob_hd_docuno',$id)->get();
        $time = DB::table('vw_productionfollowup')->where('productionopenjob_hd_docuno',$id)->first();
        return view('productions.form-view-productionfollow',compact('job','doc','comm','time'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = ProductionOpenjobHd::where('productionopenjob_hd_docuno',$id)->first();
        return view('productions.form-comment-productionfollow',compact('job'));
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
        //
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
