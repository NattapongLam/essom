@extends('layouts.main')
@section('content')
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
                <h5>ESSOM CO.,LTD<br>ใบคำขอดำเนินการด้านเอกสาร Documents Action Request</h5>
                <p class="text-right">F7530.3<br>27 Aug 25</p>                   
            </div>
            <div class="card-body">    
                <form method="POST" class="form-horizontal" action="{{ route('document-correction.store') }}" enctype="multipart/form-data">
                @csrf         
                <div class="row mt-3">
                    <div class="col-4">
                        <label>ประเภท</label>
                        <select class="form-control" name="documentcorrections_type" required>
                            <option value="ขอออกเอกสารใหม่">ขอออกเอกสารใหม่</option>
                            <option value="ขอแก้ไขเอกสาร">ขอแก้ไขเอกสาร</option>
                            <option value="ขอยกเลิกเอกสาร">ขอยกเลิกเอกสาร</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label>DAR No.</label>
                        <input class="form-control" type="text" name="documentcorrections_docuno" required>
                    </div>
                    <div class="col-4">
                        <label>Date</label>
                        <input class="form-control" type="date" value="{{ old('date', now()->format('Y-m-d')) }}" name="documentcorrections_date" required>
                    </div>
                </div>
                <div class="row mt-3">                   
                    <div class="col-4">
                        <label>To</label>
                        <input class="form-control" type="text" name="documentcorrections_to" required>
                    </div>
                    <div class="col-4">
                        <label>From</label>
                        <input class="form-control" type="text" name="documentcorrections_from" required>
                    </div>
                    <div class="col-4">
                        <label>Document No</label>
                        <select class="form-control receiver-select" name="documentregisters_id">
                            <option value="">กรุณาเลือก</option>
                            @foreach ($hd as $item)
                                <option value="{{ $item->documentregisters_id }}" data-job="{{ $item->documentregisters_remark }}">
                                    {{ $item->documentregisters_docuno }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">   
                    <div class="col-6">
                        <label>Document Name</label>
                        <input type="text" class="form-control form-control position-input" name="documentcorrections_name" required>
                    </div>
                    <div class="col-3">
                        <label for="documentcorrections_file">เอกสารงานพิมพ์ต้นฉบับ</label>
                        <input type="file" class="form-control-file" name="documentcorrections_file" >
                    </div> 
                    <div class="col-3">
                        <label for="documentcorrections_file">เอกสารอื่นๆที่ใช้อ้างอิง (หากมี)</label>
                        <input type="file" class="form-control-file" name="documentcorrections_file1" >
                    </div> 
                </div>
                <div class="row mt-3">
                    <div class="col-4">
                        <label>Form Rev</label>
                         <input class="form-control" type="text" name="documentcorrections_torev">
                    </div>
                    <div class="col-4">
                        <label>To Rev</label>
                        <input class="form-control" type="text" name="documentcorrections_fromrev">
                    </div>
                    <div class="col-4">
                        <label>Effective date</label>
                        <input class="form-control" type="date" value="{{ old('date', now()->format('Y-m-d')) }}" name="documentcorrections_effectivedate" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label>Previous Details</label>
                        <textarea class="form-control" rows="10" name="documentcorrections_previous"></textarea>
                    </div> 
                    <div class="col-6">
                        <label>Details for Revision</label>
                        <textarea class="form-control" rows="10" name="documentcorrections_revision"></textarea>
                    </div>  
                </div> 
                <div class="row mt-3">
                    <div class="col-12">
                        <label>เหตุผลในการดำเนินการ</label>
                        <textarea class="form-control" name="documentcorrections_note"></textarea>
                    </div> 
                </div> 
                <div class="row mt-3">
                    <div class="col-6">
                        <label>Requested By</label>
                        <input class="form-control" type="text" value="{{auth()->user()->name}}" name="requested_by" readonly>
                    </div>
                    <div class="col-6">
                        <label>Date</label>
                        <input class="form-control" type="date" value="{{ old('date', now()->format('Y-m-d')) }}" name="requested_date" required>
                    </div>
                </div> 
                <div class="row mt-3">
                    <div class="col-12">
                        <label>Audit Check List Revision</label>
                        <input class="form-control" type="text" name="documentcorrections_auditcheck" readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label>Reviewed By ผู้ช่วยผู้จัดการ/ผู้จัดการ/รองกรรมการผู้จัดการ</label>                      
                        {{-- <input class="form-control" type="text" name="reviewed_by" readonly> --}}
                        <select class="form-control receiver-select" name="reviewed_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label>Date</label>
                        <input class="form-control" type="date" name="reviewed_date" readonly>
                    </div>
                </div> 
                <div class="row mt-3">
                    <div class="col-12">
                        <label>Deputy Mannaging Directors/Mannaging Directors Comment</label>
                        <input class="form-control" type="text" name="reviewed_comment" readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label>Approved By</label>
                        <select class="form-control receiver-select" name="approved_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                            @endforeach
                        </select>
                        {{-- <input class="form-control" type="text" name="approved_by" readonly> --}}
                    </div>
                    <div class="col-6">
                        <label>Date</label>
                        <input class="form-control" type="date" name="approved_date" readonly>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function () {
    // init select2
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือก',
        allowClear: true,
        width: '100%'
    });

    // เมื่อเลือก Document No ให้เติม Document Name
    $(document).on('select2:select', '.receiver-select', function (e) {
        const jobName = $(this).find(':selected').data('job') || '';
        $(this).closest('.card-body').find('.position-input').val(jobName);
    });

    // ถ้าล้างค่า select ให้ล้าง Document Name ด้วย
    $(document).on('select2:clear', '.receiver-select', function (e) {
        $(this).closest('.card-body').find('.position-input').val('');
    });
});
</script>
@endpush
