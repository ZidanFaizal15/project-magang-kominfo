<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\ProgramKegiatan;

class ProgramKegiatanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $kegiatans = ProgramKegiatan::with('bidang')
            ->where('bidang_id', $user->bidang_id)
            ->latest()
            ->get();

        return view('pegawai.kegiatan.index', compact('kegiatans'));
    }

    public function show(ProgramKegiatan $kegiatan)
    {
        $user = auth()->user();

        if ($kegiatan->bidang_id != $user->bidang_id) {
            abort(403);
        }

        return view('pegawai.kegiatan.show', compact('kegiatan'));
    }
}