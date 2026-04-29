<form method="GET" action="{{ route('admin.requests.index') }}" class="grid grid-cols-12 gap-4 mb-8">
    <!-- Search Input -->
    <div class="col-span-12 md:col-span-5 bg-surface-container-low p-2 rounded-xl flex items-center">
        <span class="material-symbols-outlined px-3 text-slate-400">search</span>
        <input name="search" class="bg-transparent border-none focus:ring-0 w-full text-sm font-medium"
            placeholder="{{ __('admin.search_placeholder') }}" type="text" value="{{ request('search') }}" />
    </div>

    <!-- Request Type Filter -->
    <div class="col-span-6 md:col-span-2 bg-surface-container-low rounded-xl flex items-center px-4">
        <span class="material-symbols-outlined text-slate-400 mr-2 text-sm">filter_list</span>
        <select name="type" onchange="this.form.submit()"
            class="bg-transparent border-none focus:ring-0 w-full text-sm font-medium appearance-none">
            <option value="">{{ __('admin.type_filter_placeholder') }}</option>
            @foreach ($requestTypes as $type)
                <option value="{{ $type }}" {{ request('type') === $type ? 'selected' : '' }}>
                    {{ __('admin.request_types.' . $type) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Status Filter -->
    <div class="col-span-6 md:col-span-2 bg-surface-container-low rounded-xl flex items-center px-4">
        <span class="material-symbols-outlined text-slate-400 mr-2 text-sm">radio_button_checked</span>
        <select name="status" onchange="this.form.submit()"
            class="bg-transparent border-none focus:ring-0 w-full text-sm font-medium appearance-none">
            <option value="">{{ __('admin.status_filter_placeholder') }}</option>
            @foreach ($statuses as $key => $label)
                <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>
                    {{ __('admin.statuses.' . $key) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Action Buttons -->
    <div class="col-span-12 md:col-span-3 flex gap-2 justify-end">
        <button type="button"
            onclick="const input = document.createElement('input'); input.type = 'hidden'; input.name = 'export'; input.value = '1'; this.form.appendChild(input); this.form.submit();"
            class="bg-surface-container-highest text-on-surface font-bold py-3 rounded-full text-base hover:bg-slate-300 transition-colors flex items-center justify-center gap-3 px-5">
            <span class="material-symbols-outlined text-base">file_download</span>
            {{ __('admin.export') }}
        </button>
    </div>
</form>