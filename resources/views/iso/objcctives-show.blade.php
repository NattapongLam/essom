@extends('layouts.main')
@section('content')
<style>
.form-container {
    font-family: "Times New Roman", Times, serif;
    margin: 30px;
    background: #fff;
    padding: 20px 50px;
    border-radius: 25px;
    box-shadow: 10px 10px 10px gray;
    width: 1200px;
    overflow: hidden;
    margin-top: 40px;
}
table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid black;
    margin-top: 15px;
}
th, td {
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
button.edit{
    background: linear-gradient(180deg, #2ea8c6ff, #80bde5ff);
    color:white;
    border:none;
    padding:10px 16px;
    border-radius:10px;
    font-weight:400;
    box-shadow: 0 10px 30px rgba(8,158,157,0.18);
    cursor:pointer;
}
</style>
<h2 align="center">รายละเอียด ISO Objective</h2>

<div class="form-container">
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Section</th>
                <th>Period</th>
                <th>Description</th>
                <th>Resp. Person</th>
                <th>Previous</th>
                <th>Plan</th>
                <th>Results</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
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
            </tr>
        </tbody>
    </table>

    <div class="actions">
        <a href="{{ route('objcctives.index') }}">
            <button type="button" class="edit">กลับ</button>
        </a>
        <a href="{{ route('objcctives.edit', $objcctive) }}">
            <button type="button" class="edit">แก้ไข</button>
        </a>
    </div>
</div>
@endsection
