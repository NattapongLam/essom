@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success') || session('error'))
<script>
Swal.fire({
    icon: "{{ session('success') ? 'success' : 'error' }}",
    title: "{{ session('success') ? 'สำเร็จ!' : 'เกิดข้อผิดพลาด!' }}",
    text: "{{ session('success') ?? session('error') }}",
    confirmButtonColor: "{{ session('success') ? '#1e40af' : '#dc2626' }}"
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
h2, h3 { text-align: center; font-weight: 700; color: #0f172a; margin-bottom: 8px; }
h3 { font-weight: 500; }
h4 { margin-top: 20px; margin-bottom: 10px; font-weight: 600; color: #1e3a8a; }

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
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
    background-color: #1e40af;
    color: #ffffff;
    font-weight: 600;
    text-transform: uppercase;
}
tr:nth-child(even) { background-color: #f1f5f9; }

td a { color: #1e40af; text-decoration: none; font-weight: 500; }
td a:hover { text-decoration: underline; }

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
    table, thead, tbody, th, td, tr { display: block; }
    thead { display: none; }
    tr { margin-bottom: 15px; border: 1px solid #cbd5e1; border-radius: 8px; padding: 8px; background-color: #ffffff; }
    td { display: flex; justify-content: space-between; padding: 6px 10px; border: none; border-bottom: 1px solid #e2e8f0; }
    td::before { content: attr(data-label); font-weight: 600; color: #1e3a8a; }
    .actions { flex-direction: column; align-items: stretch; gap: 6px; }
}
</style>
<div class="form-container">
    <h2 align="center">ESSOM CO., LTD.</h2>
    <h3 align="center">บันทึกความรู้องค์กร</h3>

    <div style="margin-top:20px; text-align:right;">
        <input type="text" id="searchInput" placeholder="🔍 ค้นหา..." style="width:220px;">
    </div>

    <table id="activityTable" width="100%" border="1" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width="2%" rowspan="2" align="center">NO</th>
                <th width="2%" rowspan="2" align="center">จัดทำโดย</th>
                <th width="2%" rowspan="2" align="center">หน่วยงาน</th>
                <th width="4%" rowspan="2" align="center">ตำแหน่ง</th>
                <th width="4%" rowspan="2" align="center">วันที่</th>
                <th width="4%" rowspan="2" align="center">เอกสารKMเลขที่</th>
                <th width="4%" rowspan="2" align="center">ความรู้องค์กรด้าน</th>
                <th width="3%" rowspan="2" align="center">เอกสารNCR/CAR/คำร้องเรียน เลขที่</th>
                <th width="2%" rowspan="2" align="center">เรื่อง</th>
                <th width="2%" rowspan="2" align="center">รายละเอียดความรู้</th>
                <th width="2%" rowspan="2" align="center">เอกสารแนบ</th>
                <th width="6%" colspan="4" align="center">การประเมินหัวข้อความรู้นี้โดยหัวหน้างาน</th>
                <th width="2%" colspan="3" align="center">กำหนดวันส่งต่อ-ถ่ายทอดความรู้</th>
                <th width="2%" rowspan="2" align="center">[ปุ่มลบ/แก้ไข]</th>
            </tr>
            <tr>
                <td width="3%" align="center">อนุมัติ</td>
                <td width="3%" align="center">ไม่อนุมัติ</td>
                <td width="3%" align="center">รอพิจารณา</td>
                <td width="3%" align="center">เก็บไว้พิจารณา</td>
                <td width="3%" align="center">วันที่</td>
                <td width="3%" align="center">อนุมัติโดย</td>
                <td width="3%" align="center">วันที่</td>
            </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->department }}</td>
            <td>{{ $record->position }}</td>
            <td>{{ \Carbon\Carbon::parse($record->request_date)->format('d/m/Y') }}</td>
            <td>{{ $record->documentKM_no }}</td>
            <td>{{ $record->OZN }}</td>
            <td>{{ $record->document_no }}</td>
            <td>{{ $record->subject }}</td>
            <td>{{ $record->details }}</td>
            <td>
                @if($record->attached_file)
                <a href="{{ asset('storage/'.$record->attached_file) }}" target="_blank">เปิดไฟล์</a>
                @endif
            </td>
            @php $approvalValues = json_decode($record->approval ?? '[]', true); @endphp
            <td>{{ in_array('อนุมัติ', $approvalValues) ? '✔' : '' }}</td>
            <td>{{ in_array('ไม่อนุมัติ', $approvalValues) ? '✔' : '' }}</td>
            <td>{{ in_array('รอพิจารณา', $approvalValues) ? '✔' : '' }}</td>
            <td>{{ in_array('เก็บไว้พิจารณา', $approvalValues) ? '✔' : '' }}</td>
            <td>{{ $record->transfer_date ? \Carbon\Carbon::parse($record->transfer_date)->format('d/m/Y') : '' }}</td>
            <td>{{ $record->NameCF }}</td>
            <td>{{ $record->approval_date ? \Carbon\Carbon::parse($record->approval_date)->format('d/m/Y') : '' }}</td>
            <td>
                <div class="actions">
                    <a href="{{ route('knowledge-record.edit', $record->id) }}">
                        <button class="edit">แก้ไข</button>
                    </a>
                    <form action="{{ route('knowledge-record.destroy', $record->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete" onclick="return confirm('ยืนยันลบข้อมูล?')">ลบ</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <div class="actions" style="margin-top:15px;">
        <a href="{{ route('knowledge-record.create') }}">
            <button class="primary">+ บันทึกความรู้องค์กร</button>
        </a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('activityTable');
    const tbody = table.getElementsByTagName('tbody')[0];
    const rows = tbody.getElementsByTagName('tr');

    function updateRowNumbers() {
        let visibleIndex = 1;
        for (let i = 0; i < rows.length; i++) {
            if (rows[i].style.display !== 'none') {
                rows[i].querySelector('td:first-child').textContent = visibleIndex++;
            }
        }
    }

    searchInput.addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let match = false;
            for (let j = 0; j < cells.length; j++) {
                if (cells[j].textContent.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }
            rows[i].style.display = match ? '' : 'none';
        }
        updateRowNumbers();
    });
});
</script>
@endsection
