@props(['href', 'method' => 'GET', 'name', 'value', 'options'])

<form
    action="{{ $href }}"
    method="{{ $method === 'GET' ? 'GET' : 'POST' }}"
    class="inline-block"
>
    @csrf
    @method($method)
    <select
        name="{{ $name }}"
        onchange="this.form.submit()"
        class="focus:shadow-outline block w-full appearance-none rounded border border-gray-400 bg-white px-2 py-1 pr-8 leading-tight shadow hover:border-gray-500 focus:outline-none"
    >
        @foreach ($options as $option)
            <option
                value="{{ $option['value'] }}"
                {{ $option['value'] == $value ? 'selected' : '' }}
            >
                {{ $option['label'] }}
            </option>
        @endforeach
    </select>
</form>
