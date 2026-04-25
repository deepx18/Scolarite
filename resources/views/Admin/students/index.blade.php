<x-admin.layout>
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="lg:ml-64 pt-20 sm:pt-24 px-4 sm:px-8 pb-12">
        <div class="flex flex-col gap-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <span
                        class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ __('admin.admin_portal') }}</span>
                    <h1 class="mt-2 text-3xl font-bold text-blue-950 dark:text-white">
                        {{ __('admin.student_directory') }}
                    </h1>
                    <p class="mt-3 max-w-2xl text-sm text-slate-500">{{ __('admin.students.description') }}</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.students.create') }}"
                        class="rounded-full bg-blue-950 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-900">{{ __('admin.add_student') }}</a>
                    <a href="{{ route('admin.students.bulkUpload') }}"
                        class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">{{ __('admin.bulk_upload') }}</a>
                </div>
            </div>

            @if(session('success') || session('error'))
                <div class="rounded-3xl border p-5 shadow-sm text-sm font-medium">
                    @if(session('success'))
                        <div class="text-emerald-700 bg-emerald-100 border border-emerald-200 rounded-2xl px-4 py-3">
                            {{ session('success') }}
                        </div>
                    @else
                        <div class="text-rose-700 bg-rose-100 border border-rose-200 rounded-2xl px-4 py-3">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            @endif

            <!-- Filter Bar -->
            <form method="GET" action="{{ route('admin.students.index') }}" class="grid grid-cols-12 gap-4 mb-8">
                <!-- Search Input -->
                <div class="col-span-12 md:col-span-5 bg-surface-container-low p-2 rounded-xl flex items-center">
                    <span class="material-symbols-outlined px-3 text-slate-400">search</span>
                    <input name="search" class="bg-transparent border-none focus:ring-0 w-full text-sm font-medium"
                        placeholder="{{ __('admin.search_placeholder') }}" type="text"
                        value="{{ request('search') }}" />
                </div>

                 <!-- Action Buttons -->
                 <div class="col-span-12 md:col-span-3 flex gap-2">
                    <button type="submit" class="flex-1 bg-slate-900 text-white font-bold py-2 rounded-xl text-sm hover:bg-slate-800 transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">search</span>
                        {{ __('admin.search') }}
                    </button>
                </div>

                <!-- Department Filter -->
                <div class="col-span-6 md:col-span-2 bg-surface-container-low rounded-xl flex items-center px-4">
                    <span class="material-symbols-outlined text-slate-400 mr-2 text-sm">school</span>
                    <select name="department" onchange="this.form.submit()"
                        class="bg-transparent border-none focus:ring-0 w-full text-sm font-medium appearance-none">
                        <option value="">{{ __('admin.department') }}</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department }}" {{ request('department') === $department ? 'selected' : '' }}>
                                {{ $department }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="col-span-6 md:col-span-2 bg-surface-container-low rounded-xl flex items-center px-4">
                    <span class="material-symbols-outlined text-slate-400 mr-2 text-sm">radio_button_checked</span>
                    <select name="status" onchange="this.form.submit()"
                        class="bg-transparent border-none focus:ring-0 w-full text-sm font-medium appearance-none">
                        <option value="">{{ __('admin.status') }}</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                                {{ __("admin.{$status}") === "admin.{$status}" ? ucfirst($status) : __("admin.{$status}") }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Action Buttons -->
                {{-- <div class="col-span-12 md:col-span-3 flex gap-2">
                    <button type="submit" class="flex-1 bg-slate-900 text-white font-bold py-2 rounded-xl text-sm hover:bg-slate-800 transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">search</span>
                        {{ __('admin.search') }}
                    </button>
                </div> --}}
            </form>

            <!-- Students Table -->
            <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-full">
                    <thead>
                        <tr class="bg-surface-container-low/50">
                            <th class="p-5 font-bold text-xs uppercase tracking-widest text-slate-500">{{ __('admin.students.table.student') }}</th>
                            <th class="p-5 font-bold text-xs uppercase tracking-widest text-slate-500">{{ __('admin.students.table.apogee') }}</th>
                            <th class="p-5 font-bold text-xs uppercase tracking-widest text-slate-500">{{ __('admin.students.table.cne') }}</th>
                            <th class="p-5 font-bold text-xs uppercase tracking-widest text-slate-500">{{ __('admin.students.table.department') }}</th>
                            <th class="p-5 font-bold text-xs uppercase tracking-widest text-slate-500">{{ __('admin.students.table.status') }}</th>
                            <th class="p-5 font-bold text-xs uppercase tracking-widest text-slate-500 text-right">{{ __('admin.students.table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-low">
                        @forelse ($students as $student)
                            <tr class="hover:bg-surface-container-low/30 transition-colors">
                                <td class="p-5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-9 h-9 rounded-full bg-secondary-fixed flex items-center justify-center font-bold text-on-secondary-fixed text-xs">
                                            {{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-on-surface text-sm">{{ $student->first_name }}
                                                {{ $student->last_name }}
                                            </p>
                                            <p class="text-xs text-slate-400">{{ $student->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3 sm:p-5 text-xs sm:text-sm text-slate-700 hidden sm:table-cell whitespace-nowrap">{{ $student->apogee_number }}</td>
                                <td class="p-3 sm:p-5 text-xs sm:text-sm text-slate-700 hidden md:table-cell whitespace-nowrap">{{ $student->cne ?? 'N/A' }}</td>
                                <td class="p-3 sm:p-5 text-xs sm:text-sm text-slate-700 hidden lg:table-cell whitespace-nowrap">{{ $student->department }}</td>
                                <td class="p-3 sm:p-5">
                                    @php
                                        $statusClasses = [
                                            'active' => ['bg-emerald-50', 'text-emerald-700'],
                                            'inactive' => ['bg-slate-100', 'text-slate-700'],
                                            'suspended' => ['bg-rose-50', 'text-rose-700'],
                                        ];
                                        $statusClass = $statusClasses[$student->status] ?? ['bg-slate-100', 'text-slate-700'];
                                        $statusKey = 'admin.' . $student->status;
                                        $studentStatusLabel = __($statusKey);
                                        if ($studentStatusLabel === $statusKey) {
                                            $studentStatusLabel = ucfirst($student->status);
                                        }
                                    @endphp
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $statusClass[0] }} {{ $statusClass[1] }}">
                                        {{ $studentStatusLabel }}
                                    </span>
                                </td>
                                <td class="p-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.students.show', $student) }}"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-sky-100 text-sky-600 hover:bg-sky-200 transition"
                                                title="{{ __('admin.actions.view') }}">
                                            <span class="material-symbols-outlined text-base">visibility</span>
                                        </a>
                                            <a href="{{ route('admin.students.edit', $student) }}"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-amber-100 text-amber-600 hover:bg-amber-200 transition"
                                                title="{{ __('admin.actions.edit') }}">
                                            <span class="material-symbols-outlined text-base">edit</span>
                                        </a>
                                        <form action="{{ route('admin.students.destroy', $student) }}" method="POST"
                                            class="inline" onsubmit="return confirm('{{ __('admin.delete_student_confirm') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-rose-100 text-rose-600 hover:bg-rose-200 transition"
                                                title="{{ __('admin.actions.delete') }}">
                                                <span class="material-symbols-outlined text-base">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center text-xs sm:text-sm text-slate-500">
                                    No students found matching your criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="p-5 flex justify-between items-center bg-surface-container-low/20">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">{{ __('admin.students.showing', ['from' => $students->firstItem(), 'to' => $students->lastItem(), 'total' => $students->total()]) }}</p>
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </main>

    <!-- Export Students Modal -->

</x-admin.layout>