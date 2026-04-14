<x-client.app-layout title="My Requests" activeRoute="requests">
    {{-- <x-client.header /> --}}

    {{-- <main class="lg:ml-64 min-h-screen pb-24 lg:pb-8"> --}}

        <!-- Success Message -->
        @if (session('success'))
            <section class="px-6 mb-6">
                <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                    <p class="text-green-700 font-semibold">{{ session('success') }}</p>
                </div>
            </section>
        @endif

        <!-- Error Message -->
        @if (session('error'))
            <section class="px-6 mb-6">
                <div class="p-4 bg-rose-50 border border-rose-200 rounded-lg">
                    <p class="text-rose-700 font-semibold">{{ session('error') }}</p>
                </div>
            </section>
        @endif

        <!-- Search & Filter -->
        <x-client.search-filter-bar :searchValue="old('search', $searchValue ?? '')" :selectedType="old('type', $selectedType ?? '')" :selectedStatus="old('status', $selectedStatus ?? '')"
            :types="App\Models\Request::TYPES ?? []" :statuses="App\Models\Request::STATUSES ?? []" />

        <!-- Requests Table -->
        <section class="px-6">
            <x-client.request-data-table :requests="$requests ?? []" />
        </section>

        <!-- Pagination -->
        <section class="px-6 mt-6">
            <x-client.pagination :currentPage="$currentPage ?? 1" :totalPages="$totalPages ?? 3" :total="$total ?? 24"
                :perPage="$perPage ?? 5" />
        </section>
        {{--
    </main> --}}

    {{-- <x-client.bottom-nav /> --}}
</x-client.app-layout>