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
    background: #ffffff; 
    border-radius: 18px;
    padding: 25px 40px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    margin-bottom: 25px;
}

body {
    background-color: #ffffff;
}

h2, h3 { text-align: center; font-weight: 700; color: #0f172a; margin-bottom: 8px; }

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

<div class="form-container">
<h3>ทะเบียนผู้ใช้ Email Account</h3>

<table id="activityTable">
    <thead>
        <tr>ห
             <th>No</th>
             <th>Name</th>
             <th>Item</th>
             <th>Email Account</th>
             <th>Password</th>
             <th>User</th>
             <th>Position</th>
             <th>Department</th>
             <th>Approved By</th>
             <th>Date</th>
             <th>Remark</th>
             <th>จัดการ</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
              <td>{{ $record->id }}</td>
              <td>{{ $record->item }}</td>
              <td>{{ $record->email_account }}</td>
              <td>{{ $record->password }}</td>
              <td>{{ $record->user_name }}</td>
              <td>{{ $record->position }}</td>
              <td>{{ $record->department }}</td>
              <td>{{ $record->approved_by }}</td>
              <td>{{ $record->date }}</td>
              <td>{{ $record->remark }}</td>
              <td><button type="button" class="delete">ลบ</button></td>
        </tr>
        @endforeach
    </tbody>
</table>

<button type="button" id="addRowBtn" class="edit">เพิ่มแถว</button>
</div>

<script>
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

function addNewRow() {
    const lastRow = tableBody.querySelector('tr:last-child');
    if (!lastRow) return;

    const newRow = lastRow.cloneNode(true); 
    tableBody.appendChild(newRow);
    updateRowNumbers();
    newRow.querySelector(".delete").addEventListener("click", () => deleteRow(newRow.querySelector(".delete")));
}

addRowBtn.addEventListener('click', addNewRow);

tableBody.querySelectorAll(".delete").forEach(btn => btn.addEventListener("click", () => deleteRow(btn)));
</script>
@endsection
