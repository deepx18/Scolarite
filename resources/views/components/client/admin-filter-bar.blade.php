@props([
    'searchPlaceholder' => 'Search requests...',
    'submitLabel' => 'Search',
    'action' => '',
    'filters' => []
])

<form method="GET" action="{{ $action }}" class="grid grid-cols-12 gap-4 mb-8 items-center">

    <!-- Search Input -->
    <div class="col-span-12 md:col-span-6 bg-surface-container-low rounded-full flex items-center px-4 border border-outline-variant/20">
        <span class="material-symbols-outlined text-on-surface-variant mr-3">search</span>
        <input 
            name="search" 
            class="bg-transparent border-none focus:ring-0 w-full text-sm font-medium text-on-surface placeholder-on-surface-variant py-3"
            placeholder="{{ $searchPlaceholder }}" 
            type="text" 
            value="{{ request('search') }}"
        />
    </div>

    <!-- Filters -->
    @if(count($filters) > 0)
        @foreach($filters as $filter)
            <div class="col-span-6 md:col-span-2 bg-surface-container-low rounded-full flex items-center px-4 border border-outline-variant/20">
                <span class="material-symbols-outlined text-on-surface-variant mr-2 text-sm">
                    {{ $filter['icon'] ?? 'filter_list' }}
                </span>

                <select 
                    name="{{ $filter['name'] }}"
                    onchange="this.form.submit()"
                    class="bg-transparent border-none focus:ring-0 w-full text-sm font-medium appearance-none text-on-surface py-3"
                >
                    <option value="">{{ $filter['placeholder'] }}</option>

                    @foreach ($filter['options'] as $value => $label)
                        <option 
                            value="{{ $value }}"
                            @selected(request($filter['name']) == $value)
                        >
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endforeach
    @endif

    <!-- Submit Button -->
    <div class="col-span-12 md:col-span-2">
        <button 
            type="submit"
            class="w-full h-full bg-[#0f2755] text-white rounded-full text-sm font-semibold hover:bg-[#0b1f46] transition flex items-center justify-center gap-2 py-3"
        >
            {{ $submitLabel }}
        </button>
    </div>

    <!-- Extra Actions -->
    {{ $slot }}

</form>
