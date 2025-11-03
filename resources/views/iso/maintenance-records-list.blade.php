@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<div class="mt-4">
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h2>ESSOM CO.,LTD.<br>คำขอแก้ไข รายการบันทึกการบำรุงเครื่องจักร <br> EQUIPMENT MAINTENANCE RECORD</h2>
                    <p class="text-right mb-0">F6200.1<br>9 Apr 24</p>
                    <p class="text-left">
    
  <a href="{{ route('maintenance-records.create') }}">เพิ่มข้อมูลใหม่</a>
                    </p>    
                </div>
      <div class="card-body">             
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-bordered table-sm text-center">
                            <thead>
                                <tr>
        <tr>
            <th>No.</th>
            <th>ผู้ตรวจ</th>
            <th>วันที่ตรวจ</th>
            <th>แก้ไข </th>
            <th> ลบ</th>
        </tr>
        @foreach($records as $i => $record)
    @if($record && $record->inspector)
    <tr>
        <td>{{ intval($i) + 1 }}</td>
        <td>{{ $record->inspector }}</td>
        <td>{{ $record->inspection_date ? \Carbon\Carbon::parse($record->inspection_date)->format('Y-m-d') : '' }}</td>
        <td>
            <a href="{{ route('maintenance-records.edit', $record->id) }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i>
            </a>
        </td>
        <td>
            <form action="{{ route('maintenance-records.destroy', $record->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
    @endif
@endforeach

    </table>
</div>
</div>
</div>
</div>
</div>
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
