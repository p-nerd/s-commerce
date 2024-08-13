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
                        <label class="flex items-center justify-between">
                            <span class="w-[100px]">Heading 1:</span>
                            <input
                                type="text"
                                :name="'heroSlider-' + index + '-heading1'"
                                :value="heroSlider.heading1"
                                @change="e => updateHeroSlider(index, 'heading1', e.target.value)"
                                class="w-full rounded-md border px-3 py-2 text-gray-700 focus:border-blue-500 focus:outline-none"
                                placeholder="Enter heading 1"
                            />
                        </label>
                        <input
                            type="text"
                            :name="'heroSlider-' + index + '-heading2'"
                            :value="heroSlider.heading2"
                            @change="e => updateHeroSlider(index, 'heading2', e.target.value)"
                            class="w-full rounded-md border px-3 py-2 text-gray-700 focus:border-blue-500 focus:outline-none"
                            placeholder="Enter heading 2"
                        />
                        <input
                            type="text"
                            :name="'heroSlider-' + index + '-subheading'"
                            :value="heroSlider.subheading"
                            @change="e => updateHeroSlider(index, 'subheading', e.target.value)"
                            class="w-full rounded-md border px-3 py-2 text-gray-700 focus:border-blue-500 focus:outline-none"
                            placeholder="Enter subheading"
                        />
                        <div class="flex items-center justify-between">
                            <div class="w-[250px]">
                                <img :src="heroSlider.image" />
                            </div>
                            <input
                                type="file"
                                :name="'heroSlider-' + index + '-image'"
                                placeholder="Enter image URL"
                            />
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
                            class="lucide lucide-trash-2 cursor-pointer"
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
