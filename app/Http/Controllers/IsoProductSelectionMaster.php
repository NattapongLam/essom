<?php

namespace App\Http\Controllers;

use App\Models\ProductselectionMasterHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IsoProductSelectionMaster extends Controller
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
        $hd = ProductselectionMasterHd::where('productselection_master_hds_flag',true)->get();
        return view('iso.form-product-selectionmaster-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dep = DB::table('ms_department')->where('ms_department_flag',true)->get();      
        return view('iso.form-product-selectionmaster-create',compact('dep'));
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
            'product_type1' => 'required|string|max:255',
            'product_type2' => 'nullable|string|max:255',
            'product_type3' => 'nullable|string|max:255',
            'product_type4' => 'nullable|string|max:255',
            'productselection_master_hds_type' => 'nullable|string|max:255',
            'productselection_master_hds_group' => 'nullable|string|max:255',
            'productselection_master_hds_department' => 'nullable|string|max:255',
            'productselection_master_dts_vendor' => 'nullable|array',
            'productselection_master_dts_vendor.*' => 'nullable|string|max:255',
        ]);

        $personAt = Auth::user()->name ?? Auth::user()->email ?? 'system';
        $now = now();

        DB::transaction(function () use ($request, $personAt, $now) {
            // 1. Insert Header (productselection_master_hds)
            $hdsId = DB::table('productselection_master_hds')->insertGetId([
                'productselection_master_hds_flag' => true,
                'product_type1' => $request->input('product_type1'),
                'product_type2' => $request->input('product_type2'),
                'product_type3' => $request->input('product_type3'),
                'product_type4' => $request->input('product_type4'),
                'productselection_master_hds_type' => $request->input('productselection_master_hds_type'),
                'productselection_master_hds_group' => $request->input('productselection_master_hds_group'),
                'productselection_master_hds_department' => $request->input('productselection_master_hds_department'),
                'person_at' => $personAt,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // 2. Insert Details (productselection_master_dts)
            $vendors = $request->input('productselection_master_dts_vendor', []);
            $listNos = $request->input('productselection_master_dts_listno', []);
            $vendorNames = $request->input('productselection_master_dts_vendor_name', []);
            $vendorTels = $request->input('productselection_master_dts_vendor_tel', []);
            $vendorEmails = $request->input('productselection_master_dts_vendor_email', []);
            $vendorRemarks = $request->input('productselection_master_dts_vendor_remark', []);
            $brands = $request->input('productselection_master_dts_brand', []);
            $gradeAs = $request->input('productselection_master_dts_grade_a', []);
            $gradeBs = $request->input('productselection_master_dts_grade_b', []);
            $gradeCs = $request->input('productselection_master_dts_grade_c', []);
            $results1s = $request->input('productselection_master_dts_results1', []);
            $results2s = $request->input('productselection_master_dts_results2', []);
            $results3s = $request->input('productselection_master_dts_results3', []);
            $remarks = $request->input('productselection_master_dts_remark', []);

            $dtsRows = [];
            foreach ($vendors as $i => $vendor) {
                $vendorTrim = trim((string) $vendor);
                $brandTrim = trim((string) ($brands[$i] ?? ''));

                // ข้ามแถวว่างที่ไม่ได้กรอกทั้งชื่อผู้ขายและยี่ห้อ
                if ($vendorTrim === '' && $brandTrim === '') {
                    continue;
                }

                $listNo = (int) ($listNos[$i] ?? ($i + 1));

                $dtsRows[] = [
                    'productselection_master_hds_id' => $hdsId,
                    'productselection_master_dts_listno' => $listNo,
                    'productselection_master_dts_vendor' => $vendorTrim !== '' ? $vendorTrim : '-',
                    'productselection_master_dts_vendor_name' => $vendorNames[$i] ?? null,
                    'productselection_master_dts_vendor_tel' => $vendorTels[$i] ?? null,
                    'productselection_master_dts_vendor_email' => $vendorEmails[$i] ?? null,
                    'productselection_master_dts_vendor_remark' => $vendorRemarks[$i] ?? null,
                    'productselection_master_dts_brand' => $brands[$i] ?? null,
                    'productselection_master_dts_grade_a' => (bool) ($gradeAs[$i] ?? 0),
                    'productselection_master_dts_grade_b' => $gradeBs[$i] ?? null,
                    'productselection_master_dts_grade_c' => (bool) ($gradeCs[$i] ?? 0),
                    'productselection_master_dts_results1' => (bool) ($results1s[$i] ?? 0),
                    'productselection_master_dts_results2' => (bool) ($results2s[$i] ?? 0),
                    'productselection_master_dts_results3' => (bool) ($results3s[$i] ?? 0),
                    'productselection_master_dts_remark' => $remarks[$i] ?? null,
                    'productselection_master_dts_flag' => true,
                    'person_at' => $personAt,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            if (!empty($dtsRows)) {
                DB::table('productselection_master_dts')->insert($dtsRows);
            }

            // 3. Insert Evaluations (productselection_master_subs)
            $evaluations = $request->input('evaluation', []);
            $subsRows = [];

            foreach ($evaluations as $vendorIndex => $evalData) {
                $subListNos = $evalData['sub_listno'] ?? [];
                $subNames = $evalData['sub_name'] ?? [];
                $vendorListNos = $evalData['vendorlistno'] ?? [];

                foreach ($subListNos as $rowIdx => $subNo) {
                    $subNoInt = (int) $subNo;
                    $vendorListNoInt = (int) ($vendorListNos[$rowIdx] ?? $vendorIndex);
                    $subName = $subNames[$rowIdx] ?? '';

                    // ดึงผลลัพธ์ของแต่ละกลุ่ม (1..4) และเกรด (1..3)
                    $subRecord = [
                        'productselection_master_hds_id' => $hdsId,
                        'productselection_master_subs_listno' => $subNoInt,
                        'productselection_master_subs_name' => $subName,
                        'productselection_master_subs_vendorlistno' => $vendorListNoInt,
                        'person_at' => $personAt,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];

                    for ($group = 1; $group <= 4; $group++) {
                        $key = "results{$group}_{$subNoInt}";
                        $groupValues = $evalData[$key] ?? [];

                        // ในแต่ละแถวมี 3 คอลัมน์ต่อกลุ่ม (ดี=0, พอใช้=1, ไม่ดี=2)
                        $baseOffset = $rowIdx * 3;
                        $subRecord["productselection_master_subs_results{$group}_1"] = (bool) ($groupValues[$baseOffset] ?? 0);
                        $subRecord["productselection_master_subs_results{$group}_2"] = (bool) ($groupValues[$baseOffset + 1] ?? 0);
                        $subRecord["productselection_master_subs_results{$group}_3"] = (bool) ($groupValues[$baseOffset + 2] ?? 0);
                    }

                    $subsRows[] = $subRecord;
                }
            }

            if (!empty($subsRows)) {
                DB::table('productselection_master_subs')->insert($subsRows);
            }
        });

        return redirect()
            ->route('product-selection-master.store') // หรือเปลี่ยนเป็น route หน้า index / รายการ
            ->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
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
       $hd = DB::table('productselection_master_hds')
        ->where('productselection_master_hds_id', $id)
        ->first();

        abort_if(!$hd, 404);

        $dts = DB::table('productselection_master_dts')
            ->where('productselection_master_hds_id', $id)
            ->orderBy('productselection_master_dts_listno')
            ->get();

        $subs = DB::table('productselection_master_subs')
            ->where('productselection_master_hds_id', $id)
            ->orderBy('productselection_master_subs_vendorlistno')
            ->orderBy('productselection_master_subs_listno')
            ->get();

        $dep = DB::table('ms_department')->where('ms_department_flag',true)->get();      
        return view('iso.form-product-selectionmaster-edit',compact('dep','hd','dts','subs'));
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
        $hd = DB::table('productselection_master_hds')
            ->where('productselection_master_hds_id', $id)
            ->first();

        abort_if(!$hd, 404);

        $request->validate([
            'product_type1' => 'required|string|max:255',
            'product_type2' => 'nullable|string|max:255',
            'product_type3' => 'nullable|string|max:255',
            'product_type4' => 'nullable|string|max:255',
            'productselection_master_hds_type' => 'nullable|string|max:255',
            'productselection_master_hds_group' => 'nullable|string|max:255',
            'productselection_master_hds_department' => 'nullable|string|max:255',
            'productselection_master_dts_vendor' => 'nullable|array',
            'productselection_master_dts_vendor.*' => 'nullable|string|max:255',
        ]);

        $personAt = Auth::user()->name ?? Auth::user()->email ?? 'system';
        $now = now();

        DB::transaction(function () use ($request, $id, $hd, $personAt, $now) {
            // 1. Update Header (productselection_master_hds)
            DB::table('productselection_master_hds')
                ->where('productselection_master_hds_id', $id)
                ->update([
                    'product_type1' => $request->input('product_type1'),
                    'product_type2' => $request->input('product_type2'),
                    'product_type3' => $request->input('product_type3'),
                    'product_type4' => $request->input('product_type4'),
                    'productselection_master_hds_type' => $request->input('productselection_master_hds_type'),
                    'productselection_master_hds_group' => $request->input('productselection_master_hds_group'),
                    'productselection_master_hds_department' => $request->input('productselection_master_hds_department'),
                    'person_at' => $personAt,
                    'created_at' => $hd->created_at ?? $now,
                    'updated_at' => $now,
                ]);

            // 2. ลบ Subs และ Dts เดิมของ Header นี้ก่อน Insert ชุดใหม่
            DB::table('productselection_master_subs')
                ->where('productselection_master_hds_id', $id)
                ->delete();

            DB::table('productselection_master_dts')
                ->where('productselection_master_hds_id', $id)
                ->delete();

            // 3. Insert Details (productselection_master_dts) ใหม่
            $vendors = $request->input('productselection_master_dts_vendor', []);
            $vendorNames = $request->input('productselection_master_dts_vendor_name', []);
            $vendorTels = $request->input('productselection_master_dts_vendor_tel', []);
            $vendorEmails = $request->input('productselection_master_dts_vendor_email', []);
            $vendorRemarks = $request->input('productselection_master_dts_vendor_remark', []);
            $brands = $request->input('productselection_master_dts_brand', []);
            $gradeAs = $request->input('productselection_master_dts_grade_a', []);
            $gradeBs = $request->input('productselection_master_dts_grade_b', []);
            $gradeCs = $request->input('productselection_master_dts_grade_c', []);
            $results1s = $request->input('productselection_master_dts_results1', []);
            $results2s = $request->input('productselection_master_dts_results2', []);
            $results3s = $request->input('productselection_master_dts_results3', []);
            $remarks = $request->input('productselection_master_dts_remark', []);

            $dtsRows = [];
            $activeListNo = 0;

            foreach ($vendors as $i => $vendor) {
                $vendorTrim = trim((string) $vendor);
                $brandTrim = trim((string) ($brands[$i] ?? ''));

                if ($vendorTrim === '' && $brandTrim === '') {
                    continue;
                }

                $activeListNo++;

                $dtsRows[] = [
                    'productselection_master_hds_id' => $id,
                    'productselection_master_dts_listno' => $activeListNo,
                    'productselection_master_dts_vendor' => $vendorTrim !== '' ? $vendorTrim : '-',
                    'productselection_master_dts_vendor_name' => $vendorNames[$i] ?? null,
                    'productselection_master_dts_vendor_tel' => $vendorTels[$i] ?? null,
                    'productselection_master_dts_vendor_email' => $vendorEmails[$i] ?? null,
                    'productselection_master_dts_vendor_remark' => $vendorRemarks[$i] ?? null,
                    'productselection_master_dts_brand' => $brands[$i] ?? null,
                    'productselection_master_dts_grade_a' => (bool) ($gradeAs[$i] ?? 0),
                    'productselection_master_dts_grade_b' => $gradeBs[$i] ?? null,
                    'productselection_master_dts_grade_c' => (bool) ($gradeCs[$i] ?? 0),
                    'productselection_master_dts_results1' => (bool) ($results1s[$i] ?? 0),
                    'productselection_master_dts_results2' => (bool) ($results2s[$i] ?? 0),
                    'productselection_master_dts_results3' => (bool) ($results3s[$i] ?? 0),
                    'productselection_master_dts_remark' => $remarks[$i] ?? null,
                    'productselection_master_dts_flag' => true,
                    'person_at' => $personAt,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            if (!empty($dtsRows)) {
                DB::table('productselection_master_dts')->insert($dtsRows);
            }

            // 4. Insert Evaluations (productselection_master_subs) ใหม่
            $evaluations = $request->input('evaluation', []);
            $subsRows = [];

            foreach ($evaluations as $vendorIndex => $evalData) {
                $subListNos = $evalData['sub_listno'] ?? [];
                $subNames = $evalData['sub_name'] ?? [];
                $vendorListNos = $evalData['vendorlistno'] ?? [];

                foreach ($subListNos as $rowIdx => $subNo) {
                    $subNoInt = (int) $subNo;
                    $vendorListNoInt = (int) ($vendorListNos[$rowIdx] ?? $vendorIndex);
                    $subName = $subNames[$rowIdx] ?? '';

                    $subRecord = [
                        'productselection_master_hds_id' => $id,
                        'productselection_master_subs_listno' => $subNoInt,
                        'productselection_master_subs_name' => $subName,
                        'productselection_master_subs_vendorlistno' => $vendorListNoInt,
                        'person_at' => $personAt,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];

                    for ($group = 1; $group <= 4; $group++) {
                        $key = "results{$group}_{$subNoInt}";
                        $groupValues = $evalData[$key] ?? [];

                        $baseOffset = $rowIdx * 3;
                        $subRecord["productselection_master_subs_results{$group}_1"] = (bool) ($groupValues[$baseOffset] ?? 0);
                        $subRecord["productselection_master_subs_results{$group}_2"] = (bool) ($groupValues[$baseOffset + 1] ?? 0);
                        $subRecord["productselection_master_subs_results{$group}_3"] = (bool) ($groupValues[$baseOffset + 2] ?? 0);
                    }

                    $subsRows[] = $subRecord;
                }
            }

            if (!empty($subsRows)) {
                DB::table('productselection_master_subs')->insert($subsRows);
            }
        });

        return redirect()
            ->route('product-selection-master.edit', $id) // หรือเปลี่ยนเป็น route หน้า index / รายการ
            ->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
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

    public function cancelProductSelectionMaster(Request $request)
    {
        $hd = ProductselectionMasterHd::where('productselection_master_hds_id',$request->refid)->update([
            'productselection_master_hds_flag' => 0,
            'updated_at' => Carbon::now(),
            'person_at' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
