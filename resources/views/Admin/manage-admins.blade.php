@extends('layouts.admin')

@section('content')
    <x-admin.sidebar active="manage-admins" />
    <x-admin.navbar />

    <div class="lg:ml-72 min-h-screen bg-background">

        <main class="pt-20 sm:pt-24 px-4 sm:px-8 pb-10">
            <div class="space-y-6">
                <div>
                    <div class="flex items-center gap-2 text-sm text-slate-500 mb-3">
                        <span class="font-semibold uppercase tracking-widest">{{ __('admin.breadcrumb.admin') }}</span>
                        <span class="material-symbols-outlined text-base">chevron_right</span>
                        <span class="font-semibold text-primary uppercase tracking-widest">{{ __('admin.manage_administrators') }}</span>
                    </div>
                    <h1 class="text-4xl font-black text-slate-950 font-headline mb-2">{{ __('admin.manage_administrators') }}</h1>
                    <p class="text-slate-600">{{ __('admin.manage_admins_description') }}</p>
                </div>

                <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                    <x-admin.stats-card label="{{ __('admin.total_admins') }}" value="{{ $totalAdmins ?? 0 }}" icon="admin_panel_settings" meta="{{ __('admin.stats_roster_overview') }}" />
                    <x-admin.stats-card label="{{ __('admin.admins_added_today') }}" value="{{ $adminsAddedToday ?? 0 }}" icon="today" meta="{{ __('admin.stats_today') }}" />
                    <x-admin.stats-card label="{{ __('admin.admins_added_this_week') }}" value="{{ $adminsAddedThisWeek ?? 0 }}" icon="calendar_view_week" meta="{{ __('admin.stats_last_7_days') }}" />
                </div>
            </div>

                @if(session('success'))
                    <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-900 mt-5">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="rounded-3xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-900">
                        {{ session('error') }}
                    </div>
                @endif

                <section class="mt-8 rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                    <div class="px-4 sm:px-8 py-6 border-b border-slate-200">
                        <h2 class="text-lg sm:text-xl font-bold text-slate-900 font-headline">{{ __('admin.administrator_directory') }}</h2>
                        <p class="mt-2 text-xs sm:text-sm text-slate-500">{{ __('admin.administrator_directory_description') }}</p>
                    </div>

                    <div class="px-4 sm:px-8 py-6 border-b border-slate-200 lg:flex lg:items-center lg:justify-between lg:gap-4">
                        <form action="{{ route('admin.manage.index') }}" method="GET" class="flex w-full mb-4 lg:mb-0 lg:max-w-lg">
                            <div class="relative w-full">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                                <input type="search" name="search" value="{{ old('search', $search ?? '') }}" placeholder="{{ __('admin.filter_admins_placeholder') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-12 py-4 text-sm text-slate-700 shadow-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/10" />
                            </div>
                        </form>
                        <button type="button" onclick="document.getElementById('addAdminModal').classList.remove('hidden')" class="inline-flex items-center justify-center gap-3 rounded-full bg-[#05203a] px-4 py-2 text-white font-medium shadow-sm transition duration-150 hover:opacity-95">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#0b2a45] text-white">
                                <span class="material-symbols-outlined text-sm">add</span>
                            </span>
                            <span class="text-sm">{{ __('admin.add_new_admin') }}</span>
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <x-admin.table class="min-w-full">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-8 py-4 text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">{{ __('admin.administrator_name') }}</th>
                                    <th class="px-8 py-4 text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">{{ __('admin.email_address') }}</th>
                                    <th class="px-8 py-4 text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">{{ __('admin.date_added') }}</th>
                                    <th class="px-8 py-4 text-center text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">{{ __('admin.table.actions') }}</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @forelse($admins as $admin)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center gap-4">
                                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-[#002045] text-white font-bold">
                                                    {{ strtoupper(substr($admin->name, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <p class="text-sm font-semibold text-slate-900">{{ $admin->name }}</p>
                                                    <p class="text-sm text-slate-500">{{ $admin->department ?? __('admin.administration') }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-8 py-5 text-sm text-slate-700">{{ $admin->email }}</td>

                                        <td class="px-8 py-5 text-sm text-slate-600">{{ optional($admin->created_at)->format('M d, Y') }}</td>

                                        <td class="px-8 py-5 text-center">
                                            <div class="inline-flex items-center justify-center gap-2">
                                                <a href="{{ route('admin.manage.show', $admin) }}" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-600 transition hover:bg-slate-200 hover:text-[#002045]" title="{{ __('admin.actions.view') }}">
                                                    <span class="material-symbols-outlined text-base">visibility</span>
                                                </a>
                                                <a href="{{ route('admin.manage.edit', $admin) }}" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-600 transition hover:bg-slate-200 hover:text-[#002045]" title="{{ __('admin.actions.edit') }}">
                                                    <span class="material-symbols-outlined text-base">edit</span>
                                                </a>
                                                @if($admin->role !== 'super_admin')
                                                    <form action="{{ route('admin.manage.destroy', $admin) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-[#ef4444] transition hover:bg-red-50" title="{{ __('admin.actions.delete') }}" onclick="return confirm('{{ __('admin.modals.delete_confirm') }}');">
                                                            <span class="material-symbols-outlined text-base">delete</span>
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-300 cursor-not-allowed" title="{{ __('admin.protected') }}">
                                                        <span class="material-symbols-outlined text-base">delete</span>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                            <td colspan="5" class="px-8 py-12 text-center text-sm text-slate-500">{{ __('admin.no_administrators') }}</td>
                                        </tr>
                                @endforelse
                            </tbody>
                        </x-admin.table>
                    </div>

                    <div class="px-8 py-5 bg-slate-50 flex items-center justify-between border-t border-slate-200">
                        <p class="text-xs text-slate-600 font-medium">{{ __('admin.showing_entries', ['from' => $admins->firstItem() ?? 0, 'total' => $admins->total() ?? 0]) }}</p>
                        {{ $admins->links() }}
                    </div>
                </section>
            </div>
        </main>
    </div>

    <div id="addAdminModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-950/70 p-4">
        <div class="w-full max-w-2xl overflow-hidden rounded-[2rem] bg-white shadow-2xl ring-1 ring-slate-200">
            <div class="flex items-start justify-between gap-4 border-b border-slate-200 px-8 py-6">
                <div>
                    <h2 class="text-2xl font-black text-slate-950 font-headline">{{ __('admin.add_administrator') }}</h2>
                    <p class="mt-2 text-sm text-slate-500">{{ __('admin.add_administrator_description') }}</p>
                </div>
                <button type="button" onclick="document.getElementById('addAdminModal').classList.add('hidden')" class="text-slate-500 hover:text-slate-900">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <form action="{{ route('admin.manage.store') }}" method="POST" class="space-y-6 px-8 py-8">
                @csrf
                @if($errors->any())
                    <div class="rounded-md border border-rose-200 bg-rose-50 p-4 text-sm text-rose-900">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">{{ __('admin.admin_name_label') }}</span>
                        <input type="text" name="name" required class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="{{ __('admin.placeholder_full_name') }}" value="{{ old('name') }}" />
                    </label>

                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">{{ __('admin.admin_email_label') }}</span>
                        <input type="email" name="email" required class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="{{ __('admin.placeholder_email') }}" value="{{ old('email') }}" />
                    </label>

                    <label class="block md:col-span-2">
                        <span class="text-sm font-semibold text-slate-700">{{ __('admin.admin_department_label') }}</span>
                        <input type="text" name="department" required class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="{{ __('admin.placeholder_department') }}" value="{{ old('department') }}" />
                    </label>

                    <label class="block md:col-span-2">
                        <span class="text-sm font-semibold text-slate-700">{{ __('admin.admin_password_label') }}</span>
                        <input type="password" name="password" required class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="{{ __('admin.placeholder_password') }}" />
                    </label>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <button type="button" onclick="document.getElementById('addAdminModal').classList.add('hidden')" class="w-full rounded-2xl border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 sm:w-auto">{{ __('admin.cancel') }}</button>
                    <button type="submit" class="w-full rounded-2xl bg-gradient-to-br from-[#002045] to-[#1a365d] px-6 py-3 text-sm font-bold text-white shadow-lg shadow-slate-900/10 transition hover:shadow-xl sm:w-auto">{{ __('admin.create_administrator') }}</button>
                </div>
            </form>
        </div>
    </div>

    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var modal = document.getElementById('addAdminModal');
                if (modal) modal.classList.remove('hidden');
            });
        </script>
    @endif
@endsection
