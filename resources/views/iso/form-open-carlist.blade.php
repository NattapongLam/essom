@extends('layouts.main')
@section('content')
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
                    <table class="table table-bordered table-hover" id="tb_job">
                        <thead>
                            <tr>
                                <th>วันที่</th>
                                <th>อ้างถึง</th>
                                <th>เลขที่</th>
                                <th>ผู้แก้ปัญหา</th>
                                <th>ข้อบกพร่องที่พบ</th>
                                <th></th>
                            </tr>
                            <tr>
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
                [2, "desc"]
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
</script>
@endpush  