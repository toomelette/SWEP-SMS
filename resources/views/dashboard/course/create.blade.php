@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Course</h1>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.course.store') }}">

        <div class="box-body">
     
          @csrf   

          {!! __form::textbox(
             '3', 'name', 'text', 'Name *', 'Name', old('name'), $errors->has('name'), $errors->first('name'), ''
          ) !!} 
 

          {!! __form::textbox(
             '3', 'acronym', 'text', 'Acronym', 'Acronym', old('acronym'), $errors->has('acronym'), $errors->first('acronym'), ''
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

  @if(Session::has('COURSE_CREATE_SUCCESS'))

    {!! __html::modal(
      'course_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('COURSE_CREATE_SUCCESS')
    ) !!}
    
  @endif

@endsection 




@section('scripts')

  <script type="text/javascript">

    @if(Session::has('COURSE_CREATE_SUCCESS'))
      $('#course_create').modal('show');
    @endif

  </script> 
    
@endsection