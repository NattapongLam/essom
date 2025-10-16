@extends('layouts.main')

@section('content')

@if(session('success'))
    <p style="color: green; text-align:center;">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p style="color: red; text-align:center;">{{ session('error') }}</p>
@endif
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
.field {
    display:flex;
    gap:10px;
    align-items:flex-start;
    margin-bottom:12px;
}
.field b{ min-width:200px; display:inline-block; color:#0f172a; }
input[type="text"], input[type="date"], textarea {
  width: 50%;
  padding: 6px 10px;
  border-radius: 8px;
  border: 1px solid rgba(15,23,42,0.12);
  background: #fff;
  font-size: 13px;
  outline: none;
}
input[type="text"]:focus, textarea:focus, input[type="date"]:focus {
  border-color: #4c87e5;
  box-shadow: 0 0 8px rgba(76,135,229,0.3);
}
.actions {
  display: flex;            /* ใช้ flex layout */
  justify-content: center;  /* จัดกึ่งกลางแนวนอน */
  gap: 10px;                /* ระยะห่างระหว่างปุ่ม */
  margin-top: 20px;         /* ระยะด้านบน */
}

button.primary {
  background: linear-gradient(180deg, #258b25ff, #337725ff);
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 10px;
  font-weight: 700;
  box-shadow: 0 10px 30px rgba(8, 158, 157, 0.18);
  cursor: pointer;
  text-align: center;
}

button.edit {
  background: linear-gradient(180deg, #076a83ff, #80bde5ff);
  color: white;
  border: none;
  padding: 8px 18px;
  border-radius: 10px;
  font-weight: 700;
  box-shadow: 0 6px 18px rgba(140, 224, 238, 0.3);
  transition: 0.2s;
  cursor: pointer;
  text-align: center;
}

button.primary:hover,
button.edit:hover {
  opacity: 0.9;
  transform: translateY(-2px);
  transition: 0.2s;
};

</style>
<h2 align="center">ESSOM CO.,LTD.</h2>
<h2 align="center">Edit Objective</h2>
<form action="{{ route('objcctives.update', $objcctive) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-container">
        <div class="field">
    <b>No.:</b>
    <input type="text" name="no" value="{{ old('no', $objcctive->no) }}">
</div>

<div class="field">
    <b>Section:</b>
    <input type="text" name="section" value="{{ old('section', $objcctive->section) }}">
</div>

<div class="field">
    <b>Period:</b>
    <input type="text" name="period" value="{{ old('period', $objcctive->period) }}">
</div>

<div class="field">
    <b>Description:</b>
    <input type="text" name="description" value="{{ old('description', $objcctive->description) }}">
</div>

<div class="field">
    <b>Responsible Person:</b>
    <input type="text" name="resp_person" value="{{ old('resp_person', $objcctive->resp_person) }}">
</div>

<div class="field">
    <b>Previous:</b>
    <input type="text" name="previous" value="{{ old('previous', $objcctive->previous) }}">
</div>

<div class="field">
    <b>Plan:</b>
    <input type="text" name="plan" value="{{ old('plan', $objcctive->plan) }}">
</div>

<div class="field">
    <b>Results:</b>
    <input type="text" name="results" value="{{ old('results', $objcctive->results) }}">
</div>

<div class="field">
    <b>Remarks:</b>
    <textarea name="remarks">{{ old('remarks', $objcctive->remarks) }}</textarea>
</div>

        <div class="actions">
            <a href="{{ route('objcctives.index') }}" ><button class="edit">กลับ</button></a>
            <button type="submit" class="primary" onclick="return confirm('ต้องการอัปเดตข้อมูลใช่หรือไม่?')">อัปเดตข้อมูล</button>
        </div>
    </div>
</form>

@endsection
