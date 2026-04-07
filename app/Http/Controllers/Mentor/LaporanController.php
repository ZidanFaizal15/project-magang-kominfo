<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Menampilkan daftar laporan
     */
    public function index()
    {
        $user = auth()->user();

        // Mentor hanya melihat laporan dari bidangnya
        $laporans = Laporan::with(['Kegiatan.bidang','user'])
            ->whereHas('Kegiatan', function ($query) use ($user) {
                $query->where('bidang_id', $user->bidang_id);
            })
            ->latest()
            ->get();

        return view('mentor.laporan.index', compact('laporans'));
    }

    /**
     * Detail laporan
     */
    public function show(Laporan $laporan)
    {
        $laporan->load(['Kegiatan.bidang','user']);

        return view('mentor.laporan.show', compact('laporan'));
    }

    /**
     * Cetak laporan PDF
     */
    public function cetak(Laporan $laporan)
    {
        $pdf = Pdf::loadView('pdf.laporan', compact('laporan'));

        return $pdf->download('laporan-'.$laporan->id.'.pdf');
    }
}