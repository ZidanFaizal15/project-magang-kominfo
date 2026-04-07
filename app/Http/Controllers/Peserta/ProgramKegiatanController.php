<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\ProgramKegiatan;
use Barryvdh\DomPDF\Facade\Pdf;

class ProgramKegiatanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $kegiatans = ProgramKegiatan::with('bidang')
            ->where('bidang_id', $user->bidang_id)
            ->latest()
            ->get();

        return view('peserta.kegiatan.index', compact('kegiatans'));
    }

    public function show(ProgramKegiatan $kegiatan)
    {
        $user = auth()->user();

        if ($kegiatan->bidang_id != $user->bidang_id) {
            abort(403);
        }

        return view('peserta.kegiatan.show', compact('kegiatan'));
    }

    public function cetak(Laporan $laporan)
    {
        if ($laporan->user_id != Auth::id()) {
            abort(403);
        }

        $pdf = Pdf::loadView('pdf.kegiatan', compact('kegiatan'));

        return $pdf->download('kegiatan-' . $kegiatan->id . '.pdf');
    }
}