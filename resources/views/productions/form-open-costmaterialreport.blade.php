@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title" style="font-weight: bold">Cost of Material</h3><br><hr>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tb_job">
                    <thead>
                        <tr>
                            <th>สถานะ</th>
                            <th>ปี-เดือน</th>
                            <th>ผู้บันทึก</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>สถานะ</th>
                            <th>ปี-เดือน</th>
                            <th>ผู้บันทึก</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hd as $item)
                            <tr>
                                <td>
                                    @if ($item->costmaterial_report_flag == 1)
                                    <span class="badge badge-success">
                                        สรุปเรียบร้อย
                                    </span>
                                    @else
                                    <span class="badge badge-danger">
                                        ยกเลิก
                                    </span>
                                    @endif
                                </td> 
                                <td>{{$item->costmaterial_report_yearmonth}}</td>   
                                <td>{{$item->created_person}}</td> 
                                <td>
                                    @if($item->reviewed_by == null || $item->acknowledges_by == null)
                                    <a href="{{route('cm-report.edit',$item->costmaterial_report_id)}}" 
                                        class="btn btn-sm btn-warning" >
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @else
                                    <a href="javascript:void(0)" 
                                    class="btn btn-primary btn-sm" 
                                    data-toggle="modal" data-target="#modal"
                                    onclick="getDataCost('{{ $item->costmaterial_report_id }}')">
                                    <i class="fas fa-eye"></i></a>                                
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
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รายละเอียด</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">              
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>Job No.</th>
                            <th>Serial No.</th>
                            <th>Spec Page No</th>
                            <th>Delivery Date</th>                                  
                            <th>Description</th>    
                            <th>Buyer</th>  
                            <th>QTY</th>     
                            <th>Unit</th>      
                            <th>Total</th>                                        
                        </tr>
                        </thead>
                        <tbody id="tb_list">
                        </tbody>
                    </table>
                </div>
                <hr>
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
getDataCost = (id) => {
$.ajax({
    url: "{{ url('/getData-Cost') }}",
    type: "post",
    dataType: "JSON",
    data: {
        refid: id,
        _token: "{{ csrf_token() }}"      
    },    
    success: function(data) {
        console.log(data);
        let el_list = ''; 
        $.each(data.dt, function(key , item) {
            el_list += `    
             <tr>
                <td>${item.costmaterial_reportsub_jobno}</td>  
                <td>${item.costmaterial_reportsub_serialno}</td>  
                <td>${item.costmaterial_reportsub_specpage}</td> 
                <td>${item.delivery_date}</td>  
                <td>${item.costmaterial_reportsub_desp}</td>  
                <td>${item.costmaterial_reportsub_cust}</td>  
                <td>${parseFloat(item.costmaterial_reportsub_qty).toFixed(2)}</td>  
                <td>${parseFloat(item.costmaterial_reportsub_unit).toFixed(2)}</td>  
                <td>${parseFloat(item.costmaterial_reportsub_total).toFixed(2)}</td>                     
            </tr>
        `
        })      
        $('#tb_list').html(el_list);
    }
});
}
</script>
@endpush  