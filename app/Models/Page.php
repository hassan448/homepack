<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Page extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'title',
        'meta_title',
        'meta_description',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::clearCache());
        static::deleted(fn () => static::clearCache());
    }

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('sort_order');
    }

    public static function clearCache(): void
    {
        Cache::forget('nav_pages');

        static::query()->pluck('slug')->each(function (string $slug): void {
            Cache::forget("page_sections_{$slug}");
        });
    }
}
