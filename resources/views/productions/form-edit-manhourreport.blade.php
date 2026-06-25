@extends('layouts.main')
@section('content')

<style>
    .modern-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 12px 40px rgba(99, 102, 241, 0.04);
        background: #ffffff;
        margin-top: 2rem;
        overflow: hidden;
    }
    .modern-header-zone {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        border-bottom: 1px solid #F1F5F9;
        padding-bottom: 1.5rem;
        margin-bottom: 2rem;
    }
    .modern-card-title {
        color: #1E1B4B;
        font-weight: 700;
        font-size: 1.6rem;
        margin-bottom: 0;
    }
    .modern-card-title a {
        color: #1E1B4B;
        text-decoration: none;
        transition: color 0.2s;
    }
    .modern-card-title a:hover {
        color: #4F46E5;
    }
    
    /* ปุ่มแอ็กชันโมเดิร์น */
    .btn-modern-submit {
        background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);
        color: #ffffff !important;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 10px 28px;
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3);
        transition: all 0.2s;
    }
    .btn-modern-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
    }
    .btn-modern-submit:active {
        transform: translateY(0);
    }

    /* สไตล์ฟอร์มกลุ่มอ่านข้อมูล */
    .modern-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #4F46E5;
        margin-bottom: 6px;
    }
    .form-control-modern-view {
        background-color: #F8FAFC !important;
        border: 1px solid #E2E8F0 !important;
        border-radius: 10px !important;
        padding: 10px 14px !important;
        font-size: 0.95rem !important;
        color: #334155 !important;
        font-weight: 600;
        height: auto !important;
    }
    .form-control-total {
        background-color: #EEF2F6 !important;
        border: 1px solid #C7D2FE !important;
        color: #4F46E5 !important;
        font-size: 1.1rem !important;
        font-weight: 700;
    }

    /* โซนรายนามผู้ลงชื่ออนุมัติ */
    .signature-panel {
        background: #F8FAFC;
        border: 1px solid #F1F5F9;
        border-radius: 16px;
        padding: 1.5rem;
        margin-top: 1.5rem;
        margin-bottom: 2.5rem;
    }

    /* ตารางย่อยรายละเอียด */
    .table-section-title {
        color: #334155;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .table-modern-sub {
        width: 100% !important;
        white-space: nowrap;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #E2E8F0 !important;
    }
    .table-modern-sub thead th {
        background-color: #4F46E5 !important;
        color: #ffffff !important;
        font-weight: 500 !important;
        font-size: 0.8rem;
        padding: 12px 10px !important;
        border: none !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .table-modern-sub tbody td {
        padding: 10px 12px !important;
        vertical-align: middle !important;
        color: #334155;
        font-size: 0.85rem;
        border-bottom: 1px solid #E2E8F0 !important;
        border-right: 1px solid #E2E8F0 !important;
    }
    .table-modern-sub tbody tr:last-child td {
        border-bottom: none !important;
    }
    .table-modern-sub tbody td:last-child {
        border-right: none !important;
    }
    .table-modern-sub tbody tr:hover {
        background-color: #F8F7FF !important;
    }
</style>

<div class="container-fluid">
    <div class="card modern-card">
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('mn-report.update', $hd->manhour_report_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="card-body p-4">
            
            <div class="modern-header-zone">
                <div>
                    <h3 class="modern-card-title">
                        <i class="fas fa-file-invoice" style="color: #6366F1; margin-right: 8px;"></i>
                        <a href="{{route('mn-report.index')}}">Man Hour Report Detail</a>
                    </h3>
                </div>
                <div>
                    @if($hd->reviewed_by == null)
                        <button type="submit" class="btn btn-modern-submit">
                            <i class="fas fa-check-circle mr-2"></i> Review Report
                        </button>
                    @elseif($hd->acknowledges_by == null)
                        <button type="submit" class="btn btn-modern-submit">
                            <i class="fas fa-clipboard-check mr-2"></i> Acknowledges Report
                        </button>
                    @endif                 
                </div>
            </div>           

            <div class="row">
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label"><i class="fas fa-calendar-alt mr-1"></i> ปี-เดือน</div>
                        <input type="text" class="form-control form-control-modern-view" value="{{$hd->manhour_report_yearmonth}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label">Production</div>
                        <input type="text" class="form-control form-control-modern-view" value="{{number_format($hd->manhour_report_product,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label">ซ่อมอุปกรณ์พ่นสี (SI)</div>
                        <input type="text" class="form-control form-control-modern-view" value="{{number_format($hd->manhour_report_si,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label">ซ่อมอุปกรณ์การศึกษา (SE)</div>
                        <input type="text" class="form-control form-control-modern-view" value="{{number_format($hd->manhour_report_se,2)}}" readonly>
                    </div>
                </div>                        
            </div>

            <div class="row">
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label">ซ่อมบำรุงภายในโรงงาน (SF)</div>
                        <input type="text" class="form-control form-control-modern-view" value="{{number_format($hd->manhour_report_sf,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label">ส่งอุปกรณ์พ่นสี (DI)</div>
                        <input type="text" class="form-control form-control-modern-view" value="{{number_format($hd->manhour_report_di,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label">ส่งอุปกรณ์การศึกษาในประเทศ (DD)</div>
                        <input type="text" class="form-control form-control-modern-view" value="{{number_format($hd->manhour_report_dd,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label">ส่งอุปกรณ์การศึกษาต่างประเทศ (DE)</div>
                        <input type="text" class="form-control form-control-modern-view" value="{{number_format($hd->manhour_report_de,2)}}" readonly>
                    </div>
                </div>
            </div>      

            <div class="row">
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label">ทำความสะอาด (C)</div>
                        <input type="text" class="form-control form-control-modern-view" value="{{number_format($hd->manhour_report_c,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label">อื่นๆ (O)</div>
                        <input type="text" class="form-control form-control-modern-view" value="{{number_format($hd->manhour_report_o,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label">EN</div>
                        <input type="text" class="form-control form-control-modern-view" value="{{number_format($hd->manhour_report_en,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label">ADMIN</div>
                        <input type="text" class="form-control form-control-modern-view" value="{{number_format($hd->manhour_report_admin,2)}}" readonly>
                    </div>
                </div>
            </div>

            <div class="signature-panel">
                <div class="row">
                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                        <div class="form-group mb-0">
                            <div class="modern-label" style="color: #4F46E5; font-size: 0.9rem;"><i class="fas fa-sigma mr-1"></i> TOTAL HOUR</div>
                            <input type="text" class="form-control form-control-modern-view form-control-total" value="{{number_format($hd->manhour_report_total,2)}}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                        <div class="form-group mb-0">
                            <div class="modern-label text-muted"><i class="fas fa-user-edit mr-1"></i> Prepared By</div>
                            <input type="text" class="form-control form-control-modern-view" style="font-weight: normal;" value="{{$hd->created_person}}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                        <div class="form-group mb-0">
                            <div class="modern-label text-muted"><i class="fas fa-user-check mr-1"></i> Review By</div>
                            <input type="text" class="form-control form-control-modern-view" style="font-weight: normal; {{ $hd->reviewed_by ? 'border-color: #A7F3D0 !important;' : '' }}" value="{{$hd->reviewed_by ?? 'Pending Review'}}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mb-0">
                        <div class="form-group mb-0">
                            <div class="modern-label text-muted"><i class="fas fa-user-shield mr-1"></i> Acknowledges By</div>
                            <input type="text" class="form-control form-control-modern-view" style="font-weight: normal; {{ $hd->acknowledges_by ? 'border-color: #A7F3D0 !important;' : '' }}" value="{{$hd->acknowledges_by ?? 'Pending Acknowledge'}}" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="table-section-title">
                        <i class="fas fa-list-alt" style="color: #6366F1;"></i> Job Breakdown Details
                    </div>
                    <div class="table-responsive" style="border-radius: 12px;">
                        <table class="table table-modern-sub table-hover">
                           <thead>
                                <tr>
                                    <th>Job</th>
                                    <th>Model</th>
                                    <th>Mach</th>
                                    <th>Small1</th>
                                    <th>Small2</th>
                                    <th>Large</th>
                                    <th>Elect</th>
                                    <th>Instru</th>
                                    <th>Paint</th>
                                    <th>Del</th>
                                    <th>Service</th>
                                    <th>Other</th>
                                    <th>MH Begin</th>
                                    <th>MH This Month</th>
                                    <th>MH END</th>
                                    <th>Std/Unit</th>
                                    <th>Qty</th>
                                    <th>Budget</th>
                                    <th>Standard</th>
                                    <th>Remark</th>
                                </tr>
                           </thead>
                           <tbody>
                                @foreach ($dt as $item)
                                    <tr>
                                        <td style="font-weight: 600; color: #4F46E5;">{{$item->manhour_reportsub_jobno}}</td>
                                        <td><span class="badge bg-light text-dark p-2" style="border-radius: 6px;">{{$item->manhour_reportsub_model}}</span></td>
                                        <td>{{number_format($item->manhour_reportsub_mach,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_small1,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_small2,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_large,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_elect,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_instru,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_paint,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_del,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_service,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_other,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_begin,2)}}</td>
                                        <td style="font-weight: 600; background-color: #F8FAFC;">{{number_format($item->manhour_reportsub_this,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_end,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_unit,2)}}</td>
                                        <td style="font-weight: 600; color: #1E1B4B;">{{number_format($item->manhour_reportsub_qty,0)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_budget,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_standard,2)}}</td>
                                        <td class="text-muted" style="font-size: 0.8rem;">{{$item->manhour_reportsub_reamrk ?? '-'}}</td>
                                    </tr>
                                @endforeach
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>        
        </div>
        </form>       
    </div>
</div>

@endsection
@push('scriptjs')
<script>
    // สามารถใส่สคริปต์เพิ่มเติมที่นี่ได้ครับ
</script>
@endpush