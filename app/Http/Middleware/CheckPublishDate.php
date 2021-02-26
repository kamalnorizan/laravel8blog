<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \Carbon\Carbon;
class CheckPublishDate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd($request->published_at);
        if($request->published_at < Carbon::parse()->format('Y-m-d')){
            flash('Cannot post backdated content')->success()->important();
            return back();
        }
        return $next($request);
    }
}
