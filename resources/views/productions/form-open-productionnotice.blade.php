@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title" style="font-weight: bold">เอกสารแจ้งผลิต</h3><br><hr>
            <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tb_job">
                <thead>
                    <tr>
                        <th>สถานะ</th>
                        <th>วันที่</th>
                        <th>เลขที่ใบแจ้งผลิต</th>
                        <th>กำหนดส่ง</th>
                        <th>ลูกค้า</th>
                        <th>ผู้อนุมัติ</th>
                        <th>หมายเหตุ</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>สถานะ</th>
                        <th>วันที่</th>
                        <th>เลขที่ใบแจ้งผลิต</th>
                        <th>กำหนดส่ง</th>
                        <th>ลูกค้า</th>
                        <th>ผู้อนุมัติ</th>
                        <th>หมายเหตุ</th>
                        <th></th>
                    </tr>
                </thead>   
                <tbody>
                    @foreach ($hd as $item)
                    <tr>
                        <td>{{$item->productionnotice_status_name}}</td>
                        <td>{{\Carbon\Carbon::parse($item->productionnotice_hd_date)->format('d/m/Y')}}</td>
                        <td>{{$item->productionnotice_hd_docuno}}</td>
                        <td>{{\Carbon\Carbon::parse($item->productionnotice_hd_duedate)->format('d/m/Y')}}</td>
                        <td>{{$item->ms_customer_name}}</td>
                        <td>{{$item->approved_by}}</td>
                        <td>{{$item->productionnotice_hd_remark}} / {{$item->approved_note}}</td>
                        <td>
                            @if($item->productionnotice_status_id == 1)
                            <a href="{{route('pd-noti.edit',$item->productionnotice_hd_id)}}" 
                                class="btn btn-sm btn-warning" >
                                <i class="fas fa-edit"></i>
                              </a>                           
                            @else
                            <a href="javascript:void(0)" 
                            class="btn btn-primary btn-sm" 
                            data-toggle="modal" data-target="#modal"
                            onclick="getData('{{ $item->productionnotice_hd_id }}')">
                            <i class="fas fa-eye"></i></a>                          
                            @endif   
                        </td>
                    </tr> 
                    @endforeach                   
                </tbody>          
            </table>
            </div>
        </div>
        <div wire:loading wire:target="save" wire:loading.class="overlay" wire:loading.flex>
            <div class="d-flex justify-content-center align-items-center">
                <i class="fas fa-2x fa-sync fa-spin"></i>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                      <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">รายละเอียด</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Optional</a>
                        </li>
  
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                          <div class="table-responsive">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>กำหนดส่ง</th>
                                          <th>สินค้า</th>
                                          <th>จำนวน</th>
                                          <th>รายละเอียด</th>
                                          <th>Spec Page</th>
                                      </tr>
                                  </thead>
                                  <tbody id="tb_list"></tbody>
                              </table>
                              </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                          <div class="table-responsive">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>สินค้า</th>
                                          <th>จำนวน</th>
                                          <th>รายละเอียด</th>
                                          <th>รายละเอียดไฟฟ้า</th>
                                          <th>รายละเอียด Software</th>
                                      </tr>
                                  </thead>
                                  <tbody id="opt_list"></tbody>
                              </table>
                          </div>
                        </div>                    
                      </div>
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
getData = (id) => {
$.ajax({
    url: "{{ url('/getData') }}",
    type: "post",
    dataType: "JSON",
    data: {
        refid: id,
        _token: "{{ csrf_token() }}"      
    },    
    success: function(data) {
        console.log(data);
        let el_list = ''; 
        let op_list = ''; 
        $.each(data.dt, function(key , item) {
            el_list += `    
             <tr>
                <td>${key+1}</td>
                <td>${item.productionnotice_dt_duedate}</td>  
                <td>${item.ms_product_seminame}/${item.ms_product_semicode}</td>  
                <td>${item.ms_product_semiqty}/${item.ms_product_semiunit}</td>  
                <td>${item.productionnotice_dt_remark}</td>  
                <td>${item.ms_specpage_name}</td>                      
            </tr>
        `
        })      
        $('#tb_list').html(el_list);
        $.each(data.op, function(key , item) {
            op_list += `    
             <tr>
                <td>${item.productionnotice_op_name}/${item.productionnotice_op_code}</td>
                <td>${item.productionnotice_op_qty}/${item.productionnotice_op_unit}</td>  
                <td>${item.productionnotice_op_remark}</td>  
                <td>${item.productionnotice_op_elect}</td>  
                <td>${item.productionnotice_op_software}</td>  
                   
            </tr>
        `
        })      
        $('#opt_list').html(op_list);
    }
});
}
</script>
@endpush