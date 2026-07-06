@extends('layouts.main')
@section('content')

<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Modern Indigo Theme */
    :root {
        --indigo-main: #6366f1;
        --indigo-hover: #4f46e5;
        --indigo-light: #e0e7ff;
        --indigo-bg: #f8fafc;
        --dark-slate: #0f172a;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        
        /* Status Colors */
        --status-success-bg: #dcfce7;
        --status-success-text: #15803d;
        --status-warning-bg: #fef9c3;
        --status-warning-text: #a16207;
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.05);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #ffffff 0%, var(--indigo-bg) 100%);
        border-bottom: 1px solid rgba(99, 102, 241, 0.08);
        padding: 1.5rem 2rem;
    }

    .company-name {
        font-weight: 800;
        letter-spacing: 0.5px;
        color: var(--dark-slate);
    }

    .doc-badge {
        background-color: var(--indigo-light);
        color: var(--indigo-hover);
        padding: 0.35rem 1rem;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }

    /* Modern Table Styling */
    .modern-table-container {
        padding: 0.5rem;
    }

    .table.modern-table {
        border-collapse: separate;
        border-spacing: 0 8px;
        border: none;
    }

    .table.modern-table thead th {
        background-color: var(--indigo-bg);
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        border: none;
        padding: 12px 10px;
    }

    .table.modern-table tbody tr {
        background-color: #ffffff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .table.modern-table tbody tr:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(99, 102, 241, 0.08);
        background-color: var(--indigo-bg) !important;
    }

    .table.modern-table tbody td {
        padding: 14px 10px;
        vertical-align: middle;
        border-top: 1px solid var(--border-color);
        border-bottom: 1px solid var(--border-color);
        color: var(--dark-slate);
        font-size: 0.9rem;
    }

    .table.modern-table tbody td:first-child {
        border-left: 1px solid var(--border-color);
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        font-weight: 600;
    }

    .table.modern-table tbody td:last-child {
        border-right: 1px solid var(--border-color);
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    /* Status Badges */
    .modern-badge {
        padding: 0.4rem 0.75rem;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }
    
    .modern-badge-warning {
        background-color: var(--status-warning-bg);
        color: var(--status-warning-text);
    }

    .modern-badge-success {
        background-color: var(--status-success-bg);
        color: var(--status-success-text);
    }

    /* Action Buttons */
    .btn-action {
        border-radius: 8px;
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        border: none;
    }

    .btn-action-edit {
        background-color: #fef3c7;
        color: #d97706;
    }
    .btn-action-edit:hover {
        background-color: #fde68a;
        color: #b45309;
    }

    .btn-action-review {
        background-color: var(--indigo-light);
        color: var(--indigo-hover);
    }
    .btn-action-review:hover {
        background-color: var(--indigo-main);
        color: #ffffff;
    }

    .btn-action-danger {
        background-color: #fee2e2;
        color: #dc2626;
    }
    .btn-action-danger:hover {
        background-color: #fecaca;
        color: #991b1b;
    }

    .btn-indigo-add {
        background-color: var(--indigo-main);
        color: #ffffff;
        border-radius: 10px;
        padding: 0.5rem 1.25rem;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
        transition: all 0.2s;
        text-decoration: none !important;
    }

    .btn-indigo-add:hover {
        background-color: var(--indigo-hover);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.25);
    }

    /* DataTables Control Elements custom styling */
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 5px 10px;
        outline: none;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--indigo-main);
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card custom-card">
                
                <!-- Card Header -->
                <div class="card-header custom-card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                            <h4 class="company-name mb-1">ESSOM CO., LTD</h4>
                            <span class="doc-badge">
                                <i class="fas fa-clipboard-list mr-1"></i> แผนคุณภาพเฉพาะผลิตภัณฑ์ (Quality Plan)
                            </span>
                        </div>
                        <div class="col-md-6 text-center text-md-right">
                            <div class="mb-2">
                                <span class="text-muted font-weight-bold">F8510.1</span><br>
                                <small class="text-muted">4 Nov. 24</small>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('quality-plan.create') }}" class="btn-indigo-add">
                                    <i class="fas fa-plus mr-1"></i> เพิ่มเอกสาร
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">             
                    <div class="table-responsive modern-table-container">
                        <table id="tb_job" class="table modern-table text-center w-100">
                            <thead>
                                <tr>
                                    <th>Doc.No</th>
                                    <th>Rev.No</th>
                                    <th>EffecDate</th>
                                    <th>Page</th>
                                    <th>จัดทำโดย</th>
                                    <th>แก้ไข</th>
                                    <th>อนุมัติ / สถานะ</th>
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hd as $item)
                                    <tr>
                                        <td>{{ $item->quality_plan_hd_docno }}</td>
                                        <td>{{ $item->quality_plan_hd_revno }}</td>
                                        <td>{{ $item->quality_plan_hd_effecdate }}</td>
                                        <td>{{ $item->quality_plan_hd_page }}</td>
                                        <td>
                                            <span class="font-weight-500">{{ $item->requested_by }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('quality-plan.edit', $item->quality_plan_hd_id) }}" class="btn-action btn-action-edit" title="แก้ไข">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            @if ($item->reviewed_status == "N")
                                                @if ($item->reviewed_by == auth()->user()->name)
                                                    <a href="{{ route('quality-plan.show', $item->quality_plan_hd_id) }}" class="btn-action btn-action-review" title="ทบทวนเอกสาร">
                                                        <i class="fas fa-user-check"></i>
                                                    </a>
                                                @else
                                                    <span class="modern-badge modern-badge-warning">
                                                        <i class="fas fa-clock mr-1"></i> รอทบทวน
                                                    </span>    
                                                @endif
                                            @elseif($item->approved_status == "N")
                                                @if ($item->approved_by == auth()->user()->name)
                                                    <a href="{{ route('quality-plan.show', $item->quality_plan_hd_id) }}" class="btn-action btn-action-review" title="อนุมัติเอกสาร">
                                                        <i class="fas fa-user-check"></i>
                                                    </a>
                                                @else
                                                    <span class="modern-badge modern-badge-warning">
                                                        <i class="fas fa-hourglass-half mr-1"></i> รออนุมัติ
                                                    </span>    
                                                @endif
                                            @else   
                                                <span class="modern-badge modern-badge-success">
                                                    <i class="fas fa-check-circle mr-1"></i> อนุมัติแล้ว
                                                </span>     
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn-action btn-action-danger" title="ลบ"
                                                onclick="confirmDel('{{ $item->quality_plan_hd_id }}')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scriptjs')
<!-- Sweet Alerts js -->
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
            targets: 1,
            type: 'time-date-sort'
        }],
        order: [
            [1, "asc"]
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
        pagingType: "full_numbers",
        bSort: true,    
    });
});

confirmDel = (refid) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการลบรายการนี้หรือไม่ ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            confirmButton: 'btn btn-indigo px-4 mx-2',
            cancelButton: 'btn btn-secondary px-4 mx-2'
        },
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelQualityplanHd') }}`,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "refid": refid
                },
                dataType: "json",
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire({
                            title: 'สำเร็จ',
                            text: 'ยกเลิกเอกสารเรียบร้อยแล้ว',
                            icon: 'success',
                            confirmButtonText: 'ตกลง',
                            customClass: { confirmButton: 'btn btn-indigo px-4' },
                            buttonsStyling: false
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'ยกเลิกเอกสารไม่สำเร็จ',
                            icon: 'error',
                            confirmButtonText: 'ตกลง',
                            customClass: { confirmButton: 'btn btn-indigo px-4' },
                            buttonsStyling: false
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิก',
                text: 'โปรดตรวจสอบข้อมูลอีกครั้งเพื่อความถูกต้อง :)',
                icon: 'error',
                confirmButtonText: 'ตกลง',
                customClass: { confirmButton: 'btn btn-indigo px-4' },
                buttonsStyling: false
            });
        }
    });
}
</script>
@endpush