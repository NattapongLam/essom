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
        --border-color: #e2e8f0;
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(99, 102, 241, 0.06);
        background: #ffffff;
        overflow: hidden;
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

    /* Modern Table Styling */
    .modern-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100% !important;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border-color);
    }
    
    .modern-table thead th {
        background-color: #f1f5f9 !important;
        color: var(--text-dark) !important;
        font-weight: 600 !important;
        font-size: 0.9rem !important;
        border-bottom: 2px solid var(--border-color) !important;
        padding: 14px 10px !important;
    }
    
    .modern-table td {
        padding: 14px 10px !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
        background: #fff;
        color: #334155;
        font-size: 0.9rem;
    }
    
    .modern-table tbody tr:hover td {
        background-color: #f8fafc !important;
    }

    /* DataTables Pagination & Custom Elements Override */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--primary-indigo) !important;
        color: #fff !important;
        border-color: var(--primary-indigo) !important;
        border-radius: 6px !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: var(--primary-hover) !important;
        color: #fff !important;
        border-radius: 6px !important;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid var(--border-color) !important;
        border-radius: 8px !important;
        padding: 6px 12px !important;
        margin-left: 8px !important;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--primary-indigo) !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }

    /* Custom Color Badges for Evaluation Status */
    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        min-width: 65px;
        text-center: center;
    }
    .status-good {
        background-color: #d1fae5;
        color: #059669;
    }
    .status-fair {
        background-color: #fef3c7;
        color: #d97706;
    }
    .status-poor {
        background-color: #fee2e2;
        color: #dc2626;
    }
    .status-default {
        background-color: #f1f5f9;
        color: #475569;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="custom-card-header text-center">
                    <small class="text-muted font-weight-bold uppercase tracking-wider">ESSOM REPORT SYSTEM</small>
                    <h4 class="form-title mb-0 mt-1">การประเมินสมรรถนะของผู้ส่งมอบ/ผู้ขาย สำหรับสินค้าและบริการที่ใช้งาน</h4>
                </div>
                
                <div class="card-body p-4">   
                    <div class="table-responsive">
                        <table id="tb_job" class="table modern-table text-center">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">ลำดับ</th>
                                    <th style="width: 25%;" class="text-left">ชื่อบริษัท</th>
                                    <th style="width: 20%;" class="text-left">รายการ</th>
                                    <th>คุณภาพสินค้า</th>
                                    <th>ความเรียบร้อย</th>
                                    <th>บริการผู้ขาย</th>
                                    <th>บริการหลังการขาย</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-left font-weight-bold">{{ $item->vendor_name }}</td>
                                        <td class="text-left text-muted">{{ $item->product_group_name }}</td>
                                        
                                        <td>
                                            @if($item->quality_status == '/' || $item->quality_status == 'ดี' || $item->quality_status == '1')
                                                <span class="status-badge status-good">ดี</span>
                                            @elseif($item->quality_status == 'พอใช้')
                                                <span class="status-badge status-fair">พอใช้</span>
                                            @elseif($item->quality_status == 'ไม่ดี')
                                                <span class="status-badge status-poor">ไม่ดี</span>
                                            @else
                                                <span class="status-badge status-default">{{ $item->quality_status ?: '-' }}</span>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if($item->neatness_status == '/' || $item->neatness_status == 'ดี' || $item->neatness_status == '1')
                                                <span class="status-badge status-good">ดี</span>
                                            @elseif($item->neatness_status == 'พอใช้')
                                                <span class="status-badge status-fair">พอใช้</span>
                                            @elseif($item->neatness_status == 'ไม่ดี')
                                                <span class="status-badge status-poor">ไม่ดี</span>
                                            @else
                                                <span class="status-badge status-default">{{ $item->neatness_status ?: '-' }}</span>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if($item->vendor_service_status == '/' || $item->vendor_service_status == 'ดี' || $item->vendor_service_status == '1')
                                                <span class="status-badge status-good">ดี</span>
                                            @elseif($item->vendor_service_status == 'พอใช้')
                                                <span class="status-badge status-fair">พอใช้</span>
                                            @elseif($item->vendor_service_status == 'ไม่ดี')
                                                <span class="status-badge status-poor">ไม่ดี</span>
                                            @else
                                                <span class="status-badge status-default">{{ $item->vendor_service_status ?: '-' }}</span>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if($item->after_sale_status == '/' || $item->after_sale_status == 'ดี' || $item->after_sale_status == '1')
                                                <span class="status-badge status-good">ดี</span>
                                            @elseif($item->after_sale_status == 'พอใช้')
                                                <span class="status-badge status-fair">พอใช้</span>
                                            @elseif($item->after_sale_status == 'ไม่ดี')
                                                <span class="status-badge status-poor">ไม่ดี</span>
                                            @else
                                                <span class="status-badge status-default">{{ $item->after_sale_status ?: '-' }}</span>
                                            @endif
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
            type: 'string' // ปรับแก้จาก 'time-date-sort' เป็นประเภทข้อความธรรมดา เพื่อป้องกัน DataTables เรียงลำดับชื่อบริษัทผิดพลาด
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
</script>
@endpush