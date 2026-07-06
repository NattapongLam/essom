@extends('layouts.main')
@section('content')

<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Modern Indigo Theme Styles */
    :root {
        --indigo-primary: #6366f1;
        --indigo-hover: #4f46e5;
        --indigo-light: #e0e7ff;
        --indigo-bg: #f8fafc;
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(99, 102, 241, 0.08);
        background: #ffffff;
        overflow: hidden;
        margin-top: 2rem;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #ffffff 0%, var(--indigo-bg) 100%);
        border-bottom: 1px solid rgba(99, 102, 241, 0.1);
        padding: 1.5rem;
    }

    .company-title {
        font-weight: 800;
        letter-spacing: 0.5px;
        color: #1e293b;
    }

    .subtitle-badge {
        background-color: var(--indigo-light);
        color: var(--indigo-hover);
        padding: 0.35rem 1rem;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        margin-top: 0.5rem;
    }

    /* Table Styling */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
        width: 100% !important;
    }

    .table-modern thead th {
        background-color: var(--indigo-bg) !important;
        color: #475569 !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid rgba(99, 102, 241, 0.15) !important;
        padding: 12px 8px !important;
    }

    .table-modern tbody tr {
        transition: all 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background-color: rgba(99, 102, 241, 0.04) !important;
    }

    .table-modern td {
        padding: 14px 8px !important;
        vertical-align: middle !important;
        color: #334155;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    /* Buttons Styling */
    .btn-indigo-action {
        background-color: var(--indigo-primary);
        color: #ffffff;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }

    .btn-indigo-action:hover {
        background-color: var(--indigo-hover);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.3);
    }

    .btn-table-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s;
        border: none;
    }

    .btn-table-action:hover {
        transform: translateY(-2px);
    }

    .btn-table-edit { background-color: #fef3c7; color: #d97706; }
    .btn-table-edit:hover { background-color: #fde68a; color: #b45309; }

    .btn-table-approve { background-color: #e0e7ff; color: #4f46e5; }
    .btn-table-approve:hover { background-color: #c7d2fe; color: #3730a3; }

    .btn-table-delete { background-color: #fee2e2; color: #dc2626; }
    .btn-table-delete:hover { background-color: #fecaca; color: #b91c1c; }

    /* DataTables Custom Override for Indigo Theme */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--indigo-primary) !important;
        color: white !important;
        border: 1px solid var(--indigo-primary) !important;
        border-radius: 6px !important;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 5px 10px;
    }
</style>

<div class="container-fluid py-2">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <div class="text-center text-md-left mb-3 mb-md-0">
                            <h4 class="company-title mb-1">ESSOM CO., LTD</h4>
                            <span class="subtitle-badge">การทดสอบละเอียด &bull; DESIGN TEST</span>
                        </div>
                        <div class="text-center text-md-right">
                            <div class="text-muted small mb-2">
                                <span class="badge badge-light p-2 border">F8300.3 / 09 Jun. 16</span>
                            </div>
                            <a href="{{route('detailed-testing.create')}}" class="btn btn-indigo-action btn-sm">
                                <i class="fas fa-plus mr-1"></i> เพิ่มเอกสาร
                            </a>
                        </div>
                    </div>             
                </div>
                <div class="card-body p-4">             
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-modern text-center">
                            <thead>  
                                <tr>
                                    <th>Product</th>
                                    <th>Code</th>
                                    <th>S/N</th>
                                    <th>Tested by</th>
                                    <th>Sample calculations by</th>
                                    <th>Graph drawn by</th>
                                    <th>แก้ไข</th>
                                    <th>อนุมัติ</th>
                                    <th>ลบ</th>
                                </tr>                                                                                        
                            </thead>
                            <tbody>   
                                @foreach ($hd as $item)
                                    <tr>
                                        <td class="font-weight-bold text-dark">{{$item->detailed_testings_product}}</td>
                                        <td><span class="badge badge-light px-2 py-1 text-secondary border">{{$item->detailed_testings_code}}</span></td>
                                        <td>{{$item->detailed_testings_serial}}</td>
                                        <td>
                                            <div class="font-weight-500">{{$item->tested_by}}</div>
                                            <small class="text-muted">({{$item->tested_date}})</small>
                                        </td>
                                        <td>{{$item->detailed_testings_sample}}</td>
                                        <td>{{$item->detailed_testings_drawn}}</td>
                                        <td>
                                            <a href="{{route('detailed-testing.edit',$item->detailed_testings_id)}}" class="btn btn-table-action btn-table-edit" title="แก้ไข">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('detailed-testing.show',$item->detailed_testings_id)}}" class="btn btn-table-action btn-table-approve" title="อนุมัติ">
                                                <i class="fas fa-check-circle"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-table-action btn-table-delete"  
                                               onclick="confirmDel('{{ $item->detailed_testings_id }}')" title="ลบ">
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
            header:false,
            footer:false
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
        // ปรับแต่งสีปุ่ม SweetAlert ให้เข้ากับธีม Indigo
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
                url: `{{ url('/cancelTesting') }}`,
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