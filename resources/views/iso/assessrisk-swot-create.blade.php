@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'สำเร็จ!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#1e40af'
});
</script>
@endif

<style>
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
h3 {
    text-align: center; 
    color: #000; 
    font-weight: 600; 
    margin-bottom: 30px; 
}
.form-header {
    display: flex; 
    justify-content: space-between; 
    align-items: flex-end; 
    margin-bottom: 25px; 
    border-bottom: 2px solid #000; 
    padding-bottom: 10px; 
}
.form-header .description {
    font-size: 15px; 
    color: #141414; 
    width: 70%; 
    line-height: 1.6; 
}
.form-header .meeting-date {
    text-align: right; 
}
.form-header label {
    font-weight: 700; 
    color: #000; 
}
.form-header input[type="date"] {
    padding: 5px 10px; 
    border: 1px solid #000; 
    border-radius: 5px; 
}
table {
    width: 100%; 
    border-collapse: collapse; 
    margin-bottom: 30px; 
    background: #ffffff; 
    box-shadow: 0 1px 3px rgba(0,0,0,0.05); 
}
th, td {
    border: 1px solid #000; 
    text-align: center; 
    padding: 8px; 
    font-size: 14px; 
}
th {
    background-color: #eeeeee; 
    color: #000; 
    font-weight: 600; 
}
td input[type="text"], td input[type="date"] {
    width: 100%; 
    border: 1px solid #ccc; 
    border-radius: 4px; 
    padding: 5px; 
    font-size: 14px; 
    box-sizing: border-box; 
}
td input[type="text"]:focus, td input[type="date"]:focus {
    border-color: #000; 
    outline: none; 
    background-color: #eef2ff; 
}
button, .primary {
    background-color: #1e40af; 
    color: white; 
    border: none; 
    padding: 8px 16px; 
    font-size: 14px; 
    border-radius: 6px; 
    cursor: pointer; 
    transition: background-color 0.2s ease; 
}
button:hover, .primary:hover {
    background-color: #1d4ed8; 
}
button.deleteRow {
    background-color: #dc2626; 
    color: #fff; 
    font-weight: 500; 
    padding: 4px 10px; 
}
button.deleteRow:hover {
    background-color: #b91c1c; 
}
p strong, label {
    color: #000; 
    font-weight: 700; 
    display: block; 
    margin: 15px 0 10px; 
}
.report-section {
    display: flex; 
    flex-wrap: wrap; 
    gap: 15px; 
    justify-content: flex-start; 
    align-items: center; 
    background: #f1f5f9; 
    border: 1px solid #cbd5e1; 
    border-radius: 8px; 
    padding: 15px; 
    margin-top: 25px; 
}
.report-item {
    display: flex; 
    align-items: center; 
    gap: 10px; 
}
.report-item label {
    font-weight: 600; 
    color: #1e3a8a; 
}
.report-item input {
    border: 1px solid #cbd5e1; 
    border-radius: 5px; 
    padding: 5px 8px; 
}
.report-item input[type="date"] {
    min-width: 150px; 
}

.actions {
    text-align: center; 
    margin-top: 30px; 
}
.actions .primary {
    background-color: #2563eb; 
    font-size: 16px; 
    font-weight: 600; 
    padding: 10px 25px; 
    border-radius: 8px; 
}
.actions .primary:hover {
    background-color: #1d4ed8; 
}.white-btn {
    background-color: white;
    color: #1e3a8a;
    border: 1px solid #1e3a8a;
    padding: 6px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    transition: background-color 0.2s, color 0.2s;
}
.white-btn:hover {
    background-color: #1e3a8a;
    color: white;
}
.step { display: none; }
.step.active { display: block; }
</style>

<form method="POST" action="{{ route('assessrisk-swot.store') }}" class="form-container">
@csrf
<h3>แบบฟอร์มการวิเคราะห์ความเสี่ยงต่อธุรกิจของบริษัท</h3>

<div id="step1" class="step active">
    <div class="form-header">
        <div class="description">
            การวิเคราะห์ความเสี่ยงด้านปัจจัยภายใน และภายนอก ที่มีผลต่อกลยุทธ์ของบริษัท ด้วย SWOT Analysis
        </div>
        <div class="meeting-date">
            <label for="meetingDate">วันที่ประชุม:</label>
            <input type="date" id="meetingDate" name="meeting_date">
        </div>
    </div>
   <table id="strengthTable">
    <thead>
        <tr>
            <th rowspan="2" style="width:16%;">ความเสี่ยงที่พิจารณา<br>1.1) Strengths (S) การวิเคราะห์จุดแข็งของบริษัทฯ</th>
            <th colspan="2" style="width:14%;">มติในที่ประชุมทบทวน</th>
            <th rowspan="2" style="width:14%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
            <th rowspan="2" style="width:14%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
            <th rowspan="2" style="width:10%;">ผู้รับผิดชอบดำเนินการ</th>
            <th colspan="2" style="width:14%;">สรุปผลการปรับปรุง</th>
            <th rowspan="2" style="width:4%;">ลบ</th>
        </tr>
        <tr>
            <th style="width:7%;">Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Accept</th>
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
            <td><button type="button" class="deleteRow">ลบ</button></td>
        </tr>
        @endfor
    </tbody>
</table>
<button type="button" class="addRow" data-table="strengthTable">เพิ่มแถว</button>
</div>

<div id="step2" class="step">
    <table id="weaknessTable">
    <thead>
        <tr>
            <th rowspan="2" style="width:16%;">ความเสี่ยงที่พิจารณา<br>1.2) Weaknesses (W) การวิเคราะห์จุดอ่อนของบริษัทฯ</th>
            <th colspan="2" style="width:14%;">มติในที่ประชุมทบทวน</th>
            <th rowspan="2" style="width:14%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
            <th rowspan="2" style="width:14%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
            <th rowspan="2" style="width:10%;">ผู้รับผิดชอบดำเนินการ</th>
            <th colspan="2" style="width:14%;">สรุปผลการปรับปรุง</th>
            <th rowspan="2" style="width:4%;">ลบ</th>
        </tr>
        <tr>
            <th style="width:7%;">Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Accept</th>
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
            <td><button type="button" class="deleteRow">ลบ</button></td>
        </tr>
        @endfor
    </tbody>
</table>
<button type="button" class="addRow" data-table="weaknessTable">เพิ่มแถว</button>
<table id="opportunityTable">
    <thead>
        <tr>
            <th rowspan="2" style="width:16%;">2)พิจารณาจากปัจจัยภายนอกที่มีผลกระทบหรือโอกาส<br>2.1) Opportunities (O) การวิเคราะห์โอกาสของบริษัทฯ</th>
            <th colspan="2" style="width:14%;">มติในที่ประชุมทบทวน</th>
            <th rowspan="2" style="width:14%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
            <th rowspan="2" style="width:14%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
            <th rowspan="2" style="width:10%;">ผู้รับผิดชอบดำเนินการ</th>
            <th colspan="2" style="width:14%;">สรุปผลการปรับปรุง</th>
            <th rowspan="2" style="width:4%;">ลบ</th>
        </tr>
        <tr>
            <th style="width:7%;">Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Accept</th>
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
            <td><button type="button" class="deleteRow">ลบ</button></td>
        </tr>
        @endfor
    </tbody>
</table>
<button type="button" class="addRow" data-table="opportunityTable">เพิ่มแถว</button>
</div>

<div id="step3" class="step">
    <table id="threatTable">
    <thead>
        <tr>
            <th rowspan="2" style="width:16%;">2.2) Threats (T) การวิเคราะห์อุปสรรคของบริษัทฯ</th>
            <th colspan="2" style="width:14%;">มติในที่ประชุมทบทวน</th>
            <th rowspan="2" style="width:14%;">มาตรการในการปรับปรุง เปลี่ยนแปลงหรือควบคุม</th>
            <th rowspan="2" style="width:14%;">กิจกรรม, ระเบียบ, หน่วยงานฯลฯ ที่ต้องปรับปรุงเพื่อลดหรือเพิ่มโอกาส</th>
            <th rowspan="2" style="width:10%;">ผู้รับผิดชอบดำเนินการ</th>
            <th colspan="2" style="width:14%;">สรุปผลการปรับปรุง</th>
            <th rowspan="2" style="width:4%;">ลบ</th>
        </tr>
        <tr>
            <th style="width:7%;">Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Non Accept</th>
            <th style="width:7%;">Accept</th>
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
            <td><button type="button" class="deleteRow">ลบ</button></td>
        </tr>
        @endfor
    </tbody>
</table>
<button type="button" class="addRow" data-table="threatTable">เพิ่มแถว</button>
<label >*หมายเหตุ : ระบุผลการปรับปรุงในวาระการประชุมทบทวนเรื่องความเสี่ยงครั้งถัดไป</label>
    <div class="report-section">
        <div class="report-item">
            <label>รายงานโดย</label>
            <input type="text" name="report_by" style="width:200px;">
        </div>
        <div class="report-item">
            <label>วันที่</label>
            <input type="date" name="report_date">
        </div>
        <div class="report-item">
            <label>รับทราบโดย</label>
            <input type="text" name="ack_by" style="width:200px;">
        </div>
        <div class="report-item">
            <label>วันที่</label>
            <input type="date" name="ack_date">
        </div>
    </div>
</div>
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
    pagination.style.marginTop = '20px';
    pagination.innerHTML = `
        <button type="button" id="prevStep" class="white-btn" style="margin-right:10px;">ก่อนหน้า</button>
        <span id="pageInfo" style="margin:0 10px;"></span>
        <button type="button" id="nextStep" class="white-btn" style="margin-left:10px;">ถัดไป</button>
        <button type="submit" id="submitBtn" class="white-btn" style="margin-left:10px; display:none;">บันทึก</button>
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
            text: 'กรุณาตรวจสอบข้อมูลก่อนกดยืนยัน',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1e3a8a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then(result => {
            if (result.isConfirmed) form.submit();
        });
    });
});
</script>

@endsection
