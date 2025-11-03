@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
.form-container { 
    background:#fff; border-radius:18px; padding:30px 40px; box-shadow:0 6px 20px rgba(0,0,0,0.08); 
    border:1px solid #e0e0e0; margin-bottom:25px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
}
h2,h3{text-align:center; font-weight:700;color:#0f172a;margin-bottom:10px;}
h3{font-weight:500;}
label{font-weight:600;color:#1e293b;}
input,textarea{border:1px solid #94a3b8;border-radius:6px;padding:8px 12px;font-size:14px;width:100%;box-sizing:border-box;background-color:#f8fafc;transition:0.2s;}
input:disabled,textarea:disabled{background-color:#e2e8f0;color:#374151;}
textarea{resize:vertical;min-height:120px;}
.row{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:15px 20px;margin-bottom:15px;}
.actions{text-align:center;margin-top:20px;}
button.secondary{background:#6b7280;color:#fff;border:none;padding:10px 22px;border-radius:8px;font-weight:600;cursor:pointer;}
</style>

<div class="form-container">
    <h2>ESSOM CO., LTD.</h2>
    <h3>บันทึกความรู้องค์กร (แสดงผล)</h3>
    <hr style="margin:15px 0;">

    <div class="row">
        <div><label>จัดทำโดย</label><input type="text" value="{{ $record->name }}" disabled></div>
        <div><label>หน่วยงาน</label><input type="text" value="{{ $record->department }}" disabled></div>
        <div><label>ตำแหน่ง</label><input type="text" value="{{ $record->position }}" disabled></div>
        <div><label>วันที่</label><input type="date" value="{{ $record->request_date?->format('Y-m-d') }}" disabled></div>
    </div>

    <div class="row">
        <div><label>เอกสาร KM เลขที่</label><input type="text" value="{{ $record->documentKM_no }}" disabled></div>
        <div><label>เอกสาร NCR / CAR / คำร้องเลขที่</label><input type="text" value="{{ $record->document_no }}" disabled></div>
    </div>

    <div class="row">
        <div><label>ความรู้องค์กรด้าน</label><input type="text" value="{{ $record->OZN }}" disabled></div>
        <div><label>เรื่อง</label><input type="text" value="{{ $record->subject }}" disabled></div>
    </div>

    <div>
        <label>รายละเอียดขององค์ความรู้</label>
        <textarea disabled>{{ $record->details }}</textarea>
    </div>

    <div class="row">
        <div>
            <label>เอกสารแนบ</label>
            @if($record->attached_file)
                <p><a href="{{ asset('storage/'.$record->attached_file) }}" target="_blank">เปิดไฟล์</a></p>
            @else
                <p>-</p>
            @endif
        </div>
    </div>

    <div class="row">
        <div>
            <label>การประเมินหัวข้อความรู้นี้โดยหัวหน้างาน</label>
            <ul>
                @foreach(json_decode($record->approval ?? '[]') as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
        <div><label>กำหนดวันส่งต่อ-ถ่ายทอดความรู้</label><input type="date" value="{{ $record->transfer_date?->format('Y-m-d') }}" disabled></div>
        <div><label>อนุมัติโดย</label><input type="text" value="{{ $record->NameCF }}" disabled></div>
        <div><label>วันที่ส่งต่อ</label><input type="date" value="{{ $record->approval_date?->format('Y-m-d') }}" disabled></div>
    </div>

    <div class="actions">
        <a href="{{ route('knowledge-record.index') }}" class="btn secondary">กลับไปหน้ารายการ</a>
    </div>
</div>
@endsection
