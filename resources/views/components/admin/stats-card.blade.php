@props(['label', 'value', 'icon' => 'analytics', 'meta' => null])

<div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm relative overflow-hidden">
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-slate-500 font-semibold">{{ $label }}</p>
            <h3 class="mt-3 text-3xl md:text-4xl font-black text-slate-950 font-headline">{{ $value }}</h3>
        </div>
        <div
            class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-50 text-slate-700 ring-1 ring-slate-100">
            <span class="material-symbols-outlined text-lg">{{ $icon }}</span>
        </div>
    </div>

    @if($meta)
        <p class="mt-4 text-sm text-slate-500">{{ $meta }}</p>
    @endif
</div>