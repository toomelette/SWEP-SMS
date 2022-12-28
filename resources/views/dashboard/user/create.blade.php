@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Create User</h1>
</section>

<section class="content">
            
    <div class="box">
        <form id="add_user_form">
          <div class="box-header with-border">
            <h3 class="box-title">Form</h3>
            <div class="pull-right">
                <code>Fields with asterisks(*) are required</code>
            </div>
          </div>
            <div class="box-body">
                <div class="row">
                    {!! \App\Swep\ViewHelpers\__form2::textbox('username',[
                        'cols' => 2,
                        'label' => 'Username:'
                    ]) !!}

                    {!! \App\Swep\ViewHelpers\__form2::textbox('password',[
                        'cols' => 2,
                        'label' => 'Password:'
                    ]) !!}

                    {!! \App\Swep\ViewHelpers\__form2::select('user_type',[
                        'cols' => 2,
                        'label' => 'User Type:',
                        'options' => \App\Swep\Helpers\Arrays::userTypes(),
                    ]) !!}
                </div>
                <div class="row">

                    {!! \App\Swep\ViewHelpers\__form2::textbox('lastname',[
                        'cols' => 2,
                        'label' => 'Registered Last name:'
                    ]) !!}
                    {!! \App\Swep\ViewHelpers\__form2::textbox('firstname',[
                        'cols' => 2,
                        'label' => 'Registered First name:'
                    ]) !!}
                    {!! \App\Swep\ViewHelpers\__form2::textbox('middlename',[
                        'cols' => 2,
                        'label' => 'Registered Middle name:'
                    ]) !!}
                    {!! \App\Swep\ViewHelpers\__form2::textbox('birthday',[
                        'cols' => 2,
                        'label' => 'Date of Birth:',
                        'type' => 'date',
                    ]) !!}
                    {!! \App\Swep\ViewHelpers\__form2::textbox('position',[
                        'cols' => 2,
                        'label' => 'Position:'
                    ]) !!}
                    {!! \App\Swep\ViewHelpers\__form2::textbox('phone',[
                        'cols' => 2,
                        'label' => 'Phone:'
                    ]) !!}
                    {!! \App\Swep\ViewHelpers\__form2::textbox('email',[
                        'cols' => 2,
                        'label' => 'Email:'
                    ]) !!}
                </div>
                <div class="row">
                    {!!\App\Swep\ViewHelpers\__form2::select('mill_code',[
                        'cols' => 2,
                        'label' => 'Mill Code:',
                        'options' => \App\Swep\Helpers\Arrays::millCodes(),
                    ]) !!}
                    {!! \App\Swep\ViewHelpers\__form2::textbox('assoc_coop',[
                        'cols' => 2,
                        'label' => 'Assoc. / Coop.:'
                    ]) !!}
                    {!! \App\Swep\ViewHelpers\__form2::textbox('address',[
                        'cols' => 4,
                        'label' => 'Address:'
                    ]) !!}
                </div>
                <div class="row">
                    {!! \App\Swep\ViewHelpers\__form2::textbox('o_lastname',[
                        'cols' => 2,
                        'label' => 'Official Last Name:'
                    ]) !!}

                    {!! \App\Swep\ViewHelpers\__form2::textbox('o_firstname',[
                        'cols' => 2,
                        'label' => 'Official First Name:'
                    ]) !!}

                    {!! \App\Swep\ViewHelpers\__form2::textbox('o_middlename',[
                        'cols' => 2,
                        'label' => 'Official Middle Name:'
                    ]) !!}
                </div>
            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
            </div>
        </form>



    </div>

</section>

@endsection





@section('modals')

  @if(Session::has('USER_CREATE_SUCCESS'))

    {!! __html::modal(
      'user_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('USER_CREATE_SUCCESS')
    ) !!}

  @endif

@endsection 





@section('scripts')
    <script type="text/javascript">

        $("#add_user_form").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            $.ajax({
                url : '{{route("dashboard.user.store")}}',
                data : form.serialize(),
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    if(res == 1){
                        form.get(0).reset();
                        notify('Added successfully','success')
                    }else{
                        alert('Error. Check log')
                    }
                },
                error: function (res) {
                    alert('Error. Check log');
                    console.log(res);
                }
            })
        })
    </script>
    
@endsection