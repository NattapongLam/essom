@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'สำเร็จ!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#258b25'
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
  display: flex;        
  justify-content: center; 
  gap: 10px;               
  margin-top: 20px;         
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

<h2 align="center">ESSOM CO., LTD.</h2>
<h3 align="center">แก้ไขใบบันทึกความรู้องค์กร</h3>

<form action="{{ route('knowledge-record.update', $record->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-container">
        <label>ชื่อ:</label>
        <input type="text" name="name" value="{{ old('name', $record->name) }}">

        <label>หน่วยงาน:</label>
        <input type="text" name="department" value="{{ old('department', $record->department) }}">

        <label>ตำแหน่ง:</label>
        <input type="text" name="position" value="{{ old('position', $record->position) }}">

        <label>วันที่:</label>
        <input type="date" name="request_date" value="{{ old('request_date', $record->request_date ?? '') }}">

        <label>เอกสาร KM เลขที่:</label>
        <input type="text" name="documentKM_no" value="{{ old('documentKM_no', $record->documentKM_no) }}">

        <label>ความรู้องค์กรด้าน:</label>
        <input type="text" name="OZN" value="{{ old('OZN', $record->OZN) }}">

        <label>เอกสาร NCR/CAR/คำร้องเรียน เลขที่:</label>
        <input type="text" name="document_no" value="{{ old('document_no', $record->document_no) }}">

        <label>เรื่อง:</label>
        <input type="text" name="subject" value="{{ old('subject', $record->subject) }}">

        <label>รายละเอียด:</label>
        <textarea name="details">{{ old('details', $record->details) }}</textarea>

        <label>ไฟล์แนบ:</label>
        <input type="file" name="attached_file">

        @php
            $approvalValues = json_decode($record->approval ?? '[]', true);
        @endphp
        <div style="display: flex; gap: 10px; margin-top: 10px;">
            @foreach(['อนุมัติ','ไม่อนุมัติ','รอพิจารณา','เก็บไว้พิจารณา'] as $value)
                <label style="display:flex; flex-direction:column; align-items:center;">
                    <input type="checkbox" name="approval[]" value="{{ $value }}" 
                    {{ in_array($value, $approvalValues) ? 'checked' : '' }}>
                    {{ $value }}
                </label>
            @endforeach
        </div>

        <button type="submit" class="primary" style="margin-top: 15px;">บันทึก</button>
    </div>
</form>
@endsection
