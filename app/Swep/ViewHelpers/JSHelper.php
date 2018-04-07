<?php

namespace App\Swep\ViewHelpers;



class JSHelper{



    public static function show_password($textbox_id, $checkbox_id){

       return '$(document).ready(function(){
					$("#'. $checkbox_id .'").on("change",function(){
						var is_checked = $(this).prop("checked");
						if (is_checked) {
							$("#'. $textbox_id .'").attr("type","text");
						} else {
							$("#'. $textbox_id .'").attr("type","Password");
						}
					});
				});';

    }




    public static function toast($message){

       return '$.toast({
	            text: "'. $message .'",
	            showHideTransition: "fade",
	            allowToastClose: true,
	            hideAfter: 7500,
	            loader: false,
	            position: "top-center",
	            bgColor: "#444",
	            textColor: "#eee",
	            textAlign: "left",
	          });';

    }
    



    public static function form_submitter_via_action($data_action, $form){

       return '$(document).on("change", "#action", function () {
       				var element = $(this).children("option:selected");
       				if(element.data("action") == "'. $data_action .'"){
		            	$("#'. $form .'").attr("action", element.data("url"));
		            	$("#'. $form .'").submit();
		        	}
		        });';

    }




    public static function modal_confirm_delete_caller($modal){

       return '$(document).on("change", "#action", function () {
			      var element = $(this).children("option:selected");
			      if(element.data("action") == "delete"){
			        $("#'. $modal .'").modal("show");
			        $("#delete_body #form").attr("action", element.data("url"));
			        $("#action").val("");
			      }
			    });';

    }




    public static function table_action_rule(){

       return '$(document).on("change", "#action", function () {
       			  var element = $(this).children("option:selected");
	           	  if(element.data("type") == "1" ){ 
	           	  	location = element.data("url");
	           	  }
		       });';

    }



    public static function ajax_select_to_select($id_from, $id_to, $route, $key, $value){

      $string = "'";

      return '$(document).ready(function() {
			        $("#'. $id_from .'").on("change", function() {
			            var key = $(this).val();
			            if(key) {
			                $.ajax({
			                    url: "'. $route .'"+key,
			                    type: "GET",
			                    dataType: "json",
			                    success:function(data) {       
			                      
			                        $("#'. $id_to .'").empty();

		                        	$.each(data, function(key, value) {
	                        			$("#'. $id_to .'").append("<option value='. $string .'"+ value.'. $key .' +"'. $string .'>"+ value.'.$value.' +"</option>");
	                        		});

		                        	$("#'. $id_to .'").append("<option value>Select</option>");  
			            
			                    }
			                });
			            }else{
			            	$("#'. $id_to .'").empty();
			            }
			        });
			    });';

    }



    public static function input_uppercase($id){

       return '$(function() {
				    $("'. $id .'").keyup(function() {
				        this.value = this.value.toLocaleUpperCase();
				    });
				});';
				
    }




    public static function print_div($button, $div){

      $string = "'";

      return '<script>
		    	$("#'.$button.'").on("click", function () {
		            var divContents = $("#'.$div.'").html();
		            var printWindow = window.open("", "", "height=800,width=1000");
		            printWindow.document.write("<html><head><title></title>");
		            printWindow.document.write('.$string.'<link type="text/css" rel="stylesheet" href="http://'.$_SERVER['HTTP_HOST'].'/template/bower_components/bootstrap/dist/css/bootstrap.min.css">'.$string.');
		            printWindow.document.write('.$string.'<link type="text/css" rel="stylesheet" href="http://'.$_SERVER['HTTP_HOST'].'/template/bower_components/font-awesome/css/font-awesome.min.css">'.$string.');
		            printWindow.document.write('.$string.'<link type="text/css" rel="stylesheet" href="http://'.$_SERVER['HTTP_HOST'].'/template/dist/css/AdminLTE.min.css">'.$string.');
		            printWindow.document.write("</head><body>");
		            printWindow.document.write(divContents);
		            printWindow.document.write("</body></html>");
		            printWindow.document.close();
		            setInterval(function () { 
		      			printWindow.print();
		      			printWindow.close();
		    		}, 1000);
		    	});
			</script>';

    }





}