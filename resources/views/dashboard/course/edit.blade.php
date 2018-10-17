@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Course</h1>
      <div class="pull-right" style="margin-top: -25px;">
        {!! __html::back_button(['dashboard.course.index']) !!}
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
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.course.update', $course->slug) }}">

        <div class="box-body">
     
          @csrf   
            
          <input name="_method" value="PUT" type="hidden">

          {!! __form::textbox(
             '3', 'name', 'text', 'Name *', 'Name', old('name') ? old('name') : $course->name, $errors->has('name'), $errors->first('name'), ''
          ) !!} 
 

          {!! __form::textbox(
             '3', 'acronym', 'text', 'Acronym', 'Acronym', old('acronym') ? old('acronym') : $course->acronym, $errors->has('acronym'), $errors->first('acronym'), ''
          ) !!} 

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

  </section>

@endsection