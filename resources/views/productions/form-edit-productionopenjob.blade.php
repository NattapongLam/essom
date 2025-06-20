@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
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
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('pd-open.update', $hd->productionopenjob_hd_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <h3 class="card-title" style="font-weight: bold"><a href="{{route('pd-open.index')}}">ใบเปิดงาน</a>/เอกสารเปิดงาน</h3>
                    </div>
                </div>               
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <select class="form-control" name="productionopenjob_status_id" id="productionopenjob_status_id" required autofocus>
                            @if($hd->productionopenjob_status_id == 1)
                            <option value="">กรุณาเลือกสถานะ</option>
                            @elseif($hd->productionopenjob_status_id == 3 || $hd->productionopenjob_status_id == 5)
                            <option value="">กรุณาเลือกสถานะ</option>
                            @endif                            
                            @foreach ($sta as $item)
                            <option value="{{$item->productionopenjob_status_id}}">{{$item->productionopenjob_status_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="ระบุหมายเหตุ" name="note" id="note">
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        @if($hd->productionopenjob_status_id == 1 )
                        <button type="submit" class="btn btn-block btn-primary">
                            บันทึก
                         </button>
                        @elseif($hd->productionopenjob_status_id == 3 || $hd->productionopenjob_status_id == 5)
                        <button type="submit" class="btn btn-block btn-primary">
                            บันทึก
                         </button>
                        @endif    
                        
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-12 col-md-3">
                    <div class="form-group">
                        <h3 class="card-title"  style="font-weight: bold; color: red;">สถานะ : {{$hd->productionopenjob_status_name}}</h3>
                    </div>
                </div>
                 <div class="col-12 col-md-3">
                    <div class="form-group">
                        <h3 class="card-title"  style="font-weight: bold; color: red;">หมายเหตุ : {{$hd->approved_note}}</h3>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="productionnotice_hd_date">กำหนดส่ง</label>
                        <input type="text" class="form-control" 
                        value="{{\Carbon\Carbon::parse($hd->productionnotice_dt_duedate)->format('d/m/Y')}}" 
                        readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="productionnotice_hd_date">วันที่</label>
                        <input type="text" class="form-control" 
                        value="{{\Carbon\Carbon::parse($hd->productionopenjob_hd_date)->format('d/m/Y')}}" 
                        readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="productionnotice_hd_docuno">เลขที่ใบเปิดงาน</label>
                        <input type="text" class="form-control" value="{{$hd->productionopenjob_hd_docuno}}" readonly>
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
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="ms_customer_name">ลูกค้า</label>
                        <input type="text" class="form-control" value="{{$hd->ms_customer_name}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="ms_product_name">สินค้า</label>
                        <input type="text" class="form-control" value="{{$hd->ms_product_name}} / {{$hd->ms_product_qty}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="checked_date">Machine (MH)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->machinetime,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="checked_date">Elect (MH)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->electricitytime,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="checked_date">Paint (MH)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->painttime,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="checked_date">Assembly (MH)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->assemblytime,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="checked_date">Other (MH)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->othertime,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="checked_date">Total (MH)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->totaltime,2)}}" readonly>
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="ms_specpage_name">Spec Page</label>
                        <input type="text" class="form-control" value="{{$hd->ms_specpage_name}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="productionopenjob_estimatecost">ประมาณการต้นทุน</label>
                        <input type="text" class="form-control" value="{{number_format($hd->productionopenjob_estimatecost,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="productionnotice_hd_docuno">เลขที่ใบแจ้งผลิต</label>
                        <input type="text" class="form-control" value="{{$hd->productionnotice_hd_docuno}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="created_person">ผู้เปิดงาน</label>
                        <input type="text" class="form-control" value="{{$hd->created_person}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="checked_date">วันที่ตรวจสอบ</label>
                        <input type="date" class="form-control" value="{{$hd->checked_date}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="checked_by">ผู้ตรวจสอบ</label>
                        <input type="text" class="form-control" value="{{$hd->checked_by}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="approved_date">วันที่อนุมัติ</label>
                        <input type="date" class="form-control" value="{{$hd->approved_date}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="approved_by">ผู้อนุมัติ</label>
                        <input type="text" class="form-control" value="{{$hd->approved_by}}" readonly>
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
            </div><hr> 
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                    <label class="form-label">รายละเอียด</label><br>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>วันที่ต้องการ</th>
                                <th>แผนก</th>
                                <th>สินค้า</th>
                                <th>จำนวน</th>
                                <th>รายละเอียด</th>
                                <th>ประมาณการต้นทุน</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dt as $item)
                                <tr>
                                    <td>{{$item->productionopenjob_dt_listno}}</td>
                                    <td>{{$item->duedate}}</td>
                                    <td>{{$item->ms_department_name}}</td>
                                    <td>{{$item->ms_product_name}}</td>
                                    <td>{{$item->ms_product_qty}}/{{$item->ms_product_unit}}</td>
                                    <td>{{$item->productionopenjob_dt_remark}}</td>
                                    <td>{{number_format($item->estimatecost,2)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">Total</td>
                                <td>{{number_format($total,2)}}</td>                                
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                    </div>
                </div>
            </div><hr>  
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                    <label class="form-label">Optional</label><br>
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
             <div class="row">
                 <div class="col-12">
                    <div class="form-group">
                    <label class="form-label">ประวัตการแก้ไข</label><br>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>วันที่แก้ไข</th>
                                    <th>ผู้แก้ไข</th>
                                    <th>เลขที่งาน</th>
                                    <th>วันที่เริ่ม - จบ</th>
                                    <th>ลูกค้า</th>
                                    <th>สินค้า</th>
                                    <th>Spec Page</th>
                                    <th>ประมาณการต้นทุน</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($loghd as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->update_log)->format('d/m/Y H:i') }}</td>
                                    <td>{{ $item->person_log }}</td>
                                    <td>{{ $item->productionopenjob_hd_docuno}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->productionopenjob_hd_startdate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($item->productionopenjob_hd_enddate)->format('d/m/Y') }}</td>
                                    <td>{{ $item->ms_customer_name }}</td>
                                    <td>{{ $item->ms_product_name}} / {{$item->ms_product_qty}}</td>
                                    <td>{{ $item->ms_specpage_name }}</td>
                                    <td>{{number_format($item->productionopenjob_estimatecost,2)}}</td>
                                     <td>
                                        <a href="javascript:void(0)" 
                                            class="btn btn-primary btn-sm" 
                                            data-toggle="modal" data-target="#modal"
                                            onclick="getLogDataOpen('{{ $item->log_openjob_hd_id }}')">
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
                            <th>สถานะ</th>
                            <th>แผนก</th>
                            <th>ลำดับ</th>
                            <th>วันที่ต้องการ</th>                                    
                            <th>ชื่อสินค้า</th>  
                            <th>หน่วยนับ</th>     
                            <th>จำนวน</th>      
                            <th>รายละเอียด</th>       
                            <th>ประมาณการต้นทุน</th>                                    
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
<script>
getLogDataOpen = (id) => {
$.ajax({
    url: "{{ url('/getLogData-Open') }}",
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
                <td>${item.productionopenjob_status_name}</td>  
                <td>${item.ms_department_name}</td>  
                <td>${key+1}</td> 
                <td>${item.duedate}</td>                
                <td>${item.ms_product_name}</td>  
                <td>${item.ms_product_unit}</td>  
                <td>${item.ms_product_qty}</td>  
                <td>${item.productionopenjob_dt_remark}</td>           
                <td>${item.estimatecost}</td>            
            </tr>
        `
        })      
        $('#tb_list').html(el_list);
    }
});
}
</script>
@endpush