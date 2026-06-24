@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<div class="container-fluid py-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-lg mb-4" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        <strong>สำเร็จ!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-lg mb-4" role="alert">
        <i class="mdi mdi-block-helper me-2"></i>
        <strong>เกิดข้อผิดพลาด!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-lg" style="background-color: #ffffff;">
                <form id="frm_sub" method="POST" class="form-horizontal m-0" action="{{ route('pd-noti.update', $hd->productionnotice_hd_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body p-4 sm:p-5">
                        
                        <div class="row align-items-center">
                            <div class="col-12 col-md-2 mb-3 mb-md-0">
                                <h3 class="card-title text-dark font-weight-bold m-0" style="font-size: 1.4rem; tracking: -0.5px;">
                                    <a href="{{route('pd-noti.index')}}" class="text-indigo text-decoration-none">ใบแจ้งผลิต</a>
                                </h3>
                            </div>
                            
                            <div class="col-12 col-md-10">
                                <div class="row gx-2 align-items-center justify-content-md-end">
                                    <div class="col-12 col-sm-3 col-md-3 mb-2 mb-sm-0">
                                        <select class="form-control rounded-lg border-gray-300 font-weight-medium" name="productionnotice_status_id" id="productionnotice_status_id" required autofocus>
                                            <option value="">-- เลือกสถานะ --</option>
                                            @foreach ($sta as $item)
                                            <option value="{{$item->productionnotice_status_id}}">{{$item->productionnotice_status_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-7 col-md-6 mb-2 mb-sm-0">
                                        <input type="text" class="form-control rounded-lg border-gray-300" placeholder="ระบุหมายเหตุการอนุมัติ / ไม่อนุมัติ..." name="approved_note" id="approved_note">
                                    </div>
                                    <div class="col-12 col-sm-2 col-md-3">
                                        <button type="submit" class="btn btn-indigo w-100 font-weight-bold rounded-lg py-2 shadow-sm-none">
                                            <i class="fas fa-save mr-1"></i> บันทึกเอกสาร
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="my-4" style="border-top: 1px solid #f1f5f9;">
                        
                        <div class="bg-light-balanced p-4 rounded-lg mb-4">
                            <h6 class="text-uppercase tracking-wider text-muted font-weight-bold mb-3" style="font-size: 0.8rem;">ข้อมูลทั่วไปของเอกสาร</h6>
                            
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3 mb-3">
                                    <label class="form-label-custom"><i class="far fa-calendar-alt mr-1"></i> วันที่เอกสาร</label>
                                    <input type="text" class="form-control form-control-custom" value="{{\Carbon\Carbon::parse($hd->productionnotice_hd_date)->format('d/m/Y')}}" readonly>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 mb-3">
                                    <label class="form-label-custom"><i class="fas fa-hashtag mr-1"></i> เลขที่ใบแจ้งผลิต</label>
                                    <input type="text" class="form-control form-control-custom text-indigo font-weight-bold" value="{{$hd->productionnotice_hd_docuno}}" readonly>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 mb-3">
                                    <label class="form-label-custom text-danger"><i class="far fa-clock mr-1"></i> กำหนดส่ง</label>
                                    <input type="text" class="form-control form-control-custom text-danger font-weight-bold" value="{{\Carbon\Carbon::parse($hd->productionnotice_hd_duedate)->format('d/m/Y')}}" readonly>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 mb-3">
                                    <label class="form-label-custom"><i class="far fa-user mr-1"></i> ผู้บันทึก</label>
                                    <input type="text" class="form-control form-control-custom" value="{{$hd->created_person}}" readonly>
                                </div>
                                
                            </div>
                            
                            {{-- <div class="row"> --}}
                                {{-- <div class="col-12 col-md-6 mb-3">
                                    <label class="form-label-custom"><i class="fas fa-box mr-1"></i> สินค้าหลัก</label>
                                    <input type="text" class="form-control form-control-custom text-dark font-weight-medium" value="{{$hd->ms_product_name}}" readonly>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 mb-3">
                                    <label class="form-label-custom"><i class="fas fa-calculator mr-1"></i> จำนวนผลิต</label>
                                    <input type="text" class="form-control form-control-custom font-weight-bold" value="{{$hd->product_qty}} / {{$hd->ms_productunit_name}}" readonly>
                                </div> --}}
                                {{-- <div class="col-12 col-sm-6 col-md-3 mb-3">
                                    <label class="form-label-custom"><i class="fas fa-layer-group mr-1"></i> Spec Page</label>
                                    <input type="text" class="form-control form-control-custom" value="{{$hd->ms_specpage_name}}" readonly>
                                </div> --}}
                            {{-- </div> --}}
                            
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3 mb-md-0">
                                    <label class="form-label-custom"><i class="far fa-building mr-1"></i> ลูกค้า</label>
                                    <input type="text" class="form-control form-control-custom" value="{{$hd->ms_customer_name}}" readonly>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 mb-3 mb-sm-0">
                                    <label class="form-label-custom"><i class="far fa-calendar-check mr-1"></i> วันที่อนุมัติ</label>
                                    <input type="text" class="form-control form-control-custom" value="{{ $hd->approved_date ? \Carbon\Carbon::parse($hd->approved_date)->format('d/m/Y') : '-' }}" readonly>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <label class="form-label-custom"><i class="fas fa-user-check mr-1"></i> ผู้อนุมัติ</label>
                                    <input type="text" class="form-control form-control-custom" value="{{$hd->approved_by ?: '-'}}" readonly>
                                </div>
                            </div>

                            @if ($hd->productionnotice_hd_filename1 || $hd->productionnotice_hd_filename2)
                            <div class="row mt-3 pt-3" style="border-top: 1px dashed #e2e8f0;">
                                @if ($hd->productionnotice_hd_filename1)
                                <div class="col-12 col-sm-6">
                                    <label class="form-label-custom d-block">เอกสารแนบ 1</label>
                                    <a href="{{asset($hd->productionnotice_hd_filename1)}}" target="_blank" class="btn btn-sm btn-action-view text-decoration-none px-3 py-2 rounded-lg font-weight-medium">
                                        <i class="fas fa-file-pdf mr-1"></i> เปิดดูเอกสารแนบหลัก
                                    </a>
                                </div>
                                @endif
                                @if ($hd->productionnotice_hd_filename2)
                                <div class="col-12 col-sm-6 mt-2 mt-sm-0">
                                    <label class="form-label-custom d-block">เอกสารแนบ 2</label>
                                    <a href="{{asset($hd->productionnotice_hd_filename2)}}" target="_blank" class="btn btn-sm btn-action-view text-decoration-none px-3 py-2 rounded-lg font-weight-medium">
                                        <i class="fas fa-file-pdf mr-1"></i> เปิดดูเอกสารแนบเพิ่มเติม
                                    </a>
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="form-group mb-0">
                                    <label class="form-label-custom"><i class="far fa-comment-alt mr-1"></i> รายละเอียด / หมายเหตุท้ายเอกสาร</label>
                                    <textarea class="form-control rounded-lg bg-light border-0 text-muted" rows="5" style="resize: none; font-size: 0.95rem;" readonly>{{$hd->productionnotice_hd_remark ?: 'ไม่มีหมายเหตุระบุไว้'}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow-none border-0 mb-0">
                                    <div class="card-header p-0 border-bottom">
                                        <ul class="nav nav-tabs nav-tabs-balanced" id="custom-tabs-four-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">
                                                    <i class="fas fa-list-ul mr-1"></i> รายละเอียดสินค้าประกอบ
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">
                                                    <i class="fas fa-plus-circle mr-1"></i> ข้อกำหนดเพิ่มเติม (Optional)
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body px-0 pt-4 pb-0">
                                        <div class="tab-content" id="custom-tabs-four-tabContent">
                                            
                                            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                                <div class="table-responsive">
                                                    <table class="table table-balanced align-middle table-hover border">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" style="width: 6%;">#</th>
                                                                <th class="text-center" style="width: 14%;">กำหนดส่ง</th>
                                                                <th class="text-left" style="width: 30%;">สินค้าย่อย</th>
                                                                <th class="text-center" style="width: 15%;">จำนวนผลิต</th>
                                                                <th class="text-left" style="width: 20%;">รายละเอียด</th>
                                                                <th class="text-center" style="width: 15%;">Spec Page</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($dt as $item)
                                                            <tr>
                                                                <td class="text-center text-muted font-weight-medium">{{$item->productionnotice_dt_listno}}</td>
                                                                <td class="text-center text-secondary font-weight-bold">{{\Carbon\Carbon::parse($item->productionnotice_dt_duedate)->format('d/m/Y')}}</td>
                                                                <td class="text-left text-dark font-weight-medium">{{$item->ms_product_seminame}}</td>
                                                                <td class="text-center">
                                                                    <span class="badge badge-indigo-soft px-2 py-1">
                                                                        {{$item->ms_product_semiqty}} / {{$item->ms_product_semiunit}}
                                                                    </span>
                                                                </td>
                                                                <td class="text-left text-muted" style="font-size: 0.9rem;">{{$item->productionnotice_dt_remark ?: '-'}}</td>
                                                                <td class="text-center">
                                                                    <a href="{{asset($item->filename)}}" target="_blank" class="text-indigo font-weight-bold text-decoration-none" style="font-size: 0.9rem;">
                                                                        <i class="fas fa-file-pdf mr-1"></i> {{$item->ms_specpage_name}}
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            
                                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                                <div class="table-responsive">
                                                    <table class="table table-balanced align-middle table-hover border">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-left" style="width: 25%;">สินค้า</th>
                                                                <th class="text-center" style="width: 12%;">จำนวน</th>
                                                                <th class="text-left" style="width: 21%;">รายละเอียดทั่วไป</th>
                                                                <th class="text-left" style="width: 21%;">รายละเอียดไฟฟ้า</th>
                                                                <th class="text-left" style="width: 21%;">รายละเอียด Software</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($op as $item)
                                                            <tr>
                                                                <td class="text-left text-dark font-weight-medium">{{$item->productionnotice_op_name}}</td>
                                                                <td class="text-center">
                                                                    <span class="badge badge-light border text-muted px-2 py-1">
                                                                        {{$item->productionnotice_op_qty}} / {{$item->productionnotice_op_unit}}
                                                                    </span>
                                                                </td>
                                                                <td class="text-left text-muted" style="font-size: 0.9rem;">{{$item->productionnotice_op_remark ?: '-'}}</td>
                                                                <td class="text-left text-muted" style="font-size: 0.9rem;">{{$item->productionnotice_op_elect ?: '-'}}</td>
                                                                <td class="text-left text-muted" style="font-size: 0.9rem;">{{$item->productionnotice_op_software ?: '-'}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
                
                <div wire:loading wire:target="save" wire:loading.class="overlay" wire:loading.flex>
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fas fa-3x fa-circle-notch fa-spin text-indigo"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root { --indigo-primary: #4f46e5; --indigo-hover: #4338ca; }
    .text-indigo { color: var(--indigo-primary) !important; }
    .btn-indigo { background-color: var(--indigo-primary) !important; border-color: var(--indigo-primary) !important; color: #ffffff !important; transition: all 0.2s; }
    .btn-indigo:hover { background-color: var(--indigo-hover) !important; border-color: var(--indigo-hover) !important; }
    .rounded-lg { border-radius: 0.75rem !important; }
    
    /* สไตล์คัสตอมฟอร์มกล่องข้อมูล Readonly */
    .bg-light-balanced { background-color: #f8fafc; border: 1px solid #e2e8f0; }
    .form-label-custom { font-size: 0.82rem; color: #64748b; font-weight: 700; margin-bottom: 5px; display: inline-block; }
    .form-control-custom { background-color: #ffffff !important; border: 1px solid #cbd5e1 !important; border-radius: 0.5rem !important; color: #475569 !important; font-size: 0.95rem; padding: 0.45rem 0.75rem; height: auto; }
    .form-control-custom:focus { box-shadow: none; border-color: #cbd5e1; }

    /* ปุ่มเปิดดูไฟล์แนบ */
    .btn-action-view { background-color: #e0e7ff; color: var(--indigo-primary); display: inline-flex; align-items: center; }
    .btn-action-view:hover { background-color: #c7d2fe; color: var(--indigo-hover); }

    /* ตารางโครงสร้างสมดุล (Table Layout Balanced) */
    .table-balanced thead th { background-color: #f1f5f9; border-bottom: 2px solid #e2e8f0 !important; font-size: 0.85rem; color: #475569; font-weight: 700; padding: 12px 8px; border-top: none; }
    .table-balanced tbody tr { transition: background-color 0.15s; }
    .table-balanced tbody tr:hover { background-color: #f8fafc !important; }
    .align-middle td { vertical-align: middle !important; padding: 12px 8px !important; color: #334155; font-size: 0.92rem; }

    /* ป้ายสถานะ */
    .badge-indigo-soft { background-color: #eef2ff; color: var(--indigo-primary); border-radius: 6px; font-weight: 600; }
    
    /* แท็บหัวข้อ */
    .nav-tabs-balanced { border-bottom: 2px solid #f1f5f9; }
    .nav-tabs-balanced .nav-link { border: none; color: #64748b; font-weight: 500; padding: 10px 16px; transition: all 0.2s; }
    .nav-tabs-balanced .nav-link.active { color: var(--indigo-primary) !important; background: transparent; border-bottom: 3px solid var(--indigo-primary) !important; font-weight: 600; }
</style>
@endsection

@push('scriptjs')
<script src="{{ asset('/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    // ส่งค่าข้อมูลสถานะตั้งต้นเดิมที่มีอยู่ใน Database ไปยังกล่อง Select (ถ้ามี)
    $(document).ready(function() {
        let currentStatus = "{{ $hd->productionnotice_status_id }}";
        if(currentStatus) {
            $('#productionnotice_status_id').val(currentStatus);
        }
        
        let currentNote = "{{ $hd->approved_note }}";
        if(currentNote) {
            $('#approved_note').val(currentNote);
        }
    });
</script>
@endpush