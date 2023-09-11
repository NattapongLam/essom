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
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('fl-inst.update', $hd->finalInspection_hd_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <h3 class="card-title" style="font-weight: bold"><a href="{{route('fl-inst.index')}}">เอกสารตรวจสอบขั้นตอนสุดท้าย</a></h3>
                    </div>
                </div>
                @if($hd->finalInspection_status_id == 3)
                    
                @else
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <select class="form-control" name="finalInspection_status_id" id="finalInspection_status_id">
                            <option value="0">กรุณาเลือกสถานะ</option>
                            @foreach ($sta as $item)
                            <option value="{{$item->finalInspection_status_id}}">{{$item->finalInspection_status_name}}</option>
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
                        <label for="finalInspection_hd_date">วันที่</label>
                        <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($hd->finalInspection_hd_date)->format('d/m/Y')}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="finalInspection_hd_docuno">เลขที่เอกสาร</label>
                        <input type="text" class="form-control" value="{{$hd->finalInspection_hd_docuno}}" readonly>
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
                        <label for="serialno">Serial No.</label>
                        <input type="text" class="form-control" value="{{$hd->serialno}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="finalInspection_hd_shipto">Ship to</label>
                        <input type="text" class="form-control" value="{{$hd->finalInspection_hd_shipto}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="finalInspection_hd_dimensions">Shipping dimensions (cm.)</label>
                        <input type="text" class="form-control" value="{{$hd->finalInspection_hd_dimensions}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="finalInspection_hd_weight">Weight (kg.)</label>
                        <input type="text" class="form-control" value="{{$hd->finalInspection_hd_weight}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="ms_finalspec_hd_code">Rev .</label>
                        <input type="text" class="form-control" value="{{$hd->ms_finalspec_hd_code}} {{$hd->ms_finalspec_hd_rev}}" readonly>
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
                        <input type="text" class="form-control" value="{{$hd->ms_product_name}} ({{$hd->ms_product_code}})" readonly>
                    </div>
                </div>              
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="created_person">ผู้บันทึกขั้นที่ 1</label>
                        <input type="text" class="form-control" value="{{$hd->created_person}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="form-group">
                        <label for="finalInspection_hd_note">หมายเหตุ</label>
                        <input type="text" class="form-control" value="{{$hd->finalInspection_hd_note}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="checked_by">ผู้บันทึกขั้นที่ 2</label>
                        <input type="text" class="form-control" value="{{$hd->checked_by}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="form-group">
                        <label for="checked_note">หมายเหตุ</label>
                        <input type="text" class="form-control" value="{{$hd->checked_note}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="approved_by">ผู้อนุมัติ</label>
                        <input type="text" class="form-control" value="{{$hd->approved_by}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="form-group">
                        <label for="approved_note">หมายเหตุ</label>
                        <input type="text" class="form-control" value="{{$hd->approved_note}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">             
                <div class="col-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                      <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">1.การตรวจสอบในกระบวนการผลิต</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">2.การตรวจสอบขั้นสุดท้าย</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-profile1-tab" data-toggle="pill" href="#custom-tabs-four-profile1" role="tab" aria-controls="custom-tabs-four-profile1" aria-selected="false">เอกสารแนบ</a>
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
                                            <th>รายละเอียด</th>
                                            <th>ค่าที่ได้</th>
                                            <th>เช็ค</th>
                                            <th>หมายเหตุ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($dt1 as $item)
                                           <tr>
                                            <td>{{$item->finalInspection_dt1_remark}}</td>
                                            <td>{{$item->finalInspection_dt1_qty}}</td>
                                            <td>{{$item->finalInspection_dt1_checked}}</td>
                                            <td>{{$item->finalInspection_dt1_description}}</td>
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
                                            <th>รายละเอียด</th>
                                            <th>ค่าที่ได้</th>
                                            <th>เช็ค</th>
                                            <th>หมายเหตุ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dt2 as $item)
                                        <tr>
                                            <td>{{$item->finalInspection_dt2_remark}}</td>
                                            <td>{{$item->finalInspection_dt2_qty}}</td>
                                            <td>{{$item->finalInspection_dt2_checked}}</td>
                                            <td>{{$item->finalInspection_dt2_description}}</td>
                                           </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="custom-tabs-four-profile1" role="tabpanel" aria-labelledby="custom-tabs-four-profile1-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">        
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>รายละเอียด</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dt3 as $item)
                                        <tr>
                                            <td>{{$item->finalInspection_part_listno}}</td>
                                            <td>{{$item->finalInspection_part_remark}}</td>
                                            <td>
                                                <a href="{{asset($hd->finalInspection_part_filename)}}" target=”_blank”>
                                                    <i class="fas fa-file-pdf"></i>
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
<script>
</script>
@endpush  