@extends('layouts.main')
@section('content')
@if(session('success'))
    <p style="color: green; text-align:center;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red; text-align:center;">{{ session('error') }}</p>
@endif

<style>
.card {
  background: linear-gradient(180deg, var(--card), #fbfdff);
  border-radius: 18px;
  padding: 20px;
  box-shadow: 0 6px 18px rgba(6,20,40,0.08), 0 18px 40px rgba(8,25,60,0.08), inset 0 1px 0 rgba(255,255,255,0.6);
  border: 1px solid rgba(15,23,42,0.04);
  position: relative;
}
button.primary {
  background: linear-gradient(180deg, #258b25ff, #337725ff);
  color: white;
  border: none;
  padding: 10px 16px;
  border-radius: 10px;
  font-weight: 700;
  box-shadow: 0 10px 30px rgba(8,158,157,0.18);
  cursor: pointer;
}
button.edit {
  background: linear-gradient(180deg, #2ea8c6ff, #80bde5ff);
  color: white;
  border: none;
  padding: 10px 16px;
  border-radius: 10px;
  font-weight: 700;
  box-shadow: 0 10px 30px rgba(8,158,157,0.18);
  cursor: pointer;
}
button.delete {
  background: linear-gradient(180deg, #cb8a8aff, #b91c1c);
  color: white;
  border: none;
  padding: 6px 10px;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 4px;
}
button.delete:hover {
  background: linear-gradient(180deg, #ef4444, #dc2626);
  transform: scale(1.05);
}
button.delete svg {
  width: 14px;
  height: 14px;
  fill: white;
}

input {
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 4px;
  outline: none;
  background: transparent;
  text-align: center;
  font-size: 14px;
  padding: 6px;
  box-sizing: border-box;
}
input:focus {
  background-color: #f8faff;
  border-bottom: 2px solid #3b82f6;
}

.form-container {
  font-family: "Times New Roman", Times, serif;
  margin: 30px auto;
  background: #fff;
  padding: 20px 50px;
  border-radius: 25px;
  box-shadow: 10px 10px 10px gray;
  width: 1200px;
}

table {
  width: 100%;
  border-collapse: collapse;
  border: 1px solid black;
  margin-top: 15px;
}
th, td {
  border: 1px solid black;
  padding: 4px;
  text-align: center;
  vertical-align: middle;
}
th {
  background-color: #789fc8ff;
  font-weight: bold;
}
.actions {
  display: flex;
  gap: 12px;
  justify-content: flex-end;
  margin-top: 18px;
}
tr.fade-out {
  opacity: 0;
  transition: opacity 0.3s ease;
}
</style>
<h2 align="center">ESSOM CO.,LTD.</h2>
<h2 align="center"> Objective</h2>

<form action="{{ route('objcctives.store') }}" method="POST">
@csrf
<div align="left" class="form-container ">
            Section :
            <input class="" type="text" name="section[]" style="width:430px;" required >
            Period : 
            <input  class="" type="text" name="period[]" style="width:540px;"  required >
       

  <table id="objectiveTable">
    <thead>
      <tr>
        <th rowspan="2" width="4%">No.</th>
        <th rowspan="2" width="15%">Description of Activities</th>
        <th rowspan="2" width="10%">Resp.<br>Person</th>
        <th colspan="3" width="18%">Objectives</th>
        <th rowspan="2" width="10%">Remarks / Corrective Action</th>
        <th rowspan="2" width="3%">[ปุ่มลบ]</th>
      </tr>
      <tr>
        <th width="5%">Previous</th>
        <th width="5%">Plan</th>
        <th width="5%">Results</th>
      </tr>
    </thead>
    <tbody>
      @for($i = 0; $i < 5; $i++)
      <tr>
        <td align="center">{{ $i + 1 }}</td>
        <td><input type="text" name="description[]" placeholder="Description of Activities"></td>
        <td><input type="text" name="resp_person[]"placeholder="Resp Person"></td>
        <td><input type="text" name="previous[]" placeholder="Previous"></td>
        <td><input type="text" name="plan[]" placeholder="Plan"></td>
        <td><input type="text" name="results[]" placeholder="Results"></td>
        <td><input type="text" name="remarks[]" placeholder="Remarks"></td>
        <td>
          <button type="button" class="delete">
            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'>
              <path d='M3 6h18M9 6V4h6v2m2 0v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6h12z'/>
            </svg>
            ลบ
          </button>
        </td>
      </tr>
      @endfor
    </tbody>
  </table>
        <p>&nbsp;</p>
        
         <button type="button"style="float: left;" class="edit" id="addRowBtn" >+ เพิ่มแถว</button>

           <div class="actions" style="margin-top:10px; text-align:right;">
                <button type="submit" class="primary" >บันทึกข้อมูล</button>
            </div>
             </div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    const addRowBtn = document.getElementById('addRowBtn');
    const tableBody = document.querySelector('#objectiveTable tbody'); 

    // ใช้ event delegation สำหรับปุ่ม delete
    tableBody.addEventListener("click", function(e) {
        if (e.target.closest(".delete")) {
            const btn = e.target.closest(".delete");
            const row = btn.closest('tr');
            if (confirm("คุณแน่ใจหรือไม่ว่าต้องการลบแถวนี้?")) {
                row.classList.add('fade-out');
                setTimeout(() => {
                    row.remove();
                    updateRowNumbers();
                }, 300);
            }
        }
    });

    function updateRowNumbers() {
        const rows = tableBody.querySelectorAll('tr');
        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1;
        });
    }

    addRowBtn.addEventListener('click', () => {
        const rowCount = tableBody.rows.length + 1;
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td align="center">${rowCount}</td>
            <td><input type="text" name="description[]" placeholder="Description of Activities"></td>
            <td><input type="text" name="resp_person[]" placeholder="Resp Person"></td>
            <td><input type="text" name="previous[]" placeholder="Previous"></td>
            <td><input type="text" name="plan[]" placeholder="Plan"></td>
            <td><input type="text" name="results[]" placeholder="Results"></td>
            <td><input type="text" name="remarks[]" placeholder="Remarks"></td>
            <td>
                <button type="button" class="delete">
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'>
                      <path d='M3 6h18M9 6V4h6v2m2 0v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6h12z'/>
                    </svg>
                    ลบ
                </button>
            </td>
        `;
        tableBody.appendChild(newRow);
    });
    form.addEventListener("submit", (event) => {
        const rows = tableBody.querySelectorAll("tr");
        let filledRows = 0;

        rows.forEach(row => {
            const activityInput = row.querySelector("input[name='description[]']");
            const personInput = row.querySelector("input[name='resp_person[]']");
            if ((activityInput && activityInput.value.trim() !== "") || 
                (personInput && personInput.value.trim() !== "")) {
                filledRows++;
            }
        });

        if (filledRows < 1) {
            event.preventDefault();
            alert("⚠️ กรุณากรอกข้อมูลก่อนบันทึก!");
            return;
        }

        const confirmSave = confirm("คุณต้องการบันทึกข้อมูลใช่หรือไม่?");
        if (!confirmSave) {
            event.preventDefault(); 
        }
    });
});

</script>
@endsection
