<?php

namespace App\Swep\ViewHelpers;


class FormHelper{



    public static function textbox_inline($key, $type, $label, $placeholder, $old_value, $error_has, $error_first){

       return '<div class="form-group '. self::error_response($error_has) .'">
                  <label for="'. $key .'" class="col-sm-2 control-label">'. $label .'</label>
                  <div class="col-sm-10">
                    <input class="form-control" name="'. $key .'" id="'. $key .'" type="'. $type .'" value="'. $old_value .'" placeholder="'. $placeholder .'">
                    '. self::error_message($error_has, $error_first) .'
                  </div>
                </div>';

    }



    public static function password_inline($key, $label, $placeholder, $error_has, $error_first){

       return '<div class="form-group '. self::error_response($error_has) .'">
                  <label for="'. $key .'" class="col-sm-2 control-label">'. $label .'</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="'. $key .'" id="'. $key .'" type="password" placeholder="'. $placeholder .'">
                    '. self::error_message($error_has, $error_first) .'
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



    public static function static_select_for_filter($class, $name, $old_value, $array,  $label, $form){
      
      $string = "'";

       return '<div class="form-group col-md-'. $class .'">
                <label for="'. $name .'">'. $label .'</label>
                <select name="'. $name .'" id="'. $name .'" class="form-control input-sm" onchange="document.getElementById('. $string .''. $form .''. $string .').click()">
                  <option value="">Select</option>
                  '. self::static_options($array, $old_value) .'
                </select>
              </div>';
                
    }




    /** UTILITY METHODS **/

    public static function error_response($error_has){

      return $error_has ? 'has-error' : '';

    }



    public static function error_message($error_has, $error_first){

      if($error_has){

        return '<span class="help-block"> '. $error_first .' </span>';

      }

    }



    public static function static_options($array, $old_value){

      $string = '';

      foreach($array as $item => $value){

        $condition = $value == $old_value ? 'selected' : '';

        $string .= '<option value="'. $value .'" '. $condition .'>'. $item .'</option>';

      }

      return $string;

    }




}