<?php

namespace App\Http\Middleware;

use Closure;

class CheckProjectId
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
        if(!($request->ajax() || $request->query('project_id'))){
            return \redirect('/admin');
        }
        return $next($request);
    }
}
