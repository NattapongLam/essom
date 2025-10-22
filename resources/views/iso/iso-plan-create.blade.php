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
.card, .form-container {
    background: #ffffff; /* พื้นหลังขาว */
    border-radius: 18px;
    padding: 25px 40px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    margin-bottom: 25px;
}

body {
    background-color: #ffffff; /* ทั้งหน้าขาว */
}

h2 { text-align: center; font-weight: 700; color: #0f172a; margin-bottom: 8px; }

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 16px; 
    color: #1e293b;
    background-color: #ffffff;
}

th, td {
    border: 1px solid #cbd5e1;
    padding: 10px 12px; 
    text-align: center;
    vertical-align: middle;
    background-color: #ffffff;
}

th {
    background-color: #1e40af;
    color: #ffffff;
    font-weight: 600;
    text-transform: uppercase;
}

tr:nth-child(even) { background-color: #f8fafc; }

input, textarea, select {
    border: 1px solid #94a3b8;
    border-radius: 5px;
    padding: 6px 10px;
    font-size: 14px;
    width: 100%;
    box-sizing: border-box;
    background-color: #ffffff;
    transition: 0.2s;
}
input:focus, textarea:focus {
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

button.edit {
    background: linear-gradient(180deg, #2563eb, #60a5fa);
    color:white;
    border:none;
    padding:8px 14px;
    border-radius:6px;
    font-weight:500;
    cursor:pointer;
    transition: all 0.2s ease;
}
button.edit:hover { transform: scale(1.05); }

button.delete {
    background: linear-gradient(180deg, #dc2626, #ef4444);
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}
button.delete:hover { transform: scale(1.05); }

.actions { display:flex; gap:12px; justify-content:flex-end; margin-top:15px; }

input[type="text"], input[type="date"] { height: 36px; font-size: 16px; }
</style>

<form action="{{ route('iso-plan.store') }}" method="POST">
    @csrf
    <div align="left" class="form-container">
      <center>
<h2 align="center">ESSOM CO.,LTD.</h2>
<h2 align="center">PLAN</h2>
<br><br>
        Project :
        <input type="text" name="project_name"  style="width:450px; margin-right:200px;" required >
        Responsible Section / Person :
        <input type="text" name="responsible_section" style="width:450px;" required>
</center>
        <br />    
        <table id="activityTable">
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Description of Activities</th>
                    <th rowspan="2">Resp.<br>Person</th>
                    <th colspan="2">Date</th>
                    <th>STATUS</th>
                    <th rowspan="2">Progress Report/Remarks</th>
                    <th rowspan="2">[ปุ่มลบ]</th>
                </tr>
                <tr>
                    <th>Start</th>
                    <th>Finish</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><input type="text" name="DA[]" placeholder="Description"></td>
                    <td><input type="text" name="RP[]" placeholder="Person"></td>
                    <td><input type="date" name="date_start[]"></td>
                    <td><input type="date" name="date_end[]"></td>
                    <td><input type="text" name="RS[]" placeholder="Status"></td>
                    <td><input type="text" name="Remark[]" placeholder="Remarks"></td>
                    <td>
                        <button type="button" class="delete">ลบ</button>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
        <div>
            <br><br>
        <button type="button" style="float: left;" class="edit" id="addRowBtn">+ เพิ่มแถว</button>
        </div>
        <br><br>

        Prepared by :
        <input type="text" name="prepared_by" style="width:430px;" required >
        Date :
        <input type="date" name="prepared_date" style="width:150px; margin-right:200px;" required>
        Progress Review :
        <input type="text" name="prepared_progress_review" style="width:390px;" required >
        Date :
        <input type="date" name="prepared_progress_date" style="width:150px;" required>
        <br><br>
        Reviewed by:
        <input type="text" name="reported_progress_review" style="width:430px;" required >
        Date :
        <input type="date" name="reported_date" style="width:150px; margin-right:200px;"required>
       Reported by  :
        <input type="text" name="reported_by" style="width:420px;" required >
        Date :
        <input type="date" name="reported_progress_date" style="width:150px;" required>
        <br><br>

        Approved by :
        <input type="text" name="approved_by" style="width:430px;" required >
        Date :
        <input type="date" name="approved_date" style="width:150px; margin-right:200px;" required>
        Acknowledged by :
        <input type="text" name="acknowledged_by" style="width:380px;" required >
        Date :
        <input type="date" name="acknowledged_date" style="width:150px;" required>

        <p>&nbsp;</p>
        <div class="actions" style="margin-top:10px; text-align:right;">
            <button type="submit" class="primary">บันทึกข้อมูล</button>
        </div>
    </div>
</form>

<script>
const form = document.querySelector("form");
const addRowBtn = document.getElementById('addRowBtn');
const tableBody = document.querySelector('#activityTable tbody');

function deleteRow(btn) {
    const row = btn.closest('tr');
    if (!row) return;
    Swal.fire({
        title: 'ยืนยันลบ?',
        text: "คุณแน่ใจหรือไม่ว่าต้องการลบแถวนี้?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'ใช่, ลบ!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            row.remove();
            updateRowNumbers();
            Swal.fire('ลบแล้ว!', '', 'success');
        }
    });
}

function updateRowNumbers() {
    const rows = tableBody.querySelectorAll('tr');
    rows.forEach((row, index) => {
        row.cells[0].textContent = index + 1;
    });
}

addRowBtn.addEventListener('click', () => {
    const rowCount = tableBody.rows.length + 1;
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${rowCount}</td>
        <td><input type="text" name="DA[]" placeholder="Activity"></td>
        <td><input type="text" name="RP[]" placeholder="Person"></td>
        <td><input type="date" name="date_start[]"></td>
        <td><input type="date" name="date_end[]"></td>
        <td><input type="text" name="RS[]" placeholder="Status"></td>
        <td><input type="text" name="Remark[]" placeholder="Remarks"></td>
        <td><button type="button" class="delete">ลบ</button></td>
    `;
    tableBody.appendChild(newRow);
    newRow.querySelector(".delete").addEventListener("click", () => deleteRow(newRow.querySelector(".delete")));
});

tableBody.querySelectorAll(".delete").forEach(btn => btn.addEventListener("click", () => deleteRow(btn)));
</script>
@endsection
