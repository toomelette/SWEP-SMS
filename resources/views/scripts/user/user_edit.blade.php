 <script type="text/javascript">    

    /** ADD ROW **/
    $(document).ready(function() {
        $("#add_row").on("click", function() {
            $('select').select2('destroy');
            var content ='<tr>' +
                          '<td style="width:450px;">' +
                            '<select name="menu[]" id="menu" class="form-control select2" style="width:90%;">' +
                              '<option value="">Select</option>' +
                              '@foreach($menu_all as $data)' +
                                '<option value="{{ $data->menu_id }}">{{ $data->name }}</option>' +
                              '@endforeach' +
                            '</select>' +
                          '</td>' +

                          '<td>' +
                            '<select name="submenu[]" id="submenu" class="form-control select2" multiple="multiple" data-placeholder="Modules" style="width:80%;">' +
                              '<option value="">Select</option>' +
                              '@foreach($submenu_all as $data)' +
                                  '<option value="{{ $data->submenu_id }}">{{$data->name}}</option>' +
                              '@endforeach' +
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