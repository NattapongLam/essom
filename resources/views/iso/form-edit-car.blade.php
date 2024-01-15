@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('car-report.update', $hd->iso_car_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">        
                <h3 class="card-title" style="font-weight: bold">ใบ CAR</h3>      
            </div>            
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="iso_car_refertype">อ้างอิง :</label>
                        @if($hd->iso_car_refertype == 'คำร้องเรียนจากลูกค้า/บุคคลภายนอก')
                        <input type="checkbox" id="checkboxPrimary1" name="iso_car_refertype" value="คำร้องเรียนจากลูกค้า/บุคคลภายนอก" checked>
                        <label for="iso_car_refertype">คำร้องเรียนจากลูกค้า/บุคคลภายนอก</label>
                        @else
                        <input type="checkbox" id="checkboxPrimary1" name="iso_car_refertype">
                        <label for="iso_car_refertype">คำร้องเรียนจากลูกค้า/บุคคลภายนอก</label>
                        @endif
                        @if($hd->iso_car_refertype == 'รายงานความไม่สอดคล้องกับข้อกำหนด (NCR)')
                        <input type="checkbox" id="checkboxPrimary1" name="iso_car_refertype" value="รายงานความไม่สอดคล้องกับข้อกำหนด (NCR)" checked>
                        <label for="iso_car_refertype">รายงานความไม่สอดคล้องกับข้อกำหนด (NCR)</label>
                        @else
                        <input type="checkbox" id="checkboxPrimary1" name="iso_car_refertype">
                        <label for="iso_car_refertype">รายงานความไม่สอดคล้องกับข้อกำหนด (NCR)</label>
                        @endif
                        @if($hd->iso_car_refertype == 'การตรวจสอบภายใน')
                        <input type="checkbox" id="checkboxPrimary1" name="iso_car_refertype" value="การตรวจสอบภายใน" checked>
                        <label for="iso_car_refertype">การตรวจสอบภายใน</label>
                        @else
                        <input type="checkbox" id="checkboxPrimary1" name="iso_car_refertype">
                        <label for="iso_car_refertype">การตรวจสอบภายใน</label>
                        @endif
                        @if($hd->iso_car_refertype == 'อื่นๆ')
                        <input type="checkbox" id="checkboxPrimary1" name="iso_car_refertype" value="อื่นๆ" checked>
                        <label for="iso_car_refertype">อื่นๆ</label>
                        @else
                        <input type="checkbox" id="checkboxPrimary1" name="iso_car_refertype">
                        <label for="iso_car_refertype">อื่นๆ</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="iso_car_referremark">ระบุ :</label>
                        <input class="form-control" value="{{$hd->iso_car_referremark}}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_car_refernumber">เลขที่/ครั้งที่อ้างอิง :</label>
                        <input class="form-control" value="{{$hd->iso_car_refernumber}}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_car_referdate">วันที่ :</label>
                        <input type="date" class="form-control" value="{{$hd->iso_car_referdate}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label for="iso_car_docuno">CAR No :</label>
                        <input class="form-control" value="{{$hd->iso_car_docuno}}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_car_date">วันที่ :</label>
                        <input type="date" class="form-control" value="{{$hd->iso_car_date}}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="problem_by">ผู้แก้ปัญหา :</label>
                        <select class="form-control select2">
                            <option value="{{$hd->problem_by}}">{{$hd->problem_by}}</option>
                            @foreach ($emp as $item)
                                <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="problem_to">ถึงกรรมการผู้แก้ปัญหา :</label>
                        <select class="form-control select2">
                            <option value="{{$hd->problem_to}}">{{$hd->problem_to}}</option>
                            @foreach ($emp as $item)
                                <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                            @endforeach 
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="consider_remark">เกณฑ์พิจารณา/ข้อกำหนดที่อ้างอิง :</label>
                        <input class="form-control" value="{{$hd->consider_remark}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="found_bugs">ข้อบกพร่องที่พบ :</label>
                        <input class="form-control" value="{{$hd->found_bugs}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="characteristics">ลักษณะข้อบกพร่องนี้ในหน่วยงานหรือกระบวนการอื่นที่เหมือนกัน :</label>
                        <input class="form-control" value="{{$hd->characteristics}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label for="troublemaker_by">ผู้พบปัญหา :</label>
                        <select class="form-control select2">
                            <option value="{{$hd->troublemaker_by}}">{{$hd->troublemaker_by}}</option>
                            @foreach ($emp as $item)
                                <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="troublemaker_date">วันที่ :</label>
                        <input type="date" class="form-control" value="{{$hd->troublemaker_date}}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="troublemaker_byto">กรรมการผู้พบปัญหา :</label>
                        <select class="form-control select2">
                            <option value="{{$hd->troublemaker_byto}}">{{$hd->troublemaker_byto}}</option>
                            @foreach ($emp as $item)
                                <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="troublemaker_dateto">วันที่ :</label>
                        <input type="date" class="form-control" value="{{$hd->troublemaker_dateto}}">
                    </div>
                </div><br>
                @if($hd->iso_status_id == 1)
                <div class="row">
                    <div class="col-12 col-md-3">
                        <button type="submit" class="btn btn-info toastrDefaultSuccess">
                            ลงนาม
                        </button>
                    </div>
                </div>
                @endif               
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold">การแก้ไข/ป้องกัน</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label for="problem_date">กรรมการผู้แก้ปัญหา รับเรื่องวันที่</label>
                        <input type="date" class="form-control" value="{{$hd->problem_date}}" name="problem_date">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="problem_add">กำหนดผู้แก้ปัญหาคือ</label>
                        <select class="form-control select2" name="problem_add">
                            <option value="{{$hd->problem_add}}">{{$hd->problem_add}}</option>
                            @foreach ($emp as $item)
                                <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="cause_remark">สาเหตุของปัญหา</label>
                        <input class="form-control" value="{{$hd->cause_remark}}" name="cause_remark">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="prevent_remark">มาตรการแก้ไข/ป้องกัน</label>
                        <input class="form-control" value="{{$hd->prevent_remark}}" name="prevent_remark">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="follow_remark">การตรวจติดตาม ข้อบกพร่องนี้ในหน่วยงานหรือกระบวนการอื่นที่เหมือนกัน</label>
                        <input class="form-control" value="{{$hd->follow_remark}}" name="follow_remark">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label for="iso_car_duedate">กำหนดเสร็จภายในวันที่</label>
                        <input type="date" class="form-control" value="{{$hd->iso_car_duedate}}" name="iso_car_duedate">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="iso_car_by">ลงชื่อ (ผู้แก้ปัญหา)</label>
                        <select class="form-control select2" name="iso_car_by">
                            <option value="{{$hd->iso_car_by}}">{{$hd->iso_car_by}}</option>
                            @foreach ($emp as $item)
                                <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="iso_car_bydate">วันที่ (ผู้แก้ปัญหา)</label>
                        <input type="date" class="form-control" value="{{$hd->iso_car_bydate}}" name="iso_car_bydate">
                    </div>
                </div><br>
                @if($hd->iso_status_id == 6)
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
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="opinion_remark">ความเห็นของ กรรมการผู้จัดการ /รองกรรมการผู้จัดการ</label>
                        <input class="form-control" value="{{$hd->opinion_remark}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label for="opinion_by">ลงนาม</label>
                        <select class="form-control select2" name="opinion_by">
                            <option value="{{$hd->opinion_by}}">{{$hd->opinion_by}}</option>
                            @foreach ($emp as $item)
                                <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="opinion_date">วันที่</label>
                        <input type="date" class="form-control" value="{{$hd->opinion_date}}" name="opinion_date">
                    </div>
                </div><br>
                @if($hd->iso_status_id == 7)
                <div class="row">
                    <div class="col-12 col-md-3">
                        <button type="submit" class="btn btn-info toastrDefaultSuccess">
                            ลงนาม
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold">การติดตามผล</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-10">
                        <label for="followup_remark">กรรมการผู้จัดการ / รองกรรมการผู้จัดการ ผู้แก้ปัญหา ติดตามการแก้ไข</label>
                        <input class="form-control" value="{{$hd->followup_remark}}" name="followup_remark">
                    </div>
                    <div class="col-12 col-md-2">
                        <label for="iso_car_refdocuno">เอกสารอ้างอิง</label>
                        <input class="form-control" value="{{$hd->iso_car_refdocuno}}" name="iso_car_refdocuno">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label for="close_by">ลงนาม</label>
                        <select class="form-control select2" name="close_by">
                            <option value="{{$hd->close_by}}">{{$hd->close_by}}</option>
                            @foreach ($emp as $item)
                                <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="close_date">วันที่</label>
                        <input type="date" class="form-control" value="{{$hd->close_date}}" name="close_date">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="followup_by">กรรมการปิดประเด็นใน CAR ฉบับนี้</label>
                        <select class="form-control select2">
                            <option value="{{$hd->followup_by}}">{{$hd->followup_by}}</option>
                            @foreach ($emp as $item)
                                <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="followup_date">วันที่</label>
                        <input type="date" class="form-control" value="{{$hd->followup_date}}">
                    </div>
                </div><br>
                @if($hd->iso_status_id == 8)
                <div class="row">
                <div class="col-12 col-md-3">
                    <button type="submit" class="btn btn-success toastrDefaultSuccess">
                        ปิดเอกสาร
                    </button>
                </div>
                </div>
                @elseif($hd->iso_status_id == 9)
                <div class="col-12 col-md-3">
                    <button type="submit" class="btn btn-info toastrDefaultSuccess">
                        กรรมการปิดเอกสาร
                    </button>
                </div>
                </div>
                @endif
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
$('.select2').select2()
})
$('.toastrDefaultSuccess').click(function() {
    toastr.success('บันทึกเรียบร้อย')
});
</script>
@endpush  