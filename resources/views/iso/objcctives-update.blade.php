@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'สำเร็จ!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#4f46e5',
    customClass: { confirmButton: 'px-4 py-2 text-white font-weight-bold rounded' }
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'เกิดข้อผิดพลาด!',
    text: "{{ session('error') }}",
    confirmButtonColor: '#dc2626',
    customClass: { confirmButton: 'px-4 py-2 text-white font-weight-bold rounded' }
});
</script>
@endif

<style>
    /* Modern Indigo Theme Setup */
    .form-container {
        background: #ffffff;
        padding: 2.5rem;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05);
        border: 1px solid #e2e8f0;
        margin-bottom: 30px;
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
    }
    .header-title-block {
        text-align: center;
        margin-bottom: 25px;
    }
    h2 { 
        font-weight: 700; 
        color: #1e293b; 
        margin-bottom: 4px; 
        font-size: 1.6rem;
    }
    h2.sub-title {
        color: #4f46e5;
        font-size: 1.3rem;
        margin-bottom: 10px;
    }
    .doc-meta {
        font-size: 0.85rem;
        color: #64748b;
        line-height: 1.4;
    }

    /* Form Section Layouts */
    .section-top-fields {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
    }

    label { 
        font-weight: 600; 
        color: #475569; 
        display: block; 
        margin-bottom: 8px;
        font-size: 0.9rem;
    }
    
    /* Input Elements styling */
    input, textarea, select {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 0.9rem;
        width: 100%;
        box-sizing: border-box;
        background-color: #ffffff;
        color: #334155;
        transition: all 0.2s ease;
    }
    input:focus, textarea:focus, select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }
    
    /* Readonly and Disabled States styling for Approval View */
    input[readonly], textarea[readonly], select[disabled] {
        background-color: #f8fafc !important;
        color: #64748b !important;
        border-color: #e2e8f0 !important;
        cursor: not-allowed;
    }

    /* Table Responsive Style */
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        margin-top: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }
    th, td {
        border: 1px solid #e2e8f0;
        padding: 10px 8px;
        text-align: center;
        vertical-align: middle;
    }
    th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 700;
    }
    tr:nth-child(even) { background-color: #fcfdfe; }

    /* Action Buttons Design */
    button.primary-submit {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 12px 28px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.2s ease;
    }
    button.primary-submit:hover { 
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    /* Signature Flow Card Grid */
    .signature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        margin-top: 30px;
    }
    .signature-item {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    /* Highlight state for active approval input */
    .signature-item.active-approval input {
        border-color: #4f46e5 !important;
        background-color: #ffffff !important;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        color: #4f46e5 !important;
        font-weight: 600;
    }

    .actions { display: flex; gap: 12px; justify-content: flex-end; margin-top: 25px; }

    /* Select2 Disabled Styles Override */
    .select2-container--default.select2-container--disabled .select2-selection--single {
        background-color: #f8fafc !important;
        border-color: #e2e8f0 !important;
    }

    @media (max-width: 1024px){
        .form-container { padding: 20px; }
    }
    @media (max-width: 640px) {
        .actions { flex-direction: column; align-items: stretch; }
    }
</style>

<form action="{{ route('objcctives.update', $objcctive->id) }}" method="POST">
@csrf
@method('PUT')
<input type="hidden" name="checkdoc" value="Update">

<div class="form-container">
    <div class="header-title-block">
        <h2>ESSOM CO.,LTD.</h2>
        <h2 class="sub-title">Objective (การอนุมัติเอกสาร)</h2>
        <div class="doc-meta text-right">F6200.1<br>9 Apr 24</div>
    </div>

    <div class="section-top-fields">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <label>Section:</label>
                <input type="text" name="section[]" value="{{ old('section.0', $objcctive->section) }}" class="form-control" readonly required>
            </div>
            <div class="col-md-6">
                <label>Period:</label>
                <input type="text" name="period[]" value="{{ old('period.0', $objcctive->period) }}" class="form-control" readonly required>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="objectiveTable">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 5%">NO.</th>
                    <th rowspan="2" style="width: 30%">DESCRIPTION OF ACTIVITIES</th>
                    <th rowspan="2" style="width: 20%">RESP. PERSON</th>
                    <th colspan="3" style="background-color: #f1f5f9; color: #475569;">OBJECTIVE</th>
                    <th rowspan="2" style="width: 20%">REMARKS/CORRECTIVE ACTION</th>
                </tr>
                <tr>
                    <th width="10%" style="background-color: #f8fafc; color: #475569;">Previous</th>
                    <th width="10%" style="background-color: #f8fafc; color: #475569;">Plan</th>
                    <th width="10%" style="background-color: #f8fafc; color: #475569;">Results</th>
                </tr>
            </thead>
            <tbody>
                @php
                  $activities = $objcctive->activity_list ?? [];
                @endphp

                @forelse($activities as $i => $act)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>
                        <textarea name="description[]" rows="3" readonly>{{ trim(old('description.'.$i, $act['description'] ?? '')) }}</textarea>
                    </td>
                    <td>
                        <select class="form-control receiver-select" name="resp_person[]" disabled>
                            <option value=""></option>
                            @foreach ($emp as $item)
                                 <option value="{{ $item->ms_employee_fullname }}"
                                    {{ (isset($act['resp_person']) && $act['resp_person'] == $item->ms_employee_fullname) ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="text" name="previous[]" value="{{ old('previous.'.$i, $act['previous'] ?? '') }}" readonly></td>
                    <td><input type="text" name="plan[]" value="{{ old('plan.'.$i, $act['plan'] ?? '') }}" readonly></td>
                    <td><input type="text" name="results[]" value="{{ old('results.'.$i, $act['results'] ?? '') }}" readonly></td>
                    <td>
                        <textarea name="remarks[]" rows="3" readonly>{{ trim(old('remarks.'.$i, $act['remarks'] ?? '')) }}</textarea>
                    </td>
                </tr>
                @empty
                @for($i = 0; $i < 5; $i++)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td><input type="text" name="description[]" placeholder="Description of Activities" readonly></td>
                    <td><input type="text" name="resp_person[]" placeholder="Resp Person" readonly></td>
                    <td><input type="text" name="previous[]" placeholder="Previous" readonly></td>
                    <td><input type="text" name="plan[]" placeholder="Plan" readonly></td>
                    <td><input type="text" name="results[]" placeholder="Results" readonly></td>
                    <td><input type="text" name="remarks[]" placeholder="Remarks" readonly></td>
                </tr>
                @endfor
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="signature-grid">
        <div class="signature-item">
            <label>Prepared by:</label>
            <input type="text" name="prepared_by" class="form-control" value="{{ old('prepared_by', $objcctive->prepared_by) }}" readonly>
        </div>
        <div class="signature-item">
            <label>Date:</label>
            <input type="date" name="prepared_date" class="form-control" value="{{ old('prepared_date', optional(\Carbon\Carbon::parse($objcctive->prepared_date))->format('Y-m-d')) }}" readonly>
        </div>

        @if ($objcctive->reported_by)
            <div class="signature-item">
                <label>Reported by:</label>
                <input type="text" name="reported_by" class="form-control" value="{{$objcctive->reported_by}}" readonly>
            </div>
            <div class="signature-item">
                <label>Date:</label>
                <input type="date" name="reported_date" class="form-control" value="{{ old('reported_date', optional(\Carbon\Carbon::parse($objcctive->reported_date))->format('Y-m-d')) }}" readonly>
            </div>
        @else
            <div class="signature-item active-approval">
                <label>Reported by (ผู้อนุมัติ):</label>
                <input type="text" name="reported_by" class="form-control" value="{{auth()->user()->name}}" readonly>
            </div>
            <div class="signature-item active-approval">
                <label>Date (วันที่อนุมัติ):</label>
                <input type="date" name="reported_date" class="form-control" value="{{ old('date', now()->format('Y-m-d')) }}" required>
            </div>
        @endif          
    </div>

    <div class="signature-grid" style="margin-top: 20px;">
        @if ($objcctive->reviewed_by)
            <div class="signature-item">
                <label>Reviewed by:</label>
                <input type="text" name="reviewed_by" class="form-control" value="{{ old('reviewed_by', $objcctive->reviewed_by) }}" readonly>
            </div>
            <div class="signature-item">
                <label>Date:</label>
                <input type="date" name="reviewed_date" class="form-control" value="{{ old('reviewed_date', optional(\Carbon\Carbon::parse($objcctive->reviewed_date))->format('Y-m-d')) }}" readonly>
            </div>  
        @elseif($objcctive->reported_by)
            <div class="signature-item active-approval">
                <label>Reviewed by (ผู้อนุมัติ):</label>
                <input type="text" name="reviewed_by" class="form-control" value="{{auth()->user()->name}}" readonly>
            </div>
            <div class="signature-item active-approval">
                <label>Date (วันที่อนุมัติ):</label>
                <input type="date" name="reviewed_date" class="form-control" value="{{ old('date', now()->format('Y-m-d')) }}" required>
            </div> 
        @endif   

        @if ($objcctive->acknowledged_by)
            <div class="signature-item">
                <label>Acknowledged by:</label>
                <input type="text" name="acknowledged_by" class="form-control" value="{{ old('acknowledged_by', $objcctive->acknowledged_by) }}" readonly>
            </div>
            <div class="signature-item">
                <label>Date:</label>
                <input type="date" name="acknowledged_date" class="form-control" value="{{ old('acknowledged_date', optional(\Carbon\Carbon::parse($objcctive->acknowledged_date))->format('Y-m-d')) }}" readonly>
            </div>   
        @elseif($objcctive->reviewed_by)
            <div class="signature-item active-approval">
                <label>Acknowledged by (ผู้อนุมัติ):</label>
                <input type="text" name="acknowledged_by" class="form-control" value="{{auth()->user()->name}}" readonly>
            </div>
            <div class="signature-item active-approval">
                <label>Date (วันที่อนุมัติ):</label>
                <input type="date" name="acknowledged_date" class="form-control" value="{{ old('date', now()->format('Y-m-d')) }}" required>
            </div>   
        @endif                 
    </div>

    @if ($objcctive->approved_by || $objcctive->acknowledged_by)
    <div class="signature-grid" style="margin-top: 20px;">
        @if ($objcctive->approved_by)
            <div class="signature-item">
                <label>Approved by:</label>
                <input type="text" name="approved_by" class="form-control" value="{{ old('approved_by', $objcctive->approved_by) }}" readonly>
            </div>
            <div class="signature-item">
                <label>Date:</label>
                <input type="date" name="approved_date" class="form-control" value="{{ old('approved_date', optional(\Carbon\Carbon::parse($objcctive->approved_date))->format('Y-m-d')) }}" readonly>
            </div>
        @elseif($objcctive->acknowledged_by)
            <div class="signature-item active-approval">
                <label>Approved by (ผู้อนุมัติสูงสุด):</label>
                <input type="text" name="approved_by" class="form-control" value="{{auth()->user()->name}}" readonly>
            </div>
            <div class="signature-item active-approval">
                <label>Date (วันที่อนุมัติ):</label>
                <input type="date" name="approved_date" class="form-control" value="{{ old('date', now()->format('Y-m-d')) }}" required>
            </div>
        @endif
    </div>
    @endif

    <div class="actions">
        <button type="submit" class="primary-submit"><i class="fas fa-check-circle mr-1"></i> อนุมัติข้อมูล</button>
    </div>
</div>
</form>
@endsection

@push('scriptjs')
<script>
$(document).ready(function () {
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });
});
</script>
@endpush