<x-account-layout>
    <h4 class="mb-30">Shipping Details</h4>
    <form method="POST" action="{{ route('account.addresses.shipping.update') }}">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="phone">Phone *</label>
                <input type="text" id="phone" name="phone" required
                    value="{{ old('phone') ?? $user->shipping_phone }}" placeholder="Enter your phone number">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <x-store.select-locations :divisions="json_encode($divisions->toArray())" :division="$user->shipping_division" :district="$user->shipping_district" />
        <div class="row shipping_calculator">
            <div class="form-group">
                <label for="address">Address *</label>
                <input type="text" id="address" name="address" required
                    value="{{ old('address') ?? $user->shipping_address }}"
                    placeholder="House no. / building / street / area">
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group mb-30">
            <div class="form-group">
                <label for="landmark">Landmark</label>
                <input type="text" id="landmark" name="landmark"
                    value="{{ old('landmark') ?? $user->shipping_landmark }}" placeholder="E.g. beside train station">
                @error('landmark')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn mt-20">{{ $user->address ? 'Update' : 'Save' }}</button>
    </form>
</x-account-layout>
