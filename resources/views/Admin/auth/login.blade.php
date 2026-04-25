<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Admin Login | The Academic Curator</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
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

<body class="pattern-bg min-h-screen flex items-center justify-center overflow-x-hidden">
    <main class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-6xl rounded-[32px] overflow-hidden shadow-[0_28px_70px_rgba(15,23,42,0.12)] bg-white">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <!-- Left Branding Panel -->
                <div
                    class="hidden md:flex flex-col justify-center items-center editorial-gradient p-20 pt-12 text-white relative overflow-hidden">
                    <div class="w-60 h-60 flex items-center justify-center rounded-2xl bg-white/6 p-6"
                        style="backdrop-filter: blur(6px);">
                        <div class="bg-white rounded-lg p-3 shadow-md flex items-center justify-center">
                            <img src="{{ asset('logoEnsam.png') }}" alt="ENSAM logo"
                                class="w-50 h-auto object-contain" />
                        </div>
                    </div>
                    <div class="mt-6 text-center max-w-xs mx-auto">
                        <p class="mt-6 text-center max-w-xs mx-auto">
                            <span class="block text-sm font-semibold text-[#bd841a]">
                                Ecole Nationale Supérieure d'Arts et Métiers
                            </span>
                            <span class="block text-xs text-gray-400 mt-1">
                                Université Hassan II Casablanca
                            </span>
                        </p>
                    </div>
                    <div
                        class="absolute -right-24 bottom-[-5rem] w-60 h-60 rounded-full bg-white/10 blur-3xl pointer-events-none">
                    </div>
                </div>

                <!-- Login Form Panel -->
                <div class="bg-white p-8 md:p-14 flex flex-col justify-center">
                    <div class="max-w-xl">
                        <div class="mb-">
                            <div class="md:hidden flex flex-col items-start gap-3 mb-8 -mt-6">
                                <div class="bg-white rounded-md p-1 shadow-sm">
                                    <img src="{{ asset('logoEnsam.png') }}" alt="ENSAM logo"
                                        class="w-15 h-12 object-contain" />
                                </div>

                            </div>
                            <span
                                class="inline-flex items-center justify-center rounded-full bg-[#eef6ff] px-3 py-1 text-xs font-semibold uppercase tracking-[0.26em] text-[#0f2755] mb-4">PORTAIL
                                ADMINISTRATEUR</span>

                            <p class="text-slate-600 text-base">Veuillez entrer vos identifiants institutionnels.</p>
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
                                    <label for="email"
                                        class="block text-sm font-semibold text-slate-700 mb-2">{{ __('admin.university_email') }}</label>
                                    <div class="relative">
                                        <span
                                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">alternate_email</span>
                                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                                            placeholder="superadmin@example.com"
                                            class="w-full rounded-2xl border border-transparent bg-[#eef6ff] px-4 pl-12 py-4 text-slate-900 placeholder:text-slate-400 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[#0f2755]/10" />
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label for="password"
                                            class="text-sm font-semibold text-slate-700">{{ __('admin.password') }}</label>
                                        <a href="#"
                                            class="text-sm font-semibold text-[#bd841a] hover:underline">{{ __('admin.forgot_password') }}</a>
                                    </div>
                                    <div class="relative">
                                        <span
                                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">lock</span>
                                        <input id="password" name="password" type="password" placeholder="••••••••"
                                            class="w-full rounded-2xl border border-transparent text-[#bd841a] px-4 pl-12 py-4 text-slate-900 placeholder:text-slate-400 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[#0f2755]/10" />
                                        <button type="button"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#0f2755]"><span
                                                class="material-symbols-outlined">visibility</span></button>

                                        <!--  button Visibility -->
                                        <script>
                                            document.querySelector('button[type="button"]').addEventListener('click', function () {
                                                const input = document.getElementById('password');
                                                input.type = input.type === 'password' ? 'text' : 'password';
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}
                                        class="h-5 w-5 rounded border-slate-300 text-[#0f2755] focus:ring-[#0f2755]" />
                                    <label for="remember"
                                        class="text-sm text-slate-600 font-medium">{{ __('admin.stay_logged_in') }}</label>
                                </div>
                                <button type="submit"
                                    class="w-full rounded-2xl bg-[#0f2755] px-6 py-4 text-white text-base font-semibold shadow-[0_16px_30px_rgba(15,23,42,0.18)] hover:bg-[#0b1f46] transition-colors duration-200 flex items-center justify-center gap-2">Connexion
                                    administrateur <span class="material-symbols-outlined">arrow_forward</span></button>
                            </form>
                            <div class="mt-12 border-t border-slate-200 pt-8">
                                <p class="text-center text-sm leading-6 text-slate-500">{{ __('admin.auth_notice') }}
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</body>

</html>