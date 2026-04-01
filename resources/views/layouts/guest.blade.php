<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Monitoring App') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- VITE -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* GRADIENT ANIMATION */
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animated-bg {
            background: linear-gradient(270deg, #2563eb, #4f46e5, #7c3aed);
            background-size: 600% 600%;
            animation: gradientMove 10s ease infinite;
        }

        /* FADE ANIMATION */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade {
            animation: fadeUp 0.8s ease forwards;
        }
    </style>
</head>

<body class="font-sans antialiased">

    <!-- BACKGROUND -->
    <div class="min-h-screen animated-bg flex items-center justify-center px-4">

        <!-- WRAPPER -->
        <div class="w-full max-w-md animate-fade">

            <!-- SLOT (ISI LOGIN / REGISTER) -->
            <div class="bg-white/90 backdrop-blur-xl rounded-2xl
                        shadow-[0_25px_70px_rgba(0,0,0,0.4)]
                        px-8 py-10">

                {{ $slot }}

            </div>

        </div>

    </div>

</body>
</html>