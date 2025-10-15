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
                <h5>ESSOM CO.,LTD<br>ทะเบียนควบคุมแบบผลิต (Drawing control status)</h5><p class="text-right">F8300.7<br>19 Jan. 22</p>              
            </div>
            <div class="card-body">  
                <form method="POST" class="form-horizontal" action="{{ route('product-registration.update',$hd->product_registration_hd_id) }}" enctype="multipart/form-data">
                @csrf       
                @method('PUT')      
                <div class="row mt-3">
                        <div class="col-12">
                            <label for="documentregisters_listno">Product Name</label>
                            <input type="text" class="form-control" name="product_registration_hd_name" value="{{$hd->product_registration_hd_name}}">
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
                                <th style="width: 8%">ลำดับที่</th>
                                <th style="width: 15%">Dwg No.</th>
                                <th style="width: 25%">Description</th>
                                <th style="width: 8%">Rev.00</th>
                                <th style="width: 8%">Rev.01</th>
                                <th style="width: 8%">Rev.02</th>
                                <th style="width: 8%">Rev.03</th>
                                <th style="width: 8%">Rev.04</th>
                                <th style="width: 3%">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($dt as $item)
                               <tr>
                                    <td>
                                        {{$item->product_registration_dt_listno}}
                                        <input type="hidden" name="product_registration_dt_id[]" value="{{$item->product_registration_dt_id}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="product_registration_dt_dwgno[]" value="{{$item->product_registration_dt_dwgno}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="product_registration_dt_description[]" value="{{$item->product_registration_dt_description}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="product_registration_dt_rev00[]" value="{{$item->product_registration_dt_rev00}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="product_registration_dt_rev01[]" value="{{$item->product_registration_dt_rev01}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="product_registration_dt_rev02[]" value="{{$item->product_registration_dt_rev02}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="product_registration_dt_rev03[]" value="{{$item->product_registration_dt_rev03}}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="product_registration_dt_rev04[]" value="{{$item->product_registration_dt_rev04}}">
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm"  
                                            onclick="confirmDel('{{ $item->product_registration_dt_id }}')">
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
// ✅ ฟังก์ชันเพิ่มแถว
function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td>
            ${rowCount}
            <input type="hidden" name="product_registration_dt_listno[]" value="${rowCount}">            
        </td>
        <td>
            <input type="text"  class="form-control" placeholder="Dwg No." name="product_registration_dt_dwgno[]">
        </td>
        <td>
            <textarea type="text" class="form-control" placeholder="Description" name="product_registration_dt_description[]"></textarea>
        </td>
        <td>
            <input type="text" class="form-control" placeholder="Rev.00" name="product_registration_dt_rev00[]">
        </td>
        <td>
            <input type="text" class="form-control" placeholder="Rev.01" name="product_registration_dt_rev01[]">
        </td>
        <td>
            <input type="text" class="form-control" placeholder="Rev.02" name="product_registration_dt_rev02[]">
        </td>
        <td>
            <input type="text" class="form-control" placeholder="Rev.03" name="product_registration_dt_rev03[]">
        </td>
        <td>
            <input type="text" class="form-control" placeholder="Rev.04" name="product_registration_dt_rev04[]">
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
        row.querySelector('input[name="product_registration_dt_listno[]"]').value = number;
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
            url: `{{ url('/cancelRegistrationDt') }}`,
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
    