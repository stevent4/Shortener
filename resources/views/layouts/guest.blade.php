<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif" href="{{ asset('roket.gif') }}">
<link rel="shortcut icon" type="image/gif" href="{{ asset('roket.gif') }}">
    <title>{{ config('app.name') }} - Login</title>
    @vite('resources/css/app.css')
@vite('resources/js/app.js')

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ?? 'My Shortener' }}">
    <meta property="og:description" content="{{ $description ?? 'Aplikasi Short Link aman & fun!' }}">
    <meta property="og:image" content="{{ $image ?? asset('img.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">

</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="flex flex-col md:flex-row w-full max-w-6xl max-h-[90vh] bg-white rounded-xl shadow-xl overflow-hidden">

        <!-- Hanya scroll di mobile, hilang di md+ -->
        <div class="flex-1 overflow-y-auto md:overflow-y-visible">
            {{ $slot }}
        </div>

    </div>

</body>

</html>
