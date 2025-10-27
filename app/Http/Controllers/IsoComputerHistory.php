<?php

namespace App\Http\Controllers;

use App\Models\ComputerHistory;
use Illuminate\Http\Request;

class IsoComputerHistory extends Controller
{

    public function index()
    {
        $histories = ComputerHistory::latest()->paginate(10);
        return view('iso.computer-history-list', compact('histories'));
    }

    public function create()
    {
        return view('iso.computer-history-create');
    }

 
    public function store(Request $request)
    {
        $data = $this->validateRequest($request); 
    ComputerHistory::create($data);

    return redirect()
        ->route('computer-history.index')
        ->with('success', 'บันทึกข้อมูลเรียบร้อย');
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
        $item = ComputerHistory::findOrFail($id);
        $data = $this->validateRequest($request);
        $item->update($data);

        return redirect()
            ->route('computer-history.index')
            ->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว!');
    }

    public function destroy($id)
    {
        $item = ComputerHistory::findOrFail($id);
        $item->delete();

        return redirect()
            ->route('computer-history.index')
            ->with('success', 'ลบข้อมูลเรียบร้อยแล้ว!');
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
