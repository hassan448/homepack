<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Order;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class HomeStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $stats = Cache::remember('dashboard_stats', 60, function (): array {
            return [
                'products' => Product::count(),
                'products_active' => Product::where('is_active', true)->count(),
                'categories' => Category::count(),
                'categories_active' => Category::where('is_active', true)->count(),
                'featured' => Product::where('is_featured', true)->count(),
                'pages' => Page::count(),
                'sections' => PageSection::count(),
                'orders' => Order::count(),
                'orders_new' => Order::where('status', 'new')->count(),
            ];
        });

        return [
            Stat::make('المنتجات', $stats['products'])
                ->description('منتج نشط: '.$stats['products_active'])
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary'),
            Stat::make('الفئات', $stats['categories'])
                ->description('فئات نشطة: '.$stats['categories_active'])
                ->descriptionIcon('heroicon-m-tag')
                ->color('success'),
            Stat::make('منتجات مميزة', $stats['featured'])
                ->description('تظهر في أعلى الصفحة')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
            Stat::make('الصفحات', $stats['pages'])
                ->description('أقسام: '.$stats['sections'])
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),
            Stat::make('الطلبات', $stats['orders'])
                ->description('جديدة: '.$stats['orders_new'])
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('danger'),
        ];
    }
}
