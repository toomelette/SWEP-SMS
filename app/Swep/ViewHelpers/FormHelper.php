<?php

namespace App\Swep\ViewHelpers;

use App\Swep\Helpers\SanitizeHelper;



class FormHelper{



    /** Default **/

    public static function textbox($class, $key, $type, $label, $placeholder, $old_value, $error_has, $error_first, $extra_attr){

       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <input class="form-control" id="'. $key .'" name="'. $key .'" type="'. $type .'" value="'. SanitizeHelper::html_attribute_encode($old_value) .'" placeholder="'. $placeholder .'" '. $extra_attr .'>
                '. self::error_message($error_has, $error_first) .'
              </div>';

    }



    public static function textbox_numeric($class, $key, $type, $label, $placeholder, $old_value, $error_has, $error_first, $extra_attr){

       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <input class="form-control priceformat" id="'. $key .'" name="'. $key .'" type="'. $type .'" value="'. SanitizeHelper::html_attribute_encode($old_value) .'" placeholder="'. $placeholder .'" '. $extra_attr .'>
                  '. self::error_message($error_has, $error_first) .'
              </div>';

    }



    public static function select_dynamic($class, $key, $label, $old_value, $array, $var1, $var2, $error_has, $error_first, $select2, $extra_attr){
      
       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <select name="'. $key .'" id="'. $key .'" class="form-control '. $select2 .'" '. $extra_attr .'>
                  <option value="">Select</option>
                  '. self::dynamic_options($array, $var1, $var2, $old_value) .'
                </select>
                '. self::error_message($error_has, $error_first) .'
              </div>';
                
    }



    public static function select_static($class, $key, $label, $old_value, $array, $error_has, $error_first, $select2, $extra_attr){
      
       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <select name="'. $key .'" id="'. $key .'" class="form-control '. $select2 .'" '. $extra_attr .'>
                  <option value="">Select</option>
                  '. self::static_options($array, $old_value) .'
                </select>
                '. self::error_message($error_has, $error_first) .'
              </div>';
                
    }



    public static function textarea($class, $key, $label, $old_value, $error_has, $error_first, $extra_attr){

       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <textarea id="editor" name="'. $key .'" rows="10" cols="80" '. $extra_attr .'>'. SanitizeHelper::html_encode($old_value) .'</textarea>
                '. self::error_message($error_has, $error_first) .'
              </div>';

    }



    public static function datepicker($class, $key, $label, $old_value, $error_has, $error_first){

       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'" style="overflow:hidden;">
                <label for="'. $key .'">'. $label .'</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input id="'. $key .'" name="'. $key .'" value="'. SanitizeHelper::html_attribute_encode($old_value) .'" type="text" class="form-control" placeholder="mm/dd/yy">
                </div>
                '. self::error_message($error_has, $error_first) .'
              </div>';

    }



    /** Inlines **/

    public static function textbox_inline($key, $type, $label, $placeholder, $old_value, $error_has, $error_first, $extra_attr){

       return '<div class="form-group '. self::error_response($error_has) .'">
                  <label for="'. $key .'" class="col-sm-2 control-label">'. $label .'</label>
                  <div class="col-sm-10">
                    <input class="form-control" name="'. $key .'" id="'. $key .'" type="'. $type .'" value="'. SanitizeHelper::html_attribute_encode($old_value) .'" placeholder="'. $placeholder .'" '. $extra_attr .'>
                    '. self::error_message($error_has, $error_first) .'
                  </div>
                </div>';

    }



    public static function password_inline($key, $label, $placeholder, $error_has, $error_first, $extra_attr){

       return '<div class="form-group '. self::error_response($error_has) .'">
                  <label for="'. $key .'" class="col-sm-2 control-label">'. $label .'</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="'. $key .'" id="'. $key .'" type="password" placeholder="'. $placeholder .'" '. $extra_attr .'>
                    '. self::error_message($error_has, $error_first) .'
                  </div>
                  <div class="col-sm-2">
                    <div class="checkbox">
                        <label>
                            <input name="show_'. $key .'" id="show_'. $key .'" type="checkbox"> Show
                        </label>
                    </div>
                  </div>
                </div>';
                
    }




    /** For Filters **/


    public static function select_static_for_filter($class, $key, $label, $old_value, $array, $form, $select2){
      
      $string = "'";

       return '<div class="form-group col-md-'. $class .'">
                <label for="'. $key .'">'. $label .'</label>
                <select name="'. $key .'" id="'. $key .'" class="form-control input-sm '. $select2 .'" onchange="document.getElementById('. $string .''. $form .''. $string .').click()">
                  <option value="">Select</option>
                  '. self::static_options($array, $old_value) .'
                </select>
              </div>';
                
    }




    public static function select_dynamic_for_filter($class, $key, $label, $old_value, $array, $var1, $var2, $form, $select2){
      
      $string = "'";

       return '<div class="form-group col-md-'. $class .'">
                <label for="'. $key .'">'. $label .'</label>
                <select name="'. $key .'" id="'. $key .'" class="form-control input-sm '. $select2 .'" onchange="document.getElementById('. $string .''. $form .''. $string .').click()">
                  <option value="">Select</option>
                  '. self::dynamic_options($array, $var1, $var2, $old_value) .'
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



    public static function dynamic_options($array, $var1, $var2, $old_value){

      $string = '';

      foreach($array as $value){

        $condition = $value->$var1 == $old_value ? 'selected' : '';
        
        $string .= '<option value="'. $value->$var1 .'" '. $condition .'>'. $value->$var2 .'</option>';

      }

      return $string;

    }




}