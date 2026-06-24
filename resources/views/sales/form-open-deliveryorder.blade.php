@extends('layouts.main')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-lg" style="background-color: #ffffff;">
                <div class="card-body p-4 sm:p-5">
                    
                    <form method="GET" class="form-horizontal m-0">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                                <h3 class="card-title text-dark font-weight-bold m-0" style="font-size: 1.45rem; tracking: -0.5px;">
                                    <i class="fas fa-truck text-indigo mr-2"></i> เอกสารนำส่งสินค้า
                                </h3>
                            </div>
                            
                            <div class="col-12 col-lg-9">
                                <div class="row align-items-center justify-content-lg-end">
                                    <div class="col-12 col-sm-5 col-md-4 mb-2 mb-sm-0">
                                        <div class="form-group row mb-0 align-items-center">
                                            <label for="datestart" class="col-3 col-sm-4 col-form-label text-muted text-right font-weight-bold p-sm-0">เริ่ม:</label>
                                            <div class="col-9 col-sm-8">
                                                <input type="date" class="form-control rounded-lg border-gray-300" name="datestart" id="datestart" value="{{$datestart}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-5 col-md-4 mb-3 mb-sm-0">
                                        <div class="form-group row mb-0 align-items-center">
                                            <label for="dateend" class="col-3 col-sm-4 col-form-label text-muted text-right font-weight-bold p-sm-0">ถึง:</label>
                                            <div class="col-9 col-sm-8">
                                                <input type="date" class="form-control rounded-lg border-gray-300" name="dateend" id="dateend" value="{{$dateend}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-2 text-right">
                                        <button class="btn btn-indigo w-100 font-weight-bold rounded-lg shadow-sm-none py-2" type="submit">
                                            <i class="fas fa-search mr-1"></i> ค้นหา
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>           
                    </form>

                    <hr class="my-4" style="border-top: 1px solid #f1f5f9;">
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-balanced align-middle table-hover" id="tb_job" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center py-3 text-secondary font-weight-bold" style="width: 8%;">สถานะ</th>
                                            <th class="text-center py-3 text-secondary font-weight-bold" style="width: 9%;">วันที่</th>
                                            <th class="text-center py-3 text-secondary font-weight-bold" style="width: 9%;">กำหนดส่ง</th>
                                            <th class="text-center py-3 text-secondary font-weight-bold" style="width: 13%;">เลขที่ใบนำส่งสินค้า</th>
                                            <th class="text-center py-3 text-secondary font-weight-bold" style="width: 12%;">เลขที่อ้างอิง</th>
                                            <th class="text-left py-3 text-secondary font-weight-bold" style="width: 15%;">ลูกค้า</th>
                                            <th class="text-left py-3 text-secondary font-weight-bold" style="width: 11%;">หมายเหตุ</th>
                                            <th class="text-center py-3 text-secondary font-weight-bold" style="width: 8%;">ผู้ตรวจสอบ</th>
                                            <th class="text-center py-3 text-secondary font-weight-bold" style="width: 8%;">ผู้จัดส่ง</th>
                                            <th class="text-center py-3 text-secondary font-weight-bold" style="width: 9%;">วันที่จัดส่ง</th>
                                            <th class="text-center py-3 text-secondary font-weight-bold" style="width: 6%;">จัดการ</th>
                                        </tr>
                                    </thead>   
                                    <tbody>
                                        @foreach ($hd as $item)
                                        <tr>
                                            <td class="text-center">
                                                <span class="badge badge-indigo-soft">
                                                    {{$item->deliveryorder_status_name}}
                                                </span>
                                            </td>
                                            <td class="text-center text-muted font-weight-bold">{{\Carbon\Carbon::parse($item->deliveryorder_hd_date)->format('d/m/Y')}}</td>
                                            <td class="text-center text-danger font-weight-bold">{{\Carbon\Carbon::parse($item->deliveryorder_hd_duedate)->format('d/m/Y')}}</td>
                                            <td class="text-center text-indigo font-weight-bold">{{$item->deliveryorder_hd_docuno}}</td>
                                            <td class="text-center text-secondary" style="font-size: 0.9rem;">{{$item->productionnotice_hd_docuno ?: '-'}}</td>
                                            <td class="text-left text-dark font-weight-medium">{{$item->ms_customer_name}}</td>
                                            <td class="text-left text-muted" style="font-size: 0.85rem;">{{$item->deliveryorder_hd_note ?: '-'}}</td>
                                            <td class="text-center text-muted" style="font-size: 0.9rem;">{{$item->checked_by ?: '-'}}</td>
                                            <td class="text-center text-muted" style="font-size: 0.9rem;">{{$item->delivery_by ?: '-'}}</td>
                                            <td class="text-center text-muted">
                                                {{ $item->delivery_date ? \Carbon\Carbon::parse($item->delivery_date)->format('d/m/Y') : '-' }}
                                            </td>
                                            <td class="text-center">
                                                @if($item->deliveryorder_status_id == 1)
                                                <a href="{{route('del-order.edit',$item->deliveryorder_hd_id)}}" class="btn btn-action-edit" title="แก้ไข">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>                                   
                                                @else
                                                <a href="javascript:void(0)" class="btn btn-action-view" data-toggle="modal" data-target="#modal" onclick="getDataDel('{{ $item->deliveryorder_hd_id }}')" title="ดูรายละเอียด">
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
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-xl">
            <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title font-weight-bold text-dark">
                    <i class="fas fa-list text-indigo mr-2"></i> รายละเอียดใบนำส่งสินค้า
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 1.6rem;">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 pb-4"> 
                <div class="table-responsive">
                    <table class="table table-balanced align-middle table-bordered border">
                        <thead style="background-color: #f8fafc;">
                            <tr>
                                <th class="border-0 text-secondary text-left" style="width: 18%;">S/N MODEL</th>
                                <th class="border-0 text-secondary text-left" style="width: 25%;">Description</th>  
                                <th class="border-0 text-secondary text-center" style="width: 10%;">Qty.</th>                                   
                                <th class="border-0 text-secondary text-center" style="width: 12%;">Del. Chk.</th>    
                                <th class="border-0 text-secondary text-center" style="width: 12%;">Rec. Chk.</th>  
                                <th class="border-0 text-secondary text-left" style="width: 23%;">Part No./Note</th>                            
                            </tr>
                        </thead>
                        <tbody id="tb_list"></tbody>
                    </table>
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
    .rounded-xl { border-radius: 1rem !important; }

    /* ปุ่ม Action ขนาดกะทัดรัด มน สวยงาม */
    .btn-action-edit, .btn-action-view { display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 0.5rem; border: none; transition: all 0.15s; }
    .btn-action-edit { background-color: #fef3c7; color: #d97706; }
    .btn-action-edit:hover { background-color: #fde68a; color: #b45309; transform: translateY(-1px); }
    .btn-action-view { background-color: #e0e7ff; color: var(--indigo-primary); }
    .btn-action-view:hover { background-color: #c7d2fe; color: var(--indigo-hover); transform: translateY(-1px); }

    /* ตารางแบบ Balanced Layout */
    .table-balanced thead th { background-color: #f8fafc; border-bottom: 2px solid #e2e8f0 !important; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px; border-top: none; }
    .table-balanced tbody tr { transition: background-color 0.15s; }
    .table-balanced tbody tr:hover { background-color: #f8fafc !important; }
    .align-middle td { vertical-align: middle !important; padding: 12px 8px !important; color: #334155; font-size: 0.92rem; }

    /* ป้ายสถานะคลีนๆ */
    .badge-indigo-soft { background-color: #eef2ff; color: var(--indigo-primary); padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 0.85rem; }

    /* ตกแต่ง Checkbox ภายในตารางให้อยู่ตรงกลางน่ามอง */
    .custom-cb { width: 18px; height: 18px; accent-color: var(--indigo-primary); cursor: not-allowed; vertical-align: middle; }
</style>
@endsection

@push('scriptjs')
<script>
$(document).ready(function() {
    $('#tb_job').DataTable({
        "pageLength": 30,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'Bfrtip',
       buttons: [
            { extend: 'copy', className: 'btn btn-sm btn-light border' },
            { extend: 'csv', className: 'btn btn-sm btn-light border' },
            { extend: 'excel', className: 'btn btn-sm btn-light border' },
            { extend: 'pdf', className: 'btn btn-sm btn-light border' },
            { extend: 'print', className: 'btn btn-sm btn-light border' }
        ],
        columnDefs: [{ targets: 1, type: 'time-date-sort' }],
        order: [[2, "desc"]],
        fixedHeader: { header: false, footer: false },
        pagingType: "full_numbers",
        bSort: true,   
    });
});

getDataDel = (id) => {
    $.ajax({
        url: "{{ url('/getDataDel') }}",
        type: "post",
        dataType: "JSON",
        data: { refid: id, _token: "{{ csrf_token() }}" },    
        success: function(data) {
            let el_list = ''; 
            $.each(data.dt, function(key , item) {
                let model = item.deliveryorder_dt_model || '-';
                let remark = item.deliveryorder_dt_remark || '-';
                let desp = item.deliveryorder_dt_desp || '-';
                
                // แปลง Checkbox ให้สวยงามสะดุดตาตามธีมของหน้า
                let del_list = item.del_checked == 1 
                    ? '<input type="checkbox" class="custom-cb" checked onclick="return false;">' 
                    : '<input type="checkbox" class="custom-cb" onclick="return false;">';
                    
                let rec_list = item.rec_checked == 1 
                    ? '<input type="checkbox" class="custom-cb" checked onclick="return false;">' 
                    : '<input type="checkbox" class="custom-cb" onclick="return false;">';

                el_list += `    
                    <tr>
                        <td class="text-left font-weight-medium text-dark">${model}</td>  
                        <td class="text-left text-muted" style="font-size: 0.9rem;">${desp}</td>  
                        <td class="text-center font-weight-bold text-secondary">${parseFloat(item.deliveryorder_dt_qty).toFixed(2)}</td>  
                        <td class="text-center">${del_list}</td>  
                        <td class="text-center">${rec_list}</td>       
                        <td class="text-left text-muted" style="font-size: 0.9rem;">${remark}</td>    
                    </tr>`;
            });      
            $('#tb_list').html(el_list);
        }
    });
} 
</script>        
@endpush