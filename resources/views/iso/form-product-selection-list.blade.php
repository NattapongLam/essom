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
                <h5>ESSOM CO.,LTD<br>ใบคัดเลือกสินค้า/ผู้ขายและประเมิน (Drawing control status)</h5><p class="text-right">F8411.1<br>15 Aug. 19</p>
                <p class="text-left">
                    <a href="{{route('product-selection.create')}}">เพิ่มเอกสาร</a>
                </p>              
            </div>
            <div class="card-body">             
                <div class="table-responsive">
                    <table id="tb_job" class="table table-bordered table-sm text-center">
                        <thead>
                            <tr>
                                <td>ประเภทสินค้า</td>
                                <td>ผู้จัดทำ</td>
                                <td>ผู้ทบทวน</td>
                                <td>ผู้อนุมัติ</td>
                                <td>ประเมิน</td>
                                <td>อนุมัติ</td>
                                <td>ลบ</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hd as $item)
                                <tr>
                                    <td>
                                        1. {{$item->product_type1}}
                                        @if ($item->product_type2)
                                        <br>2. {{$item->product_type2}}
                                        @endif
                                        @if ($item->product_type3)
                                        <br>3. {{$item->product_type3}}
                                        @endif
                                        @if ($item->product_type4)
                                        <br>4. {{$item->product_type4}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$item->requested_by}}
                                        <br>
                                        {{$item->requested_date}}
                                    </td>
                                    <td>
                                        {{$item->reviewed_by}}
                                        <br>
                                        {{$item->reviewed_date}}
                                    </td>
                                    <td>
                                        {{$item->approved_by1}}
                                        <br>
                                        {{$item->approved_date1}}
                                    </td>
                                    <td>
                                        <a href="{{route('product-selection.edit',$item->product_selection_hd_id)}}" class="btn btn-sm btn-warning" >
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('product-selection.show',$item->product_selection_hd_id)}}" class="btn btn-sm btn-primary" >
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm"  
                                            onclick="confirmDel('{{ $item->product_selection_hd_id }}')">
                                            <i class="fas fa-trash"></i>
                                        </a> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
$(document).ready(function() {
 $('#tb_job').DataTable({
            "pageLength": 50,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            columnDefs: [{
                targets: 1,
                type: 'time-date-sort'
            }],
            order: [
                [1, "asc"]
            ],
            fixedHeader: {
                header:false,
                footer:false
            },
        pagingType: "full_numbers",
        bSort: true,    
    })
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
            url: `{{ url('/cancelProductSelectionHd') }}`,
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
    