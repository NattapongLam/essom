@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'สำเร็จ!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#1e40af'
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'เกิดข้อผิดพลาด!',
    text: "{{ session('error') }}",
    confirmButtonColor: '#dc2626'
});
</script>
@endif

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
.dt-button:hover, #printBtn:hover, #exportExcelBtn:hover {
    transform: scale(1.05);
}

input#searchInput {
    border: 1px solid #94a3b8;
    border-radius: 5px;
    padding: 6px 10px;
    font-size: 14px;
    width: 250px;
    background-color: #f8fafc;
}
input#searchInput:focus {
    border-color: #1e40af;
    box-shadow: 0 0 4px rgba(59,130,246,0.3);
    background-color: #ffffff;
    outline: none;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 13px;
    color: #1e293b;
    table-layout: fixed;
}
th, td {
    border: 1px solid #ddd;
    padding: 6px 8px;
    text-align: center;
    vertical-align: middle;
    word-wrap: break-word;
}
tr:nth-child(even) { background-color: #fafafa; }
tr:hover { background-color: #e0f2fe; transition: 0.2s; }

button.primary, button.edit, button.delete {
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    color: white;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}
button.primary { background: linear-gradient(180deg, #1e3a8a, #3b82f6); }
button.edit { background: linear-gradient(180deg, #2563eb, #60a5fa); }
button.delete { background: linear-gradient(180deg, #dc2626, #ef4444); }
button.primary:hover, button.edit:hover, button.delete:hover { transform: scale(1.05); }

.actions { display: flex; gap: 8px; justify-content: center; flex-wrap: wrap; }

@media print {
    #printBtn, #exportExcelBtn, #searchInput, .primary, form button, a button {
        display: none !important;
    }
}

@media (max-width: 640px){
    table, thead, tbody, th, td, tr { display: block; }
    thead { display: none; }
    tr { margin-bottom: 15px; border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px; background-color: #ffffff; }
    td { display: flex; justify-content: space-between; padding: 6px 10px; border: none; border-bottom: 1px solid #e2e8f0; }
    td::before { content: attr(data-label); font-weight: 600; color: #1e3a8a; width: 45%; }
    .actions { flex-direction: column; align-items: stretch; gap: 6px; margin-top: 10px; }
}
</style>

<div class="form-container">
    <h2 align="center">ESSOM CO.,LTD.</h2>
    <h2 align="center">ประวัติเครื่องจักร EQUIPMENT RECORD</h2>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
        <a href="{{ route('machine-history.create') }}" class="primary">เพิ่มข้อมูลใหม่</a>
        <input type="text" id="searchInput" placeholder="🔍 ค้นหา..." style="width:220px;">
    </div>
            <button id="printBtn" class="dt-button">print</button>
     <button id="exportExcelBtn" class="dt-button">excel</button>
  
    <table id="activityTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>ชื่อเครื่องจักร</th>
                <th>หมายเลข</th>
                <th>วันที่เริ่มใช้</th>
                <th>หน่วยงานที่รับผิดชอบ</th>
                <th>วัน/เดือน/ปี</th>
                <th>รายการซ่อม/เปลี่ยน</th>
                <th>ผู้ซ่อม</th>
                <th>หมายเหตุ</th>
                <th>[ปุ่มลบ/แก้ไข]</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($machines as $machine)
                @php
                    $dates = json_decode($machine->repair_date, true) ?? [];
                    $descriptions = json_decode($machine->repair_description, true) ?? [];
                    $persons = json_decode($machine->repair_person, true) ?? [];
                    $rows = max(count($dates), count($descriptions), count($persons), 1);
                @endphp

                @for($i = 0; $i < $rows; $i++)
                    <tr>
                        @if($i==0)
                            <td rowspan="{{ $rows }}" data-label="No.">{{ $no++ }}</td>
                            <td rowspan="{{ $rows }}" data-label="ชื่อเครื่องจักร">{{ $machine->machine_name }}</td>
                            <td rowspan="{{ $rows }}" data-label="หมายเลข">{{ $machine->machine_number }}</td>
                            <td rowspan="{{ $rows }}" data-label="วันที่เริ่มใช้">{{ $machine->date_start }}</td>
                            <td rowspan="{{ $rows }}" data-label="หน่วยงาน">{{ $machine->department }}</td>
                        @endif
                        <td data-label="วัน/เดือน/ปี">{{ $dates[$i] ?? '' }}</td>
                        <td data-label="รายการซ่อม/เปลี่ยน">{{ $descriptions[$i] ?? '' }}</td>
                        <td data-label="ผู้ซ่อม">{{ $persons[$i] ?? '' }}</td>
                        @if($i==0)
                            <td rowspan="{{ $rows }}" data-label="หมายเหตุ">{{ $machine->remarks ?? '-' }}</td>
                            <td rowspan="{{ $rows }}" data-label="[ปุ่มลบ/แก้ไข]">
                                <div class="actions">
                                    <a href="{{ route('machine-history.edit', $machine->id) }}"><button class="edit">แก้ไข</button></a>
                                    <form action="{{ route('machine-history.destroy', $machine->id) }}" method="POST" onsubmit="return confirm('คุณต้องการลบใช่หรือไม่?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete">ลบ</button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endfor
            @endforeach
        </tbody>
    </table>
</div>
 </div>
 </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
document.getElementById('printBtn').addEventListener('click', function() {
    const table = document.getElementById('activityTable');
    const actionColIndex = table.querySelector('thead tr').children.length - 1;
    const rows = table.querySelectorAll('tr');
    const hiddenCells = [];
    rows.forEach(row => {
        const cell = row.children[actionColIndex];
        if (cell) { hiddenCells.push(cell); cell.style.display = 'none'; }
    });
    window.print();
    hiddenCells.forEach(cell => cell.style.display = '');
});

document.getElementById('exportExcelBtn').addEventListener('click', function() {
    const table = document.getElementById('activityTable');
    const wb = XLSX.utils.book_new();
    const ws = XLSX.utils.table_to_sheet(table);
    const colWidths = [
        { wch: 5 },   
        { wch: 20 }, 
        { wch: 15 },  
        { wch: 15 },  
        { wch: 18 },  
        { wch: 15 }, 
        { wch: 30 },  
        { wch: 15 },  
        { wch: 20 }, 
    ];
    ws['!cols'] = colWidths;

    XLSX.utils.book_append_sheet(wb, ws, "Machine History");
    XLSX.writeFile(wb, "Machine_History.xlsx");
});
Object.keys(ws).forEach(cell => {
    if (ws[cell].v && /^\d{4}-\d{2}-\d{2}$/.test(ws[cell].v)) {
        ws[cell].t = 'd'; 
    }
});
</script>
@endsection
