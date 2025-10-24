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
                <h5>บริษัท เอสซอม จำกัด<br>ทะเบียนเอกสารอ้างอิง</h5><p class="text-right">F7531.2<br>9 Jun. 16</p>
                <p class="text-left">
                    <a href="{{route('document-reference.create')}}">เพิ่มเอกสาร</a>
                </p>              
            </div>
            <div class="card-body">             
                <div class="table-responsive">
                    <table id="tb_job" class="table table-bordered table-sm text-center">
                        <thead>     
                            <tr>
                                <th>ลำดับที่</th>
                                <th>วันที่รับเอกสาร</th>
                                <th>หน่วยงานที่ออกเอกสาร</th>
                                <th>ชื่อเอกสาร</th>
                                <th>รหัสเอกสาร</th>
                                <th>วันที่เอกสาร</th>
                                <th>ไฟล์แนบ</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                            </tr>                    
                        </thead>
                        <tbody>  
                            @foreach ($hd as $item)
                                <tr>
                                    <td>{{$item->documentreferences_listno}}</td>
                                    <td>{{$item->documentreferences_receivedate}}</td>
                                    <td>{{$item->documentreferences_department}}</td>
                                    <td>{{$item->documentreferences_name}}</td>
                                    <td>{{$item->documentreferences_code}}</td>
                                    <td>{{$item->documentreferences_date}}</td>
                                    <td>
                                        @if ($item->documentreferences_file)
                                            <a href="{{asset($item->documentreferences_file)}}" target=”_blank”>
                                                <i class="fas fa-file"></i>
                                            </a>
                                        @endif  
                                    </td>
                                    <td>
                                        <a href="{{route('document-reference.edit',$item->documentreferences_id)}}" class="btn btn-sm btn-warning" >
                                                <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm"  
                                            onclick="confirmDel('{{ $item->documentreferences_id }}')">
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
            url: `{{ url('/cancelReference') }}`,
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