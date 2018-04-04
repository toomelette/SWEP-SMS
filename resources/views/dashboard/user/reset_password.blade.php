@extends('layouts.admin-master')

@section('content')

<section class="content-header">
  <h1>User Reset Password</h1>
  <div class="pull-right" style="margin-top: -25px;">
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
  </div>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
      </div>
      
      <form class="form-horizontal">

        <div class="box-body">

          @if(Session::has('USER_RESET_PASSWORD_CONFIRMATION_FAIL'))
            {!! HtmlHelper::alert('danger', '<i class="icon fa fa-ban"></i> Alert!', Session::get('USER_RESET_PASSWORD_CONFIRMATION_FAIL')) !!}
          @endif

          @if(Session::has('USER_RESET_PASSWORD_OWN_ACCOUNT_FAIL'))
            {!! HtmlHelper::alert('danger', '<i class="icon fa fa-ban"></i> Alert!', Session::get('USER_RESET_PASSWORD_OWN_ACCOUNT_FAIL')) !!}
          @endif

          <div class="col-md-11">
                  
              @csrf    

              {!! FormHelper::password_inline(
                  'password', 'New Password', 'New Password', $errors->has('password'), $errors->first('password'), ''
              ) !!}

              {!! FormHelper::password_inline(
                  'password_confirmation', 'Confirm Password', 'Confirm Password', '', '', ''
              ) !!}

          </div>

        </div>

      </form>

      <div class="box-footer">
        <button class="btn btn-success" id="reset_button">Reset</button>
      </div>

    </div>

</section>

@endsection

    
@section('modals')

  @include('modals.user.reset_password')
    
@endsection


@section('scripts')

  @include('scripts.user.reset_password')
    
@endsection