<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IsoObjcctives extends Controller
{
    public function index()
    {
        $objectives = Objective::orderBy('id', 'desc')->get();
        return view('iso.objcctives-list', compact('objectives'));
    }

    public function create()
    {
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();
        return view('iso.objcctives-create', compact('emp'));
    }

    public function store(Request $request)
    {
        try {
            $activities = [];

            if (!empty($request->description)) {
                // ดึงไฟล์แนบทั้งหมดมาพักไว้ล่วงหน้าเพื่อป้องกันปัญหา index กระโดดจากการลบแถว
                $attachments = $request->file('attachment') ?? [];

                foreach ($request->description as $i => $desc) {
                    // ถ้าในแถวนั้นว่างทั้งคำอธิบายและชื่อผู้รับผิดชอบ ให้ข้ามแถวนั้นไปเลย
                    if (empty($desc) && empty($request->resp_person[$i])) {
                        continue;
                    }

                    $filePath = null;

                    // ตรวจสอบไฟล์แนบโดยเช็กว่ามี index นี้ส่งมาจากฟอร์มจริงๆ และไฟล์สมบูรณ์หรือไม่
                    if (isset($attachments[$i]) && $attachments[$i]->isValid()) {
                        $file = $attachments[$i];
                        
                        // บันทึกไฟล์ลง disk 'img' ในโฟลเดอร์ย่อย 'objective_files'
                        // ผลลัพธ์จะได้ path เช่น: objective_files/filename.extension
                        $uploadedPath = $file->store('objective_files', 'img');

                        // ปรับรูปแบบให้อยู่ในรูป 'img/objective_files/...' เพื่อให้เอาไปดึงใช้งานด้วย asset() ได้ง่าย
                        $filePath = 'img/' . $uploadedPath;
                    }

                    $activities[] = [
                        'no'          => $request->no[$i] ?? ($i + 1),
                        'description' => $desc,
                        'resp_person' => $request->resp_person[$i] ?? '',
                        'resp_person1' => $request->resp_person1[$i] ?? '',
                        'previous'    => $request->previous[$i] ?? '',
                        'plan'        => $request->plan[$i] ?? '',
                        'results'     => $request->results[$i] ?? '',
                        'remarks'     => $request->remarks[$i] ?? '',
                        'note1'       => $request->note1[$i] ?? '',
                        'note2'       => $request->note2[$i] ?? '',
                        'file_path'   => $filePath, // เก็บ Path ของไฟล์ลงในอาเรย์กิจกรรมแถวนั้นๆ
                    ];
                }
            }
           
            // บันทึกข้อมูลลงฐานข้อมูล
            Objective::create([
                'section'           => $request->section[0] ?? null,
                'period'            => $request->period[0] ?? null,
                'docutype'          => $request->docutype[0] ?? null,
                'activity_list'     => $activities, 
                'prepared_by'       => $request->prepared_by,
                'prepared_date'     => $request->prepared_date,
                'reported_by'       => $request->reported_by,
                'reported_date'     => $request->reported_date,
                'reviewed_by'       => $request->reviewed_by,
                'reviewed_date'     => $request->reviewed_date,
                'acknowledged_by'   => $request->acknowledged_by,
                'acknowledged_date' => $request->acknowledged_date,
                'approved_by'       => $request->approved_by,
                'approved_date'     => $request->approved_date,
                'approved_status'   => 'N'
            ]);

            return redirect()->route('objcctives.index')->with('success', 'บันทึกข้อมูลสำเร็จ!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }

    public function edit(Objective $objcctive)
    {
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();
        return view('iso.objcctives-edit', compact('objcctive','emp'));
    }

    public function update(Request $request, $id) // หรือใช้ Model Binding เช่น (Request $request, Objective $objcctive)
    {
        $objcctive = Objective::findOrFail($id); // ปรับชื่อ Model ตามที่คุณใช้งานจริง

        if ($request->checkdoc == "Edit") {
            try {
                $activities = [];
                
                // ดึงอาร์เรย์ของไฟล์แนบมาจาก Request
                $attachments = $request->file('attachment') ?? [];

                if (!empty($request->description)) {
                    foreach ($request->description as $i => $desc) {
                        if (empty($desc) && empty($request->resp_person[$i])) continue;

                        // ตั้งค่าเริ่มต้นเป็นไฟล์เดิมก่อน
                        $filePath = $request->old_file_path[$i] ?? "";

                        // ตรวจสอบสถานะการลบหรือการเปลี่ยนไฟล์ใหม่
                        $deleteFlag = $request->delete_file[$i] ?? '0';
                        $hasNewFile = $request->hasFile("attachment.{$i}") && $request->file("attachment.{$i}")->isValid();

                        // ถ้ามีการกดปุ่มลบไฟล์ หรือมีการอัปโหลดไฟล์ใหม่มาทับ ให้ลบไฟล์เก่าทิ้งก่อน
                        if ($deleteFlag === '1' || $hasNewFile) {
                            $this->removeExistingFile($filePath);
                            
                            if ($deleteFlag === '1') {
                                $filePath = ""; // ถ้ากดลบ ให้เซ็ตค่าใน array เป็นค่าว่าง ""
                            }
                        }

                        // ถ้ามีการอัปโหลดไฟล์ใหม่เข้ามาในแถวนี้
                        if ($hasNewFile) {
                            $file = $request->file("attachment.{$i}");
                            
                            // บันทึกไฟล์ลง disk 'img' ในโฟลเดอร์ย่อย 'objective_files'
                            $uploadedPath = $file->store('objective_files', 'img');
                            
                            $filePath = 'img/' . $uploadedPath;
                        }

                        $activities[] = [
                            'no'           => $request->no[$i] ?? $i + 1,
                            'description'  => $desc,
                            'resp_person'  => $request->resp_person[$i] ?? '',
                            'resp_person1' => $request->resp_person1[$i] ?? '',
                            'previous'     => $request->previous[$i] ?? '',
                            'plan'         => $request->plan[$i] ?? '',
                            'results'      => $request->results[$i] ?? '',
                            'remarks'      => $request->remarks[$i] ?? '',
                            'note1'        => $request->note1[$i] ?? '',
                            'note2'        => $request->note2[$i] ?? '',
                            'file_path'    => $filePath, // บันทึกเป็น path หรือค่าว่าง ""
                        ];
                    }
                }

                // บันทึกข้อมูลส่วนหัวและรายการกิจกรรมลงใน Model
                $objcctive->section       = $request->input('section.0');
                $objcctive->period        = $request->input('period.0');
                $objcctive->docutype      = $request->input('docutype.0');
                $objcctive->activity_list = $activities;
                
                // ข้อมูลลายเซ็นและวันที่
                $objcctive->reported_by       = $request->reported_by;
                $objcctive->reported_date     = $request->reported_date;
                $objcctive->prepared_by       = $request->prepared_by;
                $objcctive->prepared_date     = $request->prepared_date;
                $objcctive->reviewed_by       = $request->reviewed_by;
                $objcctive->reviewed_date     = $request->reviewed_date;
                $objcctive->acknowledged_by   = $request->acknowledged_by;
                $objcctive->acknowledged_date = $request->acknowledged_date;
                $objcctive->approved_by       = $request->approved_by;
                $objcctive->approved_date     = $request->approved_date;

                $objcctive->save();

                 return redirect()->route('objcctives.index')->with('success', 'อัปเดตข้อมูลสำเร็จเรียบร้อยแล้ว');

            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
            }
        }elseif ($request->checkdoc == "Update") {
            $data = [
                'reported_by'       => $request->reported_by,
                'reported_date'     => $request->reported_date,
                'reviewed_by'       => $request->reviewed_by,
                'reviewed_date'     => $request->reviewed_date,
                'acknowledged_by'   => $request->acknowledged_by,
                'acknowledged_date' => $request->acknowledged_date,
                'approved_by'       => $request->approved_by,
                'approved_date'     => $request->approved_date,
                'approved_remark'   => $request->approved_remark,
                'approved_status'   => 'Y'
            ];
            try {
                $objcctive->update($data);
                return redirect()->route('objcctives.index')->with('success', 'อัปเดตข้อมูลสำเร็จ!');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
            }
        }
    }
    public function show(Objective $objcctive)
    {
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();
        return view('iso.objcctives-update', compact('objcctive','emp'));
    }

    public function destroy(Objective $objcctive)
    {
        try {
            $objcctive->delete();
            return redirect()->route('objcctives.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }
    public function printView($id)
    {
        $objcctive = Objective::findOrFail($id);
        
        return view('iso.objcctives-print', compact('objcctive'));
    }
    
    private function removeExistingFile(?string $filePath)
    {
        if (!empty($filePath)) {
            // ตัดคำว่า 'img/' ออกเพื่อให้ตรงกับ Disk 'img' ที่ตั้งค่าไว้ใน filesystems.php
            $pathWithoutDisk = str_replace('img/', '', $filePath);
            
            if (Storage::disk('img')->exists($pathWithoutDisk)) {
                Storage::disk('img')->delete($pathWithoutDisk);
            }
        }
    }
    public function duplicate($id)
    {
        $objective = Objective::findOrFail($id);    
        $newObjective = $objective->replicate();
        $objectiveDetails = $objective->activity_list ?? [];
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();
        return view('iso.objcctives-new', compact('newObjective', 'objectiveDetails', 'emp'));
    }
}
