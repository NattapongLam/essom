<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DesignReviewB;
use App\Models\DesignReviewAHd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IsoDesignReviewB extends Controller
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
        $hd = DesignReviewB::leftjoin('design_review_a_hds','design_review_b_s.design_review_a_hd_id','=','design_review_a_hds.design_review_a_hd_id')
        ->select('design_review_b_s.*','design_review_a_hds.design_review_a_hd_product','design_review_a_hds.design_review_a_hd_model',
        'design_review_a_hds.design_review_a_hd_participants','design_review_a_hds.design_review_a_hd_subject')
        ->where('design_review_b_s.design_review_b_flag',true)->get();    
        return view('iso.form-design-review-b-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = DesignReviewAHd::where('design_review_a_hd_flag',true)->get();    
        return view('iso.form-design-review-b-create',compact('hd'));
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
            'design_review_a_hd_id' => ['required'],
            'design_review_b_input' => ['required'],
            'design_review_b_output' => ['required'],
        ]);
        $data = [
            'design_review_a_hd_id' => $request->design_review_a_hd_id,
            'design_review_b_input' => $request->design_review_b_input,
            'design_review_b_output' => $request->design_review_b_output,
            'design_review_b_remark' => $request->design_review_b_remark,
            'design_review_b_comment' => $request->design_review_b_comment,
            'reported_by' => $request->reported_by,
            'reported_date' => $request->reported_date,
            'design_review_b_flag' => true,
            'created_at' => Carbon::now(),
        ];
        try
        {
            DB::beginTransaction();
            $insertHD = DesignReviewB::create($data);
            DB::commit();
            return redirect()->route('design-review-b.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('design-review-b.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $list = DesignReviewAHd::where('design_review_a_hd_flag',true)->get();    
        $hd = DesignReviewB::find($id);
        return view('iso.form-design-review-b-update',compact('list','hd'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list = DesignReviewAHd::where('design_review_a_hd_flag',true)->get();    
        $hd = DesignReviewB::find($id);
        return view('iso.form-design-review-b-edit',compact('list','hd'));
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
                'design_review_a_hd_id' => ['required'],
                'design_review_b_input' => ['required'],
                'design_review_b_output' => ['required'],
            ]);
            $data = [
                'design_review_a_hd_id' => $request->design_review_a_hd_id,
                'design_review_b_input' => $request->design_review_b_input,
                'design_review_b_output' => $request->design_review_b_output,
                'design_review_b_remark' => $request->design_review_b_remark,
                'design_review_b_comment' => $request->design_review_b_comment,
                'reported_by' => $request->reported_by,
                'reported_date' => $request->reported_date,
                'design_review_b_flag' => true,
                'updated_at' => Carbon::now(),
            ];
            try
            {
                DB::beginTransaction();
                $insertHD = DesignReviewB::where('design_review_b_id',$id)->update($data);
                DB::commit();
                return redirect()->route('design-review-b.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('design-review-b.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
            }
        }elseif($request->docuref == "Update"){
            $data =[
                'reviewed_by' => $request->reviewed_by,
                'reviewed_date' => $request->reviewed_date,
                'engineecing_by' => $request->engineecing_by,
                'engineecing_date' => $request->design_review_a_hd_subject,
            ];
            try
            {
                DB::beginTransaction();
                $insertHD = DesignReviewB::where('design_review_b_id',$id)->update($data);
                DB::commit();
                return redirect()->route('design-review-b.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('design-review-b.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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

    public function cancelReviewB(Request $request)
    {
        $hd = DesignReviewB::where('design_review_b_id',$request->refid)->update([
            'design_review_b_flag' => 0,
            'updated_at' => Carbon::now(),
            'reported_by' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
