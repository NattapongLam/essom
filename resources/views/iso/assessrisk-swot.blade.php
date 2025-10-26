@extends('layouts.app')
@section('content')
<div class="container">
    <h3 class="text-center mb-4">แบบฟอร์มการวิเคราะห์ความเสี่ยงเชิงกลยุทธ์ของบริษัท (SWOT Analysis)</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('assessrisk-swot.store') }}" method="POST">
        @csrf

        <table class="table table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th width="20%">หมวดหมู่</th>
                    <th>รายละเอียด</th>
                    <th width="10%">Accept</th>
                    <th width="10%">Non Accept</th>
                    <th width="20%">แนวทางปรับปรุง / กิจกรรม</th>
                    <th width="20%">ผู้รับผิดชอบ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>1. Strengths (S)</strong></td>
                    <td><input type="text" name="strengths" class="form-control"></td>
                    <td><input type="checkbox" name="accept" value="S"></td>
                    <td><input type="checkbox" name="non_accept" value="S"></td>
                    <td><input type="text" name="improvement" class="form-control"></td>
                    <td><input type="text" name="responsible" class="form-control"></td>
                </tr>
                <tr>
                    <td><strong>2. Weaknesses (W)</strong></td>
                    <td><input type="text" name="weaknesses" class="form-control"></td>
                    <td><input type="checkbox" name="accept" value="W"></td>
                    <td><input type="checkbox" name="non_accept" value="W"></td>
                    <td><input type="text" name="improvement" class="form-control"></td>
                    <td><input type="text" name="responsible" class="form-control"></td>
                </tr>
                <tr>
                    <td><strong>3. Opportunities (O)</strong></td>
                    <td><input type="text" name="opportunities" class="form-control"></td>
                    <td><input type="checkbox" name="accept" value="O"></td>
                    <td><input type="checkbox" name="non_accept" value="O"></td>
                    <td><input type="text" name="improvement" class="form-control"></td>
                    <td><input type="text" name="responsible" class="form-control"></td>
                </tr>
                <tr>
                    <td><strong>4. Threats (T)</strong></td>
                    <td><input type="text" name="threats" class="form-control"></td>
                    <td><input type="checkbox" name="accept" value="T"></td>
                    <td><input type="checkbox" name="non_accept" value="T"></td>
                    <td><input type="text" name="improvement" class="form-control"></td>
                    <td><input type="text" name="responsible" class="form-control"></td>
                </tr>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
        </div>
    </form>
</div>
@endsection
