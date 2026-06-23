<?php

namespace App\Http\Controllers;

use App\Models\ComputerHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IsoComputerHistory extends Controller
{

    public function index()
    {
        // $histories = ComputerHistory::latest()->get();
        // return view('iso.computer-history-list', compact('histories'));
        $computers = DB::table('computer_histories_new')->where('flag',true)->get();
        return view('iso.computer-history-list-new', compact('computers'));
    }

    public function create()
    {
        return view('iso.computer-history-create');
    }

 
    public function store(Request $request)
    {
        // $data = $this->validateRequest($request); 
        // ComputerHistory::create($data);

        // return redirect()
        //     ->route('computer-history.index')
        //     ->with('success', 'บันทึกข้อมูลเรียบร้อย');
        // 1. ตรวจสอบข้อมูลและความถูกต้องของไฟล์ (Validation)
        $request->validate([
            'model'         => 'required|string|max:255',
            'received_date' => 'required|date',
            'user_name'     => 'required|string|max:255',
            'asset_code'    => 'required|string|max:255',
            'attachment'    => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120', // จำกัดขนาดไม่เกิน 5MB
        ]);

        try {
            $fileName = null;

            // 2. จัดการไฟล์เอกสารแนบ (ถ้ามีการอัปโหลดมา)
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                // ตั้งชื่อไฟล์ใหม่เป็น "เวลาปัจจุบัน_ชื่อไฟล์เดิม" เพื่อไม่ให้ชื่อซ้ำกัน
                $fileName = time() . '_' . $file->getClientOriginalName();
                // บันทึกไฟล์ลงในโฟลเดอร์ storage/app/public/attachments
                $file->storeAs('img/computers', $fileName);
            }

            // 3. ทำการ Insert ข้อมูลเข้าฐานข้อมูล SQL Server ของคุณ
            DB::table('computer_histories_new')->insert([
                'model'           => $request->model,
                'received_date'   => $request->received_date,
                'user_name'       => $request->user_name,
                'asset_code'      => $request->asset_code,
                'windows_version' => $request->windows_version,
                'office_version'  => $request->office_version,
                'checked_by'      => $request->checked_by,
                'remark'          => $request->remark,
                'others'          => $request->others,
                'attachment'      => $fileName, // เก็บชื่อไฟล์ลงในคอลัมน์ attachment
                'create_at'       => Carbon::now(),
                'update_at'       => Carbon::now(),
                'person_at'       => auth()->user()->name ?? 'System',
                'flag'            => 1
            ]);

            return response()->json([
                'success' => true,
                'message' => 'บันทึกประวัติพร้อมเอกสารแนบเรียบร้อยแล้ว'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $history = ComputerHistory::findOrFail($id); 
        return view('iso.computer-history-show', compact('history'));
    }
    public function edit($id)
    {
        $item = ComputerHistory::findOrFail($id);
        return view('iso.computer-history-edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        // $item = ComputerHistory::findOrFail($id);
        // $data = $this->validateRequest($request);
        // $item->update($data);

        // return redirect()
        //     ->route('computer-history.index')
        //     ->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว!');
        $request->validate([
            'model'         => 'required|string|max:255',
            'received_date' => 'required|date',
            'user_name'     => 'required|string|max:255',
            'asset_code'    => 'required|string|max:255',
            'attachment'    => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',
        ]);

        try {
            // ใช้ตัวแปร $id ที่ได้มาจาก URL ของ Resource ตรงๆ ในการตรวจสอบข้อมูล
            $oldData = DB::table('computer_histories_new')->where('id', $id)->first();
            if (!$oldData) {
                return response()->json(['success' => false, 'message' => 'ไม่พบข้อมูลที่ต้องการแก้ไข']);
            }

            $fileName = $oldData->attachment;

            // หากมีการอัปโหลดไฟล์มาใหม่
            if ($request->hasFile('attachment')) {
                // แก้ไข: ใส่ '/' ปิดท้ายโฟลเดอร์ เพื่อให้พาธสมบูรณ์ (เช่น public_path('img/computers/file.pdf'))
                $destinationPath = public_path('img/computers');
                
                // ลบไฟล์เก่าในระบบทิ้งก่อน
                if ($oldData->attachment && file_exists($destinationPath . '/' . $oldData->attachment)) {
                    unlink($destinationPath . '/' . $oldData->attachment);
                }

                // เซฟไฟล์ตัวใหม่ลงไปในโฟลเดอร์ public/img/computers ตัวเดิมตามลิ้งก์ใน Blade
                $file = $request->file('attachment');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move($destinationPath, $fileName);
            }

            // ทำการ Update ข้อมูลลงตาราง
            DB::table('computer_histories_new')
                ->where('id', $id)
                ->update([
                    'model'           => $request->model,
                    'received_date'   => $request->received_date,
                    'user_name'       => $request->user_name,
                    'asset_code'      => $request->asset_code,
                    'windows_version' => $request->windows_version,
                    'office_version'  => $request->office_version,
                    'checked_by'      => $request->checked_by,
                    'remark'          => $request->remark,
                    'others'          => $request->others,
                    'attachment'      => $fileName,
                    'update_at'       => \Carbon\Carbon::now(),
                    'person_at'       => auth()->user()->name ?? 'System'
                ]);

            return response()->json([
                'success' => true,
                'message' => 'อัปเดตข้อมูลคอมพิวเตอร์เรียบร้อยแล้ว'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        // $item = ComputerHistory::findOrFail($id);
        // $item->delete();

        // return redirect()
        //     ->route('computer-history.index')
        //     ->with('success', 'ลบข้อมูลเรียบร้อยแล้ว!');
        try {
        // 1. ดึงข้อมูลมาเช็ค เพื่อหาชื่อไฟล์แนบที่ต้องการลบในเซิร์ฟเวอร์
        $oldData = DB::table('computer_histories_new')->where('id', $id)->first();
        if (!$oldData) {
            return response()->json(['success' => false, 'message' => 'ไม่พบข้อมูลที่ต้องการลบ']);
        }

        // 2. ถ้ามีไฟล์แนบอยู่ ให้ทำการลบไฟล์ออกจากโฟลเดอร์ public/img/computers ด้วย
        $destinationPath = public_path('img/computers');
        if ($oldData->attachment && file_exists($destinationPath . '/' . $oldData->attachment)) {
            unlink($destinationPath . '/' . $oldData->attachment);
        }

        // 3. ลบข้อมูลออกจากตารางฐานข้อมูล
        DB::table('computer_histories_new')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'ลบข้อมูลประวัติคอมพิวเตอร์เรียบร้อยแล้ว'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
        ], 500);
    }
    }
    public function popup($id)
{
    $history = ComputerHistory::findOrFail($id);
    return view('iso.computer-history-show', compact('history'));
}

    private function validateRequest(Request $request)
    {
        $data = $request->validate([
            'user_name' => 'nullable|string|max:255',
            'no_number' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'cpu_spec' => 'nullable|string|max:255',
            'dimm1' => 'nullable|string|max:255',
            'dimm1_warranty' => 'nullable|date',
            'dimm1_exp' => 'nullable|date',
            'dimm2' => 'nullable|string|max:255',
            'dimm2_warranty' => 'nullable|date',
            'dimm2_exp' => 'nullable|date',
            'ram_other' => 'nullable|string|max:255',
            'hd_qty' => 'nullable|integer|min:0',
            'disk1' => 'nullable|string|max:255',
            'disk1_warranty' => 'nullable|date',
            'disk1_exp' => 'nullable|date',
            'disk2' => 'nullable|string|max:255',
            'disk2_warranty' => 'nullable|date',
            'disk2_exp' => 'nullable|date',
            'external_disk' => 'nullable|string|max:255',
            'cd_qty' => 'nullable|integer|min:0',
            'cd_drive1' => 'nullable|string|max:255',
            'cd1_warranty' => 'nullable|date',
            'cd1_exp' => 'nullable|date',
            'cd_drive2' => 'nullable|string|max:255',
            'cd2_warranty' => 'nullable|date',
            'cd2_exp' => 'nullable|date',
            'external_cd' => 'nullable|string|max:255',
            'main_board_spec'=>'nullable|string|max:255',
            'mb_ide_port' => 'nullable|string|max:255',
            'mb_sata_port' => 'nullable|string|max:255',
            'mb_usb_port' => 'nullable|string|max:255',
            'vga_spec' => 'nullable|string|max:255',
            'lan_spec' => 'nullable|string|max:255',
            'psu_watt' => 'nullable|string|max:255',
            'psu_result' => 'nullable|string|max:255',
            'monitor_spec' => 'nullable|string|max:255',
            'accessory' => 'nullable|string|max:255',
            'mouse' => 'nullable|string|max:255',
            'keyboard' => 'nullable|string|max:255',
            'sound_card' => 'nullable|string|max:255',
            'drive_a' => 'nullable|string|max:255',
            'card' => 'nullable|string|max:255',
            'speaker' => 'nullable|string|max:255',
            'accessory_other' => 'nullable|string|max:255',
            'os' => 'nullable|string|max:255',
            'office' => 'nullable|string|max:255',
            'software_other' => 'nullable|string|max:255',
            'problem' => 'nullable|string',
            'check_by' => 'nullable|string|max:255',
            'check_date' => 'nullable|date',
            'ack_by' => 'nullable|string|max:255',
            'ack_date' => 'nullable|date',
        ]);

        $checkboxes = [
            'type_pc','type_notebook',
            'ram_ddr1','ram_ddr2','ram_ddr3',
            'hd_ide','hd_sata','hd_sas','hd_other',
            'cd_ide','cd_sata',
            'vga_onboard','vga_display','vga_pci','vga_pcie',
            'lan_onboard','lan_usb','lan_card','lan_pci','lan_pcie',
            'psu_ide','psu_sata'
        ];

        foreach ($checkboxes as $key) {
            $data[$key] = $request->has($key);
        }

        return $data;
    }
}
