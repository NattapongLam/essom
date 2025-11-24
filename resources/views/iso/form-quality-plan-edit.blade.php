@extends('layouts.main')
@section('content')
{{-- @push('styles') --}}
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
                <h5>ESSOM CO.,LTD<br>แผนคุณภาพเฉพาะผลิตภัณฑ์ (Quality Plan)</h5><p class="text-right">F8510.1<br>4 Nov. 24</p>              
            </div>
            <div class="card-body">  
                <form method="POST" class="form-horizontal" action="{{ route('quality-plan.update',$hd->quality_plan_hd_id) }}" enctype="multipart/form-data">
                @csrf     
                @method('PUT')     
                <input type="hidden" name="checkdoc" value="Edit">   
                <div class="row mt-3">
                    <div class="col-3">
                        <label for="quality_plan_hd_docno">Doc. No</label>
                        <input class="form-control" name="quality_plan_hd_docno" value="{{$hd->quality_plan_hd_docno}}" required>
                    </div> 
                    <div class="col-3">
                        <label for="quality_plan_hd_revno">Rev. No</label>
                        <input class="form-control" name="quality_plan_hd_revno" value="{{$hd->quality_plan_hd_revno}}" required>
                    </div>
                    <div class="col-3">
                        <label for="quality_plan_hd_effecdate">Effec Date</label>
                        <input class="form-control" name="quality_plan_hd_effecdate" value="{{$hd->quality_plan_hd_effecdate}}" required>
                    </div>
                    <div class="col-3">
                        <label for="quality_plan_hd_page">Page</label>
                        <input class="form-control" name="quality_plan_hd_page" value="{{$hd->quality_plan_hd_page}}" >
                    </div>      
                </div>
                  <div class="row mt-3">
                    <div class="col-6">
                        <label for="quality_plan_hd_file">ไฟล์แนบ(หากมี)</label>
                        <input type="file" class="form-control-file" name="quality_plan_hd_file" >
                        @if ($hd->quality_plan_hd_file)
                             <a href="{{asset($hd->quality_plan_hd_file)}}" target=”_blank”>
                                <i class="fas fa-file"></i>
                            </a>
                        @endif
                    </div> 
                    <div class="col-6">
                        <label for="quality_plan_hd_link">Link(หากมี)</label>
                        <input type="text" class="form-control" name="quality_plan_hd_link" value="{{$hd->quality_plan_hd_link}}">
                    </div> 
                </div>
                <div class="row mt-3">
                    <div class="mb-2">
                        <button type="button" class="btn btn-sm btn-success" onclick="addRow()">
                            ➕ เพิ่มแถว
                        </button>
                    </div>
                    <table class="table table-bordered table-sm text-center" id="destroyTable">
                        <thead>
                            <tr>
                                <th style="width: 10%">ลำดับที่<br>No.</th>
                                <th style="width: 30%">รายละเอียด<br>Description</th>
                                <th style="width: 20%">เครื่องมือ เครื่องวัด<br>Tools</th>
                                <th style="width: 15%">ผู้ปฏิบัติ<br>By</th>
                                <th style="width: 15%">อ้างอิง<br>Reference</th>
                                <th style="width: 5%">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($dt as $item)
                               <tr>
                                    <td>
                                        {{$item->quality_plan_dt_listno}}
                                        <input type="hidden" name="quality_plan_dt_id[]" value="{{$item->quality_plan_dt_id}}">
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="quality_plan_dt_description[]">{{$item->quality_plan_dt_description}}</textarea>
                                    </td>
                                    <td>
                                        <input class="form-control" name="quality_plan_dt_tool[]" value="{{$item->quality_plan_dt_tool}}">
                                    </td>
                                    <td>
                                        <input class="form-control" name="quality_plan_dt_by[]" value="{{$item->quality_plan_dt_by}}">
                                    </td>
                                    <td>
                                        <input class="form-control" name="quality_plan_dt_reference[]" value="{{$item->quality_plan_dt_reference}}">
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm"  
                                            onclick="confirmDel('{{ $item->quality_plan_dt_id }}')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                               </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="requested_by">จัดทำโดย</label>
                        <input class="form-control" name="requested_by" value="{{$hd->requested_by}}" readonly>
                    </div>
                    <div class="col-3">
                        <label for="requested_date">วันที่</label>
                        <input class="form-control" type="date" name="requested_date" value="{{$hd->requested_date }}" required>
                    </div>
                </div>   
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="reviewed_by">ทบทวนโดย</label>
                         <select class="form-control receiver-select" name="reviewed_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ isset($hd->reviewed_by) &&  $hd->reviewed_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                        {{-- <input class="form-control" name="reviewed_by" readonly> --}}
                    </div>
                    <div class="col-3">
                        <label for="reviewed_date">วันที่</label>
                        <input class="form-control" type="date" name="reviewed_date" readonly>
                    </div>
                </div> 
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="approved_by">อนุมัติโดย</label>
                         <select class="form-control receiver-select" name="approved_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ isset($hd->approved_by) &&  $hd->approved_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                        {{-- <input class="form-control" name="approved_by" readonly> --}}
                    </div>
                    <div class="col-3">
                        <label for="approved_date">วันที่</label>
                        <input class="form-control" type="date" name="approved_date" readonly>
                    </div>
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
<script>
$(document).ready(function () {
    // init select2 ให้กับ select ที่โหลดมาตั้งแต่แรก
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });
});
// ✅ ฟังก์ชันเพิ่มแถว
function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td>
            ${rowCount}
            <input type="hidden" name="quality_plan_dt_listno[]" value="${rowCount}">            
        </td>
        <td>
            <textarea type="text" class="form-control" placeholder="รายละเอียด" name="quality_plan_dt_description[]"></textarea>
        </td>
        <td>
            <input type="text" class="form-control" placeholder="เครื่องมือ เครื่องวัด" name="quality_plan_dt_tool[]">
        </td>
        <td>
            <input type="text" class="form-control" placeholder="ผู้ปฏิบัติ" name="quality_plan_dt_by[]">
        </td>
        <td>
            <input type="text" class="form-control" placeholder="อ้างอิง" name="quality_plan_dt_reference[]">
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">ลบ</button>
        </td>
    `;

    tableBody.appendChild(row);
    updateRowNumbers(); // รีเลขลำดับ
}

// ✅ ฟังก์ชันลบแถว
function removeRow(button) {
    const row = button.closest("tr");
    row.remove();
    updateRowNumbers(); // รีเลขลำดับใหม่หลังลบ
}

function updateRowNumbers() {
    document.querySelectorAll("#destroyTable tbody tr").forEach((row, index) => {
        const number = index + 1;
        row.querySelector(".row-number").textContent = number;
        row.querySelector('input[name="quality_plan_dt_listno[]"]').value = number;
    });
}
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
            url: `{{ url('/cancelQualityplanDt') }}`,
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
    