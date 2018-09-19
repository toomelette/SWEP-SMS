@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Edit Document Folder</h1>
      <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button([
        'dashboard.document_folder.index',
      ]) !!}
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.document_folder.update', $doc_folder->slug) }}">

        <div class="box-body">
        
          <input name="_method" value="PUT" type="hidden">
        
          @csrf

          {!! __form::textbox(
             '4', 'folder_code', 'text', 'Folder Code *', 'Folder Code', old('folder_code') ? old('folder_code') : $doc_folder->folder_code, $errors->has('folder_code'), $errors->first('folder_code'), ''
          ) !!}

          {!! __form::textbox(
             '8', 'description', 'text', 'Description', 'Description', old('description') ? old('description') : $doc_folder->description, $errors->has('description'), $errors->first('description'), ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

  </section>

@endsection
