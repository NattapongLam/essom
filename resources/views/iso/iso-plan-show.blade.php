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

@php
function readonlyStep($plan, $field, $prevField = null) {
    if ($prevField && empty($plan->{$prevField})) {
        return 'readonly';
    }
    if (!empty($plan->{$field})) {
        return 'readonly';
    }
    return '';
}
@endphp

<style>
input[readonly], textarea[readonly] {
    background-color: #e2e8f0; 
    color: #1e293b;
    cursor: default;
}
.card, .form-container { background: #ffffff; border-radius: 18px; padding: 25px 40px; box-shadow: 0 6px 20px rgba(0,0,0,0.08); border: 1px solid #e0e0e0; margin-bottom: 25px; }
body { background-color: #ffffff; }
h2 { text-align: center; font-weight: 700; color: #0f172a; margin-bottom: 8px; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; color: #1e293b; background-color: #ffffff; }
th, td { border: 1px solid #cbd5e1; padding: 10px 12px; text-align: center; vertical-align: middle; background-color: #ffffff; }
th { background-color: #1e40af; color: #ffffff; font-weight: 600; text-transform: uppercase; }
tr:nth-child(even) { background-color: #f8fafc; }
input, textarea, select { border: 1px solid #94a3b8; border-radius: 5px; padding: 6px 10px; font-size: 12px; width: 100%; box-sizing: border-box; background-color: #ffffff; transition: 0.2s; }
input:focus, textarea:focus { border-color: #1e40af; box-shadow: 0 0 4px rgba(59,130,246,0.3); outline: none; }
button.primary { background: linear-gradient(180deg, #1e3a8a, #3b82f6); color: white; border: none; padding: 10px 18px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s ease; }
button.primary:hover { transform: scale(1.05); }
button.edit { background: linear-gradient(180deg, #2563eb, #60a5fa); color:white; border:none; padding:8px 14px; border-radius:6px; font-weight:500; cursor:pointer; transition: all 0.2s ease; }
button.edit:hover { transform: scale(1.05); }
button.delete { background: linear-gradient(180deg, #dc2626, #ef4444); color: white; border: none; padding: 8px 14px; border-radius: 6px; font-weight: 500; cursor: pointer; transition: all 0.2s ease; }
button.delete:hover { transform: scale(1.05); }
.actions { display:flex; gap:12px; justify-content:flex-end; margin-top:15px; }
input[type="text"], input[type="date"] { height: 36px; font-size: 12px; }
</style>

<div align="left" class="form-container">
    <form action="{{ route('iso-plan.update', $plan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <center>
            <h2>ESSOM CO.,LTD.</h2>
            <h2>PLAN</h2>
            <br><br>
            <div class="row">
                <div class="col-6">
                    Project :
                    <input type="text" value="{{ $plan->project_name ?? '-' }}" class="form-control" readonly>
                </div>
                <div class="col-6">
                    Responsible Section / Person :
                    <input type="text" value="{{ $plan->responsible_section ?? '-' }}" class="form-control" readonly>
                </div>
            </div>
        </center>

        <br>
        <div class="table-responsive">
        <table id="activityTable">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 5%">No.</th>
                    <th rowspan="2" style="width: 25%">Description of Activities</th>
                    <th rowspan="2" style="width: 20%">Resp.<br>Person</th>
                    <th colspan="2">Date</th>
                    <th>Status</th>
                    <th rowspan="2" style="width: 20%">Progress Report/Remarks</th>
                </tr>
                <tr>
                    <th style="width: 10%">Start</th>
                    <th style="width: 10%">Finish</th>
                    <th style="width: 10%">Result</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $no = 1; 
                    $activities = json_decode($plan->activities, true) ?? []; 
                @endphp
                @foreach($activities as $act)
                <tr>
                    <td style="width: 5%">{{ $no++ }}</td>
                    <td style="width: 25%"><input type="text" value="{{ $act['description'] ?? '-' }}" readonly></td>
                    <td style="width: 20%"><input type="text" value="{{ $act['responsible_person'] ?? '-' }}" readonly></td>
                    <td style="width: 10%"><input type="text" value="{{ isset($act['date_start']) ? date('Y-m-d', strtotime($act['date_start'])) : '-' }}" readonly></td>
                    <td style="width: 10%"><input type="text" value="{{ isset($act['date_end']) ? date('Y-m-d', strtotime($act['date_end'])) : '-' }}" readonly></td>
                    <td style="width: 10%"><input type="text" value="{{ $act['status'] ?? '-' }}" readonly></td>
                    <td style="width: 20%"><input type="text" value="{{ $act['remark'] ?? '-' }}" readonly></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <br><br>
        <div class="row">
            <div class="col-4">
                Prepared by :
                <input type="text" name="prepared_by" value="{{ $plan->prepared_by ?? '' }}" {{ readonlyStep($plan, 'prepared_by') }}>
            </div>
            <div class="col-2">
                Date :
                <input type="date" name="prepared_date" value="{{ isset($plan->prepared_date) ? date('Y-m-d', strtotime($plan->prepared_date)) : '' }}" {{ readonlyStep($plan, 'prepared_date') }}>
            </div>
             <div class="col-4">
                Progress Review :
                <input type="text" name="prepared_progress_review" value="{{ $plan->prepared_progress_review ?? auth()->user()->name }}" {{ readonlyStep($plan, 'prepared_progress_review', 'prepared_by') }}>
            </div>
            <div class="col-2">
                Date :
<input type="date" name="prepared_progress_date" value="{{ isset($plan->prepared_progress_date) ? date('Y-m-d', strtotime($plan->prepared_progress_date)) : now()->format('Y-m-d') }}" {{ readonlyStep($plan, 'prepared_progress_date', 'prepared_by') }}>
            </div>
        </div>
        <br>
<div class="row">
    <div class="col-4">
        Reviewed by :
<input type="text" name="reviewed_by" value="{{ $plan->reviewed_by ?? auth()->user()->name }}"  {{ readonlyStep($plan, 'reviewed_by', 'prepared_progress_review') }}>
    </div>
    <div class="col-2">
        Date :
<input type="date" name="reviewed_date" value="{{ isset($plan->reviewed_date) ? date('Y-m-d', strtotime($plan->reviewed_date)) : now()->format('Y-m-d') }}" {{ readonlyStep($plan, 'reviewed_date', 'prepared_progress_review') }}>
    </div>
        <div class="col-4">
        Reported by :
        <input type="text" name="reported_by" value="{{ $plan->reported_by ?? auth()->user()->name }}" {{ readonlyStep($plan, 'reported_by', 'reviewed_by') }}>
    </div>
    <div class="col-2">
        Date :
<input type="date" name="reported_date" value="{{ isset($plan->reported_date) ? date('Y-m-d', strtotime($plan->reported_date)) : now()->format('Y-m-d') }}" {{ readonlyStep($plan, 'reported_date', 'reviewed_by') }}>
    </div>
</div>
<br>
<div class="row">
    <div class="col-4">
        Approved by :
<input type="text" name="approved_by" value="{{ $plan->approved_by ?? auth()->user()->name }}"  {{ readonlyStep($plan, 'approved_by', 'reported_by') }}>
    </div>
    <div class="col-2">
        Date :
<input type="date" name="approved_date" value="{{ isset($plan->approved_date) ? date('Y-m-d', strtotime($plan->approved_date)) : now()->format('Y-m-d') }}" {{ readonlyStep($plan, 'approved_date', 'reported_by') }}>
    </div>
        <div class="col-4">
        Acknowledged by :
<input type="text" name="acknowledged_by" value="{{ $plan->acknowledged_by ?? auth()->user()->name }}" {{ readonlyStep($plan, 'acknowledged_by', 'approved_by') }}>
    </div>
    <div class="col-2">
        Date :
<input type="date" name="acknowledged_date" value="{{ isset($plan->acknowledged_date) ? date('Y-m-d', strtotime($plan->acknowledged_date)) : now()->format('Y-m-d') }}"  {{ readonlyStep($plan, 'acknowledged_date', 'approved_by') }}>
    </div>
</div>
<br>
<div class="row">

</div>
        <br><br><br>
        <div style="text-align:right;">
            <button type="submit" class="save">บันทึก</button>
            <a href="{{ route('iso-plan.index') }}"><button type="button" class="back">กลับ</button></a>
        </div>
    </form>
</div>
@endsection
