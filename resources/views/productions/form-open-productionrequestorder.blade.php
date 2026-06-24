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
                                    <i class="fas fa-file-invoice-dollar text-indigo mr-2"></i> เอกสารขอซื้อ
                                </h3>
                            </div>
                            <div class="col-12 col-sm-5 col-xl-3 mb-3 mb-sm-0">
                                <div class="form-group row mb-0 align-items-center">
                                    <label for="datestart" class="col-sm-3 col-form-label text-muted font-weight-bold">วันที่</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control rounded-lg border-gray-300" name="datestart" id="datestart" value="{{$datestart}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-5 col-xl-3 mb-3 mb-sm-0">
                                <div class="form-group row mb-0 align-items-center">
                                    <label for="dateend" class="col-sm-3 col-form-label text-muted font-weight-bold">ถึง</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control rounded-lg border-gray-300" name="dateend" id="dateend" value="{{$dateend}}">
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
                                        <th class="text-center text-secondary py-3" style="width: 110px;">สถานะ</th>
                                        <th class="text-center text-secondary py-3" style="width: 110px;">วันที่</th>
                                        <th class="text-center text-secondary py-3">เลขที่ใบขอซื้อ</th>
                                        <th class="text-center text-secondary py-3">เลขที่อ้างอิง</th>
                                        <th class="text-secondary py-3">แผนก</th>
                                        <th class="text-secondary py-3">หมายเหตุ</th>
                                        <th class="text-center text-secondary py-3">ผู้บันทึก</th>
                                        <th class="text-center text-secondary py-3">ผู้อนุมัติ</th>
                                        <th class="text-center text-secondary py-3" style="width: 80px;">จัดการ</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                    @foreach ($hd as $item)
                                    <tr>
                                        <td class="text-center font-weight-bold">
                                            <span class="badge badge-light-indigo px-2.5 py-1.5 rounded">
                                                {{$item->requestorder_status_name}}
                                            </span>
                                        </td>
                                        <td class="text-center font-weight-bold text-secondary">{{\Carbon\Carbon::parse($item->requestorder_hd_date)->format('d/m/Y')}}</td>
                                        <td class="text-center text-primary font-weight-bold">{{$item->requestorder_hd_docuno}}</td>
                                        <td class="text-center text-indigo font-weight-bold">{{$item->productionopenjob_hd_docuno ?: '-'}}</td>
                                        <td><span class="font-weight-500 text-dark"><i class="fas fa-building text-xs mr-1 text-muted"></i> {{$item->ms_department_name}}</span></td>
                                        <td><span class="text-muted">{{$item->requestorder_hd_note ?: '-'}}</span></td>
                                        <td class="text-center">{{$item->created_person}}</td>
                                        <td class="text-center text-muted"><i class="fas fa-user-check text-xs mr-1"></i> {{$item->approved_by ?: '-'}}</td>
                                        <td class="text-center">
                                            @if($item->requestorder_status_id == 1)
                                            <a href="{{route('pd-requ.edit',$item->requestorder_hd_id)}}" class="btn btn-sm btn-action-edit shadow-sm" title="แก้ไข">
                                                <i class="fas fa-edit"></i>
                                            </a>                                                   
                                            @else
                                            <a href="javascript:void(0)" class="btn btn-sm btn-action-view shadow-sm" data-toggle="modal" data-target="#modal" onclick="getDataRequ('{{ $item->requestorder_hd_id }}')" title="ดูรายละเอียด">
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

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-xl">
            <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title font-weight-bold text-dark"><i class="fas fa-info-circle text-indigo mr-2"></i>รายละเอียดรายการสินค้าในใบขอซื้อ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 pb-4"> 
                <div class="table-responsive">
                    <table class="table table-custom table-hover align-middle table-sm" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center text-secondary py-2" style="width: 70px;">ลำดับ</th>
                                <th class="text-center text-secondary py-2" style="width: 130px;">วันที่ต้องการ</th>
                                <th class="text-center text-secondary py-2" style="width: 140px;">รหัสสินค้า</th>                                   
                                <th class="text-secondary py-2">ชื่อสินค้า</th>    
                                <th class="text-center text-secondary py-2" style="width: 110px;">หน่วยนับ</th>  
                                <th class="text-right text-secondary py-2" style="width: 130px;">จำนวนเบิก</th>   
                                <th class="text-right text-secondary py-2" style="width: 140px;">ราคาต่อหน่วย</th>    
                            </tr>
                        </thead>
                        <tbody id="tb_list"></tbody>
                    </table>
                </div>                                           
            </div>
            <div class="modal-footer border-top-0 px-4 pb-4">
                <button type="button" class="btn btn-light px-4 font-weight-bold rounded-lg border" data-dismiss="modal">ปิด</button>
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
        color: #ffffff !important;
    }
    .rounded-xl { border-radius: 1rem !important; }
    
    /* สไตล์ปุ่ม Action ในตาราง */
    .btn-action-edit { background-color: #fef3c7; color: #d97706; border-radius: 8px; }
    .btn-action-edit:hover { background-color: #fde68a; color: #b45309; }
    .btn-action-view { background-color: #e0e7ff; color: #4f46e5; border-radius: 8px; }
    .btn-action-view:hover { background-color: #c7d2fe; color: #3730a3; }
    
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

const getDataRequ = (id) => {
    // แสดงสถานะกำลังโหลดป้องกันข้อมูลตารางชุดเดิมค้างคั่ง
    $('#tb_list').html('<tr><td colspan="7" class="text-center">กำลังโหลดข้อมูลรายละเอียดสินค้า...</td></tr>');

    $.ajax({
        url: "{{ url('/getData-Requ') }}",
        type: "POST",
        dataType: "JSON",
        data: {
            refid: id,
            _token: "{{ csrf_token() }}"      
        },    
        success: function(data) {
            let el_list = ''; 
            if(data.dt && data.dt.length > 0) {
                $.each(data.dt, function(key, item) {
                    let due_date = item.requestorder_dt_duedate ? item.requestorder_dt_duedate : '-';
                    let qty = item.ms_product_qty ? parseFloat(item.ms_product_qty).toFixed(2) : '0.00';
                    let price = item.ms_product_price ? parseFloat(item.ms_product_price).toFixed(2) : '0.00';
                    
                    el_list += `    
                        <tr>
                            <td class="text-center text-secondary font-weight-bold">${item.requestorder_dt_listno}</td>  
                            <td class="text-center">${due_date}</td>  
                            <td class="text-center font-weight-bold text-dark">${item.ms_product_code}</td>  
                            <td>${item.ms_product_name}</td>  
                            <td class="text-center">${item.ms_product_unit}</td>        
                            <td class="text-right text-indigo font-weight-bold">${qty}</td>  
                            <td class="text-right font-weight-bold text-dark">฿${price}</td> 
                        </tr>
                    `;
                });
            } else {
                el_list = '<tr><td colspan="7" class="text-center text-danger">ไม่พบข้อมูลรายละเอียดสินค้าในใบขอซื้อนี้</td></tr>';
            }
            $('#tb_list').html(el_list);
        },
        error: function(xhr, status, error) {
            console.error(error);
            $('#tb_list').html('<tr><td colspan="7" class="text-center text-danger">เกิดข้อผิดพลาดในการเชื่อมต่อระบบ</td></tr>');
        }
    });
}  
</script>
@endpush