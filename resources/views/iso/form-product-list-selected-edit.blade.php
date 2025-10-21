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
                <form method="POST" class="form-horizontal" action="{{ route('product-list-selected.update',$hd->product_list_selected_hd_id) }}" enctype="multipart/form-data">
                @csrf      
                @method('PUT')           
                <div class="row mt-3">
                    <div class="col-12">
                        <label for="documentregisters_flag">PRODUCT GROUP</label>
                        <input class="form-control" name="product_list_selected_hd_product" value="{{$hd->product_list_selected_hd_product}}">
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
                           @foreach ($dt as $item)
                            <tr>
                                <td>
                                    {{$item->product_list_selected_dt_listno}}
                                    <input type="hidden" name="product_list_selected_dt_id[]" value="{{$item->product_list_selected_dt_id}}">
                                </td>
                                <td>
                                    
                                    <textarea class="form-control" name="product_list_selected_dt_vendor[]">{{$item->product_list_selected_dt_vendor}}</textarea>
                                </td>
                                <td>
                                    <textarea class="form-control" name="product_list_selected_dt_product[]"> {{$item->product_list_selected_dt_product}}</textarea>
                                   
                                </td>
                                <td>
                                    <select class="form-control"  name="product_list_selected_dt_results1[]">
                                        @if ($item->product_list_selected_dt_results1)
                                            <option value="1">/</option>
                                            <option value="0"></option>                                            
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif                                     
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_list_selected_dt_results2[]">
                                        @if ($item->product_list_selected_dt_results2)
                                            <option value="1">/</option>
                                            <option value="0"></option>                                            
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif       
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_list_selected_dt_results3[]">
                                        @if ($item->product_list_selected_dt_results3)
                                            <option value="1">/</option>
                                            <option value="0"></option>                                            
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif       
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_list_selected_dt_results4[]">
                                        @if ($item->product_list_selected_dt_results4)
                                            <option value="1">/</option>
                                            <option value="0"></option>                                            
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif       
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_list_selected_dt_results5[]">
                                        @if ($item->product_list_selected_dt_results5)
                                            <option value="1">/</option>
                                            <option value="0"></option>                                            
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif       
                                    </select>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm"  
                                        onclick="confirmDel('{{ $item->product_list_selected_hd_id }}')">
                                        <i class="fas fa-trash"></i>
                                    </a> 
                                </td>
                            </tr>
                           @endforeach
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
            url: `{{ url('/cancelProductListSelectedDt') }}`,
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
    