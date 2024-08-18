<x-account-layout>
    <div class="card">
        <div class="card-header">
            <h5>Account Details</h5>
        </div>
        <div class="card-body">
            <form
                method="POST"
                action="{{ route('account.details.update') }}"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="name">
                            Name
                            <span class="required">*</span>
                        </label>
                        <input
                            id="name"
                            class="form-control"
                            name="name"
                            type="text"
                            value="{{ old('name') ?? $user->name }}"
                            required
                        />
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label for="email">
                            Email Address
                            <span class="required">*</span>
                        </label>
                        <input
                            id="email"
                            class="form-control"
                            name="email"
                            type="email"
                            value="{{ old('email') ?? $user->email }}"
                            required
                        />
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="avatar">Avatar</label>
                        <input
                            id="avatar"
                            class="form-control"
                            name="avatar"
                            type="file"
                            style="display: flex; align-items: center"
                        />
                        @error('avatar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div
                        class="form-group col-md-6"
                        style="
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                    >
                        @if ($user->avatar)
                            <div
                                style="
                                    width: 150px;
                                    height: 150px;
                                    border-radius: 50%;
                                    overflow: hidden;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                "
                            >
                                <img
                                    style="
                                        width: 100%;
                                        height: 100%;
                                        object-fit: cover;
                                    "
                                    src="{{ public_image($user->avatar) }}"
                                />
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn">Save Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-20">
        <div class="card-body">
            <form method="POST" action="{{ route('account.details.update') }}">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="current-password">Current Password</label>
                        <input
                            id="current-password"
                            class="form-control"
                            name="current_password"
                            type="password"
                        />
                        @error('current_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label for="new-password">New Password</label>
                        <input
                            id="new-password"
                            class="form-control"
                            name="password"
                            type="password"
                        />
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label for="confirm-password">Confirm Password</label>
                        <input
                            id="confirm-password"
                            class="form-control"
                            name="password_confirmation"
                            type="password"
                        />
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn">Save Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-account-layout>
