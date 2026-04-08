@extends('layouts.admin')

@section('content')
    <x-admin.sidebar-SuperA active="manage-admins" />
    <x-admin.navbar-SuperA />

    <div class="ml-72 min-h-screen bg-background">

        <main class="pt-24 px-8 pb-10">
            <div class="space-y-6">
                <div>
                    <div class="flex items-center gap-2 text-sm text-slate-500 mb-3">
                        <span class="font-semibold uppercase tracking-widest">ADMIN</span>
                        <span class="material-symbols-outlined text-base">chevron_right</span>
                        <span class="font-semibold text-primary uppercase tracking-widest">MANAGE ADMINISTRATORS</span>
                    </div>
                    <h1 class="text-4xl font-black text-slate-950 font-headline mb-2">Manage Administrators</h1>
                    <p class="text-slate-600">Govern campus operations and system access with intuitive administrator account management and role delegation.</p>
                </div>

                <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                    <x-admin.stats-card label="Total Admins" value="{{ $totalAdmins ?? 0 }}" icon="admin_panel_settings" meta="Roster overview" />
                    <x-admin.stats-card label="Active Sessions" value="{{ $activeSessions ?? 0 }}" icon="lan" meta="System currently active" />
                    <x-admin.stats-card label="Security Alerts" value="{{ $securityAlerts ?? 0 }}" icon="gpp_maybe" meta="Last inspection now" />
                </div>
            </div>

                @if(session('success'))
                    <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-900">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="rounded-3xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-900">
                        {{ session('error') }}
                    </div>
                @endif

                <section class="mt-8 rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-200">
                        <h2 class="text-xl font-bold text-slate-900 font-headline">Administrator Directory</h2>
                        <p class="mt-2 text-sm text-slate-500">Browse and manage institutional administrator accounts.</p>
                    </div>

                    <div class="px-8 py-6 border-b border-slate-200 lg:flex lg:items-center lg:justify-between lg:gap-4">
                        <form action="{{ route('admin.manage.index') }}" method="GET" class="flex w-full lg:max-w-lg">
                            <div class="relative w-full">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                                <input type="search" name="search" value="{{ old('search', $search ?? '') }}" placeholder="Filter admins by name, email, or department..." class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-12 py-4 text-sm text-slate-700 shadow-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/10" />
                            </div>
                        </form>
                        <button type="button" onclick="document.getElementById('addAdminModal').classList.remove('hidden')" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-br from-[#002045] to-[#1a365d] px-6 py-4 text-white font-semibold shadow-lg shadow-slate-900/10 transition duration-200 hover:shadow-xl active:scale-[0.98]">
                            <span class="material-symbols-outlined">add</span>
                             Add New Admin
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <x-admin.table class="min-w-full">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-8 py-4 text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Administrator Name</th>
                                    <th class="px-8 py-4 text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Email Address</th>
                                    <th class="px-8 py-4 text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Date Added</th>
                                    <th class="px-8 py-4 text-center text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Actions</th>
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
                                                    <p class="text-sm text-slate-500">{{ $admin->department ?? 'Administration' }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-8 py-5 text-sm text-slate-700">{{ $admin->email }}</td>

                                        <td class="px-8 py-5 text-sm text-slate-600">{{ optional($admin->created_at)->format('M d, Y') }}</td>

                                        <td class="px-8 py-5 text-center">
                                            <div class="inline-flex items-center justify-center gap-2">
                                                <a href="{{ route('admin.manage.show', $admin) }}" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-600 transition hover:bg-slate-200 hover:text-[#002045]" title="View">
                                                    <span class="material-symbols-outlined text-base">visibility</span>
                                                </a>
                                                <a href="{{ route('admin.manage.edit', $admin) }}" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-600 transition hover:bg-slate-200 hover:text-[#002045]" title="Edit">
                                                    <span class="material-symbols-outlined text-base">edit</span>
                                                </a>
                                                @if($admin->role !== 'super_admin')
                                                    <form action="{{ route('admin.manage.destroy', $admin) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-[#ef4444] transition hover:bg-red-50" title="Delete" onclick="return confirm('Delete this administrator?');">
                                                            <span class="material-symbols-outlined text-base">delete</span>
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-300 cursor-not-allowed" title="Protected">
                                                        <span class="material-symbols-outlined text-base">delete</span>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-8 py-12 text-center text-sm text-slate-500">No administrators available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </x-admin.table>
                    </div>

                    <div class="px-8 py-5 bg-slate-50 flex items-center justify-between border-t border-slate-200">
                        <p class="text-xs text-slate-600 font-medium">Showing {{ $admins->firstItem() ?? 0 }} of {{ $admins->total() ?? 0 }} entries</p>
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
                    <h2 class="text-2xl font-black text-slate-950 font-headline">Add New Administrator</h2>
                    <p class="mt-2 text-sm text-slate-500">Create a secure admin account for campus operations.</p>
                </div>
                <button type="button" onclick="document.getElementById('addAdminModal').classList.add('hidden')" class="text-slate-500 hover:text-slate-900">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <form action="{{ route('admin.manage.store') }}" method="POST" class="space-y-6 px-8 py-8">
                @csrf
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">Name</span>
                        <input type="text" name="name" required class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="Full name" value="{{ old('name') }}" />
                    </label>

                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">Email</span>
                        <input type="email" name="email" required class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="name@institution.edu" value="{{ old('email') }}" />
                    </label>

                    <label class="block md:col-span-2">
                        <span class="text-sm font-semibold text-slate-700">Department</span>
                        <input type="text" name="department" required class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="Academic Affairs" value="{{ old('department') }}" />
                    </label>

                    <label class="block md:col-span-2">
                        <span class="text-sm font-semibold text-slate-700">Password</span>
                        <input type="password" name="password" required class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="Create a secure password" />
                    </label>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <button type="button" onclick="document.getElementById('addAdminModal').classList.add('hidden')" class="w-full rounded-2xl border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 sm:w-auto">Cancel</button>
                    <button type="submit" class="w-full rounded-2xl bg-gradient-to-br from-[#002045] to-[#1a365d] px-6 py-3 text-sm font-bold text-white shadow-lg shadow-slate-900/10 transition hover:shadow-xl sm:w-auto">Create Administrator</button>
                </div>
            </form>
        </div>
    </div>
@endsection
