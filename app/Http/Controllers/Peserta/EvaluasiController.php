<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Evaluasi;
use Illuminate\Support\Facades\Auth;

class EvaluasiController extends Controller
{
    /**
     * List evaluasi untuk peserta
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

        return view('peserta.evaluasi.index', compact('evaluasis'));
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

        return view('peserta.evaluasi.show', compact('evaluasi'));
    }

    public function pdf(\App\Models\Evaluasi $evaluasi)
    {
        $user = auth()->user();

        // 🔐 Batasi hanya bidang sendiri
        if ($evaluasi->kegiatan->bidang_id != $user->bidang_id) {
            abort(403);
        }

        $pdf = Pdf::loadView('pdf.evaluasi', compact('evaluasi'));

        return $pdf->download('evaluasi-'.$evaluasi->id.'.pdf');
    }
}