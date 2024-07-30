<x-account-layout>
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">Hello {{ $user->name }}!</h3>
        </div>
        <div class="card-body">
            <p>
                From your account dashboard. you can easily check &amp; view your
                <a href="{{ route('account.orders') }}">recent orders</a>,<br>
                manage your <a href="{{ route('account.addresses') }}">shipping and billing addresses</a>
                and <a href="{{ route('account.details') }}">edit your password and account details.</a>
            </p>
        </div>
    </div>
</x-account-layout>
