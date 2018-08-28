@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Document</h1>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.document.store') }}" enctype="multipart/form-data">

        <div class="box-body">
     
          @csrf

          {!! FormHelper::file(
             '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
          ) !!} 

          {!! FormHelper::textbox(
             '4', 'reference_no', 'text', 'Reference No. *', 'Reference No.', old('reference_no'), $errors->has('reference_no'), $errors->first('reference_no'), ''
          ) !!} 

          {!! FormHelper::datepicker(
            '4', 'date',  'Date *', old('date'), $errors->has('date'), $errors->first('date')
          ) !!}

          {!! FormHelper::textbox(
             '4', 'person_to', 'text', 'To *', 'To', old('person_to'), $errors->has('person_to'), $errors->first('person_to'), ''
          ) !!} 

          {!! FormHelper::textbox(
             '4', 'person_from', 'text', 'From *', 'From', old('person_from'), $errors->has('person_from'), $errors->first('person_from'), ''
          ) !!}

          {!! FormHelper::select_static(
            '4', 'type', 'Type', old('type'), StaticHelper::document_types(), $errors->has('type'), $errors->first('type'), '', ''
          ) !!} 
          
          {!! FormHelper::textbox(
             '4', 'subject', 'text', 'Subject *', 'Subject', old('subject'), $errors->has('subject'), $errors->first('subject'), ''
          ) !!}  

          {!! FormHelper::select_dynamic(
            '4', 'folder_code', 'Folder Code *', old('folder_code'), $global_document_folders_all, 'folder_code', 'folder_code', $errors->has('folder_code'), $errors->first('folder_code'), '', ''
          ) !!}

          {!! FormHelper::textbox(
             '4', 'remarks', 'text', 'Remarks', 'Remarks', old('remarks'), $errors->has('remarks'), $errors->first('remarks'), ''
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

  @if(Session::has('DOCUMENT_CREATE_SUCCESS'))

    {!! HtmlHelper::modal(
      'doc_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('DOCUMENT_CREATE_SUCCESS')
    ) !!}
    
  @endif

@endsection 





@section('scripts')

  <script type="text/javascript">

    @if(Session::has('DOCUMENT_CREATE_SUCCESS'))
      $('#doc_create').modal('show');
    @endif

    {!! JSHelper::pdf_upload('doc_file', 'fa', '') !!}

  </script> 
    
@endsection