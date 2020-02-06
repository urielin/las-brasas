<?php

namespace App\Http\Middleware;
use Closure;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticatedRedirect
{

    public function handle($request, Closure $next)
    {
      if (!$request->session()->exists('user')) {
        return redirect()->route('login');
      }
      return $next($request);
    }

}
