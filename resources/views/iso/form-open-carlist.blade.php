@extends('layouts.main')
@section('content')
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-2">
                        <h3 class="card-title" style="font-weight: bold">เอกสาร CAR</h3>
                    </div>
                    <div class="col-12 col-md-2">
                        <a href="{{route('car-report.create')}}" 
                        class="btn btn-sm btn-success" >
                        <i class="fas fa-file"></i>&nbsp; สร้างเอกสาร
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="tb_job">
                        <thead>
                            <tr>
                                <th>สถานะ</th>
                                <th>วันที่</th>
                                <th>อ้างถึง</th>
                                <th>เลขที่</th>
                                <th>ผู้แก้ปัญหา</th>
                                <th>ข้อบกพร่องที่พบ</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>สถานะ</th>
                                <th>วันที่</th>
                                <th>อ้างถึง</th>
                                <th>เลขที่</th>
                                <th>ผู้แก้ปัญหา</th>
                                <th>ข้อบกพร่องที่พบ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hd as $item)
                                <tr>
                                    <td>{{$item->iso_status_name}}</td>
                                    <td>{{\Carbon\Carbon::parse($item->iso_car_date)->format('d/m/Y')}}</td>
                                    <td>{{$item->iso_car_refertype}}</td>
                                    <td>{{$item->iso_car_docuno}}</td>
                                    <td>{{$item->problem_by}}</td>
                                    <td>{{$item->found_bugs}}</td>
                                    <td>
                                        <a href="{{route('car-report.edit',$item->iso_car_id)}}" 
                                            class="btn btn-sm btn-warning" >
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm"  
                                            onclick="confirmDel('{{ $item->iso_car_docuno }}','{{ $item->iso_car_id }}')">
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
            "pageLength": 20,
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
                [3, "desc"]
            ],
            fixedHeader: {
                header:false,
                footer:false
            },
        pagingType: "full_numbers",
        bSort: true,
            initComplete: function() {
      this.api().columns().every(function() {
        var column = this;
        var select = $('<select class="form-control select2"><option value=""></option></select>')
          .appendTo($(column.header()).empty())
          .on('change', function() {
            var val = $.fn.dataTable.util.escapeRegex(
              $(this).val()
            );

            column
              .search(val ? '^' + val + '$' : '', true, false)
              .draw();
          });

        column.data().unique().sort().each(function(d, j) {
          select.append('<option value="' + d + '">' + d + '</option>')
        });
      });
    }
    
    })
});
confirmDel = (docs,refid) =>{       
Swal.fire({
    title: 'คุณแน่ใจหรือไม่ !',
    text: `คุณต้องการลบรายการ CAR นี้หรือไม่ ?`,
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
            url: `{{ url('/cancelDocsCar') }}`,
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "docuno": docs,
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