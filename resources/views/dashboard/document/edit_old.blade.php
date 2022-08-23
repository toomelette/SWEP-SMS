@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Edit Document</h1>
      <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button([
        'dashboard.document.index',
        'dashboard.document.show'
      ]) !!}
    </div>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.document.update', $document->slug) }}" enctype="multipart/form-data">

        <div class="box-body">
          
          <input name="_method" value="PUT" type="hidden">

          @csrf

          {!! __form::file(
             '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
          ) !!} 

          {!! __form::textbox(
             '4', 'reference_no', 'text', 'Reference No. *', 'Reference No.', old('reference_no') ? old('reference_no') : $document->reference_no, $errors->has('reference_no'), $errors->first('reference_no'), ''
          ) !!} 

          {!! __form::datepicker(
            '4', 'date',  'Date *', old('date') ? old('date') : $document->date, $errors->has('date'), $errors->first('date')
          ) !!}

          <div class="col-md-8"></div>

          {!! __form::textbox(
             '4', 'person_to', 'text', 'To', 'To', old('person_to') ? old('person_to') : $document->person_to, $errors->has('person_to'), $errors->first('person_to'), ''
          ) !!} 

          {!! __form::textbox(
             '4', 'person_from', 'text', 'From', 'From', old('person_from') ? old('person_from') : $document->person_from, $errors->has('person_from'), $errors->first('person_from'), ''
          ) !!}

          <div class="col-md-8"></div>

          {!! __form::select_static(
            '4', 'type', 'Type', old('type') ? old('type') : $document->type, __static::document_types(), $errors->has('type'), $errors->first('type'), 'select2', ''
          ) !!} 
          
          {!! __form::textbox(
             '4', 'subject', 'text', 'Subject *', 'Subject', old('subject') ? old('subject') : $document->subject, $errors->has('subject'), $errors->first('subject'), ''
          ) !!}  

          <div class="col-md-8"></div>
            
          {!! __form::select_dynamic(
            '4', 'folder_code', 'Folder Code *', old('folder_code') ? old('folder_code') : $document->folder_code, $global_document_folders_all, 'folder_code', 'folder_code', $errors->has('folder_code'), $errors->first('folder_code'), 'select2', ''
          ) !!}
            
          {!! __form::select_dynamic(
            '4', 'folder_code2', '2nd Folder Code (If Cross-File)', old('folder_code2') ? old('folder_code2') : $document->folder_code2, $global_document_folders_all, 'folder_code', 'folder_code', $errors->has('folder_code2'), $errors->first('folder_code2'), 'select2', ''
          ) !!}

          <div class="col-md-8"></div>

          {!! __form::textbox(
             '4', 'remarks', 'text', 'Remarks', 'Remarks', old('remarks') ? old('remarks') : $document->remarks, $errors->has('remarks'), $errors->first('remarks'), ''
          ) !!}  

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

  </section>

@endsection





@section('scripts')

  <script type="text/javascript">

    $("#doc_file").fileinput({
      theme: "fa",
      allowedFileExtensions: ["pdf", "jpeg", "jpg", "png"],
      maxFileCount: 1,
      showUpload: false,
      showCaption: false,
      overwriteInitial: true,
      fileType: "pdf",
      browseClass: "btn btn-primary btn-md",
      initialPreview: [
          "{{ route('dashboard.document.view_file', $document->slug) }}",
      ],
      initialPreviewAsData: true,
      initialPreviewConfig: [
          {type: "{{ File::extension($document->filename) == 'pdf' ? 'pdf' : 'image' }}", size: "100%", width: "100%", key: 1},
      ],
    }); 
    $(".kv-file-remove").hide();

  </script> 
    
@endsection