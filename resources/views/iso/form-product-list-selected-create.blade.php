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
                <h5>ESSOM CO.,LTD<br>บัญชีรายชื่อสินค้าและผู้ขายที่ได้รับการยอมรับแล้ว (APPROVED SUPPLIERLIST)</h5><p class="text-right">F8411.3<br>10 Jul. 20</p>              
            </div>
            <div class="card-body">      
                <form method="POST" class="form-horizontal" action="{{ route('product-list-selected.store') }}" enctype="multipart/form-data">
                @csrf            
                <div class="row mt-3">
                    <div class="col-12">
                        <label for="documentregisters_flag">PRODUCT GROUP</label>
                        <input class="form-control" name="product_list_selected_hd_product">
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
                                <th rowspan="2" style="width: 3%">No.</th>
                                <th rowspan="2" style="width: 20%">COMPAMY INFORMATION</th>
                                <th rowspan="2" style="width: 20%">PRODUCTLIST</th>
                                <th colspan="5" style="width: 20%">ASSESSMENT YEAR</th>
                                <th rowspan="2" style="width: 3%">ลบ</th>
                            </tr>
                            <tr id="yearRow"></tr>
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
    const yearRow = document.getElementById("yearRow");
    const currentYear = new Date().getFullYear();
    const startYear = currentYear - 4; // ย้อนหลัง 4 ปี (รวมปีปัจจุบัน = 5 ปี)

    for (let y = startYear; y <= currentYear; y++) {
        const td = document.createElement("td");
        td.textContent = y;
        yearRow.appendChild(td);
    }
// ✅ ฟังก์ชันเพิ่มแถว
function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td>
            ${rowCount}
            <input type="hidden" name="product_list_selected_dt_listno[]" value="${rowCount}">            
        </td>
        <td>
            <textarea type="text"  class="form-control" placeholder="ผู้ขาย" name="product_list_selected_dt_vendor[]"></textarea>
        </td>
        <td>
            <textarea type="text"  class="form-control" placeholder="สินค้า" name="product_list_selected_dt_product[]"></textarea>
        </td>
        <td>
            <select class="form-control"  name="product_list_selected_dt_results1[]">
                <option value="0"></option>
                <option value="1">/</option>
            </select>
        </td>
        <td>
            <select class="form-control"  name="product_list_selected_dt_results2[]">
                <option value="0"></option>
                <option value="1">/</option>
            </select>
        </td>
        <td>
            <select class="form-control"  name="product_list_selected_dt_results3[]">
                <option value="0"></option>
                <option value="1">/</option>
            </select>
        </td>
        <td>
            <select class="form-control"  name="product_list_selected_dt_results4[]">
                <option value="0"></option>
                <option value="1">/</option>
            </select>
        </td>
        <td>
            <select class="form-control"  name="product_list_selected_dt_results5[]">
                <option value="0"></option>
                <option value="1">/</option>
            </select>
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
        row.querySelector('input[name="product_list_selected_dt_listno[]"]').value = number;
    });
}
</script>
@endpush  
    