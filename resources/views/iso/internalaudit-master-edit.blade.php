@extends('layouts.main')

@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Indigo Modern Theme */
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #e0e7ff;
        --text-dark: #1e1b4b;
        --border-radius-custom: 12px;
    }

    .custom-card {
        border: none;
        border-radius: var(--border-radius-custom);
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.1), 0 8px 10px -6px rgba(79, 70, 229, 0.1);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #6366f1, var(--indigo-primary));
        color: #ffffff;
        padding: 1.5rem;
        border-bottom: none;
    }

    .custom-card-header h5 {
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .doc-code {
        font-size: 0.85rem;
        opacity: 0.85;
        font-weight: 300;
    }

    .btn-indigo-add {
        background-color: #ffffff;
        color: var(--indigo-primary) !important;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none !important;
        border: 1px solid var(--indigo-light);
    }

    .btn-indigo-add:hover {
        background-color: var(--indigo-light);
        transform: translateY(-1px);
        box-shadow: 0 6px 12px -2px rgba(79, 70, 229, 0.2);
    }

    /* Table Styling */
    .modern-table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .modern-table thead th {
        background-color: #f8fafc !important;
        color: #64748b;
        font-weight: 600;
        font-size: 0.825rem;
        letter-spacing: 0.5px;
        padding: 1rem 0.5rem !important;
        border-bottom: 2px solid #e2e8f0 !important;
        border-top: none !important;
        text-align: center;
    }

    .modern-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .modern-table tbody tr:hover {
        background-color: #f8fafc;
    }

    .modern-table tbody td {
        padding: 0.75rem 0.5rem !important;
        vertical-align: middle !important;
        color: var(--text-dark);
        font-weight: 500;
        font-size: 0.85rem;
        border-bottom: 1px solid #e2e8f0 !important;
    }

    /* Action Buttons */
    .action-btn {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    /* Custom Form Control Inside Table */
    .table-input {
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        font-size: 0.85rem;
    }

    .table-input:focus {
        border-color: var(--indigo-primary);
        box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.15);
    }
</style>

<div class="container-fluid py-4">
    <form action="{{ route('internalaudit-masters.update', $hd->internalaudit_master_hds_id) }}" method="POST">
        @csrf
        @method('PUT')           
        <div class="row">  
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header custom-card-header">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                            <div class="text-center text-md-left mb-3 mb-md-0">
                                <h5 class="m-0">ESSOM CO.,LTD</h5>
                                <h5 class="m-0 font-weight-normal" style="font-size: 1.1rem; opacity: 0.9;">รายงานการตรวจสอบภายใน</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">      
                        <!-- Header Information Form -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark mb-1">Refer to Standard Document No.</label>
                                    <input class="form-control" type="text" name="document_no" placeholder="ระบุเลขที่เอกสารอ้างอิง" value="{{ $hd->document_no }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark mb-1">Name</label>
                                    <input class="form-control" type="text" name="document_name" placeholder="ระบุชื่อเอกสาร/กระบวนการ" value="{{ $hd->document_name }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark mb-1">Rev.</label>
                                    <input class="form-control" type="text" name="revision" placeholder="เช่น 00, 01" value="{{ $hd->revision }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark mb-1">Effective Date</label>
                                    <input class="form-control" type="date" name="effective_date" value="{{ $hd->effective_date }}">
                                </div>
                            </div>
                        </div>

                        <!-- Table Section Header -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="m-0 font-weight-bold text-dark">รายการตรวจสอบ (Checklist Items)</h6>
                            <button type="button" class="btn btn-indigo-add btn-sm" id="addRowBtn">
                                <i class="fas fa-plus"></i> เพิ่มแถว
                            </button>
                        </div>

                        <!-- Dynamic Audit Table -->
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered modern-table align-middle" id="auditTable">
                                <thead>
                                    <tr>
                                        <th style="width: 3%;">Item</th>
                                        <th style="width: 25%;">Check List</th>
                                        <th style="width: 3%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($dt) && count($dt) > 0)
                                        @foreach($dt as $index => $detail)
                                        <tr>
                                            <td class="row-no text-center font-weight-bold">{{ $index + 1 }}</td>
                                            <td>
                                                <textarea class="form-control form-control-sm table-input" name="audit[{{ $index }}][checklist]" rows="2" placeholder="ระบุรายการที่ตรวจสอบ">{{ $detail->checklist ?? '' }}</textarea>
                                            </td>                                          
                                            <td class="text-center">
                                                <button type="button" class="btn btn-outline-danger btn-sm action-btn delete-row" title="ลบแถว">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <!-- Fallback Row 1 ถ้ายังไม่มีข้อมูลย่อย -->
                                        <tr>
                                            <td class="row-no text-center font-weight-bold">1</td>
                                            <td>
                                                <textarea class="form-control form-control-sm table-input" name="audit[0][checklist]" rows="2" placeholder="ระบุรายการที่ตรวจสอบ"></textarea>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-outline-danger btn-sm action-btn delete-row" title="ลบแถว">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>      


                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end gap-2 border-top pt-3">
                            <a href="{{ url()->previous() }}" class="btn btn-light mr-2">ยกเลิก</a>
                            <button type="submit" class="btn btn-primary" style="background-color: var(--indigo-primary); border-color: var(--indigo-primary);">
                                <i class="fas fa-save mr-1"></i> บันทึกข้อมูล
                            </button>
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
    document.addEventListener('DOMContentLoaded', function () {
        // กำหนด rowIndex เริ่มต้นตามจำนวนแถวที่มีอยู่จริงในตาราง เพื่อไม่ให้ Index ชนกับข้อมูลเดิม
        let rowIndex = document.querySelectorAll('#auditTable tbody tr').length;

        // ฟังก์ชั่นอัปเดตลำดับเลขข้อ
        function updateRowNumbers() {
            const rows = document.querySelectorAll('#auditTable tbody tr');
            rows.forEach((row, index) => {
                row.querySelector('.row-no').innerText = index + 1;
            });
        }

        // เพิ่มแถวใหม่
        document.getElementById('addRowBtn').addEventListener('click', function () {
            const tableBody = document.querySelector('#auditTable tbody');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td class="row-no text-center font-weight-bold"></td>
                <td>
                    <textarea class="form-control form-control-sm table-input" name="audit[${rowIndex}][checklist]" rows="2" placeholder="ระบุรายการที่ตรวจสอบ"></textarea>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-outline-danger btn-sm action-btn delete-row" title="ลบแถว">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            `;

            tableBody.appendChild(newRow);
            rowIndex++;
            updateRowNumbers();
        });

        // ลบแถว
        document.querySelector('#auditTable').addEventListener('click', function (e) {
            const deleteBtn = e.target.closest('.delete-row');
            if (deleteBtn) {
                const rows = document.querySelectorAll('#auditTable tbody tr');
                if (rows.length > 1) {
                    deleteBtn.closest('tr').remove();
                    updateRowNumbers();
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'ไม่สามารถลบได้',
                        text: 'ต้องมีรายการตรวจสอบอย่างน้อย 1 รายการ',
                        confirmButtonColor: '#4f46e5'
                    });
                }
            }
        });
    });
</script>
@endpush