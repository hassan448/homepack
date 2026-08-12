<!DOCTYPE html>
<html class="light" lang="ar" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'هوم باك | تصنيع صناعي')</title>
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet"/>
    @stack('head')
</head>
<body class="bg-background text-on-background font-body-md overflow-x-hidden">
@include('partials.header', ['activePage' => $activePage ?? ''])
<main>
    @yield('content')
</main>
@include('partials.footer')
@stack('scripts')
</body>
</html>
