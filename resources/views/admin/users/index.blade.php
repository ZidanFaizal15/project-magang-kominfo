<x-app-layout>
    <x-slot name="header">
             <h2 class="text-2xl font-bold text-gray-800">
                Daftar User
            </h2>
            <p class="text-sm text-gray-500">
                Kelola user yang memiliki akses ke sistem
            </p>
    </x-slot>

    


        <main class="flex-1 p-6 bg-gray-100">

            @if(session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-4 rounded shadow">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Daftar User</h3>

                    <a href="{{ route('admin.users.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        + Tambah User
                    </a>
                </div>
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-2 border">Nama</th>
                            <th class="p-2 border">Email</th>
                            <th class="p-2 border">Role</th>
                            <th class="p-2 border">Status</th>
                            <th class="p-2 border">Bidang</th>
                            <th class="p-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="p-2 border">{{ $user->name }}</td>
                            <td class="p-2 border">{{ $user->email }}</td>
                            <td class="p-2 border">

                            @if($user->role == 'admin')
                            <span class="px-2 py-1 text-xs bg-purple-100 text-purple-700 rounded">
                            Admin
                            </span>

                            @elseif($user->role == 'atasan')
                            <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded">
                            Atasan
                            </span>

                            @else
                            <span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">
                            Pegawai
                            </span>
                            @endif

                            </td>
                            <td class="p-2 border">

                                @if($user->is_active)
                                    <span class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded-full">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-sm bg-black text-white rounded-full">
                                        Blacklist
                                    </span>
                                @endif

                            </td>
                            <td class="px-4 py-2">
                                {{ $user->bidang->nama_bidang ?? '-' }}
                            </td>
                            <td class="p-2 border space-x-2">

                                <a href="{{ route('admin.users.edit', $user) }}"
                                class="px-2 py-1 bg-yellow-500 text-white rounded">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</x-app-layout>
