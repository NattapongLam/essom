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
button:hover, .primary:hover { background-color: #1d4ed8; }
button.deleteRow { background-color: #dc2626; color: #fff; font-weight: 500; padding: 4px 10px; }
button.deleteRow:hover { background-color: #b91c1c; }
.white-btn:hover { background-color: #1e3a8a; color: white; }
.form-container { background: #fff; border-radius: 18px; padding: 25px 40px; box-shadow: 0 6px 20px rgba(0,0,0,0.08); margin-bottom: 25px; border: 1px solid #e0e0e0; }
table { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 14px; }
th, td { border: 1px solid #cbd5e1; padding: 8px; text-align: center; vertical-align: middle; }
th { background-color: #dbdbddff; color: #000; font-weight: 600; text-transform: uppercase; }
tr:nth-child(even) { background-color: #f1f5f9; }
tr:hover { background-color: #e0f2fe; }
input[type=text], input[type=date] {
    border: 1px solid #94a3b8; border-radius: 3px; padding: 6px 10px; font-size: 14px;
    width: 100px; background-color: #f8fafc; transition: 0.2s;
}
input:focus { border-color: #1e40af; box-shadow: 0 0 4px rgba(59,130,246,0.3); background-color: #fff; outline:none; }
.step { display: none; } .step.active { display: block; }
.triple-checkbox {
    width: 18px; height: 18px; cursor: pointer; display: inline-block; text-align: center; line-height: 18px;
    user-select: none; border: 1px solid #94a3b8; border-radius: 4px; background-color: #f8fafc;
}
.triple-checkbox.checked { background-color:#16a34a; color:white; }
.triple-checkbox.cross { background-color:#dc2626; color:white; }
.check-date-container { display:flex; flex-wrap:wrap; gap:15px; justify-content:flex-end; margin-top:15px; }
.check-date-container div { display:flex; flex-direction:column; align-items:center; }
.check-date-container label { font-weight:bold; margin-bottom:4px; }
</style>

<div class="form-container">
    <h2 align="center">ESSOM CO., LTD.<br> แก้ไขรายการบำรุงรักษาอุปกรณ์IT</h2>

    <form class="form-container" method="POST" action="{{ route('computer-records.update', $record->id) }}">
        @csrf
        @method('PUT')

        <div class="step" id="step1">
            <div style="display:flex; gap:15px; margin-bottom:15px; flex-wrap:wrap;">
                <div style="flex:1 1 300px;">
                    <label>การบำรุงรักษาอุปกรณ์ IT (IT Preventive Maintenance ) For Asset Number</label>
                    <input type="text" name="asset_number" value="{{ $record->asset_number }}" required>
                </div>
                <div style="flex:1 1 200px;">
                    <label>User Name</label>
                    <input type="text" name="user_name" value="{{ $record->user_name }}" required>
                </div>
                <div style="flex:1 1 150px;">
                    <label>Period</label>
                    <input type="text" name="period" value="{{ $record->period }}" required>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Maintenance List</th>
                        @php $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']; @endphp
                        @foreach($months as $month)
                            <th>{{ $month }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                    $items_step1 = [
                        "การอัพเดทของแอนตี้ไวรัสเเป็นปัจจุบัน",
                        "การทํางานของ Hard Disk ไม่มีเสียงการอ่านดิสเสียงดังแบบเข็มตก",
                        "การทํางานของ CD / DVD สามารถอ่านเขียนได้",
                        "การบล็อกการใช้งาน USB จากภายนอก",
                        "การทำงานของ UPS ไม่ร้อนหรือมีเสียงร้องเตือนในระหว่างทำงาน",
                        "การทำงานของ OS ไม่พบการฟ้อง error ต่างๆ แสดงที่ Desktop",
                        "การทำงานของโปรแกรมต่างๆ สามารถใช้งานได้ปกติ",
                        "การจัดเก็บไฟล์งานอย่างเป็นระบบ ไม่มีการจัดเก็บไฟล์ส่วนตัว",
                        "การเข้าถึง Server ที่มี Username / Password",
                        "การทำงานของระบบแบ็คอัพไฟล์ครบถ้วนสมบูรณ์",
                        "การทำงานของระบบ Network เป็นปกติ สามารถเชื่อมต่อถึงกันได้",
                        "สามารถเข้าใช้งาน Internet ปกติ",
                        "การเชื่อมต่อกับใช้งาน Printer เป็นปกติ",
                    ];
                    $status = $record->maintenance_status ?? [];
                    @endphp

                    @foreach($items_step1 as $i => $text)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td style="text-align:left;">{{ $text }}</td>
                        @for($m=0;$m<12;$m++)
                            @php $val = $status[$i][$m] ?? 0; @endphp
                            <td>
                                <input type="hidden" name="month_{{ $i }}_{{ $m }}" value="{{ $val }}">
                                <div class="triple-checkbox {{ $val==1?'checked':($val==2?'cross':'') }}" 
                                     data-name="month_{{ $i }}_{{ $m }}">
                                    {{ $val==1?'✔':($val==2?'✖':'') }}
                                </div>
                            </td>
                        @endfor
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="step" id="step2">
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Maintenance List</th>
                        @foreach($months as $month)
                            <th>{{ $month }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                    $items_step2 = [
                        "การทำงานของ Browser เป็นปกติไม่มีการรบกวนจาก Worm ต่างๆ",
                        "สามารถใช้งาน E-Mail ได้ปกติ",
                        "ตรวจหาการติดตั้งโปรแกรมที่ละเมิดลิขสิทะิ์",
                        "คอมพิวเตอร์ต้องมีการดูแลความสะอาด ไม่สกปรกเกินไป",
                        "การทำงานของระบบ Firewall(สามารถบล็อกเวปผิดกฎหมายได้)",
                        "การทำงานของ Log (สามารถเก็บรายชื่อผู้เข้าถึงอินเตอร์เน็ตได้)",
                    ];
                    @endphp

                    @foreach($items_step2 as $i => $text)
                    @php $valIndex = $i + 13; @endphp
                    <tr>
                        <td>{{ $valIndex + 1 }}</td>
                        <td style="text-align:left;">{{ $text }}</td>
                        @for($m=0;$m<12;$m++)
                            @php $val = $status[$valIndex][$m] ?? 0; @endphp
                            <td>
                                <input type="hidden" name="month_{{ $valIndex }}_{{ $m }}" value="{{ $val }}">
                                <div class="triple-checkbox {{ $val==1?'checked':($val==2?'cross':'') }}"
                                     data-name="month_{{ $valIndex }}_{{ $m }}">
                                     {{ $val==1?'✔':($val==2?'✖':'') }}
                                </div>
                            </td>
                        @endfor
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="check-date-container">
                @for($m=0;$m<12;$m++)
                <div>
                    <label>{{ $months[$m] }} Check by</label>
                    <input type="text" name="check_by_{{ $m }}" value="{{ $record->check_by[$m] ?? '' }}">
                    <label>Date</label>
                    <input type="date" name="date_check_{{ $m }}" value="{{ $record->date_check[$m] ?? '' }}">
                </div>
                @endfor
            </div>

            <br><br>
            <div class="row">
                <div style="flex:1;">
                    <label>Remark :</label>
                    <textarea name="remark" rows="4" style="width: 100%;">{{ $record->remark }}</textarea>
                </div>
            </div>
        </div>

        <br>
        <h5>คลิก ✅ = ผ่านตรวจสอบ / คลิก ❌ = ไม่ผ่านการตรวจสอบ</h5>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.triple-checkbox').forEach(cb => {
        cb.addEventListener('click', function() {
            const input = document.querySelector(`input[name="${this.dataset.name}"]`);
            if (!this.classList.contains('checked') && !this.classList.contains('cross')) {
                this.classList.add('checked'); this.textContent = '✔'; input.value = '1';
            } else if (this.classList.contains('checked')) {
                this.classList.remove('checked'); this.classList.add('cross'); this.textContent = '✖'; input.value = '2';
            } else {
                this.classList.remove('cross'); this.textContent = ''; input.value = '0';
            }
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
        steps.forEach((s,i) => s.style.display = i === index ? 'block' : 'none');
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
});
</script>
@endsection
