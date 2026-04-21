<!-- Export Students Modal -->
<div id="exportStudentsModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div
                class="bg-white dark:bg-slate-950 rounded-3xl shadow-xl max-w-md w-full mx-4 p-6 border border-slate-200 dark:border-slate-800">
                <!-- Modal Header -->
                <div class="flex items-center justify-between mb-6">
                        <div>
                                <h2 class="text-2xl font-bold text-blue-950 dark:text-white">
                                        {{ __('admin.export_students') }}
                                </h2>
                                <p class="text-sm text-slate-500 mt-1">{{ __('admin.select_export_options') }}</p>
                        </div>
                        <button type="button"
                                onclick="document.getElementById('exportStudentsModal').classList.add('hidden')"
                                class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 shrink-0">
                                <span class="material-symbols-outlined">close</span>
                        </button>
                </div>

                <!-- Export Form -->
                <form action="{{ route('admin.students.export') }}" method="GET" class="space-y-6">
                        <!-- Export Format Selection -->
                        <div>
                                <label
                                        class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">{{ __('admin.export_format') }}</label>
                                <div class="space-y-2">
                                        <label
                                                class="flex items-center p-2 bg-slate-50 dark:bg-slate-900 rounded hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer border-2 border-blue-950 dark:border-blue-500 transition">
                                                <input type="radio" name="format" value="xlsx" checked
                                                        class="w-4 h-4 text-blue-950 rounded">
                                                <span class="ml-3 text-sm font-medium text-slate-900 dark:text-white">Excel
                                                        (.xlsx) <span
                                                                class="text-xs text-slate-500">{{ __('admin.preferred') }}</span></span>
                                        </label>
                                        <label
                                                class="flex items-center p-2 bg-slate-50 dark:bg-slate-900 rounded hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer border border-slate-200 dark:border-slate-700 transition">
                                                <input type="radio" name="format" value="csv"
                                                        class="w-4 h-4 text-blue-950 rounded">
                                                <span class="ml-3 text-sm font-medium text-slate-900 dark:text-white">CSV
                                                        (.csv)</span>
                                        </label>
                                </div>
                        </div>

                        <!-- Modal Actions -->
                        <div class="flex gap-3 pt-4">
                                <button type="button"
                                        onclick="document.getElementById('exportStudentsModal').classList.add('hidden')"
                                        class="flex-1 px-4 py-2 bg-slate-200 dark:bg-slate-800 text-slate-900 dark:text-white font-semibold rounded-lg hover:bg-slate-300 dark:hover:bg-slate-700 transition text-sm">
                                        {{ __('admin.cancel') }}
                                </button>
                                <button type="submit"
                                        class="flex-1 px-4 py-2 bg-blue-950 text-white font-semibold rounded-lg hover:bg-blue-900 transition flex items-center justify-center gap-2 text-sm">
                                        <span class="material-symbols-outlined text-base">download</span>
                                        {{ __('admin.export') }}
                                </button>
                        </div>
                </form>
        </div>
</div>

<!-- Script to handle modal -->
<script>
        function openExportModal() {
                document.getElementById('exportStudentsModal').classList.remove('hidden');
        }

        function closeExportModal() {
                document.getElementById('exportStudentsModal').classList.add('hidden');
        }

        // Close modal when clicking outside of it
        document.getElementById('exportStudentsModal')?.addEventListener('click', function (event) {
                if (event.target === this) {
                        this.classList.add('hidden');
                }
        });
</script>