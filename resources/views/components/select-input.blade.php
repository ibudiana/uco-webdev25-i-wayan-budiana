<select
    id="{{ $id }}"
    name="{{ $name }}"
    @if($required) required @endif
    @if($disabled) disabled @endif
    {{ $attributes->merge(['class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}
>
    @foreach($options as $key => $label)
        <option value="{{ $key }}" @selected(old($name, $value) == $key)>
            {{ $label }}
        </option>
    @endforeach
</select>
