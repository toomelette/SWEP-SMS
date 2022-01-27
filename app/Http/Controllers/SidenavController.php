<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SidenavController extends Controller
{

    public function change(Request $request){
        $user = Auth::user();
        $user->sidenav = $request->selected;
        if($user->update()){
            return 1;
        }
        abort(503,'Error Saving Data');
    }
}