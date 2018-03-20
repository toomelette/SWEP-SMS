@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Create User</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
      </div>
      
      <form class="form-horizontal" method="POST" action="{{ route('dashboard.user.store') }}">

        <div class="box-body">

          <div class="col-md-11">
                  
              @csrf    

              {!! FormHelper::textbox_inline(
                  'firstname', 'text', 'Firstname', 'Firstname', old('firstname'), $errors->has('firstname'), $errors->first('firstname')
              ) !!}

              {!! FormHelper::textbox_inline(
                  'middlename', 'text', 'Middlename', 'Middlename', old('middlename'), $errors->has('middlename'), $errors->first('middlename')
              ) !!}

              {!! FormHelper::textbox_inline(
                  'lastname', 'text', 'Lastname', 'Lastname', old('lastname'), $errors->has('lastname'), $errors->first('lastname')
              ) !!}

              {!! FormHelper::textbox_inline(
                  'email', 'email', 'Email', 'Email', old('email'), $errors->has('email'), $errors->first('email')
              ) !!}

              {!! FormHelper::textbox_inline(
                  'position', 'text', 'Position', 'Position / Plantilla', old('position'), $errors->has('position'), $errors->first('position')
              ) !!}

              {!! FormHelper::textbox_inline(
                  'username', 'text', 'Username', 'Username', old('username'), $errors->has('username'), $errors->first('username')
              ) !!}

              {!! FormHelper::password_inline(
                  'password', 'Password', 'Password', $errors->has('password'), $errors->first('password')
              ) !!}

              {!! FormHelper::password_inline(
                  'password_confirmation', 'Confirm Password', 'Confirm Password', '', ''
              ) !!}

          </div>


          <div class="col-md-12" style="padding-top:50px;">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">User Menu</h3>
                <button id="add_row" type="button" class="btn btn-sm bg-green pull-right"><i class="fa fa-plus"></i></button>
              </div>
              
              <div class="box-body">
                
                <table id="table_body" class="table table-bordered">

                  <tbody>

                    <tr>
                      <th>Menus</th>
                      <th>Submenus</th>
                      <th style="width: 40px"></th>
                    </tr>

                    <tr>
                      
                      <td style="min-width:80px; max-width:80px;">
                          
                        <select id="menu" class="form-control select2" style="width: 90%;">
                          <option>Select</option>
                          @foreach($menu_all as $data) 
                            <option value="{{ $data->menu_id }}">{{ $data->name }}</option>
                          @endforeach
                        </select>

                      </td>

                      <td style="min-width:100px; max-width:100px;">

                        <select id="submenu" class="form-control select2" multiple="multiple" data-placeholder="Select a Submenus" style="width: 90%;">
                          <option>Select</option>
                        </select>

                      </td>

                      <td>
                          <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                      </td>

                    </tr>

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

    {!! JSHelper::show_password('password', 'show_password') !!}
    {!! JSHelper::show_password('password_confirmation', 'show_password_confirmation') !!}


    /** ADD ROW **/
    $(document).ready(function() {
        $("#add_row").on("click", function() {
            $('select').select2('destroy');
            var content ='<tr>' +
                          '<td>' +
                            '<select id="menu" class="form-control select2" style="width: 90%;">' +
                              '<option>Select</option>' +
                              '@foreach($menu_all as $data)' +
                                '<option value="{{ $data->menu_id }}">{{ $data->name }}</option>' +
                              '@endforeach' +
                            '</select>' +
                          '</td>' +

                          '<td>' +
                            '<select id="submenu" class="form-control select2" multiple="multiple" data-placeholder="Select a Submenus" style="width: 90%;">' +
                              '<option>Select</option>' +
                            '</select>' +

                          '</td>' +

                          '<td>' +
                              '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                          '</td>' +
                        '</tr>';

        $("#table_body").append($(content));
        $('select').select2({width:400});
        });

     });


    /** DELETE ROW **/
    $(document).on("click","#delete_row" ,function(e) {
        $(this).closest('tr').remove();
    });


    /** AJAX **/
    $(document).ready(function() {
      $(document).on("change", "#menu", function() {
          var id = $(this).val();
          var parent = $(this).closest('tr');
          console.log(parent);
          if(id) {
              $.ajax({
                  url: "/api/dropdown_response_submenu_from_menu/" + id,
                  type: "GET",
                  dataType: "json",
                  success:function(data) {   

                      $(parent).find("#submenu").empty();

                      $.each(data, function(key, value) {
                          $(parent).find("#submenu").append("<option value='" + value.submenu_id + "'>"+ value.name +"</option>");
                      });

                      $(parent).find("#submenu").append("<option value>Select</option>");  
          
                  }
              });
          }else{
              $(parent).find("#submenu").empty();
          }
      });
    });
  </script>
    
    
@endsection