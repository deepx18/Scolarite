<x-admin.layout>
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="lg:ml-64 pt-20 sm:pt-24 px-4 sm:px-8 pb-12">
        <div class="flex flex-col gap-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <span class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ __('admin.request_details') }}</span>
                    <h1 class="mt-2 text-3xl font-bold text-blue-950 dark:text-white">{{ __('admin.request') }} #{{ $request->id }}</h1>
                    <p class="mt-3 max-w-2xl text-sm text-slate-500">{{ __('admin.request_details_description') }}</p>
                </div>
                <a href="{{ route('admin.requests.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">{{ __('admin.back_to_requests') }}</a>
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
                        <div class="space-y-3">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">{{ __('admin.student') }}</p>
                            <div class="rounded-3xl bg-slate-50 p-5">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                    <div>
                                        <p class="text-xl font-bold text-blue-950">{{ $request->student->first_name }} {{ $request->student->last_name }}</p>
                                        <p class="text-sm text-slate-500">{{ __('admin.cne') }}: {{ $request->student->cne ?? 'N/A' }}</p>
                                        <p class="text-sm text-slate-500">{{ __('admin.apogee') }}: {{ $request->student->apogee_number }}</p>
                                    </div>
                                        <div class="grid grid-cols-2 gap-3 text-sm text-slate-600">
                                        <div>
                                            <span class="block font-semibold">{{ __('admin.email') }}</span>
                                            <span>{{ $request->student->email }}</span>
                                        </div>
                                        <div>
                                            <span class="block font-semibold">{{ __('admin.department') }}</span>
                                            <span>{{ $request->student->department }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">{{ __('admin.request_information') }}</p>
                            <div class="rounded-3xl bg-slate-50 p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.reference') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $request->reference }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.type') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $request->typeLabel() }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.submitted') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $request->created_at->format('M d, Y H:i') }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.last_updated') }}</p>
                                    <p class="font-semibold text-slate-900">{{ $request->updated_at->format('M d, Y H:i') }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">{{ __('admin.status') }}</p>
                                    <p class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700">{{ $request->statusLabel() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">{{ __('admin.details') }}</p>
                            <div class="rounded-3xl bg-slate-50 p-5">
                                @if(is_array($request->details) && count($request->details))
                                    <ul class="space-y-2 text-sm text-slate-700 leading-relaxed list-disc list-inside">
                                        @foreach($request->details as $key => $detail)
                                            <li><span class="font-semibold capitalize">{{ str_replace('_', ' ', $key) }}:</span> {{ $detail }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-sm text-slate-700 leading-relaxed">{{ __('admin.no_additional_details') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                        <div class="space-y-6">
                            <div>
                                <h2 class="text-base font-semibold text-slate-900">{{ __('admin.quick_actions') }}</h2>
                                <p class="mt-2 text-sm text-slate-500">{{ __('admin.quick_actions_description') }}</p>
                            </div>
                            <div class="grid gap-3">
                            <button type="button" onclick="document.getElementById('statusModal').classList.remove('hidden')" class="w-full rounded-2xl bg-blue-950 px-4 py-3 text-sm font-semibold text-white">{{ __('admin.actions.update_status') }}</button>
                            <form action="{{ route('admin.requests.destroy', $request->id) }}" method="POST" onsubmit="return confirm('{{ __('admin.modals.delete_confirm') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full rounded-2xl bg-rose-50 text-rose-700 px-4 py-3 text-sm font-semibold hover:bg-rose-100">{{ __('admin.actions.delete') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Update Modal -->
        <div id="statusModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg p-8">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900">{{ __('admin.modals.title') }}</h3>
                        <p class="mt-2 text-sm text-slate-500">{{ __('admin.modals.description') }}</p>
                    </div>
                    <button type="button" onclick="document.getElementById('statusModal').classList.add('hidden')" class="text-slate-500 hover:text-slate-900">{{ __('admin.modals.cancel') }}</button>
                </div>
                <form action="{{ route('admin.requests.update', $request->id) }}" method="POST" class="mt-6 space-y-4">
                    @csrf
                    @method('PUT')
                    <label class="block text-sm font-semibold text-slate-700">{{ __('admin.modals.status') }}</label>
                    <select name="status" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                        @foreach(\App\Models\Request::STATUSES as $key => $label)
                            @if (! in_array($key, ['pending', 'in_review']))
                                <option value="{{ $key }}" {{ $request->status === $key ? 'selected' : '' }}>{{ __('admin.statuses.' . $key) }}</option>
                            @endif
                        @endforeach
                    </select>
                     <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">{{ __('admin.modals.comment') }}</label>
                        <textarea name="admin_comment" rows="4" class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none resize-none" placeholder="{{ __('admin.modals.comment_placeholder') }}"></textarea>
                    </div>
                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" onclick="document.getElementById('statusModal').classList.add('hidden')" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">{{ __('admin.modals.cancel') }}</button>
                        <button type="submit" class="rounded-2xl bg-blue-950 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-900">{{ __('admin.modals.update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-admin.layout>
