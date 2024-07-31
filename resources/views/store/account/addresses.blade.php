<x-account-layout>
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-lg-0 mb-3">
                <div class="card-header">
                    <h3 class="mb-0">Billing Address</h3>
                </div>

                @if ($user->address)
                    <div class="card-body">
                        <address>
                            {{ $user->address }}
                            <br />
                            {{ $user->district }},
                            <br />
                            {{ $user->division }}
                            <br />
                        </address>
                        <p>Phone: {{ $user->phone }}</p>
                        <a
                            href="{{ route('account.addresses.billing.edit') }}"
                            class="btn-small"
                        >
                            Edit
                        </a>
                    </div>
                @else
                    <div class="card-body">
                        <p>There is no billing address</p>
                        <a
                            href="{{ route('account.addresses.billing.edit') }}"
                            class="btn-small"
                        >
                            Add new one
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Shipping Address</h5>
                </div>
                @if ($user->shipping_address)
                    <div class="card-body">
                        <address>
                            {{ $user->shipping_address }}
                            <br />
                            {{ $user->shipping_district }},
                            <br />
                            {{ $user->shipping_division }}
                            <br />
                        </address>
                        <p>Phone: {{ $user->shipping_phone }}</p>
                        @if ($user->shipping_landmark)
                            <p>Landmark: {{ $user->shipping_landmark }}</p>
                        @endif

                        <a
                            href="{{ route('account.addresses.shipping.edit') }}"
                            class="btn-small"
                        >
                            Edit
                        </a>
                    </div>
                @else
                    <div class="card-body">
                        <p>There is no shipping address</p>
                        <a
                            href="{{ route('account.addresses.shipping.edit') }}"
                            class="btn-small"
                        >
                            Add new one
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-account-layout>
