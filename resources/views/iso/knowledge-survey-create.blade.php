@extends('layouts.main')
@section('content')
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<div class="card">
    <div class="col-12">
<div class="container mt-4">
    <h4 class="text-center">ESSOM CO., LTD.</h4>
    <h5 class="text-center mb-4">แบบสำรวจความรู้ขององค์กร</h5>

    <form action="{{ route('knowledge-survey.store') }}" method="POST">
        @csrf

        {{-- ข้อมูลพื้นฐาน --}}
        <div class="row survey-header align-items-end mb-3">
            <div class="col-md-4">
                <label>ผู้สำรวจ ชื่อ :</label>
                <input type="text" name="surveyor_name" class="form-control" value="{{$emp->ms_employee_fullname}}">
            </div>
            <div class="col-md-4">
                <label>หน่วยงาน :</label>
                <input type="text" name="department" class="form-control" value="{{$emp->ms_department_name}}">
            </div>
            <div class="col-md-4">
                <label>ตำแหน่ง :</label>
                <input type="text" name="position" class="form-control" value="{{$emp->ms_job_name}}">
            </div>
            <div class="col-md-4">
                <label>วันที่ :</label>
                <input type="date" name="survey_date" class="form-control"  value="{{ old('date', now()->format('Y-m-d')) }}">
            </div>
            <div class="col-md-4">
                <label>แบบสำรวจที่ :</label>
                <input type="text" name="survey_number" class="form-control">
            </div>
        </div>

        <hr>

        {{-- ข้อ 1 --}}
        <div class="d-flex align-items-center mb-3">
            <h6 class="mb-0 me-2">1) มีการจัดเก็บ/แบ่งปันองค์ความรู้ที่หน่วยงานด้าน:</h6>
            <input type="text" name="q1_department_field" class="form-control" style="width: 250px;" placeholder="ระบุด้าน">
            <span class="ms-2">หรือไม่</span>
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mb-2">
            <input type="checkbox" name="q1_status[]" value="จัดทำแล้ว" class="form-check-input me-2">
            <label class="form-check-label me-2 mb-0">มีการจัดทำแล้ว เอกสารเลขที่</label>
            <input type="text" name="q1_doc_no" class="form-control form-control-sm me-2" style="width: 150px;" placeholder="เอกสารเลขที่">
            <label class="form-check-label me-2 mb-0">จัดเก็บอยู่ที่</label>
            <input type="text" name="q1_storage_location" class="form-control form-control-sm" style="width: 180px;" placeholder="สถานที่จัดเก็บ">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q1_status[]" value="ถ่ายทอดความรู้แล้ว" class="form-check-input me-2">
            <label class="form-check-label me-2 mb-0">มีการถ่ายทอดความรู้แล้วด้วยการ :</label>
            <input type="text" name="q1_transfer_method" class="form-control form-control-sm" style="width: 200px;" placeholder="ระบุวิธีการถ่ายทอด">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q1_status[]" value="ยังไม่ได้ถ่ายทอด" class="form-check-input me-2">
            <label class="form-check-label mb-0">ยังไม่ได้ถ่ายทอดองค์ความรู้นี้</label>
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <label class="form-check-label me-2 mb-0">กำหนดวันถ่ายทอดองค์ความรู้ให้แล้วเสร็จ วันที่</label>
            <input type="date" name="q1_transfer_date" class="form-control form-control-sm" style="width: 180px;">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q1_status[]" value="ไม่มีการจัดทำ" class="form-check-input me-2">
            <label class="form-check-label me-2 mb-0">ยังไม่มีการจัดทำ Comment หัวหน้างาน</label>
            <input type="text" name="q1_comment" class="form-control form-control-sm me-2" style="width: 180px;">
            <label class="me-2 mb-0">วันที่</label>
            <input type="date" name="q1_comment_date" class="form-control form-control-sm" style="width: 180px;">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q1_status[]" value="อยู่ระหว่างดำเนินการ" class="form-check-input me-2">
            <label class="form-check-label me-2 mb-0">ยังอยู่ระหว่างการดำเนินการ กำหนดเสร็จวันที่</label>
            <input type="date" name="q1_progress_date" class="form-control form-control-sm" style="width: 180px;">
        </div>

        <hr>

        {{-- ข้อ 2 --}}
        <div class="d-flex align-items-center mb-3">
            <h6 class="mb-0 me-2">2) มีการจัดทำความรู้องค์กรจาก External Sources ที่หน่วยงานด้าน:</h6>
            <input type="text" name="q2_department_field" class="form-control" style="width: 250px;" placeholder="ระบุด้าน">
            <span class="ms-2">หรือไม่</span>
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mb-2">
            <input type="checkbox" name="q2_status[]" value="จัดทำแล้ว" class="form-check-input me-2">
            <label class="form-check-label me-2 mb-0">มีการจัดทำแล้ว เอกสารเลขที่</label>
            <input type="text" name="q2_doc_no" class="form-control form-control-sm me-2" style="width: 150px;" placeholder="เอกสารเลขที่">
            <label class="form-check-label me-2 mb-0">จัดเก็บอยู่ที่</label>
            <input type="text" name="q2_storage_location" class="form-control form-control-sm" style="width: 180px;" placeholder="สถานที่จัดเก็บ">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q2_status[]" value="ถ่ายทอดความรู้แล้ว" class="form-check-input me-2">
            <label class="form-check-label me-2 mb-0">มีการถ่ายทอดความรู้แล้วด้วยการ :</label>
            <input type="text" name="q2_transfer_method" class="form-control form-control-sm" style="width: 200px;" placeholder="ระบุวิธีการถ่ายทอด">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q2_status[]" value="ยังไม่ได้ถ่ายทอด" class="form-check-input me-2">
            <label class="form-check-label mb-0">ยังไม่ได้ถ่ายทอดองค์ความรู้นี้</label>
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <label class="form-check-label me-2 mb-0">กำหนดวันถ่ายทอดองค์ความรู้ให้แล้วเสร็จ วันที่</label>
            <input type="date" name="q2_transfer_date" class="form-control form-control-sm" style="width: 180px;">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q2_status[]" value="ไม่มีการจัดทำ" class="form-check-input me-2">
            <label class="form-check-label me-2 mb-0">ยังไม่มีการจัดทำ Comment หัวหน้างาน</label>
            <input type="text" name="q2_comment" class="form-control form-control-sm me-2" style="width: 180px;">
            <label class="me-2 mb-0">วันที่</label>
            <input type="date" name="q2_comment_date" class="form-control form-control-sm" style="width: 180px;">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q2_status[]" value="อยู่ระหว่างดำเนินการ" class="form-check-input me-2">
            <label class="form-check-label me-2 mb-0">ยังอยู่ระหว่างดำเนินการ กำหนดเสร็จ</label>
            <input type="text" name="q2_progress_detail" class="form-control form-control-sm me-2" style="width: 180px;" placeholder="ระบุรายละเอียด">
            <label class="me-2 mb-0">วันที่</label>
            <input type="date" name="q2_progress_date" class="form-control form-control-sm" style="width: 180px;">
        </div>

        <hr>

        {{-- ข้อ 3 --}}
        <h6>3) มีความต้องการเพิ่มความรู้องค์กรในหน่วยงานของท่านหรือไม่</h6>
        <div class="form-check">
            <input type="checkbox" name="q3_need[]" value="ต้องการ" class="form-check-input">
            <label class="form-check-label">ต้องการ</label>
        </div>
        <div class="d-flex align-items-center mb-2 mt-2">
            <label class="me-2 mb-0">หัวข้อเรื่อง :</label>
            <input type="text" name="q3_topic" class="form-control" style="width: 400px;">
        </div>

        <div class="form-check">
            <input type="checkbox" name="q3_need[]" value="ไม่ต้องการ" class="form-check-input">
            <label class="form-check-label">ไม่ต้องการ</label>
        </div>

        <div class="d-flex align-items-center mb-2 mt-2">
            <label class="me-2 mb-0">เหตุผล :</label>
            <input type="text" name="q3_reason[]" class="form-control" style="width: 400px;">
        </div>

        <div class="form-check mt-2">
            <input type="checkbox" name="q3_reason[]" value="ยังไม่แน่ใจ" class="form-check-input">
            <label class="form-check-label">ยังไม่แน่ใจ</label>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-6">
                <label>อนุมัติโดย :</label>
                <input type="text" name="approved_by" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label>วันที่ :</label>
                <input type="date" name="approved_date" class="form-control" readonly>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">บันทึก</button>
    </form>
</div>
</div>
</div>
@endsection
