<?php

namespace App\Swep\Helpers;

use Carbon\Carbon;


class DataTypeHelper{




    public static function string_to_boolean($value){

       if($value == 'true'){ return true; }
       elseif($value == 'false'){ return false; }

    }
    





    public static function boolean_to_string($value){

       if($value == true){ return 'true'; }
       elseif($value == false){ return 'false'; }

    }






    public static function date_in($value){

        return $value != null ? Carbon::parse($value)->format('Y-m-d') : null;

    }





    public static function date_out($value, $format = 'm/d/Y'){

        return $value != null ? Carbon::parse($value)->format($format) : null;

    }





    public static function string_to_num($value){

        return  $value == null ? null : str_replace(',', '', $value);

    }





}