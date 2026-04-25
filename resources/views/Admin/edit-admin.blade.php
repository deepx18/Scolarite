@extends('layouts.admin')

@section('content')
    <x-admin.sidebar active="manage-admins" />
    <x-admin.navbar />

    <div class="ml-72 min-h-screen bg-background">

        <main class="pt-24 px-8 pb-10">
            <div class="max-w-3xl">
                <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                    @if(session('success') || session('error'))
                        <div class="rounded-3xl border p-4 mb-4 text-sm font-medium">
                            @if(session('success'))
                                <div class="text-emerald-700 bg-emerald-100 border border-emerald-200 rounded-2xl px-4 py-3">{{ session('success') }}</div>
                            @else
                                <div class="text-rose-700 bg-rose-100 border border-rose-200 rounded-2xl px-4 py-3">{{ session('error') }}</div>
                            @endif
                        </div>
                    @endif
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.35em] text-slate-500 font-semibold">{{ __('admin.edit_administrator') }}</p>
                            <h1 class="mt-2 text-3xl font-black text-slate-950 font-headline">{{ $admin->name }}</h1>
                        </div>
                        <a href="{{ route('admin.manage.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-200">{{ __('admin.back_to_list') }}</a>
                    </div>

                    <form action="{{ route('admin.manage.update', $admin) }}" method="POST" class="mt-8 space-y-6">
                        @csrf
                        @method('PUT')

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">{{ __('admin.admin_name_label') }}</span>
                            <input type="text" name="name" value="{{ old('name', $admin->name) }}" required class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">{{ __('admin.admin_email_label') }}</span>
                            <input type="email" name="email" value="{{ old('email', $admin->email) }}" required class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">{{ __('admin.admin_department_label') }}</span>
                            <input type="text" name="department" value="{{ old('department', $admin->department) }}" required class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">{{ __('admin.admin_password_label') }}</span>
                            <input type="password" name="password" placeholder="{{ __('admin.leave_password_placeholder') }}" class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        </label>

                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-br from-[#002045] to-[#1a365d] px-6 py-3 text-sm font-bold text-white shadow-lg shadow-slate-900/10 transition hover:shadow-xl">{{ __('admin.save_changes') }}</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection
