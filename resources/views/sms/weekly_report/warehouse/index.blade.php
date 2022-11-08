@php
    $rand = \Illuminate\Support\Str::random();
@endphp
@extends('layouts.modal-content')

@section('modal-header')
    List of Subsidiary {{$label}} | {{\Illuminate\Support\Facades\Auth::user()->mill_code}}
@endsection

@section('modal-body')
    <form id="addWarehouseForm_{{$rand}}">
        @csrf
        <div class="row">
            {!! \App\Swep\ViewHelpers\__form2::textbox('alias',[
                'cols' => 5,
                'label' => 'Alias: ',
                'class' => 'input-sm'
            ]) !!}
            {!! \App\Swep\ViewHelpers\__form2::textbox('name',[
                'cols' => 7,
                'label' => 'Name: ',
                'class' => 'input-sm'
            ]) !!}
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-sm btn-primary pull-right" type="submit"><i class="fa fa-check"></i> Add</button>
            </div>
        </div>
    </form>

    <hr>

    <table class="table table-condensed table-bordered" id="warehousesTable_{{$rand}}">
        <thead>
        <tr>
            <th>Alias</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
@endsection

@section('modal-footer')

@endsection

@section('scripts')
    <script type="text/javascript">
        $("#addWarehouseForm_{{$rand}}").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.warehouses.store")}}',
                data : form.serialize()+'&for={{$for}}',
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,false);
                    active_warehouseTable_{{$rand}} = res.slug;
                    warehousesTable_{{$rand}}.draw(false);
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })
        var active_warehouseTable_{{$rand}} = '';
        var warehousesTable_{{$rand}} = $("#warehousesTable_{{$rand}}").DataTable({
                'dom' : 'lBfrtip',
                "processing": true,
                "serverSide": true,
                "ajax" : '{{route("dashboard.warehouses.index")}}?for={{$for}}',
                "columns": [
                    { "data": "alias" },
                    { "data": "name" },
                    { "data": "action" },
                ],
                "buttons": [
                    {!! __js::dt_buttons() !!}
                ],
                "columnDefs":[
                    {
                        "targets" : 2,
                        "orderable" : false,
                        "searchable": false,
                        "class" : 'action4'
                    },
                ],
                "order":[[0,'desc']],
                "responsive": true,
                "initComplete": function( settings, json ) {
                    $("#waitBar .progress-bar").css('width','21%');
                    $("#waitText span").html('Preparing Form 5');
                },
                "language":
                    {
                        "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                    },
                "drawCallback": function(settings){


                    $('[data-toggle="tooltip"]').tooltip();
                    $('[data-toggle="modal"]').tooltip();
                    if(active_warehouseTable_{{$rand}} !== ''){
                        $("#warehousesTable_{{$rand}} #"+active_warehouseTable_{{$rand}}).addClass('success');
                    }
                }
            })

        style_datatable("#warehousesTable_{{$rand}}");

        $(".modal-body").on("click",".editWareHouseBtn",function () {
            let btn = $(this);
            let uri = '{{route("dashboard.warehouses.edit","slug")}}';
            load_modal3(btn);
            uri = uri.replace('slug',btn.attr('data'));
            $.ajax({
                url : uri,
                data: {passedRand : '{{$rand}}'},
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    populate_modal2(btn,res);
                },
                error: function (res) {
                    populate_modal2_error(res);
                }
            })
        })
    </script>
@endsection

