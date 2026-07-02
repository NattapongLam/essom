@extends('layouts.main')
@section('content')

<!-- Essential Third-Party Plugin Style Asset -->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Core System Layout */
    .custom-container {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .form-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    /* Elegant Top Header Layout Component */
    .card-header-modern {
        background-color: #ffffff;
        padding: 2rem 2.5rem 1.5rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-title-block h5 {
        font-size: 1.05rem;
        letter-spacing: 0.5px;
        color: #64748b;
        font-weight: 500;
        margin: 0;
        line-height: 1.5;
    }

    .header-title-block h2 {
        font-weight: 700;
        color: #1e293b;
        margin-top: 6px;
        margin-bottom: 0;
        font-size: 1.4rem;
        line-height: 1.4;
    }

    .doc-number-badge {
        position: absolute;
        top: 2rem;
        right: 2.5rem;
        text-align: right;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 0.78rem;
        color: #64748b;
        line-height: 1.4;
    }

    /* Primary Action Buttons Component */
    .btn-indigo-add {
        background-color: #4f46e5;
        color: #ffffff !important;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 10px;
        border: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }
    .btn-indigo-add:hover {
        background-color: #3730a3;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3);
    }

    /* Custom Responsive Datatable Container */
    .table-modern-wrapper {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        background-color: #ffffff;
        margin-top: 15px;
    }

    .table-modern {
        margin-bottom: 0 !important;
    }

    .table-modern thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700;
        font-size: 0.82rem;
        padding: 14px 10px !important;
        border-bottom: 2px solid #e2e8f0 !important;
        border-top: none !important;
    }

    .table-modern tbody td {
        padding: 12px 10px !important;
        font-size: 0.88rem;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    /* Soft State Management Badges */
    .badge-modern {
        padding: 6px 12px;
        font-weight: 600;
        border-radius: 30px;
        font-size: 0.75rem;
        display: inline-block;
    }
    .badge-modern-success { background-color: #ecfdf5; color: #059669; }
    .badge-modern-warning { background-color: #fff7ed; color: #d97706; border: 1px solid #fed7aa; }

    /* Interactive Functional Action Controls */
    .file-link-btn {
        color: #4f46e5;
        font-weight: 500;
        font-size: 0.8rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        background: #f5f3ff;
        border-radius: 6px;
        margin: 2px 0;
        transition: all 0.15s;
    }
    .file-link-btn:hover {
        background: #e0e7ff;
        color: #312e81;
    }

    .action-control-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.15s;
    }

    @media (max-width: 992px) {
        .doc-number-badge { position: relative; top: 0; right: 0; text-align: left; display: inline-block; margin-top: 15px; }
        .card-header-modern { padding: 1.5rem; }
    }
</style>

<div class="container-fluid custom-container">
    <div class="card form-card">
        
        <!-- Document Card Header Section -->
        <div class="card-header-modern">
            <div class="header-title-block text-center">
                <h5>ESSOM CO., LTD.</h5>
                <h2>ใบคำขอดำเนินการด้านเอกสาร Documents Action Request</h2>
            </div>
            <div class="doc-number-badge">
                <strong>F7530.3</strong><br>
                <span class="text-muted">27 Aug 25</span>
            </div>
        </div>

        <!-- Card Core Workspace Context -->
        <div class="card-body" style="padding: 2rem;">
            
            <!-- Context Layout Controller Trigger Area -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{route('document-correction.create')}}" class="btn-indigo-add">
                    <i class="fas fa-plus-circle"></i> เพิ่มเอกสารสารสนเทศ
                </a>
            </div>

            <!-- Custom Modern Datatable Section -->
            <div class="table-modern-wrapper table-responsive">
                <table id="tb_job" class="table table-modern text-center">
                    <thead>
                        <tr>
                            <th style="min-width: 70px;">Type</th>
                            <th style="min-width: 110px;">DAR No.</th>
                            <th style="min-width: 100px;">Date</th>
                            <th style="text-align: left; min-width: 180px;">Document Name</th>
                            <th style="min-width: 70px;">To</th>
                            <th style="min-width: 70px;">From</th>
                            <th style="text-align: left; min-width: 150px;">Remark</th>
                            <th style="min-width: 120px;">Requested By</th>
                            <th style="min-width: 120px;">เอกสารแนบ</th>
                            <th style="width: 50px;">แก้ไข</th>
                            <th style="min-width: 100px;">อนุมัติ</th>
                            <th style="width: 50px;">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>   
                        @foreach ($hd as $item)
                            <tr>
                                <td class="font-weight-bold text-dark">{{$item->documentcorrections_type}}</td>
                                <td class="text-muted font-weight-bold">{{$item->documentcorrections_docuno}}</td>
                                <td>{{$item->documentcorrections_date}}</td>
                                <td style="text-align: left;" class="font-weight-medium">{{$item->documentcorrections_name}}</td>
                                <td>{{$item->documentcorrections_to}}</td>
                                <td>{{$item->documentcorrections_from}}</td>
                                <td style="text-align: left;" class="text-muted">{{$item->documentcorrections_note}}</td>
                                <td>{{$item->requested_by}}</td>
                                <td>
                                    @if ($item->documentcorrections_file)
                                        <a href="{{asset($item->documentcorrections_file)}}" target="_blank" class="file-link-btn">
                                            <i class="fas fa-file-alt"></i> ต้นฉบับ
                                        </a>
                                    @endif
                                    @if ($item->documentcorrections_file1)
                                        <a href="{{asset($item->documentcorrections_file1)}}" target="_blank" class="file-link-btn">
                                            <i class="fas fa-paperclip"></i> เอกสารอื่นๆ
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('document-correction.edit',$item->documentcorrections_id)}}" class="btn btn-sm btn-warning action-control-btn" title="แก้ไขข้อมูล">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    @if ($item->reviewed_status == "N")
                                        @if ($item->reviewed_by == auth()->user()->name)
                                           <a href="{{route('document-correction.show',$item->documentcorrections_id)}}" class="btn btn-sm btn-primary action-control-btn" title="ตรวจสอบสถานะ">
                                                <i class="fas fa-user-check"></i>
                                            </a>  
                                        @else
                                           <span class="badge-modern badge-modern-warning">รอทบทวน</span>
                                        @endif
                                    @elseif($item->approved_status == "N")
                                        @if ($item->approved_by == auth()->user()->name)
                                           <a href="{{route('document-correction.show',$item->documentcorrections_id)}}" class="btn btn-sm btn-primary action-control-btn" title="จัดการอนุมัติ">
                                                <i class="fas fa-user-check"></i>
                                            </a>  
                                        @else
                                           <span class="badge-modern badge-modern-warning">รออนุมัติ</span>
                                        @endif
                                    @else
                                        <span class="badge-modern badge-modern-success"><i class="fas fa-check-circle"></i> อนุมัติ</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm action-control-btn" title="ลบรายการ" onclick="confirmDel('{{ $item->documentcorrections_id }}')">
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

@endsection

@push('scriptjs')
<!-- Sweet Alerts Functional Dynamic Script Core Asset -->
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
            [2, "asc"]
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
        text: "คุณต้องการลบรายการใบคำขอนี้ใช่หรือไม่ ?",
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
                url: `{{ url('/cancelCorrection') }}`,
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