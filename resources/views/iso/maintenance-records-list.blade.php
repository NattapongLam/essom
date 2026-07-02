@extends('layouts.main')
@section('content')

{{-- @push('styles') --}}
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}

<style>
    /* Modern Indigo Theme Layout */
    .custom-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05);
        border: 1px solid #e2e8f0;
        margin-top: 30px;
        margin-bottom: 30px;
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
    }

    /* Header Component Design */
    .card-header-modern {
        background-color: #ffffff;
        padding: 2rem 2.5rem 1.2rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-title-block h2 {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
        font-size: 1.4rem;
        line-height: 1.5;
    }

    .doc-number-badge {
        position: absolute;
        top: 2rem;
        right: 2.5rem;
        text-align: right;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        color: #64748b;
        line-height: 1.4;
    }

    /* Toolbar Layout */
    .toolbar-panel {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 25px;
    }

    .search-input-group {
        position: relative;
        max-width: 320px;
        width: 100%;
    }
    .search-input-group i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.9rem;
    }
    .form-control-search {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 8px 12px 8px 35px;
        font-size: 0.88rem;
        width: 100%;
        background-color: #ffffff;
        transition: all 0.2s ease;
    }
    .form-control-search:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    /* Table Component Design */
    .table-responsive-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        margin-bottom: 5px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    table.table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
        margin-bottom: 0 !important;
    }

    table.table-modern th {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
        font-weight: 600;
        border: 1px solid #4338ca !important;
        padding: 12px 8px;
        font-size: 0.88rem;
    }

    table.table-modern td {
        padding: 12px 8px;
        border: 1px solid #e2e8f0;
        vertical-align: middle;
        background-color: #ffffff;
    }

    table.table-modern tbody tr:hover td {
        background-color: #f8fafc;
    }

    /* Buttons Component */
    .btn-indigo-add {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: #ffffff !important;
        border: none;
        padding: 8px 18px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.88rem;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }
    .btn-indigo-add:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    .btn-outline-action {
        background-color: #ffffff;
        color: #475569;
        border: 1px solid #cbd5e1;
        padding: 8px 14px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-outline-action:hover {
        background-color: #f1f5f9;
        color: #1e293b;
        border-color: #94a3b8;
    }

    .btn-table-edit {
        background-color: #fef3c7;
        color: #d97706;
        border: 1px solid #fde68a;
        padding: 6px 10px;
        border-radius: 6px;
        display: inline-flex;
        transition: all 0.2s;
    }
    .btn-table-edit:hover {
        background-color: #d97706;
        color: #ffffff;
    }

    .btn-table-delete {
        background-color: #fff5f5;
        color: #e53e3e;
        border: 1px solid #fed7d7;
        padding: 6px 10px;
        border-radius: 6px;
        display: inline-flex;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-table-delete:hover {
        background-color: #e53e3e;
        color: #ffffff;
    }

    /* Custom Style SweetAlert Buttons */
    .swal-confirm-btn {
        background-color: #4f46e5 !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 8px 20px !important;
        margin: 0 5px !important;
    }
    .swal-cancel-btn {
        background-color: #ef4444 !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 8px 20px !important;
        margin: 0 5px !important;
    }

    /* Custom Pagination Layout */
    .pagination-wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        font-size: 0.9rem;
        color: #475569;
    }
    .btn-page-nav {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-page-nav:hover:not(:disabled) {
        background: #f1f5f9;
        color: #4f46e5;
        border-color: #a5b4fc;
    }
    .btn-page-nav:disabled {
        background: #f8fafc;
        color: #cbd5e1;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .doc-number-badge { position: relative; top: 0; right: 0; text-align: left; display: inline-block; margin-top: 10px; }
        .card-header-modern { padding: 1.5rem; }
        .toolbar-panel .d-flex { flex-direction: column; gap: 12px; align-items: stretch !important; }
        .search-input-group { max-width: 100%; }
        .btn-block-mobile { width: 100%; justify-content: center; }
    }
</style>

<div class="container-fluid">
    <div class="card custom-card">
        
        <div class="card-header-modern">
            <div class="header-title-block text-center">
                <h2>ESSOM CO., LTD.</h2>
                <h2>บันทึกการบำรุงรักษาเครื่องจักร<br><span style="font-size: 1.15rem; font-weight: 600; color: #475569;">EQUIPMENT MAINTENANCE RECORD</span></h2>
            </div>
            <div class="doc-number-badge">
                <strong>F7132.1</strong><br>7 Mar 25
            </div>
        </div>

        <div class="card-body" style="padding: 2rem 2.5rem;">
            
            <div class="toolbar-panel">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="d-flex align-items-center flex-wrap gap-2 btn-block-mobile">
                        <a href="{{ route('maintenance-records.create') }}" class="btn-indigo-add btn-block-mobile">
                            <i class="fas fa-plus"></i> เพิ่มข้อมูลใหม่
                        </a>
                        <button type="button" id="printBtn" class="btn-outline-action btn-block-mobile">
                            <i class="fas fa-print"></i> พิมพ์เอกสาร
                        </button>
                        <button type="button" id="exportExcelBtn" class="btn-outline-action btn-block-mobile">
                            <i class="fas fa-file-excel text-success"></i> ส่งออก Excel
                        </button>
                    </div>
                    
                    <div class="search-input-group">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="form-control-search" placeholder="ค้นหาข้อมูลในตารางบำรุงรักษา...">
                    </div>
                </div>
            </div>

            <div class="table-responsive-container">
                <table id="maintenanceTable" class="table table-modern text-center m-0">
                    <thead>
                        <tr>
                            <th style="width: 8%">No.</th>
                            <th style="width: 25%">ปีที่ตรวจ</th>
                            <th style="width: 43%">ผู้ตรวจ (ตัวแทน)</th>
                            <th style="width: 12%">แก้ไข</th>
                            <th style="width: 12%">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($recordsByYear as $year => $record)
                            @if($record && $record->inspector)
                            <tr>
                                <td class="font-weight-bold text-secondary">{{ $no++ }}</td>
                                <td><span class="badge px-3 py-2" style="background-color: #f5f3ff; color: #4f46e5; font-size: 0.9rem; border: 1px solid #ddd6fe;">{{ $year }}</span></td>
                                <td class="text-left px-4">{{ $record->inspector }}</td>
                                <td>
                                    <a href="{{ route('maintenance-records.edit', $record->id) }}" class="btn-table-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('maintenance-records.destroy', $record->id) }}" method="POST" class="delete-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-table-delete" onclick="confirmDeleteYear(this)">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="pagination" class="pagination-wrapper"></div>

        </div>
    </div>
</div>

@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<script>
// ✅ ฟังก์ชัน SweetAlert2 ยืนยันการลบแบบโมเดิร์น
function confirmDeleteYear(button) {
    const form = button.closest('.delete-form');
    
    Swal.fire({
        title: 'ยืนยันการลบข้อมูล?',
        text: "คุณต้องการลบข้อมูลการบำรุงรักษาทั้งหมดของปีนี้ใช่หรือไม่? การกระทำนี้ไม่สามารถย้อนคืนได้!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ใช่, ฉันต้องการลบ',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            confirmButton: 'swal-confirm-btn',
            cancelButton: 'swal-cancel-btn'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}

// ✅ ระบบจัดการการค้นหาภายในตาราง (Search Engine)
document.getElementById('searchInput')?.addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#maintenanceTable tbody tr');
    rows.forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
    });
});

// ✅ สั่งพิมพ์ (Print Operation)
document.getElementById('printBtn')?.addEventListener('click', function() { window.print(); });

// ✅ ระบบแปลงและส่งออกเป็นไฟล์ Excel (.xlsx)
document.getElementById('exportExcelBtn')?.addEventListener('click', function() {
    const table = document.getElementById('maintenanceTable');
    const wb = XLSX.utils.book_new();
    const ws_data = [];
    
    // ดึงข้อมูลหัวตาราง
    const headerData = [];
    table.querySelectorAll('thead th').forEach((cell, idx) => {
        if (idx < 3) headerData.push(cell.innerText.trim()); // เอาเฉพาะ No., ปีที่ตรวจ, ผู้ตรวจ
    });
    ws_data.push(headerData);

    // ดึงข้อมูลแถวในตาราง
    const rows = table.querySelectorAll('tbody tr');
    rows.forEach(row => {
        if(row.style.display !== 'none') { // เลือกเฉพาะแถวที่ไม่ได้โดน filter ซ่อนอยู่
            const rowData = [];
            row.querySelectorAll('td').forEach((cell, idx) => {
                if (idx < 3) rowData.push(cell.innerText.trim());
            });
            ws_data.push(rowData);
        }
    });

    const ws = XLSX.utils.aoa_to_sheet(ws_data);
    ws['!cols'] = [{wch: 8}, {wch: 20}, {wch: 40}]; // ขยายความกว้างของคอลัมน์ Excel ให้พอดีตา
    
    XLSX.utils.book_append_sheet(wb, ws, "Maintenance_Record");
    XLSX.writeFile(wb, "Equipment_Maintenance_Record.xlsx");
});

// ✅ ระบบแบ่งหน้าตารางแบบ Dynamic Pagination
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('maintenanceTable');
    if (!table) return;
    
    const rows = Array.from(table.querySelectorAll('tbody tr'));
    const rowsPerPage = 10;
    let currentPage = 1;
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    if (totalPages <= 1) return; // ถ้าแถวข้อมูลไม่ทะลุ 10 แถว จะไม่แสดงแถบ Pagination

    function showPage(page) {
        currentPage = page;
        rows.forEach((row, index) => {
            row.style.display = (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) ? '' : 'none';
        });
        renderPagination();
    }

    function renderPagination() {
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = `
            <button id="prevPage" class="btn-page-nav" ${currentPage === 1 ? 'disabled' : ''}>ก่อนหน้า</button>
            <span class="font-weight-bold mx-2"> หน้า ${currentPage} / ${totalPages} </span>
            <button id="nextPage" class="btn-page-nav" ${currentPage === totalPages ? 'disabled' : ''}>ถัดไป</button>
        `;
        document.getElementById('prevPage').addEventListener('click', () => showPage(currentPage - 1));
        document.getElementById('nextPage').addEventListener('click', () => showPage(currentPage + 1));
    }

    showPage(1);
});
</script>
@endpush