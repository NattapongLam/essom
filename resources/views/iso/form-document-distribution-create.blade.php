@extends('layouts.main')
@section('content')
{{-- @push('styles') --}}
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
{{-- @endpush --}}
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
                <h5>ESSOM CO.,LTD<br>ทะเบียนแจกจ่ายเอกสาร DOCUMENTS DISTRIBUTION STATUS</h5><p class="text-right">F7530.2<br></p>              
            </div>
            <div class="card-body">  
                <form method="POST" class="form-horizontal" action="{{ route('document-distribution.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <label for="documentregisters_docuno">Document No</label>
                        <input class="form-control" name="documentregisters_docuno" value="{{$hd->documentregisters_docuno}}">
                        <input type="hidden" name="documentregisters_id" value="{{$hd->documentregisters_id}}">
                    </div>
                    <div class="col-6">
                        <label for="documentregisters_remark">Deseription</label>
                        <input class="form-control" name="documentregisters_remark" value="{{$hd->documentregisters_remark}}">
                    </div>
                </div>
                <br>
                <div class="row">
                <div class="col-12 mb-2">
                    <button type="button" class="btn btn-success btn-sm" onclick="addRow()">+ เพิ่มแถว</button>
                </div>
                <table class="table table-bordered table-sm" id="receiverTable">
                    <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">No.</th>
                        <th>Department</th>
                        <th>Receiver</th>
                        <th>Position</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th style="width: 70px;">จัดการ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($list as $item)
                                <tr>
                                    <td>{{$item->documentdistributions_listno}}</td>
                                    <td>{{$item->ms_employee_code}}/{{$item->ms_employee_fullname}}</td>
                                    <td>{{$item->ms_job_name}}</td>
                                    <td>{{$item->documentdistributions_type}}</td>
                                    <td>{{$item->documentdistributions_date}}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm"  
                                        onclick="confirmDel('{{ $item->documentdistributions_id }}')">
                                        <i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                    @endforeach
                    <!-- แถวตัวอย่างเริ่มต้น -->
                    @php $rowCount = count($list) + 1; @endphp
                    <tr>
                        <td>
                            {{ $rowCount }}
                            <input type="hidden" value="{{ $rowCount }}" name="documentdistributions_listno[]">
                        </td>
                        <td>
                            <select class="form-control" name="ms_department_name[]">
                                <option value="">กรุณาเลือก</option>
                                @foreach ($dep as $item)
                                    <option value="{{$item->ms_department_name}}">{{$item->ms_department_name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control receiver-select" name="ms_employee_id[]">
                                <option value="">กรุณาเลือก</option>
                                @foreach ($emp as $item)
                                    <option value="{{$item->ms_employee_id}}" data-job="{{ $item->ms_job_name }}">
                                        {{$item->ms_employee_code}}/{{$item->ms_employee_fullname}} ({{$item->ms_job_name}})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm position-input" placeholder="ตำแหน่ง" readonly>
                        </td>
                        <td>
                            <select class="form-control form-control-sm" name="documentdistributions_type[]">
                                <option value="Receive">Receive</option>
                                <option value="Return">Return</option>
                            </select>
                        </td>
                        <td><input type="date" class="form-control form-control-sm" name="documentdistributions_date[]"></td>
                        <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">ลบ</button></td>
                    </tr>
                    </tbody>
                </table>
                </div>
                <br>
                <div class="col-12 col-md-1">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            บันทึก
                         </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  function addRow() {
    const table = document.getElementById("receiverTable").getElementsByTagName("tbody")[0];
    const rowCount = table.rows.length;
    const row = table.insertRow();

    // สร้าง cell แต่ละช่อง
    row.innerHTML = `
      <td
      ${rowCount + 1}
    <input type="hidden" value="${rowCount + 1}" name="documentdistributions_listno[]">
      </td>
        <td>
                            <select class="form-control" name="ms_department_name[]">
                                <option value="">กรุณาเลือก</option>
                                @foreach ($dep as $item)
                                    <option value="{{$item->ms_department_name}}">{{$item->ms_department_name}}</option>
                                @endforeach
                            </select>
                        </td>
      <td>
                            <select class="form-control receiver-select" name="ms_employee_id[]">
                                <option value="">กรุณาเลือก</option>
                                @foreach ($emp as $item)
                                    <option value="{{$item->ms_employee_id}}" data-job="{{ $item->ms_job_name }}">
                                        {{$item->ms_employee_code}}/{{$item->ms_employee_fullname}} ({{$item->ms_job_name}})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm position-input" placeholder="ตำแหน่ง" readonly>
                        </td>
      <td>
        <select class="form-control form-control-sm" name="documentdistributions_type[]">
            <option value="Receive">Receive</option>
            <option value="Return">Return</option>
        </select>
      </td>
      <td><input type="date" class="form-control form-control-sm" name="documentdistributions_date[]"></td>
      <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">ลบ</button></td>
    `;
    updateRowNumbers();
    $(row).find('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });
  }

  function deleteRow(btn) {
    const row = btn.closest("tr");
    row.remove();
    updateRowNumbers();
  }

  function updateRowNumbers() {
    const table = document.getElementById("receiverTable").getElementsByTagName("tbody")[0];
    [...table.rows].forEach((row, index) => {
      row.cells[0].innerText = index + 1;
    });
  }
$(document).ready(function () {
    // init select2 ให้กับ select ที่โหลดมาตั้งแต่แรก
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });

    // ดัก event ตอนเลือกแล้วเติมตำแหน่ง
    $(document).on('select2:select', '.receiver-select', function (e) {
        const jobName = $(this).find(':selected').data('job');
        $(this).closest('tr').find('.position-input').val(jobName);
    });

    // ถ้าล้างค่าให้ล้างตำแหน่งด้วย
    $(document).on('select2:clear', '.receiver-select', function (e) {
        $(this).closest('tr').find('.position-input').val('');
    });
});
confirmDel = (refid) =>{       
Swal.fire({
    title: 'คุณแน่ใจหรือไม่ !',
    text: `คุณต้องการลบรายการนี้หรือไม่ ?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'ยืนยัน',
    cancelButtonText: 'ยกเลิก',
    confirmButtonClass: 'btn btn-success mt-2',
    cancelButtonClass: 'btn btn-danger ms-2 mt-2',
    buttonsStyling: false
}).then(function(result) {
    if (result.value) {

        $.ajax({
            url: `{{ url('/cancelDistribution') }}`,
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "refid": refid
            },
            dataType: "json",
            success: function(data) {

                console.log(data);


                if (data.status == true) {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'ยกเลิกเอกสารเรียบร้อยแล้ว',
                        icon: 'success'
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'ไม่สำเร็จ',
                        text: 'ยกเลิกเอกสารไม่สำเร็จ',
                        icon: 'error'
                    });
                }
               
            }
        });

    } else if ( // Read more about handling dismissals
        result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
            title: 'ยกเลิก',
            text: 'โปรดตรวจสอบข้อมูลอีกครั้งเพื่อความถูกต้อง :)',
            icon: 'error'
        });
    }
});

}
</script>
@endpush  
    