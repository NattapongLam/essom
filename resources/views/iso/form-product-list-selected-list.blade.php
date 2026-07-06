@extends('layouts.main')
@section('content')

<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Modern Indigo Theme */
    :root {
        --primary-indigo: #6366f1;
        --primary-hover: #4f46e5;
        --bg-light: #f8fafc;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --danger-color: #ef4444;
        --danger-hover: #dc2626;
        --warning-color: #f59e0b;
        --warning-hover: #d97706;
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(99, 102, 241, 0.06);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 24px;
    }

    .form-title {
        color: var(--primary-indigo);
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .doc-info-block {
        background: #f8fafc;
        border: 1px solid var(--border-color);
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-muted);
        display: inline-block;
        text-align: right;
    }

    .doc-info-block strong {
        color: var(--primary-indigo);
    }

    /* Modern Table Styling */
    .modern-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100% !important;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border-color);
    }
    
    .modern-table thead th {
        background-color: #f1f5f9 !important;
        color: var(--text-dark) !important;
        font-weight: 600 !important;
        font-size: 0.9rem !important;
        border-bottom: 2px solid var(--border-color) !important;
        padding: 14px 10px !important;
    }
    
    .modern-table td {
        padding: 12px 10px !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
        background: #fff;
        color: #334155;
        font-size: 0.95rem;
    }
    
    .modern-table tbody tr:hover td {
        background-color: #f8fafc !important;
    }

    /* Action Buttons Custom */
    .btn-action-edit {
        background-color: #fef3c7;
        color: var(--warning-hover);
        border: 1px solid #fde68a;
        border-radius: 8px;
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .btn-action-edit:hover {
        background-color: var(--warning-color);
        color: white;
        border-color: var(--warning-color);
    }

    .btn-action-delete {
        background-color: #fee2e2;
        color: var(--danger-hover);
        border: 1px solid #fca5a5;
        border-radius: 8px;
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .btn-action-delete:hover {
        background-color: var(--danger-color);
        color: white;
        border-color: var(--danger-color);
    }

    .btn-indigo-add {
        background-color: var(--primary-indigo);
        color: white;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        transition: all 0.2s ease-in-out;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-indigo-add:hover {
        background-color: var(--primary-hover);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.3);
    }

    /* DataTables Custom Controls Override */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--primary-indigo) !important;
        color: #fff !important;
        border-color: var(--primary-indigo) !important;
        border-radius: 6px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: var(--primary-hover) !important;
        color: #fff !important;
        border-radius: 6px !important;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid var(--border-color) !important;
        border-radius: 8px !important;
        padding: 6px 12px !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--primary-indigo) !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <div class="text-center text-md-left">
                            <small class="text-muted font-weight-bold uppercase">ESSOM CO., LTD</small>
                            <h4 class="form-title mb-0 mt-1">บัญชีรายชื่อสินค้าและผู้ขายที่ได้รับการยอมรับแล้ว</h4>
                            <span class="text-muted" style="font-size: 0.9rem;">APPROVED SUPPLIER LIST</span>
                        </div>
                        <div class="doc-info-block">
                            <div>รหัส: <strong>F8411.3</strong></div>
                            <div class="small text-muted font-weight-normal">วันที่ฉบับ: 10 Jul. 20</div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-start mt-4">
                        <a href="{{route('product-list-selected.create')}}" class="btn-indigo-add">
                            <i class="fas fa-plus"></i> เพิ่มเอกสารใหม่
                        </a>
                    </div>
                </div>
                
                <div class="card-body p-4">     
                    <div class="table-responsive">
                        <table id="tb_job" class="table modern-table text-center">
                            <thead>
                                <tr>
                                    <th class="text-left" style="width: 70%; padding-left: 24px !important;">PRODUCT GROUP</th>
                                    <th style="width: 15%;">แก้ไข</th>
                                    <th style="width: 15%;">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hd as $item)
                                    <tr>
                                        <td class="text-left font-weight-bold" style="padding-left: 24px !important; color: var(--text-dark);">
                                            {{$item->product_list_selected_hd_product}}
                                        </td>
                                        <td>
                                            <a href="{{route('product-list-selected.edit',$item->product_list_selected_hd_id)}}" class="btn-action-edit" title="แก้ไข">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn-action-delete" title="ลบ" onclick="confirmDel('{{ $item->product_list_selected_hd_id }}')">
                                                <i class="fas fa-trash"></i>
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
<!-- Sweet Alerts js -->
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
            targets: 0,
            type: 'string'
        }],
        order: [
            [0, "asc"] // เปลี่ยนลำดับการจัดเรียงจาก index 1 (ปุ่มแก้ไข) ไปเป็น index 0 (ชื่อกลุ่มสินค้า) เพื่อความถูกต้อง
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
        pagingType: "full_numbers",
        bSort: true,    
    });
});

confirmDel = (refid) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการลบรายการนี้หรือไม่ ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        confirmButtonClass: 'btn btn-success mt-2',
        cancelButtonClass: 'btn btn-danger ms-2 mt-2',
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelProductListSelectedHd') }}`,
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
                            text: 'ยกเลิกเอกสารเรียบร้อยแล้ว',
                            icon: 'success'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'ยกเลิกเอกสารไม่สำเร็จ',
                            icon: 'error'
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิก',
                text: 'โปรดตรวจสอบข้อมูลอีกครั้งเพื่อความถูกต้อง :)',
                icon: 'error'
            });
        }
    });
}
</script>
@endpush