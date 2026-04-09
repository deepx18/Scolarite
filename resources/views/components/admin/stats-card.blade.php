@props(['label', 'value', 'icon' => 'analytics', 'meta' => null])

<div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-soft">
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-slate-500 font-semibold">{{ $label }}</p>
            <h3 class="mt-3 text-4xl font-black text-slate-950 font-headline">{{ $value }}</h3>
        </div>
        <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-slate-100 text-primary">
            <span class="material-symbols-outlined text-2xl">{{ $icon }}</span>
        </div>
    </div>

    @if($meta)
        <p class="mt-4 text-sm text-slate-500">{{ $meta }}</p>
    @endif
</div>
