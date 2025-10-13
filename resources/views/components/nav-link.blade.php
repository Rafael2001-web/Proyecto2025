@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 pt-1 pb-1 border-b-2 border-accent text-sm font-semibold leading-5 text-accent focus:outline-none focus:border-accent transition-all duration-200 ease-in-out'
            : 'inline-flex items-center px-3 pt-1 pb-1 border-b-2 border-transparent text-sm font-medium leading-5 text-white hover:text-accent hover:border-accent/50 focus:outline-none focus:text-accent focus:border-accent/50 transition-all duration-200 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
