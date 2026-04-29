@props(['requests' => []])

<div class="bg-surface-container-low rounded-xl overflow-hidden shadow-sm">
    <div class="overflow-x-auto max-w-full">
        <table class="w-full min-w-full table-auto text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-high/50 text-on-surface-variant font-label text-xs uppercase tracking-widest">
                    <th class="px-8 py-5 font-bold">Request ID</th>
                    <th class="px-6 py-5 font-bold">Type</th>
                    <th class="px-6 py-5 font-bold">Date Submitted</th>
                    <th class="px-6 py-5 font-bold text-center">Status</th>
                    <th class="px-8 py-5 font-bold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($requests as $request)
                    <x-client.request-table-row :request="$request" />
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-8 text-center text-outline">
                            <p class="text-sm">No requests found.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
