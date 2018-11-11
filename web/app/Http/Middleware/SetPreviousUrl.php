<?php

namespace App\Http\Middleware;

use Closure;

class SetPreviousUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->method() === 'GET' && $request->route() && (! $request->ajax() || $request->pjax())) {
            session()->setPreviousUrl($request->fullUrl());
        }
        return $next($request);
    }
}
