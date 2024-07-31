@props(["method" => "POST", "action" => "", "confirm" => null, "confirmText" => ""])

<form
    method="{{ strtoupper($method) === "GET" ? "GET" : "POST" }}"
    action="{{ $action }}"
    class="{{ twMerge("rounded-lg bg-white p-5 shadow", $attributes["class"]) }}"
    {{ $attributes }}
    @if ($confirm)
        onsubmit="
                                                            event.preventDefault();
                                                            sweetalert({
                                                                title: '{{ $confirm }}',
                                                                text: '{{ $confirmText }}',
                                                                icon: 'warning',
                                                                dangerMode: true,
                                                                buttons: ['Cancel', 'Confirm'],
                                                            })
                                                            .then((result) => {
                                                                if (result) {
                                                                    this.submit();
                                                                }
                                                            });
                                                        "
    @endif
>
    @csrf
    @method($method)
    <div class="space-y-5">
        {{ $slot }}
    </div>
</form>
