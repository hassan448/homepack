@extends('layouts.site', ['activePage' => 'contact'])

@section('title', $page->title ?? 'اتصل بنا | شركة هوم باك للتصنيع')

@section('content')
@php
    $header = $sections->get('header');
    $form = $sections->get('form');
    $logistics = $sections->get('logistics');
    $logisticsItems = $logistics?->items() ?: [
        ['value' => '48 ساعة', 'label' => 'وقت تنفيذ النموذج الأولي'],
        ['value' => '120+', 'label' => 'شركاء عالميون'],
    ];
    $mapImage = $siteSettings->get('contact_map_image')?->value ?? 'images/img_395e3911da0e2f4ca02f32cdb3289f07.jpg';
    $mapImageUrl = str_starts_with($mapImage, 'images/')
        ? asset($mapImage)
        : ($siteSettings->get('contact_map_image')?->valueUrl() ?? asset('images/img_395e3911da0e2f4ca02f32cdb3289f07.jpg'));
@endphp
<div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin-desktop py-16">
    <section class="mb-16 md:mb-24 text-right">
        <h1 class="font-display-lg text-3xl md:text-display-lg text-primary mb-4 leading-tight">{{ $header?->title ?? 'تواصل مع قسم الهندسة' }}</h1>
        <p class="font-body-lg text-lg md:text-body-lg text-on-surface-variant max-w-2xl leading-relaxed">{{ $header?->body ?? 'من تصميم النماذج الأولية المخصصة إلى التصنيع بكميات كبيرة، فرقنا اللوجستية والهندسية جاهزة لتأمين سلسلة التوريد الخاصة بك.' }}</p>
        <div class="w-24 h-1 bg-secondary mt-8 mr-0"></div>
    </section>

    @if(session('success'))
        <div class="mb-8 p-4 bg-green-100 border border-green-400 text-green-800 rounded text-right font-body-md">
            {{ session('success') }}
            @if(session('tracking_code'))
                <p class="mt-3 font-headline-md">
                    رمز التتبع:
                    <a href="{{ route('track.show', session('tracking_code')) }}" class="text-primary underline tracking-widest">{{ session('tracking_code') }}</a>
                </p>
            @endif
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
        <!-- Contact Info & Map -->
        <div class="md:col-span-5 space-y-12 text-right">
            <div class="space-y-8">
                <div class="flex items-start gap-6 p-6 bg-surface-container-lowest technical-outline">
                    <div class="bg-primary-container p-3">
                        <span class="material-symbols-outlined text-primary-fixed no-mirror">location_on</span>
                    </div>
                    <div>
                        <h3 class="font-label-md text-label-md text-secondary uppercase mb-1">المقر العالمي</h3>
                        <p class="font-body-md text-body-md text-on-surface">{!! $siteSettings->get('contact_address')?->value ?? 'المنطقة الصناعية المرحلة الثالثة، بلوك 42<br/>مركز اللوجستيات، العاصمة' !!}</p>
                    </div>
                </div>
                <div class="flex items-start gap-6 p-6 bg-surface-container-lowest technical-outline">
                    <div class="bg-primary-container p-3">
                        <span class="material-symbols-outlined text-primary-fixed no-mirror">call</span>
                    </div>
                    <div>
                        <h3 class="font-label-md text-label-md text-secondary uppercase mb-1">الاستفسارات التجارية</h3>
                        <p class="font-body-md text-body-md text-on-surface">{{ $siteSettings->get('contact_phone')?->value ?? '+1 (800) 555-PACK' }}<br/>{{ $siteSettings->get('contact_hours')?->value ?? 'الاثنين-الجمعة، 08:00 - 18:00' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-6 p-6 bg-surface-container-lowest technical-outline">
                    <div class="bg-primary-container p-3">
                        <span class="material-symbols-outlined text-primary-fixed no-mirror">mail</span>
                    </div>
                    <div>
                        <h3 class="font-label-md text-label-md text-secondary uppercase mb-1">المراسلات الإلكترونية</h3>
                        <p class="font-body-md text-body-md text-on-surface">{{ $siteSettings->get('contact_email_1')?->value ?? 'logistics@homepack-manufacturing.com' }}<br/>{{ $siteSettings->get('contact_email_2')?->value ?? 'quotes@homepack-manufacturing.com' }}</p>
                    </div>
                </div>
            </div>
            <div class="technical-outline bg-surface-variant h-[320px] relative overflow-hidden group">
                <img class="w-full h-full object-cover grayscale opacity-80 group-hover:grayscale-0 transition-all duration-500" alt="خريطة تخطيطية لمجمع صناعي." src="{{ $mapImageUrl }}"/>
                <div class="absolute inset-0 flex items-center justify-center bg-primary/20 pointer-events-none">
                    <div class="bg-primary text-on-primary px-4 py-2 font-label-md flex items-center gap-2">
                        <span class="material-symbols-outlined no-mirror">factory</span>
                        {{ $siteSettings->get('contact_map_label')?->value ?? 'المنشأة الرئيسية لهوم باك' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Inquiry Form -->
        <div class="md:col-span-7">
            <div class="bg-white p-8 md:p-12 technical-outline blueprint-accent relative text-right">
                <div class="absolute top-0 left-0 p-4 opacity-10">
                    <span class="material-symbols-outlined text-[120px] no-mirror">inventory_2</span>
                </div>
                <h2 class="font-headline-lg text-headline-lg text-primary mb-8 border-b border-outline-variant pb-4">{{ $form?->title ?? 'نموذج استفسار عن طلب' }}</h2>
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant" for="customer_name">اسم العميل</label>
                            <input id="customer_name" name="customer_name" value="{{ old('customer_name') }}" class="w-full bg-surface border border-outline focus:border-primary focus:ring-0 px-4 py-3 font-body-md transition-all text-right @error('customer_name') border-error @enderror" placeholder="الاسم الكامل" type="text"/>
                            @error('customer_name')
                                <p class="text-error font-body-md text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant" for="email">البريد الإلكتروني</label>
                            <input id="email" name="email" value="{{ old('email') }}" class="w-full bg-surface border border-outline focus:border-primary focus:ring-0 px-4 py-3 font-body-md transition-all text-right @error('email') border-error @enderror" placeholder="example@company.com" type="email"/>
                            @error('email')
                                <p class="text-error font-body-md text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant" for="dimensions">أبعاد الصندوق (الطول x العرض x الارتفاع ملم)</label>
                            <input id="dimensions" name="dimensions" value="{{ old('dimensions') }}" class="w-full bg-surface border border-outline focus:border-primary focus:ring-0 px-4 py-3 font-body-md transition-all text-right @error('dimensions') border-error @enderror" placeholder="مثال: 400x300x200" type="text"/>
                            @error('dimensions')
                                <p class="text-error font-body-md text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant" for="quantity">كمية الطلب (وحدات)</label>
                            <input id="quantity" name="quantity" value="{{ old('quantity') }}" class="w-full bg-surface border border-outline focus:border-primary focus:ring-0 px-4 py-3 font-body-md transition-all text-right @error('quantity') border-error @enderror" placeholder="الحد الأدنى 500 وحدة" type="number"/>
                            @error('quantity')
                                <p class="text-error font-body-md text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant" for="cardboard_type">نوع الكرتون</label>
                            <select id="cardboard_type" name="cardboard_type" class="w-full bg-surface border border-outline focus:border-primary focus:ring-0 px-4 py-3 font-body-md transition-all text-right @error('cardboard_type') border-error @enderror">
                                <option value="جدار واحد مضلع" @selected(old('cardboard_type') === 'جدار واحد مضلع')>جدار واحد مضلع</option>
                                <option value="جدار مزدوج شديد التحمل" @selected(old('cardboard_type') === 'جدار مزدوج شديد التحمل')>جدار مزدوج شديد التحمل</option>
                                <option value="ورق كرافت لاينر" @selected(old('cardboard_type') === 'ورق كرافت لاينر')>ورق كرافت لاينر</option>
                                <option value="ألياف معاد تدويرها مستدامة" @selected(old('cardboard_type') === 'ألياف معاد تدويرها مستدامة')>ألياف معاد تدويرها مستدامة</option>
                            </select>
                            @error('cardboard_type')
                                <p class="text-error font-body-md text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant" for="printing_type">طباعة الشعار</label>
                            <select id="printing_type" name="printing_type" class="w-full bg-surface border border-outline focus:border-primary focus:ring-0 px-4 py-3 font-body-md transition-all text-right @error('printing_type') border-error @enderror">
                                <option value="بدون طباعة" @selected(old('printing_type') === 'بدون طباعة')>بدون طباعة</option>
                                <option value="فليكسو لون واحد" @selected(old('printing_type') === 'فليكسو لون واحد')>فليكسو لون واحد</option>
                                <option value="أوفست متعدد الألوان" @selected(old('printing_type') === 'أوفست متعدد الألوان')>أوفست متعدد الألوان</option>
                                <option value="طلاء UV ممتاز" @selected(old('printing_type') === 'طلاء UV ممتاز')>طلاء UV ممتاز</option>
                            </select>
                            @error('printing_type')
                                <p class="text-error font-body-md text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-md text-label-md text-on-surface-variant" for="notes">المواصفات / المتطلبات الإضافية</label>
                        <textarea id="notes" name="notes" class="w-full bg-surface border border-outline focus:border-primary focus:ring-0 px-4 py-3 font-body-md transition-all text-right @error('notes') border-error @enderror" placeholder="اذكر المتطلبات الهيكلية المحددة، مقاومة الرطوبة، أو احتياجات الملصقات..." rows="4">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-error font-body-md text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center gap-4 pt-4 justify-start">
                        <button class="bg-secondary text-on-secondary px-10 py-4 font-headline-md text-headline-md font-bold uppercase tracking-wider hover:bg-[#5c4125] transition-colors" type="submit">
                            إرسال الاستفسار
                        </button>
                        <span class="text-on-surface-variant font-label-md flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] no-mirror">lock</span>
                            إرسال آمن
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Logistics Section (outside main container) -->
<section class="bg-primary text-on-primary py-24 overflow-hidden relative">
    <div class="max-w-[1280px] mx-auto px-margin-desktop grid grid-cols-1 md:grid-cols-2 gap-16 items-center text-right">
        <div>
            <h2 class="font-display-lg text-display-lg mb-6">{{ $logistics?->title ?? 'سعة اللوجستيات العالمية' }}</h2>
            <p class="font-body-lg text-body-lg text-on-primary-container mb-8">{{ $logistics?->body ?? 'من خلال استخدام شبكة مترابطة من مراكز التوزيع، نضمن السلامة الهيكلية من أرضنا إلى أبواب منشأتك، بغض النظر عن الوجهة العالمية.' }}</p>
            <div class="grid grid-cols-2 gap-8">
                @foreach($logisticsItems as $item)
                    <div>
                        <div class="text-[40px] font-bold text-secondary-fixed mb-2 tracking-tight">{{ $item['value'] ?? '' }}</div>
                        <p class="font-label-md text-label-md uppercase text-on-primary-container">{{ $item['label'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="relative">
            <div class="technical-outline p-2 bg-primary-container/30">
                <img class="w-full aspect-video object-cover opacity-90" alt="لقطة لمستودع صناعي ضخم." src="{{ $logistics?->imageUrl() ?? asset('images/img_b1dafdba32af254895df51ee440fd271.jpg') }}"/>
            </div>
            <div class="absolute -bottom-8 -right-8 bg-secondary p-8 hidden md:block">
                <span class="material-symbols-outlined text-[48px] text-on-secondary no-mirror">verified</span>
                <p class="font-label-md text-on-secondary mt-2">{!! $logistics?->extra['badge'] ?? 'ISO 9001:2015<br/>معتمد' !!}</p>
            </div>
        </div>
    </div>
</section>
@endsection
