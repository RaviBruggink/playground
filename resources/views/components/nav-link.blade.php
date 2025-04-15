@props(['active' => false])

@php
    $classes = $active
        ? 'text-white bg-gray-900 border-b-2 border-blue-500'
        : 'text-gray-300 hover:text-white hover:bg-gray-700';
@endphp

<a {{ $attributes->merge(['class' => "px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out $classes"]) }}
    aria-current="{{ $active ? 'page' : 'false' }}">
    {{ $slot }}
</a>
