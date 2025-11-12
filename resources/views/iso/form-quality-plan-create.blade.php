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
                <form method="POST" class="form-horizontal" action="{{ route('quality-plan.store') }}" enctype="multipart/form-data">
                @csrf        
                <div class="row mt-3">
                    <div class="col-3">
                        <label for="quality_plan_hd_docno">Doc. No</label>
                        <input class="form-control" name="quality_plan_hd_docno" required>
                    </div> 
                    <div class="col-3">
                        <label for="quality_plan_hd_revno">Rev. No</label>
                        <input class="form-control" name="quality_plan_hd_revno" required>
                    </div>
                    <div class="col-3">
                        <label for="quality_plan_hd_effecdate">Effec Date</label>
                        <input class="form-control" name="quality_plan_hd_effecdate" required>
                    </div>
                    <div class="col-3">
                        <label for="quality_plan_hd_page">Page</label>
                        <input class="form-control" name="quality_plan_hd_page">
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
                            <!-- เริ่มต้นไม่มีแถว หรือคุณจะใส่แถวเริ่มต้น 1 แถวก็ได้ -->
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="requested_by">จัดทำโดย</label>
                        <input class="form-control" name="requested_by" value="{{auth()->user()->name}}" readonly>
                    </div>
                    <div class="col-3">
                        <label for="requested_date">วันที่</label>
                        <input class="form-control" type="date" name="requested_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                    </div>
                </div>   
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="reviewed_by">ทบทวนโดย</label>
                        <select class="form-control receiver-select" name="reviewed_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
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
                                <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
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
</script>
@endpush  
    