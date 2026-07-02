@extends('layouts.main')
@section('content')

<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Theme Layout Structure */
    .custom-container {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .table-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    /* Elegant Header Design Component */
    .card-header-modern {
        background-color: #ffffff;
        padding: 2rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .header-title-block h2 {
        font-weight: 700;
        color: #1e293b;
        margin-top: 5px;
        margin-bottom: 0;
        font-size: 1.4rem;
        line-height: 1.4;
    }

    .header-title-block h5 {
        font-size: 1.05rem;
        letter-spacing: 0.5px;
        color: #64748b;
        font-weight: 500;
        margin: 0;
    }

    .doc-meta-block {
        text-align: right;
        font-size: 0.8rem;
        color: #94a3b8;
        line-height: 1.4;
    }

    /* Premium Dynamic Action Buttons */
    .btn-indigo-action {
        background: #4f46e5;
        color: #ffffff !important;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.2s;
        text-decoration: none !important;
    }

    .btn-indigo-action:hover {
        background: #4338ca;
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    /* Modernized Table Design */
    .table-responsive {
        padding: 1.5rem;
    }

    .table-modern {
        border-collapse: separate !important;
        border-spacing: 0 !important;
        width: 100% !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 10px !important;
        overflow: hidden;
    }

    .table-modern thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        font-size: 0.85rem !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 8px !important;
        border-bottom: 2px solid #e2e8f0 !important;
        border-top: none !important;
    }

    .table-modern tbody td {
        padding: 12px 8px !important;
        font-size: 0.9rem !important;
        color: #334155 !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .table-modern tbody tr:hover td {
        background-color: #fcfcff !important;
    }

    /* Status Badges */
    .badge-modern {
        padding: 6px 12px;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 6px;
    }
    .badge-success-light {
        background-color: #dcfce7;
        color: #15803d;
    }
    .badge-danger-light {
        background-color: #fee2e2;
        color: #b91c1c;
    }

    /* Document Links & Inline Files Buttons */
    .doc-link {
        color: #4f46e5 !important;
        font-weight: 600;
        text-decoration: none !important;
        transition: color 0.2s;
    }
    .doc-link:hover {
        color: #2563eb !important;
        text-decoration: underline !important;
    }

    .inline-file-btn {
        color: #64748b;
        margin-left: 4px;
        transition: color 0.2s;
    }
    .inline-file-btn:hover {
        color: #4f46e5;
    }

    /* Distribution Action Button */
    .btn-distribute {
        background-color: #ffedd5;
        color: #ea580c !important;
        border: 1px solid #fed7aa;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none !important;
    }
    .btn-distribute:hover {
        background-color: #ea580c;
        color: #ffffff !important;
        box-shadow: 0 4px 10px rgba(234, 88, 12, 0.15);
    }

    /* Datatable Custom Filter Overrides */
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #cbd5e1 !important;
        border-radius: 6px !important;
        padding: 6px 12px !important;
        background-color: #ffffff !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #818cf8 !important;
        outline: none !important;
    }

    @media (max-width: 768px) {
        .card-header-modern { flex-direction: column; text-align: center; padding: 1.5rem; }
        .doc-meta-block { text-align: center; }
    }
</style>

<div class="container-fluid custom-container">
    <div class="card table-card">
        
        <div class="card-header-modern">
            <div class="header-title-block">
                <h5>ESSOM CO., LTD.</h5>
                <h2>ทะเบียนแจกจ่ายเอกสาร (Documents Distribution Status)</h2>
            </div>
            
            <div>
                <a href="{{ route('document-distribution.create') }}" class="btn-indigo-action">
                    <i class="fas fa-search-file"></i> ตรวจสอบเอกสาร
                </a>
            </div>

            <div class="doc-meta-block">
                <strong>F7530.2</strong><br>26 Aug 19
            </div>
        </div>

        <div class="card-body p-0">             
            <div class="table-responsive">
                <table id="tb_job" class="table table-modern text-center">
                    <thead>
                        <tr>
                            <th style="width: 90px;">สถานะ</th>
                            <th style="width: 50px;">ที่</th>
                            <th>Doc No.</th>
                            <th>Description</th>
                            <th>Rev.01</th>
                            <th>Rev.02</th>
                            <th>Rev.03</th>
                            <th>Rev.04</th>
                            <th>Rev.05</th>
                            <th>Rev.06</th>
                            <th>Rev.07</th>
                            <th>Rev.08</th>
                            <th>Rev.09</th>
                            <th>Rev.10</th>
                            <th style="width: 100px;">แจกจ่าย</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hd as $item)
                            <tr>
                                <td>
                                    @if ($item->documentregisters_flag)
                                        <span class="badge badge-modern badge-success-light">ใช้งาน</span>
                                    @else
                                        <span class="badge badge-modern badge-danger-light">ไม่ใช้งาน</span>
                                    @endif
                                </td>
                                <td>{{ $item->documentregisters_listno }}</td>
                                <td>
                                    <a href="{{ asset($item->documentregisters_file) }}" target="_blank" class="doc-link">
                                        {{ $item->documentregisters_docuno }}
                                    </a>
                                    @if ($item->documentregisters_file1)
                                        <a href="{{ asset($item->documentregisters_file1) }}" target="_blank" class="inline-file-btn" title="เอกสารแนบ 1">
                                            <i class="fas fa-paperclip"></i>
                                        </a>
                                    @endif
                                    @if ($item->documentregisters_file2)
                                        <a href="{{ asset($item->documentregisters_file2) }}" target="_blank" class="inline-file-btn" title="เอกสารอ้างอิง">
                                            <i class="fas fa-link"></i>
                                        </a>
                                    @endif
                                </td>
                                <td class="text-left">{{ $item->documentregisters_remark }}</td>
                                <td>{{ $item->documentregisters_rev01 ?? '-' }}</td>
                                <td>{{ $item->documentregisters_rev02 ?? '-' }}</td>
                                <td>{{ $item->documentregisters_rev03 ?? '-' }}</td>
                                <td>{{ $item->documentregisters_rev04 ?? '-' }}</td>
                                <td>{{ $item->documentregisters_rev05 ?? '-' }}</td>
                                <td>{{ $item->documentregisters_rev06 ?? '-' }}</td>
                                <td>{{ $item->documentregisters_rev07 ?? '-' }}</td>
                                <td>{{ $item->documentregisters_rev08 ?? '-' }}</td>
                                <td>{{ $item->documentregisters_rev09 ?? '-' }}</td>
                                <td>{{ $item->documentregisters_rev10 ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('document-distribution.show', $item->documentregisters_id) }}" class="btn-distribute" title="ดำเนินการแจกจ่าย">
                                        <i class="fas fa-paper-plane"></i> จัดการ
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
            [1, "asc"] /* เปลี่ยนมาเรียงตามลำดับ "ที่" (คอลัมน์ Index 1) เพื่อความถูกต้องของทะเบียน */
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