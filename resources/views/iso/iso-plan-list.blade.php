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
.dt-button, #printBtn, #exportExcelBtn {
    background: linear-gradient(180deg, #cecacaff, #827c7cff);
    color: white !important;
    border: none;
    padding: 8px 18px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    margin-right: 5px;
}

.dt-button:hover, #printBtn:hover, #exportExcelBtn:hover {
    transform: scale(1.05);
}
h2, h3 { 
    text-align: center; 
    font-weight: 700; 
    color: #0f172a; 
    margin-bottom: 8px; 
}
h3 { font-weight: 500; }
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
    font-size: 13px;
    color: #1e293b;
    table-layout: fixed;
}

thead th {
    position: sticky;
    top: 0;
    background-color: #f0f0f0;
    z-index: 2;
}

th, td {
    border: 1px solid #ddd;
    padding: 6px 8px;
    text-align: center;
    vertical-align: middle;
    word-wrap: break-word;
}

tr:nth-child(even) { background-color: #fafafa; }
tr:hover { background-color: #e0f2fe; transition: 0.2s; }

td a { 
    color: #1e40af; 
    text-decoration: none; 
    font-weight: 500; 
}
td a:hover { text-decoration: underline; }

button.primary, button.edit, button.delete {
    transition: all 0.2s ease;
}
button.primary:hover, button.edit:hover, button.delete:hover {
    transform: scale(1.05);
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
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
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
    gap:8px;
    justify-content:center;
    flex-wrap: wrap;
}

@media (max-width: 1024px){
    table, th, td { font-size: 12px; }
    .form-container { width: 95%; padding: 20px; }
}
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
    <h2>ESSOM CO.,LTD.</h2>
    <h2>PLAN</h2>
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
        <a href="{{ route('iso-plan.create') }}" class="primary">เพิ่มข้อมูลใหม่</a>
        <input type="text" id="searchInput" placeholder="🔍 ค้นหา..." style="width:220px;">
    </div>
     <button id="printBtn" class="dt-button">print</button>
     <button id="exportExcelBtn" class="dt-button">excel</button>
    
    <div style="overflow-x:auto; max-height:70vh;">
        <table id="activityTable">
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Project</th>
                    <th rowspan="2">Responsible Section / Person</th>
                    <th rowspan="2">Description of Activities</th>
                    <th rowspan="2">Resp. Person</th>
                    <th colspan="2">Date</th>
                    <th rowspan="2">Status</th>
                    <th rowspan="2">Remarks</th>
                    <th rowspan="2">Prepared by</th>
                    <th rowspan="2">Date</th>
                    <th rowspan="2">Progress Review</th>
                    <th rowspan="2">Date</th>
                    <th rowspan="2">Reviewed by</th>
                    <th rowspan="2">Date</th>
                    <th rowspan="2">Reported by</th>
                    <th rowspan="2">Date</th>
                    <th rowspan="2">Approved by</th>
                    <th rowspan="2">Date</th>
                    <th rowspan="2">Acknowledged by</th>
                    <th rowspan="2">Date</th>
                    <th rowspan="2">[ปุ่มลบ/แก้ไข]</th>
                </tr>
                <tr>
                    <th>Start</th>
                    <th>Finish</th>
                </tr>
            </thead>
            <tbody>
@php $no = 1; @endphp
@forelse($records as $index => $plan)
    @php $activities = json_decode($plan->activities, true) ?? []; @endphp
    @foreach($activities as $act)
        <tr>
            <td data-label="No.">{{ $no++ }}</td>
            <td data-label="Project">{{ $plan->project_name ?? '-' }}</td>
            <td data-label="Responsible Section / Person">{{ $plan->responsible_section ?? '-' }}</td>
            <td data-label="Description of Activities">{{ $act['description'] ?? '-' }}</td>
            <td data-label="Resp. Person">{{ $act['resp_person1'] ?? '-' }}</td>
            <td data-label="Start">{{ isset($act['date_start']) ? explode(' ', $act['date_start'])[0] : '-' }}</td>
            <td data-label="Finish">{{ isset($act['date_end']) ? explode(' ', $act['date_end'])[0] : '-' }}</td>
            <td data-label="Status">{{ $act['status'] ?? '-' }}</td>
            <td data-label="Remarks">{{ $act['remark'] ?? '-' }}</td>
            <td data-label="Prepared by">{{ $plan->prepared_by ?? '-' }}</td>
            <td data-label="Date">{{ isset($plan->prepared_date) ? explode(' ', $plan->prepared_date)[0] : '-' }}</td>
            <td data-label="Progress Review">{{ $plan->prepared_progress_review ?? '-' }}</td>
            <td data-label="Date">{{ isset($plan->prepared_progress_date) ? explode(' ', $plan->prepared_progress_date)[0] : '-' }}</td>
            <td data-label="Reviewed by">{{ $plan->reported_progress_review ?? '-' }}</td>
            <td data-label="Date">{{ isset($plan->reported_date) ? explode(' ', $plan->reported_date)[0] : '-' }}</td>
            <td data-label="Reported by">{{ $plan->reported_by ?? '-' }}</td>
            <td data-label="Date">{{ isset($plan->reported_progress_date) ? explode(' ', $plan->reported_progress_date)[0] : '-' }}</td>
            <td data-label="Approved by">{{ $plan->approved_by ?? '-' }}</td>
            <td data-label="Date">{{ isset($plan->approved_date) ? explode(' ', $plan->approved_date)[0] : '-' }}</td>
            <td data-label="Acknowledged by">{{ $plan->acknowledged_by ?? '-' }}</td>
            <td data-label="Date">{{ isset($plan->acknowledged_date) ? explode(' ', $plan->acknowledged_date)[0] : '-' }}</td>
            <td data-label="[ปุ่มลบ/แก้ไข]">
                <div class="actions">
                    <a href="{{ route('iso-plan.edit', $plan->id) }}"><button class="edit">แก้ไข</button></a>
                    <form action="{{ route('iso-plan.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('คุณต้องการลบแผนนี้ใช่หรือไม่?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete">ลบ</button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
@empty
    <tr>
        <td colspan="23" style="text-align:center;">ไม่มีข้อมูล</td>
    </tr>
@endforelse
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
document.getElementById('printBtn').addEventListener('click', function() {
    const table = document.getElementById('activityTable');

    const headerCells = table.querySelectorAll('thead tr:first-child th, thead tr:nth-child(2) th');
    let actionColIndex = -1;
    headerCells.forEach((th, index) => {
        if (th.getAttribute('rowspan') === '2' && th.innerText.includes('ปุ่มลบ/แก้ไข')) {
            actionColIndex = index;
        }
    });

    if (actionColIndex !== -1) {
        const rows = table.querySelectorAll('tr');
        const removedCells = [];
        rows.forEach(row => {
            const cells = row.children;
            if (cells[actionColIndex]) {
                removedCells.push(cells[actionColIndex]);
                cells[actionColIndex].style.display = 'none';
            }
        });
        window.print();
        removedCells.forEach(cell => {
            cell.style.display = '';
        });
    } else {
        window.print();
    }
});

document.getElementById('exportExcelBtn').addEventListener('click', function() {
    const table = document.getElementById('activityTable');
    const rows = table.querySelectorAll('tr');

    let wb = XLSX.utils.book_new();
    let ws_data = [];
    const headerCells = table.querySelectorAll('thead tr:first-child th, thead tr:nth-child(2) th');
    let actionColIndex = -1;
    headerCells.forEach((th, index) => {
        if (th.getAttribute('rowspan') === '2' && th.innerText.includes('ปุ่มลบ/แก้ไข')) {
            actionColIndex = index;
        }
    });

    rows.forEach((row) => {
        const rowData = [];
        row.querySelectorAll('th, td').forEach((cell, idx) => {
            if (idx !== actionColIndex) { 
                rowData.push(cell.innerText.trim());
            }
        });
        ws_data.push(rowData);
    });

    let ws = XLSX.utils.aoa_to_sheet(ws_data);

    const colWidths = [];
    const maxCols = Math.max(...ws_data.map(r => r.length));
    for(let i=0;i<maxCols;i++){
        let maxLength = Math.max(...ws_data.map(r => (r[i] ? r[i].length : 0)));
        colWidths.push({ wch: maxLength + 5 });
    }
    ws['!cols'] = colWidths;

    XLSX.utils.book_append_sheet(wb, ws, "Plan");
    XLSX.writeFile(wb, "ISO_Plan.xlsx");
});
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('activityTable');
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
