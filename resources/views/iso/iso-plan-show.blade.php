@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'สำเร็จ!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#1e40af'
});
</script>
@endif

<style>
.card, .form-container {
    background: #ffffff;
    border-radius: 18px;
    padding: 25px 40px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    margin-bottom: 25px;
}

body {
    background-color: #ffffff;
}

h2 { text-align: center; font-weight: 700; color: #0f172a; margin-bottom: 8px; }

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 16px;
    color: #1e293b;
    background-color: #ffffff;
}

th, td {
    border: 1px solid #cbd5e1;
    padding: 10px 12px;
    text-align: center;
    vertical-align: middle;
    background-color: #ffffff;
}

th {
    background-color: #1e40af;
    color: #ffffff;
    font-weight: 600;
    text-transform: uppercase;
}

tr:nth-child(even) { background-color: #f8fafc; }

input, textarea, select {
    border: 1px solid #94a3b8;
    border-radius: 5px;
    padding: 6px 10px;
    font-size: 14px;
    width: 100%;
    box-sizing: border-box;
    background-color: #f9fafb;
}

input[readonly], textarea[readonly] {
    background-color: #f1f5f9;
    color: #1e293b;
    cursor: default;
}

button.back {
    background: linear-gradient(180deg, #2563eb, #60a5fa);
    color:white;
    border:none;
    padding:8px 16px;
    border-radius:6px;
    font-weight:500;
    cursor:pointer;
}
button.back:hover { transform: scale(1.05); }
</style>

<div align="left" class="form-container">
    <center>
        <h2>ESSOM CO.,LTD.</h2>
        <h2>PLAN</h2>
        <br><br>
        Project :
        <input type="text" value="{{ $plan->project_name ?? '-' }}" style="width:450px; margin-right:200px;" readonly>
        Responsible Section / Person :
        <input type="text" value="{{ $plan->responsible_section ?? '-' }}" style="width:450px;" readonly>
    </center>

    <br>
    <table id="activityTable">
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Description of Activities</th>
                <th rowspan="2">Resp.<br>Person</th>
                <th colspan="2">Date</th>
                <th>Status</th>
                <th rowspan="2">Progress Report/Remarks</th>
            </tr>
            <tr>
                <th>Start</th>
                <th>Finish</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $no = 1; 
                $activities = json_decode($plan->activities, true) ?? []; 
            @endphp
            @foreach($activities as $act)
            <tr>
                <td>{{ $no++ }}</td>
                <td><input type="text" value="{{ $act['description'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $act['resp_person1'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ isset($act['date_start']) ? explode(' ', $act['date_start'])[0] : '-' }}" readonly></td>
                <td><input type="text" value="{{ isset($act['date_end']) ? explode(' ', $act['date_end'])[0] : '-' }}" readonly></td>
                <td><input type="text" value="{{ $act['status'] ?? '-' }}" readonly></td>
                <td><input type="text" value="{{ $act['remark'] ?? '-' }}" readonly></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>
    Prepared by :
    <input type="text" value="{{ $plan->prepared_by ?? '-' }}" style="width:430px;" readonly>
    Date :
    <input type="text" value="{{ isset($plan->prepared_date) ? explode(' ', $plan->prepared_date)[0] : '-' }}" style="width:150px; margin-right:200px;" readonly>
    Progress Review :
    <input type="text" value="{{ $plan->prepared_progress_review ?? '-' }}" style="width:390px;" readonly>
    Date :
    <input type="text" value="{{ isset($plan->prepared_progress_date) ? explode(' ', $plan->prepared_progress_date)[0] : '-' }}" style="width:150px;" readonly>
    <br><br>

    Reviewed by :
    <input type="text" value="{{ $plan->reported_progress_review ?? '-' }}" style="width:430px;" readonly>
    Date :
    <input type="text" value="{{ isset($plan->reported_date) ? explode(' ', $plan->reported_date)[0] : '-' }}" style="width:150px; margin-right:200px;" readonly>
    Reported by :
    <input type="text" value="{{ $plan->reported_by ?? '-' }}" style="width:420px;" readonly>
    Date :
    <input type="text" value="{{ isset($plan->reported_progress_date) ? explode(' ', $plan->reported_progress_date)[0] : '-' }}" style="width:150px;" readonly>
    <br><br>

    Approved by :
    <input type="text" value="{{ $plan->approved_by ?? '-' }}" style="width:430px;" readonly>
    Date :
    <input type="text" value="{{ isset($plan->approved_date) ? explode(' ', $plan->approved_date)[0] : '-' }}" style="width:150px; margin-right:200px;" readonly>
    Acknowledged by :
    <input type="text" value="{{ $plan->acknowledged_by ?? '-' }}" style="width:380px;" readonly>
    Date :
    <input type="text" value="{{ isset($plan->acknowledged_date) ? explode(' ', $plan->acknowledged_date)[0] : '-' }}" style="width:150px;" readonly>

    <br><br><br>
    <div style="text-align:right;">
        <a href="{{ route('iso-plan.index') }}">
            <button type="button" class="back">กลับ</button>
        </a>
    </div>
</div>
@endsection
