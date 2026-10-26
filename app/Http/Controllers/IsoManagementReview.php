<?php

namespace App\Http\Controllers;

use App\Models\ManagementReviewDt;
use App\Models\ManagementReviewHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IsoManagementReview extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = ManagementReviewHd::where('management_review_hds_flag',true)->get();
        return view('iso.management-review-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;
        return view('iso.management-review-create', compact('hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // 1. บันทึกตาราง Header
            $review = ManagementReviewHd::create([
                'issue_date'                     => $request->issue_date,
                'management_review_hds_no'       => $request->management_review_hds_no,
                'management_review_hds_date'     => $request->management_review_hds_date,
                'management_review_hds_time'     => $request->management_review_hds_time,
                'management_review_hds_location' => $request->management_review_hds_location,
                'prepared_by'                    => auth()->user()->name,
                'prepared_date'                  => $request->prepared_date,
                'management_review_hds_flag'     => true,
                'docs_status'                    => '1'
                // เอา created_at และ updated_at ออก เพราะ public $timestamps = false;
            ]);

            // 2. บันทึกตาราง Detail (วาระการประชุม)
            if ($request->has('agenda_topic')) {
                foreach ($request->agenda_topic as $index => $topic) {
                    if (!empty($topic)) { // ป้องกันกรณีแถวว่าง
                        ManagementReviewDt::create([
                            'management_review_hds_id'   => $review->management_review_hds_id,
                            'agenda_topic'               => $topic,
                            'agenda_type'                => $request->agenda_type[$index] ?? null,
                            'reporter'                   => $request->reporter[$index] ?? null,
                            'chairman'                   => $request->chairman[$index] ?? null,
                            'agenda_time'                => $request->agenda_time[$index] ?? null,
                            'person_at'                  => auth()->user()->name,
                            'management_review_dts_flag' => true,
                            // เอา created_at และ updated_at ออกเช่นกัน
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('management-reviews.index')->with('success', 'บันทึกข้อมูลสำเร็จ');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage())->withInput();
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
        $hd = ManagementReviewHd::find($id);
        $dt = ManagementReviewDt::where('management_review_hds_id',$id)->where('management_review_dts_flag',true)->get();
        return view('iso.management-review-update', compact('hd','dt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = ManagementReviewHd::find($id);
        $dt = ManagementReviewDt::where('management_review_hds_id',$id)->where('management_review_dts_flag',true)->get();
        return view('iso.management-review-edit', compact('hd','dt'));
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
            DB::beginTransaction();
            try {
                $hd = ManagementReviewHd::findOrFail($id);
                $hd->update([
                    'issue_date'                     => $request->issue_date,
                    'management_review_hds_no'       => $request->management_review_hds_no,
                    'management_review_hds_date'     => $request->management_review_hds_date,
                    'management_review_hds_time'     => $request->management_review_hds_time,
                    'management_review_hds_location' => $request->management_review_hds_location,
                    'prepared_by'                    => $request->prepared_by,
                    'prepared_date'                  => $request->prepared_date,
                    'docs_status'                    => '1'
                ]);
                ManagementReviewDt::where('management_review_hds_id', $id)->delete();
                if ($request->has('agenda_topic')) {
                    foreach ($request->agenda_topic as $index => $topic) {
                        if (!empty($topic)) {
                            ManagementReviewDt::create([
                                'management_review_hds_id'   => $hd->management_review_hds_id,
                                'agenda_topic'               => $topic,
                                'agenda_type'                => $request->agenda_type[$index] ?? null,
                                'reporter'                   => $request->reporter[$index] ?? null,
                                'chairman'                   => $request->chairman[$index] ?? null,
                                'agenda_time'                => $request->agenda_time[$index] ?? null,
                                'person_at'                  => auth()->user()->name,
                                'management_review_dts_flag' => true,
                            ]);
                        }
                    }
                }
                DB::commit();
                return redirect()->route('management-reviews.index')->with('success', 'อัปเดตข้อมูลสำเร็จ');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล: ' . $e->getMessage())->withInput();
            }
        }elseif($request->doc_ref == "Update"){
            DB::beginTransaction();
            try {
                $hd = ManagementReviewHd::findOrFail($id);
                $hd->update([
                    'checked_by'                    => $request->checked_by,
                    'checked_date'                  => $request->checked_date,
                    'docs_status'                   => '2'
                ]);
                DB::commit();
                return redirect()->route('management-reviews.index')->with('success', 'อัปเดตข้อมูลสำเร็จ');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล: ' . $e->getMessage())->withInput();
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
    public function cancelManagementreview(Request $request)
    {
        $hd = ManagementReviewHd::where('management_review_hds_id',$request->refid)->update([
            'management_review_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
