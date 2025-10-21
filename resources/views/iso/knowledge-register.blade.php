@extends('layouts.main')
@section('content')

@if(session('success'))
<script>alert("{{ session('success') }}");</script>
@endif

<style>
:root{ --bg:#f2f5f8; --card:#ffffff; --muted:#6b7280; --accent:#0ea5a4; }
*{box-sizing:border-box;}
body{
    font-family:"Times New Roman", Times, serif;
    margin:30px;
    background:radial-gradient(1200px 400px at -10% 10%, rgba(14,165,164,0.06), transparent 10%),
    linear-gradient(180deg, var(--bg), #eef3f7 60%);
}
h2{text-align:center;}
.main_table{
    width:100%;
    max-width:1200px;
    margin:auto;
    border-collapse:collapse;
    box-shadow:2px 2px 10px gray;
    border-radius:15px;
    overflow:hidden;
}
.main_table th, .main_table td{
    border:1px solid black;
    padding:6px;
    text-align:center;
}
.main_table th{
    background-color:#e9ecef;
    font-weight:bold;
}
.form-container{
    background:#fff;
    padding:20px 30px;
    border-radius:15px;
    box-shadow:2px 2px 10px gray;
    margin-top:20px;
}
.actions{
    display:flex;
    gap:10px;
    justify-content:flex-end;
    margin-top:15px;
}
button.edit{background:#2196F3;color:#fff;border:none;padding:5px 10px;border-radius:5px;cursor:pointer;}
button.delete{background:#E74C3C;color:#fff;border:none;padding:5px 10px;border-radius:5px;cursor:pointer;}
button.primary{background:#4CAF50;color:#fff;border:none;padding:10px 15px;border-radius:5px;cursor:pointer;}
</style>

<div class="form-container">
    <h2>ESSOM CO.,LTD.</h2>
    <h2>บริษัท เอสซอม จำกัด</h2>
    <h2>ทะเบียนความรู้องค์กร (Organization Registration)</h2>

    <table class="main_table">
        <thead>
            <tr>
                <th>NO</th>
                <th>Project</th>
                <th>Responsible Section / Person</th>
                <th>รหัสเอกสาร</th>
                <th>วันที่รับเอกสาร</th>
                <th>ชื่อเรื่ององค์กรความรู้</th>
            </tr>
        </thead>
        <tbody>
            @forelse($records as $index => $record)
                @foreach($record->documents as $doc)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $doc->document_code }}</td>
                    <td>{{ $doc->received_date }}</td>
                    <td>{{ $doc->doc_title }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('knowledge-register.edit', $record->id) }}">
                                <button class="edit">แก้ไข</button>
                            </a>
                            <form action="{{ route('knowledge-register.destroy', $record->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete" onclick="return confirm('แน่ใจว่าจะลบ?')">ลบ</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            @empty
                <tr><td colspan="7">ไม่มีข้อมูล</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="actions">
        <a href="{{ route('knowledge-register.create') }}">
            <button class="primary">+ เพิ่มข้อมูล</button>
        </a>
    </div>
</div>
@endsection
