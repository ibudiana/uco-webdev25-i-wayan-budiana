@props([
    'icon' => 'fa-solid fa-user',
    'route' => 'dashboard',
])

<a href="{{ route($route) }}" class="font-medium text-gray-900 hover:text-amber-900">
    <i class="{{ $icon }}"></i>
</a>
