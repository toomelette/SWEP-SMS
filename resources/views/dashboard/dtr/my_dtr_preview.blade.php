@extends('layouts.modal-content')

@section('modal-header')
{{\Carbon\Carbon::parse($month)->format('F, Y')}} - {{strtoupper($employee->lastname)}}, {{strtoupper($employee->firstname)}}
@endsection

@section('modal-body')
  <style>
      .fc-basic-view .fc-body .fc-row{min-height:8em !important;}
  </style>
    @php($days_in_this_month = \Carbon\Carbon::parse($month)->daysInMonth)
{{--    {{print_r($dtr_array)}}--}}
    <form method="POST" id="download_form" action="{{route('dashboard.dtr.download')}}">
        @csrf
        <input value="" id="sup_name" name="sup_name" hidden>
        <input value="{{$bm_u_id}}" id="" name="bm_u_id" hidden>
        <input value="{{$month}}" name="month" hidden>
    </form>

    <button type="submit" class="btn btn-primary pull-right download_btn" style="margin-bottom: 1rem"><i class="fa fa-download"></i> Download PDF </button>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-clock-o"></i> DAILY TIME RECORD</a></li>
            <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-calendar-check-o"></i> ATTENDANCE LOGS</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Date</th>
                            <th colspan="2" class="text-center">Morning</th>
                            <th colspan="2" class="text-center">Afternoon</th>
                            <th colspan="2" class="text-center">Overtime</th>
                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Late</th>
                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Undertime</th>
                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Remarks</th>
                        </tr>
                        <tr>
                            <th class="text-center" style="min-width: 40px">IN</th>
                            <th class="text-center" style="min-width: 40px">OUT</th>
                            <th class="text-center" style="min-width: 40px">IN</th>
                            <th class="text-center" style="min-width: 40px">OUT</th>
                            <th class="text-center" style="min-width: 40px">IN</th>
                            <th class="text-center" style="min-width: 40px">OUT</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($late = 0)
                        @php($undertime = 0)
                        @php($saturdays= 0)
                        @php($sundays = 0)
                        @for($a = 1 ; $a <= $days_in_this_month; $a++)

                            @php($date = sprintf('%02d', $a))
                            @if($month.'-'.$date == \Carbon\Carbon::now()->format('Y-m-d'))
                                @php($mark = 'info')
                            @else
                                @php($mark ='')
                            @endif
                            @if(isset($dtr_array[$month.'-'.$date]))
                                @php($late =  $late + $dtr_array[$month.'-'.$date]->late)
                                @php($undertime = $undertime + $dtr_array[$month.'-'.$date]->undertime)
                                @if($dtr_array[$month.'-'.$date]->calculated == -1)
                                    @php($italic_op = '<i style="color:#e6a800">')
                                    @php($italic_cl = '</i>')
                                @else
                                    @php($italic_op = '')
                                    @php($italic_cl = '')
                                @endif

                                <tr class="text-center {{$mark}}">
                                    <td>
                                        {{$date}}
                                    </td>
                                    <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->am_in) !!}</td>
                                    <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->am_out) !!}</td>
                                    <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->pm_in) !!}</td>
                                    <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->pm_out) !!}</td>
                                    <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->ot_in) !!}</td>
                                    <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->ot_out) !!}</td>
                                    <td>
                                        @if($dtr_array[$month.'-'.$date]->date != \Carbon\Carbon::now()->format('Y-m-d'))
                                            {!! $italic_op !!}
                                            {{$dtr_array[$month.'-'.$date]->late == 0 ? '' : \App\Swep\Helpers\Helper::convertToHoursMins($dtr_array[$month.'-'.$date]->late)}}
                                            {!! $italic_cl !!}
                                        @endif

                                    </td>
                                    <td>
                                        @if($dtr_array[$month.'-'.$date]->date != \Carbon\Carbon::now()->format('Y-m-d'))
                                            {!! $italic_op !!}
                                            {{$dtr_array[$month.'-'.$date]->undertime == 0 ? '' : \App\Swep\Helpers\Helper::convertToHoursMins($dtr_array[$month.'-'.$date]->undertime)}}
                                            {!! $italic_cl !!}
                                        @endif
                                    </td>
                                    <td class="text-left">
                                        @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6)
                                            @php($saturdays++)
                                            SATURDAY
                                        @endif
                                        @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                            @php($sundays++)
                                            SUNDAY
                                        @endif
                                        @if(isset($holidays[$month.'-'.$date]))
                                            <b>{{$holidays[$month.'-'.$date]['type']}}</b>
                                        @endif
                                        @if($dtr_array[$month.'-'.$date]->calculated == -1)
                                            <span class="text-danger">INC</span>
                                        @endif
                                    </td>
                                </tr>
                            @else
                                @if(isset($holidays[$month.'-'.$date]))
                                    <tr class="text-center {{$mark}}">
                                        <td>
                                            {{$date}}
                                        </td>
                                        <td colspan="9"><b>{{$holidays[$month.'-'.$date]['type']}} </b> (<i>{{$holidays[$month.'-'.$date]['name']}}</i>)</td>
                                    </tr>
                                @else
                                    <tr class="text-center {{$mark}}">
                                        <td>
                                            {{$date}}
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-left">
                                            @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6)
                                                @php($saturdays++)
                                                SAT
                                            @endif
                                            @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                                @php($sundays++)
                                                SUN
                                            @endif

                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endfor
                        </tbody>
                    </table>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <dl class="dl-horizontal">
                            <dt>Total Late:</dt>
                            <dd>{{\App\Swep\Helpers\Helper::convertToHoursMins($late)}}</dd>
                            <dt>Total Undertime:</dt>
                            <dd>{{\App\Swep\Helpers\Helper::convertToHoursMins($undertime)}}</dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <dl class="dl-horizontal">
                            <dt>Total Saturdays:</dt>
                            <dd>{{number_format($saturdays)}}</dd>
                            <dt>Total Sundays:</dt>
                            <dd>{{number_format($sundays)}}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                <div class="box-body no-padding">
                    <!-- THE CALENDAR -->
                    <div id="calendar">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modal-footer')
    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
@endsection

@section('scripts')
<script>
    $(function () {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function init_events(ele) {
            ele.each(function () {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex        : 1070,
                    revert        : true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                })

            })
        }

        init_events($('#external-events div.external-event'))

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()
        $('#calendar').fullCalendar({
            // header    : {
            //     left  : 'prev,next today',
            //     center: 'title',
            //     right : 'month,agendaWeek,agendaDay'
            // },
            // buttonText: {
            //     today: 'today',
            //     month: 'month',
            //     week : 'week',
            //     day  : 'day'
            // },
            //Random default events
            events    : [
                    @if(!empty($attendance_logs))
                        @foreach($attendance_logs as $attendance_log)
                            {
                                title          : "{{$biometric_values[$attendance_log->type]}}",
                                start          : new Date("{{Carbon::parse($attendance_log->timestamp)->format('Y-m-d').'T'.Carbon::parse($attendance_log->timestamp)->format('H:i:s')}}"),
                                backgroundColor: "{{\App\Swep\Helpers\Helper::biometricValuesColor($attendance_log->type)}}", //red
                                borderColor    : "{{\App\Swep\Helpers\Helper::biometricValuesColor($attendance_log->type)}}",
                                    url: "Biometric device: {{$attendance_log->deviceDetails->name}}",
                            },
                        @endforeach
                    @endif
                    @if(count($holidays)>0)
                        @foreach($holidays as$key => $holiday)
                        {
                            title          : "{{$holiday['name']}}",
                            start          : new Date("{{Carbon::parse($holiday['date'])->format('Y-m-d')}}T00:00:00"),
                            backgroundColor: "#dd4b39", //red
                            borderColor    : "#dd4b39",
                            url            : "{{$holiday['type']}}",
                        },
                        @endforeach
                    @endif
            ],
            editable  : false,
            droppable : false, // this allows things to be dropped onto the calendar !!!
            drop      : function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject')

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject)

                // assign it the date that was reported
                copiedEventObject.start           = date
                copiedEventObject.allDay          = allDay
                copiedEventObject.backgroundColor = $(this).css('background-color')
                copiedEventObject.borderColor     = $(this).css('border-color')

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove()
                }

            }
        })

        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        //Color chooser button
        var colorChooser = $('#color-chooser-btn')
        $('#color-chooser > li > a').click(function (e) {
            e.preventDefault()
            //Save color
            currColor = $(this).css('color')
            //Add color effect to button
            $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
        })


        $('#add-new-event').click(function (e) {
            e.preventDefault()
            //Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }

            //Create events
            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color'    : currColor,
                'color'           : '#fff'
            }).addClass('external-event')
            event.html(val)
            $('#external-events').prepend(event)

            //Add draggable funtionality
            init_events(event)

            //Remove event from text input
            $('#new-event').val('')
        })
    })

    setTimeout(function () {
        $("#calendar .fc-header-toolbar").remove();
    },100);

    $(".download_btn").click(function (e) {
        let timerInterval
        Swal.fire({
            title: 'Downloading, please wait . . .',
            html: 'This dialog will close in <b>3</b> seconds.',
            timer: 3000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                    b.textContent = Math.round(Swal.getTimerLeft()/1000);
                }, 1000)
                $("#download_form").submit();
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
               //console.log('I was closed by the timer')
            }
        })

        // e.preventDefault();
        // Swal.fire({
        //     title: "Enter your immediate supervisor's complete name:",
        //     html: "<i class='fa fa-info'></i> You may leave this field blank.",
        //     input: 'text',
        //     showCancelButton: true
        // }).then((result) => {
        //     if (result.value) {
        //         $("#sup_name").val(result.value);
        //         $("#download_form").submit();
        //         console.log("Result: " + result.value);
        //     }
        // });

    })

</script>
@endsection

