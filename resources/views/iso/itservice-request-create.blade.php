@extends('layouts.main')
@section('content')
<!-- SweetAlert2 Resource -->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Theme Styles for Objective Table */
    .objective-container {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        padding: 1.5rem 0;
    }
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.05) !important;
        background: #ffffff;
        overflow: hidden;
    }
    .card-header {
        background: #ffffff !important;
        padding: 1.5rem 1.75rem !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .company-title {
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 1px;
        color: #6366f1;
        margin-bottom: 0.25rem;
    }
    .main-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }
    .doc-meta {
        font-size: 0.8rem;
        color: #94a3b8;
        font-weight: 500;
    }

    /* Modern Indigo Button */
    .btn-indigo-add {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        padding: 0.55rem 1.35rem !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        font-size: 0.9rem;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2) !important;
        transition: all 0.2s ease !important;
        border: none !important;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-indigo-add:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3) !important;
        transform: translateY(-1px);
        color: #ffffff !important;
        text-decoration: none;
    }

    /* Table Customization */
    .table-responsive {
        border-radius: 12px;
        overflow: auto;
        border: 1px solid #e2e8f0;
        width: 100%;
    }
    #tb_job {
        margin: 0 !important;
    }
    #tb_job thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 0.85rem 0.5rem !important;
        font-size: 0.9rem;
        vertical-align: middle !important;
    }
    #tb_job tbody td {
        padding: 0.85rem 0.6rem !important;
        vertical-align: middle !important;
        color: #334155;
        font-size: 0.9rem;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(248, 250, 252, 0.5) !important;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(99, 102, 241, 0.02) !important;
    }

    /* Pastel Action Buttons */
    .btn-action-edit {
        background-color: #fef3c7 !important;
        color: #d97706 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 0.35rem 0.55rem !important;
        transition: all 0.2s;
        display: inline-block;
    }
    .btn-action-edit:hover {
        background-color: #d97706 !important;
        color: #ffffff !important;
    }
    .btn-action-approve {
        background-color: #e0e7ff !important;
        color: #4f46e5 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 0.35rem 0.55rem !important;
        transition: all 0.2s;
        display: inline-block;
    }
    .btn-action-approve:hover {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
    }
    .btn-action-delete {
        background-color: #fee2e2 !important;
        color: #dc2626 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 0.35rem 0.55rem !important;
        transition: all 0.2s;
        outline: none !important;
    }
    .btn-action-delete:hover {
        background-color: #dc2626 !important;
        color: #ffffff !important;
    }

    /* DataTables Layout Overwrites */
    .dt-buttons .btn {
        background-color: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #475569 !important;
        border-radius: 6px !important;
        font-size: 0.85rem !important;
        font-weight: 500 !important;
        margin-right: 0.25rem;
    }
    .dt-buttons .btn:hover {
        background-color: #f1f5f9 !important;
        color: #1e293b !important;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 0.3rem 0.75rem !important;
        outline: none;
    }
</style>

<div class="objective-container">
    <form action="{{ route('itservice-requests.store') }}" method="POST" class="form-container">
    @csrf
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div>
                            <h5 class="main-title">แบบฟอร์มร้องขอดำเนินการด้าน IT</h5>
                        </div>
                        <div class="text-md-right mt-2 mt-md-0 doc-meta">
                            <strong>Form No:</strong> F7134.3<br>
                            <strong>Date:</strong> 07 Apr 17
                        </div>
                    </div>
                </div>

                <div class="card-body">     
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">วัตถุประสงค์</label>
                                <div class="checkbox-group-wrapper" style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 10px;">
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="track_type1" name="objective_status[]" value="ติดตั้งโปรแกรม">
                                        <label for="track_type1">ติดตั้งโปรแกรม</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="track_type2" name="objective_status[]" value="ขอ E-Mail Address">
                                        <label for="track_type2">ขอ E-Mail Address</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="track_type3" name="objective_status[]" value="ขอโยกย้าย">
                                        <label for="track_type3">ขอโยกย้าย</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="track_type4" name="objective_status[]" value="ขอให้ตรวจเช็ค">
                                        <label for="track_type4">ขอให้ตรวจเช็ค</label>
                                    </div>
                                    <div class="checkbox-indigo-container">
                                        <input type="checkbox" id="track_type5" name="objective_status[]" value="ขอให้ซ่อมแซมแก้ไข">
                                        <label for="track_type5">ขอให้ซ่อมแซมแก้ไข</label>
                                    </div>
                                    <div class="checkbox-indigo-container" style="grid-column: span 3;">
                                        <input type="checkbox" id="track_type6" name="objective_status[]" value="อื่นๆ">
                                        <label for="track_type6">อื่นๆ</label>
                                        <input class="form-control" name="objective_remark">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-form-label">รายละเอียดการร้องขอ</label>
                                <textarea class="form-control" rows="5" name="itservice_requests_note"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="col-form-label">ผู้ร้องขอ</label>
                                <input class="form-control" type="text" name="itservice_requests_person" value="{{ auth()->user()->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="col-form-label">แผนก</label>
                                <input class="form-control" name="itservice_requests_department" value="{{$dep->ms_department_name}}" type="text" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="col-form-label">วันที่ร้องขอ</label>
                                <input class="form-control" type="date" value="{{date('Y-m-d')}}" name="itservice_requests_date">
                            </div>
                        </div>
                    </div> 
                    <div class="col-12 mt-3 text-right">
                        <button type="submit" class="btn btn-indigo-add">บันทึกข้อมูล</button>
                    </div>                          
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div>
    </div>
 </form>
</div>

@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
</script>
@endpush