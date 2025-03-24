@props([
    'type' => 'submit',
    'variant' => 'primary',
])

@php
    $buttonClasses = 'bg-primary-500 text-neutral-50 p-3 w-full rounded-lg cursor-pointer hover:bg-primary-600 transition duration-300';

    $variantClasses = [
        'primary' => 'bg-secondary-700 text-neutral-50 hover:bg-secondary-800',
        'secondary' => 'bg-neutral-200 text-neutral-900 hover:bg-neutral-300',
        'outline' => 'bg-transparent border border-secondary-700 text-secondary-700 hover:bg-secondary-700/10'
    ];

    $classes = $buttonClasses . ' ' . ($variantClasses[$variant] ?? $variantClasses['primary']);
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</button>
