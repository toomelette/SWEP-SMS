@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Update Fund Source</h1>
      <div class="pull-right" style="margin-top: -25px;">
        {!! HtmlHelper::back_button(['dashboard.fund_source.index']) !!}
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
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.fund_source.update', $fund_source->slug) }}">

        <div class="box-body">
          
          <input name="_method" value="PUT" type="hidden">
          
          @csrf    

          {!! FormHelper::textbox(
             '4', 'description', 'text', 'Description *', 'Description', old('description') ? old('description') : $fund_source->description, $errors->has('description'), $errors->first('description'), ''
          ) !!} 

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

  </section>

@endsection
