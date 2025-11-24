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
    $activities = is_string($plan->activities) ? json_decode($plan->activities, true) : ($plan->activities ?? []);
    if (empty($activities)) {
        $activities = [
            ['description'=>'','responsible_person'=>'','date_start'=>'','date_end'=>'','status'=>'','remark'=>'']
        ];
    }
@endphp

<style>
    input[readonly], input[disabled] {
    background-color: #e5e7eb; 
    color: #6b7280; 
    cursor: not-allowed;
}
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
            <div class="row">
                <div class="col-6">
                    Project :<input type="text" name="project_name" value="{{ $plan->project_name }}" style="width:450px;" required>
                </div>
                <div class="col-6">
                     Responsible Section / Person : <input type="text" name="responsible_section" value="{{ $plan->responsible_section }}" style="width:450px;" required>
                </div>
            </div>
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
                    <td>
                        <select class="form-control receiver-select" name="RP[]">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                     {{ isset($act['responsible_person']) &&  $act['responsible_person'] == $item->ms_employee_fullname ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                    </td>
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
        <div class="row">
            <div class="col-4">
                Prepared by :
                <input type="text" name="prepared_by" value="{{ $plan->prepared_by }}" readonly>
            </div>
            <div class="col-2">
                Date :
                <input type="date" name="prepared_date" class="form-control" value="{{ $plan->prepared_date ? date('Y-m-d', strtotime($plan->prepared_date)) : '' }}" required>
            </div>
            <div class="col-4">
             Progress Review :
            <select class="form-control receiver-select" name="prepared_progress_review">
                <option value=""></option>
                    @foreach ($emp as $item)
                        <option value="{{ $item->ms_employee_fullname }}"
                             {{ isset( $plan->prepared_progress_review) &&   $plan->prepared_progress_review == $item->ms_employee_fullname ? 'selected' : '' }}>
                            {{ $item->ms_employee_fullname }}
                        </option>
                    @endforeach
            </select>          
            </div>
            <div class="col-2">
                 Date :
        <input type="date" name="prepared_progress_date" class="form-control" value="{{ $plan->prepared_progress_date ? date('Y-m-d', strtotime($plan->prepared_progress_date)) : '' }}" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">                
                Reviewed by : 
                  <select class="form-control receiver-select" name="reviewed_by">
                <option value=""></option>
                    @foreach ($emp as $item)
                        <option value="{{ $item->ms_employee_fullname }}"
                             {{ isset( $plan->reviewed_by) &&   $plan->reviewed_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                            {{ $item->ms_employee_fullname }}
                        </option>
                    @endforeach
            </select> 
            </div>
            <div class="col-2">
                Date :
                <input type="date" name="reviewed_date" class="form-control" value="{{ $plan->reviewed_date ? date('Y-m-d', strtotime($plan->reviewed_date)) : '' }}"  required>
            </div>
            <div class="col-4">
                Reported by : 
                   <select class="form-control receiver-select" name="reported_by">
                <option value=""></option>
                    @foreach ($emp as $item)
                        <option value="{{ $item->ms_employee_fullname }}"
                             {{ isset( $plan->reported_by) &&   $plan->reported_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                            {{ $item->ms_employee_fullname }}
                        </option>
                    @endforeach
            </select> 
            </div>
            <div class="col-2">
                Date :
                <input type="date" name="reported_date" class="form-control" value="{{ $plan->reported_date ? date('Y-m-d', strtotime($plan->reported_date)) : '' }}" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                Approved by :
                   <select class="form-control receiver-select" name="approved_by">
                <option value=""></option>
                    @foreach ($emp as $item)
                        <option value="{{ $item->ms_employee_fullname }}"
                             {{ isset( $plan->approved_by) &&   $plan->approved_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                            {{ $item->ms_employee_fullname }}
                        </option>
                    @endforeach
            </select> 
            </div>
            <div class="col-2">
                Date :
                <input type="date" name="approved_date" class="form-control" value="{{ $plan->approved_date ? date('Y-m-d', strtotime($plan->approved_date)) : '' }}" required>
            </div>
             <div class="col-4">
                Acknowledged by :
                  <select class="form-control receiver-select" name="acknowledged_by">
                <option value=""></option>
                    @foreach ($emp as $item)
                        <option value="{{ $item->ms_employee_fullname }}"
                             {{ isset( $plan->acknowledged_by) &&   $plan->acknowledged_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                            {{ $item->ms_employee_fullname }}
                        </option>
                    @endforeach
            </select> 
            </div>
            <div class="col-2">
                Date :
        <input type="date" name="acknowledged_date" class="form-control" value="{{ $plan->acknowledged_date ? date('Y-m-d', strtotime($plan->acknowledged_date)) : '' }}" required>
            </div>
        </div>
        <br>      
        <div class="actions">
            <button type="submit" class="primary">บันทึกข้อมูล</button>
        </div>
    </div>
</form>
@endsection
@push('scriptjs')
<script>
$(document).ready(function () {
    // init select2 ให้กับ select ที่โหลดมาตั้งแต่แรก
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });
});
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
        <td>
             <select class="form-control receiver-select" name="RP[]">
                        <option value=""></option>
                        @foreach ($emp as $item)
                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                        @endforeach
            </select>
        </td>
        <td><input type="date" name="date_start[]"></td>
        <td><input type="date" name="date_end[]"></td>
        <td><input type="text" name="RS[]" placeholder="Status"></td>
        <td><input type="text" name="Remark[]" placeholder="Remarks"></td>
        <td><button type="button" class="delete">ลบ</button></td>
    `;
    tableBody.appendChild(newRow);
     $(newRow).find('.receiver-select').select2({
            placeholder: 'กรุณาเลือกพนักงาน',
            width: '100%'
        });
    newRow.querySelector('.delete').addEventListener('click', ()=>deleteRow(newRow.querySelector('.delete')));
});

tableBody.querySelectorAll('.delete').forEach(btn=>btn.addEventListener('click', ()=>deleteRow(btn)));
</script>
@endpush
