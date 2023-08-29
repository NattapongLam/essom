@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold">ใบ NCR</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label for="iso_ncr_observer">ผู้พบเห็น</label>
                        <select class="form-control select2">
                            <option>กรุณาเลือก</option>
                            @foreach ($emp as $item)
                            <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                            @endforeach                          
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_ncr_docuno">เลขที่</label>
                        <input class="form-control">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_ncr_department">หน่วยงานที่เกี่ยวข้อง</label>
                        <select class="form-control select2">
                            <option>กรุณาเลือก</option>
                            @foreach ($dep as $item)
                            <option value="{{$item->ms_department_name}}">{{$item->ms_department_name}}</option>
                            @endforeach        
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_ncr_jobnumber">เลขที่งาน</label>
                        <input class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="iso_ncr_productname">ผลิตภัณฑ์</label>
                        <input class="form-control">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_ncr_productcode">รหัส</label>
                        <input class="form-control">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="iso_ncr_refer">อ้างอิง</label>
                        <input class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="iso_ncr_nonconformity">ลักษณะความไม่สอดคล้อง</label>
                        <input class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label for="offender_by">ผู้กระทำผิด</label>
                        <select class="form-control select2">
                        <option>กรุณาเลือก</option>
                        @foreach ($emp as $item)
                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                        @endforeach  
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="offender_job">ตำแหน่ง</label>
                        <input class="form-control">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="reported_by">รายงานโดย</label>
                        <select class="form-control select2">
                            <option>กรุณาเลือก</option>
                            @foreach ($emp as $item)
                                <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="reported_job">ตำแหน่ง</label>
                        <input class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-2">
                        <label for="reported_date">วันที่</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-12 col-md-10">
                        <label for="iso_ncr_note">หมายเหตุ</label>
                        <input class="form-control">
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
        </div>
        </div>
    </div>
</div>
@endsection
@push('scriptjs')
<script>
</script>
@endpush  