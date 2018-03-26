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
                    <tr>
                      <td>{{ $data->username }}</td>
                      <td>{{ $data->fullname }}</td>
                      <td>{!! $data->is_online == 1 ? '<span class="badge bg-green"><i class="fa fa-check "></i></span>' : '<span class="badge bg-red"><i class="fa fa-times "></i></span>' !!}</td>
                      <td>{!! $data->is_active == 1 ? '<span class="badge bg-green"><i class="fa fa-check "></i></span>' : '<span class="badge bg-red"><i class="fa fa-times "></i></span>' !!}</td>
                      <td> 
                        <select id="action" class="form-control input-sm" onchange="location = this.value;">
                            <option value="">Select</option>
                            <option value="{{ route('dashboard.user.show', $data->slug) }}">Details</option>
                            <option value="{{ route('dashboard.user.edit', $data->slug) }}">Edit</option>
                            <option value="{{ route('dashboard.user.destroy', $data->slug) }}">Delete</option>
                        </select>
                      </td>
                    </tr>
                  @endforeach
                </table>
            </div>

            @if($users->isEmpty())
              <center><p>No Records found!</p></center>
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


@section('scripts')

    <script type="text/javascript">

        $(document).ready(function($){

           $("#filter_form").submit(function() {
                $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
                return true;
            });

            $("form").find( ":input" ).prop( "disabled", false );
        
        });

    </script>
    
@endsection