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
        padding: 1.75rem 2rem !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .company-title {
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 1px;
        color: #6366f1;
        margin-bottom: 0.35rem;
        text-transform: uppercase;
    }
    .main-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }
    .tools-subtitle {
        font-size: 0.85rem;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 0;
        font-weight: 400;
    }
    .doc-meta {
        font-size: 0.85rem;
        color: #64748b;
        background: #f8fafc;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        display: inline-block;
        text-align: left;
    }

    /* Modern Indigo Buttons Group */
    .action-buttons-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        align-items: center;
    }
    .btn-indigo-add {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        padding: 0.6rem 1.25rem !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        font-size: 0.875rem;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2) !important;
        transition: all 0.2s ease !important;
        border: none !important;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-indigo-add:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.35) !important;
        transform: translateY(-1px);
        color: #ffffff !important;
        text-decoration: none;
    }
    
    /* Variant button for F7150.2 to look slightly secondary yet premium */
    .btn-indigo-add.btn-alt {
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8) !important;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.2) !important;
    }
    .btn-indigo-add.btn-alt:hover {
        box-shadow: 0 6px 16px rgba(14, 165, 233, 0.35) !important;
    }

    /* Table Customization */
    .card-body {
        padding: 1.75rem 2rem !important;
    }
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
        padding: 1rem 0.75rem !important;
        font-size: 0.875rem;
        vertical-align: middle !important;
        white-space: nowrap;
    }
    #tb_job tbody td {
        padding: 0.9rem 0.75rem !important;
        vertical-align: middle !important;
        color: #334155;
        font-size: 0.875rem;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(248, 250, 252, 0.6) !important;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(99, 102, 241, 0.03) !important;
    }

    /* Pastel Action Buttons */
    .btn-action-edit {
        background-color: #fef3c7 !important;
        color: #d97706 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 0.4rem 0.65rem !important;
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
        padding: 0.4rem 0.65rem !important;
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
        padding: 0.4rem 0.65rem !important;
        transition: all 0.2s;
        outline: none !important;
    }
    .btn-action-delete:hover {
        background-color: #dc2626 !important;
        color: #ffffff !important;
    }

    /* DataTables Layout Overwrites */
    .dataTables_wrapper .dt-buttons {
        margin-bottom: 1rem;
    }
    .dt-buttons .btn {
        background-color: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #475569 !important;
        border-radius: 8px !important;
        font-size: 0.8rem !important;
        font-weight: 500 !important;
        margin-right: 0.35rem;
        padding: 0.4rem 0.75rem;
        transition: all 0.2s;
    }
    .dt-buttons .btn:hover {
        background-color: #f1f5f9 !important;
        color: #1e293b !important;
        border-color: #94a3b8 !important;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 0.4rem 0.75rem !important;
        outline: none;
        background-color: #ffffff;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 0.3rem 0.5rem !important;
        outline: none;
    }
</style>

<div class="objective-container">
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-start gap-3">
                        <!-- Left Info -->
                        <div>
                            <div class="company-title">ESSOM CO., LTD.</div>
                            <h5 class="main-title">
                                การตรวจพื้นที่ประจำเดือน (สำนักงาน)
                            </h5>
                            <span class="doc-code">ฟอร์มเอกสาร: GF113.2-O (20 Feb. 19)</span>
                        </div>
                    </div>
                    
                    <div class="action-buttons-group mt-4 pt-3 border-top border-light">
                        <a href="{{ route('activity-5soffs.create') }}" class="btn-indigo-add">
                            <i class="fas fa-plus-circle"></i> เพิ่มข้อมูลใหม่
                        </a>
                    </div>
                </div>

                <div class="card-body">            
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-striped table-hover table-bordered text-center w-100">
                            <thead>     
                                <tr>
                                    <th>หน่วยงานที่ถูกตรวจ</th>
                                    <th>ชั้นที่ถูกตรวจ</th>
                                    <th>วันที่</th>
                                    <th>แก้ไข</th>
                                    <th>ลบ</th>
                                </tr>                        
                            </thead>
                            <tbody>
                                @foreach ($hd as $item)
                                    <tr>
                                        <td>{{$item->department_name}}</td>
                                        <td>{{$item->floor}}</td>
                                        <td>{{$item->audit_date}}</td>
                                        <td>
                                            <a href="{{route('activity-5soffs.edit',$item->activitys_off_hds_id)}}" class="btn btn-sm btn-warning action-btn text-white" style="background-color: #f59e0b;" title="ประเมิน">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm action-btn" style="background-color: #ef4444;"  
                                                onclick="confirmDel('{{ $item->activitys_off_hds_id }}')" title="ลบ">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach                              
                            </tbody>
                        </table>
                    </div>
                </div> <!-- card-body -->
            </div> <!-- card -->
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
            { extend: 'copy', className: 'btn btn-sm' },
            { extend: 'csv', className: 'btn btn-sm' },
            { extend: 'excel', className: 'btn btn-sm' },
            { extend: 'pdf', className: 'btn btn-sm' },
            { extend: 'print', className: 'btn btn-sm' }
        ],
        order: [[0, "asc"]],
        pagingType: "full_numbers",
        bSort: true,
        "language": {
            "search": "ค้นหาข้อมูล:",
            "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
            "info": "แสดงรายการที่ _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
            "infoEmpty": "ไม่มีข้อมูลที่จะแสดง",
            "zeroRecords": "ไม่พบข้อมูลที่ค้นหา",
            "paginate": {
                "first": "หน้าแรก",
                "last": "หน้าสุดท้าย",
                "next": "ถัดไป",
                "previous": "ก่อนหน้า"
            }
        }
    });
});
confirmDel = (refid) =>{       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการลบรายการนี้หรือไม่ ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelActivity5off') }}`,
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
                            confirmButtonColor: '#6366f1'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'ยกเลิกเอกสารไม่สำเร็จ',
                            icon: 'error',
                            confirmButtonColor: '#6366f1'
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิก',
                text: 'โปรดตรวจสอบข้อมูลอีกครั้งเพื่อความถูกต้อง :)',
                icon: 'error',
                confirmButtonColor: '#6366f1'
            });
        }
    });
}
</script>
@endpush