@extends('layouts.main')

@section('content')
<h2>รายละเอียด Plan</h2>

<p><strong>Project:</strong> {{ $plan->project_name }}</p>
<p><strong>Section:</strong> {{ $plan->responsible_section }}</p>
<p><strong>Activity:</strong> {{ $plan->description_of_activities }}</p>
<p><strong>Person:</strong> {{ $plan->responsible_person }}</p>
<p><strong>Start:</strong> {{ $plan->date_start }}</p>
<p><strong>End:</strong> {{ $plan->date_end }}</p>
<p><strong>Status:</strong> {{ $plan->status }}</p>
<p><strong>Remarks:</strong> {{ $plan->remarks }}</p>

<a href="{{ route('iso-plan.index') }}">กลับ</a>
@endsection