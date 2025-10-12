@extends('layouts.main')
@section('content')
<div class="wrap">
<h2 align="center">รายการ Email Account</h2>

@if(session('success'))
<p style="color: green; text-align:center;">{{ session('success') }}</p>
@endif

@if(session('error'))
<p style="color: red; text-align:center;">{{ session('error') }}</p>
@endif
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
  padding: 10px 16px;
  border-radius: 8px;
  font-weight: 400;
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
      font-weight:400;
      box-shadow: 0 10px 30px rgba(8,158,157,0.18);
      cursor:pointer;
    }
    button.primary{
      background: linear-gradient(180deg, #258b25ff, #337725ff);
      color:white;
      border:none;
      padding:10px 16px;
      border-radius:10px;
      font-weight:600;
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
width: 1180px;
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
       <div class="form-container">
<table border="1" width="100%" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Email Account</th>
              <th>Password</th>
            <th>User</th>
            <th>Position</th>
            <th>Department</th>
            <th>Approved By</th>
            <th>Date</th>
            <th>Remark</th>
            <th style="width: 180px; text-align: center;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->email_id }}</td>
            <td>{{ $record->Item }}</td>
            <td>{{ $record->email_account }}</td>
             <td>{{ $record->password }}</td>
            <td>{{ $record->user_name }}</td>
            <td>{{ $record->position }}</td>
            <td>{{ $record->department }}</td>
            <td>{{ $record->approved_by }}</td>
            <td>{{ $record->date }}</td>
            <td>{{ $record->remark }}</td>
            <td>
         <div class="actions">
    <a href="{{ route('email-registration.edit', $record->email_id) }}">
        <button class="edit">แก้ไข</button>
    </a>
    <form action="{{ route('email-registration.destroy', $record->email_id) }}" 
          method="POST" 
          style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('ลบข้อมูลใช่หรือไม่?')" class="delete">
            ลบ
        </button>
           </div> 
        </tr>
        @endforeach
      </div>
 </form>  

<div class="actions">
    <a href="{{ route('email-registration.create') }}">
        <button class="primary">เพิ่ม EmailAccount ใหม่</button>
    </a>
       </tbody>
</table>
    </div>
</div>
</center>
@endsection
