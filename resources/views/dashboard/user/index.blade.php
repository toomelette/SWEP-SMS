@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>User List</h1>
    </section>

    <section class="content">

        <!-- Advance Filters -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Advance Filters</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                Body
            </div>
        </div>

        <!-- Table Grid -->
         <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Table Grid</h3>
                <div class="box-tools">
                    <form id="filter_form" method="GET" action"{{ route('dashboard.user.index') }}">
                        <div class="input-group input-group-sm" style="width: 250px;">
                          <input name="q" class="form-control pull-right" placeholder="Search" type="text">
                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box-body">
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
                      <td>{{ $data->lastname }}</td>
                      <td>{{ $data->is_logged }}</td>
                      <td>{{ $data->is_active }}</td>
                      <td> 
                        <select name="action" id="action" class="form-control input-sm">
                            <option value="">Select</option>
                        </select>
                      </td>
                    </tr>
                  @endforeach

                </table>
            </div>

            <div class="box-footer">
                {!! $users->render('vendor.pagination.bootstrap-4') !!}
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
        
        })

    </script>
    

@endsection