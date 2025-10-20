@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'แก้ไขสำเร็จ!',
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
h2, h3 {
    text-align: center;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 8px;
}
h3 {
    font-weight: 500;
}
h4 {
    margin-top: 20px;
    margin-bottom: 10px;
    font-weight: 600;
    color: #1e3a8a;
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

tr:nth-child(even) {
    background-color: #f1f5f9;
}

td a {
    color: #1e40af;
    text-decoration: none;
    font-weight: 500;
}

td a:hover {
    text-decoration: underline;
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
button.primary:hover {
    transform: scale(1.05);
}

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
button.edit:hover {
    transform: scale(1.05);
}

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
button.delete:hover {
    transform: scale(1.05);
}

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
    table, th, td {
        font-size: 12px;
    }
    .form-container {
        width: 95%;
        padding: 20px;
    }
}
@media (max-width: 640px){
    table, thead, tbody, th, td, tr {
        display: block;
    }
    thead {
        display: none;
    }
    tr {
        margin-bottom: 15px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 8px;
        background-color: #ffffff;
    }
    td {
        display: flex;
        justify-content: space-between;
        padding: 6px 10px;
        border: none;
        border-bottom: 1px solid #e2e8f0;
    }
    td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #1e3a8a;
    }
    .actions {
        flex-direction: column;
        align-items: stretch;
        gap: 6px;
    }
}
</style>

<div class="form-container">
    <h2>ESSOM CO.,LTD.</h2>
    <h2>บริษัท เอสซอม จำกัด</h2>
    <h2>ทะเบียนความรู้องค์กร (Organization Registration)</h2>

   <div style="margin-top:20px; text-align:right;">
    <input type="text" id="searchInput" name="search" placeholder="🔍 ค้นหา..." value="{{ request('search') }}" style="width:220px; margin-right:8px;">
</div>

    <table id="knowledgeTable">
        <thead>
            <tr>
                <th>NO</th>
                <th>รหัสเอกสาร</th>
                <th>วันที่รับเอกสาร</th>
                <th>ชื่อเรื่ององค์กรความรู้</th>
                <th width="10%">[ปุ่มลบ/แก้ไข]</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @forelse($records as $record)
                @foreach($record->documents as $doc)
                <tr>
                    <td data-label="NO">{{ $i++ }}</td>
                    <td data-label="รหัสเอกสาร">{{ $doc->document_code }}</td>
                    <td data-label="วันที่รับเอกสาร">{{ $doc->received_date }}</td>
                    <td data-label="ชื่อเรื่ององค์กรความรู้">{{ $doc->doc_title }}</td>
                    <td data-label="[ปุ่มลบ/แก้ไข]">

                        <div class="actions">
                            <a href="{{ route('knowledge-register.edit', $record->id) }}">
                                <button class="edit">แก้ไข</button>
                            </a>
                            <form action="{{ route('knowledge-register.destroy', $record->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete" onclick="return confirm('แน่ใจว่าจะลบข้อมูลนี้?')">ลบ</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            @empty
                <tr><td colspan="5">ไม่มีข้อมูล</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="actions">
        <a href="{{ route('knowledge-register.create') }}">
            <button class="primary">+ เพิ่มข้อมูล</button>
        </a>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('knowledgeTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    searchInput.addEventListener('input', function() { 
        const filter = this.value.toLowerCase();

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let match = false;

            for (let j = 0; j < cells.length - 1; j++) {
                if (cells[j].textContent.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }

            rows[i].style.display = match ? '' : 'none';
        }
    });
});
</script>
@endsection
