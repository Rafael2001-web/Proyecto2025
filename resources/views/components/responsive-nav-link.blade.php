@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-4 pe-4 py-3 border-l-4 border-accent text-start text-base font-semibold text-accent bg-primary/20 focus:outline-none focus:text-accent focus:bg-primary/30 focus:border-accent transition-all duration-200 ease-in-out'
            : 'block w-full ps-4 pe-4 py-3 border-l-4 border-transparent text-start text-base font-medium text-white hover:text-accent hover:bg-primary/10 hover:border-accent/50 focus:outline-none focus:text-accent focus:bg-primary/10 focus:border-accent/50 transition-all duration-200 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
