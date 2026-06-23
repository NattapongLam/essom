@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<div class="mt-4"><br>
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h5>ESSOM CO.,LTD<br>ประวัติคอมพิวเตอร์</h5>
                    <p class="text-right">F7134.1<br>9 Jun. 16</p>              
                </div>
                <div class="card-body"> 
                    <div class="mb-3 text-right">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addComputerModal">
                            <i class="fa fa-plus"></i> เพิ่มข้อมูลคอมพิวเตอร์
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table id="tb_job" class="table table-bordered table-sm text-center">
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
                                    <th>จัดการ</th> {{-- เปลี่ยนจาก "ลบ" เป็น "จัดการ" --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($computers as $key => $row)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $row->model }}</td>
                                    <td>{{ $row->received_date }}</td>
                                    <td>{{ $row->user_name }}</td>
                                    <td>{{ $row->asset_code }}</td>
                                    <td>{{ $row->windows_version }}</td>
                                    <td>{{ $row->office_version }}</td>
                                    <td>{{ $row->checked_by }}</td>
                                    <td>{{ $row->remark }}</td>
                                    <td>{{ $row->others }}</td>
                                    <td>
                                        @if($row->attachment)
                                            <a href="{{ asset('img/computers/'.$row->attachment) }}" target="_blank" class="btn btn-info btn-xs">ดูไฟล์</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm btn-edit" 
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
                                            แก้ไข
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $row->id }}">ลบ</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addComputerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่มประวัติคอมพิวเตอร์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formAddComputer" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6"><label>รุ่นคอมพิวเตอร์ <span class="text-danger">*</span></label><input type="text" name="model" class="form-control" required></div>
                        <div class="form-group col-md-6"><label>วันที่รับ <span class="text-danger">*</span></label><input type="date" name="received_date" class="form-control" required></div>
                        <div class="form-group col-md-6"><label>ผู้ใช้ <span class="text-danger">*</span></label><input type="text" name="user_name" class="form-control" required></div>
                        <div class="form-group col-md-6"><label>รหัสสินทรัพย์ <span class="text-danger">*</span></label><input type="text" name="asset_code" class="form-control" required></div>
                        <div class="form-group col-md-6"><label>Windows</label><input type="text" name="windows_version" class="form-control"></div>
                        <div class="form-group col-md-6"><label>Office</label><input type="text" name="office_version" class="form-control"></div>
                        <div class="form-group col-md-6"><label>ตรวจโดย</label><input type="text" name="checked_by" class="form-control"></div>
                        <div class="form-group col-md-6"><label>หมายเหตุ</label><input type="text" name="remark" class="form-control"></div>
                        <div class="form-group col-md-12"><label>อื่นๆ</label><textarea name="others" class="form-control" rows="2"></textarea></div>
                        <div class="form-group col-md-12">
                            <label>เอกสารแนบ</label>
                            <div class="custom-file">
                                <input type="file" name="attachment" class="custom-file-input">
                                <label class="custom-file-label">เลือกไฟล์...</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editComputerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title">แก้ไขประวัติคอมพิวเตอร์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditComputer" enctype="multipart/form-data">
                @csrf
                {{-- ส่วนสำคัญ: ใช้สำหรับอ้างอิง ID ที่ต้องการแก้ไข --}}
                <input type="hidden" name="id" id="edit_id">
                
                <div class="modal-body">
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
                        <div class="form-group col-md-12">
                            <label>เอกสารแนบใหม่ (ปล่อยว่างไว้หากไม่ต้องการเปลี่ยนไฟล์)</label>
                            <div class="custom-file">
                                <input type="file" name="attachment" class="custom-file-input">
                                <label class="custom-file-label">เลือกไฟล์ใหม่...</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-warning">อัปเดตข้อมูล</button>
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
        buttons: ['copy','csv','excel','pdf','print'],
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
        
        var id = $('#edit_id').val(); // ดึงค่า ID ที่ต้องการแก้ไข
        var formData = new FormData(this);
        
        // 1. สำคัญมาก: แนบ _method = PUT เข้าไปใน FormData เพื่อหลอก Laravel Resource Route 
        // เนื่องจากฟอร์มที่มีการอัปโหลดไฟล์ (multipart/form-data) จะไม่สามารถส่งด้วย Method PUT ตรง ๆ ผ่าน AJAX ได้
        formData.append('_method', 'PUT'); 

        // 2. ทำการสร้าง URL ให้ตรงตามมาตรฐาน Resource (เช่น /computer-history/5)
        var url = "{{ url('computer-history') }}/" + id; 
        
        // ส่งข้อมูลไปยังฟังก์ชันส่วนกลาง
        submitForm(url, formData);
    });

    // ฟังก์ชันส่วนกลางสำหรับส่งข้อมูล (ลดการเขียนโค้ดซ้ำ)
    function submitForm(url, data) {
        $.ajax({
            url: url,
            method: "POST", // ใช้ POST เสมอ (Laravel จะไปอ่านค่า _method: PUT ข้างในเอง)
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
});
// ==================== [ปุ่มลบข้อมูล: ยืนยันและส่ง AJAX] ====================
    $(document).on('click', '.btn-delete', function() {
        var id = $(this).data('id'); // ดึง ID จาก attribute data-id ของปุ่ม
        var url = "{{ url('computer-history') }}/" + id; // สร้าง URL เช่น /computer-history/5

        Swal.fire({
            title: 'คุณแน่ใจไหมที่จะลบข้อมูลนี้?',
            text: "เมื่อลบแล้วจะไม่สามารถกู้คืนไฟล์หรือข้อมูลนี้ได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ฉันต้องการลบ!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                // ยิง AJAX สำหรับลบข้อมูล
                $.ajax({
                    url: url,
                    method: "POST", // ใช้ POST และส่ง _method: DELETE ข้างใน
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: "DELETE" // สำคัญมากสำหรับ Resource Controller ฟังก์ชัน destroy
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
                                location.reload(); // รีโหลดหน้าจอเพื่ออัปเดตตาราง
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
</script>
@endpush