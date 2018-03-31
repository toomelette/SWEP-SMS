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



}