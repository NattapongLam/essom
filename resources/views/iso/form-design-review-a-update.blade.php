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
    }

    .form-control-modern {
        border: 1px solid #cbd5e1;
        border-radius: 8px !important;
        padding: 0.6rem 0.8rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background-color: #f8fafc;
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

    /* Do List Modern Table */
    .modern-table-form {
        border-collapse: separate !important;
        border-spacing: 0 4px !important;
    }

    .modern-table-form thead th {
        background-color: #f1f5f9 !important;
        color: #475569 !important;
        font-weight: 600;
        font-size: 0.85rem;
        border: none !important;
        padding: 10px !important;
    }

    .modern-table-form td {
        background: #f8fafc;
        border-top: 1px solid #e2e8f0 !important;
        border-bottom: 1px solid #e2e8f0 !important;
        border-left: none !important;
        border-right: none !important;
        padding: 10px !important;
        color: #334155;
        font-size: 0.95rem;
    }

    /* Dynamic Action Buttons */
    .btn-indigo-action {
        background-color: #4f46e5;
        color: #ffffff;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        transition: all 0.2s ease;
        border: none;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .btn-indigo-action:hover {
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
                        <div class="doc-meta opacity-75">การทบทวนการออกแบบ / DESIGN REVIEW (อัปเดตสถานะ)</div>
                    </div>
                    <div class="text-center text-md-right mt-2 mt-md-0">
                        <span class="badge bg-white text-dark font-weight-bold px-2 py-1 mb-1">F8300.2A</span>
                        <div class="doc-meta">19 Jan. 22</div>
                    </div>             
                </div>

                <!-- Form Body -->
                <div class="card-body p-4 p-md-5">   
                    <form method="POST" class="form-horizontal" action="{{ route('design-review-a.update', $hd->design_review_a_hd_id) }}" enctype="multipart/form-data">
                        @csrf        
                        
                        <!-- Section 1 -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group-title">
                                    <i class="fas fa-file-signature me-2 text-indigo"></i> 1. Design Review Information
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label-custom">1.1 Product</label>
                                <input class="form-control form-control-modern" type="text" name="design_review_a_hd_product" value="{{$hd->design_review_a_hd_product}}">
                                <input type="hidden" name="docuref" value="Update">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label-custom">Model</label>
                                <input class="form-control form-control-modern" type="text" name="design_review_a_hd_model" value="{{$hd->design_review_a_hd_model}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label-custom">1.2 Participants</label>
                                <textarea class="form-control form-control-modern" name="design_review_a_hd_participants" rows="2">{{$hd->design_review_a_hd_participants}}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label-custom">1.3 Subject</label>
                                <textarea class="form-control form-control-modern" name="design_review_a_hd_subject" rows="2">{{$hd->design_review_a_hd_subject}}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-4">
                                <label class="form-label-custom">1.4 Design Input</label>
                                <textarea class="form-control form-control-modern" name="design_review_a_hd_designinput" rows="2">{{$hd->design_review_a_hd_designinput}}</textarea>
                            </div>
                        </div>

                        <!-- Do List Table Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label-custom mb-2" style="font-size: 1rem;"><i class="fas fa-tasks text-indigo me-1"></i> 1.5 Do List</label>
                                <div class="table-responsive">
                                    <table class="table modern-table-form text-center w-100 mb-0" id="destroyTable">
                                        <thead>
                                            <tr>
                                                <th style="width: 30%">Item</th>
                                                <th style="width: 70%">Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dt as $item)
                                                <tr>
                                                    <td class="text-start font-weight-bold px-3">{{$item->design_review_a_dt_item}}</td>
                                                    <td class="text-start px-3">{{$item->design_review_a_dt_description}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Documents Reference -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">1.6 Drawing (page(s))</label>
                                <input class="form-control form-control-modern" type="text" name="design_review_a_hd_drawing" value="{{$hd->design_review_a_hd_drawing}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">1.7 Reference Documents (page(s))</label>
                                <input class="form-control form-control-modern" type="text" name="design_review_a_hd_reference" value="{{$hd->design_review_a_hd_reference}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-4">
                                <label class="form-label-custom">1.8 Comment</label>
                                <textarea class="form-control form-control-modern" name="design_review_a_hd_comment" rows="2">{{$hd->design_review_a_hd_comment}}</textarea>
                            </div>
                        </div>

                        <!-- Signatures Workflow Section -->
                        <div class="row p-3 mb-4 mx-0 rounded-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                            
                            <!-- Reported By -->
                            <div class="col-md-9 mb-3">
                                <label class="form-label-custom text-dark">Reported By</label>
                                <input class="form-control form-control-modern" type="text" name="reported_by" value="{{$hd->reported_by}}" readonly>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label-custom text-dark">Date</label>
                                <input class="form-control form-control-modern" type="date" name="reported_date" value="{{$hd->reported_date}}" readonly>
                            </div>

                            @if ($hd->reviewed_status == "Y")
                                <!-- Reviewed By (Readonly) -->
                                <div class="col-md-9 mb-3">
                                    <label class="form-label-custom text-dark">Reviewed By <span class="badge bg-success-subtle text-success ms-1">Approved</span></label>
                                    <input class="form-control form-control-modern" type="text" name="reviewed_by" value="{{$hd->reviewed_by}}" readonly>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label-custom text-dark">Date</label>
                                    <input class="form-control form-control-modern" type="date" name="reviewed_date" value="{{ $hd->reviewed_date }}" readonly>
                                </div>
                                    
                                <!-- Engineering Supervisor (Active Input) -->
                                <div class="col-md-9 mb-3">
                                    <label class="form-label-custom text-indigo">Engineering Supervisor (ผู้ตรวจสอบปัจจุบัน)</label>
                                    <input class="form-control form-control-modern style-active-user" type="text" name="engineecing_by" value="{{auth()->user()->name}}" readonly style="border-left: 3px solid #4f46e5 !important;">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label-custom text-indigo">Date</label>
                                    <input class="form-control form-control-modern" type="date" name="engineecing_date" value="{{ old('date', now()->format('Y-m-d')) }}">
                                </div>
                                <input type="hidden" name="reviewed_status" value="Y">
                                <input type="hidden" name="engineecing_status" value="Y">
                            @else
                                <!-- Reviewed By (Active Input) -->
                                <div class="col-md-9 mb-3">
                                    <label class="form-label-custom text-indigo">Reviewed By (ผู้ตรวจสอบปัจจุบัน)</label>
                                    <input class="form-control form-control-modern" type="text" name="reviewed_by" value="{{auth()->user()->name}}" readonly style="border-left: 3px solid #4f46e5 !important;">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label-custom text-indigo">Date</label>
                                    <input class="form-control form-control-modern" type="date" name="reviewed_date" value="{{ old('date', now()->format('Y-m-d')) }}">
                                </div>
                                    
                                <!-- Engineering Supervisor (Pending) -->
                                <div class="col-md-9 mb-3">
                                    <label class="form-label-custom text-muted">Engineering Supervisor</label>
                                    <input class="form-control form-control-modern" type="text" name="engineecing_by" readonly placeholder="รอดำเนินการหลังจากขั้นตอน Reviewed">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label-custom text-muted">Date</label>
                                    <input class="form-control form-control-modern" type="date" name="engineecing_date" readonly>
                                </div>
                                <input type="hidden" name="reviewed_status" value="Y">
                                <input type="hidden" name="engineecing_status" value="N"> 
                            @endif
                        </div> 

                        <!-- Submit Button -->
                        <div class="row mt-4">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-indigo-action px-5 py-2.5 w-100 w-md-auto">
                                    <i class="fas fa-check-circle me-2"></i> บันทึกผลการตรวจสอบเอกสาร
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
@endpush