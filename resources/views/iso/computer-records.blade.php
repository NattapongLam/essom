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
    border-radius: 18px;
    padding: 25px 40px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    margin-bottom: 25px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    font-size: 14px;
}
th, td {
    border: 1px solid #cbd5e1;
    padding: 8px;
    text-align: center;
    vertical-align: middle;
}
th {
    background-color: #1e40af;
    color: #ffffff;
    font-weight: 600;
    text-transform: uppercase;
}
tr:nth-child(even) { background-color: #f1f5f9; }
tr:hover { background-color: #e0f2fe; }
input[type=text], input[type=date] {
    border: 1px solid #94a3b8;
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
button.primary {
    background: linear-gradient(180deg, #1e3a8a, #3b82f6);
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}
button.primary:hover { transform: scale(1.05); }
/
.triple-checkbox {
    width: 18px;
    height: 18px;
    cursor: pointer;
    display: inline-block;
    text-align: center;
    line-height: 18px;
    user-select: none;
    border: 1px solid #94a3b8;
    border-radius: 4px;
    background-color: #f8fafc;
}
.triple-checkbox.checked { background-color: #16a34a; color: white; }
.triple-checkbox.cross { background-color: #dc2626; color: white; }

.check-date-container {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 10px;
}
.check-date-container div {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.check-date-container label { font-weight: bold; margin-bottom: 4px; }
.check-date-container input { width: 80px; }
</style>

<div class="form-container">
    <h2 align="center">ESSOM CO., LTD. </h2>

    <form method="POST" action="{{ route('maintenance.store') }}">
        @csrf
        <div style="display:flex; gap:15px; margin-bottom:15px;">
            <label>การบำรุงรักษาอุปกรณ์ IT (IT Preventive Maintenance ) For Asset Number</label><input type="text" name="asset_number">
            <label>User Name:</label><input type="text" name="user_name">
            <label>Period:</label><input type="text" name="period">
        </div>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th rowspan="2">Maintenance List</th>
                    @php
                        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                    @endphp
                    @foreach($months as $month)
                        <th>{{ $month }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                 $items = [
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
                    "การทำงานของ Browser เป็นปกติไม่มีการรบกวนจาก Worm ต่างๆ",
                    "สามารถใช้งาน E-Mail ได้ปกติ",
                    "ตรวจหาการติดตั้งโปรแกรมที่ละเมิดลิขสิทะิ์",
                    "คอมพิวเตอร์ต้องมีการดูแลความสะอาด ไม่สกปรกเกินไป",
                    "การทำงานของระบบ Firewall(สามารถบล็อกเวปผิดกฎหมายได้)",
                    "การทำงานของ Log (สามารถเก็บรายชื่อผู้เข้าถึงอินเตอร์เน็ตได้)",
                ];
                @endphp

                @foreach($items as $i => $text)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td style="text-align:left;">{{ $text }}</td>
                    @for($m=0;$m<12;$m++)
                        <td>
                            <input type="hidden" name="month_{{ $i }}_{{ $m }}" value="0">
                            <div class="triple-checkbox" data-name="month_{{ $i }}_{{ $m }}"></div>
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
                <input type="text" name="check_by_{{ $m }}">
                <label>Date</label>
                <input type="date" name="date_check_{{ $m }}">
            </div>
            @endfor
        </div>

        <div class="actions">
            <button type="submit" class="primary">บันทึกข้อมูล</button>
        </div>
    </form>
</div>

<script>
document.querySelectorAll('.triple-checkbox').forEach(cb => {
    cb.addEventListener('click', function() {
        let input = document.querySelector(`input[name="${this.dataset.name}"]`);
        if(!this.classList.contains('checked') && !this.classList.contains('cross')) {
            this.classList.add('checked'); this.textContent = '✔'; input.value='1';
        } else if(this.classList.contains('checked')) {
            this.classList.remove('checked'); this.classList.add('cross'); this.textContent = '✖'; input.value='2';
        } else {
            this.classList.remove('cross'); this.textContent = ''; input.value='0';
        }
    });
});
</script>
@endsection
