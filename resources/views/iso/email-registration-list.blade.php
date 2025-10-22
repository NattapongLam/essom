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
.dt-button:hover, #printBtn:hover, #exportExcelBtn:hover { transform: scale(1.05); }
h2, h3 { text-align: center; font-weight: 700; color: #0f172a; margin-bottom: 8px; }
h3 { font-weight: 500; }
h4 { margin-top: 20px; margin-bottom: 10px; font-weight: 600; color: #1e3a8a; }
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 13px;
    color: #1e293b;
    table-layout: fixed;
}
thead th {
    position: sticky;
    top: 0;
    background-color: #f0f0f0;
    z-index: 2;
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
td a { color: #1e40af; text-decoration: none; font-weight: 500; }
td a:hover { text-decoration: underline; }
button.primary, button.edit, button.delete { transition: all 0.2s ease; }
button.primary:hover, button.edit:hover, button.delete:hover { transform: scale(1.05); }
button.primary {
    background: linear-gradient(180deg, #1e3a8a, #3b82f6);
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
}
button.edit {
    background: linear-gradient(180deg, #2563eb, #60a5fa);
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
}
button.delete {
    background: linear-gradient(180deg, #dc2626, #ef4444);
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
}
input, textarea, select {
    border: 1px solid #94a3b8;
    border-radius: 5px;
    padding: 6px 10px;
    font-size: 14px;
    width: 100%;
    box-sizing: border-box;
    background-color: #f8fafc;
    transition: 0.2s;
}
input:focus, textarea:focus {
    border-color: #1e40af;
    box-shadow: 0 0 4px rgba(59,130,246,0.3);
    background-color: #ffffff;
    outline: none;
}
.actions {
    display:flex;
    gap:8px;
    justify-content:center;
    flex-wrap: wrap;
}
@media (max-width: 1024px){
    table, th, td { font-size: 12px; }
    .form-container { width: 95%; padding: 20px; }
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
    <h2>ทะเบียนผู้ใช้ Email Account</h2>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
        <a href="{{ route('email-registration.create') }}" class="primary">เพิ่มข้อมูลใหม่</a>
        <input type="text" id="searchInput" placeholder="🔍 ค้นหา..." style="width:220px;">
    </div>

    <button id="printBtn" class="dt-button">print</button>
    <button id="exportExcelBtn" class="dt-button">excel</button>

   <table id="activityTable" width="100%" border="1" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
    <thead>
        <tr>
                <th>No</th>
                <th>Item</th>
                <th>Email Account</th>
                <th>Password</th>
                <th>User</th>
                <th>Position</th>
                <th>Department</th>
                <th>Approved By</th>
                <th>Date</th>
                <th>Remark</th>
                <th>ปุ่มลบ/แก้ไข</th>
            </tr>
        </thead>
        <tbody>
            @forelse($records as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->item }}</td>
                <td>{{ $record->email_account }}</td>
                <td>{{ $record->password }}</td>
                <td>{{ $record->user_name }}</td>
                <td>{{ $record->position }}</td>
                <td>{{ $record->department }}</td>
                <td>{{ $record->approved_by }}</td>
                <td>{{ $record->date }}</td>
                <td>{{ $record->remark }}</td>
                <td>
                    <div class="actions">
                        <a href="{{ route('email-registration.edit', $record->id) }}">
                            <button class="edit">แก้ไข</button>
                        </a>
                        <form action="{{ route('email-registration.destroy', $record->id) }}" method="POST" onsubmit="return confirm('คุณต้องการลบแผนนี้ใช่หรือไม่?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete">ลบ</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="12" style="text-align:center;">ไม่มีข้อมูล</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
document.getElementById('printBtn').addEventListener('click', function() {
    const table = document.getElementById('activityTable');
    const actionColIndex = table.rows[0].cells.length - 1;

    const hiddenCells = [];
    for (let row of table.rows) {
        if (row.cells[actionColIndex]) {
            hiddenCells.push(row.cells[actionColIndex]);
            row.cells[actionColIndex].style.display = 'none';
        }
    }

    window.print();

    hiddenCells.forEach(cell => cell.style.display = '');
});

document.getElementById('exportExcelBtn').addEventListener('click', function() {
    const table = document.getElementById('activityTable');
    const rows = table.querySelectorAll('tr');
    const ws_data = [];
    rows.forEach(row => {
        const rowData = [];
        const cells = row.querySelectorAll('th, td');
        for (let i = 0; i < cells.length - 1; i++) {
            rowData.push(cells[i].innerText.trim());
        }
        ws_data.push(rowData);
    });

    const ws = XLSX.utils.aoa_to_sheet(ws_data);
    const range = XLSX.utils.decode_range(ws['!ref']);
    for (let R = range.s.r; R <= range.e.r; ++R) {
        for (let C = range.s.c; C <= range.e.c; ++C) {
            const cell_address = XLSX.utils.encode_cell({r:R, c:C});
            if (!ws[cell_address]) continue;
            ws[cell_address].s = {
                border: {
                    top: {style:"thin", color:{rgb:"000000"}},
                    bottom: {style:"thin", color:{rgb:"000000"}},
                    left: {style:"thin", color:{rgb:"000000"}},
                    right: {style:"thin", color:{rgb:"000000"}},
                },
                alignment: { vertical: "center", horizontal: "center", wrapText: true }
            };
            if (R === 0) {
                ws[cell_address].s.fill = {
                    fgColor: {rgb: "DCE6F1"} 
                };
                ws[cell_address].s.font = { bold: true, color: { rgb: "000000" } };
            }
        }
    }
    const colWidths = [];
    ws_data[0].forEach((_, i) => {
        let maxLen = Math.max(...ws_data.map(r => (r[i] ? r[i].length : 0)));
        colWidths.push({ wch: maxLen + 2 });
    });
    ws['!cols'] = colWidths;
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "EmailRegistry");
    XLSX.writeFile(wb, "Email_Registry.xlsx");
});

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const rows = document.querySelectorAll('#activityTable tbody tr');

    searchInput.addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        rows.forEach(row => {
            const match = [...row.cells].some(cell => cell.innerText.toLowerCase().includes(filter));
            row.style.display = match ? '' : 'none';
        });
    });
});
</script>
@endsection
