<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckEdit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private static $editName = "edit";

    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        if (!(Auth::user()->name == CheckEdit::$editName)) {
            return redirect('/access-denied');
        }

        return $next($request);
    }
}
