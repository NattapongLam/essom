@extends('layouts.main')
@section('content')
<div class="mt-2">
    <div class="row">
        <div class="col-12">
            <div class="card card-outline border-top-0 shadow-sm rounded-lg">
                <div class="card-body p-4">
                    
                    {{-- ส่วนฟอร์มค้นหา ปรับ Layout ให้ล้อไปกับหน้าแจ้งผลิต --}}
                    <form method="GET" class="form-horizontal">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-12 col-xl-3 mb-3 mb-xl-0">
                                <h3 class="card-title text-dark mb-0" style="font-weight: 700; font-size: 1.4rem;">
                                    <i class="fas fa-file-invoice text-indigo mr-2"></i> เอกสารสั่งงาน
                                </h3>
                            </div>
                            <div class="col-12 col-sm-5 col-xl-3 mb-3 mb-sm-0">
                                <div class="form-group row mb-0 align-items-center">
                                    <label for="datestart" class="col-sm-3 col-form-label text-muted font-weight-bold">วันที่</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control rounded-lg shadow-sm-none border-gray-300" name="datestart" id="datestart" value="{{$datestart}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-5 col-xl-3 mb-3 mb-sm-0">
                                <div class="form-group row mb-0 align-items-center">
                                    <label for="dateend" class="col-sm-3 col-form-label text-muted font-weight-bold">ถึง</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control rounded-lg shadow-sm-none border-gray-300" name="dateend" id="dateend" value="{{$dateend}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-2 col-xl-3 text-right text-sm-left">
                                <button class="btn btn-indigo px-4 shadow-sm font-weight-bold rounded-lg" type="submit">
                                    <i class="fas fa-search mr-1"></i> ค้นหา
                                </button>
                            </div>
                        </div>            
                    </form>

                    <hr class="my-4 border-gray-200">
                    
                    {{-- ส่วนตารางหลัก ใช้คลาสคัสตอมเดียวกัน --}}
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-custom table-hover align-middle table-sm" id="tb_job" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary py-3">สถานะ</th>
                                        <th class="text-center text-secondary py-3">กำหนดส่ง</th>
                                        <th class="text-center text-secondary py-3">วันที่</th>
                                        <th class="text-center text-secondary py-3">เลขที่เอกสาร</th>
                                        <th class="text-center text-secondary py-3">วิศวกร</th>
                                        <th class="text-center text-secondary py-3">ผู้จำหน่าย</th>
                                        <th class="text-center text-secondary py-3">ประเภทงาน</th>
                                        <th class="text-center text-secondary py-3">เลขที่อ้างอิง</th>
                                        <th class="text-center text-secondary py-3">ผู้ตรวจสอบ</th>
                                        <th class="text-center text-secondary py-3">ผู้อนุมัติ</th>
                                        <th class="text-center text-secondary py-3">การจัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hd as $item)
                                    <tr>
                                        <td class="text-center font-weight-bold">
                                            <span class="badge badge-light-indigo px-2.5 py-1.5 rounded">
                                                {{$item->workorder_status_name}}
                                            </span>
                                        </td>
                                        <td class="text-center font-weight-bold text-secondary">{{\Carbon\Carbon::parse($item->productionopenjob_dt_duedate)->format('Y/m/d')}}</td>
                                        <td class="text-center font-weight-bold text-secondary">{{\Carbon\Carbon::parse($item->workorder_hd_date)->format('Y/m/d')}}</td>
                                        <td class="text-center text-primary font-weight-bold">{{$item->workorder_hd_docuno}}</td>
                                        <td class="text-center">{{$item->engineer_by}}</td>
                                        <td class="text-center">{{$item->vendor_name}}</td>
                                        <td class="text-center"><span class="badge badge-secondary px-2 py-1">{{$item->process_group}}</span></td>
                                        <td class="text-center font-weight-bold text-muted">{{$item->productionopenjob_hd_docuno}}</td>
                                        <td class="text-center text-muted">{{$item->checked_by ?: '-'}}</td>
                                        <td class="text-center text-muted"><i class="fas fa-user-check text-xs mr-1"></i> {{$item->approved_by ?: '-'}}</td>
                                        <td class="text-center">
                                            @if($item->workorder_status_id == 1 || $item->workorder_status_id == 3 || $item->workorder_status_id == 6)
                                            <a href="{{route('pd-work.edit',$item->workorder_hd_id)}}" class="btn btn-sm btn-action-edit shadow-sm" title="แก้ไข">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @else
                                            <a href="javascript:void(0)" class="btn btn-sm btn-action-view shadow-sm" data-toggle="modal" data-target="#modal" onclick="getDataWork('{{ $item->workorder_hd_id }}')" title="ดูรายละเอียด">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @endif       
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
    </div>
</div>

{{-- Modal รายละเอียด เปลี่ยนดีไซน์ให้หรูเหมือนหน้าแจ้งผลิต มี Tab สวยๆ --}}
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-xl">
            <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title font-weight-bold text-dark"><i class="fas fa-info-circle text-indigo mr-2"></i>รายละเอียดเอกสารสั่งงาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 pb-4"> 
                <div class="card card-indigo card-outline card-outline-tabs shadow-none border-0 mb-0">
                    <div class="card-header p-0 border-bottom">
                        <ul class="nav nav-tabs nav-tabs-custom" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">รายการสั่งงาน</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body px-0 pt-4">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="border-0 text-center" style="width: 8%;">ลำดับ</th>
                                                <th class="border-0">รายละเอียด</th>                                    
                                                <th class="border-0 text-right" style="width: 12%;">จำนวน</th>    
                                                <th class="border-0 text-right" style="width: 15%;">ราคาต่อหน่วย</th>  
                                                <th class="border-0 text-right" style="width: 18%;">ราคารวม</th>                                
                                            </tr>
                                        </thead>
                                        <tbody id="tb_list"></tbody>
                                    </table>
                                </div>
                            </div>                   
                        </div>
                    </div>
                </div>                             
            </div>
        </div>
    </div>
</div>

<style>
    .text-indigo { color: #4f46e5 !important; }
    .btn-indigo {
        background-color: #4f46e5 !important;
        border-color: #4f46e5 !important;
        color: #ffffff !important;
    }
    .btn-indigo:hover {
        background-color: #4338ca !important;
        border-color: #4338ca !important;
    }
    .rounded-xl { border-radius: 1rem !important; }
    
    .btn-action-edit { background-color: #fef3c7; color: #d97706; border-radius: 8px; border: none; padding: 0.25rem 0.5rem; }
    .btn-action-edit:hover { background-color: #fde68a; color: #b45309; }
    .btn-action-view { background-color: #e0e7ff; color: #4f46e5; border-radius: 8px; border: none; padding: 0.25rem 0.5rem; }
    .btn-action-view:hover { background-color: #c7d2fe; color: #3730a3; }
    
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
    
    .badge-light-indigo {
        background-color: #e0e7ff;
        color: #4f46e5;
    }
    
    .nav-tabs-custom .nav-link {
        border: none;
        color: #64748b;
        font-weight: 500;
        padding: 0.75rem 1rem;
    }
    .nav-tabs-custom .nav-link.active {
        color: #4f46e5 !important;
        border-bottom: 3px solid #4f46e5 !important;
        font-weight: 600;
        background: transparent;
    }
</style>
@endsection

@push('scriptjs')
<script>
$(document).ready(function() {
    $('#tb_job').DataTable({
        "pageLength": 20,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', className: 'btn btn-sm btn-light border' },
            { extend: 'csv', className: 'btn btn-sm btn-light border' },
            { extend: 'excel', className: 'btn btn-sm btn-light border' },
            { extend: 'pdf', className: 'btn btn-sm btn-light border' },
            { extend: 'print', className: 'btn btn-sm btn-light border' }
        ],
        columnDefs: [{
            targets: [1, 2],
            type: 'time-date-sort'
        }],
        order: [
            [2, "desc"]
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
        pagingType: "full_numbers",
        bSort: true,   
    });
});

getDataWork = (id) => {
    // ใส่สปินเนอร์ตอนกำลังโหลดให้ธีมเหมือนกัน
    $('#tb_list').html('<tr><td colspan="5" class="text-center"><i class="fas fa-spinner fa-spin text-indigo mr-2"></i>กำลังโหลดข้อมูล...</td></tr>');
    
    $.ajax({
        url: "{{ url('/getData-Work') }}",
        type: "post",
        dataType: "JSON",
        data: {
            refid: id,
            _token: "{{ csrf_token() }}"      
        },    
        success: function(data) {
            let el_list = ''; 
            if (data.dt && data.dt.length > 0) {
                $.each(data.dt, function(key , item) {
                    let qty = parseFloat(item.workorder_dt_qty).toLocaleString(undefined, {minimumFractionDigits: 0});
                    let price = parseFloat(item.workorder_dt_price).toLocaleString(undefined, {minimumFractionDigits: 2});
                    let total = parseFloat(item.workorder_dt_total).toLocaleString(undefined, {minimumFractionDigits: 2});

                    el_list += `    
                        <tr>
                            <td class="text-center">${item.workorder_dt_listno}</td>  
                            <td class="font-weight-bold text-dark">${item.workorder_dt_description}</td>  
                            <td class="text-right"><span class="badge badge-secondary px-2 py-1">${qty}</span></td>  
                            <td class="text-right text-secondary font-weight-bold">${price}</td>  
                            <td class="text-right text-indigo font-weight-bold">${total}</td>          
                        </tr>`;
                });
            } else {
                el_list = '<tr><td colspan="5" class="text-center text-muted">ไม่พบรายละเอียดสินค้า</td></tr>';
            }
            $('#tb_list').html(el_list);
        }
    });
}
</script>
@endpush