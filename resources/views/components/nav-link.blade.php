@props(['active' => false])

@php
    $classes = $active
        ? 'text-white border-b-2 border-white'
        : 'text-white hover:text-gray-300 hover:border-b hover:border-white/20';
@endphp

<a {{ $attributes->merge(['class' => "px-2 py-1 text-sm uppercase font-medium transition-all duration-200 $classes"]) }}
   aria-current="{{ $active ? 'page' : 'false' }}">
    {{ $slot }}
</a>