@extends('layouts.main')
@section('content')

{{-- @push('styles') --}}
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}

<style>
    /* Modern Indigo Theme Setup */
    .custom-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05);
        border: 1px solid #e2e8f0;
        margin-top: 30px;
        margin-bottom: 30px;
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
    }
    
    .card-header-modern {
        background-color: #ffffff;
        padding: 2rem 2.5rem 1.2rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .title-block h5 {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
        font-size: 1.4rem;
        line-height: 1.4;
    }

    .doc-meta {
        font-size: 0.85rem;
        color: #64748b;
        text-align: right;
        line-height: 1.4;
    }

    .card-body-modern {
        padding: 2rem 2.5rem 2.5rem 2.5rem;
    }

    /* Section Inner Panels */
    .form-section-panel {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 22px;
        margin-bottom: 25px;
    }

    .section-subtitle {
        font-size: 1rem;
        font-weight: 700;
        color: #4f46e5;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    label { 
        font-weight: 600; 
        color: #475569; 
        display: block; 
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    /* Form Controls */
    .form-control-modern {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 0.9rem;
        width: 100%;
        box-sizing: border-box;
        background-color: #ffffff;
        color: #334155;
        transition: all 0.2s ease;
        height: auto;
    }
    .form-control-modern:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }
    .form-control-modern[readonly] {
        background-color: #f1f5f9 !important;
        color: #64748b;
        border-color: #e2e8f0;
        cursor: not-allowed;
    }

    /* Table Component Design */
    .table-responsive-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        margin-bottom: 25px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    table.table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
        margin-bottom: 0 !important;
    }
    
    table.table-modern th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 700;
        border-bottom: 2px solid #e2e8f0;
        padding: 12px 10px;
        font-size: 0.85rem;
    }

    table.table-modern td {
        padding: 12px 10px;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
        background-color: #ffffff;
    }

    /* Action Buttons styling */
    .btn-indigo-submit {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: #ffffff !important;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.2s ease;
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .btn-indigo-submit:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .header-container { flex-direction: column; text-align: center; }
        .doc-meta { text-align: center; margin-top: 5px; }
        .card-body-modern { padding: 1.25rem; }
    }
</style>

<div class="container-fluid">
    <div class="card custom-card">
        
        <div class="card-header-modern">
            <div class="header-container">
                <div class="title-block">
                    <h5>บริษัท เอสซอม จำกัด<br>ใบขอทำลายเอกสาร</h5>
                </div>
                <div class="doc-meta">
                    <strong>F7530.4</strong><br>1 May. 17
                </div>
            </div>
        </div>

        <div class="card-body-modern">
            <form method="POST" action="{{ route('document-destruction.update', $hd->documentdestruction_hd_id) }}" enctype="multipart/form-data">
                @csrf    
                @method('PUT')    
                <input type="hidden" name="check_docu" value="Approved">

                <div class="form-section-panel">
                    <div class="row">
                        <div class="col-md-4 mb-3 mb-md-0">
                             <label>เรียน</label>
                             <input class="form-control-modern" type="text" name="documentdestruction_hd_to" value="{{ $hd->documentdestruction_hd_to }}" readonly>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                             <label>จาก</label>
                             <input class="form-control-modern" type="text" name="documentdestruction_hd_from" value="{{ $hd->documentdestruction_hd_from }}" readonly>
                        </div>
                        <div class="col-md-4">
                             <label>วันที่เอกสาร</label>
                             <input class="form-control-modern" type="date" name="documentdestruction_hd_date" value="{{ $hd->documentdestruction_hd_date }}" required>
                        </div>
                    </div>
                </div>

                <div class="section-subtitle">
                    <i class="fas fa-list-ol"></i> รายการเอกสารที่ตรวจสอบเพื่อขอทำลาย
                </div>

                <div class="table-responsive-container">
                    <table class="table table-modern text-center">
                        <thead>
                            <tr>
                                <th style="width: 10%">ลำดับ</th>
                                <th style="width: 25%">รหัสเอกสาร</th>
                                <th style="width: 35%">ชื่อเอกสาร</th>
                                <th style="width: 30%">หมายเหตุ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dt as $item)
                                <tr>
                                    <td class="font-weight-bold" style="color: #64748b;">{{ $item->documentdestruction_dt_listno }}</td>
                                    <td class="font-weight-bold" style="color: #1e293b;">{{ $item->documentdestruction_dt_code }}</td>
                                    <td class="text-left px-3">{{ $item->documentdestruction_dt_name }}</td>
                                    <td class="text-left px-3 text-muted">{{ $item->documentdestruction_dt_note ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="form-section-panel">
                    <div class="section-subtitle">
                        <i class="fas fa-signature"></i> การจัดการและลงนามสถานะเอกสาร
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4 mb-md-0 text-center px-3">
                            <label class="text-left">ผู้ขออนุมัติ</label>
                            <input class="form-control-modern mb-2" type="text" value="{{ $hd->requested_by }}" name="requested_by" readonly>
                            <input class="form-control-modern" type="date" value="{{ $hd->requested_date }}" name="requested_date" readonly>
                        </div>
                        
                        @if ($hd->reviewed_status == "Y")
                            <div class="col-md-4 mb-4 mb-md-0 text-center px-3">
                                <label class="text-left">ผู้จัดการฝ่าย (ผู้ทบทวน)</label>
                                <input class="form-control-modern mb-2" type="text" value="{{ $hd->reviewed_by }}" name="reviewed_by" readonly>
                                <input class="form-control-modern" type="date" value="{{ $hd->reviewed_date }}" name="reviewed_date">
                            </div>
                            <div class="col-md-4 text-center px-3">
                                <label class="text-left" style="color: #4f46e5;"><i class="fas fa-pen-fancy"></i> ผู้อนุมัติ (การกระทำของคุณ)</label>
                                <input class="form-control-modern mb-2" type="text" name="approved_by" value="{{ auth()->user()->name }}" readonly style="border: 1px solid #818cf8;">
                                <input class="form-control-modern" type="date" name="approved_date" value="{{ old('date', now()->format('Y-m-d')) }}" style="border: 1px solid #818cf8;">
                            </div>
                            <input type="hidden" name="reviewed_status" value="Y">
                            <input type="hidden" name="approved_status" value="Y">
                        @else
                            <div class="col-md-4 mb-4 mb-md-0 text-center px-3">
                                <label class="text-left" style="color: #4f46e5;"><i class="fas fa-pen-fancy"></i> ผู้จัดการฝ่าย (การกระทำของคุณ)</label>
                                <input class="form-control-modern mb-2" type="text" value="{{ auth()->user()->name }}" name="reviewed_by" readonly style="border: 1px solid #818cf8;">
                                <input class="form-control-modern" type="date" value="{{ old('date', now()->format('Y-m-d')) }}" name="reviewed_date" style="border: 1px solid #818cf8;">
                            </div>
                            <div class="col-md-4 text-center px-3">
                                <label class="text-left">ผู้อนุมัติ</label>
                                <input class="form-control-modern mb-2" type="text" name="approved_by" readonly placeholder="รอการทบทวนเสร็จสิ้น">
                                <input class="form-control-modern" type="date" name="approved_date" readonly>
                            </div>
                            <input type="hidden" name="reviewed_status" value="Y">
                            <input type="hidden" name="approved_status" value="N">
                        @endif                   
                    </div> 
                </div> 

                @if ($hd->approved_status == "N")
                    <div class="row justify-content-end">
                        <div class="col-12 col-md-3 col-lg-2">
                            <button type="submit" class="btn-indigo-submit">
                                <i class="fas fa-check-circle"></i> บันทึกการลงนาม
                            </button>
                        </div>
                    </div>
                @endif              
            </form>                 
        </div>
    </div>
</div>

@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
</script>
@endpush