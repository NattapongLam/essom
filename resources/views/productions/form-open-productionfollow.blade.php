@extends('layouts.main')
@section('content')

@php
    // ===================== Helper functions =====================

    // แปลงค่าชั่วโมง.นาที ตามกฎปัดเศษเดิม
    if (!function_exists('pd_format_hm')) {
        function pd_format_hm($value) {
            $hours = floor((float) $value);
            $minutes = round(((float) $value - $hours) * 100);

            if ($minutes == 10 || $minutes == 20) {
                $minutes = 30;
            } elseif ($minutes == 50) {
                $hours += 1;
                $minutes = 0;
            } elseif ($minutes >= 60) {
                $hours += 1;
                $minutes = 30;
            }

            return $hours . '.' . sprintf('%02d', $minutes);
        }
    }

    // คืนคลาสสีของแถบ progress ตามเปอร์เซ็นต์ (Modern Theme Palette)
    if (!function_exists('pd_progress_meta')) {
        function pd_progress_meta($percent) {
            $percent = (float) $percent;
            if ($percent < 50) {
                return ['bg-modern-success', 'text-modern-success'];
            } elseif ($percent <= 69) {
                return ['bg-modern-warning', 'text-modern-warning'];
            } elseif ($percent <= 99) {
                return ['bg-modern-orange', 'text-modern-orange'];
            }
            return ['bg-modern-danger', 'text-modern-danger'];
        }
    }

    $steps = [
        ['key' => 'step1', 'icon' => 'fas fa-folder-open', 'nav_title' => '1. เปิดงาน', 'table_title' => 'รายการโปรเจกต์ (เปิดงาน)', 'data' => $hd1],
        ['key' => 'step2', 'icon' => 'fas fa-tools', 'nav_title' => '2. กำลังผลิต', 'table_title' => 'รายการโปรเจกต์ (กำลังผลิต)', 'data' => $hd2],
        ['key' => 'step3', 'icon' => 'fas fa-vial', 'nav_title' => '3. ทดสอบ', 'table_title' => 'รายการโปรเจกต์ (ทดสอบ)', 'data' => $hd3],
        ['key' => 'step4', 'icon' => 'fas fa-check-circle', 'nav_title' => '4. เสนอปิดงาน', 'table_title' => 'รายการโปรเจกต์ (เสนอปิดงาน)', 'data' => $hd4],
    ];
@endphp

<div class="mt-4 container-fluid" style="background-color: #f8fafc; min-height: 100vh; padding: 20px 0;">
<div class="row">
    <div class="col-12">

        {{-- ===================== STEP NAV ===================== --}}
        <div class="card card-modern border-0 mb-4">
            <div class="card-body p-2">
                <ul class="nav nav-pills nav-justified steps-container" id="projectSteps" role="tablist">
                    @foreach ($steps as $i => $step)
                        <li class="nav-item p-1">
                            <a class="nav-link py-3 {{ $i === 0 ? 'active' : '' }}"
                               id="{{ $step['key'] }}-tab"
                               data-toggle="tab"
                               href="#{{ $step['key'] }}"
                               role="tab"
                               aria-controls="{{ $step['key'] }}"
                               aria-selected="{{ $i === 0 ? 'true' : 'false' }}">
                                <div class="step-icon mb-1"><i class="{{ $step['icon'] }}"></i></div>
                                <span class="step-title">{{ $step['nav_title'] }}
                                    <span class="badge step-count" data-count-for="{{ $step['key'] }}">{{ count($step['data']) }}</span>
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- ===================== FILTER BAR ===================== --}}
        <div class="card card-modern border-0 mb-4 filter-card">
            <div class="card-body p-4">
                <div class="filter-head mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="filter-icon-box"><i class="fas fa-filter"></i></div>
                        <span class="fs-5 fw-bold text-dark">ตัวกรองข้อมูล</span>
                    </div>
                    <span id="filterCount" class="filter-result-count"></span>
                </div>
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-lg-4">
                        <label class="form-label small fw-semibold text-secondary mb-2">ค้นหาข้อมูล</label>
                        <div class="search-input">
                            <i class="fas fa-magnifying-glass"></i>
                            <input type="text" id="filterSearch" class="form-control form-modern" placeholder="เลขที่งาน, สินค้า, ลูกค้า, ผู้เปิดงาน">
                        </div>
                    </div>
                    <div class="col-6 col-lg-2">
                        <label class="form-label small fw-semibold text-secondary mb-2">กำหนดส่งจากวันที่</label>
                        <input type="date" id="filterDateFrom" class="form-control form-modern">
                    </div>
                    <div class="col-6 col-lg-2">
                        <label class="form-label small fw-semibold text-secondary mb-2">ถึงวันที่</label>
                        <input type="date" id="filterDateTo" class="form-control form-modern">
                    </div>
                    <div class="col-6 col-lg-2">
                        <label class="form-label small fw-semibold text-secondary mb-2">สถานะความคืบหน้า</label>
                        <select id="filterProgress" class="form-select form-modern">
                            <option value="">ทั้งหมด</option>
                            <option value="normal">ปกติ (&lt; 50%)</option>
                            <option value="warning">เฝ้าระวัง (50–69%)</option>
                            <option value="high">เร่งด่วน (70–99%)</option>
                            <option value="overdue">เกินกำหนด (≥ 100%)</option>
                        </select>
                    </div>
                    <div class="col-6 col-lg-2">
                        <button type="button" id="filterReset" class="btn btn-modern-outline w-100">
                            <i class="fas fa-rotate-left me-1"></i> ล้างตัวกรอง
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===================== TAB CONTENT ===================== --}}
        <div class="tab-content" id="projectStepsContent">
            @foreach ($steps as $i => $step)
                <div class="tab-pane fade {{ $i === 0 ? 'show active' : '' }}" id="{{ $step['key'] }}" role="tabpanel" aria-labelledby="{{ $step['key'] }}-tab">
                    <div class="card card-modern border-0 shadow-sm">
                        <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                            <h4 class="card-title d-flex align-items-center gap-2" style="color: #1e1b4b;">
                                <span class="title-decor-line"></span>
                                <i class="{{ $step['icon'] }} text-indigo-accent"></i> {{ $step['table_title'] }}
                            </h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table projects-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 12%">Deadline</th>
                                            <th style="width: 33%">Project Details</th>
                                            <th style="width: 35%">Progress Metrics</th>
                                            <th style="width: 10%" class="text-center">Status</th>
                                            <th style="width: 10%" class="text-end pe-4">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($step['data'] as $item)
                                            @php
                                                $dueDate = \Carbon\Carbon::parse($item->productionnotice_dt_duedate);
                                                $timeper = (float) $item->timeper;
                                                $isOverdue = $dueDate->isPast() && $timeper < 100;

                                                if ($timeper >= 100) {
                                                    $statusKey = 'overdue';
                                                } elseif ($timeper >= 70) {
                                                    $statusKey = 'high';
                                                } elseif ($timeper >= 50) {
                                                    $statusKey = 'warning';
                                                } else {
                                                    $statusKey = 'normal';
                                                }

                                                $metrics = [
                                                    ['label' => 'Project',     'icon' => 'fas fa-chart-pie',    'percent' => $item->timeper,    'planned' => pd_format_hm($item->totaltime),               'actual' => pd_format_hm($item->mantime)],
                                                    ['label' => 'Machine',     'icon' => 'fas fa-industry',     'percent' => $item->mach_per,   'planned' => number_format($item->machinetime, 2),         'actual' => number_format($item->mach_totals, 2)],
                                                    ['label' => 'Electricity', 'icon' => 'fas fa-bolt',         'percent' => $item->elect_per,  'planned' => number_format($item->electricitytime, 2),     'actual' => number_format($item->elect_totals, 2)],
                                                    ['label' => 'Paint',       'icon' => 'fas fa-paint-roller', 'percent' => $item->paint_per,  'planned' => number_format($item->painttime, 2),           'actual' => number_format($item->paint_totals, 2)],
                                                    ['label' => 'Assembly',    'icon' => 'fas fa-cubes',        'percent' => $item->assembly_per,'planned' => number_format($item->assemblytime, 2),        'actual' => number_format($item->assembly_totals, 2)],
                                                ];
                                            @endphp
                                            <tr class="project-row align-middle"
                                                data-docno="{{ strtolower($item->productionopenjob_hd_docuno) }}"
                                                data-product="{{ strtolower($item->ms_product_name . ' ' . $item->ms_product_code) }}"
                                                data-customer="{{ strtolower($item->ms_customer_name) }}"
                                                data-person="{{ strtolower($item->created_person) }}"
                                                data-duedate="{{ $dueDate->format('Y-m-d') }}"
                                                data-progress="{{ $item->timeper }}"
                                                data-status="{{ $statusKey }}">
                                                <td class="ps-4">
                                                    <div class="fw-bold text-dark fs-6">{{ $dueDate->format('d/m/Y') }}</div>
                                                    @if($isOverdue)
                                                        <span class="badge badge-modern-overdue mt-1"><i class="fas fa-triangle-exclamation me-1"></i> เลยกำหนด</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('pd-follow.show', $item->productionopenjob_hd_docuno) }}" class="project-doc-link">
                                                        {{ $item->productionopenjob_hd_docuno }}
                                                        <span class="spec-page-badge">Spec P.{{ $item->ms_specpage_name }}</span>
                                                    </a>
                                                    <div class="project-meta-grid mt-2">
                                                        <span><i class="fas fa-box"></i> {{ $item->ms_product_name }}</span>
                                                        <span><i class="fas fa-user-tie"></i> ลูกค้า: {{ $item->ms_customer_name }}</span>
                                                        <span><i class="fas fa-user"></i> ผู้เปิด: {{ $item->created_person }}</span>
                                                    </div>
                                                </td>
                                                <td class="project-progress-cell py-3">
                                                    @foreach ($metrics as $metric)
                                                        @php
                                                            [$barClass, $textClass] = pd_progress_meta($metric['percent']);
                                                            $width = min((float) $metric['percent'], 100);
                                                        @endphp
                                                        <div class="progress-metric">
                                                            <div class="progress-metric-head">
                                                                <span class="progress-metric-label"><i class="{{ $metric['icon'] }} me-1 opacity-75"></i>{{ $metric['label'] }}</span>
                                                                <span class="progress-metric-percent {{ $textClass }}">{{ number_format((float) $metric['percent'], 2) }}%</span>
                                                            </div>
                                                            <div class="progress progress-modern">
                                                                <div class="progress-bar {{ $barClass }}"
                                                                     role="progressbar"
                                                                     aria-valuenow="{{ $metric['percent'] }}"
                                                                     aria-valuemin="0"
                                                                     aria-valuemax="100"
                                                                     style="width: {{ $width }}%"></div>
                                                            </div>
                                                            <div class="progress-metric-detail">
                                                                <span>Plan: <strong>{{ $metric['planned'] }}</strong></span>
                                                                <span class="dot">•</span>
                                                                <span>Act: <strong>{{ $metric['actual'] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-indigo-light text-indigo-dark px-3 py-2 rounded-pill fw-semibold">{{ $item->productionopenjob_status_name }}</span>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <a class="btn btn-modern-primary btn-sm px-3" href="{{ route('pd-follow.show', $item->productionopenjob_hd_docuno) }}">
                                                        <i class="fas fa-eye me-1"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="5" class="empty-state-modern"><i class="fas fa-inbox fa-2x mb-2 d-block opacity-50"></i>ไม่มีรายการในขั้นตอนนี้</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="no-match-state d-none py-5 text-center text-muted">
                                <i class="fas fa-magnifying-glass-blur fa-2x mb-2 d-block opacity-50"></i> ไม่พบรายการที่ตรงกับตัวกรองที่เลือก
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
</div>
@endsection

@push('scriptjs')
<style>
    /* ===================== Modern Base UI & Indigo Palette ===================== */
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #e0e7ff;
        --indigo-dark: #3730a3;
        
        --success-modern: #10b981;
        --warning-modern: #f59e0b;
        --orange-modern: #f97316;
        --danger-modern: #ef4444;
    }

    .card-modern {
        border-radius: 16px !important;
        box-shadow: 0 4px 25px rgba(15, 23, 42, 0.04) !important;
        background-color: #ffffff;
    }

    /* ===================== Step Navigation (Modern Pill Style) ===================== */
    .steps-container {
        background-color: #f1f5f9;
        border-radius: 12px;
        padding: 4px;
    }
    .steps-container .nav-item {
        margin: 0;
    }
    .steps-container .nav-link {
        border-radius: 10px !important;
        color: #64748b;
        background-color: transparent;
        border: none;
        font-weight: 600;
        transition: all 0.2s ease-in-out;
    }
    .steps-container .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.5);
        color: var(--indigo-primary);
    }
    .steps-container .nav-link.active {
        background-color: #ffffff !important;
        color: var(--indigo-dark) !important;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.12) !important;
    }
    .step-icon { 
        font-size: 1.1rem; 
        display: inline-block;
        margin-right: 4px;
    }
    .step-title {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    .step-count {
        background: #e2e8f0;
        color: #475569;
        border-radius: 8px;
        font-size: 0.75rem;
        padding: 3px 8px;
    }
    .nav-link.active .step-count { 
        background: var(--indigo-primary); 
        color: #ffffff; 
    }

    /* ===================== Filter Bar Polish ===================== */
    .filter-icon-box {
        background-color: var(--indigo-light);
        color: var(--indigo-primary);
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }
    .filter-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .filter-result-count {
        font-size: 0.85rem;
        background-color: #f1f5f9;
        padding: 4px 12px;
        border-radius: 20px;
        color: #64748b;
        font-weight: 500;
    }
    .form-modern {
        border-radius: 10px !important;
        border: 1px solid #cbd5e1 !important;
        padding: 0.55rem 0.75rem;
        font-size: 0.9rem;
        color: #334155;
        transition: all 0.2s;
    }
    .form-modern:focus {
        border-color: var(--indigo-primary) !important;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15) !important;
    }
    .search-input { position: relative; }
    .search-input i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.9rem;
    }
    .search-input input { padding-left: 38px; }
    
    .btn-modern-outline {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        background-color: #ffffff;
        color: #64748b;
        padding: 0.55rem 1rem;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-modern-outline:hover {
        background-color: #f8fafc;
        color: #1e293b;
        border-color: #94a3b8;
    }

    /* ===================== Table Design Modernization ===================== */
    .title-decor-line {
        width: 4px;
        height: 18px;
        background-color: var(--indigo-primary);
        border-radius: 4px;
        display: inline-block;
    }
    .text-indigo-accent { color: var(--indigo-primary); }
    
    .projects-table thead th {
        background-color: #f8fafc;
        color: #64748b;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e2e8f0;
        padding: 12px 16px;
    }
    .projects-table tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: background-color 0.15s;
    }
    .projects-table tbody tr:hover { background-color: #f8fafc; }
    .projects-table td { padding: 1.1rem 12px; }

    .project-doc-link { 
        font-weight: 700; 
        color: #1e293b; 
        text-decoration: none;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .project-doc-link:hover { color: var(--indigo-primary); }
    
    .spec-page-badge {
        font-size: 0.75rem;
        background-color: #f1f5f9;
        color: #475569;
        padding: 2px 8px;
        border-radius: 6px;
        font-weight: 500;
    }
    
    .project-meta-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        font-size: 0.8rem;
        color: #64748b;
    }
    .project-meta-grid span i { margin-right: 4px; color: #94a3b8; }

    .badge-modern-overdue {
        background-color: #fef2f2;
        color: var(--danger-modern);
        font-weight: 600;
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 6px;
        border: 1px solid #fee2e2;
    }
    
    .bg-indigo-light { background-color: var(--indigo-light); }
    .text-indigo-dark { color: var(--indigo-dark); }

    /* ===================== Progress Metrics Mini-Dashboard ===================== */
    .project-progress-cell { min-width: 280px; }
    .progress-metric { margin-bottom: 0.5rem; }
    .progress-metric:last-child { margin-bottom: 0; }
    .progress-metric-head {
        display: flex;
        justify-content: space-between;
        font-size: 0.78rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 2px;
    }
    .progress-modern { 
        height: 5px !important; 
        border-radius: 50px; 
        background-color: #f1f5f9; 
    }
    .progress-modern .progress-bar { border-radius: 50px; }
    .progress-metric-detail {
        font-size: 0.72rem;
        color: #94a3b8;
        margin-top: 1px;
        display: flex;
        gap: 6px;
    }
    .progress-metric-detail .dot { color: #e2e8f0; }

    /* Modern Dynamic Progress Palette */
    .bg-modern-success { background-color: var(--success-modern) !important; }
    .text-modern-success { color: var(--success-modern) !important; }
    
    .bg-modern-warning { background-color: var(--warning-modern) !important; }
    .text-modern-warning { color: var(--warning-modern) !important; }
    
    .bg-modern-orange { background-color: var(--orange-modern) !important; }
    .text-modern-orange { color: var(--orange-modern) !important; }
    
    .bg-modern-danger { background-color: var(--danger-modern) !important; }
    .text-modern-danger { color: var(--danger-modern) !important; }

    /* Buttons */
    .btn-modern-primary {
        background-color: var(--indigo-primary);
        color: #ffffff;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        border: none;
        transition: background-color 0.2s;
    }
    .btn-modern-primary:hover {
        background-color: var(--indigo-hover);
        color: #ffffff;
    }

    .empty-state-modern {
        text-align: center;
        padding: 3.5rem 1rem !important;
        color: #94a3b8;
        font-weight: 500;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('filterSearch');
    var dateFrom = document.getElementById('filterDateFrom');
    var dateTo = document.getElementById('filterDateTo');
    var progressSelect = document.getElementById('filterProgress');
    var resetBtn = document.getElementById('filterReset');
    var countLabel = document.getElementById('filterCount');

    var rows = Array.prototype.slice.call(document.querySelectorAll('.project-row'));

    function applyFilters() {
        var term = searchInput.value.trim().toLowerCase();
        var from = dateFrom.value;
        var to = dateTo.value;
        var status = progressSelect.value;

        var visibleByPane = {};
        var totalVisible = 0;

        rows.forEach(function (row) {
            var visible = true;

            if (term) {
                var haystack = row.dataset.docno + ' ' + row.dataset.product + ' ' + row.dataset.customer + ' ' + row.dataset.person;
                if (haystack.indexOf(term) === -1) visible = false;
            }
            if (visible && from && row.dataset.duedate < from) visible = false;
            if (visible && to && row.dataset.duedate > to) visible = false;
            if (visible && status && row.dataset.status !== status) visible = false;

            row.style.display = visible ? '' : 'none';

            var pane = row.closest('.tab-pane');
            if (pane) {
                visibleByPane[pane.id] = (visibleByPane[pane.id] || 0) + (visible ? 1 : 0);
            }
            if (visible) totalVisible++;
        });

        document.querySelectorAll('.step-count').forEach(function (badge) {
            var paneId = badge.getAttribute('data-count-for');
            badge.textContent = visibleByPane[paneId] || 0;
        });

        document.querySelectorAll('.tab-pane').forEach(function (pane) {
            var hasDataRows = pane.querySelectorAll('.project-row').length > 0;
            var noMatchEl = pane.querySelector('.no-match-state');
            if (!noMatchEl) return;
            var visibleCount = visibleByPane[pane.id] || 0;
            noMatchEl.classList.toggle('d-none', !(hasDataRows && visibleCount === 0));
        });

        var hasAnyFilter = term || from || to || status;
        countLabel.textContent = hasAnyFilter ? ('พบ ' + totalVisible + ' รายการ') : '';
    }

    [searchInput, dateFrom, dateTo, progressSelect].forEach(function (el) {
        el.addEventListener('input', applyFilters);
        el.addEventListener('change', applyFilters);
    });

    resetBtn.addEventListener('click', function () {
        searchInput.value = '';
        dateFrom.value = '';
        dateTo.value = '';
        progressSelect.value = '';
        applyFilters();
    });

    applyFilters();
});
</script>
@endpush