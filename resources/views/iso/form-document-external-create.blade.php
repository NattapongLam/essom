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
                <h5>ทะเบียนรับเข้าเอกสารจากภายนอก</h5><p class="text-right">F7531.1<br>27 Sep. 23</p>              
            </div>
            <div class="card-body">   
                <form method="POST" class="form-horizontal" action="{{ route('document-external.store') }}" enctype="multipart/form-data">
                @csrf       
                <div class="row mt-3">
                    <div class="col-12">
                        <label>ปี</label>
                        <select class="form-control" name="ms_year_name">
                         <option value="">กรุณาเลือก</option>       
                           @foreach ($hd as $item)
                              <option value="{{$item->ms_year_name}}">{{$item->ms_year_name}}</option> 
                           @endforeach 
                        </select>
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
                                <th style="width: 8%">รับเอกสาร</th>
                                <th style="width: 8%">ส่งจาก</th>
                                <th style="width: 8%">แผนก/ถึง</th>
                                <th style="width: 20%">เรื่อง</th>
                                <th style="width: 8%">วิธีการส่ง</th>
                                <th style="width: 8%">จน.แผ่น</th>
                                <th style="width: 8%">ชุดเอกสาร</th>
                                <th style="width: 20%">ผู้รับ/หมายเหตุ</th>
                                <th style="width: 3%">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- เริ่มต้นไม่มีแถว หรือคุณจะใส่แถวเริ่มต้น 1 แถวก็ได้ -->
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
<script>
// ✅ ฟังก์ชันเพิ่มแถว
function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td>
             <input type="hidden" name="listno[]" value="${rowCount}">
            <input type="text" class="form-control" placeholder="รับเอกสาร" name="documentdestruction_dt_receive[]">
        </td>
        <td>
            <input type="text"  class="form-control" placeholder="ส่งจาก" name="documentdestruction_dt_sentfrom[]">
        </td>
        <td>
            <input type="text" class="form-control" placeholder="แผนก/ถึง" name="documentdestruction_dt_department[]">
        </td>
        <td>
            <textarea type="text" class="form-control" placeholder="เรื่อง" name="documentdestruction_dt_subject[]"></textarea>
        </td>
        <td>
            <input type="text" class="form-control" placeholder="วิธีการส่ง" name="documentdestruction_dt_howtosend[]">
        </td>
        <td>
            <input type="text" class="form-control" placeholder="จน.แผ่น" name="documentdestruction_dt_until[]">
        </td>
        <td>
            <input type="text" class="form-control" placeholder="ชุดเอกสาร" name="documentdestruction_dt_set[]">
        </td>
        <td>
            <textarea type="text" class="form-control" placeholder="ผู้รับ/หมายเหตุ" name="documentdestruction_dt_recipient[]"></textarea>
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
</script>
@endpush  