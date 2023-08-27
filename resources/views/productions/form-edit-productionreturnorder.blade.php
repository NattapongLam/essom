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
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('pd-retu.update', $hd->returnorder_hd_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <h3 class="card-title" style="font-weight: bold"><a href="{{route('pd-retu.index')}}">ใบรับคืนจากการเบิก</a>/เอกสารรับคืนจากการเบิก</h3>
                    </div>
                </div>
                @if ($hd->returnorder_status_id == 3)
                    
                @else
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <select class="form-control" name="returnorder_status_id" id="returnorder_status_id">
                            <option value="0">กรุณาเลือกสถานะ</option>
                            @foreach ($sta as $item)
                            <option value="{{$item->returnorder_status_id}}">{{$item->returnorder_status_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="ระบุหมายเหตุ" name="note" id="note">
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            บันทึก
                         </button>
                    </div>
                </div> 
                @endif                
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="returnorder_hd_date">วันที่</label>
                        <input type="date" class="form-control" value="{{$hd->returnorder_hd_date}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="returnorder_hd_docuno">เลขที่ใบขอซื้อ</label>
                        <input type="text" class="form-control" value="{{$hd->returnorder_hd_docuno}}" readonly>
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
                        <label for="ladingorder_hd_docuno">เลขที่ใบเบิกวัสดุอุปกรณ์</label>
                        <input type="text" class="form-control" value="{{$hd->ladingorder_hd_docuno}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="created_person">ผู้ส่งคืน</label>
                        <input type="text" class="form-control" value="{{$hd->created_person}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="form-group">
                        <label for="returnorder_hd_note">หมายเหตุ</label>
                        <input type="text" class="form-control" value="{{$hd->returnorder_hd_note}}" readonly>
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
                                <td>ลำดับ</td>
                                <td>สินค้า</td>
                                <td>จำนวนเบิก</td>
                                <td>จำนวนส่งคืน</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dt as $item)
                                <tr>
                                    <td>{{$item->returnorder_dt_listno}}</td>
                                    <td>{{$item->ms_product_code}}/{{$item->ms_product_name}}</td>
                                    <td>{{number_format($item->ladingorder_dt_qty,2)}}/{{$item->ms_product_unit}}</td>
                                    <td>{{number_format($item->returnorder_dt_qty,2)}}/{{$item->ms_product_unit}}</td>
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