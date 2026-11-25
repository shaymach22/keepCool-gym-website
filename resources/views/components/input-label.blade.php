@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#F5F5F5] uppercase tracking-wide']) }}>
    {{ $value ?? $slot }}
</label>