@extends('layouts.main')

@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #e0e7ff;
        --text-dark: #1e1b4b;
        --text-muted: #64748b;
        --bg-light: #f8fafc;
        --border-radius-custom: 16px;
    }

    .custom-card {
        border: none;
        border-radius: var(--border-radius-custom);
        box-shadow: 0 10px 30px -5px rgba(79, 70, 229, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.03);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #6366f1, var(--indigo-primary));
        color: #ffffff;
        padding: 2rem 2rem 1.5rem 2rem;
        border-bottom: none;
    }

    .doc-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        padding: 0.35rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .section-title {
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--indigo-primary);
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background-color: #e2e8f0;
    }

    .recipient-card {
        background-color: var(--bg-light);
        border: 1px solid #f1f5f9;
        border-radius: 12px;
        padding: 1.25rem;
    }

    .recipient-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .recipient-list li {
        font-size: 0.875rem;
        color: var(--text-dark);
        padding: 0.35rem 0;
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .recipient-number {
        font-weight: 700;
        color: var(--indigo-primary);
        min-width: 24px;
    }

    .meeting-details-box {
        background-color: #f0f3ff;
        border: 1px solid var(--indigo-light);
        border-radius: 12px;
        padding: 1.5rem;
    }

    .form-inline-input {
        display: inline-block;
        width: auto;
        min-width: 120px;
        border: none;
        border-bottom: 2px solid var(--indigo-primary);
        border-radius: 0;
        padding: 0.15rem 0.5rem;
        background: transparent;
        font-weight: 600;
        color: var(--text-dark);
        text-align: center;
        transition: all 0.2s ease;
    }

    .form-inline-input:focus {
        background: #ffffff;
        box-shadow: none;
        border-color: var(--indigo-hover);
        outline: none;
    }

    .meeting-text {
        font-size: 1rem;
        line-height: 2.2;
        color: var(--text-dark);
    }

    .table-modern-form {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .table-modern-form thead {
        background: #f8fafc;
    }

    .table-modern-form thead th {
        color: var(--indigo-primary);
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 0.85rem 0.5rem;
        vertical-align: middle;
    }

    .table-modern-form tbody td {
        border-bottom: 1px solid #e2e8f0;
        padding: 0.5rem;
        font-size: 0.875rem;
        vertical-align: middle;
    }

    .table-input {
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 0.375rem 0.6rem;
        font-size: 0.875rem;
        width: 100%;
        transition: all 0.2s;
    }

    .table-input:focus {
        border-color: var(--indigo-primary);
        outline: none;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.15);
    }

    .signature-card {
        background: var(--bg-light);
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.25rem;
        height: 100%;
    }

    .signature-title {
        font-size: 0.825rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .note-box {
        background-color: #fffbe2;
        border: 1px solid #fef3c7;
        border-left: 4px solid #f59e0b;
        border-radius: 8px;
        padding: 1rem 1.25rem;
        color: #92400e;
        font-size: 0.875rem;
    }

    .form-control-custom {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        font-size: 0.875rem;
        padding: 0.5rem 0.75rem;
    }

    .form-control-custom:focus {
        border-color: var(--indigo-primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .btn-indigo-add {
        background-color: var(--indigo-primary);
        color: #ffffff !important;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.6rem 1.5rem;
        border: none;
        box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-indigo-add:hover {
        background-color: var(--indigo-hover);
        transform: translateY(-1px);
        box-shadow: 0 6px 12px -2px rgba(79, 70, 229, 0.4);
    }

    .btn-remove-row {
        color: #ef4444;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 6px;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .btn-remove-row:hover {
        background: #ef4444;
        color: #ffffff;
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">  
        <div class="col-xl-10 col-12">
            <div class="card custom-card">
                <!-- Header -->
                <div class="card-header custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <div>
                            <h4 class="font-weight-bold mb-1 text-white">ESSOM CO., LTD.</h4>
                            <h6 class="mb-0 text-white-50 font-weight-normal" style="font-size: 1.05rem;">
                                แก้ไขหนังสือเชิญประชุมทบทวนโดยฝ่ายบริหาร (MANAGEMENT REVIEW)
                            </h6>
                        </div>
                        <div>
                            <span class="doc-badge text-white">
                                <i class="fas fa-file-alt mr-1"></i> ฟอร์มเอกสาร: F9300.1 (5 Jan. 26)
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body p-4 p-md-5"> 
                    <form action="{{ route('management-reviews.update', $hd->management_review_hds_id) }}" method="POST">
                        @csrf
                        @method('PUT')   
                        <input type="hidden" name="doc_ref" value="Edit">
                        <!-- Date Section -->
                        <div class="row mb-4">
                            <div class="col-md-4 col-lg-3">
                                <div class="form-group mb-0">
                                    <label class="font-weight-bold text-dark mb-1" style="font-size: 0.875rem;">
                                        วันที่ออกหนังสือเชิญ
                                    </label>
                                    <input class="form-control form-control-custom" type="date" name="issue_date" value="{{ $hd->issue_date }}">
                                </div>
                            </div>
                        </div>

                        <!-- Recipient Section -->
                        <div class="mb-4">
                            <div class="section-title">
                                <i class="fas fa-users"></i> รายชื่อผู้เข้าร่วมประชุม (เรียน)
                            </div>
                            
                            <div class="recipient-card">
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="recipient-list">
                                            <li><span class="recipient-number">1.</span> กรรมการจัดการ</li>
                                            <li><span class="recipient-number">3.</span> ที่ปรึกษากรรมการผู้จัดการงานต่างประเทศ</li>
                                            <li><span class="recipient-number">5.</span> รองกรรมการผู้จัดการฝ่ายกิจกรรมพิเศษ</li>
                                            <li><span class="recipient-number">7.</span> ผู้จัดการงานบริหาร</li>
                                            <li><span class="recipient-number">9.</span> ผู้จัดการการงานวิศวกรรมและการตลาดอุปกรณ์การศึกษา</li>
                                            <li><span class="recipient-number">11.</span> ผู้ช่วยจัดการงานผลิตและบริการ</li>
                                            <li><span class="recipient-number">13.</span> ผู้ช่วยผู้จัดการงานวิศวกรรม</li>
                                            <li><span class="recipient-number">15.</span> หัวหน้างานบริหารสำนักงาน</li>
                                            <li><span class="recipient-number">17.</span> หัวหน้างานไอที และ สนับสนุนงานขาย</li>
                                            <li><span class="recipient-number">19.</span> หัวหน้างานออกแบบ/เขียนแบบ</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 mt-3 mt-md-0">
                                        <ul class="recipient-list">
                                            <li><span class="recipient-number">2.</span> ที่ปรึกษากรรมการผู้จัดการงานขายอุปกรณ์อุตสาหกรรม</li>
                                            <li><span class="recipient-number">4.</span> รองกรรมการผู้จัดการฝ่ายออกแบบและผลิต</li>
                                            <li><span class="recipient-number">6.</span> ผู้ตรวจระบบบริหาร/ผู้ช่วยผู้ตรวจระบบบริหาร</li>
                                            <li><span class="recipient-number">8.</span> ผู้จัดการงานขายอุปกรณ์อุตสาหกรรม</li>
                                            <li><span class="recipient-number">10.</span> ผู้ช่วยผู้จัดการงานต่างประเทศและบริการการตลาด</li>
                                            <li><span class="recipient-number">12.</span> ผู้ช่วยผู้จัดการงานผลิตและทดสอบ</li>
                                            <li><span class="recipient-number">14.</span> ผู้ช่วยผู้จัดการงานบริการโรงงาน</li>
                                            <li><span class="recipient-number">16.</span> หัวหน้างานวิศกรรมและการตลาดต่างประเทศ</li>
                                            <li><span class="recipient-number">18.</span> หัวหน้างานไฟฟ้าอุปกรณ์วัดและซอฟต์แวร์</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Details Section -->
                        <div class="mb-4">
                            <div class="section-title">
                                <i class="fas fa-info-circle"></i> รายละเอียดการนัดหมาย
                            </div>
                            <div class="meeting-details-box">
                                <p class="meeting-text mb-0">
                                    กรรมการผู้จัดการ ขอเชิญประชุมทบทวนโดยฝ่ายบริหารระบบคุณภาพ/ระบบบริหารทั่วไป 
                                    ครั้งที่ <input type="text" class="form-inline-input" style="width: 90px;" placeholder="X/YYYY" name="management_review_hds_no" value="{{ $hd->management_review_hds_no }}"> 
                                    ณ วันที่ <input type="date" class="form-inline-input" style="width: 160px;" name="management_review_hds_date" value="{{ $hd->management_review_hds_date }}"> 
                                    เวลา <input type="text" class="form-inline-input" style="width: 130px;" name="management_review_hds_time" value="{{ $hd->management_review_hds_time }}"> 
                                    ที่ <input type="text" class="form-inline-input" style="width: 220px;" placeholder="ห้องประชุม/สถานที่" name="management_review_hds_location" value="{{ $hd->management_review_hds_location }}">
                                </p>
                            </div>
                        </div>

                        <!-- Table Agenda Section -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="section-title mb-0" style="flex-grow: 1;">
                                    <i class="fas fa-list-ol"></i> วาระการประชุม
                                </div>
                                <button type="button" class="btn btn-sm btn-indigo-add" id="btnAddRow" style="padding: 0.4rem 1rem; font-size: 0.825rem;">
                                    <i class="fas fa-plus"></i> เพิ่มวาระ
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-modern-form text-center align-middle mb-0" id="planningTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">#</th>
                                            <th style="width: 30%;">หัวข้อการประชุม</th>
                                            <th style="width: 20%;">วาระการประชุม</th>
                                            <th style="width: 20%;">ผู้รายงาน</th>
                                            <th style="width: 15%;">ประธาน</th>
                                            <th style="width: 10%;">เวลา</th>
                                            <th style="width: 5%;">จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Dynamic rows generated by JS -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Signatures Section -->
                        <div class="mb-4">
                            <div class="section-title">
                                <i class="fas fa-file-signature"></i> การอนุมัติและการลงนาม (Signatures)
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="signature-card">
                                        <div class="signature-title">
                                            <i class="fas fa-user-edit text-primary"></i> จัดทำโดย (ผู้จัดการงานบริหาร)
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-sm-7">
                                                <label class="small text-muted mb-1">ชื่อผู้จัดทำ</label>
                                                <input class="form-control form-control-custom bg-white" type="text" name="prepared_by" value="{{ $hd->prepared_by ?? auth()->user()->name }}" readonly>
                                            </div>
                                            <div class="col-sm-5">
                                                <label class="small text-muted mb-1">วันที่จัดทำ</label>
                                                <input class="form-control form-control-custom" type="date" name="prepared_date" value="{{ $hd->prepared_date ?? date('Y-m-d') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="signature-card">
                                        <div class="signature-title">
                                            <i class="fas fa-user-check text-success"></i> อนุมัติโดย (รองกรรมการผู้จัดการฝ่ายกิจกรรมพิเศษ)
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-sm-7">
                                                <label class="small text-muted mb-1">ผู้อนุมัติ</label>
                                                <input class="form-control form-control-custom" type="text" name="checked_by" placeholder="ระบุชื่อผู้อนุมัติ" value="{{ $hd->checked_by }}" readonly>
                                            </div>
                                            <div class="col-sm-5">
                                                <label class="small text-muted mb-1">วันที่อนุมัติ</label>
                                                <input class="form-control form-control-custom" type="date" name="checked_date" value="{{ $hd->checked_date }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Note Box -->
                        <div class="note-box mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-exclamation-circle fa-lg"></i>
                                <strong>หมายเหตุ:</strong> ผู้เข้าประชุมทุกท่านโปรดจัดเตรียมเอกสารรายงาน และทำสำเนาสำหรับแจกจ่ายให้พร้อมก่อนประชุม
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-2 border-top">
                            <a href="{{ route('management-reviews.index') }}" class="btn btn-light px-4" style="border-radius: 8px; line-height: 2.2;">
                                ยกเลิก
                            </a>
                            <button type="submit" class="btn btn-indigo-add shadow-sm">
                                <i class="fas fa-save mr-1"></i> บันทึกการแก้ไข
                            </button>
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
    document.addEventListener('DOMContentLoaded', function () {
        const tableBody = document.querySelector('#planningTable tbody');
        const btnAddRow = document.getElementById('btnAddRow');

        // ข้อมูลวาระการประชุมเก่าที่ดึงมาจาก Controller ($dt)
        const existingAgenda = @json($dt);

        function addRow(data = {}) {
            const rowCount = tableBody.children.length + 1;
            const tr = document.createElement('tr');
            
            tr.innerHTML = `
                <td class="row-number font-weight-bold text-muted">${rowCount}</td>
                <td>
                    <input type="text" name="agenda_topic[]" class="table-input" placeholder="หัวข้อการประชุม" value="${data.agenda_topic || ''}">
                </td>
                <td>
                    <input type="text" name="agenda_type[]" class="table-input" placeholder="วาระการประชุม" value="${data.agenda_type || ''}">
                </td>
                <td>
                    <input type="text" name="reporter[]" class="table-input" placeholder="ผู้รายงาน" value="${data.reporter || ''}">
                </td>
                <td>
                    <input type="text" name="chairman[]" class="table-input" placeholder="ประธาน" value="${data.chairman || ''}">
                </td>
                <td>
                    <input type="text" name="agenda_time[]" class="table-input text-center" value="${data.agenda_time || ''}">
                </td>
                <td>
                    <button type="button" class="btn-remove-row btn-delete-row" title="ลบแถว">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            `;

            tableBody.appendChild(tr);
            updateRowNumbers();
        }

        function updateRowNumbers() {
            const rows = tableBody.querySelectorAll('tr');
            rows.forEach((row, index) => {
                const numTd = row.querySelector('.row-number');
                if (numTd) numTd.textContent = index + 1;
            });
        }

        btnAddRow.addEventListener('click', function () {
            addRow();
        });

        tableBody.addEventListener('click', function (e) {
            const btnDelete = e.target.closest('.btn-delete-row');
            if (btnDelete) {
                const tr = btnDelete.closest('tr');
                if (tableBody.children.length > 1) {
                    tr.remove();
                    updateRowNumbers();
                } else {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ไม่สามารถลบได้',
                            text: 'ต้องมีวาระการประชุมอย่างน้อย 1 รายการ',
                            confirmButtonColor: '#4f46e5'
                        });
                    } else {
                        alert('ต้องมีวาระการประชุมอย่างน้อย 1 รายการ');
                    }
                }
            }
        });

        // โหลดข้อมูลเก่าเข้าตาราง ถ้าไม่มีให้สร้างแถวว่าง 1 แถว
        if (existingAgenda && existingAgenda.length > 0) {
            existingAgenda.forEach(item => addRow(item));
        } else {
            addRow();
        }
    });
</script>
@endpush