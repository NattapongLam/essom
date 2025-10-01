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
                        <select class="form-control">
                            <option value="ขอออกเอกสารใหม่">ขอออกเอกสารใหม่</option>
                            <option value="ขอแก้ไขเอกสาร">ขอแก้ไขเอกสาร</option>
                            <option value="ขอยกเลิกเอกสาร">ขอยกเลิกเอกสาร</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label>DAR No.</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-4">
                        <label>Date</label>
                        <input class="form-control" type="date">
                    </div>
                </div>
                <div class="row mt-3">                   
                    <div class="col-4">
                        <label>To</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-4">
                        <label>From</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-4">
                        <label>Document No</label>
                        <select class="form-control receiver-select">
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
                    <div class="col-12">
                        <label>Document Name</label>
                        <input type="text" class="form-control form-control position-input">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-4">
                        <label>Form Rev</label>
                         <input class="form-control" type="text">
                    </div>
                    <div class="col-4">
                        <label>To Rev</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-4">
                        <label>Effective date</label>
                        <input class="form-control" type="date">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label>Previous Details</label>
                        <textarea class="form-control" rows="10"></textarea>
                    </div> 
                    <div class="col-6">
                        <label>Details for Revision</label>
                        <textarea class="form-control" rows="10"></textarea>
                    </div>  
                </div> 
                <div class="row mt-3">
                    <div class="col-12">
                        <label>เหตุผลในการดำเนินการ</label>
                        <textarea class="form-control"></textarea>
                    </div> 
                </div> 
                <div class="row mt-3">
                    <div class="col-6">
                        <label>Requested By</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-6">
                        <label>Date</label>
                        <input class="form-control" type="date">
                    </div>
                </div> 
                <div class="row mt-3">
                    <div class="col-12">
                        <label>Audit Check List Revision</label>
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label>Reviewed By ผู้ช่วยผู้จัดการ/ผู้จัดการ/รองกรรมการผู้จัดการ</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-6">
                        <label>Date</label>
                        <input class="form-control" type="date">
                    </div>
                </div> 
                <div class="row mt-3">
                    <div class="col-12">
                        <label>Deputy Mannaging Directors/Mannaging Directors Comment</label>
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label>Approced By</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-6">
                        <label>Date</label>
                        <input class="form-control" type="date">
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
        placeholder: 'กรุณาเลือกเอกสาร',
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
