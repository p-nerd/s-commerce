@props(['method' => 'POST', 'action' => '', 'confirm' => null, 'confirmText' => ''])

<script>
    function handleSubmitFrom(event) {
        event.preventDefault();
        sweetalert({
            title: '{{ $confirm }}',
            text: '{{ $confirmText }}',
            icon: 'warning',
            dangerMode: true,
            buttons: ['Cancel', 'Confirm'],
        }).then((result) => {
            if (result) {
                event.target.submit();
            }
        });
    }
</script>

<form
    method="{{ $method === 'GET' ? 'GET' : 'POST' }}"
    action="{{ $action }}"
    {{ $attributes->merge(['class' => 'rounded-lg bg-white p-5 shadow']) }}
    onsubmit="{{ $confirm ? 'handleSubmitFrom(event)' : '' }}"
>
    @csrf
    @method($method)
    <div class="space-y-5">
        {{ $slot }}
    </div>
</form>
