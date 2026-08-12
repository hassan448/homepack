<header class="full-width top-0 z-50 sticky bg-surface dark:bg-primary border-b border-outline-variant dark:border-primary-container">
    <div class="flex justify-between items-center max-w-[1280px] mx-auto px-4 md:px-margin-desktop h-20">
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ asset('image.png') }}" alt="هوم باك" class="h-12 md:h-16 w-auto object-contain">
        </a>
        <div class="flex md:hidden items-center gap-4">
            <a href="{{ route('contact.index') }}" class="bg-secondary text-on-secondary px-4 py-2 text-sm font-bold uppercase tracking-wider rounded-sm">طلب سعر</a>
            <span class="material-symbols-outlined text-primary cursor-pointer">menu</span>
        </div>
        <nav class="hidden md:flex gap-8 items-center">
            @if(($navPages ?? collect())->has('home'))
            <a class="font-headline-md text-headline-md uppercase tracking-wider transition-all {{ ($activePage ?? '') === 'index' ? 'text-secondary dark:text-secondary-fixed-dim border-b-2 border-secondary font-bold' : 'text-on-surface-variant dark:text-on-primary-container hover:text-primary dark:hover:text-primary-fixed' }}" href="{{ route('home') }}">الرئيسية</a>
            @endif
            @if(($navPages ?? collect())->has('products'))
            <a class="font-headline-md text-headline-md uppercase tracking-wider transition-all {{ ($activePage ?? '') === 'products' ? 'text-secondary dark:text-secondary-fixed-dim border-b-2 border-secondary font-bold' : 'text-on-surface-variant dark:text-on-primary-container hover:text-primary dark:hover:text-primary-fixed' }}" href="{{ route('products.index') }}">المنتجات</a>
            @endif
            @if(($navPages ?? collect())->has('about'))
            <a class="font-headline-md text-headline-md uppercase tracking-wider transition-all {{ ($activePage ?? '') === 'about' ? 'text-secondary dark:text-secondary-fixed-dim border-b-2 border-secondary font-bold' : 'text-on-surface-variant dark:text-on-primary-container hover:text-primary dark:hover:text-primary-fixed' }}" href="{{ route('about') }}">من نحن</a>
            @endif
            @if(($navPages ?? collect())->has('track'))
            <a class="font-headline-md text-headline-md uppercase tracking-wider transition-all {{ ($activePage ?? '') === 'track' ? 'text-secondary dark:text-secondary-fixed-dim border-b-2 border-secondary font-bold' : 'text-on-surface-variant dark:text-on-primary-container hover:text-primary dark:hover:text-primary-fixed' }}" href="{{ route('track.index') }}">تتبع الطلب</a>
            @endif
            @if(($navPages ?? collect())->has('contact'))
            <a class="font-headline-md text-headline-md uppercase tracking-wider transition-all {{ ($activePage ?? '') === 'contact' ? 'text-secondary dark:text-secondary-fixed-dim border-b-2 border-secondary font-bold' : 'text-on-surface-variant dark:text-on-primary-container hover:text-primary dark:hover:text-primary-fixed' }}" href="{{ route('contact.index') }}">اتصل بنا</a>
            @endif
        </nav>
        <a href="{{ route('contact.index') }}" class="hidden md:block bg-secondary text-on-secondary px-6 py-3 font-headline-md text-headline-md font-bold uppercase tracking-wider scale-100 active:scale-95 transition-all">طلب اقتراح سعر</a>
    </div>
</header>
