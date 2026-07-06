@extends('layouts.main')
@section('content')

<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Modern Indigo Theme Styles */
    :root {
        --indigo-primary: #6366f1;
        --indigo-hover: #4f46e5;
        --indigo-light: #e0e7ff;
        --indigo-bg: #f8fafc;
        --text-dark: #1e293b;
        --text-muted: #64748b;
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(99, 102, 241, 0.06);
        background: #ffffff;
        margin-top: 2rem;
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #ffffff 0%, var(--indigo-bg) 100%);
        border-bottom: 1px solid rgba(99, 102, 241, 0.1);
        padding: 1.75rem 2rem;
    }

    .company-title {
        font-weight: 800;
        letter-spacing: 0.5px;
        color: var(--text-dark);
    }

    .subtitle-badge {
        background-color: var(--indigo-light);
        color: var(--indigo-hover);
        padding: 0.4rem 1.2rem;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        margin-top: 0.5rem;
    }

    /* Form Section Layout */
    .form-section-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--indigo-hover);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
    }

    .form-section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(to right, rgba(99, 102, 241, 0.2), transparent);
        margin-left: 1rem;
    }

    /* Form Controls Styling */
    .form-group label {
        font-weight: 500;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
    }

    .form-control-modern {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        height: auto;
        font-size: 0.95rem;
        color: var(--text-dark);
        transition: all 0.2s ease-in-out;
        background-color: #ffffff;
    }

    .form-control-modern:focus {
        border-color: var(--indigo-primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12);
        outline: none;
    }

    .form-control-modern[readonly] {
        background-color: #f1f5f9;
        color: var(--text-muted);
        border-color: #e2e8f0;
        cursor: not-allowed;
    }

    /* File Attachment Section */
    .file-upload-wrapper {
        border: 2px dashed #cbd5e1;
        border-radius: 10px;
        padding: 1rem;
        text-align: center;
        background: var(--indigo-bg);
        transition: all 0.2s;
    }

    .btn-view-file {
        display: inline-flex;
        align-items: center;
        background-color: #ffffff;
        color: var(--indigo-primary);
        border: 1px solid rgba(99, 102, 241, 0.3);
        padding: 0.4rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        box-shadow: 0 2px 6px rgba(0,0,0,0.02);
    }

    .btn-view-file:hover {
        background-color: var(--indigo-light);
        color: var(--indigo-hover);
        text-decoration: none;
    }

    /* Select2 Modern Overrides */
    .select2-container--default .select2-selection--single {
        border: 1px solid #e2e8f0 !important;
        border-radius: 10px !important;
        height: 43px !important;
        padding: 0.5rem 0.75rem !important;
        transition: all 0.2s !important;
    }

    .select2-container--default .select2-selection--single:focus,
    .select2-container--default.select2-container--open .select2-selection--single {
        border-color: var(--indigo-primary) !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12) !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 24px !important;
        color: var(--text-dark) !important;
        padding-left: 0 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 41px !important;
    }

    /* Buttons Styling */
    .btn-indigo-submit {
        background-color: var(--indigo-primary);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }

    .btn-indigo-submit:hover {
        background-color: var(--indigo-hover);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.3);
    }
</style>

<div class="container-fluid py-2">
    <div class="row justify-content-center"> 
        <div class="col-xl-10 col-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <div class="text-center text-md-left mb-3 mb-md-0">
                            <h4 class="company-title mb-1">ESSOM CO., LTD</h4>
                            <span class="subtitle-badge"><i class="fas fa-edit mr-2"></i>แก้ไขเอกสาร &bull; DESIGN TEST</span>
                        </div>
                        <div class="text-center text-md-right">
                            <span class="badge badge-light p-2 border text-muted">F8300.3 / 09 Jun. 16</span>
                        </div>
                    </div>             
                </div>
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('detailed-testing.update', $hd->detailed_testings_id) }}" enctype="multipart/form-data">
                        @csrf                 
                        @method('PUT')

                        <!-- SECTION 1: Product Information -->
                        <div class="form-section-title">1. Product Information</div>
                        <div class="row">
                            <div class="col-md-4 col-12 form-group mb-4">
                                <label>Product <span class="text-danger">*</span></label>
                                <input class="form-control form-control-modern" type="text" name="detailed_testings_product" value="{{$hd->detailed_testings_product}}" required>
                                <input type="hidden" name="docuref" value="Edit">
                            </div>
                            <div class="col-md-4 col-12 form-group mb-4">
                                <label>Code <span class="text-danger">*</span></label>
                                <input class="form-control form-control-modern" type="text" name="detailed_testings_code" value="{{$hd->detailed_testings_code}}" required>
                            </div>
                            <div class="col-md-4 col-12 form-group mb-4">
                                <label>S/N (Serial Number)</label>
                                <input class="form-control form-control-modern" type="text" name="detailed_testings_serial" value="{{$hd->detailed_testings_serial}}">
                            </div>
                        </div>

                        <!-- SECTION 2: Tester Details -->
                        <div class="form-section-title mt-2">2. Assignment Details</div>
                        <div class="row">
                            <div class="col-md-8 col-12 form-group mb-4">
                                <label>Tested by <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="tested_by" required>
                                    <option value="">กรุณาเลือกผู้ทดสอบ</option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}"
                                            {{ $item->ms_employee_fullname == $hd->tested_by ? 'selected' : '' }}>
                                            {{ $item->ms_employee_code }} - {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-12 form-group mb-4">
                                <label>Date</label>
                                <input class="form-control form-control-modern" type="date" name="tested_date" value="{{ $hd->tested_date }}">
                            </div>
                        </div>

                        <!-- SECTION 3: Raw Data & File Uploads -->
                        <div class="form-section-title mt-2">3. Testing Data & Calculations</div>
                        <div class="row">
                            <div class="col-md-4 col-12 form-group mb-4">
                                <label>Test data per attached (Page)</label>
                                <input class="form-control form-control-modern" type="text" name="detailed_testings_testdata" value="{{$hd->detailed_testings_testdata}}">
                            </div>
                            <div class="col-12 form-group mb-4">
                                <label>3.1 Data Content <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-modern" rows="8" name="detailed_testings_data" required>{{$hd->detailed_testings_data}}</textarea>
                            </div>
                            <div class="col-md-6 col-12 form-group mb-4">
                                <label>อัปโหลดไฟล์ใหม่ (หากต้องการเปลี่ยน)</label>
                                <div class="file-upload-wrapper d-flex flex-column flex-sm-row align-items-center justify-content-between">
                                    <input type="file" class="form-control-file mb-2 mb-sm-0" name="detailed_testings_file" style="max-width: 250px;">
                                    @if ($hd->detailed_testings_file)
                                        <a href="{{asset($hd->detailed_testings_file)}}" target="_blank" class="btn-view-file">
                                            <i class="fas fa-file-alt mr-2"></i> เปิดไฟล์แนบเดิม
                                        </a> 
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12 form-group mb-4">
                                <label>3.2 Sample calculations by</label>
                                <select class="form-control select2" name="detailed_testings_sample">
                                    <option value="">กรุณาเลือกผู้คำนวณ</option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}"
                                            {{ $item->ms_employee_fullname == $hd->detailed_testings_sample ? 'selected' : '' }}>
                                            {{ $item->ms_employee_code }} - {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-12 form-group mb-4">
                                <label>3.3 Graph drawn by</label>
                                <select class="form-control select2" name="detailed_testings_drawn">
                                    <option value="">กรุณาเลือกผู้เขียนกราฟ</option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}"
                                            {{ $item->ms_employee_fullname == $hd->detailed_testings_drawn ? 'selected' : '' }}>
                                            {{ $item->ms_employee_code }} - {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- SECTION 4: Reviewing & Signatures (Read-only) -->
                        <div class="form-section-title mt-2 text-muted">4. Evaluation & Approvals (Read-Only)</div>
                        <div class="row bg-light p-3 rounded-lg mb-4 mx-0 border">
                            <div class="col-md-8 col-12 form-group mb-3">
                                <label>4.1 Checked by</label>
                                <input class="form-control form-control-modern" type="text" name="checked_by" readonly>
                            </div>
                            <div class="col-md-4 col-12 form-group mb-3">
                                <label>Date</label>
                                <input class="form-control form-control-modern" type="date" name="checked_date" readonly>
                            </div>
                            <div class="col-12 form-group mb-3">
                                <label>5. Senior Engineer Comments</label>
                                <textarea class="form-control form-control-modern" rows="4" name="detailed_testings_comments" readonly></textarea>
                            </div>
                            <div class="col-md-8 col-12 form-group mb-2">
                                <label>Signature (Approver)</label>
                                <input class="form-control form-control-modern" type="text" name="signature_by" readonly>
                            </div>
                            <div class="col-md-4 col-12 form-group mb-2">
                                <label>Date</label>
                                <input class="form-control form-control-modern" type="date" name="signature_date" readonly>
                            </div>
                        </div>

                        <!-- Form Submission -->
                        <div class="row mt-4">
                            <div class="col-12 text-md-right text-center">
                                <button type="submit" class="btn btn-indigo-submit px-5 shadow-sm">
                                    <i class="fas fa-check mr-2"></i> อัปเดตเอกสาร
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