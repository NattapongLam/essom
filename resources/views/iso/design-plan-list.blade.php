@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<style>
.form-container {
    background: #ffffff;
    border-radius: 18px;
    padding: 25px 30px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    margin-bottom: 25px;
    overflow-x: auto;
}
.dt-button, #printBtn, #exportExcelBtn {
    background: linear-gradient(180deg, #cecacaff, #827c7cff);
    color: white !important;
    border: none;
    padding: 8px 18px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    margin-right: 5px;
}
.dt-button:hover, #printBtn:hover, #exportExcelBtn:hover { transform: scale(1.05); }
h2 { text-align: center; font-weight: 700; color: #0f172a; margin-bottom: 10px; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 13px; color: #1e293b; }
thead th { position: sticky; top: 0; background-color: #f0f0f0; z-index: 2; }
th, td { border: 1px solid #ddd; padding: 6px 8px; text-align: center; vertical-align: middle; }
tr:nth-child(even) { background-color: #fafafa; }
tr:hover { background-color: #e0f2fe; transition: 0.2s; }
.actions { display: flex; gap: 6px; justify-content: center; flex-wrap: wrap; }
button.edit, button.delete {
    border: none; color: white; padding: 6px 12px; border-radius: 6px;
    font-weight: 500; cursor: pointer; transition: 0.2s;
}
button.edit { background: linear-gradient(180deg, #2563eb, #60a5fa); }
button.delete { background: linear-gradient(180deg, #dc2626, #ef4444); }
button.edit:hover, button.delete:hover { transform: scale(1.05); }
input[type="text"] {
    border: 1px solid #94a3b8; border-radius: 5px; padding: 6px 10px;
    font-size: 14px; background-color: #f8fafc; transition: 0.2s;
}
input[type="text"]:focus {
    border-color: #1e40af; box-shadow: 0 0 4px rgba(59,130,246,0.3);
    background-color: #ffffff; outline: none;
}
@media (max-width: 768px){
    table, thead, tbody, th, td, tr { display: block; }
    thead { display: none; }
    tr { margin-bottom: 15px; border: 1px solid #cbd5e1; border-radius: 8px;
         padding: 10px; background-color: #ffffff; }
    td { display: flex; justify-content: space-between; padding: 6px 10px;
         border: none; border-bottom: 1px solid #e2e8f0; }
    td::before { content: attr(data-label); font-weight: 600; color: #1e3a8a; width: 45%; }
    .actions { flex-direction: column; align-items: stretch; }
}
</style>

<div class="form-container">
    <h2>รายการ Design Plan</h2>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
        <a href="{{ route('design-plan.create') }}" class="primary">เพิ่มข้อมูลใหม่</a>
        <input type="text" id="searchInput" placeholder="🔍 ค้นหา..." style="width:220px;">
    </div>

    <button id="printBtn" class="dt-button">Print</button>
    <button id="exportExcelBtn" class="dt-button">Export Excel</button>

    <div style="overflow-x:auto; max-height:70vh;">
        <table id="planTable">
            <thead>
                <tr>
                    <th>No</th>
                    @php
                        $allFields = [
                            'design_request_date','product_name','product_model','product_description',
                            'reason_cost_price','reason_catalog_picture','reason_drawing','reason_prototype','reason_other',
                            'requested_by','reviewed_by','approved_by_request','engineer_desing','senior_engineer'
                        ];
                        $headerFields = [];
                        if($plans->count() > 0){
                            $plan = $plans->first();
                            foreach($allFields as $f){
                                if(in_array($f, ['reason_cost_price','reason_catalog_picture','reason_drawing','reason_prototype'])){
                                    if($plan->$f) $headerFields[] = $f;
                                } else {
                                    if(!empty($plan->$f)) $headerFields[] = $f;
                                }
                            }
                        }
                    @endphp
                    @foreach($headerFields as $f)
                        <th>{{ ucwords(str_replace('_',' ',$f)) }}</th>
                    @endforeach
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($plans as $plan)
                    <tr>
                        <td data-label="No">{{ $loop->iteration }}</td>
                        @foreach($headerFields as $f)
                            <td data-label="{{ ucwords(str_replace('_',' ',$f)) }}">
                                @if(in_array($f, ['reason_cost_price','reason_catalog_picture','reason_drawing','reason_prototype']))
                                    @if($plan->$f) ✔ @endif
                                @else
                                    {{ $plan->$f }}
                                @endif
                            </td>
                        @endforeach
                        <td class="actions">
                            <button class="edit" onclick="openPopup({{ $plan->id }})">ดู</button>
                            <a href="{{ route('design-plan.edit', $plan->id) }}"><button class="edit">แก้ไข</button></a>
                            <form action="{{ route('design-plan.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('ยืนยันการลบข้อมูลนี้?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete">ลบ</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($headerFields)+2 }}" style="text-align:center;">ไม่มีข้อมูล</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function openPopup(id) {
    const url = `/design-plan/${id}/popup`;
    window.open(url, 'popupWindow', 'width=1000,height=800,scrollbars=yes');
}

document.getElementById('searchInput').addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#planTable tbody tr');

    rows.forEach(row => {
        const match = Array.from(row.cells).some(cell =>
            cell.innerText.toLowerCase().includes(filter)
        );
        row.style.display = match ? '' : 'none';
    });
});
document.getElementById('searchInput').addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#planTable tbody tr');
    rows.forEach(row => {
        const match = Array.from(row.cells).some(cell =>
            cell.innerText.toLowerCase().includes(filter)
        );
        row.style.display = match ? '' : 'none';
    });
});

document.getElementById('printBtn').addEventListener('click', function() {
    const table = document.getElementById('planTable').cloneNode(true);
    const actionColIndex = Array.from(table.querySelectorAll('th')).findIndex(th => th.innerText.includes('Actions'));
    if(actionColIndex !== -1){
        table.querySelectorAll('tr').forEach(tr => {
            if(tr.children[actionColIndex]) tr.children[actionColIndex].remove();
        });
    }
    const win = window.open('', '', 'width=1200,height=800');
    win.document.write('<html><head><title>Print Design Plan</title><style>body{font-family:sans-serif;margin:20px;}table{width:100%;border-collapse:collapse;}th,td{border:1px solid #ddd;padding:6px 8px;text-align:center;}th{background:#f0f0f0;}tr:nth-child(even){background:#fafafa;}tr:hover{background:#e0f2fe;}</style></head><body>');
    win.document.write('<h2 style="text-align:center;">รายการ Design Plan</h2>');
    win.document.write(table.outerHTML);
    win.document.write('</body></html>');
    win.document.close();
    win.focus();
    win.print();
});

document.getElementById('exportExcelBtn').addEventListener('click', function() {
    const table = document.getElementById('planTable');
    const rows = table.querySelectorAll('tr');
    let wb = XLSX.utils.book_new();
    let ws_data = [];
    rows.forEach(row => {
        let rowData = [];
        row.querySelectorAll('th, td').forEach(cell => rowData.push(cell.innerText.trim()));
        if(rowData.length>0) ws_data.push(rowData);
    });
    let ws = XLSX.utils.aoa_to_sheet(ws_data);
    XLSX.utils.book_append_sheet(wb, ws, "Design Plan");
    XLSX.writeFile(wb, "Design_Plan.xlsx");
});
</script>
@endsection
