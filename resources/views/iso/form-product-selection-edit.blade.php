@extends('layouts.main')
@section('content')

<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    /* Modern Indigo Theme Customization */
    :root {
        --primary-indigo: #4f46e5;
        --primary-hover: #4338ca;
        --light-indigo: #e0e7ff;
        --dark-indigo: #312e81;
        --border-radius-sm: 8px;
        --border-radius-md: 12px;
    }

    body {
        background-color: #f8fafc;
    }

    .custom-card {
        border: none;
        border-radius: var(--border-radius-md);
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, var(--dark-indigo) 0%, var(--primary-indigo) 100%);
        color: #ffffff;
        padding: 1.5rem;
        border-bottom: none;
    }

    .custom-card-header h5 {
        font-weight: 600;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .section-title {
        color: var(--dark-indigo);
        border-left: 4px solid var(--primary-indigo);
        padding-left: 10px;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .form-control, .form-control-file, .select2-container .select2-selection--single {
        border-radius: var(--border-radius-sm) !important;
        border: 1px solid #cbd5e1 !important;
        padding: 0.4rem 0.75rem;
        transition: all 0.2s ease-in-out;
    }

    .form-control:focus {
        border-color: var(--primary-indigo) !important;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15) !important;
    }

    /* Table Styling */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: var(--border-radius-sm);
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .table-modern thead th {
        background-color: var(--light-indigo) !important;
        color: var(--dark-indigo);
        font-weight: 600;
        border-bottom: 2px solid #cbd5e1 !important;
        vertical-align: middle !important;
    }

    .table-modern tbody tr:hover {
        background-color: #f1f5f9;
    }

    /* Buttons */
    .btn-indigo {
        background-color: var(--primary-indigo);
        color: white;
        border-radius: var(--border-radius-sm);
        padding: 0.5rem 1.25rem;
        font-weight: 500;
        border: none;
        transition: background-color 0.2s;
    }

    .btn-indigo:hover {
        background-color: var(--primary-hover);
        color: white;
    }

    .btn-add-row {
        background-color: var(--light-indigo);
        color: var(--primary-indigo);
        border: 1px dashed var(--primary-indigo);
        border-radius: var(--border-radius-sm);
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-add-row:hover {
        background-color: var(--primary-indigo);
        color: white;
    }

    .evaluation-block {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: var(--border-radius-md);
        padding: 1.5rem;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
    }
</style>

<div class="container-fluid mt-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">ESSOM CO.,LTD</h5>
                        <small class="opacity-75">ใบคัดเลือกสินค้า/ผู้ขายและประเมิน (SUPPLIER QUALIFICATION AND EVALUATION)</small>
                    </div>
                    <div class="text-right">
                        <span class="badge badge-light text-dark">F8411.1</span><br>
                        <small class="opacity-75">15 Aug. 19</small>
                    </div>             
                </div>
                
                <div class="card-body p-4">       
                    <form method="POST" class="form-horizontal" action="{{ route('product-selection.update',$hd->product_selection_hd_id) }}" enctype="multipart/form-data">
                        @csrf  
                        @method('PUT') 

                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title">ประเภทสินค้า</h5>
                                <input type="hidden" name="checkdoc" value="Edit">  
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-500 text-secondary" for="product_selection_hd_type">ประเภทจัดซื้อ</label>
                                <select class="form-control" name="product_selection_hd_type">
                                    <option value="{{$hd->product_selection_hd_type}}">{{$hd->product_selection_hd_type}}</option>
                                    <option value="โรงงาน">โรงงาน</option>
                                    <option value="สำนักงาน">สำนักงาน</option>
                                    <option value="ต่างประเทศ">ต่างประเทศ</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <label class="small text-muted">ประเภทที่ 1</label>
                                        <input type="text" class="form-control" name="product_type1" value="{{$hd->product_type1}}" required>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="small text-muted">ประเภทที่ 2</label>
                                        <input type="text" class="form-control" name="product_type2" value="{{$hd->product_type2}}">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="small text-muted">ประเภทที่ 3</label>
                                        <input type="text" class="form-control" name="product_type3" value="{{$hd->product_type3}}">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="small text-muted">ประเภทที่ 4</label>
                                        <input type="text" class="form-control" name="product_type4" value="{{$hd->product_type4}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                                <h5 class="section-title mb-0">รายละเอียดผู้ขายและการตรวจเยี่ยม</h5>
                                <button type="button" class="btn btn-sm btn-add-row px-3" onclick="addRow()">
                                    <i class="fas fa-plus mr-1"></i> เพิ่มแถวผู้ขาย
                                </button>
                            </div>
                            
                            <div class="col-12 table-responsive">
                                <table class="table table-modern text-center" id="destroyTable">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="width: 3%">ลำดับ</th>
                                            <th rowspan="2" style="width: 25%">รายละเอียดผู้ขายสินค้า</th>
                                            <th rowspan="2" style="width: 10%">ยี่ห้อ</th>
                                            <th rowspan="2" style="width: 6%">(A)</th>
                                            <th rowspan="2" style="width: 10%">(B)</th>
                                            <th rowspan="2" style="width: 6%">(C)</th>
                                            <th colspan="3" style="width: 15%">ผลการตรวจเยี่ยมสถานที่ผู้ขาย</th>
                                            <th rowspan="2" style="width: 10%">หมายเหตุ</th>
                                            <th rowspan="2" style="width: 10%">ไฟล์แนบ</th>
                                            <th rowspan="2" style="width: 5%">ลบ</th>
                                        </tr>
                                        <tr>
                                            <th style="width: 5%">ระบบ</th>
                                            <th style="width: 5%">บุคลากร</th>
                                            <th style="width: 5%">เครื่องมือ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dt as $item)
                                            <tr>
                                                <td class="align-middle bg-light font-weight-bold">
                                                    {{$item->product_selection_dt_listno}}
                                                    <input type="hidden" name="product_selection_dt_listno[]" value="{{$item->product_selection_dt_listno}}">
                                                    <input type="hidden" name="product_selection_dt_id[]" value="{{$item->product_selection_dt_id}}">
                                                </td>
                                                <td class="text-left p-2">
                                                    <input class="form-control form-control-sm mb-1" name="product_selection_dt_vendor[]" value="{{$item->product_selection_dt_vendor}}" placeholder="ชื่อบริษัท">
                                                    <input class="form-control form-control-sm mb-1" name="product_selection_dt_vendor_name[]" value="{{$item->product_selection_dt_vendor_name}}" placeholder="ผู้ติดต่อ">
                                                    <input class="form-control form-control-sm mb-1" name="product_selection_dt_vendor_tel[]" value="{{$item->product_selection_dt_vendor_tel}}" placeholder="เบอร์โทร">
                                                    <input class="form-control form-control-sm mb-1" name="product_selection_dt_vendor_email[]" value="{{$item->product_selection_dt_vendor_email}}" placeholder="อีเมล">
                                                    <input class="form-control form-control-sm" name="product_selection_dt_vendor_remark[]" value="{{$item->product_selection_dt_vendor_remark}}" placeholder="ข้อมูลเพิ่มเติม">
                                                </td>
                                                <td class="align-middle">
                                                    <input class="form-control form-control-sm" name="product_selection_dt_brand[]" value="{{$item->product_selection_dt_brand}}">                                       
                                                </td>
                                                <td class="align-middle">
                                                    <select class="form-control form-control-sm" name="product_selection_hd_grade_a[]">
                                                        <option value="1" {{ $item->product_selection_hd_grade_a ? 'selected' : '' }}>/</option>
                                                        <option value="0" {{ !$item->product_selection_hd_grade_a ? 'selected' : '' }}></option>
                                                    </select>
                                                </td>
                                                <td class="align-middle">
                                                    <input type="text" class="form-control form-control-sm" name="product_selection_hd_grade_b[]" value="{{$item->product_selection_hd_grade_b}}">
                                                </td>
                                                <td class="align-middle">
                                                    <select class="form-control form-control-sm" name="product_selection_hd_grade_c[]">
                                                        <option value="1" {{ $item->product_selection_hd_grade_c ? 'selected' : '' }}>/</option>
                                                        <option value="0" {{ !$item->product_selection_hd_grade_c ? 'selected' : '' }}></option>
                                                    </select>
                                                </td>
                                                <td class="align-middle">
                                                    <select class="form-control form-control-sm" name="product_selection_hd_results1[]">
                                                        <option value="1" {{ $item->product_selection_hd_results1 ? 'selected' : '' }}>/</option>
                                                        <option value="0" {{ !$item->product_selection_hd_results1 ? 'selected' : '' }}></option>
                                                    </select>
                                                </td>
                                                <td class="align-middle">
                                                    <select class="form-control form-control-sm" name="product_selection_hd_results2[]">
                                                        <option value="1" {{ $item->product_selection_hd_results2 ? 'selected' : '' }}>/</option>
                                                        <option value="0" {{ !$item->product_selection_hd_results2 ? 'selected' : '' }}></option>
                                                    </select>
                                                </td>
                                                <td class="align-middle">
                                                    <select class="form-control form-control-sm" name="product_selection_hd_results3[]">
                                                        <option value="1" {{ $item->product_selection_hd_results3 ? 'selected' : '' }}>/</option>
                                                        <option value="0" {{ !$item->product_selection_hd_results3 ? 'selected' : '' }}></option>
                                                    </select>
                                                </td>
                                                <td class="align-middle">
                                                    <input class="form-control form-control-sm" name="product_selection_dt_remark[]" value="{{$item->product_selection_dt_remark}}">
                                                </td>
                                                <td class="align-middle">
                                                    <input type="file" class="form-control-file mb-1" name="product_selection_dt_file[]" >
                                                    @if ($item->product_selection_dt_file)
                                                        <a href="{{asset($item->product_selection_dt_file)}}" target="_blank" class="text-indigo">
                                                            <i class="fas fa-file-alt fa-lg"></i> ดูไฟล์
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm" onclick="confirmDel('{{ $item->product_selection_dt_id }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tbody id="dt"></tbody>
                                </table>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="alert bg-light border text-muted small">
                                    <strong>คำอธิบายหลักเกณฑ์:</strong> (A) คุณสมบัติสินค้าตรงความต้องการ, (B) มาตรฐานของสินค้าบริการ, (C) สินค้า/บริการเป็นที่ยอมรับ
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title">การประเมินสินค้าและผู้ขาย</h5>
                            </div>
                            <div class="col-12">
                                @foreach ($sub as $vendorListNo => $items)
                                    <div class="evaluation-block mb-4">
                                        <h6 class="text-indigo font-weight-bold mb-3">
                                            <i class="fas fa-clipboard-check mr-2"></i>ใบประเมินผู้ขายลำดับที่ {{ $vendorListNo }}
                                        </h6>

                                        <table class="table table-modern text-center table-sm mb-0">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" style="width: 5%">ลำดับ</th>
                                                    <th rowspan="2" style="width: 25%" class="text-left">รายการประเมิน</th>
                                                    <th colspan="3">(1) คุณภาพสินค้า</th>
                                                    <th colspan="3">(2) ความเรียบร้อย</th>
                                                    <th colspan="3">(3) การบริการ</th>
                                                    <th colspan="3">(4) หลังการขาย</th>
                                                </tr>
                                                <tr>
                                                    <th class="small">ดี</th><th class="small">พอใช้</th><th class="small">ไม่ดี</th>
                                                    <th class="small">ดี</th><th class="small">พอใช้</th><th class="small">ไม่ดี</th>
                                                    <th class="small">ดี</th><th class="small">พอใช้</th><th class="small">ไม่ดี</th>
                                                    <th class="small">ดี</th><th class="small">พอใช้</th><th class="small">ไม่ดี</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($items as $item)
                                                    <tr>
                                                        <td class="align-middle bg-light font-weight-bold">{{ $item->product_selection_sub_listno }}</td>
                                                        <td class="text-left align-middle font-weight-500">
                                                            {{ $item->product_selection_sub_name }}
                                                            <input type="hidden" name="product_selection_sub_id[]" value="{{ $item->product_selection_sub_id }}">
                                                        </td>

                                                        @for ($group = 1; $group <= 4; $group++)
                                                            @for ($grade = 1; $grade <= 3; $grade++)
                                                                @php
                                                                    $field = "product_selection_hd_results{$group}_{$grade}";
                                                                @endphp
                                                                <td class="align-middle">
                                                                    <select class="form-control form-control-sm" name="{{ $field }}[]">
                                                                        <option value="0" {{ $item->$field == 0 ? 'selected' : '' }}></option>
                                                                        <option value="1" {{ $item->$field == 1 ? 'selected' : '' }}>/</option>
                                                                    </select>
                                                                </td>
                                                            @endfor
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach

                                <div id="evaluationContainer"></div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <label class="font-weight-500 text-secondary" for="product_selection_hd_remark">หมายเหตุเพิ่มเติม</label>
                                <textarea class="form-control" name="product_selection_hd_remark" rows="3" placeholder="ระบุหมายเหตุการประเมินที่นี่..."></textarea>
                            </div>
                        </div>

                        <div class="row p-3 bg-light rounded-lg border">
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">จัดทำโดย</label>
                                <input class="form-control bg-white" name="requested_by" value="{{auth()->user()->name}}" readonly>
                                <label class="small text-muted mt-2">วันที่จัดทำ</label>
                                <input class="form-control" type="date" name="requested_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">ทบทวนโดย</label>
                                <select class="form-control receiver-select" name="reviewed_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                    @endforeach
                                </select>
                                <label class="small text-muted mt-2">วันที่ทบทวน</label>
                                <input class="form-control" type="date" name="reviewed_date" readonly>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">อนุมัติโดย (จัดซื้อ)</label>
                                <select class="form-control receiver-select" name="approved_by1">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                    @endforeach
                                </select>
                                <label class="small text-muted mt-2">ผู้อนุมัติวันที่</label>
                                <input class="form-control" type="date" name="approved_date1" readonly>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">ผู้ประเมินสินค้า</label>
                                <select class="form-control receiver-select" name="assessor_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                    @endforeach
                                </select>
                                <label class="small text-muted mt-2">วันที่ประเมิน</label>
                                <input class="form-control" type="date" name="assessor_date" readonly>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">ผู้ประเมินบริการ</label>
                                <select class="form-control receiver-select" name="purchase_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                    @endforeach
                                </select>
                                <label class="small text-muted mt-2">วันที่ประเมิน</label>
                                <input class="form-control" type="date" name="purchase_date" readonly>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">ผู้อนุมัติขั้นสุดท้าย</label>
                                <select class="form-control receiver-select" name="approved_by2">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                                    @endforeach
                                </select>
                                <label class="small text-muted mt-2">วันที่อนุมัติ</label>
                                <input class="form-control" type="date" name="approved_date2" readonly>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-2 ml-auto">
                                <button type="submit" class="btn btn-indigo btn-block shadow-sm py-2">
                                    <i class="fas fa-save mr-1"></i> บันทึกข้อมูล
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
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });
});

function addRow() {
    const tableBody = document.querySelector("#dt");
    const rowCount = document.querySelectorAll("#destroyTable tbody tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td class="align-middle bg-light font-weight-bold">
            <span class="row-number">${rowCount}</span>
            <input type="hidden" name="product_selection_dt_listno[]" value="${rowCount}">
            <input type="hidden" name="product_selection_dt_id[]" value="0">
        </td>
        <td class="p-2">
            <input type="text" class="form-control form-control-sm mb-1" placeholder="ชื่อบริษัท" name="product_selection_dt_vendor[]">
            <input type="text" class="form-control form-control-sm mb-1" placeholder="ผู้ติดต่อ" name="product_selection_dt_vendor_name[]">
            <input type="text" class="form-control form-control-sm mb-1" placeholder="โทร" name="product_selection_dt_vendor_tel[]">
            <input type="text" class="form-control form-control-sm mb-1" placeholder="E-mail" name="product_selection_dt_vendor_email[]">
            <input type="text" class="form-control form-control-sm" placeholder="หมายเหตุผู้ขาย" name="product_selection_dt_vendor_remark[]">
        </td>
        <td class="align-middle">
            <input type="text" class="form-control form-control-sm" placeholder="ยี่ห้อ" name="product_selection_dt_brand[]">
        </td>
        <td class="align-middle">
            <select class="form-control form-control-sm" name="product_selection_hd_grade_a[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td class="align-middle"><input type="text" class="form-control form-control-sm" name="product_selection_hd_grade_b[]"></td>
        <td class="align-middle">
            <select class="form-control form-control-sm" name="product_selection_hd_grade_c[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td class="align-middle">
            <select class="form-control form-control-sm" name="product_selection_hd_results1[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td class="align-middle">
            <select class="form-control form-control-sm" name="product_selection_hd_results2[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td class="align-middle">
            <select class="form-control form-control-sm" name="product_selection_hd_results3[]">
                <option value="0"></option><option value="1">/</option>
            </select>
        </td>
        <td class="align-middle">
            <input type="text" class="form-control form-control-sm" placeholder="หมายเหตุ" name="product_selection_dt_remark[]">
        </td>
        <td class="align-middle">
            <input type="file" class="form-control-file" name="product_selection_dt_file[]" >
        </td>
        <td class="align-middle">
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRow(this)">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    `;

    tableBody.appendChild(row);
    updateRowNumbers();
    addEvaluationSection(rowCount);
}

function addEvaluationSection(index) {
    const evaluation = document.querySelector("#evaluationContainer");
    const html = `
        <div class="evaluation-block mb-4" data-index="${index}">
            <h6 class="text-indigo font-weight-bold mb-3">
                <i class="fas fa-clipboard-check mr-2"></i>ใบประเมินสินค้า/ผู้ขาย ( รายการที่ ${index} )
            </h6>
            <table class="table table-modern text-center table-sm mb-0">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 5%">ลำดับ</th>
                        <th rowspan="2" style="width: 25%" class="text-left">รายการประเมิน</th>
                        <th colspan="3">(1) ดี / พอใช้ / ไม่ดี</th>
                        <th colspan="3">(2) ดี / พอใช้ / ไม่ดี</th>
                        <th colspan="3">(3) ดี / พอใช้ / ไม่ดี</th>
                        <th colspan="3">(4) ดี / พอใช้ / ไม่ดี</th>
                    </tr>
                    <tr>
                        <th class="small">ดี</th><th class="small">พอใช้</th><th class="small">ไม่ดี</th>
                        <th class="small">ดี</th><th class="small">พอใช้</th><th class="small">ไม่ดี</th>
                        <th class="small">ดี</th><th class="small">พอใช้</th><th class="small">ไม่ดี</th>
                        <th class="small">ดี</th><th class="small">พอใช้</th><th class="small">ไม่ดี</th>
                    </tr>
                </thead>
                <tbody>
                    ${createEvaluationRow(1, "คุณภาพการใช้งานของสินค้า", index)}
                    ${createEvaluationRow(2, "ความเรียบร้อยของสินค้า", index)}
                    ${createEvaluationRow(3, "บริการของผู้ขาย", index)}
                    ${createEvaluationRow(4, "การให้บริการหลังการขาย", index)}
                </tbody>
            </table>
        </div>
    `;
    evaluation.insertAdjacentHTML("beforeend", html);
}

function createEvaluationRow(no, title, index) {
    return `
        <tr>
            <td class="align-middle bg-light font-weight-bold">${no}</td>
            <td class="text-left align-middle font-weight-500">
                ${title}
                <input type="hidden" name="product_selection_sub_id[]" value="0">
                <input type="hidden" name="evaluation[${index}][sub_listno][]" value="${no}">
                <input type="hidden" name="evaluation[${index}][sub_name][]" value="${title}">
                <input type="hidden" name="evaluation[${index}][vendorlistno][]" value="${index}">
            </td>
            ${createSelectCells(index, no)}
        </tr>
    `;
}

function createSelectCells(index, subNo) {
    let html = "";
    for (let group = 1; group <= 4; group++) {
        for (let grade = 1; grade <= 3; grade++) {
            html += `
                <td class="align-middle">
                    <select class="form-control form-control-sm" name="product_selection_hd_results${group}_${subNo}[]">
                        <option value="0"></option>
                        <option value="1">/</option>
                    </select>
                </td>
            `;
        }
    }
    return html;
}

function removeRow(button) {
    const row = button.closest("tr");
    const rows = document.querySelectorAll("#destroyTable tbody tr");
    const index = Array.from(rows).indexOf(row) + 1;

    row.remove();
    updateRowNumbers();

    const ev = document.querySelector(`.evaluation-block[data-index="${index}"]`);
    if (ev) ev.remove();
}

function updateRowNumbers() {
    document.querySelectorAll("#destroyTable tbody tr").forEach((row, i) => {
        const number = i + 1;
        const numberCell = row.querySelector(".row-number");
        if (numberCell) numberCell.textContent = number;

        const input = row.querySelector('input[name="product_selection_dt_listno[]"]');
        if (input) input.value = number;
    });
}

confirmDel = (refid) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการลบรายการนี้หรือไม่ ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        confirmButtonClass: 'btn btn-success mt-2',
        cancelButtonClass: 'btn btn-danger ml-2 mt-2',
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelProductSelectionDt') }}`,
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
                            icon: 'success'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'ยกเลิกเอกสารไม่สำเร็จ',
                            icon: 'error'
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิก',
                text: 'โปรดตรวจสอบข้อมูลอีกครั้งเพื่อความถูกต้อง :)',
                icon: 'error'
            });
        }
    });
}
</script>
@endpush