<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Evaluasi;
use Illuminate\Support\Facades\Auth;

class EvaluasiController extends Controller
{
    /**
     * List evaluasi untuk pegawai
     */
    public function index()
    {
        $user = Auth::user();

        $evaluasis = Evaluasi::with(['kegiatan.bidang'])
            ->whereHas('kegiatan', function ($query) use ($user) {
                $query->where('bidang_id', $user->bidang_id);
            })
            ->latest()
            ->get();

        return view('pegawai.evaluasi.index', compact('evaluasis'));
    }

    /**
     * Detail evaluasi
     */
    public function show(Evaluasi $evaluasi)
    {
        $user = Auth::user();

        $evaluasi->load('kegiatan');

        if ($evaluasi->kegiatan->bidang_id != $user->bidang_id) {
            abort(403);
        }

        return view('pegawai.evaluasi.show', compact('evaluasi'));
    }
}