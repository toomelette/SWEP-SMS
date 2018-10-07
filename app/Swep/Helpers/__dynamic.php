<?php

namespace App\Swep\Helpers;


use Carbon\Carbon;


class __dynamic{





    public static function months_between_dates($start, $end){

      $start = Carbon::parse($start);
      $end   = Carbon::parse($end);
      $months = [];

      while ($start->addMonth() <= $end){

        $months[$start->format('m-Y')] = $start->format('F Y');

      }

      return $months;

    }







}