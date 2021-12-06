@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Manage PAP Parents</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">PAP Parents</h3>
                <div class="pull-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_parent_modal"><i class="fa fa-plus"></i> New PAP Category</button>
                </div>
            </div>

            <div class="panel">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#advanced_filters" aria-expanded="true" class="">
                            <i class="fa fa-filter"></i>  Advanced Filters <i class=" fa  fa-angle-down"></i>
                        </a>
                    </h4>
                </div>
                <div id="advanced_filters" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-1 col-sm-2 col-lg-2">
                                <label>Status:</label>
                                <select name="status" aria-controls="scholars_table" class="form-control input-sm filter_status filters">
                                    <option value="">All</option>
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                </select>
                            </div>
                            <div class="col-md-1 col-sm-2 col-lg-2">
                                <label>Account Status:</label>
                                <select name="account" aria-controls="scholars_table" class="form-control input-sm filter_account filters">
                                    <option value="">All</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div id="pap_parent_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="pap_parent_table" style="width: 100% !important">
                        <thead>
                        <tr class="">
                            <th class="th-20">Name</th>
                            <th class="action">Action</th>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="add_parent_modal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form id="add_category_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add new category</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {!! __form::textbox(
                              '12 name', 'name', 'text', 'Name *', 'Name', '', 'name', '', ''
                            ) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {!! \App\Swep\ViewHelpers\__html::blank_modal('edit_pap_parent_modal','sm') !!}
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
        $(document).ready(function () {
            //-----DATATABLES-----//
            //Initialize DataTable
            modal_loader = $("#modal_loader").parent('div').html();
            active = '';
            pap_parent_tbl = $("#pap_parent_table").DataTable({
              'dom' : 'lBfrtip',
              "processing": true,
              "serverSide": true,
              "ajax" : '{{ route("dashboard.pap_parent.index") }}',
              "columns": [
                { "data": "name" },
                { "data": "action" }
              ],
              "buttons": [
                {!! __js::dt_buttons() !!}
              ],
              "columnDefs":[
                {
                  "targets" : 0,
                  "class" : 'w-10p'
                },
                {
                  "targets" : 1,
                  "orderable" : false,
                  "class" : 'w-1p',
                },
              ],
              "responsive": false,
              "initComplete": function( settings, json ) {
                $('#tbl_loader').fadeOut(function(){
                  $("#pap_parent_table_container").fadeIn();
                });
              },
              "language":
                      {
                        "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                      },
              "drawCallback": function(settings){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active != ''){
                  $("#pap_parent_table #"+active).addClass('success');
                }
              }
            })
            
            style_datatable("#pap_parent_table");
            
            //Need to press enter to search
            $('#pap_parent_table_filter input').unbind();
            $('#pap_parent_table_filter input').bind('keyup', function (e) {
              if (e.keyCode == 13) {
                pap_parent_tbl.search(this.value).draw();
              }
            });
        });


        $("#add_category_form").submit(function (e) {
            e.preventDefault();
            form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.pap_parent.store")}}',
                data : form.serialize(),
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,true);
                    active = res.slug;
                    pap_parent_tbl.draw(false);
                },
                error: function (res) {
                    errored(form,res);
                    console.log(res);
                }
            })
        })

        $("body").on("click",'.edit_pap_parent_btn', function () {
            btn = $(this);
            load_modal2(btn);
            slug = btn.attr('data');
            uri = "{{route('dashboard.pap_parent.edit', 'slug')}}";
            uri = uri.replace('slug',slug)
            $.ajax({
                url : uri,
                type: 'GET',
                success: function (res) {
                   populate_modal2(btn,res);
                },
                error: function (res) {
                    console.log(res);
                }
            })
        })
    </script>


@endsection