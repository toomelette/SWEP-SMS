<?php

namespace App\Swep\ViewHelpers;


class FormHelper{


    public static function textbox_inline($key, $type, $label, $placeholder, $old_value, $error_has, $error_first){

       return '<div class="form-group '. self::errorResponse($error_has) .'">
                  <label for="'. $key .'" class="col-sm-2 control-label">'. $label .'</label>
                  <div class="col-sm-10">
                    <input class="form-control" name="'. $key .'" id="'. $key .'" type="'. $type .'" value="'. $old_value .'" placeholder="'. $placeholder .'">
                    '. self::errorMessage($error_has, $error_first) .'
                  </div>
                </div>';

    }




    public static function password_inline($key, $label, $placeholder, $error_has, $error_first){

       return '<div class="form-group '. self::errorResponse($error_has) .'">
                  <label for="'. $key .'" class="col-sm-2 control-label">'. $label .'</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="'. $key .'" id="'. $key .'" type="password" placeholder="'. $placeholder .'">
                    '. self::errorMessage($error_has, $error_first) .'
                  </div>
                  <div class="col-sm-2">
                    <div class="checkbox">
                        <label>
                            <input name="show_'. $key .'" id="show_'. $key .'" type="checkbox">Show
                        </label>
                    </div>
                  </div>
                </div>';
                
    }




    public static function errorResponse($error_has){

    	return $error_has ? 'has-error' : '';

    }




    public static function errorMessage($error_has, $error_first){

    	if($error_has){

    		return '<span class="help-block"> '. $error_first .' </span>';

    	}

	}
    



}