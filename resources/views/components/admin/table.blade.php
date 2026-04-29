@props(['class' => ''])

<div class="overflow-x-auto overflow-y-hidden rounded-xl shadow-sm {{ $class }}">
    <table class="w-full min-w-full border-collapse text-xs sm:text-sm md:text-base"> 
        {{ $slot }}
    </table>
</div>
