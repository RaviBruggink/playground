@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary',
])

@php
    $baseClasses = "inline-block font-semibold py-2 px-4 rounded-full uppercase text-sm tracking-wide transition-all duration-200 w-full md:w-auto text-center";
    $variants = [
        'primary' => 'text-white border-2 border-solid hover:border-transparent hover:bg-white hover:text-black',
        'danger'  => 'bg-red-600 text-white hover:bg-red-700',
        'passive' => 'text-gray-400 hover:text-white hover:underline',
    ];

    $classes = $variants[$variant] ?? $variants['primary'];
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "$baseClasses $classes"]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => "$baseClasses $classes"]) }}>
        {{ $slot }}
    </button>
@endif