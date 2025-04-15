<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">
    <nav class="w-full bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-end items-center space-x-6">
            <x-nav-link href="{{ url('/') }}" :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link href="{{ url('about') }}" :active="request()->is('about')">About</x-nav-link>
            <x-nav-link href="{{ url('contact') }}" :active="request()->is('contact')">Contact</x-nav-link>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-8">
        {{ $slot }}
    </main>
</body>

</html>
