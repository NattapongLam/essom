@extends('layouts.main')
@section('content')

<!-- Essential Plugins Assets Component -->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* Modern Indigo Theme Workspace Core Framework */
    .custom-container {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .form-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    /* Elegant Structural Header Design */
    .card-header-modern {
        background-color: #ffffff;
        padding: 2rem 2.5rem 1.5rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-title-block h5 {
        font-size: 1.05rem;
        letter-spacing: 0.5px;
        color: #64748b;
        font-weight: 500;
        margin: 0;
        line-height: 1.5;
    }

    .header-title-block h2 {
        font-weight: 700;
        color: #1e293b;
        margin-top: 6px;
        margin-bottom: 0;
        font-size: 1.4rem;
        line-height: 1.4;
    }

    .doc-number-badge {
        position: absolute;
        top: 2rem;
        right: 2.5rem;
        text-align: right;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 0.78rem;
        color: #64748b;
        line-height: 1.4;
    }

    /* Premium Dynamic Form Controller Styling */
    .form-group-custom {
        margin-bottom: 1.25rem;
    }

    .form-group-custom label {
        font-weight: 600;
        color: #475569;
        font-size: 0.88rem;
        margin-bottom: 6px;
        display: block;
    }

    .form-control-modern {
        display: block;
        width: 100%;
        padding: 10px 14px;
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.5;
        color: #1e293b;
        background-color: #ffffff;
        background-clip: padding-box;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control-modern:focus {
        color: #1e293b;
        background-color: #ffffff;
        border-color: #818cf8;
        outline: 0;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12);
    }

    .form-control-modern[readonly] {
        background-color: #f8fafc;
        color: #64748b;
        border-color: #e2e8f0;
    }

    /* Form File Input Architecture Overrides */
    .file-input-modern {
        padding: 7px 12px;
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 10px;
        width: 100%;
        cursor: pointer;
    }

    /* Select2 Dropdown Custom Enhancements */
    .select2-container--default .select2-selection--single {
        background-color: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 10px !important;
        height: 44px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #1e293b !important;
        line-height: 42px !important;
        padding-left: 14px !important;
        font-size: 0.9rem;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 42px !important;
        right: 10px !important;
    }

    /* Core Action Primary Trigger */
    .btn-indigo-submit {
        background-color: #4f46e5;
        color: #ffffff;
        font-weight: 600;
        padding: 12px 24px;
        border-radius: 10px;
        border: none;
        width: 100%;
        letter-spacing: 0.5px;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .btn-indigo-submit:hover {
        background-color: #3730a3;
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3);
        transform: translateY(-1px);
    }

    @media (max-width: 992px) {
        .doc-number-badge { position: relative; top: 0; right: 0; text-align: left; display: inline-block; margin-top: 15px; }
        .card-header-modern { padding: 1.5rem; }
    }
</style>

<div class="container-fluid custom-container">
    <div class="card form-card">
        
        <!-- Document Card Header Section -->
        <div class="card-header-modern">
            <div class="header-title-block text-center">
                <h5>ESSOM CO., LTD.</h5>
                <h2>ใบคำขอดำเนินการด้านเอกสาร Documents Action Request</h2>
            </div>
            <div class="doc-number-badge">
                <strong>F7530.3</strong><br>
                <span class="text-muted">27 Aug 25</span>
            </div>
        </div>

        <!-- Form Workspace Layout Area -->
        <div class="card-body" style="padding: 2.5rem;">
            <form method="POST" action="{{ route('document-correction.store') }}" enctype="multipart/form-data">
                @csrf         
                
                <!-- Section Group Row 1 -->
                <div class="row">
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>ประเภท</label>
                        <select class="form-control-modern" name="documentcorrections_type" required>
                            <option value="ขอออกเอกสารใหม่">ขอออกเอกสารใหม่</option>
                            <option value="ขอแก้ไขเอกสาร">ขอแก้ไขเอกสาร</option>
                            <option value="ขอยกเลิกเอกสาร">ขอยกเลิกเอกสาร</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>DAR No.</label>
                        <input class="form-control-modern" type="text" name="documentcorrections_docuno" required>
                    </div>
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>Date</label>
                        <input class="form-control-modern" type="date" value="{{ old('date', now()->format('Y-m-d')) }}" name="documentcorrections_date" required>
                    </div>
                </div>

                <!-- Section Group Row 2 -->
                <div class="row">                   
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>To</label>
                        <input class="form-control-modern" type="text" name="documentcorrections_to" required>
                    </div>
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>From</label>
                        <input class="form-control-modern" type="text" name="documentcorrections_from" required>
                    </div>
                    <div class="col-md-4 col-12 form-group-custom">
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

                <!-- Section Group Row 3 -->
                <div class="row">   
                    <div class="col-md-3 col-12 form-group-custom">
                        <label>Document Name</label>
                        <input type="text" class="form-control-modern position-input" name="documentcorrections_name" required>
                    </div>
                    <div class="col-md-3 col-12 form-group-custom">
                        <label for="documentcorrections_file">เอกสารงานพิมพ์ต้นฉบับ</label>
                        <input type="file" class="file-input-modern" name="documentcorrections_file">
                    </div> 
                    <div class="col-md-3 col-12 form-group-custom">
                        <label for="documentcorrections_file1">เอกสารอื่นๆที่ใช้อ้างอิง (หากมี)</label>
                        <input type="file" class="file-input-modern" name="documentcorrections_file1">
                    </div> 
                    <div class="col-md-3 col-12 form-group-custom">
                        <label>ลิงก์เอกสารเดิม</label>
                        <input type="text" class="form-control-modern position-input" name="documentcorrections_link">
                    </div>
                </div>

                <!-- Section Group Row 4 -->
                <div class="row">
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>Form Rev</label>
                        <input class="form-control-modern" type="text" name="documentcorrections_torev">
                    </div>
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>To Rev</label>
                        <input class="form-control-modern" type="text" name="documentcorrections_fromrev">
                    </div>
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>Effective Date</label>
                        <input class="form-control-modern" type="date" value="{{ old('date', now()->format('Y-m-d')) }}" name="documentcorrections_effectivedate" required>
                    </div>
                </div>

                <!-- Section Group Row 5 (Description Textareas) -->
                <div class="row">
                    <div class="col-md-6 col-12 form-group-custom">
                        <label>Previous Details</label>
                        <textarea class="form-control-modern" rows="6" name="documentcorrections_previous" style="resize: vertical;"></textarea>
                    </div> 
                    <div class="col-md-6 col-12 form-group-custom">
                        <label>Details for Revision</label>
                        <textarea class="form-control-modern" rows="6" name="documentcorrections_revision" style="resize: vertical;"></textarea>
                    </div>  
                </div> 

                <!-- Section Group Row 6 -->
                <div class="row">
                    <div class="col-12 form-group-custom">
                        <label>เหตุผลในการดำเนินการ</label>
                        <textarea class="form-control-modern" rows="3" name="documentcorrections_note" style="resize: vertical;"></textarea>
                    </div> 
                </div> 

                <!-- Section Group Row 7 -->
                <div class="row">
                    <div class="col-md-6 col-12 form-group-custom">
                        <label>Requested By</label>
                        <input class="form-control-modern" type="text" value="{{auth()->user()->name}}" name="requested_by" readonly>
                    </div>
                    <div class="col-md-6 col-12 form-group-custom">
                        <label>Date</label>
                        <input class="form-control-modern" type="date" value="{{ old('date', now()->format('Y-m-d')) }}" name="requested_date" required>
                    </div>
                </div> 

                <!-- Section Group Row 8 -->
                <div class="row">
                    <div class="col-12 form-group-custom">
                        <label>Audit Check List Revision</label>
                        <input class="form-control-modern" type="text" name="documentcorrections_auditcheck" readonly>
                    </div>
                </div>

                <!-- Section Group Row 9 -->
                <div class="row">
                    <div class="col-md-6 col-12 form-group-custom">
                        <label>Reviewed By ผู้ช่วยผู้จัดการ/ผู้จัดการ/รองกรรมการผู้จัดการ</label>                       
                        <select class="form-control receiver-select" name="reviewed_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 col-12 form-group-custom">
                        <label>Date</label>
                        <input class="form-control-modern" type="date" name="reviewed_date" readonly>
                    </div>
                </div> 

                <!-- Section Group Row 10 -->
                <div class="row">
                    <div class="col-12 form-group-custom">
                        <label>Deputy Managing Directors/Managing Directors Comment</label>
                        <input class="form-control-modern" type="text" name="reviewed_comment" readonly>
                    </div>
                </div>

                <!-- Section Group Row 11 -->
                <div class="row">
                    <div class="col-md-6 col-12 form-group-custom">
                        <label>Approved By</label>
                        <select class="form-control receiver-select" name="approved_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 col-12 form-group-custom">
                        <label>Date</label>
                        <input class="form-control-modern" type="date" name="approved_date" readonly>
                    </div>
                </div>

                <!-- Submission Structural Layout Area -->
                <div class="row mt-4">
                    <div class="col-md-2 col-12">
                        <button type="submit" class="btn-indigo-submit">
                            <i class="fas fa-save mr-1"></i> บันทึกข้อมูล
                        </button>
                    </div>
                </div>
            </form> 
        </div>
    </div>
</div>

@endsection

@push('scriptjs')
<!-- Functional Plugin Logic Core Engine Extensions -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function () {
    // Initialize standard Select2 structures
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือก',
        allowClear: true,
        width: '100%'
    });

    // Populate document identification metadata fields upon selection
    $(document).on('select2:select', '.receiver-select', function (e) {
        const jobName = $(this).find(':selected').data('job') || '';
        $(this).closest('.card-body').find('.position-input').val(jobName);
    });

    // Reset targeted metadata buffers when dropdown state becomes voided
    $(document).on('select2:clear', '.receiver-select', function (e) {
        $(this).closest('.card-body').find('.position-input').val('');
    });
});
</script>
@endpush