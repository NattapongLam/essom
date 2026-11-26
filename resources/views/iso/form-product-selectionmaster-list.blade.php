@extends('layouts.main')
@section('content')

<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Theme Customizations */
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #e0e7ff;
        --indigo-bg: #f8fafc;
        --text-dark: #1e293b;
    }

    body {
        background-color: var(--indigo-bg);
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.08);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 2rem;
    }

    .company-title {
        color: var(--indigo-primary);
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .doc-subtitle {
        color: var(--text-dark);
        font-weight: 500;
        font-size: 1.1rem;
    }

    /* Table Styling */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
        width: 100% !important;
    }

    .table-modern thead th, .table-modern thead td {
        background-color: var(--indigo-light) !important;
        color: #312e81 !important;
        font-weight: 600;
        border: none !important;
        padding: 12px 8px !important;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .table-modern tbody tr {
        transition: all 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background-color: #fafafa !important;
        transform: translateY(-1px);
    }

    .table-modern td {
        padding: 14px 8px !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
        border-top: none !important;
        border-left: none !important;
        border-right: none !important;
        color: #475569;
    }

    /* Buttons Styling */
    .btn-indigo {
        background-color: var(--indigo-primary);
        color: white !important;
        border-radius: 8px;
        font-weight: 500;
        padding: 0.5rem 1.2rem;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-indigo:hover {
        background-color: var(--indigo-hover);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
    }

    .btn-indigo-outline {
        border: 1.5px solid var(--indigo-primary);
        color: var(--indigo-primary) !important;
        border-radius: 8px;
        font-weight: 500;
        padding: 0.5rem 1.2rem;
        transition: all 0.2s ease;
        background: transparent;
    }

    .btn-indigo-outline:hover {
        background-color: var(--indigo-light);
        color: var(--indigo-hover) !important;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0 !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px !important;
        border: none !important;
        transition: all 0.2s ease;
    }

    .btn-action:hover {
        transform: scale(1.08);
    }

    /* DataTables Custom Overrides */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--indigo-primary) !important;
        color: white !important;
        border: none !important;
        border-radius: 6px;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 5px 10px;
        outline: none;
    }
    
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--indigo-primary);
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="custom-card-header">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="text-left">
                            <a href="{{ route('product-selection-master.create') }}" class="btn btn-indigo">
                                <i class="fas fa-plus mr-2"></i> เพิ่มเอกสาร
                            </a>
                        </div>
                        <div class="text-center flex-grow-1">
                            <h4 class="company-title mb-1">ESSOM CO.,LTD</h4>
                            <h5 class="doc-subtitle">ตั้งค่าใบคัดเลือกสินค้า/ผู้ขายและประเมิน (SUPPLIER QUALIFICATION AND EVALUATION)</h5>
                        </div>
                    </div>                             
                </div>

                <div class="card-body p-4">             
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-modern text-center">
                            <thead>
                                <tr>
                                    <th>ประเภทสินค้า</th>
                                    <th>ประเภทจัดซื้อ</th>
                                    <th>กลุ่มสินค้า</th>
                                    <th>แผนก</th>
                                    <th>แก้ไข</th>
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hd as $item)
                                    <tr>
                                        <td>{{$item->product_type1}},{{$item->product_type2}},{{$item->product_type3}},{{$item->product_type4}}</td>
                                        <td>{{$item->productselection_master_hds_type}}</td>
                                        <td>{{$item->productselection_master_hds_group}}</td>
                                        <td>{{$item->productselection_master_hds_department}}</td>
                                        <td>
                                            <a href="{{route('product-selection-master.edit',$item->productselection_master_hds_id)}}" class="btn btn-action btn-sm" style="background-color: #6366f1; color: white;" title="แก้ไข">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                             <a href="javascript:void(0)" class="btn btn-action btn-sm" style="background-color: #ef4444; color: white;"  
                                               onclick="confirmDel('{{ $item->productselection_master_hds_id }}')" title="ลบ">
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
            targets: 1,
            type: 'time-date-sort'
        }],
        order: [
            [1, "asc"]
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
        pagingType: "full_numbers",
        bSort: true,    
    });
});

// ฟังก์ชัน SweetAlert2 ปรับธีมให้เข้ากับโทนสีม่วง Indigo
const customSwal = Swal.mixin({
    confirmButtonColor: '#4f46e5',
    cancelButtonColor: '#ef4444',
    customClass: {
        popup: 'border-radius-16'
    }
});

confirmDel = (refid) => {       
    customSwal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการลบรายการนี้หรือไม่ ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelProductSelectionMaster') }}`,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "refid": refid
                },
                dataType: "json",
                success: function(data) {
                    if (data.status == true) {
                        customSwal.fire({
                            title: 'สำเร็จ',
                            text: 'ยกเลิกเอกสารเรียบร้อยแล้ว',
                            icon: 'success'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        customSwal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'ยกเลิกเอกสารไม่สำเร็จ',
                            icon: 'error'
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            customSwal.fire({
                title: 'ยกเลิก',
                text: 'โปรดตรวจสอบข้อมูลอีกครั้งเพื่อความถูกต้อง :)',
                icon: 'error'
            });
        }
    });
}
</script>
@endpush