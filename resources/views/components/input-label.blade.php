@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-primary mb-2']) }}>
    {{ $value ?? $slot }}
</label>
