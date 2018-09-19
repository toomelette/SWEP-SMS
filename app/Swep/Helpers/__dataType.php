<?php

namespace App\Swep\Helpers;

use Carbon\Carbon;


class __dataType{




    public static function string_to_boolean($value){

       if($value == 'true'){ return true; }
       elseif($value == 'false'){ return false; }

    }
    





    public static function boolean_to_string($value){

       if($value == true){ return 'true'; }
       elseif($value == false){ return 'false'; }

    }




    public static function date_parse($value, $format = 'm/d/Y'){

        return $value != null ? Carbon::parse($value)->format($format) : null;

    }




    public static function time_parse($value, $format = 'H:i:s'){

        return $value != null ? date($format, strtotime($value)) : null;

    }





    public static function string_to_num($value){

        return  $value == null ? null : str_replace(',', '', $value);

    }





    public static function construct_time_HM($hrs, $mins){

        while ($mins >= 60) {
          
          $hrs = $hrs + 1;
          $mins = $mins - 60;

        }    

        return sprintf("%02d", $hrs) .':'. sprintf("%02d", $mins);

    }





}