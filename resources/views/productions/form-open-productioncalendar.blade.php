@extends('layouts.main')
@section('content')
<link rel="stylesheet" href="{{ URL::asset('/assets/dist/css/filter_calendar.css') }}">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.42/css/bootstrap-datetimepicker.min.css'>
<div class="mt-4"><br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title" style="font-weight: bold">แผนผลิต</h3><br>
                    <hr>
                    <div class="row">
                        <form action="{{ url('/pd-calendar-filter') }}" id="frm-cd" method="POST">
                            @csrf
                            <div class="col-12">
                                <label for="calendar_view">Filter Eventy Status</label>
                                <div class="input-group">
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
                            </div>
                        </form>
                        <button class="btn btn-info" id="filter"><i class="fa fa-filter"></i> Filter</button>
                    </div>
                <div class="row">
                    <div id="wrapper">
                        <div id="loading"></div>
                        <div class="print-visible" id="calendar"></div>
                    </div>
                    <!-- ADD EVENT MODAL -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="newEventModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Create new <span class="eventType"></span></h4>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="col-xs-4" for="title">All Day Event ?</label>
                                            <input class='allDayNewEvent' type="checkbox"></label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="col-xs-4" for="title">Event title</label>
                                            <input class="inputModal" type="text" name="title" id="title" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="col-xs-4" for="starts-at">Starts at</label>
                                            <input class="inputModal" type="text" name="starts_at" id="starts-at" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="col-xs-4" for="ends-at">Ends at</label>
                                            <input class="inputModal" type="text" name="ends_at" id="ends-at" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="col-xs-4" for="calendar-type">Calendar</label>
                                            <select class="inputModal" type="text" name="calendar-type" id="calendar-type">
                                                <option value="Sales">Sales</option>
                                                <option value="Lettings">Lettings</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="col-xs-4" for="add-event-desc">Description</label>
                                            <textarea rows="4" cols="50" class="inputModal" name="add-event-desc" id="add-event-desc"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="save-event">Save changes</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <!-- EDIT EVENT MODAL -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="editEventModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Edit <span class="eventName"></span></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="col-xs-4" for="title">All Day Event ?</label>
                                            <input class='allDayEdit' type="checkbox"></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="col-xs-4" for="title">Event title</label>
                                            <input class="inputModal" type="text" name="editTitle" id="editTitle" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="col-xs-4" for="starts-at">Starts at</label>
                                            <input class="inputModal" type="text" name="editStartDate" id="editStartDate" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="col-xs-4" for="ends-at">Ends at</label>
                                            <input class="inputModal" type="text" name="editEndDate" id="editEndDate" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="col-xs-4" for="edit-calendar-type">Calendar</label>
                                            <select class="inputModal" type="text" name="edit-calendar-type" id="edit-calendar-type">
                                                <option value="Sales">Sales</option>
                                                <option value="Lettings">Lettings</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="col-xs-4" for="edit-event-desc">Description</label>
                                            <textarea rows="4" cols="50" class="inputModal" name="edit-event-desc" id="edit-event-desc"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger" id="deleteEvent">Delete Event</button>
                                    <button type="button" class="btn btn-primary" id="updateEvent">Save changes</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                    <!-- Scrollable modal -->
                    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">รายละเอียดเอกสาร</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="show_detail">
                                    </div>
                                    <div class="row" id="footer-popup">
                                    </div>
                                    <div class="modal-footer" id="btn-popup">
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCit4RJVPT9UiLQCJJPYEBkNTJCslqO4ps&libraries=places"></script>
<!-- partial -->
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
                    } else {
                        this.approved_by = this.approved_by;
                    }
                    list += `
                    <p>เลขที่เอกสาร : ${this.docuno} </p>
                    <p>สถานะ : ${this.status}</p>
                    <p>ประเภท : ${this.type}</p>
                    <p>วันที่ : ${this.date}</p>
                    <p>ผู้สร้าง : ${this.created_person}</p>
                    <p>ผู้อนุมัติ : ${this.approved_by}</p>
                    <hr style="border-top: 1px solid #EFF2F7;">
                    `;
                    $('#show_detail').html(list);
                    setTimeout(function() {
                        $('#exampleModalScrollable').modal('show');
                    }, 500);
                })
            }
        });
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
                let randomcolor = '';
                $.each(doc, function() {

                    //change format

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
                    randomcolor = Math.floor(Math.random() * 16777215).toString(16);
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
                        backgroundColor: '#'+ randomcolor,
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

        if (info.event.url) {
        }
        
    },


    locale: 'th',

    // calendar 7 day

    firstDay: 1,


    defaultView: 'month',




    },
    

    
    
    
    );


}, 1000);





}
</script>
@endpush