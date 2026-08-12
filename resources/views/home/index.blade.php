@php use App\Support\SiteUrl; @endphp
@extends('layouts.site', ['activePage' => 'index'])

@section('title', $page->title ?? 'هوم باك | تصنيع صناعي')

@section('content')
    @php
        $hero = $sections->get('hero');
        $heroPoster = $hero?->imageUrl() ?? asset('images/img_ad9cb2c626426a8cb26dc8df94888bd4.jpg');
        $heroVideo = $hero?->videoUrl() ?? asset('hero_video.mp4');
        $featureItems = $sections->get('features')?->items() ?? [];
        $statItems = $sections->get('stats')?->items() ?? [];
        $productsPreview = $sections->get('products_preview');
        $aboutTeaser = $sections->get('about_teaser');
        $cta = $sections->get('cta');
    @endphp

    @if($hero)
    <!-- Hero Section -->
    <section class="relative h-[500px] md:h-[819px] flex items-center bg-primary overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-40">
            <video autoplay muted loop playsinline preload="metadata" poster="{{ $heroPoster }}" class="w-full h-full object-cover">
                <source src="{{ $heroVideo }}" type="video/mp4">
            </video>
        </div>
        <div class="max-w-[1280px] mx-auto px-6 md:px-margin-desktop relative z-10 w-full">
            <div class="max-w-3xl">
                <h1 class="font-display-lg text-3xl md:text-display-lg text-on-primary mb-6 uppercase leading-tight">
                    {{ $hero?->title ?? 'هوم باك: بيت صناعة الكرتون' }}
                </h1>
                <p class="font-body-lg text-lg md:text-body-lg text-on-primary-container mb-10 max-w-2xl leading-relaxed">
                    {{ $hero?->body ?? 'حلول تغليف هندسية دقيقة للخدمات اللوجستية العالمية. نحن نجمع بين المتانة الهيكلية والتصنيع المستدام.' }}
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ SiteUrl::resolve($hero?->button_url ?? '/contact') }}" class="bg-secondary text-on-secondary px-10 py-5 font-headline-md text-headline-md font-bold uppercase tracking-wider transition-all hover:bg-on-secondary-fixed-variant">
                        {{ $hero?->button_text ?? 'احصل على سعر' }}
                    </a>
                    <a href="{{ SiteUrl::resolve($hero?->button_url_2 ?? '/products') }}" class="border border-on-primary text-on-primary px-10 py-5 font-headline-md text-headline-md font-bold uppercase tracking-wider transition-all hover:bg-on-primary hover:text-primary">
                        {{ $hero?->button_text_2 ?? 'منتجاتنا' }}
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 w-full h-px bg-outline-variant opacity-20"></div>
    </section>
    @endif

    @if(count($featureItems) > 0)
    <!-- Features Section -->
    <section class="py-24 bg-surface-container-lowest">
        <div class="max-w-[1280px] mx-auto px-margin-desktop">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
                @foreach($featureItems as $item)
                    <div class="p-8 border border-outline-variant bg-surface flex flex-col items-start transition-colors duration-200 hover:bg-surface-container-low">
                        <span class="material-symbols-outlined text-secondary text-4xl mb-6 no-mirror" style="font-variation-settings: 'FILL' 1;">{{ $item['icon'] ?? 'star' }}</span>
                        <h3 class="font-headline-md text-headline-md text-primary mb-4 uppercase">{{ $item['title'] ?? '' }}</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">
                            {{ $item['body'] ?? '' }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if(count($statItems) > 0)
    <!-- Stats Section -->
    <section class="bg-primary py-16 border-y border-primary-container">
        <div class="max-w-[1280px] mx-auto px-6 md:px-margin-desktop">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-gutter text-center md:text-right">
                @foreach($statItems as $index => $item)
                    <div class="{{ $index < count($statItems) - 1 ? 'border-r border-primary-container pr-0 md:pr-gutter' : '' }}">
                        <div class="font-display-lg text-3xl md:text-display-lg text-secondary mb-2">{{ $item['value'] ?? '' }}</div>
                        <p class="font-label-md text-on-primary-container uppercase tracking-wider">{{ $item['label'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if($productsPreview)
    <!-- Product Preview (Bento Grid) -->
    <section class="py-24 bg-surface">
        <div class="max-w-[1280px] mx-auto px-margin-desktop">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <span class="font-label-md text-label-md text-secondary uppercase tracking-widest block mb-2">{{ $productsPreview?->badge ?? 'كتالوجنا' }}</span>
                    <h2 class="font-display-lg text-headline-lg text-primary uppercase">{{ $productsPreview?->title ?? 'حلول تغليف دقيقة' }}</h2>
                </div>
                <a class="font-label-md text-label-md text-primary border-b border-primary pb-1 hover:text-secondary hover:border-secondary transition-all" href="{{ SiteUrl::resolve($productsPreview?->button_url ?? '/products') }}">{{ $productsPreview?->button_text ?? 'عرض جميع المنتجات' }}</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-6 h-auto md:h-[700px]">
                @if($featuredProduct)
                    <div class="md:col-span-2 md:row-span-2 border border-outline-variant relative group overflow-hidden bg-white">
                        @if($featuredProduct->imageUrl())
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $featuredProduct->name }}" src="{{ $featuredProduct->imageUrl() }}"/>
                        @else
                            <div class="w-full h-full bg-surface-container flex items-center justify-center">
                                @if($featuredProduct->icon)
                                    <span class="material-symbols-outlined text-[80px] text-outline-variant no-mirror" style="font-variation-settings: 'FILL' 1;">{{ $featuredProduct->icon }}</span>
                                @endif
                            </div>
                        @endif
                        <div class="absolute bottom-0 left-0 right-0 p-8 bg-gradient-to-t from-primary/80 to-transparent text-right">
                            <h4 class="font-headline-md text-headline-md text-on-primary uppercase mb-2">{{ $featuredProduct->name }}</h4>
                            <p class="font-body-md text-on-primary-container">{{ $featuredProduct->description }}</p>
                        </div>
                    </div>
                @endif

                @foreach($previewProducts as $index => $product)
                    @php
                        $cellClass = $index === 0 ? 'md:col-span-2 md:row-span-1' : 'md:col-span-1 md:row-span-1';
                        $isCompact = $index >= 1;
                    @endphp
                    <div class="{{ $cellClass }} border border-outline-variant relative group overflow-hidden bg-white">
                        @if($product->imageUrl())
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $product->name }}" src="{{ $product->imageUrl() }}"/>
                        @else
                            <div class="w-full h-full bg-surface-container flex items-center justify-center">
                                @if($product->icon)
                                    <span class="material-symbols-outlined text-[64px] text-outline-variant no-mirror" style="font-variation-settings: 'FILL' 1;">{{ $product->icon }}</span>
                                @endif
                            </div>
                        @endif
                        @if($isCompact)
                            <div class="absolute inset-0 bg-primary/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="text-on-primary font-headline-md uppercase border-b-2 border-on-primary">{{ $product->name }}</span>
                            </div>
                        @else
                            <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-primary/80 to-transparent text-right">
                                <h4 class="font-headline-md text-headline-md text-on-primary uppercase mb-1">{{ $product->name }}</h4>
                                <p class="font-body-md text-on-primary-container">{{ $product->description }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if($aboutTeaser)
    <!-- About Teaser -->
    <section class="py-24 bg-primary text-on-primary overflow-hidden relative">
        <div class="absolute inset-0 blueprint-bg opacity-5"></div>
        <div class="max-w-[1280px] mx-auto px-6 md:px-margin-desktop grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
            <div class="text-right order-2 md:order-1">
                <span class="inline-block py-1 px-3 bg-secondary text-on-secondary font-label-md text-[12px] uppercase tracking-[0.2em] mb-6">{{ $aboutTeaser?->badge ?? 'منذ 1984' }}</span>
                <h2 class="font-display-lg text-2xl md:text-headline-lg text-on-primary mb-6 uppercase leading-tight">{{ $aboutTeaser?->title ?? 'قوة هندسية في كل طبقة' }}</h2>
                <p class="font-body-lg text-on-primary-container mb-8 leading-relaxed opacity-90">
                    {{ $aboutTeaser?->body ?? 'تعد هوم باك رائدة في تصنيع الكرتون المضلع عالي الأداء. نحن متخصصون في المتانة الهيكلية وحلول التغليف التي تمكن الصناعات من نقل العالم بثقة — من التصميم حتى التسليم.' }}
                </p>
                <a href="{{ SiteUrl::resolve($aboutTeaser?->button_url ?? '/about') }}" class="inline-block border border-on-primary-container text-on-primary px-8 py-4 font-headline-md text-[14px] uppercase tracking-widest hover:bg-on-primary hover:text-primary transition-all">
                    {{ $aboutTeaser?->button_text ?? 'قصة الشركة' }}
                </a>
            </div>
            <div class="relative order-1 md:order-2">
                <div class="absolute -top-8 -right-8 w-48 h-48 border-t-2 border-r-2 border-secondary opacity-30"></div>
                <img src="{{ $aboutTeaser?->imageUrl() ?? asset('images/img_b73b517e1c7804eefc5e4d0d9b735a96.jpg') }}" alt="منشأة هوم باك للتصنيع" class="w-full h-[360px] object-cover border border-primary-container"/>
                <div class="absolute -bottom-6 -left-6 bg-secondary p-6 hidden md:block">
                    <p class="font-headline-md text-on-secondary text-right italic">"{{ $aboutTeaser?->quote ?? 'دقة في كل ليفة، متانة في كل صندوق.' }}"</p>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($cta)
    <!-- CTA Section -->
    <section class="bg-primary-container py-20">
        <div class="max-w-[1280px] mx-auto px-margin-desktop text-center">
            <h2 class="font-display-lg text-display-lg text-on-primary uppercase mb-8">{{ $cta?->title ?? 'جاهز لتحسين خدماتك اللوجستية؟' }}</h2>
            <p class="font-body-lg text-on-primary-container mb-12 max-w-2xl mx-auto">
                {{ $cta?->body ?? 'اتصل بفريقنا الهندسي اليوم للحصول على عرض سعر شامل للطلبات الكبيرة ومواصفات التصنيع المخصصة.' }}
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="{{ SiteUrl::resolve($cta?->button_url ?? '/contact') }}" class="bg-secondary text-on-secondary px-12 py-5 font-headline-md text-headline-md font-bold uppercase tracking-wider transition-all hover:bg-on-secondary-fixed-variant text-center">
                    {{ $cta?->button_text ?? 'طلب اقتراح سعر' }}
                </a>
                <a href="{{ SiteUrl::resolve($cta?->button_url_2 ?? '/contact') }}" class="border border-on-primary-container text-on-primary-container px-12 py-5 font-headline-md text-headline-md font-bold uppercase tracking-wider transition-all hover:border-on-primary hover:text-on-primary text-center">
                    {{ $cta?->button_text_2 ?? 'اتصل بالمبيعات' }}
                </a>
            </div>
        </div>
    </section>
    @endif
@endsection
