@extends('layouts.main')
@section('content')

<style>
    :root {
        --primary-indigo: #6366f1;
        --primary-hover: #4f46e5;
        --bg-light-purple: #f5f3ff;
        --text-dark: #1f2937;
        --border-color: #e5e7eb;
    }
    
    body {
        background-color: #fafafa;
        color: var(--text-dark);
    }

    /* Custom Modern Card */
    .modern-card {
        background: #ffffff;
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(99, 102, 241, 0.04);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    /* Form Controls */
    .modern-input, .modern-select, .modern-textarea {
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 0.6rem 1rem;
        font-size: 0.95rem;
        transition: all 0.2s ease-in-out;
        background-color: #fff;
    }
    .modern-input:focus, .modern-select:focus, .modern-textarea:focus {
        border-color: var(--primary-indigo);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        outline: none;
    }
    .modern-input[readonly], .modern-textarea[readonly] {
        background-color: var(--bg-light-purple);
        border-color: transparent;
        color: #4b5563;
    }

    /* Buttons */
    .btn-indigo {
        background-color: var(--primary-indigo);
        color: white;
        border-radius: 10px;
        padding: 0.6rem 1.5rem;
        font-weight: 500;
        border: none;
        transition: all 0.2s;
    }
    .btn-indigo:hover {
        background-color: var(--primary-hover);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }

    /* Modern Table */
    .modern-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }
    .modern-table th {
        background-color: var(--bg-light-purple);
        color: #4338ca;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border: none;
        padding: 12px 16px;
    }
    .modern-table td {
        padding: 14px 16px;
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
    }
    .modern-table tr:last-child td {
        border-bottom: none;
    }

    /* Status Badges */
    .badge-status {
        background-color: #fee2e2;
        color: #ef4444;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-note {
        background-color: #f3f4f6;
        color: #374151;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 500;
        display: inline-block;
    }

    /* Custom Navigation Tabs */
    .modern-tabs .nav-link {
        border: none;
        color: #6b7280;
        font-weight: 500;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        margin-right: 0.5rem;
    }
    .modern-tabs .nav-link.active {
        background-color: var(--primary-indigo) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
    }

    /* Modal Styling */
    .modern-modal {
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }
    .modern-modal .modal-header {
        background-color: var(--bg-light-purple);
        border-bottom: 1px solid rgba(99, 102, 241, 0.1);
    }

    /* Breadcrumb Link */
    .back-link {
        color: var(--primary-indigo);
        text-decoration: none;
        transition: color 0.2s;
    }
    .back-link:hover {
        color: var(--primary-hover);
        text-decoration: underline;
    }
</style>

<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css')}}">

<div class="container-fluid py-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
        <i class="mdi mdi-block-helper me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="modern-card shadow-sm">
                <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('pd-close.update', $hd->productionopenjob_hd_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row align-items-center g-3 mb-4">
                        <div class="col-12 col-md-3">
                            <h3 class="m-0" style="font-weight: 700; font-size: 1.4rem;">
                                <a href="{{route('pd-close.index')}}" class="back-link">ใบปิดงาน</a><span class="text-muted"> / เอกสารปิดงาน</span>
                            </h3>
                        </div>               
                        <div class="col-12 col-md-3">
                            <select class="form-select modern-select w-100" name="productionopenjob_status_id" id="productionopenjob_status_id" required autofocus>
                                <option value="">กรุณาเลือกสถานะ</option>
                                @foreach ($sta as $item)
                                <option value="{{$item->productionopenjob_status_id}}">{{$item->productionopenjob_status_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" class="form-control modern-input" placeholder="ระบุหมายเหตุความเห็นย้อนกลับ..." name="note" id="note">
                        </div>
                        <div class="col-12 col-md-2">
                            <button type="submit" class="btn btn-indigo w-100 toastrDefaultSuccess shadow-sm">
                                <i class="fas fa-save me-2"></i> บันทึกข้อมูล
                            </button>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                         <div class="col-12 col-md-4">
                            <div class="badge-status w-100">
                                <i class="fas fa-info-circle me-2"></i><strong>สถานะปัจจุบัน :</strong> {{$hd->productionopenjob_status_name}}
                            </div>
                        </div>
                         <div class="col-12 col-md-8">
                            <div class="badge-note w-100">
                                <i class="fas fa-comment-dots me-2"></i><strong>หมายเหตุ :</strong> {{$hd->close_approvedpersonnote ?? '-'}}
                            </div>
                        </div>
                    </div>

                    <hr class="my-4" style="border-color: var(--border-color);">
                    
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-2">
                            <label class="form-label text-muted small fw-bold">กำหนดส่ง</label>
                            <input type="text" class="form-control modern-input" value="{{\Carbon\Carbon::parse($hd->productionnotice_dt_duedate)->format('d/m/Y')}}" readonly>
                        </div>
                        <div class="col-12 col-md-2">
                            <label class="form-label text-muted small fw-bold">วันที่เปิดงาน</label>
                            <input type="text" class="form-control modern-input" value="{{\Carbon\Carbon::parse($hd->productionopenjob_hd_date)->format('d/m/Y')}}" readonly>
                        </div>
                        <div class="col-12 col-md-2">
                            <label class="form-label text-muted small fw-bold">เลขที่ใบเปิดงาน</label>
                            <input type="text" class="form-control modern-input" value="{{$hd->productionopenjob_hd_docuno}}" readonly>
                        </div>
                        <div class="col-12 col-md-2">
                            <label class="form-label text-muted small fw-bold">เลขที่ใบแจ้งผลิต</label>
                            <input type="text" class="form-control modern-input" value="{{$hd->productionnotice_hd_docuno}}" readonly>
                        </div>
                        <div class="col-12 col-md-2">
                            <label class="form-label text-muted small fw-bold">Spec Page</label>
                            <input type="text" class="form-control modern-input" value="{{$hd->ms_specpage_name}}" readonly>
                        </div>
                        <div class="col-12 col-md-2">
                            <label class="form-label text-muted small fw-bold">Final Test Date</label>
                            <input type="date" class="form-control modern-input" value="{{$hd->finaltest_date}}" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-4">
                            <label class="form-label text-muted small fw-bold">ลูกค้า</label>
                            <input type="text" class="form-control modern-input" value="{{$hd->ms_customer_name}}" readonly>
                        </div>
                        <div class="col-12 col-md-5">
                            <label class="form-label text-muted small fw-bold">สินค้า</label>
                            <input type="text" class="form-control modern-input" value="{{$hd->ms_product_name}} / {{$hd->ms_product_qty}}" readonly>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label text-muted small fw-bold">วันที่เริ่ม - จบกระบวนงาน</label>
                            <input type="text" class="form-control modern-input" value="{{$hd->productionopenjob_hd_startdate}} - {{$hd->productionopenjob_hd_enddate}}" readonly>
                        </div>                                             
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-12 col-md-2">
                            <label class="form-label text-muted small fw-bold">Serial No</label>
                            <input type="text" class="form-control modern-input" value="{{$hd->serialno}}" readonly>
                        </div>
                        <div class="col-12 col-md-2">
                            <label class="form-label text-muted small fw-bold text-indigo">ประมาณการต้นทุน</label>
                            <input type="text" class="form-control modern-input fw-bold text-indigo" value="{{number_format($hd->productionopenjob_estimatecost,2)}}" readonly>
                        </div>             
                        <div class="col-12 col-md-2">
                            <label class="form-label text-muted small fw-bold text-success">จำนวนเงินที่ใช้จริง</label>
                            <input type="text" class="form-control modern-input fw-bold text-success" value="{{number_format($hd->productionopenjob_actualcost,2)}}" readonly>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label text-muted small fw-bold">ผู้ปิดงาน</label>
                            <input type="text" class="form-control modern-input" value="{{$hd->close_person}}" readonly>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label text-muted small fw-bold">Foreman</label>
                            <input type="text" class="form-control modern-input" value="{{$hd->foreman}}" readonly>
                        </div>
                    </div>

                    <div class="bg-light p-3 rounded-4 mb-4">
                        <span class="d-block mb-2 small fw-bold text-secondary text-uppercase tracking-wider">สรุปชั่วโมงการทำงาน (Man Hours)</span>
                        <div class="row g-2">
                            <div class="col-6 col-md-2">
                                <div class="bg-white p-2 rounded-3 text-center border">
                                    <span class="text-muted d-block small">Machine</span>
                                    <span class="fs-6 fw-bold text-dark">{{number_format($hd->machinetime_close,2)}}</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="bg-white p-2 rounded-3 text-center border">
                                    <span class="text-muted d-block small">Elect</span>
                                    <span class="fs-6 fw-bold text-dark">{{number_format($hd->electricitytime_close,2)}}</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="bg-white p-2 rounded-3 text-center border">
                                    <span class="text-muted d-block small">Paint</span>
                                    <span class="fs-6 fw-bold text-dark">{{number_format($hd->painttime_close,2)}}</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="bg-white p-2 rounded-3 text-center border">
                                    <span class="text-muted d-block small">Assembly</span>
                                    <span class="fs-6 fw-bold text-dark">{{number_format($hd->assemblytime_close,2)}}</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="bg-white p-2 rounded-3 text-center border">
                                    <span class="text-muted d-block small">Other</span>
                                    <span class="fs-6 fw-bold text-dark">{{number_format($hd->othertime_close,2)}}</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="bg-indigo p-2 rounded-3 text-center text-white" style="background-color: var(--primary-indigo)">
                                    <span class="opacity-75 d-block small">Total (MH)</span>
                                    <span class="fs-6 fw-bold">{{number_format($hd->totaltime_close,2)}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label text-muted small fw-bold">รายละเอียด</label>
                            <textarea rows="2" class="form-control modern-textarea" readonly>{{$hd->productionnotice_dt_remark}}</textarea>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label text-muted small fw-bold">หมายเหตุเปิดงาน</label>
                            <textarea rows="2" class="form-control modern-textarea" readonly>{{$hd->productionopenjob_hd_remark}}</textarea>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                         <div class="col-12">
                            <label class="form-label text-muted small fw-bold">หมายเหตุแก้ไขการปิดงาน</label>
                            <textarea rows="2" class="form-control modern-textarea" readonly>{{$hd->note_editclose}}</textarea>
                        </div>
                    </div>

                    <div class="row mb-4">            
                        <div class="col-12">
                            <div class="card border-0">
                              <div class="card-header bg-transparent p-0 border-bottom">
                                <ul class="nav nav-tabs modern-tabs border-0" id="custom-tabs-four-tab" role="tablist">
                                  <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-bs-toggle="tab" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">รายละเอียดรายการผลิต</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-bs-toggle="tab" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">ข้อมูลทางเทคนิค (Optional)</a>
                                  </li>
                                </ul>
                              </div>
                              <div class="card-body px-0 pt-3">
                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                  <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                    <div class="table-responsive rounded-3 border">
                                        <table class="modern-table m-0">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th>สินค้า</th>
                                                    <th class="text-end">จำนวน</th>
                                                    <th class="text-end">ประมาณการต้นทุน</th>
                                                    <th class="text-end">จำนวนเงินที่ใช้</th>
                                                    <th class="text-end">เวลาที่ใช้ (ชม.)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dt as $item)
                                                    <tr>
                                                        <td>{{$item->productionopenjob_dt_listno}}</td>
                                                        <td class="fw-medium text-dark">{{$item->ms_product_name}}</td>
                                                        <td class="text-end">{{$item->assembleqty}} / {{$item->ms_product_unit}}</td>
                                                        <td class="text-end text-secondary">{{number_format($item->estimatecost,2)}}</td>
                                                        <td class="text-end fw-medium text-success">{{number_format($item->actualcost,2)}}</td>
                                                        <td class="text-end text-dark">{{number_format($item->timespent,2)}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot style="background-color: #fafafa; font-weight: bold;">
                                                <tr>
                                                    <td colspan="3" class="text-center text-uppercase text-muted">รวมทั้งสิ้น (Total)</td>
                                                    <td class="text-end text-indigo">{{number_format($total,2)}}</td>    
                                                    <td class="text-end text-success">{{number_format($total1,2)}}</td>       
                                                    <td class="text-end text-dark">{{number_format($total2,2)}}</td>                                                   
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                  </div>
                                  
                                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                    <div class="table-responsive rounded-3 border">
                                        <table class="modern-table m-0">
                                            <thead>
                                                <tr>
                                                    <th>สินค้า</th>
                                                    <th>จำนวน</th>
                                                    <th>รายละเอียดเทคนิค</th>
                                                    <th>ระบบไฟฟ้า</th>
                                                    <th>ซอฟต์แวร์ (Software)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($op as $item)
                                                    <tr>
                                                        <td class="fw-medium text-dark">{{$item->productionnotice_op_name}} <span class="text-muted small">({{$item->productionnotice_op_code}})</span></td>
                                                        <td>{{$item->productionnotice_op_qty}} / {{$item->productionnotice_op_unit}}</td>
                                                        <td>{{$item->productionnotice_op_remark ?? '-'}}</td>
                                                        <td>{{$item->productionnotice_op_elect ?? '-'}}</td>
                                                        <td>{{$item->productionnotice_op_software ?? '-'}}</td>
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

                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="form-label text-muted small fw-bold mb-2"><i class="fas fa-paperclip me-1 text-indigo"></i> เอกสารที่เกี่ยวข้องในระบบ</label>
                            <div class="table-responsive rounded-3 border">
                                <table class="modern-table m-0">
                                    <thead>
                                        <tr>
                                            <th>สถานะ</th>
                                            <th>ประเภทเอกสาร</th>
                                            <th>วันที่เอกสาร</th>
                                            <th>เลขที่เอกสาร</th>
                                            <th>ผู้บันทึก</th>
                                            <th>ผูอนุมัติ</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @foreach ($docuno as $item)
                                            <tr>
                                                <td>
                                                    <span class="badge rounded-pill px-2 py-1 {{ $item->status == 'อนุมัติ' ? 'bg-light-success text-success' : 'bg-light text-dark' }}" style="font-size:0.8rem;">
                                                        {{$item->status}}
                                                    </span>
                                                </td>
                                                <td class="fw-medium">{{$item->type}}</td>
                                                <td>{{\Carbon\Carbon::parse($item->date)->format('d/m/Y')}}</td>
                                                <td>
                                                    @php
                                                        $routes = [
                                                            'ใบเบิกวัสดุอุปกรณ์' => 'pd-ladi.show',
                                                            'ใบขอซื้อ' => 'pd-requ.show',
                                                            'ใบสั่งงาน' => 'pd-work.show',
                                                            'ใบบันทึกชั่วโมงการทำงาน' => 'pd-woho.show',
                                                            'ใบตรวจสอบกระบวนขั้นสุดท้าย' => 'fl-inst.show',
                                                            'ใบรับคืนจากการเบิก' => 'pd-retu.show'
                                                        ];
                                                    @endphp

                                                    @if (array_key_exists($item->type, $routes))
                                                        <a href="{{route($routes[$item->type], $item->docuno)}}" class="text-indigo fw-bold text-decoration-none" target="_blank">
                                                            <i class="fas fa-external-link-alt small me-1"></i> {{$item->docuno}}
                                                        </a>
                                                    @else
                                                        <span class="text-muted">{{$item->docuno}}</span>
                                                    @endif
                                                </td>
                                                <td>{{$item->created_person}}</td>
                                                <td>{{$item->approved_by ?? '-'}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>                                                                                
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                         <div class="col-12">
                            <label class="form-label text-muted small fw-bold mb-2"><i class="fas fa-history me-1"></i> ประวัติเวอร์ชั่นและการแก้ไขเอกสาร (Logs)</label>
                            <div class="table-responsive rounded-3 border">
                                <table class="modern-table m-0" style="font-size: 0.9rem;">
                                    <thead>
                                        <tr>
                                            <th>วันที่-เวลาแก้ไข</th>
                                            <th>ผู้แก้ไข</th>
                                            <th>เลขที่งาน</th>
                                            <th class="text-end">เงินที่ใช้</th>
                                            <th>วันที่ทดสอบ</th>
                                            <th>หัวหน้างาน</th>
                                            <th>ผู้ปิดงาน</th>
                                            <th>Serial No</th>
                                            <th class="text-center">Mach(MH)</th>
                                            <th class="text-center">Elec(MH)</th>
                                            <th class="text-center">Paint(MH)</th>
                                            <th class="text-center">Assem(MH)</th>
                                            <th class="text-center">Other(MH)</th>
                                            <th class="text-center fw-bold text-indigo">Total</th>
                                            <th width="5%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($loghd as $item)
                                            <tr>
                                                <td class="text-nowrap">{{ \Carbon\Carbon::parse($item->update_log)->format('d/m/Y H:i') }}</td>
                                                <td class="text-muted">{{ $item->person_log }}</td>
                                                <td>{{ $item->productionopenjob_hd_docuno}}</td>
                                                <td class="text-end fw-medium">{{number_format($item->productionopenjob_actualcost,2)}}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->finaltest_date)->format('d/m/Y') }}</td>
                                                <td>{{ $item->foreman }}</td>
                                                <td>{{ $item->close_person }}</td>  
                                                <td>{{ $item->serialno }}</td>
                                                <td class="text-center text-muted">{{ number_format($item->machinetime_close,1) }}</td>
                                                <td class="text-center text-muted">{{ number_format($item->electricitytime_close,1) }}</td>
                                                <td class="text-center text-muted">{{ number_format($item->painttime_close,1) }}</td>
                                                <td class="text-center text-muted">{{ number_format($item->assemblytime_close,1) }}</td>
                                                <td class="text-center text-muted">{{ number_format($item->othertime_close,1) }}</td>
                                                <td class="text-center fw-bold text-indigo">{{ number_format($item->totaltime_close,1) }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-light btn-sm rounded-3 text-indigo" 
                                                            data-bs-toggle="modal" data-bs-target="#modal"
                                                            onclick="getLogDataClose('{{ $item->log_openjob_hd_id }}')">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                         </div>
                    </div>           
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content modern-modal shadow-lg">
            <div class="modal-header px-4 py-3">
                <h5 class="modal-title d-flex align-items-center fw-bold text-indigo" style="color: var(--primary-indigo)">
                    <i class="fas fa-list-alt me-2"></i> รายละเอียดประวัติรายการสิ่งของในเวอร์ชั่นนี้
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">              
                <div class="table-responsive rounded-3 border">
                    <table class="modern-table m-0">
                        <thead>
                            <tr>
                                <th width="5%">ลำดับ</th>                               
                                <th width="15%">รหัสสินค้า</th>    
                                <th>ชื่อสินค้า</th>  
                                <th width="10%">หน่วยนับ</th>     
                                <th class="text-end" width="10%">จำนวน</th>          
                                <th class="text-end" width="15%">ประมาณการต้นทุน</th>     
                                <th class="text-end" width="15%">จำนวนที่เงินที่ใช้</th>  
                                <th class="text-end" width="10%">เวลาที่ใช้</th>                               
                            </tr>
                        </thead>
                        <tbody id="tb_list">
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scriptjs')
<script src="{{ asset('/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{asset('/assets/plugins/toastr/toastr.min.js')}}"></script>
<script>
// จัดการฟังก์ชัน Toastr แจ้งเตือนสไตล์โมเดิร์น
$('.toastrDefaultSuccess').click(function() {
    toastr.success('บันทึกการปรับปรุงข้อมูลเรียบร้อยแล้ว')
});

// ดึงข้อมูล Log มาแสดงในตาราง Modal
getLogDataClose = (id) => {
    $.ajax({
        url: "{{ url('/getLogData-Close') }}",
        type: "post",
        dataType: "JSON",
        data: {
            refid: id,
            _token: "{{ csrf_token() }}"      
        },    
        success: function(data) {
            let el_list = ''; 
            $.each(data.dt, function(key, item) {
                let remark = item.productionopenjob_dt_remark ? item.productionopenjob_dt_remark : '';
                el_list += `    
                    <tr> 
                        <td class="text-muted">${key + 1}</td> 
                        <td class="fw-bold text-secondary">${item.ms_product_code}</td>  
                        <td class="fw-medium text-dark">${item.ms_product_name}</td>  
                        <td><span class="badge bg-light text-dark px-2 py-1">${item.ms_product_unit}</span></td>  
                        <td class="text-end fw-bold">${parseFloat(item.assembleqty).toFixed(2)}</td>         
                        <td class="text-end text-muted">${parseFloat(item.estimatecost).toFixed(2)}</td>        
                        <td class="text-end text-success fw-bold">${parseFloat(item.actualcost).toFixed(2)}</td>    
                        <td class="text-end text-dark">${parseFloat(item.timespent).toFixed(2)}</td> 
                    </tr>
                `;
            });      
            $('#tb_list').html(el_list);
        }
    });
}
</script>
@endpush