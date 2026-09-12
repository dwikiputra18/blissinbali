@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'flex items-center py-3 px-6 bg-indigo-800 text-white border-l-4 border-indigo-400'
            : 'flex items-center py-3 px-6 text-indigo-300 hover:bg-indigo-800 hover:text-white transition duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <i class="{{ $icon }} mr-3 w-5"></i>
    <span class="text-sm font-medium">{{ $slot }}</span>
</a>
