@props(['class' => ''])

<div class="overflow-x-auto {{ $class }}">
    <table class="w-full min-w-full border-collapse text-sm"> 
        {{ $slot }}
    </table>
</div>
