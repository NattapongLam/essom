@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    :root {
        --indigo-primary: #6366f1;
        --indigo-hover: #4f46e5;
        --indigo-light: #e0e7ff;
        --indigo-bg: #f8fafc;
        --text-dark: #1e293b;
        --border-color: #e2e8f0;
    }

    body {
        background-color: var(--indigo-bg);
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(99, 102, 241, 0.08);
        background: #ffffff;
        overflow: hidden;
        transition: transform 0.2s ease;
    }

    .page-title-link {
        color: var(--indigo-primary);
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: color 0.2s;
    }

    .page-title-link:hover {
        color: var(--indigo-hover);
    }

    .form-label-custom {
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
    }

    .form-control-custom {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 0.6rem 0.9rem;
        font-size: 0.95rem;
        transition: all 0.2s ease-in-out;
    }

    .form-control-custom:focus {
        border-color: var(--indigo-primary);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }

    .form-control-custom[readonly] {
        background-color: #f1f5f9;
        color: #64748b;
    }

    .btn-indigo {
        background-color: var(--indigo-primary);
        border-color: var(--indigo-primary);
        color: #ffffff;
        border-radius: 8px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
        transition: all 0.2s;
    }

    .btn-indigo:hover {
        background-color: var(--indigo-hover);
        border-color: var(--indigo-hover);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.35);
    }

    /* Table Styling */
    .table-custom {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    .table-custom thead th {
        background-color: #f1f5f9;
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid var(--border-color);
        padding: 12px;
    }

    .table-custom tbody tr {
        transition: background-color 0.2s;
    }

    .table-custom tbody tr:hover {
        background-color: rgba(99, 102, 241, 0.03) !important;
    }

    .table-custom td {
        padding: 14px 12px;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-dark);
    }

    /* Alert Styling */
    .alert-custom {
        border: none;
        border-radius: 12px;
        font-weight: 500;
    }
</style>

<div class="container-fluid py-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show alert-custom shadow-sm mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="mdi mdi-check-all fs-4 me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show alert-custom shadow-sm mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="mdi mdi-block-helper fs-4 me-2"></i>
            <div>{{ session('error') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card custom-card">
        <form id="frm_sub" method="POST" action="{{ route('pd-woho.update', $hd->workinghours_hd_id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="card-body p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <h3 class="m-0">
                        <a href="{{route('pd-woho.index')}}" class="page-title-link">
                            <i class="mdi mdi-clock-outline"></i> เอกสารบันทึกชั่วโมงการทำงาน
                        </a>
                    </h3>
                    
                    @if ($hd->workinghours_status_id != 3)
                        <button type="submit" class="btn btn-indigo d-none d-md-block">
                            <i class="mdi mdi-content-save-move-outline me-1"></i> บันทึกข้อมูล
                        </button>
                    @endif
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="workinghours_hd_date" class="form-label-custom mb-2">วันที่</label>
                            <input type="text" class="form-control form-control-custom" name="workinghours_hd_date" 
                                id="workinghours_hd_date" value="{{\Carbon\Carbon::parse($hd->workinghours_hd_date)->format('d/m/Y')}}" 
                                autofocus readonly>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="workinghours_hd_docuno" class="form-label-custom mb-2">เลขที่</label>
                            <input type="text" class="form-control form-control-custom" name="workinghours_hd_docuno" 
                                id="workinghours_hd_docuno" value="{{$hd->workinghours_hd_docuno}}" readonly>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="ms_department_id" class="form-label-custom mb-2">แผนก</label>
                            <select class="form-control form-control-custom select2 @error('ms_department_id') is-invalid @enderror" style="width: 100%;" name="ms_department_id" id="ms_department_id">
                                <option value="">กรุณาเลือกแผนก</option>
                                @foreach ($dep as $item)
                                <option value="{{$item->ms_department_id}}"
                                    {{ old('ms_department_id', $hd->ms_department_id) == $item->ms_department_id ? 'selected' : null }}>
                                    {{$item->ms_department_name}}
                                </option>
                                @endforeach
                            </select>
                            @error('ms_department_id')
                            <div id="ms_department_id_validation" class="invalid-feedback mt-1">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="workinghours_hd_remark" class="form-label-custom mb-2">หมายเหตุ</label>
                            <input class="form-control form-control-custom" name="workinghours_hd_remark" 
                                id="workinghours_hd_remark" type="text" placeholder="ระบุหมายเหตุเพิ่มเติม (ถ้ามี)"
                                value="{{old('workinghours_hd_remark',$hd->workinghours_hd_remark)}}">
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <h5 class="form-label-custom mb-3" style="color: var(--indigo-primary);">
                        <i class="mdi mdi-format-list-bulleted me-1"></i> รายละเอียดเวลาทำงาน
                    </h5>
                    <div class="table-responsive border rounded-3">
                        <table class="table table-custom m-0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 80px;">ลำดับ</th>
                                    <th class="text-center">เลขที่งาน</th>
                                    <th>ชื่อ - นามสกุล</th>   
                                    <th class="text-center" style="width: 200px;">จำนวนชั่วโมง</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dt as $item)
                                <tr>
                                    <td class="text-center fw-bold text-muted">
                                        {{$item->workinghours_dt_listno}}
                                        <input type="hidden" value="{{$item->workinghours_dt_id}}" name="dt_id[]">
                                    </td>
                                    <td class="text-center"><span class="badge bg-light text-dark border px-2.5 py-2" style="font-size: 0.85rem;">{{$item->productionopenjob_hd_docuno}}</span></td>
                                    <td><span class="fw-medium">{{$item->ms_employee_fullname}}</span></td>
                                    <td class="text-center">
                                        <div class="input-group input-group-sm justify-content-center">
                                            <input type="text" class="form-control form-control-custom text-center" 
                                                name="dt_qty[]" value="{{number_format($item->workinghours_dt_hours,2)}}" 
                                                style="max-width: 120px; font-weight: 600;">
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($hd->workinghours_status_id != 3)
                    <div class="col-12 d-block d-md-none mt-4">
                        <button type="submit" class="btn btn-indigo w-100">
                            <i class="mdi mdi-content-save-move-outline me-1"></i> บันทึกข้อมูล
                        </button>
                    </div>
                @endif

            </div>
        </form>
    </div>
</div>
@endsection

@push('scriptjs')
<script src="{{ asset('/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush