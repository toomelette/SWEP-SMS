@extends('layouts.admin-master')

@section('content')
    
    <!-- FORM START -->
    <form class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.user.index') }}">

    <section class="content-header">
        <h1>User List</h1>
    </section>

    <section class="content">

        <!-- Advance Filters -->
        <div class="box {!! Input::except('q', 'page') ? '' : 'collapsed-box' !!}">

            <div class="box-header with-border" data-widget="collapse">
                <h3 class="box-title">Advance Filters</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div> 
            </div>

            <div class="box-body">

              <div class="form-group col-md-2">
                <label for="exampleInputEmail1">Log-in Status</label>
                <select name="online" class="form-control input-sm" onchange="document.getElementById('submit_user_filter').click()">
                  <option value="">Select</option>
                  <option value="true" {!! old('online') == 'true' ? 'selected' : '' !!}>Online</option>
                  <option value="false" {!! old('online') == 'false' ? 'selected' : '' !!}>Offline</option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label for="exampleInputEmail1">User Status</label>
                <select name="active" class="form-control input-sm" onchange="document.getElementById('submit_user_filter').click()">
                  <option value="">Select</option>
                  <option value="true" {!! old('active') == 'true' ? 'selected' : '' !!}>Active</option>
                  <option value="false" {!! old('active') == 'false' ? 'selected' : '' !!}>Inactive</option>
                </select>
              </div>

            </div>

            <button type="submit" id="submit_user_filter" style="display:none;">Filter</button>

        </div>

        <!-- Table Grid -->
         <div class="box">

            <div class="box-header with-border">

                <div class="box-title">  
                  <div class="input-group input-group-sm" style="width: 250px;">
                    <input name="q" class="form-control pull-right" placeholder="Search any.." type="text" value="{{ old('q') }}">
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>

                <div class="box-tools">
                  <a href="{{ route('dashboard.user.index') }}" class="btn btn-sm btn-default">Refresh Data &nbsp;<i class="fa fa-refresh"></i></a>
                </div>

            </div>

    <!-- FORM END -->  
    </form>

            <div class="box-body no-padding">
                <table class="table table-bordered">
                  <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Online</th>
                    <th>Active</th>
                    <th style="width: 150px">Action</th>
                  </tr>
                  @foreach($users as $data) 
                    <tr {!! Session::has('USER_UPDATE_SUCCESS') && Session::get('USER_UPDATE_SUCCESS_SLUG') == $data->slug ? 'style="background-color: #b3e5fc;"' : '' !!} >
                      <td>{{ $data->username }}</td>
                      <td>{{ $data->fullname }}</td>
                      <td>{!! $data->is_online == 1 ? '<span class="badge bg-green"><i class="fa fa-check "></i></span>' : '<span class="badge bg-red"><i class="fa fa-times "></i></span>' !!}</td>
                      <td>{!! $data->is_active == 1 ? '<span class="badge bg-green"><i class="fa fa-check "></i></span>' : '<span class="badge bg-red"><i class="fa fa-times "></i></span>' !!}</td>
                      <td> 
                        <select id="action" class="form-control input-sm">
                            <option value="">Select</option>
                            <option value="{{ route('dashboard.user.show', $data->slug) }}">Details</option>
                            <option value="{{ route('dashboard.user.edit', $data->slug) }}">Edit</option>
                            <option value="" data-url="{{ route('dashboard.user.destroy', $data->slug) }}" id="delete_button">Delete</option>
                        </select>
                      </td>
                    </tr>
                  @endforeach
                </table>
            </div>

            @if($users->isEmpty())
            <div style="padding :5px;">
              <center><h4>No Records found!</h4></center>
            </div>
            @endif

            <div class="box-footer">
              {!! $users->appends([
                    'q'=>Input::get('q'), 
                    'online' => Input::get('online'), 
                    'active' => Input::get('active'),
                  ])->render('vendor.pagination.bootstrap-4')
              !!}
            </div>

        </div>

    </section>

@endsection


@section('modals')

  @if(Session::has('USER_UPDATE_SUCCESS'))

    {!! HtmlHelper::modal(
      'user_update', '<i class="fa fa-fw fa-check"></i> Updated!', Session::get('USER_UPDATE_SUCCESS')
    ) !!}

  @endif


  <div class="modal fade" id="user_delete" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title"><i class="fa fa-fw fa-alert"></i> Delete ?</h4>
        </div>
        <div class="modal-body" id="delete_body">
          <form method="POST" id="form">
            @csrf
            <input name="_method" value="DELETE" type="hidden">
            <p style="font-size: 17px;">Are you sure, you want to delete this record?</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection 


@section('scripts')

    <script type="text/javascript">

        $(document).on("change", "#action", function () {
           if(this.value !== ""){
              location = this.value;
           }
        });

        // CALL UPDATE SUCCESS MODAL
        @if(Session::has('USER_UPDATE_SUCCESS'))
          $('#user_update').modal('show');
        @endif

        // CALL DELETE MODAL
        $(document).on("click", "#delete_button", function () {
            $('#user_delete').modal('show');
            var url = $(this).data("url");
            $("#delete_body #form").attr("action", url);
        });

        // FORM CONTROL VARIABLES
        $(document).ready(function($){
          $("#filter_form").submit(function() {
            $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
            return true;
          });
          $("form").find( ":input" ).prop( "disabled", false );
        });

        // DELETE TOAST
        @if(Session::has('USER_DELETE_SUCCESS'))
          $.toast({
            text: '<span style="font-size:15px;">{!! Session::get('USER_DELETE_SUCCESS') !!}</span>',
            showHideTransition: 'fade',
            allowToastClose: true,
            hideAfter: 7500,
            loader: false,
            position: 'top-center',
            bgColor: '#444',
            textColor: '#eee',
            textAlign: 'left',
          });
        @endif
    </script>
    
@endsection