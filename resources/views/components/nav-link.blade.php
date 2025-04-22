@props(['active' => false])

@php
    $classes = $active
        ? 'text-amber-300 border-b-2 border-amber-300'
        : 'text-white hover:text-amber-300 hover:border-b hover:border-white/20';
@endphp

<a {{ $attributes->merge(['class' => "px-2 py-1 text-sm uppercase font-medium transition-all duration-200 $classes"]) }}
   aria-current="{{ $active ? 'page' : 'false' }}">
    {{ $slot }}
</a>