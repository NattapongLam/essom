@extends('layouts.main')
@section('content')
<link rel="stylesheet" href="{{ URL::asset('/assets/dist/css/filter_calendar.css') }}">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.42/css/bootstrap-datetimepicker.min.css'>

<style>
    /* --- โครงสร้างการจัดวางหลัก --- */
    .modern-card {
        border: none;
        border-radius: 24px;
        box-shadow: 0 10px 35px rgba(99, 102, 241, 0.05);
        background: #ffffff;
        margin-top: 1.5rem;
        padding: 2rem;
    }
    .modern-header-zone {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        border-bottom: 2px solid #F8FAFC;
        padding-bottom: 1.5rem;
        margin-bottom: 2rem;
    }
    .modern-card-title {
        color: #0F172A;
        font-weight: 700;
        font-size: 1.6rem;
        margin-bottom: 0;
    }
    
    /* --- ตัวกรองสไตล์โมเดิร์น --- */
    .filter-box-zone {
        display: flex;
        align-items: flex-end;
        gap: 12px;
        flex-wrap: wrap;
    }
    .modern-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #4F46E5;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .select2-container--default .select2-selection--multiple {
        background-color: #F8FAFC !important;
        border: 1px solid #E2E8F0 !important;
        border-radius: 12px !important;
        padding: 4px 8px !important;
        min-height: 44px !important;
        transition: all 0.2s;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #6366F1 !important;
        background-color: #ffffff !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    .btn-modern-filter {
        background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);
        color: #ffffff !important;
        font-weight: 600;
        font-size: 0.95rem;
        height: 44px;
        padding: 0 24px;
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.25);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .btn-modern-filter:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.35);
    }

    /* =========================================================================
       SUPER MODERN FULLCALENDAR OVERRIDE (ล้างหน้าตาเดิมให้ดูมินิมอล)
       ========================================================================= */
    #calendar {
        background: #ffffff;
        font-family: inherit;
    }
    /* ลบเส้นขอบตารางที่หนาเกินไป */
    .fc th, .fc td {
        border-color: #F1F5F9 !important;
    }
    /* แถบหัวปฏิทิน (ปุ่มควบคุมด้านบน) */
    .fc-toolbar {
        margin-bottom: 1.8rem !important;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .fc-toolbar h2 {
        font-size: 1.4rem !important;
        font-weight: 700 !important;
        color: #1E293B !important;
    }
    /* ปรับแต่งปุ่มกด เลื่อนซ้าย-ขวา / วันนี้ */
    .fc-button {
        background: #ffffff !important;
        border: 1px solid #E2E8F0 !important;
        color: #475569 !important;
        box-shadow: none !important;
        text-shadow: none !important;
        border-radius: 10px !important;
        height: 38px !important;
        padding: 0 14px !important;
        font-weight: 500 !important;
        transition: all 0.2s !important;
    }
    .fc-button:hover {
        background: #F8FAFC !important;
        color: #4F46E5 !important;
        border-color: #CBD5E1 !important;
    }
    .fc-state-active {
        background: #EEF2F6 !important;
        color: #4F46E5 !important;
        font-weight: 600 !important;
        border-color: #6366F1 !important;
    }
    /* หัวคอลัมน์ชื่อวัน (อา. - ส.) */
    .fc-day-header {
        background-color: #F8FAFC !important;
        color: #6366F1 !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        font-size: 0.85rem;
        padding: 12px 0 !important;
        border-bottom: 2px solid #E2E8F0 !important;
    }
    /* ปรับแต่งตัวเลขวันที่ในแต่ละช่อง */
    .fc-day-number {
        font-size: 0.9rem !important;
        font-weight: 600 !important;
        color: #64748B;
        padding: 8px 10px !important;
    }
    .fc-today .fc-day-number {
        color: #4F46E5 !important;
        background: #EEF2F6;
        border-radius: 50%;
        display: inline-block;
        min-width: 24px;
        text-align: center;
    }
    /* ไฮไลต์วันปัจจุบันให้สมูทขึ้น */
    .fc-today {
        background: rgba(99, 102, 241, 0.03) !important;
    }

    /* --- ดีไซน์ Event แถบสีบนปฏิทินใหม่หมด --- */
    .fc-event {
        border: none !important;
        border-radius: 6px !important;
        padding: 4px 8px !important;
        font-size: 0.8rem !important;
        font-weight: 500 !important;
        margin: 2px 4px !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
        transition: transform 0.15s ease, box-shadow 0.15s ease !important;
        cursor: pointer;
    }
    .fc-event:hover {
        transform: translateY(-1px) scale(1.01);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12) !important;
    }

    /* --- ตกแต่งดีไซน์หน้าต่าง Modal Pop-up --- */
    .modern-modal .modal-content {
        border: none;
        border-radius: 20px;
        box-shadow: 0 25px 60px rgba(15, 23, 42, 0.15);
        overflow: hidden;
    }
    .modern-modal .modal-header {
        background-color: #F8FAFC;
        border-bottom: 1px solid #E2E8F0;
        padding: 20px 24px;
    }
    .modern-modal .modal-title {
        color: #0F172A;
        font-weight: 700;
        font-size: 1.2rem;
    }
    .modern-modal .modal-body {
        padding: 24px;
    }
    .detail-item {
        margin-bottom: 14px;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        border-bottom: 1px dashed #E2E8F0;
        padding-bottom: 10px;
    }
    .detail-item:last-child {
        border-bottom: none;
    }
    .detail-label {
        font-weight: 600;
        color: #64748B;
        width: 130px;
        flex-shrink: 0;
    }
    .detail-value {
        color: #1E293B;
        font-weight: 500;
    }
</style>

<div class="container-fluid">
    <div class="card modern-card">
        <div class="card-body p-0">
            
            <div class="modern-header-zone">
                <div>
                    <h3 class="modern-card-title">
                        <i class="fas fa-calendar-alt" style="color: #6366F1; margin-right: 10px;"></i>แผนผลิต (Production Plan)
                    </h3>
                </div>
                
                <div class="filter-box-zone">
                    <form action="{{ url('/pd-calendar-filter') }}" id="frm-cd" method="POST" style="min-width: 300px;">
                        @csrf
                        <div class="form-group mb-0">
                            <div class="modern-label">Filter Event Status</div>
                            <select class="filter form-control" id="type_filter" name="filter[]" multiple="multiple">
                                @if($status_filter == null || $status_filter == '')
                                    @foreach ($status as $key => $item)
                                        <option value="{{ $item->productionopenjob_status_id }}">{{ $item->productionopenjob_status_name }}</option>
                                    @endforeach
                                @else
                                    @foreach ($status as $key => $item)
                                        @if(in_array($item->productionopenjob_status_id, $status_filter))
                                            <option value="{{ $item->productionopenjob_status_id }}" selected>{{ $item->productionopenjob_status_name }}</option>
                                        @else
                                            <option value="{{ $item->productionopenjob_status_id }}">{{ $item->productionopenjob_status_name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </form>
                    <button class="btn btn-modern-filter" id="filter">
                        <i class="fa fa-filter"></i> Filter
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div id="wrapper">
                        <div id="loading"></div>
                        <div class="print-visible" id="calendar"></div>
                    </div>
                </div>
            </div>

            <div class="modal fade modern-modal" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                <i class="fas fa-file-alt text-indigo mr-2" style="color: #6366F1;"></i> รายละเอียดเอกสารแผนผลิต
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="show_detail"></div>
                            <div class="row" id="footer-popup"></div>
                            <div class="modal-footer p-0 pt-3 text-right" id="btn-popup" style="border-top: 1px solid #F1F5F9;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display:none;">
                <div class="modal fade" id="newEventModal"></div>
                <div class="modal fade" id="editEventModal"></div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scriptjs')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCit4RJVPT9UiLQCJJPYEBkNTJCslqO4ps&libraries=places"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale-all.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js'></script>
<script>
    var newEvent;
    var editEvent;
    var dataset = [];
    
    $(document).ready(function() {
        setTimeout(function() {
            filterData();
        }, 500);
    });

    $('#filter').click(function() {
        $('#frm-cd').submit();
    });

    modalData = (docs) => {
        $.ajax({
            url: "{{ url('/pd-popup-calendar') }}",
            dataType: 'json',
            type: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                docs: docs
            },
            success: function(doc) {
                let list = '';
                $.each(doc, function() {
                    if (this.approved_by == null) {
                        this.approved_by = '-';
                    }
                    
                    list += `
                    <div class="detail-item"><div class="detail-label">เลขที่เอกสาร</div><div class="detail-value" style="color: #4F46E5; font-weight: 700;">${this.docuno}</div></div>
                    <div class="detail-item"><div class="detail-label">สถานะ</div><div class="detail-value"><span class="badge" style="background-color: #EEF2F6; color: #4F46E5; padding: 6px 12px; border-radius: 6px; font-weight:600;">${this.status}</span></div></div>
                    <div class="detail-item"><div class="detail-label">ประเภท</div><div class="detail-value">${this.type}</div></div>
                    <div class="detail-item"><div class="detail-label">วันที่</div><div class="detail-value" style="font-weight: 500; color:#475569;">${this.date}</div></div>
                    <div class="detail-item"><div class="detail-label">ผู้สร้าง</div><div class="detail-value">${this.created_person}</div></div>
                    <div class="detail-item"><div class="detail-label">ผู้อนุมัติ</div><div class="detail-value">${this.approved_by}</div></div>
                    `;
                    
                    $('#show_detail').html(list);
                    setTimeout(function() {
                        $('#exampleModalScrollable').modal('show');
                    }, 500);
                })
            }
        });
    }

    /* 💡 ทริคเพิ่มเติม: เปลี่ยนวิธีการเลือกเฉดสีของป้ายแถบงานสไตล์พาสเทลเพื่อความนวลตา */
    getSoftColor = () => {
        // รายการสีมินิมอลสไตล์ Material/Soft Indigo-Violet-Teal-Blue
        const modernPalettes = ['#5C6BC0', '#7E57C2', '#26A69A', '#29B6F6', '#AB47BC', '#EC407A', '#66BB6A', '#FFA726'];
        return modernPalettes[Math.floor(Math.random() * modernPalettes.length)];
    }

    filterData = () => {
        let events = [];
        let type_filter = $('#type_filter').val();
        $.ajax({
            url: "{{ url('/pd-calendar/getDataProductioncalendar') }}",
            dataType: 'json',
            type: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                type_filter: type_filter
            },
            success: function(doc) {
                $.each(doc, function() {
                    var start = new Date(this.productionopenjob_hd_startdate);
                    var start_format = start.toString("yyyy-MM-dd");

                    if (this.station_date == null) {
                        this.station_date = this.productionopenjob_hd_startdate;
                        var end = new Date(this.productionopenjob_hd_enddate);
                        var end_format = end.toString("yyyy-MM-dd");
                    } else {
                        var end = new Date(this.productionopenjob_hd_enddate);
                        var end_format = end.toString("yyyy-MM-dd");
                    }
                    
                    events.push({
                        title: this.ms_customer_name + ' เลขที่เปิดงาน : '+ this.productionopenjob_hd_docuno + ' ( ' + this.ms_product_code + ' )',
                        avatar: "{{ asset('assets/images/icon/search.png')}}",
                        description: this.productionopenjob_hd_docuno,
                        start: start_format,
                        end: end_format,
                        type: this.productionopenjob_hd_docuno,
                        calendar: this.ms_product_code,
                        className: 'bg',
                        username: this.created_person,
                        backgroundColor: getSoftColor(), // เปลี่ยนมาใช้ฟังก์ชันสีนุ่มนวลพาสเทลแทนการสุ่มมั่ว
                        textColor: "#ffffff",
                        allDay: true
                    });
                })
            }
        });

        setTimeout(function() {
            var calendar = $('#calendar').fullCalendar({
                events: events,
                eventClick: function(info) {
                    modalData(info.type);
                },
                locale: 'th',
                firstDay: 1,
                defaultView: 'month'
            });
        }, 1000);
    }
</script>
@endpush