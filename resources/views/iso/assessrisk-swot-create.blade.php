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
    /* Modern Indigo Theme Styles for SWOT Form */
    .form-container {
        background: #ffffff; 
        border-radius: 16px; 
        padding: 2rem; 
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
    
    /* Table Responsive and styling */
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

    /* Action & Utility Buttons */
    .btn-indigo-add {
        background-color: #e0e7ff !important;
        color: #4f46e5 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 0.5rem 1rem !important;
        font-weight: 600 !important;
        font-size: 0.875rem;
        transition: all 0.2s;
        margin-bottom: 20px;
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

    /* Report Section Box */
    .report-section {
        background: #f8fafc; 
        border: 1px solid #e2e8f0; 
        border-radius: 12px; 
        padding: 20px; 
        margin-top: 25px; 
    }
    .report-item {
        display: flex; 
        align-items: center; 
        gap: 12px; 
        margin-bottom: 12px;
    }
    .report-item label {
        font-weight: 600; 
        color: #334155; 
        margin: 0;
        min-width: 90px;
    }
    .report-item input {
        border: 1px solid #cbd5e1; 
        border-radius: 8px; 
        padding: 6px 12px; 
        background-color: #ffffff;
        outline: none;
        transition: all 0.2s;
    }
    .report-item input:focus:not([readonly]) {
        border-color: #6366f1;
    }
    .report-item input[readonly] {
        background-color: #e2e8f0;
        color: #64748b;
    }

    /* Wizard Navigation Buttons */
    .white-btn {
        background-color: #ffffff;
        color: #4f46e5;
        border: 1px solid #cbd5e1;
        padding: 0.6rem 1.25rem;
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
    
    .note-label {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 500;
        margin-top: 15px;
        display: block;
    }
    .step { display: none; }
    .step.active { display: block; }
</style>

<form method="POST" action="{{ route('assessrisk-swot.store') }}" class="form-container">
    @csrf
    <h3>แบบฟอร์มการวิเคราะห์ความเสี่ยงต่อธุรกิจของบริษัท</h3>

    <!-- STEP 1: Strengths -->
    <div id="step1" class="step active">
        <div class="form-header">
            <div class="description">
                การวิเคราะห์ความเสี่ยงด้านปัจจัยภายใน และภายนอก ที่มีผลต่อกลยุทธ์ของบริษัท ด้วย SWOT Analysis
            </div>
            <div class="meeting-date">
                <label for="meetingDate">วันที่ประชุม</label>
                <input type="date" id="meetingDate" name="meeting_date">
            </div>
        </div>
        
        <div class="table-responsive">
            <table id="strengthTable">
                <thead>
                    <tr>
                        <th rowspan="2" style="width:20%;">ความเสี่ยงที่พิจารณา<br><span class="text-indigo font-weight-bold" style="color:#4f46e5;">1.1) Strengths (S)</span> การวิเคราะห์จุดแข็งของบริษัทฯ</th>
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
                    @for($i=0;$i<2;$i++)
                    <tr>
                        <td><input type="text" name="strength_risk[]"></td>
                        <td><input type="text" name="strength_accept[]"></td>
                        <td><input type="text" name="strength_non_accept[]"></td>
                        <td><input type="text" name="strength_measure[]"></td>
                        <td><input type="text" name="strength_activity[]"></td>
                        <td><input type="text" name="strength_responsible[]"></td>
                        <td><input type="text" name="strength_review_non_accept[]"></td>
                        <td><input type="text" name="strength_review_accept[]"></td>
                        <td><button type="button" class="deleteRow"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-indigo-add addRow" data-table="strengthTable"><i class="fas fa-plus mr-1"></i> เพิ่มแถวข้อมูล</button>
    </div>

    <!-- STEP 2: Weaknesses & Opportunities -->
    <div id="step2" class="step">
        <div class="table-responsive">
            <table id="weaknessTable">
                <thead>
                    <tr>
                        <th rowspan="2" style="width:20%;">ความเสี่ยงที่พิจารณา<br><span class="text-indigo font-weight-bold" style="color:#4f46e5;">1.2) Weaknesses (W)</span> การวิเคราะห์จุดอ่อนของบริษัทฯ</th>
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
                    @for($i=0;$i<2;$i++)
                    <tr>
                        <td><input type="text" name="weakness_risk[]"></td>
                        <td><input type="text" name="weakness_accept[]"></td>
                        <td><input type="text" name="weakness_non_accept[]"></td>
                        <td><input type="text" name="weakness_measure[]"></td>
                        <td><input type="text" name="weakness_activity[]"></td>
                        <td><input type="text" name="weakness_responsible[]"></td>
                        <td><input type="text" name="weakness_review_non_accept[]"></td>
                        <td><input type="text" name="weakness_review_accept[]"></td>
                        <td><button type="button" class="deleteRow"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-indigo-add addRow" data-table="weaknessTable"><i class="fas fa-plus mr-1"></i> เพิ่มแถวจุดอ่อน</button>
        
        <div class="table-responsive mt-4">
            <table id="opportunityTable">
                <thead>
                    <tr>
                        <th rowspan="2" style="width:20%;">2) พิจารณาจากปัจจัยภายนอกที่มีผลกระทบหรือโอกาส<br><span class="text-indigo font-weight-bold" style="color:#4f46e5;">2.1) Opportunities (O)</span> การวิเคราะห์โอกาสของบริษัทฯ</th>
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
                    @for($i=0;$i<2;$i++)
                    <tr>
                        <td><input type="text" name="opportunity_risk[]"></td>
                        <td><input type="text" name="opportunity_accept[]"></td>
                        <td><input type="text" name="opportunity_non_accept[]"></td>
                        <td><input type="text" name="opportunity_measure[]"></td>
                        <td><input type="text" name="opportunity_activity[]"></td>
                        <td><input type="text" name="opportunity_responsible[]"></td>
                        <td><input type="text" name="opportunity_review_non_accept[]"></td>
                        <td><input type="text" name="opportunity_review_accept[]"></td>
                        <td><button type="button" class="deleteRow"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-indigo-add addRow" data-table="opportunityTable"><i class="fas fa-plus mr-1"></i> เพิ่มแถวโอกาส</button>
    </div>

    <!-- STEP 3: Threats & Responsible Info -->
    <div id="step3" class="step">
        <div class="table-responsive">
            <table id="threatTable">
                <thead>
                    <tr>
                        <th rowspan="2" style="width:20%;"><span class="text-indigo font-weight-bold" style="color:#4f46e5;">2.2) Threats (T)</span> การวิเคราะห์อุปสรรคของบริษัทฯ</th>
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
                    @for($i=0;$i<2;$i++)
                    <tr>
                        <td><input type="text" name="threat_risk[]"></td>
                        <td><input type="text" name="threat_accept[]"></td>
                        <td><input type="text" name="threat_non_accept[]"></td>
                        <td><input type="text" name="threat_measure[]"></td>
                        <td><input type="text" name="threat_activity[]"></td>
                        <td><input type="text" name="threat_responsible[]"></td>
                        <td><input type="text" name="threat_review_non_accept[]"></td>
                        <td><input type="text" name="threat_review_accept[]"></td>
                        <td><button type="button" class="deleteRow"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-indigo-add addRow" data-table="threatTable"><i class="fas fa-plus mr-1"></i> เพิ่มแถวอุปสรรค</button>
        
        <span class="note-label">*หมายเหตุ : ระบุผลการปรับปรุงในวาระการประชุมทบทวนเรื่องความเสี่ยงครั้งถัดไป</span>
        
        <div class="report-section">
            <div class="row">
                <div class="col-md-6">
                    <div class="report-item">
                        <label>รายงานโดย</label>
                        <input type="text" name="report_by" class="form-control" style="max-width:250px;" value="{{auth()->user()->name}}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="report-item">
                        <label>วันที่รายงาน</label>
                        <input type="date" name="report_date" class="form-control" style="max-width:200px;" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="report-item">
                        <label>รับทราบโดย</label>
                        <input type="text" name="ack_by" class="form-control" style="max-width:250px;" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="report-item">
                        <label>วันที่รับทราบ</label>
                        <input type="date" name="ack_date" class="form-control" style="max-width:200px;" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scriptjs')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tables = document.querySelectorAll('table');
    tables.forEach(table => {
        const addBtn = document.querySelector(`button.addRow[data-table="${table.id}"]`);
        const tbody = table.querySelector('tbody');

        function bindDelete(row) {
            const del = row.querySelector('.deleteRow');
            del.addEventListener('click', () => {
                if (tbody.rows.length > 1) row.remove();
            });
        }

        tbody.querySelectorAll('tr').forEach(r => bindDelete(r));

        addBtn.addEventListener('click', () => {
            const clone = tbody.rows[0].cloneNode(true);
            clone.querySelectorAll('input').forEach(i => i.value = '');
            tbody.appendChild(clone);
            bindDelete(clone);
        });
    });

    const form = document.querySelector('form.form-container');
    const steps = Array.from(form.querySelectorAll('.step'));
    let currentStep = 0;
    
    const pagination = document.createElement('div');
    pagination.id = 'pagination';
    pagination.style.textAlign = 'center';
    pagination.style.marginTop = '30px';
    pagination.innerHTML = `
        <button type="button" id="prevStep" class="white-btn" style="margin-right:10px;"><i class="fas fa-chevron-left mr-1"></i> ก่อนหน้า</button>
        <span id="pageInfo" style="margin:0 15px; font-weight: 600; color: #475569;"></span>
        <button type="button" id="nextStep" class="white-btn" style="margin-left:10px;">ถัดไป <i class="fas fa-chevron-right ml-1"></i></button>
        <button type="submit" id="submitBtn" class="white-btn" style="margin-left:10px; display:none;"><i class="fas fa-save mr-1"></i> บันทึกข้อมูล</button>
    `;
    form.appendChild(pagination);

    const prevBtn = document.getElementById('prevStep');
    const nextBtn = document.getElementById('nextStep');
    const submitBtn = document.getElementById('submitBtn');
    const pageInfo = document.getElementById('pageInfo');

    function showStep(index) {
        steps.forEach((s,i) => s.style.display = i===index ? 'block' : 'none');
        prevBtn.style.display = index === 0 ? 'none' : 'inline-block';
        nextBtn.style.display = index === steps.length-1 ? 'none' : 'inline-block';
        submitBtn.style.display = index === steps.length-1 ? 'inline-block' : 'none';
        pageInfo.textContent = `หน้า ${index+1} / ${steps.length}`;
    }

    prevBtn.addEventListener('click', () => {
        if (currentStep > 0) { currentStep--; showStep(currentStep); }
    });

    nextBtn.addEventListener('click', () => {
        if (currentStep < steps.length-1) { currentStep++; showStep(currentStep); }
    });

    showStep(currentStep);

    form.addEventListener('submit', function(e){
        e.preventDefault();
        Swal.fire({
            title: 'ยืนยันการบันทึกข้อมูล?',
            text: 'กรุณาตรวจสอบข้อมูล SWOT ให้ถูกต้องก่อนกดยืนยัน',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4f46e5',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'ยืนยันการบันทึก',
            cancelButtonText: 'ยกเลิก',
            customClass: {
                confirmButton: 'px-4 py-2 text-white font-weight-bold rounded mr-2',
                cancelButton: 'px-4 py-2 text-white font-weight-bold rounded'
            }
        }).then(result => {
            if (result.isConfirmed) form.submit();
        });
    });
});
</script>
@endpush