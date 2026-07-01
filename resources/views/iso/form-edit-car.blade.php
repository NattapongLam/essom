@extends('layouts.main')
@section('content')

<style>
    /* Modern Indigo Theme Styles for CAR Edit/Update Form */
    .car-container {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        padding: 1.5rem 0;
    }
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.04) !important;
        background: #ffffff;
        overflow: hidden;
        margin-bottom: 2rem !important;
    }
    .card-header {
        background: #ffffff !important;
        padding: 1.25rem 1.75rem !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .card-title-main {
        font-size: 1.25rem !important;
        font-weight: 700 !important;
        color: #1e293b !important;
        margin: 0;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    .card-title-main span.text-indigo {
        color: #4f46e5 !important;
    }
    .card-body {
        padding: 1.75rem !important;
    }
    
    /* Spacing Groups */
    .form-group-row {
        margin-bottom: 1.25rem;
    }
    
    /* Modern Input Elements */
    label {
        font-weight: 600 !important;
        color: #475569 !important;
        font-size: 0.95rem;
        margin-bottom: 0.5rem !important;
        display: inline-block;
    }
    .form-control, .select2-container .select2-selection--single {
        border-radius: 10px !important;
        border: 1.5px solid #e2e8f0 !important;
        padding: 0.5rem 0.75rem !important;
        height: 42px !important;
        color: #1f2937 !important;
        background-color: #ffffff !important;
        transition: all 0.25s ease-in-out !important;
    }
    .form-control:focus {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12) !important;
    }
    .form-control[readonly], .form-control[disabled], 
    .select2-container--disabled .select2-selection--single {
        background-color: #f8fafc !important;
        color: #64748b !important;
        border-color: #e2e8f0 !important;
        opacity: 0.85;
    }
    textarea.form-control {
        height: auto !important;
        border-radius: 12px !important;
        padding: 0.75rem !important;
        resize: vertical;
    }

    /* Attachment Badges */
    .btn-attachment-download {
        display: inline-flex;
        align-items: center;
        background-color: #eeebff;
        color: #4f46e5 !important;
        padding: 0.35rem 0.75rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-left: 0.5rem;
        transition: all 0.2s;
    }
    .btn-attachment-download:hover {
        background-color: #4f46e5;
        color: #ffffff !important;
        text-decoration: none;
    }

    /* Modern Checkboxes styled for Readonly display */
    .checkbox-group-wrapper {
        background-color: #f8fafc;
        padding: 1rem 1.25rem;
        border-radius: 12px;
        border: 1px dashed #cbd5e1;
        margin-bottom: 0.5rem;
    }
    .checkbox-indigo-container {
        display: inline-flex;
        align-items: center;
        margin-right: 1.5rem;
        margin-top: 0.25rem;
        margin-bottom: 0.25rem;
    }
    .checkbox-indigo-container input[type="checkbox"] {
        appearance: none;
        -webkit-appearance: none;
        height: 18px;
        width: 18px;
        border: 1.5px solid #cbd5e1;
        border-radius: 5px;
        background-color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.5rem;
        position: relative;
    }
    .checkbox-indigo-container input[type="checkbox"]:checked {
        background-color: #4f46e5;
        border-color: #4f46e5;
    }
    .checkbox-indigo-container input[type="checkbox"]:checked:after {
        content: '';
        position: absolute;
        width: 4px;
        height: 8px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
        top: 2px;
    }
    .checkbox-indigo-container label {
        margin-bottom: 0 !important;
        font-weight: 500 !important;
        color: #334155 !important;
    }
    .checkbox-indigo-container input[type="checkbox"]:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Multi-select stacked spacing */
    .select2-stacked-spacing {
        margin-bottom: 0.5rem !important;
    }

    /* Modern Theme Buttons */
    .btn-action-submit {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        border: none !important;
        height: 42px;
        padding: 0 1.75rem !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.2) !important;
        transition: all 0.2s ease !important;
    }
    .btn-action-submit:hover {
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.3) !important;
        transform: translateY(-1px);
        opacity: 0.95;
    }
    .btn-action-info {
        background: linear-gradient(135deg, #0284c7 0%, #0ea5e9 100%) !important;
        color: #ffffff !important;
        border: none !important;
        height: 42px;
        padding: 0 1.75rem !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 14px rgba(14, 165, 233, 0.2) !important;
        transition: all 0.2s ease !important;
    }
    .btn-action-info:hover {
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.3) !important;
        transform: translateY(-1px);
        opacity: 0.95;
    }

    /* Select2 Alignment Fixes */
    .select2-container--default .select2-selection--single {
        display: flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 8px !important;
    }
</style>

<div class="car-container">
    <div class="row">  
        <div class="col-12">
            <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('car-report.update', $hd->iso_car_id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">        
                        <h3 class="card-title-main">
                            <i class="fas fa-edit text-indigo mr-1"></i> จัดการเอกสารใบแก้ไขและป้องกันข้อบกพร่อง <span class="text-indigo">({{ $hd->iso_car_docuno }})</span>
                        </h3>
                        <div>
                            @if ($hd->iso_car_filename1)
                                <a href="{{ asset($hd->iso_car_filename1) }}" target="_blank" class="btn-attachment-download">
                                    <i class="fas fa-file-pdf mr-1"></i> ไฟล์แนบ 1
                                </a>
                            @endif
                            @if ($hd->iso_car_filename2)
                                <a href="{{ asset($hd->iso_car_filename2) }}" target="_blank" class="btn-attachment-download">
                                    <i class="fas fa-file-pdf mr-1"></i> ไฟล์แนบ 2
                                </a>
                            @endif
                            @if ($hd->iso_car_filename3)
                                <a href="{{ asset($hd->iso_car_filename3) }}" target="_blank" class="btn-attachment-download">
                                    <i class="fas fa-file-pdf mr-1"></i> ไฟล์แนบ 3
                                </a>
                            @endif
                        </div>
                    </div>      
                    
                    <div class="card-body">
                        <div class="row form-group-row">
                            <div class="col-12">
                                <label>อ้างอิง :</label>
                                <div class="checkbox-group-wrapper">
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="editRefer1" name="iso_car_refertype" value="คำร้องเรียนจากลูกค้า/บุคคลภายนอก" {{ $hd->iso_car_refertype == 'คำร้องเรียนจากลูกค้า/บุคคลภายนอก' ? 'checked' : '' }} disabled>
                                        <label for="editRefer1">คำร้องเรียนจากลูกค้า/บุคคลภายนอก</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="editRefer2" name="iso_car_refertype" value="รายงานความไม่สอดคล้องกับข้อกำหนด (NCR)" {{ $hd->iso_car_refertype == 'รายงานความไม่สอดคล้องกับข้อกำหนด (NCR)' ? 'checked' : '' }} disabled>
                                        <label for="editRefer2">รายงานความไม่สอดคล้องกับข้อกำหนด (NCR)</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="editRefer3" name="iso_car_refertype" value="การตรวจสอบภายใน" {{ $hd->iso_car_refertype == 'การตรวจสอบภายใน' ? 'checked' : '' }} disabled>
                                        <label for="editRefer3">การตรวจสอบภายใน</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="editRefer4" name="iso_car_refertype" value="ปัญหาสิ่งแวดล้อม" {{ $hd->iso_car_refertype == 'ปัญหาสิ่งแวดล้อม' ? 'checked' : '' }} disabled>
                                        <label for="editRefer4">ปัญหาสิ่งแวดล้อม</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="editRefer5" name="iso_car_refertype" value="อื่นๆ" {{ $hd->iso_car_refertype == 'อื่นๆ' ? 'checked' : '' }} disabled>
                                        <label for="editRefer5">อื่นๆ</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row form-group-row">         
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <label for="iso_car_referremark">ระบุรายละเอียด :</label>
                                <input class="form-control" value="{{$hd->iso_car_referremark}}" readonly>
                            </div>         
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <label for="iso_car_refernumber">เลขที่/ครั้งที่อ้างอิง :</label>
                                <input class="form-control" value="{{$hd->iso_car_refernumber}}" readonly>
                            </div>
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <label for="iso_car_docuno">CAR No :</label>
                                <input class="form-control font-weight-bold" value="{{$hd->iso_car_docuno}}" readonly style="color: #4f46e5;">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="iso_car_date">วันที่ออกเอกสาร :</label>
                                <input type="date" class="form-control" value="{{$hd->iso_car_date}}" readonly>
                            </div>
                        </div>

                        <div class="row form-group-row">
                            <div class="col-12 col-md-4 mb-3 mb-md-0">
                                <label for="problem_by">ผู้ออกเอกสาร :</label>
                                <select class="form-control select2" disabled style="width: 100%;">
                                    <option value="{{$hd->problem_by}}">{{$hd->problem_by}}</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="problem_to">ถึง (กรรมการผู้จัดการ/รองกรรมการผู้จัดการ ผู้แก้ปัญหา) :</label>
                                <select class="form-control select2" disabled style="width: 100%;">
                                    <option value="{{$hd->problem_to}}">{{$hd->problem_to}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group-row">
                            <div class="col-12">
                                <label for="consider_remark">เกณฑ์พิจารณา/ข้อกำหนดที่อ้างอิง :</label>
                                <textarea class="form-control" disabled rows="3">{{$hd->consider_remark}}</textarea>
                            </div>
                        </div>
                        <div class="row form-group-row">
                            <div class="col-12">
                                <label for="found_bugs">ข้อบกพร่องที่พบ :</label>
                                <textarea class="form-control" disabled rows="3">{{$hd->found_bugs}}</textarea>
                            </div>
                        </div>
                        <div class="row form-group-row">
                            <div class="col-12">
                                <label for="characteristics">ลักษณะข้อบกพร่องนี้ในหน่วยงานหรือกระบวนการอื่นที่เหมือนกัน :</label>
                                <textarea class="form-control" disabled rows="3">{{$hd->characteristics}}</textarea>
                            </div>
                        </div>

                        <div class="row form-group-row">
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <label for="troublemaker_by">ผู้พบปัญหา :</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option value="{{$hd->troublemaker_by}}">{{$hd->troublemaker_by}}</option>
                                    @foreach ($emp as $item)
                                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <label for="troublemaker_date">วันที่พบปัญหา :</label>
                                <input type="date" class="form-control" value="{{$hd->troublemaker_date}}">
                            </div>                   
                            <div class="col-12 col-md-6">
                                <label>กำหนดผู้แก้ปัญหา :</label>
                                <div class="select2-stacked-spacing">
                                    <select class="form-control select2" name="problem_add" style="width: 100%;">
                                        <option value="{{$hd->problem_add}}">{{$hd->problem_add ? $hd->problem_add : 'ไม่ระบุ'}}</option>
                                        <option value="0">ไม่ระบุ</option>
                                        @foreach ($emp as $item)
                                            <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div class="select2-stacked-spacing">
                                    <select class="form-control select2" name="problem_add1" style="width: 100%;">
                                        <option value="{{$hd->problem_add1}}">{{$hd->problem_add1 ? $hd->problem_add1 : 'ไม่ระบุ'}}</option>
                                        <option value="0">ไม่ระบุ</option>
                                        @foreach ($emp as $item)
                                            <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div>
                                    <select class="form-control select2" name="problem_add2" style="width: 100%;">
                                        <option value="{{$hd->problem_add2}}">{{$hd->problem_add2 ? $hd->problem_add2 : 'ไม่ระบุ'}}</option>
                                        <option value="0">ไม่ระบุ</option>
                                        @foreach ($emp as $item)
                                            <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                                        @endforeach 
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title-main" style="color: #4f46e5 !important;">
                            <i class="fas fa-shield-alt mr-1"></i> ส่วนบันทึก: การแก้ไข / มาตรการป้องกัน
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row form-group-row">
                            <div class="col-12">
                                <label for="cause_remark">สาเหตุของปัญหา :</label>
                                <textarea class="form-control" name="cause_remark" rows="4" placeholder="ระบุการวิเคราะห์หาสาเหตุที่แท้จริง (Root Cause)...">{{$hd->cause_remark}}</textarea>
                            </div>
                        </div>
                        <div class="row form-group-row">
                            <div class="col-12">
                                <label for="prevent_remark">มาตรการแก้ไข/ป้องกัน :</label>
                                <textarea class="form-control" name="prevent_remark" rows="4" placeholder="ระบุแผนงานหรือมาตรการเพื่อไม่ให้เกิดข้อบกพร่องซ้ำ...">{{$hd->prevent_remark}}</textarea>
                            </div>
                        </div>
                        <div class="row form-group-row">
                            <div class="col-12">
                                <label for="follow_remark">การตรวจติดตาม ข้อบกพร่องนี้ในหน่วยงานหรือกระบวนการอื่นที่เหมือนกัน :</label>
                                <textarea class="form-control" name="follow_remark" rows="4" placeholder="ระบุการขยายผลตรวจสอบในแผนกอื่นที่มีกระบวนการคล้ายคลึงกัน...">{{$hd->follow_remark}}</textarea>
                            </div>
                        </div>
                        <div class="row form-group-row align-items-end">
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <label for="iso_car_duedate">กำหนดเสร็จภายในวันที่ :</label>
                                <input type="date" class="form-control" value="{{$hd->iso_car_duedate}}" name="iso_car_duedate">
                            </div>
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <label for="iso_car_by">ลงชื่อ (ผู้แก้ปัญหา) :</label>
                                <div class="select2-stacked-spacing">
                                    <select class="form-control select2" name="iso_car_by" style="width: 100%;">
                                        <option value="{{$hd->iso_car_by}}">{{$hd->iso_car_by ? $hd->iso_car_by : 'ลงนามผู้แก้ปัญหาหลัก'}}</option>
                                        @foreach ($emp as $item)
                                            <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div class="select2-stacked-spacing">
                                    <select class="form-control select2" name="iso_car_by1" style="width: 100%;">
                                        <option value="{{$hd->iso_car_by1}}">{{$hd->iso_car_by1 ? $hd->iso_car_by1 : 'ลงนามผู้ร่วมแก้ปัญหา (1)'}}</option>
                                        @foreach ($emp as $item)
                                            <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div>
                                    <select class="form-control select2" name="iso_car_by2" style="width: 100%;">
                                        <option value="{{$hd->iso_car_by2}}">{{$hd->iso_car_by2 ? $hd->iso_car_by2 : 'ลงนามผู้ร่วมแก้ปัญหา (2)'}}</option>
                                        @foreach ($emp as $item)
                                            <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                                        @endforeach 
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <label for="iso_car_bydate">วันที่ดำเนินการเสร็จสิ้น :</label>
                                <input type="date" class="form-control" value="{{$hd->iso_car_bydate}}" name="iso_car_bydate">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="iso_car_filename2">อัปโหลดไฟล์หลักฐานแนบ :</label>
                                <input type="file" class="form-control-file" name="iso_car_filename2" >
                            </div>
                        </div>
                        
                        @if($hd->iso_status_id == 1)
                            <div class="row mt-4">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-action-submit toastrDefaultSuccess">
                                        <i class="fas fa-save mr-1"></i> บันทึกการแก้ไข/ป้องกัน
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title-main">
                            <i class="fas fa-user-check text-info mr-1"></i> ความเห็นของ กรรมการผู้จัดการ / รองกรรมการผู้จัดการ
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row form-group-row">
                            <div class="col-12">
                                <label for="opinion_remark">รายละเอียดความเห็นฝ่ายบริหาร :</label>
                                <input class="form-control" value="{{$hd->opinion_remark}}" name="opinion_remark" id="opinion_remark" placeholder="กรอกความเห็นหรือข้อเสนอแนะเพิ่มเติมจากผู้บริหาร...">
                            </div>
                        </div>
                        <div class="row form-group-row">
                            <div class="col-12 col-md-3">
                                <label for="opinion_date">วันที่ลงนามความเห็น :</label>
                                <input type="date" class="form-control" value="{{$hd->opinion_date}}" name="opinion_date">
                            </div>
                        </div>
                        
                        @if($hd->iso_status_id == 7)
                            <div class="row mt-3">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-action-info toastrDefaultSuccess">
                                        <i class="fas fa-comment-dots mr-1"></i> บันทึกความคิดเห็นผู้บริหาร
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title-main" style="color: #0284c7 !important;">
                            <i class="fas fa-check-circle mr-1"></i> การติดตามผลและการปิดประเด็น
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row form-group-row">
                            <div class="col-12 col-md-4 mb-3 mb-md-0">
                                <label for="followup_by">กรรมการผู้รับผิดชอบปิดประเด็น CAR :</label>
                                <select class="form-control select2" name="followup_by" style="width: 100%;">
                                    <option value="{{$hd->followup_by}}">{{$hd->followup_by ? $hd->followup_by : 'กรุณาเลือกผู้ลงนามปิดประเด็น'}}</option>
                                    @foreach ($emp as $item)
                                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-12 col-md-4 mb-3 mb-md-0">
                                <label for="followup_date">วันที่ปิดประเด็น :</label>
                                <input type="date" class="form-control" value="{{$hd->followup_date}}" name="followup_date">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="iso_car_refdocuno">รหัสเอกสารอ้างอิงปิดประเด็น (ถ้ามี) :</label>
                                <input class="form-control" value="{{$hd->iso_car_refdocuno}}" name="iso_car_refdocuno" placeholder="เช่น DOC-2026-XXXX">
                            </div>
                        </div>
                        
                        @if($hd->iso_status_id == 8 || $hd->iso_status_id == 7)
                            <div class="row mt-4">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-action-info toastrDefaultSuccess">
                                        <i class="fas fa-key mr-1"></i> ลงนามปิดเอกสาร CAR
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scriptjs')
<script>
    $(function () {
        // Initialize Select2 With Configuration
        $('.select2').select2({
            placeholder: "กรุณาเลือกข้อมูล",
            allowClear: true
        });
    });

    // Toastr Message Trigger
    $('.toastrDefaultSuccess').click(function() {
        toastr.success('บันทึกการเปลี่ยนแปลงข้อมูลเรียบร้อยแล้ว')
    });
</script>
@endpush