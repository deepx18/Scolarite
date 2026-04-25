@php
    $admin = auth('admin')->user();
    $role = optional($admin)->role ?? 'admin';
@endphp

<!-- TopNavBar -->
<nav
    class="fixed top-0 w-full z-50 bg-slate-50/80 dark:bg-slate-900/80 backdrop-blur-xl shadow-sm flex justify-between items-center px-4 sm:px-8 h-16 w-full">
    <div class="flex items-center gap-4 sm:gap-8">
        <!-- Menu Toggle Button (hidden on desktop) -->
        <button id="sidebarToggleBtn" onclick="toggleSidebar()"
            class="p-2 lg:hidden hover:bg-slate-200 dark:hover:bg-slate-800 rounded-lg transition-colors">
            <span class="material-symbols-outlined text-slate-700 dark:text-slate-300">menu</span>
        </button>

        <a href="{{ route('admin.dashboard') }}" class="flex items-center">
            <img src="{{ asset('logoEnsam.png') }}" alt="ENSAM logo" class="w-30 h-11 object-contain" />
        </a>
        {{-- <div class="hidden md:flex items-center gap-6">
            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'text-blue-900 dark:text-blue-100 font-bold border-b-2 border-blue-900 px-3 py-2 cursor-pointer active:scale-95 duration-200' : 'text-slate-500 dark:text-slate-400 font-medium hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors px-3 py-2 rounded-lg cursor-pointer active:scale-95 duration-200' }}">Overview</a>
            <a href="{{ route('admin.requests.index') }}"
                class="{{ request()->routeIs('admin.requests.index') ? 'text-blue-900 dark:text-blue-100 font-bold border-b-2 border-blue-900 px-3 py-2 cursor-pointer active:scale-95 duration-200' : 'text-slate-500 dark:text-slate-400 font-medium hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors px-3 py-2 rounded-lg cursor-pointer active:scale-95 duration-200' }}">All
                Requests</a>
            <a class="text-slate-500 dark:text-slate-400 font-medium hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors px-3 py-2 rounded-lg cursor-pointer active:scale-95 duration-200"
                href="{{ route('admin.students.index') }}">Student Directory</a>
        </div> --}}
    </div>
    <div class="flex items-center gap-4">
        <x-lang-switcher />

        {{-- <div class="relative group">
            <span
                class="material-symbols-outlined text-slate-500 p-2 hover:bg-slate-100 rounded-full cursor-pointer">notifications</span>
            <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full"></span>
        </div>
        <span
            class="material-symbols-outlined text-slate-500 p-2 hover:bg-slate-100 rounded-full cursor-pointer">help_outline</span>
        --}}
        <div class="relative">
            <button id="adminProfileButton" type="button"
                class="flex items-center gap-3 rounded-full border border-slate-200 bg-white px-3 py-2 hover:shadow-sm transition"
                onclick="toggleAdminProfileMenu(event)">
                <img alt="Administrator profile avatar"
                    class="w-8 h-8 rounded-full object-cover ring-2 ring-primary-fixed"
                    src="https://ui-avatars.com/api/?name={{ urlencode($admin->name ?? 'Admin') }}&background=002045&color=ffffff&size=128" />
                <div class="hidden md:flex flex-col text-left">
                    <span class="text-sm font-semibold text-slate-900">{{ $admin->name ?? 'Administrator' }}</span>
                    <span
                        class="text-xs text-slate-500">{{ $role === 'super_admin' ? 'Super Admin' : 'Administrator' }}</span>
                </div>
                <span class="material-symbols-outlined text-slate-400">expand_more</span>
            </button>

            <div id="adminProfileMenu"
                class="hidden absolute right-0 mt-2 w-60 overflow-hidden rounded-3xl bg-white border border-slate-200 shadow-xl">
                <div class="p-4 border-b border-slate-200">
                    <p class="text-sm font-semibold text-slate-900">{{ $admin->name ?? 'Administrator' }}</p>
                    <p class="text-xs text-slate-500">{{ $admin->email }}</p>
                </div>
                <a href="{{ route('admin.profile') }}"
                    class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50">My Profile</a>
                <div class="border-t border-slate-100"></div>
                <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-3 text-sm font-semibold text-rose-600 hover:bg-rose-50">Log
                        Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleAdminProfileMenu(event) {
        event.stopPropagation();
        document.getElementById('adminProfileMenu').classList.toggle('hidden');
    }

    document.addEventListener('click', function () {
        const menu = document.getElementById('adminProfileMenu');
        if (menu && !menu.classList.contains('hidden')) {
            menu.classList.add('hidden');
        }
    });
</script>