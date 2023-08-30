@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <div class="card">
            <div class="card-header">        
                <h3 class="card-title" style="font-weight: bold">ใบ CAR</h3>      
            </div>
            <form method="POST" class="form-horizontal" action="{{ route('car-report.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="iso_car_refertype">อ้างอิง :</label>
                        <input type="checkbox" id="checkboxPrimary1" name="iso_car_refertype1">
                        <label for="iso_car_refertype">คำร้องเรียนจากลูกค้า/บุคคลภายนอก</label>
                        <input type="checkbox" id="checkboxPrimary1" name="iso_car_refertype2">
                        <label for="iso_car_refertype">รายงานความไม่สอดคล้องกับข้อกำหนด (NCR)</label>
                        <input type="checkbox" id="checkboxPrimary1" name="iso_car_refertype3">
                        <label for="iso_car_refertype">การตรวจสอบภายใน</label>
                        <input type="checkbox" id="checkboxPrimary1" name="iso_car_refertype4">
                        <label for="iso_car_refertype">อื่นๆ</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="iso_car_referremark">ระบุ :</label>
                        <input class="form-control" name="iso_car_referremark">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_car_refernumber">เลขที่/ครั้งที่อ้างอิง :</label>
                        <input class="form-control" name="iso_car_refernumber">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_car_referdate">วันที่ :</label>
                        <input type="date" class="form-control" name="iso_car_referdate">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label for="iso_car_docuno">CAR No :</label>
                        <input class="form-control" name="iso_car_docuno" value="{{$docs}}" readonly>
                        <input type="hidden" class="form-control" name="iso_car_number" value="{{$docs_number}}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_car_date">วันที่ :</label>
                        <input type="date" class="form-control" name="iso_car_date" value="{{date('Y-m-d')}}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="problem_by">ผู้แก้ปัญหา :</label>
                        <select class="form-control select2" name="problem_by">
                            <option>กรุณาเลือก</option>
                            @foreach ($emp as $item)
                                <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="problem_to">ถึงกรรมการผู้แก้ปัญหา :</label>                       
                        <select class="form-control select2" name="problem_to">
                            <option>กรุณาเลือก</option>
                            @foreach ($emp as $item)
                                <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                            @endforeach 
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="consider_remark">เกณฑ์พิจารณา/ข้อกำหนดที่อ้างอิง :</label>
                        <input class="form-control" name="consider_remark">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="found_bugs">ข้อบกพร่องที่พบ :</label>
                        <input class="form-control" name="found_bugs">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="characteristics">ลักษณะข้อบกพร่องนี้ในหน่วยงานหรือกระบวนการอื่นที่เหมือนกัน :</label>
                        <input class="form-control" name="characteristics">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label for="troublemaker_by">ผู้พบปัญหา :</label>
                        <select class="form-control select2" name="troublemaker_by">
                            <option>กรุณาเลือก</option>
                            @foreach ($emp as $item)
                                <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="troublemaker_date">วันที่ :</label>
                        <input type="date" class="form-control" name="troublemaker_date">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <button type="submit" class="btn btn-success toastrDefaultSuccess">
                            บันทึก
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
$('.select2').select2()
})
$('.toastrDefaultSuccess').click(function() {
    toastr.success('บันทึกเรียบร้อย')
});
</script>
@endpush  