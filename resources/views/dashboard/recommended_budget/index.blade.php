@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Manage Programs/Activities/Projects</h1>
    </section>

    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">List of Job Order Employees</h3>
                <button type="button" class="btn btn-success btn-sm pull-right"  data-target="#add_pap_modal" data-toggle="modal"><i class="fa fa-plus"></i> Add PAP</button>
            </div>
            <div class="box-body">
                <div id="rec_budget_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="rec_budget_table" style="width: 100% !important">
                        <thead>
                        <tr class="">
                            <th class="th-20">Employee No.</th>
                            <th >Full Name</th>
                            <th >Sex</th>
                            <th >Birthday | Age</th>
                            <th >Civil Status</th>
                            <th >BM User Id</th>
                            <th class="action">Action</th>
                            <th >Lastname</th>
                            <th >Firstname</th>
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
    <div class="modal fade" id="add_pap_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="add_pap_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add PAP</h4>
                    </div>
                    <div class="modal-body">
                        @if(request('resp_center') != '' && request('year') != '')
                            <div class="row">
                                <div class="col-md-6">
                                    <b>Year:</b>
                                    <p>{{request('year')}}</p>
                                </div>
                                <div class="col-md-6">
                                    <b>Responsibility Center:</b>
                                    <p>{{request('resp_center')}}</p>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                {!! __form::select_year(6, 'Year', 'year', [] , '', '') !!}

                                {!!
                                    __form::select_static2(6, 'dept', 'Responsibility Center: ',request('resp_center'),
                                    \App\Swep\Helpers\Helper::responsibilityCenters()
                                    , '', '', '', '')
                                   !!}
                            </div>
                        @endif
                        <div class="row">
                            {!! __form::textbox(
                              '12 pap_title', 'pap_title', 'text', 'PAP Title *', 'PAP Title', '', 'pap_title', '', '',''
                            ) !!}

                            {!! __form::textarea('12 pap_desc', 'pap_desc', 'PAP Description: ', '', '', '', '', '') !!}
                        </div>
                        <div class="row">
                            {!! __form::textbox_numeric(
                              '4 ps', 'ps', 'text', 'PS *', 'PS', '', $errors->has('amount'), $errors->first('amount'), '', '',''
                            ) !!}
                            {!! __form::textbox_numeric(
                              '4 ps', 'co', 'text', 'Capital Outlay *', 'Capital Outlay', '', $errors->has('amount'), $errors->first('amount'), '', '',''
                            ) !!}
                            {!! __form::textbox_numeric(
                              '4 ps', 'mooe', 'text', 'MOOE *', 'MOOE', '', $errors->has('amount'), $errors->first('amount'), '', '',''
                            ) !!}
                        </div>
                        <div class="row">
                            {!! __form::textbox(
                              '4 pcent_share', 'pcent_share', 'number', 'Percent Share *', 'Percent Share', '', 'pcent_share', '', '',''
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
        
        //-----DATATABLES-----//
        modal_loader = $("#modal_loader").parent('div').html();
        //Initialize DataTable
        active = '';
        pap_tbl = $("#rec_budget_table").DataTable({
          'dom' : 'lBfrtip',
          "processing": true,
          "serverSide": true,
          "ajax" : '{{route("dashboard.budget_proposal.index")}}',
          "columns": [
            { "data": "username" },
            { "data": "fullname" },
            { "data": "is_online" },
            { "data": "account_status" },
            { "data": "action" }
          ],
          "buttons": [
            {!! __js::dt_buttons() !!}
          ],
          "columnDefs":[
            {
              "targets" : 0,
              "orderable" : false,
              "class" : 'w-10p'
            },
            {
              "targets" : [2,3],
              "orderable" : false,
              "class" : 'w-6p'
            },
            {
              "targets" : 4,
              "orderable" : false,
              "class" : 'action-10p'
            },
          ],
          "responsive": false,
          "initComplete": function( settings, json ) {
            $('#tbl_loader').fadeOut(function(){
              $("#rec_budget_table_container").fadeIn();
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
              $("#rec_budget_table #"+active).addClass('success');
            }
          }
        })
        
        style_datatable("#rec_budget_table");
        
        //Need to press enter to search
        $('#rec_budget_table_filter input').unbind();
        $('#rec_budget_table_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
            pap_tbl.search(this.value).draw();
          }
        });

        $("#add_pap_form").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            let form_data = form.serialize();
            @if(request('resp_center') != '' && request('year') != '')
                  form_data = form_data+'&year={{request('year')}}&resp_center={{request('resp_center')}}';
            @endif
            $.ajax({
                url : '{{route("dashboard.budget_proposal.store")}}',
                data : form_data,
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                   succeed(form,true,false);
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })
    </script>


@endsection