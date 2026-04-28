<!-- Form Section: Request Type Selection -->
<section class="bg-surface-container-low p-1 rounded-xl">
    <div class="bg-surface-container-lowest p-6 md:p-8 rounded-2xl shadow-sm">
        <div class="flex items-start gap-4 mb-6">
            <div class="w-12 h-12 bg-blue-50 text-secondary rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined">category</span>
            </div>
            <div>
                <h3 class="text-lg md:text-xl font-headline font-bold text-primary">
                    {{ __('portal.requests.create.type_selection.title') }}
                </h3>
                <p class="text-sm text-on-surface-variant mt-1">
                    {{ __('portal.requests.create.type_selection.description') }}
                </p>
            </div>
        </div>

        <div class="space-y-4">
            @foreach ($types as $key => $label)
                <label
                    class="relative flex items-start gap-4 bg-surface rounded-2xl p-4 md:p-5 border transition-shadow cursor-pointer hover:shadow-md hover:border-primary/40
                            {{ old('type', $selectedType) === $key ? 'border-primary bg-primary/5 shadow-md' : 'border-outline-variant/10' }}">
                    <input type="radio" name="type" value="{{ $key }}" class="hidden peer" {{ old('type', $selectedType) === $key ? 'checked' : '' }} required />

                    <div
                        class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 rounded-lg bg-surface-container-low flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined text-lg">description</span>
                    </div>

                    <div class="flex flex-col flex-1">
                        @php
                            $translationKey = 'admin.request_types.' . $key;
                            $translatedLabel = __($translationKey);
                        @endphp
                        <span
                            class="font-headline font-semibold text-base text-on-surface">{{ $translatedLabel === $translationKey ? $label : $translatedLabel }}</span>
                        <span
                            class="text-sm text-on-surface-variant mt-1">{{ __('portal.requests.create.type_selection.descriptions.' . $key) }}</span>
                    </div>

                    <span
                        class="material-symbols-outlined ml-3 text-primary opacity-0 peer-checked:opacity-100 transition-opacity"
                        style="font-variation-settings: 'FILL' 1;">check_circle</span>
                </label>
            @endforeach
        </div>
    </div>
</section>