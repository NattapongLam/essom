<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductionComment;
use Illuminate\Support\Facades\DB;
use App\Models\ProductionOpenjobHd;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
        $hd = DB::table('vw_productionfollowup')->get();
        return view('productions.form-open-productionfollow',compact('hd'));
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
        return view('productions.form-view-productionfollow',compact('job','doc','comm'));
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
