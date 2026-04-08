<x-client.form-layout title="Submit Request | Academic Curator">
    <!-- Page Header -->
    <x-client.form-header 
        title="Submit New Request"
        subtitle="Initiate administrative requests through our secure curatorial system."
        breadcrumb="Academic Records & Support"
    />

    <!-- Form Section -->
    <section class="bg-surface-container-lowest rounded-2xl p-10 shadow-sm border border-slate-100">
        @if ($errors->any())
            <div class="mb-8 p-4 bg-red-50 border border-red-200 rounded-lg">
                <p class="text-red-700 font-semibold mb-2">Please correct the following errors:</p>
                <ul class="text-red-600 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="space-y-10" action="{{ route('requests.store') }}" method="POST">
            @csrf
            <!-- Step 1: Type Selection -->
            <x-client.form-section :step="1" title="Select Request Type">
                <x-client.form-field 
                    type="select" 
                    name="type" 
                    placeholder="Choose a request type..."
                    required
                >
                    <option value="">-- Select a request type --</option>
                    @foreach ($types as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $selectedType) === $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </x-client.form-field>
            </x-client.form-section>

            <!-- Step 2: Type-Specific Fields (Dynamic) -->
            <div id="type-specific-fields" class="space-y-6">
                <!-- Transcript Fields -->
                <div class="type-fields hidden" data-type="transcript">
                    <x-client.form-section :step="2" title="Transcript Details">
                        <x-client.form-field 
                            type="select" 
                            label="Delivery Method" 
                            name="delivery_method"
                            required
                        >
                            <option value="">-- Select delivery method --</option>
                            <option value="email">Email</option>
                            <option value="pickup">Pickup</option>
                            <option value="mail">Mail</option>
                        </x-client.form-field>
                        <x-client.form-field 
                            type="number" 
                            label="Number of Copies" 
                            name="number_of_copies"
                            min="1"
                            max="10"
                            value="1"
                            required
                        />
                    </x-client.form-section>
                </div>

                <!-- Transfer Fields -->
                <div class="type-fields hidden" data-type="transfer">
                    <x-client.form-section :step="2" title="Transfer Details">
                        <x-client.form-field 
                            type="text" 
                            label="Destination Program" 
                            name="destination_program"
                            placeholder="e.g., Computer Science"
                            required
                        />
                        <x-client.form-field 
                            type="textarea" 
                            label="Reason for Transfer" 
                            name="reason"
                            placeholder="Explain your reasons for transferring..."
                            :rows="4"
                            required
                        />
                    </x-client.form-section>
                </div>

                <!-- Withdrawal Fields -->
                <div class="type-fields hidden" data-type="withdrawal">
                    <x-client.form-section :step="2" title="Course Withdrawal Details">
                        <x-client.form-field 
                            type="text" 
                            label="Course Code" 
                            name="course_code"
                            placeholder="e.g., CS101"
                            required
                        />
                        <x-client.form-field 
                            type="text" 
                            label="Course Name" 
                            name="course_name"
                            placeholder="Course name"
                            required
                        />
                        <x-client.form-field 
                            type="textarea" 
                            label="Reason" 
                            name="reason"
                            placeholder="Explain why you're withdrawing..."
                            :rows="4"
                            required
                        />
                    </x-client.form-section>
                </div>

                <!-- Leave Fields -->
                <div class="type-fields hidden" data-type="leave">
                    <x-client.form-section :step="2" title="Leave Details">
                        <x-client.form-field 
                            type="select" 
                            label="Leave Type" 
                            name="leave_type"
                            required
                        >
                            <option value="">-- Select type --</option>
                            <option value="medical">Medical</option>
                            <option value="personal">Personal</option>
                            <option value="academic">Academic</option>
                        </x-client.form-field>
                        <x-client.form-field 
                            type="date" 
                            label="Start Date" 
                            name="start_date"
                            required
                        />
                        <x-client.form-field 
                            type="date" 
                            label="End Date" 
                            name="end_date"
                            required
                        />
                        <x-client.form-field 
                            type="textarea" 
                            label="Reason" 
                            name="reason"
                            placeholder="Describe your situation..."
                            :rows="4"
                            required
                        />
                    </x-client.form-section>
                </div>

                <!-- Appeal Fields -->
                <div class="type-fields hidden" data-type="appeal">
                    <x-client.form-section :step="2" title="Grade Appeal Details">
                        <x-client.form-field 
                            type="text" 
                            label="Course Code" 
                            name="course_code"
                            placeholder="e.g., ENG201"
                            required
                        />
                        <x-client.form-field 
                            type="text" 
                            label="Grade Received" 
                            name="grade_received"
                            placeholder="e.g., C-, D+"
                            required
                        />
                        <x-client.form-field 
                            type="textarea" 
                            label="Reason for Appeal" 
                            name="reason"
                            placeholder="Explain why you're appealing..."
                            :rows="4"
                            required
                        />
                    </x-client.form-section>
                </div>

                <!-- Extension Fields -->
                <div class="type-fields hidden" data-type="extension">
                    <x-client.form-section :step="2" title="Extension Details">
                        <x-client.form-field 
                            type="text" 
                            label="Assignment Name" 
                            name="assignment_name"
                            placeholder="Assignment title"
                            required
                        />
                        <x-client.form-field 
                            type="number" 
                            label="Requested Days" 
                            name="requested_days"
                            min="1"
                            max="14"
                            required
                        />
                        <x-client.form-field 
                            type="textarea" 
                            label="Reason" 
                            name="reason"
                            placeholder="Explain why you need an extension..."
                            :rows="4"
                            required
                        />
                    </x-client.form-section>
                </div>

                <!-- Accommodation Fields -->
                <div class="type-fields hidden" data-type="accommodation">
                    <x-client.form-section :step="2" title="Accommodation Details">
                        <x-client.form-field 
                            type="text" 
                            label="Accommodation Type" 
                            name="accommodation_type"
                            placeholder="e.g., Extended time for exams"
                            required
                        />
                        <x-client.form-field 
                            type="checkbox" 
                            label="I have supporting documentation" 
                            name="supporting_documentation"
                        />
                        <x-client.form-field 
                            type="textarea" 
                            label="Description" 
                            name="description"
                            placeholder="Describe your accommodation needs..."
                            :rows="4"
                            required
                        />
                    </x-client.form-section>
                </div>
            </div>

            <!-- Step 3: Comment -->
            <x-client.form-section :step="3" title="Additional Comments (Optional)">
                <x-client.form-field 
                    type="textarea" 
                    label="Comments" 
                    name="comment"
                    placeholder="Any additional information..."
                    :rows="4"
                />
            </x-client.form-section>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-4 pt-6">
                <a href="{{ route('requests.index') }}" class="bg-surface-container-high text-on-surface px-8 py-4 rounded-xl font-bold text-sm tracking-tight hover:bg-surface-variant transition-all">
                    Cancel
                </a>
                <button class="bg-primary text-blue px-10 py-4 rounded-xl font-bold text-sm tracking-tight shadow-lg shadow-primary/20 hover:opacity-90 active:scale-[0.98] transition-all" type="submit">
                    Confirm Submission
                </button>
            </div>

        </form>
    </section>

    <script>
        const typeSelect = document.querySelector('select[name="type"]');
        const form = document.querySelector('form');

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
        if (typeSelect.value) {
            showTypeFields(typeSelect.value);
        }

        // Show/hide fields on change
        typeSelect.addEventListener('change', (e) => {
            showTypeFields(e.target.value);
        });

        // Validate form before submission
        form.addEventListener('submit', (e) => {
            if (!typeSelect.value) {
                e.preventDefault();
                alert('Please select a request type');
                typeSelect.focus();
                return false;
            }
        });
    </script>
</x-client.form-layout>