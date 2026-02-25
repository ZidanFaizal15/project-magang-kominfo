<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard Pegawai
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-bold mb-2">
                Selamat Datang, {{ auth()->user()->name }}
            </h3>

            <p>
                Anda login sebagai <strong>Atasan</strong>.
            </p>
        </div>
    </div>
</x-app-layout>