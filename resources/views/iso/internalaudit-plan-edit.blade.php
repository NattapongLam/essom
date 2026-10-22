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
        padding: 0.4rem 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none !important;
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
        padding: 1.2rem 0.5rem !important;
        border-bottom: 2px solid #e2e8f0 !important;
        border-top: none !important;
    }

    .modern-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .modern-table tbody tr:hover {
        background-color: #f1f5f9;
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
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div class="text-center text-md-left mb-3 mb-md-0">
                            <h5 class="m-0">ESSOM CO.,LTD</h5>
                            <h5 class="m-0 font-weight-normal" style="font-size: 1.1rem; opacity: 0.9;">
                                @isset($hd) 
                                    INTERNAL AUDIT PLAN (แก้ไขแผนการตรวจสอบภายใน) 
                                @else 
                                    INTERNAL AUDIT PLAN (แผนการตรวจสอบภายใน) 
                                @endisset
                            </h5>
                            <span class="doc-code">ฟอร์มเอกสาร: F9200.1 (9 Jun. 16)</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">   
                    {{-- ตรวจสอบเงื่อนไข Action Form ว่าเป็นหน้า Create หรือ Edit --}}
                   <form action="{{ route('internalaudit-plans.update', $hd->internalaudit_plan_hds_id) }}" method="POST">
                    @csrf
                    @method('PUT')   
                    <input type="hidden" name="doc_ref" value="Edit">

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark mb-1">PERIOD</label>
                                    <input class="form-control" type="text" name="period" placeholder="ระบุช่วงเวลา เช่น 2026/1" value="{{ old('period', $hd->period ?? '') }}">
                                </div>
                            </div>
                        </div>

                        <!-- ส่วนหัวตารางและปุ่มเพิ่มแถว -->
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="m-0 font-weight-bold text-dark">รายการตรวจสอบ (Audit Schedule)</h6>
                            <button type="button" class="btn btn-indigo-add btn-sm" id="addRowBtn">
                                <i class="fas fa-plus"></i> เพิ่มแถว
                            </button>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered modern-table text-center align-middle" id="auditTable">
                                <thead>
                                    <tr>
                                        <th style="width: 8%;">No</th>
                                        <th style="width: 22%;">Date</th>
                                        <th style="width: 30%;">Process</th>
                                        <th style="width: 20%;">Auditee</th>
                                        <th style="width: 15%;">Auditor</th>
                                        <th style="width: 5%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- วนลูปข้อมูลจากตัวแปร $dt ที่ส่งมาจาก Controller --}}
                                    @if(isset($dt) && count($dt) > 0)
                                        @foreach($dt as $index =>$item)
                                        <tr>
                                            <td class="row-no font-weight-bold">{{ $index + 1 }}</td>
                                            <td>
                                                <input type="date" class="form-control form-control-sm" name="audit[{{ $index }}][date]" value="{{ $item->date }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="audit[{{ $index }}][process]" placeholder="ระบุ Process" value="{{ $item->process }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="audit[{{ $index }}][auditee]" placeholder="ระบุ Auditee" value="{{ $item->auditee }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="audit[{{ $index }}][auditor]" placeholder="ระบุ Auditor" value="{{ $item->auditor }}">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm action-btn delete-row">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <!-- กรณีไม่มีข้อมูล (หน้าสร้างใหม่ หรือไม่มีรายการย่อย) แสดงแถวว่าง 1 แถว -->
                                        <tr>
                                            <td class="row-no font-weight-bold">1</td>
                                            <td>
                                                <input type="date" class="form-control form-control-sm" name="audit[0][date]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="audit[0][process]" placeholder="ระบุ Process">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="audit[0][auditee]" placeholder="ระบุ Auditee">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="audit[0][auditor]" placeholder="ระบุ Auditor">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm action-btn delete-row" disabled>
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Prepared By</label>
                                    <input class="form-control" type="text" name="prepared_by" value="{{ $hd->prepared_by ?? auth()->user()->name ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control" type="date" name="prepared_date" value="{{ $hd->prepared_date ?? date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Checked By</label>
                                    <input class="form-control" type="text" name="checked_by" value="{{ $hd->checked_by ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control" type="date" name="checked_date" value="{{ $hd->checked_date ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Approved By</label>
                                    <input class="form-control" type="text" name="approved_by" value="{{ $hd->approved_by ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control" type="date" name="approved_date" value="{{ $hd->approved_date ?? '' }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <h5 class="text-danger" style="font-size: 0.95rem;">หมายเหตุ : เริ่มประชุมและตรวจสอบภายในเวลา 8.30 น.</h5>
                        </div>

                        <!-- ปุ่มบันทึกข้อมูล -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="background-color: var(--indigo-primary); border: none; border-radius: 8px;">
                                <i class="fas fa-save mr-1"></i> บันทึกข้อมูล
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
$(document).ready(function() {
    // ฟังก์ชันอัปเดตหมายเลขลำดับ (No) และ Index ของ Name ใน Input อัตโนมัติ
    function updateRowNumbers() {
        $('#auditTable tbody tr').each(function(index) {
            $(this).find('.row-no').text(index + 1);

            $(this).find('input[name*="[date]"]').attr('name', `audit[${index}][date]`);
            $(this).find('input[name*="[process]"]').attr('name', `audit[${index}][process]`);
            $(this).find('input[name*="[auditee]"]').attr('name', `audit[${index}][auditee]`);
            $(this).find('input[name*="[auditor]"]').attr('name', `audit[${index}][auditor]`);
        });

        if ($('#auditTable tbody tr').length === 1) {
            $('#auditTable tbody tr .delete-row').prop('disabled', true);
        } else {
            $('#auditTable tbody tr .delete-row').prop('disabled', false);
        }
    }

    // เรียกทำงานครั้งแรกตอนโหลดหน้า เพื่อเช็คปุ่มลบ (กรณีข้อมูลเก่ามีหลายแถว)
    updateRowNumbers();

    // กดปุ่มเพิ่มแถว
    $('#addRowBtn').click(function() {
        let rowCount = $('#auditTable tbody tr').length;
        let newRow = `
            <tr>
                <td class="row-no font-weight-bold">${rowCount + 1}</td>
                <td>
                    <input type="date" class="form-control form-control-sm" name="audit[${rowCount}][date]">
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm" name="audit[${rowCount}][process]" placeholder="ระบุ Process">
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm" name="audit[${rowCount}][auditee]" placeholder="ระบุ Auditee">
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm" name="audit[${rowCount}][auditor]" placeholder="ระบุ Auditor">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm action-btn delete-row">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        `;
        $('#auditTable tbody').append(newRow);
        updateRowNumbers();
    });

    // กดปุ่มลบแถว
    $(document).on('click', '.delete-row', function() {
        if ($('#auditTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
            updateRowNumbers();
        }
    });
});
</script>
@endpush