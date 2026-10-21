@extends('layouts.main')
@section('content')
{{-- @push('styles') --}}
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}

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

    /* Form Controls */
    .form-group label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.35rem;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 0.55rem 0.75rem;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: var(--indigo-primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }

    /* Table Styling */
    .table-modern-form th {
        background-color: #f8fafc;
        color: #475569;
        font-size: 0.85rem;
        vertical-align: middle;
        padding: 0.75rem 0.5rem;
    }

    .table-modern-form td {
        vertical-align: middle;
        padding: 0.5rem;
    }

    .table-modern-form input.form-control {
        padding: 0.35rem 0.5rem;
        font-size: 0.85rem;
        text-align: center;
    }

    /* Action Buttons */
    .btn-action-delete {
        background-color: #fee2e2;
        color: #dc2626;
        border: none;
        border-radius: 6px;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .btn-action-delete:hover {
        background-color: #fecaca;
        color: #b91c1c;
        transform: scale(1.05);
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-dark);
        border-left: 4px solid var(--indigo-primary);
        padding-left: 0.5rem;
        margin-bottom: 1rem;
        margin-top: 1.5rem;
    }
</style>

<div class="container-fluid py-4">
    <form action="{{ route('individual-plannings.store') }}" method="POST">
        @csrf          
        <div class="row">  
            <div class="col-12">
               
                <div class="card custom-card">
                    <div class="card-header custom-card-header">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                            <div class="text-center text-md-left mb-3 mb-md-0">
                                <h5 class="m-0">ESSOM CO.,LTD</h5>
                                <h5 class="m-0 font-weight-normal" style="font-size: 1.1rem; opacity: 0.9;">Individual Group Planning</h5>
                                <span class="doc-code">ฟอร์มเอกสาร: F8510.3(L) (4 Nov. 24)</span>
                            </div>                     
                        </div>
                    </div>

                    <div class="card-body p-4">     
                             
                        <!-- Header Inputs -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Section</label>
                                    <input class="form-control" type="text" name="section" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Product Code</label>
                                    <input class="form-control" type="text" name="product_code" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Job No</label>
                                    <input class="form-control" type="text" name="job_no" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input class="form-control" type="number" name="qty" value="">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Customer</label>
                                    <input class="form-control" type="text" name="customer" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Responsible</label>
                                    <input class="form-control" type="text" name="responsible" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Budget Time</label>
                                    <input class="form-control" type="text" name="budget_time" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>MH For Date</label>
                                    <input class="form-control" type="date" name="mh_for_date" value="">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>To Date</label>
                                    <input class="form-control" type="date" name="to_date" value="">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Remark</label>
                                    <input class="form-control" type="text" name="remark" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Main Table Section -->
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="section-title m-0 border-0 p-0">Planning Schedule Details</div>
                            <button type="button" id="addRowBtn" class="btn btn-sm btn-success px-3" style="border-radius: 8px;">
                                <i class="fa fa-plus me-1"></i> เพิ่มแถว
                            </button>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-modern-form text-center align-middle" id="planningTable">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="min-width: 280px; width: 28%;">Description</th>
                                        <th colspan="6">Month <input class="form-control d-inline-block w-75 mt-1" type="text" name="month_1" placeholder="ระบุเดือน"></th>
                                        <th colspan="6">Month <input class="form-control d-inline-block w-75 mt-1" type="text" name="month_2" placeholder="ระบุเดือน"></th>
                                        <th colspan="6">Month <input class="form-control d-inline-block w-75 mt-1" type="text" name="month_3" placeholder="ระบุเดือน"></th>
                                        <th rowspan="2" style="width: 5%; min-width: 50px;">Action</th>
                                    </tr>
                                    <tr>
                                        @for($i=1; $i<=3; $i++)
                                            @for($j=1; $j<=6; $j++)
                                                <th style="width: 3.2%; min-width: 32px;">{{ $j }}</th>
                                            @endfor
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <!-- แถวเริ่มต้นแถวที่ 0 -->
                                    <tr>
                                        <td><input class="form-control text-start" type="text" name="details[0][description]" placeholder="รายละเอียดงาน..."></td>
                                        @for($i=0; $i<18; $i++)
                                            <td><input class="form-control px-1 text-center" type="text" name="details[0][val_{{ $i }}]"></td>
                                        @endfor
                                        <td>
                                            <button type="button" class="btn-action-delete remove-row" title="ลบแถว">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-start ps-3">Ack.</th>
                                        @for($i=0; $i<18; $i++)
                                            <td><input class="form-control px-1 text-center" type="text" name="ack[{{ $i }}]"></td>
                                        @endfor
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="text-start ps-3">Date</th>
                                        @for($i=0; $i<18; $i++)
                                            <td><input class="form-control px-1 text-center" type="date" name="ack_date[{{ $i }}]" style="font-size: 0.75rem;"></td>
                                        @endfor
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Weekly Review Section -->
                        <div class="section-title">Weekly Review</div>
                        @for($w=1; $w<=6; $w++)
                        <div class="row g-2 mb-2">
                            <div class="col-md-3 d-flex align-items-center">
                                <span class="fw-bold text-secondary">Week {{ $w }}</span>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="weekly_review[{{ $w }}][col1]" placeholder="หัวข้อ 1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="weekly_review[{{ $w }}][col2]" placeholder="หัวข้อ 2">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="weekly_review[{{ $w }}][col3]" placeholder="หัวข้อ 3">
                                </div>
                            </div>
                        </div>
                        @endfor

                        <!-- Approvals Section -->
                        <div class="section-title">Signatures</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Prepared By</label>
                                    <input class="form-control" type="text" name="prepared_by" value="{{ auth()->user()->name ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control" type="date" name="prepared_date" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Checked By</label>
                                    <input class="form-control" type="text" name="checked_by" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control" type="date" name="checked_date" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Approved By</label>
                                    <input class="form-control" type="text" name="approved_by" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control" type="date" name="approved_date" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-5 py-2 font-weight-bold" style="border-radius: 8px; background-color: var(--indigo-primary);">
                                <i class="fa fa-save me-1"></i> บันทึกข้อมูล
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
        let rowIndex = 1;

        // ฟังก์ชันสำหรับเพิ่มแถวใหม่
        document.getElementById('addRowBtn').addEventListener('click', function () {
            let tbody = document.getElementById('tableBody');
            
            let newRow = document.createElement('tr');
            
            let html = `<td><input class="form-control" type="text" name="details[${rowIndex}][description]" placeholder="รายละเอียดงาน"></td>`;
            for (let i = 0; i < 18; i++) {
                html += `<td><input class="form-control" type="text" name="details[${rowIndex}][val_${i}]"></td>`;
            }
            html += `<td>
                        <button type="button" class="btn-action-delete remove-row" title="ลบแถว">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>`;
            
            newRow.innerHTML = html;
            tbody.appendChild(newRow);
            rowIndex++;
        });

        // ฟังก์ชันลบแถว
        document.getElementById('tableBody').addEventListener('click', function (e) {
            if (e.target.closest('.remove-row')) {
                let row = e.target.closest('tr');
                let tbody = document.getElementById('tableBody');
                
                // ป้องกันไม่ให้ลบจนหมดตาราง (เหลือไว้อย่างน้อย 1 แถว)
                if (tbody.rows.length > 1) {
                    row.remove();
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'ไม่สามารถลบได้',
                        text: 'ต้องมีรายการข้อมูลอย่างน้อย 1 แถว',
                        confirmButtonColor: '#4f46e5'
                    });
                }
            }
        });
    });
</script>
@endpush