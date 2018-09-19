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
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.document_folder.store') }}">

        <div class="box-body">
     
          @csrf

          {!! __form::textbox(
             '4', 'folder_code', 'text', 'Folder Code *', 'Folder Code', old('folder_code'), $errors->has('folder_code'), $errors->first('folder_code'), ''
          ) !!}

          {!! __form::textbox(
             '8', 'description', 'text', 'Description', 'Description', old('description'), $errors->has('description'), $errors->first('description'), ''
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

  @if(Session::has('DOC_FOLDER_CREATE_SUCCESS'))

    {!! __html::modal(
      'doc_folder_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('DOC_FOLDER_CREATE_SUCCESS')
    ) !!}

  @endif

@endsection 





@section('scripts')

  <script type="text/javascript">

    @if(Session::has('DOC_FOLDER_CREATE_SUCCESS'))
      $('#doc_folder_create').modal('show');
    @endif

  </script> 
    
@endsection