@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Theme Styles for Risk Assessment Table */
    .risk-container {
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
        position: relative;
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
    .doc-meta {
        font-size: 0.8rem;
        color: #94a3b8;
        font-weight: 500;
    }

    /* Modern Buttons */
    .btn-indigo-add {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        padding: 0.5rem 1.25rem !important;
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

    /* Risk Guide Badges */
    .risk-guide-wrapper {
        background-color: #f8fafc;
        border-radius: 12px;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1.5rem;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
    }
    .guide-label {
        font-weight: 700;
        color: #475569;
        font-size: 0.9rem;
    }
    .badge-level {
        padding: 0.4rem 0.75rem !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 0.8rem !important;
    }
    .level-low { background-color: #e2fbe8 !important; color: #15803d !important; }
    .level-middle { background-color: #fef9c3 !important; color: #a16207 !important; }
    .level-high { background-color: #ffedd5 !important; color: #c2410c !important; }
    .level-veryhigh { background-color: #fee2e2 !important; color: #b91c1c !important; }

    /* Table Customization */
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }
    #tb_job {
        margin: 0 !important;
    }
    #tb_job thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 0.75rem !important;
        font-size: 0.9rem;
    }
    #tb_job tbody td {
        padding: 0.75rem !important;
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

    /* Risk Issue Content Layout */
    .risk-meta-content {
        line-height: 1.5;
    }
    .risk-tag {
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.1rem 0.4rem;
        border-radius: 4px;
        background-color: #f1f5f9;
        color: #64748b;
        margin-right: 0.25rem;
    }

    /* Action Status Badges */
    .badge-status-approved {
        background-color: #dcfce7 !important;
        color: #16a34a !important;
        padding: 0.4rem 0.75rem !important;
        border-radius: 6px !important;
        font-weight: 600 !important;
    }
    .badge-status-pending {
        background-color: #e0f2fe !important;
        color: #0284c7 !important;
        padding: 0.4rem 0.75rem !important;
        border-radius: 6px !important;
        font-weight: 600 !important;
    }

    /* Small Circular/Square Action Buttons */
    .btn-action-edit {
        background-color: #fef3c7 !important;
        color: #d97706 !important;
        border: none !important;
        border-radius: 8px !important;
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
        transition: all 0.2s;
    }
    .btn-action-delete:hover {
        background-color: #dc2626 !important;
        color: #ffffff !important;
    }

    /* DataTables Button Stylings Overwrite */
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
</style>

<div class="risk-container">
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div>
                            <div class="company-title">ESSOM CO., LTD</div>
                            <h5 class="main-title">รายงานการประเมินความเสี่ยงและโอกาส</h5>
                        </div>
                        <div class="text-md-right mt-2 mt-md-0 doc-meta">
                            <strong>Form No:</strong> F6120.1<br>
                            <strong>Date:</strong> 15 Feb 22
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('assessrisk.create') }}" class="btn-indigo-add">
                            <i class="fas fa-plus"></i> เพิ่มข้อมูลการประเมินใหม่
                        </a>
                    </div>
                </div>
                
                <div class="card-body">     
                    <div class="risk-guide-wrapper">
                        <span class="guide-label"><i class="fas fa-info-circle text-indigo mr-1"></i> เกณฑ์ระดับความเสี่ยง (Risk Level):</span>
                        <span class="badge badge-level level-low">ต่ำ (Low) : 1-3</span>
                        <span class="badge badge-level level-middle">ปานกลาง (Middle) : 4-9</span>
                        <span class="badge badge-level level-high">สูง (High) : 10-16</span>
                        <span class="badge badge-level level-veryhigh">สูงมาก (Very High) : 20-25</span>
                    </div>
                     
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-striped table-hover table-bordered table-sm w-100">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 15%;">กระบวนการ / ระเบียบ</th>
                                    <th class="text-center" style="width: 10%;">เสนอโดย</th>
                                    <th class="text-center" style="width: 10%;">อนุมัติโดย</th>
                                    <th class="text-center" style="width: 10%;">วันที่เสนอ</th>
                                    <th class="text-center" style="width: 35%;">รายละเอียดประเด็นความเสี่ยง</th>
                                    <th class="text-center" style="width: 8%;">Level</th>
                                    <th class="text-center" style="width: 4%;">แก้ไข</th>
                                    <th class="text-center" style="width: 4%;">อนุมัติ</th>
                                    <th class="text-center" style="width: 4%;">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($risks as $i => $risk)
                                <tr>
                                    <td><strong>{{ $risk->process_ref }}</strong></td>
                                    <td class="text-center">{{ $risk->proposed_by }}</td>
                                    <td class="text-center">{{ $risk->approved_by_1 ? $risk->approved_by_1 : '-' }}</td>
                                    <td class="text-center">{{ $risk->proposed_date }}</td>
                                    <td>
                                        <div class="risk-meta-content">
                                            <div><span class="risk-tag">ประเด็น</span>{{ $risk->risk_issue }}</div>
                                            <div class="text-muted small"><span class="risk-tag">สาเหตุ</span>{{ $risk->risk_cause }}</div>
                                            <div class="text-muted small"><span class="risk-tag">ผลกระทบ</span>{{ $risk->risk_impact }}</div>
                                            @if($risk->risk_accept_reason)
                                                <div class="text-muted small"><span class="risk-tag">เหตุผลที่ยอมรับ</span>{{ $risk->risk_accept_reason }}</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $lvl = $risk->pre_level_1;
                                            $badgeClass = 'level-low';
                                            if($lvl >= 4 && $lvl <= 9) $badgeClass = 'level-middle';
                                            elseif($lvl >= 10 && $lvl <= 16) $badgeClass = 'level-high';
                                            elseif($lvl >= 20) $badgeClass = 'level-veryhigh';
                                        @endphp
                                        <span class="badge badge-level {{ $badgeClass }} d-inline-block w-75">{{ $lvl }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('assessrisk.edit', $risk->id) }}" class="btn btn-sm btn-action-edit" title="แก้ไขข้อมูล">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                       @if ($risk->approved_date_1)
                                            <span class="badge badge-status-approved"><i class="fas fa-check-circle mr-1"></i>อนุมัติแล้ว</span>
                                        @elseif ($risk->approved_status_1 === 'N')
                                            @if ($risk->approved_by_1 === auth()->user()->name)
                                                <a href="{{ route('assessrisk.show', $risk->id) }}" class="btn btn-sm btn-action-approve" title="คลิกเพื่ออนุมัติ">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            @else
                                                <span class="badge badge-status-pending"><i class="far fa-clock mr-1"></i>รออนุมัติ</span>
                                            @endif
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-action-delete" onclick="confirmDel('{{ $risk->id }}')" title="ลบรายการ">
                                            <i class="fas fa-trash"></i>
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
            { extend: 'copy', className: 'btn btn-sm' },
            { extend: 'csv', className: 'btn btn-sm' },
            { extend: 'excel', className: 'btn btn-sm' },
            { extend: 'pdf', className: 'btn btn-sm' },
            { extend: 'print', className: 'btn btn-sm' }
        ],
        columnDefs: [{
            targets: 3, // แก้ไข Target Index ให้ตรงกับคอลัมน์ "วันที่เสนอ" (0-based index)
            type: 'time-date-sort'
        }],
        order: [
            [3, "asc"]
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
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

confirmDel = (refid) => {       
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
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelAssessrisk') }}`,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "refid": refid
                },
                dataType: "json",
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire({
                            title: 'ลบข้อมูลสำเร็จ',
                            text: 'ระบบได้ทำการลบข้อมูลการประเมินความเสี่ยงเรียบร้อยแล้ว',
                            icon: 'success',
                            confirmButtonText: 'ตกลง',
                            customClass: { confirmButton: 'btn btn-action-approve px-4' },
                            buttonsStyling: false
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถลบข้อมูลเอกสารชิ้นนี้ได้ กรุณาลองใหม่อีกครั้ง',
                            icon: 'error',
                            confirmButtonText: 'ปิด',
                            customClass: { confirmButton: 'btn btn-action-delete px-4' },
                            buttonsStyling: false
                        });
                    }
                }
            });
        }
    });
}
</script>
@endpush