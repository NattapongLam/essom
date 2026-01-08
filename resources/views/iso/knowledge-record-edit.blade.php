@extends('layouts.main')
@section('content')

@if(session('success'))
    <div style="background-color:#d1fae5;padding:10px;margin-bottom:15px;border-radius:6px;color:#065f46;">
        {{ session('success') }}
    </div>
@endif

<h2 align="center">ESSOM CO., LTD.</h2>
<h3 align="center">{{ isset($record) ? 'แก้ไข' : 'สร้าง' }} ใบบันทึกความรู้องค์กร</h3>
<p class="text-right mb-0">F7160.2<br>7 Nov 23</p>

<form action="{{ isset($record) ? route('knowledge-record.update', $record->id) : route('knowledge-record.store') }}" 
      method="POST" enctype="multipart/form-data" style="width:600px;margin:20px auto;">
    @csrf
    @if(isset($record)) @method('PUT') @endif
    <div style="margin-bottom:10px;">
        <label>ชื่อผู้จัดทำ:</label>
        <input type="text" name="name" value="{{ old('name', $record->name ?? '') }}" required style="width:100%;">
    </div>

    <div style="margin-bottom:10px;">
        <label>หน่วยงาน:</label>
        <input type="text" name="department" value="{{ old('department', $record->department ?? '') }}" required style="width:100%;">
    </div>

    <div style="margin-bottom:10px;">
        <label>ตำแหน่ง:</label>
        <input type="text" name="position" value="{{ old('position', $record->position ?? '') }}" required style="width:100%;">
    </div>

    <div style="margin-bottom:10px;">
        <label>วันที่:</label>
        <input type="date" name="request_date" value="{{ old('request_date', isset($record->request_date) ? $record->request_date->format('Y-m-d') : '') }}" required style="width:100%;">
    </div>

    <div style="margin-bottom:10px;">
        <label>เอกสาร KM เลขที่:</label>
        <input type="text" name="documentKM_no" value="{{ old('documentKM_no', $record->documentKM_no ?? '') }}" required style="width:100%;">
    </div>

    <div style="margin-bottom:10px;">
        <label>เอกสาร NCR/CAR/คำร้องเลขที่:</label>
        <input type="text" name="document_no" value="{{ old('document_no', $record->document_no ?? '') }}" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <label>ความรู้องค์กรด้าน:</label>
        <input type="text" name="OZN" value="{{ old('OZN', $record->OZN ?? '') }}" style="width:100%;">
    </div>

    <div style="margin-bottom:10px;">
        <label>เรื่อง:</label>
        <input type="text" name="subject" value="{{ old('subject', $record->subject ?? '') }}" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <label>รายละเอียด:</label>
        <textarea name="details" style="width:100%;height:100px;">{{ old('details', $record->details ?? '') }}</textarea>
    </div>

    <div style="margin-bottom:10px;">
        <label>ไฟล์แนบ:</label>
        <input type="file" name="attached_file">
        @if(isset($record) && $record->attached_file)
            <p><a href="{{ asset('storage/'.$record->attached_file) }}" target="_blank">เปิดไฟล์</a></p>
        @endif
    </div>
    @php
        $approvalValues = isset($record) ? json_decode($record->approval ?? '[]', true) : old('approval', []);
    @endphp
    <div style="margin-bottom:10px;">
        <label>การอนุมัติ:</label><br>
        @foreach(['อนุมัติ','ไม่อนุมัติ','รอพิจารณา','เก็บไว้พิจารณา'] as $value)
            <label style="margin-right:10px;">
                <input type="checkbox" name="approval[]" value="{{ $value }}" 
                {{ in_array($value, $approvalValues) ? 'checked' : '' }}>
                {{ $value }}
            </label>
        @endforeach
    </div>

    <div style="margin-bottom:10px;">
        <label>กำหนดวันส่งต่อ-ถ่ายทอดความรู้:</label>
        <input type="date" name="transfer_date" value="{{ old('transfer_date', isset($record->transfer_date) ? $record->transfer_date->format('Y-m-d') : '') }}">
    </div>

    @if(isset($record))
    <div style="margin-bottom:10px;">
        <label>อนุมัติโดย:</label>
        <input type="text" name="NameCF" value="{{ old('NameCF', $record->NameCF ?? '') }}" placeholder="ชื่อผู้อนุมัติ"  readonly>
    </div>

    <div style="margin-bottom:10px;">
        <label>วันที่ส่งต่อ:</label>
        <input type="date" name="approval_date" value="{{ old('approval_date', isset($record->approval_date) ? $record->approval_date->format('Y-m-d') : '') }}" readonly>
    </div>
    @endif

    <div style="text-align:center;">
        <button type="submit" style="padding:8px 16px;background-color:#258b25;color:#fff;border:none;border-radius:6px;">
            {{ isset($record) ? 'อัปเดตข้อมูล' : 'บันทึกข้อมูล' }}
        </button>
    </div>
</form>

@endsection
