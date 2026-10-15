<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="theme-color" content="#ffffff">

    <title>
        @yield('title', 'BeautyStore')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="min-h-screen bg-gray-50 text-slate-900 antialiased">

    {{-- NAVBAR --}}
    @include('layouts.customer.navbar')

    {{-- MAIN CONTENT --}}
    <main class="w-full min-w-0">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('layouts.customer.footer')

</body>
</html>