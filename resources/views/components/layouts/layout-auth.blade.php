<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    <title>@yield('title')</title>
</head>
<body class="max-w-7xl mx-auto bg-neutral-50 font-plus-jakarta px-4 py-4 md:overflow-hidden">
    <div class="min-h-screen flex items-center">
        {{ $slot }}
    </div>

    @stack('scripts')
</body>
</html>
