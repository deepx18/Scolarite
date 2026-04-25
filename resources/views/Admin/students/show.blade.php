<x-admin.layout>
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="lg:ml-64 pt-20 sm:pt-24 px-4 sm:px-8 pb-12">
        <div class="flex flex-col gap-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <span class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ __('admin.student_details') }}</span>
                    <h1 class="mt-2 text-3xl font-bold text-blue-950 dark:text-white">{{ $student->first_name }} {{ $student->last_name }}</h1>
                    <p class="mt-3 max-w-2xl text-sm text-slate-500">{{ __('admin.students.description') }}</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.students.edit', $student) }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">{{ __('admin.edit_student') }}</a>
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

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                <div class="xl:col-span-2 rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                    <div class="flex flex-col gap-6">
                        <!-- Basic Information -->
                        <div class="space-y-3">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">{{ __('admin.basic_information') }}</p>
                            <div class="rounded-3xl bg-slate-50 p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.first_name') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->first_name }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.last_name') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->last_name }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.email') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->email }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.date_of_birth') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->date_of_birth?->format('M d, Y') }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.gender') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->gender ?? __('admin.not_specified') }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.nationality') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->nationality ?? __('admin.not_specified') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="space-y-3">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">{{ __('admin.academic_information') }}</p>
                            <div class="rounded-3xl bg-slate-50 p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.apogee_number') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->apogee_number }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.cne') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->cne ?? __('admin.not_specified') }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.cin') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->cin ?? __('admin.not_specified') }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.department') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->department }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.study_level') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->study_level ?? __('admin.not_specified') }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.specialization') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->specialization ?? __('admin.not_specified') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="space-y-3">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">{{ __('admin.additional_information') }}</p>
                            <div class="rounded-3xl bg-slate-50 p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.birth_city') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->birth_city ?? __('admin.not_specified') }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.province') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->province ?? __('admin.not_specified') }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.academic_track') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->academic_track ?? __('admin.not_specified') }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.bac_year') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->bac_year ?? __('admin.not_specified') }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.status') }}</p>
                                    @php
                                        $studentStatusClasses = [
                                            'active' => ['bg-emerald-50', 'text-emerald-700'],
                                            'inactive' => ['bg-slate-100', 'text-slate-700'],
                                            'suspended' => ['bg-rose-50', 'text-rose-700'],
                                        ];
                                        $studentStatusClass = $studentStatusClasses[$student->status] ?? ['bg-slate-100', 'text-slate-700'];
                                    @endphp
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold {{ $studentStatusClass[0] }} {{ $studentStatusClass[1] }}">{{ ucfirst($student->status) }}</span>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.created') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $student->created_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-base font-semibold text-slate-900">{{ __('admin.quick_actions') }}</h2>
                            <p class="mt-2 text-sm text-slate-500">{{ __('admin.manage_student_record') }}</p>
                        </div>
                        <div class="grid gap-3">
                            <a href="{{ route('admin.students.edit', $student) }}" class="w-full rounded-2xl bg-blue-950 px-4 py-3 text-sm font-semibold text-white text-center">{{ __('admin.edit_student') }}</a>
                            <form action="{{ route('admin.students.destroy', $student) }}" method="POST" onsubmit="return confirm('{{ __('admin.delete_student_confirm_full') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full rounded-2xl bg-rose-50 text-rose-700 px-4 py-3 text-sm font-semibold hover:bg-rose-100">{{ __('admin.delete_student') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-admin.layout>