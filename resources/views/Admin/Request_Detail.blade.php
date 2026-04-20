<x-admin.layout>
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="ml-64 pt-24 px-8 pb-12">
        <div class="flex flex-col gap-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <span class="text-xs uppercase tracking-[0.3em] text-slate-500">Request Details</span>
                    <h1 class="mt-2 text-3xl font-bold text-blue-950 dark:text-white">Request #{{ $request->id }}</h1>
                    <p class="mt-3 max-w-2xl text-sm text-slate-500">View the full request details, student profile, and current status.</p>
                </div>
                <a href="{{ route('admin.requests.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">Back to requests</a>
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
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Student</p>
                            <div class="rounded-3xl bg-slate-50 p-5">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                    <div>
                                        <p class="text-xl font-bold text-blue-950">{{ $request->student->first_name }} {{ $request->student->last_name }}</p>
                                        <p class="text-sm text-slate-500">CNE: {{ $request->student->cne ?? 'N/A' }}</p>
                                        <p class="text-sm text-slate-500">Apogee: {{ $request->student->apogee_number }}</p>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3 text-sm text-slate-600">
                                        <div>
                                            <span class="block font-semibold">Email</span>
                                            <span>{{ $request->student->email }}</span>
                                        </div>
                                        <div>
                                            <span class="block font-semibold">Department</span>
                                            <span>{{ $request->student->department }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Request information</p>
                            <div class="rounded-3xl bg-slate-50 p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">Reference</p>
                                    <p class="font-semibold text-slate-900">{{ $request->reference }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">Type</p>
                                    <p class="font-semibold text-slate-900">{{ $request->typeLabel() }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">Submitted</p>
                                    <p class="font-semibold text-slate-900">{{ $request->created_at->format('M d, Y H:i') }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">Last updated</p>
                                    <p class="font-semibold text-slate-900">{{ $request->updated_at->format('M d, Y H:i') }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.28em] text-slate-500">Status</p>
                                    <p class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700">{{ $request->statusLabel() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Details</p>
                            <div class="rounded-3xl bg-slate-50 p-5">
                                @if(is_array($request->details) && count($request->details))
                                    <ul class="space-y-2 text-sm text-slate-700 leading-relaxed list-disc list-inside">
                                        @foreach($request->details as $key => $detail)
                                            <li><span class="font-semibold capitalize">{{ str_replace('_', ' ', $key) }}:</span> {{ $detail }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-sm text-slate-700 leading-relaxed">{{ 'No additional details were submitted for this request.' }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-base font-semibold text-slate-900">Quick actions</h2>
                            <p class="mt-2 text-sm text-slate-500">Manage the request from here.</p>
                        </div>
                        <div class="grid gap-3">
                            <button type="button" onclick="document.getElementById('statusModal').classList.remove('hidden')" class="w-full rounded-2xl bg-blue-950 px-4 py-3 text-sm font-semibold text-white">Update status</button>
                            <form action="{{ route('admin.requests.destroy', $request->id) }}" method="POST" onsubmit="return confirm('Delete this request?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full rounded-2xl bg-rose-50 text-rose-700 px-4 py-3 text-sm font-semibold hover:bg-rose-100">Delete request</button>
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
                        <h3 class="text-2xl font-bold text-slate-900">Change status</h3>
                        <p class="mt-2 text-sm text-slate-500">Select a new status for this request.</p>
                    </div>
                    <button type="button" onclick="document.getElementById('statusModal').classList.add('hidden')" class="text-slate-500 hover:text-slate-900">Close</button>
                </div>
                <form action="{{ route('admin.requests.update', $request->id) }}" method="POST" class="mt-6 space-y-4">
                    @csrf
                    @method('PUT')
                    <label class="block text-sm font-semibold text-slate-700">Status</label>
                    <select name="status" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                        @foreach(\App\Models\Request::STATUSES as $key => $label)
                            <option value="{{ $key }}" {{ $request->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" onclick="document.getElementById('statusModal').classList.add('hidden')" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Cancel</button>
                        <button type="submit" class="rounded-2xl bg-blue-950 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-900">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-admin.layout>
