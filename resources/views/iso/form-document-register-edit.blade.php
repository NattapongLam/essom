@extends('layouts.main')
@section('content')

<!-- Sweet Alert 2 Custom Assets -->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Theme Layout Structure */
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

    /* Elegant Header Design Component */
    .card-header-modern {
        background-color: #ffffff;
        padding: 2.5rem 2.5rem 1.5rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-title-block h5 {
        font-size: 1.1rem;
        letter-spacing: 1px;
        color: #475569;
        font-weight: 500;
        margin: 0;
        line-height: 1.5;
    }

    .header-title-block h2 {
        font-weight: 700;
        color: #1e293b;
        margin-top: 8px;
        margin-bottom: 0;
        font-size: 1.4rem;
        line-height: 1.4;
    }

    .doc-number-badge {
        position: absolute;
        top: 2.5rem;
        right: 2.5rem;
        text-align: right;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        color: #64748b;
        line-height: 1.4;
    }

    /* Modern Styled Controls & Inputs */
    .form-label-modern {
        font-weight: 600;
        color: #475569;
        font-size: 0.88rem;
        margin-bottom: 6px;
    }

    .form-control-modern {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 10px 14px;
        font-size: 0.9rem;
        color: #334155;
        transition: all 0.2s;
    }

    .form-control-modern:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        outline: none;
    }

    .form-control-modern[readonly] {
        background-color: #f1f5f9;
        color: #64748b;
        border-color: #e2e8f0;
    }

    select.form-control-modern {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23475569'%3e%3cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px;
        padding-right: 40px;
    }

    /* Sub Section Embedded Card */
    .inner-rev-card {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        margin-top: 25px;
    }

    .inner-rev-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #4f46e5;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Custom Premium File Input & Existing Badge */
    .file-input-wrapper {
        background: #ffffff;
        border: 1px dashed #cbd5e1;
        border-radius: 8px;
        padding: 12px;
        transition: all 0.2s;
    }
    .file-input-wrapper:hover {
        border-color: #818cf8;
        background-color: #fcfcff;
    }

    .existing-file-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #eeebff;
        color: #4f46e5;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        margin-top: 8px;
        transition: all 0.2s;
        text-decoration: none !important;
    }
    .existing-file-badge:hover {
        background: #4f46e5;
        color: #ffffff;
    }

    /* Premium Dynamic Action Buttons */
    .btn-indigo-submit {
        background: #4f46e5;
        color: #ffffff !important;
        border: none;
        padding: 11px 28px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.2s;
        width: 100%;
    }

    .btn-indigo-submit:hover {
        background: #4338ca;
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    .btn-secondary-cancel {
        background: #f1f5f9;
        color: #475569 !important;
        border: 1px solid #e2e8f0;
        padding: 11px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        text-decoration: none !important;
    }
    .btn-secondary-cancel:hover {
        background: #e2e8f0;
        color: #1e293b !important;
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
                <h2>ทะเบียนควบคุมเอกสาร (Documents Control Status)</h2>
            </div>
            <div class="doc-number-badge">
                <strong>F7530.1</strong><br>1 Oct. 20
            </div>
        </div>

        <!-- Form Elements Content Area -->
        <div class="card-body" style="padding: 2.5rem;">
            <form method="POST" action="{{ route('document-register.update', $hd->documentregisters_id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Main Details Section -->
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-12 mb-3">
                        <label class="form-label-modern" for="documentregisters_listno">ที่</label>
                        <input type="number" name="documentregisters_listno" class="form-control form-control-modern" value="{{$hd->documentregisters_listno}}" readonly>
                    </div>
                    <div class="col-lg-3 col-md-9 col-12 mb-3">
                        <label class="form-label-modern" for="documentregisters_docuno">Doc No.</label>
                        <input type="text" name="documentregisters_docuno" class="form-control form-control-modern" value="{{$hd->documentregisters_docuno}}" required>
                    </div>
                    <div class="col-lg-7 col-12 mb-3">
                        <label class="form-label-modern" for="documentregisters_remark">Description</label>
                        <input type="text" name="documentregisters_remark" class="form-control form-control-modern" value="{{$hd->documentregisters_remark}}">
                    </div>
                </div>

                <!-- Nested Revision Control Parameters Card -->
                <div class="inner-rev-card">
                    <div class="inner-rev-title">
                        <i class="fas fa-history"></i> ประวัติการแก้ไขและการปรับปรุง (Revision Status)
                    </div>
                    <div class="row">
                        @for ($i = 1; $i <= 10; $i++)
                            @php 
                                $revField = 'documentregisters_rev' . sprintf('%02d', $i); 
                            @endphp
                            <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                                <label class="form-label-modern" for="{{ $revField }}">Rev.{{ sprintf('%02d', $i) }}</label>
                                <input type="text" name="{{ $revField }}" class="form-control form-control-modern text-center" value="{{ $hd->$revField }}">
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Attachment Upload & Current File Verification Subsystem -->
                <div class="row mt-4">
                    <!-- File 1 Component -->
                    <div class="col-lg-4 col-12 mb-3">
                        <label class="form-label-modern" for="documentregisters_file">
                            อัปโหลดไฟล์สแกนต้นฉบับใหม่
                        </label>
                        <div class="file-input-wrapper">
                            <input type="file" class="form-control-file w-100" name="documentregisters_file">
                        </div>
                        @if ($hd->documentregisters_file)
                            <a href="{{ asset($hd->documentregisters_file) }}" target="_blank" class="existing-file-badge">
                                <i class="fas fa-file-alt"></i> ดูไฟล์เดิม (
                                @if($hd->documentregisters_rev10) Rev.{{$hd->documentregisters_rev10}}
                                @elseif($hd->documentregisters_rev09) Rev.{{$hd->documentregisters_rev09}}
                                @elseif($hd->documentregisters_rev08) Rev.{{$hd->documentregisters_rev08}}
                                @elseif($hd->documentregisters_rev07) Rev.{{$hd->documentregisters_rev07}}
                                @elseif($hd->documentregisters_rev06) Rev.{{$hd->documentregisters_rev06}}
                                @elseif($hd->documentregisters_rev05) Rev.{{$hd->documentregisters_rev05}}
                                @elseif($hd->documentregisters_rev04) Rev.{{$hd->documentregisters_rev04}}
                                @elseif($hd->documentregisters_rev03) Rev.{{$hd->documentregisters_rev03}}
                                @elseif($hd->documentregisters_rev02) Rev.{{$hd->documentregisters_rev02}}
                                @elseif($hd->documentregisters_rev01) Rev.{{$hd->documentregisters_rev01}}
                                @else ต้นฉบับ
                                @endif)
                            </a>
                        @endif
                    </div> 

                    <!-- File 2 Component -->
                    <div class="col-lg-4 col-12 mb-3">
                        <label class="form-label-modern" for="documentregisters_file1">
                            อัปโหลดเอกสารแนบใหม่ (หากมี)
                        </label>
                        <div class="file-input-wrapper">
                            <input type="file" class="form-control-file w-100" name="documentregisters_file1">
                        </div>
                        @if ($hd->documentregisters_file1)
                            <a href="{{ asset($hd->documentregisters_file1) }}" target="_blank" class="existing-file-badge">
                                <i class="fas fa-paperclip"></i> ดูเอกสารแนบเดิม
                            </a>
                        @endif
                    </div> 

                    <!-- File 3 Component -->
                    <div class="col-lg-4 col-12 mb-3">
                        <label class="form-label-modern" for="documentregisters_file2">
                            อัปโหลดเอกสารอ้างอิงใหม่ (หากมี)
                        </label>
                        <div class="file-input-wrapper">
                            <input type="file" class="form-control-file w-100" name="documentregisters_file2">
                        </div>
                        @if ($hd->documentregisters_file2)
                            <a href="{{ asset($hd->documentregisters_file2) }}" target="_blank" class="existing-file-badge">
                                <i class="fas fa-link"></i> ดูเอกสารอ้างอิงเดิม
                            </a>
                        @endif
                    </div> 
                </div>

                <!-- Status Management Module -->
                <div class="row mt-2">
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <label class="form-label-modern" for="documentregisters_flag">สถานะการใช้งาน</label>
                        <select class="form-control form-control-modern" name="documentregisters_flag">
                            <option value="1" {{ $hd->documentregisters_flag == 1 ? 'selected' : '' }}>ใช้งาน (Active)</option>
                            <option value="0" {{ $hd->documentregisters_flag == 0 ? 'selected' : '' }}>ไม่ใช้งาน (Inactive)</option>
                        </select>
                    </div>
                </div>

                <hr class="my-4" style="border-top: 1px solid #f1f5f9;">

                <!-- Action Toolbar Footer Operations -->
                <div class="row align-items-center">
                    <div class="col-md-3 col-sm-6 col-12 mb-2 mb-sm-0">
                        <button type="submit" class="btn-indigo-submit">
                            <i class="fas fa-save"></i> อัปเดตข้อมูล
                        </button>
                    </div>
                    <div class="col-md-2 col-sm-6 col-12">
                        <a href="{{ route('document-register.index') }}" class="btn-secondary-cancel text-center d-block">
                            ยกเลิก
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@push('scriptjs')
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    // พื้นที่สำหรับเขียน JS ตรวจสอบฟอร์มเพิ่มเติม (ถ้ามี)
</script>
@endpush