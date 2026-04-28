@props(['class' => ''])

<div class="overflow-x-auto overflow-y-hidden rounded-2xl border border-outline-variant/20 shadow-sm {{ $class }}">
    <table class="w-full min-w-full border-collapse text-sm"> 
        {{ $slot }}
    </table>
</div>
