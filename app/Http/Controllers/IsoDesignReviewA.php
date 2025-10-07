<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DesignReviewADt;
use App\Models\DesignReviewAHd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IsoDesignReviewA extends Controller
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
        $hd = DesignReviewAHd::where('design_review_a_hd_flag',true)->get();     
        return view('iso.form-design-review-a-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;     
        return view('iso.form-design-review-a-create',compact('hd'));
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
            'reported_by' => ['required'],
            'reported_date' => ['required'],
        ]);
        $data =[
            'design_review_a_hd_product' => $request->design_review_a_hd_product,
            'design_review_a_hd_model' => $request->design_review_a_hd_model,
            'design_review_a_hd_participants' => $request->design_review_a_hd_participants,
            'design_review_a_hd_subject' => $request->design_review_a_hd_subject,
            'design_review_a_hd_designinput' => $request->design_review_a_hd_designinput,
            'design_review_a_hd_drawing' => $request->design_review_a_hd_drawing,
            'design_review_a_hd_reference' => $request->design_review_a_hd_reference,
            'design_review_a_hd_comment' => $request->design_review_a_hd_comment,
            'reported_by' => $request->reported_by,
            'reported_date' => $request->reported_date,
            'design_review_a_hd_flag' => true,
            'created_at' => Carbon::now(),
        ];
        try
        {
            DB::beginTransaction();
            $insertHD = DesignReviewAHd::create($data);
            foreach ($request->listno as $key => $value) {
                DesignReviewADt::insert([
                    'design_review_a_hd_id' => $insertHD->design_review_a_hd_id,
                    'design_review_a_dt_item' => $request->design_review_a_dt_item[$key],
                    'design_review_a_dt_description' => $request->design_review_a_dt_description[$key],
                    'design_review_a_dt_flag' => true,
                    'person_at' => Auth::user()->name,
                    'created_at' => Carbon::now(),   
                ]);
            }
            DB::commit();
            return redirect()->route('design-review-a.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('design-review-a.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
        $hd = DesignReviewAHd::find($id);  
        $dt = DesignReviewADt::where('design_review_a_dt_flag',true)->where('design_review_a_hd_id',$id)->get(); 
        return view('iso.form-design-review-a-update',compact('hd','dt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = DesignReviewAHd::find($id);  
        $dt = DesignReviewADt::where('design_review_a_dt_flag',true)->where('design_review_a_hd_id',$id)->get(); 
        return view('iso.form-design-review-a-edit',compact('hd','dt'));
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
            $data =[
                'design_review_a_hd_product' => $request->design_review_a_hd_product,
                'design_review_a_hd_model' => $request->design_review_a_hd_model,
                'design_review_a_hd_participants' => $request->design_review_a_hd_participants,
                'design_review_a_hd_subject' => $request->design_review_a_hd_subject,
                'design_review_a_hd_designinput' => $request->design_review_a_hd_designinput,
                'design_review_a_hd_drawing' => $request->design_review_a_hd_drawing,
                'design_review_a_hd_reference' => $request->design_review_a_hd_reference,
                'design_review_a_hd_comment' => $request->design_review_a_hd_comment,
                'reported_by' => $request->reported_by,
                'reported_date' => $request->reported_date,
                'design_review_a_hd_flag' => true,
                'updated_at' => Carbon::now(),
            ];
            try
            {
                DB::beginTransaction();
                $insertHD = DesignReviewAHd::where('design_review_a_hd_id',$id)->update($data);
                foreach ($request->listno as $key => $value) {
                    DesignReviewADt::insert([
                        'design_review_a_hd_id' => $insertHD->design_review_a_hd_id,
                        'design_review_a_dt_item' => $request->design_review_a_dt_item[$key],
                        'design_review_a_dt_description' => $request->design_review_a_dt_description[$key],
                        'design_review_a_dt_flag' => true,
                        'person_at' => Auth::user()->name,
                        'created_at' => Carbon::now(),   
                    ]);
                }
                DB::commit();
                return redirect()->route('design-review-a.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('design-review-a.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
                $insertHD = DesignReviewAHd::where('design_review_a_hd_id',$id)->update($data);
                DB::commit();
                return redirect()->route('design-review-a.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('design-review-a.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
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
    
    public function cancelReviewAHd(Request $request)
    {
        $hd = DesignReviewAHd::where('design_review_a_hd_id',$request->refid)->update([
            'design_review_a_hd_flag' => 0,
            'updated_at' => Carbon::now(),
            'reported_by' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }

    public function cancelReviewADt(Request $request)
    {
        $hd = DesignReviewADt::where('design_review_a_dt_id',$request->refid)->update([
            'design_review_a_dt_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
