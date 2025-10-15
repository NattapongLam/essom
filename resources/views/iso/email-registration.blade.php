@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<title>email-registration</title>
<style>
.card{
      background: linear-gradient(180deg, var(--card), #fbfdff);
      border-radius:18px;
      padding:20px;
      box-shadow:
        0 6px 18px rgba(6,20,40,0.08),
        0 18px 40px rgba(8,25,60,0.08),
        inset 0 1px 0 rgba(255,255,255,0.6);
      border: 1px solid rgba(15,23,42,0.04);
      position:relative;
      overflow:visible;
   
    }

    .badge{
      position:absolute;
      right:16px;
      top:16px;
      font-size:12px;
      color:var(--muted);
      background: rgba(15,23,42,0.03);
      padding:6px 10px;
      border-radius:999px;
      border:1px solid rgba(15,23,42,0.02);
    }
    .summary{
      margin-top:18px;
      background: linear-gradient(180deg, rgba(14,165,164,0.03), rgba(14,165,164,0.01));
      padding:14px;
      border-radius:12px;
      border:1px solid rgba(14,165,164,0.06);
    }
     button.primary{
      background: linear-gradient(180deg, #258b25ff, #337725ff);
      color:white;
      border:none;
      padding:10px 16px;
      border-radius:10px;
      font-weight:700;
      box-shadow: 0 10px 30px rgba(8,158,157,0.18);
      cursor:pointer;
    }
    button.ghost{
      background:transparent;
      color:var(--muted);
      border:1px solid rgba(15,23,42,0.06);
      padding:10px 14px;
      border-radius:10px;
      cursor:pointer;
    }
input[type="text"], input[type="date"], textarea, select{
      width:100%;
      padding:10px 12px;
      border-radius:10px;
      border:1px solid rgba(15,23,42,0.08);
      background: linear-gradient(180deg, #fff, #fbfcff);
      font-size:14px;
      outline:none;
      transition: box-shadow .16s, border-color .16s, transform .08s;
    }
     input[type="text"]:focus, textarea:focus, select:focus{
      box-shadow: 0 6px 18px rgba(14,165,164,0.08);
      border-color: rgba(14,165,164,0.6);
      transform: translateY(-1px);
    }
    
    textarea{
      min-height:110px;
      resize:vertical;
      padding-top:12px;
    }

    
    .small{
      font-size:13px;
      color:var(--muted);
      margin-top:6px;
    }
     .bold-label {
        font-weight: bold;
    }

    .actions{
      display:flex;
      gap:12px;
      justify-content:flex-end;
      margin-top:18px;}
button.delete {
  background: linear-gradient(180deg, #cb8a8aff, #b91c1c);
  color: white;
  border: none;
  padding: 8px 12px;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}

button.delete:hover {
  background: linear-gradient(180deg, #ef4444, #dc2626);
  transform: scale(1.05);
}

button.delete svg {
  width: 16px;
  height: 16px;
  fill: white;
}

tr.fade-out {
  opacity: 0;
  transition: opacity 0.3s ease;
}

      button.edit{
      background: linear-gradient(180deg, #2ea8c6ff, #80bde5ff);
      color:white;
      border:none;
      padding:10px 16px;
      border-radius:10px;
      font-weight:700;
      box-shadow: 0 10px 30px rgba(8,158,157,0.18);
      cursor:pointer;
    }
    button.primary{
      background: linear-gradient(180deg, #258b25ff, #337725ff);
      color:white;
      border:none;
      padding:10px 16px;
      border-radius:10px;
      font-weight:700;
      box-shadow: 0 10px 30px rgba(8,158,157,0.18);
      cursor:pointer;
    }
    button.ghost{
      background:transparent;
      color:var(--muted);
      border:1px solid rgba(15,23,42,0.06);
      padding:10px 14px;
      border-radius:10px;
      cursor:pointer;
    }

    /* preview of uploaded/attached scan on left */
    .layout{
      display:grid;
      grid-template-columns: 360px 1fr;
      gap:22px;
    }
    .scan{
      border-radius:12px;
      overflow:hidden;
      border:1px solid rgba(15,23,42,0.03);
      background:linear-gradient(180deg,#f8fafb,#fff);
      display:flex;
      align-items:center;
      justify-content:center;
      padding:12px;
      box-shadow: 0 8px 30px rgba(8,20,40,0.06);
    }
    .scan img{
      max-width:100%;
      height:auto;
      display:block;
      border-radius:6px;
      box-shadow: 0 10px 30px rgba(2,6,23,0.06);
      transform: translateY(-4px);
    }
.form-container {
font-family: "Times New Roman", Times, serif;
   margin: 30px;
background: #ffffffff;
padding: 20px 50px;
border-radius: 25px;box-shadow: 10px 10px 10px gray;
width: 1200px;
overflow: hidden;
margin-top: 40px;
}
    .summary{
      margin-top:18px;
      background: linear-gradient(180deg, rgba(14,165,164,0.03), rgba(14,165,164,0.01));
      padding:14px;
      border-radius:12px;
      border:1px solid rgba(14,165,164,0.06);
    }
    .field{
      display:flex;
      gap:10px;
      align-items:flex-start;
      margin-bottom:8px;
    }
    .field b{ min-width:200px; display:inline-block; color:#0f172a; }

    @media (max-width:920px){
      .layout{ grid-template-columns: 1fr; }
      .grid{ grid-template-columns: 1fr; }
      .badge{ position:static; display:inline-block; margin-bottom:12px; }
    }

    .remark {
        margin-top: 15px;
    }

    .remark textarea {
        width: 100%;
        height: 80px;
        border: 1px solid #000;
        padding: 5px;
        resize: none;
    }

   

    .sign-line {
        border-bottom: 1px dotted #000;
        display: inline-block;
        width: 180px;
    }
    
    .small{
      font-size:14px;
      color:var(--muted);
      margin-top:6px;
    }
     .bold-label {
        font-weight: bold;
    }
table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid black;
    margin-top: 15px;
}th, td {
    border: 1px solid black;
    padding: 4px;
    text-align: center;
    vertical-align: middle;
}
th {
    background-color: #789fc8ff;
    font-weight: bold;
}
    .actions{
      display:flex;
      gap:12px;
      justify-content:flex-end;
      margin-top:18px;
    }
    .section-line {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    font-size: 16px;
}
      </style>
      <center>
    <h2 >ทะเบียนผู้ใช้ Email Account</h2>

    <div class="form-container">
        <form id="emailForm" action="{{ route('email-registration.store') }}" method="POST">
            @csrf
           <table id="emailTable" border="1" width="100%" style="border-collapse: collapse;">
                <thead>
                    <tr style="background-color:#789fc8ff; font-weight:bold;">
                        <th>Item</th>
                        <th>Email Account</th>
                        <th>Password</th>
                        <th>User</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Approved By</th>
                        <th>Date</th>
                        <th>Remark</th>
                        <th>[ปุ่มลบ]</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 1; $i <= 10; $i++)
                    <tr>
                        <td><input type="text" name="item[{{ $i }}]"></td>
                        <td><input type="text" name="email_account[{{ $i }}]"></td>
                        <td><input type="text" name="password[{{ $i }}]"></td>
                        <td><input type="text" name="user_name[{{ $i }}]"></td>
                        <td><input type="text" name="position[{{ $i }}]"></td>
                        <td><input type="text" name="department[{{ $i }}]"></td>
                        <td><input type="text" name="approved_by[{{ $i }}]"></td>
                        <td><input type="date" name="date[{{ $i }}]"></td>
                        <td><input type="text" name="remark[{{ $i }}]"></td>
                       <td>
  <button type="button" class="delete" onclick="deleteRow(this)">
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
            <br>
<button type="button"style="float: left;" class="edit" id="addRowBtn" >+ เพิ่มแถว</button>

           <div class="actions" style="margin-top:10px; text-align:right;">
    <button type="button" class="edit" onclick="window.location='{{ route('email-registration.index') }}'">กลับ</button>
                <button type="submit" class="primary">บันทึกข้อมูล</button>
            </div>
        </form>
    

@if(session('success'))
    <script>alert("{{ session('success') }}");</script>
@endif
<script>
document.addEventListener("DOMContentLoaded", function() {
    const tableBody = document.querySelector('#emailTable tbody');
    const addRowBtn = document.getElementById('addRowBtn');
    const form = document.getElementById("emailForm");
    function deleteRow(btn) {
        const row = btn.closest('tr');
        if (confirm("คุณแน่ใจหรือไม่ว่าต้องการลบแถวนี้?")) {
            row.style.transition = 'opacity 0.3s ease';
            row.style.opacity = 0;
            setTimeout(() => row.remove(), 300);
        }
    }

    tableBody.querySelectorAll(".delete").forEach(button => {
        button.addEventListener("click", function() {
            deleteRow(this);
        });
    });

    addRowBtn.addEventListener('click', function() {
        const rowCount = tableBody.rows.length + 1;
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" name="item[${rowCount}]"></td>
            <td><input type="text" name="email_account[${rowCount}]"></td>
            <td><input type="text" name="password[${rowCount}]"></td>
            <td><input type="text" name="user_name[${rowCount}]"></td>
            <td><input type="text" name="position[${rowCount}]"></td>
            <td><input type="text" name="department[${rowCount}]"></td>
            <td><input type="text" name="approved_by[${rowCount}]"></td>
            <td><input type="date" name="date[${rowCount}]"></td>
            <td><input type="text" name="remark[${rowCount}]"></td>
            <td>
                <button type="button" class="delete">ลบ</button>
            </td>
        `;
        newRow.style.opacity = 0;
        tableBody.appendChild(newRow);
        requestAnimationFrame(() => {
            newRow.style.transition = 'opacity 0.3s ease';
            newRow.style.opacity = 1;
        });

        newRow.querySelector(".delete").addEventListener("click", function() {
            deleteRow(this);
        });
    });

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        const rows = tableBody.querySelectorAll("tr");
        let hasData = false;
        for (let row of rows) {
            const inputs = row.querySelectorAll("input[type='text'], input[type='date']");
            for (let input of inputs) {
                if (input.value.trim() !== "") {
                    hasData = true;
                    break;
                }
            }
            if (hasData) break;
        }

        if (!hasData) {
            alert("กรุณากรอกข้อมูลอย่างน้อย 1 ช่องเพื่อบันทึก!");
            return;
        }

  
        if (!confirm("คุณต้องการบันทึกข้อมูล ใช่หรือไม่?")) {
            return;
        }
        const formData = new FormData(form);
        fetch(form.action, { method: form.method, body: formData })
            .then(response => {
 
                if (response.redirected) {
                    window.location.href = response.url;
                    return;
                }
                return response.json().catch(() => { throw new Error("ไม่สามารถอ่านข้อมูล  ได้"); });
            })
            .then(data => {
                if (!data) return;
                if (data.success) {
                    alert(data.message || "บันทึกข้อมูลเรียบร้อยแล้ว!");
                    tableBody.innerHTML = "";
                    form.reset();
                } else {
                    alert(data.message || "เกิดข้อผิดพลาดในการบันทึกข้อมูล");
                }
            })
            .catch(error => {
                console.error(error);
                alert("เกิดข้อผิดพลาดในการบันทึกข้อมูล");
            });
    });
});
</script>
</div>

@endsection