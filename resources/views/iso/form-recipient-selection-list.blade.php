@extends('layouts.main')
@section('content')

<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Modern Indigo Theme */
    :root {
        --primary-indigo: #6366f1;
        --primary-hover: #4f46e5;
        --bg-light: #f8fafc;
        --text-dark: #1e293b;
        --text-muted: #64748b;
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(99, 102, 241, 0.08);
        background: #ffffff;
        overflow: hidden;
        transition: transform 0.2s ease;
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

    .doc-number {
        background: #e0e7ff;
        color: var(--primary-hover);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }

    /* Buttons */
    .btn-indigo {
        background-color: var(--primary-indigo);
        color: #fff;
        border-radius: 8px;
        font-weight: 500;
        padding: 8px 16px;
        border: none;
        transition: all 0.2s;
    }
    .btn-indigo:hover {
        background-color: var(--primary-hover);
        color: #fff;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
    }

    .btn-outline-indigo {
        color: var(--primary-indigo);
        border: 1.5px solid var(--primary-indigo);
        border-radius: 8px;
        font-weight: 500;
        padding: 7px 16px;
        background: transparent;
        transition: all 0.2s;
    }
    .btn-outline-indigo:hover {
        background-color: var(--primary-indigo);
        color: #fff;
    }

    /* Table Styling */
    .modern-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100% !important;
    }
    .modern-table thead th {
        background-color: #f8fafc !important;
        color: var(--text-dark);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 12px 8px !important;
    }
    .modern-table tbody tr {
        transition: background-color 0.2s;
    }
    .modern-table tbody tr:hover {
        background-color: #f1f5f9 !important;
    }
    .modern-table td {
        padding: 14px 8px !important;
        vertical-align: middle !important;
        color: #334155;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    /* Action Action Icons Button Customization */
    .action-btn {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        border: none;
        transition: all 0.2s;
    }
    .action-btn:hover {
        transform: translateY(-2px);
    }
    
    /* DataTables Overrides to match Indigo */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--primary-indigo) !important;
        color: white !important;
        border: 1px solid var(--primary-indigo) !important;
        border-radius: 6px !important;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <div class="text-center text-md-left">
                            <small class="text-muted font-weight-bold">ESSOM CO., LTD</small>
                            <h4 class="form-title mb-0">ใบคัดเลือกผู้รับจ้างช่วงและประเมิน</h4>
                            <span class="text-muted" style="font-size: 0.9rem;">SUBCONTRACTOR QUALIFICATION AND EVALUATION</span>
                        </div>
                        <div class="text-center text-md-right">
                            <span class="doc-number mb-1">F8411.2</span>
                            <div class="text-muted small">15 Aug. 19</div>
                        </div>
                    </div>
                    
                    <hr class="my-4" style="border-color: #f1f5f9;">
                    
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                        <a href="{{route('recipient-selection.create')}}" class="btn btn-indigo mb-2 mb-sm-0">
                            <i class="fas fa-plus-circle mr-2"></i>เพิ่มเอกสาร
                        </a>
                        <a href="{{ route('recipient-selection.report') }}" class="btn btn-outline-indigo">
                            <i class="fas fa-chart-line mr-2"></i>ประเมินสมรรถนะของผู้ส่งมอบ/ผู้ขาย
                        </a>
                    </div>             
                </div>
                
                <div class="card-body p-4">             
                    <div class="table-responsive">
                        <table id="tb_job" class="table modern-table text-center">
                            <thead>
                                <tr>
                                    <th>ชื่อผู้รับจ้างช่วง</th>
                                    <th>ชื่อผู้ติดต่อ</th>
                                    <th>เบอร์โทร</th>
                                    <th>เสนอโดย</th>
                                    <th>ประเภทจัดซื้อ</th>
                                    <th>แก้ไข</th>
                                    <th>ประเมิน</th>
                                    <th>อนุมัติ</th>
                                    <th>ลบ</th>
                                    <th>อัพเดทบัญชี</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hd as $item)
                                    <tr>
                                        <td class="font-weight-bold text-dark">{{$item->recipient_selection_hd_name}}</td>
                                        <td>{{$item->recipient_selection_hd_contact}}</td>
                                        <td><span class="badge badge-light p-2 text-secondary" style="font-size: 0.85rem;"><i class="fas fa-phone-alt mr-1 text-muted"></i>{{$item->recipient_selection_hd_tel}}</span></td>
                                        <td>
                                            <span class="font-weight-500">{{$item->requested_by}}</span><br>
                                            <small class="text-muted"><i class="far fa-calendar-alt mr-1"></i>{{$item->requested_date}}</small>
                                        </td>
                                        <td><span class="badge badge-soft-primary px-2 py-1" style="background: #eff6ff; color: #2563eb;">{{$item->recipient_selection_hd_type}}</span></td>
                                        <td>
                                            <a href="{{route('recipient-selection.edit',$item->recipient_selection_hd_id)}}" class="btn btn-sm btn-info action-btn" title="แก้ไข">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('recipient-selection.edit',$item->recipient_selection_hd_id)}}" class="btn btn-sm btn-warning action-btn text-white" style="background-color: #f59e0b;" title="ประเมิน">
                                                <i class="fas fa-star"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('recipient-selection.show',$item->recipient_selection_hd_id)}}" class="btn btn-sm btn-success action-btn" style="background-color: #10b981;" title="อนุมัติ">
                                                <i class="fas fa-check-circle"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm action-btn" style="background-color: #ef4444;"  
                                                onclick="confirmDel('{{ $item->recipient_selection_hd_id }}')" title="ลบ">
                                                <i class="fas fa-trash-alt"></i>
                                            </a> 
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-primary btn-sm action-btn" style="background-color: #8b5cf6;"  
                                                onclick="confirmUpDate('{{ $item->recipient_selection_hd_id }}')" title="อัพเดทบัญชี">
                                                <i class="fas fa-cloud-upload-alt"></i>
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
    });

    // ปรับแต่งปุ่มของ SweetAlert2 ให้เป็นโทนสี Indigo และโมเดิร์นขึ้น
    const swalCustomButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-indigo mx-2 px-4 py-2',
            cancelButton: 'btn btn-light text-secondary mx-2 px-4 py-2'
        },
        buttonsStyling: false
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
                url: `{{ url('/cancelRecipientSelection') }}`,
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

confirmUpDate = (refid) =>{       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการอัพเดทลงบัญชีนี้หรือไม่ ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        confirmButtonColor: '#6366f1',
        cancelButtonColor: '#64748b',
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/updateRecipientSelection') }}`,
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
                            text: 'อัพเดทเรียบร้อยแล้ว',
                            icon: 'success',
                            confirmButtonColor: '#6366f1'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'อัพเดทไม่สำเร็จ(มีข้อมูลอยู่แล้ว)',
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