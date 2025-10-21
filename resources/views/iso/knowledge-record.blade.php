@extends('layouts.main')
@section('content')
@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 30px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .input_style {
            width: 92%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        .input_style2 {
            width: 30%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        .input_style3 {
            width: 85%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        .input_style4 {
            width: 70%;
            padding: 8px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .main_tabel {
            width: 1200px;
            margin: auto;
        }

        .table_style {
            box-shadow: 2px 2px 10px gray;
            border: 35px solid white;
            border-radius: 25px;
        }
    </style>
      <h2 align="center">ESSOM CO.,LTD.</h2>
<a href="{{ route('knowledge-record.create') }}" >
<table id="activityTable" width="20%" border="1" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th width="2%" rowspan="2" align="center">NO</th>
            <th width="2%" rowspan="2" align="center">จัดทำโดย</th>
            <th width="2%" rowspan="2" align="center">หน่วยงาน</th>
            <th width="4%" rowspan="2" align="center">ตำแหน่ง</th>
            <th width="4%" rowspan="2" align="center">วันที่</th>
            <th width="4%" rowspan="2" align="center">เอกสารKMเลขที่</th>
            <th width="4%" rowspan="2" align="center">ความรู้องค์กรด้าน</th>
            <th width="3%" rowspan="2" align="center">เอกสารNCR/CAR/คำร้องเรียน เลขที่</th>
            <th width="2%" rowspan="2" align="center">เรื่อง</th>
            <th width="2%" rowspan="2" align="center">รายละเอียดความรู้</th>
            <th width="2%" rowspan="2" align="center">เอกสารแนบ</th>
            <th width="6%" colspan="4" align="center">การประเมินหัวข้อความรู้นี้โดยหัวหน้างาน</th>
            <th width="2%" colspan="3" align="center">กำหนดวันส่งต่อ-ถ่ายทอดความรู้</th>
            <th width="2%" rowspan="2" align="center">[ปุ่มลบ/แก้ไข]</th>
        </tr>
        <tr>
            <td align="center">อนุมัติ</td>
            <td align="center">ไม่อนุมัติ</td>
            <td align="center">รอพิจารณา</td>
            <td align="center">เก็บไว้พิจารณา</td>
            <td align="center">วันที่</td>
            <td align="center">อนุมัติโดย</td>
            <td align="center">วันที่</td>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->department }}</td>
            <td>{{ $record->position }}</td>
            <td>{{ $record->request_date }}</td>
            <td>{{ $record->documentKM_no }}</td>
            <td>{{ $record->OZN }}</td>
            <td>{{ $record->document_no }}</td>
            <td>{{ $record->subject }}</td>
            <td>{{ $record->details }}</td>
            <td>
                @if($record->attached_file)
                    <a href="{{ asset('storage/'.$record->attached_file) }}" target="_blank">ดูไฟล์</a>
                @else
                    -
                @endif
            </td>
            <td colspan="4">
                @php
                    $approvalValues = json_decode($record->approval ?? '[]', true);
                @endphp
                <div style="display: flex; justify-content: space-around;">
                    @foreach(['อนุมัติ', 'ไม่อนุมัติ', 'รอพิจารณา', 'เก็บไว้พิจารณา'] as $value)
                        <label style="display:flex; flex-direction:column; align-items:center; font-size:13px;">
                            <input type="checkbox" disabled {{ in_array($value, $approvalValues ?? []) ? 'checked' : '' }}>
                            {{ $value }}
                        </label>
                    @endforeach
                </div>
            </td>

            <td>{{ $record->transfer_date ?? '-' }}</td>
            <td>{{ $record->NameCF ?? '-' }}</td>
            <td>{{ $record->approval_date ?? '-' }}</td>

            <td>
                <div class="actions">
                    <a href="{{ route('knowledge-record.edit', $record->id) }}">
                        <button type="button" class="edit">แก้ไข</button>
                    </a>
                    <form action="{{ route('knowledge-record.destroy', $record->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete" onclick="return confirm('แน่ใจว่าจะลบ?')">ลบ</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="actions">
    <a href="{{ route('knowledge-record.create') }}">+ บันทึกความรู้องค์กร</a>
</div>

@endsection