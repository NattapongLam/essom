@extends('layouts.main')

@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-hover: #4338ca;
        --bg-light: #f8fafc;
        --border-color: #e2e8f0;
        --text-main: #0f172a;
        --text-muted: #64748b;
        --radius-lg: 16px;
        --radius-md: 10px;
    }

    .custom-card {
        border: none;
        border-radius: var(--radius-lg);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
        color: #ffffff;
        padding: 2rem 2.5rem;
        border-bottom: none;
        position: relative;
    }

    .badge-doc {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        color: #ffffff;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.825rem;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    /* Modern Table */
    .table-container {
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        overflow: hidden;
    }

    .inspection-table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .inspection-table thead th {
        background-color: #f1f5f9;
        color: var(--text-muted);
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .inspection-table tbody tr {
        transition: all 0.2s ease;
    }

    .inspection-table tbody tr:hover {
        background-color: #f8fafc;
    }

    .inspection-table td {
        padding: 0.9rem 1rem;
        vertical-align: middle;
        color: var(--text-main);
        border-bottom: 1px solid var(--border-color);
    }

    .section-badge {
        width: 32px;
        height: 32px;
        background: #e0e7ff;
        color: var(--primary-color);
        font-weight: 700;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    /* Form Inputs */
    .custom-select-status {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 0.5rem 0.75rem;
        font-weight: 600;
        transition: all 0.2s;
    }

    .custom-select-status:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }

    .status-pass {
        background-color: #dcfce7 !important;
        color: #15803d !important;
        border-color: #86efac !important;
    }

    .status-fail {
        background-color: #fee2e2 !important;
        color: #b91c1c !important;
        border-color: #fca5a5 !important;
    }

    .custom-textarea {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        resize: none;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .custom-textarea:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }

    /* Sign Cards */
    .info-card {
        background: #f8fafc;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        height: 100%;
    }

    .info-card-title {
        font-weight: 700;
        color: var(--text-main);
        font-size: 1rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-submit {
        background: var(--primary-color);
        color: #fff;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        transition: all 0.2s;
    }

    .btn-submit:hover {
        background: var(--primary-hover);
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(79, 70, 229, 0.35);
        color: #fff;
    }
</style>

<div class="container-fluid py-4">
    <form action="{{ route('inspection-record-sdms.update', $hd->inspection_recordsdm_hds_id) }}" method="POST" id="inspectionForm">
        @csrf
        @method('PUT')
        <input type="hidden" name="doc_ref" value="Edit">
        
        <div class="row">  
            <div class="col-12">
                <div class="card custom-card">
                    <!-- Header -->
                    <div class="card-header custom-card-header">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                            <div>
                                <h6 class="text-white-50 text-uppercase tracking-wider mb-1" style="font-size: 0.8rem; letter-spacing: 1px;">ESSOM CO., LTD</h6>
                                <h4 class="m-0 font-weight-bold text-white">ใบตรวจสอบสินค้าต่างประเทศ (จากบริษัท SDM) - แก้ไข</h4>
                            </div>
                            <div>
                                <span class="badge-doc"><i class="fas fa-file-alt me-1"></i> GF409 SDM (25 Apr. 17)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="card-body p-4">             
                        <div class="table-container mb-4">
                            <table class="table inspection-table align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 70px;">หัวข้อ</th>
                                        <th>รายการตรวจเช็ค</th>
                                        <th style="width: 180px;" class="text-center">ผลการตรวจ</th>
                                        <th style="width: 320px;">หมายเหตุ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // จัดกลุ่มข้อมูลเก่าจากฐานข้อมูลตาม section_no และ index เพื่อดึงค่าง่ายขึ้น
                                        $savedDetails = $hd->details->groupBy('section_no');

                                        $sections = [
                                            1 => [
                                                'Flash & Fire Point (Cleveland) (ชุดทดสอบจุดวาบไฟและจุดติดไฟแบบเปิด)',
                                                'สภาพสีและอุปกรณ์ประกอบ',
                                                'การทำงานและสภาพของชุดฮีทเตอร์ (สามารถปรับอุณหภูมิได้)',
                                                'สวิทซ์เปิด-ปิด (ปิดแล้วมีไฟติด และเครื่องทำงาน)',
                                                'การหมุนของหัวส่าย (รุ่น 880 เอามือส่ายได้สะดวก,รุ่น 890 กดสวิทซ์ดูว่าส่ายได้)',
                                                'คู่มือ'
                                            ],
                                            2 => [
                                                'Flash & Fire Point (Cleveland) (ชุดทดสอบจุดวาบไฟและจุดติดไฟแบบเปิด)',
                                                'สภาพสีและอุปกรณ์ประกอบ',
                                                'การทำงานของชุดฮีทเตอร์ (สามารถปรับอุณหภูมิได้)',
                                                'กลไกการเปิดฝาสามารถทำงานได้สะดวก (เปิดแล้วปล่อยให้สปริงกลับเองได้)',
                                                'การทำงานของมอเตอร์กวน',
                                                'สวิทซ์เปิด-ปิด (ปิดแล้วมีไฟติด และเครื่องทำงาน)',
                                                'คู่มือ'
                                            ],
                                            3 => [
                                                'Kinematic Viscometer (ชุดทดสอบความหนืดของน้ำมัน)',
                                                'สภาพ, ผิว และอุปกรณ์ประกอบ',
                                                'รอยเชื่อมของสแตนเลส (เรียบร้อยไม่มีเขม่าหรือขี้เชื่อม ไม่มีขอบคม)',
                                                'การทำงานของชุดฮีทเตอร์ (ต้องใส่น้ำขณะทดลอง และดูว่าปรับอุณหภูมิได้)',
                                                'สวิทซ์เปิด-ปิด (เปิดแล้วมีไฟติด และเครื่องทำงาน)',
                                                'การทำงานของระบบไฟแสงสว่าง',
                                                'การทำงานของมอเตอร์กวน',
                                                'คู่มือ'
                                            ],
                                            4 => [
                                                'Saybolt Viscometer (ชุดทดสอบความหนืดของน้ำมัน)',
                                                'สภาพ, ผิวและอุปกรณ์ประกอบ',
                                                'การทำงานของชุดฮีทเตอร์ (ต้องใส่น้ำขณะทดลอง และดูว่าปรับอุณหภูมิได้)',
                                                'สวิทซ์เปิด-ปิด (เปิดแล้วมีไฟติด และเครื่องทำงาน)',
                                                'การทำงานของมอเตอร์กวน',
                                                'คู่มือ'
                                            ],
                                            5 => [
                                                'Penetrometer (ชุดทดสอบความเหนียวข้นของจารบี)',
                                                'สภาพสีและอุปกรณ์ประกอบ',
                                                'กรายทดสอบอยู่ในสภาพดี แกนไม่คด ปลายแหลมไม่หักงอ',
                                                'ตัวปล่อยเข็มทำงานได้ทั้งแบบใช้ไฟฟ้าและแบบไม่ใช้ไฟฟ้า',
                                                'ตัววัดระดับเลื่อนขึ้น-ลงได้คล่องตัว (ทั้งระบบปรับหยาบและปรับละเอียด)',
                                                'การทำงานของ Timer (ตั้งเวลาได้ไม่น้อยกว่า 5 วินาที และตัดการทำงานเมื่อครบเวลา)',
                                                'สวิทซ์เปิด-ปิด (เปิดแล้วมีไฟติด และเครื่องทำงาน)',
                                                'คู่มือ'
                                            ],
                                            6 => [
                                                'Bomb Calorimeter (ชุดทดสอบหาค่าความร้อนของเชื้อเพลิง)',
                                                'สภาพสี, ผิว และอุปกรณ์ประกอบ',
                                                'การทำงานของชุดจุดระเบิด (ทดลองใช้ลวดจุดระเบิดจริง เข็มแอมป์ต้องขึ้น)',
                                                'การทำงานของมอเตอร์กวน',
                                                'ฝาของชุดบอมบ์ขันเข้า-ออกสะดวก',
                                                'ขายึดลวดภายใน ไม่หลวมคลอน',
                                                'ขั้วไฟฟ้าไม่ลัดวงจร',
                                                'สวิทซ์เปิด-ปิด (เปิดแล้วมีไฟติด และเครื่องทำงานปกติ)',
                                                'คู่มือ'
                                            ]
                                        ];
                                    @endphp

                                    @foreach($sections as $secNo => $items)
                                        @foreach($items as $index => $item)
                                            @php
                                                // ดึงค่าเก่าจากฐานข้อมูล (ถ้ามี)
                                                $detailRecord = isset($savedDetails[$secNo]) ? $savedDetails[$secNo][$index] ?? null : null;
                                                $currentVal = $detailRecord ? $detailRecord->pass_fail : '';
                                                $currentRemarks = $detailRecord ? $detailRecord->remarks : '';
                                                
                                                // กำหนดคลาสสีเริ่มต้นตามค่าใน DB
                                                $statusClass = '';
                                                if($currentVal == 'pass') $statusClass = 'status-pass';
                                                if($currentVal == 'fail') $statusClass = 'status-fail';
                                            @endphp
                                            <tr>
                                                @if($index === 0)
                                                <td rowspan="{{ count($items) }}" class="text-center align-middle bg-light">
                                                    <div class="section-badge">{{ $secNo }}</div>
                                                </td>
                                                @endif
                                                <td>{{ $item }}</td>
                                                <td>
                                                    <select class="form-select custom-select-status status-picker {{ $statusClass }}" name="items[{{ $secNo }}][{{ $index }}][pass_fail]">
                                                        <option value="">-- เลือก --</option>
                                                        <option value="pass" {{ $currentVal == 'pass' ? 'selected' : '' }}>✓ ผ่าน</option>
                                                        <option value="fail" {{ $currentVal == 'fail' ? 'selected' : '' }}>✗ ไม่ผ่าน</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea class="form-control custom-textarea" rows="1" name="items[{{ $secNo }}][{{ $index }}][remarks]" placeholder="ระบุหมายเหตุ (ถ้ามี)...">{{ $currentRemarks }}</textarea>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Signatures / Approval Section -->
                        <div class="row g-4 mt-2">
                            <!-- Inspector Card -->
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-title text-indigo">
                                        <i class="fas fa-user-check text-primary"></i> ผู้ทำการตรวจสอบ (Inspector)
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">ชื่อผู้ตรวจ</label>
                                            <input class="form-control bg-white" type="text" name="checked_by" value="{{ $hd->checked_by }}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">ตำแหน่ง</label>
                                            <input class="form-control" type="text" name="checked_job" placeholder="ระบุตำแหน่ง" value="{{ $hd->checked_job }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small fw-bold text-muted">วันที่ตรวจสอบ</label>
                                            <input class="form-control" type="date" name="checked_date" value="{{ $hd->checked_date }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Approver Card -->
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-title">
                                        <i class="fas fa-user-shield text-success"></i> ผู้อนุมัติ (Approver)
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">ชื่อผู้อนุมัติ</label>
                                            <input class="form-control" type="text" name="approved_by" placeholder="ระบุชื่อผู้อนุมัติ" value="{{ $hd->approved_by }}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">ตำแหน่ง</label>
                                            <input class="form-control" type="text" name="approved_job" placeholder="ระบุตำแหน่ง" value="{{ $hd->approved_job }}" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small fw-bold text-muted">วันที่อนุมัติ</label>
                                            <input class="form-control" type="date" name="approved_date" value="{{ $hd->approved_date }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ url()->previous() }}" class="btn btn-light px-4 fw-bold">ย้อนกลับ</a>
                            <button type="submit" class="btn btn-submit">
                                <i class="fas fa-save me-1"></i> บันทึกการแก้ไข
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Change color dynamically on status select
        const statusPickers = document.querySelectorAll('.status-picker');
        
        statusPickers.forEach(picker => {
            picker.addEventListener('change', function () {
                this.classList.remove('status-pass', 'status-fail');
                if (this.value === 'pass') {
                    this.classList.add('status-pass');
                } else if (this.value === 'fail') {
                    this.classList.add('status-fail');
                }
            });
        });
    });
</script>
@endpush