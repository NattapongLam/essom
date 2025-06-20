@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css')}}">
<div class="mt-4"><br>
<div class="row">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-block-helper me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="col-12">
    <div class="card">
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('pd-close.update', $hd->productionopenjob_hd_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <h3 class="card-title" style="font-weight: bold"><a href="{{route('pd-close.index')}}">ใบปิดงาน</a>/เอกสารปิดงาน</h3>
                    </div>
                </div>               
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <select class="form-control" name="productionopenjob_status_id" id="productionopenjob_status_id" required autofocus>
                            <option value="">กรุณาเลือกสถานะ</option>
                            @foreach ($sta as $item)
                            <option value="{{$item->productionopenjob_status_id}}">{{$item->productionopenjob_status_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="ระบุหมายเหตุ" name="note" id="note">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary toastrDefaultSuccess">
                            บันทึก
                         </button>
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-12 col-md-3">
                    <div class="form-group">
                        <h3 class="card-title"  style="font-weight: bold; color: red;">สถานะ : {{$hd->productionopenjob_status_name}}</h3>
                    </div>
                </div>
                 <div class="col-12 col-md-9">
                    <div class="form-group">
                        <h3 class="card-title"  style="font-weight: bold; color: red;">หมายเหตุ : {{$hd->close_approvedpersonnote}}</h3>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="productionnotice_hd_date">กำหนดส่ง</label>
                        <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($hd->productionnotice_dt_duedate)->format('d/m/Y')}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="productionnotice_hd_date">วันที่</label>
                        <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($hd->productionopenjob_hd_date)->format('d/m/Y')}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="productionnotice_hd_docuno">เลขที่ใบเปิดงาน</label>
                        <input type="text" class="form-control" value="{{$hd->productionopenjob_hd_docuno}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="productionnotice_hd_docuno">เลขที่ใบแจ้งผลิต</label>
                        <input type="text" class="form-control" value="{{$hd->productionnotice_hd_docuno}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="ms_specpage_name">Spec Page</label>
                        <input type="text" class="form-control" value="{{$hd->ms_specpage_name}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="productionnotice_hd_date">Final Test Date</label>
                        <input type="date" class="form-control" value="{{$hd->finaltest_date}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="ms_customer_name">ลูกค้า</label>
                        <input type="text" class="form-control" value="{{$hd->ms_customer_name}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-group">
                        <label for="ms_product_name">สินค้า</label>
                        <input type="text" class="form-control" value="{{$hd->ms_product_name}} / {{$hd->ms_product_qty}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="productionnotice_hd_docuno">วันที่เริ่ม - จบ</label>
                        <input type="text" class="form-control" value="{{$hd->productionopenjob_hd_startdate}} - {{$hd->productionopenjob_hd_enddate}}" readonly>
                    </div>
                </div>                             
            </div>
            <div class="row">
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="created_person">Serial No</label>
                        <input type="text" class="form-control" value="{{$hd->serialno}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="productionopenjob_estimatecost">ประมาณการต้นทุน</label>
                        <input type="text" class="form-control" value="{{number_format($hd->productionopenjob_estimatecost,2)}}" readonly>
                    </div>
                </div>             
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="created_person">จำนวนที่เงินที่ใช้</label>
                        <input type="text" class="form-control" value="{{number_format($hd->productionopenjob_actualcost,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="created_person">ผู้ปิดงาน</label>
                        <input type="text" class="form-control" value="{{$hd->close_person}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="created_person">Foreman</label>
                        <input type="text" class="form-control" value="{{$hd->foreman}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="checked_date">Machine (MH)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->machinetime_close,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="checked_date">Elect (MH)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->electricitytime_close,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="checked_date">Paint (MH)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->painttime_close,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="checked_date">Assembly (MH)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->assemblytime_close,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="checked_date">Other (MH)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->othertime_close,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="checked_date">Total (MH)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->totaltime_close,2)}}" readonly>
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="productionnotice_hd_remark">รายละเอียด</label>
                        <textarea type="text" class="form-control" readonly>{{$hd->productionnotice_dt_remark}}</textarea>
                    </div>                  
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="productionopenjob_hd_remark">หมายเหตุ</label>
                        <textarea type="text" class="form-control" readonly>{{$hd->productionopenjob_hd_remark}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-12 col-md-12">
                    <div class="form-group">
                        <label for="productionnotice_hd_remark">หมายเหตุแก้ไข</label>
                        <textarea type="text" class="form-control" readonly>{{$hd->note_editclose}}</textarea>
                    </div>                  
                </div>
            </div>
            <div class="row">             
                <div class="col-12">
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
                                            <th>สินค้า</th>
                                            <th>จำนวน</th>
                                            <th>ประมาณการต้นทุน</th>
                                            <th>จำนวนเงินที่ใช้</th>
                                            <th>เวลาที่ใช้ (ชม.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dt as $item)
                                            <tr>
                                                <td>{{$item->productionopenjob_dt_listno}}</td>
                                                <td>{{$item->ms_product_name}}</td>
                                                <td>{{$item->assembleqty}}/{{$item->ms_product_unit}}</td>
                                                <td>{{number_format($item->estimatecost,2)}}</td>
                                                <td>{{number_format($item->actualcost,2)}}</td>
                                                <td>{{number_format($item->timespent,2)}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">Total</td>
                                            <td>{{number_format($total,2)}}</td>    
                                            <td>{{number_format($total1,2)}}</td>       
                                            <td>{{number_format($total2,2)}}</td>                                   
                                        </tr>
                                    </tfoot>
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
                                    <tbody>
                                        @foreach ($op as $item)
                                            <tr>
                                                <td>{{$item->productionnotice_op_name}} ({{$item->productionnotice_op_code}})</td>
                                                <td>{{$item->productionnotice_op_qty}} / {{$item->productionnotice_op_unit}}</td>
                                                <td>{{$item->productionnotice_op_remark}}</td>
                                                <td>{{$item->productionnotice_op_elect}}</td>
                                                <td>{{$item->productionnotice_op_software}}</td>
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
                </div>  
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                    <label class="form-label">เอกสารที่เกี่ยวข้อง</label><br>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>สถานะเอกสาร</th>
                                <th>ประเภทเอกสาร</th>
                                <th>วันที่เอกสาร</th>
                                <th>เลขที่เอกสาร</th>
                                <th>ผู้บันทึกเอกสาร</th>
                                <th>ผู้อนุมัติเอกสาร</th>
                            </tr>
                        </thead> 
                        <tbody>
                            @foreach ($docuno as $item)
                                <tr>
                                    <td>{{$item->status}}</td>
                                    <td>{{$item->type}}</td>
                                    <td>{{\Carbon\Carbon::parse($item->date)->format('d/m/Y')}}</td>
                                    <td>
                                        @if ($item->type == 'ใบเบิกวัสดุอุปกรณ์')
                                        <a href="{{route('pd-ladi.show',$item->docuno)}}"  target=”_blank”>
                                        {{$item->docuno}}
                                        </a>
                                        @elseif($item->type == 'ใบขอซื้อ')
                                        <a href="{{route('pd-requ.show',$item->docuno)}}"  target=”_blank”>
                                            {{$item->docuno}}
                                        </a>
                                        @elseif($item->type == 'ใบสั่งงาน')
                                        <a href="{{route('pd-work.show',$item->docuno)}}"  target=”_blank”>
                                            {{$item->docuno}}
                                        </a>
                                        @elseif($item->type == 'ใบบันทึกชั่วโมงการทำงาน')
                                        <a href="{{route('pd-woho.show',$item->docuno)}}"  target=”_blank”>
                                            {{$item->docuno}}
                                        </a>
                                        @elseif($item->type == 'ใบตรวจสอบกระบวนขั้นสุดท้าย')
                                        <a href="{{route('fl-inst.show',$item->docuno)}}"  target=”_blank”>
                                            {{$item->docuno}}
                                        </a>
                                        @elseif($item->type == 'ใบรับคืนจากการเบิก')
                                        <a href="{{route('pd-retu.show',$item->docuno)}}"  target=”_blank”>
                                            {{$item->docuno}}
                                        </a>
                                        @elseif($item->type == 'ใบโอนย้ายวัสดุอุปกรณ์')
                                            {{$item->docuno}}
                                        @endif
                                    </td>
                                    <td>{{$item->created_person}}</td>
                                    <td>{{$item->approved_by}}</td>
                                </tr>
                            @endforeach
                        </tbody>                                                
                    </table>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-12">
                    <div class="form-group">
                    <label class="form-label">เวอร์ชั่นเอกสาร</label><br>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>วันที่แก้ไข</th>
                                <th>ผู้แก้ไข</th>
                                <th>เลขที่งาน</th>
                                <th>จำนวนเงินที่ใช้</th>
                                <th>วันที่ทดสอบ</th>
                                <th>หัวหน้างาน</th>
                                <th>ผู้ปิดงาน</th>
                                <th>Serial No</th>
                                <th>Machine(MH)</th>
                                <th>Elect(MH)</th>
                                <th>Paint(MH)</th>
                                <th>Assembly(MH)</th>
                                <th>Other(MH)</th>
                                <th>Total(MH)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loghd as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->update_log)->format('d/m/Y H:i') }}</td>
                                    <td>{{ $item->person_log }}</td>
                                    <td>{{ $item->productionopenjob_hd_docuno}}</td>
                                    <td>{{number_format($item->productionopenjob_actualcost,2)}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->finaltest_date)->format('d/m/Y') }}</td>
                                    <td>{{ $item->foreman }}</td>
                                    <td>{{ $item->close_person }}</td>  
                                    <td>{{ $item->serialno }}</td>
                                    <td>{{ number_format($item->machinetime_close,2) }}</td>
                                    <td>{{ number_format($item->electricitytime_close,2) }}</td>
                                    <td>{{ number_format($item->painttime_close,2) }}</td>
                                    <td>{{ number_format($item->assemblytime_close,2) }}</td>
                                    <td>{{ number_format($item->othertime_close,2) }}</td>
                                    <td>{{ number_format($item->totaltime_close,2) }}</td>
                                    <td>
                                        <a href="javascript:void(0)" 
                                            class="btn btn-primary btn-sm" 
                                            data-toggle="modal" data-target="#modal"
                                            onclick="getLogDataClose('{{ $item->log_openjob_hd_id }}')">
                                            <i class="fas fa-eye"></i>
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
        </form>
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
<script src="{{ asset('/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{asset('/assets/plugins/toastr/toastr.min.js')}}"></script>
<script>
$('.toastrDefaultSuccess').click(function() {
    toastr.success('บันทึกเรียบร้อย')
});
getLogDataClose = (id) => {
$.ajax({
    url: "{{ url('/getLogData-Close') }}",
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