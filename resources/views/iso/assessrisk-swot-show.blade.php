@extends('layouts.main')
@section('content')

<style>
/* --- UI เดิมของคุณ --- */
.form-container {
    background: #ffffff; 
    border-radius: 12px; 
    padding: 20px 25px; 
    box-shadow: 0 8px 20px rgba(0,0,0,0.15), 0 4px 15px rgba(0,0,0,0.1); 
    border: 1px solid #e0e0e0; 
    margin-bottom: 25px; 
    font-family: "Tahoma", sans-serif; 
    font-size: 14px; 
    position: relative;
    overflow: visible;
}
.form-container::after {
    content: '';
    display: block;
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    height: 50px; 
    background: linear-gradient(to bottom, rgba(255,255,255,0.3), rgba(255,255,255,0));
    transform: scaleY(-1); 
    opacity: 0.5;
}
h3 { text-align: center; color: #000; font-weight: 600; margin-bottom: 30px; }
.form-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 25px; border-bottom: 2px solid #000; padding-bottom: 10px; }
.form-header .description { font-size: 15px; color: #141414; width: 70%; line-height: 1.6; }
.form-header .meeting-date { text-align: right; }
.form-header label { font-weight: 700; color: #000; }
.form-header input[type="date"] { padding: 5px 10px; border: 1px solid #000; border-radius: 5px; }
table { width: 100%; border-collapse: collapse; margin-bottom: 30px; background: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
th, td { border: 1px solid #000; text-align: center; padding: 8px; font-size: 14px; }
th { background-color: #eeeeee; color: #000; font-weight: 600; }
td input[type="text"], td input[type="date"] { width: 100%; border: 1px solid #ccc; border-radius: 4px; padding: 5px; font-size: 14px; box-sizing: border-box; }
td input[type="text"]:focus, td input[type="date"]:focus { border-color: #000; outline: none; background-color: #eef2ff; }
button, .primary { background-color: #1e40af; color: white; border: none; padding: 8px 16px; font-size: 14px; border-radius: 6px; cursor: pointer; transition: background-color 0.2s ease; }
button:hover, .primary:hover { background-color: #1d4ed8; }
button.deleteRow { background-color: #dc2626; color: #fff; font-weight: 500; padding: 4px 10px; }
button.deleteRow:hover { background-color: #b91c1c; }
p strong, label { color: #000; font-weight: 700; display: block; margin: 15px 0 10px; }
.report-section { display: flex; flex-wrap: wrap; gap: 15px; justify-content: flex-start; align-items: center; background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 8px; padding: 15px; margin-top: 25px; }
.report-item { display: flex; align-items: center; gap: 10px; }
.report-item label { font-weight: 600; color: #1e3a8a; }
.report-item input { border: 1px solid #cbd5e1; border-radius: 5px; padding: 5px 8px; }
.report-item input[type="date"] { min-width: 150px; }
.actions { text-align: center; margin-top: 30px; }
.actions .primary { background-color: #2563eb; font-size: 16px; font-weight: 600; padding: 10px 25px; border-radius: 8px; }
.actions .primary:hover { background-color: #1d4ed8; }
.white-btn { background-color: white; color: #1e3a8a; border: 1px solid #1e3a8a; padding: 6px 16px; border-radius: 6px; cursor: pointer; font-weight: 600; transition: background-color 0.2s, color 0.2s; }
.white-btn:hover { background-color: #1e3a8a; color: white; }
.step { display: none; }
.step.active { display: block; }
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
            <input type="date" name="meeting_date" 
       value="{{ $record->meeting_date ? \Carbon\Carbon::parse($record->meeting_date)->format('Y-m-d') : '' }}" readonly>
        </div>
    </div>
    <table>
        <thead>
           <tr>
            <th rowspan="2" style="width:16%;">ความเสี่ยงที่พิจารณา<br>1.1) Strengths (S) การวิเคราะห์จุดแข็งของบริษัทฯ</th>
            <th colspan="2" style="width:14%;">มติในที่ประชุมทบทวน</th>
            <th rowspan="2" style="width:14%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
            <th rowspan="2" style="width:14%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
            <th rowspan="2" style="width:10%;">ผู้รับผิดชอบดำเนินการ</th>
            <th colspan="2" style="width:14%;">สรุปผลการปรับปรุง</th>
        </tr>
        <tr>
            <th style="width:7%;">Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Accept</th>
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
    <table>
        <thead>
             <tr>
            <th rowspan="2" style="width:16%;">ความเสี่ยงที่พิจารณา<br>1.2) Weaknesses (W) การวิเคราะห์จุดอ่อนของบริษัทฯ</th>
            <th colspan="2" style="width:14%;">มติในที่ประชุมทบทวน</th>
            <th rowspan="2" style="width:14%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
            <th rowspan="2" style="width:14%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
            <th rowspan="2" style="width:10%;">ผู้รับผิดชอบดำเนินการ</th>
            <th colspan="2" style="width:14%;">สรุปผลการปรับปรุง</th>
        </tr>
        <tr>
            <th style="width:7%;">Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Accept</th>
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

    <table>
        <thead>
             <tr>
            <th rowspan="2" style="width:16%;">2)พิจารณาจากปัจจัยภายนอกที่มีผลกระทบหรือโอกาส<br>2.1) Opportunities (O) การวิเคราะห์โอกาสของบริษัทฯ</th>
            <th colspan="2" style="width:14%;">มติในที่ประชุมทบทวน</th>
            <th rowspan="2" style="width:14%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
            <th rowspan="2" style="width:14%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
            <th rowspan="2" style="width:10%;">ผู้รับผิดชอบดำเนินการ</th>
            <th colspan="2" style="width:14%;">สรุปผลการปรับปรุง</th>
        </tr>
        <tr>
            <th style="width:7%;">Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Accept</th>
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
    <table>
        <thead>
            <tr>
            <th rowspan="2" style="width:16%;">2.2) Threats (T) การวิเคราะห์อุปสรรคของบริษัทฯ</th>
            <th colspan="2" style="width:14%;">มติในที่ประชุมทบทวน</th>
            <th rowspan="2" style="width:14%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
            <th rowspan="2" style="width:14%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
            <th rowspan="2" style="width:10%;">ผู้รับผิดชอบดำเนินการ</th>
            <th colspan="2" style="width:14%;">สรุปผลการปรับปรุง</th>
        </tr>
        <tr>
            <th style="width:7%;">Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Accept</th>
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
    <div class="report-section">
        <div class="report-item">
    <label>รายงานโดย</label>
    <input type="text" value="{{ $record->report_by }}" readonly>
</div>

<div class="report-item">
    <label>วันที่</label>
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
            <input type="text" name="ack_by" value="{{auth()->user()->name}}">
        </div>
       <div class="report-item">
    <label>วันที่</label>
    <input type="date" name="ack_date" 
           value="{{ old('date', now()->format('Y-m-d')) }}">
</div>

    </div>

    <div class="actions">
        <button type="submit" class="primary">บันทึก</button>
        <a href="{{ route('assessrisk-swot.index') }}" class="white-btn">กลับหน้ารายการ</a>
    </div>
</div>
</form>

@endsection
