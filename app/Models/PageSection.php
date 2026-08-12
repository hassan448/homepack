<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PageSection extends Model
{
    protected $fillable = [
        'page_id',
        'key',
        'admin_label',
        'badge',
        'title',
        'subtitle',
        'body',
        'image',
        'icon',
        'button_text',
        'button_url',
        'button_text_2',
        'button_url_2',
        'quote',
        'extra',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'extra' => 'array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::saved(function (PageSection $section): void {
            Page::clearCache();
            Cache::forget("page_sections_{$section->page?->slug}");
        });

        static::deleted(function (PageSection $section): void {
            Page::clearCache();
        });
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function imageUrl(): ?string
    {
        if (! $this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'images/') || str_starts_with($this->image, 'hero_')) {
            return asset($this->image);
        }

        return Storage::disk('public')->url($this->image);
    }

    public function videoUrl(): ?string
    {
        $video = $this->extra['video'] ?? null;

        if (! $video) {
            return null;
        }

        if (str_starts_with($video, 'hero_') || ! str_contains($video, '/')) {
            return asset($video);
        }

        return Storage::disk('public')->url($video);
    }

    /** @return array<int, array<string, mixed>> */
    public function items(): array
    {
        return $this->extra['items'] ?? [];
    }

    public function item(int $index, ?string $field = null, mixed $default = null): mixed
    {
        $item = $this->items()[$index] ?? [];

        if ($field === null) {
            return $item ?: $default;
        }

        return $item[$field] ?? $default;
    }

    public static function forPage(string $slug): Collection
    {
        return Cache::remember("page_sections_{$slug}", 3600, function () use ($slug) {
            $page = Page::query()->where('slug', $slug)->first();

            if (! $page) {
                return collect();
            }

            return $page->sections()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->keyBy('key');
        });
    }
}
