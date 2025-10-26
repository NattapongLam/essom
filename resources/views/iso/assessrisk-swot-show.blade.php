
<style>
.form-container {
    background: #ffffff; 
    border-radius: 12px; 
    padding: 25px 30px; 
    box-shadow: 0 8px 20px rgba(0,0,0,0.15), 0 4px 15px rgba(0,0,0,0.1); 
    margin-bottom: 25px; 
    font-family: "Tahoma", sans-serif; 
    font-size: 14px; 
}
h3 { text-align:center; font-weight:600; margin-bottom:30px; }
table { width:100%; border-collapse:collapse; margin-bottom:25px; }
th, td { border:1px solid #000; text-align:center; padding:8px; font-size:14px; }
th { background:#f0f0f0; font-weight:600; }
td input { width:100%; border:none; background:transparent; text-align:center; color:#000; }
.report-section { display:flex; flex-wrap:wrap; gap:15px; justify-content:flex-start; align-items:center; margin-top:20px; }
.report-item { display:flex; align-items:center; gap:10px; }
.report-item label { font-weight:600; color:#1e3a8a; }
.report-item input { border:none; background:transparent; color:#000; font-weight:500; }
</style>

@php
$strengths = is_string($record->strength) ? json_decode($record->strength,true) : ($record->strength ?? []);
$weaknesses = is_string($record->weakness) ? json_decode($record->weakness,true) : ($record->weakness ?? []);
$opportunities = is_string($record->opportunity) ? json_decode($record->opportunity,true) : ($record->opportunity ?? []);
$threats = is_string($record->threat) ? json_decode($record->threat,true) : ($record->threat ?? []);
@endphp

<div class="form-container">
    <h3>รายละเอียดการวิเคราะห์ความเสี่ยงต่อธุรกิจของบริษัท</h3>

    <div style="text-align:right; margin-bottom:20px;">
        <label>วันที่ประชุม: <strong>{{ $record->meeting_date?->format('d/m/Y') ?? '-' }}</strong></label>
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
            @forelse($strengths as $s)
            <tr>
                <td><input type="text" value="{{ $s['risk'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $s['accept'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $s['non_accept'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $s['measure'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $s['activity'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $s['responsible'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $s['review_non_accept'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $s['review_accept'] ?? '-' }}" readonly></td>
            </tr>
            @empty
            <tr><td colspan="8">-</td></tr>
            @endforelse
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
            @forelse($weaknesses as $w)
            <tr>
                <td><input type="text" value="{{ $w['risk'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $w['accept'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $w['non_accept'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $w['measure'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $w['activity'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $w['responsible'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $w['review_non_accept'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $w['review_accept'] ?? '-' }}" readonly></td>
            </tr>
            @empty
            <tr><td colspan="8">-</td></tr>
            @endforelse
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
            @forelse($opportunities as $o)
            <tr>
                <td><input type="text" value="{{ $o['risk'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $o['accept'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $o['non_accept'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $o['measure'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $o['activity'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $o['responsible'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $o['review_non_accept'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $o['review_accept'] ?? '-' }}" readonly></td>
            </tr>
            @empty
            <tr><td colspan="8">-</td></tr>
            @endforelse
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
            @forelse($threats as $t)
            <tr>
                <td><input type="text" value="{{ $t['risk'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $t['accept'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $t['non_accept'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $t['measure'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $t['activity'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $t['responsible'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $t['review_non_accept'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $t['review_accept'] ?? '-' }}" readonly></td>
            </tr>
            @empty
            <tr><td colspan="8">-</td></tr>
            @endforelse
        </tbody>
    </table>
<label >*หมายเหตุ : ระบุผลการปรับปรุงในวาระการประชุมทบทวนเรื่องความเสี่ยงครั้งถัดไป</label>
    <div class="report-section">
        <div class="report-item">
            <label>รายงานโดย</label>
            <input type="text" value="{{ $record->report_by ?? '-' }}" readonly>
        </div>
        <div class="report-item">
            <label>วันที่</label>
            <input type="text" value="{{ $record->report_date?->format('d/m/Y') ?? '-' }}" readonly>
        </div>
        <div class="report-item">
            <label>รับทราบโดย</label>
            <input type="text" value="{{ $record->ack_by ?? '-' }}" readonly>
        </div>
        <div class="report-item">
            <label>วันที่</label>
            <input type="text" value="{{ $record->ack_date?->format('d/m/Y') ?? '-' }}" readonly>
        </div>
    </div>
</div>

