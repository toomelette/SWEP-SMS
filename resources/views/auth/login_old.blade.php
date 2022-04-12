@extends('layouts.guest-master')
@section('content')

<section class="content">
	<div class="col-md-3"></div>
	<div class="col-md-6">

		@if(Session::has('AUTH_AUTHENTICATED'))
			{!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('AUTH_AUTHENTICATED')) !!}
		@endif

		@if(Session::has('AUTH_UNACTIVATED'))
			{!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('AUTH_UNACTIVATED')) !!}
		@endif

		@if(Session::has('CHECK_UNAUTHENTICATED'))
			{!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('CHECK_UNAUTHENTICATED')) !!}
		@endif

		@if(Session::has('CHECK_NOT_LOGGED_IN'))
			{!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('CHECK_NOT_LOGGED_IN')) !!}
		@endif

		@if(Session::has('CHECK_NOT_ACTIVE'))
			{!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('CHECK_NOT_ACTIVE')) !!}
		@endif

		@if(Session::has('PROFILE_UPDATE_USERNAME_SUCCESS'))
			{!! __html::alert('success', '<i class="icon fa fa-check"></i> Success!', Session::get('PROFILE_UPDATE_USERNAME_SUCCESS')) !!}
		@endif

		@if(Session::has('PROFILE_UPDATE_PASSWORD_SUCCESS'))
			{!! __html::alert('success', '<i class="icon fa fa-check"></i> Success!', Session::get('PROFILE_UPDATE_PASSWORD_SUCCESS')) !!}
		@endif

		@if(Session::has('PASSWORD_RESET_SUCCESS'))
			{!! __html::alert('success', '<i class="icon fa fa-check"></i> Success!', Session::get('PASSWORD_RESET_SUCCESS')) !!}
		@endif

		@if(Session::has('PASSWORD_RESET_FAILED'))
			{!! __html::alert('danger', '<i class="icon fa fa-times"></i> Success!', Session::get('PASSWORD_RESET_FAILED')) !!}
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
							<input class="form-control is-invalid" name="username" id="username" placeholder="Username" type="text" value="{{ __sanitize::html_attribute_encode(old('username')) }}">
							
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
					<a href="#" data-toggle="modal" data-target="#reset_modal">Forgot username/password? Click here</a>
					<button type="submit" class="btn btn-default pull-right">Sign in</button>
				</div>
			</form>
		</div>

	</div>
	<div class="col-md-3"></div>
</section>
@endsection


@section('modals')
	<div class="modal fade" id="reset_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" style="width: 20%" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Account Recovery</h4>
				</div>
				<div class="modal-body">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1" data-toggle="tab">Password Reset</a></li>
							<li><a href="#tab_2" data-toggle="tab">Username Lookup</a></li>
						</ul>
						<div class="tab-content">

								<div class="tab-pane active" id="tab_1">
									<form id="reset_password_form">
										<div class="row">
											{!! __form::textbox(
                                                '12 username', 'username', 'text', 'Username:', 'Username','', '', '', ''
                                              ) !!}
										</div>
										<div class="row">
											<div class="col-md-12">
												<button class="btn btn-primary pull-right" type="submit"><i class="fa fa-refresh"></i> Reset</button>
											</div>
										</div>
									</form>

								</div>
								<!-- /.tab-pane -->
								<div class="tab-pane" id="tab_2">
									<form id="search_username_form">
										<div class="row">
											{!! __form::textbox(
												'12 firstname', 'firstname', 'text', 'Firstname:', 'Firstname','', '', '', ''
											  ) !!}
											{!! __form::textbox(
												'12 lastname', 'lastname', 'text', 'Lastname:', 'Lastname','', '', '', ''
											  ) !!}
											{!! __form::textbox(
												'12 birthday', 'birthday', 'date', 'Birthday:', 'birthday','', '', '', ''
											  ) !!}
										</div>
										<div class="row">
											<div class="col-md-12">
												<button class="btn btn-primary pull-right" type="submit"><i class="fa fa-search"></i> Search</button>
											</div>p
										</div>
									</form>
								</div>
						</div>
						<!-- /.tab-content -->
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection


@section('scripts')
	<script type="text/javascript">
		$("#search_username_form").submit(function (e) {
			e.preventDefault();
			form = $(this);
			loading_btn(form);
			$.ajax({
			    url : '{{route("auth.username_lookup")}}',
			    data : form.serialize(),
			    type: 'POST',
			    headers: {
			        {!! __html::token_header() !!}
			    },
			    success: function (res) {
					Swal.fire({
						title: 'User found!',
						icon: 'success',
						html:
								'Name: <b>'+res.fullname+'</b><br>' +
								'Username: <b>'+res.username+'</b>',
						showCloseButton: true,
						showCancelButton: false,
						focusConfirm: false,
						confirmButtonText:
								'<i class="fa fa-check"></i> Done',
						confirmButtonAriaLabel: 'Thumbs up, great!',
						cancelButtonText:
								'<i class="fa fa-thumbs-down"></i>',
						cancelButtonAriaLabel: 'Thumbs down'
					});
					form.get(0).reset();
					remove_loading_btn(form);
			    },
			    error: function (res) {
			        errored(form,res);
			    }
			})
		})

		$('#reset_modal').on('shown.bs.modal', function() {
			$(document).off('focusin.modal');
		});


		$("#reset_password_form").submit(function (e) {
			e.preventDefault();
			form = $(this);
			loading_btn(form);
			$.ajax({
			    url : '{{route("auth.reset_password")}}',
			    data : form.serialize(),
			    type: 'POST',
			    headers: {
			        {!! __html::token_header() !!}
			    },
			    success: function (res) {
					remove_loading_btn(form);
					Swal.fire({
						title: 'Verify your email address',
						input: 'text',
						html: 'Please enter your email address below: <br> <b>'+res.email+'</b>',
						inputAttributes: {
							autocapitalize: 'off'
						},
						showCancelButton: true,
						confirmButtonText: 'Verify',
						showLoaderOnConfirm: true,
						preConfirm: (email) => {
							return $.ajax({
								url : '{{route('auth.verify_email')}}',
								type: 'POST',
								data: {'email':email,'slug':res.slug},
								headers: {
									{!! __html::token_header() !!}
								},
							})
							.then(response => {
								return  response;
							})
							.catch(error => {
								console.log(error);
								Swal.showValidationMessage(
									'Error : '+ error.responseJSON.message,
								)
							})
						},
						allowOutsideClick: () => !Swal.isLoading()
					}).then((result) => {
						if (result.isConfirmed) {
							Swal.fire({
								title: 'A link was sent to your email. Please check your spam messages also.',
								icon : 'success',
							})
						}
					})
			    },
			    error: function (res) {
			    	console.log(res);
			    	if(res.status == 503){
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: res.responseJSON.message,
						})
					}
			        errored(form,res);
			    }
			})
		})
	</script>
@endsection
