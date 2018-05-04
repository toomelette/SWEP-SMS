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


          {{-- USER MENU DYNAMIC TABLE GRID --}}
          <div class="col-md-12" style="padding-top:50px;">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Submenu</h3>
                <button id="add_row" type="button" class="btn btn-sm bg-green pull-right"><i class="fa fa-plus"></i></button>
              </div>
              
              <div class="box-body no-padding">
                
                <table class="table table-bordered">

                  <tr>
                    <th>Name</th>
                    <th>Route</th>
                    <th>Is Nav</th>
                    <th style="width: 40px"></th>
                  </tr>

                  <tbody id="table_body">


                    @if(old('row'))

                      @foreach(old('row') as $key => $value)

                        <tr>

                          <td>
                            <div class="form-group">
                              <input type="text" name="row[{{ $key }}][sub_name]" class="form-control" placeholder="Name" value="{{ $value['sub_name'] }}">
                              <small class="text-danger">{{ $errors->first('row.'. $key .'.sub_name') }}</small>
                            </div>
                          </td>


                          <td>
                            <div class="form-group">
                              <input type="text" name="row[{{ $key }}][sub_route]" class="form-control" placeholder="Route" value="{{ $value['sub_route'] }}">
                              <small class="text-danger">{{ $errors->first('row.'. $key .'.sub_route') }}</small>
                            </div>
                          </td>


                          <td>
                            <div class="form-group">
                              <select name="row[{{ $key }}][sub_is_nav]" class="form-control">
                                <option value="">Select</option>
                                  <option value="true" {!! $value['sub_is_nav'] == "true" ? 'selected' : '' !!}>1</option>
                                  <option value="false" {!! $value['sub_is_nav'] == "false" ? 'selected' : '' !!}>0</option>
                              </select>
                              <small class="text-danger">{{ $errors->first('row.'. $key .'.sub_is_nav') }}</small>
                            </div>
                          </td>


                          <td>
                              <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                          </td>

                        </tr>

                      @endforeach

                    @else

                      @foreach($menu->submenu as $key => $data)

                        <tr>

                          <td>
                            <div class="form-group">
                              <input type="text" name="row[{{ $key }}][sub_name]" class="form-control" placeholder="Name" value="{{ $data->name }}">
                            </div>
                          </td>


                          <td>
                            <div class="form-group">
                              <input type="text" name="row[{{ $key }}][sub_route]" class="form-control" placeholder="Route" value="{{ $data->route }}">
                            </div>
                          </td>


                          <td>
                            <div class="form-group">
                              <select name="row[{{ $key }}][sub_is_nav]" class="form-control">
                                <option value="">Select</option>
                                  <option value="true" {{ $data->is_nav == true ? 'selected' : '' }}>1</option>
                                  <option value="false" {{ $data->is_nav == false ? 'selected' : '' }}>0</option>
                              </select>
                            </div>
                          </td>


                          <td>
                              <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                          </td>

                        </tr>

                      @endforeach

                    @endif

                    </tbody>
                </table>
               
              </div>

            </div>
          </div>

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save</button>
        </div>

      </form>

    </div>

</section>

@endsection




@section('scripts')

  <script type="text/javascript">


  {{-- ADD ROW --}}

  $(document).ready(function() {
    $("#add_row").on("click", function() {
      var i = $("#table_body").children().length;
      var content ='<tr>' +
                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row[' + i + '][sub_name]" class="form-control" placeholder="Name">' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row[' + i + '][sub_route]" class="form-control" placeholder="Route">' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                        '<div class="form-group">' +
                          '<select name="row[' + i + '][sub_is_nav]" class="form-control">' +
                            '<option value="">Select</option>' +
                            '<option value="true">1</option>' +
                            '<option value="false">0</option>' +
                          '</select>' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                          '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';
      $("#table_body").append($(content));
    });
  });



  {{-- DELETE ROW --}}

  $(document).on("click","#delete_row" ,function(e) {
      $(this).closest('tr').remove();
  });


  </script>
    
@endsection