@extends('layouts.modal-content')

@section('modal-header')
    {{$device->name}} - S/N: {{$device->serial_no}}
@endsection

@section('modal-body')
    <div id="logs_container" style="display: none">
        <table class="table table-condensed table-striped" id="logs_table" style="width: 100%;">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Type</th>
            </tr>
            </thead>
            <tbody>
            @if(count($attendances) > 0)
                @foreach($attendances as $attendance)
                    <tr>
                        <td>{{$attendance['uid']}}</td>
                        @if(isset($employees_arr[$attendance['id']]))
                            <td>{{strtoupper($employees_arr[$attendance['id']]->lastname)}}, {{strtoupper($employees_arr[$attendance['id']]->firstname)}}</td>
                        @else
                            <td><i>{{$attendance['id']}}</i></td>
                        @endif

                        <td>{{$attendance['timestamp']}}</td>
                        <td>{{$attendance['timestamp']}}</td>
                        <td>{{\App\Swep\Helpers\Helper::dtr_type($attendance['type'])}}</td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
    </div>
    <div id="tbl_loader_log">
        <center>
            <img style="width: 100px" src="{{asset('images/loader.gif')}}">
        </center>
    </div>
@endsection

@section('modal-footer')

@endsection

@section('scripts')
<script type="text/javascript">
    logs_tbl = $("#logs_table").DataTable({
        columnDefs: [
            {
            targets: 2,
            render: function (data, type, row) {//data
                return moment(data).format('MMM. DD,YYYY');
                },
            },
            {
                targets: 3,
                render: function (data, type, row) {//data
                    return moment(data).format('hh:mm:ss');
                },
            },
            {
                targets: 0,
                visible: false,
            }

        ],
        order: [[ 2, "desc" ],[ 3, "desc" ],[ 1, "asc" ]],
        initComplete: function( settings, json ) {

            setTimeout(function () {
                $('#tbl_loader_log').fadeOut(function(){
                    $("#logs_container").fadeIn();
                });
            },500)
        },
    });
</script>
@endsection

