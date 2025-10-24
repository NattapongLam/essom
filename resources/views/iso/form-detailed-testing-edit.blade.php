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
                <h5>ESSOM CO.,LTD<br>การทดสอบละเอียด<br>DESIGN TEST</h5><p class="text-right">F8300.3<br>09 Jun. 16</p>              
            </div>
            <div class="card-body">
                <form method="POST" class="form-horizontal" action="{{ route('detailed-testing.update',$hd->detailed_testings_id) }}" enctype="multipart/form-data">
                @csrf   
                @method('PUT')               
                <div class="row mt-3">
                    <div class="col-4">
                        <label>1. Product</label>
                        <input class="form-control" type="text" name="detailed_testings_product" value="{{$hd->detailed_testings_product}}" required>
                        <input type="hidden" name="docuref" value="Edit">
                    </div>
                    <div class="col-4">
                        <label>Code</label>
                        <input class="form-control" type="text" name="detailed_testings_code" value="{{$hd->detailed_testings_code}}" required>
                    </div>
                    <div class="col-4">
                        <label>S/N</label>
                        <input class="form-control" type="text" name="detailed_testings_serial" value="{{$hd->detailed_testings_serial}}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <label>2. Tested by</label>
                        <select class="form-control select2" name="tested_by" required>
                            <option value="">กรุณาเลือก</option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ $item->ms_employee_fullname == $hd->tested_by ? 'selected' : '' }}>
                                    {{ $item->ms_employee_code }}/{{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label>Date</label>
                        <input class="form-control" type="date" name="tested_date" value="{{ $hd->tested_date }}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-4">
                        <label>3. Test data per attached (Page)</label>
                        <input class="form-control" type="text" name="detailed_testings_testdata" value="{{$hd->detailed_testings_testdata}}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label>3.1 Data</label>
                        <textarea class="form-control" rows="10" name="detailed_testings_data" required>{{$hd->detailed_testings_data}}</textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        <label for="detailed_testings_file">ไฟล์แนบ(หากมี)</label>
                        <input type="file" class="form-control-file" name="detailed_testings_file" >
                    </div>
                    @if ($hd->detailed_testings_file)
                        <a href="{{asset($hd->detailed_testings_file)}}" target=”_blank”>
                            <i class="fas fa-file"></i>
                        </a> 
                    @endif
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label>3.2 Sample calculations by</label>
                        <select class="form-control select2" name="detailed_testings_sample">
                            <option value="">กรุณาเลือก</option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ $item->ms_employee_fullname == $hd->detailed_testings_sample ? 'selected' : '' }}>
                                    {{ $item->ms_employee_code }}/{{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label>3.2 Graph drawn by</label>
                        <select class="form-control select2" name="detailed_testings_drawn">
                            <option value="">กรุณาเลือก</option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ $item->ms_employee_fullname == $hd->detailed_testings_drawn ? 'selected' : '' }}>
                                    {{ $item->ms_employee_code }}/{{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <label>4. Checked by</label>
                        <input class="form-control" type="text" name="checked_by" readonly>
                    </div>
                    <div class="col-4">
                        <label>Date</label>
                        <input class="form-control" type="date" name="checked_date" readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label>5. Senior Engineer Comments</label>
                        <textarea class="form-control" rows="5" name="detailed_testings_comments" readonly></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <label>Signature</label>
                        <input class="form-control" type="text" name="signature_by" readonly>
                    </div>
                    <div class="col-4">
                        <label>Date</label>
                        <input class="form-control" type="date" name="signature_date" readonly>
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
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "กรุณาเลือก",
        allowClear: true,
        width: '100%' // ให้พอดีกับ form-control
    });
});
</script>
@endpush  