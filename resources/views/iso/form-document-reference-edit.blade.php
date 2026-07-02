@extends('layouts.main')
@section('content')
{{-- @push('styles') --}}
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}

<style>
    /* Custom Indigo Modern Theme */
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #e0e7ff;
        --text-dark: #1e1b4b;
        --border-radius-custom: 12px;
    }

    .custom-card {
        border: none;
        border-radius: var(--border-radius-custom);
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.1), 0 8px 10px -6px rgba(79, 70, 229, 0.1);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #6366f1, var(--indigo-primary));
        color: #ffffff;
        padding: 1.5rem;
        border-bottom: none;
    }

    .custom-card-header h5 {
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .doc-code {
        font-size: 0.85rem;
        opacity: 0.85;
        font-weight: 300;
    }

    /* Form Controls Styling */
    .form-group label {
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .custom-form-control {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 0.55rem 0.75rem;
        font-size: 0.9rem;
        color: var(--text-dark);
        transition: all 0.2s ease-in-out;
        height: auto;
    }

    .custom-form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        outline: none;
    }

    /* Readonly style */
    .custom-form-control[readonly] {
        background-color: #f1f5f9;
        color: #64748b;
        font-weight: bold;
        border-color: #e2e8f0;
    }

    /* Custom File Input Upload Container */
    .custom-file-upload {
        border: 1px dashed #cbd5e1;
        display: block;
        padding: 0.55rem 0.75rem;
        cursor: pointer;
        border-radius: 8px;
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }

    .custom-file-upload:hover {
        background-color: #f1f5f9;
        border-color: #6366f1;
    }

    /* Existing File Badge */
    .existing-file-badge {
        background-color: #e0f2fe;
        color: #0369a1;
        padding: 0.4rem 0.75rem;
        border-radius: 6px;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-weight: 500;
        text-decoration: none !important;
        transition: all 0.2s;
    }

    .existing-file-badge:hover {
        background-color: #bae6fd;
        color: #0c4a6e;
        transform: translateY(-1px);
    }

    /* Buttons Concept */
    .btn-indigo-submit {
        background: linear-gradient(135deg, #6366f1, var(--indigo-primary));
        color: #ffffff !important;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        padding: 0.6rem 2rem;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.25);
        transition: all 0.2s ease;
    }

    .btn-indigo-submit:hover {
        box-shadow: 0 6px 15px rgba(79, 70, 229, 0.4);
        transform: translateY(-1px);
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div class="text-center text-md-left mb-3 mb-md-0">
                            <h5 class="m-0">บริษัท เอสซอม จำกัด</h5>
                            <h5 class="m-0 font-weight-normal" style="font-size: 1.1rem; opacity: 0.9;">แก้ไขทะเบียนเอกสารอ้างอิง</h5>
                            <span class="doc-code">ฟอร์มเอกสาร: F7531.2 (9 Jun. 16)</span>
                        </div>
                        <div>
                            <a href="{{ route('document-reference.index') }}" class="btn btn-sm btn-light text-dark" style="border-radius: 8px; font-weight: 500;">
                                <i class="fas fa-arrow-left mr-1"></i> ย้อนกลับ
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">    
                    <form method="POST" action="{{ route('document-reference.update', $hd->documentreferences_id) }}" enctype="multipart/form-data">
                        @csrf  
                        @method('PUT')        
                        
                        <div class="row">
                            <div class="col-12 col-md-3 form-group">
                                <label>ลำดับที่</label>
                                <input type="number" class="form-control custom-form-control" name="documentreferences_listno" value="{{ $hd->documentreferences_listno }}" readonly>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label>วันที่รับเอกสาร <span class="text-danger">*</span></label>
                                <input type="date" class="form-control custom-form-control" name="documentreferences_receivedate" value="{{ $hd->documentreferences_receivedate }}" required>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label>หน่วยงานที่ออกเอกสาร <span class="text-danger">*</span></label>
                                <input type="text" class="form-control custom-form-control" name="documentreferences_department" value="{{ $hd->documentreferences_department }}" required>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 col-md-3 form-group">
                                <label>วันที่ออกเอกสาร</label>
                                <input type="date" class="form-control custom-form-control" name="documentreferences_date" value="{{ $hd->documentreferences_date }}">
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label>รหัสเอกสาร</label>
                                <input type="text" class="form-control custom-form-control" name="documentreferences_code" value="{{ $hd->documentreferences_code }}">
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label>ชื่อเอกสาร</label>
                                <input type="text" class="form-control custom-form-control" name="documentreferences_name" value="{{ $hd->documentreferences_name }}">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 col-md-6 form-group">
                                <label for="documentreferences_file">อัปเดตไฟล์แนบ (อัปโหลดใหม่เพื่อเปลี่ยนไฟล์)</label>
                                <div class="custom-file-upload">
                                    <input type="file" class="form-control-file" id="documentreferences_file" name="documentreferences_file">
                                </div>
                                @if ($hd->documentreferences_file)
                                    <div class="mt-2">
                                        <span class="text-muted mr-2" style="font-size: 0.85rem;">ไฟล์ปัจจุบัน:</span>
                                        <a href="{{ asset($hd->documentreferences_file) }}" target="_blank" class="existing-file-badge">
                                            <i class="fas fa-file-pdf"></i> เปิดดูไฟล์เดิม
                                        </a>
                                    </div>
                                @endif  
                            </div>                                     
                            <div class="col-12 col-md-6 form-group">
                                <label>Link อ้างอิงภายนอก (URL)</label>
                                <input type="text" class="form-control custom-form-control" name="documentreferences_link" value="{{ $hd->documentreferences_link }}">
                            </div>  
                        </div>

                        <hr class="my-4" style="border-top: 1px dashed #cbd5e1;">

                        <div class="row">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-indigo-submit">
                                    <i class="fas fa-save mr-1"></i> อัปเดตข้อมูล
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
</script>
@endpush