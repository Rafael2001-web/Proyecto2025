@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full border-neutral/30 bg-white text-neutral placeholder:text-neutral/50 focus:border-secondary focus:ring-secondary/20 focus:ring-2 rounded-md shadow-sm disabled:bg-neutral/10 disabled:cursor-not-allowed disabled:opacity-50 transition-colors duration-150']) !!}>
