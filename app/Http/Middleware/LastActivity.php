<?php


namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Auth;

class LastActivity
{

    public function __construct()
    {
        $this->auth = auth();
    }

    public function handle($request, Closure $next)
    {
        if ($this->auth->guard()->check() && $this->auth->user()->last_activity < Carbon::now()->subMinutes(5)->format('Y-m-d H:i:s')) {
            $user = $this->auth->user();
            $user->last_activity = Carbon::now();
            $user->timestamps = false;
            $user->save();
        }

        return $next($request);
    }
}