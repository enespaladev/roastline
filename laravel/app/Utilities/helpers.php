<?php

if (! function_exists('localizedRoute')) {
    function localizedRoute(string $name, array $params = [], ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return route("{$locale}.{$name}", $params);
    }
}
