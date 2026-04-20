<!-- Mobile Bottom Navigation -->
<nav class="lg:hidden fixed bottom-0 left-0 w-full flex justify-around items-center px-4 pb-6 pt-3 bg-white/90 dark:bg-slate-950/90 backdrop-blur-2xl z-50 rounded-t-xl shadow-[0_-4px_24px_rgba(0,0,0,0.04)] border-t border-slate-100 dark:border-slate-800">
    <a class="flex flex-col items-center justify-center {{ request()->routeIs('dashboard') ? 'text-blue-900 dark:text-blue-200 bg-blue-50/50 dark:bg-blue-900/20 rounded-xl px-3 py-1 scale-95' : 'text-slate-400 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-900' }} transition-all" href="#">
        <span class="material-symbols-outlined">home</span>
        <span class="font-manrope text-[10px] uppercase tracking-widest font-bold mt-1">Home</span>
    </a>
    <a class="flex flex-col items-center justify-center {{ request()->routeIs('requests.*') ? 'text-blue-900 dark:text-blue-200 bg-blue-50/50 dark:bg-blue-900/20 rounded-xl px-3 py-1 scale-95' : 'text-slate-400 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-900' }} transition-all" href="{{ route('requests.index') }}">
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ request()->routeIs('requests.*') ? '1' : '0' }};">pending_actions</span>
        <span class="font-manrope text-[10px] uppercase tracking-widest font-bold mt-1">Requests</span>
    </a>
    <a class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-900 transition-all" href="#">
        <span class="material-symbols-outlined">description</span>
        <span class="font-manrope text-[10px] uppercase tracking-widest font-bold mt-1">Docs</span>
    </a>
    <a class="flex flex-col items-center justify-center {{ request()->routeIs('profile.*') ? 'text-blue-900 dark:text-blue-200 bg-blue-50/50 dark:bg-blue-900/20 rounded-xl px-3 py-1 scale-95' : 'text-slate-400 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-900' }} transition-all" href="{{ route('profile.show') }}">
        <span class="material-symbols-outlined">person</span>
        <span class="font-manrope text-[10px] uppercase tracking-widest font-bold mt-1">Profile</span>
    </a>
    <a class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-900 transition-all" href="#">
        <span class="material-symbols-outlined">menu</span>
        <span class="font-manrope text-[10px] uppercase tracking-widest font-bold mt-1">Menu</span>
    </a>
</nav>
