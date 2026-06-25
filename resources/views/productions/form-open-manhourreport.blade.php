@extends('layouts.main')
@section('content')

<!-- Custom CSS Modern Indigo Theme with Top Filter Panel -->
<style>
    .modern-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 12px 40px rgba(99, 102, 241, 0.04);
        background: #ffffff;
        margin-top: 2rem;
    }
    .modern-card-title {
        color: #1E1B4B;
        font-weight: 700;
        font-size: 1.6rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    /* แผงตัวกรองด้านบนที่แยกออกมาใหม่ */
    .filter-panel {
        background: #F8FAFC;
        border: 1px solid #F1F5F9;
        border-radius: 14px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }
    .filter-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #4F46E5;
        margin-bottom: 6px;
    }
    .modern-select {
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 8px 12px;
        font-size: 0.9rem;
        color: #334155;
        background-color: #fff;
        width: 100%;
        transition: all 0.2s;
    }
    .modern-select:focus {
        border-color: #6366F1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        outline: none;
    }

    /* จัดระเบียบโซนปุ่ม Export และ Search */
    .table-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 1rem;
    }

    /* ตารางโมเดิร์นคลีน */
    .table-modern {
        width: 100% !important;
        white-space: nowrap; /* ป้องกันตัวอักษรตัดบรรทัดในช่องแคบ */
    }
    .table-modern thead th {
        background-color: #F8FAFC !important;
        color: #6366F1 !important;
        font-weight: 600 !important;
        font-size: 0.85rem;
        padding: 16px 14px !important;
        border-bottom: 2px solid #EEF2F6 !important;
    }
    .table-modern tbody td {
        padding: 14px 14px !important;
        vertical-align: middle !important;
        color: #334155;
        font-size: 0.9rem;
        border-bottom: 1px solid #F1F5F9 !important;
    }
    .table-modern tbody tr:hover {
        background-color: #F8F7FF !important;
    }

    /* สถานะ Badges */
    .badge-modern {
        padding: 6px 14px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-block;
    }
    .badge-modern-success { background-color: #ECFDF5; color: #059669; }
    .badge-modern-danger { background-color: #FEF2F2; color: #DC2626; }

    /* ปุ่มจัดการ Actions */
    .btn-modern-action {
        border-radius: 10px;
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.2s;
    }
    .btn-modern-warning { background-color: #FFFBEB; color: #D97706; }
    .btn-modern-warning:hover { background-color: #F59E0B; color: #fff; transform: translateY(-2px); }
    .btn-modern-indigo { background-color: #EFF6FF; color: #3B82F6; }
    .btn-modern-indigo:hover { background-color: #3B82F6; color: #fff; transform: translateY(-2px); }

    /* DataTables Elements Overrides */
    .dt-buttons .btn {
        background: #fff !important;
        color: #4F46E5 !important;
        border: 1px solid #E2E8F0 !important;
        border-radius: 10px !important;
        padding: 8px 16px !important;
        font-size: 0.85rem !important;
        font-weight: 500 !important;
        box-shadow: none !important;
    }
    .dt-buttons .btn:hover { background: #4F46E5 !important; color: #fff !important; }
    .dataTables_filter input {
        border: 1px solid #E2E8F0 !important;
        border-radius: 10px !important;
        padding: 7px 14px !important;
        outline: none;
    }
    .dataTables_filter input:focus { border-color: #6366F1 !important; }
    .text-muted-pct {
        color: #94A3B8; /* เทาอ่อนสไตล์มินิมอล */
        font-size: 0.75rem;
        font-weight: 500;
        display: block;
        margin-top: 2px;
    }
</style>

<div class="container-fluid">
    <div class="card modern-card">
        <div class="card-body p-4">
            
            <!-- Header -->
            <div class="modern-card-title">
                <i class="fas fa-chart-bar" style="color: #6366F1;"></i> Man Hour Report
            </div>
            <hr class="my-4" style="border-top: 1px solid #F1F5F9;">
            
            <!-- [NEW] Top Filter Panel: ดึงตัวกรองหลักขึ้นมาไว้ข้างบนเพื่อความสวยงามและไม่บั๊ก -->
            <div class="filter-panel">
                <div class="row align-items-center">
                    <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                        <div class="filter-label"><i class="fas fa-toggle-on mr-1"></i> กรองตามสถานะ</div>
                        <select id="filter_status" class="modern-select">
                            <option value="">ทั้งหมด</option>
                            <option value="สรุปเรียบร้อย">สรุปเรียบร้อย</option>
                            <option value="ยกเลิก">ยกเลิก</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                        <div class="filter-label"><i class="fas fa-calendar-alt mr-1"></i> กรองตามปี-เดือน</div>
                        <select id="filter_date" class="modern-select">
                            <option value="">ทั้งหมด</option>
                            <!-- ดึงค่าไดนามิกจากระบบอัตโนมัติผ่าน jQuery ด้านล่าง -->
                        </select>
                    </div>
                    <div class="col-md-6 text-md-right text-left">
                        <span class="text-muted small"><i class="fas fa-info-circle"></i> แยกตัวเลือกการกรองหลักมาไว้ด้านบนเพื่อการแสดงผลที่ถูกต้องและง่ายต่อการใช้งาน</span>
                    </div>
                </div>
            </div>

            <!-- Wrapper สำหรับควบคุมปุ่มและช่องค้นหาดั้งเดิม -->
            <div class="table-controls">
                <div id="btn_target"></div> <!-- เป้าหมายสำหรับย้ายปุ่ม Export มาวาง -->
                <div id="search_target"></div> <!-- เป้าหมายสำหรับย้ายช่อง Search มาวาง -->
            </div>
            
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-modern table-hover" id="tb_job">
                    <thead>
                        <tr>
                            <th>สถานะ</th>
                            <th>ปี-เดือน</th>
                            <th>Product</th>
                            <th>SI</th>
                            <th>SE</th>
                            <th>SF</th>
                            <th>DI</th>
                            <th>DD</th>
                            <th>DE</th>
                            <th>C</th>
                            <th>O</th>
                            <th>EN</th>
                            <th>ADMIN</th>
                            <th>Total</th>
                            <th class="text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
    @foreach ($hd as $item)
        @php
            // ดึงค่า Total ออกมาเป็นตัวแปรหลักเพื่อใช้เป็นฐานในการหาร
            $total = $item->manhour_report_total;
        @endphp
        <tr>
            <td data-search="{{ $item->manhour_report_flag == 1 ? 'สรุปเรียบร้อย' : 'ยกเลิก' }}">
                @if ($item->manhour_report_flag == 1)
                    <span class="badge-modern badge-modern-success">สรุปเรียบร้อย</span>
                @else
                    <span class="badge-modern badge-modern-danger">ยกเลิก</span>
                @endif
            </td> 
            <td><strong>{{$item->manhour_report_yearmonth}}</strong></td>        
            
            <td>
                <div>{{ number_format($item->manhour_report_product, 2) }}</div>
                <small class="text-muted-pct">{{ $total > 0 ? number_format(($item->manhour_report_product / $total) * 100, 1) . '%' : '0%' }}</small>
            </td>      
            
            <td>
                <div>{{ number_format($item->manhour_report_si, 2) }}</div>
                <small class="text-muted-pct">{{ $total > 0 ? number_format(($item->manhour_report_si / $total) * 100, 1) . '%' : '0%' }}</small>
            </td>     
            
            <td>
                <div>{{ number_format($item->manhour_report_se, 2) }}</div>
                <small class="text-muted-pct">{{ $total > 0 ? number_format(($item->manhour_report_se / $total) * 100, 1) . '%' : '0%' }}</small>
            </td>     
            
            <td>
                <div>{{ number_format($item->manhour_report_sf, 2) }}</div>
                <small class="text-muted-pct">{{ $total > 0 ? number_format(($item->manhour_report_sf / $total) * 100, 1) . '%' : '0%' }}</small>
            </td>    
            
            <td>
                <div>{{ number_format($item->manhour_report_dd, 2) }}</div>
                <small class="text-muted-pct">{{ $total > 0 ? number_format(($item->manhour_report_dd / $total) * 100, 1) . '%' : '0%' }}</small>
            </td>     
            
            <td>
                <div>{{ number_format($item->manhour_report_de, 2) }}</div>
                <small class="text-muted-pct">{{ $total > 0 ? number_format(($item->manhour_report_de / $total) * 100, 1) . '%' : '0%' }}</small>
            </td>  
            
            <td>
                <div>{{ number_format($item->manhour_report_di, 2) }}</div>
                <small class="text-muted-pct">{{ $total > 0 ? number_format(($item->manhour_report_di / $total) * 100, 1) . '%' : '0%' }}</small>
            </td>  
            
            <td>
                <div>{{ number_format($item->manhour_report_c, 2) }}</div>
                <small class="text-muted-pct">{{ $total > 0 ? number_format(($item->manhour_report_c / $total) * 100, 1) . '%' : '0%' }}</small>
            </td>  
            
            <td>
                <div>{{ number_format($item->manhour_report_o, 2) }}</div>
                <small class="text-muted-pct">{{ $total > 0 ? number_format(($item->manhour_report_o / $total) * 100, 1) . '%' : '0%' }}</small>
            </td>
            
            <td>
                <div>{{ number_format($item->manhour_report_en, 2) }}</div>
                <small class="text-muted-pct">{{ $total > 0 ? number_format(($item->manhour_report_en / $total) * 100, 1) . '%' : '0%' }}</small>
            </td>
            
            <td>
                <div>{{ number_format($item->manhour_report_admin, 2) }}</div>
                <small class="text-muted-pct">{{ $total > 0 ? number_format(($item->manhour_report_admin / $total) * 100, 1) . '%' : '0%' }}</small>
            </td>
            
            <td>
                <span style="font-weight: 700; color: #4F46E5;">{{ number_format($total, 2) }}</span>
                <br><small class="text-indigo" style="font-weight: 600; font-size: 0.75rem;">100%</small>
            </td>
            
            <td class="text-center">
                @if($item->reviewed_by == null || $item->acknowledges_by == null)
                    <a href="{{route('mn-report.edit',$item->manhour_report_id)}}" class="btn-modern-action btn-modern-warning" title="แก้ไขข้อมูล">
                        <i class="fas fa-edit"></i>
                    </a>
                @else
                    <a href="javascript:void(0)" class="btn-modern-action btn-modern-indigo" data-toggle="modal" data-target="#modal" onclick="getDataManHour('{{ $item->manhour_report_id }}')" title="ดูรายละเอียด">
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

<!-- Modal คงเดิมไว้ได้เลย -->
@endsection

@push('scriptjs')
<script>
$(document).ready(function() {
    var table = $('#tb_job').DataTable({
        "pageLength": 20,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', className: 'btn' },
            { extend: 'csv', className: 'btn' },
            { extend: 'excel', className: 'btn' },
            { extend: 'pdf', className: 'btn' },
            { extend: 'print', className: 'btn' }
        ],
        columnDefs: [{
            targets: 1,
            type: 'time-date-sort'
        }],
        order: [[1, "desc"]], // เรียงตาม ปี-เดือน ล่าสุดขึ้นก่อน
        fixedHeader: { header: false, footer: false },
        pagingType: "full_numbers",
        bSort: true,
        initComplete: function() {
            // ย้ายปุ่มและช่องค้นหาเดิมของ DataTables ไปวางในตำแหน่งกล่อง Layout ใหม่ที่เราคุมดีไซน์ไว้
            $('.dt-buttons').appendTo('#btn_target');
            $('.dataTables_filter').appendTo('#search_target');

            // ดึงข้อมูล ปี-เดือน ที่มีอยู่ทั้งหมดในตารางมาหยอดใส่ Dropdown ด้านบนแบบอัตโนมัติ (ไม่ซ้ำกัน)
            this.api().column(1).data().unique().sort().each(function(d, j) {
                // ล้างเศษ Tag หากมี
                var cleanDate = d.replace(/<\/?[^>]+(>|$)/g, "").trim();
                if(cleanDate) {
                    $('#filter_date').append('<option value="'+cleanDate+'">'+cleanDate+'</option>');
                }
            });
        }
    });

    // 🛠️ แก้ไขบั๊กฟิลเตอร์พัง: เปลี่ยนมาใช้ Partial Match ค้นหาเจอแน่นอน ไม่หลุดแม้มีตัวเลขหรือช่องว่าง
    $('#filter_status').on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        table.column(0).search(val ? val : '', true, false).draw();
    });

    $('#filter_date').on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        table.column(1).search(val ? val : '', true, false).draw();
    });
});

// ฟังก์ชัน AJAX (getDataManHour) ตัวเดิมคงไว้ได้เลยครับ...
</script>
@endpush