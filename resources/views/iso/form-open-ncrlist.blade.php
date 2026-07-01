@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #f5f3ff;
        --indigo-focus: rgba(79, 70, 229, 0.15);
        --text-dark: #1e1b4b;
    }
    .text-indigo-dark { color: var(--text-dark); }
    
    /* สไตล์สำหรับ Form Filter */
    .filter-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #eef2f6;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    .form-control-indigo {
        border: 1.5px solid #e0e7ff;
        border-radius: 10px;
        padding: 0.55rem 0.75rem;
        transition: all 0.3s ease;
        color: #334155;
    }
    .form-control-indigo:focus {
        border-color: var(--indigo-primary);
        box-shadow: 0 0 0 4px var(--indigo-focus);
    }
    
    /* สไตล์สำหรับ Checkbox แบบโมเดิร์น */
    .custom-chk-container {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        user-select: none;
        padding-top: 8px;
    }
    .custom-chk-container input {
        width: 18px;
        height: 18px;
        accent-color: var(--indigo-primary);
        cursor: pointer;
    }

    /* สไตล์ปุ่มกด */
    .btn-indigo-search {
        background-color: var(--indigo-primary);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.55rem 1.5rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-indigo-search:hover {
        background-color: var(--indigo-hover);
        color: white;
        transform: translateY(-1px);
    }
    .btn-indigo-create {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1.25rem;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2);
        transition: all 0.2s ease;
    }
    .btn-indigo-create:hover {
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(79, 70, 229, 0.3);
    }

    /* ปรับแต่งสไตล์ตารางข้อมูล */
    .table-modern {
        border-collapse: separate !important;
        border-spacing: 0 6px !important;
    }
    .table-modern thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        border: none !important;
        padding: 12px 10px !important;
    }
    .table-modern tbody tr {
        background-color: #ffffff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        transition: transform 0.15s ease;
    }
    .table-modern tbody tr:hover {
        background-color: var(--indigo-light) !important;
    }
    .table-modern tbody td {
        padding: 12px 10px !important;
        vertical-align: middle !important;
        border-top: 1px solid #f1f5f9 !important;
        border-bottom: 1px solid #f1f5f9 !important;
        border-left: none !important;
        border-right: none !important;
        color: #334155;
    }
    .table-modern tbody tr td:first-child {
        border-left: 1px solid #f1f5f9 !important;
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }
    .table-modern tbody tr td:last-child {
        border-right: 1px solid #f1f5f9 !important;
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    /* ปุ่ม Action ขนาดเล็กในตาราง */
    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        margin: 0 2px;
    }
    
    /* สไตล์คัสตอมปุ่มสำหรับ SweetAlert2 */
    .swal2-confirm-indigo {
        background-color: var(--indigo-primary) !important;
        color: white !important;
        padding: 10px 24px !important;
        font-size: 16px !important;
        border-radius: 8px !important;
        margin: 0 8px !important;
    }
    .swal2-cancel-muted {
        background-color: #64748b !important;
        color: white !important;
        padding: 10px 24px !important;
        font-size: 16px !important;
        border-radius: 8px !important;
        margin: 0 8px !important;
    }
</style>

<div class="container-fluid mt-4">
    <div class="row">  
        <div class="col-12">
            <div class="card filter-card border-0">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
                    <form method="GET" class="form-horizontal">
                        @csrf
                        <div class="row align-items-center g-3">
                            <div class="col-12 col-xl-3 col-lg-12">
                                <h3 class="m-0" style="font-weight: 800; color: var(--text-dark);">
                                    <i class="fas fa-file-alt text-indigo-600 me-2" style="color: var(--indigo-primary);"></i> เอกสาร NCR
                                </h3>
                            </div>
                            <div class="col-6 col-xl-2 col-md-3">
                                <div class="d-flex align-items-center">
                                    <label for="datestart" class="me-2 fw-bold text-secondary mb-0 text-nowrap">วันที่</label>
                                    <input type="date" class="form-control form-control-indigo" name="datestart" id="datestart" value="{{$datestart}}">
                                </div>
                            </div>
                            <div class="col-6 col-xl-2 col-md-3">
                                <div class="d-flex align-items-center">
                                    <label for="dateend" class="me-2 fw-bold text-secondary mb-0 text-nowrap">ถึง</label>
                                    <input type="date" class="form-control form-control-indigo" name="dateend" id="dateend" value="{{$dateend}}">
                                </div>
                            </div>
                            <div class="col-6 col-xl-1-5 col-md-3 d-flex align-items-center justify-content-start">
                                <label class="custom-chk-container mb-0">
                                    <input type="checkbox" id="checkboxPrimary1" name="ck_sta">
                                    <span class="fw-bold text-secondary">รออนุมัติ</span>
                                </label>
                            </div>
                            <div class="col-6 col-xl-1-5 col-md-3">
                                <a href="{{route('ncr-report.create')}}" class="btn btn-indigo-create text-nowrap">
                                    <i class="fas fa-plus-circle me-1"></i> สร้างเอกสาร
                                </a>
                            </div>
                            <div class="col-12 col-xl-2 text-xl-end text-start mt-xl-3 mt-2 ms-xl-auto">
                                
                                <button class="btn btn-indigo-search w-100" type="submit">
                                    <i class="fas fa-search me-1"></i> ค้นหา
                                </button>
                            </div>                  
                        </div>
                    </form>
                </div>
                
                <div class="card-body px-4 pb-4">
                    <div class="table-responsive">
                        <table class="table table-modern" id="tb_job" style="width:100%">
                            <thead>
                                <tr>
                                    <th>สถานะ</th>
                                    <th>วันที่</th>
                                    <th>ผู้พบเห็น</th>
                                    <th>เลขที่</th>
                                    <th>หน่วยงานที่เกี่ยวข้อง</th>
                                    <th>เลขที่งาน</th>
                                    <th>ผลิตภัณฑ์</th>
                                    <th>ลักษณะความไม่สอดคล้อง</th>
                                    <th>ผู้กระทำผิด</th>
                                    <th class="text-center" style="width: 90px">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hd as $item)
                                    <tr>
                                        <td>
                                            <span class="badge bg-soft-indigo p-2" style="background-color: #e0e7ff; color: #4338ca; border-radius: 6px; font-weight: 600;">
                                                {{$item->iso_status_name}}
                                            </span>
                                        </td>
                                        <td class="fw-medium">{{\Carbon\Carbon::parse($item->reported_date)->format('Y/m/d')}}</td>
                                        <td>{{$item->iso_ncr_observer}}</td>
                                        <td class="fw-bold text-indigo-dark">{{$item->iso_ncr_docuno}}</td>
                                        <td>{{$item->iso_ncr_department}}</td>
                                        <td><span class="text-muted">{{$item->iso_ncr_jobnumber}}</span></td>
                                        <td>{{$item->iso_ncr_productname}}</td>
                                        <td><div class="text-truncate" style="max-width: 180px;" title="{{$item->iso_ncr_nonconformity}}">{{$item->iso_ncr_nonconformity}}</div></td>
                                        <td>{{$item->offender_by}}</td>
                                        <td class="text-center">
                                            <a href="{{route('ncr-report.edit',$item->iso_ncr_id)}}" class="btn btn-warning btn-action text-white" title="แก้ไข">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-action" 
                                               onclick="confirmDel('{{ $item->iso_ncr_docuno }}','{{ $item->iso_ncr_id }}')" title="ลบ">
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
        "pageLength": 20,
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
            [3, "desc"]
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
        pagingType: "full_numbers",
        bSort: true
    });
}); 

confirmDel = (docs, refid) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการลบรายการ NCR เลขที่ ${docs} นี้หรือไม่ ?`, // แก้ไขข้อความแจ้งเตือนจาก CAR เป็น NCR ให้ตรงกับหน้างานจริง
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '<i class="fas fa-check me-1"></i> ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            confirmButton: 'swal2-confirm-indigo',
            cancelButton: 'swal2-cancel-muted'
        },
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelDocsNcr') }}`,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "docuno": docs,
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
                            customClass: { confirmButton: 'swal2-confirm-indigo' },
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
                            customClass: { confirmButton: 'swal2-confirm-indigo' },
                            buttonsStyling: false
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิกแล้ว',
                text: 'โปรดตรวจสอบข้อมูลอีกครั้งเพื่อความถูกต้อง :)',
                icon: 'error',
                confirmButtonText: 'ตกลง',
                customClass: { confirmButton: 'swal2-confirm-indigo' },
                buttonsStyling: false
            });
        }
    });
} 
</script>
@endpush