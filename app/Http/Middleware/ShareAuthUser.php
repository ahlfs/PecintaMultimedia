<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;

class ShareAuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('user_id')) {
            $user = User::find(session('user_id'));
            if ($user) {
                view()->share('authUser', $user);
            } else {
                session()->forget('user_id');
            }
        }
        return $next($request);
    }
}
