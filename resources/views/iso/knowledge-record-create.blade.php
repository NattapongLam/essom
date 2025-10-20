@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success') || session('error'))
<script>
Swal.fire({
    icon: "{{ session('success') ? 'success' : 'error' }}",
    title: "{{ session('success') ? 'สำเร็จ!' : 'เกิดข้อผิดพลาด!' }}",
    text: "{{ session('success') ?? session('error') }}",
    confirmButtonColor: "{{ session('success') ? '#1e40af' : '#dc2626' }}"
});
</script>
@endif

<style>
    @media (max-width: 768px) {
    .row {
        grid-template-columns: 1fr; 
        gap: 12px 0;
    }
    .checkbox-group {
        flex-direction: column; 
    }
}
.card, .form-container {
    background: #ffffff;
    border-radius: 18px;
    padding: 30px 40px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    margin-bottom: 25px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h2, h3 {
    text-align: center;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 10px;
}
h3 { font-weight: 500; }

label { font-weight: 600; color: #1e293b; }

input, textarea, select {
    border: 1px solid #94a3b8;
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 14px;
    width: 100%;
    box-sizing: border-box;
    background-color: #f8fafc;
    transition: 0.2s;
}
input:focus, textarea:focus {
    border-color: #1e40af;
    box-shadow: 0 0 6px rgba(59,130,246,0.3);
    background-color: #ffffff;
    outline: none;
}
textarea { resize: vertical; min-height: 120px; }

.row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px 20px;
    align-items: flex-start;
    margin-bottom: 15px;
}

button.primary {
    background: linear-gradient(180deg, #1e3a8a, #3b82f6);
    color: white;
    border: none;
    padding: 10px 22px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}
button.primary:hover { transform: scale(1.05); }

.actions { display:flex; gap:12px; justify-content:flex-end; margin-top:20px; }

.checkbox-group {
    display:flex;
    gap:15px;
    flex-wrap: wrap;
}
.checkbox label { font-weight: normal; }
.checkbox input[type="checkbox"] { transform: scale(1.2); margin-right:6px; }
</style>

<div class="form-container">
    <form action="{{ isset($record) ? route('knowledge-record.update', $record->id) : route('knowledge-record.store') }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @if(isset($record)) @method('PUT') @endif

        <h2>ESSOM CO., LTD.</h2>
        <h3>บันทึกความรู้องค์กร</h3>
        <hr style="margin: 15px 0;">

        <div class="row">
            <div>
                <label>จัดทำโดย</label>
                <input type="text" name="name" value="{{ old('name', $record->name ?? '') }}" placeholder="ชื่อผู้จัดทำ" required>
            </div>
            <div>
                <label>หน่วยงาน</label>
                <input type="text" name="department" value="{{ old('department', $record->department ?? '') }}" placeholder="หน่วยงาน" required>
            </div>
            <div>
                <label>ตำแหน่ง</label>
                <input type="text" name="position" value="{{ old('position', $record->position ?? '') }}" placeholder="ตำแหน่ง" required>
            </div>
            <div>
                <label>วันที่</label>
                <input type="date" name="request_date" value="{{ old('request_date', $record->request_date ?? '') }}">
            </div>
        </div>

        <div class="row">
            <div>
                <label>เอกสาร KM เลขที่</label>
                <input type="text" name="documentKM_no" value="{{ old('documentKM_no', $record->documentKM_no ?? '') }}" placeholder="เลขที่เอกสาร KM" required>
            </div>
            <div>
                <label>เอกสาร NCR / CAR / คำร้องเรียนเลขที่</label>
                <input type="text" name="document_no" value="{{ old('document_no', $record->document_no ?? '') }}" placeholder="เลขที่เอกสาร NCR/CAR" required>
            </div>
        </div>

        <div class="row">
            <div>
                <label>1.1) ความรู้องค์กรด้าน</label>
                <input type="text" name="OZN" value="{{ old('OZN', $record->OZN ?? '') }}" placeholder="ด้านความรู้องค์กร" required>
            </div>
            <div>
                <label>1.2) เรื่อง</label>
                <input type="text" name="subject" value="{{ old('subject', $record->subject ?? '') }}" placeholder="เรื่อง" required>
            </div>
        </div>

        <div>
            <label>1.3) รายละเอียดขององค์ความรู้</label>
            <textarea name="details" placeholder="รายละเอียด">{{ old('details', $record->details ?? '') }}</textarea>
        </div>

        <div class="row">
            <div>
                <label>เอกสารแนบ</label>
                <input type="file" name="attached_file" accept=".pdf,.doc,.docx,.jpg,.png">
                @if(isset($record) && $record->attached_file)
                    <p><a href="{{ asset('storage/'.$record->attached_file) }}" target="_blank">เปิดไฟล์</a></p>
                @endif
            </div>
        </div>

        <div class="checkbox">
<label for="" style="display:block; border-bottom: 1px solid #000; padding-bottom: 4px; margin-bottom: 10px;">
 หมายเหตุ: เอกสารแนบของบันทึกความรู้องค์กรที่มาจากก NCR/CAR/คำร้องให้ไปดูที่แฟ้ม NCR/CAR/คำร้องนั้นๆ
</label>

<div style="display: flex; align-items: center; gap: 10px;">
    <label>การประเมินหัวข้อความรู้นี้โดยหัวหน้างาน</label>
    @php 
        $approvalValues = json_decode($record->approval ?? '[]', true); 
    @endphp
    <div class="checkbox-group" style="display: flex; gap: 10px;">
    @foreach(['อนุมัติ', 'ไม่อนุมัติ', 'รอพิจารณา', 'เก็บไว้พิจารณา'] as $value)
        <label style="display: flex; align-items: center; gap: 4px;">
            <input type="checkbox" name="approval[]" value="{{ $value }}" {{ in_array($value, $approvalValues ?? []) ? 'checked' : '' }}>
            {{ $value }}
        </label>
    @endforeach
</div>
</div>

        </div>
        <div class="row">
            <div>
                <label>กำหนดวันส่งต่อ-ถ่ายทอดความรู้</label>
                <input type="date" name="transfer_date" value="{{ old('transfer_date', $record->transfer_date ?? '') }}">
            </div>
            <div>
                <label>อนุมัติโดย</label>
                <input type="text" name="NameCF" value="{{ old('NameCF', $record->NameCF ?? '') }}" placeholder="ชื่อผู้อนุมัติ">
            </div>
            <div>
                <label>วันที่ส่งต่อ</label>
                <input type="date" name="approval_date" value="{{ old('approval_date', $record->approval_date ?? '') }}">
            </div>
        </div>

        <div class="actions">
            <button type="submit" class="primary">
                {{ isset($record) ? 'อัปเดตข้อมูล' : 'บันทึกข้อมูล' }}
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'ยืนยันการบันทึกข้อมูล?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1e3a8a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); 
            }
        });
    });
});
</script>
@endsection
