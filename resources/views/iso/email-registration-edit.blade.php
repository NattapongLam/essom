@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
.form-container {
  font-family: "Segoe UI", "Prompt", sans-serif;
  background: linear-gradient(180deg, #e6e6e6ff, #ffffff);
  border-radius: 22px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15),
              inset 0 1px 0 rgba(255,255,255,0.4);
  width: 850px;
  margin: 60px auto;
  padding: 35px 50px;
  position: relative;
  overflow: hidden;
}


table {
 
  width: 70%;
  border-collapse: collapse;
  border: 1px solid #d0d8e2;
  box-shadow: 0 5px 15px rgba(0,0,0,0.05);
  border-radius: 10px;
  overflow: hidden;
}

th {
  background-color: #4c87e5;
  color: #fff;
  font-weight: 600;
  font-size: 14px;
  padding: 10px;
}

td {
  background-color: #f9fbff;
  padding: 6px 10px;
  border: 1px solid #e0e6ef;
}

input[type="text"], input[type="date"], textarea, select {
  width: 50%;
  padding: 6px 10px;
  border-radius: 8px;
  border: 1px solid rgba(15,23,42,0.12);
  background: #fff;
  font-size: 13px;
  outline: none;
  transition: 0.2s;
}

input[type="text"]:focus, textarea:focus, select:focus {
  border-color: #4c87e5;
  box-shadow: 0 0 8px rgba(76,135,229,0.3);
  transform: translateY(-1px);
}


.actions {
  display: flex;
  justify-content: flex-end;
  margin-top: 20px;
}
button.edit{
      background: linear-gradient(180deg, #2ea8c6ff, #80bde5ff);
      color:white;
 border: none;
  padding: 8px 18px;
  border-radius: 10px;
  font-weight: 600;
  box-shadow: 0 6px 18px rgba(10, 112, 130, 0.3);
  transition: 0.2s;
    }
button.edit:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(60,180,75,0.4);
  background: linear-gradient(180deg, #57b957, #3da23d);
}
button.primary {
  background: linear-gradient(180deg, #4cae4c, #3d8b3d);
  color: #fff;
  border: none;
  padding: 8px 18px;
  border-radius: 10px;
  font-weight: 600;
  box-shadow: 0 6px 18px rgba(60,180,75,0.3);
  transition: 0.2s;
}

button.primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(60,180,75,0.4);
  background: linear-gradient(180deg, #57b957, #3da23d);
}

@media (max-width: 768px) {
  .form-container {
    width: 95%;
    padding: 20px;
  }
  input[type="text"], input[type="date"] {
    width: 100%;
  }
}
      </style>

<form action="{{ route('email-registration.update', $record->email_id) }}" method="POST">
  @csrf
  @method('PUT')
  <center>
    <div class="form-container">
  <table>
      <h2 align="center">ทะเบียน Email Account</h2>
       <tr><th>item</th><td><input type="text" name="item" value="{{ $record->item}}"></td></tr>
      <tr><th>Email Account</th><td><input type="text" name="email_account" value="{{ $record->email_account }}"></td></tr>
      <tr><th>Password</th><td><input type="text" name="password" value="{{ $record->password }}"></td></tr>
      <tr><th>User</th><td><input type="text" name="user_name" value="{{ $record->user_name }}"></td></tr>
      <tr><th>Position</th><td><input type="text" name="position" value="{{ $record->position }}"></td></tr>
      <tr><th>Department</th><td><input type="text" name="department" value="{{ $record->department }}"></td></tr>
      <tr><th>Approved by</th><td><input type="text" name="approved_by" value="{{ $record->approved_by }}"></td></tr>
      <tr><th>Date</th><td><input type="date" name="date" value="{{ $record->date }}"></td></tr>
      <tr><th>Remark</th><td><input type="text" name="remark" value="{{ $record->remark }}"></td></tr>
  </table>
  <div class="actions">
      <a href="{{ route('email-registration.index') }}" ><button  class="edit">กลับ</button> </a>
  <button type="submit" class="primary" onclick="return confirm('ต้องการอัปเดตข้อมูลใช่หรือไม่?')">อัปเดตข้อมูล</button>
  </div>
    </div>

</form>
</center>
@endsection