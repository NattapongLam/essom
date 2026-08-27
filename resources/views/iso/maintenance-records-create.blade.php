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

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'เกิดข้อผิดพลาด!',
    text: "{{ session('error') }}",
    confirmButtonColor: '#dc2626'
});
</script>
@endif

<style>
.form-container {
    border-radius: 18px;
    padding: 25px 40px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    margin-bottom: 25px;
}
h2 { text-align: center; font-weight: 800; color: #0f172a; margin-bottom: 20px; }
table { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 14px; color: #1e293b; }
th, td { border: 1px solid #cbd5e1; padding: 8px 10px; text-align: center; vertical-align: middle; }
th { background-color: #dcdee6ff; color: #000; font-weight: 600; text-transform: uppercase; }
tr:nth-child(even) { background-color: #f1f5f9; }
tr:hover { background-color: #e0f2fe; }

button.active {
    background: linear-gradient(180deg, #e1e4ebff, #e6e9eeff);
    color: #1e293b;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}
button.active:hover { transform: scale(1.05); }

input[type=text], input[type=date] {
    border: 1px solid #000;
    border-radius: 5px;
    padding: 6px 10px;
    font-size: 14px;
    width: 100%;
    background-color: #f8fafc;
    transition: 0.2s;
}
input:focus {
    border-color: #1e40af;
    box-shadow: 0 0 4px rgba(59,130,246,0.3);
    background-color: #ffffff;
    outline: none;
}

.triple-checkbox {
    width: 22px;
    height: 22px;
    border: 2px solid #94a3b8;
    border-radius: 5px;
    cursor: pointer;
    margin: 0 auto;
    transition: all 0.2s ease;
    background-color: #f8fafc;
}
.triple-checkbox[data-state="0"] { background-color: #f8fafc; border-color: #94a3b8; }
.triple-checkbox[data-state="1"] { background-color: #16a34a; border-color: #16a34a; position: relative; }
.triple-checkbox[data-state="1"]::after { content: '✔'; color: white; font-size: 14px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); }
.triple-checkbox[data-state="2"] { background-color: #111827; border-color: #111827; }

.rotated-text {
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    white-space: nowrap;
    font-weight: bold;
    font-size: 12px;
}
.form-header td {
    background-color: #f0f9ff;
    font-weight: bold;
    text-align: center;
}
</style>

<div class="form-container">
    <h2>บันทึกการบำรุงเครื่องจักร EQUIPMENT MAINTENANCE RECORD        
    </h2>
   
    <form action="{{ route('maintenance-records.store') }}" method="POST" class="form-container">
        @csrf

        @php
            $machinesPerStep = 9;
        @endphp
        <select class="form-control" name="year">
            <option value="" selected disabled>-- กรุณาเลือกปี --</option>
            @php
                $currentYear = date('Y');
            @endphp
            @for ($i = $currentYear; $i >= $currentYear - 5; $i--)
                {{-- แปลงเป็นปี พ.ศ. (ถ้าต้องการ) หรือใช้ ค.ศ. $i ปกติ --}}
                @php $yearTh = $i + 543; @endphp
                <option value="{{ $i }}">{{ $yearTh }} ({{ $i }})</option>
            @endfor
        </select>
        <table id="maintenanceTable">
            <thead>
                <tr>
                    <th style="width: 20%">เครื่องจักร / รายการบำรุงรักษา</th>
                    @foreach($maintenance_items as $item)
                        <th  style="width: 5%"><div class="rotated-text">{{ $item }}</div></th>
                    @endforeach
                    <th style="width: 30%">ผู้ตรวจ</th>
                    <th style="width: 20%">วันที่ตรวจ</th>
                </tr>
            </thead>
<tbody>
@foreach($machines as $i => $machine)
    @php
        $step = ($i < 11) ? 1 : (($i < 22) ? 2 : 3);
    @endphp

    @if($i === 0)
    <tr class="form-header">
        <td colspan="{{ count($maintenance_items)+3 }}" style="text-align: right; font-weight: 600; padding-right: 12px;">F7132.1 1/2</td>
    </tr>
    <tr><td colspan="{{ count($maintenance_items)+3 }}" style="border-bottom: 2px solid #d1d5db;"></td></tr>
    @endif
    @if($machine === 'HP1 แท่นไฮดรอลิก')
    <tr class="form-header">
        <td colspan="{{ count($maintenance_items)+3 }}" style="text-align: right; font-weight: 600; padding-right: 12px;">F7132.1 2/2</td>
    </tr>
    <tr><td colspan="{{ count($maintenance_items)+3 }}" style="border-bottom: 2px solid #d1d5db;"></td></tr>
    @endif

    <tr class="step step-{{ $step }}">
        <td>{{ $machine }}</td>
        @foreach($maintenance_items as $indexItem => $item)
            @php
                // กำหนดค่าเริ่มต้นเป็น 0 (ปกติ/ช่องขาว)
                $defaultState = 0;

                // --- ตัวอย่างการกำหนดช่องทึบ (สีดำ) ตามเครื่องจักร ---
                // หมายเหตุ: $indexItem เริ่มจาก 0 ถึง 17 (แทนข้อ 1 ถึง 18)
                // ตัวอย่างเช่น ถ้าเครื่องจักร SB1 ไม่ต้องตรวจข้อ 1 และ 2 ให้กำหนดเป็นสถานะ 2 (ช่องดำ)
                if ($machine === 'SB1 ตู้พ่นสีแบบแห้ง' && in_array($indexItem, [0,1,4,8,9,10,11,15,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'SB2 ตู้พ่นสีผง' && in_array($indexItem, [0,1,2,3,4,8,9,10,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'SB3 ตู้อบสี' && in_array($indexItem, [0,1,4,10,11,14,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'SB4 เครื่องพ่นสีผง' && in_array($indexItem, [0,1,2,3,4,8,9,10,11,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'SB5 ห้องพ่นสีใหญ่' && in_array($indexItem, [0,1,4,8,10,11,14,15,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'SB6 ตู้พ่นทราย' && in_array($indexItem, [0,1,2,3,4,9,10,11,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'WE3 เครื่องเชื่อมอาก้อน' && in_array($indexItem, [0,1,2,3,4,8,9,10,11,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'WE4 เครื่องเชื่อมมิกซ์' && in_array($indexItem, [0,1,2,3,4,8,9,10,11,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'WA3 เครื่องเชื่อม Spot' && in_array($indexItem, [0,1,2,3,4,9,10,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'ML1 เครื่องกลึง' && in_array($indexItem, [8,9,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'ML2 เครื่องกลึง' && in_array($indexItem, [8,9,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'ML3 เครื่องกลึง' && in_array($indexItem, [8,9,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'ML4 เครื่องกลึง' && in_array($indexItem, [0,1,4,8,9,10,11,14,15,16])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'ML5 เครื่องต๊าปเกลียวท่อ' && in_array($indexItem, [1,2,3,4,8,9,10,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'ML6 เครื่องกลึง' && in_array($indexItem, [8,9,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'ML7 เครื่องกลึง COMP' && in_array($indexItem, [8,9,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MM1 เครื่องมิลลิ่ง' && in_array($indexItem, [0,1,8,9,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MM2 เครื่องมิลลิ่ง' && in_array($indexItem, [1,2,3,4,8,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MM3 เครื่องมิลลิ่ง' && in_array($indexItem, [1,8,9,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MM4 เครื่องมิลลิ่ง CNC' && in_array($indexItem, [2,3,4,8,9,11,14,15,16])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MS2 เครื่องตัดแผ่นเหล็ก' && in_array($indexItem, [1,4,8,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MS5 เครื่องม้วนเหล็กเล็ก' && in_array($indexItem, [1,2,4,11,14,15,16])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MD1 แท่นเจาะตั้งพื้น' && in_array($indexItem, [0,1,4,8,9,10,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MD2 แท่นเจาะตั้งพื้น' && in_array($indexItem, [0,1,4,8,9,10,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MD3 แท่นเจาะตั้งพื้น' && in_array($indexItem, [0,1,4,8,9,10,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MD7 แท่นเจาะตั้งพื้น' && in_array($indexItem, [0,1,4,8,9,10,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MD12 แท่นเจาะตั้งพื้น' && in_array($indexItem, [0,1,4,8,9,10,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MG5 เครื่องลับดอกส่วน' && in_array($indexItem, [0,1,2,3,4,9,10,11,13,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'AC1 ปั้มลม' && in_array($indexItem, [1,4,8,9,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'AC2 ปั้มลม' && in_array($indexItem, [1,4,8,9,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'AC3 ปั้มลม' && in_array($indexItem, [1,4,8,9,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'HP1 แท่นไฮดรอลิก' && in_array($indexItem, [1,2,3,4,5,11,12,15,16])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'HQ1: เครนไฟฟ้า' && in_array($indexItem, [1,2,3,8,11,14,15,16])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'HQ6: เครนไฟฟ้า' && in_array($indexItem, [1,2,3,8,11,14,15,16])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'HQ4 รถยก' && in_array($indexItem, [1,2,3,4,5,8,11,12,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'HQ8 รถยกสูง' && in_array($indexItem, [1,2,5,8,11,12,14,15,16])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'SA1: เครื่องเลื่อย' && in_array($indexItem, [0,1,4,8,10,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'SA2: เครื่องเลื่อย' && in_array($indexItem, [0,1,4,8,10,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'SA5 เครื่องเลื่อยสายพาน' && in_array($indexItem, [4,8,10,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'CF1: เครื่องตัดไฟเบอร์' && in_array($indexItem, [0,1,4,8,9,10,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'CP1 เครื่องตัดพลาสม่า' && in_array($indexItem, [0,1,2,3,4,8,9,10,11,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'GE เครื่องปั่นไฟ 60 Hz' && in_array($indexItem, [0,1,4,8,9,10,11,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MDB1: ตู้ควบคุมไฟฟ้า' && in_array($indexItem, [0,1,2,3,4,8,9,10,11,13,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MDB2: ตู้ควบคุมไฟฟ้า' && in_array($indexItem, [0,1,2,3,4,8,9,10,11,13,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MDB3 ตู้ควบคุมไฟโซลาร์เซลล์ (เล็ก)' && in_array($indexItem, [0,1,2,3,4,8,9,10,11,13,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'MDB4 ตู้ควบคุมไฟโซลาร์เซลล์ (ใหญ่)' && in_array($indexItem, [0,1,2,3,4,8,9,10,11,13,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'SC1: แผงโซลาร์เซลล์ (เล็ก)' && in_array($indexItem, [0,1,2,3,4,5,8,9,10,11,12,13,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                if ($machine === 'SC2: แผงโซลาร์เซลล์ (ใหญ่)' && in_array($indexItem, [0,1,2,3,4,5,8,9,10,11,12,13,14,15,16,17])) {
                    $defaultState = 2; // 2 หมายถึงช่องทึบสีดำ
                }
                // คุณสามารถเพิ่มเงื่อนไขของเครื่องจักรอื่นๆ ตามไฟล์ PDF จริงได้ตรงนี้ครับ
            @endphp
            <td>
                <input type="hidden" name="status[{{ $machine }}][{{ $indexItem }}]" value="{{ $defaultState }}">
                <div class="triple-checkbox" 
                     data-name="status[{{ $machine }}][{{ $indexItem }}]" 
                     data-state="{{ $defaultState }}"></div>
            </td>
        @endforeach
        <td>
            <select class="form-control receiver-select" name="inspector[{{ $machine }}]" placeholder="กรุณาเลือกพนักงาน">
                <option value=""></option>
                @foreach ($emp as $item)
                    <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="date" name="inspection_date[{{ $machine }}]" value=""></td>
    </tr>
@endforeach
</tbody>

        </table>

        <center>
            <p>หมายเหตุ: ลง✔ ในช่องว่างและลงชื่อผู้ตรวจพร้อมวันที่ เมื่อตรวจ และทำตามรายการเรียบร้อย <br>
            คลิกให้เป็นช่อง ■ ที่ว่างและลงชื่อผู้ตรวจพร้อมวันที่ เมื่อทำการเปลี่ยนตามรายการเรียบร้อย<br>
            ช่อง⬛คือช่องที่ไม่ต้องตรวจเช็ค</p>
        </center>

        <div id="pagination-container" style="text-align:center; margin-top:15px;">
            <button type="button" id="prevStep" class="active">ก่อนหน้า</button>
            <span id="pageInfo" style="font-weight:bold; margin:0 10px;">หน้า 1 / 3</span>
            <button type="button" id="nextStep" class="active">ถัดไป</button>
            <button type="submit" class="active" id="submitBtn" style="display:none; margin-left:10px;">บันทึก</button>
        </div>
    </form>
</div>
@endsection
@push('scriptjs')
<script>
$(document).ready(function () {
    // init select2 ให้กับ select ที่โหลดมาตั้งแต่แรก
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });
});
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.triple-checkbox').forEach(cb => {
        cb.addEventListener('click', function() {
            let input = document.querySelector(`input[name="${this.dataset.name}"]`);
            if(this.dataset.state === '0') { this.dataset.state = '1'; input.value = '1'; }
            else if(this.dataset.state === '1') { this.dataset.state = '2'; input.value = '2'; }
            else { this.dataset.state = '0'; input.value = '0'; }
        });
    });
    const steps = Array.from(document.querySelectorAll('.step'));
    const totalSteps = Math.max(...steps.map(row => {
        let cls = row.className.match(/step-(\d+)/);
        return cls ? parseInt(cls[1]) : 1;
    }));
    let currentStep = 1;

    const prevBtn = document.getElementById('prevStep');
    const nextBtn = document.getElementById('nextStep');
    const submitBtn = document.getElementById('submitBtn');
    const pageInfo = document.getElementById('pageInfo');

    function showStep(step) {
        steps.forEach(row => row.style.display = row.classList.contains(`step-${step}`) ? '' : 'none');
        prevBtn.style.display = step === 1 ? 'none' : 'inline-block';
        nextBtn.style.display = step === totalSteps ? 'none' : 'inline-block';
        submitBtn.style.display = step === totalSteps ? 'inline-block' : 'none';
        pageInfo.textContent = `หน้า ${step} / ${totalSteps}`;
    }

    prevBtn.addEventListener('click', () => { if(currentStep > 1) { currentStep--; showStep(currentStep); } });
    nextBtn.addEventListener('click', () => { if(currentStep < totalSteps) { currentStep++; showStep(currentStep); } });
    showStep(currentStep);
    const form = document.querySelector('form.form-container');
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
        }).then(result => { if(result.isConfirmed) form.submit(); });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('yearSelect');
    if (!select) return;

    const currentYear = new Date().getFullYear();
    
    // วนลูปสร้างตัวเลือกย้อนหลัง 10 ปี
    for (let i = 0; i < 10; i++) {
        let yearAd = currentYear - i;
        let yearTh = yearAd + 543; // แปลงเป็น พ.ศ.
        
        let option = document.createElement('option');
        option.value = yearAd;
        option.textContent = `${yearTh} (${yearAd})`;
        select.appendChild(option);
    }
});
</script>
@endpush  
