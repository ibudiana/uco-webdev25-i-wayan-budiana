<select
    id="{{ $id }}"
    name="{{ $name }}"
    @if($required) required @endif
    @if($disabled) disabled @endif
    {{ $attributes->merge(['class' => 'dark:bg-gray-900 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-gray-600 dark:text-gray-50']) }}
>
    @foreach($options as $key => $label)
        <option value="{{ $key }}" @selected(old($name, $value) == $key)>
            {{ $label }}
        </option>
    @endforeach
</select>
