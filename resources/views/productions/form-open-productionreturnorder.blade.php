@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title" style="font-weight: bold">เอกสารรับคืนจากการเบิก</h3><br><hr>
            <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tb_job">
                <thead>
                    <tr>
                        <th>สถานะ</th>
                        <th>วันที่</th>
                        <th>เลขที่ใบรับคืนจากการเบิก</th>
                        <th>เลขที่ใบเบิกวัสดุอุปกรณ์</th>
                        <th>เลขที่อ้างอิง</th>
                        <th>หมายเหตุ</th>
                        <th>ผู้บันทึก</th>
                        <th>ผู้อนุมัติ</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>สถานะ</th>
                        <th>วันที่</th>
                        <th>เลขที่ใบรับคืนจากการเบิก</th>
                        <th>เลขที่ใบเบิกวัสดุอุปกรณ์</th>
                        <th>เลขที่อ้างอิง</th>
                        <th>หมายเหตุ</th>
                        <th>ผู้บันทึก</th>
                        <th>ผู้อนุมัติ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hd as $item)
                    <tr>
                        <td>{{$item->returnorder_status_name}}</td>
                        <td>{{\Carbon\Carbon::parse($item->returnorder_hd_date)->format('d/m/Y')}}</td>
                        <td>{{$item->returnorder_hd_docuno}}</td>
                        <td>{{$item->ladingorder_hd_docuno}}</td>
                        <td>{{$item->productionopenjob_hd_docuno}}</td>
                        <td>{{$item->returnorder_hd_note}}</td>
                        <td>{{$item->created_person}}</td>
                        <td>{{$item->approved_by}}</td>
                        <td>
                            @if($item->returnorder_status_id == 1)
                            <a href="{{route('pd-retu.edit',$item->returnorder_hd_id)}}" 
                                class="btn btn-sm btn-warning" >
                                <i class="fas fa-edit"></i>
                              </a>                           
                            @else
                            <a href="javascript:void(0)" 
                            class="btn btn-primary btn-sm" 
                            data-toggle="modal" data-target="#modal"
                            onclick="getDataRetu('{{ $item->returnorder_hd_id }}')">
                            <i class="fas fa-eye"></i></a>                                                     
                            @endif  
                            <a href="{{route('pd-retu.edit',$item->returnorder_hd_id)}}" 
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
                            <th>ลำดับ</th>
                            <th>รหัสสินค้า</th>                                  
                            <th>ชื่อสินค้า</th>    
                            <th>หน่วยนับ</th>  
                            <th>จำนวนเบิก</th>   
                            <th>จำนวนคืน</th>                        
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
getDataRetu = (id) => {
$.ajax({
    url: "{{ url('/getData-Retu') }}",
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
                <td>${item.returnorder_dt_listno}</td>  
                <td>${item.ms_product_code}</td>  
                <td>${item.ms_product_name}</td>  
                <td>${item.ms_product_unit}</td>        
                <td>${parseFloat(item.ladingorder_dt_qty).toFixed(2)}</td>  
                <td>${parseFloat(item.returnorder_dt_qty).toFixed(2)}</td> 
            </tr>
        `
        })      
        $('#tb_list').html(el_list);
    }
});
}  
</script>
@endpush             
