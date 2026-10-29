@extends('layouts.main')

@section('content')
@push('styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

<style>
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #e0e7ff;
        --indigo-subtle: #eeeffe;
        --text-dark: #1e1b4b;
        --text-muted: #64748b;
        --border-radius-custom: 16px;
    }

    .custom-card {
        border: none;
        border-radius: var(--border-radius-custom);
        box-shadow: 0 10px 30px -5px rgba(79, 70, 229, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.03);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #4f46e5, #6366f1);
        color: #ffffff;
        padding: 2rem 1.75rem;
        border-bottom: none;
        position: relative;
    }

    .custom-card-header h5 {
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .doc-code {
        font-size: 0.8rem;
        background: rgba(255, 255, 255, 0.2);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        backdrop-filter: blur(4px);
    }

    .inspection-table {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 0;
    }

    .inspection-table thead th {
        background-color: #f8fafc !important;
        color: #475569;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem !important;
        border-bottom: 2px solid #e2e8f0 !important;
    }

    .inspection-table tbody td {
        padding: 1rem !important;
        vertical-align: middle !important;
        color: var(--text-dark);
        border-bottom: 1px solid #f1f5f9;
    }

    .dimension-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem;
        height: 100%;
    }

    .dimension-title {
        font-size: 0.82rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.5rem;
    }

    .sub-section-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--indigo-primary);
        background: var(--indigo-subtle);
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        margin: 1rem 0 0.75rem 0;
    }

    .custom-input {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 0.5rem 0.75rem;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .custom-input:focus {
        border-color: var(--indigo-primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }

    .info-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.25rem;
        height: 100%;
    }

    .info-card-title {
        font-weight: 600;
        color: var(--indigo-primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
    }

    .badge-spec {
        background-color: var(--indigo-subtle);
        color: var(--indigo-primary);
        font-weight: 500;
        font-size: 0.8rem;
        padding: 0.35rem 0.65rem;
        border-radius: 6px;
    }

    .text-danger-custom {
        color: #ef4444;
        font-weight: 600;
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center"> 
        <div class="col-12 col-xl-11">
            <div class="card custom-card">
                <!-- Header -->
                <div class="card-header custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <div>
                            <span class="doc-code mb-2 d-inline-block">ฟอร์มเอกสาร: {{ $hd->document_code ?? 'GF409.1' }}</span>
                            <h4 class="m-0 text-white fw-bold">{{ $hd->company_name ?? 'บริษัท เอสซอม จำกัด' }}</h4>
                            <p class="m-0 mt-1 text-white-50" style="font-size: 0.95rem;">
                                ใบบันทึกผลการตรวจสอบอุปกรณ์ที่สั่งทำจากภายนอก (SUBCONTRACT WORK INSPECTION RECORD)
                            </p>
                            <div class="mt-1 font-weight-bold text-white" style="font-size: 0.9rem; opacity: 0.9;">
                                PRODUCT: {{ $hd->product_name ?? 'HB100 HYDRAULICS BENCH' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body p-4"> 
                    @php
                        // จัดกลุ่มข้อมูล Details ตาม section_number เพื่อให้ดึงมาแสดงผลได้ง่าย
                        $details = isset($hd->details) ? $hd->details->keyBy('section_number') : collect();
                        
                        $item1 = $details[1]->measurements ?? [];
                        $passFail1 = $details[1]->pass_fail ?? '';
                        $remarks1 = $details[1]->remarks ?? '';

                        $item2 = $details[2]->measurements ?? [];
                        $passFail2 = $details[2]->pass_fail ?? '';
                        $remarks2 = $details[2]->remarks ?? '';
                    @endphp

                    <form action="{{ route('inspection-record-hbs.update', $hd->inspection_recordhb_hds_id) }}" method="POST" id="inspectionForm">
                        @csrf
                        @method('PUT')
                         <input type="hidden" name="doc_ref" value="Update">
                        <!-- Inspection Table -->
                        <div class="table-responsive mb-4">
                            <table class="table inspection-table align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 60px;">ลำดับ</th>
                                        <th>รายการตรวจวัด / รายละเอียดข้อกำหนด</th>
                                        <th style="width: 160px;" class="text-center">ผลการตรวจ</th>
                                        <th style="width: 250px;">หมายเหตุ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- ข้อ 1: ถังน้ำโต๊ะชลศาสตร์ -->
                                    <tr>
                                        <td class="text-center fw-bold fs-5 align-top pt-3">1</td>
                                        <td>
                                            <div class="mb-3">
                                                <h6 class="fw-bold text-dark mb-1">ถังน้ำโต๊ะชลศาสตร์ (วัดตัวอย่างของแต่ละขนาด)</h6>
                                                <div class="d-flex flex-wrap gap-2 my-2">
                                                    <span class="badge-spec"><i class="fas fa-check-circle me-1"></i>ขอบถังคมและแนวตรง</span>
                                                    <span class="badge-spec"><i class="fas fa-check-circle me-1"></i>ผนังเรียบไม่แอ่นหรือนูนมาก</span>
                                                    <span class="badge-spec text-danger-custom" style="background-color: #fef2f2;"><i class="fas fa-exclamation-circle me-1"></i>คลาดเคลื่อนได้ไม่เกิน 2% (และไม่เกิน 8 มม.)</span>
                                                </div>
                                            </div>

                                            <div class="row g-3">
                                                <!-- ความกว้าง -->
                                                <div class="col-md-4">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title"><i class="fas fa-arrows-alt-h me-1"></i> ความกว้าง (Width)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[1][width_spec]" value="{{ $item1['width_spec'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[1][width_actual]" value="{{ $item1['width_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_width_1" name="sections[1][width_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- ความยาว -->
                                                <div class="col-md-4">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title"><i class="fas fa-arrows-alt-v me-1"></i> ความยาว (Length)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[1][length_spec]" value="{{ $item1['length_spec'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[1][length_actual]" value="{{ $item1['length_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_length_1" name="sections[1][length_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- ความสูง -->
                                                <div class="col-md-4">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title"><i class="fas fa-level-up-alt me-1"></i> ความสูง (Height)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[1][height_spec]" value="{{ $item1['height_spec'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[1][height_actual]" value="{{ $item1['height_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_height_1" name="sections[1][height_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <select class="form-select custom-input fw-bold" name="sections[1][pass_fail]">
                                                <option value="">-- เลือก --</option>
                                                <option value="pass" {{ $passFail1 == 'pass' ? 'selected' : '' }} class="text-success">✓ ผ่าน</option>
                                                <option value="fail" {{ $passFail1 == 'fail' ? 'selected' : '' }} class="text-danger">✗ ไม่ผ่าน</option>
                                            </select>
                                        </td>
                                        <td class="align-middle">
                                            <textarea class="form-control custom-input" name="sections[1][remarks]" rows="5" placeholder="หมายเหตุเพิ่มเติม...">{{ $remarks1 }}</textarea>
                                        </td>
                                    </tr>

                                    <!-- ข้อ 2: ฝาถังโต๊ะชลศาสตร์ -->
                                    <tr>
                                        <td class="text-center fw-bold fs-5 align-top pt-3">2</td>
                                        <td>
                                            <div class="mb-3">
                                                <h6 class="fw-bold text-dark mb-1">ฝาถังโต๊ะชลศาสตร์ (วัดฝาตัวอย่าง โดยใช้สันบรรทัดเหล็กยาวทาบ)</h6>
                                                <div class="d-flex flex-wrap gap-2 my-2">
                                                    <span class="badge-spec">ขอบตรงและคม</span>
                                                    <span class="badge-spec">ผนังเรียบไม่แอ่นหรือนูนมาก</span>
                                                    <span class="badge-spec">ฝาถังโต๊ะเรียบ และไม่แอ่นหรือนูน</span>
                                                    <span class="badge-spec">ขอบร่องบากได้ดิ่งและขนานกับผนังถังวัดปริมาตร</span>
                                                    <span class="badge-spec text-danger-custom" style="background-color: #fef2f2;">ขนาดฝาถังคลาดเคลื่อนไม่เกิน 2% และไม่เกิน 6 มม.</span>
                                                </div>
                                            </div>

                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">ความกว้าง (Width)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][width_spec]" value="{{ $item2['width_spec'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[2][width_actual]" value="{{ $item2['width_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_cover_w_2" name="sections[2][width_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">ความยาว (Length)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][length_spec]" value="{{ $item2['length_spec'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[2][length_actual]" value="{{ $item2['length_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_cover_l_2" name="sections[2][length_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">ร่องบากกว้าง</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][notch_width_spec]" value="{{ $item2['notch_width_spec'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[2][notch_width_actual]" value="{{ $item2['notch_width_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_notch_w_2" name="sections[2][notch_width_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">ร่องบากลึก</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][notch_depth_spec]" value="{{ $item2['notch_depth_spec'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[2][notch_depth_actual]" value="{{ $item2['notch_depth_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_notch_d_2" name="sections[2][notch_depth_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">ร่องบากยาว</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][notch_length_spec]" value="{{ $item2['notch_length_spec'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[2][notch_length_actual]" value="{{ $item2['notch_length_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_notch_len_2" name="sections[2][notch_length_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">ความกว้างปากยึดแผ่น WEIR (190 มม.)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][weir_spec]" value="{{ $item2['weir_spec'] ?? '190' }}" placeholder="190.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[2][weir_actual]" value="{{ $item2['weir_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_weir_2" name="sections[2][weir_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="sub-section-title">ถังวัดปริมาตร (คลาดเคลื่อนไม่เกิน 1%)</div>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">ความสูงถังปริมาตรบน (335 มม.)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][vol_top_spec]" value="{{ $item2['vol_top_spec'] ?? '335' }}" placeholder="335.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[2][vol_top_actual]" value="{{ $item2['vol_top_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_vol_top_2" name="sections[2][vol_top_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">ความลึกถังปริมาตรล่าง (120 มม.)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][vol_bot_spec]" value="{{ $item2['vol_bot_spec'] ?? '120' }}" placeholder="120.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[2][vol_bot_actual]" value="{{ $item2['vol_bot_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_vol_bot_2" name="sections[2][vol_bot_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="sub-section-title">ถังปริมาตร ส่วนล่าง</div>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">กว้างด้านซ้ายตามแบบ (450 มม.)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][bot_lw_spec]" value="{{ $item2['bot_lw_spec'] ?? '450' }}" placeholder="450.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[2][bot_lw_actual]" value="{{ $item2['bot_lw_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_bot_lw_2" name="sections[2][bot_lw_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">กว้างด้านขวาตามแบบ (450 มม.)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][bot_rw_spec]" value="{{ $item2['bot_rw_spec'] ?? '450' }}" placeholder="450.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[2][bot_rw_actual]" value="{{ $item2['bot_rw_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_bot_rw_2" name="sections[2][bot_rw_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">ยาวด้านซ้ายตามแบบ (223 มม.)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][bot_ll_spec]" value="{{ $item2['bot_ll_spec'] ?? '223' }}" placeholder="223.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[2][bot_ll_actual]" value="{{ $item2['bot_ll_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_bot_ll_2" name="sections[2][bot_ll_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">ยาวด้านขวาตามแบบ (223 มม.)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][bot_rl_spec]" value="{{ $item2['bot_rl_spec'] ?? '223' }}" placeholder="223.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[2][bot_rl_actual]" value="{{ $item2['bot_rl_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_bot_rl_2" name="sections[2][bot_rl_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="sub-section-title">ถังปริมาตร ส่วนบน</div>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">กว้างด้านซ้ายตามแบบ (450 มม.)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][top_lw_spec]" value="{{ $item2['top_lw_spec'] ?? '450' }}" placeholder="450.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[2][top_lw_actual]" value="{{ $item2['top_lw_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_top_lw_2" name="sections[2][top_lw_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">กว้างด้านขวาตามแบบ (450 มม.)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][top_rw_spec]" value="{{ $item2['top_rw_spec'] ?? '450' }}" placeholder="450.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[2][top_rw_actual]" value="{{ $item2['top_rw_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_top_rw_2" name="sections[2][top_rw_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">ยาวด้านซ้ายตามแบบ (670 มม.)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][top_ll_spec]" value="{{ $item2['top_ll_spec'] ?? '670' }}" placeholder="670.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" data-target="top_ll_2" name="sections[2][top_ll_actual]" value="{{ $item2['top_ll_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_top_ll_2" name="sections[2][top_ll_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="dimension-box">
                                                        <div class="dimension-title">ยาวด้านขวาตามแบบ (670 มม.)</div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">ตามแบบ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input spec-input" name="sections[2][top_rl_spec]" value="{{ $item2['top_rl_spec'] ?? '670' }}" placeholder="670.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">วัดได้ (มม.)</label>
                                                            <input type="number" step="0.01" class="form-control form-control-sm custom-input actual-input" name="sections[2][top_rl_actual]" value="{{ $item2['top_rl_actual'] ?? '' }}" placeholder="0.00">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small text-muted mb-1">คลาดเคลื่อน (%)</label>
                                                            <input type="text" class="form-control form-control-sm custom-input bg-light diff-input" id="diff_top_rl_2" name="sections[2][top_rl_diff]" readonly placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <select class="form-select custom-input fw-bold" name="sections[2][pass_fail]">
                                                <option value="">-- เลือก --</option>
                                                <option value="pass" {{ $passFail2 == 'pass' ? 'selected' : '' }} class="text-success">✓ ผ่าน</option>
                                                <option value="fail" {{ $passFail2 == 'fail' ? 'selected' : '' }} class="text-danger">✗ ไม่ผ่าน</option>
                                            </select>
                                        </td>
                                        <td class="align-middle">
                                            <textarea class="form-control custom-input" name="sections[2][remarks]" rows="5" placeholder="หมายเหตุเพิ่มเติม...">{{ $remarks2 }}</textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Signatures / Approval Section -->
                        <div class="row g-4 mt-2">
                            <!-- Inspector Card -->
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-title">
                                        <i class="fas fa-user-check"></i> ผู้ทำการตรวจสอบ (Inspector)
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">ชื่อผู้ตรวจ</label>
                                            <input class="form-control custom-input bg-white" type="text" name="checked_by" value="{{ $hd->checked_by }}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">ตำแหน่ง</label>
                                            <input class="form-control custom-input" type="text" name="checked_job" placeholder="ระบุตำแหน่ง" value="{{ $hd->checked_job }}" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small fw-bold text-muted">วันที่ตรวจสอบ</label>
                                            <input class="form-control custom-input" type="date" name="checked_date" value="{{ optional($hd->checked_date)->format('Y-m-d') }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Approver Card -->
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-title">
                                        <i class="fas fa-user-shield"></i> ผู้อนุมัติ (Approver)
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">ชื่อผู้อนุมัติ</label>
                                            <input class="form-control custom-input" type="text" name="approved_by" value="{{ $hd->approved_by ?? auth()->user()->name }}" placeholder="ระบุชื่อผู้อนุมัติ" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">ตำแหน่ง</label>
                                            <input class="form-control custom-input" type="text" name="approved_job" value="{{ $hd->approved_job ?? '' }}" placeholder="ระบุตำแหน่ง" >
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small fw-bold text-muted">วันที่อนุมัติ</label>
                                            <input class="form-control custom-input" type="date" name="approved_date" value="{{ optional($hd->approved_date)->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button Zone -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ url()->previous() }}" class="btn btn-light px-4 fw-semibold" style="border-radius: 8px;">ยกเลิก</a>
                            <button type="submit" class="btn btn-primary px-4 fw-semibold" style="background-color: var(--indigo-primary); border-color: var(--indigo-primary); border-radius: 8px;">
                                <i class="fas fa-save me-1"></i> อัปเดตข้อมูล
                            </button>
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
    document.addEventListener('DOMContentLoaded', function() {
        // ฟังก์ชันสำหรับคำนวณและแสดงค่าคลาดเคลื่อน (%) แบบ Real-time (รวมถึงกรณีมีข้อมูลเก่าอยู่แล้ว)
        const boxes = document.querySelectorAll('.dimension-box');

        boxes.forEach(box => {
            const specInput = box.querySelector('.spec-input');
            const actualInput = box.querySelector('.actual-input');
            const diffInput = box.querySelector('.diff-input');

            if (specInput && actualInput && diffInput) {
                const calculate = () => {
                    const spec = parseFloat(specInput.value);
                    const actual = parseFloat(actualInput.value);

                    if (!isNaN(spec) && !isNaN(actual) && spec > 0) {
                        const diffPercent = ((actual - spec) / spec) * 100;
                        diffInput.value = diffPercent.toFixed(2) + '%';

                        if (Math.abs(diffPercent) > 2) {
                            diffInput.classList.add('text-danger-custom', 'border-danger');
                        } else {
                            diffInput.classList.remove('text-danger-custom', 'border-danger');
                        }
                    } else {
                        diffInput.value = '';
                        diffInput.classList.remove('text-danger-custom', 'border-danger');
                    }
                };

                // คำนวณทันทีเมื่อโหลดหน้า (กรณีมีข้อมูลเก่าอยู่ใน Input แล้ว)
                calculate();

                // ผูก Event ฟังการเปลี่ยนแปลงตอนผู้ใช้งานพิมพ์
                specInput.addEventListener('input', calculate);
                actualInput.addEventListener('input', calculate);
            }
        });
    });
</script>
@endpush