@props(['currentPage' => 1, 'totalPages' => 3, 'total' => 24, 'perPage' => 5])

@php
    $currentPage = (int) $currentPage;
    $totalPages = (int) $totalPages;
    $start = ($currentPage - 1) * $perPage + 1;
    $end = min($currentPage * $perPage, $total);
@endphp

<div class="px-8 py-6 bg-linear-to-r from-surface-container-high/40 to-surface-container-high/20 backdrop-blur-sm flex items-center justify-between border-t border-outline-variant/10">
    <span class="text-sm text-secondary font-medium">
        Showing <span class="font-semibold text-on-surface">{{ $start }}</span> to <span class="font-semibold text-on-surface">{{ $end }}</span> of <span class="font-semibold text-on-surface">{{ $total }}</span> requests
    </span>
    
    <div class="flex items-center gap-3">
        {{-- Previous Button --}}
        @if ($currentPage > 1)
            <a href="?page={{ $currentPage - 1 }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg border border-outline-variant/50 text-secondary hover:text-primary hover:bg-primary/5 hover:border-primary/30 transition-all duration-200 shadow-sm hover:shadow-md">
                <span class="material-symbols-outlined text-lg">chevron_left</span>
            </a>
        @else
            <button disabled class="inline-flex items-center justify-center w-9 h-9 rounded-lg border border-outline-variant/30 text-secondary opacity-40 cursor-not-allowed">
                <span class="material-symbols-outlined text-lg">chevron_left</span>
            </button>
        @endif

        {{-- Page Numbers --}}
        <div class="flex gap-1">
            @if ($totalPages > 5)
                {{-- Show first page if not current --}}
                @if ($currentPage > 3)
                    <a href="?page=1" class="px-3 py-1 rounded-lg text-xs font-semibold text-secondary hover:bg-white/50 transition-colors">
                        1
                    </a>
                    @if ($currentPage > 4)
                        <span class="px-2 py-1 text-xs text-secondary">...</span>
                    @endif
                @endif

                {{-- Show window around current page --}}
                @for ($i = max(1, $currentPage - 1); $i <= min($totalPages, $currentPage + 1); $i++)
                    @if ($i === $currentPage)
                        <button disabled class="px-3 py-1 rounded-lg text-xs font-bold bg-primary/10 text-primary shadow-md">
                            {{ $i }}
                        </button>
                    @else
                        <a href="?page={{ $i }}" class="px-3 py-1 rounded-lg text-xs font-semibold text-secondary hover:bg-white/60 transition-colors">
                            {{ $i }}
                        </a>
                    @endif
                @endfor

                {{-- Show last page if not current --}}
                @if ($currentPage < $totalPages - 2)
                    @if ($currentPage < $totalPages - 3)
                        <span class="px-2 py-1 text-xs text-secondary">...</span>
                    @endif
                    <a href="?page={{ $totalPages }}" class="px-3 py-1 rounded-lg text-xs font-semibold text-secondary hover:bg-white/50 transition-colors">
                        {{ $totalPages }}
                    </a>
                @endif
            @else
                {{-- Show all pages if 5 or fewer --}}
                @for ($i = 1; $i <= $totalPages; $i++)
                    @if ($i === $currentPage)
                        <button disabled class="px-3 py-1 rounded-lg text-xs font-bold bg-primary/10 text-primary shadow-md">
                            {{ $i }}
                        </button>
                    @else
                        <a href="?page={{ $i }}" class="px-3 py-1 rounded-lg text-xs font-semibold text-secondary hover:bg-white/60 transition-colors">
                            {{ $i }}
                        </a>
                    @endif
                @endfor
            @endif
        </div>

        {{-- Next Button --}}
        @if ($currentPage < $totalPages)
            <a href="?page={{ $currentPage + 1 }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg border border-outline-variant/50 text-secondary hover:text-primary hover:bg-primary/5 hover:border-primary/30 transition-all duration-200 shadow-sm hover:shadow-md">
                <span class="material-symbols-outlined text-lg">chevron_right</span>
            </a>
        @else
            <button disabled class="inline-flex items-center justify-center w-9 h-9 rounded-lg border border-outline-variant/30 text-secondary opacity-40 cursor-not-allowed">
                <span class="material-symbols-outlined text-lg">chevron_right</span>
            </button>
        @endif
    </div>
</div>
