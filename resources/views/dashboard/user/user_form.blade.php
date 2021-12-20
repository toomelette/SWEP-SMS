<p class="page-header-sm text-info" style="border-bottom: 1px solid grey">
    Create an account for:
</p>
<form id="new_user_from_employee_form">

    <h5 class="text-strong" style="font-size: 1.5rem">{{strtoupper($employee->firstname)}} {{strtoupper($employee->lastname)}}</h5>

    <div class="row">
        <div hidden>
            {!! __form::textbox(
              '12 slug', 'slug', 'text', 'Slug *', 'Slug', $employee->slug, 'slug', '', ''
            ) !!}
        </div>

        {!! __form::textbox(
          '12 username', 'username', 'text', 'Username *', 'Username', '', 'username', '', ''
        ) !!}
    </div>
    <hr class="no-margin" style="margin-bottom: 10px !important;">
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Save</button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $("#new_user_from_employee_form").submit(function (e) {
        e.preventDefault();
        form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.user.store")}}?create_from_employee=true',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
               console.log(res);
               succeed(form, true, false);

            },
            error: function (res) {
                errored(form,res);
                console.log(res);
            }
        })
    })
</script>