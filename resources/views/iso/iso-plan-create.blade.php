@extends('layouts.main')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'สำเร็จ!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#4f46e5'
});
</script>
@endif

<style>
    /* Modern Indigo Theme Setup */
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
    
    .card-header-modern {
        background-color: #ffffff;
        padding: 2rem 2.5rem 1.2rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        text-align: center;
    }

    .card-header-modern h2 {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
        font-size: 1.5rem;
        line-height: 1.3;
    }

    .card-body-modern {
        padding: 2rem 2.5rem 2.5rem 2.5rem;
    }

    /* Section Panels */
    .form-section-panel {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 22px;
        margin-bottom: 25px;
    }

    .section-subtitle {
        font-size: 1rem;
        font-weight: 700;
        color: #4f46e5;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    label, .field-label { 
        font-weight: 600; 
        color: #475569; 
        display: block; 
        margin-bottom: 8px;
        font-size: 0.9rem;
        text-align: left;
    }

    /* Form Controls Design */
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
        height: 38px;
    }
    .form-control-modern:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }
    .form-control-modern[readonly], .form-control-modern[disabled] {
        background-color: #f1f5f9 !important;
        color: #64748b;
        border-color: #e2e8f0;
        cursor: not-allowed;
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
        font-size: 0.88rem;
        margin-bottom: 0 !important;
    }
    
    table.table-modern th {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
        font-weight: 600;
        border: 1px solid #4338ca !important;
        padding: 10px;
        font-size: 0.85rem;
        text-transform: uppercase;
    }

    table.table-modern td {
        padding: 10px;
        border: 1px solid #e2e8f0;
        vertical-align: middle;
        background-color: #ffffff;
    }

    /* Buttons Styling */
    .btn-indigo-add-row {
        background-color: #ffffff;
        color: #4f46e5;
        border: 1px solid #c7d2fe;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-indigo-add-row:hover {
        background-color: #eeeffe;
        border-color: #4f46e5;
    }

    .btn-action-delete {
        background-color: #fff5f5;
        color: #e53e3e;
        border: 1px solid #fed7d7;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-action-delete:hover {
        background-color: #e53e3e;
        color: #ffffff;
        border-color: #e53e3e;
    }

    .btn-indigo-submit {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: #ffffff !important;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
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

    /* Select2 Overrides */
    .select2-container--default .select2-selection--single {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        height: 38px !important;
        padding: 4px 6px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }

    @media (max-width: 768px) {
        .card-body-modern { padding: 1.25rem; }
    }
</style>

<div class="container-fluid">
    <div class="card custom-card">
        
        <!-- Modernized Form Header -->
        <div class="card-header-modern">
            <h2>ESSOM CO., LTD.</h2>
            <h2>PLAN</h2>
        </div>

        <!-- Modernized Form Body -->
        <div class="card-body-modern">
            <form action="{{ route('iso-plan.store') }}" method="POST">
                @csrf
                
                <!-- Project Info Panel -->
                <div class="form-section-panel">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <span class="field-label">Project</span>
                            <input type="text" name="project_name" class="form-control-modern" placeholder="Enter project name" required>
                        </div>
                        <div class="col-md-6">
                            <span class="field-label">Responsible Section / Person</span>
                            <input type="text" name="responsible_section" class="form-control-modern" placeholder="Enter section or person" required>
                        </div>
                    </div>
                </div>

                <!-- Activities Dynamic Table -->
                <div class="section-subtitle">
                    <i class="fas fa-tasks"></i> Description of Activities
                </div>

                <div class="table-responsive-container">
                    <table class="table table-modern text-center" id="activityTable">
                        <thead>
                            <tr>
                                <th rowspan="2" style="width: 5%">No.</th>
                                <th rowspan="2" style="width: 25%">Description of Activities</th>
                                <th rowspan="2" style="width: 20%">Resp.<br>Person</th>
                                <th colspan="2" style="border-bottom: 1px solid #4338ca !important;">Date</th>
                                <th style="border-bottom: 1px solid #4338ca !important;">STATUS</th>
                                <th rowspan="2" style="width: 20%">Progress Report/Remarks</th>
                                <th rowspan="2" style="width: 5%">[ลบ]</th>
                            </tr>
                            <tr>
                                <th style="width: 10%">Start</th>
                                <th style="width: 10%">Finish</th>
                                <th style="width: 10%">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 5; $i++)
                            <tr>
                                <td class="font-weight-bold" style="color: #64748b;">{{ $i + 1 }}</td>
                                <td><input type="text" name="DA[]" class="form-control-modern" placeholder="Description"></td>
                                <td>
                                    <select class="form-control receiver-select" name="RP[]">
                                        <option value=""></option>
                                        @foreach ($emp as $item)
                                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="date" class="form-control-modern" name="date_start[]"></td>
                                <td><input type="date" class="form-control-modern" name="date_end[]"></td>
                                <td><input type="text" class="form-control-modern" name="RS[]" placeholder="Status"></td>
                                <td><input type="text" class="form-control-modern" name="Remark[]" placeholder="Remarks"></td>
                                <td><button type="button" class="btn-action-delete">ลบ</button></td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <div class="mb-4 clearfix">
                    <button type="button" class="btn-indigo-add-row float-left" id="addRowBtn">
                        <i class="fas fa-plus"></i> เพิ่มแถวรายการ
                    </button>
                </div>

                <!-- Workflow Signatures Block -->
                <div class="form-section-panel">
                    <div class="section-subtitle">
                        <i class="fas fa-user-check"></i> Workflow Signatures & Reviews
                    </div>
                    
                    <!-- Row 1: Prepared & Progress Review -->
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <span class="field-label">Prepared by</span>
                            <input class="form-control-modern" type="text" name="prepared_by" value="{{ auth()->user()->name }}" readonly>
                        </div>
                        <div class="col-md-2 mb-3 mb-md-0">
                            <span class="field-label">Date</span>
                            <input class="form-control-modern" type="date" name="prepared_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <span class="field-label">Progress Review</span> 
                            <select class="form-control receiver-select" name="prepared_progress_review">
                                <option value=""></option>
                                @foreach ($emp as $item)
                                    <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                @endforeach
                            </select>
                         </div>
                         <div class="col-md-2">
                            <span class="field-label">Date</span>
                            <input class="form-control-modern" type="date" name="prepared_progress_date" required>
                         </div>
                    </div>

                    <!-- Row 2: Reviewed & Reported -->
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <span class="field-label">Reviewed by</span>  
                            <select class="form-control receiver-select" name="reviewed_by">
                                <option value=""></option>
                                @foreach ($emp as $item)
                                    <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-3 mb-md-0">
                            <span class="field-label">Date</span>
                            <input class="form-control-modern" type="date" name="reviewed_date" required>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <span class="field-label">Reported by</span> 
                            <select class="form-control receiver-select" name="reported_by">
                                <option value=""></option>
                                @foreach ($emp as $item)
                                    <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <span class="field-label">Date</span>
                            <input class="form-control-modern" type="date" name="reported_progress_date" required>
                        </div>
                    </div>

                    <!-- Row 3: Approved & Acknowledged -->
                    <div class="row">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <span class="field-label">Approved by</span> 
                            <select class="form-control receiver-select" name="approved_by">
                                <option value=""></option>
                                @foreach ($emp as $item)
                                    <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-3 mb-md-0">
                            <span class="field-label">Date</span>
                            <input class="form-control-modern" type="date" name="approved_date" required>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <span class="field-label">Acknowledged by</span> 
                            <select class="form-control receiver-select" name="acknowledged_by">
                                <option value=""></option>
                                @foreach ($emp as $item)
                                    <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <span class="field-label">Date</span>
                            <input class="form-control-modern" type="date" name="acknowledged_date" required>
                        </div>
                    </div>
                </div>

                <!-- Footer Action Buttons -->
                <div class="text-right style-action-container" style="margin-top:20px;">
                    <button type="submit" class="btn-indigo-submit">
                        <i class="fas fa-save mr-1"></i> บันทึกข้อมูลแผนงาน
                    </button>
                </div>
            </form>                 
        </div>
    </div>
</div>

@endsection

@push('scriptjs')
<script>
$(document).ready(function () {
    // init select2 
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน...',
        allowClear: true,
        width: '100%'
    });
});

const tableBody = document.querySelector('#activityTable tbody');
const addRowBtn = document.getElementById('addRowBtn');

function deleteRow(btn) {
    const row = btn.closest('tr');
    if (!row) return;
    Swal.fire({
        title: 'ยืนยันลบ?',
        text: "คุณแน่ใจหรือไม่ว่าต้องการลบแถวนี้?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e53e3e',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'ใช่, ลบ!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            row.remove();
            updateRowNumbers();
            Swal.fire({
                title: 'ลบแล้ว!',
                icon: 'success',
                confirmButtonColor: '#4f46e5'
            });
        }
    });
}

function updateRowNumbers() {
    const rows = tableBody.querySelectorAll('tr');
    rows.forEach((row, index) => row.cells[0].textContent = index + 1);
}

addRowBtn.addEventListener('click', () => {
    const rowCount = tableBody.rows.length + 1;
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td class="font-weight-bold" style="color: #64748b;">${rowCount}</td>
        <td><input type="text" name="DA[]" class="form-control-modern" placeholder="Activity"></td>
        <td>
            <select class="form-control receiver-select" name="RP[]">
                <option value=""></option>
                @foreach ($emp as $item)
                     <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="date" class="form-control-modern" name="date_start[]"></td>
        <td><input type="date" class="form-control-modern" name="date_end[]"></td>
        <td><input type="text" class="form-control-modern" name="RS[]" placeholder="Status"></td>
        <td><input type="text" class="form-control-modern" name="Remark[]" placeholder="Remarks"></td>
        <td><button type="button" class="btn-action-delete">ลบ</button></td>
    `;
    tableBody.appendChild(newRow);
    
    // Bind select2 for newly added dynamic row
    $(newRow).find('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน...',
        allowClear: true,
        width: '100%'
    });
    
    newRow.querySelector(".btn-action-delete").addEventListener("click", () => deleteRow(newRow.querySelector(".btn-action-delete")));
});

tableBody.querySelectorAll(".btn-action-delete").forEach(btn => btn.addEventListener("click", () => deleteRow(btn)));
</script>
@endpush