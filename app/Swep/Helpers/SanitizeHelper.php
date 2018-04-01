<?php

namespace App\Swep\Helpers;


class SanitizeHelper {



  	public static function stringOutputSanitize( $string = null ) {

          $string = strip_tags($string);
          $string = htmlspecialchars($string);
          return $string;

    }



}