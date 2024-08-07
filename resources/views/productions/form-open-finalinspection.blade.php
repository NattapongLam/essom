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
                <div class="col-12 col-md-3">
                    <h3 class="card-title" style="font-weight: bold">เอกสารตรวจสอบขั้นตอนสุดท้าย</h3>&nbsp;&nbsp;
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
                        <th>วันที่</th>
                        <th>เลขที่ตรวจสอบ</th>
                        <th>เลขที่เปิดงาน</th>
                        <th>สินค้า</th>
                        <th>ลูกค้า</th>
                        <th>Rev.</th>
                        <th>Serial No</th>
                        <th>หมายเหตุ</th>
                        <th>ผู้อนุมัติ</th>
                        <th></th>
                    </tr>
                    {{-- <tr>
                        <th>สถานะ</th>
                        <th>วันที่</th>
                        <th>เลขที่ใบตรวจสอบ</th>
                        <th>เลขที่ใบเปิดงาน</th>
                        <th>สินค้า</th>
                        <th>ลูกค้า</th>
                        <th>Rev.</th>
                        <th>Serial No.</th>
                        <th>หมายเหตุ</th>
                        <th>ผู้อนุมัติ</th>
                        <th></th>
                    </tr> --}}
                </thead>
                <tbody>
                    @foreach ($hd as $item)
                        <tr>
                            <td>{{$item->finalInspection_status_name}}</td>
                            <td>{{\Carbon\Carbon::parse($item->finalInspection_hd_date)->format('d/m/Y')}}</td>
                            <td>{{$item->finalInspection_hd_docuno}}</td>
                            <td>{{$item->productionopenjob_hd_docuno}}</td>
                            <td>{{$item->ms_product_name}}</td>
                            <td>{{$item->ms_customer_name}}</td>
                            <td>{{$item->ms_finalspec_hd_code}} {{$item->ms_finalspec_hd_rev}}</td>
                            <td>{{$item->serialno}}</td>
                            <td>{{$item->finalInspection_hd_note}}</td>
                            <td>{{$item->approved_by}}</td>
                            <td>
                                @if($item->finalInspection_status_id == 4)
                                <a href="{{route('fl-inst.edit',$item->finalInspection_hd_id)}}" 
                                    class="btn btn-sm btn-warning" >
                                    <i class="fas fa-edit"></i>
                                  </a>                           
                                @else
                                <a href="javascript:void(0)" 
                                class="btn btn-primary btn-sm" 
                                data-toggle="modal" data-target="#modal"
                                onclick="getDataInst('{{ $item->finalInspection_hd_id }}')">
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                      <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">เอกสารตรวจสอบขั้นตอนสุดท้าย</a>
                        </li>
                        {{-- <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">2.การตรวจสอบขั้นสุดท้าย</a>
                        </li>   --}}
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                          <div class="table-responsive">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>ไฟล์</th>
                                          {{-- <th>ค่าที่ได้</th>
                                          <th>เช็ค</th>
                                          <th>หมายเหตุ</th> --}}
                                      </tr>
                                  </thead>
                                  <tbody id="tb1_list"></tbody>
                              </table>
                              </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                          <div class="table-responsive">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                        <th>รายละเอียด</th>
                                        <th>ค่าที่ได้</th>
                                        <th>เช็ค</th>
                                        <th>หมายเหตุ</th>
                                      </tr>
                                  </thead>
                                  <tbody id="tb2_list"></tbody>
                              </table>
                          </div>
                        </div>                     --}}
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
getDataInst = (id) => {
$.ajax({
    url: "{{ url('/getData-Inst') }}",
    type: "post",
    dataType: "JSON",
    data: {
        refid: id,
        _token: "{{ csrf_token() }}"      
    },    
    success: function(data) {
        console.log(data);
        let el1_list = ''; 
        let el2_list = ''; 
        $.each(data.dt3, function(key , item) {
            el1_list += `    
             <tr>
                <td>
                    <a href="${item.finalInspection_part_filename}" target=”_blank”>
                    ${item.finalInspection_part_filename}
                    </a>
                </td>                 
            </tr>
        `
        })      
        $('#tb1_list').html(el1_list);
        $.each(data.dt2, function(key , item) {
            if(item.finalInspection_dt2_qty == null){
                item.finalInspection_dt2_qty = ''
            }else{
                item.finalInspection_dt2_qty = item.finalInspection_dt2_qty
            }
            if(item.finalInspection_dt2_description == null){
                item.finalInspection_dt2_description = ''
            }else{
                item.finalInspection_dt2_description = item.finalInspection_dt2_description
            }
            el2_list += `    
             <tr>
                <td>${item.finalInspection_dt2_remark}</td>  
                <td>${item.finalInspection_dt2_qty}</td>  
                <td>${item.finalInspection_dt2_checked}</td>  
                <td>${item.finalInspection_dt2_description}</td>  
            </tr>
        `
        })      
        $('#tb2_list').html(el2_list);
    }
});
}          
</script>
@endpush             