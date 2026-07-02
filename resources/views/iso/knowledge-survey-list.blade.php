@extends('layouts.main')
@section('content')

<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Theme Layout */
    .custom-container {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .form-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    /* Header Design Component */
    .card-header-modern {
        background-color: #ffffff;
        padding: 2.5rem 2.5rem 1.5rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-title-block h5 {
        font-size: 1.1rem;
        letter-spacing: 1px;
        color: #475569;
        font-weight: 500;
        margin: 0;
    }

    .header-title-block h2 {
        font-weight: 700;
        color: #1e293b;
        margin-top: 8px;
        margin-bottom: 0;
        font-size: 1.5rem;
        line-height: 1.4;
    }

    .doc-number-badge {
        position: absolute;
        top: 2.5rem;
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

    /* Action Toolbar Styles */
    .action-toolbar {
        display: flex;
        justify-content: flex-start;
        padding: 1.5rem 2.5rem 0rem 2.5rem;
    }

    /* Table Component Customization */
    .table-responsive-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    table.table-modern {
        width: 100% !important;
        margin-bottom: 0 !important;
        font-size: 0.9rem;
    }

    table.table-modern th {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
        font-weight: 600;
        border: 1px solid #4338ca !important;
        padding: 12px 10px !important;
        vertical-align: middle;
        text-transform: uppercase;
        font-size: 0.88rem;
    }

    table.table-modern td {
        padding: 12px 10px !important;
        border: 1px solid #e2e8f0 !important;
        vertical-align: middle !important;
        background-color: #ffffff;
        color: #334155;
    }

    table.table-modern tbody tr:hover td {
        background-color: #f8fafc !important;
    }

    /* Badges Pill Styling */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 600;
        line-height: 1;
    }
    
    .status-badge-success {
        background-color: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .status-badge-warning {
        background-color: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
    }

    /* Custom Action Buttons Styling */
    .btn-indigo-add {
        background: #4f46e5;
        color: #ffffff !important;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.2s;
        text-decoration: none !important;
    }
    .btn-indigo-add:hover {
        background: #4338ca;
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    .btn-action-edit {
        background-color: #f59e0b;
        color: #ffffff !important;
        border: none;
        padding: 7px 12px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-action-edit:hover {
        background-color: #d97706;
        transform: scale(1.05);
    }

    .btn-action-approve {
        background-color: #4f46e5;
        color: #ffffff !important;
        border: none;
        padding: 7px 12px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-action-approve:hover {
        background-color: #3730a3;
        transform: scale(1.05);
    }

    .btn-action-delete {
        background-color: #ef4444;
        color: #ffffff !important;
        border: none;
        padding: 7px 12px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-action-delete:hover {
        background-color: #dc2626;
        transform: scale(1.05);
    }

    /* SweetAlert Form Custom Buttons Override */
    .swal-confirm-btn {
        background-color: #ef4444 !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 10px 24px !important;
        margin: 0 8px !important;
        font-weight: 600;
    }
    .swal-cancel-btn {
        background-color: #64748b !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 10px 24px !important;
        margin: 0 8px !important;
        font-weight: 600;
    }

    /* Customizing DataTables Buttons and Elements to match Indigo */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #4f46e5 !important;
        color: white !important;
        border-color: #4f46e5 !important;
        border-radius: 6px;
    }
    
    @media (max-width: 768px) {
        .doc-number-badge { position: relative; top: 0; right: 0; text-align: left; display: inline-block; margin-top: 15px; }
        .card-header-modern { padding: 1.5rem; }
        .action-toolbar { padding: 1.5rem 1.5rem 0rem 1.5rem; }
    }
</style>

<div class="container-fluid custom-container">
    <div class="card form-card">
        
        <div class="card-header-modern">
            <div class="header-title-block text-center">
                <h5>ESSOM CO., LTD.</h5>
                <h2>แบบสำรวจความรู้องค์กร</h2>
            </div>
            <div class="doc-number-badge">
                <strong>F7160.1</strong><br>7 Nov 23
            </div>
        </div>

        <div class="action-toolbar">
            <a href="{{ route('knowledge-survey.create') }}" class="btn-indigo-add">
                <i class="fas fa-plus"></i> เพิ่มข้อมูลใหม่
            </a>
        </div>

        <div class="card-body" style="padding: 1.5rem 2.5rem 2.5rem 2.5rem;">             
            <div class="table-responsive-container">
                <table id="tb_job" class="table table-modern text-center m-0">
                    <thead>
                        <tr>
                            <th style="width: 8%;">ลำดับ</th>
                            <th style="text-align: left; padding-left: 15px;">ชื่อผู้สำรวจ</th>
                            <th style="width: 20%;">หน่วยงาน</th>
                            <th style="width: 15%;">วันที่</th>
                            <th style="width: 8%;">แก้ไข</th>
                            <th style="width: 12%;">อนุมัติ</th>
                            <th style="width: 8%;">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($surveys as $index => $s)
                        <tr>
                            <td class="font-weight-bold text-secondary">{{ $index + 1 }}</td>
                            <td style="text-align: left; padding-left: 15px; font-weight: 500;">{{ $s->surveyor_name }}</td>
                            <td>{{ $s->department }}</td>
                            <td><i class="far fa-calendar-alt text-muted mr-1"></i> {{ $s->survey_date }}</td>
                            <td>
                                <a href="{{ route('knowledge-survey.edit', $s->id) }}" class="btn btn-action-edit" title="แก้ไขข้อมูล">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                @if($s->approved_status == "N")
                                    @if ($s->approved_by == auth()->user()->name)
                                        <a href="{{ route('knowledge-survey.show', $s->id) }}" class="btn btn-action-approve" title="คลิกเพื่อพิจารณาอนุมัติ">
                                            <i class="fas fa-check-circle mr-1"></i> อนุมัติ
                                        </a>
                                    @else
                                        <span class="status-badge status-badge-warning">
                                            <i class="fas fa-hourglass-half" style="font-size: 0.75rem;"></i> รออนุมัติ
                                        </span> 
                                    @endif
                                @elseif($s->approved_status == "Y")
                                    <span class="status-badge status-badge-success">
                                        <i class="fas fa-check-circle" style="font-size: 0.75rem;"></i> อนุมัติแล้ว
                                    </span>  
                                @endif
                            </td>
                            <td>
                                <form id="delete-form-{{ $s->id }}" action="{{ route('knowledge-survey.destroy', $s->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" class="btn btn-action-delete" onclick="confirmDel('{{ $s->id }}')" title="ลบข้อมูล">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#tb_job').DataTable({
        "pageLength": 50,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        columnDefs: [{
            targets: 3, // แก้ไข target ให้ตรงกับ index คอลัมน์ "วันที่" (0-based index) เพื่อดักสไตล์การจัดเรียง
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

// Modernized Dynamic Confirmation Box Hook for Delete Event
confirmDel = (id) => {       
    Swal.fire({
        title: 'ยืนยันการลบข้อมูล?',
        text: 'คุณแน่ใจหรือไม่ว่าต้องการลบรายการนี้? ข้อมูลจะถูกลบออกจากระบบอย่างถาวรและไม่สามารถกู้คืนได้',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '<i class="fas fa-trash-alt mr-1"></i> ยืนยันการลบ',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            confirmButton: 'swal-confirm-btn',
            cancelButton: 'swal-cancel-btn'
        },
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            // เมื่อกดยืนยัน จะทำการยิงฟอร์มลบของ ID นั้นๆ
            document.getElementById(`delete-form-${id}`).submit();
        }
    });
}
</script>
@endpush