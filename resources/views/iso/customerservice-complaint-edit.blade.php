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

    label {
        font-weight: 500;
        color: #475569;
        font-size: 0.875rem;
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

    .section-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--indigo-primary);
        border-left: 4px solid var(--indigo-primary);
        padding-left: 0.75rem;
        margin: 1.5rem 0 1rem 0;
    }

    .subsection-label {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
    }

    .table-modern-form thead th {
        background-color: #f8fafc !important;
        color: #475569;
        font-weight: 600;
        font-size: 0.85rem;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 0.75rem !important;
    }

    .table-modern-form tbody td {
        padding: 0.5rem !important;
        vertical-align: middle !important;
    }

    .checkbox-group-wrapper {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1rem;
    }

    .checkbox-indigo-container {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .checkbox-indigo-container:last-child {
        margin-bottom: 0;
    }

    .checkbox-indigo-container input[type="radio"] {
        accent-color: var(--indigo-primary);
        width: 1.1rem;
        height: 1.1rem;
        cursor: pointer;
    }

    .checkbox-indigo-container label {
        margin-bottom: 0;
        cursor: pointer;
        color: var(--text-dark);
        font-weight: 500;
    }

    .btn-indigo-submit {
        background-color: var(--indigo-primary);
        color: #ffffff;
        font-weight: 600;
        border-radius: 8px;
        border: none;
        padding: 0.6rem 2rem;
        transition: all 0.2s ease;
        box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
    }

    .btn-indigo-submit:hover {
        background-color: var(--indigo-hover);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 12px -2px rgba(79, 70, 229, 0.3);
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <!-- Header -->
                <div class="card-header custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div class="text-center text-md-start">
                            <h5 class="m-0">ESSOM CO., LTD.</h5>
                            <h5 class="m-0 font-weight-normal" style="font-size: 1.1rem; opacity: 0.9;">
                                ใบบันทึกคำร้องเรียนจากลูกค้าและบริการหลังขาย (CUSTOMER COMPLAINT & AFTER SALES SERVICE) - แก้ไขข้อมูล
                            </h5>
                            <span class="doc-code">ฟอร์มเอกสาร: F8204.1 (1 Jan. 21)</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4"> 
                    <form action="{{ route('customerservice-complaints.update', $hd->customerservice_complaint_hds_id) }}" method="POST">
                        @csrf       
                        @method('PUT')   
                        <input type="hidden" name="doc_ref" value="Edit">

                        <!-- ข้อมูลเบื้องต้น -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>วันที่ลูกค้าแจ้ง</label>
                                    <input class="form-control" type="date" name="customer_notice_date" value="{{ $hd->customer_notice_date }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>เลขที่ใบแจ้ง</label>
                                    <input class="form-control" type="text" name="notice_no" placeholder="ระบุเลขที่ใบแจ้ง" value="{{ $hd->notice_no }}">
                                </div>
                            </div>
                        </div>

                        <!-- ส่วนที่ 1 -->
                        <div class="section-title">
                            ส่วนที่ 1 : ส่วนข้อมูลรายละเอียดคำร้องเรียนและซ่อมบริการ (สำนักงาน)
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ลูกค้า/สาขา</label>
                                    <input class="form-control" type="text" name="customer_name" placeholder="ชื่อลูกค้า / สาขา" value="{{ $hd->customer_name }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ผู้ติดต่อ</label>
                                    <input class="form-control" type="text" name="contact_person" placeholder="ชื่อผู้ติดต่อ" value="{{ $hd->contact_person }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>โทรศัพท์</label>
                                    <input class="form-control" type="text" name="telephone" placeholder="เบอร์โทรศัพท์" value="{{ $hd->telephone }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>อีเมล์</label>
                                    <input class="form-control" type="email" name="email" placeholder="อีเมล" value="{{ $hd->email }}">
                                </div>
                            </div>
                        </div>

                        <!-- ตารางรายการ (ส่วนที่ 1) -->
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-modern-form text-center align-middle">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">ลำดับ</th>
                                        <th style="width: 20%">รหัสสินค้า</th>
                                        <th style="width: 20%">หมายเลขเครื่อง</th>
                                        <th style="width: 55%">อาการเบื้องต้น</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dt_off as $i => $item)
                                    <tr>
                                        <td>
                                            {{ $item->listno }}
                                            <input class="form-control form-control-sm" name="items[{{ $i }}][listno_off]" value="{{ $item->listno }}" type="hidden">
                                            <input class="form-control form-control-sm" name="items[{{ $i }}][customerservice_complaint_dts_id]" value="{{ $item->customerservice_complaint_dts_id }}" type="hidden">
                                        </td>
                                        <td>
                                            <input class="form-control form-control-sm" name="items[{{ $i }}][product_code]" value="{{ $item->product_code }}">
                                        </td>
                                        <td>
                                            <input class="form-control form-control-sm" name="items[{{ $i }}][serial_no]" value="{{ $item->serial_no }}">
                                        </td>
                                        <td>
                                            <input class="form-control form-control-sm" name="items[{{ $i }}][initial_symptom]" value="{{ $item->initial_symptom }}">
                                            <input type="hidden" name="items[{{ $i }}][table_type]" value="off">
                                        </td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- ผลการพิจารณา -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">ผลการพิจารณาเห็นแล้วเป็น :</label>
                                    <div class="checkbox-group-wrapper">
                                        <div class="checkbox-indigo-container">
                                            <input type="radio" id="evaluation_status1" name="evaluation_round" value="ออกใบ CAR" {{ $hd->evaluation_round == 'ออกใบ CAR' ? 'checked' : '' }}>
                                            <label for="evaluation_status1">คำร้องเรียน และ ออกใบ CAR No.</label>
                                            <input class="form-control d-inline-block w-auto mx-2" type="text" name="car_no" placeholder="เลขที่ CAR" value="{{ $hd->car_no }}" style="max-width: 150px;">
                                            <span>เมื่อวันที่</span>
                                            <input class="form-control d-inline-block w-auto ms-2" type="date" name="car_date" value="{{ $hd->car_date }}">
                                        </div>
                                        <div class="checkbox-indigo-container">
                                            <input type="radio" id="evaluation_status2" name="evaluation_round" value="ซ่อมและบริการหลังการขายเนื่องจากการสึกหรอหรือเสื่อมสภาพ" {{ $hd->evaluation_round == 'ซ่อมและบริการหลังการขายเนื่องจากการสึกหรอหรือเสื่อมสภาพ' ? 'checked' : '' }}>
                                            <label for="evaluation_status2">ซ่อมและบริการหลังการขายเนื่องจากการสึกหรอหรือเสื่อมสภาพ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ผู้บันทึก / ผู้อนุมัติ (ส่วนที่ 1) -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ผู้บันทึก</label>
                                    <input class="form-control" type="text" name="recorder" value="{{ $hd->recorder ?? (auth()->user()->name ?? '') }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>วันที่</label>
                                    <input class="form-control" type="date" name="recorded_date" value="{{ $hd->recorded_date ?? date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ผู้อนุมัติ</label>
                                    <input class="form-control" type="text" name="approver" value="{{ $hd->approver ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>วันที่</label>
                                    <input class="form-control" type="date" name="approved_date" value="{{ $hd->approved_date ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <!-- ส่วนที่ 2 -->
                        <div class="section-title">
                            ส่วนที่ 2 : การวิเคราะห์หาสาเหตุและการแก้ปัญหาของเครื่อง (โรงงาน)
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="checkbox-group-wrapper">
                                        <div class="checkbox-indigo-container">
                                            <input type="radio" id="factory_action1" name="factory_action_type" value="ติดต่อนัดหมายเพื่อเข้าไปตรวจเช็ค" {{ isset($hd->factory_action_type) && $hd->factory_action_type == 'ติดต่อนัดหมายเพื่อเข้าไปตรวจเช็ค' ? 'checked' : '' }}>
                                            <label for="factory_action1">ติดต่อนัดหมายเพื่อเข้าไปตรวจเช็ค</label>
                                            <span>วันที่</span>
                                            <input class="form-control d-inline-block w-auto ms-2" type="date" name="inspection_date" value="{{ $hd->inspection_date ?? '' }}">
                                        </div>
                                        <div class="checkbox-indigo-container">
                                            <input type="radio" id="factory_action2" name="factory_action_type" value="ติดต่อให้คำแนะนำลูกค้าแก้ไขเอง" {{ isset($hd->factory_action_type) && $hd->factory_action_type == 'ติดต่อให้คำแนะนำลูกค้าแก้ไขเอง' ? 'checked' : '' }}>
                                            <label for="factory_action2">ติดต่อให้คำแนะนำลูกค้าแก้ไขเอง</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ตารางวิเคราะห์สาเหตุและแนวทางแก้ไข (ส่วนที่ 2) -->
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-modern-form text-center align-middle">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">ลำดับ</th>
                                        <th style="width: 18%">รหัสสินค้า</th>
                                        <th style="width: 27%">สาเหตุ</th>
                                        <th style="width: 27%">แนวทางแก้ไข/รายการอะไหล่</th>
                                        <th style="width: 8%">จำนวน</th>
                                        <th style="width: 15%">ราคา (฿)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($dt_fac) && count($dt_fac) > 0)
                                        @foreach ($dt_fac as $i => $item)
                                        <tr>
                                            <td>
                                                {{ $item->listno }}
                                                <input class="form-control form-control-sm" name="factory_items[{{ $i }}][listno_fac]" value="{{ $item->listno }}" type="hidden">
                                                <input class="form-control form-control-sm" name="factory_items[{{ $i }}][customerservice_complaint_dts_id]" value="{{ $item->customerservice_complaint_dts_id }}" type="hidden">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm" name="factory_items[{{ $i }}][product_code]" value="{{ $item->product_code }}">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm" name="factory_items[{{ $i }}][cause]" value="{{ $item->cause }}">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm" name="factory_items[{{ $i }}][solution]" value="{{ $item->solution }}">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm text-center" type="number" step="0.01" name="factory_items[{{ $i }}][qty]" value="{{ number_format($item->qty,2) }}">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm text-end" type="number" step="0.01" name="factory_items[{{ $i }}][price]" value="{{ number_format($item->price,2) }}">
                                                <input type="hidden" name="factory_items[{{ $i }}][table_type]" value="fac">
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        @for ($i = 1; $i <= 10; $i++)
                                        <tr>
                                            <td>
                                                {{ $i }}
                                                <input class="form-control form-control-sm" name="factory_items[{{ $i }}][listno_fac]" value="{{ $i }}" type="hidden">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm" name="factory_items[{{ $i }}][product_code]">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm" name="factory_items[{{ $i }}][cause]">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm" name="factory_items[{{ $i }}][solution]">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm text-center" type="number" name="factory_items[{{ $i }}][qty]">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm text-end" type="number" step="0.01" name="factory_items[{{ $i }}][price]">
                                                <input type="hidden" name="factory_items[{{ $i }}][table_type]" value="fac">
                                            </td>
                                        </tr>
                                        @endfor
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- สรุปค่าใช้จ่าย -->
                        <div class="subsection-label">สรุปค่าใช้จ่าย</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ค่าวัสดุ/อุปกรณ์</label>
                                    <input class="form-control" type="number" step="0.01" name="cost_material" value="{{ number_format($hd->cost_material,2) ?? '' }}" placeholder="0.00">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ค่าแรง</label>
                                    <input class="form-control" type="number" step="0.01" name="cost_labor" value="{{ number_format($hd->cost_labor,2) ?? '' }}" placeholder="0.00">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ค่าขนส่ง/เดินทาง</label>
                                    <input class="form-control" type="number" step="0.01" name="cost_transport" value="{{ number_format($hd->cost_transport,2) ?? '' }}" placeholder="0.00">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ค่าอื่นๆ</label>
                                    <input class="form-control" type="number" step="0.01" name="cost_other" value="{{ number_format($hd->cost_other,2) ?? '' }}" placeholder="0.00">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>รวมทั้งหมด</label>
                                    <input class="form-control bg-light" type="number" step="0.01" name="cost_total" value="{{ number_format($hd->cost_total,2) ?? '' }}" placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>กำหนดเสร็จ</label>
                                    <input class="form-control" type="date" name="due_date" value="{{ $hd->due_date ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <!-- รายงานโดย / ผู้อนุมัติ (ส่วนที่ 2) -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>รายงานโดย</label>
                                    <input class="form-control" type="text" name="factory_reporter" value="{{ $hd->factory_reporter ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>วันที่</label>
                                    <input class="form-control" type="date" name="factory_reported_date" value="{{ $hd->factory_reported_date ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ผู้อนุมัติ</label>
                                    <input class="form-control" type="text" name="factory_approver" value="{{ $hd->factory_approver ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>วันที่</label>
                                    <input class="form-control" type="date" name="factory_approved_date" value="{{ $hd->factory_approved_date ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <!-- ส่วนที่ 3 -->
                        <div class="section-title">
                            ส่วนที่ 3 : การวิเคราะห์หาสาเหตุและการแก้ปัญหาของเครื่อง (สำนักงาน/โรงงาน)
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="checkbox-group-wrapper">
                                        <div class="checkbox-indigo-container">
                                            <input type="radio" id="part3_action1" name="part3_action_type" value="กรณีคำร้องเรียน" {{ isset($hd->part3_action_type) && $hd->part3_action_type == 'กรณีคำร้องเรียน' ? 'checked' : '' }}>
                                            <label for="part3_action1">กรณีคำร้องเรียน</label>
                                            <span>แก้ไขแล้วเสร็จวันที่</span>
                                            <input class="form-control d-inline-block w-auto ms-2" type="date" name="part3_completed_date" value="{{ $hd->part3_completed_date ?? '' }}">
                                            <span>ลงชื่อ</span>
                                            <input class="form-control d-inline-block w-auto ms-2" type="text" name="part3_factory_signer" placeholder="ชื่อผู้ลงนาม" value="{{ $hd->part3_factory_signer ?? '' }}" style="max-width: 150px;">
                                            <span class="text-muted">(โรงงาน)</span>
                                        </div>
                                        <div class="checkbox-indigo-container">
                                            <input type="radio" id="part3_action2" name="part3_action_type" value="กรณีเสนอราคาซ่อม" {{ isset($hd->part3_action_type) && $hd->part3_action_type == 'กรณีเสนอราคาซ่อม' ? 'checked' : '' }}>
                                            <label for="part3_action2">กรณีเสนอราคาซ่อม</label>
                                            <span>เสนอราคาซ่อมวันที่</span>
                                            <input class="form-control d-inline-block w-auto ms-2" type="date" name="part3_quotation_date" value="{{ $hd->part3_quotation_date ?? '' }}">
                                            <span>อนุมัติซ่อมวันที่</span>
                                            <input class="form-control d-inline-block w-auto ms-2" type="date" name="part3_approved_repair_date" value="{{ $hd->part3_approved_repair_date ?? '' }}">
                                            <span>ซ่อมเรียบร้อยวันที่</span>
                                            <input class="form-control d-inline-block w-auto ms-2" type="date" name="part3_repaired_date" value="{{ $hd->part3_repaired_date ?? '' }}">
                                            <span class="text-muted">(สำนักงาน)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ส่วนที่ 4 -->
                        <div class="section-title">
                            ส่วนที่ 4 : ปิดใบบันทึก (สำนักงาน/โรงงาน)
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="checkbox-group-wrapper">
                                        <div class="checkbox-indigo-container">
                                            <input type="radio" id="part4_action1" name="part4_action_type" value="ปิดเนื่องจากแก้ไขหรือซ่อมเรียบร้อย" {{ isset($hd->part4_action_type) && $hd->part4_action_type == 'ปิดเนื่องจากแก้ไขหรือซ่อมเรียบร้อย' ? 'checked' : '' }}>
                                            <label for="part4_action1">ปิดเนื่องจากแก้ไขหรือซ่อมเรียบร้อย</label>
                                        </div>
                                        <div class="checkbox-indigo-container">
                                            <input type="radio" id="part4_action2" name="part4_action_type" value="ปิดเนื่องลูกค้าไม่อนุมัติซ่อมหลังจากเสนอราคาเกิน 60 วัน" {{ isset($hd->part4_action_type) && $hd->part4_action_type == 'ปิดเนื่องลูกค้าไม่อนุมัติซ่อมหลังจากเสนอราคาเกิน 60 วัน' ? 'checked' : '' }}>
                                            <label for="part4_action2">ปิดเนื่องลูกค้าไม่อนุมัติซ่อมหลังจากเสนอราคาเกิน 60 วัน</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- รายงานโดย / ผู้อนุมัติ (ส่วนที่ 4) -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>รายงานโดย</label>
                                    <input class="form-control" type="text" name="part4_reporter" value="{{ $hd->part4_reporter ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>วันที่</label>
                                    <input class="form-control" type="date" name="part4_reported_date" value="{{ $hd->part4_reported_date ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ผู้อนุมัติ</label>
                                    <input class="form-control" type="text" name="part4_approver" value="{{ $hd->part4_approver ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>วันที่</label>
                                    <input class="form-control" type="date" name="part4_approved_date" value="{{ $hd->part4_approved_date ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <!-- ปุ่มบันทึกการแก้ไข -->
                        <div class="row mt-4">
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-indigo-submit">
                                    <i class="fas fa-save me-2"></i> บันทึกการแก้ไข
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
    // สคริปต์คำนวณราคาอัตโนมัติหรือสคริปต์เพิ่มเติม (ถ้ามี)
</script>
@endpush