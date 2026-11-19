<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SoundCrafted')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite([
    'resources/css/style.css',
    'resources/css/main.css',
    'resources/css/favourites.css',
    'resources/css/musicGroup.css',
    'resources/css/musicGroupMain.css',
    'resources/css/mistake.css',
    'resources/css/survey.css',
    'resources/css/tool.css',
    'resources/css/toolsMain.css',
    'resources/css/typesTools.css',
    'resources/css/feedback.css',
    'resources/js/feedback.js',
    'resources/js/favorites.js',
    'resources/js/app.js'
    ])
    
    @stack('styles')
</head>
<body>

    @include('layouts.partials.header')

    <main>

        @yield('content')
    </main>

    @include('layouts.partials.footer')
    
    @stack('scripts')
    
</body>
</html>