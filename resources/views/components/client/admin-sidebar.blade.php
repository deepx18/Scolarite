@props(['active' => ''])

<!-- Mobile Overlay (only on mobile/tablet) -->
<div id="sidebarOverlay" class="hidden lg:hidden fixed inset-0 bg-black/50 z-30 transition-all duration-300"></div>

<!-- Admin-style Student Sidebar -->
<aside id="studentSidebar" class="fixed left-0 top-0 h-screen w-64 pt-20 bg-slate-50 dark:bg-slate-950 flex flex-col p-4 space-y-2 border-r border-slate-200/50 dark:border-slate-800 transition-all duration-300 ease-in-out -translate-x-full lg:translate-x-0 z-40">
    <div class="mb-6 px-2">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 bg-primary rounded-full flex items-center justify-center text-white flex-shrink-0 shadow-lg">
                <span class="material-symbols-outlined text-lg">school</span>
            </div>
            <div class="flex-1 min-w-0">
                <h2 class="font-headline font-bold text-slate-900 dark:text-white text-sm leading-tight">Student Portal</h2>
                <p class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-widest font-bold">Academic Requests</p>
            </div>
        </div>
    </div>

    <nav class="grow space-y-0.5">
        <a 
            href="{{ route('requests.index') }}"
            class="{{ request()->routeIs('requests.index') ? 'flex items-center gap-3 px-4 py-3 bg-white dark:bg-slate-900 text-primary rounded-xl font-semibold shadow-sm transition-all' : 'flex items-center gap-3 px-4 py-3 text-slate-700 dark:text-slate-300 hover:text-primary hover:bg-slate-100 dark:hover:bg-slate-900 rounded-xl transition-all' }}"
        >
            <span class="material-symbols-outlined text-lg">list</span>
            <span class="font-medium">My Requests</span>
        </a>

        <a 
            href="{{ route('requests.create') }}"
            class="{{ request()->routeIs('requests.create') ? 'flex items-center gap-3 px-4 py-3 bg-white dark:bg-slate-900 text-primary rounded-xl font-semibold shadow-sm transition-all' : 'flex items-center gap-3 px-4 py-3 text-slate-700 dark:text-slate-300 hover:text-primary hover:bg-slate-100 dark:hover:bg-slate-900 rounded-xl transition-all' }}"
        >
            <span class="material-symbols-outlined text-lg">add_circle</span>
            <span class="font-medium">New Request</span>
        </a>

        <a 
            href="{{ route('profile.show') }}"
            class="{{ request()->routeIs('profile.*') ? 'flex items-center gap-3 px-4 py-3 bg-white dark:bg-slate-900 text-primary rounded-xl font-semibold shadow-sm transition-all' : 'flex items-center gap-3 px-4 py-3 text-slate-700 dark:text-slate-300 hover:text-primary hover:bg-slate-100 dark:hover:bg-slate-900 rounded-xl transition-all' }}"
        >
            <span class="material-symbols-outlined text-lg">account_circle</span>
            <span class="font-medium">My Profile</span>
        </a>

        <a 
            href="#"
            class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-900 rounded-xl transition-all"
        >
            <span class="material-symbols-outlined text-lg">file_download</span>
            <span class="font-medium">Downloads</span>
        </a>
    </nav>

    <div class="border-t border-slate-200/40 dark:border-slate-800 mt-4 pt-4 space-y-0.5">
        <a 
            href="#"
            class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 hover:bg-slate-50/50 dark:hover:bg-slate-900/30 rounded-lg transition-all"
        >
            <span class="material-symbols-outlined text-lg">help_outline</span>
            <span class="font-medium">Help & Support</span>
        </a>

        <form method="POST" action="{{ route('logout.student') }}" class="m-0">
            @csrf
            <button 
                type="submit"
                class="w-full flex items-center gap-3 px-4 py-3 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all text-left font-medium"
            >
                <span class="material-symbols-outlined text-lg">logout</span>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<script>
    function toggleStudentSidebar() {
        const sidebar = document.getElementById('studentSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    function closeStudentSidebarOnMobile() {
        if (window.innerWidth < 1024) {
            const sidebar = document.getElementById('studentSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    }

    document.getElementById('sidebarOverlay')?.addEventListener('click', toggleStudentSidebar);
</script>
