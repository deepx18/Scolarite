<x-admin.layout>
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="ml-64 pt-24 px-8 pb-12">

        <div class="flex flex-col gap-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <span class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ __('admin.admin_portal') }}</span>
                    <h1 class="mt-2 text-3xl font-bold text-blue-950 dark:text-white">{{ __('admin.dashboard') }}</h1>
                    <p class="mt-3 max-w-2xl text-sm text-slate-500">{{ __('admin.welcome_summary') }}</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.requests.index', ['export' => 1]) }}"
                        class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">{{ __('admin.export_data') }}</a>
                    <a href="{{ route('admin.requests.index') }}"
                        class="rounded-full bg-blue-950 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-900">{{ __('admin.custom_filters') }}</a>
                </div>
            </div>
            @if(session('success') || session('error'))
                <div class="rounded-3xl border p-5 shadow-sm text-sm font-medium ">
                    @if(session('success'))
                        <div class="text-emerald-700 bg-emerald-100 border border-emerald-200 rounded-2xl px-4 py-3">{{ session('success') }}</div>
                    @else
                        <div class="text-rose-700 bg-rose-100 border border-rose-200 rounded-2xl px-4 py-3">{{ session('error') }}</div>
                    @endif
                </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-4 gap-4">
                <div
                    class="rounded-3xl bg-white dark:bg-slate-950 p-6 shadow-sm border border-slate-200 dark:border-slate-800">
                    <p class="text-sm text-slate-500">{{ __('admin.total_requests') }}</p>
                    <p class="mt-4 text-3xl font-bold text-blue-950 dark:text-white">{{ $totalRequests }}</p>
                    <p class="mt-3 text-xs text-slate-500">{{ __('admin.total_requests_description') }}</p>
                </div>
                <div
                    class="rounded-3xl bg-white dark:bg-slate-950 p-6 shadow-sm border border-slate-200 dark:border-slate-800">
                    <p class="text-sm text-slate-500">{{ __('admin.pending') }}</p>
                    <p class="mt-4 text-3xl font-bold text-amber-600">{{ $pending }}</p>
                    <p class="mt-3 text-xs text-slate-500">{{ __('admin.pending_description') }}</p>
                </div>
                <div
                    class="rounded-3xl bg-white dark:bg-slate-950 p-6 shadow-sm border border-slate-200 dark:border-slate-800">
                    <p class="text-sm text-slate-500">{{ __('admin.approved_today') }}</p>
                    <p class="mt-4 text-3xl font-bold text-emerald-600">{{ $approved }}</p>
                    <p class="mt-3 text-xs text-slate-500">{{ __('admin.approved_description') }}</p>
                </div>
                <div
                    class="rounded-3xl bg-white dark:bg-slate-950 p-6 shadow-sm border border-slate-200 dark:border-slate-800">
                    <p class="text-sm text-slate-500">{{ __('admin.rejected') }}</p>
                    <p class="mt-4 text-3xl font-bold text-rose-600">{{ $rejected }}</p>
                    <p class="mt-3 text-xs text-slate-500">{{ __('admin.rejected_description') }}</p>
                </div>
            </div>

            <!-- Reclamations Status removed -->

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
                <div
                    class="xl:col-span-2 rounded-3xl bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div
                        class="flex items-center justify-between px-6 py-5 border-b border-slate-200 dark:border-slate-800">
                        <div>
                            <h2 class="text-lg font-semibold text-blue-950 dark:text-white">{{ __('admin.request_volume_by_type') }}</h2>
                            <p class="mt-1 text-sm text-slate-500">{{ __('admin.top_request_types') }}</p>
                        </div>
                        <span
                            class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700 dark:bg-slate-800 dark:text-slate-300">{{ __('admin.last_30_days') }}</span>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-5">
                            @forelse($typeVolumes as $typeVolume)
                                <li>
                                    <div
                                        class="flex items-center justify-between text-sm text-slate-600 dark:text-slate-300 mb-2">
                                        <span>{{ $typeNames[$typeVolume['type']] }}</span>
                                        <span
                                            class="font-semibold text-slate-900 dark:text-white">{{ $typeVolume['percent'] }}%</span>
                                    </div>
                                    <div class="h-3 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800">
                                        <div class="h-full rounded-full bg-blue-950 transition-all"
                                            style="width: {{ $typeVolume['percent'] }}%"></div>
                                    </div>
                                </li>
                            @empty
                                <li class="text-sm text-slate-500">{{ __('admin.no_request_volume_data') }}</li>
                            @endforelse
                        </ul>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                        <div class="rounded-3xl bg-slate-50 dark:bg-slate-900 p-4">
                                <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.peak_hour') }}</p>
                                <p class="mt-3 font-semibold text-slate-900 dark:text-white">{{ __('admin.peak_hour_example') }}</p>
                            </div>
                            <div class="rounded-3xl bg-slate-50 dark:bg-slate-900 p-4">
                                <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.average_processing') }}</p>
                                <p class="mt-3 font-semibold text-slate-900 dark:text-white">{{ __('admin.average_processing_example') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="rounded-3xl bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-800">
                        <h2 class="text-lg font-semibold text-blue-950 dark:text-white">{{ __('admin.recent_activity') }}</h2>
                        <p class="mt-1 text-sm text-slate-500">{{ __('admin.latest_request_events') }}</p>
                    </div>
                    <div class="p-6 space-y-6">
                        @foreach($recentRequests as $req)
                            <div class="flex items-start gap-4">
                                <span class="mt-2 inline-flex h-3.5 w-3.5 rounded-full bg-blue-950"></span>
                                <div class="flex-1">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
                                        <p class="font-semibold text-slate-900 dark:text-white">{{ $req->student->first_name }} {{ $req->student->last_name }}</p>
                                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.24em] text-slate-600 dark:bg-slate-800 dark:text-slate-300">{{ $req->statusLabel() }}</span>
                                    </div>
                                    <p class="mt-1 text-sm text-slate-500">{{ $req->typeLabel() }} · {{ $req->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                <!-- Pending Actions Widget -->
                <div class="rounded-3xl bg-white dark:bg-slate-950 p-6 shadow-sm border border-slate-200 dark:border-slate-800">
                    <h2 class="text-lg font-semibold text-blue-950 dark:text-white" style="font-family: 'Manrope', sans-serif;">{{ __('admin.priority_actions.title') }}</h2>
                    <p class="mt-1 text-sm text-slate-500">{{ __('admin.priority_actions.desc') }}</p>
                    <div class="mt-4 space-y-4">
                        @forelse($pendingActions as $action)
                            <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white">{{ $action->student->first_name }} {{ $action->student->last_name }}</p>
                                    <p class="text-sm text-slate-500">{{ $action->type }}</p>
                                </div>
                                <span class="inline-flex items-center rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-700">{{ __('admin.priority_actions.delayed_label') }}</span>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">{{ __('admin.priority_actions.no_pending') }}</p>
                        @endforelse
                    </div>
                </div>

                <!-- Status Distribution Widget -->
                <div class="rounded-3xl bg-white dark:bg-slate-950 p-6 shadow-sm border border-slate-200 dark:border-slate-800">
                    <h2 class="text-lg font-semibold text-blue-950 dark:text-white" style="font-family: 'Manrope', sans-serif;">{{ __('admin.status_distribution.title') }}</h2>
                    <p class="mt-1 text-sm text-slate-500">{{ __('admin.status_distribution.desc') }}</p>
                    <div class="mt-4 space-y-4">
                        @foreach($statusDistribution as $dist)
                            <div>
                                <div class="flex items-center justify-between text-sm mb-2">
                                    <span class="capitalize">{{ $statusNames[$dist['status']] }}</span>
                                    <span class="font-semibold text-slate-900 dark:text-white">{{ $dist['percent'] }}%</span>
                                </div>
                                <div class="h-3 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800">
                                    <div class="h-full rounded-full" style="width: {{ $dist['percent'] }}%; background-color: #002045;"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </main>
</x-admin.layout>