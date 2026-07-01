@extends('layouts.main')
@section('content')
<!-- DataTables & SweetAlert2 Resources -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#4f46e5',
            customClass: { confirmButton: 'px-4 py-2 text-white font-weight-bold rounded' }
        });
    </script>
@endif

<style>
    /* Modern Indigo Theme Styles for SWOT Risk Analysis Table */
    .swot-container {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        padding: 1.5rem 0;
    }
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.05) !important;
        background: #ffffff;
        overflow: hidden;
    }
    .card-header {
        background: #ffffff !important;
        padding: 1.5rem 1.75rem !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .company-title {
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 1px;
        color: #6366f1;
        margin-bottom: 0.25rem;
    }
    .main-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    /* Modern Indigo Button */
    .btn-indigo-add {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        padding: 0.55rem 1.35rem !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        font-size: 0.9rem;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2) !important;
        transition: all 0.2s ease !important;
        border: none !important;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-indigo-add:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3) !important;
        transform: translateY(-1px);
        color: #ffffff !important;
        text-decoration: none;
    }

    /* Table Customization */
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }
    #swotTable {
        margin: 0 !important;
    }
    #swotTable thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 0.85rem 0.5rem !important;
        font-size: 0.9rem;
        vertical-align: middle !important;
    }
    #swotTable tbody td {
        padding: 0.85rem 0.6rem !important;
        vertical-align: middle !important;
        color: #334155;
        font-size: 0.9rem;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(248, 250, 252, 0.5) !important;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(99, 102, 241, 0.02) !important;
    }

    /* Pastel Action Buttons */
    .btn-action-edit {
        background-color: #fef3c7 !important;
        color: #d97706 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 0.35rem 0.55rem !important;
        transition: all 0.2s;
    }
    .btn-action-edit:hover {
        background-color: #d97706 !important;
        color: #ffffff !important;
    }
    .btn-action-approve {
        background-color: #e0e7ff !important;
        color: #4f46e5 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 0.35rem 0.55rem !important;
        transition: all 0.2s;
    }
    .btn-action-approve:hover {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
    }
    .btn-action-delete {
        background-color: #fee2e2 !important;
        color: #dc2626 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 0.35rem 0.55rem !important;
        transition: all 0.2s;
    }
    .btn-action-delete:hover {
        background-color: #dc2626 !important;
        color: #ffffff !important;
    }

    /* DataTables Layout Overwrites */
    .dt-buttons .btn {
        background-color: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #475569 !important;
        border-radius: 6px !important;
        font-size: 0.85rem !important;
        font-weight: 500 !important;
        margin-right: 0.25rem;
    }
    .dt-buttons .btn:hover {
        background-color: #f1f5f9 !important;
        color: #1e293b !important;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 0.3rem 0.75rem !important;
        outline: none;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1) !important;
    }
</style>

<div class="swot-container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div>
                            <div class="company-title">ESSOM CO., LTD.</div>
                            <h5 class="main-title">คำขอแก้ไขแบบฟอร์มการวิเคราะห์ความเสี่ยงต่อธุรกิจของบริษัท (SWOT)</h5>
                        </div>
                        <div class="mt-3 mt-md-0">
                            <a href="{{ route('assessrisk-swot.create') }}" class="btn-indigo-add">
                                <i class="fas fa-plus"></i> เพิ่มข้อมูลใหม่
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="swotTable" class="table table-striped table-hover table-bordered text-center w-100">
                            <thead>
                                <tr>
                                    <th style="width: 12%;">วันที่ประชุม</th>
                                    <th style="width: 15%;">ผู้รายงาน</th>
                                    <th style="width: 16%;">Strengths</th>
                                    <th style="width: 16%;">Weaknesses</th>
                                    <th style="width: 16%;">Opportunities</th>
                                    <th style="width: 16%;">Threats</th>
                                    <th style="width: 3%;">แก้ไข</th>
                                    <th style="width: 3%;">อนุมัติ</th>
                                    <th style="width: 3%;">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                    @if ($record->strength != null && $record->weakness != null && $record->opportunity != null && $record->threat != null)
                                    <tr>
                                        <td>{{ $record->meeting_date ? \Carbon\Carbon::parse($record->meeting_date)->format('Y-m-d') : '-' }}</td>
                                        <td>{{ $record->report_by }}</td>
                                        <td class="text-left">
                                            @php
                                                $strengths = json_decode($record->strength, true);
                                                $strengths = is_array($strengths) ? $strengths : [];
                                                $strength_risks = array_column($strengths, 'risk');
                                            @endphp
                                            {{ implode(', ', $strength_risks) }}
                                        </td>
                                        <td class="text-left">
                                            @php
                                                $weaknesses = json_decode($record->weakness, true);
                                                $weaknesses = is_array($weaknesses) ? $weaknesses : [];
                                                $weakness_risks = array_column($weaknesses, 'risk');
                                            @endphp
                                            {{ implode(', ', $weakness_risks) }}
                                        </td>
                                        <td class="text-left">
                                            @php
                                                $opportunities = json_decode($record->opportunity, true);
                                                $opportunities = is_array($opportunities) ? $opportunities : [];
                                                $opportunity_risks = array_column($opportunities, 'risk');
                                            @endphp
                                            {{ implode(', ', $opportunity_risks) }}
                                        </td>
                                        <td class="text-left">
                                            @php
                                                $threats = json_decode($record->threat, true);
                                                $threats = is_array($threats) ? $threats : [];
                                                $threat_risks = array_column($threats, 'risk');
                                            @endphp
                                            {{ implode(', ', $threat_risks) }}
                                        </td>
                                        <td>
                                            <a href="{{ route('assessrisk-swot.edit', $record->id) }}" class="btn btn-sm btn-action-edit" title="แก้ไข">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('assessrisk-swot.show', $record->id) }}" class="btn btn-sm btn-action-approve" title="ตรวจสอบ / อนุมัติ">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-action-delete" onclick="confirmDel('{{ $record->id }}')" title="ลบ">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
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
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
        function confirmDel(id) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่ที่จะลบ ?',
                text: "เมื่อยืนยันแล้ว ข้อมูลส่วนนี้จะไม่สามารถกู้คืนได้อีกต่อไป!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-check mr-1"></i> ยืนยันการลบ',
                cancelButtonText: 'ยกเลิก',
                customClass: {
                    confirmButton: 'btn btn-action-delete px-4 py-2 mx-2',
                    cancelButton: 'btn btn-secondary px-4 py-2 mx-2'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/assessrisk-swot/${id}`;

                    const token = document.createElement('input');
                    token.type = 'hidden';
                    token.name = '_token';
                    token.value = '{{ csrf_token() }}';
                    form.appendChild(token);

                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        $(document).ready(function () {
            $('#swotTable').DataTable({
                "pageLength": 50,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'copy', className: 'btn btn-sm' },
                    { extend: 'csv', className: 'btn btn-sm' },
                    { extend: 'excel', className: 'btn btn-sm' },
                    { extend: 'pdf', className: 'btn btn-sm' },
                    { extend: 'print', className: 'btn btn-sm' }
                ],
                order: [[0, "desc"]],
                fixedHeader: true,
                pagingType: "full_numbers",
                bSort: true,
                "language": {
                    "search": "ค้นหาข้อมูล:",
                    "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
                    "info": "แสดงรายการที่ _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                    "infoEmpty": "ไม่มีข้อมูลที่จะแสดง",
                    "zeroRecords": "ไม่พบข้อมูลที่ค้นหา",
                    "paginate": {
                        "first": "หน้าแรก",
                        "last": "หน้าสุดท้าย",
                        "next": "ถัดไป",
                        "previous": "ก่อนหน้า"
                    }
                }
            });
        });
    </script>
@endpush