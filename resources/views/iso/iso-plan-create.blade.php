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
input[readonly], input[disabled] {
    background-color: #e5e7eb; 
    color: #6b7280; 
    cursor: not-allowed;
}
.card, .form-container { background: #ffffff; border-radius: 18px; padding: 25px 40px; box-shadow: 0 6px 20px rgba(0,0,0,0.08); border: 1px solid #e0e0e0; margin-bottom: 25px; }
body { background-color: #ffffff; }
h2 { text-align: center; font-weight: 700; color: #0f172a; margin-bottom: 8px; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 16px; color: #1e293b; background-color: #ffffff; }
th, td { border: 1px solid #cbd5e1; padding: 10px 12px; text-align: center; vertical-align: middle; background-color: #ffffff; }
th { background-color: #1e40af; color: #ffffff; font-weight: 600; text-transform: uppercase; }
tr:nth-child(even) { background-color: #f8fafc; }
input, textarea, select { border: 1px solid #94a3b8; border-radius: 5px; padding: 6px 10px; font-size: 14px; width: 100%; box-sizing: border-box; background-color: #ffffff; transition: 0.2s; }
input:focus, textarea:focus { border-color: #1e40af; box-shadow: 0 0 4px rgba(59,130,246,0.3); outline: none; }
button.primary { background: linear-gradient(180deg, #1e3a8a, #3b82f6); color: white; border: none; padding: 10px 18px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s ease; }
button.primary:hover { transform: scale(1.05); }
button.edit { background: linear-gradient(180deg, #2563eb, #60a5fa); color:white; border:none; padding:8px 14px; border-radius:6px; font-weight:500; cursor:pointer; transition: all 0.2s ease; }
button.edit:hover { transform: scale(1.05); }
button.delete { background: linear-gradient(180deg, #dc2626, #ef4444); color: white; border: none; padding: 8px 14px; border-radius: 6px; font-weight: 500; cursor: pointer; transition: all 0.2s ease; }
button.delete:hover { transform: scale(1.05); }
.actions { display:flex; gap:12px; justify-content:flex-end; margin-top:15px; }
input[type="text"], input[type="date"] { height: 36px; font-size: 16px; }
</style>

<form action="{{ route('iso-plan.store') }}" method="POST">
@csrf
<div class="form-container">
    <center>
    <h2>ESSOM CO.,LTD.</h2>
    <h2>PLAN</h2>
    <br><br>
    <div class="row">
        <div class="col-6">
            Project: <input type="text" name="project_name" style="width:450px;" required>
        </div>
        <div class="col-6">
            Responsible Section / Person: <input type="text" name="responsible_section" style="width:450px;" required>
        </div>
    </div>
    </center>
    <br/>

    <table id="activityTable">
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Description of Activities</th>
                <th rowspan="2">Resp.<br>Person</th>
                <th colspan="2">Date</th>
                <th>STATUS</th>
                <th rowspan="2">Progress Report/Remarks</th>
                <th rowspan="2">[ลบ]</th>
            </tr>
            <tr>
                <th>Start</th>
                <th>Finish</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 5; $i++)
            <tr>
                <td>{{ $i + 1 }}</td>
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
            </tr>
            @endfor
        </tbody>
    </table>

    <br>
    <button type="button" style="float:left;" class="edit" id="addRowBtn">+ เพิ่มแถว</button>
    <br><br>
    <div class="row">
        <div class="col-8">
        Prepared by: <input type="text" name="prepared_by"  value="{{auth()->user()->name}}" style="width:300px;" readonly>
        </div>
        <div class="col-4">
        Date: <input type="date" name="prepared_date" value="{{ old('date', now()->format('Y-m-d')) }}" style="width:200px;" required>
        </div>
    </div>
    <br>
   <div class="row">
     <div class="col-8">
        Progress Review: <input type="text" name="prepared_progress_review" style="width:300px;" readonly>
     </div>
     <div class="col-4">
          Date: <input type="date" name="prepared_progress_date" style="width:200px;" readonly>
     </div>
   </div>
    <br><br>
    <div class="row">
        <div class="col-8">
        Reviewed by  <input type="text" name="reviewed_by" style="width:300px;" readonly>
        </div>
        <div class="col-4">
        Date: <input type="date" name="reviewed_date" style="width:200px;" readonly>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-8">
            Reported by: <input type="text" name="reported_by" style="width:300px;" readonly>
        </div>
        <div class="col-4">
            Date: <input type="date" name="reported_progress_date" style="width:200px;" readonly>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-8">
             Approved by: <input type="text" name="approved_by" style="width:300px;" readonly>
        </div>
        <div class="col-4">
             Date: <input type="date" name="approved_date" style="width:200px;" readonly>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-8">
            Acknowledged by: <input type="text" name="acknowledged_by" style="width:300px;" readonly >
        </div>
        <div class="col-4">
            Date: <input type="date" name="acknowledged_date" style="width:200px;" readonly>
        </div>
    </div>
   
   
    
   

    <div class="actions" style="margin-top:10px; text-align:right;">
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

function deleteRow(btn) {
    const row = btn.closest('tr');
    if (!row) return;
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
            updateRowNumbers();
            Swal.fire('ลบแล้ว!', '', 'success');
        }
    });
}

function updateRowNumbers() {
    const rows = tableBody.querySelectorAll('tr');
    rows.forEach((row, index) => row.cells[0].textContent = index + 1);
}

addRowBtn.addEventListener('click', () => {
    const rowCount = tableBody.rows.length + 1;
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${rowCount}</td>
        <td><input type="text" name="DA[]" placeholder="Activity"></td>
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
    newRow.querySelector(".delete").addEventListener("click", () => deleteRow(newRow.querySelector(".delete")));
});

tableBody.querySelectorAll(".delete").forEach(btn => btn.addEventListener("click", () => deleteRow(btn)));
</script>
@endpush  