<?php

namespace App\Http\Controllers;

use App\Models\InspectionRecordDt;
use App\Models\InspectionRecordHd;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IsoInspectionRecode extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = InspectionRecordHd::where('inspection_record_hds_flag',true)->get();
        return view('iso.inspection-recode-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;
        return view('iso.inspection-recode-create', compact('hd'));
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
            'document_date' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            // 1. บันทึก Header
            $header = InspectionRecordHd::create([
                'document_date' => $request->document_date,
                'description'   => $request->description,
                'checked_by'    => $request->checked_by,
                'checked_date'  => $request->checked_date,
                'checked_job'   => $request->checked_job,
                'docs_status'   => '1',
            ]);

            // 2. บันทึก Detail (inspection_record_dts)
            if ($request->has('sections')) {
                foreach ($request->input('sections') as $sectionNo => $sectionData) {
                    $passFail = $sectionData['pass_fail'] ?? null;
                    $remarks  = $sectionData['remarks'] ?? null;
                    $isChecked = isset($sectionData['is_checked']) ? 1 : 0;

                    // กรณีมีแถวข้อมูลย่อย (Rows) เช่น ข้อ 1, 2, 3
                    if (isset($sectionData['rows']) && is_array($sectionData['rows'])) {
                        foreach ($sectionData['rows'] as $itemName => $row) {
                            InspectionRecordDt::create([
                                'inspection_record_hds_id' => $header->inspection_record_hds_id,
                                'section_no'               => $sectionNo,
                                'item_name'                => $itemName, // เช่น 20%, 40% หรือ ตัวที่ 1, 2...
                                'sample_code'              => $sectionData['sample_code'] ?? null,
                                'val_1'                    => $row['val_1'] ?? null,
                                'val_2'                    => $row['val_2'] ?? null,
                                'val_3'                    => $row['val_3'] ?? null,
                                'val_4'                    => $row['val_4'] ?? null,
                                'val_5'                    => $row['val_5'] ?? null,
                                'val_6'                    => $row['val_6'] ?? null,
                                'pass_fail'                => $passFail,
                                'remarks'                  => $remarks,
                                'is_checked'               => $isChecked,
                            ]);
                        }
                    } 
                    
                    // กรณีที่เป็นข้อ 4 (จานองศา) ที่เป็น Checkbox แยกแต่ละข้อ
                    if (isset($sectionData['checks']) && is_array($sectionData['checks'])) {
                        foreach ($sectionData['checks'] as $chkKey => $chkValue) {
                            InspectionRecordDt::create([
                                'inspection_record_hds_id' => $header->inspection_record_hds_id,
                                'section_no'               => $sectionNo,
                                'item_name'                => $chkValue, // บันทึกข้อความ checkbox ลงใน item_name
                                'pass_fail'                => $passFail,
                                'remarks'                  => $remarks,
                                'is_checked'               => 1,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->route('inspection-recodes.index')
                            ->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                            ->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage())
                            ->withInput();
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
        $hd = InspectionRecordHd::find($id);
        return view('iso.inspection-recode-update', compact('hd'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = InspectionRecordHd::find($id);
        return view('iso.inspection-recode-edit', compact('hd'));
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
            // 1. Validate ข้อมูล Header
            $request->validate([
                'document_date' => 'required|date',
            ]);

            // เริ่มต้น Transaction
            DB::beginTransaction();

            try {
                // 2. ค้นหาและอัปเดตข้อมูล Header
                $header = InspectionRecordHd::findOrFail($id);
                
                $header->update([
                    'document_date' => $request->document_date,
                    'description'   => $request->description,
                    'checked_by'    => $request->checked_by,
                    'checked_date'  => $request->checked_date,
                    'checked_job'   => $request->checked_job,
                    'docs_status'   => '1',
                ]);

                // 3. จัดการข้อมูล Detail (ลบของเดิมทิ้ง แล้วบันทึกชุดใหม่ลงไปแทน)
                $header->details()->delete();

                if ($request->has('sections')) {
                    foreach ($request->input('sections') as $sectionNo => $sectionData) {
                        $passFail  = $sectionData['pass_fail'] ?? null;
                        $remarks   = $sectionData['remarks'] ?? null;
                        $isChecked = isset($sectionData['is_checked']) ? 1 : 0;

                        // กรณีมีแถวข้อมูลย่อย (Rows) เช่น ส่วนที่ 1 และ ส่วนที่ 2
                        if (isset($sectionData['rows']) && is_array($sectionData['rows'])) {
                            foreach ($sectionData['rows'] as $itemName => $row) {
                                InspectionRecordDt::create([
                                    'inspection_record_hds_id' => $header->inspection_record_hds_id,
                                    'section_no'               => $sectionNo,
                                    'item_name'                => $itemName, // เช่น 20%, 40% หรือ เลข 1-6
                                    'sample_code'              => $sectionData['sample_code'] ?? null,
                                    'val_1'                    => $row['val_1'] ?? null,
                                    'val_2'                    => $row['val_2'] ?? null,
                                    'val_3'                    => $row['val_3'] ?? null,
                                    'val_4'                    => $row['val_4'] ?? null,
                                    'val_5'                    => $row['val_5'] ?? null,
                                    'val_6'                    => $row['val_6'] ?? null,
                                    'pass_fail'                => $passFail,
                                    'remarks'                  => $remarks,
                                    'is_checked'               => $isChecked,
                                ]);
                            }
                        } 
                        
                        // กรณีที่เป็นส่วนที่ 4 (จานองศา) ที่เป็น Checkbox แยกแต่ละข้อ
                        if (isset($sectionData['checks']) && is_array($sectionData['checks'])) {
                            foreach ($sectionData['checks'] as $chkKey => $chkValue) {
                                InspectionRecordDt::create([
                                    'inspection_record_hds_id' => $header->inspection_record_hds_id,
                                    'section_no'               => $sectionNo,
                                    'item_name'                => $chkValue,
                                    'pass_fail'                => $passFail,
                                    'remarks'                  => $remarks,
                                    'is_checked'               => 1,
                                ]);
                            }
                        }
                    }
                }

                DB::commit();

                return redirect()->route('inspection-recodes.index')
                                ->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้วครับ');

            } catch (\Exception $e) {
                DB::rollback();
                
                return redirect()->back()
                                ->with('error', 'เกิดข้อผิดพลาดในการอัปเดต: ' . $e->getMessage())
                                ->withInput();
            }
        }elseif($request->doc_ref == "Update"){
             DB::beginTransaction();

            try {
                // 2. ค้นหาและอัปเดตข้อมูล Header
                $header = InspectionRecordHd::findOrFail($id);
                
                $header->update([
                    'approved_by'    => $request->approved_by,
                    'approved_date'  => $request->approved_date,
                    'approved_job'   => $request->approved_job,
                    'docs_status'   => '2',
                ]);
             
                DB::commit();

                return redirect()->route('inspection-recodes.index')
                                ->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้วครับ');

            } catch (\Exception $e) {
                DB::rollback();
                
                return redirect()->back()
                                ->with('error', 'เกิดข้อผิดพลาดในการอัปเดต: ' . $e->getMessage())
                                ->withInput();
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
    public function cancelInspectionrecode(Request $request)
    {
        $hd = InspectionRecordHd::where('inspection_record_hds_id',$request->refid)->update([
            'inspection_record_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
