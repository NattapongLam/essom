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
    background: #fff;
    padding: 25px 40px;
    border-radius: 18px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    margin-bottom: 25px;
}
h2 { text-align: center; font-weight: 700; color: #0f172a; margin-bottom: 8px; }
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

.actions { display:flex; gap:12px; justify-content:flex-end; margin-top:15px; }

@media (max-width: 1024px){
    table, th, td { font-size: 12px; }
    .form-container { width: 95%; padding: 20px; }
}
@media (max-width: 640px){
    table { font-size: 11px; }
    .actions { flex-direction: column; align-items: stretch; }
}
</style>

<form action="{{ route('objcctives.store') }}" method="POST">
@csrf
<div class="form-container">
    <h2>ESSOM CO.,LTD.</h2>
    <h2>Objective</h2>
    <br><br>
    <center>
        <div class="section-line">
            <label>Section:
                <input type="text" name="section[]" value="{{ old('section.0') }}" style="width:430px;" required>
            </label>
            <label>Period:
                <input type="text" name="period[]" value="{{ old('period.0') }}" style="width:540px;" required>
            </label>
        </div>
   

    <table id="objectiveTable">
        <thead>
            <tr>
                <th rowspan="2">NO.</th>
                <th rowspan="2">DESCRIPTION OF ACTIVITIES</th>
                <th rowspan="2">RESP. PERSON</th>
                <th colspan="3">OBJECTIVE</th>
                <th rowspan="2">REMARKS/CORRECTIVE ACTION</th>
                <th rowspan="2">[ปุ่มลบ]</th>
            </tr>
            <tr>
                <td width="8%" align="center">Previous</td>
                <td width="8%" align="center">Plan</td>
                <td width="8%" align="center">Results</td>
            </tr>
        </thead>
        <tbody>
            @for($i = 0; $i < 5; $i++)
            <tr>
                <td>{{ $i+1 }}</td>
                <td><input type="text" name="description[]" placeholder="Description of Activities" value="{{ old('description.'.$i) }}"></td>
                <td>
                    <select class="form-control receiver-select" name="resp_person[]">
                        <option value=""></option>
                        @foreach ($emp as $item)
                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="text" name="previous[]" placeholder="Previous" value="{{ old('previous.'.$i) }}"></td>
                <td><input type="text" name="plan[]" placeholder="Plan" value="{{ old('plan.'.$i) }}"></td>
                <td><input type="text" name="results[]" placeholder="Results" value="{{ old('results.'.$i) }}"></td>
                <td><input type="text" name="remarks[]" placeholder="Remarks" value="{{ old('remarks.'.$i) }}"></td>
                <td>
                    <input type="hidden" name="no[]" value="{{ $i+1 }}" class="rowNo">
                    <button type="button" class="delete">ลบ</button>
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
     </center>
    <button type="button" class="edit" id="addRowBtn" style="margin-top:10px;">+ เพิ่มแถว</button>
    <br><br>

    <div class="section-line">
        <div class="row">
            <div class="col-4">
                <label>Prepared by:
                    <input type="text" name="prepared_by" class="form-control"  value="{{auth()->user()->name}}" readonly>
                </label>
            </div>
            <div class="col-2">
                <label>Date:
                    <input type="date" name="prepared_date"  class="form-control" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                </label>
            </div>
            <div class="col-4">
                <label>Reported by:
                    <select class="form-control receiver-select" name="reported_by">
                        <option value=""></option>
                        @foreach ($emp as $item)
                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                        @endforeach
                    </select>
                    {{-- <input type="text" name="reported_by"  class="form-control" value="{{ old('reported_by') }}" readonly> --}}
                </label>
            </div>
            <div class="col-2">
                <label>Date:
                    <input type="date" name="reported_date" class="form-control" value="{{ old('reported_date') }}" readonly>
                </label>
            </div>
        </div>
    </div>
    <br>
    <div class="section-line">
        <div class="row">
            <div class="col-4">
                 <label>Reviewed by:
                      <select class="form-control receiver-select" name="reviewed_by">
                        <option value=""></option>
                        @foreach ($emp as $item)
                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                        @endforeach
                    </select>
                    {{-- <input type="text" name="reviewed_by" class="form-control" value="{{ old('reviewed_by') }}" readonly> --}}
                </label>       
            </div>
            <div class="col-2">
                 <label>Date:
                    <input type="date" name="reviewed_date" class="form-control" value="{{ old('reviewed_date') }}"readonly>
                </label>
            </div> 
            <div class="col-4">
                <label>Acknowledged by:
                     <select class="form-control receiver-select" name="acknowledged_by">
                        <option value=""></option>
                        @foreach ($emp as $item)
                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                        @endforeach
                    </select>
                    {{-- <input type="text" name="acknowledged_by" class="form-control" value="{{ old('acknowledged_by') }}" readonly> --}}
                </label>
            </div>
            <div class="col-2">
                <label>Date:
                    <input type="date" name="acknowledged_date" class="form-control" value="{{ old('acknowledged_date') }}" readonly>
                </label>
            </div>          
        </div>
    </div>
    <br>
    <div class="section-line">
        <div class="row">
            <div class="col-4">
                <label>Approved by:
                     <select class="form-control receiver-select" name="approved_by">
                        <option value=""></option>
                        @foreach ($emp as $item)
                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                        @endforeach
                    </select>
                    {{-- <input type="text" name="approved_by" value="{{ old('approved_by') }}" readonly> --}}
                </label>
            </div>
            <div class="col-2">
                 <label>Date:
                    <input type="date" name="approved_date" value="{{ old('approved_date') }}"readonly>
                </label>
            </div>
        </div>
        
       
    </div>

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
document.addEventListener("DOMContentLoaded", function() {
    const tableBody = document.querySelector('#objectiveTable tbody'); 
    const addRowBtn = document.getElementById('addRowBtn');

    function updateRowNumbers() {
        const rows = tableBody.querySelectorAll('tr');
        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1;
            const hiddenInput = row.querySelector('.rowNo');
            if(hiddenInput) hiddenInput.value = index + 1;
        });
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
            <td><input type="text" name="description[]" placeholder="Description of Activities"></td>
            <td>
                <select class="form-control receiver-select" name="resp_person[]"  placeholder="กรุณาเลือกพนักงาน">
                        <option value=""></option>
                        @foreach ($emp as $item)
                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                        @endforeach
                </select>
            </td>
            <td><input type="text" name="previous[]" placeholder="Previous"></td>
            <td><input type="text" name="plan[]" placeholder="Plan"></td>
            <td><input type="text" name="results[]" placeholder="Results"></td>
            <td><input type="text" name="remarks[]" placeholder="Remarks"></td>
            <td>
                <input type="hidden" name="no[]" value="${rowCount}" class="rowNo">
                <button type="button" class="delete">ลบ</button>
            </td>
        `;
        tableBody.appendChild(newRow);
        $(newRow).find('.receiver-select').select2({
            placeholder: 'กรุณาเลือกพนักงาน',
            width: '100%'
        });
    });
});

</script>
@endpush  
