@extends('layouts.main')
@section('content')
{{-- @push('styles') --}}
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}

<style>
    /* Custom Indigo Modern Theme */
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #e0e7ff;
        --text-dark: #1e1b4b;
        --border-radius-custom: 12px;
    }

    .custom-card {
        border: none;
        border-radius: var(--border-radius-custom);
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.1), 0 8px 10px -6px rgba(79, 70, 229, 0.1);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #6366f1, var(--indigo-primary));
        color: #ffffff;
        padding: 1.5rem;
        border-bottom: none;
    }

    .custom-card-header h5 {
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .doc-code {
        font-size: 0.85rem;
        opacity: 0.85;
        font-weight: 300;
    }

    .btn-indigo-add {
        background-color: #ffffff;
        color: var(--indigo-primary) !important;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none !important;
        border: none;
        cursor: pointer;
    }

    .btn-indigo-add:hover {
        background-color: var(--indigo-light);
        transform: translateY(-1px);
        box-shadow: 0 6px 12px -2px rgba(79, 70, 229, 0.2);
    }

    /* Toolbar for fast entry on large tables */
    .entry-toolbar {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.85rem 1rem;
    }

    .table-scroll-box {
        max-height: 65vh;
        overflow: auto;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
    }

    /* Table Styling */
    .modern-table {
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 0;
    }

    .modern-table thead th,
    .modern-table thead td {
        position: sticky;
        background-color: #f8fafc !important;
        color: #64748b;
        font-weight: 600;
        font-size: 0.82rem;
        letter-spacing: 0.4px;
        padding: 0.65rem 0.4rem !important;
        border-bottom: 1px solid #cbd5e1 !important;
        z-index: 5;
    }

    .modern-table thead tr:first-child th {
        top: 0;
        z-index: 6;
    }

    .modern-table thead tr:nth-child(2) td {
        top: 41px;
        z-index: 6;
    }

    .modern-table tbody tr {
        transition: background-color 0.15s ease;
    }

    .modern-table tbody tr:hover {
        background-color: #eef2ff;
    }

    .modern-table tbody tr.has-data {
        background-color: #f0fdf4;
    }

    .modern-table tbody tr.has-data:hover {
        background-color: #dcfce7;
    }

    .modern-table tbody td {
        padding: 0.4rem 0.35rem !important;
        vertical-align: middle !important;
        color: var(--text-dark);
        font-weight: 500;
        font-size: 0.85rem;
        border-bottom: 1px solid #e2e8f0 !important;
    }

    .modern-table .form-control-sm:focus {
        border-color: var(--indigo-primary);
        box-shadow: 0 0 0 0.15rem rgba(79, 70, 229, 0.25);
    }

    /* Action Buttons */
    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-action-delete {
        background-color: #fee2e2;
        color: #dc2626;
        border: none;
        cursor: pointer;
    }

    .btn-action-delete:hover {
        background-color: #fecaca;
        color: #b91c1c;
        transform: scale(1.05);
    }
</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div class="text-center text-md-left mb-3 mb-md-0">
                            <h5 class="m-0">ESSOM COMPANY LIMITED</h5>
                            <h5 class="m-0 font-weight-normal" style="font-size: 1.1rem; opacity: 0.9;">OVERALL PRODUCTION PLAN</h5>
                            <span class="doc-code">ฟอร์มเอกสาร: F8510.2 (9 Feb. 17)</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('company-limiteds.store') }}" method="POST">
                        @csrf
                        <div class="row g-3 mb-3 align-items-end">
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <label>FOR MONTH</label>
                                    <input class="form-control" type="month" name="for_month" value="{{ date('Y-m') }}">
                                </div>
                            </div>
                        </div>

                        <!-- แถบช่วยกรองและนำทางเมื่อมีหลายแถว -->
                        <div class="entry-toolbar mb-3">
                            <div class="row g-2 align-items-center justify-content-between">
                                <div class="col-md-5">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-white"><i class="fa fa-search text-muted"></i></span>
                                        <input type="text" id="productFilterInput" class="form-control" placeholder="ค้นหารหัส (Code) หรือชื่อสินค้า (Desc) เพื่อกรองแถว...">
                                        <button type="button" id="clearFilterBtn" class="btn btn-outline-secondary" title="ล้างคำค้นหา">ล้าง</button>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-center gap-3">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" id="onlyFilledToggle">
                                        <label class="form-check-label small" for="onlyFilledToggle">
                                            แสดงเฉพาะแถวที่กรอกข้อมูลแล้ว
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 text-md-end small text-muted">
                                    กรอกแล้ว: <strong id="filledCount" class="text-success">0</strong> / <span id="totalRowCount">{{ $hd->count() }}</span> แถว
                                    <div class="d-none d-lg-block" style="font-size: 0.75rem;">ใช้ปุ่ม ↑ ↓ ← → เลื่อนช่องได้</div>
                                </div>
                            </div>
                        </div>

                        <div class="table-scroll-box mb-4">
                            <table class="table table-bordered modern-table text-center align-middle" id="productTable">
                                <thead>
                                    <tr>
                                        <th colspan="2">PRODUCT</th>
                                        <th colspan="2">Min Stk.</th>
                                        <th rowspan="2" style="width: 6%">PDO</th>
                                        <th colspan="2">Cur Stk.</th>
                                        <th rowspan="2" style="width: 6%">ORD</th>
                                        <th rowspan="2" style="width: 6%">PTO</th>
                                        <th rowspan="2" style="width: 6%">PP</th>
                                        <th rowspan="2" style="width: 6%">JUN</th>
                                        <th rowspan="2" style="width: 6%">FEB</th>
                                        <th rowspan="2" style="width: 6%">MAR</th>
                                        <th rowspan="2" style="min-width: 110px;">
                                            APR-JUNE
                                            <input class="form-control form-control-sm mt-1" type="number" name="for_year" value="{{ date('Y') }}">
                                        </th>
                                        <th rowspan="2" style="width: 7%">
                                            <button type="button" class="btn-indigo-add btn-sm" id="addRowBtn">
                                                <i class="fa fa-plus"></i> เพิ่มแถว
                                            </button>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="width: 11%">Code</td>
                                        <td style="min-width: 180px;">Desc</td>
                                        <td style="width: 6%">Fin.</td>
                                        <td style="width: 6%">Semi</td>
                                        <td style="width: 6%">Fin.</td>
                                        <td style="width: 6%">Semi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($hd as $index => $item)
                                        <tr data-search="{{ strtolower(($item->ms_product_code ?? '') . ' ' . ($item->ms_product_name ?? '')) }}">
                                            <td>
                                                <input type="text" class="form-control form-control-sm grid-input" name="products[{{ $index }}][product_code]" value="{{ $item->ms_product_code }}" readonly tabindex="-1">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm text-start grid-input" name="products[{{ $index }}][product_desc]" value="{{ $item->ms_product_name }}" readonly tabindex="-1">
                                            </td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[{{ $index }}][min_fin]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[{{ $index }}][min_semi]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[{{ $index }}][pdo]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[{{ $index }}][cur_fin]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[{{ $index }}][cur_semi]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[{{ $index }}][ord]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[{{ $index }}][pto]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[{{ $index }}][pp]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[{{ $index }}][jun]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[{{ $index }}][feb]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[{{ $index }}][mar]"></td>
                                            <td><input type="text" class="form-control form-control-sm track-input grid-input" name="products[{{ $index }}][apr_jun]"></td>
                                            <td>
                                                <button type="button" class="btn btn-action btn-action-delete remove-row" title="ลบแถว" tabindex="-1">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr data-search="">
                                            <td><input type="text" class="form-control form-control-sm grid-input" name="products[0][product_code]"></td>
                                            <td><input type="text" class="form-control form-control-sm grid-input" name="products[0][product_desc]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[0][min_fin]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[0][min_semi]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[0][pdo]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[0][cur_fin]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[0][cur_semi]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[0][ord]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[0][pto]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[0][pp]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[0][jun]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[0][feb]"></td>
                                            <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[0][mar]"></td>
                                            <td><input type="text" class="form-control form-control-sm track-input grid-input" name="products[0][apr_jun]"></td>
                                            <td>
                                                <button type="button" class="btn btn-action btn-action-delete remove-row" title="ลบแถว" tabindex="-1">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-muted small">Min Stk Fin=Minimum Stock Finish , Min Stk Semi=Minimum Stock Semi , PDO=Production Order , Cur Stk Fin=Currency Stock Finish , Cur Stk Semi=Current Stock Semi , ORD=Order , PTO=Potential Order , PP=Production Plan</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Prepared By</label>
                                    <input class="form-control" type="text" name="prepared_by" value="{{ auth()->user()->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control" type="date" name="prepared_date" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Checked By</label>
                                    <input class="form-control" type="text" name="checked_by" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control" type="date" name="checked_date" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Approved By</label>
                                    <input class="form-control" type="text" name="approved_by" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control" type="date" name="approved_date" value="">
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-indigo-add px-4 py-2">บันทึกข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let rowIndex = {{ max($hd->count(), 1) }};
        const table = document.querySelector('#productTable');
        const tbody = table.querySelector('tbody');
        const filterInput = document.getElementById('productFilterInput');
        const clearFilterBtn = document.getElementById('clearFilterBtn');
        const onlyFilledToggle = document.getElementById('onlyFilledToggle');
        const filledCountEl = document.getElementById('filledCount');
        const totalRowCountEl = document.getElementById('totalRowCount');

        function updateRowStatusAndStats() {
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const keyword = (filterInput.value || '').trim().toLowerCase();
            const onlyFilled = onlyFilledToggle.checked;

            let filledCount = 0;

            rows.forEach(row => {
                const trackedInputs = Array.from(row.querySelectorAll('.track-input'));
                const hasValue = trackedInputs.some(inp => String(inp.value ?? '').trim() !== '');

                row.classList.toggle('has-data', hasValue);
                if (hasValue) filledCount++;

                const codeVal = (row.querySelector('input[name$="[product_code]"]')?.value || '').toLowerCase();
                const descVal = (row.querySelector('input[name$="[product_desc]"]')?.value || '').toLowerCase();
                const searchText = (row.getAttribute('data-search') || '') + ' ' + codeVal + ' ' + descVal;

                const matchesKeyword = !keyword || searchText.includes(keyword);
                const matchesFilled = !onlyFilled || hasValue;

                row.style.display = (matchesKeyword && matchesFilled) ? '' : 'none';
            });

            filledCountEl.textContent = filledCount;
            totalRowCountEl.textContent = rows.length;
        }

        // ไฮไลต์ข้อความทั้งหมดเมื่อโฟกัสช่องกรอก เพื่อให้พิมพ์ทับได้ทันที
        table.addEventListener('focusin', function (e) {
            if (e.target.matches('input[type="number"], input[type="text"]:not([readonly])')) {
                setTimeout(() => e.target.select(), 0);
            }
        });

        // อัปเดตสถานะแถวที่กรอกแล้วแบบเรียลไทม์
        table.addEventListener('input', function (e) {
            if (e.target.classList.contains('track-input')) {
                updateRowStatusAndStats();
            }
        });

        // ค้นหากรองแถว & สลับดูเฉพาะแถวที่กรอกแล้ว
        filterInput.addEventListener('input', updateRowStatusAndStats);
        clearFilterBtn.addEventListener('click', function () {
            filterInput.value = '';
            updateRowStatusAndStats();
            filterInput.focus();
        });
        onlyFilledToggle.addEventListener('change', updateRowStatusAndStats);

        // เลื่อนช่องกรอกด้วยปุ่มลูกศรขึ้น/ลง/ซ้าย/ขวา
        table.addEventListener('keydown', function (e) {
            if (!e.target.classList.contains('grid-input')) return;

            const currentCell = e.target.closest('td');
            const currentRow = e.target.closest('tr');
            if (!currentCell || !currentRow) return;

            const cellIndex = Array.from(currentRow.children).indexOf(currentCell);

            if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                e.preventDefault();
                const visibleRows = Array.from(tbody.querySelectorAll('tr')).filter(r => r.style.display !== 'none');
                const currentPos = visibleRows.indexOf(currentRow);
                const nextPos = e.key === 'ArrowDown' ? currentPos + 1 : currentPos - 1;

                if (nextPos >= 0 && nextPos < visibleRows.length) {
                    const targetInput = visibleRows[nextPos].children[cellIndex]?.querySelector('input:not([readonly])');
                    if (targetInput) {
                        targetInput.focus();
                        targetInput.select();
                    }
                }
            } else if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
                // เลื่อนไปช่องข้างๆ เมื่อเคอร์เซอร์อยู่ต้น/ท้ายข้อความ หรือเป็น input type="number"
                const isNumber = e.target.type === 'number';
                const atStart = isNumber || e.target.selectionStart === 0;
                const atEnd = isNumber || e.target.selectionEnd === e.target.value.length;

                if ((e.key === 'ArrowLeft' && atStart) || (e.key === 'ArrowRight' && atEnd)) {
                    const delta = e.key === 'ArrowRight' ? 1 : -1;
                    let idx = cellIndex + delta;
                    while (idx >= 0 && idx < currentRow.children.length) {
                        const candidate = currentRow.children[idx].querySelector('input:not([readonly])');
                        if (candidate) {
                            e.preventDefault();
                            candidate.focus();
                            candidate.select();
                            break;
                        }
                        idx += delta;
                    }
                }
            }
        });

        // กดปุ่มเพิ่มแถว
        document.getElementById('addRowBtn').addEventListener('click', function () {
            const newRow = `
                <tr data-search="">
                    <td><input type="text" class="form-control form-control-sm grid-input" name="products[${rowIndex}][product_code]"></td>
                    <td><input type="text" class="form-control form-control-sm grid-input" name="products[${rowIndex}][product_desc]"></td>
                    <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[${rowIndex}][min_fin]"></td>
                    <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[${rowIndex}][min_semi]"></td>
                    <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[${rowIndex}][pdo]"></td>
                    <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[${rowIndex}][cur_fin]"></td>
                    <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[${rowIndex}][cur_semi]"></td>
                    <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[${rowIndex}][ord]"></td>
                    <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[${rowIndex}][pto]"></td>
                    <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[${rowIndex}][pp]"></td>
                    <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[${rowIndex}][jun]"></td>
                    <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[${rowIndex}][feb]"></td>
                    <td><input type="number" step="any" class="form-control form-control-sm text-end track-input grid-input" name="products[${rowIndex}][mar]"></td>
                    <td><input type="text" class="form-control form-control-sm track-input grid-input" name="products[${rowIndex}][apr_jun]"></td>
                    <td>
                        <button type="button" class="btn btn-action btn-action-delete remove-row" title="ลบแถว" tabindex="-1">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.insertAdjacentHTML('beforeend', newRow);
            rowIndex++;
            updateRowStatusAndStats();
        });

        // กดปุ่มลบแถว
        table.addEventListener('click', function (e) {
            if (e.target.closest('.remove-row')) {
                const row = e.target.closest('tr');
                if (tbody.querySelectorAll('tr').length > 1) {
                    row.remove();
                    updateRowStatusAndStats();
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'ไม่สามารถลบได้',
                        text: 'ต้องมีข้อมูลสินค้าอย่างน้อย 1 แถว',
                        confirmButtonColor: '#4f46e5'
                    });
                }
            }
        });

        updateRowStatusAndStats();
    });
</script>
@endpush