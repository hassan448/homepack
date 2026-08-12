@extends('layouts.site', ['activePage' => 'products'])

@section('title', $page->title ?? 'المنتجات | شركة هوم باك للتصنيع')

@section('content')
@php $hero = $sections->get('hero'); @endphp
<section class="relative bg-primary overflow-hidden">
    <div class="absolute inset-0 blueprint-bg opacity-10"></div>
    <div class="max-w-[1280px] mx-auto px-6 md:px-margin-desktop py-16 md:py-24 relative z-10">
        <nav class="flex items-center gap-2 mb-8 text-on-primary-container font-label-md text-sm">
            <a href="{{ url('/') }}" class="hover:text-on-primary transition-colors">الرئيسية</a>
            <span class="material-symbols-outlined text-[16px] no-mirror opacity-50">chevron_left</span>
            <span class="text-on-primary">المنتجات</span>
        </nav>
        <h1 class="font-display-lg text-3xl md:text-display-lg text-on-primary mb-4 uppercase">{{ $hero?->title ?? 'حلول تغليف هندسية دقيقة' }}</h1>
        <p class="font-body-lg text-on-primary-container max-w-xl">{{ $hero?->body ?? 'كتالوج ديناميك — أي تعديل في لوحة الإدارة يظهر هنا فوراً.' }}</p>
    </div>
</section>

<section class="sticky top-20 z-40 bg-surface-container-lowest border-b border-outline-variant shadow-sm">
    <div class="max-w-[1280px] mx-auto px-6 md:px-margin-desktop py-4">
        <div class="flex items-center gap-3 overflow-x-auto pb-1">
            <a href="{{ route('products.index') }}"
               class="shrink-0 px-5 py-2.5 border font-label-md text-label-md uppercase tracking-wider transition-all {{ ! $activeCategory ? 'filter-btn active' : 'border-outline-variant bg-surface text-on-surface-variant hover:border-primary' }}">
                الكل
            </a>
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                   class="shrink-0 px-5 py-2.5 border font-label-md text-label-md uppercase tracking-wider transition-all {{ $activeCategory === $category->slug ? 'filter-btn active' : 'border-outline-variant bg-surface text-on-surface-variant hover:border-primary' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>

@if($featured && (! $activeCategory || $activeCategory === 'all'))
<section class="py-16 md:py-20 bg-surface">
    <div class="max-w-[1280px] mx-auto px-6 md:px-margin-desktop">
        <div class="technical-outline bg-white overflow-hidden grid grid-cols-1 md:grid-cols-2">
            <div class="relative h-[320px] md:h-auto overflow-hidden">
                @if($featured->imageUrl())
                    <img src="{{ $featured->imageUrl() }}" alt="{{ $featured->name }}" class="w-full h-full object-cover"/>
                @endif
                @if($featured->badge_text)
                    <div class="absolute top-4 right-4 bg-secondary text-on-secondary px-3 py-1 font-label-md text-[11px] uppercase tracking-widest">{{ $featured->badge_text }}</div>
                @endif
            </div>
            <div class="p-8 md:p-12 flex flex-col justify-center text-right">
                <span class="font-label-md text-label-md text-secondary uppercase tracking-widest mb-3">منتج مميز</span>
                <h2 class="font-headline-lg text-headline-lg text-primary mb-4 uppercase">{{ $featured->name }}</h2>
                <p class="font-body-md text-on-surface-variant mb-6 leading-relaxed">{{ $featured->description }}</p>
                @if($featured->spec_label)
                    <p class="font-label-md text-secondary uppercase tracking-wider mb-6">{{ $featured->spec_label }}</p>
                @endif
                        <a href="{{ route('contact.index') }}" class="inline-block bg-secondary text-on-secondary px-8 py-3 font-headline-md text-[14px] font-bold uppercase tracking-wider hover:bg-on-secondary-fixed-variant transition-all w-fit">طلب عرض سعر</a>
            </div>
        </div>
    </div>
</section>
@endif

<section class="py-8 md:py-16 bg-surface-container-low">
    <div class="max-w-[1280px] mx-auto px-6 md:px-margin-desktop">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h3 class="font-headline-md text-headline-md text-primary uppercase">جميع المنتجات</h3>
                <p class="font-body-md text-on-surface-variant mt-1">عرض {{ $products->count() }} منتج</p>
            </div>
        </div>

        @if($products->isEmpty())
            <div class="text-center py-16 text-on-surface-variant">
                <span class="material-symbols-outlined text-6xl mb-4 no-mirror opacity-30">inventory_2</span>
                <p class="font-body-lg">لا توجد منتجات في هذه الفئة حالياً.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    @if($product->is_featured && ! $activeCategory)
                        @continue
                    @endif
                    <article class="product-card technical-outline bg-white group overflow-hidden flex flex-col">
                        <div class="relative h-56 overflow-hidden {{ $product->imageUrl() ? '' : 'bg-surface-container flex items-center justify-center' }}">
                            @if($product->imageUrl())
                                <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="product-image w-full h-full object-cover transition-transform duration-500"/>
                            @elseif($product->icon)
                                <span class="material-symbols-outlined text-[80px] text-outline-variant no-mirror" style="font-variation-settings: 'FILL' 1;">{{ $product->icon }}</span>
                            @endif
                            <div class="product-overlay absolute inset-0 bg-primary/70 opacity-0 transition-opacity duration-300 flex items-center justify-center">
                                <a href="{{ route('contact.index') }}" class="bg-secondary text-on-secondary px-6 py-3 font-label-md uppercase tracking-wider hover:bg-on-secondary-fixed-variant transition-all">طلب عرض سعر</a>
                            </div>
                            @if($product->displayBadge())
                                <span class="absolute top-3 right-3 bg-primary text-on-primary px-2 py-0.5 font-label-md text-[10px] uppercase tracking-wider">{{ $product->displayBadge() }}</span>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-1 text-right">
                            <h4 class="font-headline-md text-[18px] text-primary mb-2 uppercase">{{ $product->name }}</h4>
                            <p class="font-body-md text-on-surface-variant text-sm mb-4 flex-1">{{ $product->description }}</p>
                            <div class="flex items-center justify-between pt-4 border-t border-outline-variant">
                                @if($product->spec_label)
                                    <span class="font-label-md text-secondary text-[11px] uppercase tracking-wider">{{ $product->spec_label }}</span>
                                @endif
                                <span class="material-symbols-outlined text-on-surface-variant group-hover:text-secondary transition-colors no-mirror">arrow_back</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
