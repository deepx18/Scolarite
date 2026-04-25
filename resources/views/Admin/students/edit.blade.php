<x-admin.layout>
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="lg:ml-64 pt-20 sm:pt-24 px-4 sm:px-8 pb-12">
        <div class="flex flex-col gap-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <span class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ __('admin.edit_student') }}</span>
                    <h1 class="mt-2 text-3xl font-bold text-blue-950 dark:text-white">{{ __('admin.edit_student') }} {{ $student->first_name }} {{ $student->last_name }}</h1>
                    <p class="mt-3 max-w-2xl text-sm text-slate-500">{{ __('admin.update_student_description') ?? 'Update student information and academic details.' }}</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.students.show', $student) }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">{{ __('admin.view_student') }}</a>
                    <a href="{{ route('admin.students.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">{{ __('admin.back_to_students') }}</a>
                </div>
            </div>

            @if(session('success') || session('error'))
                <div class="rounded-3xl border p-5 shadow-sm text-sm font-medium">
                    @if(session('success'))
                        <div class="text-emerald-700 bg-emerald-100 border border-emerald-200 rounded-2xl px-4 py-3">{{ session('success') }}</div>
                    @else
                        <div class="text-rose-700 bg-rose-100 border border-rose-200 rounded-2xl px-4 py-3">{{ session('error') }}</div>
                    @endif
                </div>
            @endif

            <form action="{{ route('admin.students.update', $student) }}" method="POST" class="rounded-3xl bg-white p-8 shadow-sm border border-slate-200">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="md:col-span-2">
                            <h3 class="text-lg font-semibold text-slate-900 mb-4">{{ __('admin.basic_information') }}</h3>
                        </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">{{ __('admin.first_name') }} *</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $student->first_name) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        @error('first_name') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">{{ __('admin.last_name') }} *</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $student->last_name) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        @error('last_name') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">{{ __('admin.email') }} *</label>
                        <input type="email" name="email" value="{{ old('email', $student->email) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        @error('email') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">{{ __('admin.date_of_birth') }} *</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth?->format('Y-m-d')) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        @error('date_of_birth') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">{{ __('admin.gender') }}</label>
                        <select name="gender" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                            <option value="">{{ __('admin.select_gender') }}</option>
                            <option value="M" {{ old('gender', $student->gender) === 'M' ? 'selected' : '' }}>{{ __('admin.male') ?? 'Male' }}</option>
                            <option value="F" {{ old('gender', $student->gender) === 'F' ? 'selected' : '' }}>{{ __('admin.female') ?? 'Female' }}</option>
                        </select>
                        @error('gender') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">{{ __('admin.nationality') }}</label>
                        <input type="text" name="nationality" value="{{ old('nationality', $student->nationality) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        @error('nationality') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <!-- Academic Information -->
                    <div class="md:col-span-2 mt-8">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4">Academic Information</h3>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">{{ __('admin.apogee_number') }} *</label>
                        <input type="text" name="apogee_number" value="{{ old('apogee_number', $student->apogee_number) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        @error('apogee_number') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">{{ __('admin.cne') }}</label>
                        <input type="text" name="cne" value="{{ old('cne', $student->cne) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        @error('cne') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">{{ __('admin.cin') }}</label>
                        <input type="text" name="cin" value="{{ old('cin', $student->cin) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        @error('cin') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">{{ __('admin.department') }} *</label>
                        <select name="department" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                            <option value="">{{ __('admin.select_department') }}</option>
                            @foreach(['Computer Science', 'Engineering', 'Business', 'Medicine', 'Law'] as $dept)
                                <option value="{{ $dept }}" {{ old('department', $student->department) === $dept ? 'selected' : '' }}>{{ $dept }}</option>
                            @endforeach
                        </select>
                        @error('department') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">{{ __('admin.study_level') }}</label>
                        <select name="study_level" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                            <option value="">{{ __('admin.select_study_level') }}</option>
                            @foreach(['Bac', 'Licence', 'Master', '1ere Annee', '2e Annee', '3e Annee'] as $level)
                                <option value="{{ $level }}" {{ old('study_level', $student->study_level) === $level ? 'selected' : '' }}>{{ $level }}</option>
                            @endforeach
                        </select>
                        @error('study_level') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">{{ __('admin.specialization') }}</label>
                        <input type="text" name="specialization" value="{{ old('specialization', $student->specialization) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        @error('specialization') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <!-- Additional Information -->
                    <div class="md:col-span-2 mt-8">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4">Additional Information</h3>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">{{ __('admin.birth_city') }}</label>
                        <input type="text" name="birth_city" value="{{ old('birth_city', $student->birth_city) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        @error('birth_city') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">{{ __('admin.province') }}</label>
                        <input type="text" name="province" value="{{ old('province', $student->province) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        @error('province') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">{{ __('admin.academic_track') }}</label>
                        <select name="academic_track" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                            <option value="">{{ __('admin.select_academic_track') }}</option>
                            @foreach(['Science', 'Technology', 'Literature', 'Economics'] as $track)
                                <option value="{{ $track }}" {{ old('academic_track', $student->academic_track) === $track ? 'selected' : '' }}>{{ $track }}</option>
                            @endforeach
                        </select>
                        @error('academic_track') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">Bac Year</label>
                        <input type="text" name="bac_year" value="{{ old('bac_year', $student->bac_year) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="e.g., 2023" />
                        @error('bac_year') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">Status *</label>
                        <select name="status" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                            <option value="active" {{ old('status', $student->status) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $student->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status') <p class="text-rose-600 text-xs">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-slate-200">
                    <a href="{{ route('admin.students.show', $student) }}" class="rounded-2xl border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">{{ __('admin.cancel') }}</a>
                    <button type="submit" class="rounded-2xl bg-blue-950 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-900 transition">{{ __('admin.update_student') }}</button>
                </div>
            </form>
        </div>
    </main>
</x-admin.layout>