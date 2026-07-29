<?php

namespace App\Http\Middleware;

use App\Services\RouteTranslator;
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

        $this->shareAlternateUrls($request);   // <-- artık render'dan önce

        return $next($request);
    }

    protected function shareAlternateUrls(Request $request): void
    {
        $route = $request->route();
        if (!$route || !$route->getName()) {
            return;
        }

        $routeName = preg_replace('/^(tr|en|ar)\./', '', $route->getName());

        if (in_array($routeName, ['products.show', 'posts.show'])) {
            return;
        }

        $params = $route->parameters();

        $alternateUrls = [];
        foreach (['tr', 'en', 'ar'] as $locale) {
            $alternateUrls[$locale] = RouteTranslator::urlFor($routeName, $locale, $params);
        }

        view()->share('alternateUrls', $alternateUrls);
    }
}
