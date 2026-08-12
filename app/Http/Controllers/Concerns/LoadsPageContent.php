<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\View\View;

trait LoadsPageContent
{
    protected function ensurePageActive(string $slug): Page
    {
        $page = Page::query()->where('slug', $slug)->first();

        if (! $page?->is_active) {
            abort(404);
        }

        return $page;
    }

    /** @param  array<string, mixed>  $data */
    protected function pageView(string $slug, string $view, array $data = []): View
    {
        $page = $this->ensurePageActive($slug);

        return view($view, array_merge($data, [
            'page' => $page,
            'sections' => PageSection::forPage($slug),
        ]));
    }
}
