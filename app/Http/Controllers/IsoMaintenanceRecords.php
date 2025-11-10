<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceRecord;
use Illuminate\Support\Facades\DB;

class IsoMaintenanceRecords extends Controller
{

    private function maintenanceItems()
    {
        return [
            "1. เปลี่ยนน้ำมันเครื่อง","2. เปลี่ยนน้ำยาหล่อลื่น","3. เปลี่ยนสายพาน",
            "4. ตรวจความตึงสายพาน/โซ่","5. ตรวจการทำงานระบบเบรค","6. ตรวจการทำงานระบบไฟ",
            "7. ตรวจการทำงานทั่วไป","8. เป่า/ล้างทำความสะอาดตัวเครื่อง/หัวฉีด",
            "9. ตรวจความหลวมของบูชชิ่ง/บานประตู","10. อัดจารบีลูกปืน/บูชชิ่ง",
            "11. ตรวจระดับน้ำมัน","12. ทำความสะอาดใส้กรองอากาศ","13. ตรวจจุดสายไฟ/สายลม",
            "14. ตรวจจุดขันข้อต่อ,เกลียวต่างๆ","15. สภาพเกจวัดความดัน","16. ความถูกต้องของอุณภูมิ/เวลาที่ตั้ง",
            "17. ระดับอากาศที่ Manometer","18. ชโลมจารบีที่สลิง/โซ่"
        ];
    }


    private function machines()
    {
        return [
            'SB1 ตู้พ่นสีแบบแห้ง', 'SB2 ตู้พ่นสีผง', 'SB3 ตู้อบสี', 'SB4 เครื่องพ่นสีผง',
            'SB5 ห้องพ่นสีใหญ่', 'SB6 ตู้พ่นทราย', 'WE3 เครื่องเชื่อมอาก้อน', 'WE4 เครื่องเชื่อมมิกซ์',
            'WA3 เครื่องเชื่อม Spot', 'ML1 เครื่องกลึง', 'ML2 เครื่องกลึง', 'ML3 เครื่องกลึง',
            'ML4 เครื่องกลึง', 'ML5 เครื่องต๊าปเกลียวท่อ', 'ML6 เครื่องกลึง', 'ML7 เครื่องกลึง COMP',
            'MM1 เครื่องมิลลิ่ง', 'MM2 เครื่องมิลลิ่ง', 'MM3 เครื่องมิลลิ่ง', 'MM4 เครื่องมิลลิ่ง CNC',
            'MS2 เครื่องตัดแผ่นเหล็ก', 'MS5 เครื่องม้วนเหล็กเล็ก', 'MD1 แท่นเจาะตั้งพื้น',
            'MD2 แท่นเจาะตั้งพื้น', 'MD3 แท่นเจาะตั้งพื้น', 'MD7 แท่นเจาะตั้งพื้น', 'MD12 แท่นเจาะตั้งพื้น',
            'MG5 เครื่องลับดอกส่วน', 'AC1 ปั้มลม', 'AC2 ปั้มลม', 'AC3 ปั้มลม',

            'HP1 แท่นไฮดรอลิก','HQ1: เครนไฟฟ้า','HQ6: เครนไฟฟ้า','HQ4 รถยก',
            'HQ8 รถยกสูง','SA1: เครื่องเลื่อย','SA2 เครื่องเลื่อย','SA5 เครื่องเลื่อยสายพาน',
            'CF1: เครื่องตัดไฟเบอร์','CP1 เครื่องตัดพลาสม่า','GE เครื่องปั่นไฟ 60 Hz','MDB1: ตู้ควบคุมไฟฟ้า',
            'MMDB2 ตู้ควบคุมไฟฟ้า','MDB3 ตู้ควบคุมไฟโซลาร์เซลล์ (เล็ก)','MDB4 ตู้ควบคุมไฟโซลาร์เซลล์ (ใหญ่)',
            'SC1 แผงโซลาร์เซลล์ (เล็ก)','SC2: แผงโซลาร์เซลล์ (ใหญ่)'
        ];
    }


    public function index()
    {
        $maintenance_items = $this->maintenanceItems();
        $machines = $this->machines();
        $records = MaintenanceRecord::all()->keyBy('machine_name');

        foreach ($records as $record) {
            $record->status = is_string($record->status) ? json_decode($record->status, true) : ($record->status ?? []);
        }

        return view('iso.maintenance-records-list', compact('maintenance_items', 'machines', 'records'));
    }

    public function create()
    {
        $maintenance_items = $this->maintenanceItems();
        $machines = $this->machines();
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();
        return view('iso.maintenance-records-create', compact('maintenance_items', 'machines','emp'));
    }

 
    public function store(Request $request)
    {
        $statusData = $request->input('status', []);
        $inspectorData = $request->input('inspector', []);
        $inspectionDateData = $request->input('inspection_date', []);

        foreach ($statusData as $machine => $statuses) {
            $record = MaintenanceRecord::firstOrNew(['machine_name' => $machine]);
            $record->status = json_encode(array_map('intval', $statuses), JSON_UNESCAPED_UNICODE);
            $record->inspector = $inspectorData[$machine] ?? null;
            $record->inspection_date = $inspectionDateData[$machine] ?? null;
            $record->save();
        }

        return redirect()->route('maintenance-records.index')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว!');
    }


    public function edit()
    {
        $maintenance_items = $this->maintenanceItems();
        $machines = $this->machines();
        $records = MaintenanceRecord::all()->keyBy('machine_name');

        foreach ($records as $record) {
            $record->status = is_string($record->status) ? json_decode($record->status, true) : ($record->status ?? []);
        }

        return view('iso.maintenance-records-edit', compact('records', 'maintenance_items', 'machines'));
    }

    public function update(Request $request)
    {
        $statusData = $request->input('status', []);
        $inspectorData = $request->input('inspector', []);
        $inspectionDateData = $request->input('inspection_date', []);

        foreach ($statusData as $machine => $statuses) {
            MaintenanceRecord::updateOrCreate(
                ['machine_name' => $machine],
                [
                    'status' => json_encode($statuses, JSON_UNESCAPED_UNICODE),
                    'inspector' => $inspectorData[$machine] ?? null,
                    'inspection_date' => $inspectionDateData[$machine] ?? null
                ]
            );
        }

        return redirect()->route('maintenance-records.index')->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว!');
    }

    public function destroy($id)
    {
        MaintenanceRecord::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'ลบข้อมูลเรียบร้อยแล้ว!');
    }
}
