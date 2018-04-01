<script type="text/javascript">

    // CALL UPDATE SUCCESS MODAL
    @if(Session::has('USER_UPDATE_SUCCESS'))
      $('#user_update').modal('show');
    @endif


    // CALL CONFIRM DELETE MODAL
    {!! JSHelper::modal_confirm_delete_caller('user_delete') !!}


    // CALL LOGOUT FORM
    {!! JSHelper::form_submitter_via_action('logout', 'from_user_logout') !!}


    // CALL ACTIVATE FORM
    {!! JSHelper::form_submitter_via_action('activate', 'from_user_activate') !!}


    // CALL DEACTIVATE FORM
    {!! JSHelper::form_submitter_via_action('deactivate', 'from_user_deactivate') !!}


    // FORM VARIABLES RULE
    {!! JSHelper::table_action_rule() !!}


    // UPDATE TOAST
    @if(Session::has('USER_UPDATE_SUCCESS'))
      {!! JSHelper::toast(Session::get('USER_UPDATE_SUCCESS')) !!}
    @endif


    // DELETE TOAST
    @if(Session::has('USER_DELETE_SUCCESS'))
      {!! JSHelper::toast(Session::get('USER_DELETE_SUCCESS')) !!}
    @endif


    // LOGOUT TOAST
    @if(Session::has('USER_LOGOUT_SUCCESS'))
      {!! JSHelper::toast(Session::get('USER_LOGOUT_SUCCESS')) !!}
    @endif


    // ACTIVATE TOAST
    @if(Session::has('USER_ACTIVATE_SUCCESS'))
      {!! JSHelper::toast(Session::get('USER_ACTIVATE_SUCCESS')) !!}
    @endif


    // DEACTIVATE TOAST
    @if(Session::has('USER_DEACTIVATE_SUCCESS'))
        {!! JSHelper::toast(Session::get('USER_DEACTIVATE_SUCCESS')) !!}
    @endif


    // RESET PASSWORD SUCCESS TOAST
    @if(Session::has('USER_RESET_PASSWORD_SUCCESS'))
        {!! JSHelper::toast(Session::get('USER_RESET_PASSWORD_SUCCESS')) !!}
    @endif

</script>