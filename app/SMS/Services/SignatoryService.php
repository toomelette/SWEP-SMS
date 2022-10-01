<?php


namespace App\SMS\Services;


class SignatoryService
{
    public function getSavedSignatoriesAsArray(){
        $signatories = \App\Models\SMS\Signatories::query()->where('mill_code','=',\Auth::user()->mill_code)->get();
        $signatoriesArr = [];

        foreach ( $signatories as $signatory){
            $signatoriesArr[$signatory->form][$signatory->for]['name'] = $signatory->name;
            $signatoriesArr[$signatory->form][$signatory->for]['position'] = $signatory->position;
        }
        return $signatoriesArr;
    }
}