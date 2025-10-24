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

body { background-color: #ffffff; }
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

.actions { display:flex; gap:12px; justify-content:flex-end; margin-top:15px; }

input[type="text"], input[type="date"] { height: 36px; font-size: 16px; }
</style>

<div class="form-container">
    <h3>แก้ไขทะเบียนผู้ใช้ Email Account</h3>

    <form action="{{ route('email-registration.update', $record->id) }}" method="POST">
        @csrf
        @method('PUT')

        <table id="activityTable">
            <thead>
                <tr>
                     <th>No</th>
                     <th>Item</th>
                     <th>Email Account</th>
                     <th>Password</th>
                     <th>User</th>
                     <th>Position</th>
                     <th>Department</th>
                     <th>Approved By</th>
                     <th>Date</th>
                     <th>Remark</th>
                     <th>[ปุ่มลบ]</th>
                </tr>
            </thead>
            <tbody>
    <tr>
        <td></td>
        <td><input type="text" name="item[]" value="{{ $record->item }}" required></td>
        <td><input type="text" name="email_account[]" value="{{ $record->email_account }}" required></td>
        <td><input type="text" name="password[]" value="{{ $record->password }}" required></td>
        <td><input type="text" name="user_name[]" value="{{ $record->user_name }}" required></td>
        <td><input type="text" name="position[]" value="{{ $record->position }}" required></td>
        <td><input type="text" name="department[]" value="{{ $record->department }}" required></td>
        <td><input type="text" name="approved_by[]" value="{{ $record->approved_by }}" required></td>
        <td><input type="date" name="date[]" value="{{ $record->date ? \Carbon\Carbon::parse($record->date)->format('Y-m-d') : '' }}" required></td>
         <td><input type="text" name="remark[]"></td>
<td>
    <button type="button" class="delete"
        style="background:linear-gradient(180deg,#dc2626,#ef4444);
        color:white;border:none;padding:6px 10px;border-radius:6px;
        cursor:pointer;">ลบ</button>
</td>
</tbody>
        </table>

        <div class="actions">
            <button type="submit" class="primary">อัปเดตข้อมูล</button>
        </div>
    </form>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const tableBody = document.querySelector('#activityTable tbody'); 

    function updateRowNumbers() {
        const rows = tableBody.querySelectorAll('tr');
        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1;
        });
    }

    updateRowNumbers();

    const addRowBtn = document.createElement('button');
    addRowBtn.type = "button";
    addRowBtn.textContent = "+ เพิ่มแถว";
    addRowBtn.className = "primary";
    addRowBtn.style.marginTop = "10px";
    tableBody.parentElement.insertAdjacentElement('afterend', addRowBtn);

    tableBody.addEventListener("click", function(e) {
        if (e.target.classList.contains("delete")) {
            if (confirm("คุณแน่ใจหรือไม่ว่าต้องการลบแถวนี้?")) {
                e.target.closest('tr').remove();
                updateRowNumbers();
            }
        }
    });

    addRowBtn.addEventListener('click', function() {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td></td>
            <td><input type="text" name="item[]"></td>
            <td><input type="text" name="email_account[]"></td>
            <td><input type="text" name="password[]"></td>
            <td><input type="text" name="user_name[]"></td>
            <td><input type="text" name="position[]"></td>
            <td><input type="text" name="department[]"></td>
            <td><input type="text" name="approved_by[]"></td>
            <td><input type="date" name="date[]"></td>
            <td><input type="text" name="remark[]"></td>
            <td>
                <button type="button" class="delete"
                    style="background:linear-gradient(180deg,#dc2626,#ef4444);
                    color:white;border:none;padding:6px 10px;border-radius:6px;
                    cursor:pointer;">ลบ</button>
            </td>
        `;
        tableBody.appendChild(newRow);
        updateRowNumbers();
    });
});
</script>
@endsection
