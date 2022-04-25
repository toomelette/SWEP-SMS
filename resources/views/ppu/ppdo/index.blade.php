@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Proposal per Department/Office</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Project Procurement and Management Plan</h3>
                <div class="pull-right">
                    <button class="btn btn-primary btn-sm" data-target="#add_item_modal" data-toggle="modal"><i class="fa fa-plus"></i> Add item ({{request('fiscal_year')}} | {{request('resp_center')}})</button>
                </div>
            </div>
            <div class="box-body">
                <div id="ppdo_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="ppdo_table" style="width: 100% !important">
                        <thead>
                        <tr class="">
                            <th class="th-20">PPMP Code</th>
                            <th >PAP Code</th>
                            <th >General Desciption</th>
                            <th >Procurement</th>
                            <th >Total budget</th>
                            <th >Details</th>
                            <th class="action">Action</th>
                            <th>GRP</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div id="tbl_loader">
                    <center>
                        <img style="width: 100px" src="{{asset('images/loader.gif')}}">
                    </center>
                </div>
            </div>
        </div>
    </section>


@endsection


@section('modals')
    <div id="add_item_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="add_item_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Fiscal Year: {{request('fiscal_year')}}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 ppdo_code form-group ">
                                <label for="">PPDO Code:*</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span type="button" disabled="disabled" class="btn btn-default show_pass" data-toggle="tooltip" title="Show/Hide Password" tabindex="-1">
                                          22-
                                        </span>
                                      </span>
                                    <input type="password" name="ppdo_code" placeholder="PPDO Code" class="form-control">

                                </div>

                            </div>
{{--                            <div class="col-md-4" >--}}
{{--                                <label>PPDO Code:</label>--}}
{{--                                <div class="input-group ppdo_code">--}}
{{--                                    <span class="input-group-addon" id="basic-addon1">{{\Illuminate\Support\Carbon::parse(request('fiscal_year'))->format('y')}}-</span>--}}
{{--                                    <input type="text" name="ppdo_code" class="form-control" placeholder="PPDO Code" aria-describedby="basic-addon1">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('resp_center',[
                                    'label' => 'Responsibility Center:*',
                                    'cols' => 8,
                             ]) !!}
                        </div>
                        <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::textbox('ps',[
                                    'label' => 'Personnel Services:*',
                                    'cols' => 4,
                                    'class' => 'autonum'
                             ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('co',[
                                    'label' => 'Capital Outlay:*',
                                    'cols' => 4,
                                    'class' => 'autonum'
                             ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('mooe',[
                                    'label' => 'MOOE:*',
                                    'cols' => 4,
                                    'class' => 'autonum'
                             ]) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        $("#add_item_form").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.ppdo.store")}}',
                data : form.serialize(),
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,false);
                    active = res.slug;

                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })
    </script>

@endsection