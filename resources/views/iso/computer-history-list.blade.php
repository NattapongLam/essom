@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<style>
.form-container { background: #ffffff; border-radius: 18px; padding: 25px 30px; box-shadow: 0 6px 20px rgba(0,0,0,0.08); border: 1px solid #e0e0e0; margin-bottom: 25px; overflow-x: auto; }
.dt-button, #printBtn, #exportExcelBtn { background: linear-gradient(180deg, #cecacaff, #827c7cff); color: white !important; border: none; padding: 8px 18px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s ease; margin-right: 5px; }
.dt-button:hover, #printBtn:hover, #exportExcelBtn:hover { transform: scale(1.05); }
h2 { text-align: center; font-weight: 700; color: #0f172a; margin-bottom: 10px; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 13px; color: #1e293b; }
thead th { position: sticky; top: 0; background-color: #f0f0f0; z-index: 2; }
th, td { border: 1px solid #ddd; padding: 6px 8px; text-align: center; vertical-align: middle; }
tr:nth-child(even) { background-color: #fafafa; }
tr:hover { background-color: #e0f2fe; transition: 0.2s; }
.actions { display: flex; gap: 6px; justify-content: center; flex-wrap: wrap; }
button.edit, button.delete { border: none; color: white; padding: 6px 12px; border-radius: 6px; font-weight: 500; cursor: pointer; transition: 0.2s; }
button.edit { background: linear-gradient(180deg, #2563eb, #60a5fa); }
button.delete { background: linear-gradient(180deg, #dc2626, #ef4444); }
button.edit:hover, button.delete:hover { transform: scale(1.05); }
input[type="text"] { border: 1px solid #94a3b8; border-radius: 5px; padding: 6px 10px; font-size: 14px; background-color: #f8fafc; transition: 0.2s; }
input[type="text"]:focus { border-color: #1e40af; box-shadow: 0 0 4px rgba(59,130,246,0.3); background-color: #ffffff; outline: none; }
@media (max-width: 768px){
    table, thead, tbody, th, td, tr { display: block; }
    thead { display: none; }
    tr { margin-bottom: 15px; border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px; background-color: #ffffff; }
    td { display: flex; justify-content: space-between; padding: 6px 10px; border: none; border-bottom: 1px solid #e2e8f0; }
    td::before { content: attr(data-label); font-weight: 600; color: #1e3a8a; width: 45%; }
    .actions { flex-direction: column; align-items: stretch; }
}
</style>

<div class="form-container">
    <h2>รายการประวัติคอมพิวเตอร์</h2>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
        <a href="{{ route('computer-history.create') }}" class="primary">เพิ่มข้อมูลใหม่</a>
        <input type="text" id="searchInput" placeholder="🔍 ค้นหา..." style="width:220px;">
    </div>

    <button id="printBtn" class="dt-button">Print</button>
    <button id="exportExcelBtn" class="dt-button">Export Excel</button>

    <div style="overflow-x:auto; max-height:70vh;">
        <table id="computerTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User Name</th>
                    <th>No</th>
                    <th>Start Date</th>
                    <th>Computer Type</th>
                    <th>CPU / Spec</th>
                    <th>RAM</th>
                    <th>DIMM 1</th>
                    <th>DIMM 2</th>
                    <th>Other </th>
                    <th>Hard Disk</th>
                    <th>Disk 1</th>
                    <th>Disk 2</th>
                    <th>External Disk</th>
                    <th>CD/DVD</th>
                    <th>Drive 1</th>
                    <th>Drive 2</th>
                    <th>External CD</th>
                    <th>Main Board</th>
                    <th>VGA</th>
                    <th>LAN / Wireless</th>
                    <th>Power Supply</th>
                    <th>Monitor</th>
                    <th>Accessory</th>
                    <th>Software</th>
                    <th>Problem</th>
                    <th>Check / Acknowledge</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
            @forelse($histories as $item)
            <tr>
                <td data-label="#">{{ $loop->iteration }}</td>
                <td data-label="User Name">{{ $item->user_name }}</td>
                <td data-label="No">{{ $item->no_number }}</td>
                <td data-label="Start Date">{{ $item->start_date }}</td>
                <td data-label="Computer Type">
                    @if($item->type_pc) ✔ PC @endif
                    @if($item->type_notebook) ✔ Notebook @endif
                </td>
                <td data-label="CPU / Spec">{{ $item->cpu_spec }}</td>
                <td data-label="RAM">
                    @if($item->ram_ddr1) ✔ DDR1 @endif
                    @if($item->ram_ddr2) ✔ DDR2 @endif
                    @if($item->ram_ddr3) ✔ DDR3 @endif
                </td>
                <td data-label="DIMM 1">{{ $item->dimm1 }} @if($item->dimm1_warranty) | Warranty: {{ $item->dimm1_warranty }} @endif @if($item->dimm1_exp) | Exp: {{ $item->dimm1_exp }} @endif</td>
                <td data-label="DIMM 2">{{ $item->dimm2 }} @if($item->dimm2_warranty) | Warranty: {{ $item->dimm2_warranty }} @endif @if($item->dimm2_exp) | Exp: {{ $item->dimm2_exp }} @endif</td>
                <td data-label="Other RAM">{{ $item->ram_other }}</td>
                <td data-label="Hard Disk">
                    @if($item->hd_ide) ✔ IDE @endif
                    @if($item->hd_sata) ✔ SATA @endif
                    @if($item->hd_sas) ✔ SAS @endif
                    @if($item->hd_other) ✔ Other @endif
                    @if($item->hd_qty) <br>Qty: {{ $item->hd_qty }} @endif
                </td>
                <td data-label="Disk 1">{{ $item->disk1 }} @if($item->disk1_warranty) | Warranty: {{ $item->disk1_warranty }} @endif @if($item->disk1_exp) | Exp: {{ $item->disk1_exp }} @endif</td>
                <td data-label="Disk 2">{{ $item->disk2 }} @if($item->disk2_warranty) | Warranty: {{ $item->disk2_warranty }} @endif @if($item->disk2_exp) | Exp: {{ $item->disk2_exp }} @endif</td>
                <td data-label="External Disk">{{ $item->external_disk }}</td>
                <td data-label="CD/DVD">
                    @if($item->cd_ide) ✔ IDE @endif
                    @if($item->cd_sata) ✔ SATA @endif
                    @if($item->cd_qty) <br>Qty: {{ $item->cd_qty }} @endif
                </td>
                <td data-label="Drive 1">{{ $item->cd_drive1 }} @if($item->cd1_warranty) | Warranty: {{ $item->cd1_warranty }} @endif @if($item->cd1_exp) | Exp: {{ $item->cd1_exp }} @endif</td>
                <td data-label="Drive 2">{{ $item->cd_drive2 }} @if($item->cd2_warranty) | Warranty: {{ $item->cd2_warranty }} @endif @if($item->cd2_exp) | Exp: {{ $item->cd2_exp }} @endif</td>
                <td data-label="External CD">{{ $item->external_cd }}</td>
                <td data-label="Main Board">{{ $item->main_board_spec }}</td>
                <td data-label="VGA">{{ $item->vga_spec }}</td>
                <td data-label="LAN / Wireless">{{ $item->lan_spec }}</td>
                <td data-label="Power Supply">{{ $item->psu_result }}</td>
                <td data-label="Monitor">{{ $item->monitor_spec }}</td>
                <td data-label="Accessory">{{ $item->accessory }}</td>
                <td data-label="Software">{{ $item->software_other }}</td>
                <td data-label="Problem">{{ $item->problem }}</td>
                <td data-label="Check / Acknowledge">{{ $item->check_by }}</td>
                <td data-label="Actions">
                    <div class="actions">
    <button class="edit" onclick="openPopup({{ $item->id }})">ดู</button>
                        <a href="{{ route('computer-history.edit', $item->id) }}"><button class="edit">แก้ไข</button></a>
                        <form action="{{ route('computer-history.destroy', $item->id) }}" method="POST" onsubmit="return confirm('ยืนยันการลบข้อมูลนี้?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete">ลบ</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="28" style="text-align:center;">ไม่มีข้อมูล</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function openPopup(id) {
    const url = `/computer-history/${id}/popup`;
    window.open(url, 'popupWindow', 'width=1000,height=800,scrollbars=yes');
}
document.getElementById('searchInput').addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#computerTable tbody tr');
    rows.forEach(row => {
        row.style.display = Array.from(row.cells).some(cell => cell.innerText.toLowerCase().includes(filter)) ? '' : 'none';
    });
});

document.getElementById('printBtn').addEventListener('click', function() {
    const table = document.getElementById('computerTable').cloneNode(true);
    const actionColIndex = Array.from(table.querySelectorAll('th')).findIndex(th => th.innerText.includes('จัดการ'));
    if(actionColIndex !== -1){
        table.querySelectorAll('tr').forEach(tr => { if(tr.children[actionColIndex]) tr.children[actionColIndex].remove(); });
    }
    const win = window.open('', '', 'width=1200,height=800');
    win.document.write('<html><head><title>Print Computer History</title><style>body{font-family:sans-serif;margin:20px;}table{width:100%;border-collapse:collapse;}th,td{border:1px solid #ddd;padding:6px 8px;text-align:center;}th{background:#f0f0f0;}tr:nth-child(even){background:#fafafa;}tr:hover{background:#e0f2fe;}</style></head><body>');
    win.document.write('<h2 style="text-align:center;">รายการประวัติคอมพิวเตอร์</h2>');
    win.document.write(table.outerHTML);
    win.document.write('</body></html>');
    win.document.close();
    win.focus();
    win.print();
});

document.getElementById('exportExcelBtn').addEventListener('click', function() {
    const table = document.getElementById('computerTable');
    const rows = table.querySelectorAll('tr');
    let wb = XLSX.utils.book_new();
    let ws_data = [];
    const actionColIndex = Array.from(table.querySelectorAll('th')).findIndex(th => th.innerText.includes('จัดการ'));
    rows.forEach(row => {
        let rowData = [];
        row.querySelectorAll('th, td').forEach((cell, idx) => {
            if(idx !== actionColIndex) rowData.push(cell.innerText.trim());
        });
        if(rowData.length > 0) ws_data.push(rowData);
    });
    let ws = XLSX.utils.aoa_to_sheet(ws_data);
    ws['!cols'] = ws_data[0].map(col => ({wch: Math.max(...ws_data.map(r => r[col] ? r[col].length : 10)) + 5}));
    XLSX.utils.book_append_sheet(wb, ws, "Computer History");
    XLSX.writeFile(wb, "Computer_History.xlsx");
});
</script>
@endsection
