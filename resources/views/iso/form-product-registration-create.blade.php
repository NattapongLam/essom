@extends('layouts.main')
@section('content')

{{-- @push('styles') --}}
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}

<style>
    /* Modern Indigo Theme Layout */
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

    /* Header Container Design */
    .card-header-modern {
        background-color: #ffffff;
        padding: 2rem 2.5rem 1.2rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-title-block h5 {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
        font-size: 1.35rem;
        line-height: 1.4;
    }

    .doc-number-badge {
        position: absolute;
        top: 2rem;
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

    /* Form Panels & Controls */
    .form-section-panel {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 22px;
        margin-bottom: 25px;
    }

    label {
        font-weight: 600;
        color: #475569;
        display: block;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

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
    }
    .form-control-modern:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    textarea.form-control-modern {
        min-height: 38px;
        height: 38px;
        resize: vertical;
    }

    /* Table Component Design */
    .table-responsive-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    table.table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
        margin-bottom: 0 !important;
    }

    table.table-modern th {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
        font-weight: 600;
        border: 1px solid #4338ca !important;
        padding: 10px 4px;
        font-size: 0.8rem;
    }

    /* Highlight Specific Headers */
    table.table-modern th.bg-indigo-dark {
        background-color: #3730a3 !important;
    }

    table.table-modern td {
        padding: 6px 4px;
        border: 1px solid #e2e8f0;
        vertical-align: middle;
        background-color: #ffffff;
    }

    /* Buttons Design */
    .btn-indigo-add {
        background-color: #ffffff;
        color: #4f46e5;
        border: 1px solid #c7d2fe;
        padding: 6px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.88rem;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-indigo-add:hover {
        background-color: #f5f3ff;
        border-color: #818cf8;
    }

    .btn-indigo-submit {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: #ffffff !important;
        border: none;
        padding: 10px 30px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.2s ease;
    }
    .btn-indigo-submit:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    .btn-table-delete {
        background-color: #fff5f5;
        color: #e53e3e;
        border: 1px solid #fed7d7;
        padding: 5px 8px;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-table-delete:hover {
        background-color: #e53e3e;
        color: #ffffff;
    }

    @media (max-width: 768px) {
        .doc-number-badge { position: relative; top: 0; right: 0; text-align: left; display: inline-block; margin-top: 10px; }
        .card-header-modern { padding: 1.5rem; }
    }
</style>

<div class="container-fluid">
    <div class="card custom-card">
        
        <!-- Document Header -->
        <div class="card-header-modern">
            <div class="header-title-block text-center">
                <h5>ESSOM CO., LTD.</h5>
                <h5>ทะเบียนควบคุมแบบผลิต (Drawing control status)</h5>
            </div>
            <div class="doc-number-badge">
                <strong>F8300.7</strong><br>19 Jan. 22
            </div>
        </div>

        <!-- Form Body -->
        <div class="card-body" style="padding: 2rem 2.5rem;">
            <form method="POST" action="{{ route('product-registration.store') }}" enctype="multipart/form-data">
                @csrf     
                
                <!-- Head Form Inputs Block -->
                <div class="form-section-panel">
                    <div class="row">
                        <div class="col-md-9 mb-3 mb-md-0">
                            <label for="product_registration_hd_name">Product Name</label>
                            <input type="text" class="form-control-modern" name="product_registration_hd_name" placeholder="กรอกชื่อผลิตภัณฑ์">
                        </div>
                        <div class="col-md-3">
                            <label for="product_registration_hd_subcode">Sub Code</label>
                            <input type="text" class="form-control-modern" name="product_registration_hd_subcode" placeholder="กรอกรหัสย่อย">
                        </div>
                    </div>
                </div>

                <!-- Dynamic Table Header Toolbar -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div style="font-weight: 700; color: #1e293b; font-size: 1rem;">
                        <i class="fas fa-list-ol text-indigo mr-1" style="color: #4f46e5;"></i> รายการแบบผลิต (Drawing List)
                    </div>
                    <button type="button" class="btn-indigo-add" onclick="addRow()">
                        <i class="fas fa-plus"></i> เพิ่มแถวข้อมูล
                    </button>
                </div>

                <!-- Drawing Control Dynamic Table -->
                <div class="table-responsive-container">
                    <table class="table table-modern text-center" id="destroyTable">
                        <thead>
                            <tr>
                                <th style="width: 5%" class="bg-indigo-dark">ลำดับ</th>
                                <th style="width: 14%" class="bg-indigo-dark">Dwg No.</th>
                                <th style="width: 21%" class="bg-indigo-dark">Description</th>
                                <th style="width: 5%">Rev.00</th>
                                <th style="width: 5%">Rev.01</th>
                                <th style="width: 5%">Rev.02</th>
                                <th style="width: 5%">Rev.03</th>
                                <th style="width: 5%">Rev.04</th>
                                <th style="width: 5%">Rev.05</th>
                                <th style="width: 5%">Rev.06</th>
                                <th style="width: 5%">Rev.07</th>
                                <th style="width: 5%">Rev.08</th>
                                <th style="width: 5%">Rev.09</th>
                                <th style="width: 5%">Rev.10</th>
                                <th style="width: 5%" class="bg-indigo-dark">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- แถวข้อมูลเริ่มต้นจะถูกเพิ่มด้วย JavaScript หรือปล่อยว่างไว้รอการกดเพิ่มแถว -->
                        </tbody>
                    </table>
                </div> 

                <!-- Form Control Bottom Toolbar -->
                <div class="d-flex justify-content-start mt-4">
                    <button type="submit" class="btn-indigo-submit">
                        <i class="fas fa-save mr-2"></i> บันทึกข้อมูลเอกสาร
                    </button>
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
// จัดการเรียกใช้งานแถวแรกอัตโนมัติเมื่อโหลดหน้าเสร็จสิ้น (ทางเลือกเพื่อความสะดวกของผู้ใช้)
$(document).ready(function() {
    if ($("#destroyTable tbody tr").length === 0) {
        addRow();
    }
});

// ✅ ฟังก์ชันเพิ่มแถวแบบกำหนดสไตล์แมตช์ธีมสี
function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td class="font-weight-bold text-secondary">
            <span class="row-number">${rowCount}</span>
            <input type="hidden" name="product_registration_dt_listno[]" value="${rowCount}">            
        </td>
        <td>
            <input type="text" class="form-control-modern" placeholder="Dwg No." name="product_registration_dt_dwgno[]" required>
        </td>
        <td>
            <textarea class="form-control-modern" placeholder="Description" name="product_registration_dt_description[]"></textarea>
        </td>
        <td>
            <input type="text" class="form-control-modern text-center p-1" placeholder="00" name="product_registration_dt_rev00[]">
        </td>
        <td>
            <input type="text" class="form-control-modern text-center p-1" placeholder="01" name="product_registration_dt_rev01[]">
        </td>
        <td>
            <input type="text" class="form-control-modern text-center p-1" placeholder="02" name="product_registration_dt_rev02[]">
        </td>
        <td>
            <input type="text" class="form-control-modern text-center p-1" placeholder="03" name="product_registration_dt_rev03[]">
        </td>
        <td>
            <input type="text" class="form-control-modern text-center p-1" placeholder="04" name="product_registration_dt_rev04[]">
        </td>
        <td>
            <input type="text" class="form-control-modern text-center p-1" placeholder="05" name="product_registration_dt_rev05[]">
        </td>
        <td>
            <input type="text" class="form-control-modern text-center p-1" placeholder="06" name="product_registration_dt_rev06[]">
        </td>
        <td>
            <input type="text" class="form-control-modern text-center p-1" placeholder="07" name="product_registration_dt_rev07[]">
        </td>
        <td>
            <input type="text" class="form-control-modern text-center p-1" placeholder="08" name="product_registration_dt_rev08[]">
        </td>
        <td>
            <input type="text" class="form-control-modern text-center p-1" placeholder="09" name="product_registration_dt_rev09[]">
        </td>
        <td>
            <input type="text" class="form-control-modern text-center p-1" placeholder="10" name="product_registration_dt_rev10[]">
        </td>
        <td>
            <button type="button" class="btn-table-delete" onclick="removeRow(this)">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    `;

    tableBody.appendChild(row);
    updateRowNumbers(); // รีรันเลขลำดับให้ถูกต้อง
}

// ✅ ฟังก์ชันลบแถว
function removeRow(button) {
    const row = button.closest("tr");
    row.remove();
    updateRowNumbers(); // รีรันเลขลำดับใหม่หลังหักแถวออก
}

// ✅ ฟังก์ชันอัปเดตตัวเลขลำดับ (แก้ไขบักคลาสตัวชี้เป้าจากโค้ดชุดเดิม)
function updateRowNumbers() {
    document.querySelectorAll("#destroyTable tbody tr").forEach((row, index) => {
        const number = index + 1;
        const targetSpan = row.querySelector(".row-number");
        if(targetSpan) {
            targetSpan.textContent = number;
        }
        const targetInput = row.querySelector('input[name="product_registration_dt_listno[]"]');
        if(targetInput) {
            targetInput.value = number;
        }
    });
}
</script>
@endpush