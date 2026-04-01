<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Profile
            </h2>

            <!-- BUTTON KEMBALI -->
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('dashboard') }}"
            class="text-sm bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="p-6 max-w-xl mx-auto bg-white shadow rounded">

        <!-- STATUS -->
        @if (session('status') === 'profile-updated')
            <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
                Profile berhasil diperbarui
            </div>
        @endif

        <!-- FOTO -->
        <div class="flex flex-col items-center mb-6">
            <img id="preview"
                src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://via.placeholder.com/150' }}"
                class="w-32 h-32 rounded-full object-cover border">

            <!-- HAPUS FOTO -->
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <input type="hidden" name="remove_photo" value="1">
                <input type="hidden" name="name" value="{{ $user->name }}">
                <input type="hidden" name="email" value="{{ $user->email }}">

                <button class="mt-3 text-sm text-red-500 hover:underline">
                    Hapus Foto
                </button>
            </form>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <!-- Nama -->
            <div class="mb-4">
                <label class="block text-sm mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border rounded p-2 focus:ring focus:ring-blue-200">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border rounded p-2 bg-gray-100">
            </div>

            <!-- Upload Foto -->
            <div class="mb-6">
                <label class="block text-sm mb-1">Ganti Foto Profile</label>
                <input type="file" name="photo" onchange="previewImage(event)" class="w-full">
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Update Profile
                </button>
            </div>
        </form>
    </div>

    <!-- SCRIPT PREVIEW -->
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                document.getElementById('preview').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-app-layout>