@extends('layouts.main')
@section('content')
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

input {
  width: 100%;
  border: 1px solid #ccc; /* เพิ่มเส้นกรอบ */
  border-radius: 4px; /* มุมโค้ง */
  outline: none;
  background: transparent;
  text-align: center;
  font-size: 14px;
  padding: 6px;
  box-sizing: border-box;
}

input:focus {
  background-color: #f8faff;
  border-bottom: 2px solid #3b82f6; /* blue line when active */
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
       button.edit{
      background: linear-gradient(180deg, #2ea8c6ff, #80bde5ff);
      color:white;
      border:none;
      padding:10px 16px;
      border-radius:10px;
      font-weight:400;
      box-shadow: 0 10px 30px rgba(8,158,157,0.18);
      cursor:pointer; }
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
      <h2 align="center">ESSOM CO.,LTD.</h2>
<h2 align="center"> Objectives</h2>
 <div class="form-container">
<table id="activityTable" width="100%" border="1" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th width="4%" rowspan="2" align="center">No.</th>
            <th width="10%" rowspan="2" align="center">Section</th>
            <th width="15%" rowspan="2" align="center">For period.</th>
            <th width="%" rowspan="2" align="center">Description</th>
            <th width="10%" rowspan="2" align="center">Resp.<br>Person</th>
            <th colspan="3" align="center">Objectives</th>
            <th width="15%" rowspan="2" align="center">Remarks/Corrective action</th>
            <th width="10%" rowspan="2" align="center">[ปุ่มลบ/แก้ไข]</th>
        </tr>
        <tr>
            <th width="9%" align="center">Previous</th>
            <th width="9%" align="center">Plan</th>
            <th width="9%" align="center">Results</th>
        </tr>
    </thead>
    <tbody>
        @foreach($objectives as $objcctive)
        <tr>
            <td>{{ $objcctive->no }}</td>
            <td>{{ $objcctive->section }}</td>
            <td>{{ $objcctive->period }}</td>
            <td>{{ $objcctive->description }}</td>
            <td>{{ $objcctive->resp_person }}</td>
            <td>{{ $objcctive->previous }}</td>
            <td>{{ $objcctive->plan }}</td>
            <td>{{ $objcctive->results }}</td>
            <td>{{ $objcctive->remarks }}</td>
           <td>
   <div class="actions"> 
        <a href="{{ route('objcctives.edit', $objcctive->id) }}">
            <button type="button" class="edit">แก้ไข</button>
        </a>
        <form action="{{ route('objcctives.destroy', $objcctive->id) }}" method="POST" style="display:inline;" >
            @csrf
            @method('DELETE')
            <button type="submit" class="delete" onclick="return confirm('แน่ใจว่าจะลบ?')">ลบ</button>
        </form>
    </div>
</td>
        @endforeach
    </tbody>
</table>

<div class="actions">
    <a href="{{ route('objcctives.create') }}">
        <button class="primary">+Objectives</button>
    </a>
</div>
</div>
@endsection