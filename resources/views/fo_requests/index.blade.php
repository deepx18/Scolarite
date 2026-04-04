<x-client.app-layout title="My Requests" activeRoute="requests">
    <!-- Hero Header Section & Search -->
    <x-client.page-header 
        title="My Requests"
        searchPlaceholder="Search by type or status..."
    />

    <!-- Stats Grid -->
    {{-- <x-stats-grid 
        :totalRequests="24"
        :newThisMonth="2"
        :pendingRequests="3"
    /> --}}

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