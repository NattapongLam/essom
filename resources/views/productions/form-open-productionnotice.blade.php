@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-body">
            <form method="GET" class="form-horizontal">
                @csrf
            <div class="row">
                <div class="col-12 col-md-2">
                    <h3 class="card-title" style="font-weight: bold">เอกสารแจ้งผลิต</h3>
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
                <div class="col-12 col-md-2">
                    <button class="btn btn-info" type="submit">ค้นหา</button>
                </div>
            </div>           
            </form>
            <hr>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm" id="tb_job">
                        <thead>
                            <tr>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">วันที่</th>
                                <th class="text-center">เลขที่ใบแจ้งผลิต</th>
                                <th class="text-center">กำหนดส่ง</th>
                                <th class="text-center">ลูกค้า</th>
                                <th class="text-center">ผู้อนุมัติ</th>
                                <th class="text-center">หมายเหตุ</th>
                                <th></th>
                            </tr>
                        </thead>   
                        <tbody>
                            @foreach ($hd as $item)
                            <tr>
                                <td class="text-center">{{$item->productionnotice_status_name}}</td>
                                <td class="text-center">{{\Carbon\Carbon::parse($item->productionnotice_hd_date)->format('d/m/Y')}}</td>
                                <td class="text-center">{{$item->productionnotice_hd_docuno}}</td>
                                <td class="text-center">{{\Carbon\Carbon::parse($item->productionnotice_hd_duedate)->format('d/m/Y')}}</td>
                                <td class="text-center">{{$item->ms_customer_name}}</td>
                                <td class="text-center">{{$item->approved_by}}</td>
                                <td class="text-center">{{$item->productionnotice_hd_remark}} / {{$item->approved_note}}</td>
                                <td class="text-center">
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
                                    @if ($item->productionnotice_status_id == 4)
                                        @if ($item->approved_by == auth()->user()->name)
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm"  
                                            onclick="confirmDel('{{ $item->productionnotice_hd_docuno }}','{{ $item->productionnotice_hd_id }}')">
                                        <i class="fas fa-trash"></i></a>
                                        @endif
                                    @endif                                                     
                                </td>
                            </tr> 
                            @endforeach                   
                        </tbody>          
                    </table>
                </div>
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
                [7, "desc"]
            ],
            fixedHeader: {
				header:false,
				footer:false
			},
        pagingType: "full_numbers",
        bSort: true,   
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
            if(item.productionnotice_dt_remark == null){
                item.productionnotice_dt_remark = ''
            }else{
                item.productionnotice_dt_remark = item.productionnotice_dt_remark
            }
            el_list += `    
             <tr>
                <td>${key+1}</td>
                <td>${item.productionnotice_dt_duedate}</td>  
                <td>${item.ms_product_seminame}</td>  
                <td>${item.ms_product_semiqty}/${item.ms_product_semiunit}</td>  
                <td>${item.productionnotice_dt_remark}</td>  
                <td>
                    <a href="${item.filename}" target=”_blank”>
                    ${item.ms_specpage_name}
                    </a>
                </td>                      
            </tr>
        `
        })      
        $('#tb_list').html(el_list);
        $.each(data.op, function(key , item) {
            if(item.productionnotice_op_remark == null){
                item.productionnotice_op_remark = ''
            }else{
                item.productionnotice_op_remark = item.productionnotice_op_remark
            }
            if(item.productionnotice_op_elect == null){
                item.productionnotice_op_elect = ''
            }else{
                item.productionnotice_op_elect = item.productionnotice_op_elect
            }
            if(item.productionnotice_op_software == null){
                item.productionnotice_op_software = ''
            }else{
                item.productionnotice_op_software = item.productionnotice_op_software
            }
            op_list += `    
             <tr>
                <td>${item.productionnotice_op_name}</td>
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
confirmDel = (docs,refid) =>{       
Swal.fire({
    title: 'คุณแน่ใจหรือไม่ !',
    text: `คุณต้องการลบรายการเบิกนี้หรือไม่ ?`,
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
            url: `{{ url('/cancelDocsNotice') }}`,
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