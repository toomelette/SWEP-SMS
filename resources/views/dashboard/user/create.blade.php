@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Create User</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
      </div>
      
      <form class="form-horizontal" method="POST" action="{{ route('dashboard.user.store') }}">

        <div class="box-body">

          <div class="col-md-11">
                  
              @csrf    

              {!! FormHelper::textbox_inline(
                  'firstname', 'text', 'Firstname', 'Firstname', old('firstname'), $errors->has('firstname'), $errors->first('firstname')
              ) !!}

              {!! FormHelper::textbox_inline(
                  'middlename', 'text', 'Middlename', 'Middlename', old('middlename'), $errors->has('middlename'), $errors->first('middlename')
              ) !!}

              {!! FormHelper::textbox_inline(
                  'lastname', 'text', 'Lastname', 'Lastname', old('lastname'), $errors->has('lastname'), $errors->first('lastname')
              ) !!}

              {!! FormHelper::textbox_inline(
                  'email', 'email', 'Email', 'Email', old('email'), $errors->has('email'), $errors->first('email')
              ) !!}

              {!! FormHelper::textbox_inline(
                  'position', 'text', 'Position', 'Position / Plantilla', old('position'), $errors->has('position'), $errors->first('position')
              ) !!}

              {!! FormHelper::textbox_inline(
                  'username', 'text', 'Username', 'Username', old('username'), $errors->has('username'), $errors->first('username')
              ) !!}

              {!! FormHelper::password_inline(
                  'password', 'Password', 'Password', $errors->has('password'), $errors->first('password')
              ) !!}

              {!! FormHelper::password_inline(
                  'password_confirmation', 'Confirm Password', 'Confirm Password', '', ''
              ) !!}

          </div>

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save</button>
        </div>

      </form>

    </div>

</section>

@endsection


@section('scripts')
            
    {!! JSHelper::show_password('password', 'show_password') !!}
    {!! JSHelper::show_password('password_confirmation', 'show_password_confirmation') !!}
    
@endsection