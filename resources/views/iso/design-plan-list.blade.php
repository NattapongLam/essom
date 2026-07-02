@extends('layouts.main')
@section('content')
{{-- @push('styles') --}}
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}

<style>
    /* Custom Indigo Modern Theme */
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #e0e7ff;
        --text-dark: #1e1b4b;
        --border-radius-custom: 12px;
    }

    .custom-card {
        border: none;
        border-radius: var(--border-radius-custom);
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.1), 0 8px 10px -6px rgba(79, 70, 229, 0.1);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #6366f1, var(--indigo-primary));
        color: #ffffff;
        padding: 1.5rem;
        border-bottom: none;
    }

    .custom-card-header h5 {
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .doc-code {
        font-size: 0.85rem;
        opacity: 0.85;
        font-weight: 300;
    }

    .btn-indigo-add {
        background-color: #ffffff;
        color: var(--indigo-primary) !important;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none !important;
    }

    .btn-indigo-add:hover {
        background-color: var(--indigo-light);
        transform: translateY(-1px);
        box-shadow: 0 6px 12px -2px rgba(79, 70, 229, 0.2);
    }

    /* Table Styling */
    .modern-table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .modern-table thead th {
        background-color: #f8fafc !important;
        color: #64748b;
        font-weight: 600;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 1.2rem 0.5rem !important;
        border-bottom: 2px solid #e2e8f0 !important;
        border-top: none !important;
    }

    .modern-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .modern-table tbody tr:hover {
        background-color: #f1f5f9;
    }

    .modern-table tbody td {
        padding: 1rem 0.5rem !important;
        vertical-align: middle !important;
        color: var(--text-dark);
        font-weight: 500;
        font-size: 0.9rem;
        border-bottom: 1px solid #e2e8f0 !important;
    }

    /* Action Buttons */
    .btn-action {
        width: 34px;
        height: 34px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-action-edit {
        background-color: #fef3c7;
        color: #d97706;
        border: none;
    }

    .btn-action-edit:hover {
        background-color: #fde68a;
        color: #b45309;
        transform: scale(1.05);
    }

    .btn-action-delete {
        background-color: #fee2e2;
        color: #dc2626;
        border: none;
        cursor: pointer;
    }

    .btn-action-delete:hover {
        background-color: #fecaca;
        color: #b91c1c;
        transform: scale(1.05);
    }

    /* DataTables Overrides */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--indigo-primary) !important;
        color: white !important;
        border: 1px solid var(--indigo-primary) !important;
        border-radius: 6px;
    }
    .dt-buttons .dt-button {
        background: #f1f5f9 !important;
        color: #475569 !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 6px !important;
        font-size: 0.85rem !important;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div class="text-center text-md-left mb-3 mb-md-0">
                            <h5 class="m-0">ESSOM CO.,LTD</h5>
                            <h5 class="m-0 font-weight-normal" style="font-size: 1.1rem; opacity: 0.9;">แผนการออกแบบผลิตภัณฑ์ (DESIGN REQUEST AND DESIGN PLANNING)</h5>
                            <span class="doc-code">ฟอร์มเอกสาร: F8300.1 (19 Jan. 22)</span>
                        </div>
                        <div class="text-center text-md-right">
                            <a href="{{ route('design-plan.create') }}" class="btn-indigo-add">
                                <i class="fas fa-plus"></i> เพิ่มเอกสาร
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">             
                    <div class="table-responsive">
                        <table id="tb_job" class="table modern-table text-center w-100">
                            <thead>
                                <tr>
                                    <th style="width: 8%">No</th>
                                    <th style="width: 37%">ชื่อผลิตภัณฑ์</th>
                                    <th style="width: 25%">รุ่นผลิตภัณฑ์</th>
                                    <th style="width: 15%">วันที่ร้องขอ</th>
                                    <th style="width: 7%">แก้ไข</th>
                                    <th style="width: 7%">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($plans as $plan)
                                <tr>
                                    <td class="font-weight-bold" style="color: #64748b;">{{ $loop->iteration }}</td>
                                    <td class="text-left font-weight-bold" style="color: var(--text-dark);">{{ $plan->product_name }}</td>
                                    <td>
                                        <span class="badge badge-light p-2 text-dark" style="background-color: #f1f5f9; border-radius: 6px; font-size: 0.85rem;">
                                            {{ $plan->product_model }}
                                        </span>
                                    </td>
                                    <td>{{ $plan->design_request_date }}</td>
                                    <td>
                                        <a href="{{ route('design-plan.edit', $plan->id) }}" class="btn-action btn-action-edit" data-toggle="tooltip" title="แก้ไขแผนงาน">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn-action btn-action-delete" onclick="confirmDel('{{ $plan->id }}')" data-toggle="tooltip" title="ลบแผนงาน">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        
                                        <form id="delete-form-{{ $plan->id }}" action="{{ route('design-plan.destroy', $plan->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <i class="fas fa-folder-open mb-2 d-block" style="font-size: 2rem; color: #cbd5e1;"></i>
                                        ยังไม่มีข้อมูลแผนการออกแบบผลิตภัณฑ์ในขณะนี้
                                    </td>
                                </tr>
                                @endforelse
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
            targets: 3, /* เปลี่ยนเป็นตรวจสอบวันที่ที่คอลัมน์ Index 3 (วันที่ร้องขอ) */
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

    // เปิดใช้งาน Bootstrap Tooltip
    $('[data-toggle="tooltip"]').tooltip();
});

// อัปเกรดระบบยืนยันการลบให้เป็น SweetAlert2 คุมโทน Indigo-Red
confirmDel = (planId) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการลบข้อมูลแผนการออกแบบนี้ใช่หรือไม่ ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยันการลบ',
        cancelButtonText: 'ยกเลิก',
        confirmButtonColor: '#ef4444', // สีแดงสไตล์โมเดิร์น
        cancelButtonColor: '#64748b',  // สีเทา Slate
        customClass: {
            confirmButton: 'btn btn-danger px-4 mx-2',
            cancelButton: 'btn btn-secondary px-4 mx-2'
        },
        buttonsStyling: true
    }).then(function(result) {
        if (result.value) {
            // เมื่อกดยืนยัน จะสั่ง Submit ฟอร์มลบของแถวนั้น ๆ ทันที
            document.getElementById(`delete-form-${planId}`).submit();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิก',
                text: 'ข้อมูลของคุณยังคงปลอดภัยอยู่ :)',
                icon: 'error',
                confirmButtonColor: '#4f46e5'
            });
        }
    });
}
</script>
@endpush