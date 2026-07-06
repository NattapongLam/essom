@extends('layouts.main')
@section('content')

<!-- Sweet Alert-->
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

    /* Modern File Link Preview */
    .file-preview-box {
        display: inline-flex;
        align-items: center;
        margin-top: 0.5rem;
        padding: 0.35rem 0.75rem;
        background-color: var(--indigo-bg);
        border: 1px solid var(--indigo-light);
        border-radius: 8px;
        font-size: 0.85rem;
    }
    .file-preview-box a {
        color: var(--indigo-main);
        font-weight: 600;
        text-decoration: none;
    }
    .file-preview-box a:hover {
        color: var(--indigo-hover);
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
        display: inline-flex;
        align-items: center;
        justify-content: center;
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
                
                <!-- Card Header -->
                <div class="card-header custom-card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                            <h4 class="company-name mb-1">ESSOM CO., LTD</h4>
                            <span class="doc-badge">
                                <i class="fas fa-edit mr-1"></i> แก้ไขแผนคุณภาพเฉพาะผลิตภัณฑ์ (Edit Quality Plan)
                            </span>
                        </div>
                        <div class="col-md-6 text-center text-md-right">
                            <span class="text-muted font-weight-bold">F8510.1</span><br>
                            <small class="text-muted">4 Nov. 24</small>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4 p-md-5">
                    <form method="POST" class="form-horizontal" action="{{ route('quality-plan.update', $hd->quality_plan_hd_id) }}" enctype="multipart/form-data">
                        @csrf        
                        @method('PUT')     
                        <input type="hidden" name="checkdoc" value="Edit">   

                        <!-- Section 1: Header Information -->
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_docno">Doc. No</label>
                                <input class="form-control form-control-modern" name="quality_plan_hd_docno" value="{{ $hd->quality_plan_hd_docno }}" required>
                            </div> 
                            <div class="col-md-3 col-sm-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_revno">Rev. No</label>
                                <input class="form-control form-control-modern" name="quality_plan_hd_revno" value="{{ $hd->quality_plan_hd_revno }}" required>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_effecdate">Effec Date</label>
                                <input class="form-control form-control-modern" name="quality_plan_hd_effecdate" value="{{ $hd->quality_plan_hd_effecdate }}" required>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_page">Page</label>
                                <input class="form-control form-control-modern" name="quality_plan_hd_page" value="{{ $hd->quality_plan_hd_page }}">
                            </div>      
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_file">ไฟล์แนบ (หากมี)</label>
                                <input type="file" class="form-control form-control-modern py-1" name="quality_plan_hd_file">
                                @if ($hd->quality_plan_hd_file)
                                    <div class="file-preview-box">
                                        <i class="fas fa-file-pdf mr-2 text-danger"></i>
                                        <a href="{{ asset($hd->quality_plan_hd_file) }}" target="_blank">เปิดดูไฟล์แนบปัจจุบัน</a>
                                    </div>
                                @endif
                            </div> 
                            <div class="col-md-6 col-12 form-group mb-4">
                                <label for="quality_plan_hd_link">Link (หากมี)</label>
                                <input type="text" class="form-control form-control-modern" name="quality_plan_hd_link" value="{{ $hd->quality_plan_hd_link }}" placeholder="https://example.com">
                            </div> 
                        </div>

                        <!-- Section 2: Quality Plan Details Table -->
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
                                    @foreach ($dt as $item)
                                        <tr>
                                            <td class="row-number font-weight-bold text-muted">
                                                {{ $item->quality_plan_dt_listno }}
                                                <input type="hidden" name="quality_plan_dt_id[]" value="{{ $item->quality_plan_dt_id }}">
                                            </td>
                                            <td>
                                                <textarea class="form-control form-control-modern" rows="2" name="quality_plan_dt_description[]" required>{{ $item->quality_plan_dt_description }}</textarea>
                                            </td>
                                            <td>
                                                <input class="form-control form-control-modern" name="quality_plan_dt_tool[]" value="{{ $item->quality_plan_dt_tool }}">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-modern" name="quality_plan_dt_by[]" value="{{ $item->quality_plan_dt_by }}">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-modern" name="quality_plan_dt_reference[]" value="{{ $item->quality_plan_dt_reference }}">
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" class="btn-danger-light" 
                                                    onclick="confirmDel('{{ $item->quality_plan_dt_id }}', this)">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                <input type="hidden" name="quality_plan_dt_listno[]" value="{{ $item->quality_plan_dt_listno }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Section 3: Workflow Signatures -->
                        <div class="section-divider">การลงนามตรวจสอบและอนุมัติ</div>

                        <div class="row">
                            <div class="col-md-9 col-12 form-group mb-4">
                                <label for="requested_by">จัดทำโดย</label>
                                <input class="form-control form-control-modern" name="requested_by" value="{{ $hd->requested_by }}" readonly>
                            </div>
                            <div class="col-md-3 col-12 form-group mb-4">
                                <label for="requested_date">วันที่</label>
                                <input class="form-control form-control-modern" type="date" name="requested_date" value="{{ $hd->requested_date }}" required>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-9 col-12 form-group mb-4">
                                <label for="reviewed_by">ทบทวนโดย</label>
                                <select class="form-control receiver-select" name="reviewed_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}"
                                            {{ isset($hd->reviewed_by) && $hd->reviewed_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                            {{ $item->ms_employee_fullname }}
                                        </option>
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
                                        <option value="{{ $item->ms_employee_fullname }}"
                                            {{ isset($hd->approved_by) && $hd->approved_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                            {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-12 form-group mb-4">
                                <label for="approved_date">วันที่</label>
                                <input class="form-control form-control-modern" type="date" name="approved_date" readonly>
                            </div>
                        </div>

                        <!-- Form Submission Footer -->
                        <div class="row mt-4">
                            <div class="col-12 text-center text-md-left">
                                <button type="submit" class="btn btn-indigo px-5">
                                    <i class="fas fa-save mr-2"></i> บันทึกการแก้ไข
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
$(document).ready(function () {
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        allowClear: true,
        width: '100%'
    });
});

// ✅ ฟังก์ชันเพิ่มแถวดีไซน์โมเดิร์น (สำหรับหน้า Edit แถวใหม่จะไม่มี dt_id บันทึกใหม่ได้ทันที)
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
            <input type="hidden" name="quality_plan_dt_id[]" value="">
        </td>
    `;

    tableBody.appendChild(row);
    updateRowNumbers();
}

// ✅ ฟังก์ชันลบแถวธรรมดา (กรณีเพิ่มแถวใหม่เข้ามาแล้วอยากกดลบออกเลยโดยยังไม่ได้บันทึก)
function removeRow(button) {
    const row = button.closest("tr");
    row.remove();
    updateRowNumbers();
}

// ✅ ฟังก์ชันรันเลขแถวใหม่เรียงตามจริง (แก้ไขตัวดึง Class ให้ทำงานได้สมบูรณ์)
function updateRowNumbers() {
    document.querySelectorAll("#destroyTable tbody tr").forEach((row, index) => {
        const number = index + 1;
        const rowNumDisplay = row.querySelector(".row-number");
        if (rowNumDisplay) {
            // รักษา input hidden ของ dt_id เอาไว้ถ้ามี
            const hiddenId = rowNumDisplay.querySelector('input[name="quality_plan_dt_id[]"]');
            rowNumDisplay.textContent = number;
            if (hiddenId) rowNumDisplay.appendChild(hiddenId);
        }
        const inputHiddenListNo = row.querySelector('input[name="quality_plan_dt_listno[]"]');
        if (inputHiddenListNo) {
            inputHiddenListNo.value = number;
        }
    });
}

// ✅ ฟังก์ชันลบแถวเดิมใน Database ผ่าน Ajax พร้อม SweetAlert 2 ธีม Indigo
confirmDel = (refid, element) => {
    // ตรวจสอบก่อนว่าเป็นแถวที่ยังไม่ได้บันทึกลง DB หรือไม่ (กรณีเพิ่มแถวใหม่แล้วเผลอไปกดลบในตารางที่มีฟังก์ชัน confirmDel ครอบอยู่)
    if (!refid || refid === '') {
        removeRow(element);
        return;
    }

    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการลบรายการแถวนี้ออกจากระบบหรือไม่ ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยันการลบ',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            confirmButton: 'btn btn-indigo px-4 mx-2',
            cancelButton: 'btn btn-secondary px-4 mx-2'
        },
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelQualityplanDt') }}`,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "refid": refid
                },
                dataType: "json",
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire({
                            title: 'สำเร็จ',
                            text: 'ลบรายการแถวเรียบร้อยแล้ว',
                            icon: 'success',
                            confirmButtonText: 'ตกลง',
                            customClass: { confirmButton: 'btn btn-indigo px-4' },
                            buttonsStyling: false
                        }).then(function() {
                            // ลบแถวออกจากหน้าจอ UI และรันเลขใหม่ทันทีโดยไม่ต้องโหลด Page ใหม่หมด
                            const row = element.closest("tr");
                            row.remove();
                            updateRowNumbers();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'ลบรายการไม่สำเร็จ กรุณาลองใหม่อีกครั้ง',
                            icon: 'error',
                            confirmButtonText: 'ตกลง',
                            customClass: { confirmButton: 'btn btn-indigo px-4' },
                            buttonsStyling: false
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิก',
                text: 'การลบรายการถูกยกเลิกข้อมูลยังอยู่ปลอดภัย :)',
                icon: 'error',
                confirmButtonText: 'ตกลง',
                customClass: { confirmButton: 'btn btn-indigo px-4' },
                buttonsStyling: false
            });
        }
    });
}
</script>
@endpush