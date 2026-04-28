@props(['title' => '', 'description' => ''])

<section {{ $attributes->merge(['class' => 'bg-surface-container-lowest rounded-3xl p-10 shadow-md border border-outline-variant/10']) }}>
    @if($title)
        <div class="mb-6">
            <h2 class="text-2xl md:text-3xl font-bold text-on-surface font-headline">{{ $title }}</h2>
            @if($description)
                <p class="text-sm md:text-base text-secondary mt-2 max-w-3xl">{{ $description }}</p>
            @endif
        </div>
    @endif

    {{ $slot }}
</section>