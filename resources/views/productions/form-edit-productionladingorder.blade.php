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
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('pd-ladi.update', $hd->ladingorder_hd_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <h3 class="card-title" style="font-weight: bold"><a href="{{route('pd-ladi.index')}}">ใบเบิกวัสดุอุปกรณ์</a>/เอกสารเบิกวัสดุอุปกรณ์</h3>
                    </div>
                </div>
                {{-- <div class="col-12 col-md-2">
                    <div class="form-group">
                        <select class="form-control" name="ladingorder_status_id" id="ladingorder_status_id">
                            <option value="0">กรุณาเลือกสถานะ</option>
                            @foreach ($sta as $item)
                            <option value="{{$item->ladingorder_status_id}}">{{$item->ladingorder_status_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="col-12 col-md-5">
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
                        <input type="date" class="form-control" value="{{$hd->ladingorder_hd_date}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="workorder_hd_docuno">เลขที่ใบเบิกวัสดุอุปกรณ์</label>
                        <input type="text" class="form-control" value="{{$hd->ladingorder_hd_docuno}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="workorder_hd_docuno">เลขที่ใบเปิดงาน</label>
                        <input type="text" class="form-control" value="{{$hd->productionopenjob_hd_docuno}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="workorder_hd_docuno">แผนก</label>
                        <input type="text" class="form-control" value="{{$hd->ms_department_name}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="workorder_hd_docuno">ผู้เบิก</label>
                    <input type="text" class="form-control" value="{{$hd->created_person}}" readonly>
                </div>
                <div class="col-12 col-md-9">
                    <label for="workorder_hd_docuno">หมายเหตุ</label>
                    <input type="text" class="form-control" value="{{$hd->ladingorder_hd_note}}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="workorder_hd_docuno">ผู้อนุมัติ</label>
                    <input type="text" class="form-control" value="{{$hd->approved_by}}" readonly>
                </div>
                <div class="col-12 col-md-9">
                    <label for="workorder_hd_docuno">หมายเหตุอนุมัติ</label>
                    <input type="text" class="form-control" value="{{$hd->approved_note}}" readonly>
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
                                <td>เลือก</td>
                                <td>ลำดับ</td>
                                <td>สินค้า</td>
                                <td>จำนวน</td>
                                <td>ราคาต่อหน่วย</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dt as $item)
                                <tr>
                                    <td>
                                        @if ($item->approvedcheck == true)
                                        <input type="checkbox" id="checkboxPrimary1" name="ladingorder_dt_id[]" value="{{$item->ladingorder_dt_id}}" checked disabled>
                                        @else
                                        <input type="checkbox" id="checkboxPrimary1" name="ladingorder_dt_id[]" value="{{$item->ladingorder_dt_id}}">
                                        @endif
                                        
                                    </td>
                                    <td>{{$item->ladingorder_dt_listno}}</td>
                                    <td>{{$item->ms_product_code}}/{{$item->ms_product_name}}</td>
                                    <td>{{number_format($item->ms_product_qty,2)}}/{{$item->ms_product_unit}}</td>
                                    <td>{{number_format($item->ms_product_price,2)}}</td>
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