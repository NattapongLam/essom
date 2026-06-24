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
            <div class="row align-items-center mb-3">
                <div class="col-12 col-md-3">
                    <div class="form-group mb-0">
                        <h3 class="card-title mb-0" style="font-weight: bold"><a href="{{route('pd-open.index')}}">ใบเปิดงาน</a>/เอกสารเปิดงาน</h3>
                    </div>
                </div>               
                <div class="col-12 col-md-3">
                    <div class="form-group mb-0">
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
                    <div class="form-group mb-0">
                        <input type="text" class="form-control" placeholder="ระบุหมายเหตุการเปลี่ยนสถานะ" name="note" id="note">
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group mb-0">
                        @if($hd->productionopenjob_status_id == 1 || $hd->productionopenjob_status_id == 3 || $hd->productionopenjob_status_id == 5)
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-1"></i> บันทึก
                         </button>
                        @endif    
                    </div>
                </div>
            </div>

            <div class="row bg-light p-2 rounded mb-3 mx-0">
                 <div class="col-12 col-md-6">
                    <div class="form-group mb-0">
                        <span style="font-weight: bold; color: #dc3545; font-size: 1.1rem;">สถานะปัจจุบัน : {{$hd->productionopenjob_status_name}}</span>
                    </div>
                </div>
                 <div class="col-12 col-md-6">
                    <div class="form-group mb-0">
                        <span style="font-weight: bold; color: #6c757d; font-size: 1.1rem;">หมายเหตุอนุมัติ : {{$hd->approved_note ?: '-'}}</span>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label class="form-label font-weight-bold">กำหนดส่ง</label>
                        <input type="text" class="form-control bg-light" 
                        value="{{\Carbon\Carbon::parse($hd->productionnotice_dt_duedate)->format('d/m/Y')}}" 
                        readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label class="form-label font-weight-bold">วันที่เอกสาร</label>
                        <input type="text" class="form-control bg-light" 
                        value="{{\Carbon\Carbon::parse($hd->productionopenjob_hd_date)->format('d/m/Y')}}" 
                        readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label class="form-label font-weight-bold">เลขที่ใบเปิดงาน</label>
                        <input type="text" class="form-control bg-light text-primary font-weight-bold" value="{{$hd->productionopenjob_hd_docuno}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label class="form-label font-weight-bold">วันที่เริ่ม - จบ</label>
                        <input type="text" class="form-control bg-light" value="{{$hd->productionopenjob_hd_startdate}} - {{$hd->productionopenjob_hd_enddate}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="form-label font-weight-bold">ลูกค้า</label>
                        <input type="text" class="form-control bg-light" value="{{$hd->ms_customer_name}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="form-label font-weight-bold">สินค้าหลัก</label>
                        <input type="text" class="form-control bg-light" value="{{$hd->ms_product_name}} / {{$hd->ms_product_qty}}" readonly>
                    </div>
                </div>
            </div>

            <div class="row bg-light pt-2 pb-1 rounded mb-3 mx-0 border">
                <div class="col-6 col-md-2">
                    <div class="form-group">
                        <label class="small text-muted mb-1">Machine (MH)</label>
                        <input type="text" class="form-control form-control-sm text-end" value="{{number_format($hd->machinetime,2)}}" readonly>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="form-group">
                        <label class="small text-muted mb-1">Elect (MH)</label>
                        <input type="text" class="form-control form-control-sm text-end" value="{{number_format($hd->electricitytime,2)}}" readonly>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="form-group">
                        <label class="small text-muted mb-1">Paint (MH)</label>
                        <input type="text" class="form-control form-control-sm text-end" value="{{number_format($hd->painttime,2)}}" readonly>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="form-group">
                        <label class="small text-muted mb-1">Assembly (MH)</label>
                        <input type="text" class="form-control form-control-sm text-end" value="{{number_format($hd->assemblytime,2)}}" readonly>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="form-group">
                        <label class="small text-muted mb-1">Other (MH)</label>
                        <input type="text" class="form-control form-control-sm text-end" value="{{number_format($hd->othertime,2)}}" readonly>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="form-group">
                        <label class="small mb-1 font-weight-bold text-dark">Total (MH)</label>
                        <input type="text" class="form-control form-control-sm text-end bg-white font-weight-bold text-primary" value="{{number_format($hd->totaltime,2)}}" readonly>
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label class="form-label font-weight-bold">Spec Page</label>
                        <input type="text" class="form-control bg-light" value="{{$hd->ms_specpage_name}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label class="form-label font-weight-bold">ประมาณการต้นทุนรวม</label>
                        <input type="text" class="form-control bg-light text-end text-success font-weight-bold" value="{{number_format($hd->productionopenjob_estimatecost,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label class="form-label font-weight-bold">เลขที่ใบแจ้งผลิต</label>
                        <input type="text" class="form-control bg-light" value="{{$hd->productionnotice_hd_docuno}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label class="form-label font-weight-bold">ผู้เปิดงาน</label>
                        <input type="text" class="form-control bg-light" value="{{$hd->created_person}}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label class="form-label text-muted">วันที่ตรวจสอบ</label>
                        <input type="text" class="form-control bg-light" value="{{ $hd->checked_date ? \Carbon\Carbon::parse($hd->checked_date)->format('d/m/Y') : '-' }}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label class="form-label text-muted">ผู้ตรวจสอบ</label>
                        <input type="text" class="form-control bg-light" value="{{$hd->checked_by ?: '-'}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label class="form-label text-muted">วันที่อนุมัติ</label>
                        <input type="text" class="form-control bg-light" value="{{ $hd->approved_date ? \Carbon\Carbon::parse($hd->approved_date)->format('d/m/Y') : '-' }}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label class="form-label text-muted">ผู้อนุมัติ</label>
                        <input type="text" class="form-control bg-light" value="{{$hd->approved_by ?: '-'}}" readonly>
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="form-label font-weight-bold">รายละเอียดแจ้งผลิต</label>
                        <textarea class="form-control bg-light" rows="3" readonly style="resize: none;">{{$hd->productionnotice_dt_remark ?: '-'}}</textarea>
                    </div>                  
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="form-label font-weight-bold">หมายเหตุใบเปิดงาน</label>
                        <textarea class="form-control bg-light" rows="3" readonly style="resize: none;">{{$hd->productionopenjob_hd_remark ?: '-'}}</textarea>
                    </div>
                </div>
            </div>
            <hr> 

            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="font-weight-bold text-dark mb-2"><i class="fas fa-list-ol me-1"></i> รายละเอียดการสั่งงาน</h5>
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 60px;">#</th>
                                <th style="width: 120px;">วันที่ต้องการ</th>
                                <th style="width: 140px;">แผนก</th>
                                <th>สินค้า</th>
                                <th style="width: 130px;">จำนวน / หน่วย</th>
                                <th style="min-width: 250px;">รายละเอียดคำสั่งพิมพ์</th>
                                <th class="text-end" style="width: 150px;">ประมาณการต้นทุน</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dt as $item)
                                <tr>
                                    <td class="text-center">{{$item->productionopenjob_dt_listno}}</td>
                                    <td>{{$item->duedate}}</td>
                                    <td>{{$item->ms_department_name}}</td>
                                    <td>{{$item->ms_product_name}}</td>
                                    <td>{{$item->ms_product_qty}} / {{$item->ms_product_unit}}</td>
                                    <td style="white-space: normal; word-break: break-word;">
                                        {{$item->productionopenjob_dt_remark ?: '-'}}
                                    </td>
                                    <td class="text-end text-success font-weight-bold">{{number_format($item->estimatecost,2)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light font-weight-bold">
                            <tr>
                                <td colspan="6" class="text-end">Total</td>
                                <td class="text-end text-primary" style="font-size: 1.05rem;">{{number_format($total,2)}}</td>                                
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>
            <hr> 

            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="font-weight-bold text-dark mb-2"><i class="fas fa-puzzle-piece me-1"></i> รายละเอียดเสริม (Optional)</h5>
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>สินค้า</th>
                                <th style="width: 140px;">จำนวน / หน่วย</th>
                                <th style="min-width: 200px;">รายละเอียด</th>
                                <th style="min-width: 200px;">รายละเอียดไฟฟ้า</th>
                                <th style="min-width: 200px;">รายละเอียด Software</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($op as $item)
                                <tr>
                                    <td class="font-weight-bold text-secondary">{{$item->productionnotice_op_name}} <small class="text-muted">({{$item->productionnotice_op_code}})</small></td>
                                    <td>{{$item->productionnotice_op_qty}} / {{$item->productionnotice_op_unit}}</td>
                                    <td style="white-space: normal; word-break: break-word;">{{$item->productionnotice_op_remark ?: '-'}}</td>
                                    <td style="white-space: normal; word-break: break-word;">{{$item->productionnotice_op_elect ?: '-'}}</td>
                                    <td style="white-space: normal; word-break: break-word;">{{$item->productionnotice_op_software ?: '-'}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <hr>  

            <div class="row">
                 <div class="col-12">
                    <h5 class="font-weight-bold text-dark mb-2"><i class="fas fa-history me-1"></i> เวอร์ชั่นประวัติเอกสาร (Log History)</h5>
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>วันที่แก้ไข</th>
                                    <th>ผู้แก้ไข</th>
                                    <th>เลขที่งาน</th>
                                    <th>วันที่เริ่ม - จบ</th>
                                    <th>ลูกค้า</th>
                                    <th>สินค้า</th>
                                    <th>Spec Page</th>
                                    <th class="text-end">ประมาณการต้นทุน</th>
                                    <th class="text-center" style="width: 60px;">ดู</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($loghd as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->update_log)->format('d/m/Y H:i') }}</td>
                                    <td>{{ $item->person_log }}</td>
                                    <td class="text-primary font-weight-bold">{{ $item->productionopenjob_hd_docuno}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->productionopenjob_hd_startdate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($item->productionopenjob_hd_enddate)->format('d/m/Y') }}</td>
                                    <td>{{ $item->ms_customer_name }}</td>
                                    <td>{{ $item->ms_product_name}} / {{$item->ms_product_qty}}</td>
                                    <td>{{ $item->ms_specpage_name ?: '-' }}</td>
                                    <td class="text-end text-success">{{number_format($item->productionopenjob_estimatecost,2)}}</td>
                                     <td class="text-center">
                                        <a href="javascript:void(0)" 
                                            class="btn btn-outline-primary btn-sm rounded-circle" 
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
        </form>
    </div>
    </div>
</div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-dark"><i class="fas fa-info-circle me-1"></i> รายละเอียดประวัติเวอร์ชันเอกสาร</h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close" style="border:none; background:none; font-size:1.5rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">              
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                        <tr>
                            <th style="width: 100px;">สถานะ</th>
                            <th style="width: 120px;">แผนก</th>
                            <th class="text-center" style="width: 50px;">ลำดับ</th>
                            <th style="width: 110px;">วันที่ต้องการ</th>                                    
                            <th>ชื่อสินค้า</th>  
                            <th style="width: 90px;">หน่วยนับ</th>     
                            <th style="width: 80px;">จำนวน</th>      
                            <th style="min-width: 250px;">รายละเอียด</th>       
                            <th class="text-end" style="width: 140px;">ประมาณการต้นทุน</th>                                    
                        </tr>
                        </thead>
                        <tbody id="tb_list">
                        </tbody>
                    </table>
                </div>
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
            // ปรับจุดตรวจสอบค่าว่าง (Null) ให้แสดงผลเสมอกัน และใส่ Fallback เป็นเครื่องหมาย ขีด (-)
            let remark = item.productionopenjob_dt_remark ? item.productionopenjob_dt_remark : '-';
            let deptName = item.ms_department_name ? item.ms_department_name : '-';
            let statusName = item.productionopenjob_status_name ? item.productionopenjob_status_name : '-';
            let prodName = item.ms_product_name ? item.ms_product_name : '-';
            let prodUnit = item.ms_product_unit ? item.ms_product_unit : '-';
            let prodQty = item.ms_product_qty ? item.ms_product_qty : '0';
            let cost = item.estimatecost ? parseFloat(item.estimatecost).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}) : '0.00';
            let dueDate = item.duedate ? item.duedate : '-';

            // จัดเรียงสไตล์ CSS ตัดคำอัตโนมัติภายในโครงสร้าง Modal String ให้สวยงาม
            el_list += `    
              <tr>
                <td><span class="badge bg-secondary p-1">${statusName}</span></td>  
                <td>${deptName}</td>  
                <td class="text-center">${key+1}</td> 
                <td>${dueDate}</td>                
                <td>${prodName}</td>  
                <td>${prodUnit}</td>  
                <td>${prodQty}</td>  
                <td style="white-space: normal; word-break: break-word;">${remark}</td>           
                <td class="text-end text-success font-weight-bold">${cost}</td>            
            </tr>
        `
        })      
        $('#tb_list').html(el_list);
    }
});
}
</script>
@endpush