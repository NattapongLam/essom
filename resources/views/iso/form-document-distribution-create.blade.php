@extends('layouts.main')
@section('content')

<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* Modern Indigo Theme Layout Structure */
    .custom-container {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .form-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    /* Elegant Header Design Component */
    .card-header-modern {
        background-color: #ffffff;
        padding: 2rem 2.5rem 1.5rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-title-block h5 {
        font-size: 1.05rem;
        letter-spacing: 0.5px;
        color: #64748b;
        font-weight: 500;
        margin: 0;
        line-height: 1.5;
    }

    .header-title-block h2 {
        font-weight: 700;
        color: #1e293b;
        margin-top: 6px;
        margin-bottom: 0;
        font-size: 1.4rem;
        line-height: 1.4;
    }

    .doc-number-badge {
        position: absolute;
        top: 2rem;
        right: 2.5rem;
        text-align: right;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        color: #64748b;
    }

    /* Modern Styled Controls & Inputs */
    .form-label-modern {
        font-weight: 600;
        color: #475569;
        font-size: 0.88rem;
        margin-bottom: 6px;
    }

    .form-control-modern {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 10px 14px;
        font-size: 0.9rem;
        color: #334155;
        transition: all 0.2s;
    }

    .form-control-modern:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        outline: none;
    }

    .form-control-modern[readonly] {
        background-color: #f1f5f9;
        color: #64748b;
    }

    /* Premium Dynamic Action Buttons */
    .btn-indigo-submit {
        background: #4f46e5;
        color: #ffffff !important;
        border: none;
        padding: 11px 28px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.2s;
        width: 100%;
    }
    .btn-indigo-submit:hover {
        background: #4338ca;
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    .btn-outline-indigo {
        color: #4f46e5;
        background-color: transparent;
        border: 1px solid #4f46e5;
        padding: 6px 14px;
        font-weight: 600;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-outline-indigo:hover {
        background-color: #4f46e5;
        color: #ffffff;
    }

    /* Custom Responsive Interactive Grid/Table */
    .table-modern-wrapper {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        margin-top: 15px;
        background-color: #ffffff;
    }

    .table-modern {
        margin-bottom: 0 !important;
    }

    .table-modern thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 12px 10px !important;
        border-bottom: 2px solid #e2e8f0 !important;
        border-top: none !important;
    }

    .table-modern tbody td {
        padding: 10px 10px !important;
        font-size: 0.9rem;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    /* Select2 Modern Overrides Custom Styling */
    .select2-container--default .select2-selection--single {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        height: 42px !important;
        padding: 6px 8px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #334155 !important;
        font-size: 0.9rem !important;
    }
    .select2-container--default .select2-dropdown {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }

    @media (max-width: 992px) {
        .doc-number-badge { position: relative; top: 0; right: 0; text-align: left; display: inline-block; margin-top: 10px; }
        .card-header-modern { padding: 1.5rem; }
    }
</style>

<div class="container-fluid custom-container">
    <div class="card form-card">
        
        <div class="card-header-modern">
            <div class="header-title-block text-center">
                <h5>ESSOM CO., LTD.</h5>
                <h2>ทะเบียนแจกจ่ายเอกสาร (Documents Distribution Status)</h2>
            </div>
            <div class="doc-number-badge">
                <strong>F7530.2</strong>
            </div>
        </div>

        <div class="card-body" style="padding: 2.5rem;">
            <form method="POST" action="{{ route('document-distribution.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="row mb-4">
                    <div class="col-md-6 col-12 mb-3">
                        <label class="form-label-modern" for="documentregisters_docuno">Document No.</label>
                        <input class="form-control form-control-modern" name="documentregisters_docuno" value="{{$hd->documentregisters_docuno}}" readonly>
                        <input type="hidden" name="documentregisters_id" value="{{$hd->documentregisters_id}}">
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label class="form-label-modern" for="documentregisters_remark">Description</label>
                        <input class="form-control form-control-modern" name="documentregisters_remark" value="{{$hd->documentregisters_remark}}" readonly>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-2 mt-4">
                    <h5 class="m-0 font-weight-bold text-dark" style="font-size: 1rem;">
                        <i class="fas fa-users-class text-indigo"></i> รายชื่อผู้รับการแจกจ่ายเอกสาร
                    </h5>
                    <button type="button" class="btn btn-outline-indigo btn-sm" onclick="addRow()">
                        <i class="fas fa-plus-circle"></i> เพิ่มแถวผู้รับเอกสาร
                    </button>
                </div>

                <div class="table-modern-wrapper table-responsive">
                    <table class="table table-modern text-center" id="receiverTable">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No.</th>
                                <th style="width: 220px;">Department</th>
                                <th style="width: 300px;">Receiver</th>
                                <th style="width: 200px;">Position</th>
                                <th style="width: 140px;">Type</th>
                                <th style="width: 160px;">Date</th>
                                <th style="width: 80px;">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                                <tr class="table-secondary-light" style="background-color: #fafafa;">
                                    <td class="font-weight-bold text-muted">{{$item->documentdistributions_listno}}</td>
                                    <td>{{$item->ms_department_name}}</td>
                                    <td class="text-left pl-3">{{$item->ms_employee_code}} / {{$item->ms_employee_fullname}}</td>
                                    <td>{{$item->ms_job_name}}</td>
                                    <td>
                                        <span class="badge badge-pill {{ $item->documentdistributions_type == 'Receive' ? 'badge-success' : 'badge-warning' }}" style="padding: 5px 10px;">
                                            {{$item->documentdistributions_type}}
                                        </span>
                                    </td>
                                    <td>{{$item->documentdistributions_date}}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-light text-danger border" title="ลบรายการแจกจ่าย" onclick="confirmDel('{{ $item->documentdistributions_id }}')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            @php $rowCount = count($list) + 1; @endphp
                            <tr>
                                <td class="row-index-label font-weight-bold text-indigo" style="font-size: 1rem;">
                                    {{ $rowCount }}
                                </td>
                                <td>
                                    <input type="hidden" value="{{ $rowCount }}" name="documentdistributions_listno[]" class="row-list-no">
                                    <select class="form-control form-control-modern select-clean" name="ms_department_name[]" style="height: 42px;">
                                        <option value="">กรุณาเลือกฝ่าย</option>
                                        @foreach ($dep as $item)
                                            <option value="{{$item->ms_department_name}}">{{$item->ms_department_name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control receiver-select" name="ms_employee_id[]">
                                        <option value="">กรุณาเลือกพนักงาน</option>
                                        @foreach ($emp as $item)
                                            <option value="{{$item->ms_employee_id}}" data-job="{{ $item->ms_job_name }}">
                                                {{$item->ms_employee_code}} / {{$item->ms_employee_fullname}}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-modern position-input" placeholder="ตำแหน่ง" style="height: 42px;" readonly>
                                </td>
                                <td>
                                    <select class="form-control form-control-modern select-clean" name="documentdistributions_type[]" style="height: 42px;">
                                        <option value="Receive">Receive</option>
                                        <option value="Return">Return</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="date" class="form-control form-control-modern" name="documentdistributions_date[]" style="height: 42px;" value="{{ date('Y-m-d') }}">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger px-3" style="height: 38px;" onclick="deleteRow(this)">ลบ</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr class="my-4" style="border-top: 1px solid #f1f5f9;">

                <div class="row">
                    <div class="col-xl-1 col-lg-2 col-md-3 col-6">
                        <div class="form-group mb-0">
                            <button type="submit" class="btn-indigo-submit">
                                <i class="fas fa-save"></i> บันทึก
                            </button>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-2 col-md-3 col-6">
                        <a href="{{ route('document-distribution.index') }}" class="btn btn-block btn-light border" style="padding: 11px 0; border-radius: 8px; font-weight: 600;">
                            กลับหน้าแรก
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  function addRow() {
    const table = document.getElementById("receiverTable").getElementsByTagName("tbody")[0];
    const rowCount = table.rows.length;
    const row = table.insertRow();

    // สร้าง cell ตาราง และแก้ไขโครงสร้าง HTML ที่พังในตัวแปรเดิมเรียบร้อยครับ
    row.innerHTML = `
        <td class="row-index-label font-weight-bold text-indigo" style="font-size: 1rem;">${rowCount + 1}</td>
        <td>
            <input type="hidden" value="${rowCount + 1}" name="documentdistributions_listno[]" class="row-list-no">
            <select class="form-control form-control-modern select-clean" name="ms_department_name[]" style="height: 42px;">
                <option value="">กรุณาเลือกฝ่าย</option>
                @foreach ($dep as $item)
                    <option value="{{$item->ms_department_name}}">{{$item->ms_department_name}}</option>
                @endforeach
            </select>
        </td>
        <td>
            <select class="form-control receiver-select" name="ms_employee_id[]">
                <option value="">กรุณาเลือกพนักงาน</option>
                @foreach ($emp as $item)
                    <option value="{{$item->ms_employee_id}}" data-job="{{ $item->ms_job_name }}">
                        {{$item->ms_employee_code}} / {{$item->ms_employee_fullname}}
                    </option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="text" class="form-control form-control-modern position-input" placeholder="ตำแหน่ง" style="height: 42px;" readonly>
        </td>
        <td>
            <select class="form-control form-control-modern select-clean" name="documentdistributions_type[]" style="height: 42px;">
                <option value="Receive">Receive</option>
                <option value="Return">Return</option>
            </select>
        </td>
        <td>
            <input type="date" class="form-control form-control-modern" name="documentdistributions_date[]" style="height: 42px;" value="{{ date('Y-m-d') }}">
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-danger px-3" style="height: 38px;" onclick="deleteRow(this)">ลบ</button>
        </td>
    `;
    
    // ผูกคำสั่งการจัดสไตล์พรีเมียมตัวเลือกพนักงาน (Select2) ทันทีหลังสร้างแถว
    $(row).find('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });
    
    updateRowNumbers();
  }

  function deleteRow(btn) {
    const row = btn.closest("tr");
    row.remove();
    updateRowNumbers();
  }

  function updateRowNumbers() {
    const table = document.getElementById("receiverTable").getElementsByTagName("tbody")[0];
    let logicalIndex = 1;
    
    [...table.rows].forEach((row) => {
        // อัปเดตตัวเลขเฉพาะแถวกรอกข้อมูลที่ยังไม่บันทึก (มีคลาส .row-list-no)
        const indexLabel = row.querySelector('.row-index-label');
        const hiddenInput = row.querySelector('.row-list-no');
        
        if(indexLabel) {
            indexLabel.innerText = logicalIndex;
        }
        if(hiddenInput) {
            hiddenInput.value = logicalIndex;
        }
        logicalIndex++;
    });
  }

$(document).ready(function () {
    // โหลดใช้งาน Select2 เริ่มต้นสำหรับแถวแรกที่ติดมากับโครงสร้างข้อมูลเบื้องต้น
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });

    // ดึงข้อมูลตำแหน่งงานโดยอัตโนมัติมาวางเมื่อผู้ใช้เลือกพนักงานเสร็จสิ้น
    $(document).on('select2:select', '.receiver-select', function (e) {
        const jobName = $(this).find(':selected').data('job');
        $(this).closest('tr').find('.position-input').val(jobName || '');
    });

    $(document).on('select2:clear', '.receiver-select', function (e) {
        $(this).closest('tr').find('.position-input').val('');
    });
});

// ฟังก์ชันลบรายการแจกจ่ายเอกสารผ่าน AJAX ร่วมกับ SweetAlert2
confirmDel = (refid) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: "คุณต้องการลบรายการแจกจ่ายนี้ใช่หรือไม่ ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยันการลบ',
        cancelButtonText: 'ยกเลิก',
        confirmButtonClass: 'btn btn-success mt-2',
        cancelButtonClass: 'btn btn-danger ms-2 mt-2',
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelDistribution') }}`,
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
                            text: 'ลบรายการแจกจ่ายเรียบร้อยแล้ว',
                            icon: 'success'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถลบรายการได้ กรุณาลองใหม่อีกครั้ง',
                            icon: 'error'
                        });
                    }
                }
            });
        }
    });
}
</script>
@endpush