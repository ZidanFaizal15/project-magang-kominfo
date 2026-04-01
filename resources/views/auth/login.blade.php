<x-guest-layout>

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Login
        </h2>

        <!-- TOMBOL KEMBALI -->
        <a href="{{ url('/') }}"
           class="text-sm text-gray-500 hover:text-gray-700 transition">
            Kembali
        </a>
    </div>

    <!-- STATUS -->
    <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- EMAIL -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email"
                class="block mt-1 w-full rounded-lg"
                type="email"
                name="email"
                :value="old('email')"
                required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- PASSWORD -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password"
                    class="block mt-1 w-full rounded-lg pr-12 transition duration-200"
                    type="password"
                    name="password"
                    required />

                <!-- ICON EYE -->
                <button type="button"
                    onmousedown="showPassword(this)"
                    onmouseup="hidePassword(this)"
                    onmouseleave="hidePassword(this)"
                    ontouchstart="showPassword(this)"
                    ontouchend="hidePassword(this)"
                    class="absolute right-3 top-3 text-gray-400 hover:text-blue-600 transition duration-200 active:scale-110">

                    <!-- SVG EYE -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5
                               c4.477 0 8.268 2.943 9.542 7
                               -1.274 4.057-5.065 7-9.542 7
                               -4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- REMEMBER + FORGOT -->
        <div class="flex items-center justify-between mt-4">

            <label class="flex items-center text-sm text-gray-600">
                <input type="checkbox" name="remember"
                    class="rounded border-gray-300 text-blue-600 mr-2">
                Remember me
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-blue-600 hover:underline">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- BUTTON LOGIN -->
        <button
            class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition duration-200 transform hover:scale-[1.02] active:scale-95">
            Log in
        </button>

        <!-- REGISTER -->
        <p class="text-sm text-center mt-5 text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}"
               class="text-blue-600 font-medium hover:underline">
                Register
            </a>
        </p>

    </form>

    <!-- SCRIPT -->
    <script>
        function showPassword(el) {
            const input = document.getElementById('password');
            input.type = 'text';
            el.classList.add('text-blue-600', 'scale-125');
        }

        function hidePassword(el) {
            const input = document.getElementById('password');
            input.type = 'password';
            el.classList.remove('text-blue-600', 'scale-125');
        }
    </script>

</x-guest-layout>