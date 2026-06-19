@extends('layouts.main')
@section('content')

@php
    // ===================== Helper functions (ประกาศครั้งเดียวบนสุดของไฟล์) =====================

    if (!function_exists('pd_status_badge_class')) {
        function pd_status_badge_class($status) {
            if ($status === 'ยกเลิก') {
                return 'badge-danger';
            }
            if (in_array($status, ['อนุมัติ', 'อนุมัติตรวจรับ', 'สรุปเรียบร้อย'])) {
                return 'badge-success';
            }
            return 'badge-warning';
        }
    }

    // map ประเภทเอกสาร -> route ที่จะลิงก์ไป + ไอคอนประจำประเภท (แทนการเขียน @if/@elseif ซ้ำ)
    if (!function_exists('pd_doc_type_meta')) {
        function pd_doc_type_meta($type) {
            $map = [
                'ใบเบิกวัสดุอุปกรณ์'              => ['route' => 'pd-ladi.show', 'icon' => 'fas fa-dolly'],
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

    // เลือกไอคอนตามนามสกุลไฟล์แนบ ของเดิมใช้ไอคอนรูปภาพตายตัวแม้ไฟล์จะไม่ใช่รูป
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

<div class="mt-4">
<div class="row">
    <div class="col-12">
        <div class="card project-detail-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-diagram-project me-2"></i>Projects Detail</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">

                    {{-- ===================== LEFT: STATS + ACTIVITY ===================== --}}
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
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
                                    <div>
                                        <span class="stat-label">Total Time</span>
                                        <span class="stat-value">{{ number_format($job->totaltime, 2) }}</span>
                                       {{-- กำหนดค่าสีตามเงื่อนไขเปอร์เซ็นต์ --}}
            @if ($time->timeper < 50)
                @php $barColor = 'bg-green'; @endphp
            @elseif ($time->timeper >= 50 && $time->timeper <= 69)
                @php $barColor = 'bg-yellow'; @endphp {{-- หรือ bg-warning ตาม CSS framework ที่คุณใช้ --}}
            @elseif ($time->timeper >= 70 && $time->timeper <= 99)
                @php $barColor = 'bg-orange'; @endphp {{-- หากไม่มีสีส้มในระบบ สามารถสร้างคลาสคัสตอมเพิ่มได้ --}}
            @else
                @php $barColor = 'bg-red'; @endphp {{-- หรือ bg-danger --}}
            @endif

            {{-- แสดงผล Progress Bar --}}
            <div class="progress progress-sm">
                <div class="progress-bar {{ $barColor }}" role="progressbar" 
                     aria-valuenow="{{ $time->timeper }}" 
                     aria-valuemin="0" 
                     aria-valuemax="100" 
                     style="width: {{ $time->timeper > 100 ? 100 : $time->timeper }}%">
                </div>
            </div>
            
            <small>
                {{ number_format($time->timeper, 2) }}% ( {{ $time->mantime }} ) 
            </small>
                                    </div>
                              </div>                            
                        </div>
                        </div>
                        <h4 class="section-title mt-4"><i class="fas fa-stream me-2"></i>Recent Activity</h4>

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
                                            @else
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
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <div class="job-summary">
                            <h3 class="job-title">Job No. {{ $job->productionopenjob_hd_docuno }}</h3>
                            <p class="text-muted mb-1">Product : {{ $job->ms_product_name }}</p>
                            <p class="text-muted mb-0">Spec Page : {{ $job->ms_specpage_name }}</p>
                        </div>

                        <div class="job-meta-list">
                            <div class="job-meta-item">
                                <span class="job-meta-label"><i class="fas fa-building me-1"></i>Client Company</span>
                                <span class="job-meta-value">{{ $job->ms_customer_name }}</span>
                            </div>
                            <div class="job-meta-item">
                                <span class="job-meta-label"><i class="fas fa-user me-1"></i>Project Leader</span>
                                <span class="job-meta-value">{{ $job->created_person }}</span>
                            </div>
                        </div>

                        <h5 class="section-title mt-4"><i class="fas fa-comments me-2"></i>Project comment</h5>

                        <ul class="comment-list list-unstyled">
                            @forelse ($comm as $item)
                                <li class="comment-item">
                                    <a href="{{ asset($item->filename) }}" target="_blank" rel="noopener" class="comment-attachment">
                                        <i class="{{ pd_file_icon($item->filename) }}"></i>
                                    </a>
                                    <p class="comment-text">{{ $item->comment }}</p>
                                </li>
                            @empty
                                <li class="empty-state">ยังไม่มีความเห็นในโปรเจกต์นี้</li>
                            @endforelse
                        </ul>

                        <div class="text-center mt-4 mb-3">
                            <a href="{{ route('pd-follow.edit', $job->productionopenjob_hd_docuno) }}" class="btn btn-primary btn-sm px-4">
                                <i class="fas fa-plus me-1"></i>Add comment
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
</div>
@endsection

@push('scriptjs')
<style>
    .project-detail-card .card-title { font-weight: 700; color: #4b545c; }
    .section-title { font-weight: 700; color: #4b545c; font-size: 1rem; }

    /* ===================== Stat boxes ===================== */
    .stat-box {
        display: flex;
        align-items: center;
        gap: .75rem;
        background: #f8f9fa;
        border: 1px solid #e3e6ea;
        border-radius: 10px;
        padding: .85rem 1rem;
        height: 100%;
    }
    .stat-box-danger { background: #fdf2f1; border-color: #f5c6c4; }
    .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.05rem;
        color: #fff;
        flex-shrink: 0;
    }
    .stat-icon-budget { background: #3f6791; }
    .stat-icon-spent { background: #16a085; }
    .stat-icon-time { background: #8e44ad; }
    .stat-icon-danger { background: #c0392b; }
    .stat-label {
        display: block;
        font-size: .72rem;
        color: #8a929a;
        text-transform: uppercase;
        letter-spacing: .03em;
    }
    .stat-value { display: block; font-size: 1.15rem; font-weight: 700; color: #2c3e50; }
    .stat-flag {
        display: inline-block;
        margin-top: .2rem;
        font-size: .68rem;
        font-weight: 600;
        color: #c0392b;
        background: #fdecea;
        padding: .1em .55em;
        border-radius: 50px;
    }

    /* ===================== Activity timeline ===================== */
    .activity-timeline { position: relative; padding-left: 2.1rem; margin-top: 1rem; }
    .activity-timeline::before {
        content: '';
        position: absolute;
        left: .95rem;
        top: .4rem;
        bottom: .4rem;
        width: 2px;
        background: #e3e6ea;
    }
    .timeline-item { position: relative; padding-bottom: 1.1rem; }
    .timeline-item:last-child { padding-bottom: 0; }
    .timeline-dot {
        position: absolute;
        left: -2.1rem;
        top: 0;
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        background: #fff;
        border: 2px solid #3f6791;
        color: #3f6791;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .78rem;
        z-index: 1;
    }
    .timeline-content { background: #fff; border: 1px solid #e9ecef; border-radius: 10px; padding: .85rem 1rem; }
    .timeline-top { display: flex; align-items: center; gap: .5rem; flex-wrap: wrap; }
    .timeline-doc-link { font-weight: 600; color: #2c3e50; text-decoration: none; }
    .timeline-doc-link:hover { color: #3f6791; text-decoration: underline; }
    .timeline-doc-plain { color: #6c757d; }
    .timeline-meta { font-size: .78rem; color: #9aa1a8; margin-top: .3rem; }
    .timeline-remark { margin: .5rem 0 0; font-size: .85rem; color: #4b545c; }

    /* ===================== Right panel ===================== */
    .job-summary { border-bottom: 1px solid #eef0f2; padding-bottom: 1rem; margin-bottom: 1rem; }
    .job-title { color: #3f6791; font-weight: 700; }
    .job-meta-list { display: flex; flex-direction: column; gap: .65rem; }
    .job-meta-item { display: flex; flex-direction: column; }
    .job-meta-label { font-size: .72rem; color: #8a929a; text-transform: uppercase; letter-spacing: .03em; }
    .job-meta-value { font-weight: 600; color: #2c3e50; }

    .comment-list { display: flex; flex-direction: column; gap: .6rem; margin-top: .75rem; }
    .comment-item { display: flex; gap: .6rem; align-items: flex-start; background: #f8f9fa; border-radius: 10px; padding: .6rem .75rem; }
    .comment-attachment {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: #eef1f4;
        color: #3f6791;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        text-decoration: none;
        transition: all .15s ease-in-out;
    }
    .comment-attachment:hover { background: #3f6791; color: #fff; }
    .comment-text { margin: 0; font-size: .85rem; color: #4b545c; padding-top: .3rem; }

    .empty-state {
        text-align: center;
        padding: 2rem 1rem;
        color: #adb5bd;
        font-size: .85rem;
        background: #fafbfc;
        border: 1px dashed #e3e6ea;
        border-radius: 10px;
    }
</style>
@endpush