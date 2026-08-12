@extends('layouts.site', ['activePage' => 'track'])

@section('title', $page->title ?? 'تتبع الطلب | هوم باك')

@section('content')
@php
    $header = $sections->get('header');
    $help = $sections->get('help');
@endphp
<div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin-desktop py-16">
    <section class="mb-12 text-right">
        <span class="inline-block py-1 px-3 bg-secondary text-on-secondary font-label-md text-[12px] uppercase tracking-[0.2em] mb-6">{{ $header?->badge ?? 'تتبع الطلب' }}</span>
        <h1 class="font-display-lg text-3xl md:text-display-lg text-primary mb-4 leading-tight">{{ $header?->title ?? 'تابع حالة طلبك' }}</h1>
        <p class="font-body-lg text-lg md:text-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
            {{ $header?->body ?? 'أدخل رمز التتبع الذي استلمته بعد إرسال نموذج الاستفسار لمتابعة مراحل معالجة طلبك.' }}
        </p>
        <div class="w-24 h-1 bg-secondary mt-8 mr-0"></div>
    </section>

    <div class="max-w-xl mx-auto">
        <div class="bg-white p-8 md:p-10 technical-outline blueprint-accent text-right">
            <form action="{{ route('track.lookup') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-on-surface-variant" for="code">رمز التتبع</label>
                    <input
                        id="code"
                        name="code"
                        value="{{ old('code') }}"
                        class="w-full bg-surface border border-outline focus:border-primary focus:ring-0 px-4 py-4 font-headline-md text-lg tracking-widest uppercase transition-all text-center @error('code') border-error @enderror"
                        placeholder="HP-XXXXXXXX"
                        type="text"
                        autocomplete="off"
                        required
                    />
                    @error('code')
                        <p class="text-error font-body-md text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <button class="w-full bg-secondary text-on-secondary px-10 py-4 font-headline-md text-headline-md font-bold uppercase tracking-wider hover:bg-on-secondary-fixed-variant transition-colors" type="submit">
                    عرض حالة الطلب
                </button>
            </form>
        </div>

        <div class="mt-8 p-6 bg-surface-container-lowest technical-outline text-right">
            <div class="flex items-start gap-4">
                <span class="material-symbols-outlined text-secondary text-3xl no-mirror">info</span>
                <div>
                    <h3 class="font-headline-md text-headline-md text-primary mb-2">{{ $help?->title ?? 'أين أجد رمز التتبع؟' }}</h3>
                    @if($help?->body)
                        <p class="font-body-md text-on-surface-variant leading-relaxed">{!! $help->body !!}</p>
                    @else
                        <p class="font-body-md text-on-surface-variant leading-relaxed">
                            يظهر الرمز مباشرة بعد إرسال نموذج الاستفسار في صفحة
                            <a href="{{ route('contact.index') }}" class="text-secondary hover:underline">اتصل بنا</a>.
                            يبدأ الرمز بـ <strong>HP-</strong> متبوعاً بـ 8 أحرف.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
