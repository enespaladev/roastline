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
        $params = $route->parameters();

        $alternateUrls = [];

        if ($routeName === 'products.show') {
            $product = \App\Models\Product::where('slug', $params['slug'] ?? null)
                ->where('is_active', true)
                ->first();

            if (!$product) {
                return;
            }

            foreach (['tr', 'en', 'ar'] as $locale) {
                $prefix = RouteTranslator::slug('products', $locale);
                $alternateUrls[$locale] = url($locale . '/' . $prefix . '/' . $product->getTranslation('slug', $locale));
            }
        } elseif ($routeName === 'posts.show') {
            $post = \App\Models\Post::where('slug', $params['slug'] ?? null)
                ->where('is_active', true)
                ->first();

            if (!$post) {
                return;
            }

            foreach (['tr', 'en', 'ar'] as $locale) {
                $prefix = RouteTranslator::slug('posts', $locale);
                $alternateUrls[$locale] = url($locale . '/' . $prefix . '/' . $post->getTranslation('slug', $locale));
            }
        } else {
            foreach (['tr', 'en', 'ar'] as $locale) {
                $alternateUrls[$locale] = RouteTranslator::urlFor($routeName, $locale, $params);
            }
        }

        view()->share('alternateUrls', $alternateUrls);
    }
}
