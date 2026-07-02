@extends('layouts.main')
@section('content')

<!-- DataTables & Sweet Alert 2 Custom CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Theme Layout Structure */
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

    /* Elegant Header Component */
    .card-header-modern {
        background-color: #ffffff;
        padding: 2.5rem 2.5rem 1.5rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-title-block h2 {
        font-size: 1.1rem;
        letter-spacing: 1px;
        color: #475569;
        font-weight: 500;
        margin: 0;
    }

    .header-title-block h3 {
        font-weight: 700;
        color: #1e293b;
        margin-top: 8px;
        margin-bottom: 0;
        font-size: 1.4rem;
        line-height: 1.5;
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

    /* Toolbar Layout */
    .action-toolbar {
        display: flex;
        justify-content: flex-start;
        padding: 1.5rem 2.5rem 0rem 2.5rem;
    }

    /* Premium Grid Table Customization */
    .table-responsive-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    table.table-modern {
        width: 100% !important;
        margin-bottom: 0 !important;
        font-size: 0.88rem;
    }

    table.table-modern th {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
        font-weight: 600;
        border: 1px solid #4338ca !important;
        padding: 14px 10px !important;
        vertical-align: middle;
        font-size: 0.85rem;
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

    /* Dynamic Badges Styling */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
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

    /* Custom Indigo Buttons Interface */
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

    /* SweetAlert Override Buttons Hook */
    .swal-confirm-btn {
        background-color: #4f46e5 !important;
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

    /* Override DataTables Standard Buttons spacing to look tidy */
    .dt-buttons {
        margin-bottom: 20px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #4f46e5 !important;
        color: white !important;
        border-color: #4f46e5 !important;
        border-radius: 6px;
    }
    
    @media (max-width: 992px) {
        .doc-number-badge { position: relative; top: 0; right: 0; text-align: left; display: inline-block; margin-top: 15px; }
        .card-header-modern { padding: 1.5rem; }
        .action-toolbar { padding: 1.5rem 1.5rem 0rem 1.5rem; }
    }
</style>

<div class="container-fluid custom-container">
    <div class="card form-card">
        
        <!-- Header Document Block -->
        <div class="card-header-modern">
            <div class="header-title-block text-center">
                <h2>ESSOM CO., LTD.</h2>
                <h3>ใบส่งต่อความรู้องค์กร การประเมินผลและการทบทวน</h3>
            </div>
            <div class="doc-number-badge">
                <strong>F7160.3</strong><br>7 Nov 23
            </div>
        </div>

        <!-- Upper Action Dynamic Toolbar -->
        <div class="action-toolbar">
            <a href="{{ route('knowledge-transfer.create') }}" class="btn-indigo-add">
                <i class="fas fa-plus"></i> เพิ่มข้อมูลใหม่
            </a>
        </div>

        <!-- Data Grid Content Area -->
        <div class="card-body" style="padding: 1.5rem 2.5rem 2.5rem 2.5rem;">             
            <div class="table-responsive-container">
                <table id="tb_job" class="table table-modern text-center m-0">
                    <thead>
                        <tr>
                            <th style="width: 5%;">NO</th>
                            <th style="text-align: left; padding-left: 15px;">ผู้ส่ง / ผู้ประเมิน ชื่อ</th>
                            <th>หน่วยงาน</th>
                            <th>ตำแหน่ง</th>
                            <th>วันที่</th>
                            <th>เอกสาร KM เลขที่</th>
                            <th>อนุมัติเมื่อวันที่</th>
                            <th>ความรู้องค์กรด้าน</th>
                            <th style="width: 6%;">แก้ไข</th>
                            <th style="width: 10%;">อนุมัติ</th>
                            <th style="width: 6%;">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                        <tr>
                            <td class="font-weight-bold text-secondary">{{ $loop->iteration }}</td>
                            <td style="text-align: left; padding-left: 15px; font-weight: 500;">{{ $record->evaluator_name }}</td>
                            <td>{{ $record->department }}</td>
                            <td>{{ $record->position }}</td>
                            <td><i class="far fa-calendar-alt text-muted mr-1"></i> {{ $record->record_date }}</td>
                            <td class="font-weight-bold text-indigo">{{ $record->doc_no }}</td>
                            <td>
                                @if($record->approved_date)
                                    <i class="far fa-calendar-check text-muted mr-1"></i> {{ $record->approved_date }}
                                @else
                                    -
                                @endif
                            </td>
                            <td style="text-align: left;">{{ Str::limit($record->organizational_knowledge, 40) }}</td>
                            <td>
                                 <a href="{{ route('knowledge-transfer.edit', $record->id) }}" class="btn btn-action-edit" title="แก้ไขข้อมูล">
                                    <i class="fas fa-edit"></i>
                                 </a>
                            </td>
                            <td>
                                @if ($record->approved_status == "N")
                                    @if ($record->approved_by == auth()->user()->name)
                                        <a href="{{ route('knowledge-transfer.show', $record->id) }}" class="btn btn-action-approve" title="คลิกเพื่ออนุมัติเอกสาร">
                                            <i class="fas fa-check-circle mr-1"></i> อนุมัติ
                                        </a>
                                    @else
                                        <span class="status-badge status-badge-warning">
                                            <i class="fas fa-hourglass-half" style="font-size: 0.75rem;"></i> รออนุมัติ
                                        </span> 
                                    @endif
                                @elseif($record->approved_status == "Y")
                                    <span class="status-badge status-badge-success">
                                        <i class="fas fa-check-circle" style="font-size: 0.75rem;"></i> อนุมัติแล้ว
                                    </span> 
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-action-delete" onclick="confirmDel('{{ $record->id }}')" title="ลบข้อมูล">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        @if($records->isEmpty())
                        <tr><td colspan="11" align="center" class="text-muted py-4">ไม่มีข้อมูลในระบบขณะนี้</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Assets Injection Scripts Core JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
$(document).ready(function() {
    var table = $('#tb_job').DataTable({
        pageLength: 50,
        lengthMenu: [[10,25,50,-1],[10,25,50,"All"]],
        dom: 'Bfrtip',
        buttons: ['copy','csv','excel','pdf','print'],
        order: [[0,"asc"]],
        fixedHeader: {header:false, footer:false},
        pagingType: "full_numbers",
        bSort: true
    });
});

// Premium Intercept SweetAlert2 Wrapper Ajax Lifecycle
function confirmDel(id) {
   Swal.fire({
        title: 'ยืนยันการลบข้อมูล?',
        text: 'คุณแน่ใจหรือไม่ว่าต้องการลบรายการนี้? ข้อมูลจะถูกลบออกจากระบบอย่างถาวร!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '<i class="fas fa-trash-alt mr-1"></i> ยืนยันการลบ',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            confirmButton: 'swal-confirm-btn',
            cancelButton: 'swal-cancel-btn'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `{{ url('/knowledge-transfer') }}/${id}`,
                type: 'POST',
                data: {
                    "_method": "DELETE",
                    "_token": "{{ csrf_token() }}"
                },
                success: function() {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'ลบรายการเรียบร้อยแล้ว',
                        icon: 'success',
                        confirmButtonColor: '#4f46e5'
                    }).then(() => location.reload());
                },
                error: function() {
                    Swal.fire({
                        title: 'ไม่สำเร็จ',
                        text: 'เกิดข้อผิดพลาด ไม่สามารถลบรายการได้',
                        icon: 'error',
                        confirmButtonColor: '#4f46e5'
                    });
                }
            });
        }
    });
}
</script>
@endsection