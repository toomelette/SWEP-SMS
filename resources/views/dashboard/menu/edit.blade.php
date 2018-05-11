  @extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Edit Menu</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! HtmlHelper::back_button(['dashboard.menu.index']) !!}
    </div>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.menu.update', $menu->slug) }}">

        <div class="box-body">

          @if(Session::has('USER_FORM_FAIL_USERNAME_EXIST'))
            {!! HtmlHelper::alert('danger', '<i class="icon fa fa-ban"></i> Alert!', Session::get('USER_FORM_FAIL_USERNAME_EXIST')) !!}
          @endif

          <div class="col-md-11">
            
            <input name="_method" value="PUT" type="hidden">
            
            @csrf    

            {!! FormHelper::textbox(
              '4', 'name', 'text', 'Name:', 'Name', old('name') ? old('name') : $menu->name, $errors->has('name'), $errors->first('name'), ''
            ) !!}

            {!! FormHelper::textbox(
              '4', 'route', 'text', 'Route:', 'Route', old('route') ? old('route') : $menu->route, $errors->has('route'), $errors->first('route'), ''
            ) !!}

            {!! FormHelper::textbox(
              '4', 'icon', 'text', 'Icon:', 'Icon', old('icon') ? old('icon') : $menu->icon, $errors->has('icon'), $errors->first('icon'), ''
            ) !!}

            {!! FormHelper::select_static(
              '4', 'is_menu', 'Is Menu', old('is_menu') ? old('is_menu') : DataTypeHelper::boolean_to_string($menu->is_menu), ['1' => 'true', '0' => 'false'], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
            ) !!}
            
            {!! FormHelper::select_static(
              '4', 'is_dropdown', 'Is Dropdown', old('is_dropdown') ? old('is_dropdown') : DataTypeHelper::boolean_to_string($menu->is_dropdown), ['1' => 'true', '0' => 'false'], $errors->has('is_dropdown'), $errors->first('is_dropdown'), '', ''
            ) !!}

          </div>

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save</button>
        </div>

      </form>

    </div>

</section>

@endsection

