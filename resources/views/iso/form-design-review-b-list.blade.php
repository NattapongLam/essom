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
                <h5>ESSOM CO.,LTD<br>การทบทวนการออกแบบ<br>DESIGN VERIFCATION</h5><p class="text-right">F8300.2B<br>19 Jan. 22</p>
                <p class="text-left">
                    <a href="{{route('design-review-b.create')}}">เพิ่มเอกสาร</a>
                </p>              
            </div>
            <div class="card-body">             
                <div class="table-responsive">
                    <table id="tb_job" class="table table-bordered table-sm text-center">
                        <thead>      
                            <tr>
                                <th>Product</th>  
                                <th>Model</th>  
                                <th>Participants</th>  
                                <th>Subject</th>  
                                <th>Design Input</th> 
                                <th>Design Output</th> 
                                <th>Reported By</th>  
                                <th>แก้ไข</th>
                                <th>อนุมัติ</th>
                                <th>ลบ</th>
                            </tr>                                      
                        </thead>
                        <tbody>  
                            @foreach ($hd as $item)
                                <tr>
                                    <td>{{$item->design_review_a_hd_product}}</td>
                                    <td>{{$item->design_review_a_hd_model}}</td>
                                    <td>{{$item->design_review_a_hd_participants}}</td>
                                    <td>{{$item->design_review_a_hd_subject}}</td>  
                                    <td>{{$item->design_review_b_input}}</td> 
                                    <td>{{$item->design_review_b_output}}</td> 
                                    <td>{{$item->reported_by}}</td>
                                    <td>
                                        @if ($item->engineecing_by == null)
                                            <a href="{{route('design-review-b.edit',$item->design_review_b_id)}}" class="btn btn-sm btn-warning" >
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif                                       
                                    </td>
                                    <td>
                                        <a href="{{route('design-review-b.show',$item->design_review_b_id)}}" class="btn btn-sm btn-primary" >
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @if ($item->engineecing_by == null)
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm"  
                                                onclick="confirmDel('{{ $item->design_review_b_id }}')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endif  
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
            url: `{{ url('/cancelReviewAHd') }}`,
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