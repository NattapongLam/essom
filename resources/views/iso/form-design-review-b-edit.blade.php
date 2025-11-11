@extends('layouts.main')
@section('content')
{{-- @push('styles') --}}
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
                <h5>ESSOM CO.,LTD<br>การทบทวนการออกแบบ<br>DESIGN VERIFCATION</h5><p class="text-right">F8300.2B<br>19 Jan. 22</p>                            
            </div>
            <div class="card-body">   
                <form method="POST" class="form-horizontal" action="{{ route('design-review-b.update',$hd->design_review_b_id) }}" enctype="multipart/form-data">
                @csrf   
                @method('PUT')     
                <div class="row mt-3">
                    <label>1. Design Review</label><br>
                    <input type="hidden" name="docuref" value="Edit">
                    <select class="form-control" name="design_review_a_hd_id" required>
                        <option value="">กรุณาเลือกเอกสาร</option>
                        @foreach ($list as $item)
                            <option value="{{$item->design_review_a_hd_id}}" 
                                {{ $item->design_review_a_hd_id == $hd->design_review_a_hd_id ? 'selected' : '' }}>
                                {{$item->design_review_a_hd_product}}/{{$item->design_review_a_hd_model}}
                            </option>
                        @endforeach
                    </select>
                </div>              
                <div class="row mt-3">
                    <div class="col-12">
                        <label>2. Design Verification</label><br>
                        <label>2.1 Comparison Design Input and Output</label>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col-6">
                        <label>Design Input</label>
                        <textarea class="form-control" rows="10" name="design_review_b_input" required>{{$hd->design_review_b_input}}</textarea>
                    </div>
                    <div class="col-6">
                        <label>Design Output</label>
                        <textarea class="form-control" rows="10" name="design_review_b_output" required>{{$hd->design_review_b_output}}</textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label>Remark</label>
                        <textarea class="form-control" rows="10" name="design_review_b_remark">{{$hd->design_review_b_remark}}</textarea>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col-12">
                        <label>2.2 Comments</label>
                        <textarea class="form-control" rows="10" name="design_review_b_comment">{{$hd->design_review_b_comment}}</textarea>
                    </div>
                </div>
                   <div class="row mt-3">
                    <div class="col-9">
                        <label>Reported By</label>
                        <input class="form-control" type="text" name="reported_by"  value="{{$hd->reported_by}}" readonly>
                    </div>
                    <div class="col-3">
                        <label>Date</label>
                        <input class="form-control" type="date" name="reported_date" value="{{$hd->reported_date}}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label>Reviewed By</label>
                         <select class="form-control receiver-select" name="reviewed_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ isset($hd->reviewed_by) &&  $hd->reviewed_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                        {{-- <input class="form-control" type="text" name="reviewed_by" readonly> --}}
                    </div>
                    <div class="col-3">
                        <label>Date</label>
                        <input class="form-control" type="date" name="reviewed_date" readonly>
                    </div>
                </div>        
                <div class="row mt-3">
                    <div class="col-9">
                        <label>Engineecing Supervisor</label>
                         <select class="form-control receiver-select" name="engineecing_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ isset($hd->engineecing_by) &&  $hd->engineecing_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                        {{-- <input class="form-control" type="text" name="engineecing_by" readonly> --}}
                    </div>
                    <div class="col-3">
                        <label>Date</label>
                        <input class="form-control" type="date" name="engineecing_date" readonly>
                    </div>
                </div> 
                <br>
                <div class="col-12 col-md-1">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            บันทึก
                         </button>
                    </div>
                </div>
                </form> 
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
$(document).ready(function () {
    // init select2 ให้กับ select ที่โหลดมาตั้งแต่แรก
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });
});
</script>
@endpush  