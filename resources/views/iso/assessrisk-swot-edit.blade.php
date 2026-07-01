@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
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
    /* Modern Indigo Theme for SWOT Edit Form */
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
        outline: none;
        transition: all 0.2s;
    }
    .form-header input[type="date"]:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    
    /* Responsive Table & Layout Styling */
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        margin-bottom: 20px;
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
    td input[type="text"]:focus {
        border-color: #6366f1; 
        outline: none; 
        background-color: #fafafa; 
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
    }

    /* Action Buttons */
    .btn-indigo-add {
        background-color: #e0e7ff !important;
        color: #4f46e5 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 0.5rem 1rem !important;
        font-weight: 600 !important;
        font-size: 0.875rem;
        transition: all 0.2s;
        margin-bottom: 25px;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    .btn-indigo-add:hover {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
    }
    button.deleteRow {
        background-color: #fee2e2; 
        color: #dc2626; 
        border: none;
        border-radius: 6px;
        font-weight: 500; 
        padding: 4px 10px; 
        transition: all 0.2s;
    }
    button.deleteRow:hover {
        background-color: #dc2626; 
        color: #ffffff;
    }

    /* Report Section Container */
    .report-section {
        background: #f8fafc; 
        border: 1px solid #e2e8f0; 
        border-radius: 12px; 
        padding: 20px; 
        margin-top: 25px; 
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
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
    }
    .report-item input[readonly] {
        background-color: #f1f5f9;
        color: #64748b;
        cursor: not-allowed;
    }

    /* Step Wizard Buttons */
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
    }
    .white-btn:hover {
        background-color: #f8fafc;
        border-color: #94a3b8;
        color: #4f46e5;
    }
    #submitBtn {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        border: none !important;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
    }
    #submitBtn:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }
    
    .step { display: none; }
    .step.active { display: block; }
</style>

<form method="POST" action="{{ route('assessrisk-swot.update', $record->id) }}" class="form-container">
    @csrf
    @method('PUT')

    <h3>แบบฟอร์มการวิเคราะห์ความเสี่ยงต่อธุรกิจของบริษัท (แก้ไข)</h3>
    
    <!-- STEP 1: Strengths -->
    <div id="step1" class="step active">
        <div class="form-header">
            <div class="description">การวิเคราะห์ความเสี่ยงด้านปัจจัยภายใน และภายนอก ด้วย SWOT Analysis</div>
            <div class="meeting-date">
                <label for="meetingDate">วันที่ประชุม</label>
                <input type="date" name="meeting_date" value="{{ $record->meeting_date ? \Carbon\Carbon::parse($record->meeting_date)->format('Y-m-d') : '' }}">
            </div>
        </div>

        <div class="table-responsive">
            <table id="strengthTable">
                <thead>
                    <tr>
                        <th rowspan="2" style="width:20%;">ความเสี่ยงที่พิจารณา<br><span style="color:#4f46e5;">1.1) Strengths (S)</span> การวิเคราะห์จุดแข็งของบริษัทฯ</th>
                        <th colspan="2" style="width:16%;">มติในที่ประชุมทบทวน</th>
                        <th rowspan="2" style="width:16%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
                        <th rowspan="2" style="width:16%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
                        <th rowspan="2" style="width:12%;">ผู้รับผิดชอบดำเนินการ</th>
                        <th colspan="2" style="width:16%;">สรุปผลการปรับปรุง</th>
                        <th rowspan="2" style="width:4%;">ลบ</th>
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
                        <td><input type="text" name="strength_risk[]" value="{{ $item['risk'] ?? '' }}"></td>
                        <td><input type="text" name="strength_accept[]" value="{{ $item['accept'] ?? '' }}"></td>
                        <td><input type="text" name="strength_non_accept[]" value="{{ $item['non_accept'] ?? '' }}"></td>
                        <td><input type="text" name="strength_measure[]" value="{{ $item['measure'] ?? '' }}"></td>
                        <td><input type="text" name="strength_activity[]" value="{{ $item['activity'] ?? '' }}"></td>
                        <td><input type="text" name="strength_responsible[]" value="{{ $item['responsible'] ?? '' }}"></td>
                        <td><input type="text" name="strength_review_non_accept[]" value="{{ $item['review_non_accept'] ?? '' }}"></td>
                        <td><input type="text" name="strength_review_accept[]" value="{{ $item['review_accept'] ?? '' }}"></td>
                        <td><button type="button" class="deleteRow">ลบ</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-indigo-add addRow" data-table="strengthTable"><i class="fas fa-plus mr-1"></i> เพิ่มแถวจุดแข็ง</button>
    </div>

    <!-- STEP 2: Weaknesses & Opportunities -->
    <div id="step2" class="step">
        <div class="table-responsive">
            <table id="weaknessTable">
                <thead>
                    <tr>
                        <th rowspan="2" style="width:20%;">ความเสี่ยงที่พิจารณา<br><span style="color:#4f46e5;">1.2) Weaknesses (W)</span> การวิเคราะห์จุดอ่อนของบริษัทฯ</th>
                        <th colspan="2" style="width:16%;">มติในที่ประชุมทบทวน</th>
                        <th rowspan="2" style="width:16%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
                        <th rowspan="2" style="width:16%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
                        <th rowspan="2" style="width:12%;">ผู้รับผิดชอบดำเนินการ</th>
                        <th colspan="2" style="width:16%;">สรุปผลการปรับปรุง</th>
                        <th rowspan="2" style="width:4%;">ลบ</th>
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
                        <td><input type="text" name="weakness_risk[]" value="{{ $item['risk'] ?? '' }}"></td>
                        <td><input type="text" name="weakness_accept[]" value="{{ $item['accept'] ?? '' }}"></td>
                        <td><input type="text" name="weakness_non_accept[]" value="{{ $item['non_accept'] ?? '' }}"></td>
                        <td><input type="text" name="weakness_measure[]" value="{{ $item['measure'] ?? '' }}"></td>
                        <td><input type="text" name="weakness_activity[]" value="{{ $item['activity'] ?? '' }}"></td>
                        <td><input type="text" name="weakness_responsible[]" value="{{ $item['responsible'] ?? '' }}"></td>
                        <td><input type="text" name="weakness_review_non_accept[]" value="{{ $item['review_non_accept'] ?? '' }}"></td>
                        <td><input type="text" name="weakness_review_accept[]" value="{{ $item['review_accept'] ?? '' }}"></td>
                        <td><button type="button" class="deleteRow">ลบ</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-indigo-add addRow" data-table="weaknessTable"><i class="fas fa-plus mr-1"></i> เพิ่มแถวจุดอ่อน</button>
        
        <div class="table-responsive">
            <table id="opportunityTable">
                <thead>
                    <tr>
                        <th rowspan="2" style="width:20%;">2) พิจารณาจากปัจจัยภายนอกที่มีผลกระทบหรือโอกาส<br><span style="color:#4f46e5;">2.1) Opportunities (O)</span> การวิเคราะห์โอกาสของบริษัทฯ</th>
                        <th colspan="2" style="width:16%;">มติในที่ประชุมทบทวน</th>
                        <th rowspan="2" style="width:16%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
                        <th rowspan="2" style="width:16%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
                        <th rowspan="2" style="width:12%;">ผู้รับผิดชอบดำเนินการ</th>
                        <th colspan="2" style="width:16%;">สรุปผลการปรับปรุง</th>
                        <th rowspan="2" style="width:4%;">ลบ</th>
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
                        <td><input type="text" name="opportunity_risk[]" value="{{ $item['risk'] ?? '' }}"></td>
                        <td><input type="text" name="opportunity_accept[]" value="{{ $item['accept'] ?? '' }}"></td>
                        <td><input type="text" name="opportunity_non_accept[]" value="{{ $item['non_accept'] ?? '' }}"></td>
                        <td><input type="text" name="opportunity_measure[]" value="{{ $item['measure'] ?? '' }}"></td>
                        <td><input type="text" name="opportunity_activity[]" value="{{ $item['activity'] ?? '' }}"></td>
                        <td><input type="text" name="opportunity_responsible[]" value="{{ $item['responsible'] ?? '' }}"></td>
                        <td><input type="text" name="opportunity_review_non_accept[]" value="{{ $item['review_non_accept'] ?? '' }}"></td>
                        <td><input type="text" name="opportunity_review_accept[]" value="{{ $item['review_accept'] ?? '' }}"></td>
                        <td><button type="button" class="deleteRow">ลบ</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-indigo-add addRow" data-table="opportunityTable"><i class="fas fa-plus mr-1"></i> เพิ่มแถวโอกาส</button>
    </div>

    <!-- STEP 3: Threats & Signatures -->
    <div id="step3" class="step">
        <div class="table-responsive">
            <table id="threatTable">
                <thead>
                    <tr>
                        <th rowspan="2" style="width:20%;"><span style="color:#4f46e5;">2.2) Threats (T)</span> การวิเคราะห์อุปสรรคของบริษัทฯ</th>
                        <th colspan="2" style="width:16%;">มติในที่ประชุมทบทวน</th>
                        <th rowspan="2" style="width:16%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
                        <th rowspan="2" style="width:16%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
                        <th rowspan="2" style="width:12%;">ผู้รับผิดชอบดำเนินการ</th>
                        <th colspan="2" style="width:16%;">สรุปผลการปรับปรุง</th>
                        <th rowspan="2" style="width:4%;">ลบ</th>
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
                        <td><input type="text" name="threat_risk[]" value="{{ $item['risk'] ?? '' }}"></td>
                        <td><input type="text" name="threat_accept[]" value="{{ $item['accept'] ?? '' }}"></td>
                        <td><input type="text" name="threat_non_accept[]" value="{{ $item['non_accept'] ?? '' }}"></td>
                        <td><input type="text" name="threat_measure[]" value="{{ $item['measure'] ?? '' }}"></td>
                        <td><input type="text" name="threat_activity[]" value="{{ $item['activity'] ?? '' }}"></td>
                        <td><input type="text" name="threat_responsible[]" value="{{ $item['responsible'] ?? '' }}"></td>
                        <td><input type="text" name="threat_review_non_accept[]" value="{{ $item['review_non_accept'] ?? '' }}"></td>
                        <td><input type="text" name="threat_review_accept[]" value="{{ $item['review_accept'] ?? '' }}"></td>
                        <td><button type="button" class="deleteRow">ลบ</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-indigo-add addRow" data-table="threatTable"><i class="fas fa-plus mr-1"></i> เพิ่มแถวอุปสรรค</button>

        <div class="report-section">
            <div class="report-item">
                <label>รายงานโดย</label>
                <input type="text" name="report_by" value="{{ $record->report_by }}">
            </div>
            <div class="report-item">
                <label>วันที่รายงาน</label>
                <input type="date" name="report_date" value="{{ $record->report_date ? \Carbon\Carbon::parse($record->report_date)->format('Y-m-d') : '' }}">
            </div>
            <div class="report-item">
                <label>รับทราบโดย</label>
                <input type="text" name="ack_by" value="{{ old('ack_by', $record->ack_by) }}" readonly>
            </div>
            <div class="report-item">
                <label>วันที่รับทราบ</label>
                <input type="date" name="ack_date" value="{{ old('ack_date', $record->ack_date ? \Carbon\Carbon::parse($record->ack_date)->format('Y-m-d') : '') }}" readonly>
            </div>
        </div>
    </div>

    <!-- Navigation Wizard -->
    <div id="pagination" style="text-align:center; margin-top:30px;">
        <button type="button" id="prevStep" class="white-btn">ก่อนหน้า</button>
        <span id="pageInfo" style="margin:0 15px; font-weight: 600; color: #475569;"></span>
        <button type="button" id="nextStep" class="white-btn">ถัดไป</button>
        <button type="submit" id="submitBtn" class="white-btn" style="display:none;">บันทึกการแก้ไข</button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addBtns = document.querySelectorAll('button.addRow');
    addBtns.forEach(addBtn => {
        const tableId = addBtn.getAttribute('data-table');
        const table = document.getElementById(tableId);
        const tbody = table.querySelector('tbody');

        function bindDelete(row) {
            const del = row.querySelector('.deleteRow');
            if(del){
                del.addEventListener('click', () => {
                    if (tbody.rows.length > 1) row.remove();
                });
            }
        }

        tbody.querySelectorAll('tr').forEach(row => bindDelete(row));

        addBtn.addEventListener('click', () => {
            const firstRow = tbody.rows[0];
            if (!firstRow) return;
            const clone = firstRow.cloneNode(true);

            clone.querySelectorAll('input').forEach(input => {
                if (!input.hasAttribute('readonly')) input.value = '';
            });

            tbody.appendChild(clone);
            bindDelete(clone);
        });
    });

    // Step navigation
    const steps = document.querySelectorAll('.step');
    let currentStep = 0;
    const prevBtn = document.getElementById('prevStep');
    const nextBtn = document.getElementById('nextStep');
    const submitBtn = document.getElementById('submitBtn');
    const pageInfo = document.getElementById('pageInfo');

    function showStep(index) {
        steps.forEach((s,i)=>s.style.display = i===index ? 'block':'none');
        prevBtn.style.display = index===0 ? 'none':'inline-block';
        nextBtn.style.display = index===steps.length-1 ? 'none':'inline-block';
        submitBtn.style.display = index===steps.length-1 ? 'inline-block':'none';
        pageInfo.textContent = `หน้า ${index+1} / ${steps.length}`;
    }

    prevBtn.onclick = ()=>{ if(currentStep>0){ currentStep--; showStep(currentStep);} }
    nextBtn.onclick = ()=>{ if(currentStep<steps.length-1){ currentStep++; showStep(currentStep);} }
    showStep(currentStep);
});
</script>
@endsection