@extends('layouts.main')
@section('content')

<style>
    /* Modern Indigo Theme for SWOT Form */
    .form-container {
        background: #ffffff; 
        border-radius: 16px; 
        padding: 2.5rem; 
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05); 
        border: 1px solid #e2e8f0; 
        margin-bottom: 30px; 
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
    }
    h3 {
        text-align: center; 
        color: #1e293b; 
        font-weight: 700; 
        margin-bottom: 25px; 
        font-size: 1.5rem;
    }
    .form-header {
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 25px; 
        border-bottom: 1px solid #e2e8f0; 
        padding-bottom: 15px; 
        flex-wrap: wrap;
        gap: 15px;
    }
    .form-header .description {
        font-size: 0.95rem; 
        color: #64748b; 
        max-width: 70%; 
        line-height: 1.6; 
    }
    .form-header .meeting-date {
        text-align: right; 
    }
    .form-header label {
        font-weight: 600; 
        color: #4f46e5; 
        margin-bottom: 0.25rem;
        display: block;
    }
    .form-header input[type="date"] {
        padding: 0.4rem 0.75rem; 
        border: 1px solid #cbd5e1; 
        border-radius: 8px; 
        background-color: #f1f5f9;
        color: #64748b;
        outline: none;
        cursor: not-allowed;
    }
    
    /* Responsive Table Layout Styling */
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        margin-bottom: 30px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }
    table {
        width: 100%; 
        border-collapse: collapse; 
        background: #ffffff; 
    }
    th, td {
        border: 1px solid #e2e8f0; 
        text-align: center; 
        padding: 10px 8px; 
        font-size: 0.875rem; 
    }
    th {
        background-color: #f8fafc; 
        color: #475569; 
        font-weight: 700; 
        vertical-align: middle !important;
    }
    td input[type="text"] {
        width: 100%; 
        border: 1px solid #cbd5e1; 
        border-radius: 6px; 
        padding: 6px 10px; 
        font-size: 0.875rem; 
        box-sizing: border-box; 
        transition: all 0.2s;
    }
    td input[readonly] {
        background-color: #f8fafc;
        color: #64748b;
        border-color: #e2e8f0;
        cursor: not-allowed;
    }

    /* Report Section Container */
    .report-section {
        background: #f8fafc; 
        border: 1px solid #e2e8f0; 
        border-radius: 12px; 
        padding: 20px; 
        margin-top: 25px; 
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }
    .report-item {
        display: flex; 
        flex-direction: column;
        gap: 6px;
    }
    .report-item label {
        font-weight: 600; 
        color: #475569; 
        margin: 0;
        font-size: 0.875rem;
    }
    .report-item input {
        border: 1px solid #cbd5e1; 
        border-radius: 8px; 
        padding: 8px 12px; 
        background-color: #ffffff;
        outline: none;
        font-size: 0.875rem;
        transition: all 0.2s;
    }
    .report-item input:focus:not([readonly]) {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    .report-item input[readonly] {
        background-color: #f1f5f9;
        color: #64748b;
        cursor: not-allowed;
    }

    /* Action Buttons */
    .actions {
        text-align: center; 
        margin-top: 30px; 
        display: flex;
        justify-content: center;
        gap: 12px;
    }
    .primary-btn {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 0.6rem 1.75rem;
        font-size: 0.95rem;
        font-weight: 600;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        display: inline-flex;
        align-items: center;
    }
    .primary-btn:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
        color: #ffffff;
    }
    .white-btn {
        background-color: #ffffff;
        color: #4f46e5;
        border: 1px solid #cbd5e1;
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    .white-btn:hover {
        background-color: #f8fafc;
        border-color: #94a3b8;
        color: #4f46e5;
        text-decoration: none;
    }
</style>

@php
    $strengths = json_decode($record->strength, true); $strengths = is_array($strengths) ? $strengths : [];
    $weaknesses = json_decode($record->weakness, true); $weaknesses = is_array($weaknesses) ? $weaknesses : [];
    $opportunities = json_decode($record->opportunity, true); $opportunities = is_array($opportunities) ? $opportunities : [];
    $threats = json_decode($record->threat, true); $threats = is_array($threats) ? $threats : [];
@endphp

<form action="{{ route('assessrisk-swot.update', $record->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-container">
        <h3>แบบฟอร์มการวิเคราะห์ความเสี่ยงต่อธุรกิจของบริษัท (แสดงข้อมูล)</h3>

        <div class="form-header">
            <div class="description">
                การวิเคราะห์ความเสี่ยงด้านปัจจัยภายใน และภายนอก ที่มีผลต่อกลยุทธ์ของบริษัท ด้วย SWOT Analysis
            </div>
            <div class="meeting-date">
                <label>วันที่ประชุม</label>
                <input type="date" name="meeting_date" value="{{ $record->meeting_date ? \Carbon\Carbon::parse($record->meeting_date)->format('Y-m-d') : '' }}" readonly>
            </div>
        </div>

        <!-- 1.1 Strengths Table -->
        <div class="table-responsive">
            <table>
                <thead>
                   <tr>
                        <th rowspan="2" style="width:20%;">ความเสี่ยงที่พิจารณา<br><span style="color:#4f46e5;">1.1) Strengths (S)</span> การวิเคราะห์จุดแข็งของบริษัทฯ</th>
                        <th colspan="2" style="width:16%;">มติในที่ประชุมทบทวน</th>
                        <th rowspan="2" style="width:16%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
                        <th rowspan="2" style="width:16%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
                        <th rowspan="2" style="width:12%;">ผู้รับผิดชอบดำเนินการ</th>
                        <th colspan="2" style="width:16%;">สรุปผลการปรับปรุง</th>
                    </tr>
                    <tr>
                        <th style="width:8%;">Accept</th>
                        <th style="width:8%;">Non Accept</th>
                        <th style="width:8%;">Non Accept</th>
                        <th style="width:8%;">Accept</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($strengths as $item)
                    <tr>
                        <td><input type="text" value="{{ $item['risk'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['accept'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['non_accept'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['measure'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['activity'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['responsible'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['review_non_accept'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['review_accept'] ?? '' }}" readonly></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- 1.2 Weaknesses Table -->
        <div class="table-responsive">
            <table>
                <thead>
                     <tr>
                        <th rowspan="2" style="width:20%;">ความเสี่ยงที่พิจารณา<br><span style="color:#4f46e5;">1.2) Weaknesses (W)</span> การวิเคราะห์จุดอ่อนของบริษัทฯ</th>
                        <th colspan="2" style="width:16%;">มติในที่ประชุมทบทวน</th>
                        <th rowspan="2" style="width:16%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
                        <th rowspan="2" style="width:16%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
                        <th rowspan="2" style="width:12%;">ผู้รับผิดชอบดำเนินการ</th>
                        <th colspan="2" style="width:16%;">สรุปผลการปรับปรุง</th>
                    </tr>
                    <tr>
                        <th style="width:8%;">Accept</th>
                        <th style="width:8%;">Non Accept</th>
                        <th style="width:8%;">Non Accept</th>
                        <th style="width:8%;">Accept</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($weaknesses as $item)
                    <tr>
                        <td><input type="text" value="{{ $item['risk'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['accept'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['non_accept'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['measure'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['activity'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['responsible'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['review_non_accept'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['review_accept'] ?? '' }}" readonly></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- 2.1 Opportunities Table -->
        <div class="table-responsive">
            <table>
                <thead>
                     <tr>
                        <th rowspan="2" style="width:20%;">2) พิจารณาจากปัจจัยภายนอกที่มีผลกระทบหรือโอกาส<br><span style="color:#4f46e5;">2.1) Opportunities (O)</span> การวิเคราะห์โอกาสของบริษัทฯ</th>
                        <th colspan="2" style="width:16%;">มติในที่ประชุมทบทวน</th>
                        <th rowspan="2" style="width:16%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
                        <th rowspan="2" style="width:16%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
                        <th rowspan="2" style="width:12%;">ผู้รับผิดชอบดำเนินการ</th>
                        <th colspan="2" style="width:16%;">สรุปผลการปรับปรุง</th>
                    </tr>
                    <tr>
                        <th style="width:8%;">Accept</th>
                        <th style="width:8%;">Non Accept</th>
                        <th style="width:8%;">Non Accept</th>
                        <th style="width:8%;">Accept</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($opportunities as $item)
                    <tr>
                        <td><input type="text" value="{{ $item['risk'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['accept'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['non_accept'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['measure'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['activity'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['responsible'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['review_non_accept'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['review_accept'] ?? '' }}" readonly></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- 2.2 Threats Table -->
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2" style="width:20%;"><span style="color:#4f46e5;">2.2) Threats (T)</span> การวิเคราะห์อุปสรรคของบริษัทฯ</th>
                        <th colspan="2" style="width:16%;">มติในที่ประชุมทบทวน</th>
                        <th rowspan="2" style="width:16%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
                        <th rowspan="2" style="width:16%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
                        <th rowspan="2" style="width:12%;">ผู้รับผิดชอบดำเนินการ</th>
                        <th colspan="2" style="width:16%;">สรุปผลการปรับปรุง</th>
                    </tr>
                    <tr>
                        <th style="width:8%;">Accept</th>
                        <th style="width:8%;">Non Accept</th>
                        <th style="width:8%;">Non Accept</th>
                        <th style="width:8%;">Accept</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($threats as $item)
                    <tr>
                        <td><input type="text" value="{{ $item['risk'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['accept'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['non_accept'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['measure'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['activity'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['responsible'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['review_non_accept'] ?? '' }}" readonly></td>
                        <td><input type="text" value="{{ $item['review_accept'] ?? '' }}" readonly></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Report Signatures Footer Section -->
        <div class="report-section">
            <div class="report-item">
                <label>รายงานโดย</label>
                <input type="text" value="{{ $record->report_by }}" readonly>
            </div>

            <div class="report-item">
                <label>วันที่รายงาน</label>
                @php
                    try {
                        $reportDate = $record->report_date 
                            ? \Carbon\Carbon::parse($record->report_date)->format('Y-m-d') 
                            : '';
                    } catch (\Exception $e) {
                        $reportDate = '';
                    }
                @endphp
                <input type="date" value="{{ $reportDate }}" readonly>
            </div>

            <div class="report-item">
                <label>รับทราบโดย</label>
                <input type="text" name="ack_by" value="{{ auth()->user()->name }}">
            </div>

            <div class="report-item">
                <label>วันที่รับทราบ</label>
                <input type="date" name="ack_date" value="{{ old('date', now()->format('Y-m-d')) }}">
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="actions">
            <button type="submit" class="primary-btn">บันทึกข้อมูล</button>
            <a href="{{ route('assessrisk-swot.index') }}" class="white-btn">กลับหน้ารายการ</a>
        </div>
    </div>
</form>

@endsection