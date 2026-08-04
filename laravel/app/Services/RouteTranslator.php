<?php

namespace App\Services;

use App\Models\Category;

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

    public static function urlFor(string $routeName, string $locale, array $params = []): string
    {
        return match ($routeName) {
            'home' => url($locale),
            'about', 'videos' => url($locale . '/' . static::slug($routeName, $locale)),
            'products.index' => url($locale . '/' . static::slug('products', $locale)),
            'products.category' => static::productsCategoryUrl($locale, $params),
            'posts.index' => url($locale . '/' . static::slug('posts', $locale)),
            'contact.index' => url($locale . '/' . static::slug('contact', $locale)),
            default => url($locale),
        };
    }

    protected static function productsCategoryUrl(string $locale, array $params): string
    {
        $currentSlug = $params['categorySlug'] ?? null;

        if (!$currentSlug) {
            return url($locale . '/' . static::slug('products', $locale));
        }

        // Mevcut slug hangi dildeyse ona bakmadan, bu slug'a sahip kategoriyi bul
        $category = Category::where('is_active', true)->get()->first(function ($cat) use ($currentSlug) {
            foreach (['tr', 'en', 'ar'] as $loc) {
                if ($cat->getTranslation('slug', $loc) === $currentSlug) {
                    return true;
                }
            }
            return false;
        });

        if (!$category) {
            return url($locale . '/' . static::slug('products', $locale));
        }

        $targetSlug = $category->getTranslation('slug', $locale);

        return url(
            $locale . '/'
            . static::slug('products', $locale) . '/'
            . static::slug('products_category', $locale) . '/'
            . $targetSlug
        );
    }
}
