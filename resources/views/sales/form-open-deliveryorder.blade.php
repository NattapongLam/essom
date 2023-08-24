@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title" style="font-weight: bold">เอกสารนำส่งสินค้า</h3><br><hr>
            <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tb_job">
                <thead>
                    <tr>
                        <th>สถานะ</th>
                        <th>วันที่</th>
                        <th>กำหนดส่ง</th>
                        <th>เลขที่ใบนำส่งสินค้า</th>
                        <th>เลขที่อ้างอิง</th>
                        <th>ลูกค้า</th>
                        <th>หมายเหตุ</th>
                        <th>ผู้ตรวจสอบ</th>
                        <th>ผู้จัดส่ง</th>
                        <th>วันที่จัดส่ง</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>สถานะ</th>
                        <th>วันที่</th>
                        <th>กำหนดส่ง</th>
                        <th>เลขที่ใบนำส่งสินค้า</th>
                        <th>เลขที่อ้างอิง</th>
                        <th>ลูกค้า</th>
                        <th>หมายเหตุ</th>
                        <th>ผู้ตรวจสอบ</th>
                        <th>ผู้จัดส่ง</th>
                        <th>วันที่จัดส่ง</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hd as $item)
                        <tr>
                            <td>{{$item->deliveryorder_status_name}}</td>
                            <td>{{\Carbon\Carbon::parse($item->deliveryorder_hd_date)->format('d/m/Y')}}</td>
                            <td>{{\Carbon\Carbon::parse($item->deliveryorder_hd_duedate)->format('d/m/Y')}}</td>
                            <td>{{$item->deliveryorder_hd_docuno}}</td>
                            <td>{{$item->productionnotice_hd_docuno}}</td>
                            <td>{{$item->ms_customer_name}}</td>
                            <td>{{$item->deliveryorder_hd_note}}</td>
                            <td>{{$item->checked_by}}</td>
                            <td>{{$item->delivery_by}}</td>
                            <td>{{\Carbon\Carbon::parse($item->delivery_date)->format('d/m/Y')}}</td>
                            <td>
                                @if($item->deliveryorder_status_id == 1)
                                <a href="{{route('del-order.edit',$item->deliveryorder_hd_id)}}" 
                                    class="btn btn-sm btn-warning" >
                                    <i class="fas fa-edit"></i>
                                  </a>                           
                                @else
                                <a href="javascript:void(0)" 
                                class="btn btn-primary btn-sm" 
                                data-toggle="modal" data-target="#modal"
                                onclick="getDataDel('{{ $item->deliveryorder_hd_id }}')">
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
                            <th>S/N MODEL</th>
                            <th>Description</th>  
                            <th>Qty.</th>                                  
                            <th>Del. Chk.</th>    
                            <th>Rec. Chk.</th>  
                            <th>Part No./Note</th>                            
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
                "pageLength": 30,
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
getDataDel = (id) => {
$.ajax({
    url: "{{ url('/getDataDel') }}",
    type: "post",
    dataType: "JSON",
    data: {
        refid: id,
        _token: "{{ csrf_token() }}"      
    },    
    success: function(data) {
        console.log(data);
        let el_list = ''; 
        let del_list = ''; 
        let rec_list = ''; 
        $.each(data.dt, function(key , item) {
            if(item.deliveryorder_dt_model == null){
                item.deliveryorder_dt_model = ''
            }else{
                item.deliveryorder_dt_model = item.deliveryorder_dt_model
            }
            if(item.deliveryorder_dt_remark == null){
                item.deliveryorder_dt_remark = ''
            }else{
                item.deliveryorder_dt_remark = item.deliveryorder_dt_remark
            }
            if(item.del_checked == 1){
                del_list =  '<input type="checkbox" id="checkboxPrimary1" checked readonly>'
            }else{
                del_list =  '<input type="checkbox" id="checkboxPrimary1" readonly>'
            }
            if(item.rec_checked == 1){
                rec_list =  '<input type="checkbox" id="checkboxPrimary1" checked readonly>'
            }else{
                rec_list =  '<input type="checkbox" id="checkboxPrimary1" readonly>'
            }
            el_list += `    
             <tr>
                <td>${item.deliveryorder_dt_model}</td>  
                <td>${item.deliveryorder_dt_desp}</td>  
                <td>${parseFloat(item.deliveryorder_dt_qty).toFixed(2)}</td>  
                <td>${del_list}</td>  
                <td>${rec_list}</td>       
                <td>${item.deliveryorder_dt_remark}</td>    
            </tr>
        `
        })      
        $('#tb_list').html(el_list);
    }
});
} 
</script>        
@endpush             