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
                <h5>ESSOM CO.,LTD<br>ใบคำขอดำเนินการด้านเอกสาร Documents Action Request</h5><p class="text-right">F7530.3<br>27 Aug 25</p>     
                <p class="text-left">
                    <a href="{{route('document-correction.create')}}">เพิ่มเอกสาร</a>
                </p>              
            </div>
            <div class="card-body">             
                <div class="table-responsive">
                    <table id="tb_job" class="table table-bordered table-sm text-center">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>DAR No.</th>
                                <th>Date</th>
                                <th>Document Name</th>
                                <th>To</th>
                                <th>From</th>
                                <th>Remark</th>
                                <th>Requested By</th>
                                <th></th>
                                <th>แก้ไข</th>
                                <th>อนุมัติ</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>   
                            @foreach ($hd as $item)
                                <tr>
                                    <td>{{$item->documentcorrections_type}}</td>
                                    <td>{{$item->documentcorrections_docuno}}</td>
                                    <td>{{$item->documentcorrections_date}}</td>
                                    <td>{{$item->documentcorrections_name}}</td>
                                    <td>{{$item->documentcorrections_to}}</td>
                                    <td>{{$item->documentcorrections_from}}</td>
                                    <td>{{$item->documentcorrections_note}}</td>
                                    <td>{{$item->requested_by}}</td>
                                    <td>
                                        @if ($item->documentcorrections_file)
                                            <a href="{{asset($item->documentcorrections_file)}}" target=”_blank”>
                                                <i class="fas fa-file"> ไฟล์เดิม</i>
                                            </a><br>
                                        @endif
                                        @if ($item->documentcorrections_file1)
                                            <a href="{{asset($item->documentcorrections_file1)}}" target=”_blank”>
                                                <i class="fas fa-file"> ไฟล์ใหม่</i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- @if ($item->reviewed_by == null) --}}
                                            <a href="{{route('document-correction.edit',$item->documentcorrections_id)}}" class="btn btn-sm btn-warning" >
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        {{-- @endif --}}
                                    </td>
                                    <td>
                                        @if ($item->reviewed_status == "N")
                                            @if ($item->reviewed_by == auth()->user()->name)
                                               <a href="{{route('document-correction.show',$item->documentcorrections_id)}}" class="btn btn-sm btn-primary" >
                                                    <i class="fas fa-edit"></i>
                                                </a>  
                                            @else
                                               <span class="badge-warning">รอทบทวน</span>
                                            @endif
                                        @elseif($item->approved_status == "N")
                                            @if ($item->approved_by == auth()->user()->name)
                                               <a href="{{route('document-correction.show',$item->documentcorrections_id)}}" class="btn btn-sm btn-primary" >
                                                    <i class="fas fa-edit"></i>
                                                </a>  
                                            @else
                                               <span class="badge-warning">รออนุมัติ</span>
                                            @endif
                                        @else
                                         <span class="badge-success">อนุมัติ</span>
                                        @endif
                                       
                                    </td>
                                    <td>
                                        {{-- @if ($item->reviewed_by == null) --}}
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm"  
                                            onclick="confirmDel('{{ $item->documentcorrections_id }}')">
                                            <i class="fas fa-trash"></i></a>
                                        {{-- @endif --}}
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
                [2, "asc"]
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
            url: `{{ url('/cancelCorrection') }}`,
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
    