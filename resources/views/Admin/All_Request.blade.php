<x-admin.layout>
    <x-admin.navbar />
    <x-admin.sidebar />

    <!-- Main Content Canvas -->
    <main class="ml-64 pt-24 px-8 pb-12">
        <x-admin.header />

        <!-- Bento Filter Bar -->
        <x-admin.filter-bar 
            :requestTypes="$requestTypes"
            :statuses="$statuses"
        />

        <!-- Data Table Container -->
        <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low/50">
                        <th class="p-5 w-12">
                            <input class="rounded border-outline-variant text-primary focus:ring-primary w-4 h-4" type="checkbox"/>
                        </th>
                        <th class="p-5 font-bold text-xs uppercase tracking-widest text-slate-500">Student Name</th>
                        <th class="p-5 font-bold text-xs uppercase tracking-widest text-slate-500">Request Type</th>
                        <th class="p-5 font-bold text-xs uppercase tracking-widest text-slate-500">Submission Date</th>
                        <th class="p-5 font-bold text-xs uppercase tracking-widest text-slate-500">Status</th>
                        <th class="p-5 font-bold text-xs uppercase tracking-widest text-slate-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low">
                    @foreach ($requests as $request)
                        <tr class="hover:bg-surface-container-low/30 transition-colors">
                            <td class="p-5">
                                <input class="rounded border-outline-variant text-primary focus:ring-primary w-4 h-4" type="checkbox"/>
                            </td>
                            <td class="p-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-secondary-fixed flex items-center justify-center font-bold text-on-secondary-fixed text-xs">
                                        {{ substr($request->student->first_name, 0, 1) }}{{ substr($request->student->last_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-on-surface text-sm">{{ $request->student->first_name }} {{ $request->student->last_name }}</p>
                                        <p class="text-xs text-slate-400">{{ $request->student->apogee_number }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-5">
                                <div class="flex items-center gap-2 text-sm font-medium text-on-surface">
                                    <span class="material-symbols-outlined text-primary text-lg">description</span>
                                    {{ $request->type }}
                                </div>
                            </td>
                            <td class="p-5">
                                <span class="text-sm text-slate-500 font-medium">{{ $request->created_at->format('M d, Y') }}</span>
                            </td>
                            <td class="p-5">
                                @php
                                    $statusColors = [
                                        'Pending' => ['bg-amber-100', 'text-amber-800', 'bg-amber-500'],
                                        'Approved' => ['bg-emerald-100', 'text-emerald-800', 'bg-emerald-500'],
                                        'Rejected' => ['bg-rose-100', 'text-rose-800', 'bg-rose-500'],
                                    ];
                                    $colors = $statusColors[$request->status] ?? ['bg-gray-100', 'text-gray-800', 'bg-gray-500'];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $colors[0] }} {{ $colors[1] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $colors[2] }} mr-1.5"></span>
                                    {{ $request->status }}
                                </span>
                            </td>
                            <td class="p-5 text-right">
                                <a href="{{ route('admin.requests.show', $request->id) }}" class="text-primary font-bold text-sm hover:underline">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="p-5 flex justify-between items-center bg-surface-container-low/20">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Showing {{ $requests->firstItem() }}-{{ $requests->lastItem() }} of {{ $requests->total() }} requests</p>
                {{ $requests->links() }}
            </div>
        </div>
        <!-- Asymmetrical Feature Section: Quick Insights -->
        <section class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2 bg-gradient-to-br from-primary to-primary-container p-8 rounded-2xl text-on-primary flex flex-col justify-between h-64 relative overflow-hidden shadow-xl">
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold tracking-tight mb-2">Automated Processing</h3>
                    <p class="text-on-primary-container max-w-sm">Enable AI-assisted validation for standard transcript requests to reduce turnaround time by 40%.</p>
                </div>
                <div class="relative z-10">
                    <button class="bg-white text-primary font-black py-2.5 px-6 rounded-lg text-sm tracking-tight active:scale-95 transition-transform">Configure Rules</button>
                </div>
                <!-- Abstract decorative element -->
                <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute top-10 right-20 w-32 h-32 bg-secondary-fixed/5 rounded-full blur-2xl"></div>
            </div>
            <div class="bg-tertiary-container p-8 rounded-2xl flex flex-col justify-center items-center text-center shadow-lg border border-outline-variant/10">
                <span class="material-symbols-outlined text-tertiary-fixed-dim text-5xl mb-4" style="font-variation-settings: 'FILL' 1;">bolt</span>
                <h3 class="text-xl font-bold text-on-tertiary-container mb-2">Priority Queue</h3>
                <p class="text-on-tertiary-container/80 text-sm mb-6">There are 4 urgent requests requiring immediate signature.</p>
                <button class="w-full bg-tertiary-fixed text-on-tertiary-fixed font-bold py-3 rounded-xl text-sm uppercase tracking-widest hover:brightness-110 transition-all">Review Now</button>
            </div>
        </section>
    </main>
</x-admin.layout>
