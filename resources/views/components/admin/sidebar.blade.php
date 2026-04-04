<!-- SideNavBar -->
<aside class="fixed left-0 top-0 h-screen w-64 pt-20 bg-slate-100 dark:bg-slate-950 flex flex-col p-4 space-y-2 tonal-layering">
    <div class="mb-8 px-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-on-primary">
                <span class="material-symbols-outlined">account_balance</span>
            </div>
            <div>
                <h2 class="font-['Manrope'] font-black text-blue-950 dark:text-blue-50 text-sm">Admin Portal</h2>
                <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">Central Management</p>
            </div>
        </div>
    </div>
    <nav class="flex-grow space-y-1">
        <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:text-blue-800 dark:hover:text-blue-200 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 rounded-lg transition-all ease-in-out duration-150" href="#">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="font-medium">Overview</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 bg-white dark:bg-slate-900 text-blue-900 dark:text-white shadow-sm rounded-lg font-semibold ease-in-out duration-150" href="#">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">pending_actions</span>
            <span class="font-medium">All Requests</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:text-blue-800 dark:hover:text-blue-200 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 rounded-lg transition-all ease-in-out duration-150" href="#">
            <span class="material-symbols-outlined">group</span>
            <span class="font-medium">Student Directory</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:text-blue-800 dark:hover:text-blue-200 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 rounded-lg transition-all ease-in-out duration-150" href="#">
            <span class="material-symbols-outlined">analytics</span>
            <span class="font-medium">Reports</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:text-blue-800 dark:hover:text-blue-200 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 rounded-lg transition-all ease-in-out duration-150" href="#">
            <span class="material-symbols-outlined">settings</span>
            <span class="font-medium">System Settings</span>
        </a>
    </nav>
    <button class="mx-4 my-6 py-3 px-4 bg-gradient-to-br from-primary to-primary-container text-on-primary rounded-lg font-bold text-sm shadow-lg flex items-center justify-center gap-2 active:scale-95 transition-transform">
        <span class="material-symbols-outlined text-sm">add</span>
        New Report
    </button>
    <div class="border-t border-slate-200 dark:border-slate-800 pt-4 space-y-1">
        <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:text-blue-800 dark:hover:text-blue-200 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 rounded-lg transition-all" href="#">
            <span class="material-symbols-outlined">contact_support</span>
            <span class="font-medium">Support</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 text-error hover:bg-error/10 rounded-lg transition-all" href="#">
            <span class="material-symbols-outlined">logout</span>
            <span class="font-medium">Log Out</span>
        </a>
    </div>
</aside>