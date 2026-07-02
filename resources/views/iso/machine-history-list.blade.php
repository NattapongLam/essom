@extends('layouts.main')
@section('content')

{{-- @push('styles') --}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
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
        padding: 2rem 2.5rem 1rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-title-block h5 {
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

    /* Top Action Bar Group */
    .top-action-bar {
        display: flex;
        justify-content: flex-start;
        padding: 0 2.5rem;
        margin-top: 25px;
        margin-bottom: -15px;
    }

    /* Buttons Component */
    .btn-indigo-add {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: #ffffff !important;
        border: none;
        padding: 10px 22px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }
    .btn-indigo-add:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
        color: #ffffff;
    }

    /* Table Component Container */
    .table-responsive-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        margin-top: 15px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    table.table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.88rem;
    }

    table.table-modern th {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
        font-weight: 600;
        border: 1px solid #4338ca !important;
        padding: 12px 10px;
        font-size: 0.88rem;
        vertical-align: middle;
    }

    table.table-modern td {
        padding: 12px 10px;
        border: 1px solid #e2e8f0;
        vertical-align: middle;
        background-color: #ffffff;
        color: #475569;
    }

    table.table-modern tbody tr:hover td {
        background-color: #f8fafc;
    }

    /* Rowspan merged cell style enhancement */
    table.table-modern td[rowspan] {
        background-color: #ffffff;
        font-weight: 500;
    }

    /* Custom DataTables Integration Styling */
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 20px !important;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 6px 12px !important;
        background-color: #ffffff !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #6366f1 !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    .dt-buttons {
        margin-bottom: 20px !important;
        display: inline-flex;
        gap: 5px;
    }
    .dt-button {
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #475569 !important;
        border-radius: 8px !important;
        padding: 6px 14px !important;
        font-size: 0.85rem !important;
        font-weight: 500 !important;
        transition: all 0.2s !important;
        box-shadow: none !important;
    }
    .dt-button:hover {
        background: #f1f5f9 !important;
        color: #1e293b !important;
        border-color: #94a3b8 !important;
    }

    /* Table Actions Button Elements */
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

    /* Style SweetAlert Buttons */
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

    @media (max-width: 768px) {
        .doc-number-badge { position: relative; top: 0; right: 0; text-align: left; display: inline-block; margin-top: 10px; }
        .card-header-modern { padding: 1.5rem; }
        .top-action-bar { padding: 0 1.5rem; }
        .btn-indigo-add { width: 100%; justify-content: center; }
    }
</style>

<div class="container-fluid">
    <div class="card custom-card">
        
        <!-- Header Document Block -->
        <div class="card-header-modern">
            <div class="header-title-block text-center">
                <h5 class="m-0" style="font-size: 1.1rem; letter-spacing: 1px; color: #475569;">ESSOM CO., LTD.</h5>
                <h5 class="mt-2 mb-0">ประวัติเครื่องจักร<br><span style="font-size: 1.15rem; font-weight: 600; color: #4f46e5;">EQUIPMENT RECORD</span></h5>
            </div>
            <div class="doc-number-badge">
                <strong>F7132.2</strong><br>9 Feb 17
            </div>
        </div>

        <!-- Add Button Action Bar Area -->
        <div class="top-action-bar">
            <a href="{{ route('machine-history.create') }}" class="btn-indigo-add">
                <i class="fas fa-plus"></i> เพิ่มข้อมูลใหม่
            </a>
        </div>

        <!-- Card Table Content Area -->
        <div class="card-body" style="padding: 2rem 2.5rem;">
            <div class="table-responsive-container">
                <table id="tb_job" class="table table-modern text-center m-0">
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
                            <th>แก้ไข</th>
                            <th>ลบ</th>
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
                                    @if($i == 0)
                                        <td rowspan="{{ $rows }}" class="font-weight-bold text-secondary">{{ $no++ }}</td>
                                        <td rowspan="{{ $rows }}" class="text-left font-weight-bold" style="color: #1e293b; min-width: 140px;">{{ $machine->machine_name }}</td>
                                        <td rowspan="{{ $rows }}" class="font-weight-bold" style="color: #4f46e5;">{{ $machine->machine_number }}</td>
                                        <td rowspan="{{ $rows }}" style="min-width: 90px;">{{ $machine->date_start }}</td>
                                        <td rowspan="{{ $rows }}">{{ $machine->department }}</td>
                                    @endif
                                    
                                    <td style="min-width: 90px; background-color: #fafafa;">{{ $dates[$i] ?? '' }}</td>
                                    <td class="text-left" style="min-width: 180px;">{{ $descriptions[$i] ?? '' }}</td>
                                    <td style="min-width: 100px;">{{ $persons[$i] ?? '' }}</td>
                                    
                                    @if($i == 0)
                                        <td rowspan="{{ $rows }}" class="text-left" style="min-width: 120px;">{{ $machine->remarks ?? '-' }}</td>
                                        <td rowspan="{{ $rows }}">
                                            <a href="{{ route('machine-history.edit', $machine->id) }}" class="btn-table-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td rowspan="{{ $rows }}">
                                            <form action="{{ route('machine-history.destroy', $machine->id) }}" method="POST" class="delete-machine-form" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn-table-delete" onclick="confirmDeleteMachine(this)">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
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
</div>

@endsection

@push('scriptjs')
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
// ✅ ระบบ SweetAlert2 ยืนยันการลบประวัติเครื่องจักรแบบโมเดิร์น
function confirmDeleteMachine(button) {
    const form = button.closest('.delete-machine-form');
    
    Swal.fire({
        title: 'ยืนยันการลบข้อมูล?',
        text: "คุณต้องการลบรายการประวัติเครื่องจักรนี้ใช่หรือไม่? ข้อมูลทั้งหมดรวมถึงประวัติการซ่อมย่อยจะถูกลบถาวร!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยันการลบ',
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

$(document).ready(function() {
    $('#tb_job').DataTable({
        "pageLength": 50,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', text: '<i class="fas fa-copy"></i> คัดลอก' },
            { extend: 'csv', text: '<i class="fas fa-file-csv"></i> CSV' },
            { extend: 'excel', text: '<i class="fas fa-file-excel text-success"></i> Excel' },
            { extend: 'pdf', text: '<i class="fas fa-file-pdf text-danger"></i> PDF' },
            { extend: 'print', text: '<i class="fas fa-print"></i> พิมพ์เอกสาร' }
        ],
        columnDefs: [{
            targets: 1,
            type: 'time-date-sort'
        }],
        order: [
            [0, "asc"]
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
        pagingType: "full_numbers",
        bSort: true,    
    });
});
</script>
@endpush