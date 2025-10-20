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
.card, .form-container {
    background: #ffffff;
    border-radius: 18px;
    padding: 25px 40px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    margin-bottom: 25px;
}
h2 {
    text-align: center;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 8px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 14px;
    color: #1e293b;
}
th, td {
    border: 1px solid #cbd5e1;
    padding: 6px 8px;
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

input, textarea, select {
    border: 1px solid #94a3b8;
    border-radius: 5px;
    padding: 6px 10px;
    font-size: 14px;
    width: 100%;
    box-sizing: border-box;
    background-color: #f8fafc;
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

button.ghost {
    background: #cbd5e1;
    color: #000;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}
button.ghost:hover { transform: scale(1.05); }

.actions {
    display:flex;
    gap:12px;
    justify-content:flex-end;
    margin-top:15px;
}

@media (max-width: 1024px){
    table, th, td { font-size: 12px; }
    .form-container { width: 95%; padding: 20px; }
}
@media (max-width: 640px){
    table { font-size: 11px; }
    .actions { flex-direction: column; align-items: stretch; }
}
</style>

<div class="form-container">
    <h2>ESSOM CO.,LTD.</h2>
    <h2>บริษัท เอสซอม จำกัด</h2>
    <h2>ทะเบียนความรู้องค์กร(Organization Knowledge)</h2>

    <form action="{{ route('knowledge-register.store') }}" method="POST">
        @csrf
        <table id="knowledgeTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>รหัสเอกสาร</th>
                    <th>วันที่รับเอกสาร</th>
                    <th>ชื่อเรื่ององค์กรความรู้</th>
                    <th>[ปุ่มลบ]ห</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><input type="text" name="document_code[]" placeholder="" required></td>
                    <td><input type="date" name="received_date[]" required></td>
                    <td><input type="text" name="doc_title[]" placeholder=""></td>
                    <td><button type="button" class="delete">ลบ</button></td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="edit" id="addRowBtn" style="margin-top:10px;">+ เพิ่มแถว</button>

        <div class="actions">
            <button type="button" class="ghost" onclick="window.location.href='{{ route('knowledge-register.index') }}'">ย้อนกลับ</button>
            <button type="submit" class="primary">บันทึกข้อมูล</button>
        </div>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const tableBody = document.querySelector('#knowledgeTable tbody'); 
    const addRowBtn = document.getElementById('addRowBtn');

    function updateRowNumbers() {
        const rows = tableBody.querySelectorAll('tr');
        rows.forEach((row, index) => { row.cells[0].textContent = index + 1; });
    }

    tableBody.addEventListener("click", function(e) {
        if (e.target.closest(".delete")) {
            const row = e.target.closest('tr');
            if (confirm("คุณแน่ใจหรือไม่ว่าต้องการลบแถวนี้?")) {
                row.remove();
                updateRowNumbers();
            }
        }
    });

    addRowBtn.addEventListener('click', () => {
        const rowCount = tableBody.rows.length + 1;
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${rowCount}</td>
            <td><input type="text" name="document_code[]" placeholder=""></td>
            <td><input type="date" name="received_date[]"></td>
            <td><input type="text" name="doc_title[]" placeholder=""></td>
            <td><button type="button" class="delete">ลบ</button></td>
        `;
        tableBody.appendChild(newRow);
    });
});
</script>

@endsection
