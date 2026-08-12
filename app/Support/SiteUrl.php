<?php

namespace App\Support;

class SiteUrl
{
    public static function resolve(?string $url): string
    {
        if (! $url) {
            return '#';
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }

        $path = ltrim($url, '/');

        return match ($path) {
            '', 'home' => route('home'),
            'about' => route('about'),
            'contact' => route('contact.index'),
            'products' => route('products.index'),
            'track' => route('track.index'),
            default => url($url),
        };
    }
}
