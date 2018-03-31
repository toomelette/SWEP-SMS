<script type="text/javascript">

  {!! JSHelper::show_password('password', 'show_password') !!}
  {!! JSHelper::show_password('password_confirmation', 'show_password_confirmation') !!}
  {!! JSHelper::show_password('user_password', 'show_user_password') !!}


  //CALL RESET PASSWORD CONFIRMATION
  $(document).on("click", "#reset_button", function () {
    var password = $("#password").val();
    var password_confirmation = $("#password_confirmation").val();
    $("#user_reset_password").modal("show");
    $("#reset_password_form #password_in_modal").attr("value", password);
    $("#reset_password_form #password_confirmation_in_modal").attr("value", password_confirmation);
  });

</script>