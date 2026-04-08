<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Institutional Control Center' }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#002045',
                        'primary-container': '#1a365d',
                        background: '#f8fafc',
                        surface: '#ffffff',
                        'surface-container-low': '#f1f4f6',
                        outline: '#74777f',
                        error: '#ef4444',
                        'on-primary': '#ffffff',
                        'on-surface': '#0f172a',
                    },
                    fontFamily: {
                        headline: ['Manrope'],
                        body: ['Inter'],
                    },
                    boxShadow: {
                        soft: '0 18px 48px rgba(15, 23, 42, 0.08)',
                    },
                },
            },
        };
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Manrope', sans-serif;
        }
    </style>
</head>

<body class="bg-background text-on-surface min-h-screen">
    @yield('content')
</body>

</html>
