<!-- Top Navigation Bar -->
<header class="bg-white/85 dark:bg-slate-950/85 backdrop-blur-xl flex justify-between items-center w-full px-6 py-3 max-w-full mx-auto z-50 sticky top-0">
    <div class="flex items-center space-x-6">
        <h1 class="text-xl font-bold text-blue-900 dark:text-blue-100 font-manrope tracking-tight">{{ config('app.name', 'Scholarly Portal') }}</h1>
        <div class="hidden md:flex items-center space-x-6 border-l pl-6 border-slate-200/20 dark:border-slate-800/20">
            <a class="text-slate-500 dark:text-slate-400 font-manrope font-semibold text-sm hover:bg-slate-100/50 dark:hover:bg-slate-800/50 transition-colors px-3 py-1 rounded-lg {{ request()->routeIs('dashboard') ? 'text-blue-900 dark:text-blue-100 border-b-2 border-blue-900' : '' }}" href="#">Home</a>
            <a class="text-slate-500 dark:text-slate-400 font-manrope font-semibold text-sm hover:bg-slate-100/50 dark:hover:bg-slate-800/50 transition-colors px-3 py-1 rounded-lg {{ request()->routeIs('requests.*') ? 'text-blue-900 dark:text-blue-100 border-b-2 border-blue-900' : '' }}" href="{{ route('requests.index') }}">Requests</a>
            <a class="text-slate-500 dark:text-slate-400 font-manrope font-semibold text-sm hover:bg-slate-100/50 dark:hover:bg-slate-800/50 transition-colors px-3 py-1 rounded-lg" href="#">Documentation</a>
        </div>
    </div>
    <div class="flex items-center space-x-4">
        <button class="p-2 text-slate-500 hover:bg-slate-100/50 rounded-full transition-colors">
            <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
        </button>
        <div class="w-8 h-8 rounded-full bg-slate-200 overflow-hidden">
            <img alt="User profile" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBvzTLW7XVKdQDbl9Zial6-tbHxYohgUxvgOC8MGTGQD5zajxXQNGNTxEkNJS1kZ9BUTqXVUFNFsXVhtL6oFoUX50gyVmLPsan4zxGaihb9rgZ1fqqdtjBPZeiyvD4-U-CXoVxz0fNSayiAicw4B-EYdapiIqgETVjX9aiCeohQwBxoWd_ghUIgB-CdlbrZaf_XyIK6BZtSRkIqrlwD71p6Djt9gAh7J_IDKkUSn1tkI4CU0-_7pS4StIFhT6cR8vB4AIsxWxizVBs"/>
        </div>
    </div>
</header>
