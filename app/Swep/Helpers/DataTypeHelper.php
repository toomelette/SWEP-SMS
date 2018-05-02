<?php

namespace App\Swep\Helpers;

use Cache;


class DataTypeHelper{



    public static function boolean($value){

       if($value == 'true'){

            return true;

        }elseif($value == 'false'){

            return false;

        }

    }
    



}