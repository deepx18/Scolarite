@extends('layouts.admin')

@section('content')
    <x-admin.sidebar active="manage-admins" />
    <x-admin.navbar />

    <div class="ml-72 min-h-screen bg-background">

        <main class="pt-24 px-8 pb-10">
            <div class="max-w-3xl">
                <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.35em] text-slate-500 font-semibold">Edit Administrator</p>
                            <h1 class="mt-2 text-3xl font-black text-slate-950 font-headline">{{ $admin->name }}</h1>
                        </div>
                        <a href="{{ route('admin.manage.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-200">Cancel</a>
                    </div>

                    <form action="{{ route('admin.manage.update', $admin) }}" method="POST" class="mt-8 space-y-6">
                        @csrf
                        @method('PUT')

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Name</span>
                            <input type="text" name="name" value="{{ old('name', $admin->name) }}" required class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Email</span>
                            <input type="email" name="email" value="{{ old('email', $admin->email) }}" required class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Department</span>
                            <input type="text" name="department" value="{{ old('department', $admin->department) }}" required class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Password</span>
                            <input type="password" name="password" placeholder="Leave blank to keep current password" class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        </label>

                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-br from-[#002045] to-[#1a365d] px-6 py-3 text-sm font-bold text-white shadow-lg shadow-slate-900/10 transition hover:shadow-xl">Save Changes</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection
