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
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('pd-noti.update', $hd->productionnotice_hd_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <h3 class="card-title" style="font-weight: bold"><a href="{{route('pd-noti.index')}}">ใบแจ้งผลิต</a>/เอกสารแจ้งผลิต</h3>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <select class="form-control" name="productionnotice_status_id" id="productionnotice_status_id" required autofocus>
                            <option value="">กรุณาเลือกสถานะ</option>
                            @foreach ($sta as $item)
                            <option value="{{$item->productionnotice_status_id}}">{{$item->productionnotice_status_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="ระบุหมายเหตุ" name="approved_note" id="approved_note">
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            บันทึกเอกสาร
                         </button>
                    </div>
                </div>
            </div><hr>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="productionnotice_hd_date">วันที่</label>
                        <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($hd->productionnotice_hd_date)->format('d/m/Y')}}" readonly>
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
                        <label for="productionnotice_hd_duedate">กำหนดส่ง</label>
                        <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($hd->productionnotice_hd_duedate)->format('d/m/Y')}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="ms_specpage_name">Spec Page</label>
                        <input type="text" class="form-control" value="{{$hd->ms_specpage_name}}" readonly>
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
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="ms_product_name">จำนวน</label>
                        <input type="text" class="form-control" value="{{$hd->product_qty}} / {{$hd->ms_productunit_name}}" readonly>
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
                        <label for="ms_customer_name">ลูกค้า</label>
                        <input type="text" class="form-control" value="{{$hd->ms_customer_name}}" readonly>
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
                @if ($hd->productionnotice_hd_filename1)
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="productionnotice_hd_filename1">เอกสารแนบ</label>
                        <a href="{{asset($hd->productionnotice_hd_filename1)}}" target=”_blank”>
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>
                </div>
                @endif
                @if ($hd->productionnotice_hd_filename2)
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="productionnotice_hd_filename2">เอกสารแนบ</label>
                        <a href="{{asset($hd->productionnotice_hd_filename2)}}" target=”_blank”>
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>
                </div>
                @endif                           
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="form-group">
                        <label for="productionnotice_hd_remark">รายละเอียด</label>
                        <textarea type="text" class="form-control" readonly>{{$hd->productionnotice_hd_remark}}</textarea>
                    </div>
                </div>
            </div><hr>
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
                                        <th>กำหนดส่ง</th>
                                        <th>สินค้า</th>
                                        <th>จำนวน</th>
                                        <th>รายละเอียด</th>
                                        <th>Spec Page</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dt as $item)
                                        <tr>
                                            <td>{{$item->productionnotice_dt_listno}}</td>
                                            <td>{{\Carbon\Carbon::parse($item->productionnotice_dt_duedate)->format('d/m/Y')}}</td>
                                            <td>{{$item->ms_product_seminame}}</td>
                                            <td>{{$item->ms_product_semiqty}} / {{$item->ms_product_semiunit}}</td>
                                            <td>{{$item->productionnotice_dt_remark}}</td>
                                            <td>
                                                <a href="{{asset($item->filename)}}" target=”_blank”> {{$item->ms_specpage_name}}</a>
                                               
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
                                            <td>{{$item->productionnotice_op_name}}</td>
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
        </div>
        </form>
        <div wire:loading wire:target="save" wire:loading.class="overlay" wire:loading.flex>
            <div class="d-flex justify-content-center align-items-center">
                <i class="fas fa-2x fa-sync fa-spin"></i>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<script src="{{ asset('/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush