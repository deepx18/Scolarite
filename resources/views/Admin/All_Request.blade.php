<x-admin.layout>
    <x-admin.navbar />

    <x-admin.sidebar />

    <!-- Main Content Canvas -->
    <main class="lg:ml-64 pt-20 sm:pt-24 px-4 sm:px-8 pb-12">
        <x-admin.header />

        @if(session('success') || session('error'))
            <div class="rounded-3xl border p-5 shadow-sm text-sm font-medium my-4">
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

        <!-- Bento Filter Bar -->
        <x-admin.filter-bar :requestTypes="$requestTypes" :statuses="$statuses" />

        <!-- Data Table Container -->
        <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm overflow-x-auto max-w-full">
            <table class="w-full min-w-full md:min-w-[720px] table-auto text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low/50">
                        <th
                            class="p-3 sm:p-5 font-bold text-xs uppercase tracking-widest text-slate-500 whitespace-nowrap">
                            {{ __('admin.table.student_name') }}</th>
                        <th
                            class="p-3 sm:p-5 font-bold text-xs uppercase tracking-widest text-slate-500 whitespace-nowrap hidden sm:table-cell">
                            {{ __('admin.table.request_type') }}</th>
                        <th
                            class="p-3 sm:p-5 font-bold text-xs uppercase tracking-widest text-slate-500 whitespace-nowrap hidden md:table-cell">
                            {{ __('admin.table.date') }}</th>
                        <th
                            class="p-3 sm:p-5 font-bold text-xs uppercase tracking-widest text-slate-500 whitespace-nowrap">
                            {{ __('admin.table.status') }}</th>
                        <th
                            class="p-3 sm:p-5 font-bold text-xs uppercase tracking-widest text-slate-500 text-right whitespace-nowrap">
                            {{ __('admin.table.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low">
                    @foreach ($requests as $request)
                        <tr class="hover:bg-surface-container-low/30 transition-colors text-sm md:text-base">
                            <td class="p-3 sm:p-5">
                                <div class="flex items-center gap-2 sm:gap-3">
                                    <div
                                        class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-secondary-fixed flex items-center justify-center font-bold text-on-secondary-fixed text-xs flex-shrink-0">
                                        {{ substr($request->student->first_name, 0, 1) }}{{ substr($request->student->last_name, 0, 1) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-bold text-on-surface text-xs sm:text-sm truncate">
                                            {{ $request->student->first_name }} {{ $request->student->last_name }}</p>
                                        <p class="text-xs text-slate-400 truncate">
                                            {{ $request->student->cne ?? $request->student->apogee_number }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3 sm:p-5 hidden sm:table-cell">
                                <div
                                    class="flex items-center gap-2 text-xs sm:text-sm font-medium text-on-surface whitespace-nowrap">
                                    <span
                                        class="material-symbols-outlined text-primary text-lg hidden sm:inline">description</span>
                                    {{ $request->typeLabel() }}
                                </div>
                            </td>
                            <td class="p-3 sm:p-5 hidden md:table-cell">
                                <span
                                    class="text-xs sm:text-sm text-slate-500 font-medium whitespace-nowrap">{{ $request->created_at->format('M d, Y') }}</span>
                            </td>
                            <td class="p-3 sm:p-5">
                                @php
                                    $normalizedStatus = strtolower(str_replace(' ', '_', $request->status));
                                    $statusColors = [
                                        'pending' => ['bg-amber-50', 'text-amber-700', 'bg-amber-500'],
                                        'approved' => ['bg-emerald-50', 'text-emerald-700', 'bg-emerald-500'],
                                        'rejected' => ['bg-rose-50', 'text-rose-700', 'bg-rose-500'],
                                        'in_review' => ['bg-sky-50', 'text-sky-700', 'bg-sky-500'],
                                    ];
                                    $colors = $statusColors[$normalizedStatus] ?? ['bg-gray-100', 'text-gray-800', 'bg-gray-500'];
                                    $statusLabel = ucwords(str_replace('_', ' ', $normalizedStatus));
                                @endphp
                                <span
                                    class="inline-flex items-center px-2 sm:px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colors[0] }} {{ $colors[1] }} whitespace-nowrap">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $colors[2] }} mr-1"></span>
                                    {{ $request->statusLabel() }}
                                </span>
                            </td>
                            <td class="p-3 sm:p-5 text-right">
                                <div class="flex items-center justify-end gap-1 sm:gap-2 flex-wrap">
                                    <a href="{{ route('admin.requests.show', $request->id) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-sky-100 text-sky-600 hover:bg-sky-200 transition flex-shrink-0"
                                        title="{{ __('admin.actions.view') }}">
                                        <span class="material-symbols-outlined text-sm sm:text-base">visibility</span>
                                    </a>
                                    <button type="button"
                                        onclick="openStatusModal({{ $request->id }}, '{{ $request->status }}')"
                                        class="inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-amber-100 text-amber-600 hover:bg-amber-200 transition flex-shrink-0"
                                        title="{{ __('admin.actions.update_status') }}">
                                        <span class="material-symbols-outlined text-sm sm:text-base">edit</span>
                                    </button>
                                    <form action="{{ route('admin.requests.destroy', $request->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('{{ __('admin.modals.delete_confirm') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-rose-100 text-rose-600 hover:bg-rose-200 transition flex-shrink-0"
                                            title="{{ __('admin.actions.delete') }}">
                                            <span class="material-symbols-outlined text-sm sm:text-base">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="p-5 flex justify-between items-center bg-surface-container-low/20">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">
                    {{ __('admin.table.showing', ['from' => $requests->firstItem(), 'to' => $requests->lastItem(), 'total' => $requests->total()]) }}
                </p>
                {{ $requests->links() }}
            </div>
        </div>
        <!-- Quick insights removed -->
    </main>

    <!-- Status Update Modal -->
    <div id="statusModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">{{ __('admin.modals.title') }}</h2>

            <form id="statusForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label
                        class="block text-sm font-semibold text-slate-700 mb-2">{{ __('admin.modals.status') }}</label>
                    <select name="status" id="statusSelect"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        @foreach(\App\Models\Request::STATUSES as $key => $label)
                            @if (! in_array($key, ['pending', 'in_review']))
                                <option value="{{ $key }}">{{ __('admin.statuses.' . $key) }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div>
                    <label
                        class="block text-sm font-semibold text-slate-700 mb-2">{{ __('admin.modals.comment') }}</label>
                    <textarea name="admin_comment" rows="4"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none resize-none"
                        placeholder="{{ __('admin.modals.comment_placeholder') }}"></textarea>
                </div>

                <div class="flex gap-3 pt-6">
                    <button type="button" onclick="closeStatusModal()"
                        class="flex-1 px-4 py-3 border border-slate-300 text-slate-700 font-semibold rounded-xl hover:bg-slate-50 transition">
                        {{ __('admin.modals.cancel') }}
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-3 bg-primary text-white font-semibold rounded-xl hover:opacity-90 transition">
                        {{ __('admin.modals.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openStatusModal(requestId, currentStatus) {
            document.getElementById('statusSelect').value = currentStatus;
            document.getElementById('statusForm').action = `/admin/requests/${requestId}`;
            document.getElementById('statusModal').classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }

        document.getElementById('statusModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeStatusModal();
            }
        });
    </script>
</x-admin.layout>