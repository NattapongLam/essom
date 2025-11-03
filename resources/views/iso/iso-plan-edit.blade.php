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

@php
    // ตรวจสอบ activities ว่าเป็น string หรือ array
    $activities = is_string($plan->activities) ? json_decode($plan->activities, true) : ($plan->activities ?? []);
    if (empty($activities)) {
        $activities = [
            ['description'=>'','responsible_person'=>'','date_start'=>'','date_end'=>'','status'=>'','remark'=>'']
        ];
    }
@endphp

<style>
.card, .form-container { background:#fff; border-radius:18px; padding:25px 40px; box-shadow:0 6px 20px rgba(0,0,0,0.08); border:1px solid #e0e0e0; margin-bottom:25px; }
body { background:#fff; }
h2 { text-align:center; font-weight:700; color:#0f172a; margin-bottom:8px; }
table { width:100%; border-collapse:collapse; margin-top:20px; font-size:16px; color:#1e293b; background:#fff; }
th, td { border:1px solid #cbd5e1; padding:10px 12px; text-align:center; vertical-align:middle; background:#fff; }
th { background:#1e40af; color:#fff; font-weight:600; text-transform:uppercase; }
tr:nth-child(even) { background:#f8fafc; }
input, textarea, select { border:1px solid #94a3b8; border-radius:5px; padding:6px 10px; width:100%; box-sizing:border-box; background:#fff; transition:0.2s; }
input:focus, textarea:focus { border-color:#1e40af; box-shadow:0 0 4px rgba(59,130,246,0.3); outline:none; }
button.primary { background:linear-gradient(180deg,#1e3a8a,#3b82f6); color:#fff; border:none; padding:10px 18px; border-radius:8px; cursor:pointer; transition:0.2s; }
button.primary:hover { transform:scale(1.05); }
button.edit { background:linear-gradient(180deg,#2563eb,#60a5fa); color:#fff; border:none; padding:8px 14px; border-radius:6px; cursor:pointer; transition:0.2s; }
button.edit:hover { transform:scale(1.05); }
button.delete { background:linear-gradient(180deg,#dc2626,#ef4444); color:#fff; border:none; padding:8px 14px; border-radius:6px; cursor:pointer; transition:0.2s; }
button.delete:hover { transform:scale(1.05); }
.actions { display:flex; gap:12px; justify-content:flex-end; margin-top:15px; }
input[type="text"], input[type="date"] { height:36px; font-size:16px; }
</style>

<form action="{{ route('iso-plan.update', $plan->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-container">
        <center>
            <h2>ESSOM CO.,LTD.</h2>
            <h2>ใบ PLAN</h2>
            <br><br>
            Project :
            <input type="text" name="project_name" value="{{ $plan->project_name }}" style="width:450px; margin-right:200px;" required>
            Responsible Section / Person :
            <input type="text" name="responsible_section" value="{{ $plan->responsible_section }}" style="width:450px;" required>
        </center>
        <br>
        <table id="activityTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Description of Activities</th>
                    <th>Resp. Person</th>
                    <th>Start</th>
                    <th>Finish</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $i => $act)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><input type="text" name="DA[]" value="{{ $act['description'] ?? '' }}"></td>
                    <td><input type="text" name="RP[]" value="{{ $act['responsible_person'] ?? $act['responsible'] ?? '' }}"></td>
                    <td><input type="date" name="date_start[]" value="{{ $act['date_start'] ? date('Y-m-d', strtotime($act['date_start'])) : '' }}"></td>
                    <td><input type="date" name="date_end[]" value="{{ $act['date_end'] ? date('Y-m-d', strtotime($act['date_end'])) : '' }}"></td>
                    <td><input type="text" name="RS[]" value="{{ $act['status'] ?? '' }}"></td>
                    <td><input type="text" name="Remark[]" value="{{ $act['remark'] ?? '' }}"></td>
                    <td><button type="button" class="delete">ลบ</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <br>
            <button type="button" class="edit" id="addRowBtn">+ เพิ่มแถว</button>
        </div>
        <br><br>

        Prepared by :
        <input type="text" name="prepared_by" value="{{ $plan->prepared_by }}" style="width:400px;">
        Date :
        <input type="date" name="prepared_date" value="{{ $plan->prepared_date ? date('Y-m-d', strtotime($plan->prepared_date)) : '' }}" style="width:150px; margin-right:200px;">
        Progress Review :
        <input type="text" name="prepared_progress_review" value="{{ $plan->prepared_progress_review }}" style="width:390px;">
        Date :
        <input type="date" name="prepared_progress_date" value="{{ $plan->prepared_progress_date ? date('Y-m-d', strtotime($plan->prepared_progress_date)) : '' }}" style="width:150px;">
        <br><br>
Reviewed by :
<input type="text" name="reviewed_by" value="{{ $plan->reviewed_by }}" style="width:400px;">
Date :
<input type="date" name="reviewed_date" value="{{ $plan->reviewed_date ? date('Y-m-d', strtotime($plan->reviewed_date)) : '' }}" style="width:150px; margin-right:200px;">

        Reported by :
<input type="text" name="reported_by" value="{{ $plan->reported_by }}" style="width:420px;">
Date :
<input type="date" name="reported_date" value="{{ $plan->reported_date ? date('Y-m-d', strtotime($plan->reported_date)) : '' }}" style="width:150px;">

        <br><br>
        Approved by :
        <input type="text" name="approved_by" value="{{ $plan->approved_by }}" style="width:400px;">
        Date :
        <input type="date" name="approved_date" value="{{ $plan->approved_date ? date('Y-m-d', strtotime($plan->approved_date)) : '' }}" style="width:150px; margin-right:200px;">
        Acknowledged by :
        <input type="text" name="acknowledged_by" value="{{ $plan->acknowledged_by }}" style="width:380px;">
        Date :
        <input type="date" name="acknowledged_date" value="{{ $plan->acknowledged_date ? date('Y-m-d', strtotime($plan->acknowledged_date)) : '' }}" style="width:150px;">
        <div class="actions">
            <button type="submit" class="primary">บันทึกข้อมูล</button>
        </div>
    </div>
</form>

<script>
const tableBody = document.querySelector('#activityTable tbody');
const addRowBtn = document.getElementById('addRowBtn');

function updateRowNumbers(){
    tableBody.querySelectorAll('tr').forEach((row,index)=>{
        row.cells[0].textContent = index+1;
    });
}

function deleteRow(btn){
    const row = btn.closest('tr');
    if(!row) return;
    Swal.fire({
        title:'ยืนยันลบ?',
        text:'คุณแน่ใจหรือไม่ว่าต้องการลบแถวนี้?',
        icon:'warning',
        showCancelButton:true,
        confirmButtonColor:'#dc2626',
        cancelButtonColor:'#6b7280',
        confirmButtonText:'ใช่, ลบ!',
        cancelButtonText:'ยกเลิก'
    }).then((result)=>{
        if(result.isConfirmed){
            row.remove();
            updateRowNumbers();
            Swal.fire('ลบแล้ว!','','success');
        }
    });
}

addRowBtn.addEventListener('click', ()=>{
    const rowCount = tableBody.rows.length + 1;
    const newRow = document.createElement('tr');
    newRow.innerHTML=`
        <td>${rowCount}</td>
        <td><input type="text" name="DA[]" placeholder="Description"></td>
        <td><input type="text" name="RP[]" placeholder="Person"></td>
        <td><input type="date" name="date_start[]"></td>
        <td><input type="date" name="date_end[]"></td>
        <td><input type="text" name="RS[]" placeholder="Status"></td>
        <td><input type="text" name="Remark[]" placeholder="Remarks"></td>
        <td><button type="button" class="delete">ลบ</button></td>
    `;
    tableBody.appendChild(newRow);
    newRow.querySelector('.delete').addEventListener('click', ()=>deleteRow(newRow.querySelector('.delete')));
});

tableBody.querySelectorAll('.delete').forEach(btn=>btn.addEventListener('click', ()=>deleteRow(btn)));
</script>
@endsection
