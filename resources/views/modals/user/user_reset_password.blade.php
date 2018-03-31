<div class="modal fade" id="user_reset_password" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title"><i class="fa fa-key"></i> &nbsp;User Confirmation</h4>
        </div>
        <div class="modal-body">
          <form id="reset_password_form" class="form-horizontal" method="POST" autocomplete="off" action="{{ route('dashboard.user.reset_password_post', $user->slug) }}">
            @csrf
            <p style="font-size: 17px;">Confirm first your identity before resetting someone's password!</p>
            <br>
            <input id="password_in_modal" type="hidden" name="password" value="">
            <input id="password_confirmation_in_modal" type="hidden" name="password_confirmation" value="">

            {!! FormHelper::textbox_inline(
                'username', 'text', 'Username', 'Username', old('username'), $errors->has('username'), $errors->first('username')
            ) !!}

            {!! FormHelper::password_inline(
                'user_password', 'Password', 'Password', $errors->has('user_password'), $errors->first('user_password')
            ) !!}

        </div>

        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Sign-in</button>
        </div>

        </form>

      </div>
    </div>
  </div>