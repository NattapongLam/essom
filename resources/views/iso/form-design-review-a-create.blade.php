@extends('layouts.main')
@section('content')

<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Modern Indigo Theme Styles for Form */
    .custom-card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.08) !important;
        background: #ffffff;
        overflow: hidden;
    }
    
    .custom-card-header {
        background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%) !important;
        color: #ffffff !important;
        padding: 1.5rem !important;
        border-bottom: none !important;
    }

    .custom-card-header h5 {
        color: #ffffff !important;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .doc-meta {
        font-size: 0.85rem;
        opacity: 0.85;
    }

    /* Form Label & Input Design */
    .form-group-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #312e81;
        padding-bottom: 6px;
        border-bottom: 2px solid #e0e7ff;
        margin-bottom: 1.5rem;
    }

    .form-label-custom {
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
    }

    .form-control-modern {
        border: 1px solid #cbd5e1;
        border-radius: 8px !important;
        padding: 0.6rem 0.8rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background-color: #f8fafc;
    }

    .form-control-modern:focus {
        background-color: #ffffff;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
    }

    .form-control-modern[readonly] {
        background-color: #f1f5f9;
        color: #64748b;
        cursor: not-allowed;
    }

    /* Do List Modern Table */
    .modern-table-form {
        border-collapse: separate !important;
        border-spacing: 0 4px !important;
    }

    .modern-table-form thead th {
        background-color: #f1f5f9 !important;
        color: #475569 !important;
        font-weight: 600;
        font-size: 0.85rem;
        border: none !important;
        padding: 10px !important;
    }

    .modern-table-form td {
        background: #ffffff;
        border-top: 1px solid #e2e8f0 !important;
        border-bottom: 1px solid #e2e8f0 !important;
        border-left: none !important;
        border-right: none !important;
        padding: 8px !important;
        vertical-align: middle;
    }

    /* Dynamic Action Buttons */
    .btn-indigo-action {
        background-color: #4f46e5;
        color: #ffffff;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        transition: all 0.2s ease;
        border: none;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .btn-indigo-action:hover {
        background-color: #4338ca;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3);
    }

    .btn-add-row {
        background-color: #ecfdf5;
        color: #059669;
        border: 1px dashed #a7f3d0;
        font-weight: 600;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .btn-add-row:hover {
        background-color: #d1fae5;
        color: #047857;
    }

    .btn-delete-row {
        background-color: #fef2f2;
        color: #dc2626;
        border: 1px solid #fee2e2;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .btn-delete-row:hover {
        background-color: #fee2e2;
        color: #b91c1c;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="custom-card-header d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div class="text-center text-md-left">
                        <h5 class="mb-0">ESSOM CO., LTD</h5>
                        <div class="doc-meta opacity-75">การทบทวนการออกแบบ / DESIGN REVIEW</div>
                    </div>
                    <div class="text-center text-md-right mt-2 mt-md-0">
                        <span class="badge bg-white text-dark font-weight-bold px-2 py-1 mb-1">F8300.2A</span>
                        <div class="doc-meta">19 Jan. 22</div>
                    </div>             
                </div>

                <div class="card-body p-4 p-md-5">   
                    <form method="POST" class="form-horizontal" action="{{ route('design-review-a.store') }}" enctype="multipart/form-data">
                        @csrf        
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group-title">
                                    <i class="fas fa-file-alt me-2 text-indigo"></i> 1. Design Review Details
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label-custom">1.1 Product</label>
                                <input class="form-control form-control-modern" type="text" name="design_review_a_hd_product" placeholder="ระบุชื่อผลิตภัณฑ์">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label-custom">Model</label>
                                <input class="form-control form-control-modern" type="text" name="design_review_a_hd_model" placeholder="รุ่น / โมเดล">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label-custom">1.2 Participants</label>
                                <textarea class="form-control form-control-modern" name="design_review_a_hd_participants" rows="2" placeholder="รายชื่อผู้เข้าร่วมประชุม/ทบทวน"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label-custom">1.3 Subject</label>
                                <textarea class="form-control form-control-modern" name="design_review_a_hd_subject" rows="2" placeholder="หัวข้อการทบทวนการออกแบบ"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-4">
                                <label class="form-label-custom">1.4 Design Input</label>
                                <textarea class="form-control form-control-modern" name="design_review_a_hd_designinput" rows="2" placeholder="ข้อมูลที่ใช้ในการออกแบบ"></textarea>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label-custom mb-0" style="font-size: 1rem;"><i class="fas fa-tasks text-indigo me-1"></i> 1.5 Do List</label>
                                    <button type="button" class="btn btn-sm btn-add-row px-3 py-1.5" onclick="addRow()">
                                        <i class="fas fa-plus me-1"></i> เพิ่มแถวรายการ
                                    </button>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table modern-table-form text-center w-100 mb-0" id="destroyTable">
                                        <thead>
                                            <tr>
                                                <th style="width: 25%">Item</th>
                                                <th style="width: 65%">Description</th>
                                                <th style="width: 10%">ลบ</th>  
                                            </tr>
                                        </thead>
                                        <tbody>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">1.6 Drawing (page(s))</label>
                                <input class="form-control form-control-modern" type="text" name="design_review_a_hd_drawing" placeholder="จำนวนหน้าแบบสเก็ตช์ / แบบสั่งงาน">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">1.7 Reference Documents (page(s))</label>
                                <input class="form-control form-control-modern" type="text" name="design_review_a_hd_reference" placeholder="จำนวนหน้าเอกสารอ้างอิง">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-4">
                                <label class="form-label-custom">1.8 Comment</label>
                                <textarea class="form-control form-control-modern" name="design_review_a_hd_comment" rows="2" placeholder="ความคิดเห็นเพิ่มเติม..."></textarea>
                            </div>
                        </div>

                        <div class="row p-3 mb-4 mx-0 rounded-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                            
                            <div class="col-md-9 mb-3">
                                <label class="form-label-custom text-dark">Reported By</label>
                                <input class="form-control form-control-modern" type="text" name="reported_by" value="{{auth()->user()->name}}" readonly>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label-custom text-dark">Date</label>
                                <input class="form-control form-control-modern" type="date" name="reported_date" value="{{ old('date', now()->format('Y-m-d')) }}">
                            </div>

                            <div class="col-md-9 mb-3">
                                <label class="form-label-custom text-dark">Reviewed By</label>
                                <select class="form-control receiver-select" name="reviewed_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label-custom text-dark">Date</label>
                                <input class="form-control form-control-modern" type="date" name="reviewed_date" readonly>
                            </div>

                            <div class="col-md-9 mb-2">
                                <label class="form-label-custom text-dark">Engineering Supervisor</label>
                                <select class="form-control receiver-select" name="engineecing_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label-custom text-dark">Date</label>
                                <input class="form-control form-control-modern" type="date" name="engineecing_date" readonly>
                            </div>
                        </div> 

                        <div class="row mt-4">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-indigo-action px-5 py-2.5 w-100 w-md-auto">
                                    <i class="fas fa-save me-2"></i> บันทึกข้อมูลเอกสาร
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
    // init select2
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });
});

// ✅ ฟังก์ชันเพิ่มแถวแบบโมเดิร์น
function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td>
            <input type="hidden" name="listno[]" value="${rowCount}">
            <input type="text" class="form-control form-control-modern" placeholder="Item e.g. ${rowCount}" name="design_review_a_dt_item[]">
        </td>
        <td>
            <input type="text" class="form-control form-control-modern" placeholder="ระบุรายละเอียดงาน (Description)" name="design_review_a_dt_description[]">
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-delete-row px-3" onclick="removeRow(this)">
                <i class="fas fa-trash-alt"></i>
            </button>
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

function updateRowNumbers() {
    document.querySelectorAll("#destroyTable tbody tr").forEach((row, index) => {
        const number = index + 1;
        const hiddenInput = row.querySelector('input[name="listno[]"]');
        if (hiddenInput) {
            hiddenInput.value = number;
        }
    });
}
</script>
@endpush