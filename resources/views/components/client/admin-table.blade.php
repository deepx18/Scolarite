@props(['class' => ''])

<div class="overflow-x-auto max-w-full rounded-2xl border border-outline-variant/20 shadow-sm {{ $class }}">
    <table class="w-full min-w-full table-auto border-collapse text-sm"> 
        {{ $slot }}
    </table>
</div>
