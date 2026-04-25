@props(['userImage' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBvzTLW7XVKdQDbl9Zial6-tbHxYohgUxvgOC8MGTGQD5zajxXQNGNTxEkNJS1kZ9BUTqXVUFNFsXVhtL6oFoUX50gyVmLPsan4zxGaihb9rgZ1fqqdtjBPZeiyvD4-U-CXoVxz0fNSayiAicw4B-EYdapiIqgETVjX9aiCeohQwBxoWd_ghUIgB-CdlbrZaf_XyIK6BZtSRkIqrlwD71p6Djt9gAh7J_IDKkUSn1tkI4CU0-_7pS4StIFhT6cR8vB4AIsxWxizVBs'])

<header
    class="fixed bg-slate-50/95 dark:bg-slate-950/90 border-b border-slate-200/40 dark:border-slate-800/40 backdrop-blur-xl flex justify-between items-center w-full px-6 py-3 max-w-full mx-auto z-50 sticky top-0">
    <div class="flex items-center space-x-4">
        <button id="sidebarToggleBtn" onclick="toggleStudentSidebar()" class="p-2 lg:hidden bg-white/90 dark:bg-slate-900/90 text-slate-700 dark:text-slate-200 shadow-sm hover:bg-slate-200/80 rounded-full transition-colors">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <a href="{{ url('/') }}" class="flex items-center gap-3">
            <img src="{{ asset('logoEnsam.png') }}" alt="ENSAM logo" class="w-30 h-11 object-contain" />
        </a>
        <div class="hidden md:flex items-center space-x-6 border-l pl-6 border-slate-200/20 dark:border-slate-800/20">
            {{-- <a
                class="text-slate-500 dark:text-slate-400 font-body font-semibold text-sm hover:bg-slate-100/50 dark:hover:bg-slate-800/50 transition-colors px-3 py-1 rounded-lg"
                href="#">Home</a> --}}
            {{-- <a
                class="text-primary dark:text-blue-100 font-bold border-b-2 border-primary font-body text-sm px-1 py-1"
                href="#">Requests</a> --}}
            {{-- <a
                class="text-slate-500 dark:text-slate-400 font-body font-semibold text-sm hover:bg-slate-100/50 dark:hover:bg-slate-800/50 transition-colors px-3 py-1 rounded-lg"
                href="#">Documentation</a> --}}
        </div>
    </div>
    
    <div class="flex items-center space-x-4">
        <!-- New Request Button -->
        {{-- <a href="{{ route('requests.create') }}" class="bg-white text-on-primary px-4 py-1.5 rounded-xl font-headline font-bold text-sm shadow-lg shadow-primary/20 hover:opacity-90 transition-all active:scale-95 flex items-center gap-2">
            <span class="material-symbols-outlined text-base">add</span>
            <span class="hidden sm:inline">New Request</span>
        </a> --}}

        <!-- Language switcher -->
        <div class="mr-2">
            <x-lang-switcher />
        </div>

        <!-- Notifications -->
        <button
            class="p-2 text-slate-500 hover:bg-slate-100/50 dark:hover:bg-slate-800/50 rounded-full transition-colors">
            {{-- <span class="material-symbols-outlined text-slate-600 dark:text-slate-400">notifications</span> --}}
        </button>

        <!-- Profile Dropdown -->
        <div class="relative group">
            <button
                class="w-8 h-8 rounded-full overflow-hidden ring-2 ring-gray-300 hover:ring-blue-500 transition-all">
                <img alt="User profile photo" class="w-full h-full object-cover" src="{{ $userImage }}" />
            </button>

            <div
                class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 py-2 z-50">

                <!-- Profile Header -->
                <div class="px-4 py-3 border-b border-gray-200">
                    <p class="text-sm font-bold text-gray-900">
                        {{ auth('student')->user()->first_name . " " . auth('student')->user()->last_name ?? 'Student' }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ auth()->user()->email ?? 'student@university.edu' }}
                    </p>
                </div>

                <!-- Menu Items -->
                <a href="{{ route('profile.show') }}"
                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 transition-colors text-sm">
                    <span class="material-symbols-outlined text-gray-500">account_circle</span>
                    View Profile
                </a>

                <div class="border-t border-gray-200 mt-2 pt-2">
                    <form method="POST" action="{{ route('logout.student') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 transition-colors text-sm">
                            <span class="material-symbols-outlined">logout</span>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>