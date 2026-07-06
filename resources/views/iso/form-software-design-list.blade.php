@extends('layouts.main')
@section('content')

<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Indigo Modern Theme */
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #eeebff;
        --indigo-border: #e0e0fe;
        --amber-edit: #d97706;
        --amber-edit-hover: #b45309;
    }
    
    .card-modern {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(79, 70, 229, 0.05);
        overflow: hidden;
        background: #ffffff;
    }

    .card-modern .card-header {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #ffffff;
        border-bottom: none;
        padding: 1.5rem;
    }

    .card-modern .card-header h5 {
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
        width: 100% !important;
    }

    .table-modern thead th {
        background-color: var(--indigo-light);
        color: #3730a3;
        font-weight: 600;
        border: 1px solid var(--indigo-border) !important;
        padding: 14px 10px;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .table-modern tbody td {
        border: 1px solid #f3f4f6 !important;
        padding: 12px 10px;
        vertical-align: middle;
        color: #4b5563;
    }

    .table-modern tbody tr:hover {
        background-color: #f9fafb;
    }

    /* Action Buttons Design */
    .btn-action {
        border: none;
        border-radius: 8px;
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        color: white !important;
    }

    .btn-action-edit {
        background-color: var(--amber-edit);
    }
    .btn-action-edit:hover {
        background-color: var(--amber-edit-hover);
        transform: translateY(-1px);
    }

    .btn-action-approve {
        background-color: var(--indigo-primary);
    }
    .btn-action-approve:hover {
        background-color: var(--indigo-hover);
        transform: translateY(-1px);
    }

    .btn-action-delete {
        background-color: #fee2e2;
        color: #ef4444 !important;
    }
    .btn-action-delete:hover {
        background-color: #ef4444;
        color: white !important;
        transform: translateY(-1px);
    }

    .btn-add-document {
        background-color: rgba(255, 255, 255, 0.2);
        color: white !important;
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 10px;
        padding: 8px 16px;
        font-weight: 600;
        transition: all 0.2s;
        backdrop-filter: blur(5px);
    }

    .btn-add-document:hover {
        background-color: white;
        color: var(--indigo-primary) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">  
        <div class="col-12 col-xl-11">
            <div class="card card-modern">
                <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div class="text-center text-md-left">
                        <h5 class="m-0">ESSOM CO.,LTD</h5>
                        <p class="m-0 opacity-75 small">การออกแบบซอฟต์แวร์, ทบทวนและทวนสอบ (SOFTWARE DESIGN, REVIEW AND VERIFICATION)</p>
                    </div>
                    
                    <div class="d-flex align-items-center gap-3 align-self-stretch align-self-md-center justify-content-between justify-content-md-end">
                        <a href="{{ route('software-design.create') }}" class="btn btn-add-document">
                            ➕ เพิ่มเอกสารใหม่
                        </a>
                        <div style="text-align: right; font-size: 0.8rem; opacity: 0.9; line-height: 1.3;">
                            <strong>FS8302.1</strong><br>4 Nov. 24
                        </div>
                    </div>             
                </div>
                
                <div class="card-body p-4">      
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-modern text-center">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Software No</th>
                                    <th style="width: 35%">Product Name</th>
                                    <th style="width: 26%">Reference Documents</th>
                                    <th style="width: 8%">แก้ไข</th>
                                    <th style="width: 8%">อนุมัติ</th>
                                    <th style="width: 8%">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hd as $item)
                                <tr>
                                    <td class="font-weight-bold text-dark">{{ $item->software_design_hd_no }}</td>
                                    <td class="text-left px-3">{{ $item->software_design_hd_product }}</td>
                                    <td class="text-left px-3">{{ $item->software_design_hd_reference }}</td>
                                    <td>
                                        <a href="{{ route('software-design.edit', $item->software_design_hd_id) }}" class="btn-action btn-action-edit" title="แก้ไขข้อความ">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('software-design.show', $item->software_design_hd_id) }}" class="btn-action btn-action-approve" title="ตรวจสอบสิทธิ์อนุมัติ">
                                            <i class="fas fa-check-double"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn-action btn-action-delete" onclick="confirmDel('{{ $item->software_design_hd_id }}')" title="ลบรายการ">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
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

@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#tb_job').DataTable({
        "pageLength": 50,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        columnDefs: [{
            targets: 1,
            type: 'time-date-sort'
        }],
        order: [
            [0, "asc"]
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
        pagingType: "full_numbers",
        bSort: true,    
    });
});

// ✅ ปรับ SweetAlert คอนเฟิร์มการลบให้เป็นโทน Indigo สอดคล้องกับธีมหลัก
confirmDel = (refid) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการลบรายการดีไซน์ซอฟต์แวร์นี้ออกจากระบบใช่หรือไม่ ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยันการลบ',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            confirmButton: 'btn btn-indigo mx-2 px-4 py-2',
            cancelButton: 'btn btn-secondary mx-2 px-4 py-2'
        },
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelSoftwareDesignHd') }}`,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "refid": refid
                },
                dataType: "json",
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire({
                            title: 'สำเร็จ',
                            text: 'ลบรายการเอกสารเรียบร้อยแล้ว',
                            icon: 'success',
                            confirmButtonColor: '#4f46e5'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'ไม่สามารถลบเอกสารได้ กรุณาลองใหม่อีกครั้ง',
                            icon: 'error',
                            confirmButtonColor: '#4f46e5'
                        });
                    }
                }
            });
        }
    });
}
</script>
@endpush