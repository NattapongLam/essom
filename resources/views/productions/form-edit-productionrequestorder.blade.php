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
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('pd-requ.update', $hd->requestorder_hd_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <h3 class="card-title" style="font-weight: bold"><a href="{{route('pd-requ.index')}}">ใบขอซื้อ</a>/เอกสารขอซื้อ</h3>
                    </div>
                </div>
                @if ($hd->requestorder_status_id == 3 || $hd->requestorder_status_id == 4 || $hd->requestorder_status_id == 5)                    
                @elseif($hd->requestorder_status_id == 1)
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <select class="form-control" name="requestorder_status_id" id="requestorder_status_id" required autofocus>
                            <option value="">กรุณาเลือกสถานะ</option>
                            @foreach ($sta as $item)
                            <option value="{{$item->requestorder_status_id}}">{{$item->requestorder_status_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="ระบุหมายเหตุ" name="note" id="note">
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            อนุมัติ
                         </button>
                    </div>
                </div>
                @endif               
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="requestorder_hd_date">วันที่</label>
                        <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($hd->requestorder_hd_date)->format('d/m/Y')}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="requestorder_hd_docuno">เลขที่ใบขอซื้อ</label>
                        <input type="text" class="form-control" value="{{$hd->requestorder_hd_docuno}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="productionopenjob_hd_docuno">เลขที่ใบเปิดงาน</label>
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
                        <label for="created_person">ผู้ขอซื้อ</label>
                        <input type="text" class="form-control" value="{{$hd->created_person}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="form-group">
                        <label for="requestorder_hd_note">หมายเหตุ</label>
                        <input type="text" class="form-control" value="{{$hd->requestorder_hd_note}}" readonly>
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
                                <td>วันที่ต้องการ</td>
                                <td>ลำดับ</td>
                                <td>สินค้า</td>
                                <td>จำนวน</td>
                                <td>ราคาต่อหน่วย</td>
                                <td>รายละเอียด</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dt as $item)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($item->requestorder_dt_duedate)->format('d/m/Y')}}</td>
                                    <td>{{$item->requestorder_dt_listno}}</td>
                                    <td>{{$item->ms_product_code}}/{{$item->ms_product_name}}</td>
                                    <td>{{number_format($item->ms_product_qty,2)}}/{{$item->ms_product_unit}}</td>
                                    <td>{{number_format($item->ms_product_price,2)}}</td>
                                    <td>{{$item->requestorder_dt_remark}}</td>
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
@endpush