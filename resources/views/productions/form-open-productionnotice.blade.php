@extends('layouts.main')
@section('content')
<div class="mt-2">
    <div class="row">
        <div class="col-12">
            <div class="card card-outline border-top-0 shadow-sm rounded-lg">
                <div class="card-body p-4">
                    
                    <form method="GET" class="form-horizontal">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-12 col-xl-3 mb-3 mb-xl-0">
                                <h3 class="card-title text-dark mb-0" style="font-weight: 700; font-size: 1.4rem;">
                                    <i class="fas fa-file-alt text-indigo mr-2"></i> เอกสารแจ้งผลิต
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
                    
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-custom table-hover align-middle table-sm" id="tb_job" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary py-3">สถานะ</th>
                                        <th class="text-center text-secondary py-3">วันที่</th>
                                        <th class="text-center text-secondary py-3">เลขที่ใบแจ้งผลิต</th>
                                        <th class="text-center text-secondary py-3">กำหนดส่ง</th>
                                        <th class="text-center text-secondary py-3">ลูกค้า</th>
                                        <th class="text-center text-secondary py-3">ผู้อนุมัติ</th>
                                        <th class="text-center text-secondary py-3">การจัดการ</th>
                                        <th class="text-center text-secondary py-3">หมายเหตุ</th>                              
                                        <th class="text-center text-secondary py-3">ลบ</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                    @foreach ($hd as $item)
                                    <tr>
                                        <td class="text-center font-weight-bold">
                                            <span class="badge badge-light-indigo px-2.5 py-1.5 rounded">
                                                {{$item->productionnotice_status_name}}
                                            </span>
                                        </td>
                                        <td class="text-center font-weight-bold text-secondary">{{\Carbon\Carbon::parse($item->productionnotice_hd_date)->format('Y/m/d')}}</td>
                                        <td class="text-center text-primary font-weight-bold">{{$item->productionnotice_hd_docuno}}</td>
                                        <td class="text-center text-danger font-weight-bold">{{\Carbon\Carbon::parse($item->productionnotice_hd_duedate)->format('Y/m/d')}}</td>
                                        <td class="text-center">{{$item->ms_customer_name}}</td>
                                        <td class="text-center text-muted"><i class="fas fa-user-check text-xs mr-1"></i> {{$item->approved_by}}</td>
                                        <td class="text-center">
                                            @if($item->productionnotice_status_id == 1)
                                            <a href="{{route('pd-noti.edit',$item->productionnotice_hd_id)}}" class="btn btn-sm btn-action-edit shadow-sm" title="แก้ไข">
                                                <i class="fas fa-edit"></i>
                                            </a>                                   
                                            @else
                                            <a href="javascript:void(0)" class="btn btn-sm btn-action-view shadow-sm" data-toggle="modal" data-target="#modal" onclick="getData('{{ $item->productionnotice_hd_id }}')" title="ดูรายละเอียด">
                                                <i class="fas fa-eye"></i>
                                            </a>                                  
                                            @endif                                                                                                                
                                        </td>
                                        <td class="text-center text-sm text-muted">{{$item->productionnotice_hd_remark ?: '-'}} <span class="text-indigo">{{$item->approved_note ? ' / '.$item->approved_note : ''}}</span></td>                                
                                        <td class="text-center">
                                            @if ($item->productionnotice_status_id == 4)
                                                @if ($item->approved_by == auth()->user()->name)
                                                <a href="javascript:void(0)" class="btn btn-sm btn-action-delete shadow-sm" onclick="confirmDel('{{ $item->productionnotice_hd_docuno }}','{{ $item->productionnotice_hd_id }}')" title="ลบเอกสาร">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                @endif
                                            @endif          
                                        </td>
                                    </tr> 
                                    @endforeach                   
                                </tbody>          
                            </table>
                        </div>
                    </div>       
                </div>
                
                <div wire:loading wire:target="save" wire:loading.class="overlay" wire:loading.flex>
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fas fa-3x fa-sync fa-spin text-indigo"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-xl">
            <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title font-weight-bold text-dark"><i class="fas fa-info-circle text-indigo mr-2"></i>รายละเอียดเอกสาร</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 pb-4"> 
                <div class="card card-indigo card-outline card-outline-tabs shadow-none border-0 mb-0">
                    <div class="card-header p-0 border-bottom">
                        <ul class="nav nav-tabs nav-tabs-custom" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">รายละเอียดสินค้า</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">ข้อมูลเพิ่มเติม (Optional)</a>
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
                                                <th class="border-0">#</th>
                                                <th class="border-0">กำหนดส่ง</th>
                                                <th class="border-0">สินค้า</th>
                                                <th class="border-0">จำนวน</th>
                                                <th class="border-0">รายละเอียด</th>
                                                <th class="border-0">Spec Page</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tb_list"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="border-0">สินค้า</th>
                                                <th class="border-0">จำนวน</th>
                                                <th class="border-0">รายละเอียด</th>
                                                <th class="border-0">รายละเอียดไฟฟ้า</th>
                                                <th class="border-0">รายละเอียด Software</th>
                                            </tr>
                                        </thead>
                                        <tbody id="opt_list"></tbody>
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
    
    /* สไตล์ปุ่ม Action ในตาราง */
    .btn-action-edit { background-color: #fef3c7; color: #d97706; border-radius: 8px; }
    .btn-action-edit:hover { background-color: #fde68a; color: #b45309; }
    .btn-action-view { background-color: #e0e7ff; color: #4f46e5; border-radius: 8px; }
    .btn-action-view:hover { background-color: #c7d2fe; color: #3730a3; }
    .btn-action-delete { background-color: #fee2e2; color: #dc2626; border-radius: 8px; }
    .btn-action-delete:hover { background-color: #fecaca; color: #b91c1c; }
    
    /* Custom Table styling */
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
    
    /* Badges */
    .badge-light-indigo {
        background-color: #e0e7ff;
        color: #4f46e5;
    }
    
    /* Custom Tabs */
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
            targets: 1,
            type: 'time-date-sort'
        }],
        order: [
            [6, "desc"],
            [3, "desc"]
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
        pagingType: "full_numbers",
        bSort: true,   
    });
});

getData = (id) => {
    $.ajax({
        url: "{{ url('/getData') }}",
        type: "post",
        dataType: "JSON",
        data: {
            refid: id,
            _token: "{{ csrf_token() }}"      
        },    
        success: function(data) {
            let el_list = ''; 
            let op_list = ''; 
            $.each(data.dt, function(key , item) {
                let remark = item.productionnotice_dt_remark || '';
                el_list += `    
                    <tr>
                        <td>${key+1}</td>
                        <td class="font-weight-bold text-secondary">${item.productionnotice_dt_duedate}</td>  
                        <td class="font-weight-bold text-dark">${item.ms_product_seminame}</td>  
                        <td><span class="badge badge-secondary px-2 py-1">${item.ms_product_semiqty}/${item.ms_product_semiunit}</span></td>  
                        <td class="text-muted">${remark}</td>  
                        <td>
                            <a href="${item.filename}" target="_blank" class="text-indigo font-weight-bold">
                                <i class="fas fa-file-pdf mr-1"></i> ${item.ms_specpage_name}
                            </a>
                        </td>                      
                    </tr>`;
            });      
            $('#tb_list').html(el_list);

            $.each(data.op, function(key , item) {
                let op_remark = item.productionnotice_op_remark || '';
                let op_elect = item.productionnotice_op_elect || '';
                let op_software = item.productionnotice_op_software || '';
                op_list += `    
                    <tr>
                        <td class="font-weight-bold">${item.productionnotice_op_name}</td>
                        <td><span class="badge badge-secondary px-2 py-1">${item.productionnotice_op_qty}/${item.productionnotice_op_unit}</span></td>  
                        <td class="text-muted">${op_remark}</td>  
                        <td>${op_elect}</td>  
                        <td>${op_software}</td>  
                    </tr>`;
            });      
            $('#opt_list').html(op_list);
        }
    });
}

confirmDel = (docs, refid) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ที่จะลบ ?',
        text: `ต้องการยกเลิกเอกสารเลขที่ ${docs} ใช่หรือไม่?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยันการลบ',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            confirmButton: 'btn btn-danger px-4 py-2 font-weight-bold rounded-lg mr-2',
            cancelButton: 'btn btn-light px-4 py-2 font-weight-bold rounded-lg border'
        },
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: `{{ url('/cancelDocsNotice') }}`,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "docuno": docs,
                    "refid": refid
                },
                dataType: "json",
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire({
                            title: 'สำเร็จ',
                            text: 'ยกเลิกเอกสารเรียบร้อยแล้ว',
                            icon: 'success',
                            confirmButtonText: 'ตกลง',
                            customClass: { confirmButton: 'btn btn-indigo px-4' },
                            buttonsStyling: false
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ยกเลิกเอกสารไม่สำเร็จ',
                            icon: 'error',
                            confirmButtonText: 'ปิด',
                            customClass: { confirmButton: 'btn btn-indigo px-4' },
                            buttonsStyling: false
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิกแล้ว',
                text: 'เอกสารของคุณยังคงปลอดภัยข้อมูลไม่ถูกนำออก :)',
                icon: 'info',
                confirmButtonText: 'รับทราบ',
                customClass: { confirmButton: 'btn btn-indigo px-4' },
                buttonsStyling: false
            });
        }
    });
}
</script>
@endpush