@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Document Folder</h1>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.email_contact.store') }}">

        <div class="box-body">
     
          @csrf

          {!! __form::textbox(
             '4', 'name', 'text', 'Name / Description *', 'Name / Description', old('name'), $errors->has('name'), $errors->first('name'), ''
          ) !!}

          {!! __form::textbox(
             '4', 'email', 'text', 'Email *', 'Email ', old('email'), $errors->has('email'), $errors->first('email'), ''
          ) !!}

          {!! __form::textbox(
             '4', 'contact_no', 'text', 'Contact No.', 'Contact No.', old('contact_no'), $errors->has('contact_no'), $errors->first('contact_no'), ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

  </section>

@endsection




@section('modals')

  @if(Session::has('EMAIL_CONTACT_CREATE_SUCCESS'))

    {!! __html::modal(
      'email_contact_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('EMAIL_CONTACT_CREATE_SUCCESS')
    ) !!}

  @endif

@endsection 





@section('scripts')

  <script type="text/javascript">

    @if(Session::has('EMAIL_CONTACT_CREATE_SUCCESS'))
      $('#email_contact_create').modal('show');
    @endif

  </script>
    
@endsection