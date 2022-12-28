<?php


namespace App\Swep\Helpers;


use App\Models\Applicant;
use App\Models\ApplicantPositionApplied;
use App\Models\HRPayPlanitilla;
use App\Models\SMS\CropYears;
use App\Models\SMS\SugarClass;
use App\Models\SMS\SugarMills;

class Arrays
{

    public static function cropYears($includeEmptySelect = false){
        $cys = CropYears::query()->orderBy('date_start','asc')->get();
        $arr = [];
        if($includeEmptySelect == true){
            $arr['ALL'] = 'ALL';
        }
        if(!empty($cys)){
            foreach ($cys as $cy){
                $arr[$cy->name] = $cy->name;
            }
        }
        return $arr;
    }

    public static function millCodes($includeEmptySelect = false){
        $suagrMills = SugarMills::query()->orderBy('slug','asc')->get();
        $arr = [];
        if($includeEmptySelect == true){
            $arr['ALL'] = 'ALL';
        }
        if(!empty($suagrMills)){
            foreach ($suagrMills as $suagrMill){
                $arr[$suagrMill->slug] = $suagrMill->slug;
            }
        }
        return $arr;
    }

    public static function sugarClasses(){
        $scs = SugarClass::query()->whereNull('swapping')->get();
        $scsArr = [];
        foreach ($scs as $sc){
            $scsArr[$sc->sugar_class] = $sc->sugar_class;
        }
        return $scsArr;
    }

    public static function sugarTypes(){
        return [
            'RAW' => 'RAW',
            'REFINED' => 'REFINED',
        ];
    }

    public static function sugarClassesForSwapping(){
        $scs = SugarClass::query()->whereNotNull('swapping')->get();
        $scsArr = [];
        foreach ($scs as $sc){
            $scsArr[$sc->swapping] = $sc->swapping;
        }
        return $scsArr;
    }


    public static function sex(){
        return [
            'MALE' => 'MALE',
            'FEMALE' => 'FEMALE',
        ];
    }

    public static function civil_status(){
        return [
            'SINGLE' => 'SINGLE',
            'MARRIED' => 'MARRIED',
            'WIDOWED' => 'WIDOWED',
            'DIVORCED' => 'DIVORCED',
            'SEPARATED' => 'SEPARATED',
        ];
    }


    public static function payPlantillas(){
        $array = ['1'=>2];
        $pps = HRPayPlanitilla::query()->select('item_no','position')->get();
        if(!empty($pps)){
            foreach ($pps as $pp){
                $array[$pp->item_no] = $pp->position;
            }
        }
        return $array;
    }

    public static function fonts(){
        $a = [
            'Arial' => 'Arial',
            'Cambria'=> 'Cambria',
            'Calibri' => 'Calibri (default)',
            'Verdana' => 'Verdana',
            'Futura' => 'Futura',
            'Times New Roman' => 'Times New Roman',
            'Garamond' => 'Garamond',
            'Rockwell' => 'Rockwell',
            'Franklin Gothic'=> 'Franklin Gothic',

        ];
        ksort($a);
        return $a;
    }
    public static function fontSizes(){
        return [
            '8px' => '8px',
            '9px' => '9px',
            '10px' => '10px',
            '11px' => '11px',
            '12px' => '12px',
            '13px' => '13px',
            '14px' => '14px',
            '15px' => '15px',
            '16px' => '16px',
            '17px' => '17px',
        ];
    }

    public static function subsidiaryItems(){
        return [
            'carryOver' => 'Carry Over',
            'receipts' => 'Receipts',
            'withdrawals' => 'Withdrawals',
        ];
    }

    public static function userTypes(){
        return [
            'ENCODER' => 'ENCODER',
            'APPROVER' => 'APPROVER',
            'VIEWER' => 'VIEWER',
        ];
    }

}