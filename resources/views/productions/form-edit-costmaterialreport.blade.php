@extends('layouts.main')
@section('content')

<style>
    /* โครงสร้าง Card หลัก */
    .modern-card {
        border: none;
        border-radius: 24px;
        box-shadow: 0 10px 35px rgba(99, 102, 241, 0.04);
        background: #ffffff;
        margin-top: 1.5rem;
        padding: 1.5rem;
    }
    .modern-header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        border-bottom: 2px solid #F1F5F9;
        padding-bottom: 1.2rem;
        margin-bottom: 1.8rem;
    }
    .modern-card-title a {
        color: #0F172A !important;
        font-weight: 700;
        font-size: 1.6rem;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: color 0.2s;
    }
    .modern-card-title a:hover {
        color: #4F46E5 !important;
    }
    
    /* ปุ่มส่งแบบฟอร์มสไตล์ Modern ไล่เฉดสี */
    .btn-modern-action {
        background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);
        color: #ffffff !important;
        font-weight: 600;
        font-size: 1rem;
        padding: 10px 32px;
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.25);
        transition: all 0.2s;
        min-width: 160px;
    }
    .btn-modern-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.35);
    }

    /* ปรับแต่ง Form Group & Readonly Inputs */
    .modern-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #4F46E5;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .modern-form-control {
        background-color: #F8FAFC !important;
        border: 1px solid #E2E8F0 !important;
        border-radius: 12px !important;
        height: 44px !important;
        color: #334155 !important;
        font-weight: 500 !important;
        padding: 10px 14px !important;
        box-shadow: none !important;
    }

    /* สไตล์ตารางมินิมอลภายในฟอร์ม */
    .table-responsive {
        border: none !important;
        margin-top: 1.5rem;
    }
    .modern-table {
        width: 100% !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
    }
    .modern-table thead th {
        background-color: #F8FAFC !important;
        color: #4F46E5 !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        font-size: 0.85rem;
        padding: 14px 12px !important;
        border-bottom: 2px solid #E2E8F0 !important;
        border-top: none !important;
        white-space: nowrap;
    }
    .modern-table tbody td {
        padding: 14px 12px !important;
        vertical-align: middle !important;
        color: #334155;
        font-size: 0.9rem;
        border-bottom: 1px solid #F1F5F9 !important;
    }
    .modern-table tbody tr:hover td {
        background-color: rgba(99, 102, 241, 0.01) !important;
    }
</style>

<div class="container-fluid">
    <div class="card modern-card">
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('cm-report.update', $hd->costmaterial_report_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="card-body p-0">
            
            <div class="modern-header-flex">
                <h3 class="modern-card-title">
                    <a href="{{ route('cm-report.index') }}">
                        <i class="fas fa-arrow-left text-muted" style="font-size: 1.2rem;"></i> Cost of Material
                    </a>
                </h3>
                <div>
                    @if($hd->reviewed_by == null)
                        <button type="submit" class="btn btn-modern-action">
                            <i class="fas fa-check-circle mr-1"></i> Review
                        </button>
                    @elseif($hd->acknowledges_by == null)
                        <button type="submit" class="btn btn-modern-action">
                            <i class="fas fa-clipboard-check mr-1"></i> Acknowledges
                        </button>
                    @endif                 
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label">ปี-เดือน (Period)</div>
                        <input type="text" class="form-control modern-form-control" value="{{$hd->costmaterial_report_yearmonth}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label">Prepared By</div>
                        <input type="text" class="form-control modern-form-control" value="{{$hd->created_person}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label">Review By</div>
                        <input type="text" class="form-control modern-form-control" value="{{$hd->reviewed_by ?? '-'}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <div class="form-group">
                        <div class="modern-label">Acknowledges By</div>
                        <input type="text" class="form-control modern-form-control" value="{{$hd->acknowledges_by ?? '-'}}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table modern-table">
                            <thead>
                                <tr>
                                    <th>Job No.</th>
                                    <th>Serial No.</th>
                                    <th>SpecPage No.</th>
                                    <th>Invoice No.</th>
                                    <th>Delivery Date</th>
                                    <th>Description</th>
                                    <th>Buyer</th>
                                    <th class="text-right">QTY</th>
                                    <th class="text-right">/Unit</th>
                                    <th class="text-right">/Total</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dt as $item)
                                    <tr>
                                        <td style="font-weight: 600; color: #4F46E5;">{{$item->costmaterial_reportsub_jobno}}</td>
                                        <td>{{$item->costmaterial_reportsub_serialno}}</td>
                                        <td>{{$item->costmaterial_reportsub_specpage}}</td>
                                        <td>{{$item->costmaterial_reportsub_invoice}}</td>
                                        <td style="white-space: nowrap;"><i class="far fa-calendar-alt text-muted mr-1"></i> {{\Carbon\Carbon::parse($item->delivery_date)->format('d/m/Y')}}</td>
                                        <td>{{$item->costmaterial_reportsub_desp}}</td>
                                        <td>{{$item->costmaterial_reportsub_cust}}</td>
                                        
                                        <td class="text-right" style="font-weight: 500;">{{ number_format($item->costmaterial_reportsub_qty, 2) }}</td>
                                        <td class="text-right">{{ number_format($item->costmaterial_reportsub_unit, 2) }}</td>
                                        <td class="text-right" style="font-weight: 700; color: #0F172A;">{{ number_format($item->costmaterial_reportsub_total, 2) }}</td>
                                        
                                        <td style="color: #64748B; font-size: 0.85rem;">{{$item->costmaterial_reportsub_remark ?? '-'}}</td>
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
    // สคริปต์เพิ่มเติมในอนาคต สามารถเขียนลงในส่วนนี้ได้เลยครับ
</script>
@endpush