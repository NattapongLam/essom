@extends('layouts.main')
@section('content')

<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Theme Customizations */
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #e0e7ff;
        --indigo-bg: #f8fafc;
        --text-dark: #1e293b;
    }

    body {
        background-color: var(--indigo-bg);
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.08);
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
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .doc-subtitle {
        color: var(--text-dark);
        font-weight: 500;
        font-size: 1.1rem;
    }

    /* Table Styling */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
        width: 100% !important;
    }

    .table-modern thead th, .table-modern thead td {
        background-color: var(--indigo-light) !important;
        color: #312e81 !important;
        font-weight: 600;
        border: none !important;
        padding: 12px 8px !important;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .table-modern tbody tr {
        transition: all 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background-color: #fafafa !important;
        transform: translateY(-1px);
    }

    .table-modern td {
        padding: 14px 8px !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
        border-top: none !important;
        border-left: none !important;
        border-right: none !important;
        color: #475569;
    }

    /* Buttons Styling */
    .btn-indigo {
        background-color: var(--indigo-primary);
        color: white !important;
        border-radius: 8px;
        font-weight: 500;
        padding: 0.5rem 1.2rem;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-indigo:hover {
        background-color: var(--indigo-hover);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
    }

    .btn-indigo-outline {
        border: 1.5px solid var(--indigo-primary);
        color: var(--indigo-primary) !important;
        border-radius: 8px;
        font-weight: 500;
        padding: 0.5rem 1.2rem;
        transition: all 0.2s ease;
        background: transparent;
    }

    .btn-indigo-outline:hover {
        background-color: var(--indigo-light);
        color: var(--indigo-hover) !important;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0 !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px !important;
        border: none !important;
        transition: all 0.2s ease;
    }

    .btn-action:hover {
        transform: scale(1.08);
    }

    /* DataTables Custom Overrides */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--indigo-primary) !important;
        color: white !important;
        border: none !important;
        border-radius: 6px;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 5px 10px;
        outline: none;
    }
    
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--indigo-primary);
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="custom-card-header">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="text-center flex-grow-1">
                            <h4 class="company-title mb-1">ESSOM CO.,LTD</h4>
                            <h5 class="doc-subtitle">ตั้งค่าใบคัดเลือกสินค้า/ผู้ขายและประเมิน (SUPPLIER QUALIFICATION AND EVALUATION)</h5>
                        </div>
                    </div>                             
                </div>

                <div class="card-body p-4"> 
                    <form method="POST" class="form-horizontal" action="{{ route('product-selection-master.store') }}" enctype="multipart/form-data">
                    @csrf         
                      <div class="row align-items-end">
                            <div class="col-md-3 mb-3">
                                <h5 class="section-title mb-0">
                                    <i class="fas fa-boxes text-indigo"></i> ประเภทสินค้า
                                </h5>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="productselection_master_hds_type">ประเภทจัดซื้อ</label>
                                <select class="form-control text-center" name="productselection_master_hds_type">
                                    <option value="">กรุณาเลือก</option>
                                    <option value="โรงงาน">โรงงาน</option>
                                    <option value="สำนักงาน">สำนักงาน</option>
                                    <option value="ต่างประเทศ">ต่างประเทศ</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="productselection_master_hds_group">กลุ่มสินค้า</label>
                                <select class="form-control text-center" name="productselection_master_hds_group">
                                    <option value="">กรุณาเลือก</option>
                                    <option value="สินค้า">สินค้า</option>
                                    <option value="บริการ">บริการ</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="productselection_master_hds_department">แผนก</label>
                                <select class="form-control text-center" name="productselection_master_hds_department">
                                    <option value="">กรุณาเลือก</option>
                                    @foreach ($dep as $item)
                                        <option value="{{$item->ms_department_name}}">{{$item->ms_department_name}}</option>
                                    @endforeach
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
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>

function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;
    const row = document.createElement("tr");
    
    row.innerHTML = `
        <td>
            <span class="row-number font-weight-700 text-indigo">${rowCount}</span>
            <input type="hidden" name="productselection_master_dts_listno[]" value="${rowCount}">
        </td>
        <td class="p-2">
            <input type="text" class="form-control form-control-sm mb-1" placeholder="ชื่อบริษัทผู้ขาย" name="productselection_master_dts_vendor[]">
            <input type="text" class="form-control form-control-sm mb-1" placeholder="ผู้ติดต่อ" name="productselection_master_dts_vendor_name[]">
            <div class="row no-gutters">
                <div class="col-6 pr-1"><input type="text" class="form-control form-control-sm" placeholder="โทร" name="productselection_master_dts_vendor_tel[]"></div>
                <div class="col-6 pl-1"><input type="text" class="form-control form-control-sm" placeholder="E-mail" name="productselection_master_dts_vendor_email[]"></div>
            </div>
            <input type="text" class="form-control form-control-sm mt-1" placeholder="หมายเหตุย่อย" name="productselection_master_dts_vendor_remark[]">
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" placeholder="ยี่ห้อสินค้า" name="productselection_master_dts_brand[]">
        </td>
        <td>
            <select class="form-control form-control-sm text-center" name="productselection_master_dts_grade_a[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td><input type="text" class="form-control form-control-sm" name="productselection_master_dts_grade_b[]"></td>
        <td>
            <select class="form-control form-control-sm text-center" name="productselection_master_dts_grade_c[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td>
            <select class="form-control form-control-sm text-center" name="productselection_master_dts_results1[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td>
            <select class="form-control form-control-sm text-center" name="productselection_master_dts_results2[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td>
            <select class="form-control form-control-sm text-center" name="productselection_master_dts_results3[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" placeholder="หมายเหตุ" name="productselection_master_dts_remark[]">
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
    const rows = Array.from(document.querySelectorAll("#destroyTable tbody tr"));
    const index = rows.indexOf(row) + 1;

    row.remove();

    const ev = document.querySelector(`.evaluation-block[data-index="${index}"]`);
    if (ev) ev.remove();

    updateRowNumbers();
}

function updateRowNumbers() {
    const rows = document.querySelectorAll("#destroyTable tbody tr");
    rows.forEach((row, i) => {
        const number = i + 1;
        row.querySelector(".row-number").textContent = number;
        row.querySelector('input[name="productselection_master_dts_listno[]"]').value = number;
    });

    const blocks = document.querySelectorAll("#evaluationContainer .evaluation-block");
    blocks.forEach((block, i) => {
        const number = i + 1;
        block.setAttribute("data-index", number);
        const titleEl = block.querySelector("h6");
        if (titleEl) {
            titleEl.innerHTML = `<i class="fas fa-clipboard-check"></i> ใบประเมินสินค้า/ผู้ขาย ( รายการพิจารณาที่ ${number} )`;
        }
        block.querySelectorAll('input[name*="[vendorlistno]"]').forEach(input => {
            input.value = number;
        });
    });
}
</script>
@endpush