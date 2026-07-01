@extends('layouts.main')
@section('content')

<style>
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #f5f3ff;
        --indigo-focus: rgba(79, 70, 229, 0.15);
        --text-dark: #1e1b4b;
    }

    /* สไตล์ Card และโครงสร้างหลัก */
    .modern-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #eef2f6;
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.05);
    }
    .form-section-title {
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--indigo-primary);
        border-bottom: 2px solid #eeecf9;
        padding-bottom: 6px;
        margin-bottom: 16px;
    }

    /* ปรับแต่ง Label และ Input */
    .modern-label {
        font-weight: 600;
        color: #475569;
        margin-bottom: 6px;
        font-size: 0.9rem;
    }
    .form-control-indigo {
        border: 1.5px solid #e0e7ff;
        border-radius: 10px;
        padding: 0.6rem 0.85rem;
        transition: all 0.3s ease;
        color: #334155;
        background-color: #fff;
    }
    .form-control-indigo:focus {
        border-color: var(--indigo-primary);
        box-shadow: 0 0 0 4px var(--indigo-focus);
        background-color: #fff;
    }
    .form-control-indigo[readonly] {
        background-color: #f8fafc;
        border-color: #e2e8f0;
        color: #64748b;
        font-weight: 600;
    }

    /* การปรับแต่งส่วนของ Select2 ให้เข้ากับธีม */
    .select2-container--default .select2-selection--single {
        border: 1.5px solid #e0e7ff !important;
        border-radius: 10px !important;
        height: 43px !important;
        padding: 6px 12px !important;
        transition: all 0.3s ease !important;
    }
    .select2-container--default .select2-selection--single:focus,
    .select2-container--default .select2-search--dropdown .select2-search__field:focus {
        border-color: var(--indigo-primary) !important;
    }

    /* ปุ่มบันทึกและปุ่มย้อนกลับ */
    .btn-indigo-save {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.65rem 2rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        transition: all 0.2s ease;
    }
    .btn-indigo-save:hover {
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.35);
    }
    .btn-muted-cancel {
        background-color: #f1f5f9;
        color: #475569;
        border: none;
        border-radius: 10px;
        padding: 0.65rem 1.5rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-muted-cancel:hover {
        background-color: #e2e8f0;
        color: #334155;
    }
</style>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">  
        <div class="col-12 col-xl-11">
            <div class="card modern-card border-0">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0 d-flex align-items-center justify-content-between">
                    <h3 class="m-0" style="font-weight: 800; color: var(--text-dark);">
                        <i class="fas fa-plus-circle me-2" style="color: var(--indigo-primary);"></i>สร้างใบ NCR
                    </h3>
                    <a href="{{ route('ncr-report.index') }}" class="btn btn-muted-cancel btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> กลับหน้าหลัก
                    </a>
                </div>
                
                <form method="POST" class="form-horizontal" action="{{ route('ncr-report.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-4">
                        
                        <div class="form-section-title">
                            <i class="fas fa-info-circle me-1"></i> ข้อมูลทั่วไปของเอกสาร (General Information)
                        </div>
                        <div class="row g-4 mb-4">
                            <div class="col-12 col-md-3">
                                <label for="iso_ncr_observer" class="modern-label">ผู้พบเห็น</label>
                                <select class="form-control form-control-indigo select2" name="iso_ncr_observer">
                                    <option selected disabled>กรุณาเลือก</option>
                                    @foreach ($emp as $item)
                                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                                    @endforeach                                  
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="iso_ncr_docuno" class="modern-label">เลขที่เอกสาร</label>
                                <input type="text" class="form-control form-control-indigo" name="iso_ncr_docuno" value="{{$docs}}" readonly>
                                <input type="hidden" name="iso_ncr_number" value="{{$docs_number}}">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="iso_ncr_department" class="modern-label">หน่วยงานที่เกี่ยวข้อง</label>
                                <select class="form-control form-control-indigo select2" name="iso_ncr_department">
                                    <option selected disabled>กรุณาเลือก</option>
                                    @foreach ($dep as $item)
                                        <option value="{{$item->ms_department_name}}">{{$item->ms_department_name}}</option>
                                    @endforeach        
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="iso_ncr_jobnumber" class="modern-label">เลขที่งาน (Job No.)</label>                       
                                <input type="text" class="form-control form-control-indigo" name="iso_ncr_jobnumber" placeholder="ระบุเลขที่งาน">
                            </div>
                        </div>

                        <div class="form-section-title">
                            <i class="fas fa-boxes me-1"></i> รายละเอียดผลิตภัณฑ์และปัญหา (Product & Non-Conformity)
                        </div>
                        <div class="row g-4 mb-4">
                            <div class="col-12 col-md-6">
                                <label for="iso_ncr_productname" class="modern-label">ผลิตภัณฑ์</label>
                                <input type="text" class="form-control form-control-indigo" name="iso_ncr_productname" placeholder="ชื่อสินค้า / ผลิตภัณฑ์">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="iso_ncr_productcode" class="modern-label">รหัสผลิตภัณฑ์</label>
                                <input type="text" class="form-control form-control-indigo" name="iso_ncr_productcode" placeholder="Product Code">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="iso_ncr_refer" class="modern-label">เอกสารอ้างอิง</label>
                                <input type="text" class="form-control form-control-indigo" name="iso_ncr_refer" placeholder="เช่น เลขที่ใบสั่งซื้อ/ใบส่งของ">
                            </div>
                            <div class="col-12">
                                <label for="iso_ncr_nonconformity" class="modern-label">ลักษณะความไม่สอดคล้อง / ปัญหาที่พบ</label>
                                <textarea class="form-control form-control-indigo" name="iso_ncr_nonconformity" rows="3" placeholder="อธิบายรายละเอียดความเสียหายหรือสิ่งที่ไม่เป็นไปตามข้อกำหนด..."></textarea>
                            </div>
                        </div>

                        <div class="form-section-title">
                            <i class="fas fa-users-cog me-1"></i> ผู้มีส่วนเกี่ยวข้องและบันทึกเพิ่มเติม (Personnel & Notes)
                        </div>
                        <div class="row g-4 mb-4">
                            <div class="col-12 col-md-3">
                                <label for="offender_by" class="modern-label">ผู้กระทำผิด / ผู้รับผิดชอบ</label>
                                <select class="form-control form-control-indigo select2" name="offender_by">
                                    <option selected disabled>กรุณาเลือก</option>
                                    @foreach ($emp as $item)
                                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                                    @endforeach  
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="offender_job" class="modern-label">ตำแหน่ง</label>
                                <input type="text" class="form-control form-control-indigo" name="offender_job" placeholder="ตำแหน่งของผู้กระทำผิด">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="reported_by" class="modern-label">รายงานโดย</label>
                                <select class="form-control form-control-indigo select2" name="reported_by">
                                    <option selected disabled>กรุณาเลือก</option>
                                    @foreach ($emp as $item)
                                        <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_fullname}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="reported_job" class="modern-label">ตำแหน่ง</label>
                                <input type="text" class="form-control form-control-indigo" name="reported_job" placeholder="ตำแหน่งผู้รายงาน">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="reported_date" class="modern-label">วันที่รายงาน</label>
                                <input type="date" class="form-control form-control-indigo" name="reported_date" value="{{date('Y-m-d')}}">
                            </div>
                            <div class="col-12 col-md-9">
                                <label for="iso_ncr_note" class="modern-label">หมายเหตุ</label>
                                <input type="text" class="form-control form-control-indigo" name="iso_ncr_note" placeholder="ข้อมูลเพิ่มเติมอื่น ๆ (ถ้ามี)">
                            </div>
                        </div>

                        <hr class="my-4" style="border-top: 1px dashed #e2e8f0;">

                        <div class="row">
                            <div class="col-12 text-end">
                                <button type="button" onclick="history.back()" class="btn btn-muted-cancel me-2">
                                    ยกเลิก
                                </button>
                                <button type="submit" class="btn btn-indigo-save toastrDefaultSuccess">
                                    <i class="fas fa-save me-1"></i> บันทึกข้อมูล
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scriptjs')
<script>
    $(document).ready(function() {
        // สามารถเพิ่มการตั้งค่าหรือ Event ลิสเนอร์ของหน้าจอนี้เพิ่มเติมได้ที่นี่
    });
</script>
@endpush