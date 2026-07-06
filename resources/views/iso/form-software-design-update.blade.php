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

    .form-control-modern[readonly], 
    .form-control-modern[disabled] {
        background-color: #f3f4f6;
        border-color: #e5e7eb;
        color: #4b5563;
        opacity: 1; /* Override bootstrap disabled opacity */
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
        padding: 10px;
        vertical-align: middle;
    }

    /* Custom Modern Badges & Action Buttons */
    .badge-modern {
        padding: 0.45rem 0.85rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-left: 8px;
    }

    .badge-modern-warning {
        background-color: #fffbeb;
        color: #b45309;
        border: 1px solid #fde68a;
    }

    .badge-modern-success {
        background-color: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .btn-approve-action {
        background-color: #22c55e;
        color: white;
        border-radius: 8px;
        padding: 0.35rem 0.75rem;
        font-size: 0.8rem;
        font-weight: 600;
        border: none;
        transition: all 0.2s;
        margin-left: 8px;
        box-shadow: 0 2px 4px rgba(34, 197, 94, 0.2);
    }

    .btn-approve-action:hover {
        background-color: #16a34a;
        color: white;
        box-shadow: 0 4px 8px rgba(34, 197, 94, 0.3);
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
                    <input type="hidden" name="checkdoc" value="Update"> 

                    <h5 class="section-title">1. Software Design</h5>
                    
                    <div class="form-section-group mb-4">
                        <div class="row g-3">
                            <div class="col-12 col-md-4 mb-3">
                                <label for="software_design_hd_no" class="form-label-modern mb-2">1.1 Software No.</label>
                                <input class="form-control form-control-modern" name="software_design_hd_no" value="{{ $hd->software_design_hd_no }}" readonly>
                            </div>
                            <div class="col-12 col-md-8 mb-3">
                                <label for="software_design_hd_product" class="form-label-modern mb-2">Product Name</label>
                                <input class="form-control form-control-modern" name="software_design_hd_product" value="{{ $hd->software_design_hd_product }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="software_design_hd_reference" class="form-label-modern mb-2">1.2 Reference Documents</label>
                                <input class="form-control form-control-modern" name="software_design_hd_reference" value="{{ $hd->software_design_hd_reference }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label-modern mb-2">1.3 Input Data</label>
                                <textarea class="form-control form-control-modern" name="software_design_hd_inputdata" rows="3" disabled>{{ $hd->software_design_hd_inputdata }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label-modern mb-2">1.4 Output Display & Control</label>
                                <textarea class="form-control form-control-modern" name="software_design_hd_output" rows="3" disabled>{{ $hd->software_design_hd_output }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-12">
                                <label class="form-label-modern mb-2">1.5 Layout Features and Man-hours</label>
                                <textarea class="form-control form-control-modern" name="software_design_hd_layout" rows="3" disabled>{{ $hd->software_design_hd_layout }}</textarea>
                            </div>
                        </div>
                    </div>

                    <h5 class="section-title">Design Workflow & Review 1</h5>
                    <div class="form-section-group mb-4">
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-9">
                                <label for="prepared_by1" class="form-label-modern mb-2">Prepared by</label>
                                <input class="form-control form-control-modern" name="prepared_by1" value="{{ $hd->prepared_by1 }}" readonly>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="prepared_date1" class="form-label-modern mb-2">Date</label>
                                <input class="form-control form-control-modern" type="date" name="prepared_date1" value="{{ $hd->prepared_date1 }}" readonly>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-12 col-md-9">
                                <div class="d-flex align-items-center mb-2">
                                    <label for="reviewed_by1" class="form-label-modern m-0">Reviewed by</label>
                                    @if ($hd->reviewed_status1 == "N")
                                        @if ($hd->reviewed_by1 == auth()->user()->name)
                                            <a href="javascript:void(0)" class="btn btn-approve-action" onclick="confirmApp('{{ $hd->software_design_hd_id }}','reviewed1')">
                                                <i class="fas fa-check-circle me-1"></i> กดอนุมัติรายการ
                                            </a>
                                        @else
                                            <span class="badge-modern badge-modern-warning">⏳ รอดำเนินการ</span>
                                        @endif
                                    @else
                                        <span class="badge-modern badge-modern-success">✅ ดำเนินการเรียบร้อย</span>
                                    @endif   
                                </div>
                                <input class="form-control form-control-modern" name="reviewed_by1" value="{{ $hd->reviewed_by1 }}" readonly>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="reviewed_date1" class="form-label-modern mb-2">Date</label>
                                <input class="form-control form-control-modern" type="date" name="reviewed_date1" value="{{ $hd->reviewed_date1 }}" readonly>
                            </div>
                        </div> 
                    </div>

                    <h5 class="section-title">2. Verification Table</h5>
                    <div class="table-responsive mb-4">
                        <table class="table table-modern text-center" id="destroyTable">
                            <thead>
                                <tr>
                                    <th style="width: 55%">Calculation</th>
                                    <th style="width: 15%">By hand</th>
                                    <th style="width: 15%">Display</th>
                                    <th style="width: 15%">% Error</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dt as $item)
                                    <tr>
                                        <td>
                                            <input class="form-control form-control-modern" name="software_design_dt_calculation[]" value="{{ $item->software_design_dt_calculation }}" readonly>
                                            <input type="hidden" name="software_design_dt_id[]" value="{{ $item->software_design_dt_id }}">
                                        </td>
                                        <td>
                                            <input class="form-control form-control-modern text-center" name="software_design_dt_byhand[]" value="{{ $item->software_design_dt_byhand }}" readonly>
                                        </td>
                                        <td>
                                            <input class="form-control form-control-modern text-center" name="software_design_dt_display[]" value="{{ $item->software_design_dt_display }}" readonly>
                                        </td>
                                        <td>
                                            <input class="form-control form-control-modern text-center" name="software_design_dt_error[]" value="{{ $item->software_design_dt_error }}" readonly>
                                        </td>
                                    </tr>  
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h5 class="section-title">3. Comments & Final Signatures</h5>
                    <div class="form-section-group">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label-modern mb-2">Comment / ผลการตรวจสอบ</label>
                                <textarea class="form-control form-control-modern" name="software_design_hd_comment" rows="3" disabled>{{ $hd->software_design_hd_comment }}</textarea>
                            </div>
                        </div>
                        
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-9">
                                <label for="prepared_by2" class="form-label-modern mb-2">Prepared by (Verification)</label>
                                <input class="form-control form-control-modern" name="prepared_by2" value="{{ $hd->prepared_by2 }}" readonly>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="prepared_date2" class="form-label-modern mb-2">Date</label>
                                <input class="form-control form-control-modern" type="date" name="prepared_date2" value="{{ $hd->prepared_date2 }}" readonly>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-9">
                                <div class="d-flex align-items-center mb-2">
                                    <label for="reviewed_by2" class="form-label-modern m-0">Reviewed by (Verification)</label>
                                    @if ($hd->reviewed_status2 == "N")
                                        @if ($hd->reviewed_by2 == auth()->user()->name)
                                            <a href="javascript:void(0)" class="btn btn-approve-action" onclick="confirmApp('{{ $hd->software_design_hd_id }}','reviewed2')">
                                                <i class="fas fa-check-circle me-1"></i> กดอนุมัติรายการ
                                            </a>
                                        @else
                                            <span class="badge-modern badge-modern-warning">⏳ รอดำเนินการ</span>
                                        @endif
                                    @else
                                        <span class="badge-modern badge-modern-success">✅ ดำเนินการเรียบร้อย</span>
                                    @endif   
                                </div>
                                <input class="form-control form-control-modern" name="reviewed_by2" value="{{ $hd->reviewed_by2 }}" readonly>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="reviewed_date2" class="form-label-modern mb-2">Date</label>
                                <input class="form-control form-control-modern" type="date" name="reviewed_date2" value="{{ $hd->reviewed_date2 }}" readonly>
                            </div>
                        </div> 

                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-9">
                                <div class="d-flex align-items-center mb-2">
                                    <label for="initialapproval_by" class="form-label-modern m-0">Initial Approval by</label>
                                    @if ($hd->initialapproval_status == "N")
                                        @if ($hd->initialapproval_by == auth()->user()->name)
                                            <a href="javascript:void(0)" class="btn btn-approve-action" onclick="confirmApp('{{ $hd->software_design_hd_id }}','initialapproval')">
                                                <i class="fas fa-check-circle me-1"></i> กดอนุมัติรายการ
                                            </a>
                                        @else
                                            <span class="badge-modern badge-modern-warning">⏳ รอดำเนินการ</span>
                                        @endif
                                    @else
                                        <span class="badge-modern badge-modern-success">✅ ดำเนินการเรียบร้อย</span>
                                    @endif   
                                </div>
                                <input class="form-control form-control-modern" name="initialapproval_by" value="{{ $hd->initialapproval_by }}" readonly>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="initialapproval_date" class="form-label-modern mb-2">Date</label>
                                <input class="form-control form-control-modern" type="date" name="initialapproval_date" value="{{ $hd->initialapproval_date }}" readonly>
                            </div>
                        </div> 

                        <div class="row g-3">
                            <div class="col-12 col-md-9">
                                <div class="d-flex align-items-center mb-2">
                                    <label for="finalapproval_by" class="form-label-modern m-0">Final Approval</label>
                                    @if ($hd->finalapproval_status == "N")
                                        @if ($hd->finalapproval_by == auth()->user()->name)
                                            <a href="javascript:void(0)" class="btn btn-approve-action" onclick="confirmApp('{{ $hd->software_design_hd_id }}','finalapproval')">
                                                <i class="fas fa-check-circle me-1"></i> กดอนุมัติรายการ
                                            </a>
                                        @else
                                            <span class="badge-modern badge-modern-warning">⏳ รอดำเนินการ</span>
                                        @endif
                                    @else
                                        <span class="badge-modern badge-modern-success">✅ ดำเนินการเรียบร้อย</span>
                                    @endif   
                                </div>
                                <input class="form-control form-control-modern" name="finalapproval_by" value="{{ $hd->finalapproval_by }}" readonly>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="finalapproval_date" class="form-label-modern mb-2">Date</label>
                                <input class="form-control form-control-modern" type="date" name="finalapproval_date" value="{{ $hd->finalapproval_date }}" readonly>
                            </div>
                        </div> 
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
// ✅ ฟังก์ชันส่งอนุมัติผ่าน Ajax ปรับดีไซน์กล่อง SweetAlert2 ให้เข้าชุดธีมโมเดิร์น
confirmApp = (refid, status) => {       
    Swal.fire({
        title: 'ยืนยันการอนุมัติเอกสาร !',
        text: `คุณต้องการบันทึกการอนุมัติในตำแหน่งนี้ใช่หรือไม่ ?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'ยืนยันอนุมัติ',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            confirmButton: 'btn btn-success mx-2 px-4 py-2',
            cancelButton: 'btn btn-light mx-2 px-4 py-2'
        },
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/approvedSoftwareDesign') }}`,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "refid": refid,
                    "status": status
                },
                dataType: "json",
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire({
                            title: 'ดำเนินการสำเร็จ',
                            text: 'อนุมัติเอกสารเรียบร้อยแล้ว',
                            icon: 'success',
                            confirmButtonText: 'ตกลง',
                            customClass: { confirmButton: 'btn btn-indigo px-4' },
                            buttonsStyling: false
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'เกิดข้อผิดพลาดในการอนุมัติเอกสาร',
                            icon: 'error',
                            confirmButtonText: 'ปิด',
                            customClass: { confirmButton: 'btn btn-secondary px-4' },
                            buttonsStyling: false
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'การเชื่อมต่อล้มเหลว',
                        text: 'เซิร์ฟเวอร์ไม่ตอบสนอง กรุณาลองใหม่อีกครั้ง',
                        icon: 'error',
                        confirmButtonText: 'ปิด',
                        customClass: { confirmButton: 'btn btn-secondary px-4' },
                        buttonsStyling: false
                    });
                }
            });
        }
    });
}
</script>
@endpush