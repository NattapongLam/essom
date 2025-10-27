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
    .actions { display:flex; gap:8px; justify-content:center; flex-wrap: wrap; }

.action-btn.view {
    background: linear-gradient(180deg, #2563eb, #60a5fa);
    color: white;
    border-radius: 6px;
    padding: 6px 12px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}
.action-btn.view:hover { transform: scale(1.05); }

.action-btn.edit {
    background: linear-gradient(180deg, #3b82f6, #60a5fa);
    color: white;
    border-radius: 6px;
    padding: 6px 12px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}
.action-btn.edit:hover { transform: scale(1.05); }

.action-btn.delete {
    background: linear-gradient(180deg, #dc2626, #ef4444);
    color: white;
    border-radius: 6px;
    padding: 6px 12px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}
.action-btn.delete:hover { transform: scale(1.05); }

.form-container {
    background: #ffffff;
    border-radius: 18px;
    padding: 25px 40px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
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
}
th { background-color: #cdced2ff; color: #000000ff; font-weight:600; }
tr:nth-child(even) { background-color: #000000ff; }
.delete {
    background: linear-gradient(180deg, #dc2626, #ef4444);
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    border: none;
    cursor:pointer;
}
#searchInput, #printBtn, #exportExcelBtn {
    border-radius: 8px;
    border: 1px solid #94a3b8;
    padding: 8px 12px;
    font-size: 14px;
    transition: all 0.2s ease;
}
button.primary, #printBtn, #exportExcelBtn {
    background: linear-gradient(180deg, #1e3a8a, #3b82f6);
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    margin-right: 5px;
    transition: all 0.2s ease;}

#searchInput { width: 180px; }

#printBtn, #exportExcelBtn {
    background: linear-gradient(180deg, #c4c5c7ff, #b2b3b4ff);
    color: white;
    border: none;
    cursor: pointer;
    font-weight: 600;
}

#printBtn:hover, #exportExcelBtn:hover, #searchInput:focus {
    transform: scale(1.05);
    outline: none;
    border-color: #1e40af;
    box-shadow: 0 0 4px rgba(59,130,246,0.3);
}
</style>
<div class="form-container">
    <h2 align="center">ESSOM CO., LTD. <br> รายการบำรุงรักษาอุปกรณ์IT</h2>
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; flex-wrap:wrap; gap:10px">
        <a href="{{ route('computer-records.create') }}" >+ เพิ่มข้อมูลใหม่</a>
               <input type="text" id="searchInput" placeholder="🔍 ค้นหา...">
    </div>
<div style="margin-bottom:10px;">
        <button id="printBtn">Print</button>
        <button id="exportExcelBtn">Excel</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>For Asset Number</th>
                <th>User Name</th>
                <th>Period</th>
                <th>[ปุ่มลบ/แก้ไข]</th>
            </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->asset_number }}</td>
                <td>{{ $record->user_name }}</td>
                <td>{{ $record->period }}</td>
                <td>
                       <div class="actions">
         <a href="{{ route('computer-records.show', $record->id) }}" 
                       class="action-btn view show-popup" 
                       data-id="{{ $record->id }}">ดู</a>
                    <a href="{{ route('computer-records.edit', $record->id) }}" class="action-btn edit">แก้ไข</a>
                    <form action="{{ route('computer-records.destroy', $record->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete" onclick="return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่?')">ลบ</button>
                        </div>
                    </form>
                </td>
            </tr>
            
        @endforeach
        </tbody>
    </table>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const table = document.querySelector('table');
    const searchInput = document.getElementById('searchInput');
    const rows = table.querySelectorAll('tbody tr');
    searchInput.addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            let match = false;
            cells.forEach((cell, i) => {
                if(i < cells.length - 1 && cell.textContent.toLowerCase().includes(filter)) match = true;
            });
            row.style.display = match ? '' : 'none';
        });
    });
    document.getElementById('printBtn').addEventListener('click', function() {
        window.print();
    });
    document.getElementById('exportExcelBtn').addEventListener('click', function() {
        let wb = XLSX.utils.book_new();
        let ws = XLSX.utils.table_to_sheet(table);
        XLSX.utils.book_append_sheet(wb, ws, "ComputerRecords");
        XLSX.writeFile(wb, "ComputerRecords.xlsx");
    });
});  
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.show-popup').forEach(btn => {
        btn.addEventListener('click', function(e){
            e.preventDefault();
            const recordId = this.dataset.id;
            const url = `/computer-records/${recordId}`; 

            fetch(url)
                .then(res => res.text())
                .then(html => {
                    Swal.fire({
                        title: 'รายละเอียดการบำรุงรักษา',
                        html: html,
                        width: '100%',
                        showCloseButton: true,
                        focusConfirm: false,
                    });
                })
                .catch(err => {
                    Swal.fire('เกิดข้อผิดพลาด','ไม่สามารถโหลดข้อมูลได้','error');
                });
        });
    });
});
</script>
@endsection
