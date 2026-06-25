@extends('layouts.main')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css')}}">

<style>
    :root {
        --primary-indigo: #4f46e5;
        --primary-hover: #4338ca;
        --light-indigo: #e0e7ff;
        --text-dark: #1f2937;
        --bg-card: #ffffff;
    }

    body {
        background-color: #f8fafc;
        color: var(--text-dark);
    }

    .custom-card {
        background: var(--bg-card);
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.03);
        margin-bottom: 2rem;
    }

    .page-title {
        color: var(--primary-indigo);
        font-weight: 700;
        letter-spacing: -0.5px;
        position: relative;
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 0.6rem 1rem;
        transition: all 0.2s ease-in-out;
    }

    .form-control:focus {
        border-color: var(--primary-indigo);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }

    /* สไตล์ปุ่มค้นหาแบบ Indigo */
    .btn-indigo {
        background-color: var(--primary-indigo);
        color: white;
        border-radius: 10px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        border: none;
        transition: all 0.2s;
        width: 100%;
    }

    .btn-indigo:hover {
        background-color: var(--primary-hover);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    /* Custom Switch แทน Checkbox แบบเก่า */
    .custom-switch-purple .custom-control-input:checked ~ .custom-control-label::before {
        background-color: var(--primary-indigo) !important;
        border-color: var(--primary-indigo) !important;
    }

    /* ตารางสไตล์มินิมอล */
    .modern-table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .modern-table thead th {
        background-color: #f1f5f9;
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 14px;
    }

    .modern-table tbody tr {
        transition: background-color 0.2s;
    }

    .modern-table tbody tr:hover {
        background-color: #f8fafc !important;
    }

    .modern-table td {
        padding: 14px;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9;
    }

    /* ไอคอนและปุ่มแอคชั่น */
    .btn-action {
        border-radius: 8px;
        padding: 6px 12px;
        font-weight: 500;
    }
    
    .text-indigo { color: var(--primary-indigo); }

    /* ปรับแต่งความโค้งมนของ Modal */
    .modal-content {
        border: none;
        border-radius: 20px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .modal-header {
        border-bottom: 1px solid #f1f5f9;
        background-color: #fafafa;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }
</style>

<div class="container-fluid pt-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-body p-4">
                    <form method="GET" class="form-horizontal">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <h3 class="page-title m-0"><i class="fas fa-folder-minus mr-2"></i>เอกสารปิดงาน</h3>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mb-md-0">
                                    <label for="datestart" class="text-muted small font-weight-bold mb-1">วันที่เริ่มต้น</label>
                                    <input type="date" class="form-control" name="datestart" id="datestart" value="{{$datestart}}">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mb-md-0">
                                    <label for="dateend" class="text-muted small font-weight-bold mb-1">ถึงวันที่</label>
                                    <input type="date" class="form-control" name="dateend" id="dateend" value="{{$dateend}}">
                                </div>
                            </div>
                            <div class="col-12 col-md-1">
                                <div class="form-group mb-md-0">
                                    <label class="text-muted small font-weight-bold mb-1 d-block">สถานะ</label>
                                    <div class="custom-control custom-switch custom-switch-purple pt-2">
                                        <input type="checkbox" class="custom-control-input" id="checkboxPrimary1" name="ck_sta">
                                        <label class="custom-control-label font-weight-normal text-secondary" for="checkboxPrimary1">รออนุมัติ</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 pt-3">
                                <button class="btn btn-indigo" type="submit">
                                    <i class="fas fa-search mr-2"></i>ค้นหา
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <hr class="my-4" style="border-top: 1px solid #f1f5f9;">
                    
                    <div class="table-responsive">
                        <table class="table modern-table" id="tb_job" style="width:100%">
                            <thead>
                                <tr>
                                    <th>สถานะ</th>
                                    <th>กำหนดส่ง</th>
                                    <th>วันที่</th>
                                    <th>เลขที่</th>
                                    <th>วันที่เริ่ม - จบ</th>
                                    <th>ลูกค้า</th>
                                    <th>สินค้า</th>
                                    <th>Spec Page</th>
                                    <th>รายละเอียด</th>
                                    <th>ประมาณการต้นทุน</th>
                                    <th>จำนวนเงินที่ใช้</th>
                                    <th class="text-center">เอกสารแนบ</th>
                                    <th class="text-center">การจัดการ</th>
                                    <th>แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hd as $item)
                                    <tr>
                                        <td>
                                            <span class="badge badge-pill p-2 {{ $item->productionopenjob_status_id == 9 ? 'badge-warning' : 'badge-light text-indigo' }}" style="font-size: 0.85rem;">
                                                {{$item->productionopenjob_status_name}}
                                            </span>
                                        </td>
                                        <td class="text-secondary">{{\Carbon\Carbon::parse($item->productionnotice_dt_duedate)->format('d/m/Y')}}</td>
                                        <td>{{\Carbon\Carbon::parse($item->productionopenjob_hd_date)->format('d/m/Y')}}</td>
                                        <td class="font-weight-bold text-dark">{{$item->productionopenjob_hd_docuno}}</td>
                                        <td class="small text-muted">
                                            {{\Carbon\Carbon::parse($item->productionopenjob_hd_startdate)->format('d/m/Y')}} - <br>
                                            {{\Carbon\Carbon::parse($item->productionopenjob_hd_enddate)->format('d/m/Y')}}
                                        </td>
                                        <td>{{$item->ms_customer_name}}</td>
                                        <td>
                                            <span class="font-weight-600">{{$item->ms_product_name}}</span> 
                                            <span class="text-muted small">({{$item->ms_product_qty}})</span>
                                        </td>
                                        <td>{{$item->ms_specpage_name}}</td>
                                        <td class="text-truncate" style="max-width: 150px;">{{$item->productionnotice_dt_remark}}</td>
                                        <td class="text-right font-weight-bold">{{number_format($item->productionopenjob_estimatecost,2)}}</td>
                                        <td class="text-right font-weight-bold text-indigo">{{number_format($item->productionopenjob_actualcost,2)}}</td>
                                        <td class="text-center">
                                            @if ($item->productionopenjob_hd_filename)
                                            <a href="{{asset($item->productionopenjob_hd_filename)}}" target="_blank" class="text-danger h5">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($item->productionopenjob_status_id == 9 || $item->productionopenjob_status_id == 13)
                                            <a href="{{route('pd-close.edit',$item->productionopenjob_hd_id)}}" 
                                                class="btn btn-sm btn-warning btn-action text-white" title="แก้ไข">
                                                <i class="fas fa-edit"></i> แก้ไข
                                            </a>
                                            @else
                                            <a href="javascript:void(0)" 
                                                class="btn btn-light btn-sm btn-action text-indigo" 
                                                data-toggle="modal" data-target="#modal"
                                                onclick="getDataClose('{{ $item->productionopenjob_hd_id }}')" title="ดูรายละเอียด">
                                                <i class="fas fa-eye mr-1"></i> เปิดดู
                                            </a>                                   
                                            @endif                                                                                
                                        </td>
                                        <td class="small text-muted">
                                            @if ($item->edit_qty)
                                            <span class="badge badge-light text-secondary mb-1">จำนวน {{$item->edit_qty}} ครั้ง</span><br>
                                            @endif  
                                            {{$item->note_editclose}}                              
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

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-4 py-3">
                <h5 class="modal-title font-weight-bold text-indigo"><i class="fas fa-info-circle mr-2"></i>รายละเอียดรายการปิดงาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">              
                <div class="table-responsive">
                    <table class="table modern-table mb-0">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>                              
                                <th>รหัสสินค้า</th>    
                                <th>ชื่อสินค้า</th>  
                                <th>หน่วยนับ</th>     
                                <th class="text-right">จำนวน</th>          
                                <th class="text-right">ประมาณการต้นทุน</th>     
                                <th class="text-right">จำนวนเงินที่ใช้</th>                                 
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
<script src="{{asset('/assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('/assets/plugins/toastr/toastr.min.js')}}"></script>
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
            { extend: 'copy', className: 'btn btn-sm btn-light text-dark' },
            { extend: 'csv', className: 'btn btn-sm btn-light text-dark' },
            { extend: 'excel', className: 'btn btn-sm btn-light text-indigo' },
            { extend: 'pdf', className: 'btn btn-sm btn-light text-danger' },
            { extend: 'print', className: 'btn btn-sm btn-light text-secondary' }
        ],
        columnDefs: [{
            targets: 1,
            type: 'time-date-sort'
        }],
        order: [
            [3, "asc"]
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
        pagingType: "full_numbers",
        bSort: true
    });
});

getDataClose = (id) => {
    $.ajax({
        url: "{{ url('/getData-Close') }}",
        type: "post",
        dataType: "JSON",
        data: {
            refid: id,
            _token: "{{ csrf_token() }}"      
        },    
        success: function(data) {
            console.log(data);
            let el_list = ''; 
            $.each(data.dt, function(key , item) {
                if(item.productionopenjob_dt_remark == null){
                    item.productionopenjob_dt_remark = ''
                }
                
                el_list += `    
                    <tr> 
                        <td class="text-secondary">${key+1}</td> 
                        <td class="font-weight-bold">${item.ms_product_code}</td>  
                        <td>${item.ms_product_name}</td>  
                        <td><span class="badge badge-light p-2">${item.ms_product_unit}</span></td>  
                        <td class="text-right font-weight-bold">${parseFloat(item.assembleqty).toFixed(2)}</td>         
                        <td class="text-right text-muted">${parseFloat(item.estimatecost).toFixed(2)}</td>        
                        <td class="text-right font-weight-bold text-indigo">${parseFloat(item.actualcost).toFixed(2)}</td>    
                    </tr>
                `
            })      
            $('#tb_list').html(el_list);
        }
    });
}
</script>
@endpush