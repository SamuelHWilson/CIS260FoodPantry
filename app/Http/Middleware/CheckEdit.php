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
    private static $editID = 5;

    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        if (!(Auth::user()->id == CheckEdit::$editID)) {
            return redirect('/testing/not-edit');
        }

        return $next($request);
    }
}
