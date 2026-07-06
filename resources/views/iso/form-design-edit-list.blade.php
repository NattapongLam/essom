@extends('layouts.main')
@section('content')

<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Modern Indigo Theme */
    :root {
        --indigo-primary: #6366f1;
        --indigo-hover: #4f46e5;
        --indigo-light: #e0e7ff;
        --indigo-bg: #f8fafc;
        --text-dark: #1e293b;
        --text-muted: #64748b;
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(99, 102, 241, 0.05);
        background: #ffffff;
        margin-top: 2rem;
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #ffffff 0%, var(--indigo-bg) 100%);
        border-bottom: 1px solid rgba(99, 102, 241, 0.08);
        padding: 1.75rem 2rem;
    }

    .company-title {
        font-weight: 800;
        letter-spacing: 0.5px;
        color: var(--text-dark);
    }

    .subtitle-badge {
        background-color: var(--indigo-light);
        color: var(--indigo-hover);
        padding: 0.4rem 1.2rem;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        margin-top: 0.5rem;
    }

    /* Action Toolbar */
    .table-toolbar {
        padding: 1.5rem 2rem 0.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .btn-indigo-add {
        background-color: var(--indigo-primary);
        color: #ffffff;
        font-weight: 600;
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        border: none;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
        display: inline-flex;
        align-items: center;
        text-decoration: none;
    }

    .btn-indigo-add:hover {
        background-color: var(--indigo-hover);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.25);
        text-decoration: none;
    }

    /* Table Styling */
    .modern-table-container {
        padding: 0 2rem 2rem 2rem;
    }

    .modern-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100% !important;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
    }

    .modern-table thead th {
        background-color: #f1f5f9 !important;
        color: #475569 !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        font-size: 0.8rem !important;
        letter-spacing: 0.5px;
        padding: 1rem 0.75rem !important;
        border-bottom: 2px solid #e2e8f0 !important;
        border-top: none !important;
    }

    .modern-table tbody浏览 td {
        padding: 0.85rem 0.75rem !important;
        vertical-align: middle !important;
        color: var(--text-dark);
        font-size: 0.9rem;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .modern-table tbody tr:last-child td {
        border-bottom: none !important;
    }

    /* Action Buttons in Table */
    .btn-action-view {
        background-color: #f0fdf4;
        color: #16a34a;
        border: 1px solid #bbf7d0;
    }
    .btn-action-view:hover { background-color: #16a34a; color: #ffffff; }

    .btn-action-edit {
        background-color: #fffbeb;
        color: #d97706;
        border: 1px solid #fde68a;
    }
    .btn-action-edit:hover { background-color: #d97706; color: #ffffff; }

    .btn-action-approve {
        background-color: #e0e7ff;
        color: #4f46e5;
        border: 1px solid #c7d2fe;
    }
    .btn-action-approve:hover { background-color: #4f46e5; color: #ffffff; }

    .btn-action-delete {
        background-color: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
    .btn-action-delete:hover { background-color: #dc2626; color: #ffffff; }

    .btn-modern-sm {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.15s ease-in-out;
    }
</style>

<div class="container-fluid py-2">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <!-- Header Component -->
                <div class="card-header custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <div class="text-center text-md-left mb-3 mb-md-0">
                            <h4 class="company-title mb-1">ESSOM CO., LTD</h4>
                            <span class="subtitle-badge">
                                <i class="fas fa-tools mr-2"></i>คำขอแก้ไขแบบ &bull; DESIGN CHANGE REQUEST
                            </span>
                        </div>
                        <div class="text-center text-md-right">
                            <span class="badge badge-light p-2 border text-muted">F8300.4 / 09 Jun. 16</span>
                        </div>
                    </div>              
                </div>

                <!-- Toolbar Actions -->
                <div class="table-toolbar">
                    <a href="{{route('design-edit.create')}}" class="btn-indigo-add">
                        <i class="fas fa-plus-circle mr-2"></i> เพิ่มเอกสารคำขอ
                    </a>
                </div>

                <!-- Main Data Table -->
                <div class="card-body p-0">             
                    <div class="table-responsive modern-table-container">
                        <table id="tb_job" class="table modern-table text-center">
                            <thead>  
                                <tr>
                                    <th>Product</th>
                                    <th>Model</th>
                                    <th>Drawing No.</th>
                                    <th>Requested By</th>
                                    <th>Supervisor</th>
                                    <th>ไฟล์แนบ</th>
                                    <th>แก้ไข</th>
                                    <th>อนุมัติ</th>
                                    <th>ลบ</th>
                                </tr>                                                                                        
                            </thead>
                            <tbody>    
                                @foreach ($hd as $item)
                                    <tr>
                                        <td class="font-weight-600">{{ $item->design_edits_product}}</td>
                                        <td><span class="badge badge-light border px-2 py-1">{{ $item->design_edits_model}}</span></td>
                                        <td><code>{{ $item->design_edits_drawing}}</code></td>
                                        <td>{{ $item->requested_by}}</td>
                                        <td>{{ $item->supervisor_by}}</td>
                                        <td>
                                            @if ($item->design_edits_file)
                                                <a href="{{asset($item->design_edits_file)}}" target="_blank" class="btn-modern-sm btn-action-view" title="เปิดไฟล์แนบ">
                                                    <i class="fas fa-file-alt"></i>
                                                </a>     
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif                                       
                                        </td>
                                        <td>
                                            <a href="{{route('design-edit.edit',$item->design_edits_id)}}" class="btn-modern-sm btn-action-edit" title="แก้ไขข้อมูล">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('design-edit.show',$item->design_edits_id)}}" class="btn-modern-sm btn-action-approve" title="พิจารณาอนุมัติ">
                                                <i class="fas fa-user-check"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn-modern-sm btn-action-delete"  
                                               onclick="confirmDel('{{ $item->design_edits_id }}')" title="ลบรายการ">
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

confirmDel = (refid) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการลบรายการคำขอแก้ไขแบบนี้ใช่หรือไม่ ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยันการลบ',
        cancelButtonText: 'ยกเลิก',
        confirmButtonClass: 'btn btn-success mt-2',
        cancelButtonClass: 'btn btn-danger ms-2 mt-2',
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelDesignedit') }}`,
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
                            text: 'ลบข้อมูลเอกสารเรียบร้อยแล้ว',
                            icon: 'success'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'เกิดข้อผิดพลาด ไม่สามารถลบข้อมูลได้',
                            icon: 'error'
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิกแล้ว',
                text: 'ข้อมูลของคุณยังคงปลอดภัยอยู่เช่นเดิม :)',
                icon: 'info'
            });
        }
    });
}
</script>
@endpush