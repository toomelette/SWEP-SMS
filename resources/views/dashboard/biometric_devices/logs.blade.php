@extends('layouts.modal-content')

@section('modal-header')
    {{$device->name}} - S/N: {{$device->serial_no}}
@endsection

@section('modal-body')
    <div id="logs_container" style="display: none">
        <table class="table table-condensed table-striped" id="logs_table" style="width: 100%;">
            <thead>
            <tr>

                <th>Name</th>
                <th>Action</th>
                <th>Time</th>
                <th>Type</th>
            </tr>
            </thead>
            <tbody>


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

    $(document).ready(function () {
        //-----DATATABLES-----//
        //Initialize DataTable
        logs_active = '';
        logs_tbl = $("#logs_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{route("dashboard.biometric_devices.attendances")}}?device={{$device->serial_no}}',
            "columns": [
                {data: 'fullname',name:'x.fullname'},
                {data: 'type' },
                {data: 'timestamp' },
                {data: 'user' },

            ],
            "buttons": [
                {!! __js::dt_buttons() !!}
            ],
            "columnDefs":[
                {
                    "targets" : 3,
                    "visible" : false,
                },
                {
                    targets: 2,
                    render : function (row) {
                        return moment(row).format("MMM. DD, YY | hh:mm A");;
                    }
                }
            ],
            "order":[[2,'desc']],
            "responsive": false,
            "initComplete": function( settings, json ) {
                $('#tbl_loader_log').fadeOut(function(){
                    $("#logs_container").fadeIn();
                });
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(logs_active != ''){
                    $("#logs_table #"+logs_active).addClass('success');
                }
            }
        });

        style_datatable("#logs_table");

        //Need to press enter to search
        $('#logs_table_filter input').unbind();
        $('#logs_table_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                logs_tbl.search(this.value).draw();
            }
        });
    })


</script>
@endsection

