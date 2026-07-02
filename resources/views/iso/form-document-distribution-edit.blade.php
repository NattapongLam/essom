@extends('layouts.main')
@section('content')

<!-- Third-Party Essential Assets -->
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

    /* Elegant Header Design Component */
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
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        color: #64748b;
    }

    /* Custom Responsive Interactive Grid/Table */
    .table-modern-wrapper {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        background-color: #ffffff;
    }

    .table-modern {
        margin-bottom: 0 !important;
    }

    .table-modern thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700;
        font-size: 0.82rem;
        padding: 14px 8px !important;
        border-bottom: 2px solid #e2e8f0 !important;
        border-top: none !important;
    }

    .table-modern tbody td {
        padding: 12px 8px !important;
        font-size: 0.88rem;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    /* Status Badges & Action Link Overrides */
    .badge-modern {
        padding: 5px 10px;
        font-weight: 600;
        border-radius: 6px;
        font-size: 0.78rem;
    }
    
    .badge-modern-success { background-color: #ecfdf5; color: #059669; }
    .badge-modern-danger { background-color: #fef2f2; color: #dc2626; }

    .doc-link {
        color: #4f46e5;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.15s;
    }
    .doc-link:hover {
        color: #312e81;
        text-decoration: underline;
    }

    /* Premium Dynamic Action Buttons */
    .btn-indigo-action {
        color: #4f46e5;
        background-color: #f5f3ff;
        border: 1px solid #e0e7ff;
        padding: 6px 12px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-indigo-action:hover {
        background-color: #4f46e5;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
    }

    @media (max-width: 992px) {
        .doc-number-badge { position: relative; top: 0; right: 0; text-align: left; display: inline-block; margin-top: 10px; }
        .card-header-modern { padding: 1.5rem; }
    }
</style>

<div class="container-fluid custom-container">
    <div class="card form-card">
        
        <!-- Document Card Header Section -->
        <div class="card-header-modern">
            <div class="header-title-block text-center">
                <h5>ESSOM CO., LTD.</h5>
                <h2>ทะเบียนแจกจ่ายเอกสาร (Documents Distribution Status)</h2>
            </div>
            <div class="doc-number-badge">
                <strong>F7530.2</strong>
            </div>
        </div>

        <!-- Form Table Content Section -->
        <div class="card-body" style="padding: 2rem;">
            <div class="table-modern-wrapper table-responsive">
                <table id="tb_job" class="table table-modern text-center">
                    <thead>
                        <tr>
                            <th style="min-width: 90px;">สถานะ</th>
                            <th style="min-width: 50px;">ที่</th>
                            <th style="min-width: 130px;">Doc.</th>
                            <th style="text-align: left; min-width: 200px;">Description</th>
                            <th>Rev.1</th>
                            <th>Rev.2</th>
                            <th>Rev.3</th>
                            <th>Rev.4</th>
                            <th>Rev.5</th>
                            <th>Rev.6</th>
                            <th>Rev.7</th>
                            <th>Rev.8</th>
                            <th>Rev.9</th>
                            <th>Rev.10</th>
                            <th style="min-width: 80px;">รับทราบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                            <tr>
                                <td>
                                    @if ($item->documentregisters_flag)
                                        <span class="badge badge-modern badge-modern-success">ใช้งาน</span>
                                    @else
                                        <span class="badge badge-modern badge-modern-danger">ไม่ใช้งาน</span>
                                    @endif
                                </td>
                                <td class="text-muted font-weight-bold">{{$item->documentregisters_listno}}</td>
                                <td>
                                    <a href="{{asset($item->documentregisters_file)}}" target="_blank" class="doc-link">
                                        {{$item->documentregisters_docuno}}
                                    </a>
                                    @if ($item->documentregisters_file1)
                                        <a href="{{asset($item->documentregisters_file1)}}" target="_blank" class="text-indigo ml-1" title="ไฟล์แนบ 1">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                    @endif
                                    @if ($item->documentregisters_file2)
                                        <a href="{{asset($item->documentregisters_file2)}}" target="_blank" class="text-indigo ml-1" title="ไฟล์แนบ 2">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                    @endif
                                </td>
                                <td style="text-align: left;">{{$item->documentregisters_remark}}</td>
                                <td>{{$item->documentregisters_rev01 ?? '-'}}</td>
                                <td>{{$item->documentregisters_rev02 ?? '-'}}</td>
                                <td>{{$item->documentregisters_rev03 ?? '-'}}</td>
                                <td>{{$item->documentregisters_rev04 ?? '-'}}</td>
                                <td>{{$item->documentregisters_rev05 ?? '-'}}</td>
                                <td>{{$item->documentregisters_rev06 ?? '-'}}</td>
                                <td>{{$item->documentregisters_rev07 ?? '-'}}</td>
                                <td>{{$item->documentregisters_rev08 ?? '-'}}</td>
                                <td>{{$item->documentregisters_rev09 ?? '-'}}</td>
                                <td>{{$item->documentregisters_rev10 ?? '-'}}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-indigo-action btn-sm" title="กดรับทราบ" onclick="confirmApp('{{ $item->documentdistributions_id }}')">
                                        <i class="fas fa-check-circle mr-1"></i> รับทราบ
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
<!-- Sweet Alerts Framework Extension Scripts -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
confirmApp = (refid) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: "คุณต้องการรับทราบรายการนี้ใช่หรือไม่ ?",
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
                url: `{{ url('/approvedDistribution') }}`,
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
                            text: 'รับทราบเอกสารเรียบร้อยแล้ว',
                            icon: 'success'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'รับทราบเอกสารไม่สำเร็จ',
                            icon: 'error'
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิกแล้ว',
                text: 'โปรดตรวจสอบข้อมูลอีกครั้งเพื่อความถูกต้อง :)',
                icon: 'info'
            });
        }
    });
}
</script>
@endpush