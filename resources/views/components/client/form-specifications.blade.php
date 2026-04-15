<!-- Form Section: Type-Specific Fields (Dynamic) -->
<section id="type-specific-section" class="bg-surface-container-low p-1 rounded-xl">
    <div class="bg-surface-container-lowest p-8 rounded-lg shadow-sm">
        <div class="flex items-start gap-4 mb-8">
            <div class="w-12 h-12 bg-blue-50 text-secondary rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined">edit_note</span>
            </div>
            <div>
                <h3 class="text-xl font-headline font-bold text-primary">Request Specifications</h3>
                <p class="text-sm text-on-surface-variant">Provide the necessary context and details for your request.
                </p>
            </div>
        </div>

        <div id="type-specific-fields" class="space-y-6">
            <!-- Transcript Fields -->
            <div class="type-fields hidden space-y-6" data-type="transcript">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Delivery Method</label>
                    <select name="delivery_method"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 appearance-none focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled>
                        <option value="">-- Select delivery method --</option>
                        <option value="email">Email</option>
                        <option value="pickup">Pickup</option>
                        <option value="mail">Mail</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Number of Copies</label>
                    <input type="number" name="number_of_copies" min="1" max="10" value="1"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
            </div>

            <!-- Transfer Fields -->
            <div class="type-fields hidden space-y-6" data-type="transfer">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Destination Program</label>
                    <input type="text" name="destination_program" placeholder="e.g., Computer Science"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Reason for Transfer</label>
                    <textarea name="reason" rows="4" placeholder="Explain your reasons for transferring..."
                        class="w-full bg-surface-container-highest border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary transition-all font-body resize-none disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled></textarea>
                </div>
            </div>

            <!-- Withdrawal Fields -->
            <div class="type-fields hidden space-y-6" data-type="withdrawal">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Course Code</label>
                    <input type="text" name="course_code" placeholder="e.g., CS101"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Course Name</label>
                    <input type="text" name="course_name" placeholder="Course name"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Reason</label>
                    <textarea name="reason" rows="4" placeholder="Explain why you're withdrawing..."
                        class="w-full bg-surface-container-highest border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary transition-all font-body resize-none disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled></textarea>
                </div>
            </div>

            <!-- Leave Fields -->
            <div class="type-fields hidden space-y-6" data-type="leave">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Leave Type</label>
                    <select name="leave_type"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 appearance-none focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled>
                        <option value="">-- Select type --</option>
                        <option value="medical">Medical</option>
                        <option value="personal">Personal</option>
                        <option value="academic">Academic</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Start Date</label>
                    <input type="date" name="start_date"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">End Date</label>
                    <input type="date" name="end_date"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Reason</label>
                    <textarea name="reason" rows="4" placeholder="Describe your situation..."
                        class="w-full bg-surface-container-highest border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary transition-all font-body resize-none disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled></textarea>
                </div>
            </div>

            <!-- Appeal Fields -->
            <div class="type-fields hidden space-y-6" data-type="appeal">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Course Code</label>
                    <input type="text" name="course_code" placeholder="e.g., ENG201"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Grade Received</label>
                    <input type="text" name="grade_received" placeholder="e.g., C-, D+"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Reason for Appeal</label>
                    <textarea name="reason" rows="4" placeholder="Explain why you're appealing..."
                        class="w-full bg-surface-container-highest border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary transition-all font-body resize-none disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled></textarea>
                </div>
            </div>

            <!-- Extension Fields -->
            <div class="type-fields hidden space-y-6" data-type="extension">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Assignment Name</label>
                    <input type="text" name="assignment_name" placeholder="Assignment title"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Requested Days</label>
                    <input type="number" name="requested_days" min="1" max="14"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Reason</label>
                    <textarea name="reason" rows="4" placeholder="Explain why you need an extension..."
                        class="w-full bg-surface-container-highest border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary transition-all font-body resize-none disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled></textarea>
                </div>
            </div>

            <!-- Accommodation Fields -->
            <div class="type-fields hidden space-y-6" data-type="accommodation">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Accommodation Type</label>
                    <input type="text" name="accommodation_type" placeholder="e.g., Extended time for exams"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
                <div class="flex items-center gap-3 p-4 bg-surface-container-high/40 rounded-lg">
                    <input type="checkbox" id="supporting_docs" name="supporting_documentation"
                        class="w-5 h-5 rounded cursor-pointer disabled:opacity-50" disabled />
                    <label for="supporting_docs"
                        class="text-sm font-body text-on-surface cursor-pointer disabled:opacity-50">I have supporting
                        documentation</label>
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Description</label>
                    <textarea name="description" rows="4" placeholder="Describe your accommodation needs..."
                        class="w-full bg-surface-container-highest border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary transition-all font-body resize-none disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled></textarea>
                </div>
            </div>

            <!-- Enrollment Certificate Fields -->
            <div class="type-fields hidden space-y-6" data-type="enrollment_certificate">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Delivery Method</label>
                    <select name="delivery_method"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 appearance-none focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled>
                        <option value="">-- Select delivery method --</option>
                        <option value="email">Email</option>
                        <option value="pickup">Pickup</option>
                        <option value="mail">Mail</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Number of Copies</label>
                    <input type="number" name="number_of_copies" min="1" max="10" value="1"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
            </div>

            <!-- Diploma Fields -->
            <div class="type-fields hidden space-y-6" data-type="diploma">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Delivery Method</label>
                    <select name="delivery_method"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 appearance-none focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled>
                        <option value="">-- Select delivery method --</option>
                        <option value="email">Email</option>
                        <option value="pickup">Pickup</option>
                        <option value="mail">Mail</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Number of Copies</label>
                    <input type="number" name="number_of_copies" min="1" max="5" value="1"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
            </div>

            <!-- Student Card Fields -->
            <div class="type-fields hidden space-y-6" data-type="student_card">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Request Type</label>
                    <select name="card_type"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 appearance-none focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled>
                        <option value="">-- Select card option --</option>
                        <option value="new">New Card</option>
                        <option value="replacement">Replacement</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Reason</label>
                    <textarea name="reason" rows="4" placeholder="Why do you need this card?"
                        class="w-full bg-surface-container-highest border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary transition-all font-body resize-none disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled></textarea>
                </div>
            </div>

            <!-- Financial Aid Fields -->
            <div class="type-fields hidden space-y-6" data-type="financial_aid">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Aid Type</label>
                    <select name="aid_type"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 appearance-none focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled>
                        <option value="">-- Select aid type --</option>
                        <option value="scholarship">Scholarship</option>
                        <option value="loan">Loan</option>
                        <option value="bursary">Bursary</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Reason</label>
                    <textarea name="reason" rows="4" placeholder="Explain your financial support need..."
                        class="w-full bg-surface-container-highest border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary transition-all font-body resize-none disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled></textarea>
                </div>
            </div>

            <!-- Other Request Fields -->
            <div class="type-fields hidden space-y-6" data-type="other">
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Subject</label>
                    <input type="text" name="subject" placeholder="Brief subject"
                        class="w-full bg-surface-container-highest border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-secondary transition-all font-body text-on-surface disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled />
                </div>
                <div>
                    <label class="block text-sm font-headline font-bold text-primary mb-3">Description</label>
                    <textarea name="description" rows="4" placeholder="Describe your request in detail..."
                        class="w-full bg-surface-container-highest border-none rounded-lg p-4 focus:ring-2 focus:ring-secondary transition-all font-body resize-none disabled:bg-outline-variant/20 disabled:text-on-surface-variant"
                        disabled></textarea>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const typeRadios = document.querySelectorAll('input[name="type"]');

    function showTypeFields(type) {
        // Disable and hide all type-specific fields
        document.querySelectorAll('.type-fields').forEach(el => {
            el.classList.add('hidden');
            el.querySelectorAll('input, select, textarea').forEach(field => {
                field.disabled = true;
            });
        });

        // Enable and show selected type fields
        if (type) {
            const selectedFields = document.querySelector(`.type-fields[data-type="${type}"]`);
            if (selectedFields) {
                selectedFields.classList.remove('hidden');
                selectedFields.querySelectorAll('input, select, textarea').forEach(field => {
                    field.disabled = false;
                });
            }
        }
    }

    // Show fields on load if type was previously selected
    const checkedRadio = document.querySelector('input[name="type"]:checked');
    if (checkedRadio && checkedRadio.value) {
        showTypeFields(checkedRadio.value);
    }

    // Show/hide fields on change
    typeRadios.forEach(radio => {
        radio.addEventListener('change', (e) => {
            showTypeFields(e.target.value);
        });
    });
</script>