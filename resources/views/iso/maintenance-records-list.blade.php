@extends('layouts.main')
@section('content')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

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
h2 { text-align: center; font-weight: 800; color: #0f172a; margin-bottom: 20px; }
table { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 14px; color: #1e293b; }
th, td { border: 1px solid #cbd5e1; padding: 8px 10px; text-align: center; vertical-align: middle; }
th { background-color: #dcddddff; color: #000000ff; font-weight: 600; text-transform: uppercase; }
tr:nth-child(even) { background-color: #f1f5f9; }
tr:hover { background-color: #e0f2fe; }
button.view-btn, button.edit, button.delete, .dt-button {
    transition: all 0.2s ease;
    cursor: pointer;
    border: none;
}
button.view-btn { background: linear-gradient(180deg, #5a7eadff, #3c588dffff); color: white; padding: 8px 14px; border-radius: 6px; font-weight: 500; }
button.edit { background: linear-gradient(180deg, #2563eb, #60a5fa); color: white; padding: 8px 14px; border-radius: 6px; font-weight: 500; }
button.delete { background: linear-gradient(180deg, #dc2626, #ef4444); color: white; padding: 8px 14px; border-radius: 6px; font-weight: 500; }
.dt-button { background: linear-gradient(180deg, #dbd2d2ff, #e3e7ebff); color: white !important; padding: 8px 18px; border-radius: 8px; font-weight: 600; margin-right: 5px; }
.actions { display:flex; gap:8px; justify-content:center; flex-wrap: wrap; }
</style>

<div class="form-container">
    <h2>รายการบันทึกการบำรุงเครื่องจักร EQUIPMENT MAINTENANCE RECORD</h2>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
        <a href="{{ route('maintenance-records.create') }}" class="primary">เพิ่มข้อมูลใหม่</a>
        <input type="text" id="searchInput" placeholder="🔍 ค้นหา..." style="width:220px;">
    </div>
    <button id="printBtn" class="dt-button">print</button>
    <button id="exportExcelBtn" class="dt-button">excel</button>

    <table id="maintenanceTable">
        <tr>
            <th>No.</th>
            <th>ผู้ตรวจ</th>
            <th>วันที่ตรวจ</th>
            <th>[แก้ไข / ลบ]</th>
        </tr>
        @foreach($records as $i => $record)
            @if($record && $record->inspector)
            <tr>
                <td>{{ intval($i) + 1 }}</td>
                <td>{{ $record->inspector }}</td>
                <td>{{ $record->inspection_date ? \Carbon\Carbon::parse($record->inspection_date)->format('Y-m-d') : '' }}</td>
                <td class="actions">
                    <a href="{{ route('maintenance-records.edit', $record->id) }}"><button class="edit">แก้ไข</button></a>
                    <form action="{{ route('maintenance-records.destroy', $record->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete" onclick="return confirm('ยืนยันการลบ?')">ลบ</button>
                    </form>
                </td>
            </tr>
            @endif
        @endforeach
    </table>

    <div id="pagination" style="margin-top:15px; text-align:center;"></div>
</div>

<script>
document.getElementById('searchInput').addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#maintenanceTable tr:not(:first-child)');
    rows.forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
    });
});

document.getElementById('printBtn').addEventListener('click', function() { window.print(); });
document.getElementById('exportExcelBtn').addEventListener('click', function() {
    const table = document.getElementById('maintenanceTable');
    const wb = XLSX.utils.book_new();
    const ws_data = [];
    const rows = table.querySelectorAll('tr');
    rows.forEach(row => {
        const rowData = [];
        row.querySelectorAll('th, td').forEach(cell => rowData.push(cell.innerText.trim()));
        ws_data.push(rowData);
    });
    const ws = XLSX.utils.aoa_to_sheet(ws_data);
    ws['!cols'] = ws_data[0].map(col => ({ wch: 20 }));
    XLSX.utils.book_append_sheet(wb, ws, "Maintenance");
    XLSX.writeFile(wb, "Maintenance_Record.xlsx");
});

document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('maintenanceTable');
    const rows = Array.from(table.querySelectorAll('tr:not(:first-child)'));
    const rowsPerPage = 10;
    let currentPage = 1;
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    function showPage(page) {
        currentPage = page;
        rows.forEach((row, index) => {
            row.style.display = (index >= (page-1)*rowsPerPage && index < page*rowsPerPage) ? '' : 'none';
        });
        renderPagination();
    }

    function renderPagination() {
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = `
            <button id="prevPage" ${currentPage === 1 ? 'disabled' : ''}>ก่อนหน้า</button>
            <span> หน้า ${currentPage} / ${totalPages} </span>
            <button id="nextPage" ${currentPage === totalPages ? 'disabled' : ''}>ถัดไป</button>
        `;
        document.getElementById('prevPage').addEventListener('click', () => showPage(currentPage - 1));
        document.getElementById('nextPage').addEventListener('click', () => showPage(currentPage + 1));
    }

    showPage(1);
});
</script>
@endsection
