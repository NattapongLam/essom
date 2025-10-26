@extends('layouts.main')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

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
.form-container {
    background: #ffffff;
    border-radius: 18px;
    padding: 25px 30px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    margin-bottom: 25px;
    overflow-x: auto;
    font-family: "Tahoma", sans-serif;
    font-size: 14px;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

th, td {
    border: 1px solid #ddd;
    padding: 6px 8px;
    text-align: center;
    vertical-align: top;
    word-wrap: break-word;
}

th {
    background-color: #f0f0f0;
    font-weight: 600;
}

tr:nth-child(even) { background-color: #fafafa; }
tr:hover { background-color: #e0f2fe; transition: 0.2s; }

ul { padding-left:15px; margin:0; }

button.primary, #printBtn, #exportExcelBtn {
    background: linear-gradient(180deg, #1e3a8a, #3b82f6);
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    margin-right: 5px;
    transition: all 0.2s ease;
}

button.primary:hover, #printBtn:hover, #exportExcelBtn:hover { 
    transform: scale(1.05);
}

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

#searchInput {
    padding: 6px 10px;
    border-radius: 6px;
    border: 1px solid #94a3b8;
    width: 220px;
    margin-bottom: 15px;
}
</style>

<div class="form-container">
    <h3 style="text-align:center;">รายการแบบฟอร์มการวิเคราะห์ความเสี่ยงต่อธุรกิจของบริษัท (SWOT)</h3>

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; flex-wrap:wrap; gap:10px;">
        <a href="{{ route('assessrisk-swot.create') }}" class="primary">เพิ่มข้อมูลใหม่</a>
        <input type="text" id="searchInput" placeholder="🔍 ค้นหา...">
    </div>

    <div style="margin-bottom:10px;">
        <button id="printBtn" class="dt-button">Print</button>
        <button id="exportExcelBtn" class="dt-button">Excel</button>
    </div>

    <div style="overflow-x:auto;">
        <table id="swotTable">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>วันที่ประชุม</th>
                    <th>Strengths (S)</th>
                    <th>Weaknesses (W)</th>
                    <th>Opportunities (O)</th>
                    <th>Threats (T)</th>
                    <th>รายงานโดย</th>
                    <th>วันที่รายงาน</th>
                    <th>รับทราบโดย</th>
                    <th>วันที่รับทราบ</th>
                    <th>[ปุ่มลบ/แก้ไข]</th>
                </tr>
            </thead>
            <tbody>
@foreach($records as $record)
    @php
        $strengths     = is_array($record->strength) ? $record->strength : (json_decode($record->strength, true) ?? []);
        $weaknesses    = is_array($record->weakness) ? $record->weakness : (json_decode($record->weakness, true) ?? []);
        $opportunities = is_array($record->opportunity) ? $record->opportunity : (json_decode($record->opportunity, true) ?? []);
        $threats       = is_array($record->threat) ? $record->threat : (json_decode($record->threat, true) ?? []);
    @endphp
    <tr>
        <td data-label="NO">{{ $loop->iteration }}</td>
        <td data-label="วันที่ประชุม">{{ $record->meeting_date?->format('d/m/Y') ?? '-' }}</td>

        <td data-label="Strengths">
            @if(count($strengths))
                <ul style="padding-left:15px; margin:0;">
                    @foreach($strengths as $s)
                        <li>{{ $s['risk'] ?? '-' }} @if(!empty($s['measure'])) - {{ $s['measure'] }} @endif</li>
                    @endforeach
                </ul>
            @else
                -
            @endif
        </td>

        <td data-label="Weaknesses">
            @if(count($weaknesses))
                <ul style="padding-left:15px; margin:0;">
                    @foreach($weaknesses as $w)
                        <li>{{ $w['risk'] ?? '-' }} @if(!empty($w['measure'])) - {{ $w['measure'] }} @endif</li>
                    @endforeach
                </ul>
            @else
                -
            @endif
        </td>

        <td data-label="Opportunities">
            @if(count($opportunities))
                <ul style="padding-left:15px; margin:0;">
                    @foreach($opportunities as $o)
                        <li>{{ $o['risk'] ?? '-' }} @if(!empty($o['measure'])) - {{ $o['measure'] }} @endif</li>
                    @endforeach
                </ul>
            @else
                -
            @endif
        </td>

        <td data-label="Threats">
            @if(count($threats))
                <ul style="padding-left:15px; margin:0;">
                    @foreach($threats as $t)
                        <li>{{ $t['risk'] ?? '-' }} @if(!empty($t['measure'])) - {{ $t['measure'] }} @endif</li>
                    @endforeach
                </ul>
            @else
                -
            @endif
        </td>

        <td data-label="รายงานโดย">{{ $record->report_by ?? '-' }}</td>
        <td data-label="วันที่รายงาน">{{ $record->report_date?->format('d/m/Y') ?? '-' }}</td>
        <td data-label="รับทราบโดย">{{ $record->ack_by ?? '-' }}</td>
        <td data-label="วันที่รับทราบ">{{ $record->ack_date?->format('d/m/Y') ?? '-' }}</td>

        <td data-label="Action">
            <div class="actions">
                <a href="{{ route('assessrisk-swot.show', $record->id) }}" 
   class="action-btn view" 
   onclick="window.open(this.href,'swotDetail','width=1000,height=800,scrollbars=yes'); return false;">ดู</a>
                <a href="{{ route('assessrisk-swot.edit', $record->id) }}" class="action-btn edit">แก้ไข</a>
                <form action="{{ route('assessrisk-swot.destroy', $record->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn delete" onclick="return confirm('คุณต้องการลบข้อมูลใช่หรือไม่?')">ลบ</button>
                </form>
            </div>
        </td>
    </tr>
@endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    onst modal = document.getElementById('swotPopup');
const backdrop = document.getElementById('modalBackdrop');
const closeBtn = document.getElementById('closePopup');

function showSwot(id) {
    fetch(`/assessrisk-swot/${id}`)  
        .then(res => res.text())
        .then(html => {
            document.getElementById('popupContent').innerHTML = html;
            modal.style.display = 'block';
            backdrop.style.display = 'block';
        });
}

closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
    backdrop.style.display = 'none';
});

backdrop.addEventListener('click', () => {
    modal.style.display = 'none';
    backdrop.style.display = 'none';
});
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('swotTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    searchInput.addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        for (let i=0;i<rows.length;i++){
            const cells = rows[i].getElementsByTagName('td');
            let match = false;
            for (let j=0;j<cells.length-1;j++){
                if(cells[j].textContent.toLowerCase().indexOf(filter)>-1){
                    match = true; break;
                }
            }
            rows[i].style.display = match ? '' : 'none';
        }
    });

    document.getElementById('printBtn').addEventListener('click', function() {
        window.print();
    });

    document.getElementById('exportExcelBtn').addEventListener('click', function() {
        let wb = XLSX.utils.book_new();
        let ws = XLSX.utils.table_to_sheet(table);
        XLSX.utils.book_append_sheet(wb, ws, "SWOT");
        XLSX.writeFile(wb, "SWOT.xlsx");
    });
});
</script>

@endsection