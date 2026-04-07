<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'id'); // default ID
        $direction = $request->get('direction', 'asc');

        $allowedSorts = ['id', 'name', 'email', 'role', 'is_active', 'bidang'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }

        $query = User::query()->with('bidang');

        // SORTING KHUSUS
        if ($sort === 'bidang') {
            $query->leftJoin('bidangs', 'users.bidang_id', '=', 'bidangs.id')
                ->select('users.*')
                ->orderBy('bidangs.nama_bidang', $direction);

        } elseif ($sort === 'role') {
            // urutan custom: Admin > Mentor > Peserta
            $query->orderByRaw("
                FIELD(role, 'admin', 'mentor', 'peserta') " . $direction
            );

        } elseif ($sort === 'is_active') {
            // Aktif dulu baru blacklist
            $query->orderBy('is_active', $direction);

        } else {
            $query->orderBy($sort, $direction);
        }

        $users = $query->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $bidangs = Bidang::all();

        return view('admin.users.create', compact('bidangs'));
    }

    public function edit(User $user)
    {
        $bidangs = Bidang::all();
        return view('admin.users.edit', compact('user', 'bidangs'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
                    'name'  => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email,' . $user->id,
                    'role'  => 'required|in:admin,mentor,peserta',
                    'password' => 'nullable|min:6',
                ];

                // Jika bukan admin → bidang wajib
                if ($request->role !== 'admin') {
                    $rules['bidang_id'] = 'required|exists:bidangs,id';
                } else {
                    $rules['bidang_id'] = 'nullable';
                }
                
        $request->validate($rules);

            $user->name  = $request->name;
            $user->email = $request->email;
            $user->role  = $request->role;
            $user->bidang_id = $request->role === 'admin'
                ? null
                : $request->bidang_id;

            if ($request->filled('password')) {
                $user->password = \Hash::make($request->password);
            }

            $user->save();


        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa hapus akun sendiri');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }

    public function toggleActive(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 'Status user diperbarui');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,mentor,peserta',
            'bidang_id' => 'nullable|exists:bidangs,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'bidang_id' => $request->bidang_id,
            'is_active' => true
        ]);

        return redirect()->route('admin.users.index')
            ->with('success','User berhasil ditambahkan');
    }
}
