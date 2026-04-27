<x-admin.layout>
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="lg:ml-64 pt-20 sm:pt-24 px-4 sm:px-8 pb-12">
        <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-200">
            <div class="flex flex-col lg:flex-row justify-between gap-6">
                <div class="flex items-center gap-4">
                    <img alt="Administrator avatar" class="w-20 h-20 rounded-full object-cover ring-2 ring-primary-fixed"
                        src="https://ui-avatars.com/api/?name={{ urlencode($admin->name ?? 'Admin') }}&background=002045&color=ffffff&size=256" />
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-slate-500">{{ __('admin.profile') }}</p>
                        <h1 class="text-3xl font-bold text-blue-950">{{ $admin->name ?? __('admin.profile') }}</h1>
                        <p class="text-sm text-slate-500 mt-2">{{ ($admin->role ?? 'admin') === 'super_admin' ? __('admin.super_admin_control') : __('admin.admin_control') }}</p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 items-center">
                    <a href="{{ route('admin.dashboard') }}"
                        class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">{{ __('admin.dashboard') }}</a>
                    <a href="{{ route('admin.students.index') }}"
                        class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">{{ __('admin.manage_students') }}</a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
                        @csrf
                        <button type="submit"
                            class="rounded-2xl bg-rose-600 px-5 py-3 text-sm font-semibold text-white hover:bg-rose-700 transition">{{ __('admin.logout') }}</button>
                    </form>
                </div>
            </div>

            <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="rounded-3xl bg-slate-50 p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">{{ __('admin.account_details') }}</h2>
                    <div class="space-y-4 text-sm text-slate-700">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ __('admin.name') }}</p>
                            <p class="font-semibold">{{ $admin->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ __('admin.email') }}</p>
                            <p class="font-semibold">{{ $admin->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ __('admin.role') }}</p>
                            <p class="font-semibold">{{ ucfirst(str_replace('_', ' ', $admin->role ?? 'admin')) }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ __('admin.department') }}</p>
                            <p class="font-semibold">{{ $admin->department ?? __('admin.not_specified') }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl bg-slate-50 p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">{{ __('admin.quick_actions') }}</h2>
                    <div class="grid gap-3">
                        <a href="{{ route('admin.requests.index') }}"
                            class="rounded-2xl bg-white border border-slate-200 px-5 py-4 text-sm font-semibold text-slate-800 hover:bg-slate-100 transition">{{ __('admin.view_requests') }}</a>
                        <a href="{{ route('admin.students.index') }}"
                            class="rounded-2xl bg-white border border-slate-200 px-5 py-4 text-sm font-semibold text-slate-800 hover:bg-slate-100 transition">{{ __('admin.open_student_directory') }}</a>
                        <a href="{{ route('admin.dashboard') }}"
                            class="rounded-2xl bg-white border border-slate-200 px-5 py-4 text-sm font-semibold text-slate-800 hover:bg-slate-100 transition">{{ __('admin.admin_dashboard') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-admin.layout>