@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<div class="mt-2">
    <div class="row">
        @if(session('success'))
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show rounded-lg shadow-sm border-0" role="alert">
                <i class="mdi mdi-check-all me-2"></i>
                <strong>สำเร็จ!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @elseif(session('error'))
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show rounded-lg shadow-sm border-0" role="alert">
                <i class="mdi mdi-block-helper me-2"></i>
                <strong>เกิดข้อผิดพลาด!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

        <div class="col-12">
            <div class="card card-outline border-top-0 shadow-sm rounded-lg">
                <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('pd-retu.update', $hd->returnorder_hd_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body p-4">
                        <div class="row align-items-center mb-4">
                            <div class="col-12 col-xl-3 mb-3 mb-xl-0">
                                <h3 class="card-title text-dark mb-0" style="font-weight: 700; font-size: 1.4rem;">
                                    <a href="{{route('pd-retu.index')}}" class="text-indigo text-decoration-none mr-1">
                                        <i class="fas fa-arrow-left mr-1" style="font-size: 1.1rem;"></i> ใบรับคืนจากการเบิก
                                    </a>
                                    <span class="text-secondary" style="font-weight: 400; font-size: 1.2rem;">/ แก้ไขเอกสาร</span>
                                </h3>
                            </div>
                            
                            @if ($hd->returnorder_status_id != 3)
                            <div class="col-12 col-sm-4 col-xl-2 mb-2 mb-sm-0">
                                <div class="form-group mb-0">
                                    <select class="form-control rounded-lg border-gray-300 font-weight-bold" name="returnorder_status_id" id="returnorder_status_id">
                                        <option value="0">กรุณาเลือกสถานะ</option>
                                        @foreach ($sta as $item)
                                        <option value="{{$item->returnorder_status_id}}">{{$item->returnorder_status_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-5 col-xl-5 mb-2 mb-sm-0">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control rounded-lg border-gray-300" placeholder="ระบุหมายเหตุการเปลี่ยนสถานะ..." name="note" id="note">
                                </div>
                            </div>
                            <div class="col-12 col-sm-3 col-xl-2 text-right">
                                <button type="submit" class="btn btn-indigo btn-block px-4 shadow-sm font-weight-bold rounded-lg">
                                    <i class="fas fa-save mr-1"></i> บันทึกข้อมูล
                                </button>
                            </div>
                            @endif              
                        </div>

                        <hr class="my-4 border-gray-200">

                        <div class="row mb-1">
                            <div class="col-12 col-md-3 mb-3">
                                <label class="text-muted font-weight-bold mb-1">วันที่เอกสาร</label>
                                <input type="text" class="form-control bg-light rounded-lg border-gray-200 font-weight-bold" value="{{\Carbon\Carbon::parse($hd->returnorder_hd_date)->format('d/m/Y')}}" readonly>
                            </div>
                            <div class="col-12 col-md-3 mb-3">
                                <label class="text-muted font-weight-bold mb-1">เลขที่ใบรับคืน</label>
                                <input type="text" class="form-control bg-light rounded-lg border-gray-200 font-weight-bold text-primary" value="{{$hd->returnorder_hd_docuno}}" readonly>
                            </div>
                            <div class="col-12 col-md-3 mb-3">
                                <label class="text-muted font-weight-bold mb-1">เลขที่ใบเปิดงาน</label>
                                <input type="text" class="form-control bg-light rounded-lg border-gray-200 font-weight-bold" value="{{$hd->productionopenjob_hd_docuno}}" readonly>
                            </div>
                            <div class="col-12 col-md-3 mb-3">
                                <label class="text-muted font-weight-bold mb-1">เลขที่ใบเบิกวัสดุอุปกรณ์</label>
                                <input type="text" class="form-control bg-light rounded-lg border-gray-200 font-weight-bold text-indigo" value="{{$hd->ladingorder_hd_docuno}}" readonly>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12 col-md-3 mb-3">
                                <label class="text-muted font-weight-bold mb-1">ผู้ส่งคืนพัสดุ</label>
                                <input type="text" class="form-control bg-light rounded-lg border-gray-200" value="{{$hd->created_person}}" readonly>
                            </div>
                            <div class="col-12 col-md-9 mb-3">
                                <label class="text-muted font-weight-bold mb-1">หมายเหตุเอกสาร</label>
                                <input type="text" class="form-control bg-light rounded-lg border-gray-200 text-secondary" value="{{$hd->returnorder_hd_note ?: '-'}}" readonly>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="form-group mb-0">
                                    <label class="font-weight-bold text-dark mb-2" style="font-size: 1.1rem;">
                                        <i class="fas fa-list-ul text-indigo mr-1"></i> รายละเอียดรายการวัสดุอุปกรณ์ที่ส่งคืน
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-custom table-hover align-middle table-sm">
                                            <thead>
                                                <tr>
                                                    <th class="text-center text-secondary py-3" style="width: 80px;">ลำดับ</th>
                                                    <th class="text-secondary py-3">ข้อมูลสินค้า (รหัส / รายชื่อสินค้า)</th>
                                                    <th class="text-right text-secondary py-3" style="width: 180px;">จำนวนเบิก</th>
                                                    <th class="text-right text-secondary py-3" style="width: 180px;">จำนวนส่งคืน</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dt as $item)
                                                    <tr>
                                                        <td class="text-center text-secondary font-weight-bold">{{$item->returnorder_dt_listno}}</td>
                                                        <td>
                                                            <span class="text-dark font-weight-bold mr-2">{{$item->ms_product_code}}</span>
                                                            <span class="text-muted">/ {{$item->ms_product_name}}</span>
                                                        </td>
                                                        <td class="text-right font-weight-bold text-secondary">
                                                            {{number_format($item->ladingorder_dt_qty,2)}}
                                                            <span class="badge badge-light-indigo px-2 ml-1" style="font-weight: 500;">{{$item->ms_product_unit}}</span>
                                                        </td>
                                                        <td class="text-right font-weight-bold text-success">
                                                            {{number_format($item->returnorder_dt_qty,2)}}
                                                            <span class="badge badge-light-success px-2 ml-1" style="font-weight: 500; background-color: #d1fae5; color: #065f46;">{{$item->ms_product_unit}}</span>
                                                        </td>
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
    /* ธีมสีหลัก Indigo */
    .text-indigo { color: #4f46e5 !important; }
    .btn-indigo {
        background-color: #4f46e5 !important;
        border-color: #4f46e5 !important;
        color: #ffffff !important;
    }
    .btn-indigo:hover {
        background-color: #4338ca !important;
        border-color: #4338ca !important;
        color: #ffffff !important;
    }
    
    /* สไตล์คัสตอมตารางตระกูลใบเปิดงาน */
    .table-custom thead th {
        border-bottom: 2px solid #e2e8f0 !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        background-color: #f8fafc;
    }
    .table-custom tbody tr { transition: all 0.2s; }
    .table-custom tbody tr:hover { background-color: #f1f5f9 !important; }
    .align-middle td { vertical-align: middle !important; }
    
    /* สไตล์เลเบลป้ายกำกับมน */
    .badge-light-indigo {
        background-color: #e0e7ff;
        color: #4f46e5;
    }
</style>
@endsection

@push('scriptjs')
<script src="{{ asset('/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush