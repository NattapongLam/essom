@extends('layouts.main')
@section('content')

{{-- @push('styles') --}}
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}

<style>
    /* Modern Indigo Theme Setup */
    .custom-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05);
        border: 1px solid #e2e8f0;
        margin-top: 30px;
        margin-bottom: 30px;
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
        overflow: hidden;
    }
    
    .card-header-modern {
        background-color: #ffffff;
        padding: 2rem 2.5rem 1.5rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .title-block h5 {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
        font-size: 1.4rem;
        line-height: 1.4;
    }

    .doc-meta {
        font-size: 0.85rem;
        color: #64748b;
        text-align: right;
        line-height: 1.4;
    }

    /* Action Button - Create Data */
    .btn-indigo-add {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: #ffffff !important;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.2s ease;
    }
    .btn-indigo-add:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    /* Table Responsive Style */
    .table-responsive-container {
        padding: 1.5rem 2.5rem 2.5rem 2.5rem;
    }
    
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    table.table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
        color: #334155;
        margin-bottom: 0 !important;
    }
    
    table.table-modern th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 700;
        border-bottom: 2px solid #e2e8f0;
        padding: 14px 10px;
        text-transform: uppercase;
        font-size: 0.85rem;
    }

    table.table-modern td {
        padding: 12px 10px;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
    }

    table.table-modern tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Status Badges */
    .status-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        text-align: center;
    }
    
    .badge-review-pending {
        background-color: #fffbeb;
        color: #d97706;
        border: 1px solid #fde68a;
    }
    
    .badge-approve-pending {
        background-color: #e0e7ff;
        color: #4f46e5;
        border: 1px solid #c7d2fe;
    }
    
    .badge-approved-success {
        background-color: #f0fdf4;
        color: #16a34a;
        border: 1px solid #bbf7d0;
    }

    /* Operational Action Buttons */
    .btn-action-edit {
        background-color: #f1f5f9;
        color: #4f46e5;
        border: 1px solid #e2e8f0;
        padding: 6px 10px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-action-edit:hover {
        background-color: #4f46e5;
        color: #ffffff;
        border-color: #4f46e5;
    }

    .btn-action-delete {
        background-color: #fff5f5;
        color: #e53e3e;
        border: 1px solid #fed7d7;
        padding: 6px 10px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-action-delete:hover {
        background-color: #e53e3e;
        color: #ffffff;
        border-color: #e53e3e;
    }

    /* DataTable Overrides to Match Indigo Theme */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #4f46e5 !important;
        color: white !important;
        border: 1px solid #4f46e5 !important;
        border-radius: 6px;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #cbd5e1 !important;
        border-radius: 6px !important;
        padding: 5px 10px !important;
    }

    @media (max-width: 768px) {
        .header-container { flex-direction: column; text-align: center; }
        .doc-meta { text-align: center; margin-top: 5px; }
        .table-responsive-container { padding: 1rem; }
    }
</style>

<div class="container-fluid">
    <div class="card custom-card">
        
        <div class="card-header-modern">
            <div class="header-container">
                <div class="title-block">
                    <h5>บริษัท เอสซอม จำกัด<br>ใบขอทำลายเอกสาร</h5>
                </div>
                <div>
                    <a href="{{ route('document-destruction.create') }}" class="btn-indigo-add">
                        <i class="fas fa-plus"></i> เพิ่มเอกสารทำลาย
                    </a>
                </div>
                <div class="doc-meta">
                    <strong>F7530.4</strong><br>1 May. 17
                </div>
            </div>
        </div>

        <div class="table-responsive-container">
            <div class="table-responsive">
                <table id="tb_job" class="table table-modern text-center">
                    <thead>
                        <tr>
                            <th style="width: 15%">วันที่</th>
                            <th style="width: 20%">เรียน</th>
                            <th style="width: 20%">จาก</th>
                            <th style="width: 20%">ผู้ขออนุมัติ</th>
                            <th style="width: 15%">สถานะ / อนุมัติ</th>
                            <th style="width: 10%">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hd as $item)
                            <tr>
                                <td class="font-weight-bold" style="color: #1e293b;">{{ $item->documentdestruction_hd_date }}</td>
                                <td>{{ $item->documentdestruction_hd_to }}</td>
                                <td>{{ $item->documentdestruction_hd_from }}</td>
                                <td>{{ $item->requested_by }}</td>
                                <td>
                                    @if ($item->reviewed_status == "N")
                                        @if ($item->reviewed_by == auth()->user()->name)
                                            <a href="{{ route('document-destruction.show', $item->documentdestruction_hd_id) }}" class="btn-action-edit" title="ทบทวนเอกสาร">
                                                <i class="fas fa-edit"></i> ทบทวน
                                            </a>
                                        @else
                                            <span class="status-badge badge-review-pending">รอทบทวน</span>
                                        @endif
                                    @elseif($item->reviewed_status == "Y")
                                        @if ($item->approved_by == auth()->user()->name)
                                            <a href="{{ route('document-destruction.show', $item->documentdestruction_hd_id) }}" class="btn-action-edit" title="อนุมัติเอกสาร">
                                                <i class="fas fa-edit"></i> อนุมัติ
                                            </a>
                                        @else
                                            <span class="status-badge badge-approve-pending">รออนุมัติ</span>
                                        @endif
                                    @else
                                        <span class="status-badge badge-approved-success">อนุมัติแล้ว</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->reviewed_status == "N")
                                            <a href="{{ route('document-destruction.edit', $item->documentdestruction_hd_id) }}" class="btn-action-edit" title="ทบทวนเอกสาร">
                                                <i class="fas fa-edit"></i> แก้ไข
                                            </a>
                                    @endif
                                    <a href="javascript:void(0)" class="btn-action-delete" onclick="confirmDel('{{ $item->documentdestruction_hd_id }}')" title="ลบรายการ">
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

confirmDel = (refid) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: 'คุณต้องการลบใบขอทำลายเอกสารรายการนี้หรือไม่ ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        confirmButtonClass: 'btn btn-success px-4 py-2 text-white font-weight-bold rounded',
        cancelButtonClass: 'btn btn-danger ms-2 px-4 py-2 text-white font-weight-bold rounded',
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelDestruction') }}`,
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
                            icon: 'success',
                            confirmButtonColor: '#4f46e5'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'ยกเลิกเอกสารไม่สำเร็จ',
                            icon: 'error',
                            confirmButtonColor: '#dc2626'
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิกแล้ว',
                text: 'โปรดตรวจสอบข้อมูลอีกครั้งเพื่อความถูกต้อง :)',
                icon: 'error',
                confirmButtonColor: '#dc2626'
            });
        }
    });
}
</script>
@endpush