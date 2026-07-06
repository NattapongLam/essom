@extends('layouts.main')
@section('content')

<!-- Sweet Alert & Modern Indigo Styles -->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    /* Modern Indigo Theme Variables */
    :root {
        --indigo-primary: #6366f1;
        --indigo-dark: #4338ca;
        --indigo-light: #e0e7ff;
        --indigo-bg: #f8fafc;
        --radius-md: 12px;
        --radius-sm: 8px;
    }

    body {
        background-color: var(--indigo-bg);
    }

    .modern-card {
        border: none;
        border-radius: var(--radius-md);
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
        background: #ffffff;
        overflow: hidden;
    }

    .modern-header {
        background: linear-gradient(135deg, var(--indigo-dark) 0%, var(--indigo-primary) 100%);
        color: #ffffff;
        padding: 1.5rem;
        border-bottom: none;
    }

    .modern-header h5 {
        font-weight: 700;
        letter-spacing: 0.5px;
        margin: 0;
    }

    /* Table Styling */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: var(--radius-sm);
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .table-modern thead th {
        background-color: var(--indigo-light) !important;
        color: var(--indigo-dark) !important;
        font-weight: 600;
        border-bottom: 2px solid #cbd5e1 !important;
        padding: 12px 8px !important;
        vertical-align: middle !important;
    }

    .table-modern tbody tr {
        transition: background-color 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background-color: #f1f5f9 !important;
    }

    .table-modern tbody td {
        padding: 12px 8px !important;
        vertical-align: middle !important;
        color: #334155;
    }

    /* DataTables Customization Overrides เพื่อให้เข้ากับโทนสีม่วง */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: var(--indigo-primary) !important;
        border-color: var(--indigo-primary) !important;
        color: white !important;
        border-radius: var(--radius-sm);
    }

    .dt-buttons .dt-button {
        background: #ffffff !important;
        color: var(--indigo-dark) !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: var(--radius-sm) !important;
        padding: 5px 15px !important;
        font-weight: 500 !important;
        transition: all 0.2s;
    }

    .dt-buttons .dt-button:hover {
        background: var(--indigo-light) !important;
        border-color: var(--indigo-primary) !important;
    }
</style>

<div class="container-fluid mt-4">
    <div class="row">  
        <div class="col-12">
            <div class="card modern-card">
                <!-- Header ส่วนหัวข้อไล่เฉดสีม่วงอินดิโก -->
                <div class="card-header modern-header text-center">
                    <h5 class="m-0">การประเมินสมรรถนะของผู้ส่งมอบ/ผู้ขาย สำหรับสินค้าและบริการที่ใช้งาน</h5>
                </div>
                
                <div class="card-body p-4">   
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-modern text-center w-100">
                            <thead>
                                <tr>
                                    <th style="width: 5%">ลำดับ</th>
                                    <th style="width: 25%">ชื่อบริษัท</th>
                                    <th style="width: 20%">รายการ</th>
                                    <th style="width: 12%">คุณภาพการใช้งานของสินค้า</th>
                                    <th style="width: 12%">ความเรียบร้อยของสินค้า</th>
                                    <th style="width: 12%">บริการของผู้ขาย</th>
                                    <th style="width: 14%">การให้บริการหลังการขาย</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $key => $item)
                                    <tr>
                                        <td class="font-weight-bold bg-light">{{ $key + 1 }}</td>
                                        <td class="text-left font-weight-500">{{ $item->vendor_name }}</td>
                                        <td class="text-left">{{ $item->product_group_name }}</td>
                                        <td>{{ $item->quality_status }}</td>
                                        <td>{{ $item->neatness_status }}</td>
                                        <td>{{ $item->vendor_service_status }}</td>
                                        <td>{{ $item->after_sale_status }}</td>
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