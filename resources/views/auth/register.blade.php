<x-guest-layout>

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Register
        </h2>

        <!-- TOMBOL KEMBALI -->
        <a href="{{ url('/') }}"
           class="text-sm text-gray-500 hover:text-gray-700 transition">
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- NAME -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name"
                class="block mt-1 w-full rounded-lg"
                type="text"
                name="name"
                :value="old('name')"
                required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- EMAIL -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email"
                class="block mt-1 w-full rounded-lg"
                type="email"
                name="email"
                :value="old('email')"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- BIDANG -->
        <div class="mt-4">
            <x-input-label for="bidang_id" value="Bidang" />

            <select id="bidang_id" name="bidang_id"
                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                required>
                <option value="">-- Pilih Bidang --</option>

                @foreach($bidangs as $bidang)
                    <option value="{{ $bidang->id }}">
                        {{ $bidang->nama_bidang }}
                    </option>
                @endforeach
            </select>

            <x-input-error :messages="$errors->get('bidang_id')" class="mt-2" />
        </div>

        <!-- ROLE -->
        <div class="mt-4">
            <x-input-label for="role" value="Role" />

            <select id="role" name="role"
                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                required>
                <option value="">-- Pilih Role --</option>
                <option value="pegawai">Pegawai</option>
                <option value="atasan">Atasan</option>
            </select>

            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- PASSWORD -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password"
                    class="block mt-1 w-full rounded-lg pr-12"
                    type="password"
                    name="password"
                    required />

                <!-- ICON MATA -->
                <button type="button"
                    onclick="togglePassword('password', this)"
                    class="absolute right-3 top-3 text-gray-400 hover:text-blue-600 transition hidden">
                    
                    <!-- EYE ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5
                               c4.478 0 8.268 2.943 9.542 7
                               -1.274 4.057-5.064 7-9.542 7
                               -4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- CONFIRM PASSWORD -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation"
                class="block mt-1 w-full rounded-lg"
                type="password"
                name="password_confirmation"
                required />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- BUTTON REGISTER -->
        <button
            class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition duration-200 transform hover:scale-[1.02]">
            Register
        </button>

        <!-- LOGIN LINK -->
        <p class="text-sm text-center mt-5 text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}"
               class="text-blue-600 font-medium hover:underline">
                Login
            </a>
        </p>

    </form>

    <!-- SCRIPT -->
    <script>
        function togglePassword(id, el) {
            const input = document.getElementById(id);

            if (input.type === 'password') {
                input.type = 'text';
                el.classList.add('text-blue-600');
            } else {
                input.type = 'password';
                el.classList.remove('text-blue-600');
            }
        }

        // Munculkan icon hanya saat user mulai mengetik
        document.getElementById('password').addEventListener('input', function() {
            const btn = this.parentElement.querySelector('button');
            if (this.value.length > 0) {
                btn.classList.remove('hidden');
            } else {
                btn.classList.add('hidden');
            }
        });
    </script>

</x-guest-layout>