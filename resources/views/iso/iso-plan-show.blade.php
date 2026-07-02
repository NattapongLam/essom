@extends('layouts.main')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'สำเร็จ!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#4f46e5'
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
    /* Modern Indigo Theme Setup */
    .custom-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05);
        border: 1px solid #e2e8f0;
        margin-top: 30px;
        margin-bottom: 30px;
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
    }
    
    .card-header-modern {
        background-color: #ffffff;
        padding: 2rem 2.5rem 1.2rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        text-align: center;
    }

    .card-header-modern h2 {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
        font-size: 1.5rem;
        line-height: 1.3;
    }

    .card-body-modern {
        padding: 2rem 2.5rem 2.5rem 2.5rem;
    }

    /* Section Panels */
    .form-section-panel {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 22px;
        margin-bottom: 25px;
    }

    .section-subtitle {
        font-size: 1rem;
        font-weight: 700;
        color: #4f46e5;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    label, .field-label { 
        font-weight: 600; 
        color: #475569; 
        display: block; 
        margin-bottom: 8px;
        font-size: 0.9rem;
        text-align: left;
    }

    /* Form Controls Design */
    .form-control-modern {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 0.9rem;
        width: 100%;
        box-sizing: border-box;
        background-color: #ffffff;
        color: #334155;
        transition: all 0.2s ease;
        height: 38px;
    }
    .form-control-modern:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }
    .form-control-modern[readonly], .form-control-modern[disabled] {
        background-color: #f1f5f9 !important;
        color: #64748b;
        border-color: #e2e8f0;
        cursor: default;
    }

    /* Table Component Design */
    .table-responsive-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    table.table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.88rem;
        margin-bottom: 0 !important;
    }
    
    table.table-modern th {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
        font-weight: 600;
        border: 1px solid #4338ca !important;
        padding: 10px;
        font-size: 0.85rem;
    }

    table.table-modern td {
        padding: 10px;
        border: 1px solid #e2e8f0;
        vertical-align: middle;
        background-color: #ffffff;
    }

    /* Buttons Styling */
    .btn-indigo-submit {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: #ffffff !important;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-indigo-submit:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    .btn-secondary-back {
        background-color: #ffffff;
        color: #64748b;
        border: 1px solid #cbd5e1;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none !important;
    }
    .btn-secondary-back:hover {
        background-color: #f8fafc;
        color: #334155;
        border-color: #94a3b8;
    }

    @media (max-width: 768px) {
        .card-body-modern { padding: 1.25rem; }
    }
</style>

<div class="container-fluid">
    <div class="card custom-card">
        
        <!-- Modernized Form Header -->
        <div class="card-header-modern">
            <h2>ESSOM CO., LTD.</h2>
            <h2>PLAN</h2>
        </div>

        <!-- Modernized Form Body -->
        <div class="card-body-modern">
            <form action="{{ route('iso-plan.update', $plan->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Project Info Panel -->
                <div class="form-section-panel">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <span class="field-label">Project</span>
                            <input type="text" value="{{ $plan->project_name ?? '-' }}" class="form-control-modern" readonly>
                        </div>
                        <div class="col-md-6">
                            <span class="field-label">Responsible Section / Person</span>
                            <input type="text" value="{{ $plan->responsible_section ?? '-' }}" class="form-control-modern" readonly>
                        </div>
                    </div>
                </div>

                <!-- Activities Table (Read-Only Mode) -->
                <div class="section-subtitle">
                    <i class="fas fa-tasks"></i> Description of Activities
                </div>

                <div class="table-responsive-container">
                    <table class="table table-modern text-center" id="activityTable">
                        <thead>
                            <tr>
                                <th rowspan="2" style="width: 5%">No.</th>
                                <th rowspan="2" style="width: 25%">Description of Activities</th>
                                <th rowspan="2" style="width: 20%">Resp.<br>Person</th>
                                <th colspan="2" style="border-bottom: 1px solid #4338ca !important;">Date</th>
                                <th style="border-bottom: 1px solid #4338ca !important;">Status</th>
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
                                <td class="font-weight-bold" style="color: #64748b;">{{ $no++ }}</td>
                                <td><input type="text" class="form-control-modern" value="{{ $act['description'] ?? '-' }}" readonly></td>
                                <td><input type="text" class="form-control-modern" value="{{ $act['responsible_person'] ?? '-' }}" readonly></td>
                                <td><input type="text" class="form-control-modern" value="{{ isset($act['date_start']) ? date('Y-m-d', strtotime($act['date_start'])) : '-' }}" readonly></td>
                                <td><input type="text" class="form-control-modern" value="{{ isset($act['date_end']) ? date('Y-m-d', strtotime($act['date_end'])) : '-' }}" readonly></td>
                                <td><input type="text" class="form-control-modern" value="{{ $act['status'] ?? '-' }}" readonly></td>
                                <td><input type="text" class="form-control-modern" value="{{ $act['remark'] ?? '-' }}" readonly></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Workflow Signatures Block -->
                <div class="form-section-panel">
                    <div class="section-subtitle">
                        <i class="fas fa-user-check"></i> Workflow Signatures & Reviews
                    </div>
                    
                    <!-- Row 1: Prepared & Progress Review -->
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <span class="field-label">Prepared by</span>
                            <input class="form-control-modern" type="text" name="prepared_by" value="{{ $plan->prepared_by ?? '' }}" {{ readonlyStep($plan, 'prepared_by') }}>
                        </div>
                        <div class="col-md-2 mb-3 mb-md-0">
                            <span class="field-label">Date</span>
                            <input class="form-control-modern" type="date" name="prepared_date" value="{{ isset($plan->prepared_date) ? date('Y-m-d', strtotime($plan->prepared_date)) : '' }}" {{ readonlyStep($plan, 'prepared_date') }}>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <span class="field-label">Progress Review</span> 
                            <input class="form-control-modern" type="text" name="prepared_progress_review" value="{{ $plan->prepared_progress_review ?? auth()->user()->name }}" {{ readonlyStep($plan, 'prepared_progress_review', 'prepared_by') }}>
                         </div>
                         <div class="col-md-2">
                            <span class="field-label">Date</span>
                            <input class="form-control-modern" type="date" name="prepared_progress_date" value="{{ isset($plan->prepared_progress_date) ? date('Y-m-d', strtotime($plan->prepared_progress_date)) : now()->format('Y-m-d') }}" {{ readonlyStep($plan, 'prepared_progress_date', 'prepared_by') }}>
                         </div>
                    </div>

                    <!-- Row 2: Reviewed & Reported -->
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <span class="field-label">Reviewed by</span>  
                            <input class="form-control-modern" type="text" name="reviewed_by" value="{{ $plan->reviewed_by ?? auth()->user()->name }}"  {{ readonlyStep($plan, 'reviewed_by', 'prepared_progress_review') }}>
                        </div>
                        <div class="col-md-2 mb-3 mb-md-0">
                            <span class="field-label">Date</span>
                            <input class="form-control-modern" type="date" name="reviewed_date" value="{{ isset($plan->reviewed_date) ? date('Y-m-d', strtotime($plan->reviewed_date)) : now()->format('Y-m-d') }}" {{ readonlyStep($plan, 'reviewed_date', 'prepared_progress_review') }}>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <span class="field-label">Reported by</span> 
                            <input class="form-control-modern" type="text" name="reported_by" value="{{ $plan->reported_by ?? auth()->user()->name }}" {{ readonlyStep($plan, 'reported_by', 'reviewed_by') }}>
                        </div>
                        <div class="col-md-2">
                            <span class="field-label">Date</span>
                            <input class="form-control-modern" type="date" name="reported_date" value="{{ isset($plan->reported_date) ? date('Y-m-d', strtotime($plan->reported_date)) : now()->format('Y-m-d') }}" {{ readonlyStep($plan, 'reported_date', 'reviewed_by') }}>
                        </div>
                    </div>

                    <!-- Row 3: Approved & Acknowledged -->
                    <div class="row">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <span class="field-label">Approved by</span> 
                            <input class="form-control-modern" type="text" name="approved_by" value="{{ $plan->approved_by ?? auth()->user()->name }}"  {{ readonlyStep($plan, 'approved_by', 'reported_by') }}>
                        </div>
                        <div class="col-md-2 mb-3 mb-md-0">
                            <span class="field-label">Date</span>
                            <input class="form-control-modern" type="date" name="approved_date" value="{{ isset($plan->approved_date) ? date('Y-m-d', strtotime($plan->approved_date)) : now()->format('Y-m-d') }}" {{ readonlyStep($plan, 'approved_date', 'reported_by') }}>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <span class="field-label">Acknowledged by</span> 
                            <input class="form-control-modern" type="text" name="acknowledged_by" value="{{ $plan->acknowledged_by ?? auth()->user()->name }}" {{ readonlyStep($plan, 'acknowledged_by', 'approved_by') }}>
                        </div>
                        <div class="col-md-2">
                            <span class="field-label">Date</span>
                            <input class="form-control-modern" type="date" name="acknowledged_date" value="{{ isset($plan->acknowledged_date) ? date('Y-m-d', strtotime($plan->acknowledged_date)) : now()->format('Y-m-d') }}"  {{ readonlyStep($plan, 'acknowledged_date', 'approved_by') }}>
                        </div>
                    </div>
                </div>

                <!-- Footer Action Buttons -->
                <div class="text-right" style="margin-top: 30px; display: flex; gap: 10px; justify-content: flex-end;">
                    <a href="{{ route('iso-plan.index') }}" class="btn-secondary-back">
                        <i class="fas fa-arrow-left"></i> กลับ
                    </a>
                    <button type="submit" class="btn-indigo-submit">
                        <i class="fas fa-save"></i> บันทึกข้อมูล
                    </button>
                </div>
            </form>                 
        </div>
    </div>
</div>

@endsection