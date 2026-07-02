@extends('layouts.main')
@section('content')

{{-- @push('styles') --}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}

<style>
    /* Modern Indigo Theme Layout */
    .custom-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05);
        border: 1px solid #e2e8f0;
        margin-top: 30px;
        margin-bottom: 30px;
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
    }

    /* Header Component Design */
    .card-header-modern {
        background-color: #ffffff;
        padding: 2rem 2.5rem 1rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-title-block h5 {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
        font-size: 1.4rem;
        line-height: 1.5;
    }

    .doc-number-badge {
        position: absolute;
        top: 2rem;
        right: 2.5rem;
        text-align: right;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        color: #64748b;
        line-height: 1.4;
    }

    /* Top Action Bar Group */
    .top-action-bar {
        display: flex;
        justify-content: flex-end;
        padding: 0 2.5rem;
        margin-top: 25px;
        margin-bottom: -15px;
    }

    /* Buttons Component */
    .btn-indigo-add {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: #ffffff !important;
        border: none;
        padding: 10px 22px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }
    .btn-indigo-add:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    /* Table Component Container */
    .table-responsive-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        margin-top: 15px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    table.table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.88rem;
    }

    table.table-modern th {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
        font-weight: 600;
        border: 1px solid #4338ca !important;
        padding: 14px 10px;
        font-size: 0.88rem;
        vertical-align: middle;
    }

    table.table-modern td {
        padding: 12px 10px;
        border: 1px solid #e2e8f0;
        vertical-align: middle;
        background-color: #ffffff;
        color: #475569;
    }

    table.table-modern tbody tr:hover td {
        background-color: #f8fafc;
    }

    /* Custom DataTables Integration Styling */
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 20px !important;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 6px 12px !important;
        background-color: #ffffff !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #6366f1 !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    .dt-buttons {
        margin-bottom: 20px !important;
        display: inline-flex;
        gap: 5px;
    }
    .dt-button {
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #475569 !important;
        border-radius: 8px !important;
        padding: 6px 14px !important;
        font-size: 0.85rem !important;
        font-weight: 500 !important;
        transition: all 0.2s !important;
        box-shadow: none !important;
    }
    .dt-button:hover {
        background: #f1f5f9 !important;
        color: #1e293b !important;
        border-color: #94a3b8 !important;
    }

    /* Table Badges & Action Buttons */
    .btn-table-view-file {
        background-color: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.2s;
    }
    .btn-table-view-file:hover {
        background-color: #2563eb;
        color: #ffffff;
        text-decoration: none;
    }

    .action-btn-group {
        display: inline-flex;
        gap: 6px;
    }

    .btn-table-edit {
        background-color: #fef3c7;
        color: #d97706;
        border: 1px solid #fde68a;
        padding: 6px 10px;
        border-radius: 6px;
        display: inline-flex;
        transition: all 0.2s;
    }
    .btn-table-edit:hover {
        background-color: #d97706;
        color: #ffffff;
    }

    .btn-table-delete {
        background-color: #fff5f5;
        color: #e53e3e;
        border: 1px solid #fed7d7;
        padding: 6px 10px;
        border-radius: 6px;
        display: inline-flex;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-table-delete:hover {
        background-color: #e53e3e;
        color: #ffffff;
    }

    /* Modernized Bootstrap Modals Layout */
    .modal-content-modern {
        border-radius: 14px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .modal-header-modern {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 1.25rem 1.75rem;
    }
    .modal-header-modern.bg-indigo-head {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: #ffffff;
    }
    .modal-header-modern.bg-indigo-head .modal-title {
        color: #ffffff;
        font-weight: 600;
    }
    .modal-header-modern.bg-indigo-head .close {
        color: #ffffff;
        opacity: 0.8;
    }
    .modal-header-modern .modal-title {
        font-weight: 700;
        color: #1e293b;
        font-size: 1.15rem;
    }
    .modal-body-modern {
        padding: 1.75rem;
        background-color: #ffffff;
    }
    .modal-footer-modern {
        background-color: #f8fafc;
        border-top: 1px solid #f1f5f9;
        padding: 1rem 1.75rem;
    }

    /* Form Design Controls */
    .modal-body-modern label {
        font-weight: 600;
        color: #475569;
        font-size: 0.88rem;
        margin-bottom: 6px;
    }
    .modal-body-modern .form-control {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 8px 12px;
        font-size: 0.9rem;
        color: #334155;
        transition: all 0.2s;
    }
    .modal-body-modern .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    /* Style SweetAlert Buttons */
    .swal-confirm-btn {
        background-color: #4f46e5 !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 8px 20px !important;
        margin: 0 5px !important;
    }
    .swal-cancel-btn {
        background-color: #ef4444 !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 8px 20px !important;
        margin: 0 5px !important;
    }

    @media (max-width: 768px) {
        .doc-number-badge { position: relative; top: 0; right: 0; text-align: left; display: inline-block; margin-top: 10px; }
        .card-header-modern { padding: 1.5rem; }
        .top-action-bar { padding: 0 1.5rem; }
        .btn-indigo-add { width: 100%; justify-content: center; }
    }
</style>

<div class="container-fluid">
    <div class="card custom-card">
        
        <div class="card-header-modern">
            <div class="header-title-block text-center">
                <h5 class="m-0" style="font-size: 1.1rem; letter-spacing: 1px; color: #475569;">ESSOM CO., LTD.</h5>
                <h5 class="mt-2 mb-0">ประวัติคอมพิวเตอร์</h5>
            </div>
            <div class="doc-number-badge">
                <strong>F7134.1</strong><br>9 Jun. 16
            </div>
        </div>

        <div class="top-action-bar">
            <button type="button" class="btn-indigo-add" data-toggle="modal" data-target="#addComputerModal">
                <i class="fa fa-plus"></i> เพิ่มข้อมูลคอมพิวเตอร์
            </button>
        </div>

        <div class="card-body" style="padding: 2rem 2.5rem;"> 
            <div class="table-responsive-container">
                <table id="tb_job" class="table table-modern text-center m-0">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>รุ่นคอมพิวเตอร์</th>
                            <th>วันที่รับ</th>
                            <th>ผู้ใช้</th>
                            <th>รหัสสินทรัพย์</th>
                            <th>Windows</th>
                            <th>Office</th>
                            <th>ตรวจโดย</th>
                            <th>หมายเหตุ</th>
                            <th>อื่นๆ</th>
                            <th>เอกสารแนบ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($computers as $key => $row)
                        <tr>
                            <td class="font-weight-bold text-secondary">{{ $key + 1 }}</td>
                            <td class="text-left font-weight-bold" style="color: #1e293b; min-width: 130px;">{{ $row->model }}</td>
                            <td style="min-width: 90px;">{{ $row->received_date }}</td>
                            <td class="font-weight-bold" style="color: #4f46e5;">{{ $row->user_name }}</td>
                            <td><span class="badge badge-light p-2 text-dark border" style="font-size:0.85rem;">{{ $row->asset_code }}</span></td>
                            <td>{{ $row->windows_version }}</td>
                            <td>{{ $row->office_version }}</td>
                            <td>{{ $row->checked_by }}</td>
                            <td class="text-left" style="min-width: 110px;">{{ $row->remark }}</td>
                            <td class="text-left" style="min-width: 120px;">{{ $row->others }}</td>
                            <td>
                                @if($row->attachment)
                                    <a href="{{ asset('img/computers/'.$row->attachment) }}" target="_blank" class="btn-table-view-file">
                                        <i class="fas fa-file-alt"></i> ดูไฟล์
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-btn-group">
                                    <button type="button" class="btn-table-edit btn-edit" 
                                        data-id="{{ $row->id }}"
                                        data-model="{{ $row->model }}"
                                        data-received_date="{{ $row->received_date }}"
                                        data-user_name="{{ $row->user_name }}"
                                        data-asset_code="{{ $row->asset_code }}"
                                        data-windows_version="{{ $row->windows_version }}"
                                        data-office_version="{{ $row->office_version }}"
                                        data-checked_by="{{ $row->checked_by }}"
                                        data-remark="{{ $row->remark }}"
                                        data-others="{{ $row->others }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn-table-delete btn-delete" data-id="{{ $row->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="addComputerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-modern bg-indigo-head">
                <h5 class="modal-title"><i class="fa fa-desktop mr-2"></i> เพิ่มประวัติคอมพิวเตอร์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formAddComputer" enctype="multipart/form-data">
                @csrf
                <div class="modal-body modal-body-modern">
                    <div class="row">
                        <div class="form-group col-md-6"><label>รุ่นคอมพิวเตอร์ <span class="text-danger">*</span></label><input type="text" name="model" class="form-control" required></div>
                        <div class="form-group col-md-6"><label>วันที่รับ <span class="text-danger">*</span></label><input type="date" name="received_date" class="form-control" required></div>
                        <div class="form-group col-md-6"><label>ผู้ใช้ <span class="text-danger">*</span></label><input type="text" name="user_name" class="form-control" required></div>
                        <div class="form-group col-md-6"><label>รหัสสินทรัพย์ <span class="text-danger">*</span></label><input type="text" name="asset_code" class="form-control" required></div>
                        <div class="form-group col-md-6"><label>Windows</label><input type="text" name="windows_version" class="form-control" placeholder="เช่น Windows 11 Pro"></div>
                        <div class="form-group col-md-6"><label>Office</label><input type="text" name="office_version" class="form-control" placeholder="เช่น Office 2021"></div>
                        <div class="form-group col-md-6"><label>ตรวจโดย</label><input type="text" name="checked_by" class="form-control"></div>
                        <div class="form-group col-md-6"><label>หมายเหตุ</label><input type="text" name="remark" class="form-control"></div>
                        <div class="form-group col-md-12"><label>อื่นๆ</label><textarea name="others" class="form-control" rows="2"></textarea></div>
                        <div class="form-group col-md-12 mb-0">
                            <label>เอกสารแนบ</label>
                            <div class="custom-file">
                                <input type="file" name="attachment" class="custom-file-input" id="add_attachment_file">
                                <label class="custom-file-label" for="add_attachment_file">เลือกไฟล์...</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-modern">
                    <button type="button" class="btn btn-light" style="border-radius:8px;" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-indigo-add" style="box-shadow:none;"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editComputerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-modern bg-indigo-head">
                <h5 class="modal-title"><i class="fa fa-edit mr-2"></i> แก้ไขประวัติคอมพิวเตอร์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditComputer" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="edit_id">
                
                <div class="modal-body modal-body-modern">
                    <div class="row">
                        <div class="form-group col-md-6"><label>รุ่นคอมพิวเตอร์ <span class="text-danger">*</span></label><input type="text" name="model" id="edit_model" class="form-control" required></div>
                        <div class="form-group col-md-6"><label>วันที่รับ <span class="text-danger">*</span></label><input type="date" name="received_date" id="edit_received_date" class="form-control" required></div>
                        <div class="form-group col-md-6"><label>ผู้ใช้ <span class="text-danger">*</span></label><input type="text" name="user_name" id="edit_user_name" class="form-control" required></div>
                        <div class="form-group col-md-6"><label>รหัสสินทรัพย์ <span class="text-danger">*</span></label><input type="text" name="asset_code" id="edit_asset_code" class="form-control" required></div>
                        <div class="form-group col-md-6"><label>Windows</label><input type="text" name="windows_version" id="edit_windows_version" class="form-control"></div>
                        <div class="form-group col-md-6"><label>Office</label><input type="text" name="office_version" id="edit_office_version" class="form-control"></div>
                        <div class="form-group col-md-6"><label>ตรวจโดย</label><input type="text" name="checked_by" id="edit_checked_by" class="form-control"></div>
                        <div class="form-group col-md-6"><label>หมายเหตุ</label><input type="text" name="remark" id="edit_remark" class="form-control"></div>
                        <div class="form-group col-md-12"><label>อื่นๆ</label><textarea name="others" id="edit_others" class="form-control" rows="2"></textarea></div>
                        <div class="form-group col-md-12 mb-0">
                            <label>เอกสารแนบใหม่ <span class="text-muted" style="font-weight:normal;">(ปล่อยว่างไว้หากไม่ต้องการเปลี่ยนไฟล์)</span></label>
                            <div class="custom-file">
                                <input type="file" name="attachment" class="custom-file-input" id="edit_attachment_file">
                                <label class="custom-file-label" for="edit_attachment_file">เลือกไฟล์ใหม่...</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-modern">
                    <button type="button" class="btn btn-light" style="border-radius:8px;" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-indigo-add" style="box-shadow:none;"><i class="fas fa-check-circle"></i> อัปเดตข้อมูล</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
$(document).ready(function() {
    // 1. เรียกใช้งาน DataTables
    $('#tb_job').DataTable({
        "pageLength": 50,
        "lengthMenu": [[10, 25, 50, -1],[10, 25, 50, "All"]],
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', text: '<i class="fas fa-copy"></i> คัดลอก' },
            { extend: 'csv', text: '<i class="fas fa-file-csv"></i> CSV' },
            { extend: 'excel', text: '<i class="fas fa-file-excel text-success"></i> Excel' },
            { extend: 'pdf', text: '<i class="fas fa-file-pdf text-danger"></i> PDF' },
            { extend: 'print', text: '<i class="fas fa-print"></i> พิมพ์' }
        ],
        order: [[0, "asc"]],
        pagingType: "full_numbers"
    });

    // แสดงชื่อไฟล์เมื่อมีการเลือกไฟล์
    $(document).on('change', '.custom-file-input', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // ==================== [การทำงานฟอร์มเพิ่มข้อมูล] ====================
    $('#formAddComputer').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        submitForm("{{ route('computer-history.store') }}", formData);
    });

    // ==================== [ปุ่มแก้ไขคลิก: ดึงข้อมูลเก่าลงฟอร์ม] ====================
    $(document).on('click', '.btn-edit', function() {
        // ดึงข้อมูลจาก attribute data-* ของปุ่มที่ถูกคลิก
        $('#edit_id').val($(this).data('id'));
        $('#edit_model').val($(this).data('model'));
        $('#edit_received_date').val($(this).data('received_date'));
        $('#edit_user_name').val($(this).data('user_name'));
        $('#edit_asset_code').val($(this).data('asset_code'));
        $('#edit_windows_version').val($(this).data('windows_version'));
        $('#edit_office_version').val($(this).data('office_version'));
        $('#edit_checked_by').val($(this).data('checked_by'));
        $('#edit_remark').val($(this).data('remark'));
        $('#edit_others').val($(this).data('others'));
        
        // รีเซ็ตช่องเลือกไฟล์แนบในฟอร์มแก้ไขให้ว่างก่อน
        $('#editComputerModal .custom-file-input').val('');
        $('#editComputerModal .custom-file-label').html('เลือกไฟล์ใหม่...');

        // เปิด Modal แก้ไขข้อมูล
        $('#editComputerModal').modal('show');
    });

    // ==================== [การทำงานฟอร์มแก้ไขข้อมูล] ====================
    $('#formEditComputer').on('submit', function(e) {
        e.preventDefault();
        
        var id = $('#edit_id').val(); 
        var formData = new FormData(this);
        
        // แนบ _method = PUT เข้าไปใน FormData เพื่อหลอก Laravel Resource Route
        formData.append('_method', 'PUT'); 

        var url = "{{ url('computer-history') }}/" + id; 
        
        submitForm(url, formData);
    });

    // ฟังก์ชันส่วนกลางสำหรับส่งข้อมูลเพิ่ม/แก้ไข (ลดการเขียนโค้ดซ้ำ)
    function submitForm(url, data) {
        $.ajax({
            url: url,
            method: "POST", 
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function() {
                Swal.fire({
                    title: 'กำลังประมวลผล...',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'สำเร็จ!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({ icon: 'error', title: 'ผิดพลาด', text: response.message });
                }
            },
            error: function() {
                Swal.fire({ icon: 'error', title: 'ผิดพลาด', text: 'ระบบทำงานไม่สำเร็จ' });
            }
        });
    }

    // ==================== [ปุ่มลบข้อมูล: ยืนยันและส่ง AJAX] ====================
    $(document).on('click', '.btn-delete', function() {
        var id = $(this).data('id'); 
        var url = "{{ url('computer-history') }}/" + id; 

        Swal.fire({
            title: 'คุณแน่ใจไหมที่จะลบข้อมูลนี้?',
            text: "เมื่อลบแล้วจะไม่สามารถกู้คืนไฟล์หรือข้อมูลนี้ได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ใช่, ฉันต้องการลบ!',
            cancelButtonText: 'ยกเลิก',
            customClass: {
                confirmButton: 'swal-confirm-btn',
                cancelButton: 'swal-cancel-btn'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: "POST", 
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: "DELETE" 
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'กำลังลบข้อมูล...',
                            allowOutsideClick: false,
                            didOpen: () => { Swal.showLoading(); }
                        });
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบสำเร็จ!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload(); 
                            });
                        } else {
                            Swal.fire({ icon: 'error', title: 'ผิดพลาด', text: response.message });
                        }
                    },
                    error: function() {
                        Swal.fire({ icon: 'error', title: 'ผิดพลาด', text: 'ไม่สามารถลบข้อมูลได้ ระบบทำงานไม่สำเร็จ' });
                    }
                });
            }
        });
    });
});
</script>
@endpush