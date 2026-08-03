@extends('layouts.main')
@section('content')

<style>
    /* ตั้งค่าหน้ากระดาษสำหรับการพิมพ์ */
    @media print {
        body {
            background-color: #ffffff !important;
            -webkit-print-color-adjust: exact;
        }
        .no-print {
            display: none !important;
        }
        .form-container {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        @page {
            size: A4;
            margin: 10mm;
        }
    }

    /* สไตล์จำลองหน้าเอกสารทางการ */
    .form-container {
        background: #ffffff;
        padding: 2rem;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        max-width: 900px;
        margin: 20px auto;
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #1e293b;
    }
    .header-title-block {
        text-align: center;
        margin-bottom: 20px;
        position: relative;
    }
    .doc-meta-top-left {
        position: absolute;
        left: 0;
        top: 0;
        font-size: 0.85rem;
        color: #475569;
        text-align: left;
    }
    .doc-meta-top-right {
        position: absolute;
        right: 0;
        top: 0;
        font-size: 0.85rem;
        color: #475569;
        text-align: right;
    }
    h2 { 
        font-weight: 700; 
        color: #1e293b; 
        margin-bottom: 2px; 
        font-size: 1.4rem;
    }
    h2.sub-title {
        color: #4f46e5;
        font-size: 1.1rem;
        margin-bottom: 10px;
    }

    /* ส่วนหัวฟอร์ม Section / Period */
    .section-top-fields {
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }

    /* ตารางแสดงข้อมูล */
    .table-responsive {
        border-radius: 6px;
        overflow: hidden;
        border: 1px solid #cbd5e1;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
    }
    th, td {
        border: 1px solid #cbd5e1;
        padding: 8px 6px;
        text-align: center;
        vertical-align: middle;
    }
    th {
        background-color: #f1f5f9;
        color: #1e293b;
        font-weight: 700;
    }
    td.text-left {
        text-align: left;
    }
    .print-text-block {
        white-space: pre-line;
        margin-bottom: 4px;
    }
    .print-sub-label {
        font-size: 0.75rem;
        color: #64748b;
    }

    /* ตารางลายเซ็นด้านล่าง */
    .signature-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 15px;
        margin-top: 20px;
    }
    .signature-item {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        padding: 6px 0;
        border-bottom: 1px dashed #cbd5e1;
    }
    .signature-item span:first-child {
        font-weight: 600;
        color: #475569;
    }

    /* ปุ่มสั่งพิมพ์ */
    .print-actions {
        text-align: center;
        margin-top: 25px;
        margin-bottom: 40px;
    }
    .btn-print {
        background: #4f46e5;
        color: #fff;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }
    .btn-print:hover {
        background: #4338ca;
    }
</style>

<div class="form-container">
    <div class="header-title-block">
        <div class="doc-meta-top-left">
            ESSOM CO.,LTD.
        </div>
        <div class="doc-meta-top-right">
            F6200.1<br>9 Apr 24
        </div>
        <h2>OBJECTIVE & ACTIVITIES REPORT</h2>
        <h2 class="sub-title">รายงานวัตถุประสงค์และผลการดำเนินงาน</h2>
    </div>

    <div class="section-top-fields">
        <div class="row">
            <div class="col-md-6">
                <strong>Section:</strong> {{ $objcctive->section }}
            </div>
            <div class="col-md-6">
                <strong>Period:</strong> {{ $objcctive->period }}
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th rowspan="2" style="width: 5%">NO.</th>
                    <th rowspan="2" style="width: 35%">DESCRIPTION OF ACTIVITIES</th>
                    <th rowspan="2" style="width: 20%">RESP. PERSON</th>
                    <th colspan="3">OBJECTIVE</th>
                    <th rowspan="2" style="width: 20%">REMARKS/CORRECTIVE ACTION</th>
                </tr>
                <tr>
                    <th width="8%">Previous</th>
                    <th width="8%">Plan</th>
                    <th width="8%">Results</th>
                </tr>
            </thead>
            <tbody>
                @php
                  $activities = $objcctive->activity_list ?? [];
                @endphp

                @forelse($activities as $i => $act)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td class="text-left">
                        <div class="print-text-block"><strong>-</strong> {{ $act['description'] ?? '-' }}</div>
                        @if(!empty($act['note1']))
                            <div class="print-sub-label"><strong>วัตถุประสงค์:</strong> {{ $act['note1'] }}</div>
                        @endif
                        @if(!empty($act['note2']))
                            <div class="print-sub-label"><strong>สาเหตุ/แนวทางแก้ไข:</strong> {{ $act['note2'] }}</div>
                        @endif
                    </td>
                    <td>{{ $act['resp_person'] ?? '-' }}</td>
                    <td>{{ $act['previous'] ?? '-' }}</td>
                    <td>{{ $act['plan'] ?? '-' }}</td>
                    <td>{{ $act['results'] ?? '-' }}</td>
                    <td class="text-left">{{ $act['remarks'] ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">ไม่มีข้อมูลกิจกรรม</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="signature-grid">
        <div class="signature-item">
            <span>Prepared by:</span>
            <span>{{ $objcctive->prepared_by ?? '-' }} ({{ optional(\Carbon\Carbon::parse($objcctive->prepared_date))->format('d/m/Y') }})</span>
        </div>
        <div class="signature-item">
            <span>Reported by:</span>
            <span>{{ $objcctive->reported_by ?? '-' }} ({{ optional(\Carbon\Carbon::parse($objcctive->reported_date))->format('d/m/Y') }})</span>
        </div>
        <div class="signature-item">
            <span>Reviewed by:</span>
            <span>{{ $objcctive->reviewed_by ?? '-' }} ({{ optional(\Carbon\Carbon::parse($objcctive->reviewed_date))->format('d/m/Y') }})</span>
        </div>
        <div class="signature-item">
            <span>Acknowledged by:</span>
            <span>{{ $objcctive->acknowledged_by ?? '-' }} ({{ optional(\Carbon\Carbon::parse($objcctive->acknowledged_date))->format('d/m/Y') }})</span>
        </div>
        <div class="signature-item" style="grid-column: span 2;">
            <span>Approved by:</span>
            <span>{{ $objcctive->approved_by ?? '-' }} ({{ optional(\Carbon\Carbon::parse($objcctive->approved_date))->format('d/m/Y') }})</span>
        </div>
    </div>
</div>

<div class="print-actions no-print">
    <button type="button" class="btn-print" onclick="window.print()">
        <i class="fas fa-print mr-1"></i> พิมพ์เอกสาร / บันทึกเป็น PDF
    </button>
    <a href="{{ url()->previous() }}" class="btn btn-secondary ml-2" style="text-decoration: none; padding: 10px 20px; color: #475569; background: #e2e8f0; border-radius: 8px; font-weight: 600;">ย้อนกลับ</a>
</div>

@endsection