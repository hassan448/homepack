<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        View::composer(['partials.header', 'partials.footer', 'contact.index'], function ($view): void {
            try {
                $view->with('siteSettings', SiteSetting::allCached());
                $view->with('navPages', Cache::remember('nav_pages', 3600, fn () => Page::query()
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->pluck('slug')
                    ->flip()));
            } catch (\Throwable $e) {
                report($e);
                $view->with('siteSettings', collect());
                $view->with('navPages', collect());
            }
        });

        foreach ([Product::class, Category::class, Order::class, Page::class, PageSection::class] as $model) {
            $model::saved(fn () => Cache::forget('dashboard_stats'));
            $model::deleted(fn () => Cache::forget('dashboard_stats'));
        }
    }
}
