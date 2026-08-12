<footer class="full-width bottom-0 bg-primary dark:bg-tertiary-container border-t border-primary-container">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter max-w-[1280px] mx-auto px-4 md:px-margin-desktop py-16 text-right">
        <div class="col-span-1">
            <div class="mb-6"><img src="{{ asset('image.png') }}" alt="هوم باك" class="h-10 w-auto object-contain"></div>
            <p class="font-body-md text-on-primary-container leading-relaxed">{!! $siteSettings->get('footer_description')?->value ?? 'الشركة الرائدة في حلول الكرتون الهيكلية منذ عام 1984. هندسة للقوة، وتصميم للاستدامة.' !!}</p>
        </div>
        <div class="col-span-1">
            <h5 class="text-on-primary font-headline-md text-headline-md mb-6 uppercase">التنقل</h5>
            <ul class="space-y-4">
                @if(($navPages ?? collect())->has('home'))
                <li><a class="text-on-primary-container hover:text-on-primary font-body-md hover:underline decoration-secondary decoration-2 transition-all" href="{{ route('home') }}">الرئيسية</a></li>
                @endif
                @if(($navPages ?? collect())->has('products'))
                <li><a class="text-on-primary-container hover:text-on-primary font-body-md hover:underline decoration-secondary decoration-2 transition-all" href="{{ route('products.index') }}">المنتجات</a></li>
                @endif
                @if(($navPages ?? collect())->has('about'))
                <li><a class="text-on-primary-container hover:text-on-primary font-body-md hover:underline decoration-secondary decoration-2 transition-all" href="{{ route('about') }}">من نحن</a></li>
                @endif
                @if(($navPages ?? collect())->has('contact'))
                <li><a class="text-on-primary-container hover:text-on-primary font-body-md hover:underline decoration-secondary decoration-2 transition-all" href="{{ route('contact.index') }}">اتصل بنا</a></li>
                @endif
                @if(($navPages ?? collect())->has('track'))
                <li><a class="text-on-primary-container hover:text-on-primary font-body-md hover:underline decoration-secondary decoration-2 transition-all" href="{{ route('track.index') }}">تتبع الطلب</a></li>
                @endif
            </ul>
        </div>
        <div class="col-span-1">
            <h5 class="text-on-primary font-headline-md text-headline-md mb-6 uppercase">الموارد</h5>
            <ul class="space-y-4">
                <li><a class="text-on-primary-container hover:text-on-primary font-body-md hover:underline decoration-secondary decoration-2 transition-all" href="#">شهادة الأيزو</a></li>
                <li><a class="text-on-primary-container hover:text-on-primary font-body-md hover:underline decoration-secondary decoration-2 transition-all" href="#">الخدمات اللوجستية العالمية</a></li>
            </ul>
        </div>
        <div class="col-span-1">
            <h5 class="text-on-primary font-headline-md text-headline-md mb-6 uppercase">تواصل معنا</h5>
            <p class="font-body-md text-on-primary-container text-sm">{!! $siteSettings->get('footer_address')?->value ?? 'المقر: المنطقة الصناعية، بوابة 4<br/>شارع التصنيع' !!}</p>
        </div>
    </div>
    <div class="max-w-[1280px] mx-auto px-4 md:px-margin-desktop py-8 border-t border-primary-container text-center">
        <p class="font-body-md text-on-tertiary-container">© {{ date('Y') }} شركة هوم باك للتصنيع. جميع الحقوق محفوظة.</p>
    </div>
</footer>
