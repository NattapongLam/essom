@extends('layouts.main')
@section('content')

<!-- DataTables & Sweet Alert 2 Modern Styling -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Theme Layout Structure */
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

    /* Elegant Header Component */
    .card-header-modern {
        background-color: #ffffff;
        padding: 2.5rem 2.5rem 1.5rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-title-block h5 {
        font-size: 1.1rem;
        letter-spacing: 1px;
        color: #475569;
        font-weight: 500;
        margin: 0;
        line-height: 1.5;
    }

    .header-title-block h2 {
        font-weight: 700;
        color: #1e293b;
        margin-top: 8px;
        margin-bottom: 0;
        font-size: 1.4rem;
        line-height: 1.4;
    }

    .doc-number-badge {
        position: absolute;
        top: 2.5rem;
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

    /* Action Toolbar Layout */
    .action-toolbar {
        display: flex;
        justify-content: flex-start;
        padding: 1.5rem 2.5rem 0rem 2.5rem;
    }

    /* Premium Grid Table Design */
    .table-responsive-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    table.table-modern {
        width: 100% !important;
        margin-bottom: 0 !important;
        font-size: 0.85rem;
    }

    table.table-modern th {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
        font-weight: 600;
        border: 1px solid #4338ca !important;
        padding: 12px 6px !important;
        vertical-align: middle;
        font-size: 0.82rem;
    }

    table.table-modern td {
        padding: 10px 6px !important;
        border: 1px solid #e2e8f0 !important;
        vertical-align: middle !important;
        background-color: #ffffff;
        color: #334155;
    }

    table.table-modern tbody tr:hover td {
        background-color: #f8fafc !important;
    }

    /* Custom Navigation & Action Buttons Interface */
    .btn-indigo-add {
        background: #4f46e5;
        color: #ffffff !important;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.2s;
        text-decoration: none !important;
    }
    .btn-indigo-add:hover {
        background: #4338ca;
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    .btn-action-edit {
        background-color: #f59e0b;
        color: #ffffff !important;
        border: none;
        padding: 6px 10px;
        border-radius: 6px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-action-edit:hover {
        background-color: #d97706;
        transform: scale(1.05);
    }

    /* Document Link Badges Styles */
    .doc-link-btn {
        color: #4f46e5 !important;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s;
    }
    .doc-link-btn:hover {
        color: #312e81;
        text-decoration: underline;
    }

    .file-icon-btn {
        color: #64748b;
        margin-left: 4px;
        transition: color 0.2s;
    }
    .file-icon-btn:hover {
        color: #4f46e5;
    }

    /* Status Pill Badges Styling */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 0.78rem;
        font-weight: 600;
        line-height: 1;
    }
    
    .status-badge-success {
        background-color: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .status-badge-danger {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #fca5a5;
    }

    /* Overriding DataTables standard features for styling */
    .dt-buttons {
        margin-bottom: 20px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #4f46e5 !important;
        color: white !important;
        border-color: #4f46e5 !important;
        border-radius: 6px;
    }
    
    @media (max-width: 992px) {
        .doc-number-badge { position: relative; top: 0; right: 0; text-align: left; display: inline-block; margin-top: 15px; }
        .card-header-modern { padding: 1.5rem; }
        .action-toolbar { padding: 1.5rem 1.5rem 0rem 1.5rem; }
    }
</style>

<div class="container-fluid custom-container">
    <div class="card form-card">
        
        <!-- Document Card Header Section -->
        <div class="card-header-modern">
            <div class="header-title-block text-center">
                <h5>ESSOM CO., LTD.</h5>
                <h2>ทะเบียนควบคุมเอกสาร (Documents Control Status)</h2>
            </div>
            <div class="doc-number-badge">
                <strong>F7530.1</strong><br>1 Oct. 20
            </div>
        </div>

        <!-- Upper Control Toolbar -->
        <div class="action-toolbar">
            <a href="{{ route('document-register.create') }}" class="btn-indigo-add">
                <i class="fas fa-plus"></i> เพิ่มเอกสาร
            </a>
        </div>

        <!-- Dynamic Responsive Table Workspace -->
        <div class="card-body" style="padding: 1.5rem 2.5rem 2.5rem 2.5rem;">             
            <div class="table-responsive-container">
                <table id="tb_job" class="table table-modern text-center m-0">
                    <thead>
                        <tr>
                            <th style="width: 8%;">สถานะ</th>
                            <th style="width: 4%;">ที่</th>
                            <th style="text-align: left; padding-left: 10px; width: 14%;">Doc. No</th>
                            <th style="text-align: left; padding-left: 10px;">Description</th>
                            <th style="width: 5%;">Rev.01</th>
                            <th style="width: 5%;">Rev.02</th>
                            <th style="width: 5%;">Rev.03</th>
                            <th style="width: 5%;">Rev.04</th>
                            <th style="width: 5%;">Rev.05</th>
                            <th style="width: 5%;">Rev.06</th>
                            <th style="width: 5%;">Rev.07</th>
                            <th style="width: 5%;">Rev.08</th>
                            <th style="width: 5%;">Rev.09</th>
                            <th style="width: 5%;">Rev.10</th>
                            <th style="width: 5%;">แก้ไข</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hd as $item)
                        <tr>
                            <td>
                                @if ($item->documentregisters_flag)
                                    <span class="status-badge status-badge-success">ใช้งาน</span>
                                @else
                                    <span class="status-badge status-badge-danger">ไม่ใช้งาน</span>
                                @endif
                            </td>
                            <td class="font-weight-bold text-secondary">{{ $item->documentregisters_listno }}</td>
                            <td style="text-align: left; padding-left: 10px;">
                                <a href="{{ asset($item->documentregisters_file) }}" target="_blank" class="doc-link-btn" title="เปิดดูเอกสารหลัก">
                                    {{ $item->documentregisters_docuno }}
                                </a>
                                @if ($item->documentregisters_file1)
                                    <a href="{{ asset($item->documentregisters_file1) }}" target="_blank" class="file-icon-btn" title="ไฟล์แนบ 1">
                                        <i class="fas fa-file-alt"></i>
                                    </a>
                                @endif
                                @if ($item->documentregisters_file2)
                                    <a href="{{ asset($item->documentregisters_file2) }}" target="_blank" class="file-icon-btn" title="ไฟล์แนบ 2">
                                        <i class="fas fa-file-alt"></i>
                                    </a>
                                @endif
                            </td>
                            <td style="text-align: left; padding-left: 10px;">{{ $item->documentregisters_remark }}</td>
                            <td>{{ $item->documentregisters_rev01 }}</td>
                            <td>{{ $item->documentregisters_rev02 }}</td>
                            <td>{{ $item->documentregisters_rev03 }}</td>
                            <td>{{ $item->documentregisters_rev04 }}</td>
                            <td>{{ $item->documentregisters_rev05 }}</td>
                            <td>{{ $item->documentregisters_rev06 }}</td>
                            <td>{{ $item->documentregisters_rev07 }}</td>
                            <td>{{ $item->documentregisters_rev08 }}</td>
                            <td>{{ $item->documentregisters_rev09 }}</td>
                            <td>{{ $item->documentregisters_rev10 }}</td>
                            <td>
                                <a href="{{ route('document-register.edit', $item->documentregisters_id) }}" class="btn btn-action-edit" title="แก้ไขเอกสาร">
                                    <i class="fas fa-edit"></i>
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
            targets: 1, // ยึดการ Sort ตามลำดับ "ที่"
            type: 'num'
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
</script>
@endpush