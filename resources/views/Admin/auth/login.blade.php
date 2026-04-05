<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Admin Login | The Academic Curator</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-container-highest": "#e0e3e5",
                        "on-secondary-container": "#5b6577",
                        "surface-container-low": "#f1f4f6",
                        "tertiary-fixed": "#ffddba",
                        "background": "#f7fafc",
                        "secondary-fixed": "#d9e3f8",
                        "on-primary-fixed": "#001b3c",
                        "secondary": "#555f70",
                        "tertiary-container": "#4f2e00",
                        "surface-tint": "#455f88",
                        "inverse-primary": "#adc7f7",
                        "on-surface-variant": "#43474e",
                        "on-tertiary-container": "#c6955e",
                        "tertiary-fixed-dim": "#f2bc82",
                        "on-primary": "#ffffff",
                        "surface-bright": "#f7fafc",
                        "on-secondary": "#ffffff",
                        "surface": "#f7fafc",
                        "outline": "#74777f",
                        "on-error": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-primary-fixed-variant": "#2d476f",
                        "surface-container-lowest": "#ffffff",
                        "tertiary": "#321b00",
                        "on-tertiary": "#ffffff",
                        "surface-variant": "#e0e3e5",
                        "error": "#ba1a1a",
                        "surface-container": "#ebeef0",
                        "primary-container": "#1a365d",
                        "on-tertiary-fixed-variant": "#633f0f",
                        "surface-tint": "#455f88",
                        "outline-variant": "#c4c6cf",
                        "secondary-fixed-dim": "#bdc7db",
                        "inverse-surface": "#2d3133",
                        "on-error-container": "#93000a",
                        "surface-container-high": "#e5e9eb",
                        "secondary-container": "#d9e3f8",
                        "primary": "#002045",
                        "on-secondary-fixed-variant": "#3e4758",
                        "on-primary-container": "#86a0cd",
                        "on-tertiary-fixed": "#2b1700",
                        "on-background": "#181c1e",
                        "primary-fixed-dim": "#adc7f7",
                        "on-surface": "#181c1e",
                        "inverse-on-surface": "#eef1f3",
                        "on-secondary-fixed": "#121c2b"
                    },
                    fontFamily: {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .editorial-gradient {
            background: linear-gradient(135deg, #002045 0%, #1a365d 100%);
        }

        .pattern-bg {
            background-color: #f7fafc;
            background-image: radial-gradient(#d6e3ff 0.5px, transparent 0.5px), radial-gradient(#d6e3ff 0.5px, #f7fafc 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
    </style>
</head>

<body class="bg-[#f4f7fb] font-body text-slate-900 selection:bg-[#0f2755] selection:text-white">
    <main class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-6xl rounded-[32px] overflow-hidden shadow-[0_28px_70px_rgba(15,23,42,0.12)]">
            <div class="grid grid-cols-1 md:grid-cols-2 bg-white">
                <!-- Left Branding Panel -->
                <div class="hidden md:flex flex-col justify-between bg-[#0f2755] p-16 text-white relative overflow-hidden">
                    <div>
                        <div class="flex items-center gap-3 mb-10">
                            <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-2xl">school</span>
                            </div>
                            <span class="font-headline font-bold text-lg">The Academic Curator</span>
                        </div>
                        <h1 class="font-headline text-[2.95rem] leading-tight font-extrabold mb-6">Institutional<br />Control Center</h1>
                        <p class="max-w-md text-slate-200/85 text-lg leading-8">Access the administrative core to manage faculty research, student curricula, and global academic outreach.</p>
                    </div>
                    <div class="flex items-center gap-4 bg-white/10 border border-white/10 rounded-[24px] p-4 shadow-[0_16px_35px_rgba(15,23,42,0.18)] max-w-xs">
                        <img class="w-12 h-12 rounded-full object-cover border border-white/20" src="https://lh3.googleusercontent.com/aida-public/AB6AXuChAjZULxxhGEUuwHJxwAc8JLZ9bbOg-pUQgKTvgFjI3p_QNo1YMMKzxZSSGB7jKzeHs9xOYpZF0VvOkqewMyrSd5wwC6jrBav7dILjXfJjDDw5520DJeCvP6BPyD3m2vb0eAg0VsXyJowtwdQzunqtcTgjNL0zymy5HCkrp68kJV5uv5Vr75cAXNObOSOj5nXQsawSMmFMJbQtRQoAThkne9Vb4Pzg31UxVtED1BNmf-wdwdRUxlISk9nbZXQIHg11Tm804DZ1OpQ" alt="Lead Administrator avatar" />
                        <div>
                            <p class="font-semibold text-white">Dr. Elias Thorne</p>
                            <p class="text-sm text-slate-200/70">Head of Global Research</p>
                        </div>
                    </div>
                    <div class="absolute -right-24 bottom-[-5rem] w-72 h-72 rounded-full bg-white/10 blur-3xl"></div>
                </div>

                <!-- Login Form Panel -->
                <div class="bg-white p-8 md:p-14 flex flex-col justify-center">
                    <div class="max-w-xl">
                        <div class="mb-10">
                            <div class="md:hidden flex items-center gap-3 mb-8">
                                <span class="material-symbols-outlined text-[#0f2755] text-3xl">school</span>
                                <span class="font-headline font-bold text-xl text-[#0f2755]">The Academic Curator</span>
                            </div>
                            <span class="inline-flex items-center justify-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.26em] text-slate-500 mb-4">Admin Portal</span>
                            <h2 class="font-headline text-4xl font-extrabold text-slate-950 mb-3">Welcome Back</h2>
                            <p class="text-slate-600 text-base">Please enter your institutional credentials.</p>
                        </div>
                        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-6">
                            @csrf
                            @if ($errors->any())
                                <div class="rounded-3xl border border-rose-200/60 bg-rose-50/90 p-4 text-rose-700">
                                    <div class="flex items-start gap-3">
                                        <span class="material-symbols-outlined text-rose-700 text-xl">error</span>
                                        <p class="text-sm leading-relaxed">{{ $errors->first() }}</p>
                                    </div>
                                </div>
                            @endif
                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">University Email</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">alternate_email</span>
                                    <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="admin.name@university.edu" class="w-full rounded-2xl border border-slate-200 bg-slate-100 px-4 pl-12 py-4 text-slate-900 placeholder:text-slate-400 focus:border-[#0f2755] focus:outline-none focus:ring-2 focus:ring-[#0f2755]/10" />
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label for="password" class="text-sm font-semibold text-slate-700">Password</label>
                                    <a href="#" class="text-sm font-semibold text-[#0f2755] hover:underline">Forgot Password?</a>
                                </div>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">lock</span>
                                    <input id="password" name="password" type="password" placeholder="••••••••" class="w-full rounded-2xl border border-slate-200 bg-slate-100 px-4 pl-12 py-4 text-slate-900 placeholder:text-slate-400 focus:border-[#0f2755] focus:outline-none focus:ring-2 focus:ring-[#0f2755]/10" />
                                    <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#0f2755]">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }} class="h-5 w-5 rounded border-slate-300 text-[#0f2755] focus:ring-[#0f2755]" />
                                <label for="remember" class="text-sm text-slate-600 font-medium">Stay logged in for 24 hours</label>
                            </div>
                            <button type="submit" class="w-full rounded-2xl bg-[#0f2755] px-6 py-4 text-white text-base font-semibold shadow-[0_16px_30px_rgba(15,23,42,0.18)] hover:bg-[#0b1f46] transition-colors duration-200 flex items-center justify-center gap-2">
                                Admin Sign In
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </button>
                        </form>
                        <div class="mt-12 border-t border-slate-200 pt-8">
                            <p class="text-center text-sm leading-6 text-slate-500">This system is for authorized personnel only. All access and activity is logged and monitored. Unauthorized access attempts will be prosecuted to the full extent of the law.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>