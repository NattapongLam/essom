<style>
.form-container {
    background: #fff;
    border-radius: 18px;
    padding: 25px 40px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    margin-bottom: 25px;
    border: 1px solid #e0e0e0;
    font-size: 14px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th, td {
    border: 1px solid #cbd5e1;
    padding: 8px;
    text-align: center;
    vertical-align: middle;
}

th {
    background-color: #dbdbddff;
    font-weight: 600;
}

tr:nth-child(even) { background-color: #f1f5f9; }
tr:hover { background-color: #e0f2fe; }

input[type=text], input[type=date], textarea {
    border: 1px solid #94a3b8;
    border-radius: 3px;
    padding: 6px 10px;
    background-color: #f8fafc;
    width: 100%;
    box-sizing: border-box;
}

input:focus, textarea:focus {
    border-color: #1e40af;
    box-shadow: 0 0 4px rgba(59,130,246,0.3);
    background-color: #fff;
    outline:none;
}

.triple-checkbox {
    width: 18px; height: 18px;
    display: inline-block;
    text-align: center;
    line-height: 18px;
    border: 1px solid #94a3b8;
    border-radius: 4px;
    background-color: #f8fafc;
    color: white;
    font-weight: bold;
}

.triple-checkbox.checked { background-color:#16a34a; }
.triple-checkbox.cross { background-color:#dc2626; }

.check-date-container {
    display:flex;
    flex-wrap:wrap;
    gap:15px;
    justify-content:flex-end;
    margin-top:15px;
}

.check-date-container div {
    display:flex;
    flex-direction:column;
    align-items:center;
}

.check-date-container label {
    font-weight:bold;
    margin-bottom:4px;
}

h5 { margin-top: 20px; }
</style>
<div class="form-container">
    <h2 align="center">ESSOM CO., LTD.</h2>

    <div style="display:flex; gap:20px; flex-wrap:wrap; margin-bottom:20px;">
        <div style="flex:1 1 200px;">
            <label>For Asset Number</label>
            <input type="text" value="{{ $data->asset_number ?? '' }}" readonly>
        </div>
        <div style="flex:1 1 200px;">
            <label>User Name</label>
            <input type="text" value="{{ $data->user_name ?? '' }}" readonly>
        </div>
        <div style="flex:1 1 200px;">
            <label>Period</label>
            <input type="text" value="{{ $data->period ?? '' }}" readonly>
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
                    @php
                        $value = $data->{"month_{$i}_{$m}"} ?? 0;
                        $class = $value == 1 ? 'checked' : ($value == 2 ? 'cross' : '');
                        $symbol = $value == 1 ? '✔' : ($value == 2 ? '✖' : '');
                    @endphp
                    <td><div class="triple-checkbox {{ $class }}">{{ $symbol }}</div></td>
                @endfor
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ปรับ Check by / Date ให้อยู่เป็น column สวยงาม -->
    <div class="check-date-container" style="justify-content:flex-start;">
        @for($m=0;$m<12;$m++)
        <div style="min-width:120px;">
            <label>{{ $months[$m] }} Check by</label>
            <input type="text" value="{{ $data->{"check_by_{$m}"} ?? '' }}" readonly>
            <label>Date</label>
            <input type="date" value="{{ $data->{"date_check_{$m}"} ?? '' }}" readonly>
        </div>
        @endfor
    </div>
    <div style="margin-top:20px;">
        <label>Remark :</label>
        <textarea rows="4" style="width:100%; text-align:left;" readonly>{{ $data->remark ?? '' }}</textarea>
    </div>
    <h5>คลิก ✅ แสดงถึงผ่านตรวจสอบ,อยู่ในสภาพปกติ <br>
        คลิก ❌ แสดงถึงไม่ผ่านการตรวจสอบ,อยู่ในสภาพผิดปกติ</h5>
</div>