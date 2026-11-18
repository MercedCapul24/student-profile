<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PreventDuplicateSubmit
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('post') && $request->filled('submit_token')) {
            $key = 'submit_token:' . $request->input('submit_token');

            // Cache::add only works once per token, so a second copy is ignored
            if (! Cache::add($key, true, now()->addMinutes(10))) {
                return redirect()->back();
            }
        }

        return $next($request);
    }
}