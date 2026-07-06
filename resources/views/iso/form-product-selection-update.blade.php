@extends('layouts.main')
@section('content')

<!-- Sweet Alert & Modern Indigo Styles -->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    /* Modern Indigo Theme Variables & Utilities */
    :root {
        --indigo-primary: #6366f1;
        --indigo-dark: #4338ca;
        --indigo-light: #e0e7ff;
        --indigo-bg: #f8fafc;
        --radius-md: 12px;
        --radius-sm: 8px;
    }

    body {
        background-color: var(--indigo-bg);
    }

    .modern-card {
        border: none;
        border-radius: var(--radius-md);
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
        background: #ffffff;
        overflow: hidden;
    }

    .modern-header {
        background: linear-gradient(135deg, var(--indigo-dark) 0%, var(--indigo-primary) 100%);
        color: #ffffff;
        padding: 1.5rem;
        border-bottom: none;
    }

    .modern-header h5 {
        font-weight: 700;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .section-title {
        color: var(--indigo-dark);
        border-left: 4px solid var(--indigo-primary);
        padding-left: 10px;
        font-weight: 600;
        margin-bottom: 1.25rem;
    }

    .form-control, .form-select {
        border-radius: var(--radius-sm) !important;
        border: 1px solid #cbd5e1 !important;
        padding: 0.45rem 0.75rem;
        background-color: #ffffff;
        color: #334155;
    }

    .form-control[readonly], .form-control[disabled] {
        background-color: #f1f5f9 !important;
        color: #64748b;
    }

    /* Table Styling */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: var(--radius-sm);
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .table-modern thead th {
        background-color: var(--indigo-light) !important;
        color: var(--indigo-dark);
        font-weight: 600;
        border-bottom: 2px solid #cbd5e1 !important;
        vertical-align: middle !important;
    }

    .table-modern tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Custom Badges */
    .badge-modern {
        padding: 0.45em 0.85em;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .badge-modern-warning { background-color: #fef3c7; color: #d97706; }
    .badge-modern-success { background-color: #dcfce7; color: #15803d; }

    /* Button Action */
    .btn-action-indigo {
        background-color: var(--indigo-primary);
        color: white;
        border: none;
        padding: 0.25rem 0.6rem;
        border-radius: var(--radius-sm);
        transition: all 0.2s;
    }
    .btn-action-indigo:hover {
        background-color: var(--indigo-dark);
        color: white;
        box-shadow: 0 2px 4px rgba(99, 102, 241, 0.4);
    }
    
    .evaluation-block {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: var(--radius-md);
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
</style>

<div class="container-fluid mt-4">
    <div class="row">  
        <div class="col-12">
            <div class="card modern-card">
                <!-- Header ส่วนหัวข้อ -->
                <div class="card-header modern-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">ESSOM CO.,LTD</h5>
                        <small class="opacity-75">ใบคัดเลือกสินค้า/ผู้ขายและประเมิน (SUPPLIER QUALIFICATION AND EVALUATION)</small>
                    </div>
                    <div class="text-right">
                        <span class="badge badge-light text-dark font-weight-bold">F8411.1</span><br>
                        <small class="opacity-75">15 Aug. 19</small>
                    </div>             
                </div>

                <div class="card-body p-4">       
                    <input type="hidden" name="checkdoc" value="Update">    

                    <!-- ส่วนที่ 1: ประเภทสินค้า -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="section-title">ประเภทสินค้า</h5>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small text-muted font-weight-bold" for="product_type1">ประเภทที่ 1</label>
                            <input type="text" class="form-control" name="product_type1" value="{{$hd->product_type1}}" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small text-muted font-weight-bold" for="product_type2">ประเภทที่ 2</label>
                            <input type="text" class="form-control" name="product_type2" value="{{$hd->product_type2}}">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small text-muted font-weight-bold" for="product_type3">ประเภทที่ 3</label>
                            <input type="text" class="form-control" name="product_type3" value="{{$hd->product_type3}}">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small text-muted font-weight-bold" for="product_type4">ประเภทที่ 4</label>
                            <input type="text" class="form-control" name="product_type4" value="{{$hd->product_type4}}">
                        </div>
                    </div>

                    <!-- ส่วนที่ 2: ตารางรายละเอียดผู้ขาย -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="section-title">รายละเอียดผู้ขายและการตรวจเยี่ยม</h5>
                        </div>
                        <div class="col-12 table-responsive">
                            <table class="table table-modern text-center" id="destroyTable">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="width: 3%">ลำดับ</th>
                                        <th rowspan="2" style="width: 25%">รายละเอียดผู้ขายสินค้า</th>
                                        <th rowspan="2" style="width: 10%">ยี่ห้อ</th>
                                        <th rowspan="2" style="width: 6%">(A)</th>
                                        <th rowspan="2" style="width: 10%">(B)</th>
                                        <th rowspan="2" style="width: 6%">(C)</th>
                                        <th colspan="3" style="width: 15%">ผลการตรวจเยี่ยมสถานที่ผู้ขาย</th>
                                        <th rowspan="2" style="width: 15%">หมายเหตุ</th>
                                        <th rowspan="2" style="width: 10%">ไฟล์แนบ</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 5%">ระบบ</th>
                                        <th style="width: 5%">บุคลากร</th>
                                        <th style="width: 5%">เครื่องมือ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dt as $item)
                                        <tr>
                                            <td class="align-middle bg-light font-weight-bold">
                                                {{$item->product_selection_dt_listno}}
                                                <input type="hidden" name="product_selection_dt_id[]" value="{{$item->product_selection_dt_id}}">
                                            </td>
                                            <td class="p-2">
                                                <input class="form-control form-control-sm mb-1" name="product_selection_dt_vendor[]" value="{{$item->product_selection_dt_vendor}}" readonly>
                                                <input class="form-control form-control-sm mb-1" name="product_selection_dt_vendor_name[]" value="{{$item->product_selection_dt_vendor_name}}" readonly>
                                                <input class="form-control form-control-sm mb-1" name="product_selection_dt_vendor_tel[]" value="{{$item->product_selection_dt_vendor_tel}}" readonly>
                                                <input class="form-control form-control-sm mb-1" name="product_selection_dt_vendor_email[]" value="{{$item->product_selection_dt_vendor_email}}" readonly>
                                                <input class="form-control form-control-sm" name="product_selection_dt_vendor_remark[]" value="{{$item->product_selection_dt_vendor_remark}}" readonly>
                                            </td>
                                            <td class="align-middle">
                                                <input class="form-control form-control-sm" name="product_selection_dt_brand[]" value="{{$item->product_selection_dt_brand}}" readonly>                                        
                                            </td>
                                            <td class="align-middle">
                                                <select class="form-control form-control-sm" name="product_selection_hd_grade_a[]" disabled>
                                                    <option value="1" {{ $item->product_selection_hd_grade_a ? 'selected' : '' }}>/</option>
                                                    <option value="0" {{ !$item->product_selection_hd_grade_a ? 'selected' : '' }}></option>
                                                </select>
                                            </td>
                                            <td class="align-middle">
                                                <input type="text" class="form-control form-control-sm" name="product_selection_hd_grade_b[]" value="{{$item->product_selection_hd_grade_b}}" readonly>
                                            </td>
                                            <td class="align-middle">
                                                <select class="form-control form-control-sm" name="product_selection_hd_grade_c[]" disabled>
                                                    <option value="1" {{ $item->product_selection_hd_grade_c ? 'selected' : '' }}>/</option>
                                                    <option value="0" {{ !$item->product_selection_hd_grade_c ? 'selected' : '' }}></option>
                                                </select>
                                            </td>
                                            <td class="align-middle">
                                                <select class="form-control form-control-sm" name="product_selection_hd_results1[]" disabled>
                                                    <option value="1" {{ $item->product_selection_hd_results1 ? 'selected' : '' }}>/</option>
                                                    <option value="0" {{ !$item->product_selection_hd_results1 ? 'selected' : '' }}></option>
                                                </select>
                                            </td>
                                            <td class="align-middle">
                                                 <select class="form-control form-control-sm" name="product_selection_hd_results2[]" disabled>
                                                    <option value="1" {{ $item->product_selection_hd_results2 ? 'selected' : '' }}>/</option>
                                                    <option value="0" {{ !$item->product_selection_hd_results2 ? 'selected' : '' }}></option>
                                                </select>
                                            </td>
                                            <td class="align-middle">
                                                <select class="form-control form-control-sm" name="product_selection_hd_results3[]" disabled>
                                                    <option value="1" {{ $item->product_selection_hd_results3 ? 'selected' : '' }}>/</option>
                                                    <option value="0" {{ !$item->product_selection_hd_results3 ? 'selected' : '' }}></option>
                                                </select>
                                            </td>
                                            <td class="align-middle">
                                                <input class="form-control form-control-sm" name="product_selection_dt_remark[]" value="{{$item->product_selection_dt_remark}}" readonly>
                                            </td>
                                            <td class="align-middle">
                                                @if ($item->product_selection_dt_file)
                                                    <a href="{{asset($item->product_selection_dt_file)}}" target="_blank" class="text-indigo">
                                                        <i class="fas fa-file-alt fa-lg"></i> เปิดไฟล์
                                                    </a>
                                                @else
                                                    <span class="text-muted small">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="alert bg-light border text-muted small">
                                <strong>คำอธิบายเพิ่มเติม:</strong> (A) คุณสมบัติสินค้าตรงความต้องการ, (B) มาตรฐานของสินค้าบริการ, (C) สินค้า/บริการเป็นที่ยอมรับ
                            </div>
                        </div>
                    </div>

                    <!-- ส่วนที่ 3: ใบประเมินสินค้าแยกตามรายการผู้ขาย -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="section-title">ใบประเมินสินค้า/ผู้ขาย</h5>
                        </div>
                        <div class="col-12">
                            @foreach ($sub as $vendorListNo => $items)
                                <div class="evaluation-block mb-4">
                                    <h6 class="font-weight-bold text-indigo mb-3">
                                        <i class="fas fa-clipboard-check mr-2"></i>ใบประเมินลำดับที่ {{ $vendorListNo }}
                                    </h6>
                                    <div class="table-responsive">
                                        <table class="table table-modern table-sm text-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" style="width: 5%">ลำดับ</th>
                                                    <th rowspan="2" style="width: 35%" class="text-left">รายการประเมิน</th>
                                                    <th colspan="3">(1) คุณภาพสินค้า</th>
                                                    <th colspan="3">(2) ความเรียบร้อย</th>
                                                    <th colspan="3">(3) การบริการ</th>
                                                    <th colspan="3">(4) หลังการขาย</th>
                                                </tr>
                                                <tr>
                                                    <th class="small text-muted">ดี</th><th class="small text-muted">พอใช้</th><th class="small text-muted">ไม่ดี</th>
                                                    <th class="small text-muted">ดี</th><th class="small text-muted">พอใช้</th><th class="small text-muted">ไม่ดี</th>
                                                    <th class="small text-muted">ดี</th><th class="small text-muted">พอใช้</th><th class="small text-muted">ไม่ดี</th>
                                                    <th class="small text-muted">ดี</th><th class="small text-muted">พอใช้</th><th class="small text-muted">ไม่ดี</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($items as $item)
                                                    <tr>
                                                        <td class="align-middle bg-light font-weight-bold">{{ $item->product_selection_sub_listno }}</td>
                                                        <td class="text-left align-middle font-weight-500">
                                                            {{ $item->product_selection_sub_name }}
                                                            <input type="hidden" name="product_selection_sub_id[]" value="{{ $item->product_selection_sub_id }}">
                                                        </td>

                                                        @for ($group = 1; $group <= 4; $group++)
                                                            @for ($grade = 1; $grade <= 3; $grade++)
                                                                @php
                                                                    $field = "product_selection_hd_results{$group}_{$grade}";
                                                                @endphp
                                                                <td class="align-middle">
                                                                    <select class="form-control form-control-sm text-center" name="{{ $field }}[]" disabled>
                                                                        <option value="0" {{ $item->$field == 0 ? 'selected' : '' }}></option>
                                                                        <option value="1" {{ $item->$field == 1 ? 'selected' : '' }}>/</option>
                                                                    </select>
                                                                </td>
                                                            @endfor
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- ส่วนที่ 4: หมายเหตุเพิ่มเติม -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="font-weight-500 text-secondary" for="product_selection_hd_remark">หมายเหตุ</label>
                            <textarea class="form-control" name="product_selection_hd_remark" rows="3" disabled>{{$hd->product_selection_hd_remark}}</textarea>
                        </div>                    
                    </div>

                    <!-- ส่วนที่ 5: ลายเซ็นและการอนุมัติ -->
                    <div class="row p-3 bg-light rounded border g-3">
                        <!-- จัดทำโดย -->
                        <div class="col-md-4 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="font-weight-bold text-dark m-0">จัดทำโดย</label>
                            </div>
                            <input class="form-control mb-2" name="requested_by" value="{{$hd->requested_by}}" readonly>
                            <label class="small text-muted mb-1">วันที่จัดทำ</label>
                            <input class="form-control" type="date" name="requested_date" value="{{$hd->requested_date}}" readonly>
                        </div>

                        <!-- ทบทวนโดย -->
                        <div class="col-md-4 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="font-weight-bold text-dark m-0">ทบทวนโดย</label>
                                @if ($hd->reviewed_status == "N")
                                    @if ($hd->reviewed_by == auth()->user()->name)
                                        <a href="javascript:void(0)" class="btn-action-indigo btn-sm" onclick="confirmApp('{{ $hd->product_selection_hd_id }}','reviewed')">
                                            <i class="fas fa-check mr-1"></i> อนุมัติ
                                        </a>
                                    @else
                                        <span class="badge-modern badge-modern-warning"><i class="fas fa-clock"></i> รอดำเนินการ</span>
                                    @endif                           
                                @else
                                    <span class="badge-modern badge-modern-success"><i class="fas fa-check-circle"></i> เรียบร้อย</span>
                                @endif
                            </div>
                            <input class="form-control mb-2" name="reviewed_by" value="{{$hd->reviewed_by}}" readonly>
                            <label class="small text-muted mb-1">วันที่ทบทวน</label>
                            <input class="form-control" type="date" name="reviewed_date" value="{{ $hd->reviewed_date }}" readonly>
                        </div> 

                        <!-- อนุมัติโดย (ขั้นแรก) -->
                        <div class="col-md-4 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="font-weight-bold text-dark m-0">อนุมัติโดย</label>
                                @if ($hd->approved_status1 == "N")
                                    @if ($hd->approved_by1 == auth()->user()->name)
                                        <a href="javascript:void(0)" class="btn-action-indigo btn-sm" onclick="confirmApp('{{ $hd->product_selection_hd_id }}','approved1')">
                                            <i class="fas fa-check mr-1"></i> อนุมัติ
                                        </a>
                                    @else
                                        <span class="badge-modern badge-modern-warning"><i class="fas fa-clock"></i> รอดำเนินการ</span>
                                    @endif
                                @else
                                    <span class="badge-modern badge-modern-success"><i class="fas fa-check-circle"></i> เรียบร้อย</span>
                                @endif
                            </div>
                            <input class="form-control mb-2" name="approved_by1" value="{{$hd->approved_by1}}" readonly>
                            <label class="small text-muted mb-1">วันที่อนุมัติ</label>
                            <input class="form-control" type="date" name="approved_date1" value="{{ $hd->approved_date1 }}" readonly>
                        </div>                       

                        <!-- ผู้ประเมินสินค้า -->
                        <div class="col-md-4 mb-3">
                            <label class="font-weight-bold text-dark mb-1">ผู้ประเมินสินค้า</label>
                            <input class="form-control mb-2" name="assessor_by" value="{{$hd->assessor_by}}" readonly>
                            <label class="small text-muted mb-1">วันที่ประเมิน</label>
                            <input class="form-control" type="date" name="assessor_date" value="{{$hd->assessor_date }}" readonly>
                        </div>

                        <!-- ผู้ประเมินบริการ -->
                        <div class="col-md-4 mb-3">
                            <label class="font-weight-bold text-dark mb-1">ผู้ประเมินบริการ</label>
                            <input class="form-control mb-2" name="purchase_by" value="{{$hd->purchase_by}}" readonly>
                            <label class="small text-muted mb-1">วันที่ประเมิน</label>
                            <input class="form-control" type="date" name="purchase_date" value="{{$hd->purchase_date }}" readonly>
                        </div>

                        <!-- ผู้อนุมัติขั้นสุดท้าย -->
                        <div class="col-md-4 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="font-weight-bold text-dark m-0">ผู้อนุมัติขั้นสุดท้าย</label>
                                @if ($hd->approved_status2 == "N")
                                    @if ($hd->approved_by2 == auth()->user()->name)
                                        <a href="javascript:void(0)" class="btn-action-indigo btn-sm" onclick="confirmApp('{{ $hd->product_selection_hd_id }}','approved2')">
                                            <i class="fas fa-check mr-1"></i> อนุมัติ
                                        </a>
                                    @else
                                        <span class="badge-modern badge-modern-warning"><i class="fas fa-clock"></i> รอดำเนินการ</span>
                                    @endif                                
                                @else
                                    <span class="badge-modern badge-modern-success"><i class="fas fa-check-circle"></i> เรียบร้อย</span>
                                @endif
                            </div>
                            <input class="form-control mb-2" name="approved_by2" value="{{$hd->approved_by2}}" readonly>
                            <label class="small text-muted mb-1">วันที่อนุมัติ</label>
                            <input class="form-control" type="date" name="approved_date2" value="{{ $hd->approved_date2}}" readonly>
                        </div>                 
                    </div>

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
// ฟังก์ชันเพิ่มแถวแบบไดนามิก (กรณีเปิดใช้งานในอนาคต)
function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td class="align-middle bg-light font-weight-bold">
            <span class="row-number">${rowCount}</span>
            <input type="hidden" name="product_selection_dt_listno[]" value="${rowCount}">            
        </td>
        <td class="p-2">
            <textarea class="form-control form-control-sm" placeholder="รายละเอียดผู้ขายสินค้า" name="product_selection_dt_vendor[]" rows="2"></textarea>
        </td>
        <td class="align-middle">
            <input type="text" class="form-control form-control-sm" placeholder="ยี่ห้อ" name="product_selection_dt_brand[]">
        </td>
        <td class="align-middle">
            <select class="form-control form-control-sm" name="product_selection_hd_grade_a[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td class="align-middle">
            <select class="form-control form-control-sm" name="product_selection_hd_grade_b[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td class="align-middle">
            <select class="form-control form-control-sm" name="product_selection_hd_grade_c[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td class="align-middle">
            <select class="form-control form-control-sm" name="product_selection_hd_results1[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td class="align-middle">
            <select class="form-control form-control-sm" name="product_selection_hd_results2[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td class="align-middle">
            <select class="form-control form-control-sm" name="product_selection_hd_results3[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td class="align-middle">
            <input type="text" class="form-control form-control-sm" placeholder="หมายเหตุ" name="product_selection_dt_remark[]">
        </td>
        <td class="align-middle text-center">
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRow(this)"><i class="fas fa-trash-alt"></i></button>
        </td>
    `;
    tableBody.appendChild(row);
}

function removeRow(button) {
    button.closest("tr").remove();
    updateRowNumbers();
}

function updateRowNumbers() {
    document.querySelectorAll("#destroyTable tbody tr").forEach((row, index) => {
        const number = index + 1;
        const numSpan = row.querySelector(".row-number");
        if(numSpan) numSpan.textContent = number;
        
        const listInput = row.querySelector('input[name="product_selection_dt_listno[]"]');
        if(listInput) listInput.value = number;
    });
}

confirmApp = (refid, status) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการอนุมัติรายการนี้หรือไม่ ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        confirmButtonClass: 'btn btn-success mt-2',
        cancelButtonClass: 'btn btn-danger ml-2 mt-2',
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/ApprovedProductSelectionHd') }}`,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "refid": refid,
                    'status': status
                },
                dataType: "json",
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire({
                            title: 'สำเร็จ',
                            text: 'อนุมัติเอกสารเรียบร้อยแล้ว',
                            icon: 'success'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'อนุมัติเอกสารไม่สำเร็จ',
                            icon: 'error'
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิก',
                text: 'โปรดตรวจสอบข้อมูลอีกครั้งเพื่อความถูกต้อง :)',
                icon: 'error'
            });
        }
    });
}
</script>
@endpush