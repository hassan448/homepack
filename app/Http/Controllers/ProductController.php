<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\LoadsPageContent;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    use LoadsPageContent;

    public function index(Request $request): View
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $query = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->orderBy('sort_order');

        $activeCategory = $request->query('category');

        if ($activeCategory && $activeCategory !== 'all') {
            $query->whereHas('category', fn ($q) => $q->where('slug', $activeCategory));
        }

        $products = $query->get();
        $featured = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->first();

        return $this->pageView('products', 'products.index', compact('categories', 'products', 'featured', 'activeCategory'));
    }
}
