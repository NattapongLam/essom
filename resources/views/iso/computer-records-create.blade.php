@extends('layouts.main')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'สำเร็จ!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#4f46e5'
});
</script>
@endif

<style>
    /* Modern Indigo Theme Layout */
    .custom-container {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .form-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    /* Header Design Component */
    .card-header-modern {
        background-color: #ffffff;
        padding: 2.5rem 2.5rem 1.5rem 2.5rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-title-block h2 {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
        font-size: 1.4rem;
        line-height: 1.5;
    }

    .doc-number-badge {
        position: absolute;
        top: 2.5rem;
        right: 2.5rem;
        text-align: right;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        color: #64748b;
        line-height: 1.4;
    }

    /* Top Information Input Fields */
    .info-input-group {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .info-input-group label {
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 6px;
    }

    .form-control-modern {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 0.9rem;
        background-color: #ffffff;
        transition: all 0.2s;
        width: 100%;
        color: #334155;
    }

    .form-control-modern:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    /* Table Component Customization */
    .table-responsive-container {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        margin-top: 15px;
    }

    table.table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
    }

    table.table-modern th {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
        font-weight: 600;
        border: 1px solid #4338ca !important;
        padding: 12px 6px;
        font-size: 0.85rem;
        vertical-align: middle;
    }

    table.table-modern td {
        padding: 10px 6px;
        border: 1px solid #e2e8f0;
        vertical-align: middle;
        background-color: #ffffff;
    }

    table.table-modern tbody tr:hover td {
        background-color: #f8fafc;
    }

    /* Dynamic Multi-State Checkbox UI */
    .triple-checkbox {
        width: 22px;
        height: 22px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        user-select: none;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        background-color: #ffffff;
        font-size: 0.75rem;
        font-weight: bold;
        transition: all 0.15s ease;
    }
    .triple-checkbox:hover {
        border-color: #94a3b8;
        transform: scale(1.05);
    }
    .triple-checkbox.checked { 
        background-color: #10b981; 
        color: white; 
        border-color: #10b981; 
    }
    .triple-checkbox.cross { 
        background-color: #ef4444; 
        color: white; 
        border-color: #ef4444; 
    }

    /* Monthly Sign-off Checkers Grid Grid */
    .check-date-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 16px;
        margin-top: 30px;
        background: #f8fafc;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }

    .month-checker-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        padding: 12px;
        border-radius: 8px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.02);
    }

    .month-checker-card .month-title {
        font-weight: 700;
        color: #4f46e5;
        font-size: 0.85rem;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 6px;
        margin-bottom: 8px;
        text-align: center;
    }

    .month-checker-card label {
        font-size: 0.75rem;
        color: #64748b;
        margin-bottom: 2px;
        font-weight: 500;
    }

    .month-checker-card input {
        margin-bottom: 8px;
        font-size: 0.8rem;
        padding: 4px 8px;
    }
    .month-checker-card input:last-child {
        margin-bottom: 0;
    }

    /* Form Step Controller Styling */
    .step { display: none; }
    .step.active { display: block; }

    /* Buttons Interface Design */
    .btn-indigo-nav {
        background: #4f46e5;
        color: #ffffff !important;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.2s;
    }
    .btn-indigo-nav:hover {
        background: #4338ca;
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
    }

    .btn-outline-secondary-modern {
        background: #ffffff;
        color: #475569 !important;
        border: 1px solid #cbd5e1;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-outline-secondary-modern:hover {
        background: #f1f5f9;
        color: #1e293b !important;
    }

    .btn-success-save {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff !important;
        border: none;
        padding: 10px 26px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
        transition: all 0.2s;
    }
    .btn-success-save:hover {
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.25);
    }

    /* Instruction Badge Legends */
    .legend-box {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        padding: 15px 20px;
        border-radius: 10px;
        margin-top: 25px;
    }
    .legend-box h5 {
        font-size: 0.88rem;
        color: #166534;
        line-height: 1.6;
        margin: 0;
        font-weight: 500;
    }

    /* Form Overrides Custom Buttons for SweetAlert */
    .swal-confirm-btn {
        background-color: #4f46e5 !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 8px 22px !important;
        margin: 0 5px !important;
    }
    .swal-cancel-btn {
        background-color: #ef4444 !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 8px 22px !important;
        margin: 0 5px !important;
    }

    @media (max-width: 768px) {
        .doc-number-badge { position: relative; top: 0; right: 0; text-align: left; display: inline-block; margin-top: 10px; }
        .card-header-modern { padding: 1.5rem; }
    }
</style>

<div class="container-fluid custom-container">
    <div class="card form-card">
        
        <div class="card-header-modern">
            <div class="header-title-block text-center">
                <h5 class="m-0" style="font-size: 1.1rem; letter-spacing: 1px; color: #475569;">ESSOM CO., LTD.</h5>
                <h2 class="mt-2 mb-0">การบำรุงรักษาอุปกรณ์ IT</h2>
            </div>
            <div class="doc-number-badge">
                <strong>F7134.2</strong><br>12 Jun 20
            </div>
        </div>

        <form id="maintenanceForm" method="POST" action="{{ route('computer-records.store') }}">
            @csrf
            
            <div class="card-body" style="padding: 2rem 2.5rem;">

                <div class="info-input-group">
                    <div class="row">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label><i class="fas fa-hashtag text-indigo mr-1"></i> For Asset Number</label>
                            <input type="text" class="form-control-modern" name="asset_number" required placeholder="ระบุเลขรหัสสินทรัพย์">
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label><i class="fas fa-user text-indigo mr-1"></i> User Name</label>
                            <input type="text" class="form-control-modern" name="user_name" required placeholder="ชื่อผู้ใช้งาน">
                        </div>
                        <div class="col-md-4">
                            <label><i class="fas fa-calendar-alt text-indigo mr-1"></i> Period (Year)</label>
                            <input type="text" class="form-control-modern" name="period" required placeholder="เช่น พ.ศ. 2569 / 2026">
                        </div>
                    </div>
                </div>

                @php $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']; @endphp

                <div class="step" id="step1">
                    <div class="table-responsive-container">
                        <table class="table-modern text-center m-0">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">Item</th>
                                    <th style="width: 35%; text-align: left; padding-left: 15px;">Maintenance List</th>
                                    @foreach($months as $month)
                                        <th>{{ $month }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $items_step1 = [
                                    "การอัพเดทของแอนตี้ไวรัสเเป็นปัจจุบัน",
                                    "การทํางานของ Hard Disk ไม่มีเสียงการอ่านดิสเสียงดังแบบเข็มตก",
                                    "การทํางานของ CD / DVD สามารถอ่านเขียนได้",
                                    "การบล็อกการใช้งาน USB จากภายนอก",
                                    "การทำงานของ UPS ไม่ร้อนหรือมีเสียงร้องเตือนในระหว่างทำงาน",
                                    "การทำงานของ OS ไม่พบการฟ้อง error ต่างๆ แสดงที่ Desktop",
                                    "การทำงานของโปรแกรมต่างๆ สามารถใช้งานได้ปกติ",
                                    "การจัดเก็บไฟล์งานอย่างเป็นระบบ ไม่มีการจัดเก็บไฟล์ส่วนตัว",
                                    "การเข้าถึง Server ที่มี Username / Password",
                                    "การทำงานของระบบแบ็คอัพไฟล์ครบถ้วนสมบูรณ์",
                                    "การทำงานของระบบ Network เป็นปกติ สามารถเชื่อมต่อถึงกันได้",
                                    "สามารถเข้าใช้งาน Internet ปกติ",
                                    "การเชื่อมต่อกับใช้งาน Printer เป็นปกติ",
                                ];
                                @endphp

                                @foreach($items_step1 as $i => $text)
                                <tr>
                                    <td class="font-weight-bold text-secondary">{{ $i+1 }}</td>
                                    <td style="text-align:left; padding-left: 15px; color: #1e293b;">{{ $text }}</td>
                                    @for($m=0;$m<12;$m++)
                                        <td>
                                            <input type="hidden" name="month_{{ $i }}_{{ $m }}" value="0">
                                            <div class="triple-checkbox" data-name="month_{{ $i }}_{{ $m }}"></div>
                                        </td>
                                    @endfor
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="step" id="step2">
                    <div class="table-responsive-container">
                        <table class="table-modern text-center m-0">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">Item</th>
                                    <th style="width: 35%; text-align: left; padding-left: 15px;">Maintenance List</th>
                                    @foreach($months as $month)
                                        <th>{{ $month }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $items_step2 = [
                                    "การทำงานของ Browser เป็นปกติไม่มีการรบกวนจาก Worm ต่างๆ",
                                    "สามารถใช้งาน E-Mail ได้ปกติ",
                                    "ตรวจหาการติดตั้งโปรแกรมที่ละเมิดลิขสิทธิ์",
                                    "คอมพิวเตอร์ต้องมีการดูแลความสะอาด ไม่สกปรกเกินไป",
                                    "การทำงานของระบบ Firewall(สามารถบล็อกเวปผิดกฎหมายได้)",
                                    "การทำงานของ Log (สามารถเก็บรายชื่อผู้เข้าถึงอินเตอร์เน็ตได้)",
                                ];
                                @endphp

                                @foreach($items_step2 as $i => $text)
                                <tr>
                                    <td class="font-weight-bold text-secondary">{{ $i+14 }}</td>
                                    <td style="text-align:left; padding-left: 15px; color: #1e293b;">{{ $text }}</td>
                                    @for($m=0;$m<12;$m++)
                                        <td>
                                            <input type="hidden" name="month_{{ $i+13 }}_{{ $m }}" value="0">
                                            <div class="triple-checkbox" data-name="month_{{ $i+13 }}_{{ $m }}"></div>
                                        </td>
                                    @endfor
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="check-date-grid">
                        @for($m=0;$m<12;$m++)
                        <div class="month-checker-card">
                            <div class="month-title">{{ $months[$m] }} Assessment</div>
                            
                            <label>Check by</label>
                            <input type="text" class="form-control-modern mb-2" name="check_by_{{ $m }}" placeholder="ผู้ตรวจ">
                            
                            <label>Date Checked</label>
                            <input type="date" class="form-control-modern" name="date_check_{{ $m }}">
                        </div>
                        @endfor
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <label class="font-weight-bold text-secondary mb-2" style="font-size: 0.9rem;">Remark / หมายเหตุเพิ่มเติม :</label>
                            <textarea class="form-control-modern" name="remark" rows="4" placeholder="กรอกรายละเอียด หรือบันทึกเพิ่มเติมเกี่ยวกับการตรวจสภาพ..." style="resize: vertical;"></textarea>
                        </div>
                    </div>
                </div>

                <div class="legend-box">
                    <h5>
                        <i class="fas fa-info-circle text-success mr-1"></i> <strong>คำแนะนำในการบันทึกข้อมูล:</strong><br>
                        • คลิกที่กล่อง 1 ครั้งเพื่อขึ้นเครื่องหมาย <span class="text-success font-weight-bold">✔ (ผ่านการตรวจสอบ / สภาพปกติ)</span><br>
                        • คลิกอีกครั้งเพื่อเปลี่ยนเป็นเครื่องหมาย <span class="text-danger font-weight-bold">✖ (ไม่ผ่านการตรวจสอบ / สภาพผิดปกติ)</span>
                    </h5>
                </div>

                <div id="pagination" class="d-flex justify-content-center align-items-center mt-5" style="gap: 15px;">
                    <button type="button" id="prevStep" class="btn-outline-secondary-modern"><i class="fas fa-chevron-left mr-1"></i> ก่อนหน้า</button>
                    <span id="pageInfo" class="font-weight-bold text-muted" style="font-size: 0.95rem; min-width: 80px; text-align: center;"></span>
                    <button type="button" id="nextStep" class="btn-indigo-nav">ถัดไป <i class="fas fa-chevron-right ml-1"></i></button>
                    <button type="submit" id="submitBtn" class="btn-success-save" style="display:none;"><i class="fas fa-save mr-1"></i> บันทึกข้อมูลทั้งหมด</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Triple-state Dynamic Checker Component Javascript Control Logic
    document.querySelectorAll('.triple-checkbox').forEach(cb => {
        cb.addEventListener('click', function() {
            const input = document.querySelector(`input[name="${this.dataset.name}"]`);
            if (!this.classList.contains('checked') && !this.classList.contains('cross')) {
                this.classList.add('checked'); 
                this.textContent = '✔'; 
                input.value = '1';
            } else if (this.classList.contains('checked')) {
                this.classList.remove('checked'); 
                this.classList.add('cross'); 
                this.textContent = '✖'; 
                input.value = '2';
            } else {
                this.classList.remove('cross'); 
                this.textContent = ''; 
                input.value = '0';
            }
        });
    });

    // Multi-Step Form Management Integration Logic
    const form = document.getElementById('maintenanceForm');
    const steps = Array.from(form.querySelectorAll('.step'));
    let currentStep = 0;

    const prevBtn = document.getElementById('prevStep');
    const nextBtn = document.getElementById('nextStep');
    const submitBtn = document.getElementById('submitBtn');
    const pageInfo = document.getElementById('pageInfo');

    function showStep(index) {
        steps.forEach((s, i) => {
            if(i === index) {
                s.classList.add('active');
            } else {
                s.classList.remove('active');
            }
        });
        
        prevBtn.style.display = index === 0 ? 'none' : 'inline-block';
        nextBtn.style.display = index === steps.length - 1 ? 'none' : 'inline-block';
        submitBtn.style.display = index === steps.length - 1 ? 'inline-block' : 'none';
        pageInfo.textContent = `หน้า ${index + 1} / ${steps.length}`;
    }

    prevBtn.addEventListener('click', () => {
        if (currentStep > 0) { 
            currentStep--; 
            showStep(currentStep); 
            window.scrollTo({top: 0, behavior: 'smooth'});
        }
    });

    nextBtn.addEventListener('click', () => {
        if (currentStep < steps.length - 1) { 
            currentStep++; 
            showStep(currentStep); 
            window.scrollTo({top: 0, behavior: 'smooth'});
        }
    });

    // Initial Trigger Render View 
    showStep(currentStep);

    // SweetAlert2 Form Confirmation Interception Hook
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // เช็คความครบถ้วนของ Required Inputs หน้าแรกก่อนส่งฟอร์มเบื้องต้น
        if(!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        Swal.fire({
            title: 'ยืนยันการบันทึกข้อมูล?',
            text: 'กรุณาตรวจสอบตารางการเช็คลิสต์และข้อมูลให้ถูกต้องก่อนกดยืนยัน',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-check mr-1"></i> ยืนยันบันทึก',
            cancelButtonText: 'ยกเลิกตรวจสอบอีกครั้ง',
            customClass: {
                confirmButton: 'swal-confirm-btn',
                cancelButton: 'swal-cancel-btn'
            },
            buttonsStyling: false
        }).then(result => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

});
</script>
@endsection