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
        margin-bottom: 0;
        line-height: 1.4;
    }

    /* Form Controls */
    .form-group label {
        font-weight: 600;
        color: #475569;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }
    .form-control {
        border: 1px solid #cbd5e1 !important;
        border-radius: 10px !important;
        padding: 0.6rem 0.875rem !important;
        font-size: 0.875rem;
        color: #334155;
        transition: all 0.2s ease;
    }
    .form-control:focus {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1) !important;
    }

    /* Table Customization */
    .card-body {
        padding: 2rem !important;
    }
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }
    .table-modern-form {
        margin: 0 !important;
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
        padding: 0.85rem 0.75rem !important;
        vertical-align: middle !important;
        color: #334155;
        font-size: 0.875rem;
        border-bottom: 1px solid #f1f5f9 !important;
        background-color: #ffffff;
    }
    .table-modern-form tbody tr:hover td {
        background-color: rgba(99, 102, 241, 0.02) !important;
    }
    .category-cell {
        font-weight: 700;
        background-color: #f8fafc !important;
        color: #4f46e5 !important;
        vertical-align: middle !important;
    }
    .table-modern-form tfoot td {
        background-color: #f8fafc !important;
        font-weight: 600;
        padding: 1rem !important;
        color: #334155;
    }

    /* Score Input */
    .score-input {
        max-width: 80px;
        margin: 0 auto;
        text-align: center;
        font-weight: 600;
    }

    /* Buttons */
    .btn-indigo-submit {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        padding: 0.75rem 2rem !important;
        border-radius: 12px !important;
        font-weight: 600 !important;
        font-size: 0.95rem;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3) !important;
        transition: all 0.2s ease !important;
        border: none !important;
    }
    .btn-indigo-submit:hover {
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.45) !important;
        transform: translateY(-1px);
        color: #ffffff !important;
    }
</style>

<div class="objective-container">
    <div class="row justify-content-center">  
        <div class="col-xl-11 col-12">
            <form action="{{ route('activity-5spdts.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-start gap-3">
                            <div>
                                <div class="company-title">ESSOM CO., LTD.</div>
                                <h5 class="main-title">
                                    แบบฟอร์มการตรวจประเมินผลกิจกรรม 5 ส โรงงาน (ตรวจสำนักงาน)
                                </h5>
                            </div>
                        </div>            
                    </div>

                    <div class="card-body">            
                        <!-- Header Information Form -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>ครั้งที่</label>
                                    <input class="form-control" type="text" placeholder="ระบุครั้งที่ตรวจ" name="time_no">
                                    <input type="hidden" name="docutype" value="GF113.2-F">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>หน่วยงานที่ถูกตรวจ</label>
                                    <input class="form-control" type="text" placeholder="ระบุหน่วยงาน" name="department">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ชั้นที่ถูกตรวจ</label>
                                    <input class="form-control" type="text" placeholder="ระบุชั้น" name="floor">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>วันที่</label>
                                    <input class="form-control" type="date" name="audit_date" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Checksheet Table -->
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-modern-form text-center align-middle" id="destroyTable">
                                <thead>
                                    <tr>
                                        <th style="width: 15%;">พื้นที่ตรวจเช็ค</th>
                                        <th style="width: 8%;">ข้อ</th>
                                        <th style="width: 50%; text-align: left; padding-left: 1rem !important;">รายละเอียด</th>
                                        <th style="width: 10%;">เต็ม</th>
                                        <th style="width: 17%;">คะแนน (1-5)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="4" class="category-cell">1.บริเวณทำงาน</td>
                                        <td>1.1</td>
                                        <td class="text-start">ไม่วางสิ่งของไว้ใต้โต๊ะหรือบนพนักพิงเก้าอี้</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[1]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>1.2</td>
                                        <td class="text-start">ของบนโต๊ะทำงาน จัดวางเป็นระเบียบนำมาใช้ได้สะดวก</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[2]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>1.3</td>
                                        <td class="text-start">ไม่มีเศษขยะบริเวณโต๊ะทำงาน</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[3]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>1.4</td>
                                        <td class="text-start">เครื่องใช้สำนักงานส่วนกลางต้องไม่มีสิ่งของที่ไม่เกี่ยวข้องปะปนบริเวณเครื่องใช้มีชื่อผู้รับผิดชอบ มีความสะอาดพร้อมใช้งาน</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[4]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5" class="category-cell">2.ห้องพัสดุ</td>
                                        <td>2.1</td>
                                        <td class="text-start">ตู้เอกสาร / ตู้เก็บอุปกรณ์ / ชั้นเก็บของ วางแบ่งหมวดหมู่ชัดเจนไม่มีของอื่นปะปน</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[5]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>2.2</td>
                                        <td class="text-start">ไม่มีของที่ไม่เกี่ยวข้องเก็บในตู้</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[6]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>2.3</td>
                                        <td class="text-start">จัดแบ่งพื้นที่ในตู้และชั้นวางของให้เป็นระเบียบมีป้ายชี้บ่งให้เข้าใจ</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[7]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>2.4</td>
                                        <td class="text-start">รักษาความสะอาดบริเวณตู้เอกสารไม่มีเทป/คราบกาวติดตู้</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[8]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>2.5</td>
                                        <td class="text-start">ไม่วางสิ่งของขวางหน้าตู้เอกสาร</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[9]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3" class="category-cell">3.ห้องครัว</td>
                                        <td>3.1</td>
                                        <td class="text-start">โต๊ะห้องครัวและเครื่องใช้ไฟฟ้ามีความสะอาด</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[10]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>3.2</td>
                                        <td class="text-start">ห้องครัวจัดเก็บสิ่งของเป็นระเบียบ และเป็นหมวดหมู่ตามชั้นวางหยิบใช้ได้สะดวก</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[11]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>3.3</td>
                                        <td class="text-start">ตู้เย็นต้องไม่มีอาหารเหลือเก็บไว้นาน</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[12]" min="1" max="5"></td>
                                    </tr>                           
                                    <tr>
                                        <td rowspan="3" class="category-cell">4.ห้องน้ำ</td>
                                        <td>4.1</td>
                                        <td class="text-start">พื้นที่ห้องน้ำมีความสะอาด ไม่มีขยะนอกถังขยะ</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[13]" min="1" max="5"></td>
                                        
                                    </tr>
                                    <tr>
                                        <td>4.2</td>
                                        <td class="text-start">มีกระดาษชำระสำรองตลอดเวลา</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[14]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>4.3</td>
                                        <td class="text-start">สิ่งของเครื่องใช้ส่วนตัววางไว้ในห้องน้ำแบบเป็นระเบียบเรียบร้อย</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[15]" min="1" max="5"></td>
                                    </tr>
                                    

                                    <!-- สร้างนิสัย -->
                                    <tr>
                                        <td rowspan="5" class="category-cell">5.พื้นที่ส่วนกลาง</td>
                                        <td>5.1</td>
                                        <td class="text-start">พื้นที่มีความสะอาดไม่มีเศษขยะเช่นทางเดิน ห้องโถง บันได พื้นที่โดยรอบสำนักงาน</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[16]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>5.2</td>
                                        <td class="text-start">วางสิ่งของเป็นระเบียบในบริเวณพื้นที่ที่กำหนด</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[17]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>5.3</td>
                                        <td class="text-start">ห้องประชุม กระดานไวท์บอร์ด ต้องสะอาดและดต๊ะประชุม,เก้าอี้จัดวางเรียบร้อยอยู่ในสภาพพร้อมใช้งาน</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[18]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>5.4</td>
                                        <td class="text-start">บอร์ดติดประกาศมีข้อมูลที่เป็นปัจุบัน</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[19]" min="1" max="5"></td>
                                    </tr>
                                    <tr>
                                        <td>5.5</td>
                                        <td class="text-start">บริเวณวางรองเท้าเข้าห้องทำงานมีความเป็นระเบียบเรียบร้อย</td>
                                        <td>5</td>
                                        <td><input type="number" class="form-control score-input" name="score[20]" min="1" max="5"></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-start ps-3">
                                            <small class="text-muted">เกณฑ์การให้คะแนน: 5 = ดีมาก , 4 = ดี , 3 = พอใช้ , 2 = ควรปรับปรุง , 1 = แย่มาก</small>
                                        </td>
                                        <td class="text-center fw-bold">100</td>
                                        <td><input type="text" id="total_score" class="form-control score-input bg-light" readonly value="0"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Feedback and Recommendations -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>จุดเด่นของพื้นที่จากการปรับปรุง</label>
                                    <textarea class="form-control" rows="3" name="strengths" placeholder="ระบุจุดเด่น..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>ข้อเสนอแนะการปรับปรุง</label>
                                    <textarea class="form-control" rows="3" name="improvements" placeholder="ระบุข้อเสนอแนะ..."></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Signatures Information -->
                        <div class="row g-3 bg-light p-3 rounded-3 mx-0">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ชื่อผู้ตรวจ</label>
                                    <input class="form-control bg-white" type="text" name="prepared_by" value="{{ auth()->user()->name ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>วันที่ตรวจ</label>
                                    <input class="form-control bg-white" type="date" name="prepared_date" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ชื่อผู้รับการตรวจ</label>
                                    <input class="form-control bg-white" type="text" name="checked_by" placeholder="ระบุชื่อผู้รับการตรวจ">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>วันที่รับทราบ</label>
                                    <input class="form-control bg-white" type="date" name="checked_date">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-indigo-submit">
                                <i class="fas fa-save me-2"></i> บันทึกผลการตรวจประเมิน
                            </button>
                        </div>

                    </div> <!-- card-body -->
                </div> <!-- card -->
            </form>
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

        function calculateTotal() {
            let total = 0;
            scoreInputs.forEach(input => {
                let val = parseInt(input.value);
                // นับเฉพาะช่องที่มีค่าตัวเลขระหว่าง 1 ถึง 5 เท่านั้น
                if (!isNaN(val) && val >= 1 && val <= 5) {
                    total += val;
                }
            });
            totalScoreInput.value = total;
        }

        scoreInputs.forEach(input => {
            // บังคับกรอกได้เฉพาะตัวเลข 1-5 ตัวเดียวเท่านั้นแบบทันที
            input.addEventListener('input', function() {
                // ลบตัวอักษรที่ไม่ใช่ตัวเลขออก
                this.value = this.value.replace(/[^0-9]/g, '');

                let val = parseInt(this.value);

                // ถ้าพิมพ์เลขมากกว่า 5 ให้ตัดเหลือตัวแรก หรือปรับเป็น 5
                if (this.value.length > 1) {
                    this.value = this.value.slice(-1); // เอาตัวเลขหลักสุดท้ายที่พิมพ์
                    val = parseInt(this.value);
                }

                if (val > 5) {
                    this.value = 5;
                } else if (val === 0) {
                    this.value = '';
                }

                calculateTotal();
            });

            // ป้องกันกรณีเผลอกดลูกศรขึ้น-ลง หรือพิมพ์ค่าติดลบ
            input.addEventListener('keydown', function(e) {
                if (['e', 'E', '+', '-', '.'].includes(e.key)) {
                    e.preventDefault();
                }
            });
        });

        // คำนวณครั้งแรกตอนโหลดหน้าเว็บ
        calculateTotal();
    });
</script>
@endpush