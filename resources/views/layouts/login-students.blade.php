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
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
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
    class="font-body bg-surface text-on-surface flex items-center justify-center min-h-screen relative overflow-hidden">
    <!-- Background Image with Tonal Overlay -->
    <div class="absolute inset-0 z-0">
        <img alt="University library background" class="w-full h-full object-cover filter blur-[2px]"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuChAjZULxxhGEUuwHJxwAc8JLZ9bbOg-pUQgKTvgFjI3p_QNo1YMMKzxZSSGB7jKzeHs9xOYpZF0VvOkqewMyrSd5wwC6jrBav7dILjXfJjDDw5520DJeCvP6BPyD3m2vb0eAg0VsXyJowtwdQzunqtcTgjNL0zymy5HCkrp68kJV5uv5Vr75cAXNObOSOj5nXQsawSMmFMJbQtRQoAThkne9Vb4Pzg31UxVtED1BNmf-wdwdRUxlISk9nbZXQIHg11Tm804DZ1OpQ" />
        <div class="absolute inset-0 bg-academic-overlay backdrop-blur-sm"></div>
    </div>
    <!-- Login Container -->
    <main class="relative z-10 w-full max-w-[480px] px-6 py-12">
        <div
            class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col items-center p-10 md:p-14">
            <!-- Brand Identity Section -->
            <div class="flex flex-col items-center mb-10 text-center">
                <div class="w-20 h-20 bg-primary-container rounded-xl flex items-center justify-center mb-6 shadow-sm">
                    <span class="material-symbols-outlined text-primary-fixed text-4xl">school</span>
                </div>
                <h1 class="font-headline text-3xl font-extrabold tracking-tighter text-primary mb-2">Academic Curator
                </h1>
                <p class="text-secondary font-medium text-sm max-w-[280px]">Access your student records and manage
                    administrative requests securely.</p>
            </div>
            <!-- Login Form -->
             {{-- Display errors --}}
    @if ($errors->any())
        <div style="color:red">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
            <form class="w-full space-y-8" action="{{ route('students.login.submit') }}" method="POST">
                @csrf
                <!-- Apogee Number Field -->
                <div class="group">
                    <label
                        class="block font-label text-xs font-semibold uppercase tracking-wider text-secondary mb-2 group-focus-within:text-primary transition-colors"
                        for="apogee_number" >
                        Apogee Number
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline text-xl">badge</span>
                        </div>
                        <input
                            class="w-full pl-12 pr-4 py-4 bg-surface-container-highest border-0 border-b-2 border-transparent focus:border-primary focus:ring-0 rounded-t-lg text-on-surface font-medium placeholder:text-outline/60 transition-all"
                            type="text" id="apogee_number" name="apogee_number" required />
                    </div>
                    <p class="mt-2 text-[11px] text-outline">Your unique university identification number.</p>
                </div>
                <!-- Date of Birth Field -->
                <div class="group">
                    <label
                        class="block font-label text-xs font-semibold uppercase tracking-wider text-secondary mb-2 group-focus-within:text-primary transition-colors"
                        for="date_of_birth">
                        Date of Birth
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline text-xl">calendar_today</span>
                        </div>
                        <input
                            class="w-full pl-12 pr-4 py-4 bg-surface-container-highest border-0 border-b-2 border-transparent focus:border-primary focus:ring-0 rounded-t-lg text-on-surface font-medium transition-all"
                            type="date" id="date_of_birth" name="date_of_birth" required />
                    </div>
                </div>
                <!-- Action Button -->
                <button
                    class="w-full bg-gradient-to-br from-primary to-primary-container text-on-primary py-4 rounded-lg font-headline font-bold text-sm tracking-wide shadow-md hover:shadow-lg transition-all active:scale-[0.98] flex items-center justify-center gap-2"
                    type="submit">
                    Log In
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </button>
            </form>
        </div>
    </main>
</body>

</html>