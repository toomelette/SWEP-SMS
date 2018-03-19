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
    



}