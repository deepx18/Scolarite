<x-client.app-layout title="My Requests" activeRoute="requests">
    <!-- Hero Header Section & Search -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-on-surface mb-2">My Requests</h1>
        <p class="text-secondary mb-6">Manage and track all your submitted requests</p>

        <!-- Search & Filter Bar -->
        <form method="GET" action="{{ route('requests.index') }}" class="flex gap-4 items-end flex-wrap">
            <div class="flex-1 min-w-64">
                <label class="text-sm text-secondary font-semibold block mb-2">Search</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 material-symbols-outlined text-secondary text-lg">search</span>
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search by reference or type..." 
                        value="{{ request('search') }}"
                        class="w-full pl-10 pr-4 py-3 rounded-lg border border-outline-variant/50 text-on-surface placeholder-secondary focus:outline-none focus:border-primary"
                    />
                </div>
            </div>

            <div class="min-w-48">
                <label class="text-sm text-secondary font-semibold block mb-2">Status</label>
                <select 
                    name="status" 
                    class="w-full px-4 py-3 rounded-lg border border-outline-variant/50 text-on-surface focus:outline-none focus:border-primary"
                >
                    <option value="">All Statuses</option>
                    @foreach (App\Models\Request::STATUSES as $key => $label)
                        <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-primary text-blue px-6 py-3 rounded-lg font-semibold hover:opacity-90 transition-all">
                    Search
                </button>
                <a href="{{ route('requests.index') }}" class="bg-surface-container-high text-on-surface px-6 py-3 rounded-lg font-semibold hover:bg-surface-variant transition-all">
                    Clear
                </a>
            </div>
        </form>

        <!-- New Request Button -->
        <div class="mt-4">
            <a href="{{ route('requests.create') }}" class="inline-flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-lg font-semibold hover:bg-primary/20 transition-all">
                <span class="material-symbols-outlined">add</span>
                New Request
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-green-700 font-semibold">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Data Table Section -->
    <x-client.request-data-table :requests="$requests ?? []" />

    <!-- Pagination -->
    <x-client.pagination 
        :currentPage="$currentPage ?? 1"
        :totalPages="$totalPages ?? 3"
        :total="$total ?? 24"
        :perPage="$perPage ?? 5"
    />

    <!-- Footer -->
    {{-- <x-page-footer /> --}}
</x-client.app-layout>