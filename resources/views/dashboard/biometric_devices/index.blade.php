@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Biometric Devices</h1>
</section>

<section class="content">
    <div class="row">
        @if($devices->count() > 0)
            @php($count = 0)
            @foreach($devices as $device)
                @php($count++)
                <div class="col-md-4">
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header {{$colors[$count]}} clearfix">
                            <div class="widget-user-image">
                                <img class="img-circle" src="{{asset('images/bds.jpg')}}" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">{{$device->name}}</h3>
                            <h5 class="widget-user-desc">S/N: {{$device->serial_no}}</h5>
                            <div class="btn-group pull-right btn-group-sm" role="group" aria-label="...">
                                <button type="button" class="btn btn-default clear_attendance_btn" data="{{$device->id}}" text="Device: <b>{{$device->name}}</b> <br> IP Address: <b>{{$device->ip_address}}</b><br> <span class='text-danger text-strong'>THIS ACTION CANNOT BE UNDONE!</span> <br> <span class='text-info'>Please enter your password to continue:</span> "><i class="fa fa-eraser"></i> Clear Attendance</button>
                                <button type="button" class="btn btn-default logs_btn" data="{{$device->id}}" data-target="#logs_modal" data-toggle="modal"><i class="fa fa-calendar"></i> Logs</button>
                                <button type="button" class="btn btn-default restart_btn" data="{{$device->id}}" text="Device: <b>{{$device->name}}</b> <br> IP Address: <b>{{$device->ip_address}}</b>"><i class="fa fa-refresh"></i> Restart</button>
                                <button type="button" class="btn btn-default extract_btn" data="{{$device->id}}" text="Device: <b>{{$device->name}}</b> <br> IP Address: <b>{{$device->ip_address}}</b>"><i class="fa fa-sign-out"></i>Extract</button>
                            </div>
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">IP Address <span class="pull-right badge bg-blue">{{$device->ip_address}}</span></a></li>
                                <li><a href="#">Last Fetch <span class="pull-right badge bg-aqua">{{\Carbon\Carbon::parse($device->updated_at)->format('M d, Y | H:i A')}}</span></a></li>
                                <li><a href="#">Last UID <span class="pull-right badge bg-green">{{$device->last_uid}}</span></a></li>
                                <li>
                                    <a href="#">Status
                                        @if($device->status == 1)
                                            <span class="pull-right badge bg-green">Active</span>
                                        @else
                                            <span class="pull-right badge bg-red">Inactive</span>
                                        @endif
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</section>


@endsection


@section('modals')
{!! \App\Swep\ViewHelpers\__html::blank_modal('logs_modal','60') !!}
@endsection

@section('scripts')
<script type="text/javascript">
    function dt_draw() {
        users_table.draw(false);
    }

    function filter_dt() {
        is_online = $(".filter_status").val();
        is_active = $(".filter_account").val();
        users_table.ajax.url("{{ route('dashboard.user.index') }}" + "?is_online=" + is_online + "&is_active=" + is_active).load();

        $(".filters").each(function (index, el) {
            if ($(this).val() != '') {
                $(this).parent("div").addClass('has-success');
                $(this).siblings('label').addClass('text-green');
            } else {
                $(this).parent("div").removeClass('has-success');
                $(this).siblings('label').removeClass('text-green');
            }
        });
    }
</script>
<script type="text/javascript">
    $(".restart_btn").click(function () {
        btn = $(this);
        var id = btn.attr('data');
        Swal.fire({
            title: 'Restart device?',
            // input: 'text',
            html: btn.attr('text'),
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-refresh"></i> Restart',
            showLoaderOnConfirm: true,
            preConfirm: (email) => {
                return $.ajax({
                    url : '{{route('dashboard.biometric_devices.restart')}}',
                    type: 'POST',
                    data: {'id':id},
                    headers: {
                        {!! __html::token_header() !!}
                    },
                })
                    .then(response => {
                        return  response;
                    })
                    .catch(error => {
                        console.log(error);
                        Swal.showValidationMessage(
                            'Error : '+ error.responseJSON.message,
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Restarting Device',
                    icon : 'info',
                })
            }
        })
    })

    $(".extract_btn").click(function () {
        btn = $(this);
        var id = btn.attr('data');
        Swal.fire({
            title: 'Extract from device?',
            // input: 'text',
            html: btn.attr('text'),
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-sign-out"></i> Extract',
            showLoaderOnConfirm: true,
            preConfirm: (email) => {
                return $.ajax({
                    url : '{{route('dashboard.biometric_devices.extract')}}',
                    type: 'POST',
                    data: {'id':id},
                    headers: {
                        {!! __html::token_header() !!}
                    },
                })
                .then(response => {
                    return  response;
                })
                .catch(error => {
                    console.log(error);
                    Swal.showValidationMessage(
                        'Error : '+ error.responseJSON.message,
                    )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(result);
                Swal.fire({
                    title: result.value,
                    icon : 'success',
                })
            }
        })
    })
    
    $(".logs_btn").click(function () {
        btn = $(this);
        load_modal2(btn);
        $.ajax({
            url : '{{route("dashboard.biometric_devices.attendances")}}',
            data : {id:btn.attr('data')},
            type: 'GET',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                populate_modal2(btn,res);
               console.log(res);
            },
            error: function (res) {
                notify('Bad request.','danger');
                console.log(res);
            }
        })
    })

    $(".clear_attendance_btn").click(function () {
        btn = $(this);
        var id = btn.attr('data');
        Swal.fire({
            title: 'Clear attendance from device?',
            input: 'password',
            html: btn.attr('text'),
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-eraser"></i> Clear Attendance',
            showLoaderOnConfirm: true,
            preConfirm: (password) => {
                return $.ajax({
                    url : '{{route('dashboard.biometric_devices.clear_attendance')}}',
                    type: 'POST',
                    data: {'id':id, 'password':password},
                    headers: {
                        {!! __html::token_header() !!}
                    },
                })
                    .then(response => {
                        return  response;
                    })
                    .catch(error => {
                        console.log(error);
                        Swal.showValidationMessage(
                            'Error : '+ error.responseJSON.message,
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(result);
                Swal.fire({
                    title: result.value,
                    icon : 'success',
                })
            }
        })
    })

</script>
@endsection