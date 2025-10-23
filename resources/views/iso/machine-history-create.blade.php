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
    background: #ffffff;
    border-radius: 18px;
    padding: 25px 30px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    margin-bottom: 25px;
    overflow-x: auto;
}

h2 { text-align: center; font-weight: 700; color: #0f172a; margin-bottom: 10px; }

input, textarea {
    width: 100%;
    border: 1px solid #94a3b8;
    border-radius: 5px;
    outline: none;
    background-color: #f8fafc;
    text-align: center;
    font-size: 14px;
    padding: 6px 10px;
    box-sizing: border-box;
    transition: all 0.2s ease;
}
input:focus, textarea:focus {
    border-color: #1e40af;
    box-shadow: 0 0 4px rgba(59,130,246,0.3);
    background-color: #ffffff;
}

button.primary, button.edit, button.delete {
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}
button.primary { background: linear-gradient(180deg, #1e3a8a, #3b82f6); }
button.edit { background: linear-gradient(180deg, #2563eb, #60a5fa); }
button.delete { background: linear-gradient(180deg, #dc2626, #ef4444); }
button.primary:hover, button.edit:hover, button.delete:hover { transform: scale(1.05); }

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 13px;
    color: #1e293b;
    table-layout: fixed;
}
th, td {
    border: 1px solid #ddd;
    padding: 6px 8px;
    text-align: center;
    vertical-align: middle;
    word-wrap: break-word;
}
th { background-color: #ebebeb; font-weight: 600; color: #0a0a0a; text-transform: uppercase; }
tr:nth-child(even) { background-color: #fafafa; }
tr:hover { background-color: #e0f2fe; transition: 0.2s; }

.actions { display: flex; gap: 8px; justify-content: flex-end; flex-wrap: wrap; margin-top: 15px; }

@media (max-width: 640px){
    table, thead, tbody, th, td, tr { display: block; }
    thead { display: none; }
    tr { margin-bottom: 15px; border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px; background-color: #ffffff; }
    td { display: flex; justify-content: space-between; padding: 6px 10px; border: none; border-bottom: 1px solid #e2e8f0; }
    td::before { content: attr(data-label); font-weight: 600; color: #1e3a8a; width: 45%; }
    .actions { flex-direction: column; align-items: stretch; gap: 6px; margin-top: 10px; }
}
</style>

<div class="form-container">
<h2>ESSOM CO., LTD.</h2>
<h2>ประวัติเครื่องจักร EQUIPMENT RECORD</h2>

<form action="{{ route('machine-history.store') }}" method="POST">
@csrf
<div style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:15px;">
    <div style="flex:1 1 45%;">
        <label>ชื่อเครื่องจักร:</label>
        <input type="text" name="machine_name" required>
    </div>
    <div style="flex:1 1 45%;">
        <label>หมายเลข:</label>
        <input type="text" name="machine_number" required>
    </div>
</div>

<div style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:15px;">
    <div style="flex:1 1 45%;">
        <label>วันที่เริ่มใช้:</label>
        <input type="date" name="date_start" required>
    </div>
    <div style="flex:1 1 45%;">
        <label>หน่วยงานที่รับผิดชอบ:</label>
        <input type="text" name="department" required>
    </div>
</div>

<table id="machineTable">
    <thead>
        <tr>
            <th>No.</th>
            <th>วัน/เดือน/ปี</th>
            <th>รายการซ่อม/เปลี่ยน</th>
            <th>ผู้ซ่อม</th>
            <th>[ลบ]</th>
        </tr>
    </thead>
    <tbody>
        @for($i = 0; $i < 5; $i++)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td><input type="date" name="repair_date[]"></td>
            <td><input type="text" name="repair_description[]" placeholder="รายการซ่อม/เปลี่ยน"></td>
            <td><input type="text" name="repair_person[]" placeholder="ผู้ซ่อม"></td>
            <td>
                <button type="button" class="delete">ลบ</button>
            </td>
        </tr>
        @endfor
    </tbody>
</table>
<button type="button" class="edit" id="addRowBtn">+ เพิ่มแถว</button>

<br><br>
<label>หมายเหตุ:</label>
<textarea name="remarks" placeholder="."></textarea>

<div class="actions">
    <button type="submit" class="primary">บันทึกข้อมูล</button>
</div>
</form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const tableBody = document.querySelector('#machineTable tbody');
    const addRowBtn = document.getElementById('addRowBtn');

    tableBody.addEventListener("click", function(e) {
        if (e.target.closest(".delete")) {
            const btn = e.target.closest(".delete");
            const row = btn.closest('tr');
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
                    const rows = tableBody.querySelectorAll('tr');
                    rows.forEach((r,i)=> r.cells[0].textContent = i+1);
                    Swal.fire('ลบแล้ว!', '', 'success');
                }
            });
        }
    });

    addRowBtn.addEventListener('click', () => {
        const rowCount = tableBody.rows.length + 1;
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${rowCount}</td>
            <td><input type="date" name="repair_date[]"></td>
            <td><input type="text" name="repair_description[]" placeholder="รายการซ่อม/เปลี่ยน"></td>
            <td><input type="text" name="repair_person[]" placeholder="ผู้ซ่อม"></td>
            <td><button type="button" class="delete">ลบ</button></td>
        `;
        tableBody.appendChild(newRow);
    });
});
</script>
@endsection
