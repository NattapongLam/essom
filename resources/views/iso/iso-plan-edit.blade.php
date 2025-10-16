@extends('layouts.main')
@section('content')
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
<form method="POST" action="{{ route('iso-plan.update', $plan->id) }}">
    @csrf
    @method('PUT')
         <h2 align="center">ESSOM CO.,LTD.</h2>
    <h2 align="center">Edit PLAN</h2>
    <div class="form-container">
        
        <div class="field">
            <b>Project:</b>
            <input type="text" name="project_name" value="{{ old('project_name', $plan->project_name) }}">
        </div>

        <div class="field">
            <b>Responsible Section:</b>
            <input type="text" name="responsible_section" value="{{ old('responsible_section', $plan->responsible_section) }}">
        </div>

        <div class="field">
            <b>Description of Activities:</b>
           <input type="text" name="description_of_activities" value="{{ old('description_of_activities', $activity['description'] ?? '') }}">
</div>
        <div class="field">
            <b>Responsible Person:</b>
            <input type="text" name="responsible_person" value="{{ old('responsible_person', $activity['responsible_person'] ?? '') }}">
</div>
        <div class="field">
            <b>Start Date:</b>
            <input type="date" name="date_start" value="{{ old('date_start', $activity['date_start'] ?? '') }}">
        </div>

        <div class="field">
            <b>End Date:</b>
           <input type="date" name="date_end" value="{{ old('date_end', $activity['date_end'] ?? '') }}">
        </div>

        <div class="field">
            <b>Status:</b>
          <input type="text" name="status" value="{{ old('status', $activity['status'] ?? '') }}">
</div>
        <div class="field">
            <b>Remarks:</b>
           <textarea name="remarks">{{ old('remarks', $activity['remark'] ?? '') }}</textarea>
        </div>
        <div class="actions">
      <a href="{{ route('iso-plan.index') }}" ><button  class="edit">กลับ</button> </a>
  <button type="submit" class="primary" onclick="return confirm('ต้องการอัปเดตข้อมูลใช่หรือไม่?')">อัปเดตข้อมูล</button>
  </div>

    </div>
    
</form>

@endsection