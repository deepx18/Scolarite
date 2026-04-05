<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Login | Academic Curator</title>
    <!-- Fonts & Icons -->
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-variant": "#e0e3e5",
                        "secondary": "#555f70",
                        "surface": "#f7fafc",
                        "on-background": "#181c1e",
                        "background": "#f7fafc",
                        "surface-container-low": "#f1f4f6",
                        "tertiary-fixed": "#ffddba",
                        "surface-container-highest": "#e0e3e5",
                        "on-primary-container": "#86a0cd",
                        "error": "#ba1a1a",
                        "primary-fixed-dim": "#adc7f7",
                        "inverse-on-surface": "#eef1f3",
                        "inverse-primary": "#adc7f7",
                        "on-error-container": "#93000a",
                        "surface-dim": "#d7dadc",
                        "surface-container": "#ebeef0",
                        "outline": "#74777f",
                        "on-secondary": "#ffffff",
                        "on-primary-fixed": "#001b3c",
                        "on-surface-variant": "#43474e",
                        "secondary-fixed": "#d9e3f8",
                        "on-tertiary-container": "#c6955e",
                        "inverse-surface": "#2d3133",
                        "surface-bright": "#f7fafc",
                        "tertiary-container": "#4f2e00",
                        "on-secondary-fixed": "#121c2b",
                        "primary": "#002045",
                        "surface-container-lowest": "#ffffff",
                        "on-surface": "#181c1e",
                        "surface-container-high": "#e5e9eb",
                        "on-tertiary": "#ffffff",
                        "tertiary-fixed-dim": "#f2bc82",
                        "secondary-fixed-dim": "#bdc7db",
                        "on-tertiary-fixed-variant": "#633f0f",
                        "outline-variant": "#c4c6cf",
                        "on-tertiary-fixed": "#2b1700",
                        "surface-tint": "#455f88",
                        "tertiary": "#321b00",
                        "secondary-container": "#d9e3f8",
                        "on-secondary-fixed-variant": "#3e4758",
                        "on-secondary-container": "#5b6577",
                        "primary-fixed": "#d6e3ff",
                        "on-primary-fixed-variant": "#2d476f",
                        "primary-container": "#1a365d",
                        "on-primary": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-error": "#ffffff"
                    },
                    fontFamily: {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .bg-academic-overlay {
            background: linear-gradient(135deg, rgba(0, 32, 69, 0.92) 0%, rgba(26, 54, 93, 0.85) 100%);
        }

        input::-webkit-calendar-picker-indicator {
            filter: invert(0.4);
            cursor: pointer;
        }
    </style>
</head>

<body
    class="font-body bg-surface text-on-surface flex min-h-screen flex-col items-center justify-center py-8 md:py-12 relative overflow-auto">
    <!-- Background Image with Tonal Overlay -->
    <div class="absolute inset-0 z-0">
        <img alt="University library background" class="w-full h-full object-cover filter blur-[2px]"
            data-alt="Stunning perspective of a historic university library with high vaulted ceilings, sunbeams through tall windows, and blurred wooden study carrels."
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuChAjZULxxhGEUuwHJxwAc8JLZ9bbOg-pUQgKTvgFjI3p_QNo1YMMKzxZSSGB7jKzeHs9xOYpZF0VvOkqewMyrSd5wwC6jrBav7dILjXfJjDDw5520DJeCvP6BPyD3m2vb0eAg0VsXyJowtwdQzunqtcTgjNL0zymy5HCkrp68kJV5uv5Vr75cAXNObOSOj5nXQsawSMmFMJbQtRQoAThkne9Vb4Pzg31UxVtED1BNmf-wdwdRUxlISk9nbZXQIHg11Tm804DZ1OpQ" />
        <div class="absolute inset-0 bg-academic-overlay backdrop-blur-sm"></div>
    </div>
    <!-- Login Container -->
    <main class="relative z-10 w-[95%] sm:w-[85%] max-w-[450px] px-3 py-6 sm:px-4 md:px-6 md:py-8">
        <div
            class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col items-center p-4 sm:p-6 md:p-10 lg:p-12">
            <!-- Brand Identity Section -->
            <div class="flex flex-col items-center mb-6 sm:mb-8 md:mb-10 text-center">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-primary-container rounded-xl flex items-center justify-center mb-4 sm:mb-6 shadow-sm">
                    <span class="material-symbols-outlined text-primary-fixed text-2xl sm:text-3xl lg:text-4xl" data-icon="school">school</span>
                </div>
                <h1 class="font-headline text-xl sm:text-2xl md:text-3xl font-extrabold tracking-tighter text-primary mb-1 sm:mb-2">Academic Curator
                </h1>
                <p class="text-secondary font-medium text-xs sm:text-sm max-w-[280px]">Access your student records and manage
                    administrative requests securely.</p>
            </div>
            <!-- Login Form -->
            <form method="POST" action="{{ route('login.student.submit') }}" class="w-full space-y-6 sm:space-y-7 md:space-y-8">
                @csrf
                @if ($errors->any())
                    <div class="mb-5 rounded-lg border-l-4 border-error bg-error/10 p-3 sm:p-4 text-error">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-error text-lg sm:text-xl min-w-fit">error</span>
                            <p class="text-xs sm:text-sm leading-relaxed">{{ $errors->first() }}</p>
                        </div>
                    </div>
                @endif
                <!-- Apogee Number Field -->
                <div class="group">
                    <label
                        class="block font-label text-[10px] sm:text-xs font-semibold uppercase tracking-wider text-secondary mb-2 group-focus-within:text-primary transition-colors"
                        for="apogee">
                        Apogee Number
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline text-lg sm:text-xl" data-icon="badge">badge</span>
                        </div>
                        <input
                            class="w-full pl-10 sm:pl-12 pr-3 sm:pr-4 py-3 sm:py-4 bg-surface-container-highest border-0 border-b-2 {{ $errors->has('apogee') ? 'border-error focus:border-error' : 'border-transparent focus:border-primary' }} focus:ring-0 rounded-t-lg text-on-surface text-sm sm:text-base font-medium placeholder:text-outline/60 transition-all"
                            id="apogee" name="apogee" placeholder="e.g. 19028374" type="text"
                            value="{{ old('apogee') }}" />
                    </div>
                    <p class="mt-1 sm:mt-2 text-[10px] sm:text-[11px] text-outline">Your unique university identification number.</p>
                </div>
                <!-- Date of Birth Field -->
                <div class="group">
                    <label
                        class="block font-label text-[10px] sm:text-xs font-semibold uppercase tracking-wider text-secondary mb-2 group-focus-within:text-primary transition-colors"
                        for="dob">
                        Date of Birth
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline text-lg sm:text-xl"
                                data-icon="calendar_today">calendar_today</span>
                        </div>
                        <input
                            class="w-full pl-10 sm:pl-12 pr-3 sm:pr-4 py-3 sm:py-4 bg-surface-container-highest border-0 border-b-2 {{ $errors->has('dob') ? 'border-error focus:border-error' : 'border-transparent focus:border-primary' }} focus:ring-0 rounded-t-lg text-on-surface text-sm sm:text-base font-medium transition-all"
                            id="dob" name="dob" type="date" value="{{ old('dob') }}" />
                    </div>
                </div>
                <!-- Action Button -->
                <button
                    class="w-full bg-gradient-to-br from-primary to-primary-container text-on-primary py-3 sm:py-4 rounded-lg font-headline font-bold text-xs sm:text-sm tracking-wide shadow-md hover:shadow-lg transition-all active:scale-[0.98] flex items-center justify-center gap-2"
                    type="submit">
                    Log In
                    <span class="material-symbols-outlined text-base sm:text-lg" data-icon="arrow_forward">arrow_forward</span>
                </button>
            </form>
            <!-- Secondary Links/Help -->
            <div class="mt-8 sm:mt-10 md:mt-12 w-full pt-6 sm:pt-8 border-t border-outline-variant/20 flex flex-col gap-3 sm:gap-4 text-center">
                <a class="text-[10px] sm:text-xs font-semibold text-secondary hover:text-primary transition-colors flex items-center justify-center gap-1"
                    href="#">
                    <span class="material-symbols-outlined text-xs sm:text-sm" data-icon="help">help</span>
                    Having trouble logging in?
                </a>
                <p class="text-[9px] sm:text-[10px] text-outline/70 leading-relaxed">
                    By logging in, you agree to the Academic Curator's <br />
                    <a class="underline hover:text-secondary" href="#">Privacy Policy</a> and <a
                        class="underline hover:text-secondary" href="#">Terms of Service</a>.
                </p>
            </div>
        </div>
        <!-- Footer / Branding Minimal -->
        <footer class="mt-6 sm:mt-8 flex justify-center gap-4 sm:gap-6 opacity-60">
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-primary-fixed"></div>
                <span class="text-[8px] sm:text-[10px] font-bold text-primary-fixed uppercase tracking-widest">Student Portal
                    2.0</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-primary-fixed"></div>
                <span class="text-[8px] sm:text-[10px] font-bold text-primary-fixed uppercase tracking-widest">Secured Node</span>
            </div>
        </footer>
    </main>
    <!-- Decorative Elements (Asymmetric) -->
    <div
        class="absolute top-20 right-[-100px] w-[300px] h-[300px] bg-primary/10 rounded-full blur-[120px] pointer-events-none">
    </div>
    <div
        class="absolute bottom-20 left-[-100px] w-[400px] h-[400px] bg-tertiary-fixed/5 rounded-full blur-[120px] pointer-events-none">
    </div>
</body>

</html>
