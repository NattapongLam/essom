@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css')}}">
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('ncr-report.update', $hd->iso_ncr_id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold">ใบ NCR</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label for="iso_ncr_observer">ผู้พบเห็น</label>
                        <select class="form-control select2">
                            <option value="{{$hd->iso_ncr_observer}}">{{$hd->iso_ncr_observer}}</option>
                            @foreach ($emp as $item)
                            <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                            @endforeach                          
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_ncr_docuno">เลขที่</label>
                        <input class="form-control" value="{{$hd->iso_ncr_docuno}}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_ncr_department">หน่วยงานที่เกี่ยวข้อง</label>
                        <select class="form-control select2">
                            <option value="{{$hd->iso_ncr_department}}">{{$hd->iso_ncr_department}}</option>
                            @foreach ($dep as $item)
                            <option value="{{$item->ms_department_name}}">{{$item->ms_department_name}}</option>
                            @endforeach        
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_ncr_jobnumber">เลขที่งาน</label>
                        <input class="form-control" value="{{$hd->iso_ncr_jobnumber}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="iso_ncr_productname">ผลิตภัณฑ์</label>
                        <input class="form-control" value="{{$hd->iso_ncr_productname}}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_ncr_productcode">รหัส</label>
                        <input class="form-control" value="{{$hd->iso_ncr_productcode}}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_ncr_refer">อ้างอิง</label>
                        <input class="form-control" value="{{$hd->iso_ncr_refer}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="iso_ncr_nonconformity">ลักษณะความไม่สอดคล้อง</label>
                        <input class="form-control" value="{{$hd->iso_ncr_nonconformity}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label for="offender_by">ผู้กระทำผิด</label>
                        <select class="form-control select2">
                        <option value="{{$hd->offender_by}}">{{$hd->offender_by}}</option>
                        @foreach ($emp as $item)
                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                        @endforeach  
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="offender_job">ตำแหน่ง</label>
                        <input class="form-control" value="{{$hd->offender_job}}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="reported_by">รายงานโดย</label>
                        <select class="form-control select2">
                            <option value="{{$hd->reported_by}}">{{$hd->reported_by}}</option>
                            @foreach ($emp as $item)
                                <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}} ({{$item->ms_employeegroup_name}})</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="reported_job">ตำแหน่ง</label>
                        <input class="form-control" value="{{$hd->reported_job}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-2">
                        <label for="reported_date">วันที่</label>
                        <input type="date" class="form-control" value="{{$hd->reported_date}}">
                    </div>
                    <div class="col-12 col-md-10">
                        <label for="iso_ncr_note">หมายเหตุ</label>
                        <input class="form-control" value="{{$hd->iso_ncr_note}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold">การปฎิบัติต่อผลิตภัณฑ์ที่ไม่เป็นไปตามข้อกำหนด :</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="iso_ncr_why">1.กรณีไม่ทราบสาเหตุ</label>
                        @if ($hd->iso_ncr_why)
                        <input type="checkbox" id="checkboxPrimary1" name="iso_ncr_why" checked>
                        <label for="iso_ncr_why">ถอดและหรือ ตรวจสอบชิ้นส่วนประกอบเพื่อหาสาเหตุและรายงาน</label>
                        @else
                        <input type="checkbox" id="checkboxPrimary1" name="iso_ncr_why">
                        <label for="iso_ncr_why">ถอดและหรือ ตรวจสอบชิ้นส่วนประกอบเพื่อหาสาเหตุและรายงาน</label>
                        @endif                       
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="iso_ncr_cause">2.กรณีทราบสาเหตุ</label>
                        @if($hd->iso_ncr_cause == 'ซ่อมแซม')
                        <input type="checkbox" id="checkboxPrimary1" name="iso_ncr_cause1" value="ซ่อมแซม" checked>
                        <label for="iso_ncr_cause">ซ่อมแซม</label>
                        @else
                        <input type="checkbox" id="checkboxPrimary1" name="iso_ncr_cause1">
                        <label for="iso_ncr_cause">ซ่อมแซม</label>
                        @endif
                        @if($hd->iso_ncr_cause == 'ใช้ตามสภาพ')
                        <input type="checkbox" id="checkboxPrimary1" name="iso_ncr_cause2" value="ใช้ตามสภาพ" checked>
                        <label for="iso_ncr_cause">ใช้ตามสภาพ</label>
                        @else
                        <input type="checkbox" id="checkboxPrimary1" name="iso_ncr_cause2">
                        <label for="iso_ncr_cause">ใช้ตามสภาพ</label>
                        @endif
                        @if($hd->iso_ncr_cause == 'ทำลาย')
                        <input type="checkbox" id="checkboxPrimary1" name="iso_ncr_cause3" value="ทำลาย" checked>
                        <label for="iso_ncr_cause">ทำลาย</label>
                        @else
                        <input type="checkbox" id="checkboxPrimary1" name="iso_ncr_cause3">
                        <label for="iso_ncr_cause">ทำลาย</label>
                        @endif
                        @if($hd->iso_ncr_cause == 'นำไปใช้งานอื่น')
                        <input type="checkbox" id="checkboxPrimary1" name="iso_ncr_cause4" value="นำไปใช้งานอื่น" checked>
                        <label for="iso_ncr_cause">นำไปใช้งานอื่น</label>
                        @else
                        <input type="checkbox" id="checkboxPrimary1" name="iso_ncr_cause4">
                        <label for="iso_ncr_cause">นำไปใช้งานอื่น</label>
                        @endif
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
                </div><br>
                @if ($hd->iso_status_id == 1)
                <div class="row">
                    <div class="col-12 col-md-3">
                        <button type="submit" class="btn btn-success toastrDefaultSuccess">
                            บันทึก
                        </button>
                    </div>
                </div>
                @endif              
            </div>         
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold">บันทึกอนุมัติหลังการปฎิบัติต่อผลิตภัณฑ์ที่ไม่เป็นไปตามข้อกำหนด :</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label for="approval_status">คำอนุมัติ :</label>   
                        @if($hd->approval_status == 'อนุมัติตามเสนอ')
                            <input type="checkbox" id="checkboxPrimary1" name="approval_status1" checked>
                            <label for="approval_status">อนุมัติตามเสนอ</label>
                            @else
                            <input type="checkbox" id="checkboxPrimary1" name="approval_status1">
                            <label for="approval_status">อนุมัติตามเสนอ</label>
                        @endif
                        @if($hd->approval_status == 'ไม่อนุมัติตามเสนอ')
                            <input type="checkbox" id="checkboxPrimary1" name="approval_status2" checked>
                            <label for="approval_status">ไม่อนุมัติตามเสนอ</label>
                            @else
                            <input type="checkbox" id="checkboxPrimary1" name="approval_status2">
                            <label for="approval_status">ไม่อนุมัติตามเสนอ</label>
                            @endif
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
                </div><br>   
                @if ($hd->iso_status_id == 2)
                <div class="row">
                    <div class="col-12 col-md-3">
                        <button type="submit" class="btn btn-success toastrDefaultSuccess">
                            บันทึก
                        </button>
                    </div>
                </div>
                @endif    
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold">บันทึกการตรวจสอบหลังการปฎิบัติต่อผลิตภัณฑ์ที่ไม่เป็นไปตามข้อกำหนด :</h3>
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
                </div><br>   
                @if ($hd->iso_status_id == 3)
                <div class="row">
                    <div class="col-12 col-md-3">
                        <button type="submit" class="btn btn-success toastrDefaultSuccess">
                            บันทึก
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
    $('.select2').select2()
})
$('.toastrDefaultSuccess').click(function() {
    toastr.success('บันทึกเรียบร้อย')
});
</script>
@endpush  