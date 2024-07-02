@props([
    'options' => [],
    'value' => null,
    'placeholder' => "",
])

<select
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
    <option value="" {{ !$value ? 'selected' : '' }}>
            {{ $placeholder }}
    </option>
    @foreach ($options as $option)
        <option value="{{ $option['value'] }}" {{ $option['value'] == $value ? 'selected' : '' }}>
            {{ $option['label'] }}
        </option>
    @endforeach
</select>
