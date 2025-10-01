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
                <h5>ESSOM CO.,LTD<br>ทะเบียนแจกจ่ายเอกสาร DOCUMENTS DISTRIBUTION STATUS</h5><p class="text-right">F7530.2<br></p>     
                <p class="text-left">
                    <a href="{{route('document-distribution.create')}}" class="btn btn-secondary">ตรวจสอบเอกสาร</a>
                </p>              
            </div>
            <div class="card-body">             
                <div class="table-responsive">
                    <table id="tb_job" class="table table-bordered table-sm text-center">
                        <thead>
                            <tr>
                                <th>Doc.</th>
                                <th>Deseription</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>รับทราบ</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($hd as $item)
                                    <tr>
                                        <td>
                                            <a href="{{asset($item->documentregisters_file)}}" target=”_blank”>
                                            {{$item->documentregisters_docuno}}
                                            </a>
                                        </td>
                                        <td>{{$item->documentregisters_remark}}</td>
                                        <td>{{$item->documentregisters_rev01}}</td>
                                        <td>{{$item->documentregisters_rev02}}</td>
                                        <td>{{$item->documentregisters_rev03}}</td>
                                        <td>{{$item->documentregisters_rev04}}</td>
                                        <td>{{$item->documentregisters_rev05}}</td>
                                        <td>{{$item->documentregisters_rev06}}</td>
                                        <td>{{$item->documentregisters_rev07}}</td>
                                        <td>{{$item->documentregisters_rev08}}</td>
                                        <td>{{$item->documentregisters_rev09}}</td>
                                        <td>{{$item->documentregisters_rev10}}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="confirmDoc('{{ $item->documentdistributions_id }}')">
                                                <i class="fas fa-edit"></i>
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
confirmDoc = (refid) =>{       
Swal.fire({
    title: 'คุณแน่ใจหรือไม่ !',
    text: `คุณต้องการรับทราบการแจกจ่ายเอกสารนี้หรือไม่ ?`,
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
            url: `{{ url('/approvedDistribution') }}`,
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
                        text: 'รับทราบเรียบร้อยแล้ว',
                        icon: 'success'
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'ไม่สำเร็จ',
                        text: 'รับทราบเอกสารไม่สำเร็จ',
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
    