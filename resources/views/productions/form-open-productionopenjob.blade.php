@extends('layouts.main')
@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-lg" style="background-color: #ffffff;">
                <div class="card-body p-4">
                    
                    <form method="GET" class="form-horizontal m-0">
                        @csrf
                        <div class="row align-items-end">
                            
                            <div class="col-12 col-md-3 col-lg-2 mb-3 mb-md-0">
                                <h3 class="card-title text-dark font-weight-bold m-0" style="font-size: 1.35rem; tracking: -0.5px;">
                                    เอกสารเปิดงาน
                                </h3>
                            </div>
                            
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 mb-3 mb-md-0">
                                <div class="form-group mb-0">
                                    <label for="datestart" class="form-label text-muted font-weight-bold small mb-1">วันที่เริ่มต้น</label>
                                    <input type="date" class="form-control rounded-lg border-gray-300" name="datestart" id="datestart" value="{{$datestart}}">
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 mb-3 mb-md-0">
                                <div class="form-group mb-0">
                                    <label for="dateend" class="form-label text-muted font-weight-bold small mb-1">ถึงวันที่</label>
                                    <input type="date" class="form-control rounded-lg border-gray-300" name="dateend" id="dateend" value="{{$dateend}}">
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-4 col-md-2 col-lg-2 mb-3 mb-md-0 d-flex align-items-center" style="height: 38px;">
                                <div class="form-check d-flex align-items-center p-0">
                                    <input type="checkbox" class="custom-cb" id="checkboxPrimary1" name="ck_sta" {{ request('ck_sta') ? 'checked' : '' }}>
                                    <label for="checkboxPrimary1" class="form-label text-secondary font-weight-medium m-0 ms-2" style="cursor: pointer; padding-left: 6px;">รออนุมัติ</label>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-2 col-lg-2 ms-auto text-end">
                                <button class="btn btn-indigo w-100 font-weight-bold rounded-lg shadow-sm-none py-2" type="submit">
                                    <i class="fas fa-search mr-1"></i> ค้นหาข้อมูล
                                </button>
                            </div>
                            
                        </div>
                    </form>
                    
                    <hr class="my-4" style="border-color: #f1f5f9;">
                    
                    <div class="table-responsive">
                        <table class="table table-balanced align-middle table-hover border" id="tb_job">
                            <thead>
                                <tr>
                                    <th class="py-3 text-secondary font-weight-bold">สถานะ</th>
                                    <th class="py-3 text-secondary font-weight-bold">กำหนดส่ง</th>
                                    <th class="py-3 text-secondary font-weight-bold">วันที่</th>
                                    <th class="py-3 text-secondary font-weight-bold">เลขที่เอกสาร</th>
                                    <th class="py-3 text-secondary font-weight-bold">วันที่เริ่ม - จบ</th>
                                    <th class="py-3 text-secondary font-weight-bold">ลูกค้า</th>
                                    <th class="py-3 text-secondary font-weight-bold">สินค้า (จำนวน)</th>
                                    <th class="py-3 text-secondary font-weight-bold">Spec Page</th>
                                    <th class="py-3 text-secondary font-weight-bold">รายละเอียด</th>
                                    <th class="py-3 text-secondary font-weight-bold text-right">ประมาณการต้นทุน</th>                           
                                    <th class="py-3 text-secondary font-weight-bold text-center" style="width: 60px;">จัดการ</th>
                                    <th class="py-3 text-secondary font-weight-bold">บันทึกแก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hd as $item)
                                <tr>
                                    <td>
                                        <span class="badge badge-custom-status">
                                            {{$item->productionopenjob_status_name}}
                                        </span>
                                    </td>
                                    <td class="font-weight-medium text-danger">{{\Carbon\Carbon::parse($item->productionnotice_dt_duedate)->format('d/m/Y')}}</td>
                                    <td class="text-muted">{{\Carbon\Carbon::parse($item->productionopenjob_hd_date)->format('d/m/Y')}}</td>
                                    <td class="font-weight-bold text-indigo">{{$item->productionopenjob_hd_docuno}}</td>
                                    <td class="text-secondary" style="font-size: 0.88rem;">
                                        {{\Carbon\Carbon::parse($item->productionopenjob_hd_startdate)->format('d/m/Y')}} - 
                                        {{\Carbon\Carbon::parse($item->productionopenjob_hd_enddate)->format('d/m/Y')}}
                                    </td>
                                    <td class="font-weight-medium text-dark">{{$item->ms_customer_name}}</td>
                                    <td>
                                        <span class="text-dark font-weight-medium">{{$item->ms_product_name}}</span> 
                                        <span class="text-indigo small font-weight-bold">({{$item->ms_product_qty}})</span>
                                    </td>
                                    <td><span class="text-muted">{{$item->ms_specpage_name ?: '-'}}</span></td>
                                    <td style="min-width: 180px; white-space: normal; word-break: break-word;">
                                        <span class="text-muted">{{$item->productionnotice_dt_remark ?: '-'}}</span>
                                    </td>
                                    <td class="text-right font-weight-bold text-dark">{{number_format($item->productionopenjob_estimatecost,2)}}</td>                               
                                    <td class="text-center">
                                        @if($item->productionopenjob_status_id == 1 || $item->productionopenjob_status_id == 3 || $item->productionopenjob_status_id == 5)
                                        <a href="{{route('pd-open.edit',$item->productionopenjob_hd_id)}}" class="btn btn-sm btn-action-edit" title="แก้ไขเอกสาร">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @else
                                        <a href="javascript:void(0)" class="btn btn-sm btn-action-view" data-toggle="modal" data-target="#modal" onclick="getDataOpen('{{ $item->productionopenjob_hd_id }}')" title="ดูรายละเอียด">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @endif                                                                                  
                                    </td>
                                    <td style="font-size: 0.88rem;" class="text-secondary">
                                        @if ($item->edit_qty)
                                        <span class="text-amber font-weight-bold"><i class="fas fa-history mr-1"></i> แก้ไข {{$item->edit_qty}} ครั้ง</span><br>
                                        @endif     
                                        <small class="text-muted italic">{{$item->note_edit}}</small>                         
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
        <div class="modal-content border-0 shadow-lg rounded-lg">
            <div class="modal-header px-4 py-3 bg-light" style="border-bottom: 1px solid #e2e8f0;">
                <h5 class="modal-title font-weight-bold text-dark" style="font-size: 1.1rem;"><i class="fas fa-info-circle text-indigo mr-2"></i> รายละเอียดขั้นตอนการเปิดงาน</h5>
                <button type="button" class="btn-close-custom" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">              
                <div class="table-responsive">
                    <table class="table table-balanced align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-secondary font-weight-bold">สถานะ</th>
                                <th class="text-secondary font-weight-bold">แผนก</th>
                                <th class="text-secondary font-weight-bold text-center" style="width: 60px;">ลำดับ</th>
                                <th class="text-secondary font-weight-bold">วันที่ต้องการ</th>                                    
                                <th class="text-secondary font-weight-bold">ชื่อสินค้า</th>  
                                <th class="text-secondary font-weight-bold">หน่วยนับ</th>     
                                <th class="text-secondary font-weight-bold text-center">จำนวน</th>      
                                <th class="text-secondary font-weight-bold">รายละเอียด</th>       
                                <th class="text-secondary font-weight-bold text-right">ประมาณการต้นทุน</th>                                    
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

<style>
    :root { --indigo-primary: #4f46e5; --indigo-hover: #4338ca; }
    .text-indigo { color: var(--indigo-primary) !important; }
    .text-amber { color: #d97706 !important; }
    
    .btn-indigo { background-color: var(--indigo-primary) !important; border-color: var(--indigo-primary) !important; color: #ffffff !important; transition: all 0.2s; }
    .btn-indigo:hover { background-color: var(--indigo-hover) !important; border-color: var(--indigo-hover) !important; transform: translateY(-1px); }
    
    .rounded-lg { border-radius: 0.75rem !important; }
    .italic { font-style: italic; }
    
    /* ปุ่ม Action สไตล์มินิมอล */
    .btn-action-edit { background-color: #fef3c7; color: #d97706 !important; border: none; padding: 6px 10px; border-radius: 6px; transition: all 0.15s; }
    .btn-action-edit:hover { background-color: #fde68a; transform: scale(1.05); }
    .btn-action-view { background-color: #e0e7ff; color: var(--indigo-primary) !important; border: none; padding: 6px 10px; border-radius: 6px; transition: all 0.15s; }
    .btn-action-view:hover { background-color: #c7d2fe; transform: scale(1.05); }
    
    /* จัดการความกว้างและสไตล์หัวตาราง */
    .table-balanced { width: 100% !important; margin-bottom: 0 !important; }
    .table-balanced thead th { background-color: #f8fafc; border-bottom: 2px solid #e2e8f0 !important; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 10px; border-top: none; color: #64748b !important; }
    .table-balanced tbody td { vertical-align: middle !important; padding: 12px 10px !important; color: #334155; font-size: 0.92rem; border-color: #f1f5f9 !important; }
    
    /* ข้อความยาวเกินจะตัดเป็น ... */
    .style-truncate { display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; vertical-align: bottom; }
    
    /* สไตล์ Badge สถานะคอลัมน์ทั่วไปภายในแถว */
    .badge-custom-status { background-color: #f1f5f9; color: #475569; font-size: 0.82rem; padding: 5px 10px; border-radius: 50px; font-weight: 500; }
    
    /* กล่อง Checkbox คุมโทนสี */
    .custom-cb { width: 18px; height: 18px; accent-color: var(--indigo-primary); cursor: pointer; vertical-align: middle; }
    
    /* ปุ่มกากบาทหน้าต่างโมดอล */
    .btn-close-custom { background: transparent; border: none; font-size: 1.4rem; color: #94a3b8; line-height: 1; transition: color 0.15s; padding: 0; margin: 0; }
    .btn-close-custom:hover { color: #334155; }
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
            [2, "desc"] // ปรับให้ Default เรียงตามคอลัมน์วันที่เอกสารลงมาล่าสุดเพื่อความสมเหตุสมผล
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
        pagingType: "full_numbers",
        bSort: true
    });
});

getDataOpen = (id) => {
    $.ajax({
        url: "{{ url('/getData-Open') }}",
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
                    item.productionopenjob_dt_remark = '-'
                }
                
                // แปลงฟอร์แมตตัวเลขต้นทุนให้แสดงทศนิยม 2 ตำแหน่งเสมอกับหน้าหลัก
                let formattedCost = parseFloat(item.estimatecost) ? idToMoneyFormat(item.estimatecost) : '0.00';
                
                el_list += `    
                    <tr>
                        <td><span class="badge-custom-status">${item.productionopenjob_status_name}</span></td>  
                        <td class="font-weight-medium text-dark">${item.ms_department_name}</td>  
                        <td class="text-center text-muted">${key+1}</td> 
                        <td class="text-secondary">${item.duedate}</td>                
                        <td class="font-weight-medium">${item.ms_product_name}</td>  
                        <td><span class="badge bg-light text-secondary border px-2 py-1">${item.ms_product_unit}</span></td>  
                        <td class="text-center font-weight-bold text-indigo">${item.ms_product_qty}</td>  
                        <td class="text-muted" style="font-size: 0.88rem;">${item.productionopenjob_dt_remark}</td>           
                        <td class="text-right font-weight-bold text-dark">${formattedCost}</td>            
                    </tr>
                `;
            });      
            $('#tb_list').html(el_list);
        }
    });
}

// ฟังก์ชันช่วยจัด Format ตัวเลขทศนิยมใน JavaScript (ถ้าจำเป็น)
function idToMoneyFormat(value) {
    return Number(value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}
</script>
@endpush