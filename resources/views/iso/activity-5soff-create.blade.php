@extends('layouts.main')
@section('content')
<!-- SweetAlert2 Resource -->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Theme Styles for Objective Table */
    .objective-container {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        padding: 1.5rem 0;
    }
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.05) !important;
        background: #ffffff;
        overflow: hidden;
    }
    .card-header {
        background: #ffffff !important;
        padding: 1.75rem 2rem !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .company-title {
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 1px;
        color: #6366f1;
        margin-bottom: 0.35rem;
        text-transform: uppercase;
    }
    .main-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }
    .doc-code {
        font-size: 0.85rem;
        color: #64748b;
        background: #f8fafc;
        padding: 0.5rem 0.85rem;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        display: inline-block;
    }

    /* Table Customization */
    .card-body {
        padding: 1.75rem 2rem !important;
    }
    .table-responsive {
        border-radius: 12px;
        overflow: auto;
        border: 1px solid #e2e8f0;
        width: 100%;
    }
    .table-modern-form thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 1rem 0.75rem !important;
        font-size: 0.875rem;
        vertical-align: middle !important;
        white-space: nowrap;
    }
    .table-modern-form tbody td {
        padding: 0.9rem 0.75rem !important;
        vertical-align: middle !important;
        color: #334155;
        font-size: 0.875rem;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .category-cell {
        background-color: #fafbfc;
        font-weight: 600;
        color: #1e293b !important;
        text-align: left !important;
        padding-left: 1rem !important;
    }
    
    /* Form Controls */
    .form-group label {
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }
    .form-control {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }
    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    .score-input {
        text-align: center;
        font-weight: 600;
    }
    .btn-submit {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        padding: 0.75rem 2rem !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25) !important;
        border: none !important;
        transition: all 0.2s ease !important;
    }
    .btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4) !important;
    }
</style>

<div class="objective-container">
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <form action="{{ route('activity-5soffs.store') }}" method="POST">
                    @csrf
                    
                    <div class="card-header">
                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-start gap-3">
                            <div>
                                <div class="company-title">ESSOM CO., LTD.</div>
                                <h5 class="main-title">
                                    การตรวจพื้นที่ประจำเดือน (สำนักงาน)
                                </h5>
                                <span class="doc-code"><i class="ri-file-text-line me-1"></i> ฟอร์มเอกสาร: GF113.2-O (20 Feb. 19)</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">            
                        <!-- แสดง Error ถ้ามี -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>หน่วยงานและชั้นที่ถูกตรวจ <span class="text-danger">*</span></label>
                                    <select class="form-control" name="activitysoff_master_hds_id" id="masterSelect" required>
                                        <option value="">กรุณาเลือกหน่วยงาน</option>
                                        @foreach ($hd as $item)
                                            <option value="{{ $item->activitysoff_master_hds_id }}">
                                                {{ $item->department_name }} (ชั้น {{ $item->floor }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-modern-form text-center align-middle mb-0" id="destroyTable">
                                <thead>
                                    <tr>
                                        <th style="width: 20%;">พื้นที่ตรวจเช็ค</th>
                                        <th style="width: 8%;">ข้อ</th>
                                        <th style="width: 47%;">รายละเอียด</th>
                                        <th style="width: 10%;">เต็ม</th>
                                        <th style="width: 15%;">คะแนน (1-5)</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <tr>
                                        <td colspan="5" class="text-muted py-4">กรุณาเลือกหน่วยงานและชั้นที่ถูกตรวจด้านบนเพื่อแสดงรายการตรวจสอบ</td>
                                    </tr>
                                </tbody>
                                <tfoot id="tableFoot" style="display: none;">
                                    <tr class="bg-light">
                                        <td colspan="3" class="text-start ps-3">
                                            <small class="text-muted"><strong>เกณฑ์การให้คะแนน:</strong> 5 = ดีมาก , 4 = ดี , 3 = พอใช้ , 2 = ควรปรับปรุง , 1 = แย่มาก</small>
                                        </td>
                                        <td class="text-center fw-bold text-dark">คะแนนเต็ม<br><span id="maxScoreText">0</span></td>
                                        <td>
                                            <div class="input-group input-group-sm mb-1">
                                                <input type="text" id="total_score" class="form-control score-input bg-white fw-bold text-primary" readonly value="0">
                                                <span class="input-group-text">คะแนน</span>
                                            </div>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="percent_score" class="form-control score-input bg-white fw-bold text-success" readonly value="0.00">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>จุดเด่นจากการตรวจพื้นที่</label>
                                    <textarea class="form-control" rows="3" placeholder="ระบุจุดเด่น..." name="strength">{{ old('strength') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>จุดด้อยจากการตรวจพื้นที่</label>
                                    <textarea class="form-control" rows="3" placeholder="ระบุจุดด้อย..." name="weakness">{{ old('weakness') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>ข้อเสนอแนะจากการตรวจพื้นที่</label>
                                    <textarea class="form-control" rows="3" placeholder="ระบุข้อเสนอแนะ..." name="suggestion">{{ old('suggestion') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 bg-light p-3 rounded-3 mx-0 mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>กรรมการตรวจให้คะแนน (ท่านที่ 1) <span class="text-danger">*</span></label>
                                    <input class="form-control bg-white" type="text" name="auditor_1" value="{{ old('auditor_1', auth()->user()->name ?? '') }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>กรรมการตรวจให้คะแนน (ท่านที่ 2)</label>
                                    <input class="form-control bg-white" type="text" name="auditor_2" value="{{ old('auditor_2') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>วันที่ตรวจ <span class="text-danger">*</span></label>
                                    <input class="form-control bg-white" type="date" name="audit_date" value="{{ old('audit_date', date('Y-m-d')) }}" required>
                                </div>
                            </div>
                        </div> 

                        <!-- ปุ่มบันทึกข้อมูล -->
                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-submit">
                                <i class="ri-save-line me-1"></i> บันทึกผลการตรวจพื้นที่
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
const mastersData = @json($hd);

document.addEventListener('DOMContentLoaded', function () {
    const masterSelect = document.getElementById('masterSelect');
    const tableBody = document.getElementById('tableBody');
    const tableFoot = document.getElementById('tableFoot');
    const maxScoreText = document.getElementById('maxScoreText');

    masterSelect.addEventListener('change', function () {
        const selectedId = this.value;
        tableBody.innerHTML = '';

        if (!selectedId) {
            tableBody.innerHTML = `<tr><td colspan="5" class="text-muted py-4">กรุณาเลือกหน่วยงานและชั้นที่ถูกตรวจด้านบนเพื่อแสดงรายการตรวจสอบ</td></tr>`;
            tableFoot.style.display = 'none';
            return;
        }

        const selectedMaster = mastersData.find(m => m.activitysoff_master_hds_id == selectedId);

        if (!selectedMaster || !selectedMaster.details || selectedMaster.details.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="5" class="text-danger py-4">ไม่พบรายการตรวจสอบในหน่วยงานนี้</td></tr>`;
            tableFoot.style.display = 'none';
            return;
        }

        // จัดกลุ่ม Details ตามหมวดหมู่หลัก (เช่น '1.1' -> '1')
        const groups = {};
        selectedMaster.details.forEach(detail => {
            const mainGroupKey = detail.code ? detail.code.split('.')[0] : '1';
            if (!groups[mainGroupKey]) {
                groups[mainGroupKey] = [];
            }
            groups[mainGroupKey].push(detail);
        });

        const categoryLabels = {
            '1': {
                name: '1. บริเวณทำงาน',
                sub: 'ตึกงานบริหารงานขายอุปกรณ์อุตสาหกรรมและงานขายอุปกรณ์การศึกษา'
            },
            '2': {
                name: '2. พื้นที่ส่วนกลาง',
                sub: 'ตรวจงานบริหาร'
            },
            '3': {
                name: '3. สโตร์ และ Shop พ่นสี',
                sub: 'ตรวจงานบริหารและงานขายอุปกรณ์อุตสาหกรรม'
            }
        };

        let html = '';
        let totalMaxScore = 0;
        let globalIndex = 0;

        Object.keys(groups).sort().forEach(groupKey => {
            const groupItems = groups[groupKey];
            const categoryInfo = categoryLabels[groupKey] || {
                name: `${groupKey}. พื้นที่ตรวจเช็ค`,
                sub: ''
            };

            groupItems.forEach((detail, idx) => {
                let score = parseInt(detail.score) || 0; // แปลงคะแนนเป็นตัวเลข
                totalMaxScore += score; // สะสมคะแนนเต็มรวม

                html += `<tr>`;

                if (idx === 0) {
                    html += `
                        <td rowspan="${groupItems.length}" class="category-cell align-middle">
                            ${categoryInfo.name}
                            ${categoryInfo.sub ? `<br><small class="text-muted fw-normal">${categoryInfo.sub}</small>` : ''}
                        </td>
                    `;
                }

                html += `
                    <td>
                        ${detail.code}
                        <input type="hidden" name="items[${globalIndex}][activitysoff_master_dts_id]" value="${detail.activitysoff_master_dts_id}">
                    </td>
                    <td class="text-start"  style="text-align: left; padding-left: 1rem !important;">${detail.detail}</td>
                    <td>${score > 0 ? score : '-'}</td>
                    <td>
                `;

                // ถ้าคะแนนเต็มมากกว่า 0 ให้แสดงช่อง Input คะแนนปกติ แต่ถ้าคะแนนเต็มเป็น 0 ไม่ต้องแสดงช่อง Input
                if (score > 0) {
                    html += `
                        <input type="number" class="form-control score-input" name="items[${globalIndex}][score]" value="5" min="1" max="5" required>
                    `;
                } else {
                    html += `
                        <input type="hidden" name="items[${globalIndex}][score]" value="0">
                        <span class="text-muted">-</span>
                    `;
                }

                html += `
                    </td>
                </tr>`;

                globalIndex++;
            });
        });

        tableBody.innerHTML = html;
        maxScoreText.textContent = totalMaxScore;
        tableFoot.style.display = '';

        initScoreCalculation(totalMaxScore);
    });

    function initScoreCalculation(maxScore) {
        const scoreInputs = document.querySelectorAll('.score-input');
        const totalScoreInput = document.getElementById('total_score');
        const percentScoreInput = document.getElementById('percent_score');

        function calculateTotal() {
            let total = 0;
            scoreInputs.forEach(input => {
                let val = parseInt(input.value);
                if (!isNaN(val) && val >= 1 && val <= 5) {
                    total += val;
                }
            });
            
            totalScoreInput.value = total;
            let percent = maxScore > 0 ? (total / maxScore) * 100 : 0;
            percentScoreInput.value = percent.toFixed(2);
        }

        scoreInputs.forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
                let val = parseInt(this.value);

                if (this.value.length > 1) {
                    this.value = this.value.slice(-1);
                    val = parseInt(this.value);
                }

                if (val > 5) {
                    this.value = 5;
                } else if (val === 0) {
                    this.value = '';
                }

                calculateTotal();
            });

            input.addEventListener('keydown', function(e) {
                if (['e', 'E', '+', '-', '.'].includes(e.key)) {
                    e.preventDefault();
                }
            });
        });

        calculateTotal();
    }
});
</script>
@endpush