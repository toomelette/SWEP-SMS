@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Department</h1>
      <div class="pull-right" style="margin-top: -25px;">
        {!! __html::back_button(['dashboard.department.index']) !!}
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
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.department.update', $department->slug) }}">

        <div class="box-body">
            
          <input name="_method" value="PUT" type="hidden">

          @csrf    

          {!! __form::textbox(
             '4', 'name', 'text', 'Name *', 'Name', old('name') ? old('name') : $department->name , $errors->has('name'), $errors->first('name'), ''
          ) !!} 

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

  </section>

@endsection
