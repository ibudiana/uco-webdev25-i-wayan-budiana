@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'dark:bg-gray-900 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-gray-600 dark:text-gray-50']) }}>
