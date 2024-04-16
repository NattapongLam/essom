@extends('layouts.main')
@section('content')
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css')}}">
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
    <div class="card">
        <div class="card-body">
            <form method="GET" class="form-horizontal">
                @csrf
            <div class="row">
                <div class="col-12 col-md-2">
                    <h3 class="card-title" style="font-weight: bold">เอกสารปิดงาน</h3>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group row">
                        <label for="datestart" class="col-sm-3 col-form-label">วันที่</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" name="datestart" id="datestart" class="form-control" value="{{$datestart}}">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group row">
                        <label for="dateend" class="col-sm-3 col-form-label">ถึงวันที่</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" name="dateend" id="dateend" class="form-control" value="{{$dateend}}">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-1">
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <input type="checkbox" id="checkboxPrimary1" name="ck_sta">
                            <label for="ck_sta" class="form-label">รออนุมัติ</label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <button class="btn btn-info" type="submit">ค้นหา</button>
                </div>
            </div>
            </form>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tb_job">
                    <thead>
                        <tr>
                            <th>สถานะ</th>
                            <th>กำหนดส่ง</th>
                            <th>วันที่</th>
                            <th>เลขที่</th>
                            <th>วันที่เริ่ม - จบ</th>
                            <th>ลูกค้า</th>
                            <th>สินค้า</th>
                            <th>Spec Page</th>
                            <th>รายละเอียด</th>
                            <th>ประมาณการต้นทุน</th>
                            <th>จำนวนที่เงินที่ใช้</th>
                            <th>เอกสารแนบ</th>
                            <th></th>
                        </tr>
                        {{-- <tr>
                            <th>สถานะ</th>
                            <th>กำหนดส่ง</th>
                            <th>วันที่</th>
                            <th>เลขที่ใบเปิดงาน</th>
                            <th>วันที่เริ่ม - จบ</th>
                            <th>ลูกค้า</th>
                            <th>สินค้า</th>
                            <th>Spec Page</th>
                            <th>รายละเอียด</th>
                            <th>ประมาณการต้นทุน</th>
                            <th>จำนวนที่เงินที่ใช้</th>
                            <th>เอกสารแนบ</th>
                            <th></th>
                        </tr> --}}
                    </thead>
                    <tbody>
                        @foreach ($hd as $item)
                            <tr>
                                <td>{{$item->productionopenjob_status_name}}</td>
                                <td>{{\Carbon\Carbon::parse($item->productionnotice_dt_duedate)->format('d/m/Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($item->productionopenjob_hd_date)->format('d/m/Y')}}</td>
                                <td>{{$item->productionopenjob_hd_docuno}}</td>
                                <td>
                                    {{\Carbon\Carbon::parse($item->productionopenjob_hd_startdate)->format('d/m/Y')}} - 
                                    {{\Carbon\Carbon::parse($item->productionopenjob_hd_enddate)->format('d/m/Y')}}
                                </td>
                                <td>{{$item->ms_customer_name}}</td>
                                <td>{{$item->ms_product_name}} ({{$item->ms_product_qty}})</td>
                                <td>{{$item->ms_specpage_name}}</td>
                                <td>{{$item->productionnotice_dt_remark}}</td>
                                <td>{{number_format($item->productionopenjob_estimatecost,2)}}</td>
                                <td>{{number_format($item->productionopenjob_actualcost,2)}}</td>
                                <td>
                                    @if ($item->productionopenjob_hd_filename)
                                    <a href="{{asset($item->productionopenjob_hd_filename)}}" target=”_blank”>
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    @if($item->productionopenjob_status_id == 9 || $item->productionopenjob_status_id == 13)
                                    <a href="{{route('pd-close.edit',$item->productionopenjob_hd_id)}}" 
                                        class="btn btn-sm btn-warning" >
                                        <i class="fas fa-edit"></i>
                                      </a>
                                    @else
                                    <a href="javascript:void(0)" 
                                    class="btn btn-primary btn-sm" 
                                    data-toggle="modal" data-target="#modal"
                                    onclick="getDataClose('{{ $item->productionopenjob_hd_id }}')">
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
                            <th>รหัสสินค้า</th>    
                            <th>ชื่อสินค้า</th>  
                            <th>หน่วยนับ</th>     
                            <th>จำนวน</th>          
                            <th>ประมาณการต้นทุน</th>     
                            <th>จำนวนที่เงินที่ใช้</th>  
                            <th>เวลาที่ใช้</th>                               
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
<!-- SweetAlert2 -->
<script src="{{asset('/assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('/assets/plugins/toastr/toastr.min.js')}}"></script>
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
                [3, "asc"]
            ],
            fixedHeader: {
				header:false,
				footer:false
			},
        pagingType: "full_numbers",
        bSort: true,
    // initComplete: function() {
    //   this.api().columns().every(function() {
    //     var column = this;
    //     var select = $('<select class="form-control select2"><option value=""></option></select>')
    //       .appendTo($(column.header()).empty())
    //       .on('change', function() {
    //         var val = $.fn.dataTable.util.escapeRegex(
    //           $(this).val()
    //         );

    //         column
    //           .search(val ? '^' + val + '$' : '', true, false)
    //           .draw();
    //       });

    //     column.data().unique().sort().each(function(d, j) {
    //       select.append('<option value="' + d + '">' + d + '</option>')
    //     });
    //   });
    // }
    
    })
});
getDataClose = (id) => {
$.ajax({
    url: "{{ url('/getData-Close') }}",
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
            if(item.productionopenjob_dt_remark == null){
                item.productionopenjob_dt_remark = ''
            }else{
                item.productionopenjob_dt_remark = item.productionopenjob_dt_remark
            }
            el_list += `    
             <tr> 
                <td>${key+1}</td> 
                <td>${item.ms_product_code}</td>  
                <td>${item.ms_product_name}</td>  
                <td>${item.ms_product_unit}</td>  
                <td>${parseFloat(item.assembleqty).toFixed(2)}</td>         
                <td>${parseFloat(item.estimatecost).toFixed(2)}</td>        
                <td>${parseFloat(item.actualcost).toFixed(2)}</td>    
                <td>${parseFloat(item.timespent).toFixed(2)}</td> 
            </tr>
        `
        })      
        $('#tb_list').html(el_list);
    }
});
}
</script>
@endpush   