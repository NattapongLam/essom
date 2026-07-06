@extends('layouts.main')
@section('content')

<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Modern Indigo Theme */
    :root {
        --indigo-main: #6366f1;
        --indigo-hover: #4f46e5;
        --indigo-light: #e0e7ff;
        --indigo-bg: #f8fafc;
        --dark-slate: #0f172a;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.05);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #ffffff 0%, var(--indigo-bg) 100%);
        border-bottom: 1px solid rgba(99, 102, 241, 0.08);
        padding: 1.5rem 2rem;
    }

    .company-name {
        font-weight: 800;
        letter-spacing: 0.5px;
        color: var(--dark-slate);
    }

    .doc-badge {
        background-color: var(--indigo-light);
        color: var(--indigo-hover);
        padding: 0.35rem 1rem;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }

    .section-divider {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--indigo-hover);
        letter-spacing: 0.5px;
        margin-top: 2rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
    }

    .section-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(to right, rgba(99, 102, 241, 0.2), transparent);
        margin-left: 1rem;
    }

    .form-group label {
        font-weight: 500;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
    }

    .form-control-modern {
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 0.6rem 1rem;
        height: auto;
        font-size: 0.95rem;
        color: var(--dark-slate);
        transition: all 0.2s ease;
        background-color: #ffffff;
    }

    .form-control-modern:focus {
        border-color: var(--indigo-main);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12);
        outline: none;
    }

    .form-control-modern[readonly] {
        background-color: #f8fafc;
        color: var(--text-muted);
        border-color: #e2e8f0;
        cursor: not-allowed;
    }

    /* Modern Table Inside Form */
    .table-modern-form {
        border: none;
    }

    .table-modern-form thead th {
        background-color: var(--indigo-bg);
        color: #475569;
        font-weight: 600;
        font-size: 0.85rem;
        border: 1px solid var(--border-color);
        padding: 12px 8px;
        vertical-align: middle;
    }

    .table-modern-form tbody td {
        padding: 8px;
        vertical-align: middle;
        border: 1px solid var(--border-color);
    }

    /* Row inputs customization */
    .table-modern-form tbody .form-control {
        border-radius: 6px;
        padding: 0.4rem 0.75rem;
        font-size: 0.9rem;
    }

    /* Select2 Indigo Override */
    .select2-container--default .select2-selection--single {
        border: 1px solid var(--border-color) !important;
        border-radius: 10px !important;
        height: 43px !important;
        padding: 0.5rem 0.75rem !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 24px !important;
        color: var(--dark-slate) !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 41px !important;
    }

    /* Buttons Modern Indigo Styling */
    .btn-indigo {
        background-color: var(--indigo-main);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        padding: 0.7rem 2rem;
        font-weight: 600;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
    }

    .btn-indigo:hover {
        background-color: var(--indigo-hover);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.25);
    }

    .btn-indigo-light {
        background-color: var(--indigo-light);
        color: var(--indigo-hover);
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s;
    }

    .btn-indigo-light:hover {
        background-color: var(--indigo-main);
        color: #ffffff;
    }

    .btn-danger-light {
        background-color: #fee2e2;
        color: #dc2626;
        border: none;
        border-radius: 6px;
        padding: 0.4rem 0.8rem;
        font-weight: 500;
        font-size: 0.85rem;
        transition: all 0.2s;
    }

    .btn-danger-light:hover {
        background-color: #dc2626;
        color: #ffffff;
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-11 col-12">
            <div class="card custom-card">
                
                <div class="card-header custom-card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                            <h4 class="company-name mb-1">ESSOM CO., LTD</h4>
                            <span class="doc-badge">
                                <i class="fas fa-file-invoice mr-1"></i> แผนคุณภาพเฉพาะผลิตภัณฑ์ (Quality Plan)
                            </span>
                        </div>
                        <div class="col-md-6 text-center text-md-right">
                            <span class="text-muted font-weight-bold">F8510.1</span><br>
                            <small class="text-muted">4 Nov. 24</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="POST" class="form-horizontal" action="{{ route('quality-plan.store') }}" enctype="multipart/form-data">
                        @csrf        
                        
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_docno">Doc. No</label>
                                <input class="form-control form-control-modern" name="quality_plan_hd_docno" required>
                            </div> 
                            <div class="col-md-3 col-sm-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_revno">Rev. No</label>
                                <input class="form-control form-control-modern" name="quality_plan_hd_revno" required>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_effecdate">Effec Date</label>
                                <input class="form-control form-control-modern" name="quality_plan_hd_effecdate" required>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_page">Page</label>
                                <input class="form-control form-control-modern" name="quality_plan_hd_page">
                            </div>      
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_file">ไฟล์แนบ (หากมี)</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control form-control-modern py-1" name="quality_plan_hd_file">
                                </div>
                            </div> 
                            <div class="col-md-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_link">Link (หากมี)</label>
                                <input type="text" class="form-control form-control-modern" name="quality_plan_hd_link" placeholder="https://example.com">
                            </div> 
                        </div>

                        <div class="section-divider">รายละเอียดแผนคุณภาพ</div>

                        <div class="mb-3 text-right">
                            <button type="button" class="btn btn-indigo-light" onclick="addRow()">
                                <i class="fas fa-plus-circle mr-1"></i> เพิ่มแถวรายการ
                            </button>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-modern-form text-center" id="destroyTable">
                                <thead>
                                    <tr>
                                        <th style="width: 8%">ลำดับที่<br>No.</th>
                                        <th style="width: 37%">รายละเอียด<br>Description</th>
                                        <th style="width: 20%">เครื่องมือ เครื่องวัด<br>Tools</th>
                                        <th style="width: 15%">ผู้ปฏิบัติ<br>By</th>
                                        <th style="width: 15%">อ้างอิง<br>Reference</th>
                                        <th style="width: 5%">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    </tbody>
                            </table>
                        </div>

                        <div class="section-divider">การลงนามตรวจสอบและอนุมัติ</div>

                        <div class="row">
                            <div class="col-md-9 col-12 form-group mb-4">
                                <label for="requested_by">จัดทำโดย</label>
                                <input class="form-control form-control-modern" name="requested_by" value="{{ auth()->user()->name }}" readonly>
                            </div>
                            <div class="col-md-3 col-12 form-group mb-4">
                                <label for="requested_date">วันที่</label>
                                <input class="form-control form-control-modern" type="date" name="requested_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-9 col-12 form-group mb-4">
                                <label for="reviewed_by">ทบทวนโดย</label>
                                <select class="form-control receiver-select" name="reviewed_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-12 form-group mb-4">
                                <label for="reviewed_date">วันที่</label>
                                <input class="form-control form-control-modern" type="date" name="reviewed_date" readonly>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-md-9 col-12 form-group mb-4">
                                <label for="approved_by">อนุมัติโดย</label>
                                <select class="form-control receiver-select" name="approved_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-12 form-group mb-4">
                                <label for="approved_date">วันที่</label>
                                <input class="form-control form-control-modern" type="date" name="approved_date" readonly>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-center text-md-left">
                                <button type="submit" class="btn btn-indigo px-5">
                                    <i class="fas fa-save mr-2"></i> บันทึกข้อมูล
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
    // โหลดครั้งแรกให้เพิ่มแถวเริ่มต้นให้ผู้ใช้ใช้งานทันที 1 แถวเพื่อความสะดวก
    addRow();

    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        allowClear: true,
        width: '100%'
    });
});

// ✅ ฟังก์ชันเพิ่มแถวดีไซน์โมเดิร์น
function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td class="row-number font-weight-bold text-muted">${rowCount}</td>
        <td>
            <textarea class="form-control form-control-modern" rows="2" placeholder="ระบุรายละเอียดโครงการ" name="quality_plan_dt_description[]" required></textarea>
        </td>
        <td>
            <input type="text" class="form-control form-control-modern" placeholder="เครื่องมือ/เครื่องวัด" name="quality_plan_dt_tool[]">
        </td>
        <td>
            <input type="text" class="form-control form-control-modern" placeholder="ชื่อผู้ปฏิบัติ" name="quality_plan_dt_by[]">
        </td>
        <td>
            <input type="text" class="form-control form-control-modern" placeholder="เอกสารอ้างอิง" name="quality_plan_dt_reference[]">
        </td>
        <td class="text-center">
            <button type="button" class="btn-danger-light" onclick="removeRow(this)">
                <i class="fas fa-trash-alt"></i>
            </button>
            <input type="hidden" name="quality_plan_dt_listno[]" value="${rowCount}">
        </td>
    `;

    tableBody.appendChild(row);
    updateRowNumbers();
}

// ✅ ฟังก์ชันลบแถว
function removeRow(button) {
    const row = button.closest("tr");
    row.remove();
    updateRowNumbers();
}

// ✅ ฟังก์ชันรันเลขแถวใหม่ให้ถูกต้องเรียงตามจริง
function updateRowNumbers() {
    document.querySelectorAll("#destroyTable tbody tr").forEach((row, index) => {
        const number = index + 1;
        // เข้าถึงคลาส .row-number เพื่ออัปเดตตัวเลขแสดงผลบน UI
        const rowNumDisplay = row.querySelector(".row-number");
        if (rowNumDisplay) {
            rowNumDisplay.textContent = number;
        }
        // อัปเดตค่า input hidden เพื่อส่งไปยัง Database
        const inputHidden = row.querySelector('input[name="quality_plan_dt_listno[]"]');
        if (inputHidden) {
            inputHidden.value = number;
        }
    });
}
</script>
@endpush