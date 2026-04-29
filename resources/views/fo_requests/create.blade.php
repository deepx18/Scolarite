<x-client.admin-layout :title="__('portal.requests.create.page_title')" activeRoute="requests">
    
    <!-- Page Header -->
    <x-client.admin-header 
        :title="__('portal.requests.create.header.title')"
        :description="__('portal.requests.create.header.description')"
        :breadcrumb="[
            ['label' => __('portal.requests.create.header.breadcrumb.requests'), 'url' => route('requests.index')],
            ['label' => __('portal.requests.create.header.breadcrumb.current')]
        ]"
    />

    <div class="max-w-4xl mx-auto">

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-8 p-4 bg-error-container border border-error rounded-lg">
                <p class="text-error font-semibold mb-2">{{ __('portal.requests.create.errors.title') }}</p>
                <ul class="text-error text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form 
            x-data="{ step: {{ session('step', 1) }} }"
            class="space-y-8"
            action="{{ route('requests.store') }}" 
            method="POST"
        >
            @csrf

            <!-- Stepper -->
            <div class="flex items-center justify-between">
                <template x-for="i in 3">
                    <div class="flex-1 flex items-center gap-2">
                        <div 
                            class="w-8 h-8 flex items-center justify-center rounded-full text-sm font-semibold"
                            :class="step >= i ? 'bg-primary text-white' : 'bg-gray-200 text-gray-500'"
                        >
                            <span x-text="i"></span>
                        </div>
                        <div 
                            class="h-1 flex-1"
                            :class="step > i ? 'bg-primary' : 'bg-gray-200'"
                        ></div>
                    </div>
                </template>
            </div>

            <!-- STEP 1 -->
            <div x-show="step === 1" x-transition>
                <x-client.admin-section 
                    :title="__('portal.requests.create.steps.type.title')" 
                    :description="__('portal.requests.create.steps.type.description')"
                >
                    <x-client.form-type-selection 
                        :types="$types"
                        :selectedType="old('type', $selectedType)"
                    />
                </x-client.admin-section>
            </div>

            <!-- STEP 2 -->
            <div x-show="step === 2" x-transition>
                <x-client.admin-section 
                    :title="__('portal.requests.create.steps.details.title')" 
                    :description="__('portal.requests.create.steps.details.description')"
                >
                    <x-client.form-specifications />
                </x-client.admin-section>
            </div>

            <!-- STEP 3 -->
            <div x-show="step === 3" x-transition>
                <x-client.admin-section 
                    :title="__('portal.requests.create.steps.comments.title')" 
                    :description="__('portal.requests.create.steps.comments.description')"
                >
                    <x-client.form-comments />
                </x-client.admin-section>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6">

                <!-- Back -->
                <button 
                    type="button"
                    x-show="step > 1"
                    @click="step--"
                    class="px-4 py-2 border rounded-xl"
                >
                    {{ __('portal.requests.create.actions.back') }}
                </button>

                <div class="flex gap-4 ml-auto">

                    <!-- Next -->
                    <button 
                        type="button"
                        x-show="step < 3"
                        @click="step++"
                        class="px-4 py-2 bg-primary text-white rounded-xl"
                    >
                        {{ __('portal.requests.create.actions.next') }}
                    </button>

                    <!-- Submit -->
                    <x-client.admin-button 
                        x-show="step === 3"
                        variant="primary" 
                        icon="send" 
                        type="submit"
                    >
                        {{ __('portal.requests.create.actions.submit') }}
                    </x-client.admin-button>

                </div>
            </div>

        </form>
    </div>

</x-client.admin-layout>
