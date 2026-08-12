<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SiteSetting extends Model
{
    protected $fillable = [
        'group',
        'key',
        'label',
        'value',
        'type',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('site_settings'));
        static::deleted(fn () => Cache::forget('site_settings'));
    }

    public static function allCached(): Collection
    {
        return Cache::remember('site_settings', 3600, fn () => static::query()->orderBy('sort_order')->get()->keyBy('key'));
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        return static::allCached()->get($key)?->value ?? $default;
    }

    public function valueUrl(): ?string
    {
        if ($this->type !== 'image' || ! $this->value) {
            return null;
        }

        if (str_starts_with($this->value, 'images/')) {
            return asset($this->value);
        }

        return Storage::disk('public')->url($this->value);
    }

    public static function groupLabels(): array
    {
        return [
            'general' => 'عام',
            'contact' => 'التواصل',
            'footer' => 'التذييل',
            'header' => 'الرأس',
        ];
    }

    public function groupLabel(): string
    {
        return self::groupLabels()[$this->group] ?? $this->group;
    }
}
