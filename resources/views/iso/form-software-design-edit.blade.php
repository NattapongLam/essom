@extends('layouts.main')
@section('content')

<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Indigo Modern Theme */
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #eeebff;
        --indigo-border: #e0e0fe;
        --gray-bg: #f9fafb;
    }
    
    .card-modern {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(79, 70, 229, 0.05);
        overflow: hidden;
        background: #ffffff;
    }

    .card-modern .card-header {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #ffffff;
        border-bottom: none;
        padding: 1.5rem;
    }

    .card-modern .card-header h5 {
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .section-title {
        color: var(--indigo-primary);
        font-weight: 700;
        border-left: 4px solid var(--indigo-primary);
        padding-left: 10px;
        margin-bottom: 1.25rem;
    }

    .form-label-modern {
        font-weight: 600;
        color: #4b5563;
        font-size: 0.85rem;
        letter-spacing: 0.3px;
    }

    .form-control-modern {
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        transition: all 0.2s ease;
        background-color: #ffffff;
    }

    .form-control-modern:focus {
        border-color: var(--indigo-primary);
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
    }

    .form-control-modern[readonly] {
        background-color: #f3f4f6;
        border-color: #e5e7eb;
        color: #6b7280;
    }

    /* Sub-card styling for groupings */
    .form-section-group {
        background-color: var(--gray-bg);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid #f1f5f9;
    }

    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-modern thead th {
        background-color: var(--indigo-light);
        color: #3730a3;
        font-weight: 600;
        border: 1px solid var(--indigo-border) !important;
        padding: 12px;
    }

    .table-modern tbody td {
        border: 1px solid #e5e7eb !important;
        padding: 8px;
        vertical-align: middle;
    }

    .btn-indigo {
        background-color: var(--indigo-primary);
        color: white;
        border-radius: 10px;
        padding: 0.7rem 2rem;
        font-weight: 600;
        border: none;
        transition: all 0.2s;
    }

    .btn-indigo:hover {
        background-color: var(--indigo-hover);
        color: white;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
    }

    .btn-add-row {
        background-color: #f5f3ff;
        color: var(--indigo-primary);
        border: 2px dashed var(--indigo-primary);
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-add-row:hover {
        background-color: var(--indigo-primary);
        color: white;
    }

    .btn-delete {
        background-color: #fee2e2;
        color: #ef4444;
        border: none;
        border-radius: 8px;
        padding: 6px 14px;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-delete:hover {
        background-color: #ef4444;
        color: white;
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">  
        <div class="col-12 col-xl-11">
            <div class="card card-modern">
                <div class="card-header position-relative">
                    <div class="text-center">
                        <h5 class="m-0">ESSOM CO.,LTD</h5>
                        <p class="m-0 opacity-75 small">การออกแบบซอฟต์แวร์, ทบทวนและทวนสอบ (SOFTWARE DESIGN, REVIEW AND VERIFICATION)</p>
                    </div>
                    <div class="position-absolute" style="right: 1.5rem; bottom: 1rem; text-align: right; font-size: 0.8rem; opacity: 0.8;">
                        <strong>FS8302.1</strong><br>4 Nov. 24
                    </div>             
                </div>
                
                <div class="card-body p-4">         
                    <form method="POST" class="form-horizontal" action="{{ route('software-design.update', $hd->software_design_hd_id) }}" enctype="multipart/form-data">
                        @csrf              
                        @method('PUT')        
                        <input type="hidden" name="checkdoc" value="Edit"> 

                        <h5 class="section-title">1. Software Design</h5>
                        
                        <div class="form-section-group mb-4">
                            <div class="row g-3">
                                <div class="col-12 col-md-4 mb-3">
                                    <label for="software_design_hd_no" class="form-label-modern mb-2">1.1 Software No.</label>
                                    <input class="form-control form-control-modern" name="software_design_hd_no" value="{{ $hd->software_design_hd_no }}" required>
                                </div>
                                <div class="col-12 col-md-8 mb-3">
                                    <label for="software_design_hd_product" class="form-label-modern mb-2">Product Name</label>
                                    <input class="form-control form-control-modern" name="software_design_hd_product" value="{{ $hd->software_design_hd_product }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="software_design_hd_reference" class="form-label-modern mb-2">1.2 Reference Documents</label>
                                    <input class="form-control form-control-modern" name="software_design_hd_reference" value="{{ $hd->software_design_hd_reference }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="software_design_hd_input" class="form-label-modern mb-2">1.3 Input Data</label>
                                    <textarea class="form-control form-control-modern" name="software_design_hd_input" rows="3">{{ $hd->software_design_hd_input }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="software_design_hd_output" class="form-label-modern mb-2">1.4 Output Display & Control</label>
                                    <textarea class="form-control form-control-modern" name="software_design_hd_output" rows="3">{{ $hd->software_design_hd_output }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-12">
                                    <label for="software_design_hd_layout" class="form-label-modern mb-2">1.5 Layout Features and Man-hours</label>
                                    <textarea class="form-control form-control-modern" name="software_design_hd_layout" rows="3">{{ $hd->software_design_hd_layout }}</textarea>
                                </div>
                            </div>
                        </div>

                        <h5 class="section-title">Design Workflow</h5>
                        <div class="form-section-group mb-4">
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-9">
                                    <label for="prepared_by1" class="form-label-modern mb-2">Prepared by</label>
                                    <input class="form-control form-control-modern" name="prepared_by1" value="{{ $hd->prepared_by1 }}" readonly>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="prepared_date1" class="form-label-modern mb-2">Date</label>
                                    <input class="form-control form-control-modern" type="date" name="prepared_date1" value="{{ $hd->prepared_date1 }}" required>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-md-9">
                                    <label for="reviewed_by1" class="form-label-modern mb-2">Reviewed by</label>
                                    <select class="form-control form-control-modern receiver-select" name="reviewed_by1">
                                        <option value=""></option>
                                        @foreach ($emp as $item)
                                            <option value="{{ $item->ms_employee_fullname }}"
                                                {{ isset($hd->reviewed_by1) && $hd->reviewed_by1 == $item->ms_employee_fullname ? 'selected' : '' }}>
                                                {{ $item->ms_employee_fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="reviewed_date1" class="form-label-modern mb-2">Date</label>
                                    <input class="form-control form-control-modern" type="date" name="reviewed_date1" readonly>
                                </div>
                            </div> 
                        </div>

                        <h5 class="section-title">2. Verification Table</h5>
                        <div class="mb-3">
                            <button type="button" class="btn btn-add-row px-3 py-2" onclick="addRow()">
                                ➕ เพิ่มแถวรายการคํานวณ
                            </button>
                        </div>
                        <div class="table-responsive mb-4">
                            <table class="table table-modern text-center" id="destroyTable">
                                <thead>
                                    <tr>
                                        <th style="width: 54%">Calculation</th>
                                        <th style="width: 14%">By hand</th>
                                        <th style="width: 14%">Display</th>
                                        <th style="width: 13%">% Error</th>
                                        <th style="width: 5%">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dt as $item)
                                        <tr>
                                            <td>
                                                <input class="form-control form-control-modern" name="software_design_dt_calculation[]" value="{{ $item->software_design_dt_calculation }}">
                                                <input type="hidden" name="software_design_dt_id[]" value="{{ $item->software_design_dt_id }}">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-modern text-center" name="software_design_dt_byhand[]" value="{{ $item->software_design_dt_byhand }}">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-modern text-center" name="software_design_dt_display[]" value="{{ $item->software_design_dt_display }}">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-modern text-center" name="software_design_dt_error[]" value="{{ $item->software_design_dt_error }}">
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" class="btn btn-delete btn-sm" onclick="confirmDel('{{ $item->software_design_dt_id }}', this)">
                                                    ลบ
                                                </a>
                                            </td>
                                        </tr>  
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h5 class="section-title">3. Comments & Final Signatures</h5>
                        <div class="form-section-group mb-4">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="software_design_hd_comment" class="form-label-modern mb-2">Comment / ผลการตรวจสอบ</label>
                                    <textarea class="form-control form-control-modern" name="software_design_hd_comment" rows="3">{{ $hd->software_design_hd_comment }}</textarea>
                                </div>
                            </div>
                            
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-9">
                                    <label for="prepared_by2" class="form-label-modern mb-2">Verified/Prepared by (Verification)</label>
                                    <input class="form-control form-control-modern" name="prepared_by2" value="{{ $hd->prepared_by2 }}" readonly>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="prepared_date2" class="form-label-modern mb-2">Date</label>
                                    <input class="form-control form-control-modern" type="date" name="prepared_date2" value="{{ $hd->prepared_date2 }}" required>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-9">
                                    <label for="reviewed_by2" class="form-label-modern mb-2">Reviewed by (Verification)</label>
                                    <select class="form-control form-control-modern receiver-select" name="reviewed_by2">
                                        <option value=""></option>
                                        @foreach ($emp as $item)
                                            <option value="{{ $item->ms_employee_fullname }}"
                                                {{ isset($hd->reviewed_by2) && $hd->reviewed_by2 == $item->ms_employee_fullname ? 'selected' : '' }}>
                                                {{ $item->ms_employee_fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="reviewed_date2" class="form-label-modern mb-2">Date</label>
                                    <input class="form-control form-control-modern" type="date" name="reviewed_date2" readonly>
                                </div>
                            </div> 

                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-9">
                                    <label for="initialapproval_by" class="form-label-modern mb-2">Initial Approval by</label>
                                    <select class="form-control form-control-modern receiver-select" name="initialapproval_by">
                                        <option value=""></option>
                                        @foreach ($emp as $item)
                                            <option value="{{ $item->ms_employee_fullname }}"
                                                {{ isset($hd->initialapproval_by) && $hd->initialapproval_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                                {{ $item->ms_employee_fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="initialapproval_date" class="form-label-modern mb-2">Date</label>
                                    <input class="form-control form-control-modern" type="date" name="initialapproval_date" readonly>
                                </div>
                            </div> 

                            <div class="row g-3">
                                <div class="col-12 col-md-9">
                                    <label for="finalapproval_by" class="form-label-modern mb-2">Final Approval</label>
                                    <select class="form-control form-control-modern receiver-select" name="finalapproval_by">
                                        <option value=""></option>
                                        @foreach ($emp as $item)
                                            <option value="{{ $item->ms_employee_fullname }}"
                                                {{ isset($hd->finalapproval_by) && $hd->finalapproval_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                                {{ $item->ms_employee_fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="finalapproval_date" class="form-label-modern mb-2">Date</label>
                                    <input class="form-control form-control-modern" type="date" name="finalapproval_date" readonly>
                                </div>
                            </div> 
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 col-md-2">
                                <button type="submit" class="btn btn-indigo btn-block shadow-sm">
                                    💾 บันทึกการเปลี่ยนแปลง
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

// ✅ ฟังก์ชันเพิ่มแถวใหม่ (สำหรับหน้า Edit จะไม่มี ID เดิมติดไป)
function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td>
            <input type="hidden" name="listno[]" value="${rowCount}">
            <input type="hidden" name="software_design_dt_id[]" value="">
            <input type="text" class="form-control form-control-modern" placeholder="สูตรคํานวณ / รายการ" name="software_design_dt_calculation[]">
        </td>
        <td>
            <input type="text" class="form-control form-control-modern text-center" placeholder="ผลแมนนวล" name="software_design_dt_byhand[]">
        </td>
        <td>
            <input type="text" class="form-control form-control-modern text-center" placeholder="ผลบนจอ" name="software_design_dt_display[]">
        </td>
        <td>
            <input type="text" class="form-control form-control-modern text-center" placeholder="เปอร์เซ็นต์คลาดเคลื่อน" name="software_design_dt_error[]">
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-delete btn-sm" onclick="removeRow(this)">ลบ</button>
        </td>
    `;

    tableBody.appendChild(row);
    updateRowNumbers(); 
}

// ✅ ฟังก์ชันลบแถวที่เพิ่งเพิ่มใหม่ (ยังไม่ได้ลงฐานข้อมูล)
function removeRow(button) {
    const row = button.closest("tr");
    row.remove();
    updateRowNumbers(); 
}

function updateRowNumbers() {
    document.querySelectorAll("#destroyTable tbody tr").forEach((row, index) => {
        const number = index + 1;
        const hiddenInput = row.querySelector('input[name="listno[]"]');
        if(hiddenInput) hiddenInput.value = number;
    });
}

// ✅ ฟังก์ชันลบข้อมูลแถวเดิมในฐานข้อมูลผ่าน Ajax พร้อมปรับสไตล์ SweetAlert2 ใหม่
confirmDel = (refid, button) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: "คุณต้องการลบรายการคํานวณนี้ออกจากระบบใช่หรือไม่ ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยันการลบ',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            confirmButton: 'btn btn-indigo mx-2',
            cancelButton: 'btn btn-light mx-2'
        },
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelSoftwareDesignDt') }}`,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "refid": refid
                },
                dataType: "json",
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire({
                            title: 'ลบสำเร็จ',
                            text: 'ลบรายการคำนวณเรียบร้อยแล้ว',
                            icon: 'success',
                            confirmButtonText: 'ตกลง',
                            customClass: { confirmButton: 'btn btn-indigo' },
                            buttonsStyling: false
                        }).then(function() {
                            // ทำการลบแถวออกจากหน้าจอแบบไม่ต้องรีโหลดทั้งหน้าเพื่อ UXที่ดี
                            if(button) {
                                button.closest("tr").remove();
                                updateRowNumbers();
                            } else {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถลบรายการได้ กรุณาลองใหม่อีกครั้ง',
                            icon: 'error',
                            confirmButtonText: 'ปิด',
                            customClass: { confirmButton: 'btn btn-secondary' },
                            buttonsStyling: false
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'การเชื่อมต่อล้มเหลว',
                        text: 'ไม่สามารถติดต่อเซิร์ฟเวอร์ได้ในขณะนี้',
                        icon: 'error',
                        confirmButtonText: 'ปิด',
                        customClass: { confirmButton: 'btn btn-secondary' },
                        buttonsStyling: false
                    });
                }
            });
        }
    });
}
</script>
@endpush