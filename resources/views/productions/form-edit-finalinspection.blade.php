@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    :root {
        --primary-indigo: #4f46e5;
        --primary-hover: #4338ca;
        --light-indigo: #f5f3ff;
        --indigo-focus: rgba(79, 70, 229, 0.15);
        --text-main: #1f2937;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
    }

    body {
        background-color: #f8fafc;
        color: var(--text-main);
    }

    .custom-card {
        background: #ffffff;
        border: none;
        border-radius: 20px;
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.02);
    }

    .page-title a {
        color: var(--primary-indigo) !important;
        font-weight: 700;
        letter-spacing: -0.5px;
        transition: color 0.2s;
        text-decoration: none !important;
    }

    .page-title a:hover {
        color: var(--primary-hover) !important;
    }

    /* ปรับแต่ง Form Elements */
    .form-group label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-muted);
        margin-bottom: 0.4rem;
    }

    .form-control, .form-select, .form-control[readonly] {
        border-radius: 12px;
        border: 1px solid var(--border-color);
        padding: 0.65rem 1rem;
        font-size: 0.95rem;
        background-color: #ffffff;
        transition: all 0.2s ease;
    }

    .form-control[readonly] {
        background-color: #f8fafc;
        color: #475569;
        border-style: dashed;
    }

    .form-control:focus {
        border-color: var(--primary-indigo);
        box-shadow: 0 0 0 4px var(--indigo-focus);
    }

    /* สไตล์ปุ่มกดหลัก */
    .btn-indigo {
        background-color: var(--primary-indigo);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 0.65rem 1.5rem;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-indigo:hover {
        background-color: var(--primary-hover);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
    }

    /* ลิงก์ดาวน์โหลดเอกสาร PDF */
    .pdf-link-box {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fff1f2;
        color: #e11d48 !important;
        border: 1px solid #ffe4e6;
        border-radius: 12px;
        height: calc(2.25rem + 10px);
        font-size: 1.2rem;
        transition: all 0.2s;
    }

    .pdf-link-box:hover {
        background-color: #ffe4e6;
        transform: scale(1.03);
    }

    /* ส่วนแบ่งระดับขั้นการตรวจสอบ */
    .flow-section-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--primary-indigo);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
    }

    .flow-divider {
        border-top: 1px solid #f1f5f9;
        margin: 1.5rem 0;
    }

    /* ปรับแต่ง Tabs ด้านล่างให้ดูคลีน */
    .modern-tabs {
        border-bottom: 2px solid #f1f5f9;
    }

    .modern-tabs .nav-link {
        border: none !important;
        color: var(--text-muted);
        font-weight: 600;
        padding: 1rem 1.5rem;
        position: relative;
        background: transparent !important;
    }

    .modern-tabs .nav-link.active {
        color: var(--primary-indigo) !important;
    }

    .modern-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 3px;
        background-color: var(--primary-indigo);
        border-radius: 3px 3px 0 0;
    }

    /* สไตล์ตารางเอกสารแนบ */
    .modern-table thead th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        border-bottom: 2px solid #e2e8f0;
        padding: 14px;
    }

    .modern-table td {
        padding: 14px;
        vertical-align: middle;
        color: var(--text-main);
    }

    /* ปรับแต่งสไตล์ Alert */
    .custom-alert {
        border: none;
        border-radius: 12px;
        padding: 1rem 1.25rem;
    }
</style>

<div class="container-fluid pt-4">
    @if(session('success'))
    <div class="alert alert-success custom-alert alert-dismissible fade show shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle me-2 h5 mb-0 text-success"></i>
            <span class="ml-2">{{ session('success') }}</span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger custom-alert alert-dismissible fade show shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-exclamation-circle me-2 h5 mb-0 text-danger"></i>
            <span class="ml-2">{{ session('error') }}</span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <form id="frm_sub" method="POST" action="{{ route('fl-inst.update', $hd->finalInspection_hd_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body p-4">
                        <div class="row align-items-center mb-4">
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <h3 class="page-title m-0">
                                    <a href="{{route('fl-inst.index')}}">
                                        <i class="fas fa-chevron-left mr-2 small" style="font-size:1.1rem;"></i>ตรวจสอบขั้นตอนสุดท้าย
                                    </a>
                                </h3>
                            </div>
                            
                            @if($hd->finalInspection_status_id != 3)
                            <div class="col-12 col-md-2">
                                <div class="form-group mb-0">
                                    <select class="form-control" name="finalInspection_status_id" id="finalInspection_status_id" required autofocus>
                                        <option value="">กรุณาเลือกสถานะที่ต้องการเปลี่ยน</option>
                                        @foreach ($sta as $item)
                                        <option value="{{$item->finalInspection_status_id}}">{{$item->finalInspection_status_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control" placeholder="ระบุหมายเหตุการอัปเดต..." name="note" id="note">
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <button type="submit" class="btn btn-indigo w-100 shadow-sm">
                                    <i class="fas fa-save mr-2"></i>บันทึกสถานะ
                                </button>
                            </div>
                            @endif              
                        </div>

                        <hr class="flow-divider">

                        <div class="row mb-3">
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label>วันที่</label>
                                    <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($hd->finalInspection_hd_date)->format('d/m/Y')}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label>เลขที่เอกสาร</label>
                                    <input type="text" class="form-control font-weight-bold text-dark" value="{{$hd->finalInspection_hd_docuno}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label>เลขที่ใบเปิดงาน</label>
                                    <input type="text" class="form-control" value="{{$hd->productionopenjob_hd_docuno}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label>Serial No.</label>
                                    <input type="text" class="form-control text-primary font-weight-bold" value="{{$hd->serialno}}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label>Ship to</label>
                                    <input type="text" class="form-control" value="{{$hd->finalInspection_hd_shipto}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label>Shipping dimensions (cm.)</label>
                                    <input type="text" class="form-control" value="{{$hd->finalInspection_hd_dimensions}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label>Weight (kg.)</label>
                                    <input type="text" class="form-control" value="{{$hd->finalInspection_hd_weight}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label>Rev.</label>
                                    <input type="text" class="form-control" value="{{$hd->ms_finalspec_hd_code}} {{$hd->ms_finalspec_hd_rev}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-1">
                                <div class="form-group">
                                    <label>Doc File</label>
                                    <a href="{{asset($hd->finalInspection_hd_filename)}}" target="_blank" class="pdf-link-box" title="เปิดไฟล์เอกสารแนบ">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                </div>
                            </div>              
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>ลูกค้า</label>
                                    <input type="text" class="form-control" value="{{$hd->ms_customer_name}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>สินค้า</label>
                                    <input type="text" class="form-control" value="{{$hd->ms_product_name}} ({{$hd->ms_product_code}})" readonly>
                                </div>
                            </div>              
                        </div>

                        <hr class="flow-divider">

                        <div class="bg-light p-3 rounded-lg mb-4" style="border-radius: 16px;">
                            <div class="row mb-3 align-items-center">
                                <div class="col-12 col-md-3">
                                    <div class="form-group mb-md-0">
                                        <label class="flow-section-title mb-1"><i class="fas fa-user-edit mr-2"></i>ผู้บันทึกขั้นที่ 1</label>
                                        <input type="text" class="form-control" value="{{$hd->created_person}}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="form-group mb-0">
                                        <label>หมายเหตุบันทึกขั้นที่ 1</label>
                                        <input type="text" class="form-control" value="{{$hd->finalInspection_hd_note}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-center">
                                <div class="col-12 col-md-3">
                                    <div class="form-group mb-md-0">
                                        <label class="flow-section-title mb-1"><i class="fas fa-user-check mr-2"></i>ผู้บันทึกขั้นที่ 2</label>
                                        <input type="text" class="form-control" value="{{$hd->checked_by}}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="form-group mb-0">
                                        <label>หมายเหตุบันทึกขั้นที่ 2</label>
                                        <input type="text" class="form-control" value="{{$hd->checked_note}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-12 col-md-3">
                                    <div class="form-group mb-md-0">
                                        <label class="flow-section-title mb-1"><i class="fas fa-user-shield mr-2"></i>ผู้อนุมัติ</label>
                                        <input type="text" class="form-control" value="{{$hd->approved_by}}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="form-group mb-0">
                                        <label>หมายเหตุการอนุมัติ</label>
                                        <input type="text" class="form-control" value="{{$hd->approved_note}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">             
                            <div class="col-12">
                                <div class="card shadow-none border-0">
                                    <div class="card-header p-0 bg-transparent border-0">
                                        <ul class="nav nav-tabs modern-tabs" id="custom-tabs-four-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-four-profile1-tab" data-toggle="pill" href="#custom-tabs-four-profile1" role="tab" aria-controls="custom-tabs-four-profile1" aria-selected="true">
                                                    <i class="fas fa-paperclip mr-2"></i>เอกสารแนบเพิ่มเติม
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body px-0 pt-3">
                                        <div class="tab-content" id="custom-tabs-four-tabContent">
                                            <div class="tab-pane fade show active" id="custom-tabs-four-profile1" role="tabpanel" aria-labelledby="custom-tabs-four-profile1-tab">
                                                <div class="table-responsive">
                                                    <table class="table modern-table table-hover">        
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 100px;">ลำดับ</th>
                                                                <th>รายละเอียด / คำอธิบายเอกสาร</th>
                                                                <th style="width: 120px;" class="text-center">ดาวน์โหลด</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($dt3 as $item)
                                                            <tr>
                                                                <td class="font-weight-bold text-secondary">{{$item->finalInspection_part_listno}}</td>
                                                                <td>{{$item->finalInspection_part_remark}}</td>
                                                                <td class="text-center">
                                                                    <a href="{{asset($item->finalInspection_part_filename)}}" target="_blank" class="btn btn-light btn-sm text-danger" style="border-radius: 8px; padding: 6px 12px;">
                                                                        <i class="fas fa-file-pdf mr-1"></i> เปิดดูไฟล์
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="3" class="text-center text-muted py-4">ไม่มีเอกสารแนบเพิ่มเติมในระบบ</td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scriptjs')
<script>
    // พื้นที่สำหรับเขียนสคริปต์เพิ่มเติมในอนาคต
</script>
@endpush