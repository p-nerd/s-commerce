<div
    class="rounded-md border bg-white py-5"
    x-data-hero-sliders="{{ json_encode($heroSliders->value) }}"
    x-data="{
        heroSliders: JSON.parse($el.getAttribute('x-data-hero-sliders')),
        addHeroSlider() {
            this.heroSliders.push({
                heading1: '',
                heading2: '',
                subheading: '',
                image: '',
            })
        },
        removeHeroSlider(index) {
            this.heroSliders.splice(index, 1)
        },
        updateHeroSlider(index, key, value) {
            this.heroSliders[index][key] = value
        },
        removeImage(index) {
            this.heroSliders[index].image = ''
        },
        submitForm(e) {
            e.target.submit()
        },
    }"
>
    <div class="mx-auto w-3/4 space-y-3">
        <h2 class="text-lg font-semibold leading-tight text-gray-800">
            Hero Sliders
        </h2>
        <form
            method="POST"
            action="{{ route('admin.settings.customize.hero-sliders.update') }}"
            class="space-y-4"
            @submit.prevent="submitForm"
        >
            @csrf
            @method('PATCH')
            <template
                x-for="(heroSlider, index) in heroSliders"
                :key="index"
            >
                <div class="flex w-full space-x-4">
                    <div class="mb-2 flex w-full flex-col space-y-2">
                        <label class="flex space-x-2">
                            <span class="w-[120px]">Heading 1:</span>
                            <input
                                type="text"
                                :name="'hero-slider-' + index + '-heading1'"
                                :value="heroSlider.heading1"
                                @change="e => updateHeroSlider(index, 'heading1', e.target.value)"
                                class="w-full rounded-md border text-gray-700 focus:border-blue-500 focus:outline-none"
                                placeholder="Enter heading 1"
                            />
                        </label>

                        <label class="flex space-x-2">
                            <span class="w-[120px]">Heading 2:</span>
                            <input
                                type="text"
                                :name="'hero-slider-' + index + '-heading2'"
                                :value="heroSlider.heading2"
                                @change="e => updateHeroSlider(index, 'heading2', e.target.value)"
                                class="w-full rounded-md border px-3 py-2 text-gray-700 focus:border-blue-500 focus:outline-none"
                                placeholder="Enter heading 2"
                            />
                        </label>

                        <label class="flex space-x-2">
                            <span class="w-[120px]">Subheading:</span>
                            <input
                                type="text"
                                :name="'hero-slider-' + index + '-subheading'"
                                :value="heroSlider.subheading"
                                @change="e => updateHeroSlider(index, 'subheading', e.target.value)"
                                class="w-full rounded-md border px-3 py-2 text-gray-700 focus:border-blue-500 focus:outline-none"
                                placeholder="Enter subheading"
                            />
                        </label>

                        <div class="flex justify-between">
                            <label class="flex space-x-2">
                                <span class="w-[103px]">Image:</span>
                                <input
                                    type="file"
                                    :name="'hero-slider-' + index + '-image'"
                                    @change="e => {
                                    const file = e.target.files[0];
                                    if (file) {
                                        const reader = new FileReader();
                                        reader.onload = event => {
                                            updateHeroSlider(index, 'image', event.target.result);
                                        };
                                        reader.readAsDataURL(file);
                                    }
                                }"
                                    class="focus:border-blue-500 focus:outline-none"
                                />
                            </label>
                            <div class="relative w-[300px]">
                                <button
                                    x-show="heroSlider.image"
                                    type="button"
                                    @click="removeImage(index)"
                                    class="absolute left-3 top-3 cursor-pointer text-sm text-red-500"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="18"
                                        height="18"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path d="M3 6h18" />
                                        <path
                                            d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"
                                        />
                                        <path
                                            d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"
                                        />
                                        <line x1="10" x2="10" y1="11" y2="17" />
                                        <line x1="14" x2="14" y1="11" y2="17" />
                                    </svg>
                                </button>
                                <img :src="heroSlider.image" />
                            </div>
                        </div>
                    </div>

                    <div>
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
                            class="cursor-pointer text-red-500"
                            @click="removeHeroSlider(index)"
                        >
                            <path d="M3 6h18" />
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                            <line x1="10" x2="10" y1="11" y2="17" />
                            <line x1="14" x2="14" y1="11" y2="17" />
                        </svg>
                    </div>
                </div>
            </template>

            <div class="flex items-center justify-between">
                <div class="flex flex-col justify-center">
                    <x-shared.primary-button
                        type="button"
                        @click="addHeroSlider"
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
