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

    /* Badges & Links */
    .file-badge {
        background-color: #e0f2fe;
        color: #0369a1;
        padding: 0.4rem 0.6rem;
        border-radius: 6px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
    }
    
    .file-badge:hover {
        background-color: #bae6fd;
        color: #0c4a6e;
        transform: scale(1.05);
    }

    .link-text {
        max-width: 150px;
        display: inline-block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #4f46e5;
        font-weight: 500;
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
    }

    .btn-action-delete:hover {
        background-color: #fecaca;
        color: #b91c1c;
        transform: scale(1.05);
    }

    /* DataTables Pagination Override */
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
                            <h5 class="m-0">บริษัท เอสซอม จำกัด</h5>
                            <h5 class="m-0 font-weight-normal" style="font-size: 1.1rem; opacity: 0.9;">ทะเบียนเอกสารอ้างอิง</h5>
                            <span class="doc-code">ฟอร์มเอกสาร: F7531.2 (9 Jun. 16)</span>
                        </div>
                        <div class="text-center text-md-right">
                            <a href="{{route('document-reference.create')}}" class="btn-indigo-add">
                                <i class="fas fa-plus"></i> เพิ่มเอกสารอ้างอิง
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">             
                    <div class="table-responsive">
                        <table id="tb_job" class="table modern-table text-center w-100">
                            <thead>     
                                <tr>
                                    <th style="width: 5%">ลำดับที่</th>
                                    <th style="width: 10%">วันที่รับเอกสาร</th>
                                    <th style="width: 13%">หน่วยงานที่ออกเอกสาร</th>
                                    <th style="width: 20%">ชื่อเอกสาร</th>
                                    <th style="width: 12%">รหัสเอกสาร</th>
                                    <th style="width: 10%">วันที่เอกสาร</th>
                                    <th style="width: 8%">ไฟล์แนบ</th>
                                    <th style="width: 12%">Link</th>
                                    <th style="width: 5%">แก้ไข</th>
                                    <th style="width: 5%">ลบ</th>
                                </tr>                    
                            </thead>
                            <tbody>  
                                @foreach ($hd as $item)
                                    <tr>
                                        <td class="font-weight-bold" style="color: #64748b;">
                                            {{$item->documentreferences_listno}}
                                        </td>
                                        <td>{{$item->documentreferences_receivedate}}</td>
                                        <td>{{$item->documentreferences_department}}</td>
                                        <td class="text-left font-weight-bold" style="color: var(--text-dark);">
                                            {{$item->documentreferences_name}}
                                        </td>
                                        <td>
                                            <span class="badge badge-light p-2 text-dark" style="background-color: #f1f5f9; border-radius: 6px;">
                                                {{$item->documentreferences_code}}
                                            </span>
                                        </td>
                                        <td>{{$item->documentreferences_date}}</td>
                                        <td>
                                            @if ($item->documentreferences_file)
                                                <a href="{{asset($item->documentreferences_file)}}" target="_blank" class="file-badge" data-toggle="tooltip" title="เปิดไฟล์แนบ">
                                                    <i class="fas fa-file-pdf mr-1"></i> เปิดไฟล์
                                                </a>
                                            @else
                                                <span class="text-muted" style="font-size: 0.85rem;">-</span>
                                            @endif  
                                        </td>
                                        <td>
                                            @if ($item->documentreferences_link)
                                                <a href="{{$item->documentreferences_link}}" target="_blank" class="link-text" data-toggle="tooltip" title="{{$item->documentreferences_link}}">
                                                    <i class="fas fa-external-link-alt mr-1"></i> ลิงก์แนบ
                                                </a>
                                            @else
                                                <span class="text-muted" style="font-size: 0.85rem;">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('document-reference.edit',$item->documentreferences_id)}}" class="btn-action btn-action-edit" data-toggle="tooltip" title="แก้ไขข้อมูล">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn-action btn-action-delete" onclick="confirmDel('{{ $item->documentreferences_id }}')" data-toggle="tooltip" title="ลบข้อมูล">
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
            [0, "asc"]
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
        pagingType: "full_numbers",
        bSort: true,    
    });
    
    // เปิดใช้งาน Bootstrap Tooltip เผื่อผู้ใช้เอาเมาส์มาชี้ที่ปุ่ม
    $('[data-toggle="tooltip"]').tooltip();
});

confirmDel = (refid) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการลบรายการนี้หรือไม่ ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        // ปรับแต่งสีปุ่มใน SweetAlert2 ให้ตรงกับธีมหลัก
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
                url: `{{ url('/cancelReference') }}`,
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