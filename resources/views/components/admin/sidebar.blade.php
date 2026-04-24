@props(['active' => ''])

@php
    $admin = auth('admin')->user();
    $role = optional($admin)->role ?? 'admin';
@endphp

<!-- Mobile Overlay (only on mobile/tablet) -->
<div id="sidebarOverlay" class="hidden lg:hidden fixed inset-0 bg-black/50 z-30 transition-all duration-300"></div>

<!-- SideNavBar -->
<aside id="adminSidebar"
    class="fixed left-0 top-0 h-screen w-64 pt-16 sm:pt-20 bg-slate-100 dark:bg-slate-950 flex flex-col p-4 space-y-2 tonal-layering z-40 transition-all duration-300 ease-in-out
    -translate-x-full lg:translate-x-0 data-[collapsed=false]:lg:translate-x-0 data-[collapsed=true]:lg:-translate-x-full">
    <div class="mb-8 px-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-on-primary">
                <span class="material-symbols-outlined">account_balance</span>
            </div>
            <div>
                <h2 class="font-['Manrope'] font-black text-blue-950 dark:text-blue-50 text-sm">
                    {{ $role === 'super_admin' ? __('admin.super_admin_control') : __('admin.admin_control') }}</h2>
                <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">
                    {{ $role === 'super_admin' ? __('admin.institutional_authority') : __('admin.institutional_control') }}
                </p>
            </div>
        </div>
    </div>
    <nav class="grow space-y-1">
        <a href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'flex items-center gap-3 px-4 py-3 bg-white dark:bg-slate-900 text-blue-900 dark:text-white shadow-sm rounded-lg font-semibold ease-in-out duration-150' : 'flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:text-blue-800 dark:hover:text-blue-200 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 rounded-lg transition-all ease-in-out duration-150' }}"
            onclick="closeSidebarOnMobile()">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="font-medium">{{ __('admin.overview') }}</span>
        </a>
        <a href="{{ route('admin.requests.index') }}"
            class="{{ request()->routeIs('admin.requests.index') ? 'flex items-center gap-3 px-4 py-3 bg-white dark:bg-slate-900 text-blue-900 dark:text-white shadow-sm rounded-lg font-semibold ease-in-out duration-150' : 'flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:text-blue-800 dark:hover:text-blue-200 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 rounded-lg transition-all ease-in-out duration-150' }}"
            onclick="closeSidebarOnMobile()">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">pending_actions</span>
            <span class="font-medium">{{ __('admin.all_requests') }}</span>
        </a>
        <a href="{{ route('admin.students.index') }}"
            class="{{ request()->routeIs('admin.students.*') ? 'flex items-center gap-3 px-4 py-3 bg-white dark:bg-slate-900 text-blue-900 dark:text-white shadow-sm rounded-lg font-semibold ease-in-out duration-150' : 'flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:text-blue-800 dark:hover:text-blue-200 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 rounded-lg transition-all ease-in-out duration-150' }}"
            onclick="closeSidebarOnMobile()">
            <span class="material-symbols-outlined">group</span>
            <span class="font-medium">{{ __('admin.student_directory') }}</span>
        </a>
        @if($role === 'super_admin')
            <a href="{{ route('admin.manage.index') }}"
                class="{{ request()->routeIs('admin.manage.*') ? 'flex items-center gap-3 px-4 py-3 bg-white dark:bg-slate-900 text-blue-900 dark:text-white shadow-sm rounded-lg font-semibold ease-in-out duration-150' : 'flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:text-blue-800 dark:hover:text-blue-200 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 rounded-lg transition-all ease-in-out duration-150' }}"
                onclick="closeSidebarOnMobile()">
                <span class="material-symbols-outlined">manage_accounts</span>
                <span class="font-medium">{{ __('admin.manage_administrators') }}</span>
            </a>
        @endif
    </nav>
    <div class="border-t border-slate-200 dark:border-slate-800 pt-4 space-y-1">
        <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-4 py-3 text-error hover:bg-error/10 rounded-lg transition-all text-left">
                <span class="material-symbols-outlined">logout</span>
                <span class="font-medium">{{ __('admin.logout') }}</span>
            </button>
        </form>
    </div>
</aside>

<script>
    let sidebarCollapsed = false;

    function toggleSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const main = document.querySelector('main');
        const isDesktop = window.innerWidth >= 1024;

        if (isDesktop) {
            // Desktop: Collapse/Expand sidebar
            sidebarCollapsed = !sidebarCollapsed;
            localStorage.setItem('sidebarCollapsed', sidebarCollapsed);
            
            if (sidebarCollapsed) {
                sidebar.classList.add('-translate-x-full');
                if (main) main.classList.add('sidebar-collapsed');
            } else {
                sidebar.classList.remove('-translate-x-full');
                if (main) main.classList.remove('sidebar-collapsed');
            }
        } else {
            // Mobile/Tablet: Show/Hide overlay
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    }

    function closeSidebarOnMobile() {
        if (window.innerWidth < 1024) {
            document.getElementById('adminSidebar').classList.add('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.add('hidden');
        }
    }

    // Initialize sidebar state from localStorage
    document.addEventListener('DOMContentLoaded', function() {
        const savedState = localStorage.getItem('sidebarCollapsed');
        if (savedState === 'true' && window.innerWidth >= 1024) {
            sidebarCollapsed = true;
            const sidebar = document.getElementById('adminSidebar');
            const main = document.querySelector('main');
            sidebar.classList.add('-translate-x-full');
            if (main) main.classList.add('sidebar-collapsed');
        }
    });

    // Reset sidebar on window resize
    window.addEventListener('resize', function() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const main = document.querySelector('main');
        
        if (window.innerWidth >= 1024) {
            // Desktop: Show overlay is hidden
            overlay.classList.add('hidden');
            
            // Restore collapsed state if it was saved
            if (sidebarCollapsed) {
                sidebar.classList.add('-translate-x-full');
                if (main) main.classList.add('sidebar-collapsed');
            } else {
                sidebar.classList.remove('-translate-x-full');
                if (main) main.classList.remove('sidebar-collapsed');
            }
        } else {
            // Mobile/Tablet: Reset sidebar position
            sidebar.classList.add('-translate-x-full');
            if (main) main.classList.remove('sidebar-collapsed');
        }
    });

    // Close sidebar when clicking overlay
    document.getElementById('sidebarOverlay')?.addEventListener('click', toggleSidebar);
</script>