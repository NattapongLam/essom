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

    /* สไตล์แถบสีสถานะแบบมีตัวเลข (Badge with count indicator) */
    .status-badge-wrapper {
        display: inline-flex;
        align-items: center;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 4px 10px;
        font-weight: 600;
        font-size: 0.875rem;
    }
    .status-color-bar {
        width: 6px;
        height: 16px;
        border-radius: 4px;
        margin-right: 8px;
    }
    .status-count-pill {
        background: #e0e7ff;
        color: #4338ca;
        padding: 1px 6px;
        border-radius: 6px;
        font-size: 0.75rem;
        margin-left: 8px;
        font-weight: 700;
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
                                    <th>เลขที่ CAR</th>
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
                                    @php
                                        // คำนวณจำนวนวันที่ผ่านไปนับจาก reported_date ถึงปัจจุบัน
                                        $reportedDate = \Carbon\Carbon::parse($item->reported_date);
                                        $daysPassed = $reportedDate->diffInDays(\Carbon\Carbon::now());
                                        
                                        // กำหนดสีแถบตามเงื่อนไขความเก่าของวันที่ (ตัวอย่าง: เกิน 30 วัน สีแดง, เกิน 15 วัน สีเหลือง, ปกติสีเขียว/น้ำเงิน)
                                        $barColor = '#10b981'; // เขียว
                                        if ($daysPassed > 30) {
                                            $barColor = '#ef4444'; // แดง
                                        } elseif ($daysPassed > 15) {
                                            $barColor = '#f59e0b'; // ส้ม/เหลือง
                                        }
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="status-badge-wrapper">
                                                <span class="status-color-bar" style="background-color: {{ $barColor }};"></span>
                                                <span>{{$item->iso_status_name}}</span>
                                                <span class="status-count-pill" title="จำนวนวันที่ผ่านมานับจากวันที่รายงาน">{{ $daysPassed }} วัน</span>
                                            </div>
                                        </td>
                                        <td class="fw-medium">{{$reportedDate->format('Y/m/d')}}</td>                                       
                                        <td>{{$item->iso_ncr_observer}}</td>
                                        <td class="fw-bold text-indigo-dark">{{$item->iso_ncr_docuno}}</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm car-docuno-input" 
                                                    data-id="{{ $item->iso_ncr_id }}" 
                                                    value="{{ $item->iso_car_docuno }}" 
                                                    placeholder="ระบุเลขที่ CAR">
                                        </td>
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
    var table = $('#tb_job').DataTable({
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

    // เงื่อนไข: ซ่อนสถานะ "ปิดเอกสาร" อัตโนมัติในตาราง (คอลัมน์ที่ 0 คือสถานะ)
    table.column(0).search('^(?!.*ปิดเอกสาร).*$', true, false).draw();

    // ฟังก์ชันคำนวณวันเริ่มต้นบวกเพิ่ม 30 วันไปยังช่องวันที่สิ้นสุดอัตโนมัติ
    $('#datestart').on('change', function() {
        let startDateVal = $(this).val();
        if (startDateVal) {
            let startDate = new Date(startDateVal);
            
            // บวกเพิ่มไปอีก 30 วัน
            startDate.setDate(startDate.getDate() + 30);
            
            let yyyy = startDate.getFullYear();
            let mm = String(startDate.getMonth() + 1).padStart(2, '0');
            let dd = String(startDate.getDate()).padStart(2, '0');
            
            let endDateVal = `${yyyy}-${mm}-${dd}`;
            
            // กำหนดค่าให้กับช่อง "ถึง" (dateend)
            $('#dateend').val(endDateVal);
        }
    });
}); 

confirmDel = (docs, refid) => {      
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการลบรายการ NCR เลขที่ ${docs} นี้หรือไม่ ?`,
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
$(document).on('blur change', '.car-docuno-input', function() {
    let input = $(this);
    let ncrId = input.data('id');
    let carDocuno = input.val();

    // ป้องกันการยิงซ้ำถ้าค่าเดิมไม่เปลี่ยน
    if (input.data('val') === carDocuno) return;

    $.ajax({
        url: "{{ route('ncr-report.update-car') }}", // กำหนด Route สำหรับอัปเดตเฉพาะช่องนี้
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "id": ncrId,
            "iso_car_docuno": carDocuno
        },
        dataType: "json",
        success: function(response) {
            if (response.status) {
                input.data('val', carDocuno); // บันทึกค่าล่าสุดไว้เทียบ
                // แสดงแจ้งเตือนแบบเล็กๆ มุมจอ (ตัวอย่างใช้ SweetAlert2 แบบ Toast)
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                });
                Toast.fire({
                    icon: 'success',
                    title: 'บันทึกเลขที่ CAR สำเร็จ'
                });
            } else {
                Swal.fire('ผิดพลาด', response.message || 'ไม่สามารถบันทึกข้อมูลได้', 'error');
            }
        },
        error: function() {
            Swal.fire('ผิดพลาด', 'เกิดข้อผิดพลาดในการเชื่อมต่อเซิร์ฟเวอร์', 'error');
        }
    });
});

// เก็บค่าเริ่มต้นไว้เทียบตอนโหลดหน้าเสร็จ
$('.car-docuno-input').each(function() {
    $(this).data('val', $(this).val());
});
</script>
@endpush