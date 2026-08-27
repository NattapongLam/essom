@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

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
    background: #ffffff;
}
h2 {
    text-align: center;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 20px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    font-size: 14px;
    color: #1e293b;
}
th, td {
    border: 1px solid #cbd5e1;
    padding: 8px 10px;
    text-align: center;
    vertical-align: middle;
}
th {
    background-color: #dcdee6ff;
    color: #000;
    font-weight: 600;
    text-transform: uppercase;
}
tr:nth-child(even) { background-color: #f1f5f9; }
tr:hover { background-color: #e0f2fe; }

.pagination-btn {
    background: linear-gradient(180deg, #e1e4ebff, #e6e9eeff);
    color: #1e293b;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}
.pagination-btn:hover { transform: scale(1.05); }

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

/* 3 สถานะ: 0=ช่องขาว, 1=เครื่องหมายถูก, 2=ช่องดำ */
.triple-checkbox {
    width: 22px;
    height: 22px;
    border: 2px solid #94a3b8;
    border-radius: 5px;
    cursor: pointer;
    margin: 0 auto;
    transition: all 0.2s ease;
}
.triple-checkbox[data-state="0"] { 
    background-color: #ffffff; 
    border-color: #94a3b8; 
}
.triple-checkbox[data-state="1"] { 
    background-color: #16a34a; 
    border-color: #16a34a; 
    position: relative; 
}
.triple-checkbox[data-state="1"]::after { 
    content: '✔'; 
    color: white; 
    font-size: 14px; 
    position: absolute; 
    top: 50%; 
    left: 50%; 
    transform: translate(-50%, -50%); 
}
.triple-checkbox[data-state="2"] { 
    background-color: #111827; 
    border-color: #111827; 
}

.rotated-text {
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    white-space: nowrap;
    font-weight: bold;
    font-size: 12px;
}
.form-header {
    font-weight: bold;
    text-align: right;
    background-color: #f1f5f9;
}
</style>

<div class="container-fluid">
    <div class="form-container">
        <h2>แก้ไขบันทึกการบำรุงเครื่องจักร EQUIPMENT MAINTENANCE RECORD</h2>

        <form id="maintenanceForm" action="{{ route('maintenance-records.update', $record_id ?? 0) }}" method="POST">
            @csrf
            @method('PUT')
            
            <table id="maintenanceTable">
                <thead>
                    <tr>
                        <th>เครื่องจักร / รายการบำรุงรักษา</th>
                        @foreach($maintenance_items as $item)
                            <th><div class="rotated-text">{{ $item }}</div></th>
                        @endforeach
                        <th>ผู้ตรวจ</th>
                        <th>วันที่ตรวจ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($machines as $i => $machine)
                        @php
                            // ดึงข้อมูลที่เตรียมไว้จาก Controller โดยตรง
                            $recordData = $records[$machine] ?? null;
                            
                            $data = [
                                'status' => $recordData ? $recordData->status : [],
                                'inspector' => $recordData->inspector ?? '',
                                'inspection_date' => $recordData->inspection_date ?? ''
                            ];
                        @endphp
                        
                        @if($i === 0)
                        <tr class="form-header">
                            <td colspan="{{ count($maintenance_items)+3 }}">F7132.1 1/2</td>
                        </tr>
                        @endif
                        
                        @if($machine === 'HP1 แท่นไฮดรอลิก')
                        <tr class="form-header">
                            <td colspan="{{ count($maintenance_items)+3 }}">F7132.1 2/2</td>
                        </tr>
                        @endif

                        <tr class="step-row" data-step="{{ $i < 11 ? 1 : ($i < 22 ? 2 : 3) }}">
                            <td>{{ $machine }}</td>
                            @foreach($maintenance_items as $index => $item)
                                @php 
                                    // ดึงค่าสถานะตรงๆ (0=ขาว, 1=ถูก, 2=ดำ) ถ้าไม่มีให้เป็น 0
                                    $state = $data['status'][$index] ?? 0; 
                                @endphp
                                <td>
                                    <input type="hidden" name="status[{{ $machine }}][{{ $index }}]" value="{{ $state }}">
                                    <div class="triple-checkbox" data-name="status[{{ $machine }}][{{ $index }}]" data-state="{{ $state }}"></div>
                                </td>
                            @endforeach
                            <td><input type="text" name="inspector[{{ $machine }}]" value="{{ $data['inspector'] }}"></td>
                            <td><input type="date" name="inspection_date[{{ $machine }}]" value="{{ $data['inspection_date'] ? \Carbon\Carbon::parse($data['inspection_date'])->format('Y-m-d') : '' }}"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <center style="margin-top:15px;">
                <p>หมายเหตุ: ลง✔ ในช่องว่างและลงชื่อผู้ตรวจพร้อมวันที่ เมื่อตรวจและทำตามรายการเรียบร้อย <br> คลิกให้เป็นช่อง ■ ที่ว่างและลงชื่อผู้ตรวจพร้อมวันที่ เมื่อทำการเปลี่ยนตามรายการเรียบร้อย<br> ช่อง⬛คือช่องที่ไม่ต้องตรวจเช็ค</p>
            </center>

            <div id="pagination" style="text-align: center; margin-top: 20px;">
                <button type="button" id="prevStep" class="pagination-btn">ก่อนหน้า</button>
                <span id="pageInfo" style="font-weight:bold; margin:0 15px;">หน้า 1 / 3</span>
                <button type="button" id="nextStep" class="pagination-btn">ถัดไป</button>
                <button type="submit" id="submitBtn" class="pagination-btn" style="background: #1e3a8a; color: white; display: none; margin-left: 10px;">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ลูปเปลี่ยนสถานะเมื่อคลิก: 0 (ขาว) -> 1 (✔) -> 2 (ดำ) -> กลับมา 0 (ขาว)
    document.querySelectorAll('.triple-checkbox').forEach(cb => {
        cb.addEventListener('click', function() {
            let input = document.querySelector(`input[name="${this.dataset.name}"]`);
            if (!input) return;
            
            if (this.dataset.state === '0') { 
                this.dataset.state = '1'; 
                input.value = '1'; 
            } else if (this.dataset.state === '1') { 
                this.dataset.state = '2'; 
                input.value = '2'; 
            } else { 
                this.dataset.state = '0'; 
                input.value = '0'; 
            }
        });
    });

    // ระบบ Pagination
    const rows = Array.from(document.querySelectorAll('.step-row'));
    const totalSteps = 3;
    let currentStep = 1;

    const prevBtn = document.getElementById('prevStep');
    const nextBtn = document.getElementById('nextStep');
    const submitBtn = document.getElementById('submitBtn');
    const pageInfo = document.getElementById('pageInfo');

    function showStep(step) {
        rows.forEach(row => {
            const rowStep = parseInt(row.getAttribute('data-step'));
            row.style.display = (rowStep === step) ? '' : 'none';
        });

        prevBtn.style.display = (step === 1) ? 'none' : 'inline-block';
        nextBtn.style.display = (step === totalSteps) ? 'none' : 'inline-block';
        submitBtn.style.display = (step === totalSteps) ? 'inline-block' : 'none';
        pageInfo.textContent = `หน้า ${step} / ${totalSteps}`;
    }

    prevBtn.addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    nextBtn.addEventListener('click', () => {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        }
    });

    showStep(currentStep);

    // SweetAlert2 ยืนยันการบันทึก
    const form = document.getElementById('maintenanceForm');
    form.addEventListener('submit', function(e) {
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
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endsection