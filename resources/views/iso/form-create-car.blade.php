@extends('layouts.main')
@section('content')

<style>
    /* Modern Indigo Theme Styles for CAR Create Form */
    .car-container {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        padding: 1.5rem 0;
    }
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05) !important;
        background: #ffffff;
        overflow: hidden;
    }
    .card-header {
        background: #ffffff !important;
        padding: 1.5rem 1.75rem !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .card-title-main {
        font-size: 1.4rem !important;
        font-weight: 700 !important;
        color: #4f46e5 !important;
        margin: 0;
        display: flex;
        align-items: center;
    }
    .card-body {
        padding: 2rem !important;
    }
    
    /* Grid Row Spacing */
    .form-group-row {
        margin-bottom: 1.5rem;
    }
    
    /* Modern Form Labels & Controls */
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
    textarea.form-control {
        height: auto !important;
        border-radius: 12px !important;
        padding: 0.75rem !important;
        resize: vertical;
    }

    /* Custom File Input Modern Styling */
    .form-control-file {
        padding: 5px 0;
    }

    /* Modern Inline Checkboxes */
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
        cursor: pointer;
    }
    .checkbox-indigo-container input[type="checkbox"] {
        appearance: none;
        -webkit-appearance: none;
        height: 20px;
        width: 20px;
        border: 1.5px solid #cbd5e1;
        border-radius: 6px;
        background-color: #fff;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.5rem;
        transition: all 0.2s ease;
        position: relative;
    }
    .checkbox-indigo-container input[type="checkbox"]:checked {
        background-color: #4f46e5;
        border-color: #4f46e5;
    }
    .checkbox-indigo-container input[type="checkbox"]:checked:after {
        content: '';
        position: absolute;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
        top: 2px;
    }
    .checkbox-indigo-container label {
        margin-bottom: 0 !important;
        cursor: pointer;
        font-weight: 500 !important;
        color: #334155 !important;
    }

    /* Stacked Select2 Spacing for multiple dynamic options */
    .select2-stacked-spacing {
        margin-bottom: 0.5rem !important;
    }

    /* Modern Indigo Button */
    .btn-indigo-submit {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        border: none !important;
        height: 44px;
        padding: 0 2.5rem !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.2) !important;
        transition: all 0.2s ease !important;
    }
    .btn-indigo-submit:hover {
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.3) !important;
        opacity: 0.95;
        transform: translateY(-1px);
    }

    /* Select2 Skin Override for Indigo Theme */
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
            <div class="card">
                <div class="card-header">        
                    <h3 class="card-title-main">
                        <i class="fas fa-file-alt mr-2"></i> บันทึกใบแก้ไขและป้องกันข้อบกพร่อง (ใบ CAR)
                    </h3>      
                </div>
                
                <form method="POST" class="form-horizontal" action="{{ route('car-report.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        
                        <!-- อ้างอิง Checkbox Section -->
                        <div class="row form-group-row">
                            <div class="col-12">
                                <label>อ้างอิง :</label>
                                <div class="checkbox-group-wrapper">
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="refertype1" name="iso_car_refertype1">
                                        <label for="refertype1">คำร้องเรียนจากลูกค้า/บุคคลภายนอก</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="refertype2" name="iso_car_refertype2">
                                        <label for="refertype2">รายงานความไม่สอดคล้องกับข้อกำหนด (NCR)</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="refertype3" name="iso_car_refertype3">
                                        <label for="refertype3">การตรวจสอบภายใน</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="refertype4" name="iso_car_refertype4">
                                        <label for="refertype4">อื่นๆ</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- รายละเอียดอ้างอิง -->
                        <div class="row form-group-row">
                            <div class="col-12 col-md-9 mb-3 mb-md-0">
                                <label for="iso_car_referremark">ระบุรายละเอียดอ้างอิง :</label>
                                <input class="form-control" name="iso_car_referremark" placeholder="กรอกข้อมูลเพิ่มเติมเกี่ยวกับเอกสารอ้างอิง">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="iso_car_refernumber">เลขที่/ครั้งที่อ้างอิง :</label>
                                <input class="form-control" name="iso_car_refernumber" placeholder="เช่น นร.01/69">
                            </div>
                        </div>
                        
                        <hr class="my-4" style="border-top: 1px solid #f1f5f9;">

                        <!-- ข้อมูลหลักของเอกสาร -->
                        <div class="row form-group-row">
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <label for="iso_car_docuno">CAR No :</label>
                                <input class="form-control font-weight-bold" name="iso_car_docuno" value="{{$docs}}" readonly style="background-color: #f8fafc; color: #4f46e5;">
                                <input type="hidden" name="iso_car_number" value="{{$docs_number}}">
                            </div>
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <label for="iso_car_date">วันที่ออกเอกสาร :</label>
                                <input type="date" class="form-control" name="iso_car_date" value="{{date('Y-m-d')}}">
                            </div>
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <label for="problem_by">ผู้ออกเอกสาร :</label>
                                <select class="form-control select2" name="problem_by" style="width: 100%;">
                                    <option value="">กรุณาเลือก</option>
                                    @foreach ($emp as $item)
                                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="iso_car_filename1">ไฟล์แนบหลักฐาน (หากมี) :</label>
                                <input type="file" class="form-control-file" name="iso_car_filename1">
                            </div>
                        </div>

                        <div class="row form-group-row">
                            <div class="col-12 col-md-6">
                                <label for="problem_to">ถึง (กรรมการผู้จัดการ/รองกรรมการผู้จัดการ ผู้แก้ปัญหา) :</label>                       
                                <select class="form-control select2" name="problem_to" style="width: 100%;">
                                    <option value="">กรุณาเลือก</option>
                                    @foreach ($emp as $item)
                                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>

                        <!-- ส่วนรายละเอียดเนื้อหา -->
                        <div class="row form-group-row">
                            <div class="col-12">
                                <label for="consider_remark">เกณฑ์พิจารณา / ข้อกำหนดที่อ้างอิง :</label>
                                <textarea class="form-control" name="consider_remark" rows="4" placeholder="กรอกมาตรฐาน ISO หรือข้อกำหนดกระบวนการทำงานที่เกี่ยวข้อง..."></textarea>
                            </div>
                        </div>
                        
                        <div class="row form-group-row">
                            <div class="col-12">
                                <label for="found_bugs">ข้อบกพร่องที่พบ :</label>
                                <textarea class="form-control" name="found_bugs" rows="4" placeholder="กรอกรายละเอียดข้อบกพร่องหรือความไม่สอดคล้องที่ตรวจสอบพบ..."></textarea>
                            </div>
                        </div>
                        
                        <div class="row form-group-row">
                            <div class="col-12">
                                <label for="characteristics">ลักษณะข้อบกพร่องนี้ในหน่วยงานหรือกระบวนการอื่นที่เหมือนกัน (Cross-cutting issue) :</label>
                                <textarea class="form-control" name="characteristics" rows="3" placeholder="ระบุว่าข้อบกพร่องนี้ส่งผลหรือตรวจพบในส่วนงานอื่นด้วยหรือไม่..."></textarea>
                            </div>
                        </div>
                        
                        <hr class="my-4" style="border-top: 1px solid #f1f5f9;">

                        <!-- ส่วนผู้รับผิดชอบและกำหนดเวลา -->
                        <div class="row form-group-row">
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <label for="troublemaker_by">ผู้พบปัญหา :</label>
                                <select class="form-control select2" name="troublemaker_by" style="width: 100%;">
                                    <option value="">กรุณาเลือก</option>
                                    @foreach ($emp as $item)
                                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <label for="troublemaker_date">วันที่พบปัญหา :</label>
                                <input type="date" class="form-control" name="troublemaker_date">
                            </div>
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <label for="problem_add">กำหนดผู้แก้ปัญหา :</label>
                                <div class="select2-stacked-spacing">
                                    <select class="form-control select2" name="problem_add" style="width: 100%;">
                                        <option value="">เลือกผู้รับผิดชอบหลัก</option>
                                        @foreach ($emp as $item)
                                            <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div class="select2-stacked-spacing">
                                    <select class="form-control select2" name="problem_add1" style="width: 100%;">
                                        <option value="">เลือกผู้ร่วมดำเนินการ (1)</option>
                                        @foreach ($emp as $item)
                                            <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div>
                                    <select class="form-control select2" name="problem_add2" style="width: 100%;">
                                        <option value="">เลือกผู้ร่วมดำเนินการ (2)</option>
                                        @foreach ($emp as $item)
                                            <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="problem_date">ผู้แก้ปัญหา รับเรื่องวันที่ :</label>
                                <input type="date" class="form-control" name="problem_date">
                            </div>
                        </div>
                        
                        <!-- ปุ่มบันทึกข้อมูล -->
                        <div class="row mt-4">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-indigo-submit toastrDefaultSuccess">
                                    <i class="fas fa-save mr-1"></i> บันทึกข้อมูลใบ CAR
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scriptjs')
<script>
    $(function () {
        // Initialize Select2
        $('.select2').select2({
            placeholder: "กรุณาเลือกข้อมูล",
            allowClear: true
        });
    });

    // Toastr Activation
    $('.toastrDefaultSuccess').click(function() {
        toastr.success('บันทึกข้อมูลใบ CAR เรียบร้อยแล้ว')
    });
</script>
@endpush