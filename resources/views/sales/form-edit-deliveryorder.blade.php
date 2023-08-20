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
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('del-order.update', $hd->deliveryorder_hd_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <h3 class="card-title" style="font-weight: bold"><a href="{{route('del-order.index')}}">ใบนำส่งสินค้า</a>/เอกสารนำส่งสินค้า</h3>
                    </div>
                </div>
                <div class="col-12 col-md-6">
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
                        <input type="date" class="form-control" value="{{$hd->deliveryorder_hd_date}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="workorder_hd_date">เลขที่ใบนำส่งสินค้า</label>
                        <input type="text" class="form-control" value="{{$hd->deliveryorder_hd_docuno}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="workorder_hd_date">เลขที่อ้างอิง</label>
                        <input type="text" class="form-control" value="{{$hd->productionnotice_hd_docuno}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="workorder_hd_date">กำหนดส่ง</label>
                        <input type="date" class="form-control" value="{{$hd->deliveryorder_hd_duedate}}" readonly>
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="workorder_hd_date">ลูกค้า</label>
                        <input type="text" class="form-control" value="{{$hd->ms_customer_name}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="workorder_hd_date">สถานที่จัดส่ง</label>
                        <input type="text" class="form-control" value="{{$hd->ms_customer_delivery}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="workorder_hd_date">ติดต่อ</label>
                        <input type="text" class="form-control" value="{{$hd->ms_customer_contactn}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="workorder_hd_date">Spec Page</label>
                        <input type="text" class="form-control" value="{{$hd->ms_specpage_name}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="form-group">
                        <label for="workorder_hd_date">หมายเหตุ</label>
                        <input type="text" class="form-control" value="{{$hd->deliveryorder_hd_note}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="checked_date">วันที่ตรวจสอบ</label>
                        <input type="date" class="form-control" value="" name="checked_date" id="checked_date">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="checked_by">ผู้ตรวจสอบ</label>
                        <select class="form-control select2" style="width: 100%;" name="checked_by" id="checked_by">
                            <option selected="selected">กรุณาเลือก</option>
                            @foreach ($emp as $item)
                            <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_code}}/{{$item->ms_employee_fullname}}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="delivery_date">วันที่จัดส่ง</label>
                        <input type="date" class="form-control" value="" name="delivery_date" id="delivery_date">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="delivery_by">ผู้จัดส่ง</label>
                        <select class="form-control select2" style="width: 100%;" name="delivery_by" id="delivery_by">
                            <option selected="selected">กรุณาเลือก</option>
                            @foreach ($emp as $item)
                            <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_code}}/{{$item->ms_employee_fullname}}</option>
                            @endforeach
                          </select>
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
                                <th>S/N MODEL</th>
                                <th>Description</th>  
                                <th>Qty.</th>                                  
                                <th>Del. Chk.</th>    
                                <th>Rec. Chk.</th>  
                                <th>Part No./Note</th>   
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dt as $item)
                                <tr>
                                    <td>{{$item->deliveryorder_dt_model}}</td>
                                    <td>{{$item->deliveryorder_dt_desp}}</td>
                                    <td>{{number_format($item->deliveryorder_dt_qty,2)}}</td>
                                    <td>
                                        @if ($item->del_checked == true)
                                        <input type="checkbox" id="checkboxPrimary1" name="deliveryorder_dt_id[]" value="{{$item->deliveryorder_dt_id}}" checked>
                                        @else
                                        <input type="checkbox" id="checkboxPrimary1" name="deliveryorder_dt_id[]" value="{{$item->deliveryorder_dt_id}}">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->rec_checked == true)
                                        <input type="checkbox" id="checkboxPrimary1" name="rec_checked[]" value="{{$item->rec_checked}}" checked>
                                        @else
                                        <input type="checkbox" id="checkboxPrimary1" name="rec_checked[]" value="{{$item->rec_checked}}">
                                        @endif
                                    </td>
                                    <td>{{$item->deliveryorder_dt_remark}}</td>                                  
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
@endsection
@push('scriptjs')
    <script src="{{ asset('/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(function () {
          $('.select2').select2()
        })
    </script>
@endpush           

            