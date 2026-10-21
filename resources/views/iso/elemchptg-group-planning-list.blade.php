@extends('layouts.main')

@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Indigo Modern Theme */
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #e0e7ff;
        --text-dark: #1e1b4b;
        --border-radius-custom: 12px;
    }

    .custom-card {
        border: none;
        border-radius: var(--border-radius-custom);
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.1), 0 8px 10px -6px rgba(79, 70, 229, 0.1);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #6366f1, var(--indigo-primary));
        color: #ffffff;
        padding: 1.5rem;
        border-bottom: none;
    }

    .custom-card-header h5 {
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .doc-code {
        font-size: 0.85rem;
        opacity: 0.85;
        font-weight: 300;
    }

    .btn-indigo-add {
        background-color: #ffffff;
        color: var(--indigo-primary) !important;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none !important;
    }

    .btn-indigo-add:hover {
        background-color: var(--indigo-light);
        transform: translateY(-1px);
        box-shadow: 0 6px 12px -2px rgba(79, 70, 229, 0.2);
    }

    /* Table Styling */
    .modern-table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .modern-table thead th {
        background-color: #f8fafc !important;
        color: #64748b;
        font-weight: 600;
        font-size: 0.825rem;
        letter-spacing: 0.5px;
        padding: 1.2rem 0.5rem !important;
        border-bottom: 2px solid #e2e8f0 !important;
        border-top: none !important;
    }

    .modern-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .modern-table tbody tr:hover {
        background-color: #f1f5f9;
    }

    .modern-table tbody td {
        padding: 1rem 0.5rem !important;
        vertical-align: middle !important;
        color: var(--text-dark);
        font-weight: 500;
        font-size: 0.85rem;
        border-bottom: 1px solid #e2e8f0 !important;
    }

    .set-badge {
        font-size: 0.75rem;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 2px;
    }
    .badge-elec { background-color: #e0e7ff; color: #4338ca; }
    .badge-mach { background-color: #f1f5f9; color: #334155; }
    .badge-paint { background-color: #fce7f3; color: #be185d; }

    /* Action Buttons */
    .action-btn {
        width: 34px;
        height: 34px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    /* DataTables Overrides */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--indigo-primary) !important;
        color: white !important;
        border: 1px solid var(--indigo-primary) !important;
        border-radius: 6px;
    }
    .dt-buttons .dt-button {
        background: #f1f5f9 !important;
        color: #475569 !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 6px !important;
        font-size: 0.85rem !important;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div class="text-center text-md-left mb-3 mb-md-0">
                            <h5 class="m-0">ESSOM CO.,LTD</h5>
                            <h5 class="m-0 font-weight-normal" style="font-size: 1.1rem; opacity: 0.9;">Electrical , Machining , and Painting Group Planning</h5>
                            <span class="doc-code">ฟอร์มเอกสาร: F8510.3(S) (9 Feb. 17)</span>
                        </div>
                        <div class="text-center text-md-right">
                            <a href="{{ route('elemchptg-plannings.create') }}" class="btn-indigo-add">
                                <i class="fas fa-plus"></i> เพิ่มเอกสาร
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">            
                    <div class="table-responsive">
                        <table id="tb_job" class="table modern-table text-center w-100">
                            <thead>  
                                <tr>  
                                    <th>Status</th>
                                    <th>Prepared By</th>
                                    <th>Section (Elec / Mach / Paint)</th>
                                    <th>Product Code</th>
                                    <th>Job No</th>
                                    <th>Customer</th>
                                    <th>แก้ไข</th>
                                    <th>อัพเดท</th>
                                    <th>ลบ</th>                        
                                </tr>                      
                            </thead>
                            <tbody>  
                                @foreach ($hd as$item)
                                    @php
                                        // ดึงข้อมูลแยกตาม set_no เพื่อเอามาแสดงรวมในแถวเดียว
                                        $set1 =$item->details->where('set_no', 1)->first();
                                        $set2 =$item->details->where('set_no', 2)->first();
                                        $set3 =$item->details->where('set_no', 3)->first();
                                    @endphp
                                    <tr>
                                        <td>
                                            @if ($item->docs_status == "1")
                                                <span class="bg-gradient-warning">เปิดเอกสาร</span>
                                            @elseif ($item->docs_status == "2")
                                                <span class="bg-gradient-warning">ตรวจสอบเรียบร้อย</span>
                                            @elseif ($item->docs_status == "3")
                                                <span class="bg-gradient-warning">อนุมัติ</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->prepared_by }}</td>
                                        
                                        {{-- Section ทั้ง 3 ชุด --}}
                                        <td class="text-start">
                                            <div><span class="set-badge badge-elec">Elec:</span> {{ $set1->section ?? '-' }}</div>
                                            <div><span class="set-badge badge-mach">Mach:</span> {{ $set2->section ?? '-' }}</div>
                                            <div><span class="set-badge badge-paint">Paint:</span> {{ $set3->section ?? '-' }}</div>
                                        </td>

                                        {{-- Product Code ทั้ง 3 ชุด --}}
                                        <td class="text-start">
                                            <div>{{ $set1->product_code ?? '-' }}</div>
                                            <div>{{ $set2->product_code ?? '-' }}</div>
                                            <div>{{ $set3->product_code ?? '-' }}</div>
                                        </td>

                                        {{-- Job No ทั้ง 3 ชุด --}}
                                        <td class="text-start">
                                            <div>{{ $set1->job_no ?? '-' }}</div>
                                            <div>{{ $set2->job_no ?? '-' }}</div>
                                            <div>{{ $set3->job_no ?? '-' }}</div>
                                        </td>

                                        {{-- Customer ทั้ง 3 ชุด --}}
                                        <td class="text-start">
                                            <div>{{ $set1->customer ?? '-' }}</div>
                                            <div>{{ $set2->customer ?? '-' }}</div>
                                            <div>{{ $set3->customer ?? '-' }}</div>
                                        </td>

                                        <td>
                                            <a href="{{ route('elemchptg-plannings.edit', $item->elemchptggroup_planning_hds_id) }}" class="btn btn-sm btn-warning action-btn text-white" style="background-color: #f59e0b;" title="แก้ไข">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('elemchptg-plannings.show', $item->elemchptggroup_planning_hds_id) }}" class="btn btn-sm btn-success action-btn" style="background-color: #10b981;" title="ดูรายละเอียด">
                                                <i class="fas fa-check-circle"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm action-btn" style="background-color: #ef4444;"  
                                                onclick="confirmDel('{{ $item->elemchptggroup_planning_hds_id }}')" title="ลบ">
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
$(document).ready(function() {$('#tb_job').DataTable({
        "pageLength": 50,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        order: [
            [0, "asc"]
        ],
        pagingType: "full_numbers",
        bSort: true,    
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
                url: `{{ url('/cancelElemchptgplanning') }}`,
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