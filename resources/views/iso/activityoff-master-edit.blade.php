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
    .btn-indigo-add {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        padding: 0.6rem 1.25rem !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        font-size: 0.875rem;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2) !important;
        transition: all 0.2s ease !important;
        border: none !important;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-indigo-add:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.35) !important;
        transform: translateY(-1px);
        color: #ffffff !important;
        text-decoration: none;
    }
    .section-group-header {
        background-color: #f1f5f9 !important;
        font-weight: bold;
        color: #1e293b;
    }
</style>

<div class="objective-container">
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <form action="{{ route('activityoff-masters.update', $hd->activitysoff_master_hds_id) }}" method="POST">
                    @csrf 
                    @method('PUT')

                    <div class="card-header">
                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                            <div>
                                <div class="company-title">ESSOM CO., LTD.</div>
                                <h5 class="main-title mb-1">
                                    ตั้งค่าการตรวจพื้นที่ประจำเดือน (สำนักงาน)
                                </h5>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('activityoff-masters.index') }}" class="btn btn-secondary" style="border-radius: 10px; padding: 0.6rem 1.25rem;">
                                    <i class="fas fa-arrow-left"></i> ย้อนกลับ
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
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
                                        <th style="width: 22%;">พื้นที่ตรวจเช็ค</th>
                                        <th style="width: 12%;">ข้อ</th>
                                        <th style="width: 43%; text-align: left; padding-left: 1rem !important;">รายละเอียด</th>
                                        <th style="width: 8%;">เต็ม</th>
                                        <th style="width: 15%;">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // โครงสร้างหมวดหมู่หลัก
                                        $sections = [
                                            1 => [
                                                'title' => '1. บริเวณทำงาน',
                                                'sub' => 'ตึกงานบริหารงานขายอุปกรณ์อุตสาหกรรมและงานขายอุปกรณ์การศึกษา',
                                                'area' => 'บริเวณทำงาน'
                                            ],
                                            2 => [
                                                'title' => '2. พื้นที่ส่วนกลาง',
                                                'sub' => 'ตรวจงานบริหาร',
                                                'area' => 'พื้นที่ส่วนกลาง'
                                            ],
                                            3 => [
                                                'title' => '3. สโตร์ และ Shop พ่นสี',
                                                'sub' => 'ตรวจงานบริหารและงานขายอุปกรณ์อุตสาหกรรม',
                                                'area' => 'สโตร์ และ Shop พ่นสี'
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($sections as $secNum => $secMeta)
                                        <!-- หัวข้อหมวด -->
                                        <tr class="section-group-header">
                                            <td colspan="5" class="text-start px-3">
                                                {{ $secMeta['title'] }}
                                                <br><small class="text-muted fw-normal">{{ $secMeta['sub'] }}</small>
                                            </td>
                                        </tr>

                                        <!-- ดึงรายการย่อยจาก Database ขึ้นมาแสดง -->
                                        @if (isset($detailsGrouped[$secNum]) && $detailsGrouped[$secNum]->count() > 0)
                                            @foreach ($detailsGrouped[$secNum] as $dt)
                                                <tr>
                                                    <td>{{ $secMeta['area'] }}</td>
                                                    <td>
                                                        <input type="text" name="item[{{ $secNum }}][code][]" class="form-control text-center" value="{{ $dt->code }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="item[{{ $secNum }}][detail][]" class="form-control" value="{{ $dt->detail }}" placeholder="ระบุรายละเอียดหัวข้อย่อย">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="item[{{ $secNum }}][score][]" class="form-control text-center" value="{{ $dt->score }}">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-success add-row"><i class="fas fa-plus"></i> เพิ่ม</button>
                                                        <button type="button" class="btn btn-sm btn-danger remove-row"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <!-- ถ้าใน DB ยังไม่มีข้อมูล ให้แสดงแถวว่างเริ่มต้น 1 แถว -->
                                            <tr>
                                                <td>{{ $secMeta['area'] }}</td>
                                                <td>
                                                    <input type="text" name="item[{{ $secNum }}][code][]" class="form-control text-center" value="{{ $secNum }}.1">
                                                </td>
                                                <td>
                                                    <input type="text" name="item[{{ $secNum }}][detail][]" class="form-control" placeholder="ระบุรายละเอียดหัวข้อย่อย">
                                                </td>
                                                <td>
                                                    <input type="text" name="item[{{ $secNum }}][score][]" class="form-control text-center" value="5">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success add-row"><i class="fas fa-plus"></i> เพิ่ม</button>
                                                    <button type="button" class="btn btn-sm btn-danger remove-row"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn-indigo-add">
                                <i class="fas fa-save"></i> บันทึกการเปลี่ยนแปลง
                            </button>
                        </div>
                    </div> <!-- card-body -->
                </form> 
            </div> <!-- card -->
        </div>
    </div>
</div>
@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
$(document).ready(function() {
    // อัปเดตชื่อ name ของ Input ให้ตรงตามหมวดหมู่
    function updateRowIndexes() {
        $('.section-group-header').each(function(index) {
            let sectionNum = index + 1;
            let $tr = $(this).next();

            while ($tr.length && !$tr.hasClass('section-group-header')) {
                $tr.find('td:nth-child(2) input').attr('name', `item[${sectionNum}][code][]`);
                $tr.find('td:nth-child(3) input').attr('name', `item[${sectionNum}][detail][]`);
                $tr.find('td:nth-child(4) input').attr('name', `item[${sectionNum}][score][]`);
                $tr = $tr.next();
            }
        });
    }

    // ปุ่มเพิ่มแถวใหม่ (Add Row)
    $(document).on('click', '.add-row', function() {
        let $sectionHeader = $(this).closest('tr').prevAll('.section-group-header:first');
        if($sectionHeader.length === 0) {
            $sectionHeader = $(this).closest('tr').prev('.section-group-header');
        }
        
        let areaName = $sectionHeader.text().trim().split('\n')[0].replace(/^\d+\.\s*/, '');

        let newRow = `
            <tr>
                <td>${areaName}</td>
                <td><input type="text" class="form-control text-center" placeholder="เช่น 1.4.1"></td>
                <td><input type="text" class="form-control" placeholder="ระบุรายละเอียดหัวข้อย่อย"></td>
                <td><input type="text" class="form-control text-center" value="5"></td>
                <td>
                    <button type="button" class="btn btn-sm btn-success add-row"><i class="fas fa-plus"></i> เพิ่ม</button>
                    <button type="button" class="btn btn-sm btn-danger remove-row"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        `;

        let $currentRow = $(this).closest('tr');
        let $nextTr = $currentRow.next();
        while($nextTr.length && !$nextTr.hasClass('section-group-header')) {
            $currentRow = $nextTr;
            $nextTr = $currentRow.next();
        }
        $currentRow.after(newRow);

        updateRowIndexes();
    });

    // ปุ่มลบแถว (Remove Row)
    $(document).on('click', '.remove-row', function() {
        let $currentRow = $(this).closest('tr');
        let sectionHeader = $currentRow.prevAll('.section-group-header:first');
        let countInGroup = 0;
        let $check = sectionHeader.next();
        
        while($check.length && !$check.hasClass('section-group-header')) {
            countInGroup++;
            $check = $check.next();
        }

        if(countInGroup <= 1) {
            Swal.fire({
                title: 'ไม่สามารถลบได้',
                text: 'ต้องมีรายการย่อยอย่างน้อย 1 รายการในหมวดหมู่นี้',
                icon: 'warning',
                confirmButtonColor: '#6366f1'
            });
            return;
        }

        $currentRow.remove();
        updateRowIndexes();
    });

    updateRowIndexes();
});
</script>
@endpush