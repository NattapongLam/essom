<?php

namespace App\Http\Controllers;

use App\Models\IndividualgroupMasterHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IsoIndividualgroupMaster extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = IndividualgroupMasterHd::where('individualgroup_master_hds_flag',true)->get();
        return view('iso.indivdual-group-master-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;
        return view('iso.indivdual-group-master-create', compact('hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_code' => ['required', 'string', 'max:255'],
            'details' => ['required', 'array', 'min:1'],
            'details.*.description' => ['nullable', 'string', 'max:255'],
        ]);

        // ปรับตามระบบ Auth ของคุณ เช่น auth()->user()->name ?? auth()->id() ?? 'system'
        $personAt = auth()->user()->name ?? auth()->id() ?? 'system';

        try {
            DB::transaction(function () use ($validated, $personAt) {
                // 1. Insert ตาราง Header และดึง ID ที่สร้างใหม่
                $headerId = DB::table('individualgroup_master_hds')->insertGetId([
                    'individualgroup_master_hds_flag' => true,
                    'product_code' => $validated['product_code'],
                    'person_at' => $personAt,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // 2. เตรียมข้อมูล Details
                $detailRows = [];
                foreach ($validated['details'] as $detail) {
                    $description = isset($detail['description']) ? trim($detail['description']) : null;

                    // ข้ามแถวที่ไม่ได้กรอก description เลย (ถ้าต้องการเก็บแถวว่างด้วย ให้ลบ if นี้ออก)
                    if ($description === null || $description === '') {
                        continue;
                    }

                    $detailRows[] = [
                        'individualgroup_master_hds_id' => $headerId,
                        'description' => $description,
                        'individualgroup_master_dts_flag' => true,
                        'person_at' => $personAt,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                // 3. Insert ตาราง Details แบบ Bulk Insert
                if (!empty($detailRows)) {
                    DB::table('individualgroup_master_dts')->insert($detailRows);
                }
            });

            return redirect()
                ->back()
                ->with('success', 'บันทึกข้อมูลสำเร็จ');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage());
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
        $hd = DB::table('individualgroup_master_hds')
            ->where('individualgroup_master_hds_id', $id)
            ->first();

        abort_if(!$hd, 404);

        $dts = DB::table('individualgroup_master_dts')
            ->where('individualgroup_master_hds_id', $id)
            ->orderBy('individualgroup_master_dts_id')
            ->get();
        return view('iso.indivdual-group-master-edit', compact('hd','dts'));
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
        $validated = $request->validate([
            'product_code' => ['required', 'string', 'max:255'],
            'details' => ['required', 'array', 'min:1'],
            'details.*.id' => ['nullable', 'integer'],
            'details.*.description' => ['nullable', 'string', 'max:255'],
        ]);

        // ตรวจว่ามี Header อยู่จริงก่อนเข้า Transaction
        $header = DB::table('individualgroup_master_hds')
            ->where('individualgroup_master_hds_id', $id)
            ->first();

        abort_if(!$header, 404);

        $personAt = auth()->user()->name ?? auth()->id() ?? 'system';

        try {
            DB::transaction(function () use ($validated, $header, $personAt) {
                $headerId = $header->individualgroup_master_hds_id;

                // 1. อัปเดตตาราง Header
                DB::table('individualgroup_master_hds')
                    ->where('individualgroup_master_hds_id', $headerId)
                    ->update([
                        'product_code' => $validated['product_code'],
                        'person_at' => $personAt,
                        'updated_at' => now(),
                    ]);

                // 2. แยกแถวที่ส่งมา: อัปเดตแถวเดิม vs เตรียม insert แถวใหม่
                $keptDetailIds = [];
                $newDetailRows = [];

                foreach ($validated['details'] as $detail) {
                    $detailId = $detail['id'] ?? null;
                    $description = isset($detail['description']) ? trim($detail['description']) : null;

                    // ข้ามแถวใหม่ที่เว้นว่าง
                    if (!$detailId && ($description === null || $description === '')) {
                        continue;
                    }

                    if ($detailId) {
                        // อัปเดตแถวเดิมของ Header นี้เท่านั้น
                        DB::table('individualgroup_master_dts')
                            ->where('individualgroup_master_hds_id', $headerId)
                            ->where('individualgroup_master_dts_id', $detailId)
                            ->update([
                                'description' => $description,
                                'person_at' => $personAt,
                                'updated_at' => now(),
                            ]);

                        $keptDetailIds[] = (int) $detailId;
                    } else {
                        // เพิ่มแถวใหม่
                        $newDetailRows[] = [
                            'individualgroup_master_hds_id' => $headerId,
                            'description' => $description,
                            'individualgroup_master_dts_flag' => true,
                            'person_at' => $personAt,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }

                // 3. ลบแถวเดิมที่ถูกลบออกจากหน้าจอ
                $deleteQuery = DB::table('individualgroup_master_dts')
                    ->where('individualgroup_master_hds_id', $headerId);

                if (!empty($keptDetailIds)) {
                    $deleteQuery->whereNotIn('individualgroup_master_dts_id', $keptDetailIds);
                }

                $deleteQuery->delete();

                // 4. Insert แถวใหม่
                if (!empty($newDetailRows)) {
                    DB::table('individualgroup_master_dts')->insert($newDetailRows);
                }
            });

            return redirect()
                ->route('individual-masters.edit', $header->individualgroup_master_hds_id)
                ->with('success', 'อัปเดตข้อมูลสำเร็จ');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล: ' . $e->getMessage());
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

    public function cancelIndividualmaster(Request $request)
    {
        $hd = IndividualgroupMasterHd::where('individualgroup_master_hds_id',$request->refid)->update([
            'individualgroup_master_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
