@extends('layouts.main')
@section('content')

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
        --border-color: #e2e8f0;
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(99, 102, 241, 0.05);
        background: #ffffff;
        margin-top: 2rem;
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #ffffff 0%, var(--indigo-bg) 100%);
        border-bottom: 1px solid rgba(99, 102, 241, 0.08);
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

    /* Form Layout Elements */
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
        background: linear-gradient(to right, rgba(99, 102, 241, 0.15), transparent);
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
        background-color: #f8fafc;
        color: var(--text-muted);
        border-color: #e2e8f0;
        cursor: not-allowed;
    }

    /* Custom File Input Container */
    .custom-file-upload {
        border: 1px dashed rgba(99, 102, 241, 0.3);
        background-color: var(--indigo-bg);
        border-radius: 10px;
        padding: 0.5rem 1rem;
        display: block;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .custom-file-upload:hover {
        background-color: var(--indigo-light);
        border-color: var(--indigo-primary);
    }

    /* Select2 Overrides */
    .select2-container--default .select2-selection--single {
        border: 1px solid var(--border-color) !important;
        border-radius: 10px !important;
        height: 43px !important;
        padding: 0.5rem 0.75rem !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 24px !important;
        color: var(--text-dark) !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 41px !important;
    }

    /* Workflow Gray Zones */
    .workflow-locked-zone {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem;
    }

    /* Action Buttons */
    .btn-indigo-submit {
        background-color: var(--indigo-primary);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        padding: 0.75rem 2.5rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
    }

    .btn-indigo-submit:hover {
        background-color: var(--indigo-hover);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.25);
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
                            <span class="subtitle-badge"><i class="fas fa-plus-circle mr-2"></i>สร้างคำขอแก้ไขแบบ &bull; DESIGN CHANGE REQUEST</span>
                        </div>
                        <div class="text-center text-md-right">
                            <span class="badge badge-light p-2 border text-muted">F8300.4 / 09 Jun. 16</span>
                        </div>
                    </div>              
                </div>

                <div class="card-body p-4 p-md-5">   
                    <form method="POST" action="{{ route('design-edit.store') }}" enctype="multipart/form-data">
                        @csrf                                      
                        
                        <div class="form-section-title">1. Base Information</div>
                        <div class="row">
                            <div class="col-md-6 col-12 form-group mb-4">
                                <label>Product <span class="text-danger">*</span></label>
                                <input class="form-control form-control-modern" type="text" name="design_edits_product" placeholder="ระบุชื่อผลิตภัณฑ์" required>
                            </div>
                            <div class="col-md-6 col-12 form-group mb-4">
                                <label>Model <span class="text-danger">*</span></label>
                                <input class="form-control form-control-modern" type="text" name="design_edits_model" placeholder="ระบุรุ่น / โมเดล" required>
                            </div>
                        </div>

                        <div class="form-section-title mt-2">2. Detail of Change</div>
                        <div class="row">
                            <div class="col-12 form-group mb-4">
                                <label>2.1 Drawing No. <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-modern" rows="2" name="design_edits_drawing" placeholder="ระบุหมายเลขแบบ หรือรายละเอียด Drawingที่ต้องการเปลี่ยนแปลง" required></textarea>
                            </div>
                            <div class="col-12 form-group mb-4">
                                <label>2.2 Reasons and Details <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-modern" rows="5" name="design_edits_reasons" placeholder="อธิบายเหตุผลและความจำเป็นในการขอแก้ไขแบบอย่างละเอียด..." required></textarea>
                            </div>
                            <div class="col-md-6 col-12 form-group mb-4">
                                <label for="design_edits_file">ไฟล์แนบประกอบ (หากมี)</label>
                                <div class="custom-file-upload">
                                    <input type="file" class="form-control-file" id="design_edits_file" name="design_edits_file">
                                </div>
                            </div>
                        </div>

                        <div class="form-section-title mt-2">3. Request Signatures</div>
                        <div class="row">
                            <div class="col-md-8 col-12 form-group mb-4">
                                <label>Requested By <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="requested_by" required>
                                    <option value="">กรุณาเลือกผู้ส่งคำขอ</option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}">
                                            {{ $item->ms_employee_code }} - {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-12 form-group mb-4">
                                <label>Requested Date <span class="text-danger">*</span></label>
                                <input class="form-control form-control-modern" type="date" name="requested_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-md-8 col-12 form-group mb-4">
                                <label>Supervisor <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="supervisor_by" required>
                                    <option value="">กรุณาเลือกผู้ควบคุมงาน</option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}">
                                            {{ $item->ms_employee_code }} - {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-12 form-group mb-4">
                                <label>Supervisor Date <span class="text-danger">*</span></label>
                                <input class="form-control form-control-modern" type="date" name="supervisor_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                            </div>
                        </div>

                        <div class="form-section-title mt-4 text-muted">4. Future Review Process (Locked)</div>
                        
                        <div class="workflow-locked-zone mb-4">
                            <div class="row">
                                <div class="col-12 form-group mb-3">
                                    <label class="text-muted">4.1 Engineering Section Comments</label>
                                    <textarea class="form-control form-control-modern" rows="2" name="engineeringsection_comments" readonly></textarea>
                                </div>
                                <div class="col-md-8 col-12 form-group mb-4">
                                    <label class="text-muted">Signature</label>
                                    <input class="form-control form-control-modern" type="text" name="engineeringsection_by" readonly>
                                </div>
                                <div class="col-md-4 col-12 form-group mb-4">
                                    <label class="text-muted">Date</label>
                                    <input class="form-control form-control-modern" type="date" name="engineeringsection_date" readonly>
                                </div>
                            </div>
                            <hr class="my-3" style="border-top: 1px dashed #e2e8f0;">

                            <div class="row">
                                <div class="col-12 form-group mb-3">
                                    <label class="text-muted">4.2 Engineer Comments</label>
                                    <textarea class="form-control form-control-modern" rows="2" name="engineer_comments" readonly></textarea>
                                </div>
                                <div class="col-md-8 col-12 form-group mb-4">
                                    <label class="text-muted">Signature</label>
                                    <input class="form-control form-control-modern" type="text" name="engineer_by" readonly>
                                </div>
                                <div class="col-md-4 col-12 form-group mb-4">
                                    <label class="text-muted">Date</label>
                                    <input class="form-control form-control-modern" type="date" name="engineer_date" readonly>
                                </div>
                            </div>
                            <hr class="my-3" style="border-top: 1px dashed #e2e8f0;">

                            <div class="row">
                                <div class="col-12 form-group mb-3">
                                    <label class="text-muted">4.3 Senior Engineer Comments</label>
                                    <textarea class="form-control form-control-modern" rows="2" name="seniorengineer_comments" readonly></textarea>
                                </div>
                                <div class="col-md-8 col-12 form-group mb-2">
                                    <label class="text-muted">Signature</label>
                                    <input class="form-control form-control-modern" type="text" name="seniorengineer_by" readonly>
                                </div>
                                <div class="col-md-4 col-12 form-group mb-2">
                                    <label class="text-muted">Date</label>
                                    <input class="form-control form-control-modern" type="date" name="seniorengineer_date" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-md-right text-center">
                                <button type="submit" class="btn btn-indigo-submit px-5">
                                    <i class="fas fa-save mr-2"></i> บันทึกและส่งคำขอแก้ไข
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
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "กรุณาเลือกรายชื่อ",
        allowClear: true,
        width: '100%'
    });
});
</script>
@endpush