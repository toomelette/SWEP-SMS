@if(Session::has('USER_CREATE_SUCCESS'))

	{!! HtmlHelper::modal(
	  'user_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('USER_CREATE_SUCCESS')
	) !!}
	
@endif