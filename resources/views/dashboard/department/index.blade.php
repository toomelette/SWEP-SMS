@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Departments</h1>
    </section>

    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">List of Departments</h3>
                <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add_dept_modal"><i class="fa fa-plus"></i> Add Department</button>
            </div>
            <div class="box-body">
                <div id="departments_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="departments_table" style="width: 100% !important">
                        <thead>
                        <tr class="">
                            <th >Department ID</th>
                            <th >Name</th>
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
    <div class="modal fade" id="add_dept_modal" tabindex="-1" role="dialog" aria-labelledby="add_dept_modalLabel">
      <div class="modal-dialog" role="document" style="width: 25%">
        <div class="modal-content">
          <form id="add_dept_form">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="add_dept_modalLabel">Add Department</h4>
              </div>
              <div class="modal-body">
                  <div class="row">
                      {!! \App\Swep\ViewHelpers\__form2::textbox('department_id',[
                          'label' => 'Department ID:*',
                          'cols' => 12,
                      ]) !!}
                      {!! \App\Swep\ViewHelpers\__form2::textbox('name',[
                          'label' => 'Department Name:*',
                          'cols' => 12,
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

    {!! \App\Swep\ViewHelpers\__html::blank_modal('edit_dept_modal','25') !!}
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
        var active = '';
        departments_tbl = $("#departments_table").DataTable({
            "ajax" : '{{Request::url()}}',
            "columns": [
                { "data": "department_id" },
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
                    "targets" : 2,
                    "orderable" : false,
                    "class" : 'action3'
                },
            ],
            "responsive": false,
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "initComplete": function( settings, json ) {
                style_datatable("#"+settings.sTableId);
                $('#tbl_loader').fadeOut(function(){
                    $("#"+settings.sTableId+"_container").fadeIn();
                    if(find != ''){
                        departments_tbl.search(find).draw();
                    }
                });
                //Need to press enter to search
                $('#'+settings.sTableId+'_filter input').unbind();
                $('#'+settings.sTableId+'_filter input').bind('keyup', function (e) {
                    if (e.keyCode == 13) {
                        departments_tbl.search(this.value).draw();
                    }
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
                    $("#"+settings.sTableId+" #"+active).addClass('success');
                }
            }
        });

        $("#add_dept_form").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.department.store")}}',
                data : form.serialize(),
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,false);
                    notify('Department successfully added','success');
                    active = res.slug;
                    departments_tbl.draw(false);
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })
        $("body").on('click','.edit_dept_btn',function () {
            let btn = $(this);
            load_modal2(btn);
            let uri = '{{route("dashboard.department.edit","slug")}}';
            uri = uri.replace('slug',btn.attr('data'));
            $.ajax({
                url : uri,
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                   populate_modal2(btn,res);
                },
                error: function (res) {
                    populate_modal2_error(res)
                }
            })
        })
    </script>

@endsection