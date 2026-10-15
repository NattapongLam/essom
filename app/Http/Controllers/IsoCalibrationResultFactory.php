<?php

namespace App\Http\Controllers;

use App\Models\CalibrationResultfactoryDt;
use App\Models\CalibrationResultfactoryHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IsoCalibrationResultFactory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = CalibrationResultfactoryHd::where('calibration_resultfactory_hds_flag',true)->get();
        return view('iso.calibration-resultfactory-list', compact('hd'));
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
    public function create1()
    {
        $hd = null;
        return view('iso.calibration-resultfactory-create1', compact('hd'));
    }

    public function create2()
    {
        $hd = null;
        return view('iso.calibration-resultfactory-create2', compact('hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->docutype == "F7150.1"){
            $request->validate([
                'calibration_name' => 'required|string|max:255',
                'calibration_code' => 'required|string|max:255',
            ]);

            // เริ่มต้น Transaction เพื่อความปลอดภัยของข้อมูลทั้ง 2 ตาราง
            DB::beginTransaction();

            try {
                // 2. บันทึกข้อมูลตารางหลัก (Header)
                $header = CalibrationResultfactoryHd::create([
                    'docutype'                             => $request->docutype,
                    'calibration_name'                     => $request->calibration_name,
                    'calibration_code'                     => $request->calibration_code,
                    'calibration_brand'                    => $request->calibration_brand,
                    'calibration_resultfactory_hds_date'   => $request->calibration_resultfactory_hds_date,
                    'standard_tools'                       => $request->standard_tools,
                    'room_temperature'                     => $request->room_temperature,
                    'atmospheric_pressur'                  => $request->atmospheric_pressur,
                    'measurement_scales'                   => $request->measurement_scales,
                    'additional_details'                   => $request->additional_details,
                    'standard_unit'                        => $request->standard_unit,
                    'value_unit'                           => $request->value_unit,
                    'equipment_unit'                       => $request->equipment_unit,
                    'error_unit'                           => $request->error_unit,
                    'evaluation_round'                     => $request->evaluation_round,
                    'approved_at'                          => $request->approved_at,
                    'approved_date'                        => $request->approved_date,
                    'final_approval'                       => $request->final_approval,
                ]);

                // 3. บันทึกข้อมูลรายการตารางย่อย (Details) แบบ Loop ตามแถวที่เพิ่มเข้ามา
                if ($request->has('standard_value')) {
                    foreach ($request->standard_value as $index => $value) {
                        CalibrationResultfactoryDt::create([
                            'calibration_resultfactory_hds_id' => $header->calibration_resultfactory_hds_id,
                            'listno'                           => $request->listno[$index] ?? ($index + 1),
                            'standard_value'                   => $request->standard_value[$index] ?? null,
                            'correct_value'                    => $request->correct_value[$index] ?? null,
                            'calibration_value'                => $request->calibration_value[$index] ?? null,
                            'error_value'                      => $request->error_value[$index] ?? null,
                            'measured_percent'                 => $request->measured_percent[$index] ?? null,
                            'acceptable_percent'               => $request->acceptable_percent[$index] ?? null,
                            'remark'                           => $request->remark[$index] ?? null,
                            'person_at'                        => Auth::user()->name ?? 'System', // หรือดึงจากชื่อผู้บันทึก
                        ]);
                    }
                }

                DB::commit();

                return redirect()->route('calibration-resultfactory.index')->with('success', 'บันทึกข้อมูลสำเร็จ');

            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage())->withInput();
            }
        }elseif($request->docutype == "F7150.2"){
             $request->validate([
                'calibration_name' => 'required|string|max:255',
                'calibration_code' => 'required|string|max:255',
            ]);

            // เริ่มต้น Transaction เพื่อความปลอดภัยของข้อมูลทั้ง 2 ตาราง
            DB::beginTransaction();

            try {
                // 2. บันทึกข้อมูลตารางหลัก (Header)
                $header = CalibrationResultfactoryHd::create([
                    'docutype'                             => $request->docutype,
                    'calibration_name'                     => $request->calibration_name,
                    'calibration_code'                     => $request->calibration_code,
                    'calibration_brand'                    => $request->calibration_brand,
                    'calibration_resultfactory_hds_date'   => $request->calibration_resultfactory_hds_date,
                    'standard_tools'                       => $request->standard_tools,
                    'room_temperature'                     => $request->room_temperature,
                    'atmospheric_pressur'                  => $request->atmospheric_pressur,
                    'measurement_scales'                   => $request->measurement_scales,
                    'additional_details'                   => $request->additional_details,
                    'standard_unit'                        => $request->standard_unit,
                    'value_unit'                           => $request->value_unit,
                    'equipment_unit'                       => $request->equipment_unit,
                    'error_unit'                           => $request->error_unit,
                    'evaluation_round'                     => $request->evaluation_round,
                    'approved_at'                          => $request->approved_at,
                    'approved_date'                        => $request->approved_date,
                    'final_approval'                       => $request->final_approval,
                    'liquid_unit'                          => $request->liquid_unit,
                    'container_unit'                       => $request->container_unit,
                    'specific_note'                        => $request->specific_note,
                ]);

                // 3. บันทึกข้อมูลรายการตารางย่อย (Details) แบบ Loop ตามแถวที่เพิ่มเข้ามา
               if ($request->has('standard_value')) {
                    foreach ($request->standard_value as $index => $value) {
                        CalibrationResultfactoryDt::create([
                            'calibration_resultfactory_hds_id' => $header->calibration_resultfactory_hds_id,
                            'listno'             => $request->listno[$index] ?? ($index + 1),
                            'standard_value'     => $request->standard_value[$index] ?? null,
                            'correct_value'      => $request->correct_value[$index] ?? null,
                            'calibration_value'  => $request->calibration_value[$index] ?? null,
                            'error_value'        => $request->error_value[$index] ?? null,
                            'measured_percent'   => $request->measured_percent[$index] ?? null,
                            'acceptable_percent' => $request->acceptable_percent[$index] ?? null,
                            'remark'             => $request->remark[$index] ?? null,
                            'person_at'          => Auth::user()->name ?? 'System',
                            'table_type'         => $request->table_type[$index] ?? 'A',
                        ]);
                    }
                }

                // 4. บันทึกข้อมูลรายการตารางย่อย (Details) - ตาราง B
                if ($request->has('standard_value_b')) {
                    foreach ($request->standard_value_b as $index => $value) {
                        CalibrationResultfactoryDt::create([
                            'calibration_resultfactory_hds_id' => $header->calibration_resultfactory_hds_id,
                            'listno'             => $request->listno_b[$index] ?? ($index + 1),
                            'standard_value'     => $request->standard_value_b[$index] ?? null,
                            'correct_value'      => $request->correct_value_b[$index] ?? null,
                            'calibration_value'  => $request->calibration_value_b[$index] ?? null,
                            'error_value'        => $request->error_value_b[$index] ?? null,
                            'measured_percent'   => $request->measured_percent_b[$index] ?? null,
                            'acceptable_percent' => null, // ถ้าตาราง B ไม่มีช่องนี้
                            'remark'             => $request->remark_b[$index] ?? null,
                            'person_at'          => Auth::user()->name ?? 'System',
                            'table_type'         => $request->table_type_b[$index] ?? 'B',
                        ]);
                    }
                }
                DB::commit();

                return redirect()->route('calibration-resultfactory.index')->with('success', 'บันทึกข้อมูลสำเร็จ');

            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage())->withInput();
            }
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
        $hd = CalibrationResultfactoryHd::find($id);
        
        if (!$hd) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลที่ต้องการแก้ไข');
        }

        if ($hd->docutype == "F7150.1") {
            $dt = CalibrationResultfactoryDt::where('calibration_resultfactory_hds_id', $id)->get();
            return view('iso.calibration-resultfactory-edit1', compact('hd', 'dt'));
            
        } elseif ($hd->docutype == "F7150.2") {
            // ดึงข้อมูลทั้งหมดของ Header นี้มาครั้งเดียว
            $dt = CalibrationResultfactoryDt::where('calibration_resultfactory_hds_id', $id)->get();
            
            // แยกข้อมูลสำหรับตาราง A และ B โดยใช้ Collection filter หรือ where
            $dt1 = $dt->where('table_type', 'A');
            $dt2 = $dt->where('table_type', 'B');

            return view('iso.calibration-resultfactory-edit2', compact('hd', 'dt', 'dt1', 'dt2'));
        }
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
        // ใช้ Database Transaction เพื่อความปลอดภัยของข้อมูล
        DB::beginTransaction();
        try {
            $hd = CalibrationResultfactoryHd::findOrFail($id);

            // 1. ตรวจสอบประเภทเอกสารเพื่ออัปเดต Header ตามฟอร์มที่เหมาะสม
            if ($hd->docutype == "F7150.1") {
                $hd->update([
                    'docutype'                           => $request->docutype,
                    'calibration_name'                   => $request->calibration_name,
                    'calibration_code'                   => $request->calibration_code,
                    'calibration_brand'                  => $request->calibration_brand,
                    'calibration_resultfactory_hds_date' => $request->calibration_resultfactory_hds_date,
                    'standard_tools'                     => $request->standard_tools,
                    'room_temperature'                   => $request->room_temperature,
                    'atmospheric_pressur'                => $request->atmospheric_pressur,
                    'measurement_scales'                 => $request->measurement_scales,
                    'additional_details'                 => $request->additional_details,
                    'standard_unit'                      => $request->standard_unit,
                    'value_unit'                         => $request->value_unit,
                    'equipment_unit'                     => $request->equipment_unit,
                    'error_unit'                         => $request->error_unit,
                    'evaluation_round'                   => $request->evaluation_round,
                    'approved_at'                        => $request->approved_at,
                    'approved_date'                      => $request->approved_date,
                    'final_approval'                     => $request->final_approval,
                ]);

                // 2. จัดการข้อมูลรายละเอียด (Details) สำหรับ F7150.1
                $dtsIds = $request->input('dts_id', []);
                $submittedIds = [];

                if ($request->has('standard_value')) {
                    foreach ($request->standard_value as $index => $standardValue) {
                        $detailId = $dtsIds[$index] ?? null;

                        $dataToSave = [
                            'calibration_resultfactory_hds_id' => $id,
                            'listno'               => $request->listno[$index] ?? ($index + 1),
                            'standard_value'       => $standardValue,
                            'correct_value'        => $request->correct_value[$index] ?? null,
                            'calibration_value'    => $request->calibration_value[$index] ?? null,
                            'error_value'          => $request->error_value[$index] ?? null,
                            'measured_percent'     => $request->measured_percent[$index] ?? null,
                            'acceptable_percent'   => $request->acceptable_percent[$index] ?? null,
                            'remark'               => $request->remark[$index] ?? null,
                        ];

                        if (!empty($detailId)) {
                            CalibrationResultfactoryDt::where('calibration_resultfactory_dts_id', $detailId)->update($dataToSave);
                            $submittedIds[] = $detailId;
                        } else {
                            $newDetail = CalibrationResultfactoryDt::create($dataToSave);
                            $submittedIds[] = $newDetail->calibration_resultfactory_dts_id;
                        }
                    }
                }

                // ลบแถว F7150.1 ที่ถูกกดลบทิ้ง
                CalibrationResultfactoryDt::where('calibration_resultfactory_hds_id', $id)
                    ->whereNotIn('calibration_resultfactory_dts_id', $submittedIds)
                    ->delete();

            } elseif ($hd->docutype == "F7150.2") {
                $hd->update([
                    'docutype'                           => $request->docutype,
                    'calibration_name'                   => $request->calibration_name,
                    'calibration_code'                   => $request->calibration_code,
                    'calibration_resultfactory_hds_date' => $request->calibration_resultfactory_hds_date,
                    'standard_tools'                     => $request->standard_tools,
                    'room_temperature'                   => $request->room_temperature,
                    'liquid_unit'                        => $request->liquid_unit,
                    'atmospheric_pressur'                => $request->atmospheric_pressur,
                    'container_unit'                     => $request->container_unit,
                    'specific_note'                      => $request->specific_note,
                    'measurement_scales'                 => $request->measurement_scales,
                    'additional_details'                 => $request->additional_details,
                    'scale_neatness'                     => $request->scale_neatness,
                    'evaluation_round'                   => $request->evaluation_round,
                    'approved_at'                        => $request->approved_at,
                    'approved_date'                      => $request->approved_date,
                    'final_approval'                     => $request->final_approval,
                ]);

                $submittedIds = [];

                // 3. จัดการข้อมูลตาราง A (F7150.2)
                $dtsIdsA = $request->input('dts_id', []);
                if ($request->has('standard_value')) {
                    foreach ($request->standard_value as $index => $val) {
                        $detailId = $dtsIdsA[$index] ?? null;

                        $dataA = [
                            'calibration_resultfactory_hds_id' => $id,
                            'listno'             => $request->listno[$index] ?? ($index + 1),
                            'standard_value'     => $val,
                            'correct_value'      => $request->correct_value[$index] ?? null,
                            'calibration_value'  => $request->calibration_value[$index] ?? null,
                            'error_value'        => $request->error_value[$index] ?? null,
                            'measured_percent'   => $request->measured_percent[$index] ?? null,
                            'acceptable_percent' => $request->acceptable_percent[$index] ?? null,
                            'remark'             => $request->remark[$index] ?? null,
                            'table_type'         => 'A',
                        ];

                        if (!empty($detailId)) {
                            CalibrationResultfactoryDt::where('calibration_resultfactory_dts_id', $detailId)->update($dataA);
                            $submittedIds[] = $detailId;
                        } else {
                            $newDetail = CalibrationResultfactoryDt::create($dataA);
                            $submittedIds[] = $newDetail->calibration_resultfactory_dts_id;
                        }
                    }
                }

                // 4. จัดการข้อมูลตาราง B (F7150.2)
                $dtsIdsB = $request->input('dts_id_b', []);
                if ($request->has('standard_value_b')) {
                    foreach ($request->standard_value_b as $index => $val) {
                        $detailId = $dtsIdsB[$index] ?? null;

                        $dataB = [
                            'calibration_resultfactory_hds_id' => $id,
                            'listno'             => $request->listno_b[$index] ?? ($index + 1),
                            'standard_value'     => $val,
                            'correct_value'      => $request->correct_value_b[$index] ?? null,
                            'calibration_value'  => $request->calibration_value_b[$index] ?? null,
                            'error_value'        => $request->error_value_b[$index] ?? null,
                            'measured_percent'   => $request->measured_percent_b[$index] ?? null,
                            'acceptable_percent' => null, // ถ้าไม่มีช่องนี้ในตาราง B สามารถเว้นว่างไว้ได้
                            'remark'             => $request->remark_b[$index] ?? null,
                            'table_type'         => 'B',
                        ];

                        if (!empty($detailId)) {
                            CalibrationResultfactoryDt::where('calibration_resultfactory_dts_id', $detailId)->update($dataB);
                            $submittedIds[] = $detailId;
                        } else {
                            $newDetail = CalibrationResultfactoryDt::create($dataB);
                            $submittedIds[] = $newDetail->calibration_resultfactory_dts_id;
                        }
                    }
                }

                // ลบแถวตาราง A และ B ของ F7150.2 ที่ถูกกดลบทิ้ง
                CalibrationResultfactoryDt::where('calibration_resultfactory_hds_id', $id)
                    ->whereNotIn('calibration_resultfactory_dts_id', $submittedIds)
                    ->delete();
            }

            DB::commit();

            return redirect()->route('calibration-resultfactory.index')->with('success', 'บันทึกข้อมูลสำเร็จเรียบร้อยแล้ว');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage())->withInput();
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
    public function cancelCalibrationFactory(Request $request)
    {
        $hd = CalibrationResultfactoryHd::where('calibration_resultfactory_hds_id',$request->refid)->update([
            'calibration_resultfactory_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
}
