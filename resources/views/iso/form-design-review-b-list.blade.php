@extends('layouts.main')
@section('content')

<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Modern Indigo Theme Styles for Datatable Page */
    .custom-card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.08) !important;
        background: #ffffff;
        overflow: hidden;
    }
    
    .custom-card-header {
        background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%) !important;
        color: #ffffff !important;
        padding: 1.5rem !important;
        border-bottom: none !important;
    }

    .custom-card-header h5 {
        color: #ffffff !important;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .doc-meta {
        font-size: 0.85rem;
        opacity: 0.85;
    }

    /* Add Document Button */
    .btn-add-doc {
        background-color: #ffffff;
        color: #4f46e5 !important;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        transition: all 0.2s ease;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        text-decoration: none !important;
    }

    .btn-add-doc:hover {
        background-color: #f8fafc;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    /* Datatable Modern Overrides */
    .modern-table {
        border-collapse: separate !important;
        border-spacing: 0 6px !important;
        width: 100% !important;
    }

    .modern-table thead th {
        background-color: #f1f5f9 !important;
        color: #475569 !important;
        font-weight: 600;
        font-size: 0.85rem;
        border: none !important;
        padding: 12px 10px !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .modern-table tbody tr {
        transition: all 0.15s ease;
    }

    .modern-table tbody tr:hover td {
        background-color: #f0fdf4 !important; /* อารมณ์ Soft highlight เมื่อเอาเมาส์ชี้ */
    }

    .modern-table td {
        background: #f8fafc;
        border-top: 1px solid #e2e8f0 !important;
        border-bottom: 1px solid #e2e8f0 !important;
        border-left: none !important;
        border-right: none !important;
        padding: 12px 10px !important;
        color: #334155;
        font-size: 0.9rem;
        vertical-align: middle !important;
    }

    /* Action Buttons Inside Table */
    .btn-action-edit {
        background-color: #f59e0b;
        color: #fff !important;
        border: none;
        border-radius: 6px;
        padding: 6px 10px;
        transition: all 0.2s;
    }
    .btn-action-edit:hover {
        background-color: #d97706;
        transform: scale(1.05);
    }

    .btn-action-approve {
        background-color: #4f46e5;
        color: #fff !important;
        border: none;
        border-radius: 6px;
        padding: 6px 10px;
        transition: all 0.2s;
    }
    .btn-action-approve:hover {
        background-color: #4338ca;
        transform: scale(1.05);
    }

    .btn-action-delete {
        background-color: #ef4444;
        color: #fff !important;
        border: none;
        border-radius: 6px;
        padding: 6px 10px;
        transition: all 0.2s;
    }
    .btn-action-delete:hover {
        background-color: #dc2626;
        transform: scale(1.05);
    }

    /* Custom Modern Badges */
    .badge-modern-review {
        background-color: #fef3c7;
        color: #d97706;
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-block;
        border: 1px solid #fde68a;
    }

    .badge-modern-pending {
        background-color: #e0e7ff;
        color: #4f46e5;
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-block;
        border: 1px solid #c7d2fe;
    }

    .badge-modern-success {
        background-color: #dcfce7;
        color: #15803d;
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-block;
        border: 1px solid #bbf7d0;
    }

    /* Custom styles for DataTables Data export buttons to match Indigo */
    .dt-buttons .btn {
        background-color: #e0e7ff !important;
        color: #4f46e5 !important;
        border: none !important;
        font-weight: 500 !important;
        border-radius: 6px !important;
        margin-right: 5px !important;
    }
    .dt-buttons .btn:hover {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <!-- Header -->
                <div class="custom-card-header d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div class="text-center text-md-left">
                        <h5>ESSOM CO., LTD</h5>
                        <div class="doc-meta opacity-75">การทบทวนการออกแบบ / DESIGN VERIFICATION</div>
                    </div>
                    <div class="d-flex flex-column align-items-center align-items-md-end">
                        <span class="badge bg-white text-dark font-weight-bold px-2 py-1 mb-1">F8300.2B</span>
                        <div class="doc-meta mb-2">19 Jan. 22</div>
                        <a href="{{route('design-review-b.create')}}" class="btn-add-doc d-inline-flex align-items-center gap-1">
                            <i class="fas fa-plus-circle"></i> เพิ่มเอกสาร
                        </a>
                    </div>             
                </div>

                <!-- Card Body & Table -->
                <div class="card-body p-4">            
                    <div class="table-responsive">
                        <table id="tb_job" class="table modern-table text-center">
                            <thead>      
                                <tr>
                                    <th>Product</th>  
                                    <th>Model</th>  
                                    <th>Participants</th>  
                                    <th>Subject</th>  
                                    <th>Design Input</th> 
                                    <th>Design Output</th> 
                                    <th>Reported By</th>  
                                    <th style="width: 5%">แก้ไข</th>
                                    <th style="width: 12%">อนุมัติ</th>
                                    <th style="width: 5%">ลบ</th>
                                </tr>                                      
                            </thead>
                            <tbody>  
                                @foreach ($hd as $item)
                                    <tr>
                                        <td class="text-start font-weight-bold">{{$item->design_review_a_hd_product}}</td>
                                        <td><span class="badge bg-light text-dark border p-2">{{$item->design_review_a_hd_model}}</span></td>
                                        <td class="text-start">{{Str::limit($item->design_review_a_hd_participants, 30)}}</td>
                                        <td class="text-start">{{Str::limit($item->design_review_a_hd_subject, 30)}}</td>  
                                        <td class="text-start">{{Str::limit($item->design_review_b_input, 30)}}</td> 
                                        <td class="text-start">{{Str::limit($item->design_review_b_output, 30)}}</td> 
                                        <td>{{$item->reported_by}}</td>
                                        
                                        <!-- Edit Action -->
                                        <td>
                                            <a href="{{route('design-review-b.edit',$item->design_review_b_id)}}" class="btn-action-edit d-inline-flex align-items-center justify-content-center">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        
                                        <!-- Approval Action / Badges Status -->
                                        <td>
                                            @if ($item->reviewed_status == "N")
                                                @if ($item->reviewed_by == auth()->user()->name)
                                                    <a href="{{route('design-review-b.show',$item->design_review_b_id)}}" class="btn-action-approve d-inline-flex align-items-center gap-1">
                                                        <i class="fas fa-user-check"></i> ทบทวน
                                                    </a>  
                                                @else
                                                    <span class="badge-modern-review"><i class="fas fa-clock me-1"></i> รอทบทวน</span>
                                                @endif
                                            @elseif($item->engineecing_status == "N")
                                                @if ($item->engineecing_by == auth()->user()->name)
                                                    <a href="{{route('design-review-b.show',$item->design_review_b_id)}}" class="btn-action-approve d-inline-flex align-items-center gap-1">
                                                        <i class="fas fa-signature"></i> อนุมัติ
                                                    </a>  
                                                @else
                                                    <span class="badge-modern-pending"><i class="fas fa-hourglass-half me-1"></i> รออนุมัติ</span>
                                                @endif    
                                            @else  
                                                <span class="badge-modern-success"><i class="fas fa-check-circle me-1"></i> อนุมัติแล้ว</span>
                                            @endif
                                        </td>
                                        
                                        <!-- Delete Action -->
                                        <td>
                                            <a href="javascript:void(0)" class="btn-action-delete d-inline-flex align-items-center justify-content-center"  
                                               onclick="confirmDel('{{ $item->design_review_b_id }}')">
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

@section('scriptjs')
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
            { extend: 'copy', className: 'btn' },
            { extend: 'csv', className: 'btn' },
            { extend: 'excel', className: 'btn' },
            { extend: 'pdf', className: 'btn' },
            { extend: 'print', className: 'btn' }
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
        text: `คุณต้องการลบรายการนี้หรือไม่ ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            confirmButton: 'btn btn-success px-4 py-2 mt-2',
            cancelButton: 'btn btn-danger px-4 py-2 ms-2 mt-2'
        },
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelReviewB') }}`,
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
@endsection