@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Manage Programs/Activities/Projects</h1>
    </section>

    <section class="content">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">PAP List</a></li>
                <li><a href="#tab_2" data-toggle="tab">PAP Groups</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">


                        <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                List of Programs/Activities/Projects
                                <button class="btn btn-success pull-right "><i class="fa fa-plus"></i> Add PAP</button>
                            </div>
                            <div class="panel-body">
                                <div id="pap_table_container" style="display: block">
                                    <table class="table table-bordered table-striped table-hover" id="pap_table" style="width: 100% !important">
                                        <thead>
                                        <tr class="">
                                            <th class="th-20">PAP</th>
                                            <th >PAP Code</th>
                                            <th class="th-10">Capital Outlay</th>
                                            <th class="th-10">MOOE</th>
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

                </div>

                <div class="tab-pane" id="tab_2">
                    The European languages are members of the same family. Their separate existence is a myth.
                    For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                    in their grammar, their pronunciation and their most common words. Everyone realizes why a
                    new common language would be desirable: one could refuse to pay expensive translators. To
                    achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                    words. If several languages coalesce, the grammar of the resulting language is more simple
                    and regular than that of the individual languages.
                </div>
            </div>
        </div>
    </section>


@endsection


@section('modals')

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
        pap_tbl = $("#pap_table").DataTable({
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
              $("#pap_table_container").fadeIn();
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
              $("#pap_table #"+active).addClass('success');
            }
          }
        })
        
        style_datatable("#pap_table");
        
        //Need to press enter to search
        $('#pap_table_filter input').unbind();
        $('#pap_table_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
            pap_tbl.search(this.value).draw();
          }
        });
    </script>


@endsection