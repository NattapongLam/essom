<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานสรุปผลการตรวจพื้นที่ประจำไตรมาสที่ {{ $selectedQuarter }}/{{ $thaiYear }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        @page {
            size: A4 landscape;
            margin: 8mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Sarabun', sans-serif;
            font-size: 11px;
            color: #000000;
            background: #ffffff;
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .no-print-bar {
            background: #f8fafc;
            border-bottom: 1px solid #cbd5e1;
            padding: 10px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .no-print-title {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
        }
        .btn-print-now {
            background: #4f46e5;
            color: #ffffff;
            border: none;
            padding: 7px 16px;
            border-radius: 6px;
            font-family: 'Sarabun', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-print-now:hover {
            background: #4338ca;
        }

        .report-wrapper {
            width: 100%;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 6px;
        }
        .report-title {
            font-size: 14px;
            font-weight: 700;
        }
        .report-doc-code {
            font-size: 11px;
            font-weight: 600;
        }

        table.quarter-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        table.quarter-table th,
        table.quarter-table td {
            border: 1px solid #000000;
            padding: 4px 5px;
            vertical-align: top;
            word-wrap: break-word;
            overflow-wrap: break-word;
            line-height: 1.35;
        }
        table.quarter-table thead th {
            text-align: center;
            vertical-align: middle;
            font-weight: 700;
            background-color: #f8fafc;
        }

        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .font-bold { font-weight: 700; }

        .person-line {
            margin-bottom: 1px;
        }

        .rank-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
            border: 1px solid #000000;
            border-radius: 50%;
            font-size: 10px;
            font-weight: 700;
            margin-top: 3px;
        }

        .remark-item {
            margin-bottom: 2px;
        }
        .remark-item:last-child {
            margin-bottom: 0;
        }
        .remark-prefix {
            font-weight: 600;
        }

        @media print {
            .no-print-bar {
                display: none !important;
            }
            body {
                margin: 0;
            }
            table.quarter-table tr {
                page-break-inside: avoid;
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>

    <div class="no-print-bar">
        <div class="no-print-title">
            สรุปผลการตรวจพื้นที่ประจำไตรมาสที่ {{ $selectedQuarter }} ปี พ.ศ. {{ $thaiYear }} ({{ $year }})
        </div>
        <button type="button" class="btn-print-now" onclick="window.print()">
            ปริ้นเอกสาร (A4 แนวนอน)
        </button>
    </div>

    <div class="report-wrapper">
        <div class="report-header">
            <div class="report-title">
                ESSOM CO., LTD. — สรุปผลการตรวจพื้นที่ประจำไตรมาสที่ {{ $selectedQuarter }} ปี {{ $thaiYear }}
            </div>
            <div class="report-doc-code">
                ฟอร์มเอกสาร: GF113.2-O (20 Feb. 19)
            </div>
        </div>

        <table class="quarter-table">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 19%;">Area</th>
                    <th rowspan="2" style="width: 8%;">Auditor<br>ไตรมาส {{ $selectedQuarter }}</th>
                    <th rowspan="2" style="width: 8%;">Auditee</th>
                    <th rowspan="2" style="width: 8%;">หน่วยงาน<br>รับผิดชอบ</th>
                    <th colspan="4" style="width: 12%;">ไตรมาส</th>
                    <th rowspan="2" style="width: 6.5%;">วันที่ตรวจ</th>
                    <th rowspan="2" style="width: 5.5%;">AVR<br>จัด<br>อันดับ</th>
                    <th rowspan="2" style="width: 33%;">หมายเหตุ</th>
                </tr>
                <tr>
                    <th style="width: 3%;">1</th>
                    <th style="width: 3%;">2</th>
                    <th style="width: 3%;">3</th>
                    <th style="width: 3%;">4</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        <td class="text-left">
                            {!! nl2br(e($row['area'])) !!}
                        </td>

                        <td class="text-center">
                            @forelse ($row['auditors'] as $auditor)
                                <div class="person-line">{{ $auditor }}</div>
                            @empty
                                <div>-</div>
                            @endforelse
                        </td>

                        <td class="text-center">
                            @forelse ($row['auditees'] as $auditee)
                                <div class="person-line">{{ $auditee }}</div>
                            @empty
                                <div>-</div>
                            @endforelse
                        </td>

                        <td class="text-center">
                            {{ $row['department_name'] }}
                        </td>

                        <td class="text-center">{{ !is_null($row['q1']) ? $row['q1'] . '%' : '-' }}</td>
                        <td class="text-center">{{ !is_null($row['q2']) ? $row['q2'] . '%' : '-' }}</td>
                        <td class="text-center">{{ !is_null($row['q3']) ? $row['q3'] . '%' : '-' }}</td>
                        <td class="text-center">{{ !is_null($row['q4']) ? $row['q4'] . '%' : '-' }}</td>

                        <td class="text-center">
                            {{ $row['audit_date'] ?? '-' }}
                        </td>

                        <td class="text-center">
                            <div class="font-bold">{{ $row['avr'] }}%</div>
                            @if($row['rank'] !== '-')
                                <div><span class="rank-badge">{{ $row['rank'] }}</span></div>
                            @endif
                        </td>

                        <td class="text-left">
                            <div class="remark-item">
                                <span class="remark-prefix">จุดเด่น :</span> {{ $row['strength'] }}
                            </div>
                            <div class="remark-item">
                                <span class="remark-prefix">จุดด้อย :</span> {!! nl2br(e($row['weakness'])) !!}
                            </div>
                            <div class="remark-item">
                                <span class="remark-prefix">ข้อเสนอแนะ :</span> {!! nl2br(e($row['suggestion'])) !!}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center" style="padding: 18px;">
                            ไม่พบข้อมูลการตรวจในปีที่เลือก
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>