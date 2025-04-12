@props(['active'])

@php
    $classes = $active ?? false ? 'text-[#D4FCDB]' : '';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
