@extends('layouts.main')
@section('content')
{{-- @push('styles') --}}
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}

<style>
    /* Custom Indigo Modern Theme */
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #e0e7ff;
        --text-dark: #1e1b4b;
        --border-radius-custom: 12px;
    }

    .custom-card {
        border: none;
        border-radius: var(--border-radius-custom);
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.1), 0 8px 10px -6px rgba(79, 70, 229, 0.1);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #6366f1, var(--indigo-primary));
        color: #ffffff;
        padding: 1.5rem;
        border-bottom: none;
    }

    .custom-card-header h5 {
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .doc-code {
        font-size: 0.85rem;
        opacity: 0.85;
        font-weight: 300;
    }

    /* Form Controls Styling */
    .form-group label {
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .custom-form-control {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 0.55rem 0.75rem;
        font-size: 0.9rem;
        color: var(--text-dark);
        transition: all 0.2s ease-in-out;
    }

    .custom-form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        outline: none;
    }

    /* Table Dynamic Styling */
    .modern-table {
        border-collapse: separate;
        border-spacing: 0 6px;
    }

    .modern-table thead th {
        background-color: #f8fafc !important;
        color: #64748b;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 8px !important;
        border: none !important;
    }

    .modern-table tbody tr {
        background-color: #f8fafc;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        transition: transform 0.2s;
    }

    .modern-table tbody tr:hover {
        transform: translateY(-1px);
        background-color: #f1f5f9;
    }

    .modern-table tbody td {
        padding: 8px !important;
        vertical-align: middle !important;
        border: none !important;
    }

    .modern-table tbody td:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    .modern-table tbody td:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    /* Buttons Concept */
    .btn-indigo-action {
        background-color: #ffffff;
        color: var(--indigo-primary) !important;
        font-weight: 600;
        border: 1.5px solid var(--indigo-primary);
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        transition: all 0.2s ease;
    }

    .btn-indigo-action:hover {
        background-color: var(--indigo-light);
        transform: translateY(-1px);
    }

    .btn-indigo-submit {
        background: linear-gradient(135deg, #6366f1, var(--indigo-primary));
        color: #ffffff !important;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        padding: 0.6rem 2rem;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.25);
        transition: all 0.2s ease;
    }

    .btn-indigo-submit:hover {
        box-shadow: 0 6px 15px rgba(79, 70, 229, 0.4);
        transform: translateY(-1px);
    }

    .btn-row-delete {
        background-color: #fee2e2;
        color: #dc2626;
        border: none;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s;
    }

    .btn-row-delete:hover {
        background-color: #fecaca;
        color: #b91c1c;
        transform: scale(1.05);
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div class="text-center text-md-left mb-3 mb-md-0">
                            <h5 class="m-0">แก้ไขทะเบียนรับเข้าเอกสารจากภายนอก</h5>
                            <span class="doc-code">ฟอร์มเอกสาร: F7531.1 (27 Sep. 23)</span>
                        </div>
                        <div>
                            <a href="{{ route('document-external.index') }}" class="btn btn-sm btn-light text-dark" style="border-radius: 8px; font-weight: 500;">
                                <i class="fas fa-arrow-left mr-1"></i> ย้อนกลับ
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">   
                    {{-- <form method="POST" action="{{ route('document-external.update', $hd->documentexternal_hd_id) }}" enctype="multipart/form-data">
                        @csrf      
                        @method('PUT')  --}}
                        
                        <div class="row">
                            <div class="col-12 col-md-4 form-group">
                                <label for="ms_year_name">ปีเอกสาร <span class="text-danger">*</span></label>
                                <select class="form-control custom-form-control" name="ms_year_name" required>
                                    <option value="">-- กรุณาเลือกปี --</option>      
                                    @foreach ($year as $item)
                                        <option value="{{$item->ms_year_name}}" {{ $item->ms_year_name == $hd->ms_year_name ? 'selected' : '' }}>
                                            {{$item->ms_year_name}}
                                        </option> 
                                    @endforeach 
                                </select>
                            </div> 
                        </div>

                        <hr class="my-4" style="border-top: 1px dashed #cbd5e1;">

                        <!-- ส่วนหัวข้อและการค้นหา -->
                        <div class="row align-items-center mb-3">
                            <div class="col-12 col-md-5 mb-2 mb-md-0">
                                <h6 class="m-0 font-weight-bold" style="color: var(--text-dark);">รายการเอกสารแนบ (แก้ไข)</h6>
                            </div>
                            <div class="col-12 col-md-7 d-flex justify-content-md-end align-items-center">
                                <!-- ช่องค้นหาข้อมูลในตาราง -->
                                <div class="input-group mr-2" style="max-width: 280px;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white custom-form-control border-right-0" style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="tableSearchInput" class="form-control custom-form-control border-left-0" placeholder="ค้นหาในตาราง..." onkeyup="filterTable()" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                </div>
                                <button type="button" class="btn btn-sm btn-indigo-action text-nowrap" onclick="addRow()">
                                    <i class="fas fa-plus-circle mr-1"></i> เพิ่มแถวเอกสาร
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
    <table class="table modern-table text-center w-100" id="destroyTable">
        <thead>
            <tr>
                <th style="width: 5%">ลำดับ</th>
                <th style="width: 10%">รับเอกสาร</th>
                <th style="width: 10%">ส่งจาก</th>
                <th style="width: 11%">แผนก/ถึง</th>
                <th style="width: 22%">เรื่อง</th>
                <th style="width: 10%">วิธีการส่ง</th>
                <th style="width: 7%">จน.แผ่น</th>
                <th style="width: 7%">ชุดเอกสาร</th>
                <th style="width: 15%">ผู้รับ/หมายเหตุ</th>
                <th style="width: 3%">ลบ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dt as $index => $item)
                <tr>
                    <td class="text-center font-weight-bold row-number" style="color: #64748b;">
                        {{ $index + 1 }}
                    </td>
                    <td>
                        <input type="hidden" name="dt_id[]" class="dt-id" value="{{ $item->documentexternal_dt_id }}">
                        <input type="text" class="form-control custom-form-control auto-save" placeholder="รับเอกสาร" name="documentdestruction_dt_receive[]" value="{{ $item->documentdestruction_dt_receive }}">
                    </td>
                    <td>
                        <input type="text" class="form-control custom-form-control auto-save" placeholder="ส่งจาก" name="documentdestruction_dt_sentfrom[]" value="{{ $item->documentdestruction_dt_sentfrom }}">
                    </td>
                    <td>
                        <input type="text" class="form-control custom-form-control auto-save" placeholder="แผนก/ถึง" name="documentdestruction_dt_department[]" value="{{ $item->documentdestruction_dt_department }}">
                    </td>
                    <td>
                        <textarea class="form-control custom-form-control auto-save" rows="1" placeholder="เรื่อง..." name="documentdestruction_dt_subject[]" style="resize: vertical; min-height: 38px;">{{ $item->documentdestruction_dt_subject }}</textarea>
                    </td>
                    <td>
                        <input type="text" class="form-control custom-form-control auto-save" placeholder="วิธีการส่ง" name="documentdestruction_dt_howtosend[]" value="{{ $item->documentdestruction_dt_howtosend }}">
                    </td>
                    <td>
                        <input type="number" class="form-control custom-form-control text-center auto-save" placeholder="0" name="documentdestruction_dt_until[]" value="{{ $item->documentdestruction_dt_until }}">
                    </td>
                    <td>
                        <input type="text" class="form-control custom-form-control text-center auto-save" placeholder="1" name="documentdestruction_dt_set[]" value="{{ $item->documentdestruction_dt_set }}">
                    </td>
                    <td>
                        <textarea class="form-control custom-form-control auto-save" rows="1" placeholder="หมายเหตุ..." name="documentdestruction_dt_recipient[]" style="resize: vertical; min-height: 38px;">{{ $item->documentdestruction_dt_recipient }}</textarea>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn-row-delete" onclick="confirmDel('{{ $item->documentexternal_dt_id }}', this)" title="ลบแถวนี้จากระบบ">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>    
                        
                        {{-- <div class="row mt-4">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-indigo-submit">
                                    <i class="fas fa-save mr-1"></i> อัปเดตข้อมูลทั้งหมด
                                </button>
                            </div>
                        </div>
                    </form>     --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}"></script>
<script>
// ✅ ฟังก์ชันบันทึกข้อมูลรายแถวอัตโนมัติเมื่อผู้ใช้พิมพ์เสร็จและคลิกออก (blur)
$(document).on('change blur', '.auto-save', function() {
    const row = $(this).closest('tr');
    saveRowData(row);
});

function saveRowData(row) {
    const hdId = "{{ $hd->documentexternal_hd_id }}";
    const dtId = row.find('.dt-id').val() || '';
    const receive = row.find('input[name="documentdestruction_dt_receive[]"]').val();
    const sentfrom = row.find('input[name="documentdestruction_dt_sentfrom[]"]').val();
    const department = row.find('input[name="documentdestruction_dt_department[]"]').val();
    const subject = row.find('textarea[name="documentdestruction_dt_subject[]"]').val();
    const howtosend = row.find('input[name="documentdestruction_dt_howtosend[]"]').val();
    const until = row.find('input[name="documentdestruction_dt_until[]"]').val();
    const set = row.find('input[name="documentdestruction_dt_set[]"]').val();
    const recipient = row.find('textarea[name="documentdestruction_dt_recipient[]"]').val();

    // ทำเครื่องหมายว่ากำลังบันทึก (เปลี่ยนสีขอบช่องนิดหน่อยให้รู้ว่าระบบกำลังทำงาน)
    row.find('.custom-form-control').css('border-color', '#fbbf24');

    $.ajax({
        url: `{{ url('/document-external/save-row') }}/${hdId}`,
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "dt_id": dtId,
            "documentdestruction_dt_receive": receive,
            "documentdestruction_dt_sentfrom": sentfrom,
            "documentdestruction_dt_department": department,
            "documentdestruction_dt_subject": subject,
            "documentdestruction_dt_howtosend": howtosend,
            "documentdestruction_dt_until": until,
            "documentdestruction_dt_set": set,
            "documentdestruction_dt_recipient": recipient
        },
        dataType: "json",
        success: function(response) {
            if (response.status) {
                // คืนสีขอบช่องปกติ และแสดง Toast แจ้งเตือนว่าบันทึกแล้ว
                row.find('.custom-form-control').css('border-color', '#10b981'); // สีเขียวชั่วคราว
                setTimeout(() => {
                    row.find('.custom-form-control').css('border-color', '');
                }, 1500);

                showToast('บันทึกข้อมูลเรียบร้อย', 'success');

                if (!dtId && response.dt_id) {
                    row.find('.dt-id').val(response.dt_id);
                    row.find('.btn-row-delete').attr('onclick', `confirmDel('${response.dt_id}', this)`);
                }
            }
        },
        error: function(xhr) {
            row.find('.custom-form-control').css('border-color', '#ef4444'); // สีแดงถ้าบันทึกไม่ผ่าน
            showToast('บันทึกไม่สำเร็จ', 'error');
        }
    });
}

// ✅ ฟังก์ชันแสดง Toast แจ้งเตือนมุมจอแบบไม่กวนการทำงาน
function showToast(message, iconType) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true
    });
    Toast.fire({
        icon: iconType,
        title: message
    });
}

// ✅ ฟังก์ชันเพิ่มแถวใหม่
function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td class="text-center font-weight-bold row-number" style="color: #64748b;">
            ${rowCount}
        </td>
        <td>
            <input type="hidden" name="dt_id[]" class="dt-id" value="">
            <input type="text" class="form-control custom-form-control auto-save" placeholder="รับเอกสาร" name="documentdestruction_dt_receive[]">
        </td>
        <td>
            <input type="text" class="form-control custom-form-control auto-save" placeholder="ส่งจาก" name="documentdestruction_dt_sentfrom[]">
        </td>
        <td>
            <input type="text" class="form-control custom-form-control auto-save" placeholder="แผนก/ถึง" name="documentdestruction_dt_department[]">
        </td>
        <td>
            <textarea class="form-control custom-form-control auto-save" rows="1" placeholder="เรื่อง..." name="documentdestruction_dt_subject[]" style="resize: vertical; min-height: 38px;"></textarea>
        </td>
        <td>
            <input type="text" class="form-control custom-form-control auto-save" placeholder="วิธีการส่ง" name="documentdestruction_dt_howtosend[]">
        </td>
        <td>
            <input type="number" class="form-control custom-form-control text-center auto-save" placeholder="0" name="documentdestruction_dt_until[]">
        </td>
        <td>
            <input type="text" class="form-control custom-form-control text-center auto-save" placeholder="1" name="documentdestruction_dt_set[]">
        </td>
        <td>
            <textarea class="form-control custom-form-control auto-save" rows="1" placeholder="หมายเหตุ..." name="documentdestruction_dt_recipient[]" style="resize: vertical; min-height: 38px;"></textarea>
        </td>
        <td class="text-center">
            <button type="button" class="btn-row-delete" onclick="confirmDel('', this)" title="ลบแถวนี้">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    `;

    tableBody.appendChild(row);
    updateRowNumbers();
}

// ✅ ฟังก์ชันจัดระเบียบเลขข้อ
function updateRowNumbers() {
    document.querySelectorAll("#destroyTable tbody tr").forEach((row, index) => {
        const number = index + 1;
        const rowNumDisplay = row.querySelector(".row-number");
        if(rowNumDisplay) rowNumDisplay.textContent = number;
    });
}

// ✅ ฟังก์ชันลบแถว
function confirmDel(refid, button) { 
    if(!refid) {
        $(button).closest("tr").remove();
        updateRowNumbers();
        return;
    }

    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการลบรายการเอกสารย่อยนี้ออกจากระบบใช่หรือไม่ ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        confirmButtonColor: '#4f46e5',
        cancelButtonColor: '#ef4444'
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelExternalDt') }}`,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "refid": refid
                },
                dataType: "json",
                success: function(data) {
                    if (data.status == true) {
                        const row = button.closest("tr");
                        row.remove();
                        updateRowNumbers();
                        showToast('ลบข้อมูลสำเร็จ', 'success');
                    }
                }
            });
        }
    });
}
</script>
@endpush