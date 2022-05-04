<?php

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Closure;
use Illuminate\Http\Request;

class getPortal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard()->check()){
//            $portal = $request->portal;
//            $user = User::query()->where('user_id','=',Auth::user()->user_id)->first();
//            $user->portal = $portal;
//            $user->update();
            return $next($request);
        }
        return redirect('/');
    }
}
