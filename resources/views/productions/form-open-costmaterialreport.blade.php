@extends('layouts.main')
@section('content')

<style>
    /* โครงสร้าง Card หลัก */
    .modern-card {
        border: none;
        border-radius: 24px;
        box-shadow: 0 10px 35px rgba(99, 102, 241, 0.04);
        background: #ffffff;
        margin-top: 1.5rem;
        padding: 1.5rem;
    }
    .modern-card-title {
        color: #0F172A;
        font-weight: 700;
        font-size: 1.6rem;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .modern-divider {
        border-top: 2px solid #F1F5F9;
        margin-top: 1.2rem;
        margin-bottom: 1.5rem;
    }

    /* สไตล์ปรับแต่ง DataTables & ตารางมินิมอล */
    .table-responsive {
        border: none !important;
    }
    .modern-table {
        width: 100% !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
    }
    
    /* จัดระเบียบแถวหัวตารางแยกเป็น 2 บรรทัด */
    .modern-table thead tr.main-header th {
        background-color: #F8FAFC !important;
        color: #4F46E5 !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        font-size: 0.85rem;
        padding: 14px 16px 8px 16px !important;
        border-top: none !important;
        border-bottom: none !important;
    }
    .modern-table thead tr.filter-header th {
        background-color: #F8FAFC !important;
        padding: 4px 16px 14px 16px !important;
        border-bottom: 2px solid #E2E8F0 !important;
        border-top: none !important;
    }

    .modern-table tbody td {
        padding: 14px 16px !important;
        vertical-align: middle !important;
        color: #334155;
        font-size: 0.95rem;
        border-bottom: 1px solid #F1F5F9 !important;
        border-top: none !important;
    }
    .modern-table tbody tr:hover td {
        background-color: rgba(99, 102, 241, 0.02) !important;
    }

    /* ดีไซน์ตัวกล่อง Dropdown ฟิลเตอร์แถวล่าง */
    .modern-table thead select.filter-select {
        width: 100% !important;
        background-color: #ffffff !important;
        border: 1px solid #CBD5E1 !important;
        border-radius: 8px !important;
        height: 36px !important;
        padding: 4px 10px !important;
        font-size: 0.85rem !important;
        color: #334155 !important;
        font-weight: 500;
        transition: all 0.2s ease;
        cursor: pointer;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.02);
    }
    .modern-table thead select.filter-select:focus {
        border-color: #6366F1 !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15) !important;
    }

    /* ชุดปุ่มคำสั่งและสเตตัสพาสเทลหรู */
    .badge-modern-success {
        background-color: #DCFCE7 !important;
        color: #15803D !important;
        padding: 6px 14px !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 0.8rem !important;
        display: inline-block;
    }
    .badge-modern-danger {
        background-color: #FEE2E2 !important;
        color: #B91C1C !important;
        padding: 6px 14px !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 0.8rem !important;
        display: inline-block;
    }
    .btn-modern-warning {
        background-color: #FEF3C7 !important;
        color: #D97706 !important;
        border: none !important;
        border-radius: 10px !important;
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .btn-modern-warning:hover {
        background-color: #FDE68A !important;
        transform: translateY(-1px);
    }
    .btn-modern-primary {
        background-color: #EEF2F6 !important;
        color: #4F46E5 !important;
        border: none !important;
        border-radius: 10px !important;
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .btn-modern-primary:hover {
        background-color: #E0E7FF !important;
        transform: translateY(-1px);
    }

    /* จัดการปุ่มเครื่องมือ DataTables ให้เว้นระยะสวยงาม */
    .dataTables_wrapper .dt-buttons {
        margin-bottom: 16px !important;
        float: left;
    }
    .dataTables_wrapper .dt-buttons .dt-button {
        background: #ffffff !important;
        border: 1px solid #E2E8F0 !important;
        color: #475569 !important;
        border-radius: 10px !important;
        padding: 6px 16px !important;
        font-size: 0.85rem !important;
        font-weight: 600 !important;
        box-shadow: none !important;
        transition: all 0.2s !important;
    }
    .dataTables_wrapper .dt-buttons .dt-button:hover {
        background: #F8FAFC !important;
        color: #4F46E5 !important;
        border-color: #CBD5E1 !important;
    }
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 16px !important;
        float: right;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #E2E8F0 !important;
        border-radius: 8px !important;
        padding: 6px 12px !important;
        outline: none;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #6366F1 !important;
    }

    /* หน้าต่าง Pop-up (Modal XL) ดีไซน์ใหม่ */
    .modern-modal-xl .modal-content {
        border: none !important;
        border-radius: 24px !important;
        box-shadow: 0 25px 50px rgba(15, 23, 42, 0.15) !important;
        overflow: hidden;
    }
    .modern-modal-xl .modal-header {
        background-color: #F8FAFC;
        border-bottom: 1px solid #E2E8F0;
        padding: 20px 28px;
    }
    .modern-modal-xl .modal-title {
        color: #0F172A;
        font-weight: 700;
        font-size: 1.25rem;
    }
    .modern-modal-xl .modal-body {
        padding: 28px;
    }
</style>

<div class="container-fluid">
    <div class="card modern-card">
        <div class="card-body p-0">
            
            <h3 class="modern-card-title">
                <i class="fas fa-layer-group" style="color: #6366F1;"></i> Cost of Material
            </h3>
            <div class="modern-divider"></div>
            
            <div class="table-responsive">
                <table class="table modern-table" id="tb_job">
                    <thead>
                        <tr class="main-header">
                            <th style="width: 25%;">สถานะ</th>
                            <th style="width: 30%;">ปี-เดือน</th>
                            <th style="width: 30%;">ผู้บันทึก</th>
                            <th style="width: 15%;" class="text-center"><i class="fas fa-cog"></i></th>
                        </tr>
                        <tr class="filter-header">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hd as $item)
                            <tr>
                                <td>
                                    @if ($item->costmaterial_report_flag == 1)
                                        <span class="badge badge-modern-success">สรุปเรียบร้อย</span>
                                    @else
                                        <span class="badge badge-modern-danger">ยกเลิก</span>
                                    @endif
                                </td> 
                                <td style="font-weight: 600; color: #1E293B;">{{$item->costmaterial_report_yearmonth}}</td>   
                                <td><i class="far fa-user text-muted mr-1"></i> {{$item->created_person}}</td> 
                                <td class="text-center">
                                    @if($item->reviewed_by == null || $item->acknowledges_by == null)
                                        <a href="{{route('cm-report.edit',$item->costmaterial_report_id)}}" class="btn-modern-warning" title="แก้ไขข้อมูล">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="btn-modern-primary" data-toggle="modal" data-target="#modal" onclick="getDataCost('{{ $item->costmaterial_report_id }}')" title="ดูรายละเอียด">
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

<div class="modal fade modern-modal-xl" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-file-invoice-dollar mr-2" style="color: #6366F1;"></i> รายละเอียดต้นทุนวัสดุ
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">              
                <div class="table-responsive">
                    <table class="table modern-table mb-0">
                        <thead>
                            <tr>
                                <th>Job No.</th>
                                <th>Serial No.</th>
                                <th>Spec Page No</th>
                                <th>Delivery Date</th>                                   
                                <th>Description</th>    
                                <th>Buyer</th>  
                                <th class="text-right">QTY</th>     
                                <th class="text-right">Unit</th>      
                                <th class="text-right">Total</th>                                        
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
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        columnDefs: [{
            targets: 1,
            type: 'time-date-sort'
        }],
        order: [
            [1, "desc"] // จัดเรียงตามปี-เดือน ล่าสุดขึ้นก่อน
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
        pagingType: "full_numbers",
        bSort: true,
        initComplete: function() {
            this.api().columns().every(function(index) {
                var column = this;
                
                // ชี้ไปที่ช่อง <th> ของแถว filter-header ตรงกับ index คอลัมน์นั้นๆ
                var filterCell = $('#tb_job thead tr.filter-header th').eq(index);

                // หากเป็นคอลัมน์สุดท้าย (คอลัมน์ที่ 3 เป็นปุ่ม Action) ให้ปล่อยว่างไว้ ไม่ต้องใส่ Filter
                if (index === 3) {
                    filterCell.html(''); 
                    return;
                }

                // สร้างตัวเลือก Dropdown คลีนๆ สไตล์มินิมอล
                var select = $('<select class="filter-select"><option value="">🔍 ทั้งหมด</option></select>')
                    .appendTo(filterCell.empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                // ดึงข้อมูลที่ไม่ซ้ำมาหยอดใส่ Option
                column.data().unique().sort().each(function(d, j) {
                    // ทำความสะอาดล้างพวก HTML Tags ออก (เช่น ป้าย <span class="badge..."> ออกให้เหลือแค่ข้อความด้านใน)
                    var cleanText = d.replace(/<[^>]*>/g, "").trim(); 
                    if(cleanText != "") {
                        select.append('<option value="' + cleanText + '">' + cleanText + '</option>');
                    }
                });
            });
        }
    });
});

getDataCost = (id) => {
    $.ajax({
        url: "{{ url('/getData-Cost') }}",
        type: "post",
        dataType: "JSON",
        data: {
            refid: id,
            _token: "{{ csrf_token() }}"      
        },    
        success: function(data) {
            let el_list = ''; 
            $.each(data.dt, function(key, item) {
                el_list += `    
                    <tr>
                        <td style="font-weight:600; color:#4F46E5;">${item.costmaterial_reportsub_jobno}</td>  
                        <td>${item.costmaterial_reportsub_serialno}</td>  
                        <td>${item.costmaterial_reportsub_specpage}</td> 
                        <td><i class="far fa-calendar-alt text-muted mr-1"></i> ${item.delivery_date}</td>  
                        <td>${item.costmaterial_reportsub_desp}</td>  
                        <td>${item.costmaterial_reportsub_cust}</td>  
                        <td class="text-right" style="font-weight:600;">${parseFloat(item.costmaterial_reportsub_qty).toLocaleString(undefined, {minimumFractionDigits: 2})}</td>  
                        <td class="text-right">${parseFloat(item.costmaterial_reportsub_unit).toLocaleString(undefined, {minimumFractionDigits: 2})}</td>  
                        <td class="text-right" style="font-weight:700; color:#0F172A;">${parseFloat(item.costmaterial_reportsub_total).toLocaleString(undefined, {minimumFractionDigits: 2})}</td>                     
                    </tr>
                `;
            });      
            $('#tb_list').html(el_list);
        }
    });
}
</script>
@endpush