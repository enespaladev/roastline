<?php

namespace App\Services;

class RouteTranslator
{
    protected static array $map;

    public static function map(): array
    {
        return static::$map ??= config('route-translations');
    }

    public static function slug(string $key, string $locale): ?string
    {
        return static::map()[$key][$locale] ?? null;
    }

    public static function urlFor(string $routeName, string $locale): string
    {
        return match ($routeName) {
            'home' => url($locale),
            'about', 'videos' => url($locale . '/' . static::slug($routeName, $locale)),
            'products.index' => url($locale . '/' . static::slug('products', $locale)),
            'posts.index' => url($locale . '/' . static::slug('posts', $locale)),
            'contact.index' => url($locale . '/' . static::slug('contact', $locale)),
            default => url($locale),
        };
    }
}
