<?php


namespace App\Http\Controllers;


use App\Models\UserData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AjaxPostController extends Controller
{
    public function post($for){
        if($for == 'dtr_edit_intro'){
            $ud = new UserData;
            $ud->slug = Str::random();
            $ud->data = $for;
            $ud->user_id = Auth::user()->user_id;
            $ud->value = 1;
            $ud->save();
        }
    }
}