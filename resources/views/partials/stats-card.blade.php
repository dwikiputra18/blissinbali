@props(['title', 'value', 'color', 'trend'])

@php
    // Mapping colors to Tailwind classes
    $colors = [
        'blue' => 'border-blue-950 text-white bg-blue-950',
        'green' => 'border-green-500 text-green-600 bg-green-50',
        'yellow' => 'border-yellow-500 text-yellow-600 bg-yellow-50',
        'red' => 'border-red-500 text-red-600 bg-red-50',
    ];
    $selectedColor = $colors[$color] ?? $colors['blue'];
@endphp

<div class="bg-white p-6 rounded-xl shadow-sm border-l-4 {{ explode(' ', $selectedColor)[0] }} hover:shadow-md transition-shadow duration-300">
    <div class="flex justify-between items-start">
        <div>
            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">{{ $title }}</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $value }}</h3>
        </div>
        <div class="p-2 rounded-lg {{ $selectedColor }}">
            @if($color == 'blue') <i class="fas fa-shopping-cart"></i>
            @elseif($color == 'green') <i class="fas fa-wallet"></i>
            @elseif($color == 'yellow') <i class="fas fa-hotel"></i>
            @else <i class="fas fa-exclamation-circle"></i>
            @endif
        </div>
    </div>
    <div class="mt-4 flex items-center">
        <span class="text-xs font-semibold {{ str_contains($trend, '+') ? 'text-green-600' : (str_contains($trend, '-') ? 'text-red-600' : 'text-gray-400') }}">
            {{ $trend }}
        </span>
        <span class="text-xs text-gray-400 ml-2 italic text-[10px]">since last month</span>
    </div>
</div>
