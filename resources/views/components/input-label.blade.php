@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-600 dark:text-gray-50']) }}>
    {{ $value ?? $slot }}
</label>
