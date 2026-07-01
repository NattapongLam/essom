@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css')}}">

<style>
    /* Modern Indigo Theme Styles */
    .ncr-wrapper {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        padding: 1.5rem 0;
    }
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05) !important;
        background: #ffffff;
        margin-bottom: 2rem !important;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 10px 30px rgba(79, 70, 229, 0.08) !important;
    }
    .card-header {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        padding: 1.25rem 1.75rem !important;
        border-bottom: none !important;
    }
    .card-title {
        font-size: 1.15rem !important;
        font-weight: 600 !important;
        letter-spacing: 0.5px;
        margin: 0;
    }
    .card-body {
        padding: 2rem !important;
        background-color: #fcfcff;
    }
    .row {
        margin-bottom: 1.25rem;
    }
    .row:last-child {
        margin-bottom: 0;
    }
    label {
        font-weight: 600 !important;
        color: #4b5563 !important;
        margin-bottom: 0.5rem !important;
        font-size: 0.9rem;
        display: inline-block;
    }
    .form-control {
        border-radius: 10px !important;
        border: 1.5px solid #e5e7eb !important;
        padding: 0.6rem 1rem !important;
        height: auto !important;
        color: #1f2937 !important;
        background-color: #ffffff !important;
        transition: all 0.25s ease-in-out !important;
    }
    .form-control:focus {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12) !important;
        background-color: #ffffff !important;
    }
    /* Select2 Modern Overrides */
    .select2-container--default .select2-selection--single {
        border-radius: 10px !important;
        border: 1.5px solid #e5e7eb !important;
        height: 45px !important;
        padding: 0.55rem 1rem !important;
        transition: all 0.25s ease-in-out;
    }
    .select2-container--default .select2-selection--single:focus,
    .select2-container--default.select2-container--open .select2-selection--single {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12) !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 22px !important;
        color: #1f2937 !important;
        padding-left: 0 !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 43px !important;
        right: 10px !important;
    }
    /* Modern Checkbox Design */
    .checkbox-container {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
        cursor: pointer;
    }
    .checkbox-container input[type="checkbox"] {
        appearance: none;
        -webkit-appearance: none;
        height: 20px;
        width: 20px;
        border: 1.5px solid #d1d5db;
        border-radius: 6px;
        background-color: #fff;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.75rem;
        transition: all 0.2s ease;
        position: relative;
    }
    .checkbox-container input[type="checkbox"]:checked {
        background-color: #4f46e5;
        border-color: #4f46e5;
    }
    .checkbox-container input[type="checkbox"]:checked:after {
        content: '';
        position: absolute;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
        top: 2px;
    }
    .checkbox-container label {
        margin-bottom: 0 !important;
        cursor: pointer;
        font-weight: 500 !important;
    }
    /* Modern Indigo Button */
    .btn-indigo-submit {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 0.75rem 2rem !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2) !important;
        transition: all 0.2s ease !important;
    }
    .btn-indigo-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.3) !important;
        opacity: 0.95;
    }
    .btn-indigo-submit:active {
        transform: translateY(1px);
    }
</style>

<div class="ncr-wrapper">
    <div class="row">  
        <div class="col-12">
            <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('ncr-report.update', $hd->iso_ncr_id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ใบ NCR</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <label for="iso_ncr_observer">ผู้พบเห็น</label>
                                <select class="form-control select2" name="iso_ncr_observer">
                                    <option value="{{$hd->iso_ncr_observer}}">{{$hd->iso_ncr_observer}}</option>
                                    @foreach ($emp as $item)
                                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                                    @endforeach                                  
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="iso_ncr_docuno">เลขที่</label>
                                <input class="form-control" name="iso_ncr_docuno" value="{{$hd->iso_ncr_docuno}}">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="iso_ncr_department">หน่วยงานที่เกี่ยวข้อง</label>
                                <select class="form-control select2" name="iso_ncr_department">
                                    <option value="{{$hd->iso_ncr_department}}">{{$hd->iso_ncr_department}}</option>
                                    @foreach ($dep as $item)
                                        <option value="{{$item->ms_department_name}}">{{$item->ms_department_name}}</option>
                                    @endforeach        
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="iso_ncr_jobnumber">เลขที่งาน</label>
                                <input class="form-control" name="iso_ncr_jobnumber" value="{{$hd->iso_ncr_jobnumber}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="iso_ncr_productname">ผลิตภัณฑ์</label>
                                <input class="form-control" name="iso_ncr_productname" value="{{$hd->iso_ncr_productname}}">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="iso_ncr_productcode">รหัส</label>
                                <input class="form-control" name="iso_ncr_productcode" value="{{$hd->iso_ncr_productcode}}">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="iso_ncr_refer">อ้างอิง</label>
                                <input class="form-control" name="iso_ncr_refer" value="{{$hd->iso_ncr_refer}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-12">
                                <label for="iso_ncr_nonconformity">ลักษณะความไม่สอดคล้อง</label>
                                <input class="form-control" name="iso_ncr_nonconformity" value="{{$hd->iso_ncr_nonconformity}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-3">
                                <label for="offender_by">ผู้กระทำผิด</label>
                                <select class="form-control select2" name="offender_by">
                                    <option value="{{$hd->offender_by}}">{{$hd->offender_by}}</option>
                                    @foreach ($emp as $item)
                                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                                    @endforeach  
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="offender_job">ตำแหน่ง</label>
                                <input class="form-control" name="offender_job" value="{{$hd->offender_job}}">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="reported_by">รายงานโดย</label>
                                <select class="form-control select2" name="reported_by">
                                    <option value="{{$hd->reported_by}}">{{$hd->reported_by}}</option>
                                    @foreach ($emp as $item)
                                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="reported_job">ตำแหน่ง</label>
                                <input class="form-control" name="reported_job" value="{{$hd->reported_job}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-2">
                                <label for="reported_date">วันที่</label>
                                <input type="date" class="form-control" name="reported_date" value="{{$hd->reported_date}}">
                            </div>
                            <div class="col-12 col-md-10">
                                <label for="iso_ncr_note">หมายเหตุ</label>
                                <input class="form-control" name="iso_ncr_note" value="{{$hd->iso_ncr_note}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">การปฎิบัติต่อผลิตภัณฑ์ที่ไม่เป็นไปตามข้อกำหนด :</h3>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-start">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <label class="d-block mb-2">1.กรณีไม่ทราบสาเหตุ</label>
                                <div class="checkbox-container">
                                    <input type="checkbox" id="iso_ncr_why" name="iso_ncr_why" {{ $hd->iso_ncr_why ? 'checked' : '' }}>
                                    <label for="iso_ncr_why">ถอดและหรือ ตรวจสอบชิ้นส่วนประกอบเพื่อหาสาเหตุและรายงาน</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="d-block mb-2">2.กรณีทราบสาเหตุ</label>
                                <div class="d-flex flex-wrap gap-3">
                                    <div class="checkbox-container mr-3">
                                        <input type="checkbox" id="cause_repair" name="iso_ncr_cause1" value="ซ่อมแซม" {{ $hd->iso_ncr_cause == 'ซ่อมแซม' ? 'checked' : '' }}>
                                        <label for="cause_repair">ซ่อมแซม</label>
                                    </div>
                                    <div class="checkbox-container mr-3">
                                        <input type="checkbox" id="cause_asis" name="iso_ncr_cause2" value="ใช้ตามสภาพ" {{ $hd->iso_ncr_cause == 'ใช้ตามสภาพ' ? 'checked' : '' }}>
                                        <label for="cause_asis">ใช้ตามสภาพ</label>
                                    </div>
                                    <div class="checkbox-container mr-3">
                                        <input type="checkbox" id="cause_destroy" name="iso_ncr_cause3" value="ทำลาย" {{ $hd->iso_ncr_cause == 'ทำลาย' ? 'checked' : '' }}>
                                        <label for="cause_destroy">ทำลาย</label>
                                    </div>
                                    <div class="checkbox-container">
                                        <input type="checkbox" id="cause_other_use" name="iso_ncr_cause4" value="นำไปใช้งานอื่น" {{ $hd->iso_ncr_cause == 'นำไปใช้งานอื่น' ? 'checked' : '' }}>
                                        <label for="cause_other_use">นำไปใช้งานอื่น</label>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <label for="iso_ncr_other">เหตุผลที่เลือก</label>
                                <input type="text" class="form-control" value="{{$hd->iso_ncr_other}}" name="iso_ncr_other">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label for="offered_by">เสนอโดย</label>
                                <select class="form-control select2" name="offered_by">
                                    <option value="{{$hd->offered_by}}">{{$hd->offered_by}}</option>
                                    @foreach ($emp as $item)
                                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="offered_job">ตำแหน่ง</label>
                                <input type="text" class="form-control" value="{{$hd->offered_job}}" name="offered_job">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="offered_date">วันที่</label>
                                <input type="date" class="form-control" value="{{$hd->offered_date}}" name="offered_date">
                            </div>
                        </div>

                        @if ($hd->iso_status_id == 1)
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-indigo-submit toastrDefaultSuccess">
                                    <i class="fas fa-save mr-2"></i> บันทึกข้อมูล
                                </button>
                            </div>
                        </div>
                        @endif              
                    </div>         
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">บันทึกอนุมัติหลังการปฎิบัติต่อผลิตภัณฑ์ที่ไม่เป็นไปตามข้อกำหนด :</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <label class="d-block mb-2">คำอนุมัติ :</label>   
                                <div class="checkbox-container">
                                    <input type="checkbox" id="app_status1" name="approval_status1" {{ $hd->approval_status == 'อนุมัติตามเสนอ' ? 'checked' : '' }}>
                                    <label for="app_status1">อนุมัติตามเสนอ</label>
                                </div>
                                <div class="checkbox-container">
                                    <input type="checkbox" id="app_status2" name="approval_status2" {{ $hd->approval_status == 'ไม่อนุมัติตามเสนอ' ? 'checked' : '' }}>
                                    <label for="app_status2">ไม่อนุมัติตามเสนอ</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-9"> 
                                <label for="approval_remark">เพิ่มเติม :</label>   
                                <input class="form-control" value="{{$hd->approval_remark}}" name="approval_remark">
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-12 col-md-12"> 
                                <label for="iso_ncr_order">คำสั่ง :</label>   
                                <input class="form-control" value="{{$hd->iso_ncr_order}}" name="iso_ncr_order">
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-12 col-md-4"> 
                                <label for="customer_docuno">กรณี USE-AS-IS : ใบยินยอมจากลูกค้าเลขที่ :</label>   
                                <input class="form-control" value="{{$hd->customer_docuno}}" name="customer_docuno">
                            </div>
                            <div class="col-12 col-md-4"> 
                                <label for="customer_date">วันที่ :</label>  
                                <input type="date" class="form-control" value="{{$hd->customer_date}}" name="customer_date">
                            </div>
                            <div class="col-12 col-md-4"> 
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-12 col-md-4"> 
                                <label for="approved_by">ลงชื่อผู้อนุมัติ :</label>  
                                <select class="form-control select2" name="approved_by">
                                    <option value="{{$hd->approved_by}}">{{$hd->approved_by}}</option>
                                    @foreach ($emp as $item)
                                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-12 col-md-4"> 
                                <label for="approved_job">ตำแหน่ง :</label>
                                <input class="form-control" value="{{$hd->approved_job}}" name="approved_job">
                            </div>
                            <div class="col-12 col-md-4"> 
                                <label for="approved_date">วันที่ :</label>  
                                <input type="date" class="form-control" value="{{$hd->approved_date}}" name="approved_date">
                            </div>
                        </div>

                        @if ($hd->iso_status_id == 2)
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-indigo-submit toastrDefaultSuccess">
                                    <i class="fas fa-save mr-2"></i> บันทึกอนุมัติ
                                </button>
                            </div>
                        </div>
                        @endif    
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">บันทึกการตรวจสอบหลังการปฎิบัติต่อผลิตภัณฑ์ที่ไม่เป็นไปตามข้อกำหนด :</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12"> 
                                <label for="iso_ncr_remark">เพิ่มเติม</label>   
                                <input class="form-control" value="{{$hd->iso_ncr_remark}}" name="iso_ncr_remark">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4"> 
                                <label for="checked_by">ผู้ตรวจสอบ</label>  
                                <select class="form-control select2" name="checked_by">
                                    <option value="{{$hd->checked_by}}">{{$hd->checked_by}}</option>
                                    @foreach ($emp as $item)
                                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-12 col-md-4"> 
                                <label for="checked_job">ตำแหน่ง</label>
                                <input class="form-control" value="{{$hd->checked_job}}" name="checked_job">
                            </div>
                            <div class="col-12 col-md-4"> 
                                <label for="checked_date">วันที่ :</label>  
                                <input type="date" class="form-control" value="{{$hd->checked_date}}" name="checked_date">
                            </div>
                        </div>

                        @if ($hd->iso_status_id == 3)
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-indigo-submit toastrDefaultSuccess">
                                    <i class="fas fa-save mr-2"></i> บันทึกการตรวจสอบ
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
<script src="{{ asset('/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{asset('/assets/plugins/toastr/toastr.min.js')}}"></script>
<script>
$(function () {
    $('.select2').select2({
        width: '100%'
    });
});

$('.toastrDefaultSuccess').click(function() {
    toastr.success('บันทึกเรียบร้อย')
});
</script>
@endpush