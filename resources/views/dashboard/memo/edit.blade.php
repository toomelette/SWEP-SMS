@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Edit Memo</h1>
      <div class="pull-right" style="margin-top: -25px;">
        {!! HtmlHelper::back_button(['dashboard.memo.index','dashboard.memo.show']) !!}
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
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.memo.update', $memo->slug) }}">

        <div class="box-body">
     
          @csrf    
          <input name="_method" value="PUT" type="hidden">

          {!! FormHelper::textbox(
             '3', 'reference_no', 'text', 'Reference No. *', 'Reference No.', old('reference_no') ? old('reference_no') : $memo->reference_no, $errors->has('reference_no'), $errors->first('reference_no'), ''
          ) !!} 

          {!! FormHelper::datepicker(
            '3', 'date',  'Memo Dated', old('date') ? old('date') : DataTypeHelper::date_parse($memo->date), $errors->has('date'), $errors->first('date')
          ) !!}

          {!! FormHelper::textbox(
             '6', 'person_to', 'text', 'To *', 'To', old('person_to') ? old('person_to') : $memo->person_to, $errors->has('person_to'), $errors->first('person_to'), ''
          ) !!} 

          <div class="col-md-12"></div>

          {!! FormHelper::textbox(
             '6', 'person_from', 'text', 'From *', 'From', old('person_from') ? old('person_from') : $memo->person_from, $errors->has('person_from'), $errors->first('person_from'), ''
          ) !!}

          {!! FormHelper::textbox(
             '6', 'type', 'text', 'Type *', 'Type', old('type') ? old('type') : $memo->type, $errors->has('type'), $errors->first('type'), ''
          ) !!} 
          
          {!! FormHelper::textbox(
             '6', 'subject', 'text', 'Subject *', 'Subject', old('subject') ? old('subject') : $memo->subject, $errors->has('subject'), $errors->first('subject'), ''
          ) !!} 

          {!! FormHelper::textbox(
             '6', 'remarks', 'text', 'Remarks', 'From', old('remarks') ? old('remarks') : $memo->remarks, $errors->has('remarks'), $errors->first('remarks'), ''
          ) !!}  

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

  </section>

@endsection