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
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('pd-work.update', $hd->workorder_hd_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">    
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <h3 class="card-title" style="font-weight: bold"><a href="{{route('pd-work.index')}}">เอกสารสั่งงาน</a>/ใบสั่งงาน</h3>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <select class="form-control" name="workorder_status_id" id="workorder_status_id">
                            <option value="0">กรุณาเลือกสถานะ</option>
                            @foreach ($sta as $item)
                            <option value="{{$item->workorder_status_id}}">{{$item->workorder_status_name}}</option>
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
                        <button type="submit" class="btn btn-block btn-primary">
                            บันทึก
                         </button>
                    </div>
                </div>          
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="workorder_hd_date">วันที่</label>
                        <input type="date" class="form-control" value="{{$hd->workorder_hd_date}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="workorder_hd_docuno">เลขที่ใบสั่งงาน</label>
                        <input type="text" class="form-control" value="{{$hd->workorder_hd_docuno}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="productionopenjob_hd_docuno">เลขที่อ้างอิง</label>
                        <input type="text" class="form-control" value="{{$hd->productionopenjob_hd_docuno}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="ms_department_name">แผนก</label>
                        <input type="text" class="form-control" value="{{$hd->ms_department_name}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="engineer_by">วิศวกร</label>
                        <input type="text" class="form-control" value="{{$hd->engineer_by}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="process_group">ประเภทงาน</label>
                        <input type="text" class="form-control" value="{{$hd->process_group}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="productionopenjob_dt_duedate">กำหนดส่ง</label>
                        <input type="date" class="form-control" value="{{$hd->productionopenjob_dt_duedate}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="created_person">ผู้บันทึก</label>
                        <input type="text" class="form-control" value="{{$hd->created_person}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="ms_product_name">สินค้า</label>
                        <input type="text" class="form-control" value="{{$hd->ms_product_name}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="ms_product_name">ผู้จำหน่าย</label>
                        <input type="text" class="form-control" value="{{$hd->vendor_name}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="vendor_date">วันที่เสนอ</label>
                        <input type="date" class="form-control" value="{{$hd->vendor_date}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="vendor_tel">เบอร์ติดต่อ</label>
                        <input type="text" class="form-control" value="{{$hd->vendor_tel}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="workorder_hd_remark">หมายเหตุ</label>
                        <input type="text" class="form-control" value="{{$hd->workorder_hd_remark}}" readonly>
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
                <div class="col-12">
                    <div class="form-group">
                    <label class="form-label">รายละเอียด</label><br>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>รายละเอียด</th>
                                <th>จำนวน</th>
                                <th>ราคาต่อหน่วย</th>
                                <th>ราคารวม</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dt as $item)
                            <tr>
                                <td>{{$item->workorder_dt_listno}}</td>
                                <td>{{$item->workorder_dt_description}}</td>
                                <td>{{$item->workorder_dt_qty}}</td>
                                <td>{{number_format($item->workorder_dt_price,2)}}</td>
                                <td>{{number_format($item->workorder_dt_total,2)}}</td>
                            </tr>
                            @endforeach                          
                        </tbody>
                        <tfoot>
                            <td colspan="4">Total</td>
                            <td>{{number_format($total,2)}}</td>     
                        </tfoot>
                    </table>
                    </div>
                    </div>
                </div>
            </div>
            @if($ck)
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                    <label class="form-label" style="color: red">งานตรวจรับจ้างทำของ</label><br>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-group clearfix">
                                <label class="form-label">ขนาดได้ตามแบบ</label> 
                                @if($ck->size_checked)
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary1" checked>
                                    <label for="checkboxPrimary1">
                                      ผ่าน
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary2">
                                    <label for="checkboxPrimary2">
                                      ไม่ผ่าน
                                    </label>
                                </div>                                 
                                @else
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary1">
                                    <label for="checkboxPrimary1">
                                      ผ่าน
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary2" checked>
                                    <label for="checkboxPrimary2">
                                      ไม่ผ่าน
                                    </label>
                                </div>
                                @endif                                                           
                                <div class="icheck-primary d-inline">
                                    <label for="checkboxPrimary2">{{$ck->size_remark}}</label>    
                                </div>                                                      
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-group clearfix">
                                <label class="form-label">ความเรียบร้อย</label> 
                                @if($ck->tidy_checked)
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary1" checked>
                                    <label for="checkboxPrimary1">
                                      ผ่าน
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary2">
                                    <label for="checkboxPrimary2">
                                      ไม่ผ่าน
                                    </label>
                                </div>                                 
                                @else
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary1">
                                    <label for="checkboxPrimary1">
                                      ผ่าน
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary2" checked>
                                    <label for="checkboxPrimary2">
                                      ไม่ผ่าน
                                    </label>
                                </div>
                                @endif                                                           
                                <div class="icheck-primary d-inline">
                                    <label for="checkboxPrimary2">{{$ck->tidy_remark}}</label>    
                                </div>                                                      
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-group clearfix">
                                <label class="form-label">จำนวนครบ</label> 
                                @if($ck->quantity_checked)
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary1" checked>
                                    <label for="checkboxPrimary1">
                                      ผ่าน
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary2">
                                    <label for="checkboxPrimary2">
                                      ไม่ผ่าน
                                    </label>
                                </div>                                 
                                @else
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary1">
                                    <label for="checkboxPrimary1">
                                      ผ่าน
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary2" checked>
                                    <label for="checkboxPrimary2">
                                      ไม่ผ่าน
                                    </label>
                                </div>
                                @endif                                                           
                                <div class="icheck-primary d-inline">
                                    <label for="checkboxPrimary2">{{$ck->quantity_remark}}</label>    
                                </div>                                                      
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-group clearfix">
                                <label class="form-label">วัสดุที่ใช้ตรงตามแบบ</label> 
                                @if($ck->material_checked)
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary1" checked>
                                    <label for="checkboxPrimary1">
                                      ผ่าน
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary2">
                                    <label for="checkboxPrimary2">
                                      ไม่ผ่าน
                                    </label>
                                </div>                                 
                                @else
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary1">
                                    <label for="checkboxPrimary1">
                                      ผ่าน
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary2" checked>
                                    <label for="checkboxPrimary2">
                                      ไม่ผ่าน
                                    </label>
                                </div>
                                @endif                                                           
                                <div class="icheck-primary d-inline">
                                    <label for="checkboxPrimary2">{{$ck->material_remark}}</label>    
                                </div>                                                      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                    <label class="form-label" style="color: red">งานตรวจรับบริการขนส่ง</label><br>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-group clearfix">
                                <label class="form-label">ตรงเวลา</label> 
                                @if($ck->ontime_checked)
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary1" checked>
                                    <label for="checkboxPrimary1">
                                      ผ่าน
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary2">
                                    <label for="checkboxPrimary2">
                                      ไม่ผ่าน
                                    </label>
                                </div>                                 
                                @else
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary1">
                                    <label for="checkboxPrimary1">
                                      ผ่าน
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary2" checked>
                                    <label for="checkboxPrimary2">
                                      ไม่ผ่าน
                                    </label>
                                </div>
                                @endif                                                           
                                <div class="icheck-primary d-inline">
                                    <label for="checkboxPrimary2">{{$ck->ontime_remark}}</label>    
                                </div>                                                      
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-group clearfix">
                                <label class="form-label">สินค้าขนส่งที่ไม่เสียหาย</label> 
                                @if($ck->intact_checked)
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary1" checked>
                                    <label for="checkboxPrimary1">
                                      ผ่าน
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary2">
                                    <label for="checkboxPrimary2">
                                      ไม่ผ่าน
                                    </label>
                                </div>                                 
                                @else
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary1">
                                    <label for="checkboxPrimary1">
                                      ผ่าน
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary2" checked>
                                    <label for="checkboxPrimary2">
                                      ไม่ผ่าน
                                    </label>
                                </div>
                                @endif                                                           
                                <div class="icheck-primary d-inline">
                                    <label for="checkboxPrimary2">{{$ck->intact_remark}}</label>    
                                </div>                                                      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="icheck-primary d-inline">
                        <label for="checkboxPrimary2">ผู้ตรวจสอบ : {{$ck->checked_by}}</label>    
                    </div>
                    <div class="icheck-primary d-inline">
                        <label for="checkboxPrimary2">วันที่ : {{\Carbon\Carbon::parse($ck->checked_date)->format('d/m/Y')}}</label>    
                    </div>
                    <div class="icheck-primary d-inline">
                        <label for="checkboxPrimary2">หมายเหตุ : {{$ck->checked_note}}</label>    
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="icheck-primary d-inline">
                        <label for="checkboxPrimary2">ผู้อนุมัติ : {{$ck->approved_by}}</label>    
                    </div>
                    <div class="icheck-primary d-inline">
                        <label for="checkboxPrimary2">วันที่ : {{\Carbon\Carbon::parse($ck->approved_date)->format('d/m/Y')}}</label>    
                    </div>
                    <div class="icheck-primary d-inline">
                        <label for="checkboxPrimary2">หมายเหตุ : {{$ck->approved_note}}</label>    
                    </div>
                </div>
            </div>   
            @endif          
        </div>
        </form>
    </div>
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<script src="{{ asset('/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush