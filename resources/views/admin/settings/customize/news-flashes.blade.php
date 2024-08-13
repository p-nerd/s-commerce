<div
    class="rounded-md border bg-white py-5"
    x-data-flashes="{{ json_encode($newsFlashes->value) }}"
    x-data="{
        flashes: JSON.parse($el.getAttribute('x-data-flashes')),
        addFlash() {
            this.flashes.push('')
        },
        removeFlash(index) {
            this.flashes.splice(index, 1)
        },
        updateFlash(index, value) {
            this.flashes[index] = value
        },
        submitForm(e) {
            e.target.submit()
        },
    }"
>
    <div class="mx-auto w-3/4 space-y-3">
        <h2 class="text-lg font-semibold leading-tight text-gray-800">
            News Flashes
        </h2>
        <form
            method="POST"
            action="{{ route('admin.settings.customize.news-flashes.update') }}"
            class="space-y-2"
            @submit.prevent="submitForm"
        >
            @csrf
            @method('PATCH')
            <template x-for="(flash, index) in flashes" :key="index">
                <div class="mb-2 flex items-center space-x-2">
                    <input
                        type="text"
                        :name="'flash-' + index"
                        :value="flash"
                        @change="e => updateFlash(index, e.target.value)"
                        class="w-full rounded-md border px-3 py-2 text-gray-700 focus:border-blue-500 focus:outline-none"
                        placeholder="Enter news flash"
                    />
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="lucide lucide-trash-2"
                        @click="removeFlash(index)"
                    >
                        <path d="M3 6h18" />
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                        <line x1="10" x2="10" y1="11" y2="17" />
                        <line x1="14" x2="14" y1="11" y2="17" />
                    </svg>
                </div>
            </template>
            <div class="flex items-center justify-between">
                <div class="flex flex-col justify-center">
                    <x-shared.primary-button
                        type="button"
                        @click="addFlash"
                        class="bg-green-500 text-white"
                    >
                        + Add
                    </x-shared.primary-button>
                </div>
                <x-form.submit style="padding-top: 0">
                    Save Changes
                </x-form.submit>
            </div>
        </form>
    </div>
</div>
