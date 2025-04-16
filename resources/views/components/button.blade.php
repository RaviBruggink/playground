<!-- resources/views/components/button.blade.php -->
@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary',
])

@php
    $baseClasses = "font-semibold py-2 px-4 rounded transition";
    $variants = [
        'primary' => 'bg-blue-600 hover:bg-blue-700 text-white',
        'danger'  => 'bg-red-600 hover:bg-red-700 text-white',
        'passive' => 'text-gray-600 hover:underline',
    ];

    $classes = $variants[$variant] ?? $variants['primary'];
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "$classes $baseClasses"]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => "$classes $baseClasses"]) }}>
        {{ $slot }}
    </button>
@endif