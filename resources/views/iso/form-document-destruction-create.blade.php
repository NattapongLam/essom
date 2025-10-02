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
                <h5>บริษัท เอสซอม จำกัด<br>ใบขอทำลายเอกสาร</h5><p class="text-right">F7530.4<br>1 May. 17</p>              
            </div>
            <div class="card-body">  
                <form method="POST" class="form-horizontal" action="{{ route('document-destruction.store') }}" enctype="multipart/form-data">
                @csrf       
                <div class="row mt-3">
                    <div class="col-4">
                         <label>เรียน</label>
                         <input class="form-control" type="text" name="documentdestruction_hd_to" required>
                    </div>
                    <div class="col-4">
                         <label>จาก</label>
                         <input class="form-control" type="text" name="documentdestruction_hd_from" required>
                    </div>
                    <div class="col-4">
                         <label>วันที่</label>
                         <input class="form-control" type="date" name="documentdestruction_hd_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                    </div>
                </div>
                <br>
                <h6>ขอทำลายเอกสารดังนี้</h6>
                <div class="row mt-3">
                    <div class="mb-2">
                        <button type="button" class="btn btn-sm btn-success" onclick="addRow()">
                            ➕ เพิ่มแถว
                        </button>
                    </div>
                    <table class="table table-bordered table-sm text-center" id="destroyTable">
                        <thead>
                            <tr>
                                <th style="width: 5%">ลำดับ</th>
                                <th style="width: 20%">รหัสเอกสาร</th>
                                <th style="width: 30%">ชื่อเอกสาร</th>
                                <th style="width: 30%">หมายเหตุ</th>
                                <th style="width: 10%">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- เริ่มต้นไม่มีแถว หรือคุณจะใส่แถวเริ่มต้น 1 แถวก็ได้ -->
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-4 text-center">
                        <label>ผู้ขออนุมัติ</label>
                        <input class="form-control" type="text" value="{{auth()->user()->name}}" name="requested_by" readonly><br>
                        <input class="form-control" type="date" value="{{ old('date', now()->format('Y-m-d')) }}" name="requested_date" required>
                    </div>
                    <div class="col-4 text-center">
                        <label>ผู้จัดการฝ่าย</label>
                        <input class="form-control" type="text"><br>
                        <input class="form-control" type="date">
                    </div>
                    <div class="col-4 text-center">
                        <label>ผู้อนุมัติ</label>
                        <input class="form-control" type="text"><br>
                        <input class="form-control" type="date">
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
        <td class="text-center">
            <span class="row-number">${rowCount}</span>
            <input type="hidden" name="documentdestruction_dt_listno[]" value="${rowCount}">
        </td>
        <td>
            <input type="text" name="documentdestruction_dt_code[]" class="form-control" placeholder="กรอกรหัสเอกสาร" required>
        </td>
        <td>
            <input type="text" name="documentdestruction_dt_name[]" class="form-control" placeholder="กรอกชื่อเอกสาร" required>
        </td>
        <td>
            <input type="text" name="documentdestruction_dt_note[]" class="form-control" placeholder="กรอกหมายเหตุ">
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
        row.querySelector('input[name="documentdestruction_dt_listno[]"]').value = number;
    });
}
</script>
@endpush  
    