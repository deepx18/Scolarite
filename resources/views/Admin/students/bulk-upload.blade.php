<x-admin.layout>
        <x-admin.navbar />
        <x-admin.sidebar />

        <main class="ml-64 pt-24 px-8 pb-12">
                <div class="max-w-4xl mx-auto space-y-6">
                        <div
                                class="rounded-3xl bg-white dark:bg-slate-950 p-8 shadow-sm border border-slate-200 dark:border-slate-800">
                                <div class="flex flex-col gap-2">
                                        <span
                                                class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ __('admin.bulk_upload') }}</span>
                                        <h1 class="text-3xl font-bold text-blue-950 dark:text-white">
                                                {{ __('admin.import_students') }}
                                        </h1>
                                        <p class="text-sm text-slate-500">{{ __('admin.import_students_description') }}
                                        </p>
                                        @if(session('success'))
                                                <div
                                                        class="rounded-3xl bg-emerald-50 border border-emerald-200 p-5 text-emerald-900">
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

                                        @if(session('errors_list'))
                                                <div class="rounded-3xl bg-amber-50 border border-amber-200 p-5 text-amber-900">
                                                        <p class="font-semibold mb-2">Skipped rows:</p>
                                                        <ul class="list-disc pl-5 space-y-1 text-sm">
                                                                @foreach(session('errors_list') as $error)
                                                                        <li>{{ $error }}</li>
                                                                @endforeach
                                                        </ul>
                                                </div>
                                        @endif

                                        <div
                                                class="rounded-3xl bg-white dark:bg-slate-950 p-8 shadow-sm border border-slate-200 dark:border-slate-800">
                                                <form method="POST"
                                                        action="{{ route('admin.students.bulkUpload.store') }}"
                                                        enctype="multipart/form-data" class="space-y-6">
                                                        @csrf
                                                        <div class="space-y-2">
                                                                <label
                                                                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('admin.csv_file') }}</label>
                                                                <div class="relative">
                                                                        <input id="csv-file" type="file" name="file"
                                                                                accept=".csv"
                                                                                class="absolute inset-0 h-full w-full opacity-0 cursor-pointer"
                                                                                onchange="document.getElementById('csv-file-name').textContent = this.files.length ? this.files[0].name : '{{ __('admin.no_file_selected') }}'" />
                                                                        <div
                                                                                class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900">
                                                                                <span id="csv-file-name"
                                                                                        class="text-slate-500">{{ __('admin.no_file_selected') }}</span>
                                                                                <button type="button"
                                                                                        onclick="document.getElementById('csv-file').click()"
                                                                                        class="ml-auto rounded-full bg-blue-950 px-4 py-2 text-white hover:bg-blue-900">{{ __('admin.choose_file') }}</button>
                                                                        </div>
                                                                </div>
                                                                <p class="text-xs text-slate-500">
                                                                        {{ __('admin.csv_file_description') }}
                                                                </p>
                                                        </div>
                                                        <div
                                                                class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
                                                                <a href="{{ route('admin.students.index') }}"
                                                                        class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-200">{{ __('admin.back_to_students') }}</a>
                                                                <button type="submit"
                                                                        class="inline-flex items-center justify-center rounded-full bg-blue-950 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-900">{{ __('admin.import') }}</button>
                                                        </div>
                                                </form>
                                        </div>
                                </div>
        </main>
</x-admin.layout>