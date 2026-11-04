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
                <form action="{{ route('activity-5soffs.update', $hd->activitys_off_hds_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-header">
                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-start gap-3">
                            <div>
                                <div class="company-title">ESSOM CO., LTD.</div>
                                <h5 class="main-title">
                                    การตรวจพื้นที่ประจำเดือน (สำนักงาน) - แก้ไขข้อมูล
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>หน่วยงานที่ถูกตรวจ <span class="text-danger">*</span></label>
                                    <input class="form-control @error('department_name') is-invalid @enderror" type="text" name="department_name" value="{{ old('department_name', $hd->department_name) }}" placeholder="ระบุหน่วยงานที่ถูกตรวจ" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ชั้นที่ถูกตรวจ <span class="text-danger">*</span></label>
                                    <input class="form-control @error('floor') is-invalid @enderror" type="text" name="floor" value="{{ old('floor', $hd->floor) }}" placeholder="ระบุชั้นที่ถูกตรวจ" required>
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
                                <tbody>
                                    @php
                                        // 1. ดึงคะแนนเก่าที่เคยบันทึกไว้ในตาราง Detail ของ Transaction นี้
                                        $savedScores = $hd->details->pluck('score', 'item_code')->toArray();

                                        // 2. ดึงข้อมูล Master Details ที่ตรงกับ Department และ Floor ของ Header นี้
                                        $masterDetails = \App\Models\ActivitysoffMasterDt::whereHas('header', function($q) use ($hd) {
                                            $q->where('department_name', $hd->department_name)
                                            ->where('floor', $hd->floor);
                                        })->orderBy('code')->get(); // <--- อย่าลืมใส่ ->get() ตรงนี้ครับ

                                        // จัดกลุ่มตามหมวดหมู่หลัก (ดูจากตัวเลขตัวแรกของ code เช่น 1.1 -> หมวด 1)
                                        $groupedDetails = $masterDetails->groupBy(function($item) {
                                            return explode('.', $item->code)[0];
                                        });

                                        $categoryLabels = [
                                            '1' => ['name' => 'บริเวณทำงาน', 'sub' => 'ตึกงานบริหารงานขายอุปกรณ์อุตสาหกรรมและงานขายอุปกรณ์การศึกษา'],
                                            '2' => ['name' => 'พื้นที่ส่วนกลาง', 'sub' => 'ตรวจงานบริหาร'],
                                            '3' => ['name' => 'สโตร์ และ Shop พ่นสี', 'sub' => 'ตรวจงานบริหารและงานขายอุปกรณ์อุตสาหกรรม']
                                        ];

                                        $globalIndex = 0;
                                        $totalMaxScore = 0;
                                    @endphp

                                    @foreach ($groupedDetails as $groupKey => $items)
                                        @php
                                            $catInfo = $categoryLabels[$groupKey] ?? ['name' => 'พื้นที่ตรวจเช็คอื่นๆ', 'sub' => ''];
                                        @endphp
                                        @foreach ($items as $idx => $detail)
                                            @php
                                                $scoreVal = $savedScores[$detail->code] ?? '';
                                                $maxScore = $detail->score;
                                                $totalMaxScore += intval($maxScore);
                                            @endphp
                                            <tr>
                                                @if ($idx === 0)
                                                    <td rowspan="{{ $items->count() }}" class="category-cell align-middle">
                                                        {{ $groupKey }}. {{ $catInfo['name'] }}
                                                        <br><small class="text-muted fw-normal">{{ $catInfo['sub'] }}</small>
                                                    </td>
                                                @endif
                                                <td>{{ $detail->code }}</td>
                                                <td class="text-start" style="text-align: left; padding-left: 1rem !important;">{{ $detail->detail }}</td>
                                                <td>{{ $maxScore }}</td>
                                                <td>
                                                    <input type="hidden" name="items[{{ $globalIndex }}][activitysoff_master_dts_id]" value="{{ $detail->activitysoff_master_dts_id }}">
                                                    
                                                    @if (intval($maxScore) > 0)
                                                        <input type="number" class="form-control score-input" name="items[{{ $globalIndex }}][score]" value="{{ old('items.' . $globalIndex . '.score', $scoreVal) }}" min="1" max="5" required>
                                                    @else
                                                        <input type="hidden" name="items[{{ $globalIndex }}][score]" value="0">
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php $globalIndex++; @endphp
                                        @endforeach
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-light">
                                        <td colspan="3" class="text-start ps-3">
                                            <small class="text-muted"><strong>เกณฑ์การให้คะแนน:</strong> 5 = ดีมาก , 4 = ดี , 3 = พอใช้ , 2 = ควรปรับปรุง , 1 = แย่มาก</small>
                                        </td>
                                        <td class="text-center fw-bold text-dark">คะแนนเต็ม<br><span id="maxScoreText">{{ $totalMaxScore }}</span></td>
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
                                    <textarea class="form-control" rows="3" placeholder="ระบุจุดเด่น..." name="strength">{{ old('strength', $hd->strength) }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>จุดด้อยจากการตรวจพื้นที่</label>
                                    <textarea class="form-control" rows="3" placeholder="ระบุจุดด้อย..." name="weakness">{{ old('weakness', $hd->weakness) }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>ข้อเสนอแนะจากการตรวจพื้นที่</label>
                                    <textarea class="form-control" rows="3" placeholder="ระบุข้อเสนอแนะ..." name="suggestion">{{ old('suggestion', $hd->suggestion) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 bg-light p-3 rounded-3 mx-0 mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>กรรมการตรวจให้คะแนน (ท่านที่ 1) <span class="text-danger">*</span></label>
                                    <input class="form-control bg-white" type="text" name="auditor_1" value="{{ old('auditor_1', $hd->auditor_1) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>กรรมการตรวจให้คะแนน (ท่านที่ 2)</label>
                                    <input class="form-control bg-white" type="text" name="auditor_2" value="{{ old('auditor_2', $hd->auditor_2) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>วันที่ตรวจ <span class="text-danger">*</span></label>
                                    <input class="form-control bg-white" type="date" name="audit_date" value="{{ old('audit_date', $hd->audit_date) }}" required>
                                </div>
                            </div>
                        </div> 

                        <!-- ปุ่มบันทึกข้อมูล -->
                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-submit">
                                <i class="ri-save-line me-1"></i> บันทึกการแก้ไขผลการตรวจ
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
document.addEventListener('DOMContentLoaded', function () {
    const scoreInputs = document.querySelectorAll('.score-input');
    const totalScoreInput = document.getElementById('total_score');
    const percentScoreInput = document.getElementById('percent_score');
    const maxScore = parseInt(document.getElementById('maxScoreText').textContent) || 105;

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
});
</script>
@endpush