@extends('layouts.main')
@section('content')
<!-- SweetAlert2 Resource -->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Theme Styles for Objective Table */
    .objective-container {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        padding: 1.5rem 0;
    }
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.05) !important;
        background: #ffffff;
        overflow: hidden;
    }
    .card-header {
        background: #ffffff !important;
        padding: 1.5rem 1.75rem !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .company-title {
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 1px;
        color: #6366f1;
        margin-bottom: 0.25rem;
    }
    .main-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }
    .doc-meta {
        font-size: 0.8rem;
        color: #94a3b8;
        font-weight: 500;
    }

    /* Modern Indigo Button */
    .btn-indigo-add {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        padding: 0.55rem 1.35rem !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        font-size: 0.9rem;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2) !important;
        transition: all 0.2s ease !important;
        border: none !important;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-indigo-add:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3) !important;
        transform: translateY(-1px);
        color: #ffffff !important;
        text-decoration: none;
    }

    /* Table Customization */
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }
    #tb_job {
        margin: 0 !important;
    }
    #tb_job thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 0.85rem 0.5rem !important;
        font-size: 0.9rem;
        vertical-align: middle !important;
    }
    #tb_job tbody td {
        padding: 0.85rem 0.6rem !important;
        vertical-align: middle !important;
        color: #334155;
        font-size: 0.9rem;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(248, 250, 252, 0.5) !important;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(99, 102, 241, 0.02) !important;
    }

    /* Pastel Action Buttons */
    .btn-action-edit {
        background-color: #fef3c7 !important;
        color: #d97706 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 0.35rem 0.55rem !important;
        transition: all 0.2s;
        display: inline-block;
    }
    .btn-action-edit:hover {
        background-color: #d97706 !important;
        color: #ffffff !important;
    }
    .btn-action-approve {
        background-color: #e0e7ff !important;
        color: #4f46e5 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 0.35rem 0.55rem !important;
        transition: all 0.2s;
        display: inline-block;
    }
    .btn-action-approve:hover {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
    }
    .btn-action-delete {
        background-color: #fee2e2 !important;
        color: #dc2626 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 0.35rem 0.55rem !important;
        transition: all 0.2s;
        outline: none !important;
    }
    .btn-action-delete:hover {
        background-color: #dc2626 !important;
        color: #ffffff !important;
    }

    /* DataTables Layout Overwrites */
    .dt-buttons .btn {
        background-color: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #475569 !important;
        border-radius: 6px !important;
        font-size: 0.85rem !important;
        font-weight: 500 !important;
        margin-right: 0.25rem;
    }
    .dt-buttons .btn:hover {
        background-color: #f1f5f9 !important;
        color: #1e293b !important;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 0.3rem 0.75rem !important;
        outline: none;
    }
</style>

<div class="objective-container">
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div>
                            <div class="company-title">ESSOM CO., LTD.</div>
                            <h5 class="main-title">คำขอแก้ไข Objective</h5>
                        </div>
                        <div class="text-md-right mt-2 mt-md-0 doc-meta">
                            <strong>Form No:</strong> F6200.1<br>
                            <strong>Date:</strong> 9 Apr 24
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('objcctives.create') }}" class="btn-indigo-add">
                            <i class="fas fa-plus"></i> เพิ่มข้อมูลใหม่
                        </a>
                    </div>
                </div>

                <div class="card-body">             
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-striped table-hover table-bordered text-center w-100">
                            <thead>
                                <tr>
                                    <th style="width: 45%;">SECTION</th>
                                    <th style="width: 37%;">FOR PERIOD.</th>
                                    <th style="width: 6%;">แก้ไข</th>
                                    <th style="width: 6%;">อนุมัติ</th>
                                    <th style="width: 6%;">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($objectives as $objective)
                                    <tr>
                                        <td class="text-left font-weight-bold">{{ $objective->section ?? '-' }}</td>
                                        <td>{{ $objective->period ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('objcctives.edit', $objective->id) }}" class="btn-action-edit" title="แก้ไข">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('objcctives.show', $objective->id) }}" class="btn-action-approve" title="ตรวจสอบ / อนุมัติ">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn-action-delete" onclick="confirmDel('{{ $objective->id }}')" title="ลบข้อมูล">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <form id="delete-form-{{ $objective->id }}" action="{{ route('objcctives.destroy', $objective->id) }}" method="POST" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- card-body -->
            </div> <!-- card -->
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
            { extend: 'copy', className: 'btn btn-sm' },
            { extend: 'csv', className: 'btn btn-sm' },
            { extend: 'excel', className: 'btn btn-sm' },
            { extend: 'pdf', className: 'btn btn-sm' },
            { extend: 'print', className: 'btn btn-sm' }
        ],
        order: [[0, "asc"]],
        pagingType: "full_numbers",
        bSort: true,
        "language": {
            "search": "ค้นหาข้อมูล:",
            "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
            "info": "แสดงรายการที่ _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
            "infoEmpty": "ไม่มีข้อมูลที่จะแสดง",
            "zeroRecords": "ไม่พบข้อมูลที่ค้นหา",
            "paginate": {
                "first": "หน้าแรก",
                "last": "หน้าสุดท้าย",
                "next": "ถัดไป",
                "previous": "ก่อนหน้า"
            }
        }
    });
});

function confirmDel(id) {
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ที่จะลบ ?',
        text: "เมื่อยืนยันแล้ว ข้อมูลส่วนนี้จะไม่สามารถกู้คืนได้อีกต่อไป!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '<i class="fas fa-check mr-1"></i> ยืนยันการลบ',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            confirmButton: 'btn btn-action-delete px-4 py-2 mx-2',
            cancelButton: 'btn btn-secondary px-4 py-2 mx-2'
        },
        buttonsStyling: false
    }).then(function(result) {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endpush