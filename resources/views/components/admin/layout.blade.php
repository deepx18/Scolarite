<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $title ?? 'All Requests | The Academic Curator' }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
                        "surface-dim": "#d7dadc",
                        "primary-fixed": "#d6e3ff",
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
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Manrope', sans-serif; }
        .glass-nav {
            backdrop-filter: blur(20px);
        }
        .tonal-layering {
            border: none !important;
        }
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen">
    {{ $slot }}
</body>
</html>