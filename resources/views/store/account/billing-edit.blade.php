<x-account-layout>
    <h4 class="mb-30">Billing Details</h4>
    <form
        method="POST"
        action="{{ route('account.addresses.billing.update') }}"
    >
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="phone">Phone *</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    required
                    value="{{ old('phone') ?? $user->phone }}"
                    placeholder="Enter your phone number"
                />
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <x-store.select-locations
            :divisions="json_encode($divisions->toArray())"
            :division="$user->division"
            :district="$user->district"
        />
        <div class="row shipping_calculator">
            <div class="form-group">
                <label for="address">Address *</label>
                <input
                    type="text"
                    id="address"
                    name="address"
                    required
                    value="{{ old('address') ?? $user->address }}"
                    placeholder="House no. / building / street / area"
                />
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn mt-20">
            {{ $user->address ? 'Update' : 'Save' }}
        </button>
    </form>
</x-account-layout>
