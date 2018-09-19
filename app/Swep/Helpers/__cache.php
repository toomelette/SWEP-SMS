<?php

namespace App\Swep\Helpers;

use Cache;


class __cache{



    public static function deletePattern($key){

       $redis = Cache::getRedis();

         $keys = $redis->keys($key);

         foreach($keys as $key){

             $redis->del($key);

         }

    }
    



}