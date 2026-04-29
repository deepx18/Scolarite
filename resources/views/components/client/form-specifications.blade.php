<!-- Form Section: Type-Specific Fields (Dynamic) -->
<section id="type-specific-section" class="bg-surface-container-low p-1 rounded-xl">
    <div class="bg-surface-container-lowest p-8 rounded-lg shadow-sm">
        <div class="flex items-start gap-4 mb-8">
            <div class="w-12 h-12 bg-blue-50 text-secondary rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined">edit_note</span>
            </div>
            <div>
                <h3 class="text-xl font-headline font-bold text-primary">{{ __('portal.requests.create.specifications.title') }}</h3>
                <p class="text-sm text-on-surface-variant">{{ __('portal.requests.create.specifications.description') }}</p>
            </div>
        </div>

        <div id="type-specific-fields" class="space-y-6">
            <div class="type-fields hidden space-y-6" data-type="transcript">
                @include('components.client.partials.request-copy-delivery-fields')
            </div>

            <div class="type-fields hidden space-y-6" data-type="enrollment_certificate">
                @include('components.client.partials.request-copy-delivery-fields')
            </div>

            <div class="type-fields hidden space-y-6" data-type="baccalaureate_withdrawal">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">{{ __('portal.requests.create.specifications.fields.reason') }}</label>
                    <textarea name="reason" rows="4" maxlength="1000" placeholder="{{ __('portal.requests.create.specifications.placeholders.reason') }}"
                        class="w-full bg-surface-container-highest border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary transition-all font-body resize-none disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled>{{ old('reason') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">{{ __('portal.requests.create.specifications.fields.expected_return_date') }}</label>
                    <input type="date" name="expected_return_date" value="{{ old('expected_return_date') }}" min="{{ now()->addDay()->toDateString() }}"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
            </div>

            <div class="type-fields hidden space-y-6" data-type="internship_agreement">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">{{ __('portal.requests.create.specifications.fields.company_name') }}</label>
                    <input type="text" name="company_name" value="{{ old('company_name') }}" maxlength="255" placeholder="{{ __('portal.requests.create.specifications.placeholders.company_name') }}"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-headline font-bold text-primary mb-3">{{ __('portal.requests.create.specifications.fields.start_date') }}</label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}"
                            class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                            disabled />
                    </div>
                    <div>
                        <label class="block text-sm font-headline font-bold text-primary mb-3">{{ __('portal.requests.create.specifications.fields.end_date') }}</label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}"
                            class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                            disabled />
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">{{ __('portal.requests.create.specifications.fields.description') }}</label>
                    <textarea name="description" rows="4" maxlength="1000" placeholder="{{ __('portal.requests.create.specifications.placeholders.description') }}"
                        class="w-full bg-surface-container-highest border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary transition-all font-body resize-none disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled>{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="type-fields hidden space-y-6" data-type="re_enrollment">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">{{ __('portal.requests.create.specifications.fields.academic_year') }}</label>
                    <input type="text" name="academic_year" value="{{ old('academic_year') }}" maxlength="20" placeholder="{{ __('portal.requests.create.specifications.placeholders.academic_year') }}"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">{{ __('portal.requests.create.specifications.fields.program') }}</label>
                    <input type="text" name="program" value="{{ old('program') }}" maxlength="255" placeholder="{{ __('portal.requests.create.specifications.placeholders.program') }}"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
            </div>

            <div class="type-fields hidden space-y-6" data-type="personal_info_correction">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">{{ __('portal.requests.create.specifications.fields.field_to_correct') }}</label>
                    <input type="text" name="field_to_correct" value="{{ old('field_to_correct') }}" maxlength="255" placeholder="{{ __('portal.requests.create.specifications.placeholders.field_to_correct') }}"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-headline font-bold text-primary mb-3">{{ __('portal.requests.create.specifications.fields.current_value') }}</label>
                        <input type="text" name="current_value" value="{{ old('current_value') }}" maxlength="255" placeholder="{{ __('portal.requests.create.specifications.placeholders.current_value') }}"
                            class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                            disabled />
                    </div>
                    <div>
                        <label class="block text-sm font-headline font-bold text-primary mb-3">{{ __('portal.requests.create.specifications.fields.correct_value') }}</label>
                        <input type="text" name="correct_value" value="{{ old('correct_value') }}" maxlength="255" placeholder="{{ __('portal.requests.create.specifications.placeholders.correct_value') }}"
                            class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                            disabled />
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">{{ __('portal.requests.create.specifications.fields.justification') }}</label>
                    <textarea name="justification" rows="4" maxlength="1000" placeholder="{{ __('portal.requests.create.specifications.placeholders.justification') }}"
                        class="w-full bg-surface-container-highest border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary transition-all font-body resize-none disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled>{{ old('justification') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</section>

@once
    <script>
        (() => {
            const updateTypeFields = (type) => {
                document.querySelectorAll('.type-fields').forEach((group) => {
                    const isSelected = group.dataset.type === type;

                    group.classList.toggle('hidden', !isSelected);
                    group.querySelectorAll('input, select, textarea').forEach((field) => {
                        field.disabled = !isSelected;
                        field.required = isSelected;
                    });
                });
            };

            const checkedType = document.querySelector('input[name="type"]:checked');
            updateTypeFields(checkedType?.value);

            document.querySelectorAll('input[name="type"]').forEach((radio) => {
                radio.addEventListener('change', (event) => {
                    updateTypeFields(event.target.value);
                });
            });
        })();
    </script>
@endonce
