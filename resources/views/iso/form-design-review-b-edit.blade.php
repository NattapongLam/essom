@extends('layouts.main')
@section('content')

<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Modern Indigo Theme Styles */
    .custom-card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.08) !important;
        background: #ffffff;
        overflow: hidden;
    }
    
    .custom-card-header {
        background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%) !important;
        color: #ffffff !important;
        padding: 1.5rem !important;
        border-bottom: none !important;
    }

    .custom-card-header h5 {
        color: #ffffff !important;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .doc-meta {
        font-size: 0.85rem;
        opacity: 0.85;
    }

    /* Form Label & Input Design */
    .form-group-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #312e81;
        padding-bottom: 6px;
        border-bottom: 2px solid #e0e7ff;
        margin-bottom: 1.5rem;
    }

    .form-label-custom {
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
        display: block;
    }

    .form-control-modern {
        border: 1px solid #cbd5e1;
        border-radius: 8px !important;
        padding: 0.6rem 0.8rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background-color: #f8fafc;
        color: #334155;
    }

    .form-control-modern:focus {
        background-color: #ffffff;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
    }

    .form-control-modern[readonly] {
        background-color: #f1f5f9;
        color: #64748b;
        cursor: not-allowed;
    }

    /* Select2 Custom Styling Overrides */
    .select2-container--default .select2-selection--single {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        height: calc(1.5em + 1.2rem + 2px) !important;
        padding: 0.5rem 0.8rem !important;
        background-color: #f8fafc !important;
        transition: all 0.2s ease;
    }

    .select2-container--default .select2-selection--single:focus,
    .select2-container--default.select2-container--open .select2-selection--single {
        border-color: #6366f1 !important;
        background-color: #ffffff !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15) !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #334155 !important;
        padding-left: 0 !important;
        line-height: 1.5 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100% !important;
        top: 0 !important;
        right: 10px !important;
    }

    /* Custom Dividers */
    .modern-hr {
        border-top: 1px dashed #cbd5e1;
        margin: 2rem 0;
        opacity: 0.7;
    }

    /* Action Buttons */
    .btn-indigo-submit {
        background-color: #4f46e5;
        color: #ffffff;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.7rem 2rem;
        transition: all 0.2s ease;
        border: none;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .btn-indigo-submit:hover {
        background-color: #4338ca;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3);
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <!-- Header -->
                <div class="custom-card-header d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div class="text-center text-md-left">
                        <h5 class="mb-0">ESSOM CO., LTD</h5>
                        <div class="doc-meta opacity-75">แก้ไขการทบทวนการออกแบบ / EDIT DESIGN VERIFICATION</div>
                    </div>
                    <div class="text-center text-md-right">
                        <span class="badge bg-white text-dark font-weight-bold px-2 py-1 mb-1">F8300.2B</span>
                        <div class="doc-meta">19 Jan. 22</div>
                    </div>             
                </div>

                <!-- Card Body -->
                <div class="card-body p-4 p-md-5">   
                    <form method="POST" class="form-horizontal" action="{{ route('design-review-b.update',$hd->design_review_b_id) }}" enctype="multipart/form-data">
                        @csrf    
                        @method('PUT')
                        
                        <!-- Section 1 -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="form-group-title">
                                    <i class="fas fa-edit me-2 text-indigo"></i> 1. Design Review Reference
                                </div>
                                <input type="hidden" name="docuref" value="Edit">
                                <label class="form-label-custom">เลือกเอกสารอ้างอิง (Product / Model)</label>
                                <select class="form-control form-control-modern receiver-select" name="design_review_a_hd_id" required>
                                    <option value="">กรุณาเลือกเอกสาร</option>
                                    @foreach ($list as $item)
                                        <option value="{{$item->design_review_a_hd_id}}" 
                                            {{ $item->design_review_a_hd_id == $hd->design_review_a_hd_id ? 'selected' : '' }}>
                                            {{$item->design_review_a_hd_product}} / Model: {{$item->design_review_a_hd_model}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>              
                        
                        <!-- Section 2 -->
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="form-group-title">
                                    <i class="fas fa-microscope me-2 text-indigo"></i> 2. Design Verification Process
                                </div>
                                <span class="badge bg-indigo-subtle text-indigo px-3 py-2 rounded-2 font-weight-bold mb-3" style="font-size: 0.9rem;">
                                    2.1 Comparison Design Input and Output
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom text-danger">Design Input *</label>
                                <textarea class="form-control form-control-modern" rows="8" name="design_review_b_input" placeholder="กรอกข้อมูลข้อมูลนำเข้าการออกแบบ..." required>{{$hd->design_review_b_input}}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom text-success">Design Output *</label>
                                <textarea class="form-control form-control-modern" rows="8" name="design_review_b_output" placeholder="กรอกข้อมูลผลลัพธ์การออกแบบ..." required>{{$hd->design_review_b_output}}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-2">
                                <label class="form-label-custom">Remark (หมายเหตุ)</label>
                                <textarea class="form-control form-control-modern" rows="4" name="design_review_b_remark" placeholder="ระบุหมายเหตุเพิ่มเติม (ถ้ามี)">{{$hd->design_review_b_remark}}</textarea>
                            </div>
                        </div>

                        <hr class="modern-hr">

                        <div class="row">
                            <div class="col-12 mb-4">
                                <label class="form-label-custom" style="font-size: 0.95rem; color: #312e81; font-weight: 700;">2.2 Comments</label>
                                <textarea class="form-control form-control-modern" rows="4" name="design_review_b_comment" placeholder="กรอกความคิดเห็นหรือข้อเสนอแนะเพิ่มเติม...">{{$hd->design_review_b_comment}}</textarea>
                            </div>
                        </div>

                        <!-- Workflow Signatures Section -->
                        <div class="row p-3 mb-4 mx-0 rounded-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                            
                            <!-- Reported By -->
                            <div class="col-md-9 mb-3">
                                <label class="form-label-custom">Reported By (ผู้บันทึกระบบ)</label>
                                <input class="form-control form-control-modern" type="text" name="reported_by" value="{{$hd->reported_by}}" readonly>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label-custom">Date</label>
                                <input class="form-control form-control-modern" type="date" name="reported_date" value="{{$hd->reported_date}}">
                            </div>

                            <!-- Reviewed By -->
                            <div class="col-md-9 mb-3">
                                <label class="form-label-custom text-indigo">Reviewed By (ผู้ทบทวน)</label>
                                <select class="form-control receiver-select" name="reviewed_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}"
                                            {{ isset($hd->reviewed_by) &&  $hd->reviewed_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                            {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label-custom text-muted">Date</label>
                                <input class="form-control form-control-modern" type="date" name="reviewed_date" readonly placeholder="ดึงอัตโนมัติเมื่ออนุมัติ">
                            </div>

                            <!-- Engineering Supervisor -->
                            <div class="col-md-9 mb-3">
                                <label class="form-label-custom text-indigo">Engineering Supervisor (ผู้อนุมัติ)</label>
                                 <select class="form-control receiver-select" name="engineecing_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}"
                                            {{ isset($hd->engineecing_by) &&  $hd->engineecing_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                            {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label-custom text-muted">Date</label>
                                <input class="form-control form-control-modern" type="date" name="engineecing_date" readonly placeholder="ดึงอัตโนมัติเมื่ออนุมัติ">
                            </div>
                        </div> 

                        <!-- Submit Button -->
                        <div class="row mt-4">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-indigo-submit w-100 w-md-auto">
                                    <i class="fas fa-save me-2"></i> บันทึกการอัปเดตข้อมูลเอกสาร
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
    // init select2 
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน...',
        width: '100%',
        allowClear: true
    });
});
</script>
@endpush