@extends('layouts.main')
@section('content')
<!-- SweetAlert2 Resource -->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Theme Styles */
    .objective-container {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        padding: 1.5rem 0;
    }
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.05) !important;
        background: #ffffff;
        overflow: hidden;
    }
    .card-header {
        background: #ffffff !important;
        padding: 1.75rem 2rem !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .card-body {
        padding: 2rem !important;
    }
    .company-title {
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 1px;
        color: #6366f1;
        margin-bottom: 0.35rem;
        text-transform: uppercase;
    }
    .main-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }
    .tools-subtitle {
        font-size: 0.85rem;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 0;
        font-weight: 400;
    }
    .doc-meta {
        font-size: 0.85rem;
        color: #64748b;
        background: #f8fafc;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        display: inline-block;
        text-align: left;
    }

    /* Form Controls Customization */
    .form-group label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.5rem;
    }
    .form-control, .form-control-modern {
        border: 1px solid #cbd5e1 !important;
        border-radius: 10px !important;
        padding: 0.55rem 0.85rem !important;
        font-size: 0.875rem !important;
        color: #1e293b !important;
        background-color: #fff !important;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-control-modern:focus {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12) !important;
        outline: none;
    }

    /* Table & Modern Form Styling */
    .table-responsive {
        border-radius: 12px;
        overflow: auto;
        border: 1px solid #e2e8f0;
    }
    .table-modern-form {
        margin: 0 !important;
    }
    .table-modern-form thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 0.85rem 0.5rem !important;
        font-size: 0.85rem;
        vertical-align: middle !important;
    }
    .table-modern-form thead th .form-control {
        margin-top: 0.35rem;
        font-size: 0.8rem !important;
        padding: 0.3rem 0.5rem !important;
        height: auto;
    }
    .table-modern-form tbody td {
        padding: 0.75rem 0.5rem !important;
        vertical-align: middle !important;
        font-size: 0.875rem;
    }

    /* Custom Checkbox Design */
    .checkbox-group-wrapper {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
        background: #f8fafc;
        padding: 1rem;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }
    .checkbox-indigo-container {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }
    .checkbox-indigo-container input[type="checkbox"],
    .checkbox-indigo-container input[type="radio"] {
        width: 1.15rem;
        height: 1.15rem;
        accent-color: #6366f1;
        cursor: pointer;
    }
    .checkbox-indigo-container input[type="radio"] {
        border-radius: 50%;
    }
    .checkbox-indigo-container label {
        margin-bottom: 0 !important;
        font-weight: 500 !important;
        color: #334155;
        cursor: pointer;
        font-size: 0.9rem;
    }

    /* Buttons Styling */
    .btn-indigo-light {
        background: #e0e7ff !important;
        color: #4f46e5 !important;
        border: none !important;
        border-radius: 10px !important;
        padding: 0.5rem 1rem !important;
        font-weight: 600 !important;
        font-size: 0.875rem !important;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .btn-indigo-light:hover {
        background: #4f46e5 !important;
        color: #ffffff !important;
    }
    .btn-danger-light {
        background-color: #fee2e2 !important;
        color: #dc2626 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 0.4rem 0.65rem !important;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-danger-light:hover {
        background-color: #dc2626 !important;
        color: #ffffff !important;
    }
</style>

<div class="objective-container">
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-start gap-3">
                        <div>
                            <div class="company-title">ESSOM CO., LTD.</div>
                            <h5 class="main-title">
                                ผลการสอบเทียบเครื่องมือวัดในโรงงาน<br>
                                <span style="font-size: 1.1rem; font-weight: 600; color: #475569;">CALIBRATION OF MEASURING TOOLS</span>
                            </h5>
                            <p class="tools-subtitle">
                                Digital Weight, Weight, Vernier, Micrometer, Steel Ruler, Measuring Tape,<br>
                                Ring Gauge, Square Ruler, Template, Pressure Gauge, Barometer, Thermometer,<br>
                                Measuring Tank, Stop Watch, Tachometer, Inclined manometer
                            </p>
                        </div>
                        <div class="d-flex flex-column align-items-lg-end gap-3 mt-2 mt-lg-0">
                            <div class="doc-meta">
                                <strong>Form No:</strong> F7150.1<br>
                                <strong>Date:</strong> 19 Mar 21
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">       
                    <form action="{{ route('calibration-resultfactory.store') }}" method="POST">
                    @csrf     
                    <!-- Top Form Fields -->
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ชื่อเครื่องมือ</label>
                                <input class="form-control" type="text" placeholder="ระบุชื่อเครื่องมือ" name="calibration_name">
                                <input type="hidden" name="docutype" value="F7150.1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>หมายเลขเครื่อง</label>
                                <input class="form-control" type="text" placeholder="ระบุหมายเลขเครื่อง" name="calibration_code">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ยี่ห้อ</label>
                                <input class="form-control" type="text" placeholder="ระบุยี่ห้อ" name="calibration_brand">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>วันสอบเทียบ</label>
                                <input class="form-control" type="date" value="{{date('Y-m-d')}}" name="calibration_resultfactory_hds_date">
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>เครื่องมือมาตรฐาน</label>
                                <input class="form-control" type="text" placeholder="ระบุเครื่องมือมาตรฐาน" name="standard_tools">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>อุณหภูมิห้อง (°C)</label>
                                <input class="form-control" type="text" placeholder="0.0" name="room_temperature">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ความดันบรรยากาศ (kPa)</label>
                                <input class="form-control" type="text" placeholder="0.0" name="atmospheric_pressur">
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ความเรียบร้อยของเครื่องมือและสเกลวัด</label>
                                <input class="form-control" type="text" placeholder="ระบุรายละเอียด" name="measurement_scales">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>รายละเอียดอื่น ประกอบการสอบเทียบ</label>
                                <input class="form-control" type="text" placeholder="ระบุรายละเอียดเพิ่มเติม" name="additional_details">
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Table Section -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="font-weight-bold text-dark m-0">รายการผลการสอบเทียบ</h6>
                            <button type="button" class="btn btn-indigo-light" onclick="addRow()">
                                <i class="fas fa-plus-circle"></i> เพิ่มแถวรายการ
                            </button>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-modern-form text-center align-middle" id="destroyTable">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="width: 60px;">ลำดับ</th>
                                        <th rowspan="2">
                                            ผล/ค่าอุปกรณ์มาตรฐานหน่วย<br>
                                            <input class="form-control" type="text" placeholder="หน่วย" name="standard_unit">
                                        </th>
                                        <th rowspan="2">
                                            ผล/ค่าที่ถูกต้องหน่วย<br>
                                            <input class="form-control" type="text" placeholder="หน่วย" name="value_unit">
                                        </th>
                                        <th rowspan="2"> 
                                            ผล/ค่าอุปกรณ์สอบเทียบหน่วย<br>
                                            <input class="form-control" type="text" placeholder="หน่วย" name="equipment_unit">
                                        </th>
                                        <th rowspan="2">
                                            ค่าคลาดเคลื่อนหน่วย<br>
                                            <input class="form-control" type="text" placeholder="หน่วย" name="error_unit">
                                        </th>
                                        <th colspan="2">ความคลาดเคลื่อนที่</th>
                                        <th rowspan="2">หมายเหตุ</th>
                                        <th rowspan="2" style="width: 60px;">ลบ</th>
                                    </tr>
                                    <tr>
                                        <th>วัดได้ %</th>
                                        <th>ยอมรับได้ %</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dynamic rows will be appended here -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Acceptance Checkboxes Group 1 -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mb-2">ผลการประเมิน</label>
                                <div class="checkbox-group-wrapper">
                                    <div class="checkbox-indigo-container">
                                        <input type="radio" id="accept_status1" name="evaluation_round" value="ยอมรับได้">
                                        <label for="accept_status1">ยอมรับได้</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="radio" id="accept_status2" name="evaluation_round" value="ไม่ยอมรับ">
                                        <label for="accept_status2">ไม่ยอมรับ</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Inspector Info -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ผู้สอบเทียบ</label>
                                <input class="form-control" type="text" value="{{ auth()->user()->name ?? '' }}" name="approved_at">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>วันที่</label>
                                <input class="form-control" type="date"  value="{{date('Y-m-d')}}" name="approved_date">
                            </div>
                        </div>
                    </div>

                    <!-- Acceptance Checkboxes Group 2 -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mb-2">ผลการอนุมัติขั้นสุดท้าย</label>
                                <div class="checkbox-group-wrapper">
                                    <div class="checkbox-indigo-container">
                                        <input type="radio" id="pass_status1" name="final_approval" value="ผ่าน">
                                        <label for="pass_status1">ผ่าน</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="radio" id="pass_status2" name="final_approval" value="ไม่ผ่าน">
                                        <label for="pass_status2">ไม่ผ่าน</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-indigo-light px-4 py-2" style="font-size: 1rem !important;">
                                <i class="fas fa-save me-2"></i> บันทึกข้อมูล
                            </button>
                        </div>
                    </div>
                </form>
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div>
    </div>
</div>

@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
// ✅ ฟังก์ชันเพิ่มแถวดีไซน์โมเดิร์น
function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td class="row-number font-weight-bold text-muted">${rowCount}</td>
        <td>
            <input type="text" class="form-control form-control-modern" placeholder="ค่ามาตรฐาน" name="standard_value[]">
        </td>
        <td>
            <input type="text" class="form-control form-control-modern" placeholder="ค่าที่ถูกต้อง" name="correct_value[]">
        </td>
        <td>
            <input type="text" class="form-control form-control-modern" placeholder="ค่าสอบเทียบ" name="calibration_value[]">
        </td>
        <td>
            <input type="text" class="form-control form-control-modern" placeholder="ค่าคลาดเคลื่อน" name="error_value[]">
        </td>
        <td>
            <input type="text" class="form-control form-control-modern" placeholder="วัดได้ %" name="measured_percent[]">
        </td>
        <td>
            <input type="text" class="form-control form-control-modern" placeholder="ยอมรับได้ %" name="acceptable_percent[]">
        </td>
        <td>
            <input type="text" class="form-control form-control-modern" placeholder="หมายเหตุ" name="remark[]">
        </td>
        <td class="text-center">
            <button type="button" class="btn-danger-light" onclick="removeRow(this)">
                <i class="fas fa-trash-alt"></i>
            </button>
            <input type="hidden" name="listno[]" value="${rowCount}">
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
        const rowNumDisplay = row.querySelector(".row-number");
        if (rowNumDisplay) {
            rowNumDisplay.textContent = number;
        }
        const inputHidden = row.querySelector('input[name="listno[]"]');
        if (inputHidden) {
            inputHidden.value = number;
        }
    });
}
</script>
@endpush