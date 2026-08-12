@php use App\Support\SiteUrl; @endphp
@extends('layouts.site', ['activePage' => 'about'])

@section('title', $page->title ?? 'من نحن | شركة هوم باك للتصنيع')

@section('content')
    @php
        $intro = $sections->get('intro');
        $quality = $sections->get('quality');
        $vision = $sections->get('vision');
        $cta = $sections->get('cta');
        $introStats = $intro?->items() ?: [
            ['value' => '25+', 'label' => 'سنة خبرة'],
            ['value' => '500 ألف', 'label' => 'سعة يومية'],
        ];
        $qualityItems = $quality?->items() ?: [
            ['icon' => 'verified', 'title' => 'شهادة الأيزو', 'body' => 'الالتزام بمعايير إدارة الجودة الدولية الصارمة (ISO 9001:2015) لضمان إنتاج ثابت وعالي الجودة لسلاسل التوريد العالمية.', 'footer' => 'تحقق عالمي'],
            ['icon' => 'recycling', 'title' => 'قابلة لإعادة التدوير بنسبة 100%', 'body' => 'التزامنا بالاقتصاد الدائري يعني أن كل منتج مصمم من مصادر متجددة وقابل لإعادة التدوير بالكامل بعد دورة حياته.', 'footer' => 'هندسة بيئية'],
            ['icon' => 'precision_manufacturing', 'title' => 'دقة هيكلية', 'body' => 'استخدام تكنولوجيا القطع بالليزر المتقدمة والتحكم في الرطوبة للحفاظ على أعلى مستويات سلامة الكرتون وقوة الانفجار في الصناعة.', 'footer' => 'ميزة تقنية'],
        ];
        $visionItems = $vision?->items() ?: [
            ['icon' => 'public', 'label' => 'توزيع عالمي'],
            ['icon' => 'local_shipping', 'label' => 'شحن في اليوم التالي'],
            ['icon' => 'inventory_2', 'label' => 'إدارة المخزون'],
            ['icon' => 'hub', 'label' => 'سلسلة توريد متكاملة'],
        ];
        $visionImages = $vision?->extra['images'] ?? [
            'images/img_b73b517e1c7804eefc5e4d0d9b735a96.jpg',
            'images/img_54a3b3aa0d9070c7ac52b97a10d40f58.jpg',
        ];
        $qualityIconBgs = ['bg-primary-container', 'bg-secondary', 'bg-primary'];
    @endphp

    <!-- Intro Section: Leader in Manufacturing -->
    <section class="relative py-16 md:py-24 bg-surface-container-low overflow-hidden">
        <div class="max-w-[1280px] mx-auto px-6 md:px-margin-desktop grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 items-center">
            <div class="z-10 text-right">
                <span class="inline-block py-1 px-3 bg-primary text-on-primary font-label-md text-[12px] uppercase tracking-[0.2em] mb-6">{{ $intro?->badge ?? 'قيادة راسخة' }}</span>
                <h1 class="font-display-lg text-3xl md:text-display-lg text-primary mb-8 leading-tight">{{ $intro?->title ?? 'قوة هندسية في كل طبقة.' }}</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-10 max-w-xl">
                    {{ $intro?->body ?? 'تعد شركة هوم باك رائدة عالمية في تصنيع الكرتون المضلع عالي الأداء. نحن متخصصون في المتانة الهيكلية وحلول التغليف المعيارية التي تمكن الصناعات من نقل العالم بثقة.' }}
                </p>
                <div class="flex gap-4">
                    @foreach($introStats as $stat)
                        <div class="technical-outline p-6 bg-white flex flex-col gap-2">
                            <span class="font-display-lg text-headline-lg text-secondary">{{ $stat['value'] ?? '' }}</span>
                            <span class="font-label-md text-on-surface-variant uppercase tracking-wider">{{ $stat['label'] ?? '' }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="relative">
                <div class="absolute -top-12 -right-12 w-64 h-64 border-t-2 border-r-2 border-secondary opacity-20"></div>
                <img alt="منشأة تصنيع صناعية" class="w-full h-[500px] object-cover shadow-lg border border-outline-variant" src="{{ $intro?->imageUrl() ?? asset('images/img_b73b517e1c7804eefc5e4d0d9b735a96.jpg') }}"/>
                <div class="absolute -bottom-6 -left-6 bg-primary p-8 text-on-primary">
                    <p class="font-headline-md italic font-light text-right">"{{ $intro?->quote ?? 'دقة في كل ليفة، متانة في كل صندوق.' }}"</p>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-1/3 h-full blueprint-bg opacity-40 -z-0"></div>
    </section>

    <!-- Quality Standards Section: Bento Grid -->
    <section class="py-32 bg-white">
        <div class="max-w-[1280px] mx-auto px-margin-desktop">
            <div class="flex flex-col items-center mb-20 text-center">
                <h2 class="font-headline-lg text-headline-lg text-primary mb-4 uppercase tracking-tighter">{{ $quality?->title ?? 'معايير لا تهاون فيها' }}</h2>
                <div class="h-1 w-24 bg-secondary"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($qualityItems as $index => $item)
                    <div class="technical-outline p-10 flex flex-col items-start hover:bg-surface-container-lowest transition-colors duration-300 text-right">
                        <div class="{{ $qualityIconBgs[$index] ?? 'bg-primary-container' }} p-4 mb-8">
                            <span class="material-symbols-outlined text-white text-3xl no-mirror" @if($index === 1) style="font-variation-settings: 'FILL' 1;" @endif>{{ $item['icon'] ?? 'verified' }}</span>
                        </div>
                        <h3 class="font-headline-md text-headline-md text-primary mb-4 uppercase">{{ $item['title'] ?? '' }}</h3>
                        <p class="font-body-md text-on-surface-variant">{{ $item['body'] ?? '' }}</p>
                        <div class="mt-8 pt-6 border-t border-outline-variant w-full font-label-md text-secondary uppercase tracking-widest text-right">{{ $item['footer'] ?? '' }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Vision & Logistics Section: Asymmetric Layout -->
    <section class="py-24 bg-primary text-on-primary">
        <div class="max-w-[1280px] mx-auto px-margin-desktop grid grid-cols-1 md:grid-cols-12 gap-gutter items-center">
            <div class="md:col-span-7 pr-12 text-right">
                <h2 class="font-display-lg text-display-lg mb-8 leading-tight">{{ $vision?->title ?? 'ربط الإنتاج المحلي بالخدمات اللوجستية العالمية.' }}</h2>
                <p class="font-body-lg text-body-lg text-on-primary-container mb-12 opacity-90">
                    {{ $vision?->body ?? 'تتمثل رؤيتنا فيما وراء أرضية التصنيع. لقد قمنا ببناء شبكة لوجستية تربط الحرفية المحلية بالطلب العالمي، مما يضمن حماية أصولك بواسطة هندسة هوم باك، سواء كنت تشحن عبر الشارع أو عبر المحيط.' }}
                </p>
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-12">
                    @foreach($visionItems as $item)
                        <li class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-secondary no-mirror">{{ $item['icon'] ?? 'public' }}</span>
                            <span class="font-label-md uppercase tracking-widest">{{ $item['label'] ?? '' }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="md:col-span-5 grid grid-cols-2 gap-4 relative">
                <div class="col-span-2">
                    <img alt="مركز لوجستي عالمي" class="w-full h-64 object-cover border border-primary-container" src="{{ isset($visionImages[0]) ? (str_starts_with($visionImages[0], 'images/') ? asset($visionImages[0]) : $visionImages[0]) : asset('images/img_b73b517e1c7804eefc5e4d0d9b735a96.jpg') }}"/>
                </div>
                <div>
                    <img alt="تفاصيل لوجستية" class="w-full h-48 object-cover border border-primary-container" src="{{ isset($visionImages[1]) ? (str_starts_with($visionImages[1], 'images/') ? asset($visionImages[1]) : $visionImages[1]) : asset('images/img_54a3b3aa0d9070c7ac52b97a10d40f58.jpg') }}"/>
                </div>
                <div class="flex items-center justify-center bg-secondary p-8">
                    <span class="material-symbols-outlined text-6xl text-white opacity-40 no-mirror">language</span>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-surface border-y border-outline-variant">
        <div class="max-w-[1280px] mx-auto px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-12 text-right">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-primary mb-2">{{ $cta?->title ?? 'هل أنت جاهز لتقوية سلسلة التوريد الخاصة بك؟' }}</h2>
                <p class="font-body-md text-on-surface-variant">{{ $cta?->body ?? 'استشر فريقنا الهندسي للحصول على تحليل هيكلي مخصص لاحتياجات التغليف الخاصة بك.' }}</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ SiteUrl::resolve($cta?->button_url ?? '/contact') }}" class="bg-primary text-on-primary px-8 py-4 font-headline-md text-[14px] uppercase tracking-widest transition-all hover:bg-primary-container">{{ $cta?->button_text ?? 'احجز استشارة' }}</a>
                <a href="{{ SiteUrl::resolve($cta?->button_url_2 ?? '/products') }}" class="border border-primary text-primary px-8 py-4 font-headline-md text-[14px] uppercase tracking-widest transition-all hover:bg-surface-container">{{ $cta?->button_text_2 ?? 'عرض الكتالوج' }}</a>
            </div>
        </div>
    </section>
@endsection
