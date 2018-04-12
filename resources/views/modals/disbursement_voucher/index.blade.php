{!! HtmlHelper::modal_delete('dv_delete') !!}

<div class="modal fade" id="dv_set_no" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <form id="dv_set_no_form" class="form-horizontal" method="POST" autocomplete="off">
            @csrf
            <p style="font-size: 17px;">Set DV No.</p><br>

            {!! FormHelper::textbox_inline(
                'dv_no', 'text', 'DV No.', 'DV No.', old('dv_no'), $errors->has('dv_no'), $errors->first('dv_no'), ''
            ) !!}

        </div>

        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>

        </form>

      </div>
    </div>
  </div>