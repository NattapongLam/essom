@extends('layouts.main')

@section('content')
{{-- @push('styles') --}}
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}

<style>
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #e0e7ff;
        --indigo-soft-bg: #f8fafc;
        --text-dark: #0f172a;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --card-radius: 16px;
    }

    /* Modern Card Container */
    .custom-card {
        border: 1px solid var(--border-color);
        border-radius: var(--card-radius);
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
        background: #ffffff;
        overflow: hidden;
    }

    /* Header Styling */
    .custom-card-header {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #ffffff;
        padding: 1.75rem 2rem;
        border-bottom: none;
    }

    .doc-title {
        font-weight: 700;
        font-size: 1.35rem;
        margin-bottom: 0.25rem;
        letter-spacing: -0.02em;
    }

    .doc-subtitle {
        font-weight: 400;
        font-size: 0.95rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .doc-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(4px);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    /* Buttons */
    .btn-indigo-add {
        background-color: #ffffff;
        color: var(--indigo-primary) !important;
        font-weight: 600;
        border-radius: 10px;
        padding: 0.6rem 1.25rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none !important;
        border: none;
    }

    .btn-indigo-add:hover {
        background-color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px -3px rgba(0, 0, 0, 0.15);
        color: var(--indigo-hover) !important;
    }

    /* Form Controls */
    .form-group label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.4rem;
    }

    .custom-input {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        transition: all 0.2s ease-in-out;
    }

    .custom-input:focus {
        border-color: var(--indigo-primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        outline: none;
    }

    /* Inspection Table Styling */
    .table-responsive {
        border-radius: 12px;
        border: 1px solid var(--border-color);
    }

    .inspection-table {
        margin-bottom: 0;
        border-collapse: collapse;
        width: 100%;
        background-color: #ffffff;
    }

    .inspection-table th {
        background-color: var(--indigo-soft-bg) !important;
        color: #475569;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.85rem 0.75rem !important;
        border-bottom: 2px solid var(--border-color) !important;
    }

    .inspection-table td {
        padding: 0.6rem 0.5rem !important;
        vertical-align: middle !important;
        font-size: 0.875rem;
        color: var(--text-dark);
        border: 1px solid var(--border-color);
    }

    .section-header-row {
        background-color: #f1f5f9;
        font-weight: 600;
        color: var(--indigo-primary);
    }

    .sub-header-row {
        background-color: #fafafa;
        font-weight: 600;
        color: var(--text-muted);
        font-size: 0.8rem !important;
    }

    .flow-pct-cell {
        font-weight: 600;
        color: #475569;
        background-color: #f8fafc;
        text-align: center;
    }

    /* Section Cards for Approval Footer */
    .info-card {
        background-color: #f8fafc;
        border-radius: 12px;
        padding: 1.25rem;
        border: 1px solid #e2e8f0;
    }

    .info-card-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--indigo-primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
</style>

<div class="container-fluid py-4">
    <form action="{{ route('inspection-recodes.store') }}" method="POST">
    @csrf     
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                
                <!-- Card Header -->
                <div class="card-header custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <div class="text-center text-md-left">
                            <h4 class="doc-title m-0">บริษัท เอสซอม จำกัด</h4>
                            <div class="doc-subtitle mt-1">
                                บันทึกผลการตรวจรับอุปกรณ์ที่สั่งทำจากภายนอก<br>
                                <span class="text-uppercase" style="font-size: 0.85rem; opacity: 0.85;">Subcontract Work Inspection Record</span>
                            </div>
                            <span class="doc-badge">ฟอร์มเอกสาร: GF409.1 (25 Apr. 17)</span>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">     
                    
                    <!-- Top Form Fields -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><i class="far fa-calendar-alt me-1"></i> วันที่</label>
                                <input class="form-control custom-input" type="date" name="document_date" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label><i class="fas fa-info-circle me-1"></i> รายละเอียด</label>
                                <input class="form-control custom-input" type="text" name="description" placeholder="กรอกรายละเอียดงานตรวจรับ..." value="">
                            </div>
                        </div>
                    </div>

                    <!-- Inspection Table -->
                    <div class="table-responsive mb-4">
                        <table class="table inspection-table text-center align-middle" id="planningTable">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">ลำดับ</th>
                                    <th colspan="7">รายการตรวจวัด / รายละเอียด</th>
                                    <th style="width: 130px;">ผ่าน/ไม่ผ่าน</th>
                                    <th style="width: 180px;">หมายเหตุ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- ================= ส่วนที่ 1 ================= -->
                                <tr class="section-header-row">
                                    <td rowspan="7" class="fw-bold fs-6">1</td>
                                    <td colspan="7" class="text-start py-2">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                            <span>
                                                <strong>มาตรวัดอัตราการไหล (วัดหยาบ)</strong> 
                                                <span class="text-muted ms-2" style="font-size: 0.8rem;">(วัดมาตรตัวอย่าง สุ่มตัวอย่าง 5% คลาดเคลื่อนไม่เกิน 8%)</span>
                                            </span>
                                            <div class="d-flex align-items-center gap-2" style="max-width: 200px;">
                                                <span class="text-nowrap" style="font-size: 0.85rem;">ตัวที่:</span>
                                                <input class="form-control form-control-sm custom-input" name="sections[1][sample_code]" placeholder="ระบุตัวที่">
                                            </div>
                                        </div>
                                    </td>
                                    <td rowspan="7" class="align-middle">
                                        <select class="form-select form-select-sm custom-input" name="sections[1][pass_fail]">
                                            <option value="">-- เลือก --</option>
                                            <option value="pass">ผ่าน</option>
                                            <option value="fail">ไม่ผ่าน</option>
                                        </select>
                                    </td>
                                    <td rowspan="7" class="align-middle">
                                        <textarea class="form-control custom-input" name="sections[1][remarks]" rows="5" placeholder="หมายเหตุเพิ่มเติม..."></textarea>
                                    </td>
                                </tr>

                                <tr class="sub-header-row">
                                    <td style="width: 90px;">ระดับ (%)</td>
                                    <td>อ่านได้ (ลิตร/นาที)</td>
                                    <td>ปริมาตร (ลิตร)</td>
                                    <td>เวลา (วินาที)</td>
                                    <td>อัตราการไหล (ลิตร/วินาที)</td>
                                    <td>% คลาดเคลื่อน (%)</td>
                                    <td>-</td>
                                </tr>

                                @foreach(['20%', '40%', '60%', '80%', '100%'] as $pct)
                                <tr>
                                    <td class="flow-pct-cell">{{ $pct }}</td>
                                    <td><input class="form-control form-control-sm custom-input text-end" type="number" step="any" name="sections[1][rows][{{ $pct }}][val_1]"></td>
                                    <td><input class="form-control form-control-sm custom-input text-end" type="number" step="any" name="sections[1][rows][{{ $pct }}][val_2]"></td>
                                    <td><input class="form-control form-control-sm custom-input text-end" type="number" step="any" name="sections[1][rows][{{ $pct }}][val_3]"></td>
                                    <td><input class="form-control form-control-sm custom-input text-end" type="number" step="any" name="sections[1][rows][{{ $pct }}][val_4]"></td>
                                    <td><input class="form-control form-control-sm custom-input text-end" type="number" step="any" name="sections[1][rows][{{ $pct }}][val_5]"></td>
                                    <td><input class="form-control form-control-sm custom-input text-end" type="number" step="any" disabled></td>
                                </tr>
                                @endforeach

                                <!-- ================= ส่วนที่ 2 ================= -->
                                <tr class="section-header-row">
                                    <td rowspan="9" class="fw-bold fs-6">2</td>
                                    <td colspan="7" class="text-start py-2">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                            <span>
                                                <strong>สเกลวัดระยะสุ่มตัวอย่าง 2%</strong> 
                                                <span class="text-muted ms-2" style="font-size: 0.8rem;">(คลาดเคลื่อนไม่เกิน 0.2% และไม่เกิน 1 มม.)</span>
                                            </span>
                                        </div>
                                    </td>
                                    <td rowspan="9" class="align-middle">
                                        <select class="form-select form-select-sm custom-input" name="sections[2][pass_fail]">
                                            <option value="">-- เลือก --</option>
                                            <option value="pass">ผ่าน</option>
                                            <option value="fail">ไม่ผ่าน</option>
                                        </select>
                                    </td>
                                    <td rowspan="9" class="align-middle">
                                        <textarea class="form-control custom-input" name="sections[2][remarks]" rows="6" placeholder="หมายเหตุเพิ่มเติม..."></textarea>
                                    </td>
                                </tr>

                                <tr class="sub-header-row">
                                    <td>ตัวที่</td>
                                    <td>อ่านได้ (200 มม.)</td>
                                    <td>% คลาดเคลื่อน</td>
                                    <td>อ่านได้ (300 มม.)</td>
                                    <td>% คลาดเคลื่อน</td>
                                    <td>อ่านได้ (500 มม.)</td>
                                    <td>อ่านได้ (1000 มม.)</td>
                                </tr>

                                @for($i = 1; $i <= 6; $i++)
                                <tr>
                                    <td class="flow-pct-cell">{{ $i }}</td>
                                    <td><input class="form-control form-control-sm custom-input text-end" type="number" step="any" name="sections[2][rows][{{ $i }}][val_1]"></td>
                                    <td><input class="form-control form-control-sm custom-input text-end" type="number" step="any" name="sections[2][rows][{{ $i }}][val_2]"></td>
                                    <td><input class="form-control form-control-sm custom-input text-end" type="number" step="any" name="sections[2][rows][{{ $i }}][val_3]"></td>
                                    <td><input class="form-control form-control-sm custom-input text-end" type="number" step="any" name="sections[2][rows][{{ $i }}][val_4]"></td>
                                    <td><input class="form-control form-control-sm custom-input text-end" type="number" step="any" name="sections[2][rows][{{ $i }}][val_5]"></td>
                                    <td><input class="form-control form-control-sm custom-input text-end" type="number" step="any" name="sections[2][rows][{{ $i }}][val_6]"></td>
                                </tr>
                                @endfor

                                <tr>
                                    <td colspan="7" class="text-start bg-light py-2 px-3">
                                        <div class="form-check m-0">
                                            <input class="form-check-input" type="checkbox" id="scaleCheck2" name="sections[2][is_checked]" value="1">
                                            <label class="form-check-label fw-semibold text-dark ms-1" for="scaleCheck2" style="cursor: pointer;">
                                                ขีดแบ่งสเกลคม, สม่ำเสมอและช่องขอบเท่ากัน
                                            </label>
                                        </div>
                                    </td>
                                </tr>

                                <!-- ================= ส่วนที่ 3 (วาล์วเข็ม) ================= -->
                                <tr class="section-header-row">
                                    <td rowspan="7" class="fw-bold fs-6">3</td>
                                    <td colspan="7" class="text-start py-2">
                                        <strong>วาล์วเข็ม สุ่มตัวอย่าง 2%</strong>
                                    </td>
                                    <td rowspan="7" class="align-middle">
                                        <select class="form-select form-select-sm custom-input" name="sections[3][pass_fail]">
                                            <option value="">-- เลือก --</option>
                                            <option value="pass">ผ่าน</option>
                                            <option value="fail">ไม่ผ่าน</option>
                                        </select>
                                    </td>
                                    <td rowspan="7" class="align-middle">
                                        <textarea class="form-control custom-input" name="sections[3][remarks]" rows="5" placeholder="หมายเหตุเพิ่มเติม..."></textarea>
                                    </td>
                                </tr>
                                <tr class="sub-header-row">
                                    <td>ตัวที่</td>
                                    <td colspan="6">รายละเอียดการตรวจสอบ / ผลการทดสอบ</td>
                                </tr>
                                @for ($i = 1; $i <= 5; $i++)
                                <tr>
                                    <td class="flow-pct-cell">{{ $i }}</td>
                                    <td colspan="6" class="text-start">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span style="font-size: 0.85rem;">ไม่รั่วที่ความดัน 5 กก./ซม.² (สภาพของ O-ring และแกนวาล์ว)</span>
                                            <input type="text" class="form-control form-control-sm custom-input" style="max-width: 150px;" name="sections[3][rows][{{ $i }}][val_1]" placeholder="ผลตรวจ/ค่าที่ได้">
                                        </div>
                                    </td>
                                </tr>
                                @endfor

                                <!-- ================= ส่วนที่ 4 (จานองศา) ================= -->
                                <tr class="section-header-row">
                                    <td rowspan="5" class="fw-bold fs-6">4</td>
                                    <td colspan="7" class="text-start py-2">
                                        <strong>จานองศา สุ่มตัวอย่าง 2%</strong>
                                    </td>
                                    <td rowspan="5" class="align-middle">
                                        <select class="form-select form-select-sm custom-input" name="sections[4][pass_fail]">
                                            <option value="">-- เลือก --</option>
                                            <option value="pass">ผ่าน</option>
                                            <option value="fail">ไม่ผ่าน</option>
                                        </select>
                                    </td>
                                    <td rowspan="5" class="align-middle">
                                        <textarea class="form-control custom-input" name="sections[4][remarks]" rows="3" placeholder="หมายเหตุเพิ่มเติม..."></textarea>
                                    </td>
                                </tr>
                                @php
                                    $diskChecks = [
                                        'ต้องกลมไม่บิดเบี้ยว',
                                        'ตัวหนังสือบอกค่าองศาคมชัดไม่เลอะเทอะ',
                                        'ขีดแบ่งองศาคมชัดไม่เลอะเทอะ ห่างสม่ำเสมอและเรียงเป็นวงกลม',
                                        'ขีดแบ่งองศาห่างขอบเท่ากันตลอดวงกลม'
                                    ];
                                @endphp
                                @foreach($diskChecks as $index => $chkText)
                                <tr>
                                    <td colspan="7" class="text-start bg-light py-2 px-3">
                                        <div class="form-check m-0">
                                            <input class="form-check-input" type="checkbox" id="diskCheck_{{ $index }}" name="sections[4][checks][{{ $index }}]" value="{{ $chkText }}">
                                            <label class="form-check-label fw-semibold text-dark ms-1" for="diskCheck_{{ $index }}" style="cursor: pointer;">
                                                {{ $chkText }}
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Signatures / Approval Section -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="info-card">
                                <div class="info-card-title">
                                    <i class="fas fa-user-check"></i> ผู้ทำการตรวจสอบ (Inspector)
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ผู้ทำการตรวจสอบ</label>
                                            <input class="form-control custom-input" type="text" name="checked_by" placeholder="ชื่อผู้ตรวจ" value="{{ auth()->user()->name ?? '' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ตำแหน่ง</label>
                                            <input class="form-control custom-input" type="text" name="checked_job" placeholder="ตำแหน่ง">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-0">
                                            <label>วันที่ตรวจสอบ</label>
                                            <input class="form-control custom-input" type="date" name="checked_date" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-card">
                                <div class="info-card-title">
                                    <i class="fas fa-user-shield"></i> ผู้อนุมัติ (Approver)
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ผู้อนุมัติ</label>
                                            <input class="form-control custom-input" type="text" name="approved_by" placeholder="ชื่อผู้อนุมัติ">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ตำแหน่ง</label>
                                            <input class="form-control custom-input" type="text" name="approved_job" placeholder="ตำแหน่ง">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-0">
                                            <label>วันที่อนุมัติ</label>
                                            <input class="form-control custom-input" type="date" name="approved_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-5 py-2 font-weight-bold" style="border-radius: 8px; background-color: var(--indigo-primary);">
                            <i class="fa fa-save me-1"></i> บันทึกข้อมูล
                        </button>
                    </div>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div>
    </div>
    </form>
</div>
@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    // สามารถเพิ่ม JavaScript Logic หรือ Event Handlers ต่างๆ ที่นี่
</script>
@endpush