<x-admin.layout>
        <x-admin.navbar />
        <x-admin.sidebar />

        <main class="ml-64 pt-24 px-8 pb-12">
                <div class="max-w-4xl mx-auto space-y-6">
                        <div
                                class="rounded-3xl bg-white dark:bg-slate-950 p-8 shadow-sm border border-slate-200 dark:border-slate-800">
                                <div class="flex flex-col gap-2">
                                        <span
                                                class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ __('admin.admin_portal') }}</span>
                                        <h1 class="text-3xl font-bold text-blue-950 dark:text-white">
                                                {{ __('admin.add_new_student') }}
                                        </h1>
                                        <p class="text-sm text-slate-500">{{ __('admin.add_student_page_description') }}
                                        </p>
                                </div>
                        </div>

                        @if(session('success'))
                                <div class="rounded-3xl bg-emerald-50 border border-emerald-200 p-5 text-emerald-900">
                                        {{ session('success') }}
                                </div>
                        @endif

                        @if($errors->any())
                                <div class="rounded-3xl bg-rose-50 border border-rose-200 p-5 text-rose-900">
                                        <ul class="list-disc pl-5 space-y-1 text-sm">
                                                @foreach($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                @endforeach
                                        </ul>
                                </div>
                        @endif

                        <div
                                class="rounded-3xl bg-white dark:bg-slate-950 p-8 shadow-sm border border-slate-200 dark:border-slate-800">
                                <form method="POST" action="{{ route('admin.students.store') }}"
                                        class="grid grid-cols-1 gap-6">
                                        @csrf
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                        <label
                                                                class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('admin.first_name') }}</label>
                                                        <input name="first_name" value="{{ old('first_name') }}"
                                                                type="text"
                                                                class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900/10" />
                                                </div>
                                                <div>
                                                        <label
                                                                class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('admin.last_name') }}</label>
                                                        <input name="last_name" value="{{ old('last_name') }}"
                                                                type="text"
                                                                class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900/10" />
                                                </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                        <label
                                                                class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('admin.email') }}</label>
                                                        <input name="email" value="{{ old('email') }}" type="email"
                                                                class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900/10" />
                                                </div>
                                                <div>
                                                        <label
                                                                class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('admin.apogee_number') }}</label>
                                                        <input name="apogee_number" value="{{ old('apogee_number') }}"
                                                                type="text"
                                                                class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900/10" />
                                                </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                        <label
                                                                class="block text-sm font-medium text-slate-700 dark:text-slate-300">CNE</label>
                                                        <input name="cne" value="{{ old('cne') }}" type="text"
                                                                class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900/10" />
                                                </div>
                                                <div>
                                                        <label
                                                                class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('admin.date_of_birth') }}</label>
                                                        <input name="date_of_birth" value="{{ old('date_of_birth') }}"
                                                                type="date"
                                                                class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900/10" />
                                                </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                        <label
                                                                class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('admin.department') }}</label>
                                                        <input name="department" value="{{ old('department') }}"
                                                                type="text"
                                                                class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900/10" />
                                                </div>
                                                <div>
                                                        <label
                                                                class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('admin.status') }}</label>
                                                        <select name="status"
                                                                class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900/10">
                                                                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>{{ __('admin.active') }}
                                                                </option>
                                                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>{{ __('admin.inactive') }}
                                                                </option>
                                                        </select>
                                                </div>
                                        </div>

                                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
                                                <a href="{{ route('admin.students.index') }}"
                                                        class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-200">{{ __('admin.back_to_students') }}</a>
                                                <button type="submit"
                                                        class="inline-flex items-center justify-center rounded-full bg-blue-950 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-900">{{ __('admin.save_student') }}</button>
                                        </div>
                                </form>
                        </div>
                </div>
        </main>
</x-admin.layout>