<?php


namespace App\Swep\Helpers;


use App\Models\PPU\PPURespCodes;
use Illuminate\Support\Facades\Auth;

class PPUHelpers
{
    public static function respCentersArray(){
        $arr = [];
        $rc_codes = PPURespCodes::query()->with('description');
        if(Auth::user()->employee->resp_center != null || Auth::user()->employee->resp_center != ''){
            $rc_codes = $rc_codes->where('rc','=' , Auth::user()->employee->resp_center);
        }
        $rc_codes = $rc_codes->get();
        foreach ($rc_codes as $rc_code){
            $arr[$rc_code->description->name][$rc_code->desc]= $rc_code->rc_code;
        }

        return $arr;
    }
}