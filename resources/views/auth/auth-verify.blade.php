<x-guest-layout>
    <div class="mt-4 flex items-center justify-between">
        <form
            method="POST"
            action="{{ route('verify') }}"
            class="mx-auto space-y-3"
        >
            @csrf

            <input type="hidden" name="email" value="{{ $email }}" />
            <input type="hidden" name="password" value="{{ $password }}" />
            <input type="hidden" name="remember" value="{{ $remember }}" />

            <p
                id="helper-text-explanation"
                class="mt-2 text-center text-sm text-gray-500 dark:text-gray-400"
            >
                The verification code:
                <span class="font-bold">{{ $email }}</span>
            </p>
            <div class="mb-2 flex justify-center space-x-2 rtl:space-x-reverse">
                <div>
                    <label for="code-1" class="sr-only">First code</label>
                    <input
                        name="code_1"
                        type="text"
                        maxlength="1"
                        data-focus-input-init
                        data-focus-input-next="code-2"
                        id="code-1"
                        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block h-9 w-9 rounded-lg border border-gray-300 bg-white py-3 text-center text-sm font-extrabold text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                    />
                </div>
                <div>
                    <label for="code-2" class="sr-only">Second code</label>
                    <input
                        name="code_2"
                        type="text"
                        maxlength="1"
                        data-focus-input-init
                        data-focus-input-prev="code-1"
                        data-focus-input-next="code-3"
                        id="code-2"
                        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block h-9 w-9 rounded-lg border border-gray-300 bg-white py-3 text-center text-sm font-extrabold text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                    />
                </div>
                <div>
                    <label for="code-3" class="sr-only">Third code</label>
                    <input
                        name="code_3"
                        type="text"
                        maxlength="1"
                        data-focus-input-init
                        data-focus-input-prev="code-2"
                        data-focus-input-next="code-4"
                        id="code-3"
                        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block h-9 w-9 rounded-lg border border-gray-300 bg-white py-3 text-center text-sm font-extrabold text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                    />
                </div>
                <div>
                    <label for="code-4" class="sr-only">Fourth code</label>
                    <input
                        name="code_4"
                        type="text"
                        maxlength="1"
                        data-focus-input-init
                        data-focus-input-prev="code-3"
                        data-focus-input-next="code-5"
                        id="code-4"
                        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block h-9 w-9 rounded-lg border border-gray-300 bg-white py-3 text-center text-sm font-extrabold text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                    />
                </div>
            </div>

            <div class="flex w-full justify-center">
                <x-shared.primary-button>Verify</x-shared.primary-button>
            </div>

            <p
                id="helper-text-explanation"
                class="mt-2 text-center text-sm text-gray-500 dark:text-gray-400"
            >
                Please introduce the 6 digit code we sent via email.
            </p>
            <div class="text-center text-sm text-gray-500 dark:text-gray-400">
                <span id="countdown" data-duration="{{ $duration }}"></span>
            </div>
            <!-- <div id="resendButton" class="hidden justify-center"> -->
            <!--     <x-shared.secondary-button type="submit" > -->
            <!--         Resent Verification Code -->
            <!--     </x-shared.secondary-button> -->
            <!-- </div> -->
        </form>
    </div>
</x-guest-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputs = document.querySelectorAll(
            'input[data-focus-input-init]',
        );

        inputs.forEach((input) => {
            input.addEventListener('input', function (e) {
                if (this.value.length === this.maxLength) {
                    const nextInputId = this.getAttribute(
                        'data-focus-input-next',
                    );
                    if (nextInputId) {
                        const nextInput = document.getElementById(nextInputId);
                        if (nextInput) {
                            nextInput.focus();
                        }
                    }
                }
            });

            input.addEventListener('keydown', function (e) {
                if (e.key === 'Backspace' && this.value.length === 0) {
                    const prevInputId = this.getAttribute(
                        'data-focus-input-prev',
                    );
                    if (prevInputId) {
                        const prevInput = document.getElementById(prevInputId);
                        if (prevInput) {
                            prevInput.focus();
                            // Move cursor to the end of the input
                            prevInput.setSelectionRange(
                                prevInput.value.length,
                                prevInput.value.length,
                            );
                        }
                    }
                }
            });
        });

        const countdownElement = document.getElementById('countdown');
        const resendButtonElement = document.getElementById('resendButton');
        let duration = parseInt(countdownElement.getAttribute('data-duration'));

        function updateCountdown() {
            if (duration > 0) {
                const minutes = Math.floor(duration / 60000); // Get full minutes
                const seconds = Math.ceil((duration % 60000) / 1000); // Get remaining seconds

                let displayString = '';
                if (minutes > 0) {
                    displayString +=
                        minutes + (minutes === 1 ? ' minute' : ' minutes');
                }
                if (seconds > 0 || minutes === 0) {
                    if (minutes > 0) displayString += ' - ';
                    displayString +=
                        seconds + (seconds === 1 ? ' second' : ' seconds');
                }

                countdownElement.textContent = displayString;

                duration -= 1000; // Decrease by 1 second (1000 milliseconds)
                setTimeout(updateCountdown, 1000);
            } else {
                countdownElement.textContent = 'Time expired';
                resendButtonElement.classList.remove('hidden');
                resendButtonElement.classList.add('flex');
            }
        }

        updateCountdown();
    });
</script>
