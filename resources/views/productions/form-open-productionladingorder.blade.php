@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title" style="font-weight: bold">เอกสารใบเบิกวัสดุอุปกรณ์</h3>&nbsp;
            <a href="{{route('pd-ladi.create')}}" 
                class="btn btn-sm btn-success" >
                <i class="fas fa-file"></i>
            </a>
            <br><hr>
            <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tb_job">
                <thead>
                    <tr>
                        <td>สถานะ</td>
                        <td>วันที่</td>
                        <td>เลขที่ใบเบิก</td>
                        <td>เลขที่อ้างอิง</td>
                        <td>แผนก</td>
                        <td>ผู้เบิก</td>
                        <td>หมายเหตุ</td>
                        <td>ผู้อนุมัติ</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>สถานะ</td>
                        <td>วันที่</td>
                        <td>เลขที่ใบเบิก</td>
                        <td>เลขที่อ้างอิง</td>
                        <td>แผนก</td>
                        <td>ผู้เบิก</td>
                        <td>หมายเหตุ</td>
                        <td>ผู้อนุมัติ</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hd as $item)
                        <tr>
                            <td>{{$item->ladingorder_status_name}}</td>
                            <td>{{\Carbon\Carbon::parse($item->ladingorder_hd_date)->format('d/m/Y')}}</td>
                            <td>{{$item->ladingorder_hd_docuno}}</td>
                            <td>{{$item->productionopenjob_hd_docuno}}</td>
                            <td>{{$item->ms_department_name}}</td>
                            <td>{{$item->created_person}}</td>
                            <td>{{$item->ladingorder_hd_note}}</td>
                            <td>{{$item->approved_by}}</td>
                            <td>
                                @if($item->ladingorder_status_id == 1 || $item->ladingorder_status_id == 5)
                                <a href="{{route('pd-ladi.edit',$item->ladingorder_hd_id)}}" 
                                    class="btn btn-sm btn-warning" >
                                    <i class="fas fa-edit"></i>
                                  </a>                           
                                @else
                                <a href="javascript:void(0)" 
                                class="btn btn-primary btn-sm" 
                                data-toggle="modal" data-target="#modal"
                                onclick="getDataLadi('{{ $item->ladingorder_hd_id }}')">
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
                            <th>ลำดับ</th>
                            <th>คลังสินค้า</th>  
                            <th>รหัสสินค้า</th>                                  
                            <th>ชื่อสินค้า</th>    
                            <th>หน่วยนับ</th>  
                            <th>คงเหลือ</th>  
                            <th>จำนวนเบิก</th>   
                            <th>จำนวนคืน</th>    
                            <th>ราคาต่อหน่วย</th>                           
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
getDataLadi = (id) => {
$.ajax({
    url: "{{ url('/getData-Ladi') }}",
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
            if(item.ms_warehouse_name == null){
                item.ms_warehouse_name = ''
            }else{
                item.ms_warehouse_name = item.ms_warehouse_name
            }
            el_list += `    
             <tr>
                <td>${item.ladingorder_dt_listno}</td>  
                <td>${item.ms_warehouse_name}</td>  
                <td>${item.ms_product_code}</td>  
                <td>${item.ms_product_name}</td>  
                <td>${item.ms_product_unit}</td>        
                <td>${parseFloat(item.stcqty).toFixed(2)}</td>  
                <td>${parseFloat(item.ms_product_qty).toFixed(2)}</td>  
                <td>${parseFloat(item.returnqty).toFixed(2)}</td>   
                <td>${parseFloat(item.ms_product_price).toFixed(2)}</td> 
            </tr>
        `
        })      
        $('#tb_list').html(el_list);
    }
});
}            
</script>
@endpush             