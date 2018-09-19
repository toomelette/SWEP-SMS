@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Synchronize User to Employee</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button(['dashboard.user.index']) !!}
    </div>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div>
      </div>
      
      <form class="form-horizontal" method="POST" autocomplete="off" action="{{ route('dashboard.user.sync_employee_post', $user->slug) }}">

        <div class="box-body">

          @if(Session::has('USER_SYNC_EMPLOYEE_FAIL'))
            {!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Alert!', Session::get('USER_SYNC_EMPLOYEE_FAIL')) !!}
          @endif

          <div class="col-md-11">
              
              <input name="_method" value="PATCH" type="hidden">
              @csrf

              {!! __form::select_dynamic(
                '4', 's', 'Please Select Employee you want to sync *', old('s'), $global_employees_all, 'slug', 'fullname', $errors->has('s'), $errors->first('s'), 'select2', ''
              ) !!}

          </div>

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Sync <i class="fa fa-fw fa-exchange"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection
