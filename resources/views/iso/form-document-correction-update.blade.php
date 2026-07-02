@extends('layouts.main')
@section('content')

<!-- Third-Party Component Stylesheets -->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* Global Core Design System Setup */
    .custom-container {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }

    .form-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(79, 70, 229, 0.06);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    /* Elegant Structural Header Architecture */
    .card-header-modern {
        background-color: #ffffff;
        padding: 2.25rem 2.5rem 1.75rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-title-block h5 {
        font-size: 1rem;
        letter-spacing: 0.5px;
        color: #64748b;
        font-weight: 500;
        margin: 0;
        line-height: 1.5;
    }

    .header-title-block h2 {
        font-weight: 700;
        color: #1e293b;
        margin-top: 4px;
        margin-bottom: 0;
        font-size: 1.45rem;
        line-height: 1.4;
    }

    .doc-number-badge {
        position: absolute;
        top: 2.25rem;
        right: 2.5rem;
        text-align: right;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        color: #475569;
        line-height: 1.4;
    }

    /* Premium Form Architecture elements */
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

    /* Subdued Styling for Immutably Locked Form Controls */
    .form-control-modern[readonly],
    .form-control-modern[disabled] {
        background-color: #f8fafc;
        color: #64748b;
        border-color: #e2e8f0;
        opacity: 1;
        cursor: not-allowed;
    }

    /* Select2 Dropdown Component Enhancements */
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

    .select2-container--default.select2-container--disabled .select2-selection--single {
        background-color: #f8fafc !important;
        border-color: #e2e8f0 !important;
    }

    .select2-container--default.select2-container--disabled .select2-selection--single .select2-selection__rendered {
        color: #64748b !important;
    }

    /* Sectional Segmentation Anchors */
    .section-divider {
        position: relative;
        margin: 2rem 0 1.5rem 0;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .section-divider h4 {
        font-size: 0.95rem;
        font-weight: 700;
        color: #4f46e5;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0;
    }

    /* Master Action Buttons */
    .btn-indigo-submit {
        background-color: #4f46e5;
        color: #ffffff;
        font-weight: 600;
        padding: 11px 24px;
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
        
        <!-- Application Branding Header Block -->
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

        <!-- Master Interactive Working Form Space Area -->
        <div class="card-body" style="padding: 2.5rem;">
            <form method="POST" action="{{ route('document-correction.update', $doc->documentcorrections_id) }}" enctype="multipart/form-data">
                @csrf   
                @method('PUT')    
                <input type="hidden" name="checkdoc" value="Update">      
                
                <!-- Section Breakout: General Metadata Document Influx -->
                <div class="section-divider" style="margin-top: 0;">
                    <h4><i class="fas fa-file-alt mr-2"></i> ข้อมูลเอกสารเบื้องต้น (Document Metadata)</h4>
                </div>

                <div class="row">
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>ประเภท</label>
                        <select class="form-control-modern" name="documentcorrections_type" disabled>
                            @if ($doc->documentcorrections_type == "ขอออกเอกสารใหม่")
                                <option value="ขอออกเอกสารใหม่">ขอออกเอกสารใหม่</option>
                                <option value="ขอแก้ไขเอกสาร">ขอแก้ไขเอกสาร</option>
                                <option value="ขอยกเลิกเอกสาร">ขอยกเลิกเอกสาร</option>
                            @elseif($doc->documentcorrections_type == "ขอแก้ไขเอกสาร")                                
                                <option value="ขอแก้ไขเอกสาร">ขอแก้ไขเอกสาร</option>
                                <option value="ขอยกเลิกเอกสาร">ขอยกเลิกเอกสาร</option>
                                <option value="ขอออกเอกสารใหม่">ขอออกเอกสารใหม่</option>
                            @else                                    
                                <option value="ขอยกเลิกเอกสาร">ขอยกเลิกเอกสาร</option>
                                <option value="ขอออกเอกสารใหม่">ขอออกเอกสารใหม่</option>
                                <option value="ขอแก้ไขเอกสาร">ขอแก้ไขเอกสาร</option>
                            @endif                          
                        </select>
                    </div>
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>DAR No.</label>
                        <input class="form-control-modern" type="text" name="documentcorrections_docuno" value="{{$doc->documentcorrections_docuno}}" readonly>
                    </div>
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>Date</label>
                        <input class="form-control-modern" type="date" value="{{ $doc->documentcorrections_date }}" name="documentcorrections_date" readonly>
                    </div>
                </div>

                <div class="row">                   
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>To</label>
                        <input class="form-control-modern" type="text" name="documentcorrections_to" value="{{$doc->documentcorrections_to}}" readonly>
                    </div>
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>From</label>
                        <input class="form-control-modern" type="text" name="documentcorrections_from" value="{{$doc->documentcorrections_from}}" readonly>
                    </div>
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>Document No</label>
                        <select class="form-control receiver-select" name="documentregisters_id" disabled>
                            <option value="">กรุณาเลือก</option>
                            @foreach ($hd as $item)
                                <option value="{{ $item->documentregisters_id }}" 
                                    data-job="{{ $item->documentregisters_remark }}"
                                    {{ $item->documentregisters_id == $doc->documentregisters_id ? 'selected' : '' }}>
                                    {{ $item->documentregisters_docuno }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">   
                    <div class="col-12 form-group-custom">
                        <label>Document Name</label>
                        <input type="text" class="form-control-modern position-input" name="documentcorrections_name" value="{{$doc->documentcorrections_name}}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>Form Rev</label>
                        <input class="form-control-modern" type="text" name="documentcorrections_torev" value="{{$doc->documentcorrections_torev}}" readonly>
                    </div>
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>To Rev</label>
                        <input class="form-control-modern" type="text" name="documentcorrections_fromrev" value="{{$doc->documentcorrections_fromrev}}" readonly>
                    </div>
                    <div class="col-md-4 col-12 form-group-custom">
                        <label>Effective Date</label>
                        <input class="form-control-modern" type="date" value="{{ $doc->documentcorrections_effectivedate }}" name="documentcorrections_effectivedate" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-12 form-group-custom">
                        <label>Previous Details</label>
                        <textarea class="form-control-modern" rows="6" name="documentcorrections_previous" style="resize: vertical;" readonly>{{$doc->documentcorrections_previous}}</textarea>
                    </div> 
                    <div class="col-md-6 col-12 form-group-custom">
                        <label>Details for Revision</label>
                        <textarea class="form-control-modern" rows="6" name="documentcorrections_revision" style="resize: vertical;" readonly>{{$doc->documentcorrections_revision}}</textarea>
                    </div>  
                </div> 

                <div class="row">
                    <div class="col-12 form-group-custom">
                        <label>เหตุผลในการดำเนินการ</label>
                        <textarea class="form-control-modern" rows="3" name="documentcorrections_note" style="resize: vertical;" readonly>{{$doc->documentcorrections_note}}</textarea>
                    </div> 
                </div> 

                <div class="row">
                    <div class="col-md-6 col-12 form-group-custom">
                        <label>Requested By</label>
                        <input class="form-control-modern" type="text" value="{{$doc->requested_by}}" name="requested_by" readonly>
                    </div>
                    <div class="col-md-6 col-12 form-group-custom">
                        <label>Date</label>
                        <input class="form-control-modern" type="date" value="{{$doc->requested_date}}" name="requested_date" readonly>
                    </div>
                </div>

                <!-- Section Breakout: Conditional Structural Logic Flows -->
                @if ($doc->reviewed_status == "Y")
                    <div class="section-divider">
                        <h4><i class="fas fa-check-double mr-2"></i> การพิจารณาอนุมัติเอกสาร (Approval Section)</h4>
                    </div>

                    <div class="row">
                        <div class="col-12 form-group-custom">
                            <label>Audit Check List Revision</label>
                            <input class="form-control-modern" type="text" name="documentcorrections_auditcheck" value="{{$doc->documentcorrections_auditcheck}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12 form-group-custom">
                            <label>Reviewed By ผู้ช่วยผู้จัดการ/ผู้จัดการ/รองกรรมการผู้จัดการ</label>
                            <input class="form-control-modern" type="text" name="reviewed_by" value="{{$doc->reviewed_by}}" readonly>
                        </div>
                        <div class="col-md-6 col-12 form-group-custom">
                            <label>Date</label>
                            <input class="form-control-modern" type="date" name="reviewed_date" value="{{$doc->reviewed_date}}">
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-12 form-group-custom">
                            <label>Deputy Managing Directors/Managing Directors Comment</label>
                            <input class="form-control-modern" type="text" name="reviewed_comment" value="{{$doc->reviewed_comment}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12 form-group-custom">
                            <label>Approved By</label>
                            <input class="form-control-modern" type="text" name="approved_by" value="{{auth()->user()->name}}" readonly>
                        </div>
                        <div class="col-md-6 col-12 form-group-custom">
                            <label>Date</label>
                            <input class="form-control-modern" type="date" name="approved_date" value="{{ old('date', now()->format('Y-m-d')) }}">
                        </div>
                        <input type="hidden" name="reviewed_status" value="Y">
                        <input type="hidden" name="approved_status" value="Y">
                    </div>
                @else
                    <div class="section-divider">
                        <h4><i class="fas fa-eye mr-2"></i> การพิจารณาตรวจสอบเอกสาร (Review Section)</h4>
                    </div>

                    <div class="row">
                        <div class="col-12 form-group-custom">
                            <label>Audit Check List Revision</label>
                            <input class="form-control-modern" type="text" name="documentcorrections_auditcheck">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12 form-group-custom">
                            <label>Reviewed By ผู้ช่วยผู้จัดการ/ผู้จัดการ/รองกรรมการผู้จัดการ</label>
                            <input class="form-control-modern" type="text" name="reviewed_by" value="{{auth()->user()->name}}" readonly>
                        </div>
                        <div class="col-md-6 col-12 form-group-custom">
                            <label>Date</label>
                            <input class="form-control-modern" type="date" name="reviewed_date" value="{{ old('date', now()->format('Y-m-d')) }}">
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-12 form-group-custom">
                            <label>Deputy Managing Directors/Managing Directors Comment</label>
                            <input class="form-control-modern" type="text" name="reviewed_comment">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12 form-group-custom">
                            <label>Approved By</label>
                            <input class="form-control-modern" type="text" name="approved_by" readonly>
                        </div>
                        <div class="col-md-6 col-12 form-group-custom">
                            <label>Date</label>
                            <input class="form-control-modern" type="date" name="approved_date" readonly>
                        </div>
                        <input type="hidden" name="reviewed_status" value="Y">
                        <input type="hidden" name="approved_status" value="N">
                    </div>
                @endif                     
                
                <!-- Dynamic Conditional Submission Core Control Trigger -->
                @if ($doc->approved_status == "N")
                    <div class="row mt-4">
                        <div class="col-md-2 col-12">
                            <button type="submit" class="btn-indigo-submit">
                                <i class="fas fa-save mr-1"></i> บันทึกการตรวจสอบ
                            </button>
                        </div>
                    </div>
                @endif 
            </form> 
        </div>
    </div>
</div>

@endsection

@push('scriptjs')
<!-- Functional Core Framework Logic Integrations -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function () {
    // Initialize targeted standard Select2 dropdown parameters
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกเอกสาร',
        allowClear: true,
        width: '100%'
    });

    // Populate assigned form parameters based on valid programmatic selection index
    $(document).on('select2:select', '.receiver-select', function (e) {
        const jobName = $(this).find(':selected').data('job') || '';
        $(this).closest('.card-body').find('.position-input').val(jobName);
    });

    // Terminate targeted document metadata values upon selector clearance events
    $(document).on('select2:clear', '.receiver-select', function (e) {
        $(this).closest('.card-body').find('.position-input').val('');
    });
});
</script>
@endpush