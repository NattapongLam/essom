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
        margin-top: 2rem;
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

    /* Modern File Link Buttons */
    .file-badge-link {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1.25rem;
        background-color: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        color: var(--dark-slate);
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(0,0,0,0.02);
    }

    .file-badge-link:hover {
        border-color: var(--indigo-main);
        color: var(--indigo-main);
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.08);
    }

    /* Modern Table Inside Form */
    .table-modern-form {
        border: none;
    }

    .table-modern-form thead th {
        background-color: var(--indigo-bg);
        color: #475569;
        font-weight: 600;
        font-size: 0.85rem;
        border: 1px solid var(--border-color);
        padding: 14px 10px;
        vertical-align: middle;
    }

    .table-modern-form tbody td {
        padding: 14px 10px;
        vertical-align: middle;
        border: 1px solid var(--border-color);
        color: var(--dark-slate);
        font-size: 0.95rem;
    }

    /* Buttons Modern Indigo Styling */
    .btn-indigo {
        background-color: var(--indigo-main);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        padding: 0.7rem 2.5rem;
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
        <div class="col-xl-11 col-12">
            <div class="card custom-card">
                
                <!-- Card Header -->
                <div class="card-header custom-card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                            <h4 class="company-name mb-1">ESSOM CO., LTD</h4>
                            <span class="doc-badge">
                                <i class="fas fa-user-check mr-1"></i> ทบทวนและอนุมัติแผนคุณภาพเฉพาะผลิตภัณฑ์
                            </span>
                        </div>
                        <div class="col-md-6 text-center text-md-right">
                            <span class="text-muted font-weight-bold">F8510.1</span><br>
                            <small class="text-muted">4 Nov. 24</small>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4 p-md-5">
                    <form method="POST" class="form-horizontal" action="{{ route('quality-plan.update', $hd->quality_plan_hd_id) }}" enctype="multipart/form-data">
                        @csrf        
                        @method('PUT')     
                        <input type="hidden" name="checkdoc" value="Update">   

                        <!-- Section 1: Header Information -->
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_docno">Doc. No</label>
                                <input class="form-control form-control-modern" name="quality_plan_hd_docno" value="{{ $hd->quality_plan_hd_docno }}" readonly>
                            </div> 
                            <div class="col-md-3 col-sm-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_revno">Rev. No</label>
                                <input class="form-control form-control-modern" name="quality_plan_hd_revno" value="{{ $hd->quality_plan_hd_revno }}" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_effecdate">Effec Date</label>
                                <input class="form-control form-control-modern" name="quality_plan_hd_effecdate" value="{{ $hd->quality_plan_hd_effecdate }}" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_page">Page</label>
                                <input class="form-control form-control-modern" name="quality_plan_hd_page" value="{{ $hd->quality_plan_hd_page }}" readonly>
                            </div>      
                        </div>

                        <!-- Attachments Row -->
                        <div class="row mb-2">
                            @if ($hd->quality_plan_hd_file)
                            <div class="col-md-6 col-12 mb-3">
                                <label class="d-block text-muted small font-weight-bold">ไฟล์แนบเอกสาร</label>
                                <a href="{{ asset($hd->quality_plan_hd_file) }}" target="_blank" class="file-badge-link">
                                    <i class="fas fa-file-pdf text-danger mr-2 fa-lg"></i> เปิดดูไฟล์แนบโครงการ
                                </a>
                            </div>
                            @endif

                            @if ($hd->quality_plan_hd_link)
                            <div class="col-md-6 col-12 mb-3">
                                <label class="d-block text-muted small font-weight-bold">ลิงก์อ้างอิงภายนอก</label>
                                <a href="{{ $hd->quality_plan_hd_link }}" target="_blank" class="file-badge-link">
                                    <i class="fas fa-link text-primary mr-2 fa-md"></i> เปิดลิงก์เชื่อมโยงข้อมูล
                                </a>
                            </div>
                            @endif
                        </div>

                        <!-- Section 2: Quality Plan Details Table -->
                        <div class="section-divider">รายละเอียดแผนคุณภาพ</div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-modern-form" id="destroyTable">
                                <thead>
                                    <tr>
                                        <th style="width: 10%" class="text-center">ลำดับที่<br>No.</th>
                                        <th style="width: 40%">รายละเอียด<br>Description</th>
                                        <th style="width: 20%">เครื่องมือ เครื่องวัด<br>Tools</th>
                                        <th style="width: 15%">ผู้ปฏิบัติ<br>By</th>
                                        <th style="width: 15%">อ้างอิง<br>Reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dt as $item)
                                        <tr>
                                            <td class="text-center font-weight-bold text-muted">{{ $item->quality_plan_dt_listno }}</td>
                                            <td>{{ $item->quality_plan_dt_description }}</td>
                                            <td>{{ $item->quality_plan_dt_tool ?? '-' }}</td>
                                            <td>{{ $item->quality_plan_dt_by ?? '-' }}</td>
                                            <td>{{ $item->quality_plan_dt_reference ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Section 3: Workflow Signatures -->
                        <div class="section-divider">การลงนามตรวจสอบและอนุมัติ</div>

                        <!-- Requested By Row -->
                        <div class="row">
                            <div class="col-md-9 col-12 form-group mb-4">
                                <label for="requested_by">จัดทำโดย</label>
                                <input class="form-control form-control-modern" name="requested_by" value="{{ $hd->requested_by }}" readonly>
                            </div>
                            <div class="col-md-3 col-12 form-group mb-4">
                                <label for="requested_date">วันที่</label>
                                <input class="form-control form-control-modern" type="date" name="requested_date" value="{{ $hd->requested_date }}" readonly>
                            </div>
                        </div>   

                        @if ($hd->reviewed_status == "Y")
                            <!-- Case: Reviewed Done -> Waiting for Approve -->
                            <div class="row">
                                <div class="col-md-9 col-12 form-group mb-4">
                                    <label for="reviewed_by">ทบทวนโดย</label>
                                    <input class="form-control form-control-modern" name="reviewed_by" value="{{ $hd->reviewed_by }}" readonly>
                                </div>
                                <div class="col-md-3 col-12 form-group mb-4">
                                    <label for="reviewed_date">วันที่</label>
                                    <input class="form-control form-control-modern" type="date" name="reviewed_date" value="{{ $hd->reviewed_date }}" readonly>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-9 col-12 form-group mb-4">
                                    <label for="approved_by">อนุมัติโดย</label>
                                    <input class="form-control form-control-modern" name="approved_by" value="{{ auth()->user()->name }}" readonly>
                                </div>
                                <div class="col-md-3 col-12 form-group mb-4">
                                    <label for="approved_date">วันที่</label>
                                    <input class="form-control form-control-modern" type="date" name="approved_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                                </div>
                                <input type="hidden" name="reviewed_status" value="Y">
                                <input type="hidden" name="approved_status" value="Y">
                            </div>
                        @else
                            <!-- Case: Waiting for Review -->
                            <div class="row">
                                <div class="col-md-9 col-12 form-group mb-4">
                                    <label for="reviewed_by">ทบทวนโดย</label>
                                    <input class="form-control form-control-modern" name="reviewed_by" value="{{ auth()->user()->name }}" readonly>
                                </div>
                                <div class="col-md-3 col-12 form-group mb-4">
                                    <label for="reviewed_date">วันที่</label>
                                    <input class="form-control form-control-modern" type="date" name="reviewed_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-9 col-12 form-group mb-4">
                                    <label for="approved_by">อนุมัติโดย</label>
                                    <input class="form-control form-control-modern" name="approved_by" readonly>
                                </div>
                                <div class="col-md-3 col-12 form-group mb-4">
                                    <label for="approved_date">วันที่</label>
                                    <input class="form-control form-control-modern" type="date" name="approved_date" readonly>
                                </div>
                                <input type="hidden" name="reviewed_status" value="Y">
                                <input type="hidden" name="approved_status" value="N">
                            </div>
                        @endif         

                        <!-- Form Submission Footer -->
                        <div class="row mt-4">
                            <div class="col-12 text-center text-md-left">
                                <button type="submit" class="btn btn-indigo px-5">
                                    <i class="fas fa-check-circle mr-2"></i> บันทึกผลการตรวจสอบ
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