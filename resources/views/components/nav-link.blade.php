@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-2.5 text-sm font-medium bg-gray-700 text-white rounded-md'
            : 'flex items-center px-4 py-2.5 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white rounded-md transition-colors';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
