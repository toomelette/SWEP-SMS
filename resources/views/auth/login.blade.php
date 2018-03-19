@extends('layouts.guest-master')
@section('content')

<section class="content">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		
		@if(Session::has('AUTH_AUTHENTICATED'))
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-ban"></i> Oops!</h4>
				{{ Session::get('AUTH_AUTHENTICATED') }}
			</div>
		@endif

		@if(Session::has('AUTH_UNACTIVATED'))
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-ban"></i> Oops!</h4>
				{{ Session::get('AUTH_UNACTIVATED') }}
			</div>
		@endif

		@if(Session::has('CHECK_UNAUTHENTICATED'))
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa  fa-exclamation-triangle"></i> Oops!</h4>
				{{ Session::get('CHECK_UNAUTHENTICATED') }}
			</div>
		@endif

		@if(Session::has('CHECK_NOT_LOGGED_IN'))
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa  fa-exclamation-triangle"></i> Oops!</h4>
				{{ Session::get('CHECK_NOT_LOGGED_IN') }}
			</div>
		@endif

		@if(Session::has('CHECK_NOT_ACTIVE'))
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa  fa-exclamation-triangle"></i> Oops!</h4>
				{{ Session::get('CHECK_NOT_ACTIVE') }}
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
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="show_password" id="show_password">Show Password
								</label>
							</div>
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


@section('scripts')
			
	{!! JSHelper::show_password('password', 'show_password') !!}
	
@endsection