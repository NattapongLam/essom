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
            <h3 class="card-title" style="font-weight: bold">แผนผลิต</h3><br><hr>
            <div class="row">
                {{-- <div id="openviewWeather">
                    <a class="weatherwidget-io" href="https://forecast7.com/en/15d87100d99/thailand/" data-label_1="Thailand" data-label_2="Weather" data-font="Roboto" data-icons="Climacons Animated" data-theme="original" data-accent="rgba(1, 1, 1, 0.0)"></a>
                </div>              
                <script>
                    ! function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = 'https://weatherwidget.io/js/widget.min.js';
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, 'script', 'weatherwidget-io-js');
                </script>               
                <div id="contextMenu" class="dropdown clearfix">              
                </div>            --}}
                    <div class="row">
                        <div class="col-4">               
                            <label for="calendar_view">Filter Eventy Status</label>
                            <div class="input-group">
                                <select class="filter form-control" id="type_filter" multiple="multiple">                                
                                </select>
                            </div>
                        </div>               
                        <div class="col-4">               
                            <label for="calendar_view">Filter Process</label>
                            <div class="input-group">
                                <select class="filter form-control" id="calendar_filter" multiple="multiple">                               
                                </select>
                            </div>
                        </div>                
                        <div class="col-4">
                
                            <label for="calendar_view">Filter all</label>
                            <div class="input-group">
                                <label class="checkbox-inline"><input class='filter' type="checkbox" value="all" checked disabled>All</label>                           
                            </div>
                        </div>               
                    </div>
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
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">รายละเอียดเอกสาร</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
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
        var calendar = $('#calendar').fullCalendar({
            eventRender: function(event, element, view) {
                var startTimeEventInfo = moment(event.start).format('HH:mm');
                var endTimeEventInfo = moment(event.end).format('HH:mm');
                var displayEventDate;
                var randomcolor = '';
                if (event.avatar.length > 1) {
                    element.find(".fc-content").css('padding-left', '55px');
                    element.find(".fc-content").after($("<div class=\"fc-avatar-image\"></div>").html('<img src=\'' + event.avatar + '\' />'));
                }
                if (event.allDay == false) {
                    displayEventDate = startTimeEventInfo + " - " + endTimeEventInfo;
                } else {
                    displayEventDate = "All Day";
                }
                element.popover({
                    title: '<div class="popoverTitleCalendar" style="background-color:' + event.backgroundColor + '; color:' + event.textColor + '">' + event.title + '</div>',
                    content: '<div class="popoverInfoCalendar">' +
                        '<p><strong>Calendar:</strong> ' + event.calendar + '</p>' +
                        '<p><strong>Username:</strong> ' + event.username + '</p>' +
                        '<p><strong>Event Type:</strong> ' + event.type + '</p>' +
                        '<p><strong>Event Time:</strong> ' + displayEventDate + '</p>' +
                        '<div class="popoverDescCalendar"><strong>Description:</strong> ' + event.description + '</div>' +
                        '</div>',
                    delay: {
                        show: "800",
                        hide: "50"
                    },
                    trigger: 'hover',
                    placement: 'top',
                    html: true,
                    container: 'body'
                });
                randomcolor = '#1F567C';
                if (event.username) {
                    element.css('background-color', randomcolor);
                }
                var show_username, show_type = true,
                    show_calendar = true;
                var username = $('input:checkbox.filter:checked').map(function() {
                    return $(this).val();
                }).get();

                var types = $('#type_filter').val();

                var calendars = $('#calendar_filter').val();

                show_username =  true;


                show_type = true;


                if (types && types.length > 0) {
                    if (types[0] == "all") {
                        show_type = true;
                    } else {
                        show_type = types.indexOf(event.type) >= 0;

                    }
                }

                if (calendars && calendars.length > 0) {
                    if (calendars[0] == "all") {
                        show_calendar = true;
                    } else {
                        show_calendar = calendars.indexOf(event.calendar) >= 0;
                    }
                }

                return show_username && show_type && show_calendar;

            },

            header: {
                left: 'today, prevYear, nextYear',
                center: 'prev, title, next',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            views: {
                month: {
                    columnFormat: 'dddd'
                },
                agendaWeek: {
                    columnFormat: 'ddd D/M',
                    eventLimit: false
                },
                agendaDay: {
                    columnFormat: 'dddd',
                    eventLimit: false
                },
                listWeek: {
                    columnFormat: ''
                },
                settimana: {
            type: 'agendaWeek',
            duration: {
                days: 7
            },
            title: 'Apertura',
            columnFormat: 'dddd', // Format the day to only show like 'Monday'
            hiddenDays: [0, 7] // Hide Sunday and Saturday?
        }
            },

            loading: function(bool) {
                //alert('events are being rendered');
            },
            eventAfterAllRender: function(view) {
                if (view.name == "month") {
                    $(".fc-content").css('height', 'auto');
                }
            },
            eventLimitClick: function(cellInfo, event) {


            },
            eventResize: function(event, delta, revertFunc, jsEvent, ui, view) {
                $('.popover.fade.top').remove();
            },
            eventDragStart: function(event, jsEvent, ui, view) {
                var draggedEventIsAllDay;
                draggedEventIsAllDay = event.allDay;
            },
            eventDrop: function(event, delta, revertFunc, jsEvent, ui, view) {
                $('.popover.fade.top').remove();
            },
            unselect: function(jsEvent, view) {
                //$(".dropNewEvent").hide();
            },
            dayClick: function(startDate, jsEvent, view) {

                //var today = moment();
                //var startDate;

                //if(view.name == "month"){

                //  startDate.set({ hours: today.hours(), minute: today.minutes() });
                //  alert('Clicked on: ' + startDate.format());

                //}

            },
            select: function(startDate, endDate, jsEvent, view) {

                var today = moment();
                var startDate;
                var endDate;

                if (view.name == "month") {
                    startDate.set({
                        hours: today.hours(),
                        minute: today.minutes()
                    });
                    startDate = moment(startDate).format('ddd DD MMM YYYY HH:mm');
                    endDate = moment(endDate).subtract('days', 1);
                    endDate.set({
                        hours: today.hours() + 1,
                        minute: today.minutes()
                    });
                    endDate = moment(endDate).format('ddd DD MMM YYYY HH:mm');
                } else {
                    startDate = moment(startDate).format('ddd DD MMM YYYY HH:mm');
                    endDate = moment(endDate).format('ddd DD MMM YYYY HH:mm');
                }

                var $contextMenu = $("#contextMenu");

                var HTMLContent = '';

                $(".fc-body").unbind('click');
                $(".fc-body").on('click', 'td', function(e) {

                    document.getElementById('contextMenu').innerHTML = (HTMLContent);

                    $contextMenu.addClass("contextOpened");
                    $contextMenu.css({
                        display: "block",
                        left: e.pageX,
                        top: e.pageY
                    });
                    return false;

                });

                $contextMenu.on("click", "a", function(e) {
                    e.preventDefault();
                    $contextMenu.removeClass("contextOpened");
                    $contextMenu.hide();
                });

                $('body').on('click', function() {
                    $contextMenu.hide();
                    $contextMenu.removeClass("contextOpened");
                });

                //newEvent(startDate, endDate);

            },
            eventClick: function(event, jsEvent, view) {

                editEvent(event);



            },
            locale: 'th_GB',
            timezone: "local",
            nextDayThreshold: "09:00:00",
            allDaySlot: true,
            displayEventTime: true,
            displayEventEnd: true,
            firstDay: 1,
            weekNumbers: false,
            selectable: true,
            weekNumberCalculation: "ISO",
            eventLimit: true,
            eventLimitClick: 'week', //popover
            navLinks: true,
            defaultDate: moment().format('YYYY-MM-DD'),
            timeFormat: 'HH:mm',
            defaultTimedEventDuration: '01:00:00',
            editable: true,
            minTime: '07:00:00',
            maxTime: '18:00:00',
            slotLabelFormat: 'HH:mm',
            weekends: true,
            nowIndicator: true,
            dayPopoverFormat: 'dddd DD/MM',
            longPressDelay: 0,
            eventLongPressDelay: 0,
            selectLongPressDelay: 0,


            // get data json
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: "{{ url('/pd-calendar/getDataProductioncalendar') }}",
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    success: function(doc) {

                        console.log(doc);

                        var events = [];

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

                            events.push({
                                title: this.ms_customer_fullname,
                                avatar: "{{ asset('assets/images/icon/search.png')}}",
                                description: this.productionopenjob_hd_docuno,
                                start: start_format,
                                end: start_format,
                                type: this.ms_customer_name,
                                calendar: this.ms_product_code,
                                className: 'bg',
                                username: this.created_person,
                                backgroundColor: "#9816f4",
                                textColor: "#ffffff",
                                allDay: true
                            });
                        })

                        callback(events);


                    }
                });
            },



        });









        $('.filter').on('change', function() {
            $('#calendar').fullCalendar('rerenderEvents');
        });

        $("#type_filter").select2({
            placeholder: "Filter Types",
            allowClear: true
        });

        $("#calendar_filter").select2({
            placeholder: "Filter Calendars",
            allowClear: true
        });

        $("#starts-at, #ends-at").datetimepicker({
            format: 'ddd DD MMM YYYY HH:mm'
        });

        //var minDate = moment().subtract(0, 'days').millisecond(0).second(0).minute(0).hour(0);

        $(" #editStartDate, #editEndDate").datetimepicker({
            format: 'ddd DD MMM YYYY HH:mm'
            //minDate: minDate
        });

        //CREATE NEW EVENT CALENDAR

        newEvent = function(start, end, eventType) {


        }

        //EDIT EVENT CALENDAR

        editEvent = function(event, element, view) {

            console.log(event.description);

            var docs = '';
            $.ajax({
                url: "{{ url('/qc-calendar/getDataProductionQcPopup') }}",
                dataType: 'json',
                type: 'POST',
                data: {
                    refno: event.description,
                    _token: '{{csrf_token()}}'
                },
                success: function(doc) {

                    $('#exampleModalScrollable').modal('show');

                    let list = '';
                    let count_so = [];
                    let count_sku = [];
                    let total_qty = [];

                    $.each(doc.due, function(key , item) {

                        docs = item.pdt_planning_docuno;

                        if(item.ms_customersub_name == null){
                            item.ms_customersub_name = '-';
                        }else{
                            item.ms_customersub_name = item.ms_customersub_name;
                        }

                        if(item.sal_quotation_hd_netamount == null){
                            item.sal_quotation_hd_netamount = '-';
                        }else{
                            item.sal_quotation_hd_netamount = item.sal_quotation_hd_netamount;
                        }

                        let sku = '';
                        let footer = '';
            
           

                        count_so.push(item.sal_quotation_hd_docuno);


                        $.each(doc.dt , function() {

                            count_sku.push(this.ms_product_code);
                            total_qty.push(this.ms_product_qty);


                            if(item.sal_quotation_hd_docuno == this.sal_salecommand_hd_docuno){

                                sku += `
                                <tr>
                                <td>${this.ms_product_code}<br>${this.ms_product_name}</td>
                                <td>${this.ms_product_qty}</td>
                                <td>${this.pdt_planning_status_name}</td>
                                </tr>
                                `;

                            }



                        })



                        list += `
                        <p>เลขที่โปรเจค : ${item.sal_project_hd_docuno} <a href="#" onclick="likFollow('${item.sal_project_hd_docuno}')"><i class="fa fa-link"></i></a></p>
                        <p>ชื่อลูกค้า : ${item.ms_customer_name1}</p>
                        <p>ผู้ติดต่อ : ${item.ms_customersub_name}</p>
                        <p>เอกสารที่เกี่ยวข้อง : ${item.sal_quotation_hd_docuno}</p>
                        <p>มูลค่าโปรเจค : ${item.sal_quotation_hd_netamount}</p>
                        <p>สถานะ : ${item.sal_quotation_status_name}</p>
                        <div class="row">
                        <div class="col-12">
                        <table class="table table-bordered">
                        <thead>
                        <tr style="background-color: #EFF2F7;">
                        <th>สินค้า</th>
                        <th>จำนวน</th>
                        <th>สถานะ</th>
                        </tr>
                        </thead>
                        <tbody>
                        ${sku}
                        </tbody>
                        </table>
                        </div>
                        </div>


                        <hr style="border-top: 1px solid #EFF2F7;">
                        `;

                        sku = '';

                    })

                    $ans_so = count_so.length;
                    $ans_sku = count_sku.length;
                    total_qty = total_qty.map(Number);
                    $ans_qty = total_qty.reduce((a, b) => a + b, 0);


-

                    $('#show_detail').html(list);
                    $('#btn-popup').html(`
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>`)

                    $('#footer-popup').html(`
                    <div class="col-4 text-center" style="background-color: #EFF2F7;">
                    SO รวม : ${$ans_so}
                    </div>
                    <div class="col-4 text-center" style="background-color: #EFF2F7;">
                    SKU รวม : ${$ans_sku}
                    </div>
                    <div class="col-4 text-center" style="background-color: #EFF2F7;">
                    จำนวนชิ้นรวม : ${$ans_qty}
                    </div>
                    `);


            









                }



            })

                 
          

 

        }


        //SET DEFAULT VIEW CALENDAR

        var defaultCalendarView = $("#calendar_view").val();

        if (defaultCalendarView == 'month') {
            $('#calendar').fullCalendar('changeView', 'month');
        } else if (defaultCalendarView == 'agendaWeek') {
            $('#calendar').fullCalendar('changeView', 'agendaWeek');
        } else if (defaultCalendarView == 'agendaDay') {
            $('#calendar').fullCalendar('changeView', 'agendaDay');
        } else if (defaultCalendarView == 'listWeek') {
            $('#calendar').fullCalendar('changeView', 'listWeek');
        }

        $('#calendar_view').on('change', function() {

            var defaultCalendarView = $("#calendar_view").val();
            $('#calendar').fullCalendar('changeView', defaultCalendarView);

        });

        //SET MIN TIME AGENDA

        $('#calendar_start_time').on('change', function() {

            var minTimeAgendaView = $(this).val();
            $('#calendar').fullCalendar('option', {
                minTime: minTimeAgendaView
            });

        });

        //SET MAX TIME AGENDA

        $('#calendar_end_time').on('change', function() {

            var maxTimeAgendaView = $(this).val();
            $('#calendar').fullCalendar('option', {
                maxTime: maxTimeAgendaView
            });

        });

        //SHOW - HIDE WEEKENDS

        var activeInactiveWeekends = false;
        checkCalendarWeekends();

        $('.showHideWeekend').on('change', function() {
            checkCalendarWeekends();
        });

        function checkCalendarWeekends() {

            // if ($('.showHideWeekend').is(':checked')) {
            //     activeInactiveWeekends = true;
            //     $('#calendar').fullCalendar('option', {
            //         weekends: activeInactiveWeekends
            //     });
            // } else {
            //     activeInactiveWeekends = false;
            //     $('#calendar').fullCalendar('option', {
            //         weekends: activeInactiveWeekends
            //     });
            // }

        }

        //CREATE NEW CALENDAR AND APPEND

        $('#addCustomCalendar').on('click', function() {

            var newCalendarName = $("#inputCustomCalendar").val();
            $('#calendar_filter, #calendar-type, #edit-calendar-type').append($('<option>', {
                value: newCalendarName,
                text: newCalendarName
            }));
            $("#inputCustomCalendar").val("");

        });

        //WEATHER GRAMATICALLY

        function retira_acentos(str) {
            var com_acento = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝRÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿr";
            var sem_acento = "AAAAAAACEEEEIIIIDNOOOOOOUUUUYRsBaaaaaaaceeeeiiiionoooooouuuuybyr";
            var novastr = "";
            for (i = 0; i < str.length; i++) {
                troca = false;
                for (a = 0; a < com_acento.length; a++) {
                    if (str.substr(i, 1) == com_acento.substr(a, 1)) {
                        novastr += sem_acento.substr(a, 1);
                        troca = true;
                        break;
                    }
                }
                if (troca == false) {
                    novastr += str.substr(i, 1);
                }
            }
            return novastr.toLowerCase().replace(/\s/g, '-');
        }

        //WEATHER THEMES

        document.getElementById('switchWeatherTheme').addEventListener('change', function() {

            var valueTheme = $(this).val();
            var widget = document.querySelector('.weatherwidget-io');
            widget.setAttribute('data-theme', valueTheme);
            __weatherwidget_init();

        });

        //WEATHER LOCATION
        var input = document.getElementById('searchTextField');
        var autocomplete = new google.maps.places.Autocomplete(input);

        // console.log(autocomplete);

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
            var newPlace = retira_acentos(place.name);


            var urlDataWeather = 'https://forecast7.com/en/' + latitude.toFixed(2).replace(/\./g, 'd').replace(/\-/g, 'n') + longitude.toFixed(2).replace(/\./g, 'd').replace(/\-/g, 'n') + '/' + newPlace + '/';

            alert(urlDataWeather);

            var weatherWidget = document.querySelector('.weatherwidget-io');
            weatherWidget.href = urlDataWeather;
            weatherWidget.dataset.label_1 = place.name;
            __weatherwidget_init();

            //document.getElementById('city2').value = place.name;
            //document.getElementById('cityLat').value = place.geometry.location.lat();
            //document.getElementById('cityLng').value = place.geometry.location.lng();
            //alert("This function is working!");
            //alert(place.name);
            // alert(place.address_components[0].long_name);

        });

    });


    addNote = (docs) => {

     

        $.ajax({
                url: "{{ url('/popUpCalendaraddNote') }}",
                dataType: 'json',
                type: 'POST',
                data: {
                    refno: docs,
                    note : $('#note-textarea').val(),
                    _token: '{{csrf_token()}}'
                },
                success: function(doc) {

                    if(doc.status == 'success'){
                        $.ajax({
                        url: "{{ url('/getNoteCalendar') }}",
                        type: "POST",
                        data: {            
                            refpro : docs, 
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: "json",
                        success: function(data) {

                            let notelist = ''

                            $.each(data.note , function(){
                                notelist += `
                                <div style="background-color: #EFF2F7; padding: 10px; margin-bottom: 10px; border-radius: 5px; ">
                                <p>${this.personsave} [${this.update_at}]</p>
                                <p>${this.cust_note_remark}</p>
                                <hr style="border-top: 1px solid #EFF2F7;"></p>
                                </div>
                                `;
                            })
                            $('#note-textarea').val('')
                            $('#show_note').html(notelist);

                        }

                    });
                    }else{
                        Swal.fire(
                            'เพิ่มโน๊ตไม่สำเร็จ!',
                            '',
                            'error'
                        )
                    }





                }
            })

        
    }

    
    likFollow = (id) => {
$.ajax({
    url: "{{ url('/popUpCalendarPlanning') }}",
    type: 'POST',
    data: {
        refno: id,
        _token: '{{csrf_token()}}'
    },
    success: function(doc) {


        window.open(doc.route_link, "_blank");

       


    }

})


}
</script>
@endpush   