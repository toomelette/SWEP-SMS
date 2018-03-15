@extends('layouts.guest')

@section('content')
    
    <section class="content">
	    <div class="col-md-3"></div>

		    <div class="col-md-6">
	         
	        @if(Session::has('IS_AUTHENTICATED'))
	        	<div class="alert alert-danger alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <h4><i class="icon fa fa-ban"></i> Alert!</h4>  
	                {{ Session::get('IS_AUTHENTICATED') }}
          		</div>
	        @endif

	        @if(Session::has('IS_UNACTIVATED'))
	        	<div class="alert alert-danger alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <h4><i class="icon fa fa-ban"></i> Alert!</h4>  
	                {{ Session::get('IS_UNACTIVATED') }}
          		</div>
	        @endif

	          <div class="box box-default">
	            <div class="box-header with-border">
	              <h3 class="box-title">Login</h3>
	            </div>

	            <form class="form-horizontal" method="POST" action="{{ route('auth.login') }}">
	              
	              @csrf

	              <div class="box-body">

	                <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
	                  <label for="username" class="col-sm-2 control-label">Username</label>
	                  <div class="col-sm-10">
	                    <input class="form-control is-invalid" name="username" id="username" placeholder="Username" type="text" value="{{ old('username') }}">
	                    
	                    @if ($errors->has('username'))
                            <span class="help-block"> {{ $errors->first('username') }} </span>
                        @endif

	                  </div>
	                </div>


	                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
	                  <label for="password" class="col-sm-2 control-label">Password</label>
	                  <div class="col-sm-10">
	                    <input class="form-control" name="password" id="password" placeholder="Password" type="password">

	                    @if ($errors->has('password'))
                            <span class="help-block">{{ $errors->first('password') }}</span>
                        @endif

	                  </div>
	                </div>

	              </div>
	             
	              <div class="box-footer">
	                <button type="submit" class="btn btn-default">Sign in</button>
	              </div>
	              
	            </form>
	          </div>
	        </div>

        <div class="col-md-3"></div>

	</section>

@endsection