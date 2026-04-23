@extends('layouts.admin')

@section('content')
    <x-admin.sidebar active="manage-admins" />
    <x-admin.navbar />

    <div class="ml-72 min-h-screen bg-background">

        <main class="pt-24 px-8 pb-10">
            <div class="max-w-4xl space-y-6">
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
                            <p class="text-xs uppercase tracking-[0.35em] text-slate-500 font-semibold">{{ __('admin.administrator_profile') }}</p>
                            <h1 class="mt-2 text-3xl font-black text-slate-950 font-headline">{{ $admin->name }}</h1>
                        </div>
                        <a href="{{ route('admin.manage.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-200">{{ __('admin.back_to_list') }}</a>
                    </div>

                    <div class="mt-8 grid gap-6 lg:grid-cols-2">
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                            <p class="text-xs uppercase tracking-[0.25em] text-slate-500 font-semibold">{{ __('admin.email') }}</p>
                            <p class="mt-3 text-sm text-slate-900">{{ $admin->email }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                            <p class="text-xs uppercase tracking-[0.25em] text-slate-500 font-semibold">{{ __('admin.department') }}</p>
                            <p class="mt-3 text-sm text-slate-900">{{ $admin->department ?? __('admin.administration') }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                            <p class="text-xs uppercase tracking-[0.25em] text-slate-500 font-semibold">{{ __('admin.role') }}</p>
                            <p class="mt-3 text-sm text-slate-900 capitalize">{{ str_replace('_', ' ', $admin->role) }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                            <p class="text-xs uppercase tracking-[0.25em] text-slate-500 font-semibold">{{ __('admin.created') }}</p>
                            <p class="mt-3 text-sm text-slate-900">{{ optional($admin->created_at)->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
