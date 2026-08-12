<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\LoadsPageContent;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    use LoadsPageContent;

    public function index(): View
    {
        $featuredProduct = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->first();

        $previewProducts = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->when($featuredProduct, fn ($q) => $q->where('id', '!=', $featuredProduct->id))
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return $this->pageView('home', 'home.index', compact('featuredProduct', 'previewProducts'));
    }
}
