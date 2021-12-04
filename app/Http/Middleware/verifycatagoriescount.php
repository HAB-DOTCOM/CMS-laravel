<?php

namespace App\Http\Middleware;

use Closure;
use App\catagory;

class verifycatagoriescount
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
        if(catagory::all()->count()==0)
        {
            session()->flash('error','you have to create catagory in order to create your post');
            return redirect(route('catagories.create'));
        }
        return $next($request);
    }
}
