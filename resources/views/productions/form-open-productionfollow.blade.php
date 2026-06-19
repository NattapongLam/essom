@extends('layouts.main')
@section('content')

@php
    // ===================== Helper functions (ประกาศครั้งเดียวบนสุดของไฟล์) =====================

    // แปลงค่าชั่วโมง.นาที ตามกฎปัดเศษเดิม (.10/.20 -> .30, .50 -> ปัดเป็นชั่วโมงถัดไป, >=60 -> ปัดขึ้น 1 ชม. เศษ .30)
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

    // คืนคลาสสีของแถบ progress ตามเปอร์เซ็นต์ (เขียว/เหลือง/ส้ม/แดง)
    if (!function_exists('pd_progress_meta')) {
        function pd_progress_meta($percent) {
            $percent = (float) $percent;
            if ($percent < 50) {
                return ['bg-success', 'text-success'];
            } elseif ($percent <= 69) {
                return ['bg-warning', 'text-warning-dark'];
            } elseif ($percent <= 99) {
                return ['bg-orange', 'text-orange'];
            }
            return ['bg-danger', 'text-danger'];
        }
    }

    // โครงสร้างของ 4 ขั้นตอน ใช้ loop เดียวเพื่อ render ทั้ง nav pill และ tab pane (ไม่ต้องเขียนซ้ำ 4 ชุด)
    $steps = [
        ['key' => 'step1', 'icon' => 'fas fa-folder-open', 'nav_title' => '1. เปิดงาน', 'table_title' => 'รายการโปรเจกต์ (เปิดงาน)', 'data' => $hd1],
        ['key' => 'step2', 'icon' => 'fas fa-tools', 'nav_title' => '2. กำลังผลิต', 'table_title' => 'รายการโปรเจกต์ (กำลังผลิต)', 'data' => $hd2],
        ['key' => 'step3', 'icon' => 'fas fa-vial', 'nav_title' => '3. ทดสอบ', 'table_title' => 'รายการโปรเจกต์ (ทดสอบ)', 'data' => $hd3],
        ['key' => 'step4', 'icon' => 'fas fa-check-circle', 'nav_title' => '4. เสนอปิดงาน', 'table_title' => 'รายการโปรเจกต์ (เสนอปิดงาน)', 'data' => $hd4],
    ];
@endphp

<div class="mt-4">
<div class="row">
    <div class="col-12">

        {{-- ===================== STEP NAV ===================== --}}
        <div class="card mb-3">
            <div class="card-body p-3">
                <ul class="nav nav-pills nav-justified steps-container" id="projectSteps" role="tablist">
                    @foreach ($steps as $i => $step)
                        <li class="nav-item">
                            <a class="nav-link py-3 {{ $i === 0 ? 'active' : '' }}"
                               id="{{ $step['key'] }}-tab"
                               data-toggle="tab"
                               href="#{{ $step['key'] }}"
                               role="tab"
                               aria-controls="{{ $step['key'] }}"
                               aria-selected="{{ $i === 0 ? 'true' : 'false' }}">
                                <div class="step-icon mb-1"><i class="{{ $step['icon'] }} fa-lg"></i></div>
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
        <div class="card mb-3 filter-card">
            <div class="card-body">
                <div class="filter-head">
                    <i class="fas fa-filter"></i> ตัวกรองข้อมูล
                    <span id="filterCount" class="filter-result-count"></span>
                </div>
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-lg-4">
                        <label class="form-label small text-muted mb-1">ค้นหา</label>
                        <div class="search-input">
                            <i class="fas fa-magnifying-glass"></i>
                            <input type="text" id="filterSearch" class="form-control" placeholder="เลขที่งาน, สินค้า, ลูกค้า, ผู้เปิดงาน">
                        </div>
                    </div>
                    <div class="col-6 col-lg-2">
                        <label class="form-label small text-muted mb-1">กำหนดส่งจากวันที่</label>
                        <input type="date" id="filterDateFrom" class="form-control">
                    </div>
                    <div class="col-6 col-lg-2">
                        <label class="form-label small text-muted mb-1">ถึงวันที่</label>
                        <input type="date" id="filterDateTo" class="form-control">
                    </div>
                    <div class="col-6 col-lg-2">
                        <label class="form-label small text-muted mb-1">สถานะความคืบหน้า</label>
                        <select id="filterProgress" class="form-select">
                            <option value="">ทั้งหมด</option>
                            <option value="normal">ปกติ (&lt; 50%)</option>
                            <option value="warning">เฝ้าระวัง (50–69%)</option>
                            <option value="high">เร่งด่วน (70–99%)</option>
                            <option value="overdue">เกินกำหนด (≥ 100%)</option>
                        </select>
                    </div>
                    <div class="col-6 col-lg-2">
                        <label class="form-label small text-muted mb-1">&nbsp;</label>
                        <button type="button" id="filterReset" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-rotate-left"></i> ล้างตัวกรอง
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===================== TAB CONTENT (loop เดียว render ทั้ง 4 แท็บ) ===================== --}}
        <div class="tab-content" id="projectStepsContent">
            @foreach ($steps as $i => $step)
                <div class="tab-pane fade {{ $i === 0 ? 'show active' : '' }}" id="{{ $step['key'] }}" role="tabpanel" aria-labelledby="{{ $step['key'] }}-tab">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h3 class="card-title"><i class="{{ $step['icon'] }} me-2"></i> {{ $step['table_title'] }}</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped projects mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">Deadline</th>
                                            <th style="width: 30%">Project Name</th>
                                            <th class="text-center">Progress</th>
                                            <th style="width: 10%" class="text-center">Status</th>
                                            <th style="width: 10%"></th>
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

                                                // รวมเมตริกทั้ง 5 ไว้ใน array เดียว แล้ว loop render ครั้งเดียว (ไม่ซ้ำ 5 บล็อก)
                                                $metrics = [
                                                    ['label' => 'Project',     'icon' => 'fas fa-bolt',                 'percent' => $item->timeper,    'planned' => pd_format_hm($item->totaltime),               'actual' => pd_format_hm($item->mantime)],
                                                    ['label' => 'Machine',     'icon' => 'fas fa-bolt',                 'percent' => $item->mach_per,   'planned' => number_format($item->machinetime, 2),         'actual' => number_format($item->mach_totals, 2)],
                                                    ['label' => 'Electricity', 'icon' => 'fas fa-bolt',                 'percent' => $item->elect_per,  'planned' => number_format($item->electricitytime, 2),     'actual' => number_format($item->elect_totals, 2)],
                                                    ['label' => 'Paint',       'icon' => 'fas fa-bolt',                 'percent' => $item->paint_per,  'planned' => number_format($item->painttime, 2),           'actual' => number_format($item->paint_totals, 2)],
                                                    ['label' => 'Assembly',    'icon' => 'fas fa-bolt',                 'percent' => $item->assembly_per,'planned' => number_format($item->assemblytime, 2),        'actual' => number_format($item->assembly_totals, 2)],
                                                ];
                                            @endphp
                                            <tr class="project-row"
                                                data-docno="{{ strtolower($item->productionopenjob_hd_docuno) }}"
                                                data-product="{{ strtolower($item->ms_product_name . ' ' . $item->ms_product_code) }}"
                                                data-customer="{{ strtolower($item->ms_customer_name) }}"
                                                data-person="{{ strtolower($item->created_person) }}"
                                                data-duedate="{{ $dueDate->format('Y-m-d') }}"
                                                data-progress="{{ $item->timeper }}"
                                                data-status="{{ $statusKey }}">
                                                <td class="project-deadline">
                                                    <div class="fw-semibold">{{ $dueDate->format('d/m/Y') }}</div>
                                                    @if($isOverdue)
                                                        <span class="badge badge-overdue mt-1"><i class="fas fa-triangle-exclamation"></i> เลยกำหนด</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('pd-follow.show', $item->productionopenjob_hd_docuno) }}" class="project-doc-link">
                                                        {{ $item->productionopenjob_hd_docuno }}
                                                        <span class="text-muted fw-normal">(Spec Page {{ $item->ms_specpage_name }})</span>
                                                    </a>
                                                    <div class="project-meta">
                                                        <span><i class="fas fa-box me-1"></i> {{ $item->ms_product_name }}</span>
                                                        <span><i class="fas fa-user-tie me-1"></i> ลูกค้า: {{ $item->ms_customer_name }}</span>
                                                        <span><i class="fas fa-user me-1"></i> ผู้เปิดงาน: {{ $item->created_person }}</span>
                                                    </div>
                                                </td>
                                                <td class="project-progress-cell">
                                                    @foreach ($metrics as $metric)
                                                        @php
                                                            [$barClass, $textClass] = pd_progress_meta($metric['percent']);
                                                            $width = min((float) $metric['percent'], 100);
                                                        @endphp
                                                        <div class="progress-metric">
                                                            <div class="progress-metric-head">
                                                                <span class="progress-metric-label"><i class="{{ $metric['icon'] }} me-1"></i>{{ $metric['label'] }}</span>
                                                                <span class="progress-metric-percent {{ $textClass }}">{{ number_format((float) $metric['percent'], 2) }}%</span>
                                                            </div>
                                                            <div class="progress progress-sm">
                                                                <div class="progress-bar {{ $barClass }}"
                                                                     role="progressbar"
                                                                     aria-valuenow="{{ $metric['percent'] }}"
                                                                     aria-valuemin="0"
                                                                     aria-valuemax="100"
                                                                     style="width: {{ $width }}%"></div>
                                                            </div>
                                                            <div class="progress-metric-detail">
                                                                <span>ตั้งไว้ <strong>{{ $metric['planned'] }}</strong></span>
                                                                <span class="dot">•</span>
                                                                <span>จริง <strong>{{ $metric['actual'] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td class="project-state text-center">
                                                    <span class="badge bg-success p-2">{{ $item->productionopenjob_status_name }}</span>
                                                </td>
                                                <td class="project-actions text-end">
                                                    <a class="btn btn-primary btn-sm" href="{{ route('pd-follow.show', $item->productionopenjob_hd_docuno) }}">
                                                        <i class="fas fa-folder"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="5" class="empty-state">ไม่มีรายการในขั้นตอนนี้</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="no-match-state d-none">ไม่พบรายการที่ตรงกับตัวกรองที่เลือก</div>
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
    /* ===================== Step nav ===================== */
    .steps-container .nav-link {
        border-radius: 10px !important;
        color: #6c757d;
        background-color: #f8f9fa;
        border: 1px solid #e3e6ea;
        transition: all .18s ease-in-out;
    }
    .steps-container .nav-link:hover {
        background-color: #eef1f4;
        color: #3f6791;
    }
    .steps-container .nav-link.active {
        background-color: #3f6791 !important;
        color: #fff !important;
        border-color: #3f6791;
        box-shadow: 0 6px 14px rgba(63, 103, 145, .25);
    }
    .step-icon { font-size: 1.2rem; }
    .step-title { font-weight: 600; }
    .step-count {
        background: rgba(255,255,255,.65);
        color: #3f6791;
        border-radius: 50px;
        font-size: .8rem;
        padding: .2em .55em;
        margin-left: .25rem;
    }
    .nav-link.active .step-count { background: rgba(255,255,255,.25); color: #fff; }

    /* ===================== Filter bar ===================== */
    .filter-card { border: 1px solid #e3e6ea; }
    .filter-head {
        font-weight: 600;
        color: #4b545c;
        margin-bottom: .75rem;
        display: flex;
        align-items: center;
        gap: .4rem;
    }
    .filter-result-count {
        margin-left: auto;
        font-weight: 400;
        font-size: .85rem;
        color: #8a929a;
    }
    .search-input { position: relative; }
    .search-input i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        font-size: .85rem;
    }
    .search-input input { padding-left: 32px; }

    /* ===================== Card / table polish ===================== */
    .card-title {
        font-weight: 700;
        color: #4b545c;
        margin-bottom: 0;
    }
    table.projects thead th {
        background-color: #f8f9fa;
        color: #6c757d;
        font-size: .78rem;
        text-transform: uppercase;
        letter-spacing: .03em;
        border-bottom: 2px solid #e9ecef;
        white-space: nowrap;
    }
    table.projects tbody tr:hover { background-color: #f4f7fa; }
    table.projects td { vertical-align: top; padding: 1rem .9rem; }

    .project-doc-link { font-weight: 600; color: #2c3e50; text-decoration: none; }
    .project-doc-link:hover { color: #3f6791; text-decoration: underline; }
    .project-meta {
        margin-top: .35rem;
        display: flex;
        flex-direction: column;
        gap: .15rem;
        font-size: .82rem;
        color: #8a929a;
    }
    .badge-overdue {
        background-color: #fdecea;
        color: #c0392b;
        font-weight: 600;
        font-size: .72rem;
        display: inline-block;
    }

    /* ===================== Progress metrics ===================== */
    .project-progress-cell { min-width: 260px; }
    .progress-metric { margin-bottom: .65rem; }
    .progress-metric:last-child { margin-bottom: 0; }
    .progress-metric-head {
        display: flex;
        justify-content: space-between;
        font-size: .8rem;
        font-weight: 600;
        color: #4b545c;
        margin-bottom: .2rem;
    }
    .progress-metric-percent { font-weight: 700; }
    .progress-metric .progress { height: 7px; border-radius: 50px; background-color: #eef0f2; }
    .progress-metric .progress-bar { border-radius: 50px; }
    .progress-metric-detail {
        font-size: .74rem;
        color: #9aa1a8;
        margin-top: .2rem;
        display: flex;
        gap: .4rem;
    }
    .progress-metric-detail .dot { color: #d4d8db; }
    .bg-orange { background-color: #fd7e14 !important; }
    .text-orange { color: #fd7e14 !important; }
    .text-warning-dark { color: #b8860b !important; }

    .empty-state, .no-match-state {
        text-align: center;
        padding: 2.5rem 1rem;
        color: #adb5bd;
        font-size: .9rem;
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