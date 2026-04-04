@props(['label' => '', 'placeholder' => '', 'type' => 'text', 'name' => '', 'value' => '', 'required' => false, 'rows' => null])

<div class="space-y-1">
    @if($label)
        <label class="text-xs font-semibold text-slate-500 ml-1">
            {{ $label }}
            @if($required)
                <span class="text-error">*</span>
            @endif
        </label>
    @endif
    @if($type === 'textarea')
        <textarea class="w-full bg-surface-container-low border-none rounded-xl p-4 text-on-surface focus:ring-2 focus:ring-primary focus:bg-white transition-all resize-none {{ $rows ? "min-h-[" . ($rows * 28) . "px]" : 'min-h-[140px]' }}" 
            name="{{ $name }}" 
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}>{{ $value }}</textarea>
    @elseif($type === 'select')
        <div class="relative">
            <select class="w-full bg-surface-container-low border-primary rounded-xl p-4 text-primary font-medium focus:ring-2 focus:ring-primary focus:bg-white transition-all appearance-none cursor-pointer"
                name="{{ $name }}"
                {{ $required ? 'required' : '' }}>
                <option disabled="" selected="" value="">{{ $placeholder }}</option>
                {{ $slot }}
            </select>
            {{-- <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                <span class="material-symbols-outlined">expand_more</span>
            </div> --}}
        </div>
    @else
        <input class="w-full bg-surface-container-low border-none rounded-xl p-4 text-on-surface focus:ring-2 focus:ring-primary focus:bg-white transition-all"
            type="{{ $type }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            value="{{ $value }}"
            {{ $required ? 'required' : '' }}
        />
    @endif
</div>
