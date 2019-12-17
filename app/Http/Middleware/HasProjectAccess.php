<?php

namespace App\Http\Middleware;

use App\Models\Investor;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class HasProjectAccess
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
        if(Auth::check()){
            $project_id = Request::query('project_id', null);
            if(Auth::user()->hasRole('Investor') && !empty($project_id)){
                Investor::where(['user_id'=> Auth::id(), 'project_id'=>$project_id])->firstOrFail();
            }

        }
        return $next($request);
    }
}
