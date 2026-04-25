@props(['title' => 'Academic Curator', 'activeRoute' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#002045",
                        "on-primary": "#ffffff",
                        "primary-container": "#d4e3ff",
                        "on-primary-container": "#001b3c",
                        "secondary": "#1960a3",
                        "on-secondary": "#ffffff",
                        "secondary-container": "#d9e3f8",
                        "on-secondary-container": "#001c3b",
                        "tertiary": "#321b00",
                        "on-tertiary": "#ffffff",
                        "surface": "#f7fafc",
                        "on-surface": "#1a1c1f",
                        "on-surface-variant": "#43474e",
                        "surface-variant": "#e0e3e5",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f1f4f6",
                        "surface-container-high": "#e8eef2",
                        "surface-container-highest": "#dcdfea",
                        "outline": "#74777f",
                        "outline-variant": "#c4c7cf",
                        "error": "#ba1a1a",
                        "on-error": "#ffffff",
                        "error-container": "#ffdad6",
                    },
                    fontFamily: {
                        headline: ["Manrope", "sans-serif"],
                        body: ["Inter", "sans-serif"],
                    },
                    fontSize: {
                        xs: ["12px", "16px"],
                        sm: ["14px", "20px"],
                        base: ["16px", "24px"],
                        lg: ["20px", "28px"],
                        xl: ["24px", "32px"],
                        "2xl": ["32px", "40px"],
                    },
                },
            },
        };
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-surface text-on-surface font-body">
    <!-- Top Navigation -->
    <x-client.top-nav-bar />

    <!-- Admin Sidebar -->
    <x-client.admin-sidebar :active="$activeRoute" />

    <!-- Main Content -->
    <main class="lg:ml-64 min-h-screen pb-24 lg:pb-8">
        <div class="max-w-7xl mx-auto px-6 py-8">
            {{ $slot }}
        </div>
    </main>
</body>

</html>
