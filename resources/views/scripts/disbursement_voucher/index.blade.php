<script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! JSHelper::modal_confirm_delete_caller('dv_delete') !!}


    {{-- FORM VARIABLES RULE --}}
    {!! JSHelper::table_action_rule() !!}


    {{-- DV DELETE TOAST --}}
    @if(Session::has('SESSION_DV_DELETE_SUCCESS'))
      {!! JSHelper::toast(Session::get('SESSION_DV_DELETE_SUCCESS')) !!}
    @endif


    {{-- DV SET NO TOAST --}}
    @if(Session::has('SESSION_DV_SET_NO_SUCCESS'))
      {!! JSHelper::toast(Session::get('SESSION_DV_SET_NO_SUCCESS')) !!}
    @endif
    

    $(document).on("change", "#action", function () {
	  var element = $(this).children("option:selected");
	  if(element.data("action") == "set_dv_no"){
	    $("#dv_set_no").modal("show");
	    $("#dv_set_no_form").attr("action", element.data("url"));
        $("#dv_set_no_form #dv_no").val(element.data("value"));
	    $(this).val("");
	  }
	});


</script>