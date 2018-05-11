@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Submenu</h1>
      <div class="pull-right" style="margin-top: -25px;">
        {!! HtmlHelper::back_button(['dashboard.submenu.index']) !!}
      </div>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.submenu.update', $submenu->slug) }}">

        <div class="box-body">
            
          <input name="_method" value="PUT" type="hidden">

          @csrf    

          {!! FormHelper::textbox(
             '4', 'name', 'text', 'Name:', 'Name', old('name') ? old('name') : $submenu->name , $errors->has('name'), $errors->first('name'), ''
          ) !!}

          {!! FormHelper::textbox(
             '4', 'route', 'text', 'Route:', 'Route', old('route') ? old('route') : $submenu->route , $errors->has('route'), $errors->first('route'), ''
          ) !!}

          {!! FormHelper::select_static(
            '4', 'is_nav', 'Is nav', old('is_nav') ? old('is_nav') : DataTypeHelper::boolean_to_string($submenu->is_nav), ['1' => 'true', '0' => 'false'], $errors->has('is_nav'), $errors->first('is_nav'), '', ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save</button>
        </div>

      </form>

    </div>

  </section>

@endsection


@section('modals')

  @if(Session::has('DEPARTMENT_CREATE_SUCCESS'))
    {!! HtmlHelper::modal('department_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('DEPARTMENT_CREATE_SUCCESS')) !!}
  @endif

@endsection 


@section('scripts')

  <script type="text/javascript">

    @if(Session::has('DEPARTMENT_CREATE_SUCCESS'))
      $('#department_create').modal('show');
    @endif

  </script> 
    
@endsection