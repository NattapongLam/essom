@extends('layouts.main')
@section('content')

<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Modern Indigo Theme Styles */
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
        position: relative;
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

    /* Buttons Style */
    .btn-indigo-add {
        background: #ffffff;
        color: #4f46e5 !important;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: none;
    }

    .btn-indigo-add:hover {
        background: #f4f5ff;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }

    /* Table Customizations */
    .modern-table {
        border-collapse: separate !important;
        border-spacing: 0 6px !important;
    }

    .modern-table thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        padding: 12px 8px !important;
        border: none !important;
    }

    .modern-table tbody tr {
        transition: all 0.2s ease;
        background-color: #ffffff;
    }

    .modern-table tbody tr:hover {
        background-color: #f4f5ff !important;
        transform: scale(1.002);
    }

    .modern-table td {
        padding: 12px 8px !important;
        vertical-align: middle !important;
        border-top: 1px solid #f1f5f9 !important;
        border-bottom: 1px solid #f1f5f9 !important;
        border-left: none !important;
        border-right: none !important;
        color: #334155;
    }

    /* Custom Modern Badges */
    .badge-modern {
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 0.78rem;
        font-weight: 600;
        display: inline-block;
    }

    .badge-modern-warning {
        background-color: #fffbeb;
        color: #d97706;
        border: 1px solid #fde68a;
    }

    .badge-modern-success {
        background-color: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }

    /* Action Buttons Inside Table */
    .action-btn {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }

    /* Customizing DataTables elements to match theme */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #4f46e5 !important;
        color: #fff !important;
        border: 1px solid #4f46e5 !important;
        border-radius: 6px;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="custom-card-header d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div class="text-center text-md-left">
                        <h5 class="mb-0">ESSOM CO., LTD</h5>
                        <div class="doc-meta opacity-75">การทบทวนการออกแบบ / DESIGN REVIEW</div>
                    </div>
                    
                    <div class="text-center">
                        <a href="{{route('design-review-a.create')}}" class="btn btn-indigo-add">
                            <i class="fas fa-plus me-2"></i> เพิ่มเอกสาร
                        </a>
                    </div>

                    <div class="text-center text-md-right mt-2 mt-md-0">
                        <span class="badge bg-white text-dark font-weight-bold px-2 py-1 mb-1">F8300.2A</span>
                        <div class="doc-meta">19 Jan. 22</div>
                    </div>             
                </div>

                <div class="card-body p-4">             
                    <div class="table-responsive">
                        <table id="tb_job" class="table modern-table text-center w-100">
                            <thead>   
                                <tr>
                                    <th>Product</th>  
                                    <th>Model</th>  
                                    <th>Participants</th>  
                                    <th>Subject</th>  
                                    <th>Design Input</th>  
                                    <th>Reported By</th>  
                                    <th style="width: 60px;">แก้ไข</th>
                                    <th style="width: 120px;">อนุมัติ</th>
                                    <th style="width: 60px;">ลบ</th>
                                </tr>                                         
                            </thead>
                            <tbody>       
                                @foreach ($hd as $item)
                                    <tr>
                                        <td class="font-weight-bold">{{$item->design_review_a_hd_product}}</td>
                                        <td><span class="text-muted">{{$item->design_review_a_hd_model}}</span></td>
                                        <td>{{$item->design_review_a_hd_participants}}</td>
                                        <td>{{$item->design_review_a_hd_subject}}</td>
                                        <td>{{$item->design_review_a_hd_designinput}}</td>
                                        <td>{{$item->reported_by}}</td>
                                        <td>
                                            <a href="{{route('design-review-a.edit',$item->design_review_a_hd_id)}}" class="btn btn-warning action-btn text-white shadow-sm" title="แก้ไขข้อมูล">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            @if ($item->reviewed_status == "N")
                                                @if ($item->reviewed_by == auth()->user()->name)
                                                    <a href="{{route('design-review-a.show',$item->design_review_a_hd_id)}}" class="btn btn-primary action-btn shadow-sm" style="background-color: #4f46e5; border-color: #4f46e5;">
                                                        <i class="fas fa-file-signature"></i>
                                                    </a>
                                                @else
                                                   <span class="badge-modern badge-modern-warning">รอทบทวน</span> 
                                                @endif
                                            @elseif($item->engineecing_status == "N")
                                                 @if ($item->engineecing_by == auth()->user()->name)
                                                    <a href="{{route('design-review-a.show',$item->design_review_a_hd_id)}}" class="btn btn-primary action-btn shadow-sm" style="background-color: #4f46e5; border-color: #4f46e5;">
                                                        <i class="fas fa-file-signature"></i>
                                                    </a>
                                                @else
                                                    <span class="badge-modern badge-modern-warning">รออนุมัติ</span>
                                                @endif
                                            @else
                                                <span class="badge-modern badge-modern-success">อนุมัติเรียบร้อย</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-danger action-btn shadow-sm"  
                                               onclick="confirmDel('{{ $item->design_review_a_hd_id }}')" title="ลบเอกสาร">
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
                [1, "asc"]
            ],
            fixedHeader: {
                header:false,
                footer:false
            },
        pagingType: "full_numbers",
        bSort: true,    
    })
});

confirmDel = (refid) =>{       
Swal.fire({
    title: 'คุณแน่ใจหรือไม่ !',
    text: `คุณต้องการลบรายการนี้หรือไม่ ?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'ยืนยันการลบ',
    cancelButtonText: 'ยกเลิก',
    confirmButtonClass: 'btn btn-danger px-4 mx-2',
    cancelButtonClass: 'btn btn-light px-4 mx-2',
    buttonsStyling: false
}).then(function(result) {
    if (result.value) {
        $.ajax({
            url: `{{ url('/cancelReviewAHd') }}`,
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
            title: 'ยกเลิกแล้ว',
            text: 'ข้อมูลของคุณยังปลอดภัยอยู่ :)',
            icon: 'info',
            confirmButtonColor: '#4f46e5'
        });
    }
});
}
</script>
@endpush