<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring App</title>
    @vite('resources/css/app.css')

    <style>
        /* ANIMASI BACKGROUND */
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

        /* ANIMASI MASUK */
        @keyframes fadeLeft {
            from {
                opacity: 0;
                transform: translateX(-40px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeRight {
            from {
                opacity: 0;
                transform: translateX(40px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-left {
            animation: fadeLeft 0.8s ease forwards;
        }

        .animate-right {
            animation: fadeRight 0.8s ease forwards;
        }
    </style>
</head>

<body class="min-h-screen animated-bg relative overflow-hidden">

    <!-- HERO (FULL BACKGROUND) -->
    <div class="hidden md:flex absolute inset-0 items-center justify-end px-20 text-white animate-right">

        <div class="max-w-xl">
            <h1 class="text-5xl font-bold mb-6 leading-tight">
                Monitoring App
            </h1>

            <p class="text-white/80 text-lg">
                Selamat datang di sistem monitoring dan evaluasi kegiatan magang.
                Pantau kegiatan magangmu, buat laporan, dan dapatkan hasil evualuasi
                dengan mudah dan cepat.
            </p>
        </div>

    </div>

    <!-- SIDEBAR -->
    <div class="w-full md:w-[35%] h-screen bg-white/90 backdrop-blur-xl
                shadow-[0_25px_70px_rgba(0,0,0,0.5)]
                flex items-center justify-center px-8
                animate-left relative z-10">

        <div class="w-full max-w-sm text-center">

            <h2 class="text-xl font-semibold text-gray-800 mb-8">
                Mulai Sekarang
            </h2>

            <div class="flex flex-col items-center gap-4">

                <a href="{{ route('login') }}"
                   class="w-3/4 border-blue-600 bg-blue-600 hover:bg-gray-700 text-white py-3 rounded-lg font-medium transition duration-200 transform hover:scale-105">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="w-3/4 border-blue-600 bg-blue-600 hover:bg-gray-700 text-white py-3 rounded-lg font-medium transition duration-200 transform hover:scale-105">
                    Register
                </a>

            </div>

        </div>

    </div>

</body>
</html>