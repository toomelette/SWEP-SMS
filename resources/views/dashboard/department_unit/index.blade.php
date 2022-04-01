@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Department Units</h1>
    </section>

    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">List of Department Units</h3>
                <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add_unit_modal"><i class="fa fa-plus"></i> Add Unit</button>
            </div>
            <div class="box-body">
                <div id="du_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="du_table" style="width: 100% !important">
                        <thead>
                        <tr class="">
                            <th ><Name></Name></th>
                            <th>Description</th>
                            <th >Department</th>
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
<div class="modal fade" id="add_unit_modal" tabindex="-1" role="dialog" aria-labelledby="add_unit_modalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form id="add_unit_form">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="add_unit_modalLabel">Modal title</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  {!! \App\Swep\ViewHelpers\__form2::select('department_id',[
                    'label' => 'Department: *',
                    'cols' => 12,
                    'options' => Helper::departmentsArray(),
                  ]) !!}
                  {!! \App\Swep\ViewHelpers\__form2::textbox('name',[
                    'label' => 'Name: *',
                    'cols' => 12,
                  ]) !!}

                  {!! \App\Swep\ViewHelpers\__form2::textbox('description',[
                    'label' => 'Description: *',
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
    {!! \App\Swep\ViewHelpers\__html::blank_modal('edit_unit_modal','sm') !!}
@endsection

@section('scripts')
<script type="text/javascript">
    //-----DATATABLES-----//
    modal_loader = $("#modal_loader").parent('div').html();
    //Initialize DataTable
    var active = '';
    du_tbl = $("#du_table").DataTable({
        "ajax" : '{{\Illuminate\Support\Facades\Request::url()}}',
        "columns": [
            { "data": "name" },
            { "data": "description" },
            { "data": "department_id" },
            { "data": "action" }
        ],
        "buttons": [
            {!! __js::dt_buttons() !!}
        ],
        "columnDefs":[
            {
                "targets" : [2],
                "visible" : false,
                "class" : 'action2'
            },
            {
                "targets" : 0,
                "class" : 'w-10p'
            },
            {
                "targets" : 3,
                "orderable" : false,
                "class" : 'action3'
            },
        ],
        'rowGroup' : {
            'dataSrc' : 'department_id',
        },
        "order" : [[2,'asc'],[0,'asc']],
        "responsive": false,
        'dom' : 'lBfrtip',
        "processing": true,
        "serverSide": true,
        "initComplete": function( settings, json ) {
            style_datatable("#"+settings.sTableId);
            $('#tbl_loader').fadeOut(function(){
                $("#"+settings.sTableId+"_container").fadeIn();
                if(find != ''){
                    du_tbl.search(find).draw();
                }
            });
            //Need to press enter to search
            $('#'+settings.sTableId+'_filter input').unbind();
            $('#'+settings.sTableId+'_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    du_tbl.search(this.value).draw();
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
    $("#add_unit_form").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.department_unit.store")}}',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
               succeed(form,true,false);
               active = res.slug;
               du_tbl.draw(false);
               notify('Unit successfully added.','success');
            },
            error: function (res) {
                errored(form,res)
            }
        })
    })

    $("body").on('click','.edit_unit_btn',function () {
        let btn = $(this);
        load_modal2(btn);
        let uri = '{{route("dashboard.department_unit.edit","slug")}}';
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