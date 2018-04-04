<script type="text/javascript">
	
	{!! JSHelper::ajax_select_to_select('department_name', 'department_unit_name', '/api/dropdown_response_department_units_from_department/', 'name', 'name') !!}
	{!! JSHelper::ajax_select_to_select('department_name', 'account_code', '/api/dropdown_response_accounts_from_department/', 'account_code', 'account_code') !!}

	$('#dv_create').modal('show');


</script>