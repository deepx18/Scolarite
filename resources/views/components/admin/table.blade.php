@props(['class' => ''])

<div class="overflow-x-auto max-w-full rounded-xl shadow-sm {{ $class }}">
    <table class="w-full min-w-full table-auto border-collapse text-xs sm:text-sm md:text-base"> 
        {{ $slot }}
    </table>
</div>
