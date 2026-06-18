@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/fixedcolumns/4.2.2/css/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />
<div class="mt-4"><br>
<div class="row">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-block-helper me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="col-12">
    <div class="card">
        <form method="POST" class="form-horizontal" action="{{ route('pd-woho.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <h3 class="card-title" style="font-weight: bold"><a href="{{route('pd-woho.index')}}">เอกสารบันทึกชั่วโมงการทำงาน</h3></a><br>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group row">
                        <label for="workinghours_hd_date" class="col-sm-3 col-form-label">วันที่</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" name="workinghours_hd_date" id="workinghours_hd_date" class="form-control" value="{{date('Y-m-d')}}" autofocus>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-group row">
                        <label for="workinghours_hd_docuno" class="col-sm-3 col-form-label">พนักงาน</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 @error('ms_employee_id') is-invalid @enderror" style="width: 100%;" name="ms_employee_id" id="ms_employee_id">
                                <option value="">กรุณาเลือก</option>
                                @foreach ($emps as $item)
                                <option value="{{$item->ms_employee_id}}" 
                                        data-code="{{$item->ms_employee_code}}" 
                                        {{ old('ms_employee_id', $emp->ms_employee_id) == $item->ms_employee_id ? 'selected' : null }}>
                                    {{$item->ms_employee_code}}/{{$item->ms_employee_fullname}}
                                </option>
                                @endforeach
                            </select>
                                @error('ms_employee_id')
                                <div id="ms_employee_id_validation" class="invalid-feedback">
                                  {{$message}}
                                </div>
                                @enderror   
                          <input type="hidden" class="form-control" name="workinghours_hd_docuno" id="workinghours_hd_docuno" class="form-control" value="{{$docs}}"readonly>
                          <input type="hidden" name="workinghours_hd_number" id="workinghours_hd_number" value="{{$docs_number}}">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group row">
                        <label for="ms_department_id" class="col-sm-3 col-form-label">แผนก</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 @error('ms_department_id') is-invalid @enderror" style="width: 100%;" name="ms_department_id" id="ms_department_id">
                                <option value="">กรุณาเลือก</option>
                                @foreach ($dep as $item)
                                <option value="{{$item->ms_department_id}}"
                                    {{ old('ms_department_id', $emp->ms_department_id) == $item->ms_department_id ? 'selected' : null }}>
                                    {{$item->ms_department_name}}</option>
                                @endforeach
                            </select>
                                @error('ms_department_id')
                                <div id="ms_department_id_validation" class="invalid-feedback">
                                  {{$message}}
                                </div>
                                @enderror   
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-1">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            บันทึก
                         </button>
                    </div>
                </div>
            </div>           
            <div class="row">
                <h5>ประวัติการบันทึกย้อนหลัง 7 วัน</h5>
                <table class="table" id="jobTable">
                <thead>
                    <tr>
                        <th>วันที่</th>
                        <th>เลขที่งาน</th>
                        <th>จำนวน</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3" class="text-center">กรุณาเลือกพนักงาน</td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                <div class="form-group">
                    <label for="workinghours_hd_remark">หมายเหตุ</label>
                    <input class="form-control" name="workinghours_hd_remark" id="workinghours_hd_remark" type="text">
                </div>
                </div>
            </div>
              <div class="row">             
                <div class="col-12">
                   
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="background-color:#F5F5F5">
                                <th class="text-center">ลำดับ</th>
                                <th>เลขที่งาน</th>
                                <th>สินค้า</th> 
                                <th class="text-center">จำนวนชั่วโมง</th>                    
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody id="tb_employeelist">
                        </tbody>
                        <tfoot>
                            <tr style="background-color:#EAEAEA; font-weight: bold;">
                                <td colspan="3" class="text-right">ยอดรวมทั้งหมด:</td>
                                <td class="text-center">
                                    <span id="total_hours">0.0</span> ชม.
                                </td>
                                <td>
                                    <h6 id="result_hours"><span class="text-primary font-weight-bold">8.5</span> ชม.</h6>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                </div>
            </div><hr>
            <div class="row">             
                <div class="col-12">
                    <div class="table-responsive">
                        <div style="overflow-x:auto;">
                        <table id="tb_job" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>เลือก</th>
                                    <th>ลำดับ</th>
                                    <th>เลขที่งาน</th>
                                    <th>สินค้า</th>
                                    <th>ประเภท</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($job as $key => $item)
                                    <tr>
                                        <td class="text-center"><img src="{{asset('img/accept.png')}}" style="width: 30px" onclick="addTolist({{$item->id}})"> </td>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->productionopenjob_hd_docuno}}</td>
                                        <td>{{$item->ms_product_name}}</td>
                                        <td>{{$item->workinghours_type_name}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
</div>
</div>
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
addTolist = (id) => {
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
            $numbertd = $('#tb_employeelist tr').length + 1;
            
            // 🌟 เช็คว่าเป็นประเภท Product หรือไม่
            let isProduct = (data.emp.workinghours_type_name === 'Product') ? 'true' : 'false';

            $('#tb_employeelist').append(`
            <tr style="background-color:#F8F8FF" class="${data.emp.id}">                 
            <td class="text-center"><input type="hidden" name="productionopenjob_hd_docuno[]" value="${data.emp.id}">${$numbertd}</td>   
            <td class="text-center">${data.emp.productionopenjob_hd_docuno}</td>
            <td class="text-center">${data.emp.ms_product_name}</td>
            <td class="text-center">
                <input type="hidden" id="job_id[]" name="job_id[]" value="${data.emp.id}">
                
                <input class="form-control input-hours-trigger" 
                       type="number" 
                       id="workinghours_dt_hours[]" 
                       name="workinghours_dt_hours[]" 
                       value="0" 
                       style="width:70px;" 
                       min="0"
                       data-is-product="${isProduct}">

                <select class="form-control select-time-trigger" style="width:70px;" id="workinghours_dt_time[]" name="workinghours_dt_time[]">
                    <option value="0">.00</option>
                    <option value="30">.30</option>
                </select>
            </td>                                                     
            <td class="text-center"><button type="button" class="btn btn-danger btn-sm" onclick="removeTolist('${data.emp.id}')"><i class="fas fa-trash"></i></button></td>
            </tr>
            `);

            // คำนวณยอดรวมใหม่ทันทีเมื่อเพิ่มแถว
            calculateTotalHours();
        }
    })
}
removeTolist = (id) => {
    // โค้ดสั่งลบ TR เดิมของคุณ เช่น $(`.${id}`).remove();
    $(`.${id}`).remove();
    
    // จัดลำดับเลขข้อใหม่ (Optional)
    $('#tb_employeelist tr').each(function(index) {
        $(this).find('td:first').html(`<input type="hidden" name="productionopenjob_hd_docuno[]" value="${$(this).attr('class')}">${index + 1}`);
    });

    // เรียกคำนวณยอดรวมใหม่หลังจากลบเสร็จสิ้น
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
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            // columnDefs: [{
            //     targets: 1,
            //     type: 'time-date-sort'
            // }],
            order: [
                [0, "desc"]
            ],
            fixedHeader: {
                header:false,
                footer:false
            },
        pagingType: "full_numbers",
        bSort: true, 
    })
}); 
$(document).ready(function () {

    $('#ms_employee_id').on('change', function () {
        let empId = $(this).val();
        let tbody = $('#jobTable tbody');

        tbody.html('<tr><td colspan="3" class="text-center">กำลังโหลด...</td></tr>');

        if (empId === '') {
            tbody.html('<tr><td colspan="3" class="text-center">กรุณาเลือกพนักงาน</td></tr>');
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
                    tbody.append('<tr><td colspan="3" class="text-center">ไม่พบข้อมูล</td></tr>');
                    return;
                }

                $.each(res, function (index, item) {
                    tbody.append(`
                        <tr>
                            <td>${item.workinghours_hd_date}</td>
                            <td>${item.productionopenjob_hd_docuno}</td>
                            <td>${item.workinghours_dt_hours}</td>
                        </tr>
                    `);
                });
            },
            error: function () {
                tbody.html('<tr><td colspan="3" class="text-danger text-center">เกิดข้อผิดพลาด</td></tr>');
            }
        });
    });

});
$('#ms_employee_id, #workinghours_hd_date').on('change', function() {
    let empId = $('#ms_employee_id').val();
    
    // ดึงค่า ms_employee_code จาก data attribute ของ option ที่ถูกเลือก
    let empCode = $('#ms_employee_id').find(':selected').data('code'); 
    let checkDate = $('#workinghours_hd_date').val();

    // ตรวจสอบว่าเลือกครบหรือยัง (ใช้ empId เช็คว่าเลือกพนักงานแล้ว และมีวันที่)
    if(empId && checkDate) {
        $.ajax({
            url: "{{ route('employee.checkLeave') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                ms_employee_code: empCode, // ส่ง code ไปหลังบ้าน
                check_date: checkDate
            },
            success: function(response) {
                // 🌟 ย้ายมาไว้ด้านบนสุด เพื่อให้คำนวณโอทีและทำ Console Log ได้ทุกกรณี (ไม่ว่าจะลาหรือไม่ก็ตาม)
                let otHours = parseFloat(response.overtime_hours) || 0;

                // 1. [เคสที่ 1] พนักงานมีการลาหยุดในระบบ
                if(response.is_leave) {
                    let leave = response.leave_data; 
                    let leaveName = leave.ms_leave_name; // ตัวแปรที่ต้องการเช็ค
                    
                    // 1.1 ตรวจสอบกรณี "เต็มวัน"
                    if (leaveName && leaveName.includes('เต็มวัน')) {
                        alert('แจ้งเตือน: พนักงานท่านนี้ลา [' + leaveName + '] ไม่สามารถบันทึกงานได้');
                        $('#workinghours_hd_date').val(''); // เคลียร์ค่าวันที่                       
                        
                        if(response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }
                        return;
                    }

                    // 1.2 ตรวจสอบกรณี "ครึ่งวัน"
                    else if (leaveName && leaveName.includes('ครึ่งวัน')) {
                        
                        if(leaveName && leaveName.includes('วันเช้า')){
                            alert('ข้อแนะนำ: พนักงานท่านนี้ลาแบบ [' + leaveName + '] กรุณาตรวจสอบชั่วโมงทำงานให้ถูกต้อง');
                            
                            let baseHours = 4.5;
                            let totalHours = baseHours + otHours;
                            
                            console.log("--- พนักงานลาครึ่งวันเช้า ---");
                            console.log("ค่าโอทีจากหลังบ้าน:", response.overtime_hours);
                            console.log("ยอดรวมชั่วโมงสิทธิ์ (4.5 + OT):", totalHours);

                            $('#result_hours').html(`<span class="text-primary font-weight-bold">${totalHours.toFixed(1)}</span> ชม.`);
                            calculateTotalHours();
                            return;
                            
                        } else if (leaveName && leaveName.includes('วันบ่าย')){
                            alert('ข้อแนะนำ: พนักงานท่านนี้ลาแบบ [' + leaveName + '] กรุณาตรวจสอบชั่วโมงทำงานให้ถูกต้อง');
                            
                            let baseHours = 4;
                            let totalHours = baseHours + otHours;
                            
                            console.log("--- พนักงานลาครึ่งวันบ่าย ---");
                            console.log("ค่าโอทีจากหลังบ้าน:", response.overtime_hours);
                            console.log("ยอดรวมชั่วโมงสิทธิ์ (4.0 + OT):", totalHours);

                            $('#result_hours').html(`<span class="text-primary font-weight-bold">${totalHours.toFixed(1)}</span> ชม.`);
                            calculateTotalHours();
                            return;
                        }
                    }
                    
                    // 1.3 กรณีเป็นสถานะการลาอื่นๆ ที่ไม่มีคำว่า เต็มวัน หรือ ครึ่งวัน
                    else {
                        alert('คำเตือน: พนักงานอยู่ในสถานะการลา: ' + leaveName);
                        let baseHours = 8.5;
                        let totalHours = baseHours + otHours;
                        
                        console.log("--- พนักงานลาประเภทอื่นๆ ---");
                        console.log("ค่าโอทีจากหลังบ้าน:", response.overtime_hours);
                        console.log("ยอดรวมชั่วโมงสิทธิ์ (7.5 + OT):", totalHours);

                        $('#result_hours').html(`<span class="text-primary font-weight-bold">${totalHours.toFixed(1)}</span> ชม.`);
                        calculateTotalHours();
                    }
                } 
                
                // 2. [เคสที่ 2] 🌟 เพิ่มบล็อกนี้: พนักงานมาทำงานปกติ (ไม่ได้ลาหยุด) แต่มีโอกาสได้โอที
                else {
                    let baseHours = 8.5; // ชั่วโมงทำงานมาตรฐานของคนไม่ลา
                    let totalHours = baseHours + otHours; // คำนวณจริง 7.5 + 0.5 = 8.00
                    
                    console.log("--- พนักงานทำงานปกติ (ไม่ได้ลา) ---");
                    console.log("ค่าโอทีจากหลังบ้าน:", response.overtime_hours);
                    console.log("ค่าโอทีหลังแปลง:", otHours);
                    console.log("ยอดรวมชั่วโมงสิทธิ์ (7.5 + OT):", totalHours);
                    
                    // อัปเดตตัวเลขแสดงผลบนหน้าจอให้พนักงานปกติ
                    $('#result_hours').html(`<span class="text-primary font-weight-bold">${totalHours.toFixed(1)}</span> ชม.`);
                    
                    // เรียกฟังก์ชันตรวจสอบกับตารางแถวล่างสุดทันที
                    calculateTotalHours();
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText); // ดูโค้ดที่พังใน Console Log
            }
        });
    }
});
// เปลี่ยนจาก calculateTotalHours : () => เป็นแบบด้านล่างนี้ครับ
calculateTotalHours = () => { 
    let total = 0;
    let totalProductHours = 0; // 🌟 ตัวแปรสะสมชั่วโมงสำหรับงานที่เป็น Product ทั้งหมด

    // วนลูปหาทุกแถวที่อยู่ในตาราง tb_employeelist
    $('#tb_employeelist tr').each(function() {
        let inputHours = $(this).find('input[name="workinghours_dt_hours[]"]');
        let hours = parseFloat(inputHours.val()) || 0;
        let minutesValue = parseFloat($(this).find('select[name="workinghours_dt_time[]"]').val()) || 0;
        let minutes = minutesValue === 30 ? 0.5 : 0;

        let rowTotal = hours + minutes;
        total += rowTotal;

        // 🌟 ตรวจสอบว่าแถวนี้เป็นประเภท Product หรือไม่ ถ้าใช่ให้นำไปบวกรวมในกลุ่ม Product
        let isProduct = inputHours.data('is-product') === true || inputHours.data('is-product') === "true";
        if (isProduct) {
            totalProductHours += rowTotal;
        }
    });

    // แสดงผลรวมทั้งหมดใน tag span
    $('#total_hours').text(total.toFixed(1));

    // ดึงตัวเลขจาก #result_hours มาเปรียบเทียบ (สิทธิ์ชั่วโมงสูงสุดของวันนั้นๆ)
    let maxHours = parseFloat($('#result_hours').text()) || 0;

    // 🌟 1. เช็คเคสที่ 1: ชั่วโมงรวมของงานประเภท Product ทั้งหมด เกิน 7 ชั่วโมงหรือไม่
    if (totalProductHours > 7) {
        Swal.fire({
            icon: 'error',
            title: 'ชั่วโมงงาน Product เกินกำหนด!',
            text: `ยอดรวมชั่วโมงงานประเภท Product ทั้งหมด คือ ${totalProductHours.toFixed(1)} ชม. (กำหนดให้ลงได้ไม่เกิน 7.0 ชม.)`,
            confirmButtonText: 'ตกลง'
        });

        $('#total_hours').css('color', 'red');
        $('button[type="submit"]').prop('disabled', true); // บล็อกปุ่มบันทึก
    } 
    // 🌟 2. เช็คเคสที่ 2: ชั่วโมงรวมทุกประเภท เกินสิทธิ์สูงสุดของวันนั้นๆ หรือไม่ (เงื่อนไขเดิมของคุณ)
    else if (total > maxHours) {
        Swal.fire({
            icon: 'error',
            title: 'ชั่วโมงรวมเกินกำหนด!',
            text: `จำนวนชั่วโมงรวมทั้งหมด (${total.toFixed(1)} ชม.) เกินกว่าชั่วโมงที่กำหนดไว้ (${maxHours.toFixed(1)} ชม.)`,
            confirmButtonText: 'ตกลง'
        });

        $('#total_hours').css('color', 'red');
        $('button[type="submit"]').prop('disabled', true); // บล็อกปุ่มบันทึก
    } 
    // ถ้าผ่านเงื่อนไขทั้งหมด ปลดบล็อกปุ่มบันทึกตามปกติ
    else {
        $('#total_hours').css('color', '');
        $('button[type="submit"]').prop('disabled', false);
    }
}
</script>
@endpush        