@extends('layouts.main')
@section('content')

<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Modern Indigo Theme */
    :root {
        --indigo-main: #6366f1;
        --indigo-hover: #4f46e5;
        --indigo-light: #e0e7ff;
        --indigo-bg: #f8fafc;
        --dark-slate: #0f172a;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.05);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #ffffff 0%, var(--indigo-bg) 100%);
        border-bottom: 1px solid rgba(99, 102, 241, 0.08);
        padding: 1.5rem 2rem;
    }

    .company-name {
        font-weight: 800;
        letter-spacing: 0.5px;
        color: var(--dark-slate);
    }

    .doc-badge {
        background-color: var(--indigo-light);
        color: var(--indigo-hover);
        padding: 0.35rem 1rem;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }

    .section-divider {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--indigo-hover);
        letter-spacing: 0.5px;
        margin-top: 1.75rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
    }

    .section-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(to right, rgba(99, 102, 241, 0.2), transparent);
        margin-left: 1rem;
    }

    .form-group label {
        font-weight: 500;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
    }

    .form-control-modern {
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 0.6rem 1rem;
        height: auto;
        font-size: 0.95rem;
        color: var(--dark-slate);
        transition: all 0.2s ease;
        background-color: #ffffff;
    }

    .form-control-modern:focus {
        border-color: var(--indigo-main);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12);
        outline: none;
    }

    .form-control-modern[readonly] {
        background-color: #f8fafc;
        color: var(--text-muted);
        border-color: #e2e8f0;
        cursor: not-allowed;
    }

    /* File Attachment Link */
    .file-attachment-box {
        display: inline-flex;
        align-items: center;
        background-color: var(--indigo-bg);
        border: 1px solid var(--indigo-light);
        padding: 0.5rem 1.25rem;
        border-radius: 10px;
        color: var(--indigo-hover);
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
    }

    .file-attachment-box:hover {
        background-color: var(--indigo-light);
        color: var(--indigo-hover);
        text-decoration: none;
    }

    /* Select2 Indigo Override */
    .select2-container--default .select2-selection--single {
        border: 1px solid var(--border-color) !important;
        border-radius: 10px !important;
        height: 43px !important;
        padding: 0.5rem 0.75rem !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 24px !important;
        color: var(--dark-slate) !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 41px !important;
    }

    /* Modern Indigo Button */
    .btn-indigo {
        background-color: var(--indigo-main);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        padding: 0.7rem 2rem;
        font-weight: 600;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
    }

    .btn-indigo:hover {
        background-color: var(--indigo-hover);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.25);
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-12">
            <div class="card custom-card">
                
                <!-- Card Header -->
                <div class="card-header custom-card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                            <h4 class="company-name mb-1">ESSOM CO., LTD</h4>
                            <span class="doc-badge">
                                <i class="fas fa-file-alt mr-1"></i> คำขอแก้ไขแบบ / DESIGN CHANGE REQUEST
                            </span>
                        </div>
                        <div class="col-md-6 text-center text-md-right">
                            <span class="text-muted font-weight-bold">F8300.4</span><br>
                            <small class="text-muted">09 Jun. 16</small>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4 p-md-5">
                    <form method="POST" class="form-horizontal" action="{{ route('design-edit.update', $hd->design_edits_id) }}" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')
                        
                        <!-- Section 1: Base Data -->
                        <div class="row">
                            <div class="col-md-6 col-12 form-group mb-4">
                                <label>Product</label>
                                <input class="form-control form-control-modern" type="text" name="design_edits_product" value="{{ $hd->design_edits_product }}" required>
                                <input type="hidden" name="docuref" value="Update">
                            </div>
                            <div class="col-md-6 col-12 form-group mb-4">
                                <label>Model</label>
                                <input class="form-control form-control-modern" type="text" name="design_edits_model" value="{{ $hd->design_edits_model }}" required>
                            </div>
                        </div>

                        <!-- Section 2: Details -->
                        <div class="section-divider">1. Detail of Change</div>
                        
                        <div class="row">
                            <div class="col-12 form-group mb-4">
                                <label>1.1 Drawing No.</label>
                                <textarea class="form-control form-control-modern" rows="2" name="design_edits_drawing" required>{{ $hd->design_edits_drawing }}</textarea>
                            </div>
                            <div class="col-12 form-group mb-4">
                                <label>1.2 Reasons and Details</label>
                                <textarea class="form-control form-control-modern" rows="5" name="design_edits_reasons" required>{{ $hd->design_edits_reasons }}</textarea>
                            </div>
                        </div>

                        @if ($hd->design_edits_file)
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="d-block">Attached File</label>
                                    <a href="{{ asset($hd->design_edits_file) }}" target="_blank" class="file-attachment-box">
                                        <i class="fas fa-file-pdf mr-2 text-danger"></i> เรียกดูเอกสารแนบเดิม
                                    </a>
                                </div>
                            </div>
                        @endif

                        <!-- Section 3: Requesters & Supervisors -->
                        <div class="row">
                            <div class="col-md-9 col-12 form-group mb-4">
                                <label>Requested By</label>
                                <select class="form-control select2" name="requested_by" required>
                                    <option value="">กรุณาเลือก</option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}"
                                            {{ $item->ms_employee_fullname == $hd->requested_by ? 'selected' : '' }}>
                                            {{ $item->ms_employee_code }} / {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-12 form-group mb-4">
                                <label>Date</label>
                                <input class="form-control form-control-modern" type="date" name="requested_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-md-9 col-12 form-group mb-4">
                                <label>Supervisor</label>
                                <select class="form-control select2" name="supervisor_by" required>
                                    <option value="">กรุณาเลือก</option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}"
                                            {{ $item->ms_employee_fullname == $hd->supervisor_by ? 'selected' : '' }}>
                                            {{ $item->ms_employee_code }} / {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-12 form-group mb-4">
                                <label>Date</label>
                                <input class="form-control form-control-modern" type="date" name="supervisor_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                            </div>
                        </div>

                        <!-- Section 4: Engineering Section Approval -->
                        <div class="section-divider">2. Engineering Section Comments</div>
                        @if ($hd->engineeringsection_by)
                            <div class="row">
                                <div class="col-12 form-group mb-4">
                                    <textarea class="form-control form-control-modern" rows="3" name="engineeringsection_comments" readonly>{{ $hd->engineeringsection_comments }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-12 form-group mb-4">
                                    <label>Signature</label>
                                    <input class="form-control form-control-modern" type="text" name="engineeringsection_by" value="{{ $hd->engineeringsection_by }}" readonly>
                                </div>
                                <div class="col-md-3 col-12 form-group mb-4">
                                    <label>Date</label>
                                    <input class="form-control form-control-modern" type="date" name="engineeringsection_date" value="{{ $hd->engineeringsection_date }}" readonly>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-12 form-group mb-4">
                                    <textarea class="form-control form-control-modern" rows="3" name="engineeringsection_comments" placeholder="ระบุความคิดเห็นของแผนกวิศวกรรม..."></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-12 form-group mb-4">
                                    <label>Signature</label>
                                    <input class="form-control form-control-modern" type="text" name="engineeringsection_by" value="{{ auth()->user()->name }}" readonly>
                                </div>
                                <div class="col-md-3 col-12 form-group mb-4">
                                    <label>Date</label>
                                    <input class="form-control form-control-modern" type="date" name="engineeringsection_date" value="{{ old('date', now()->format('Y-m-d')) }}">
                                </div>
                            </div>
                        @endif  

                        <!-- Section 5: Engineer Review -->
                        @if ($hd->engineeringsection_by)
                            <div class="section-divider">3. Engineer Comments</div>
                            @if ($hd->engineer_by)
                                <div class="row">
                                    <div class="col-12 form-group mb-4">
                                        <textarea class="form-control form-control-modern" rows="3" name="engineer_comments" readonly>{{ $hd->engineer_comments }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9 col-12 form-group mb-4">
                                        <label>Signature</label>
                                        <input class="form-control form-control-modern" type="text" name="engineer_by" value="{{ $hd->engineer_by }}" readonly>
                                    </div>
                                    <div class="col-md-3 col-12 form-group mb-4">
                                        <label>Date</label>
                                        <input class="form-control form-control-modern" type="date" name="engineer_date" value="{{ $hd->engineer_date }}" readonly>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-12 form-group mb-4">
                                        <textarea class="form-control form-control-modern" rows="3" name="engineer_comments" placeholder="ระบุความคิดเห็นของวิศวกร..."></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9 col-12 form-group mb-4">
                                        <label>Signature</label>
                                        <input class="form-control form-control-modern" type="text" name="engineer_by" value="{{ auth()->user()->name }}" readonly>
                                    </div>
                                    <div class="col-md-3 col-12 form-group mb-4">
                                        <label>Date</label>
                                        <input class="form-control form-control-modern" type="date" name="engineer_date" value="{{ old('date', now()->format('Y-m-d')) }}">
                                    </div>
                                </div>  
                            @endif                    
                        @endif   

                        <!-- Section 6: Senior Engineer Verification -->
                        @if ($hd->seniorengineer_by)
                            <div class="section-divider">4. Senior Engineer Comments</div>
                            <div class="row">
                                <div class="col-12 form-group mb-4">
                                    <textarea class="form-control form-control-modern" rows="3" name="seniorengineer_comments" readonly>{{ $hd->seniorengineer_comments }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-12 form-group mb-4">
                                    <label>Signature</label>
                                    <input class="form-control form-control-modern" type="text" name="seniorengineer_by" value="{{ $hd->seniorengineer_by }}" readonly>
                                </div>
                                <div class="col-md-3 col-12 form-group mb-4">
                                    <label>Date</label>
                                    <input class="form-control form-control-modern" type="date" name="seniorengineer_date" value="{{ $hd->seniorengineer_date }}" readonly>
                                </div>
                            </div>  
                        @else
                            @if ($hd->engineeringsection_by && $hd->engineer_by)
                                <div class="section-divider">4. Senior Engineer Comments</div>
                                <div class="row">
                                    <div class="col-12 form-group mb-4">
                                        <textarea class="form-control form-control-modern" rows="3" name="seniorengineer_comments" placeholder="ระบุความคิดเห็นของวิศวกรอาวุโส..."></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9 col-12 form-group mb-4">
                                        <label>Signature</label>
                                        <input class="form-control form-control-modern" type="text" name="seniorengineer_by" value="{{ auth()->user()->name }}" readonly>
                                    </div>
                                    <div class="col-md-3 col-12 form-group mb-4">
                                        <label>Date</label>
                                        <input class="form-control form-control-modern" type="date" name="seniorengineer_date" value="{{ old('date', now()->format('Y-m-d')) }}">
                                    </div>
                                </div> 
                            @endif    
                        @endif

                        <!-- Action Button -->
                        <div class="row mt-4">
                            <div class="col-12 text-center text-md-left">
                                <button type="submit" class="btn btn-indigo px-5">
                                    <i class="fas fa-save mr-2"></i> บันทึกข้อมูล
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
        width: '100%'
    });
});
</script>
@endpush