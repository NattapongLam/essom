@extends('layouts.main')
@section('content')
{{-- @push('styles') --}}
<!-- Sweet Alert-->
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
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        padding: 1rem !important;
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
        padding: 1rem !important;
        vertical-align: middle !important;
        color: var(--text-dark);
        font-weight: 500;
        border-bottom: 1px solid #e2e8f0 !important;
    }

    /* Action Buttons */
    .btn-action {
        width: 36px;
        height: 36px;
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
    }

    .btn-action-delete:hover {
        background-color: #fecaca;
        color: #b91c1c;
        transform: scale(1.05);
    }

    /* DataTables Customization Overrides */
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
    .dt-buttons .dt-button:hover {
        background: #e2e8f0 !important;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div class="text-center text-md-left mb-3 mb-md-0">
                            <h5 class="m-0">ทะเบียนรับเข้าเอกสารจากภายนอก</h5>
                            <span class="doc-code">ฟอร์มเอกสาร: F7531.1 (27 Sep. 23)</span>
                        </div>
                        <div class="text-center text-md-right">
                            <a href="{{route('document-external.create')}}" class="btn-indigo-add">
                                <i class="fas fa-plus"></i> เพิ่มเอกสารภายนอก
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">             
                    <div class="table-responsive">
                        <table id="tb_job" class="table modern-table text-center w-100">
                            <thead>     
                                <tr>
                                    <th style="width: 60%;">ปี</th>
                                    <th style="width: 20%;">อัพเดท</th>
                                    <th style="width: 20%;">ลบ</th>
                                </tr>                    
                            </thead>
                            <tbody>  
                                @foreach ($hd as $item)
                                    <tr>
                                        <td>
                                            <span class="badge badge-light p-2 px-3 text-dark" style="font-size: 0.9rem; border-radius: 6px; background: #f1f5f9;">
                                                {{$item->ms_year_name}}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{route('document-external.edit',$item->documentexternal_hd_id)}}" class="btn-action btn-action-edit" data-toggle="tooltip" title="แก้ไขข้อมูล">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn-action btn-action-delete" onclick="confirmDel('{{ $item->documentexternal_hd_id }}')" data-toggle="tooltip" title="ลบข้อมูล">
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
            [0, "desc"] // ปรับให้เรียงตามปีล่าสุดขึ้นก่อนเพื่อความสะดวกในการใช้งาน
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
        // ปรับสีปุ่มใน SweetAlert2 ให้แมตช์กับธีม Indigo & Red
        confirmButtonColor: '#4f46e5',
        cancelButtonColor: '#ef4444',
        customClass: {
            confirmButton: 'btn btn-primary px-4 mx-2',
            cancelButton: 'btn btn-danger px-4 mx-2'
        },
        buttonsStyling: true
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelExternalHd') }}`,
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
                            confirmButtonColor: '#4f46e5'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'ยกเลิกเอกสารไม่สำเร็จ',
                            icon: 'error',
                            confirmButtonColor: '#4f46e5'
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิก',
                text: 'โปรดตรวจสอบข้อมูลอีกครั้งเพื่อความถูกต้อง :)',
                icon: 'error',
                confirmButtonColor: '#4f46e5'
            });
        }
    });
}
</script>
@endpush