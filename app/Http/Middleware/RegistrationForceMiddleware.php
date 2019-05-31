<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class RegistrationForceMiddleware {
    public function handle($request, Closure $next) {

        if (! Cookie::get('new_user')) {
            return redirect()->route('create.alert');
        }

        return $next($request);
    }
}