@extends('layouts.main')
@section('content')

@php
    // ===================== Helper functions =====================

    if (!function_exists('pd_status_badge_class')) {
        function pd_status_badge_class($status) {
            if ($status === 'ยกเลิก') {
                return 'badge-danger-modern';
            }
            if (in_array($status, ['อนุมัติ', 'อนุมัติตรวจรับ', 'สรุปเรียบร้อย'])) {
                return 'badge-success-modern';
            }
            return 'badge-warning-modern';
        }
    }

    if (!function_exists('pd_doc_type_meta')) {
        function pd_doc_type_meta($type) {
            $map = [
                'ใบเบิกวัสดุอุปกรณ์'            => ['route' => 'pd-ladi.show', 'icon' => 'fas fa-dolly'],
                'ใบขอซื้อ'                        => ['route' => 'pd-requ.show', 'icon' => 'fas fa-cart-shopping'],
                'ใบสั่งงาน'                       => ['route' => 'pd-work.show', 'icon' => 'fas fa-clipboard-list'],
                'ใบบันทึกชั่วโมงการทำงาน'         => ['route' => 'pd-woho.show', 'icon' => 'fas fa-business-time'],
                'ใบตรวจสอบกระบวนขั้นสุดท้าย'      => ['route' => 'fl-inst.show', 'icon' => 'fas fa-magnifying-glass'],
                'ใบรับคืนจากการเบิก'              => ['route' => 'pd-retu.show', 'icon' => 'fas fa-rotate-left'],
                'ใบโอนย้ายวัสดุอุปกรณ์'           => ['route' => null,           'icon' => 'fas fa-truck-arrow-right'],
            ];

            return $map[$type] ?? ['route' => null, 'icon' => 'fas fa-file-lines'];
        }
    }

    if (!function_exists('pd_file_icon')) {
        function pd_file_icon($filename) {
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'])) {
                return 'far fa-image';
            }
            if ($ext === 'pdf') {
                return 'far fa-file-pdf';
            }
            return 'far fa-file';
        }
    }

    $isOverBudget = (float) $job->productionopenjob_actualcost > (float) $job->productionopenjob_estimatecost;
@endphp

<div class="mt-4 container-fluid px-3">
<div class="row">
    <div class="col-12">
        <div class="card project-detail-card border-0">
            <div class="card-header border-0 d-flex align-items-center justify-content-between bg-transparent pt-4 px-4">
                <h3 class="card-title m-0"><i class="fas fa-diagram-project me-2 text-indigo"></i>Projects Detail</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool-modern" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool-modern" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">

                    {{-- ===================== LEFT: STATS + ACTIVITY ===================== --}}
                    <div class="col-12 col-lg-8 order-2 order-lg-1">
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-sm-4">
                                <div class="stat-box">
                                    <div class="stat-icon stat-icon-budget"><i class="fas fa-money-bill-wave"></i></div>
                                    <div>
                                        <span class="stat-label">Estimate budget</span>
                                        <span class="stat-value">{{ number_format($job->productionopenjob_estimatecost, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="stat-box {{ $isOverBudget ? 'stat-box-danger' : '' }}">
                                    <div class="stat-icon {{ $isOverBudget ? 'stat-icon-danger' : 'stat-icon-spent' }}"><i class="fas fa-money-bill-wave"></i></div>
                                    <div>
                                        <span class="stat-label">Total amount spent</span>
                                        <span class="stat-value">{{ number_format($job->productionopenjob_actualcost, 2) }}</span>
                                        @if($isOverBudget)
                                            <span class="stat-flag"><i class="fas fa-triangle-exclamation"></i> เกินงบ</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="stat-box">
                                    <div class="stat-icon stat-icon-time"><i class="fas fa-clock"></i></div>
                                    <div class="w-100 pr-2">
                                        <span class="stat-label">Total Time</span>
                                        <span class="stat-value mb-1">{{ number_format($job->totaltime, 2) }}</span>
                                        
                                        @if ($time->timeper < 50)
                                            @php $barColor = 'bg-indigo-success'; @endphp
                                        @elseif ($time->timeper >= 50 && $time->timeper <= 69)
                                            @php $barColor = 'bg-indigo-warning'; @endphp
                                        @elseif ($time->timeper >= 70 && $time->timeper <= 99)
                                            @php $barColor = 'bg-indigo-orange'; @endphp
                                        @else
                                            @php $barColor = 'bg-indigo-danger'; @endphp
                                        @endif

                                        <div class="progress progress-modern mb-1">
                                            <div class="progress-bar {{ $barColor }}" role="progressbar" 
                                                 aria-valuenow="{{ $time->timeper }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100" 
                                                 style="width: {{ $time->timeper > 100 ? 100 : $time->timeper }}%">
                                            </div>
                                        </div>
                                        
                                        <small class="text-muted d-block style-percent">
                                            {{ number_format($time->timeper, 2) }}% ({{ $time->mantime }})
                                        </small>
                                    </div>
                                </div>
                            </div>                            
                        </div>

                        <h4 class="section-title mt-4 pt-2"><i class="fas fa-stream me-2 text-indigo"></i>Recent Activity</h4>

                        <div class="activity-timeline">
                            @forelse ($doc as $item)
                                @php
                                    $meta = pd_doc_type_meta($item->type);
                                    $badgeClass = pd_status_badge_class($item->status);
                                @endphp
                                <div class="timeline-item">
                                    <div class="timeline-dot"><i class="{{ $meta['icon'] }}"></i></div>
                                    <div class="timeline-content">
                                        <div class="timeline-top">
                                            <span class="badge {{ $badgeClass }}">{{ $item->status }}</span>
                                            @if($meta['route'])
                                                <a href="{{ route($meta['route'], $item->docuno) }}" target="_blank" rel="noopener" class="timeline-doc-link">
                                                    {{ $item->docuno }}
                                                </a>
                                            @ elegance
                                                <span class="timeline-doc-link timeline-doc-plain">{{ $item->docuno }}</span>
                                            @endif
                                        </div>
                                        <div class="timeline-meta">{{ $item->type }} · {{ $item->created_person }} · {{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</div>
                                        @if($item->remark)
                                            <p class="timeline-remark">{{ $item->remark }}</p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state">ยังไม่มีความเคลื่อนไหวของโปรเจกต์นี้</div>
                            @endforelse
                        </div>
                    </div>

                    {{-- ===================== RIGHT: JOB INFO + COMMENTS ===================== --}}
                    <div class="col-12 col-lg-4 order-1 order-lg-2">
                        <div class="job-summary-box">
                            <div class="job-summary-header">
                                <h3 class="job-title m-0">Job No. {{ $job->productionopenjob_hd_docuno }}</h3>
                                <div class="job-sub-info mt-2">
                                    <span class="d-block"><i class="fas fa-cube me-1"></i> Product: {{ $job->ms_product_name }}</span>
                                    <span class="d-block mt-1"><i class="fas fa-file-alt me-1"></i> Spec Page: {{ $job->ms_specpage_name }}</span>
                                </div>
                            </div>

                            <div class="job-meta-list mt-3">
                                <div class="job-meta-item">
                                    <span class="job-meta-label"><i class="fas fa-building me-1"></i>Client Company</span>
                                    <span class="job-meta-value">{{ $job->ms_customer_name }}</span>
                                </div>
                                <div class="job-meta-item">
                                    <span class="job-meta-label"><i class="fas fa-user-tie me-1"></i>Project Leader</span>
                                    <span class="job-meta-value">{{ $job->created_person }}</span>
                                </div>
                            </div>
                        </div>

                        <h5 class="section-title mt-4"><i class="fas fa-comments me-2 text-indigo"></i>Project Comments</h5>

                        <ul class="comment-list list-unstyled">
                            @forelse ($comm as $item)
                                <li class="comment-item">
                                    <a href="{{ asset($item->filename) }}" target="_blank" rel="noopener" class="comment-attachment">
                                        <i class="{{ pd_file_icon($item->filename) }}"></i>
                                    </a>
                                    <div class="comment-body">
                                        <p class="comment-text">{{ $item->comment }}</p>
                                    </div>
                                </li>
                            @empty
                                <li class="empty-state">ยังไม่มีความเห็นในโปรเจกต์นี้</li>
                            @endforelse
                        </ul>

                        <div class="text-center mt-4">
                            <a href="{{ route('pd-follow.edit', $job->productionopenjob_hd_docuno) }}" class="btn btn-indigo-primary px-4 py-2 w-100 rounded-pill shadow-sm">
                                <i class="fas fa-plus me-2"></i>Add Comment
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('scriptjs')
<style>
    /* ===================== Global Theme & Cards ===================== */
    .text-indigo { color: #6366f1 !important; }
    
    .project-detail-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    }
    
    .project-detail-card .card-title {
        font-weight: 700;
        color: #1e1b4b;
        font-size: 1.25rem;
    }
    
    .section-title {
        font-weight: 700;
        color: #1e1b4b;
        font-size: 1.05rem;
        letter-spacing: -0.01em;
    }

    .btn-tool-modern {
        background: #f3f4f6;
        color: #4b5563;
        border: none;
        border-radius: 8px;
        padding: 5px 10px;
        margin-left: 5px;
        transition: all 0.2s;
    }
    .btn-tool-modern:hover {
        background: #e5e7eb;
        color: #1f2937;
    }

    /* ===================== Modern Badges ===================== */
    .badge-modern {
        padding: 0.45em 0.85em;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
    }
    .badge-success-modern { background-color: #ecfdf5; color: #059669;com .badge-modern }
    .badge-warning-modern { background-color: #fffbeb; color: #d97706; .badge-modern }
    .badge-danger-modern { background-color: #fef2f2; color: #dc2626; .badge-modern }
    
    /* fallback to dynamic if class composition issue */
    .timeline-top .badge {
        padding: 0.45em 0.85em;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.72rem;
        border: 1px solid transparent;
    }
    .badge-success-modern { background: #e6fdf4; color: #10b981; border-color: #bbf7d0; }
    .badge-warning-modern { background: #fffbeb; color: #f59e0b; border-color: #fde68a; }
    .badge-danger-modern { background: #fef2f2; color: #ef4444; border-color: #fca5a5; }

    /* ===================== Stat boxes ===================== */
    .stat-box {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 14px;
        padding: 1.1rem;
        height: 100%;
        box-shadow: 0 2px 12px rgba(99, 102, 241, 0.03);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(99, 102, 241, 0.06);
    }
    .stat-box-danger { 
        background: #fffafb; 
        border-color: #fee2e2; 
    }
    
    .stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        color: #fff;
        flex-shrink: 0;
    }
    .stat-icon-budget { background: linear-gradient(135deg, #818cf8, #4f46e5); box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2); }
    .stat-icon-spent { background: linear-gradient(135deg, #a78bfa, #7c3aed); box-shadow: 0 4px 10px rgba(124, 58, 237, 0.2); }
    .stat-icon-time { background: linear-gradient(135deg, #c084fc, #9333ea); box-shadow: 0 4px 10px rgba(147, 51, 234, 0.2); }
    .stat-icon-danger { background: linear-gradient(135deg, #f87171, #dc2626); box-shadow: 0 4px 10px rgba(220, 38, 38, 0.2); }
    
    .stat-label {
        display: block;
        font-size: 0.72rem;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .stat-value { display: block; font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-top: 1px;}
    .stat-flag {
        display: inline-flex;
        align-items: center;
        gap: 3px;
        margin-top: 0.25rem;
        font-size: 0.68rem;
        font-weight: 600;
        color: #ef4444;
        background: #fee2e2;
        padding: 0.15em 0.65em;
        border-radius: 50px;
    }

    /* Progress Bar Modern */
    .progress-modern {
        height: 6px;
        border-radius: 10px;
        background-color: #f1f5f9;
        overflow: hidden;
    }
    .bg-indigo-success { background: #10b981; }
    .bg-indigo-warning { background: #f59e0b; }
    .bg-indigo-orange  { background: #f97316; }
    .bg-indigo-danger  { background: #ef4444; }
    .style-percent { font-size: 0.7rem; font-weight: 500; }

    /* ===================== Activity timeline ===================== */
    .activity-timeline { position: relative; padding-left: 2.2rem; margin-top: 1.25rem; }
    .activity-timeline::before {
        content: '';
        position: absolute;
        left: 0.95rem;
        top: 0.5rem;
        bottom: 0.5rem;
        width: 2px;
        background: #e2e8f0;
    }
    .timeline-item { position: relative; padding-bottom: 1.25rem; }
    .timeline-item:last-child { padding-bottom: 0; }
    
    .timeline-dot {
        position: absolute;
        left: -2.2rem;
        top: 2px;
        width: 1.9rem;
        height: 1.9rem;
        border-radius: 50%;
        background: #ffffff;
        border: 2px solid #818cf8;
        color: #4f46e5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        z-index: 1;
        box-shadow: 0 2px 6px rgba(79, 70, 229, 0.15);
    }
    .timeline-content { 
        background: #ffffff; 
        border: 1px solid #f1f5f9; 
        border-radius: 12px; 
        padding: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.01);
    }
    .timeline-top { display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap; }
    .timeline-doc-link { font-weight: 700; color: #4f46e5; text-decoration: none; font-size: 0.9rem; }
    .timeline-doc-link:hover { color: #312e81; text-decoration: underline; }
    .timeline-doc-plain { color: #64748b; font-weight: 600; }
    .timeline-meta { font-size: 0.78rem; color: #94a3b8; margin-top: 0.35rem; }
    .timeline-remark { 
        margin: 0.6rem 0 0; 
        font-size: 0.85rem; 
        color: #334155; 
        background: #f8fafc; 
        padding: 0.5rem 0.75rem; 
        border-radius: 8px; 
    }

    /* ===================== Right panel & Comments ===================== */
    .job-summary-box {
        background: linear-gradient(135deg, #fdfbf7, #f5f3ff);
        border: 1px solid #e0e7ff;
        border-radius: 14px;
        padding: 1.25rem;
    }
    .job-title { color: #4f46e5; font-weight: 800; font-size: 1.2rem; letter-spacing: -0.02em;}
    .job-sub-info { font-size: 0.82rem; color: #475569; font-weight: 500; }
    
    .job-meta-list { display: flex; flex-direction: column; gap: 0.75rem; }
    .job-meta-item { 
        border-top: 1px dashed #e2e8f0; 
        padding-top: 0.65rem;
    }
    .job-meta-item:first-child { border-top: none; padding-top: 0; }
    .job-meta-label { font-size: 0.7rem; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; }
    .job-meta-value { font-weight: 700; color: #1e293b; font-size: 0.9rem; margin-top: 1px; display: block; }

    .comment-list { display: flex; flex-direction: column; gap: 0.75rem; margin-top: 0.85rem; }
    .comment-item { 
        display: flex; 
        gap: 0.75rem; 
        align-items: flex-start; 
        background: #ffffff; 
        border: 1px solid #f1f5f9;
        border-radius: 12px; 
        padding: 0.75rem; 
        box-shadow: 0 2px 6px rgba(0,0,0,0.01);
    }
    .comment-attachment {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #eeeffe;
        color: #4f46e5;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        text-decoration: none;
        transition: all 0.2s;
    }
    .comment-attachment:hover { background: #4f46e5; color: #ffffff; transform: scale(1.05); }
    .comment-text { margin: 0; font-size: 0.85rem; color: #334155; line-height: 1.4; }

    .btn-indigo-primary {
        background: #4f46e5;
        color: #ffffff;
        font-weight: 600;
        font-size: 0.9rem;
        border: none;
        transition: all 0.2s;
    }
    .btn-indigo-primary:hover {
        background: #4338ca;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
    }

    .empty-state {
        text-align: center;
        padding: 2rem 1rem;
        color: #94a3b8;
        font-size: 0.85rem;
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
    }
</style>
@endpush