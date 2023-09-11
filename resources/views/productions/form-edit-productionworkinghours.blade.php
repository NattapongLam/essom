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
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('pd-woho.update', $hd->workinghours_hd_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <h3 class="card-title" style="font-weight: bold"><a href="{{route('pd-woho.index')}}">เอกสารบันทึกชั่วโมงการทำงาน</h3></a>
                    </div>
                </div>
                @if ($hd->workinghours_status_id == 3)
                    
                @else
                <div class="col-12 col-md-3">
                    <div class="form-group row">
                        <label for="workinghours_hd_date" class="col-sm-2 col-form-label">วันที่</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="workinghours_hd_date" 
                          id="workinghours_hd_date" class="form-control" value="{{\Carbon\Carbon::parse($hd->workinghours_hd_date)->format('d/m/Y')}}" 
                          autofocus readonly>
                        </div>
                      </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group row">
                        <label for="workinghours_hd_docuno" class="col-sm-2 col-form-label">เลขที่</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="workinghours_hd_docuno" id="workinghours_hd_docuno" class="form-control" value="{{$hd->workinghours_hd_docuno}}"readonly>
                        </div>
                      </div>
                </div>
                <div class="col-12 col-md-3">
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
                        <label for="ms_department_id">แผนก</label>
                        <select class="form-control select2 @error('ms_department_id') is-invalid @enderror" style="width: 100%;" name="ms_department_id" id="ms_department_id">
                            <option value="">กรุณาเลือก</option>
                            @foreach ($dep as $item)
                            <option value="{{$item->ms_department_id}}"
                                {{ old('ms_department_id', $hd->ms_department_id) == $item->ms_department_id ? 'selected' : null }}>
                                {{$item->ms_department_name}}</option>
                            @endforeach
                        </select>
                            @error('ms_department_id')
                            <div id="ms_department_id_validation" class="invalid-feedback">
                              {{$message}}
                            </div>
                            @enderror
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="productionopenjob_dt_id">เลขที่เปิดงาน</label>
                        <select class="form-control select2 @error('productionopenjob_dt_id') is-invalid @enderror" style="width: 100%;" id="productionopenjob_dt_id" name="productionopenjob_dt_id">
                        <option value="">กรุณาเลือกเลขที่เปิดงาน</option>
                        @foreach ($jobdoc as $jobdoc)
                            <option value="{{ $jobdoc->productionopenjob_dt_id }}"
                                {{ old('productionopenjob_dt_id', $hd->productionopenjob_dt_id) == $jobdoc->productionopenjob_dt_id ? 'selected' : null }}>
                                {{ $jobdoc->productionopenjob_hd_docuno }} {{ $jobdoc->ms_product_name }} {{ $jobdoc->ms_customer_name }}</option>
                        @endforeach
                        </select>
                        @error('productionopenjob_dt_id')
                            <div id="productionopenjob_dt_id_docuno_validation" class="invalid-feedback">
                              {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="other_hours">ชั่วโมงอื่นๆ</label>
                        <input class="form-control" name="other_hours" id="other_hours" type="text" value="{{old('other_hours',number_format($hd->other_hours,2))}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                <div class="form-group">
                    <label for="workinghours_hd_remark">หมายเหตุ</label>
                    <input class="form-control" name="workinghours_hd_remark" id="workinghours_hd_remark" type="text" value="{{old('workinghours_hd_remark',$hd->workinghours_hd_remark)}}">
                </div>
                </div>
            </div>
            <div class="row">             
                <div class="col-12">
                <div class="table-responsive">
                <table class="table table-bordered">
                <thead>
                    <tr style="background-color:#F5F5F5">
                        <th class="text-center">ลำดับ</th>
                        <th class="text-center">รหัสพนักงาน</th>
                        <th class="text-center">ชื่อ - นามสกุล</th>   
                        <th class="text-center">จำนวนชั่วโมง</th>                    
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dt as $item)
                    <tr style="background-color:#F8F8FF">
                        <td class="text-center">
                            {{$item->workinghours_dt_listno}}
                            <input type="hidden" value="{{$item->workinghours_dt_id}}" name="dt_id[]">
                        </td>
                        <td class="text-center">{{$item->ms_employee_code}}</td>
                        <td class="text-center">{{$item->ms_employee_fullname}}</td>
                        <td class="text-center">
                            <input type="text" class="form-control" name="dt_qty[]" value="{{number_format($item->workinghours_dt_hours,2)}}">
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
@endsection
@push('scriptjs')
<script src="{{ asset('/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush