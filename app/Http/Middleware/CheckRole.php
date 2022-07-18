<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
//use RealRashid\SweetAlert\Facades\Alert;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
//        dd($request->user()->role, $roles);
        if (in_array($request->user()->role,$roles)){

            return $next($request);
        }
//        Alert::toast('Maaf anda tidak memiliki akses', 'error');
        return redirect()->back();
    }
}
