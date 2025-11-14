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
                <h5>ESSOM CO.,LTD<br>การออกแบบซอฟต์แวร์,ทบทวนและทวนสอบ (SOFTWARE DESIGN,REVIEW AND VERIFICATION)</h5><p class="text-right">FS8302.1<br>4 Nov. 24</p>              
            </div>
            <div class="card-body">         
                <form method="POST" class="form-horizontal" action="{{ route('software-design.update',$hd->software_design_hd_id) }}" enctype="multipart/form-data">
                @csrf   
                @method('PUT')        
                <input type="hidden" name="checkdoc" value="Edit">               
                <div class="row mt-3">
                    <div class="col-12">
                        <h5><strong>1.Software Design</strong></h5>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-4">
                        <label for="software_design_hd_no">1.1 Software No.</label>
                        <input class="form-control" name="software_design_hd_no" value="{{$hd->software_design_hd_no}}">
                    </div>
                    <div class="col-8">
                        <label for="software_design_hd_product">Product Name</label>
                        <input class="form-control" name="software_design_hd_product" value="{{$hd->software_design_hd_product}}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label for="software_design_hd_reference">1.2 Reference Documents</label>
                        <input class="form-control" name="software_design_hd_reference" value="{{$hd->software_design_hd_reference}}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label for="approved_by2">1.3 Input Data</label>
                        <textarea class="form-control" name="software_design_hd_input">{{$hd->software_design_hd_input}}</textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label for="approved_by2">1.4 Output Display & Control</label>
                        <textarea class="form-control" name="software_design_hd_output">{{$hd->software_design_hd_output}}</textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label for="approved_by2">1.5 Layout Features and Man-hours</label>
                        <textarea class="form-control" name="software_design_hd_layout">{{$hd->software_design_hd_layout}}</textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="prepared_by1">Prepared by</label>
                        <input class="form-control" name="prepared_by1" value="{{$hd->prepared_by1}}" readonly>
                    </div>
                    <div class="col-3">
                        <label for="prepared_date1">Date</label>
                        <input class="form-control" type="date" name="prepared_date1" value="{{ $hd->prepared_date1 }}" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="reviewed_by1">Reviewed by</label>
                        <select class="form-control receiver-select" name="reviewed_by1">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ isset($hd->reviewed_by1) &&  $hd->reviewed_by1 == $item->ms_employee_fullname ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                        {{-- <input class="form-control" name="reviewed_by1" readonly> --}}
                    </div>
                    <div class="col-3">
                        <label for="reviewed_date1">Date</label>
                        <input class="form-control" type="date" name="reviewed_date1" readonly>
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
                                <th style="width: 50%">Calculation</th>
                                <th style="width: 10%">By hand</th>
                                <th style="width: 10%">Display</th>
                                <th style="width: 10%">% Error</th>
                                <th style="width: 3%">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dt as $item)
                                <tr>
                                    <td>
                                        <input class="form-control" name="software_design_dt_calculation[]" value="{{$item->software_design_dt_calculation}}">
                                        <input type="hidden" name="software_design_dt_id[]" value="{{$item->software_design_dt_id}}">
                                    </td>
                                    <td>
                                        <input class="form-control" name="software_design_dt_byhand[]" value="{{$item->software_design_dt_byhand}}">
                                    </td>
                                    <td>
                                        <input class="form-control" name="software_design_dt_display[]" value="{{$item->software_design_dt_display}}">
                                    </td>
                                    <td>
                                        <input class="form-control" name="software_design_dt_error[]" value="{{$item->software_design_dt_error}}">
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm"  
                                            onclick="confirmDel('{{ $item->software_design_dt_id }}')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>
                 <div class="row mt-3">
                    <div class="col-12">
                        <label for="approved_by2">Comment</label>
                        <textarea class="form-control" name="software_design_hd_comment">{{$hd->software_design_hd_comment}}</textarea>
                    </div>
                </div>
                   <div class="row mt-3">
                    <div class="col-9">
                        <label for="prepared_by2">Prepared by</label>
                        <input class="form-control" name="prepared_by2" value="{{$hd->prepared_by2}}" readonly>
                    </div>
                    <div class="col-3">
                        <label for="prepared_date2">Date</label>
                        <input class="form-control" type="date" name="prepared_date2" value="{{ $hd->prepared_date2 }}" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="reviewed_by2">Reviewed by</label>
                        <select class="form-control receiver-select" name="reviewed_by2">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ isset($hd->reviewed_by2) &&  $hd->reviewed_by2 == $item->ms_employee_fullname ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                        {{-- <input class="form-control" name="reviewed_by2" readonly> --}}
                    </div>
                    <div class="col-3">
                        <label for="reviewed_date2">Date</label>
                        <input class="form-control" type="date" name="reviewed_date2" readonly>
                    </div>
                </div> 
                 <div class="row mt-3">
                    <div class="col-9">
                        <label for="initialapproval_by">Initial Approval by</label>
                        <select class="form-control receiver-select" name="initialapproval_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ isset($hd->initialapproval_by) &&  $hd->initialapproval_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                        {{-- <input class="form-control" name="initialapproval_by" readonly> --}}
                    </div>
                    <div class="col-3">
                        <label for="initialapproval_date">Date</label>
                        <input class="form-control" type="date" name="initialapproval_date" readonly>
                    </div>
                </div> 
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="finalapproval_by">Final Approval</label>
                        <select class="form-control receiver-select" name="finalapproval_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ isset($hd->finalapproval_by) &&  $hd->finalapproval_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                        {{-- <input class="form-control" name="finalapproval_by" readonly> --}}
                    </div>
                    <div class="col-3">
                        <label for="finalapproval_date">Date</label>
                        <input class="form-control" type="date" name="finalapproval_date" readonly>
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
// ✅ ฟังก์ชันเพิ่มแถว
function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td>
             <input type="hidden" name="listno[]" value="${rowCount}">
            <input type="text" class="form-control" placeholder="Calculation" name="software_design_dt_calculation[]">
        </td>
        <td>
            <input type="text"  class="form-control" placeholder="By hand" name=software_design_dt_byhand[]">
        </td>
        <td>
            <input type="text" class="form-control" placeholder="Display" name="software_design_dt_display[]">
        </td>
        <td>
            <input type="text" class="form-control" placeholder="% Error" name="software_design_dt_error[]">
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
        row.querySelector('input[name="listno[]"]').value = number;
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
            url: `{{ url('/cancelSoftwareDesignDt') }}`,
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
    