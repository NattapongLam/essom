@extends('layouts.main')
@section('content')

<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Theme Design System */
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #f5f3ff;
        --indigo-border: #e0e7ff;
        --indigo-text: #312e81;
        --surface-bg: #f8fafc;
        --text-main: #1e293b;
        --text-muted: #64748b;
    }

    body {
        background-color: var(--surface-bg);
        color: var(--text-main);
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.05), 0 8px 10px -6px rgba(79, 70, 229, 0.05);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 2rem;
    }

    .company-title {
        color: var(--indigo-primary);
        font-weight: 800;
        letter-spacing: 0.5px;
    }

    .doc-subtitle {
        color: var(--text-main);
        font-weight: 600;
        font-size: 1.1rem;
    }

    .section-title {
        color: var(--indigo-text);
        font-weight: 600;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Form Controls */
    .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.6rem 0.8rem;
        height: auto;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        background-color: #ffffff;
    }

    .form-control:focus {
        border-color: var(--indigo-primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }

    label {
        font-weight: 500;
        color: var(--text-muted);
        font-size: 0.85rem;
        margin-bottom: 0.4rem;
    }

    /* Modern Tables */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
        width: 100% !important;
    }

    .table-modern thead th {
        background-color: var(--indigo-light) !important;
        color: var(--indigo-text) !important;
        font-weight: 600;
        border: 1px solid var(--indigo-border) !important;
        padding: 12px 8px !important;
        font-size: 0.85rem;
        vertical-align: middle !important;
    }

    .table-modern td {
        padding: 12px 8px !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
        border-top: none !important;
        border-left: 1px solid #f1f5f9 !important;
        border-right: 1px solid #f1f5f9 !important;
        background: #ffffff;
    }

    /* Buttons */
    .btn-indigo {
        background-color: var(--indigo-primary);
        color: white !important;
        border-radius: 10px;
        font-weight: 500;
        padding: 0.6rem 1.5rem;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-indigo:hover {
        background-color: var(--indigo-hover);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
    }

    .btn-success-modern {
        background-color: #10b981;
        color: white !important;
        border-radius: 8px;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-success-modern:hover {
        background-color: #059669;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
    }

    /* Evaluation Blocks */
    .evaluation-block {
        background: #fafafa;
        border: 1px solid #f1f5f9;
        border-radius: 12px;
        padding: 1.5rem;
        border-left: 4px solid var(--indigo-primary);
    }

    /* Select2 Restyling to match design */
    .select2-container--default .select2-selection--single {
        border: 1px solid #e2e8f0 !important;
        border-radius: 10px !important;
        height: 42px !important;
        display: flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px !important;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                
                <div class="custom-card-header text-center position-relative">
                    <h4 class="company-title mb-1">ESSOM CO.,LTD</h4>
                    <h5 class="doc-subtitle mb-0">ใบคัดเลือกสินค้า/ผู้ขายและประเมิน (SUPPLIER QUALIFICATION AND EVALUATION)</h5>
                    <div class="position-absolute text-right text-muted" style="right: 2rem; top: 2rem; font-size: 0.85rem; line-height: 1.4;">
                        <strong>F8411.1</strong><br>15 Aug. 19
                    </div>              
                </div>
          
                <div class="card-body p-4">       
                    <form method="POST" class="form-horizontal" action="{{ route('product-selection.store') }}" enctype="multipart/form-data">
                        @csrf        
                        
                        <div class="row align-items-end">
                            <div class="col-md-6 mb-3">
                                <h5 class="section-title mb-0">
                                    <i class="fas fa-boxes text-indigo"></i> ประเภทสินค้า
                                </h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="product_selection_hd_type">ประเภทจัดซื้อ</label>
                                <select class="form-control text-center" name="product_selection_hd_type">
                                    <option value="">กรุณาเลือก</option>
                                    <option value="โรงงาน">โรงงาน</option>
                                    <option value="สำนักงาน">สำนักงาน</option>
                                    <option value="ต่างประเทศ">ต่างประเทศ</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-3 mb-2">
                                <label for="product_type1">ระบุประเภทสินค้า 1 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="product_type1" required placeholder="ประเภทที่ 1">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="product_type2">ระบุประเภทสินค้า 2</label>
                                <input type="text" class="form-control" name="product_type2" placeholder="ประเภทที่ 2">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="product_type3">ระบุประเภทสินค้า 3</label>
                                <input type="text" class="form-control" name="product_type3" placeholder="ประเภทที่ 3">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="product_type4">ระบุประเภทสินค้า 4</label>
                                <input type="text" class="form-control" name="product_type4" placeholder="ประเภทที่ 4">
                            </div>
                        </div>

                        <hr class="my-4" style="border-color: #f1f5f9;">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="section-title mb-0">
                                <i class="fas fa-store text-indigo"></i> รายละเอียดผู้ขายสินค้าและเกณฑ์พิจารณา
                            </h5>
                            <button type="button" class="btn btn-success-modern btn-sm" onclick="addRow()">
                                <i class="fas fa-plus mr-1"></i> เพิ่มแถวผู้ขาย
                            </button>
                        </div>

                        <div class="table-responsive mb-3">
                            <table class="table table-modern text-center" id="destroyTable">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="width: 4%">ลำดับ</th>
                                        <th rowspan="2" style="width: 25%">รายละเอียดผู้ขายสินค้า</th>
                                        <th rowspan="2" style="width: 12%">ยี่ห้อ</th>
                                        <th colspan="3" style="width: 18%">คุณสมบัติเบื้องต้น</th>
                                        <th colspan="3" style="width: 18%">ผลการตรวจเยี่ยมสถานที่ผู้ขาย</th>
                                        <th rowspan="2" style="width: 12%">หมายเหตุ</th>
                                        <th rowspan="2" style="width: 8%">ไฟล์แนบ</th>
                                        <th rowspan="2" style="width: 3%">ลบ</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 6%">(A)</th>
                                        <th style="width: 6%">(B)</th>
                                        <th style="width: 6%">(C)</th>
                                        <th style="width: 6%">ระบบ</th>
                                        <th style="width: 6%">บุคลากร</th>
                                        <th style="width: 6%">เครื่องมือ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    </tbody>
                            </table>
                        </div>

                        <div class="card p-3 mb-4" style="background-color: var(--indigo-light); border: 1px solid var(--indigo-border); border-radius: 10px;">
                            <span class="text-indigo font-weight-500" style="font-size: 0.85rem; letter-spacing: 0.3px;">
                                <i class="fas fa-info-circle mr-1"></i> <strong>คำอธิบายเกณฑ์:</strong> (A) คุณสมบัติสินค้าตรงความต้องการ, (B) มาตรฐานของสินค้าบริการ, (C) สินค้า/บริการเป็นที่ยอมรับ
                            </span>
                        </div>

                        <div id="evaluationContainer" class="mb-4"></div>

                        <hr class="my-4" style="border-color: #f1f5f9;">

                        <h5 class="section-title mb-3">
                            <i class="fas fa-file-signature text-indigo"></i> ข้อมูลการตรวจสอบและบันทึกข้อมูล
                        </h5>

                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <label for="product_selection_hd_remark">หมายเหตุเพิ่มเติม</label>
                                <textarea class="form-control" name="product_selection_hd_remark" rows="2" placeholder="กรอกข้อความแนบท้ายใบประเมิน..."></textarea>
                            </div>                    
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-9 mb-2">
                                <label for="requested_by">จัดทำโดย</label>
                                <input class="form-control font-weight-600 bg-light" name="requested_by" value="{{auth()->user()->name}}" readonly>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="requested_date">วันที่จัดทำ</label>
                                <input class="form-control" type="date" name="requested_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                            </div>
                        </div>   

                        <div class="row mb-3">
                            <div class="col-md-9 mb-2">
                                <label for="reviewed_by">ทบทวนโดย</label>
                                <select class="form-control receiver-select" name="reviewed_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="reviewed_date">วันที่ทบทวน</label>
                                <input class="form-control" type="date" name="reviewed_date" readonly>
                            </div>
                        </div> 

                        <div class="row mb-3">
                            <div class="col-md-9 mb-2">
                                <label for="assessor_by">ผู้ประเมินสินค้า</label>
                                <select class="form-control receiver-select" name="assessor_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="assessor_date">วันที่ประเมินสินค้า</label>
                                <input class="form-control" type="date" name="assessor_date" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-9 mb-2">
                                <label for="purchase_by">ผู้ประเมินบริการ</label>
                                <select class="form-control receiver-select" name="purchase_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="purchase_date">วันที่ประเมินบริการ</label>
                                <input class="form-control" type="date" name="purchase_date" readonly>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-9 mb-2">
                                <label for="approved_by2">ผู้อนุมัติ</label>
                                <select class="form-control receiver-select" name="approved_by2">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="approved_date2">วันที่อนุมัติ</label>
                                <input class="form-control" type="date" name="approved_date2" readonly>
                            </div>
                        </div>

                        <div class="row pt-2">
                            <div class="col-md-2 col-12">
                                <button type="submit" class="btn btn-block btn-indigo py-2">
                                    <i class="fas fa-save mr-1"></i> บันทึกข้อมูล          
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
$(document).ready(function () {
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });
});

function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;
    const row = document.createElement("tr");
    
    row.innerHTML = `
        <td>
            <span class="row-number font-weight-700 text-indigo">${rowCount}</span>
            <input type="hidden" name="product_selection_dt_listno[]" value="${rowCount}">
        </td>
        <td class="p-2">
            <input type="text" class="form-control form-control-sm mb-1" placeholder="ชื่อบริษัทผู้ขาย" name="product_selection_dt_vendor[]">
            <input type="text" class="form-control form-control-sm mb-1" placeholder="ผู้ติดต่อ" name="product_selection_dt_vendor_name[]">
            <div class="row no-gutters">
                <div class="col-6 pr-1"><input type="text" class="form-control form-control-sm" placeholder="โทร" name="product_selection_dt_vendor_tel[]"></div>
                <div class="col-6 pl-1"><input type="text" class="form-control form-control-sm" placeholder="E-mail" name="product_selection_dt_vendor_email[]"></div>
            </div>
            <input type="text" class="form-control form-control-sm mt-1" placeholder="หมายเหตุย่อย" name="product_selection_dt_vendor_remark[]">
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" placeholder="ยี่ห้อสินค้า" name="product_selection_dt_brand[]">
        </td>
        <td>
            <select class="form-control form-control-sm text-center" name="product_selection_hd_grade_a[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td><input type="text" class="form-control form-control-sm" name="product_selection_hd_grade_b[]"></td>
        <td>
            <select class="form-control form-control-sm text-center" name="product_selection_hd_grade_c[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td>
            <select class="form-control form-control-sm text-center" name="product_selection_hd_results1[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td>
            <select class="form-control form-control-sm text-center" name="product_selection_hd_results2[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td>
            <select class="form-control form-control-sm text-center" name="product_selection_hd_results3[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" placeholder="หมายเหตุ" name="product_selection_dt_remark[]">
        </td>
        <td>
            <div class="custom-file">
                <input type="file" class="form-control-file" name="product_selection_dt_file[]" style="font-size: 0.75rem;">
            </div>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-danger btn-action" onclick="removeRow(this)" style="border-radius: 6px;">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    tableBody.appendChild(row);
    updateRowNumbers();
    addEvaluationSection(rowCount);
}

function addEvaluationSection(index) {
    const evaluation = document.querySelector("#evaluationContainer");
    const html = `
        <div class="evaluation-block mb-4 shadow-sm" data-index="${index}">
            <h6 class="font-weight-700 text-indigo mb-3">
                <i class="fas fa-clipboard-check"></i> ใบประเมินสินค้า/ผู้ขาย ( รายการพิจารณาที่ ${index} )
            </h6>

            <div class="table-responsive">
                <table class="table table-modern table-sm text-center">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center" style="width:28%">รายการประเมิน</th>
                            <th colspan="3" class="text-center">( 1 ) คุณภาพ</th>
                            <th colspan="3" class="text-center">( 2 ) ความเรียบร้อย</th>
                            <th colspan="3" class="text-center">( 3 ) บริการผู้ขาย</th>
                            <th colspan="3" class="text-center">( 4 ) บริการหลังการขาย</th>
                        </tr>
                        <tr>
                            <th class="text-center" style="background:#f0fdf4!important; color:#166534!important;">ดี</th>
                            <th class="text-center" style="background:#fefce8!important; color:#854d0e!important;">พอใช้</th>
                            <th class="text-center" style="background:#fef2f2!important; color:#991b1b!important;">ไม่ดี</th>
                            
                            <th class="text-center" style="background:#f0fdf4!important; color:#166534!important;">ดี</th>
                            <th class="text-center" style="background:#fefce8!important; color:#854d0e!important;">พอใช้</th>
                            <th class="text-center" style="background:#fef2f2!important; color:#991b1b!important;">ไม่ดี</th>
                            
                            <th class="text-center" style="background:#f0fdf4!important; color:#166534!important;">ดี</th>
                            <th class="text-center" style="background:#fefce8!important; color:#854d0e!important;">พอใช้</th>
                            <th class="text-center" style="background:#fef2f2!important; color:#991b1b!important;">ไม่ดี</th>
                            
                            <th class="text-center" style="background:#f0fdf4!important; color:#166534!important;">ดี</th>
                            <th class="text-center" style="background:#fefce8!important; color:#854d0e!important;">พอใช้</th>
                            <th class="text-center" style="background:#fef2f2!important; color:#991b1b!important;">ไม่ดี</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${createEvaluationRow(1, "คุณภาพการใช้งานของสินค้า", index)}
                        ${createEvaluationRow(2, "ความเรียบร้อยของสินค้า", index)}
                        ${createEvaluationRow(3, "บริการของผู้ขาย", index)}
                        ${createEvaluationRow(4, "การให้บริการหลังการขาย", index)}
                    </tbody>
                </table>
            </div>
        </div>
    `;
    evaluation.insertAdjacentHTML("beforeend", html);
}

function createEvaluationRow(no, title, index) {
    return `
        <tr>
            <td class="text-left font-weight-500 pl-3">
                <span class="text-muted mr-1">•</span> ${title}
                <input type="hidden" name="evaluation[${index}][sub_listno][]" value="${no}">
                <input type="hidden" name="evaluation[${index}][sub_name][]" value="${title}">
                <input type="hidden" name="evaluation[${index}][vendorlistno][]" value="${index}">
            </td>
            ${createSelectCells(index, no)}
        </tr>
    `;
}

function createSelectCells(index, subNo) {
    let html = "";
    for (let group = 1; group <= 4; group++) {
        for (let grade = 1; grade <= 3; grade++) {
            html += `
                <td>
                    <select class="form-control form-control-sm text-center" 
                            name="evaluation[${index}][results${group}_${subNo}][]" 
                            style="min-width: 45px; padding: 0.2rem;">
                        <option value="0"></option>
                        <option value="1">/</option>
                    </select>
                </td>
            `;
        }
    }
    return html;
}

function removeRow(button) {
    const row = button.closest("tr");
    const rows = document.querySelectorAll("#destroyTable tbody tr");
    const index = Array.from(rows).indexOf(row) + 1;

    row.remove();
    updateRowNumbers();
    
    const ev = document.querySelector(`.evaluation-block[data-index="${index}"]`);
    if (ev) ev.remove();
}

function updateRowNumbers() {
    document.querySelectorAll("#destroyTable tbody tr").forEach((row, i) => {
        const number = i + 1;
        row.querySelector(".row-number").textContent = number;
        row.querySelector('input[name="product_selection_dt_listno[]"]').value = number;
    });
}
</script>
@endpush