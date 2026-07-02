@extends('layouts.main')
@section('content')

{{-- @push('styles') --}}
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}

<style>
    /* Modern Indigo Theme Setup */
    .custom-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05);
        border: 1px solid #e2e8f0;
        margin-top: 30px;
        margin-bottom: 30px;
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
        overflow: hidden;
    }
    
    .card-header-modern {
        background-color: #ffffff;
        padding: 2rem 2.5rem 1.5rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .title-block h5 {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
        font-size: 1.4rem;
        line-height: 1.4;
    }

    .doc-meta {
        font-size: 0.85rem;
        color: #64748b;
        text-align: right;
        line-height: 1.4;
    }

    /* Action Button - Create Data */
    .btn-indigo-add {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: #ffffff !important;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.2s ease;
    }
    .btn-indigo-add:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    /* Table Responsive Style */
    .table-responsive-container {
        padding: 1.5rem 2.5rem 2.5rem 2.5rem;
    }
    
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    table.table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.88rem;
        color: #334155;
        margin-bottom: 0 !important;
    }
    
    table.table-modern th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 14px 10px;
        font-size: 0.85rem;
    }

    table.table-modern td {
        padding: 12px 10px;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
        line-height: 1.5;
    }

    table.table-modern tbody tr:hover {
        background-color: #f1f5f9;
    }

    /* Meta Small Text in Cells */
    .text-meta-date {
        display: block;
        font-size: 0.78rem;
        color: #64748b;
        margin-top: 2px;
    }

    .activity-item {
        padding: 4px 0;
        border-bottom: 1px dashed #e2e8f0;
    }
    .activity-item:last-child {
        border-bottom: none;
    }

    /* Operational Action Buttons */
    .btn-action-edit {
        background-color: #fef3c7;
        color: #d97706;
        border: 1px solid #fde68a;
        padding: 6px 10px;
        border-radius: 6px;
        transition: all 0.2s;
        display: inline-block;
    }
    .btn-action-edit:hover {
        background-color: #d97706;
        color: #ffffff;
    }

    .btn-action-approve {
        background-color: #e0e7ff;
        color: #4f46e5;
        border: 1px solid #c7d2fe;
        padding: 6px 10px;
        border-radius: 6px;
        transition: all 0.2s;
        display: inline-block;
    }
    .btn-action-approve:hover {
        background-color: #4f46e5;
        color: #ffffff;
    }

    .btn-action-delete {
        background-color: #fff5f5;
        color: #e53e3e;
        border: 1px solid #fed7d7;
        padding: 6px 10px;
        border-radius: 6px;
        transition: all 0.2s;
        background-image: none;
    }
    .btn-action-delete:hover {
        background-color: #e53e3e;
        color: #ffffff;
    }

    /* DataTable Overrides to Match Indigo Theme */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #4f46e5 !important;
        color: white !important;
        border: 1px solid #4f46e5 !important;
        border-radius: 6px;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #cbd5e1 !important;
        border-radius: 6px !important;
        padding: 5px 10px !important;
    }

    @media (max-width: 768px) {
        .header-container { flex-direction: column; text-align: center; }
        .doc-meta { text-align: center; margin-top: 5px; }
        .table-responsive-container { padding: 1rem; }
    }
</style>

<div class="container-fluid">
    <div class="card custom-card">
        
        <div class="card-header-modern">
            <div class="header-container">
                <div class="title-block">
                    <h5>ESSOM CO., LTD<br>PLAN</h5>
                </div>
                <div>
                    <a href="{{ route('iso-plan.create') }}" class="btn-indigo-add">
                        <i class="fas fa-plus"></i> เพิ่มเอกสารแผนงาน
                    </a>
                </div>
                <div class="doc-meta">
                    <strong>F6200.2</strong><br>14 Oct 20
                </div>
            </div>
        </div>

        <div class="table-responsive-container">
            <div class="table-responsive">
                <table id="tb_job" class="table table-modern text-center">
                    <thead>
                        <tr>
                            <th style="width: 4%">No.</th>
                            <th style="width: 12%">Project</th>
                            <th style="width: 12%">Responsible Section / Person</th>
                            <th style="width: 20%">Description of Activities</th>
                            <th style="width: 10%">Progress Review</th>
                            <th style="width: 8%">Reviewed by</th>
                            <th style="width: 8%">Reported by</th>
                            <th style="width: 8%">Approved by</th>
                            <th style="width: 8%">Acknowledged by</th>
                            <th style="width: 3%">แก้ไข</th>
                            <th style="width: 3%">อนุมัติ</th>
                            <th style="width: 4%">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse($records as $plan)
                            @php $activities = json_decode($plan->activities, true) ?? []; @endphp
                            <tr>
                                <td class="font-weight-bold" style="color: #64748b;">{{ $no++ }}</td>
                                <td class="text-left font-weight-bold" style="color: #1e293b;">{{ $plan->project_name ?? '-' }}</td>
                                <td>{{ $plan->responsible_section ?? '-' }}</td>
                                <td class="text-left">
                                    @if(count($activities) > 0)
                                        @foreach($activities as $act)
                                            <div class="activity-item">
                                                <span>• {{ $act['description'] ?? '-' }}</span><br>
                                                <small class="text-muted" style="margin-left: 8px;">Responsible: {{ $act['responsible_person'] ?? '-' }}</small>
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $plan->prepared_progress_review ?? '-' }}
                                    @if(isset($plan->prepared_progress_date))
                                        <span class="text-meta-date">({{ \Carbon\Carbon::parse($plan->prepared_progress_date)->format('Y-m-d') }})</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $plan->reviewed_by ?? '-' }}
                                    @if(isset($plan->reviewed_date))
                                        <span class="text-meta-date">({{ \Carbon\Carbon::parse($plan->reviewed_date)->format('Y-m-d') }})</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $plan->reported_by ?? '-' }}
                                    @if(isset($plan->reported_date))
                                        <span class="text-meta-date">({{ \Carbon\Carbon::parse($plan->reported_date)->format('Y-m-d') }})</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $plan->approved_by ?? '-' }}
                                    @if(isset($plan->approved_date))
                                        <span class="text-meta-date">({{ \Carbon\Carbon::parse($plan->approved_date)->format('Y-m-d') }})</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $plan->acknowledged_by ?? '-' }}
                                    @if(isset($plan->acknowledged_date))
                                        <span class="text-meta-date">({{ \Carbon\Carbon::parse($plan->acknowledged_date)->format('Y-m-d') }})</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('iso-plan.edit', $plan->id) }}" class="btn-action-edit" title="แก้ไข">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('iso-plan.show', $plan->id) }}" class="btn-action-approve" title="อนุมัติ / ตรวจสอบ">
                                        <i class="fas fa-check"></i>
                                    </a>
                                </td>
                                <td>
                                    <form id="delete-form-{{ $plan->id }}" action="{{ route('iso-plan.destroy', $plan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-action-delete" onclick="confirmDel({{ $plan->id }})" title="ลบรายการ">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-muted py-4">ไม่พบข้อมูลแผนงานในระบบ</td>
                            </tr>
                        @endforelse
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
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "ทั้งหมด"]],
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        fixedHeader: { header: false, footer: false },
        pagingType: "full_numbers",
        bSort: true
    });
});

function confirmDel(id) {
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่?',
        text: 'คุณต้องการลบรายการแผนงานนี้ออกจากระบบใช่หรือไม่?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยันการลบ',
        cancelButtonText: 'ยกเลิก',
        confirmButtonClass: 'btn btn-success px-4 py-2 text-white font-weight-bold rounded',
        cancelButtonClass: 'btn btn-danger ms-2 px-4 py-2 text-white font-weight-bold rounded',
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endpush