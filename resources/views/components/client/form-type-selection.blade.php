<!-- Form Section: Request Type Selection -->
<section class="bg-surface-container-low p-1 rounded-xl">
    <div class="bg-surface-container-lowest p-8 rounded-lg shadow-sm">
        <div class="flex items-start gap-4 mb-8">
            <div class="w-12 h-12 bg-blue-50 text-secondary rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined">category</span>
            </div>
            <div>
                <h3 class="text-xl font-headline font-bold text-primary">Request Selection</h3>
                <p class="text-sm text-on-surface-variant">Choose the category that best describes your request.</p>
            </div>
        </div>
        <div class="space-y-3">
            @foreach ($types as $key => $label)
                <label class="relative flex items-center p-4 border-2 transition-all rounded-xl cursor-pointer hover:border-primary/50 {{ old('type', $selectedType) === $key ? 'border-primary bg-primary/5' : 'border-outline-variant/30' }}">
                    <input type="radio" name="type" value="{{ $key }}" class="hidden peer" {{ old('type', $selectedType) === $key ? 'checked' : '' }} required />
                    <div class="flex flex-col flex-1">
                        <span class="font-headline font-bold text-primary text-sm">{{ $label }}</span>
                        <span class="text-xs text-on-surface-variant mt-1">
                            @switch($key)
                                @case('transcript')
                                    Official academic records and certifications.
                                    @break
                                @case('transfer')
                                    Change your academic program.
                                    @break
                                @case('withdrawal')
                                    Withdraw from a course.
                                    @break
                                @case('leave')
                                    Request a leave of absence.
                                    @break
                                @case('appeal')
                                    Appeal a grade.
                                    @break
                                @case('extension')
                                    Request an assignment extension.
                                    @break
                                @case('accommodation')
                                    Request academic accommodations.
                                    @break
                                @case('enrollment_certificate')
                                    Request proof of enrollment to share with third parties.
                                    @break
                                @case('diploma')
                                    Request your diploma or degree document.
                                    @break
                                @case('student_card')
                                    Request or replace your student ID card.
                                    @break
                                @case('financial_aid')
                                    Apply for financial aid, scholarship, or loan support.
                                    @break
                                @case('other')
                                    Submit a request not covered by the other categories.
                                    @break
                            @endswitch
                        </span>
                    </div>
                    <span class="material-symbols-outlined ml-4 text-primary opacity-0 peer-checked:opacity-100 transition-opacity" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                </label>
            @endforeach
        </div>
    </div>
</section>
