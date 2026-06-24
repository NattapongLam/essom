@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/fixedcolumns/4.2.2/css/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />

<div class="mt-2">
    @if(session('success'))
    <div class="alert alert-indigo-success alert-dismissible fade show border-0 shadow-sm rounded-lg" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle mr-2 text-xl"></i>
            <div>{{ session('success') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-indigo-danger alert-dismissible fade show border-0 shadow-sm rounded-lg" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-exclamation-circle mr-2 text-xl"></i>
            <div>{{ session('error') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm rounded-xl border-0">
                <form method="POST" class="form-horizontal" action="{{ route('pd-woho.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <a href="{{route('pd-woho.index')}}" class="text-indigo decoration-none mr-2">
                                <i class="fas fa-arrow-left font-weight-bold text-lg"></i>
                            </a>
                            <h3 class="card-title text-dark mb-0 font-weight-700" style="font-size: 1.35rem;">
                                บันทึกชั่วโมงการทำงานพนักงาน
                            </h3>
                        </div>

                        <div class="row bg-light p-3 rounded-lg mx-0 mb-4 align-items-center border border-gray-100">
                            <div class="col-12 col-md-3 mb-2 mb-md-0">
                                <div class="form-group row mb-0 align-items-center">
                                    <label for="workinghours_hd_date" class="col-sm-3 col-form-label font-weight-bold text-secondary">วันที่</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control rounded-lg border-gray-300" name="workinghours_hd_date" id="workinghours_hd_date" value="{{date('Y-m-d')}}" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-5 mb-2 mb-md-0">
                                <div class="form-group row mb-0 align-items-center">
                                    <label for="ms_employee_id" class="col-sm-3 col-form-label font-weight-bold text-secondary">พนักงาน</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 @error('ms_employee_id') is-invalid @enderror" style="width: 100%;" name="ms_employee_id" id="ms_employee_id">
                                            <option value="">กรุณาเลือกพนักงาน</option>
                                            @foreach ($emps as $item)
                                            <option value="{{$item->ms_employee_id}}" 
                                                    data-code="{{$item->ms_employee_code}}" 
                                                    {{ old('ms_employee_id', $emp->ms_employee_id) == $item->ms_employee_id ? 'selected' : null }}>
                                                [{{$item->ms_employee_code}}] - {{$item->ms_employee_fullname}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('ms_employee_id')
                                        <div id="ms_employee_id_validation" class="invalid-feedback font-weight-bold">
                                            {{$message}}
                                        </div>
                                        @enderror   
                                        <input type="hidden" name="workinghours_hd_docuno" id="workinghours_hd_docuno" value="{{$docs}}" readonly>
                                        <input type="hidden" name="workinghours_hd_number" id="workinghours_hd_number" value="{{$docs_number}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <div class="form-group row mb-0 align-items-center">
                                    <label for="ms_department_id" class="col-sm-3 col-form-label font-weight-bold text-secondary">แผนก</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 @error('ms_department_id') is-invalid @enderror" style="width: 100%;" name="ms_department_id" id="ms_department_id">
                                            <option value="">กรุณาเลือกแผนก</option>
                                            @foreach ($dep as $item)
                                            <option value="{{$item->ms_department_id}}"
                                                {{ old('ms_department_id', $emp->ms_department_id) == $item->ms_department_id ? 'selected' : null }}>
                                                {{$item->ms_department_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('ms_department_id')
                                        <div id="ms_department_id_validation" class="invalid-feedback font-weight-bold">
                                            {{$message}}
                                        </div>
                                        @enderror   
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-1">
                                <button type="submit" class="btn btn-indigo btn-block font-weight-bold rounded-lg py-2 shadow-sm">
                                    <i class="fas fa-save mr-1"></i> บันทึก
                                </button>
                            </div>
                        </div>          

                        <div class="row mx-0 mb-4 p-3 border border-gray-200 rounded-lg bg-white shadow-xs">
                            <div class="col-12">
                                <h5 class="text-secondary font-weight-bold mb-3" style="font-size: 0.95rem;">
                                    <i class="fas fa-history text-muted mr-1"></i> ประวัติการบันทึกงานย้อนหลัง 7 วันของพนักงาน
                                </h5>
                                <div class="table-responsive">
                                    <table class="table table-custom table-sm table-hover" id="jobTable" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-secondary py-2" style="width: 250px;">วันที่ทำงาน</th>
                                                <th class="text-secondary py-2">เลขที่เอกสารงาน</th>
                                                <th class="text-right text-secondary py-2" style="width: 200px;">จำนวนชั่วโมงสะสม</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-3">กรุณาเลือกพนักงานเพื่อดูประวัติข้อมูลย้อนหลัง</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="form-group mb-0">
                                    <label for="workinghours_hd_remark" class="font-weight-bold text-secondary mb-1">หมายเหตุเอกสารเพิ่มเติม</label>
                                    <input class="form-control rounded-lg border-gray-300" name="workinghours_hd_remark" id="workinghours_hd_remark" type="text" placeholder="ระบุเหตุผลหรือรายละเอียดเพิ่มเติม (ถ้ามี)...">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">         
                            <div class="col-12">
                                <h5 class="text-dark font-weight-bold mb-2" style="font-size: 1.05rem;">
                                    <i class="fas fa-list-ol text-indigo mr-1"></i> รายการงานที่กำลังลงเวลาบันทึก
                                </h5>
                                <div class="table-responsive">
                                    <table class="table table-custom align-middle table-sm" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-center text-secondary py-2.5" style="width: 80px;">ลำดับ</th>
                                                <th class="text-center text-secondary py-2.5" style="width: 180px;">เลขที่งาน</th>
                                                <th class="text-secondary py-2.5">รายละเอียดสินค้า</th> 
                                                <th class="text-center text-secondary py-2.5" style="width: 200px;">จัดการเวลาทำงาน</th>                    
                                                <th class="text-center text-secondary py-2.5" style="width: 90px;">ลบ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tb_employeelist">
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-4">ยังไม่มีรายการงานที่เลือก สามารถกดปุ่มเครื่องหมายด้านล่างตารางเพื่อเลือกรายการ</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="font-weight-bold bg-light" style="border-top: 2px solid #cbd5e1;">
                                                <td colspan="3" class="text-right text-dark py-3">ยอดรวมสะสมทั้งหมดของเอกสารชุดนี้:</td>
                                                <td class="text-center py-3">
                                                    <div class="badge badge-indigo-total px-3 py-2 rounded font-weight-bold text-md" style="font-size: 1rem;">
                                                        <span id="total_hours">0.0</span> ชม.
                                                    </div>
                                                </td>
                                                <td class="text-center py-3">
                                                    <div id="result_hours" class="d-none">8.5</div>
                                                    <span class="badge bg-secondary text-white px-2 py-1.5 rounded-lg text-xs" title="ขีดจำกัดชั่วโมง">Limit Setup</span>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="my-4 border-gray-200">
                        
                        <div class="row">            
                            <div class="col-12">
                                <h5 class="text-dark font-weight-bold mb-3" style="font-size: 1.05rem;">
                                    <i class="fas fa-search-plus text-success-indigo mr-1"></i> เลือกรายการคำสั่งผลิตสินค้า (Production Jobs List)
                                </h5>
                                <div class="table-responsive">
                                    <table id="tb_job" class="table table-custom table-hover align-middle table-sm" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-center text-secondary py-3" style="width: 90px;">เลือกงาน</th>
                                                <th class="text-center text-secondary py-3" style="width: 80px;">ลำดับ</th>
                                                <th class="text-center text-secondary py-3" style="width: 180px;">เลขที่เอกสารงาน</th>
                                                <th class="text-secondary py-3">รายละเอียดสินค้างานผลิต</th>
                                                <th class="text-center text-secondary py-3" style="width: 150px;">ประเภทงาน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($job as $key => $item)
                                                <tr>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-action-add btn-sm shadow-xs rounded-circle" onclick="addTolist({{$item->id}})" title="เพิ่มชิ้นงานนี้เข้าตาราง">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center font-weight-bold text-muted">{{$key+1}}</td>
                                                    <td class="text-center font-weight-bold text-primary">{{$item->productionopenjob_hd_docuno}}</td>
                                                    <td class="font-weight-500 text-dark">{{$item->ms_product_name}}</td>
                                                    <td class="text-center">
                                                        <span class="badge bg-light text-dark border px-2.5 py-1.5 rounded font-weight-500">
                                                            {{$item->workinghours_type_name}}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* สไตล์คุมโทนระบบโมเดิร์นคัลเลอร์ Indigo */
    .text-indigo { color: #4f46e5 !important; }
    .decoration-none { text-decoration: none !important; }
    .font-weight-700 { font-weight: 700; }
    .font-weight-500 { font-weight: 500; }
    .rounded-xl { border-radius: 1rem !important; }
    .text-md { font-size: 1.1rem; }
    
    .btn-indigo {
        background-color: #4f46e5 !important;
        border-color: #4f46e5 !important;
        color: #ffffff !important;
    }
    .btn-indigo:hover, .btn-indigo:focus {
        background-color: #4338ca !important;
        color: #ffffff !important;
    }
    
    /* สไตล์ปุ่ม Action ต่างๆ */
    .btn-action-add {
        background-color: #e0e7ff;
        color: #4f46e5;
        border: none;
        width: 32px;
        height: 32px;
        padding: 0;
        transition: all 0.2s ease;
    }
    .btn-action-add:hover {
        background-color: #4f46e5;
        color: #ffffff;
        transform: scale(1.08);
    }
    .btn-action-remove {
        background-color: #fee2e2;
        color: #dc2626;
        border-radius: 6px;
    }
    .btn-action-remove:hover {
        background-color: #fecaca;
        color: #b91c1c;
    }

    /* ตารางโมเดิร์นไร้ขอบล้น */
    .table-custom thead th {
        border-bottom: 2px solid #e2e8f0 !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.82rem;
        letter-spacing: 0.5px;
        background-color: #f8fafc;
    }
    .table-custom tbody tr { transition: all 0.15s; }
    .table-custom tbody tr:hover { background-color: #f1f5f9 !important; }
    .align-middle td { vertical-align: middle !important; }
    
    /* กล่อง Badge สะสมแต้ม */
    .badge-indigo-total {
        background-color: #4f46e5;
        color: #ffffff;
        box-shadow: 0 2px 4px rgba(79, 70, 229, 0.25);
    }
    .text-success-indigo { color: #6d28d9 !important; }

    /* ตกแต่ง Alert Box */
    .alert-indigo-success { background-color: #ecfdf5; color: #065f46; border-left: 4px solid #10b981 !important; }
    .alert-indigo-danger { background-color: #fef2f2; color: #991b1b; border-left: 4px solid #ef4444 !important; }
    
    /* สไตล์ Inputs แถวบันทึกเวลา */
    .input-hours-styled {
        border-radius: 6px 0 0 6px !important;
        border: 1px solid #cbd5e1;
        text-align: center;
        font-weight: bold;
        color: #334155;
    }
    .select-time-styled {
        border-radius: 0 6px 6px 0 !important;
        border: 1px solid #cbd5e1;
        border-left: none;
        background-color: #f8fafc;
        font-weight: 500;
        color: #475569;
    }
</style>
@endsection

@push('scriptjs')
<script src="{{ asset('/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>
<script>
$(function () {
    $('.select2').select2()
})

$(document).on('input change', '.input-hours-trigger, .select-time-trigger', function() {
    calculateTotalHours();
});

const addTolist = (id) => {
    console.log(id)
    $.ajax({
        url: "{{ url('/getEmployee') }}",
        type: "POST",
        data: {
            id: id,
            _token: '{{ csrf_token() }}'
        },
        dataType: "json",
        success: function(data) {              
            // ลบแถวข้อความว่างเปล่าออก ถ้ามี
            if ($('#tb_employeelist tr').length === 1 && $('#tb_employeelist tr td').attr('colspan') === '5') {
                $('#tb_employeelist').empty();
            }

            let numbertd = $('#tb_employeelist tr').length + 1;
            let isProduct = (data.emp.workinghours_type_name === 'Product') ? 'true' : 'false';

            $('#tb_employeelist').append(`
            <tr style="background-color:#ffffff" class="${data.emp.id} align-middle">                 
                <td class="text-center font-weight-bold text-secondary">
                    <input type="hidden" name="productionopenjob_hd_docuno[]" value="${data.emp.id}">${numbertd}
                </td>   
                <td class="text-center font-weight-bold text-primary">${data.emp.productionopenjob_hd_docuno}</td>
                <td class="font-weight-500 text-dark">${data.emp.ms_product_name}</td>
                <td class="text-center">
                    <input type="hidden" id="job_id[]" name="job_id[]" value="${data.emp.id}">
                    <div class="input-group justify-content-center">
                        <input class="form-control input-hours-trigger input-hours-styled" 
                               type="number" 
                               id="workinghours_dt_hours[]" 
                               name="workinghours_dt_hours[]" 
                               value="0" 
                               style="max-width:75px;" 
                               min="0"
                               data-is-product="${isProduct}">

                        <select class="form-control select-time-trigger select-time-styled" style="max-width:75px;" id="workinghours_dt_time[]" name="workinghours_dt_time[]">
                            <option value="0">.00</option>
                            <option value="30">.30</option>
                        </select>
                    </div>
                </td>                                                                     
                <td class="text-center">
                    <button type="button" class="btn btn-action-remove btn-sm shadow-xs" onclick="removeTolist('${data.emp.id}')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
            `);

            calculateTotalHours();
        }
    })
}

const removeTolist = (id) => {
    $(`.${id}`).remove();
    
    // หากลบจนเกลี้ยงตาราง ให้แสดงแถวแจ้งเตือนไม่มีข้อมูล
    if ($('#tb_employeelist tr').length === 0) {
        $('#tb_employeelist').html('<tr><td colspan="5" class="text-center text-muted py-4">ยังไม่มีรายการงานที่เลือก สามารถกดปุ่มเครื่องหมายด้านล่างตารางเพื่อเลือกรายการ</td></tr>');
    } else {
        // เรียงข้อใหม่ลำดับเลขแถว
        $('#tb_employeelist tr').each(function(index) {
            $(this).find('td:first').html(`<input type="hidden" name="productionopenjob_hd_docuno[]" value="${$(this).attr('class')}">${index + 1}`);
        });
    }

    calculateTotalHours();
}

$(document).ready(function() {
    $('#tb_job').DataTable({
        "pageLength": 40,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', className: 'btn btn-sm btn-light border' },
            { extend: 'csv', className: 'btn btn-sm btn-light border' },
            { extend: 'excel', className: 'btn btn-sm btn-light border' },
            { extend: 'pdf', className: 'btn btn-sm btn-light border' },
            { extend: 'print', className: 'btn btn-sm btn-light border' }
        ],
        order: [
            [1, "asc"]
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
        pagingType: "full_numbers",
        bSort: true, 
    })
}); 

$(document).ready(function () {
    $('#ms_employee_id').on('change', function () {
        let empId = $(this).val();
        let tbody = $('#jobTable tbody');

        tbody.html('<tr><td colspan="3" class="text-center text-muted py-3"><i class="fas fa-spinner fa-spin mr-1"></i> กำลังโหลดข้อมูลย้อนหลัง...</td></tr>');

        if (empId === '') {
            tbody.html('<tr><td colspan="3" class="text-center text-muted py-3">กรุณาเลือกพนักงานเพื่อดูประวัติข้อมูลย้อนหลัง</td></tr>');
            return;
        }

        $.ajax({
            url: "{{ route('employee.jobs') }}",
            type: "GET",
            data: {
                ms_employee_id: empId
            },
            success: function (res) {
                tbody.empty();

                if (res.length === 0) {
                    tbody.append('<tr><td colspan="3" class="text-center text-secondary py-3">ไม่พบประวัติการทำงานในรอบ 7 วันที่ผ่านมา</td></tr>');
                    return;
                }

                $.each(res, function (index, item) {
                    tbody.append(`
                        <tr>
                            <td class="font-weight-bold text-muted">${item.workinghours_hd_date}</td>
                            <td class="font-weight-bold text-secondary">${item.productionopenjob_hd_docuno}</td>
                            <td class="text-right text-dark font-weight-bold">${parseFloat(item.workinghours_dt_hours).toFixed(2)} ชม.</td>
                        </tr>
                    `);
                });
            },
            error: function () {
                tbody.html('<tr><td colspan="3" class="text-danger text-center py-3">เกิดข้อผิดพลาดในการดึงประวัติการทำงาน</td></tr>');
            }
        });
    });
});

$('#ms_employee_id, #workinghours_hd_date').on('change', function() {
    let empId = $('#ms_employee_id').val();
    let empCode = $('#ms_employee_id').find(':selected').data('code'); 
    let checkDate = $('#workinghours_hd_date').val();

    if(empId && checkDate) {
        $.ajax({
            url: "{{ route('employee.checkLeave') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                ms_employee_code: empCode,
                check_date: checkDate
            },
            success: function(response) {
                let otHours = parseFloat(response.overtime_hours) || 0;

                // 1. เคสพนักงานมีการลาหยุดในระบบ
                if(response.is_leave) {
                    let leave = response.leave_data; 
                    let leaveName = leave.ms_leave_name; 
                    
                    if (leaveName && leaveName.includes('เต็มวัน')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สามารถบันทึกงานได้',
                            text: `พนักงานท่านนี้ลงทะเบียนลาแบบ [${leaveName}] เรียบร้อยแล้ว`,
                            confirmButtonText: 'รับทราบ',
                            customClass: { confirmButton: 'btn btn-indigo px-4' },
                            buttonsStyling: false
                        });
                        $('#workinghours_hd_date').val('');                     
                        
                        if(response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }
                        return;
                    }
                    else if (leaveName && leaveName.includes('ครึ่งวัน')) {
                        if(leaveName && leaveName.includes('วันเช้า')){
                            Swal.fire({
                                icon: 'warning',
                                title: 'คำแนะนำเพิ่มเติม',
                                text: `พนักงานลาแบบ [${leaveName}] โปรดตรวจสอบความถูกต้องของชั่วโมงเข้างาน`,
                                confirmButtonText: 'ตกลง',
                                customClass: { confirmButton: 'btn btn-indigo px-4' },
                                buttonsStyling: false
                            });
                            
                            let baseHours = 4.5;
                            let totalHours = baseHours + otHours;
                            
                            $('#result_hours').text(totalHours.toFixed(1));
                            calculateTotalHours();
                            return;
                            
                        } else if (leaveName && leaveName.includes('วันบ่าย')){
                            Swal.fire({
                                icon: 'warning',
                                title: 'คำแนะนำเพิ่มเติม',
                                text: `พนักงานลาแบบ [${leaveName}] โปรดตรวจสอบความถูกต้องของชั่วโมงเข้างาน`,
                                confirmButtonText: 'ตกลง',
                                customClass: { confirmButton: 'btn btn-indigo px-4' },
                                buttonsStyling: false
                            });
                            
                            let baseHours = 4;
                            let totalHours = baseHours + otHours;
                            
                            $('#result_hours').text(totalHours.toFixed(1));
                            calculateTotalHours();
                            return;
                        }
                    }
                    else {
                        Swal.fire({
                            icon: 'info',
                            title: 'ตรวจสอบสถานะการลา',
                            text: `พนักงานอยู่ในสถานะ: ${leaveName}`,
                            confirmButtonText: 'ตกลง',
                            customClass: { confirmButton: 'btn btn-indigo px-4' },
                            buttonsStyling: false
                        });
                        let baseHours = 8.5;
                        let totalHours = baseHours + otHours;
                        
                        $('#result_hours').text(totalHours.toFixed(1));
                        calculateTotalHours();
                    }
                } 
                // 2. เคสพนักงานมาทำงานปกติ (ไม่ได้ลา)
                else {
                    let baseHours = 8.5; 
                    let totalHours = baseHours + otHours; 
                    
                    $('#result_hours').text(totalHours.toFixed(1));
                    calculateTotalHours();
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }
});

const calculateTotalHours = () => { 
    let total = 0;
    let totalProductHours = 0;

    $('#tb_employeelist tr').each(function() {
        let inputHours = $(this).find('input[name="workinghours_dt_hours[]"]');
        if(inputHours.length > 0) {
            let hours = parseFloat(inputHours.val()) || 0;
            let minutesValue = parseFloat($(this).find('select[name="workinghours_dt_time[]"]').val()) || 0;
            let minutes = minutesValue === 30 ? 0.5 : 0;

            let rowTotal = hours + minutes;
            total += rowTotal;

            let isProduct = inputHours.data('is-product') === true || inputHours.data('is-product') === "true";
            if (isProduct) {
                totalProductHours += rowTotal;
            }
        }
    });

    $('#total_hours').text(total.toFixed(1));
    let maxHours = parseFloat($('#result_hours').text()) || 0;

    // ตรวจสอบเงื่อนไขการทำงานและแจ้งเตือนด้วย SweetAlert2 ธีมพรีเมียม
    if (totalProductHours > 7) {
        Swal.fire({
            icon: 'error',
            title: 'ระงับการบันทึก: ยอดงาน Product เกินกำหนด',
            text: `ปัจจุบันลงงาน Product รวมกันไป ${totalProductHours.toFixed(1)} ชม. (ระบบกำหนดห้ามเกิน 7.0 ชม.)`,
            confirmButtonText: 'แก้ไขข้อมูล',
            customClass: { confirmButton: 'btn btn-danger px-4' },
            buttonsStyling: false
        });

        $('#total_hours').css('color', '#ef4444');
        $('button[type="submit"]').prop('disabled', true);
    } 
    else if (total > maxHours) {
        Swal.fire({
            icon: 'error',
            title: 'ระงับการบันทึก: จำนวนชั่วโมงรวมเกินโควตา',
            text: `จำนวนชั่วโมงทั้งหมดของคุณคือ ${total.toFixed(1)} ชม. ซึ่งสิทธิ์ของวันนั้นลงได้สูงสุด ${maxHours.toFixed(1)} ชม.`,
            confirmButtonText: 'แก้ไขข้อมูล',
            customClass: { confirmButton: 'btn btn-danger px-4' },
            buttonsStyling: false
        });

        $('#total_hours').css('color', '#ef4444');
        $('button[type="submit"]').prop('disabled', true);
    } 
    else {
        $('#total_hours').css('color', '');
        $('button[type="submit"]').prop('disabled', false);
    }
}
</script>
@endpush