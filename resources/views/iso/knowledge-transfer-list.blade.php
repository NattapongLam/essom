@extends('layouts.main')
@section('content')
<style>
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

#searchInput {
    border: 1px solid #94a3b8;
    border-radius: 5px;
    padding: 6px 10px;
    font-size: 14px;
    width: 220px;
    box-sizing: border-box;
    background-color: #f8fafc;
    transition: 0.2s;
}
#searchInput:focus {
    border-color: #1e40af;
    box-shadow: 0 0 4px rgba(59,130,246,0.3);
    background-color: #ffffff;
    outline: none;
}
</style>

<div class="wrap">
    <div class="card">
        <h2 align="center">ESSOM CO.,LTD.</h2>
        <h2 align="center">ส่งต่อความรู้องค์กร</h2>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap:10px;">
            <a href="{{ route('knowledge-transfer.create') }}" class="primary">เพิ่มข้อมูลใหม่</a>
            <input type="text" id="searchInput" placeholder="🔍 ค้นหา...">
        </div>

        <div style="margin-bottom:10px;">
            <button id="printBtn" class="dt-button">print</button>
            <button id="exportExcelBtn" class="dt-button">excel</button>
        </div>

        <table id="activityTable" style="width:100%; border-collapse: collapse; font-size:13px;">
           <thead>
    <tr style="background:#f0f0f0; text-align:center;">
        <th rowspan="2">NO</th>
        <th rowspan="2">ผู้ส่ง / ผู้ประเมิน ชื่อ</th>
        <th rowspan="2">หน่วยงาน</th>
        <th rowspan="2">ตำแหน่ง</th>
        <th rowspan="2">วันที่</th>
        <th rowspan="2">เอกสาร KM เลขที่</th>
        <th rowspan="2">อนุมัติเมื่อวันที่</th>
        <th rowspan="2">ความรู้องค์กรด้าน</th>
        <th rowspan="2">เรื่อง</th>

        <th colspan="3">สถานะการส่งต่อ-ถ่ายทอดองค์ความรู้</th>

        <th rowspan="2">วิธีการในการส่งต่อ-ถ่ายทอดความรู้</th>

        <th colspan="7"> การประเมินผล</th>
        <th colspan="7">การทบทวนองค์ความรู้</th>

        <th rowspan="2">อนุมัติโดย / วันที่</th>
        <th rowspan="2">[ปุ่มลบ/แก้ไข]</th>
    </tr>

    <tr style="background:#f9fafb; font-size:12px;">
        <th>ส่งต่อ-ถ่ายทอดแล้ว</th>
        <th>ยังไม่ได้ส่งต่อ-ถ่ายทอด</th>
        <th>อยู่ระหว่างแผนการส่งต่อความรู้</th>


        <th>รับรู้และเข้าใจเป็นอย่างดี</th>
        <th>เข้าใจเป็นบางส่วน</th>
        <th>ยังไม่เข้าใจ</th>
        <th>ผ่าน</th>
        <th>ไม่ผ่าน</th>
        <th>ยังประเมินไม่ได้</th>
        <th>ยังไม่ได้ประเมิน</th>

        <th>องค์ความรู้นี้ยังใช้ได้ปัจจุบัน</th>
        <th>อาจไม่เป็นปัจจุบัน / ไม่สอดคล้อง</th>
        <th>ยกเลิกและจัดหาองค์ความรู้ใหม่แทน</th>
        <th>ควรทบทวนทุกเดือน</th>
        <th>ควรทบทวนทุก 6 เดือน</th>
        <th>ควรทบทวนทุก 1 ปี</th>
        <th>ไม่จำเป็นต้องทบทวนซ้ำ</th>
    </tr>
</thead>
<tbody>
@foreach($records as $record)
           <tr>
               <td align="center">{{ $loop->iteration }}</td>
               <td>{{ $record->evaluator_name }}</td>
               <td>{{ $record->department }}</td>
               <td>{{ $record->position }}</td>
               <td>{{ $record->record_date }}</td>
               <td>{{ $record->doc_no }}</td>
               <td>{{ $record->approved_date }}</td>
               <td>{{ $record->organizational_knowledge }}</td>
               <td>{{ $record->subject }}</td>

               <td align="center">@if($record->status_sent) ✔ <br>{{ $record->sent_date ?? '-' }} @endif</td>
               <td align="center">@if($record->status_pending) ✔ <br>{{ $record->plan_send_date ?? '-' }} @endif</td>
               <td align="center">@if($record->status_planning) ✔ <br>{{ $record->plan_complete_date ?? '-' }} @endif</td>

               <td>{{ $record->transfer_method ?? '-' }}</td>

               <td align="center">{{ $record->eval_understanding_good ? '✔' : '' }}</td>
               <td align="center">{{ $record->eval_understanding_partial ? '✔' : '' }}</td>
               <td align="center">{{ $record->eval_understanding_none ? '✔' : '' }}</td>
               <td align="center">{{ $record->eval_result_pass ? '✔' : '' }}</td>
               <td align="center">{{ $record->eval_result_fail ? '✔' : '' }}</td>
               <td align="center">{{ $record->eval_not_yet ? '✔' : '' }}</td>
               <td align="center">{{ $record->eval_not_done ? '✔' : '' }}</td>

               <td align="center">{{ $record->review_current ? '✔' : '' }}</td>
               <td align="center">{{ $record->review_outdated ? '✔' : '' }}</td>
               <td align="center">{{ $record->review_replace ? '✔' : '' }}</td>
               <td align="center">{{ $record->review_freq_monthly ? '✔' : '' }}</td>
               <td align="center">{{ $record->review_freq_6months ? '✔' : '' }}</td>
               <td align="center">{{ $record->review_freq_yearly ? '✔' : '' }}</td>
               <td align="center">{{ $record->review_freq_none ? '✔' : '' }}</td>

               <td align="center">{{ $record->approved_by }}<br>{{ $record->approved_date_final }}</td>

               <td align="center">
                   <a href="{{ route('knowledge-transfer.edit', $record->id) }}">
                       <button class="edit">แก้ไข</button>
                   </a>
                   <form action="{{ route('knowledge-transfer.destroy', $record->id) }}" method="POST" style="display:inline;">
                       @csrf
                       @method('DELETE')
                       <button type="submit" class="delete" onclick="return confirm('แน่ใจว่าจะลบ?')">ลบ</button>
                   </form>
               </td>
           </tr>
           @endforeach

           @if($records->isEmpty())
           <tr><td colspan="30" align="center">ไม่มีข้อมูล</td></tr>
           @endif
           </tbody>
        </table>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const rows = document.querySelectorAll('#activityTable tbody tr');
    searchInput.addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    document.getElementById('printBtn').addEventListener('click', function() {
        const table = document.getElementById('activityTable');
        window.print();
    });

    document.getElementById('exportExcelBtn').addEventListener('click', function() {
        const table = document.getElementById('activityTable');
        const rows = table.querySelectorAll('tr');
        let wb = XLSX.utils.book_new();
        let ws_data = [];

        rows.forEach((row) => {
            const rowData = [];
            row.querySelectorAll('th, td').forEach(cell => {
                rowData.push(cell.innerText.trim());
            });
            ws_data.push(rowData);
        });

        let ws = XLSX.utils.aoa_to_sheet(ws_data);
        XLSX.utils.book_append_sheet(wb, ws, "Knowledge_Transfer");
        XLSX.writeFile(wb, "Knowledge_Transfer.xlsx");
    });
});
</script>
@endsection