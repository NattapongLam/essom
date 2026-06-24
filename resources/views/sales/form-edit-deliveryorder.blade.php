@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<div class="container-fluid py-4">
    <div class="row">
        @if(session('success'))
        <div class="col-12 mb-3">
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-lg py-3" role="alert">
                <i class="mdi mdi-check-all me-2 font-size-16 text-success"></i>
                <strong class="text-success">{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @elseif(session('error'))
        <div class="col-12 mb-3">
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-lg py-3" role="alert">
                <i class="mdi mdi-block-helper me-2 font-size-16 text-danger"></i>
                <strong class="text-danger">{{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-lg" style="background-color: #ffffff;">
                <form id="frm_sub" method="POST" class="form-horizontal m-0" action="{{ route('del-order.update', $hd->deliveryorder_hd_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body p-4 sm:p-5">
                        <div class="row align-items-center mb-4 pb-3 border-bottom" style="border-color: #f1f5f9 !important;">
                            <div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-0">
                                <h3 class="card-title text-dark font-weight-bold m-0" style="font-size: 1.35rem; tracking: -0.5px;">
                                    <a href="{{route('del-order.index')}}" class="text-indigo-link text-decoration-none">ใบนำส่งสินค้า</a>
                                    <span class="text-muted font-weight-light" style="font-size: 1.1rem; padding: 0 4px;">/</span>
                                    <span class="text-secondary" style="font-size: 1.2rem;">จัดการเอกสาร</span>
                                </h3>
                            </div>
                            <div class="col-12 col-md-5 col-lg-6 mb-3 mb-md-0">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control rounded-lg border-gray-300 py-2 px-3" placeholder="ระบุหมายเหตุการแก้ไขเพิ่มเติมที่นี่..." name="note" id="note">
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <button type="submit" class="btn btn-indigo w-100 font-weight-bold rounded-lg shadow-sm-none py-2">
                                    <i class="fas fa-save mr-2"></i> บันทึกข้อมูล
                                </button>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label text-muted font-weight-bold small mb-1">วันที่เอกสาร</label>
                                    <input type="date" class="form-control form-control-readonly rounded-lg" value="{{$hd->deliveryorder_hd_date}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label text-muted font-weight-bold small mb-1">เลขที่ใบนำส่งสินค้า</label>
                                    <input type="text" class="form-control form-control-readonly rounded-lg text-indigo font-weight-bold" value="{{$hd->deliveryorder_hd_docuno}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label text-muted font-weight-bold small mb-1">เลขที่อ้างอิง</label>
                                    <input type="text" class="form-control form-control-readonly rounded-lg" value="{{$hd->productionnotice_hd_docuno ?: '-'}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label text-muted font-weight-bold small mb-1">กำหนดส่ง</label>
                                    <input type="date" class="form-control form-control-readonly rounded-lg text-danger font-weight-bold" value="{{$hd->deliveryorder_hd_duedate}}" readonly>
                                </div>
                            </div>
                        </div> 

                        <div class="row mb-2">
                            <div class="col-12 col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label text-muted font-weight-bold small mb-1">ลูกค้า</label>
                                    <input type="text" class="form-control form-control-readonly rounded-lg text-dark font-weight-medium" value="{{$hd->ms_customer_name}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label text-muted font-weight-bold small mb-1">สถานที่จัดส่ง</label>
                                    <input type="text" class="form-control form-control-readonly rounded-lg" value="{{$hd->ms_customer_delivery ?: '-'}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label text-muted font-weight-bold small mb-1">ผู้ติดต่อ</label>
                                    <input type="text" class="form-control form-control-readonly rounded-lg" value="{{$hd->ms_customer_contactn ?: '-'}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label text-muted font-weight-bold small mb-1">Spec Page</label>
                                    <input type="text" class="form-control form-control-readonly rounded-lg" value="{{$hd->ms_specpage_name ?: '-'}}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label class="form-label text-muted font-weight-bold small mb-1">หมายเหตุหลักจากระบบ</label>
                                    <input type="text" class="form-control form-control-readonly rounded-lg italic text-muted" value="{{$hd->deliveryorder_hd_note ?: '-'}}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 mb-4 rounded-lg" style="background-color: #f8fafc; border: 1px dashed #cbd5e1;">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group mb-2 mb-md-0">
                                        <label for="checked_date" class="form-label text-dark font-weight-bold small mb-1"><i class="fas fa-calendar-check text-indigo mr-1"></i> วันที่ตรวจสอบ</label>
                                        <input type="date" class="form-control rounded-lg border-gray-300" name="checked_date" id="checked_date">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group mb-2 mb-md-0">
                                        <label for="checked_by" class="form-label text-dark font-weight-bold small mb-1"><i class="fas fa-user-check text-indigo mr-1"></i> ผู้ตรวจสอบ</label>
                                        <select class="form-control select2 rounded-lg" style="width: 100%;" name="checked_by" id="checked_by">
                                            <option selected="selected" value="">กรุณาเลือกผู้ตรวจสอบ</option>
                                            @foreach ($emp as $item)
                                            <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_code}} / {{$item->ms_employee_fullname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group mb-2 mb-sm-0">
                                        <label for="delivery_date" class="form-label text-dark font-weight-bold small mb-1"><i class="fas fa-shipping-fast text-indigo mr-1"></i> วันที่จัดส่ง</label>
                                        <input type="date" class="form-control rounded-lg border-gray-300" name="delivery_date" id="delivery_date">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group mb-0">
                                        <label for="delivery_by" class="form-label text-dark font-weight-bold small mb-1"><i class="fas fa-user-astronaut text-indigo mr-1"></i> ผู้จัดส่ง</label>
                                        <select class="form-control select2 rounded-lg" style="width: 100%;" name="delivery_by" id="delivery_by">
                                            <option selected="selected" value="">กรุณาเลือกผู้จัดส่ง</option>
                                            @foreach ($emp as $item)
                                            <option value="{{$item->ms_employee_fullname}}">{{$item->ms_employee_code}} / {{$item->ms_employee_fullname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group mb-0">
                                    <label class="form-label text-dark font-weight-bold mb-2" style="font-size: 1.05rem;">
                                        <i class="fas fa-clipboard-list text-indigo mr-1"></i> รายการสินค้าแนบใบนำส่ง
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-balanced align-middle table-bordered border">
                                            <thead>
                                                <tr>
                                                    <th class="text-left py-3 text-secondary font-weight-bold" style="width: 20%;">S/N MODEL</th>
                                                    <th class="text-left py-3 text-secondary font-weight-bold" style="width: 25%;">Description</th>  
                                                    <th class="text-center py-3 text-secondary font-weight-bold" style="width: 10%;">Qty.</th>                                   
                                                    <th class="text-center py-3 text-secondary font-weight-bold" style="width: 12%;">Del. Chk.</th>    
                                                    <th class="text-center py-3 text-secondary font-weight-bold" style="width: 12%;">Rec. Chk.</th>  
                                                    <th class="text-left py-3 text-secondary font-weight-bold" style="width: 21%;">Part No./Note</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dt as $item)
                                                <tr>
                                                    <td class="text-left font-weight-medium text-dark">{{$item->deliveryorder_dt_model ?: '-'}}</td>
                                                    <td class="text-left text-muted" style="font-size: 0.9rem;">{{$item->deliveryorder_dt_desp ?: '-'}}</td>
                                                    <td class="text-center font-weight-bold text-secondary">{{number_format($item->deliveryorder_dt_qty,2)}}</td>
                                                    <td class="text-center">
                                                        <input type="checkbox" class="custom-cb" name="deliveryorder_dt_id[]" value="{{$item->deliveryorder_dt_id}}" {{ $item->del_checked ? 'checked' : '' }}>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="checkbox" class="custom-cb" name="rec_checked[]" value="{{$item->rec_checked}}" {{ $item->rec_checked ? 'checked' : '' }}>
                                                    </td>
                                                    <td class="text-left text-muted" style="font-size: 0.9rem;">{{$item->deliveryorder_dt_remark ?: '-'}}</td>                                  
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    :root { --indigo-primary: #4f46e5; --indigo-hover: #4338ca; }
    .text-indigo { color: var(--indigo-primary) !important; }
    .text-indigo-link { color: var(--indigo-primary); font-weight: bold; transition: opacity 0.15s; }
    .text-indigo-link:hover { color: var(--indigo-hover); opacity: 0.85; text-decoration: underline !important; }
    
    .btn-indigo { background-color: var(--indigo-primary) !important; border-color: var(--indigo-primary) !important; color: #ffffff !important; transition: all 0.2s; }
    .btn-indigo:hover { background-color: var(--indigo-hover) !important; border-color: var(--indigo-hover) !important; transform: translateY(-1px); }
    
    .rounded-lg { border-radius: 0.75rem !important; }
    
    /* สไตล์คัสตอมฟอร์มที่ไม่ต้องการให้แก้ไขข้อมูล (Readonly Look) */
    .form-control-readonly { background-color: #f1f5f9 !important; border-color: #e2e8f0 !important; color: #475569 !important; cursor: not-allowed; }
    
    /* ตารางแบบแนวทางเดียวกัน (Balanced Table View) */
    .table-balanced { width: 100% !important; margin-bottom: 0 !important; }
    .table-balanced thead th { background-color: #f8fafc; border-bottom: 2px solid #e2e8f0 !important; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px; border-top: none; }
    .align-middle td { vertical-align: middle !important; padding: 12px 10px !important; color: #334155; font-size: 0.92rem; }
    
    /* สไตล์กล่องเลือกติ๊กถูก */
    .custom-cb { width: 18px; height: 18px; accent-color: var(--indigo-primary); cursor: pointer; vertical-align: middle; }
</style>
@endsection

@push('scriptjs')
    <script src="{{ asset('/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2({
                placeholder: "กรุณาเลือกข้อมูล",
                allowClear: true
            });
        });
    </script>
@endpush