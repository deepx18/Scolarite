<!-- Desktop Side Navigation -->

<!--
<aside class="hidden lg:flex flex-col h-full p-4 space-y-2 bg-slate-50 dark:bg-slate-950 h-screen w-64 fixed left-0 top-0 z-40">
    <div class="flex items-center px-4 mb-8 pt-4">
        <div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center mr-3">
            {{-- <span class="material-symbols-outlined text-white">school</span> --}}
        </div>
        <div>
            {{-- <h2 class="text-lg font-black text-blue-900 dark:text-white leading-tight">Academic Hub</h2>
            <p class="text-[10px] text-slate-500 font-medium">Student Portal</p> --}}
        </div>
    </div>
    <nav class="flex-1 space-y-1">
        <a class="flex items-center px-4 py-3 rounded-xl transition-all text-slate-600 dark:text-slate-400 hover:text-blue-800 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 {{ request()->routeIs('dashboard') ? 'bg-white dark:bg-slate-900 text-blue-900 dark:text-blue-200 font-bold shadow-sm translate-x-1' : '' }}" href="#">
            <span class="material-symbols-outlined mr-3">dashboard</span>
            <span class="font-manrope text-sm font-medium">Dashboard</span>
        </a>
        <a class="flex items-center px-4 py-3 rounded-xl transition-all text-slate-600 dark:text-slate-400 hover:text-blue-800 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 {{ request()->routeIs('requests.*') ? 'bg-white dark:bg-slate-900 text-blue-900 dark:text-blue-200 font-bold shadow-sm translate-x-1' : '' }}" href="{{ route('requests.index') }}">
            <span class="material-symbols-outlined mr-3">pending_actions</span>
            <span class="font-manrope text-sm font-medium">Requests</span>
        </a>
        <a class="flex items-center px-4 py-3 rounded-xl transition-all text-slate-600 dark:text-slate-400 hover:text-blue-800 hover:bg-slate-200/50 dark:hover:bg-slate-800/50" href="#">
            <span class="material-symbols-outlined mr-3">description</span>
            <span class="font-manrope text-sm font-medium">Documents</span>
        </a>
        <a class="flex items-center px-4 py-3 rounded-xl transition-all text-slate-600 dark:text-slate-400 hover:text-blue-800 hover:bg-slate-200/50 dark:hover:bg-slate-800/50" href="#">
            <span class="material-symbols-outlined mr-3">school</span>
            <span class="font-manrope text-sm font-medium">Grades</span>
        </a>
        <div class="pt-8 pb-4">
            <div class="h-[1px] bg-slate-200/50 mx-4"></div>
        </div>
        <a class="flex items-center px-4 py-3 rounded-xl transition-all text-slate-600 dark:text-slate-400 hover:text-blue-800 hover:bg-slate-200/50 dark:hover:bg-slate-800/50" href="#">
            <span class="material-symbols-outlined mr-3">settings</span>
            <span class="font-manrope text-sm font-medium">Settings</span>
        </a>
        <a class="flex items-center px-4 py-3 rounded-xl transition-all text-slate-600 dark:text-slate-400 hover:text-blue-800 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 {{ request()->routeIs('profile.*') ? 'bg-white dark:bg-slate-900 text-blue-900 dark:text-blue-200 font-bold shadow-sm translate-x-1' : '' }}" href="{{ route('profile.show') }}">
            <span class="material-symbols-outlined mr-3">account_circle</span>
            <span class="font-manrope text-sm font-medium">Profile</span>
        </a>
    </nav>
    {{-- <div class="mt-auto">
        <a href="{{ route('requests.create') }}">
            <button class="w-full bg-primary text-white py-3 px-4 rounded-xl font-bold text-sm shadow-lg shadow-blue-900/20 active:scale-95 transition-all mb-4">
                New Request
            </button>
        </a>
        <form action="{{ route('logout.student') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center px-4 py-3 rounded-xl transition-all text-slate-600 dark:text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">
                <span class="material-symbols-outlined mr-3">logout</span>
                <span class="font-manrope text-sm font-medium">Logout</span>
            </button>
        </form>
    </div> --}}
</aside>
-->

<aside
    class="lg:flex flex-col h-full p-4 space-y-2 bg-slate-50 dark:bg-slate-950 w-64 fixed left-0 top-0 z-40">
    <div class="flex align-bottom items-end px-4 mb-8 h-24">
        <div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center mr-3">
            <span class="material-symbols-outlined text-white" data-icon="school">school</span>
        </div>
        <div>
            <h2 class="text-lg font-black text-blue-900 dark:text-white leading-tight">
                Academic Hub
            </h2>
            <p class="text-[10px] text-slate-500 font-medium">
                Student Portal
            </p>
        </div>
    </div>
    {{-- <div class="bg-surface-container-lowest dark:bg-surface-container-high text-on-background dark:text-inverse-on-surface">
        type shit
    </div> --}}
    <nav class="flex-1 space-y-1">
        <a class="flex items-center px-4 py-3 rounded-xl transition-all text-slate-600 dark:text-slate-400 hover:text-blue-800 hover:bg-slate-200/50 dark:hover:bg-slate-800/50"
            href="#">
            <span class="material-symbols-outlined mr-3" data-icon="dashboard">dashboard</span>
            <span class="font-manrope text-sm font-medium">Dashboard</span>
        </a>
        <a class="flex items-center px-4 py-3 rounded-xl transition-all bg-white dark:bg-slate-900 text-blue-900 dark:text-blue-200 font-bold shadow-sm translate-x-1"
            href="#">
            <span class="material-symbols-outlined mr-3" data-icon="pending_actions">pending_actions</span>
            <span class="font-manrope text-sm font-medium">Requests</span>
        </a>
        <a class="flex items-center px-4 py-3 rounded-xl transition-all text-slate-600 dark:text-slate-400 hover:text-blue-800 hover:bg-slate-200/50 dark:hover:bg-slate-800/50"
            href="#">
            <span class="material-symbols-outlined mr-3" data-icon="description">description</span>
            <span class="font-manrope text-sm font-medium">Documents</span>
        </a>
        <a class="flex items-center px-4 py-3 rounded-xl transition-all text-slate-600 dark:text-slate-400 hover:text-blue-800 hover:bg-slate-200/50 dark:hover:bg-slate-800/50"
            href="#">
            <span class="material-symbols-outlined mr-3" data-icon="school">school</span>
            <span class="font-manrope text-sm font-medium">Grades</span>
        </a>
        {{-- <div class="pt-8 pb-4">
            <div class="h-px bg-slate-200/50 mx-4"></div>
        </div>
        <a class="flex items-center px-4 py-3 rounded-xl transition-all text-slate-600 dark:text-slate-400 hover:text-blue-800 hover:bg-slate-200/50 dark:hover:bg-slate-800/50"
            href="#">
            <span class="material-symbols-outlined mr-3" data-icon="settings">settings</span>
            <span class="font-manrope text-sm font-medium">Settings</span>
        </a>
        <a class="flex items-center px-4 py-3 rounded-xl transition-all text-slate-600 dark:text-slate-400 hover:text-blue-800 hover:bg-slate-200/50 dark:hover:bg-slate-800/50"
            href="#">
            <span class="material-symbols-outlined mr-3" data-icon="account_circle">account_circle</span>
            <span class="font-manrope text-sm font-medium">Profile</span>
        </a> --}}
    </nav>
    <div class="mt-auto">
        <a href="{{ route('requests.create') }}">
            <button class="w-full bg-slate-50 dark:bg-slate-950 text-white py-3 px-4 rounded-xl font-bold text-sm shadow-lg shadow-blue-900/20 active:scale-95 transition-all mb-4">
                New Request
            </button>
        </a>
        <a class="flex items-center px-4 py-3 rounded-xl transition-all text-slate-600 dark:text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20"
            href="#">
            <span class="material-symbols-outlined mr-3" data-icon="logout">logout</span>
            <span class="font-manrope text-sm font-medium">Logout</span>
        </a>
    </div>
</aside>