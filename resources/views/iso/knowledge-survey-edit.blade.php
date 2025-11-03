@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
.container {
    max-width: 1000px;
    border: 2px solid #007bff;
    border-radius: 10px;
    padding: 20px 30px;
    background-color: #f9f9f9;
}
.form-control { font-size: 0.9rem; padding: 6px 10px; }
label { font-weight: 600; font-size: 0.9rem; margin-bottom: 4px; }
h4, h5 { margin-bottom: 0.5rem; }
h6 { font-weight: 600; margin-top: 1.5rem; }
hr { margin: 1.5rem 0; }
.btn { font-size: 0.9rem; padding: 6px 18px; }
</style>

<div class="container mt-4">
    <h4 class="text-center">ESSOM CO., LTD.</h4>
    <h5 class="text-center mb-4">แก้ไขแบบสำรวจความรู้ขององค์กร</h5>

    <form action="{{ route('knowledge-survey.update', $survey->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row survey-header align-items-end mb-3">
            <div class="col-md-3">
                <label>ผู้สำรวจ ชื่อ :</label>
                <input type="text" name="surveyor_name" class="form-control" value="{{ $survey->surveyor_name }}">
            </div>
            <div class="col-md-2">
                <label>หน่วยงาน :</label>
                <input type="text" name="department" class="form-control" value="{{ $survey->department }}">
            </div>
            <div class="col-md-2">
                <label>ตำแหน่ง :</label>
                <input type="text" name="position" class="form-control" value="{{ $survey->position }}">
            </div>
            <div class="col-md-2">
                <label>วันที่ :</label>
                <input type="date" name="survey_date" class="form-control" value="{{ $survey->survey_date }}">
            </div>
            <div class="col-md-3">
                <label>แบบสำรวจที่ :</label>
                <input type="text" name="survey_number" class="form-control" value="{{ $survey->survey_number }}">
            </div>
        </div>

        <hr>

        {{-- ข้อ 1 --}}
        <div class="d-flex align-items-center mb-3">
            <h6 class="mb-0 me-2">1) มีการจัดเก็บ/แบ่งปันองค์ความรู้ที่หน่วยงานด้าน:</h6>
            <input type="text" name="q1_department_field" class="form-control" style="width: 250px;" value="{{ $survey->q1_department_field }}">
            <span class="ms-2">หรือไม่</span>
        </div>

        @php $q1_status = $survey->q1_status ?? []; @endphp
        <div class="form-check d-flex align-items-center flex-wrap mb-2">
            <input type="checkbox" name="q1_status[]" value="จัดทำแล้ว" class="form-check-input me-2" {{ in_array('จัดทำแล้ว', $q1_status) ? 'checked' : '' }}>
            <label class="form-check-label me-2 mb-0">มีการจัดทำแล้ว เอกสารเลขที่</label>
            <input type="text" name="q1_doc_no" class="form-control form-control-sm me-2" style="width: 150px;" value="{{ $survey->q1_doc_no }}">
            <label class="form-check-label me-2 mb-0">จัดเก็บอยู่ที่</label>
            <input type="text" name="q1_storage_location" class="form-control form-control-sm" style="width: 180px;" value="{{ $survey->q1_storage_location }}">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q1_status[]" value="ถ่ายทอดความรู้แล้ว" class="form-check-input me-2" {{ in_array('ถ่ายทอดความรู้แล้ว', $q1_status) ? 'checked' : '' }}>
            <label class="form-check-label me-2 mb-0">มีการถ่ายทอดความรู้แล้วด้วยการ :</label>
            <input type="text" name="q1_transfer_method" class="form-control form-control-sm" style="width: 200px;" value="{{ $survey->q1_transfer_method }}">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q1_status[]" value="ยังไม่ได้ถ่ายทอด" class="form-check-input me-2" {{ in_array('ยังไม่ได้ถ่ายทอด', $q1_status) ? 'checked' : '' }}>
            <label class="form-check-label mb-0">ยังไม่ได้ถ่ายทอดองค์ความรู้นี้</label>
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <label class="form-check-label me-2 mb-0">กำหนดวันถ่ายทอดองค์ความรู้ให้แล้วเสร็จ วันที่</label>
            <input type="date" name="q1_transfer_date" class="form-control form-control-sm" style="width: 180px;" value="{{ $survey->q1_transfer_date }}">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q1_status[]" value="ไม่มีการจัดทำ" class="form-check-input me-2" {{ in_array('ไม่มีการจัดทำ', $q1_status) ? 'checked' : '' }}>
            <label class="form-check-label me-2 mb-0">ยังไม่มีการจัดทำ Comment หัวหน้างาน</label>
            <input type="text" name="q1_comment" class="form-control form-control-sm me-2" style="width: 180px;" value="{{ $survey->q1_comment }}">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q1_status[]" value="อยู่ระหว่างดำเนินการ" class="form-check-input me-2" {{ in_array('อยู่ระหว่างดำเนินการ', $q1_status) ? 'checked' : '' }}>
            <label class="form-check-label me-2 mb-0">ยังอยู่ระหว่างการดำเนินการ กำหนดเสร็จวันที่</label>
            <input type="date" name="q1_progress_date" class="form-control form-control-sm" style="width: 180px;" value="{{ $survey->q1_progress_date }}">
        </div>

        <hr>

        {{-- ข้อ 2 --}}
        <div class="d-flex align-items-center mb-3">
            <h6 class="mb-0 me-2">2) มีการจัดทำความรู้องค์กรจาก External Sources ที่หน่วยงานด้าน:</h6>
            <input type="text" name="q2_department_field" class="form-control" style="width: 250px;" value="{{ $survey->q2_department_field }}">
            <span class="ms-2">หรือไม่</span>
        </div>

        @php $q2_status = $survey->q2_status ?? []; @endphp
        <div class="form-check d-flex align-items-center flex-wrap mb-2">
            <input type="checkbox" name="q2_status[]" value="จัดทำแล้ว" class="form-check-input me-2" {{ in_array('จัดทำแล้ว', $q2_status) ? 'checked' : '' }}>
            <label class="form-check-label me-2 mb-0">มีการจัดทำแล้ว เอกสารเลขที่</label>
            <input type="text" name="q2_doc_no" class="form-control form-control-sm me-2" style="width: 150px;" value="{{ $survey->q2_doc_no }}">
            <label class="form-check-label me-2 mb-0">จัดเก็บอยู่ที่</label>
            <input type="text" name="q2_storage_location" class="form-control form-control-sm" style="width: 180px;" value="{{ $survey->q2_storage_location }}">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q2_status[]" value="ถ่ายทอดความรู้แล้ว" class="form-check-input me-2" {{ in_array('ถ่ายทอดความรู้แล้ว', $q2_status) ? 'checked' : '' }}>
            <label class="form-check-label me-2 mb-0">มีการถ่ายทอดความรู้แล้วด้วยการ :</label>
            <input type="text" name="q2_transfer_method" class="form-control form-control-sm" style="width: 200px;" value="{{ $survey->q2_transfer_method }}">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q2_status[]" value="ยังไม่ได้ถ่ายทอด" class="form-check-input me-2" {{ in_array('ยังไม่ได้ถ่ายทอด', $q2_status) ? 'checked' : '' }}>
            <label class="form-check-label mb-0">ยังไม่ได้ถ่ายทอดองค์ความรู้นี้</label>
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <label class="form-check-label me-2 mb-0">กำหนดวันถ่ายทอดองค์ความรู้ให้แล้วเสร็จ วันที่</label>
            <input type="date" name="q2_transfer_date" class="form-control form-control-sm" style="width: 180px;" value="{{ $survey->q2_transfer_date }}">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q2_status[]" value="ไม่มีการจัดทำ" class="form-check-input me-2" {{ in_array('ไม่มีการจัดทำ', $q2_status) ? 'checked' : '' }}>
            <label class="form-check-label me-2 mb-0">ยังไม่มีการจัดทำ Comment หัวหน้างาน</label>
            <input type="text" name="q2_comment" class="form-control form-control-sm me-2" style="width: 180px;" value="{{ $survey->q2_comment }}">
            <label class="me-2 mb-0">วันที่</label>
            <input type="date" name="q2_comment_date" class="form-control form-control-sm" style="width: 180px;" value="{{ $survey->q2_comment_date }}">
        </div>

        <div class="form-check d-flex align-items-center flex-wrap mt-2">
            <input type="checkbox" name="q2_status[]" value="อยู่ระหว่างดำเนินการ" class="form-check-input me-2" {{ in_array('อยู่ระหว่างดำเนินการ', $q2_status) ? 'checked' : '' }}>
            <label class="form-check-label me-2 mb-0">ยังอยู่ระหว่างดำเนินการ กำหนดเสร็จวันที่</label>
            <input type="date" name="q2_progress_date" class="form-control form-control-sm" style="width: 180px;" value="{{ $survey->q2_progress_date }}">
        </div>

        <hr>

        {{-- ข้อ 3 --}}
        <h6>3) มีความต้องการเพิ่มความรู้องค์กรในหน่วยงานของท่านหรือไม่</h6>
        @php $q3_need = $survey->q3_need ?? []; @endphp
        <div class="form-check">
            <input type="checkbox" name="q3_need[]" value="ต้องการ" class="form-check-input" {{ in_array('ต้องการ', $q3_need) ? 'checked' : '' }}>
            <label class="form-check-label">ต้องการ</label>
        </div>
        <div class="d-flex align-items-center mb-2 mt-2">
            <label class="me-2 mb-0">หัวข้อเรื่อง :</label>
            <input type="text" name="q3_topic" class="form-control" style="width: 400px;" value="{{ $survey->q3_topic }}">
        </div>

        <div class="form-check">
            <input type="checkbox" name="q3_need[]" value="ไม่ต้องการ" class="form-check-input" {{ in_array('ไม่ต้องการ', $q3_need) ? 'checked' : '' }}>
            <label class="form-check-label">ไม่ต้องการ</label>
        </div>

        @php $q3_reason = $survey->q3_reason ?? []; @endphp
        <div class="d-flex align-items-center mb-2 mt-2">
            <label class="me-2 mb-0">เหตุผล :</label>
            <input type="text" name="q3_reason[]" class="form-control" style="width: 400px;" value="{{ $q3_reason[0] ?? '' }}">
        </div>

        <div class="form-check mt-2">
            <input type="checkbox" name="q3_reason[]" value="ยังไม่แน่ใจ" class="form-check-input" {{ in_array('ยังไม่แน่ใจ', $q3_reason) ? 'checked' : '' }}>
            <label class="form-check-label">ยังไม่แน่ใจ</label>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6">
                <label>อนุมัติโดย :</label>
                <input type="text" name="approved_by" class="form-control" value="{{ $survey->approved_by }}">
            </div>
            <div class="col-md-6">
                <label>วันที่ :</label>
                <input type="date" name="approved_date" class="form-control" value="{{ $survey->approved_date }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">บันทึก</button>
    </form>
</div>
@endsection
