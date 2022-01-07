@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Manage DTR</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List of Biometric Users</h3>
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
                                <label>Sex:</label>
                                <select name="scholars_table_length" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                    <option value="">All</option>
                                    <option value="MALE">Male</option>
                                    <option value="FEMALE">Female</option>
                                </select>
                            </div>
                            <div class="col-md-1 col-sm-2 col-lg-2">
                                <label>Employment Status:</label>
                                <select name="scholars_table_length" aria-controls="scholars_table" class="form-control input-sm filter_status filters">
                                    <option value="">All</option>
                                    <option value="PERM">Permanent</option>
                                    <option value="JO">Job Order</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div id="dtr_table_container" style="display: none">


                    <table class="table table-bordered table-striped table-hover" id="dtr_table" style="width: 100% !important; font-size: 14px">
                        <thead>
                        <tr class="bg-green">
                            <th>Name</th>
                            <th>BM Id</th>
                            <th class="w-40">Employee No</th>
                            <th class="th-10">Status</th>
                            <th class="th-10">Sex</th>
                            <th class="th-10">Last attendance</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
            <div id="tbl_loader">
                <center>
                    <img style="width: 100px" src="{{asset("images/loader.gif")}}">
                </center>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
    </section>


@endsection


@section('modals')
{!! __html::blank_modal('show_dtr_modal','lg') !!}
{!! __html::blank_modal('dtr_modal','lg') !!}
@endsection

@section('scripts')
    <script type="text/javascript">
        function dt_draw() {
            users_table.draw(false);
        }

        function filter_dt() {
            var sex = $(".filter_sex").val();
            var status = $(".filter_status").val();
            dtr_tbl.ajax.url("{{ route('dashboard.dtr.index') }}" + "?sex=" + sex + "&status=" + status).load();

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
        dtr_tbl = $("#dtr_table").DataTable({
          'dom' : 'lBfrtip',
          "processing": true,
          "serverSide": true,
          "ajax" : '{{route('dashboard.dtr.index')}}',
          "columns": [
            { "data": "fullname" },
            { "data": "biometric_user_id" },
            { "data": "employee_no" },
            { "data": "type"},
            { "data": "sex" },
            { "data": "last_attendance" },
              { "data": "action" }
          ],
          "buttons": [
            {!! __js::dt_buttons() !!}
          ],
          "columnDefs":[

            {
              "targets" : [,3,4],
              // "orderable" : ,
              "class" : 'w-6p'
            },
            {
                "targets" : [1,2],
              "class" : 'action-10p'
            },
            {
              "targets" : 6,
              "orderable" : false,
              "class" : 'action-10p'
            },
          ],
          "responsive": false,
          "initComplete": function( settings, json ) {
            $('#tbl_loader').fadeOut(function(){
              $("#dtr_table_container").fadeIn();
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
              $("#dtr_table #"+active).addClass('success');
            }
          }
        })
        
        style_datatable("#dtr_table");
        
        //Need to press enter to search
        $('#dtr_table_filter input').unbind();
        $('#dtr_table_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
            dtr_tbl.search(this.value).draw();
          }
        });

        $(".filters").change(function () {
            filter_dt();
        })
        $("body").on("click",'.show_dtr_btn',function () {
            btn = $(this);
            load_modal2(btn);
            url = '{{route("dashboard.dtr.show","slug")}}';
            url = url.replace("slug",btn.attr('data'));
            $.ajax({
                url : url,
                data : '',
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    populate_modal2(btn,res);
                    console.log(res);
                },
                error: function (res) {
                    notify('Error','danger');
                    console.log(res);
                }
            })
        })
    </script>

@endsection