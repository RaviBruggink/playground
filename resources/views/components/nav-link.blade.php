@props(['active'])

@php
$classes = ($active ?? false)
    ? 'relative text-primary-600 dark:text-primary-400 after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-primary-600 dark:after:bg-primary-400'
    : 'relative text-neutral-600 dark:text-neutral-400 hover:text-primary-600 dark:hover:text-primary-400 after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-primary-600 dark:after:bg-primary-400 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>