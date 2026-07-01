@extends('layouts.main')
@section('content')

{{-- @push('styles') --}}
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}

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
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .title-block h5 {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
        font-size: 1.4rem;
        line-height: 1.4;
    }

    .doc-meta {
        font-size: 0.85rem;
        color: #64748b;
        text-align: right;
        line-height: 1.4;
    }

    .card-body-modern {
        padding: 2rem 2.5rem 2.5rem 2.5rem;
    }

    /* Section Inner Form Groups */
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

    label { 
        font-weight: 600; 
        color: #475569; 
        display: block; 
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    /* Form Controls Controls Design */
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
        height: auto;
    }
    .form-control-modern:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    /* Table Component Design */
    .table-responsive-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        margin-bottom: 25px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    table.table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
        margin-bottom: 0 !important;
    }
    
    table.table-modern th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 700;
        border-bottom: 2px solid #e2e8f0;
        padding: 12px 10px;
        font-size: 0.85rem;
    }

    table.table-modern td {
        padding: 10px;
        border-bottom: 1px solid #e2e8f0;
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
        padding: 6px 14px;
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
        width: 100%;
    }
    .btn-indigo-submit:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    /* Select2 Elements Overrides */
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
        .header-container { flex-direction: column; text-align: center; }
        .doc-meta { text-align: center; margin-top: 5px; }
        .card-body-modern { padding: 1.25rem; }
    }
</style>

<div class="container-fluid">
    <div class="card custom-card">
        
        <div class="card-header-modern">
            <div class="header-container">
                <div class="title-block">
                    <h5>บริษัท เอสซอม จำกัด<br>ใบขอทำลายเอกสาร</h5>
                </div>
                <div class="doc-meta">
                    <strong>F7530.4</strong><br>1 May. 17
                </div>
            </div>
        </div>

        <div class="card-body-modern">
            <form method="POST" class="form-horizontal" action="{{ route('document-destruction.update',$hd->documentdestruction_hd_id) }}" enctype="multipart/form-data">
                @csrf    
                @method('PUT')  
                <input type="hidden" name="check_docu" value="Edit">
                <div class="form-section-panel">
                    <div class="row">
                        <div class="col-md-4 mb-3 mb-md-0">
                             <label>เรียน</label>
                             <input class="form-control-modern" type="text" name="documentdestruction_hd_to" placeholder="ระบุผู้รับหนังสือ" value="{{$hd->documentdestruction_hd_to}}" required>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                             <label>จาก</label>
                             <input class="form-control-modern" type="text" name="documentdestruction_hd_from" placeholder="ระบุหน่วยงานผู้ส่ง" value="{{$hd->documentdestruction_hd_from}}" required>
                        </div>
                        <div class="col-md-4">
                             <label>วันที่เอกสาร</label>
                             <input class="form-control-modern" type="date" name="documentdestruction_hd_date" value="{{ $hd->documentdestruction_hd_date }}" required>
                        </div>
                    </div>
                </div>

                <div class="section-subtitle">
                    <i class="fas fa-file-alt"></i> รายการเอกสารที่ขอทำลาย
                </div>

                <div class="mb-3">
                    <button type="button" class="btn-indigo-add-row" onclick="addRow()">
                        <i class="fas fa-plus"></i> เพิ่มแถวรายการ
                    </button>
                </div>

                <div class="table-responsive-container">
                    <table class="table table-modern text-center" id="destroyTable">
                        <thead>
                            <tr>
                                <th style="width: 8%">ลำดับ</th>
                                <th style="width: 22%">รหัสเอกสาร</th>
                                <th style="width: 35%">ชื่อเอกสาร</th>
                                <th style="width: 25%">หมายเหตุ</th>
                                <th style="width: 10%">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dt as $item)
                                <tr>
                                <td>
                                    <span class="row-number">{{$item->documentdestruction_dt_listno}}</span>
                                    <input type="hidden" name="documentdestruction_dt_listno[]" value="{{$item->documentdestruction_dt_listno}}">
                                </td>
                                <td>
                                    <input type="text" name="documentdestruction_dt_code[]" class="form-control-modern" value="{{$item->documentdestruction_dt_code}}" placeholder="กรอกรหัสเอกสาร" required>
                                </td>
                                <td>
                                    <input type="text" name="documentdestruction_dt_name[]" class="form-control-modern" value="{{$item->documentdestruction_dt_name}}" placeholder="กรอกชื่อเอกสาร" required>
                                </td>
                                <td>
                                    <input type="text" name="documentdestruction_dt_note[]" class="form-control-modern" value="{{$item->documentdestruction_dt_note}}" placeholder="กรอกหมายเหตุ">
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn-action-delete" onclick="confirmDel('{{ $item->documentdestruction_dt_id }}')" title="ลบรายการ">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                </div>

                <div class="form-section-panel">
                    <div class="section-subtitle">
                        <i class="fas fa-user-check"></i> ขั้นตอนการลงนามและสั่งการ
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4 mb-md-0 text-center px-3">
                            <label class="text-left">ผู้ขออนุมัติ</label>
                            <input class="form-control-modern mb-2" type="text" value="{{$hd->requested_by}}" name="requested_by" style="background-color: #f1f5f9;" readonly>
                            <input class="form-control-modern" type="date" value="{{$hd->requested_date }}" name="requested_date" required>
                        </div>
                        
                        <div class="col-md-4 mb-4 mb-md-0 text-center px-3">
                            <label class="text-left">ผู้จัดการฝ่าย (ผู้ทบทวน)</label>
                            <div class="text-left mb-2">
                                <select class="form-control receiver-select" name="reviewed_by" required>
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}" {{ isset($hd->reviewed_by) &&  $hd->reviewed_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                            {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input class="form-control-modern" type="date" readonly style="background-color: #f1f5f9; cursor: not-allowed;" placeholder="รอลงวันที่เมื่อทบทวน">
                        </div>
                        
                        <div class="col-md-4 text-center px-3">
                            <label class="text-left">ผู้อนุมัติ</label>
                            <div class="text-left mb-2">
                                 <select class="form-control receiver-select" name="approved_by" required>
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}" {{ isset($hd->approved_by) &&  $hd->approved_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                            {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input class="form-control-modern" type="date" readonly style="background-color: #f1f5f9; cursor: not-allowed;" placeholder="รอลงวันที่เมื่ออนุมัติ">
                        </div>
                    </div>
                </div> 

                <div class="row justify-content-end">
                    <div class="col-12 col-md-3 col-lg-2">
                        <button type="submit" class="btn-indigo-submit">
                            <i class="fas fa-save mr-1"></i> บันทึกข้อมูล
                        </button>
                    </div>
                </div>

            </form>                 
        </div>
    </div>
</div>

@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
$(document).ready(function () {
    // init select2
    initSelect2();
});

function initSelect2() {
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน...',
        allowClear: true,
        width: '100%'
    });
}

// ✅ ฟังก์ชันเพิ่มแถว
function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td>
            <span class="row-number">${rowCount}</span>
            <input type="hidden" name="documentdestruction_dt_listno[]" value="${rowCount}">
        </td>
        <td>
            <input type="text" name="documentdestruction_dt_code[]" class="form-control-modern" placeholder="กรอกรหัสเอกสาร" required>
        </td>
        <td>
            <input type="text" name="documentdestruction_dt_name[]" class="form-control-modern" placeholder="กรอกชื่อเอกสาร" required>
        </td>
        <td>
            <input type="text" name="documentdestruction_dt_note[]" class="form-control-modern" placeholder="กรอกหมายเหตุ">
        </td>
        <td>
            <button type="button" class="btn-action-delete" onclick="removeRow(this)">ลบ</button>
        </td>
    `;

    tableBody.appendChild(row);
    updateRowNumbers();
}

// ✅ ฟังก์ชันลบแถว
function removeRow(button) {
    const tableBody = document.querySelector("#destroyTable tbody");
    if (tableBody.querySelectorAll("tr").length <= 1) {
        Swal.fire({
            title: 'คำเตือน',
            text: 'ต้องมีรายการเอกสารอย่างน้อย 1 แถว',
            icon: 'warning',
            confirmButtonColor: '#4f46e5'
        });
        return;
    }
    const row = button.closest("tr");
    row.remove();
    updateRowNumbers();
}

function updateRowNumbers() {
    document.querySelectorAll("#destroyTable tbody tr").forEach((row, index) => {
        const number = index + 1;
        row.querySelector(".row-number").textContent = number;
        row.querySelector('input[name="documentdestruction_dt_listno[]"]').value = number;
    });
}
confirmDel = (refid) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: 'คุณต้องการลบใบขอทำลายเอกสารรายการนี้หรือไม่ ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        confirmButtonClass: 'btn btn-success px-4 py-2 text-white font-weight-bold rounded',
        cancelButtonClass: 'btn btn-danger ms-2 px-4 py-2 text-white font-weight-bold rounded',
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelDestructionDt') }}`,
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
                            text: 'ยกเลิกเอกสารเรียบร้อยแล้ว',
                            icon: 'success',
                            confirmButtonColor: '#4f46e5'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'ยกเลิกเอกสารไม่สำเร็จ',
                            icon: 'error',
                            confirmButtonColor: '#dc2626'
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิกแล้ว',
                text: 'โปรดตรวจสอบข้อมูลอีกครั้งเพื่อความถูกต้อง :)',
                icon: 'error',
                confirmButtonColor: '#dc2626'
            });
        }
    });
}
</script>
@endpush