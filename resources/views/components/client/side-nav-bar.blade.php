@props(['activeRoute' => 'requests'])

<aside class="h-screen w-64 fixed left-0 top-0 z-40 bg-slate-100 dark:bg-slate-950 flex flex-col p-4 gap-2 hidden lg:flex pt-20">
    {{-- <div class="mb-8 px-4">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">school</span>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-blue-900 dark:text-blue-50 leading-tight">Student Portal</h2>
                <p class="text-[10px] uppercase tracking-widest text-slate-500 font-bold">Academic Services</p>
            </div>
        </div>
    </div> --}}
    <nav class="flex-1 space-y-1">
        <a class="{{ $activeRoute === 'requests' ? 'bg-white dark:bg-slate-900 text-blue-900 dark:text-blue-400 shadow-sm' : 'text-slate-600 dark:text-slate-400 hover:translate-x-1' }} rounded-xl py-3 px-4 flex items-center gap-3 transition-transform font-label text-sm font-semibold" href="#">
            <span class="material-symbols-outlined">description</span> My Requests
        </a>
        <a class="text-slate-600 dark:text-slate-400 py-3 px-4 flex items-center gap-3 hover:translate-x-1 transition-transform font-label text-sm font-semibold" href="#">
            <span class="material-symbols-outlined">folder_shared</span> Documents
        </a>
    </nav>
    <div class="mt-auto pt-4 border-t border-slate-200 dark:border-slate-800 space-y-1">
        <a href="{{ route('requests.create') }}">
            <button class="w-full bg-blue-500 text-white py-3 px-4 rounded-xl font-bold text-sm shadow-lg shadow-blue-900/20 active:scale-95 transition-all mb-4">
                New Request
            </button>
        </a>

       <form action="{{ route('students.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-red-500 text-white py-3 px-4 rounded-xl font-bold text-sm shadow-lg shadow-red-900/20 active:scale-95 transition-all">
                Logout
            </button>
        </form>
    </div>
</aside>
