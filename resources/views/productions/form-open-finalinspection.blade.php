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
        font-size: 1.5rem;
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

    /* ฟอร์มค้นหาด้านบน (Search Bar Dashboard) */
    .search-zone {
        background-color: #FAFAFE;
        border-radius: 16px;
        padding: 20px 15px 5px 15px;
        margin-bottom: 20px;
        border: 1px solid #EEF2F6;
    }
    .modern-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #4F46E5;
        margin-bottom: 8px;
    }
    .modern-form-control {
        background-color: #ffffff !important;
        border: 1px solid #CBD5E1 !important;
        border-radius: 10px !important;
        height: 40px !important;
        color: #334155 !important;
        font-weight: 500;
    }
    .modern-form-control:focus {
        border-color: #6366F1 !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12) !important;
    }
    
    /* สไตล์ Checkbox รออนุมัติ */
    .modern-checkbox-wrapper {
        display: flex;
        align-items: center;
        height: 40px;
        margin-top: 28px;
    }
    .modern-checkbox-wrapper input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #6366F1;
        cursor: pointer;
    }
    .modern-checkbox-wrapper label {
        margin-bottom: 0;
        margin-left: 8px;
        font-weight: 600;
        color: #475569;
        cursor: pointer;
    }

    /* ปุ่มค้นหา */
    .btn-modern-search {
        background-color: #6366F1 !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 10px !important;
        height: 40px;
        padding: 0 24px;
        font-weight: 600;
        margin-top: 28px;
        width: 100%;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }
    .btn-modern-search:hover {
        background-color: #4F46E5 !important;
        transform: translateY(-1px);
    }

    /* สไตล์จัดระเบียบตาราง DataTables */
    .table-responsive {
        border: none !important;
    }
    .modern-table {
        width: 100% !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
    }
    
    /* แถวหัวข้อหลัก (บรรทัดบน) */
    .modern-table thead tr.main-header th {
        background-color: #F8FAFC !important;
        color: #4F46E5 !important;
        font-weight: 600 !important;
        font-size: 0.85rem;
        padding: 12px 10px 6px 10px !important;
        border-top: none !important;
        border-bottom: none !important;
        white-space: nowrap;
    }
    /* แถวช่องกรองข้อมูล Dropdown (บรรทัดล่าง) */
    .modern-table thead tr.filter-header th {
        background-color: #F8FAFC !important;
        padding: 4px 10px 12px 10px !important;
        border-bottom: 2px solid #E2E8F0 !important;
        border-top: none !important;
    }

    .modern-table tbody td {
        padding: 12px 10px !important;
        vertical-align: middle !important;
        color: #334155;
        font-size: 0.9rem;
        border-bottom: 1px solid #F1F5F9 !important;
    }
    .modern-table tbody tr:hover td {
        background-color: rgba(99, 102, 241, 0.01) !important;
    }

    /* ดีไซน์ตัวกล่องกลั่นกรองหัวตาราง */
    .modern-table thead select.filter-select {
        width: 100% !important;
        background-color: #ffffff !important;
        border: 1px solid #CBD5E1 !important;
        border-radius: 8px !important;
        height: 34px !important;
        padding: 2px 6px !important;
        font-size: 0.8rem !important;
        color: #475569 !important;
        font-weight: 500;
        cursor: pointer;
    }
    .modern-table thead select.filter-select:focus {
        border-color: #6366F1 !important;
        outline: none;
    }

    /* ปุ่ม Action แก้งาน / ดูงาน */
    .btn-modern-edit {
        background-color: #FEF3C7 !important;
        color: #D97706 !important;
        border: none !important;
        border-radius: 8px !important;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .btn-modern-edit:hover {
        background-color: #FDE68A !important;
        transform: translateY(-1px);
    }
    .btn-modern-view {
        background-color: #EEF2F6 !important;
        color: #4F46E5 !important;
        border: none !important;
        border-radius: 8px !important;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .btn-modern-view:hover {
        background-color: #E0E7FF !important;
        transform: translateY(-1px);
    }

    /* เครื่องมือปุ่มเซ็ตสิทธิ์ของ DataTables */
    .dataTables_wrapper .dt-buttons {
        margin-bottom: 16px !important;
        float: left;
    }
    .dataTables_wrapper .dt-buttons .dt-button {
        background: #ffffff !important;
        border: 1px solid #E2E8F0 !important;
        color: #475569 !important;
        border-radius: 8px !important;
        padding: 5px 14px !important;
        font-size: 0.85rem !important;
        font-weight: 600 !important;
    }
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 16px !important;
        float: right;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #E2E8F0 !important;
        border-radius: 8px !important;
        padding: 5px 12px !important;
        outline: none;
    }

    /* มอดอลดีไซน์โมเดิร์นคลีน */
    .modern-modal .modal-content {
        border: none !important;
        border-radius: 20px !important;
        box-shadow: 0 25px 50px rgba(15, 23, 42, 0.12) !important;
        overflow: hidden;
    }
    .modern-modal .modal-header {
        background-color: #F8FAFC;
        border-bottom: 1px solid #E2E8F0;
        padding: 16px 24px;
    }
    .modern-modal .nav-tabs {
        border-bottom: none !important;
    }
    .modern-modal .nav-tabs .nav-link {
        border: none !important;
        color: #64748B;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 8px;
    }
    .modern-modal .nav-tabs .nav-link.active {
        background-color: #6366F1 !important;
        color: #ffffff !important;
    }
    
    /* ลิงก์ดาวน์โหลดไฟล์แนบ */
    .file-attachment-link {
        color: #4F46E5 !important;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .file-attachment-link:hover {
        text-decoration: underline;
    }
</style>

<div class="container-fluid">
    <div class="card modern-card">
        <div class="card-body p-0">
            
            <form method="GET" class="form-horizontal">
                @csrf
                <div class="search-zone">
                    <div class="row align-items-center">
                        <div class="col-12 col-xl-3 mb-3">
                            <h3 class="modern-card-title">
                                <i class="fas fa-clipboard-check" style="color: #6366F1;"></i> เอกสารตรวจสอบขั้นตอนสุดท้าย
                            </h3>
                        </div>
                        <div class="col-12 col-md-3 col-xl-2 mb-3">
                            <div class="form-group mb-0">
                                <label for="datestart" class="modern-label">วันที่เริ่มต้น</label>
                                <input type="date" class="form-control modern-form-control" name="datestart" id="datestart" value="{{$datestart}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-xl-2 mb-3">
                            <div class="form-group mb-0">
                                <label for="dateend" class="modern-label">ถึงวันที่</label>
                                <input type="date" class="form-control modern-form-control" name="dateend" id="dateend" value="{{$dateend}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-xl-2 mb-3">
                            <div class="modern-checkbox-wrapper">
                                <input type="checkbox" id="checkboxPrimary1" name="ck_sta" {{ request('ck_sta') ? 'checked' : '' }}>
                                <label for="checkboxPrimary1">รออนุมัติ</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-xl-3 mb-3">
                            <button class="btn btn-modern-search" type="submit">
                                <i class="fas fa-search mr-1"></i> ค้นหารายการ
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="modern-divider"></div>         
            
            <div class="table-responsive">
                <table class="table modern-table" id="tb_job">
                    <thead>
                        <tr class="main-header">
                            <th style="width: 10%;">สถานะ</th>
                            <th style="width: 10%;">วันที่</th>
                            <th style="width: 11%;">เลขที่ตรวจสอบ</th>
                            <th style="width: 11%;">เลขที่เปิดงาน</th>
                            <th style="width: 12%;">สินค้า</th>
                            <th style="width: 12%;">ลูกค้า</th>
                            <th style="width: 6%;">Rev.</th>
                            <th style="width: 10%;">Serial No</th>
                            <th style="width: 10%;">หมายเหตุ</th>
                            <th style="width: 8%;">ผู้อนุมัติ</th>
                            <th style="width: 5%;" class="text-center"><i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hd as $item)
                            <tr>
                                <td>
                                    <span class="font-weight-bold" style="color: #475569;">{{$item->finalInspection_status_name}}</span>
                                </td>
                                <td style="white-space: nowrap;"><i class="far fa-calendar-alt text-muted mr-1"></i> {{\Carbon\Carbon::parse($item->finalInspection_hd_date)->format('d/m/Y')}}</td>
                                <td style="font-weight: 600; color: #0F172A;">{{$item->finalInspection_hd_docuno}}</td>
                                <td style="color: #4F46E5; font-weight: 500;">{{$item->productionopenjob_hd_docuno}}</td>
                                <td>{{$item->ms_product_name}}</td>
                                <td>{{$item->ms_customer_name}}</td>
                                <td><span class="badge badge-light px-2 py-1">{{$item->ms_finalspec_hd_code}} {{$item->ms_finalspec_hd_rev}}</span></td>
                                <td><code style="color: #EC4899; font-size: 0.85rem;">{{$item->serialno}}</code></td>
                                <td style="color: #64748B; font-size: 0.85rem;">{{$item->finalInspection_hd_note ?? '-'}}</td>
                                <td><i class="far fa-user text-muted mr-1"></i> {{$item->approved_by ?? '-'}}</td>
                                <td class="text-center">
                                    @if($item->finalInspection_status_id == 4)
                                        <a href="{{route('fl-inst.edit',$item->finalInspection_hd_id)}}" class="btn-modern-edit" title="แก้ไขข้อมูล">
                                            <i class="fas fa-edit"></i>
                                        </a>                         
                                    @else
                                        <a href="javascript:void(0)" class="btn-modern-view" data-toggle="modal" data-target="#modal" onclick="getDataInst('{{ $item->finalInspection_hd_id }}')" title="เรียกดู">
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

<div class="modal fade modern-modal" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-selected="true">
                            <i class="fas fa-file-alt mr-1"></i> เอกสารตรวจสอบขั้นตอนสุดท้าย
                        </a>
                    </li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table modern-table mb-0">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-paperclip mr-1"></i> ไฟล์เอกสารแนบ</th>
                                    </tr>
                                </thead>
                                <tbody id="tb1_list">
                                    </tbody>
                            </table>
                        </div>
                    </div>
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
            [3, "asc"]
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
        pagingType: "full_numbers",
        bSort: true,
        
        // เปิดใช้งาน Filter และย้ายลงแถวด้านล่างแยกเป็นสัดส่วนชัดเจน
        initComplete: function() {
            this.api().columns().every(function(index) {
                var column = this;
                
                // ค้นหาตำแหน่งกล่อง <th> ในแถวกรองตาม index จริง
                var filterCell = $('#tb_job thead tr.filter-header th').eq(index);

                // หากเป็นคอลัมน์สุดท้าย (ช่องปุ่มแก้ไข/ดู) ให้เว้นว่างไว้ ไม่ต้องเจาะกล่องค้นหา
                if (index === 10) {
                    filterCell.html(''); 
                    return;
                }

                // สร้าง Select Filter รูปแบบคลีนมินิมอล
                var select = $('<select class="filter-select"><option value="">🔍 ทั้งหมด</option></select>')
                    .appendTo(filterCell.empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                // ดึงข้อมูลแถวเฉพาะที่ไม่ซ้ำมาบรรจุเป็น Option
                column.data().unique().sort().each(function(d, j) {
                    // กรองเศษ Tag HTML แปลกปลอมออกเพื่อให้เหลือเนื้อข้อความล้วนๆ
                    var cleanText = d.replace(/<[^>]*>/g, "").trim(); 
                    if(cleanText != "") {
                        select.append('<option value="' + cleanText + '">' + cleanText + '</option>');
                    }
                });
            });
        }
    });
});    

getDataInst = (id) => {
    $.ajax({
        url: "{{ url('/getData-Inst') }}",
        type: "post",
        dataType: "JSON",
        data: {
            refid: id,
            _token: "{{ csrf_token() }}"      
        },    
        success: function(data) {
            let el1_list = ''; 
            let el2_list = ''; 
            
            // Render ข้อมูลหน้าไฟล์แนบ
            $.each(data.dt3, function(key, item) {
                el1_list += `    
                    <tr>
                        <td>
                            <a href="${item.finalInspection_part_filename}" target="_blank" class="file-attachment-link">
                                <i class="far fa-file-pdf text-danger"></i> ${item.finalInspection_part_filename.split('/').pop()}
                            </a>
                        </td>                 
                    </tr>
                `;
            });      
            $('#tb1_list').html(el1_list);
            
            // Render ข้อมูลรายละเอียดชิ้นงานตรวจสอบ (ถ้ามีการเปิดใช้งานเพิ่มในหน้า UI ในอนาคต)
            $.each(data.dt2, function(key, item) {
                let qty = item.finalInspection_dt2_qty ?? '';
                let desc = item.finalInspection_dt2_description ?? '';
                el2_list += `    
                    <tr>
                        <td>${item.finalInspection_dt2_remark}</td>  
                        <td>${qty}</td>  
                        <td>${item.finalInspection_dt2_checked}</td>  
                        <td>${desc}</td>  
                    </tr>
                `;
            });      
            $('#tb2_list').html(el2_list);
        }
    });
}          
</script>
@endpush