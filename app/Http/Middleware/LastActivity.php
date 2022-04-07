<?php


namespace App\Http\Middleware;

use App\Swep\Helpers\Helper;
use Carbon\Carbon;
use Closure;
use Auth;
use Illuminate\Support\Facades\Request;

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
            $user->last_login_ip = Request::ip();
            $user->timestamps = false;
            $user->last_activity_machine = Helper::deviceInfo()->platform .' | '.Helper::deviceInfo()->browser;
            $user->save();
        }

        return $next($request);

    }
}