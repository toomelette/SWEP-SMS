@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Plantilla</h1>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.plantilla.store') }}">

        <div class="box-body">
     
          @csrf   

          {!! __form::select_dynamic(
            '3', 'department_unit_id', 'Unit *', old('department_unit_id'), $global_department_units_all, 'department_unit_id', 'description', $errors->has('department_unit_id'), $errors->first('department_unit_id'), 'select2', ''
          ) !!}


          {!! __form::textbox(
             '3', 'name', 'text', 'Name *', 'Name', old('name'), $errors->has('name'), $errors->first('name'), ''
          ) !!} 


          {!! __form::select_static(
            '3', 'is_vacant', 'Vacant *', old('is_vacant'), ['Yes' => 'true', 'No' => 'false'], $errors->has('is_vacant'), $errors->first('is_vacant'), '', ''
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

  @if(Session::has('PLANTILLA_CREATE_SUCCESS'))

    {!! __html::modal(
      'plantilla_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('PLANTILLA_CREATE_SUCCESS')
    ) !!}
    
  @endif

@endsection 




@section('scripts')

  <script type="text/javascript">

    @if(Session::has('PLANTILLA_CREATE_SUCCESS'))
      $('#plantilla_create').modal('show');
    @endif

  </script> 
    
@endsection