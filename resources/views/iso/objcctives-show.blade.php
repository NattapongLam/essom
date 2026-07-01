@extends('layouts.main')
@section('content')

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
        margin-bottom: 5px;
    }

    /* Meta Info Cards Grid */
    .info-overview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
    }
    .info-card {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .info-card .label {
        font-size: 0.85rem;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
    }
    .info-card .value {
        font-size: 1.05rem;
        color: #0f172a;
        font-weight: 700;
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
        font-size: 0.9rem;
    }
    th, td {
        border: 1px solid #e2e8f0;
        padding: 12px 14px;
        text-align: center;
        vertical-align: middle;
    }
    th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 700;
    }
    td.text-left {
        text-align: left;
    }
    tr:nth-child(even) { background-color: #fcfdfe; }
    
    /* Text formatting inside table */
    .text-muted-placeholder {
        color: #cbd5e1;
        font-style: italic;
    }

    /* Action Buttons Design */
    .actions { 
        display: flex; 
        gap: 12px; 
        justify-content: flex-end; 
        margin-top: 25px; 
    }
    
    .btn-modern {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    
    .btn-secondary-outline {
        background-color: #ffffff;
        color: #64748b;
        border: 1px solid #cbd5e1;
    }
    .btn-secondary-outline:hover {
        background-color: #f8fafc;
        color: #334155;
        border-color: #94a3b8;
    }

    .btn-indigo-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
    }
    .btn-indigo-primary:hover { 
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
        color: #ffffff;
    }

    @media (max-width: 1024px){
        .form-container { padding: 20px; }
    }
    @media (max-width: 640px) {
        .actions { flex-direction: column; align-items: stretch; }
        .btn-modern { justify-content: center; }
    }
</style>

<div class="form-container" style="max-width: 1200px; margin: 40px auto;">
    
    <div class="header-title-block">
        <h2>ESSOM CO.,LTD.</h2>
        <h2 class="sub-title">รายละเอียด ISO Objective</h2>
    </div>

    <div class="info-overview-grid">
        <div class="info-card">
            <span class="label">No.</span>
            <span class="value">{{ $objcctive->no ?? '-' }}</span>
        </div>
        <div class="info-card">
            <span class="label">Section</span>
            <span class="value">{{ $objcctive->section ?? '-' }}</span>
        </div>
        <div class="info-card">
            <span class="label">Period</span>
            <span class="value">{{ $objcctive->period ?? '-' }}</span>
        </div>
        <div class="info-card">
            <span class="label">Responsible Person</span>
            <span class="value" style="color: #4f46e5;">{{ $objcctive->resp_person ?? '-' }}</span>
        </div>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 35%">Description of Activities</th>
                    <th style="width: 15%">Previous</th>
                    <th style="width: 15%">Plan</th>
                    <th style="width: 15%">Results</th>
                    <th style="width: 20%">Remarks / Corrective Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-left" style="white-space: pre-line; line-height: 1.5;">{!! !empty($objcctive->description) ? e($objcctive->description) : '<span class="text-muted-placeholder">ไม่ได้ระบุรายละเอียด</span>' !!}</td>
                    <td>{{ $objcctive->previous ?? '-' }}</td>
                    <td>{{ $objcctive->plan ?? '-' }}</td>
                    <td>
                        @if(!empty($objcctive->results))
                            <span class="badge" style="background-color: #e0e7ff; color: #4f46e5; padding: 6px 12px; border-radius: 20px; font-weight: 600;">{{ $objcctive->results }}</span>
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-left" style="white-space: pre-line; line-height: 1.5;">{!! !empty($objcctive->remarks) ? e($objcctive->remarks) : '<span class="text-muted-placeholder">-</span>' !!}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="actions">
        <a href="{{ route('objcctives.index') }}" class="btn-modern btn-secondary-outline">
            <i class="fas fa-arrow-left"></i> กลับหน้าหลัก
        </a>
        <a href="{{ route('objcctives.edit', $objcctive) }}" class="btn-modern btn-indigo-primary">
            <i class="fas fa-edit"></i> แก้ไขข้อมูล
        </a>
    </div>
</div>

@endsection