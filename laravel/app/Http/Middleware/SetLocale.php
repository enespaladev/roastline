<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route('locale', 'tr');

        if (in_array($locale, ['tr', 'en', 'ar'])) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
