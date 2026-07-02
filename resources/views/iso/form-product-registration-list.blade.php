@extends('layouts.main')
@section('content')

{{-- @push('styles') --}}
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

    /* Header Container Design */
    .card-header-modern {
        background-color: #ffffff;
        padding: 2rem 2.5rem 1.5rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-title-block h5 {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
        font-size: 1.35rem;
        line-height: 1.4;
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

    .action-header-bar {
        margin-top: 20px;
        display: flex;
        justify-content: flex-start;
    }

    /* Buttons Design */
    .btn-indigo-add {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: #ffffff !important;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none !important;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
    }
    .btn-indigo-add:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    /* Data Table Custom Styling */
    .table-responsive-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    table.table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
        margin-bottom: 0 !important;
    }

    table.table-modern th {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
        font-weight: 600;
        border: 1px solid #4338ca !important;
        padding: 12px 10px;
        font-size: 0.88rem;
    }

    table.table-modern td {
        padding: 12px 10px;
        border: 1px solid #e2e8f0;
        vertical-align: middle;
        background-color: #ffffff;
        color: #334155;
    }

    table.table-modern tr:nth-child(even) td {
        background-color: #f8fafc;
    }

    /* Action Buttons inside Table */
    .btn-table-edit {
        background-color: #fef3c7;
        color: #d97706;
        border: 1px solid #fde68a;
        padding: 6px 10px;
        border-radius: 6px;
        transition: all 0.2s;
        display: inline-flex;
    }
    .btn-table-edit:hover {
        background-color: #d97706;
        color: #ffffff;
        border-color: #d97706;
    }

    .btn-table-delete {
        background-color: #fff5f5;
        color: #e53e3e;
        border: 1px solid #fed7d7;
        padding: 6px 10px;
        border-radius: 6px;
        transition: all 0.2s;
        display: inline-flex;
    }
    .btn-table-delete:hover {
        background-color: #e53e3e;
        color: #ffffff;
        border-color: #e53e3e;
    }

    /* Overriding DataTables Default Style to fit Purple Theme */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #4f46e5 !important;
        color: white !important;
        border-color: #4f46e5 !important;
        border-radius: 6px;
    }
    .dt-buttons .dt-button {
        background: #ffffff !important;
        color: #4f46e5 !important;
        border: 1px solid #c7d2fe !important;
        border-radius: 6px !important;
        padding: 5px 12px !important;
        font-size: 0.85rem !important;
    }
    .dt-buttons .dt-button:hover {
        background: #eeeffe !important;
    }

    @media (max-width: 768px) {
        .doc-number-badge { position: relative; top: 0; right: 0; text-align: left; display: inline-block; margin-top: 10px; }
        .card-header-modern { padding: 1.5rem; }
    }
</style>

<div class="container-fluid">
    <div class="card custom-card">
        
        <div class="card-header-modern">
            <div class="header-title-block text-center">
                <h5>ESSOM CO., LTD.</h5>
                <h5>ทะเบียนควบคุมแบบผลิต (Drawing control status)</h5>
            </div>
            <div class="doc-number-badge">
                <strong>F8300.7</strong><br>19 Jan. 22
            </div>
            
            <div class="action-header-bar">
                <a href="{{ route('product-registration.create') }}" class="btn-indigo-add">
                    <i class="fas fa-plus-circle"></i> เพิ่มเอกสารใหม่
                </a>
            </div>
        </div>

        <div class="card-body" style="padding: 2rem 2.5rem;">    
            <div class="table-responsive-container">
                <table id="tb_job" class="table table-modern text-center">
                    <thead>
                        <tr> 
                            <th>Product Name</th>
                            <th>Sub Code</th>
                            <th>Update</th>      
                            <th style="width: 8%">แก้ไข</th> 
                            <th style="width: 8%">ลบ</th>                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hd as $item)
                            <tr>
                                <td class="text-left font-weight-bold" style="color: #1e293b; padding-left: 15px;">
                                    {{ $item->product_registration_hd_name }}
                                </td>
                                <td>
                                    <span class="badge badge-light" style="font-size: 0.85rem; padding: 5px 10px; border-radius: 6px; border: 1px solid #e2e8f0;">
                                        {{ $item->product_registration_hd_subcode }}
                                    </span>
                                </td>
                                <td style="color: #64748b;">{{ $item->updated_at }}</td>
                                <td>
                                    <a href="{{ route('product-registration.edit', $item->product_registration_hd_id) }}" class="btn-table-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn-table-delete" onclick="confirmDel('{{ $item->product_registration_hd_id }}')">
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

confirmDel = (refid) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: 'คุณต้องการลบรายการนี้หรือไม่ ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            confirmButton: 'btn btn-success px-4 py-2 mr-2',
            cancelButton: 'btn btn-danger px-4 py-2'
        },
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelRegistrationHd') }}`,
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
                            confirmButtonColor: '#4f46e5'
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิก',
                text: 'โปรดตรวจสอบข้อมูลอีกครั้งเพื่อความถูกต้อง :)',
                icon: 'error',
                confirmButtonColor: '#4f46e5'
            });
        }
    });
}
</script>
@endpush