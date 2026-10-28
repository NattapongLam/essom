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
                <!-- เปลี่ยน Action ไปยัง Route สำหรับบันทึกข้อมูล (ปรับเปลี่ยนชื่อ route ตามที่คุณตั้ง) -->
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>หน่วยงานที่ถูกตรวจ <span class="text-danger">*</span></label>
                                    <input class="form-control @error('department_name') is-invalid @enderror" type="text" name="department_name" value="{{ old('department_name') }}" placeholder="ระบุหน่วยงานที่ถูกตรวจ" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ชั้นที่ถูกตรวจ <span class="text-danger">*</span></label>
                                    <input class="form-control @error('floor') is-invalid @enderror" type="text" name="floor" value="{{ old('floor') }}" placeholder="ระบุชั้นที่ถูกตรวจ" required>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-modern-form text-center align-middle mb-0" id="destroyTable">
                                <thead>
                                    <tr>
                                        <th style="width: 20%;">พื้นที่ตรวจเช็ค</th>
                                        <th style="width: 8%;">ข้อ</th>
                                        <th style="width: 47%; text-align: left; padding-left: 1rem !important;">รายละเอียด</th>
                                        <th style="width: 10%;">เต็ม</th>
                                        <th style="width: 15%;">คะแนน (1-5)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- หมวดที่ 1 -->
                                    <tr>
                                        <td rowspan="10" class="category-cell">1. บริเวณทำงาน<br><small class="text-muted fw-normal">ตึกงานบริหารงานขายอุปกรณ์อุตสาหกรรมและงานขายอุปกรณ์การศึกษา</small></td>
                                        <td>1.1</td>
                                        <td class="text-start">วางสิ่งของบริเวณโต๊ะทำงานให้เป็นระเบียบและนำมาใช้ได้สะดวก</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[1]" value="{{ old('score.1') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>1.2</td>
                                        <td class="text-start">ไม่มีเศษขยะบริเวณโต๊ะทำงาน</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[2]" value="{{ old('score.2') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>1.3</td>
                                        <td class="text-start">เครื่องใช้สำนักงานส่วนกลางต้องไม่มีสิ่งของที่ไม่เกี่ยวข้องปะปน บริเวณเครื่องใช้มีชื่อผู้รับผิดชอบมีความสะอาดพร้อมใช้งาน</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[3]" value="{{ old('score.3') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>1.4</td>
                                        <td class="text-start fw-bold" colspan="3" style="text-align: left !important;">ตู้เอกสาร/ตู้เก็บอุปกรณ์</td>
                                    </tr>
                                    <tr>
                                        <td>1.4.1</td>
                                        <td class="text-start">ไม่มีของที่ไม่เกี่ยวข้องเก็บในตู้</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[4]" value="{{ old('score.4') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>1.4.2</td>
                                        <td class="text-start">ติดชื่อผู้รับผิดชอบตู้และจัดแบ่งพื้นที่ในตู้ให้เป็นระเบียบ มีป้ายชี้บ่ง</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[5]" value="{{ old('score.5') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>1.4.3</td>
                                        <td class="text-start">รักษาความสะอาดบริเวณตู้เอกสารไม่มีเทป/คราบกาวติดตู้</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[6]" value="{{ old('score.6') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>1.4.4</td>
                                        <td class="text-start">ไม่วางสิ่งของหน้าตู้เอกสาร</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[7]" value="{{ old('score.7') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>1.4.5</td>
                                        <td class="text-start">การวางสิ่งของบนหลังตู้เอกสารให้วางแฟ้มให้เป็นระเบียบหรือมีชั้นเก็บเอกสารหรือกล่องเก็บ</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[8]" value="{{ old('score.8') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>1.4.6</td>
                                        <td class="text-start">ปิดตู้ทุกครั้งหลังใช้งาน</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[9]" value="{{ old('score.9') }}" min="1" max="5"></td>
                                    </tr>

                                    <!-- หมวดที่ 2 -->
                                    <tr>
                                        <td rowspan="6" class="category-cell">2. พื้นที่ส่วนกลาง<br><small class="text-muted fw-normal">ตรวจงานบริหาร</small></td>
                                        <td>2.1</td>
                                        <td class="text-start">พื้นที่มีความสะอาดไม่มีเศษขยะ เช่น ทางเดิน ห้องโถง บันได พื้นที่โดยรอบสำนักงาน</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[10]" value="{{ old('score.10') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>2.2</td>
                                        <td class="text-start">บริเวณพื้นที่จอดรถยนต์/จักรยานยนต์ จอดตรงตามช่องจอด</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[11]" value="{{ old('score.11') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>2.3</td>
                                        <td class="text-start">วางสิ่งของเป็นระเบียบในบริเวณพื้นที่ที่กำหนด</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[12]" value="{{ old('score.12') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>2.4</td>
                                        <td class="text-start">ห้องประชุม กระดานไวท์บอร์ด ต้องสะอาดและโต๊ะประชุม, เก้าอี้จัดวางเรียบร้อยอยู่ในสภาพพร้อมใช้งาน</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[13]" value="{{ old('score.13') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>2.5</td>
                                        <td class="text-start">บอร์ดติดประกาศชั้น 1 มีข้อมูลไม่เกิน 3 เดือน</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[14]" value="{{ old('score.14') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>2.6</td>
                                        <td class="text-start">ห้องระบบไฟฟ้า ไม่วางสิ่งของอื่นไว้ภายใน (ยกเว้นชั้น 3 ให้วางไว้อย่างมีระเบียบ)</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[15]" value="{{ old('score.15') }}" min="1" max="5"></td>
                                    </tr>

                                    <!-- หมวดที่ 3 -->
                                    <tr>
                                        <td rowspan="6" class="category-cell">3. สโตร์ และ Shop พ่นสี<br><small class="text-muted fw-normal">ตรวจงานบริหารและงานขายอุปกรณ์อุตสาหกรรม</small></td>
                                        <td>3.1</td>
                                        <td class="text-start">ไม่มีสิ่งของที่ไม่เกี่ยวข้องปะปนกับอุปกรณ์</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[16]" value="{{ old('score.16') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>3.2</td>
                                        <td class="text-start">อุปกรณ์ เครื่องมือ ถูกเก็บอยู่ในกล่องหรือตู้เก็บอุปกรณ์หรือชั้นวางเป็นระเบียบเรียบร้อย มีป้ายชี้บ่ง สามารถนำมาใช้ได้สะดวก</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[17]" value="{{ old('score.17') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>3.3</td>
                                        <td class="text-start">ห้องสโตร์ กระดานไวท์บอร์ด ต้องสะอาดและอยู่ในสภาพพร้อมใช้งาน</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[18]" value="{{ old('score.18') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>3.4</td>
                                        <td class="text-start">พื้นที่มีความสะอาด ไม่มีเศษขยะ</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[19]" value="{{ old('score.19') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>3.5</td>
                                        <td class="text-start">วางสิ่งของให้เป็นระเบียบ ในพื้นที่ที่กำหนด</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[20]" value="{{ old('score.20') }}" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>3.6</td>
                                        <td class="text-start">เครื่องมือเครื่องใช้ที่มีอันตราย เช่น มีความแหลมคม ไวไฟ มีการจัดเก็บในภาชนะอย่างปลอดภัย</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[21]" value="{{ old('score.21') }}" min="1" max="5"></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-light">
                                        <td colspan="3" class="text-start ps-3">
                                            <small class="text-muted"><strong>เกณฑ์การให้คะแนน:</strong> 5 = ดีมาก , 4 = ดี , 3 = พอใช้ , 2 = ควรปรับปรุง , 1 = แย่มาก</small>
                                        </td>
                                        <td class="text-center fw-bold text-dark">คะแนนเต็ม<br>105</td>
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
document.addEventListener('DOMContentLoaded', function () {
    const scoreInputs = document.querySelectorAll('.score-input');
    const totalScoreInput = document.getElementById('total_score');
    const percentScoreInput = document.getElementById('percent_score');
    const maxScore = 105; // คะแนนเต็มรวม

    function calculateTotal() {
        let total = 0;
        scoreInputs.forEach(input => {
            let val = parseInt(input.value);
            if (!isNaN(val) && val >= 1 && val <= 5) {
                total += val;
            }
        });
        
        totalScoreInput.value = total;
        let percent = (total / maxScore) * 100;
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

    // คำนวณครั้งแรกตอนโหลดหน้าเว็บ (กรณีมีค่าเก่าจาก Old() หรือแก้ไขข้อมูลเดิม)
    calculateTotal();
});
</script>
@endpush