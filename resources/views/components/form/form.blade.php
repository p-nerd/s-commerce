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
    {{ $attributes->merge(['class' => 'rounded-lg p-5']) }}
    onsubmit="{{ $confirm ? 'handleSubmitFrom(event)' : '' }}"
>
    @csrf
    @method($method)
    <div class="space-y-5">
        {{ $slot }}
    </div>
</form>
