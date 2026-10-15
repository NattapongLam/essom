@extends('layouts.main')
@section('content')
<!-- SweetAlert2 Resource -->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Theme Styles for Objective Table */
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
        padding: 1.5rem 1.75rem !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .main-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }
    .doc-meta {
        font-size: 0.8rem;
        color: #94a3b8;
        font-weight: 500;
    }

    /* Modern Indigo Button */
    .btn-indigo-add {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        padding: 0.55rem 1.35rem !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        font-size: 0.9rem;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2) !important;
        transition: all 0.2s ease !important;
        border: none !important;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-indigo-add:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3) !important;
        transform: translateY(-1px);
        color: #ffffff !important;
        text-decoration: none;
    }

    /* Table & Inputs Customization */
    .table-responsive-container {
        border-radius: 12px;
        overflow: auto;
        border: 1px solid #e2e8f0;
        width: 100%;
        background: #ffffff;
    }
    #destroyTable {
        margin: 0 !important;
        width: 100%;
    }
    #destroyTable thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 0.85rem 0.5rem !important;
        font-size: 0.9rem;
        vertical-align: middle !important;
    }
    #destroyTable tbody td {
        padding: 0.85rem 0.6rem !important;
        vertical-align: middle !important;
        color: #334155;
        font-size: 0.9rem;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    /* Modern Form Controls inside Table */
    .form-control-modern {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 0.45rem 0.75rem !important;
        font-size: 0.9rem;
        width: 100%;
        outline: none;
        transition: all 0.2s;
        background-color: #ffffff;
    }
    .form-control-modern:focus {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }
    textarea.form-control-modern {
        resize: vertical;
        min-height: 38px;
    }

    /* Delete Action Button inside Table */
    .btn-table-delete {
        background-color: #fee2e2 !important;
        color: #dc2626 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 0.4rem 0.65rem !important;
        transition: all 0.2s;
        cursor: pointer;
    }
    .btn-table-delete:hover {
        background-color: #dc2626 !important;
        color: #ffffff !important;
    }
</style>

<div class="objective-container">
    <form action="{{ route('office-repairreques.store') }}" method="POST" class="form-container">
    @csrf
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div>
                            <h5 class="main-title">ใบแจ้งซ่อมและประวัติซ่อมอุปกรณ์สำนักงาน</h5>
                        </div>
                        <div class="text-md-right mt-2 mt-md-0 doc-meta">
                            <strong>Form No:</strong> F7131.1<br>
                            <strong>Date:</strong> 19 Nov 20
                        </div>
                    </div>
                </div>

                <div class="card-body">           
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">ชื่ออุปกรณ์</label>
                                <input class="form-control" type="text" name="equipment_name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">รหัสทรัพย์สิน</label>
                                <input class="form-control" type="text" name="equipment_code" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">วันที่แจ้ง</label>
                                <input class="form-control" type="date" name="notification_date" value="{{date('Y-m-d')}}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <button type="button" class="btn-indigo-add" onclick="addRow()">
                                    <i class="fas fa-plus"></i> เพิ่มแถวข้อมูล
                                </button>
                            </div>
                            <div class="table-responsive-container">
                                <table class="table text-center" id="destroyTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 8%">ลำดับ</th>
                                            <th style="width: 37%">ลักษณะอาการที่ชำรุดหรือเสีย (อย่างละเอียด)</th>
                                            <th style="width: 37%">การแก้ไข</th>
                                            <th style="width: 10%">หมายเหตุ</th>
                                            <th style="width: 8%">ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- แถวข้อมูลเริ่มต้นจะถูกเพิ่มด้วย JavaScript อัตโนมัติ -->
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-form-label">ผู้แจ้งซ่อม</label>
                                <input class="form-control" value="{{ auth()->user()->name }}" name="notification_person" readonly> 
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-form-label">ผู้รับแจ้งซ่อม</label>
                                <input class="form-control" type="text" name="receiver_name" readonly> 
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">ขั้นตอนติดตาม</label>
                                <div class="checkbox-group-wrapper">
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="track_type1" name="tracking_status[]" value="send_company">
                                        <label for="track_type1">จัดส่งบริษัทเพื่อซ่อม</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="track_type2" name="tracking_status[]" value="wait_quotation">
                                        <label for="track_type2">รอใบเสนอราคา</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="track_type3" name="tracking_status[]" value="wait_parts">
                                        <label for="track_type3">รอสั่งซื้ออุปกรณ์</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="track_type4" name="tracking_status[]" value="other">
                                        <label for="track_type4">อื่นๆ</label>
                                        <input class="form-control" name="tracking_remark" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">อนุมัติการดำเนินการซ่อม</label>
                                <input class="form-control" type="text" name="approver_name" readonly> 
                                <small class="text-muted d-block mt-1">ผจก.งานบริหาร/กรรมการผู้จัดการ</small>
                                <input class="form-control" name="approver_remark" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">ความคิดเห็นเจ้าหน้าที่</label>
                                <div class="checkbox-indigo-container mb-2">
                                    <input type="checkbox" id="staff_type1" name="staff_opinion" value="completed">
                                    <label for="staff_type1">ดำเนินการเสร็จเรียบร้อยแล้ว วันที่</label>
                                    <input class="form-control mt-1" type="date" name="completed_date" readonly> 
                                </div>
                                <div class="checkbox-indigo-container">
                                    <input type="checkbox" id="staff_type2" name="staff_opinion" value="cannot_repair">
                                    <label for="staff_type2">ไม่สามารถซ่อมได้เพราะ</label>
                                    <input class="form-control mt-1" type="text" name="cannot_repair_reason" readonly> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3 text-right">
                        <button type="submit" class="btn btn-indigo-add">บันทึกข้อมูล</button>
                    </div>
                </div> 
            </div> 
        </div>
    </div>
    </form>
</div>
@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
// จัดการเรียกใช้งานแถวแรกอัตโนมัติเมื่อโหลดหน้าเสร็จสิ้น
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
            <input type="hidden" name="detail_no[]" value="${rowCount}">            
        </td>
        <td>
            <textarea class="form-control-modern" name="symptom_detail[]" rows="1" required></textarea>
        </td>
        <td>
            <textarea class="form-control-modern" name="repair_action[]" rows="1"></textarea>
        </td>
        <td>
            <input type="text" class="form-control-modern text-center p-1" name="remark[]">
        </td>
        <td>
            <button type="button" class="btn-table-delete" onclick="removeRow(this)">
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
    const tbody = row.closest("tbody");
    
    if (tbody.querySelectorAll("tr").length > 1) {
        row.remove();
        updateRowNumbers();
    } else {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'warning',
                title: 'แจ้งเตือน',
                text: 'ต้องมีข้อมูลอย่างน้อย 1 แถวครับ',
                confirmButtonColor: '#4f46e5'
            });
        } else {
            alert('ต้องมีข้อมูลอย่างน้อย 1 แถวครับ');
        }
    }
}

// ✅ ฟังก์ชันอัปเดตตัวเลขลำดับ
function updateRowNumbers() {
    document.querySelectorAll("#destroyTable tbody tr").forEach((row, index) => {
        const number = index + 1;
        const targetSpan = row.querySelector(".row-number");
        if(targetSpan) {
            targetSpan.textContent = number;
        }
        const targetInput = row.querySelector('input[name="detail_no[]"]');
        if(targetInput) {
            targetInput.value = number;
        }
    });
}
</script>
@endpush