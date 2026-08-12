@extends('layouts.site', ['activePage' => 'track'])

@section('title', 'تتبع الطلب ' . $order->tracking_code . ' | هوم باك')

@section('content')
<div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin-desktop py-16">
    <section class="mb-12 text-right flex flex-col md:flex-row md:items-end md:justify-between gap-6">
        <div>
            <a href="{{ route('track.index') }}" class="inline-flex items-center gap-2 font-label-md text-secondary uppercase tracking-wider mb-6 hover:underline">
                <span class="material-symbols-outlined text-base no-mirror">arrow_forward</span>
                بحث عن طلب آخر
            </a>
            <h1 class="font-display-lg text-3xl md:text-display-lg text-primary mb-4 leading-tight">حالة الطلب</h1>
            <p class="font-body-lg text-on-surface-variant">تاريخ الطلب: {{ $order->created_at->format('Y/m/d — H:i') }}</p>
        </div>
        <div class="technical-outline bg-primary text-on-primary px-6 py-4 text-center md:text-right">
            <p class="font-label-md text-on-primary-container uppercase tracking-widest mb-1">رمز التتبع</p>
            <p class="font-headline-lg text-2xl tracking-widest">{{ $order->tracking_code }}</p>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
        <!-- Timeline -->
        <div class="lg:col-span-7">
            <div class="bg-white p-8 md:p-10 technical-outline text-right">
                <h2 class="font-headline-lg text-headline-lg text-primary mb-8 border-b border-outline-variant pb-4">مراحل الطلب</h2>

                @if($order->isCancelled())
                    <div class="flex items-start gap-4 p-6 bg-error-container/20 border border-error/30">
                        <span class="material-symbols-outlined text-error text-4xl no-mirror">cancel</span>
                        <div>
                            <h3 class="font-headline-md text-headline-md text-error mb-2">{{ \App\Models\Order::statusLabel('cancelled') }}</h3>
                            <p class="font-body-md text-on-surface-variant">{{ \App\Models\Order::statusDescription('cancelled') }}</p>
                        </div>
                    </div>
                @else
                    <ol class="space-y-0">
                        @foreach($timeline as $index => $step)
                            <li class="relative flex gap-6 pb-10 last:pb-0">
                                @if(!$loop->last)
                                    <div class="absolute top-12 right-5 w-px h-[calc(100%-3rem)] {{ $step['state'] === 'completed' ? 'bg-secondary' : 'bg-outline-variant' }}"></div>
                                @endif

                                <div class="shrink-0 w-10 h-10 flex items-center justify-center rounded-full border-2
                                    @if($step['state'] === 'completed') bg-secondary border-secondary text-on-secondary
                                    @elseif($step['state'] === 'current') bg-primary border-primary text-on-primary
                                    @else bg-surface border-outline-variant text-outline @endif">
                                    @if($step['state'] === 'completed')
                                        <span class="material-symbols-outlined text-xl no-mirror">check</span>
                                    @else
                                        <span class="material-symbols-outlined text-xl no-mirror">{{ $step['icon'] }}</span>
                                    @endif
                                </div>

                                <div class="flex-1 pt-1">
                                    <h3 class="font-headline-md text-headline-md mb-1
                                        @if($step['state'] === 'current') text-primary
                                        @elseif($step['state'] === 'completed') text-on-surface
                                        @else text-on-surface-variant @endif">
                                        {{ $step['label'] }}
                                        @if($step['state'] === 'current')
                                            <span class="inline-block mr-2 px-2 py-0.5 bg-secondary/10 text-secondary font-label-md text-[11px] uppercase tracking-wider">الحالة الحالية</span>
                                        @endif
                                    </h3>
                                    <p class="font-body-md text-on-surface-variant">{{ $step['description'] }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                @endif
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-5">
            <div class="bg-surface-container-lowest p-8 technical-outline text-right space-y-6">
                <h2 class="font-headline-lg text-headline-lg text-primary border-b border-outline-variant pb-4">ملخص الطلب</h2>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="font-label-md text-secondary uppercase tracking-wider mb-1">العميل</p>
                        <p class="font-body-md text-on-surface">{{ $order->customer_name ?: '—' }}</p>
                    </div>
                    <div>
                        <p class="font-label-md text-secondary uppercase tracking-wider mb-1">الحالة</p>
                        <p class="font-body-md text-on-surface">{{ \App\Models\Order::statusLabel($order->status) }}</p>
                    </div>
                    @if($order->dimensions)
                        <div>
                            <p class="font-label-md text-secondary uppercase tracking-wider mb-1">الأبعاد</p>
                            <p class="font-body-md text-on-surface">{{ $order->dimensions }}</p>
                        </div>
                    @endif
                    @if($order->quantity)
                        <div>
                            <p class="font-label-md text-secondary uppercase tracking-wider mb-1">الكمية</p>
                            <p class="font-body-md text-on-surface">{{ number_format($order->quantity) }} وحدة</p>
                        </div>
                    @endif
                    @if($order->cardboard_type)
                        <div>
                            <p class="font-label-md text-secondary uppercase tracking-wider mb-1">نوع الكرتون</p>
                            <p class="font-body-md text-on-surface">{{ $order->cardboardTypeLabel() }}</p>
                        </div>
                    @endif
                    @if($order->printing_type)
                        <div>
                            <p class="font-label-md text-secondary uppercase tracking-wider mb-1">الطباعة</p>
                            <p class="font-body-md text-on-surface">{{ $order->printingTypeLabel() }}</p>
                        </div>
                    @endif
                </div>

                @if($order->notes)
                    <div>
                        <p class="font-label-md text-secondary uppercase tracking-wider mb-1">ملاحظات</p>
                        <p class="font-body-md text-on-surface-variant leading-relaxed">{{ $order->notes }}</p>
                    </div>
                @endif

                <div class="pt-4 border-t border-outline-variant">
                    <p class="font-body-md text-on-surface-variant mb-4">هل لديك استفسار؟ تواصل مع فريقنا.</p>
                    <a href="{{ route('contact.index') }}" class="inline-block bg-secondary text-on-secondary px-6 py-3 font-headline-md text-[14px] font-bold uppercase tracking-wider hover:bg-on-secondary-fixed-variant transition-all">
                        اتصل بنا
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
