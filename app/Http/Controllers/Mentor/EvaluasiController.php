<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Evaluasi;
use App\Models\ProgramKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class EvaluasiController extends Controller
{
    /**
     * List evaluasi
     */
    public function index()
    {
        $user = auth()->user();
  
        $evaluasis = Evaluasi::with(['kegiatan.bidang'])
            ->whereHas('kegiatan', function ($q) use ($user) {
                $q->where('bidang_id', $user->bidang_id);
            })
            ->latest()
            ->get();
        $kegiatanSiap = ProgramKegiatan::where('bidang_id', $user->bidang_id)
            ->whereDoesntHave('evaluasi')
            ->get()
            ->filter(function ($item) {
                $target = $item->target_laporan ?? 0;

                $jumlahUser = $item->laporans()
                    ->select('user_id')
                    ->distinct()
                    ->count();

                return $jumlahUser >= $target;
            })
            ->values(); // <- penting biar index rapi

        return view('mentor.evaluasi.index', compact('evaluasis', 'kegiatanSiap'));
    }

    /**
     * Form create evaluasi
     */
    public function create(ProgramKegiatan $kegiatan)
    {
        $user = auth()->user();

        if ($kegiatan->bidang_id != $user->bidang_id) {
            abort(403);
        }

            $jumlahUserMelapor = $kegiatan->laporans()
                ->select('user_id')
                ->distinct()
                ->count();

        if ($jumlahUserMelapor < $kegiatan->target_laporan) {
            return redirect()->back()
                ->with('error', 'Target laporan belum tercapai.');
        }

        if ($kegiatan->evaluasi) {
            return redirect()->route('mentor.evaluasi.show', $kegiatan->evaluasi->id);
        }
        return view('mentor.evaluasi.create', compact('kegiatan', 'jumlahUserMelapor'));
    }

    /**
     * Simpan evaluasi
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:program_kegiatans,id',
            'catatan' => 'required|string'
        ]);

        $kegiatan = ProgramKegiatan::findOrFail($request->kegiatan_id);

        $jumlahUserMelapor = $kegiatan->laporans()
            ->select('user_id')
            ->distinct()
            ->count();

        $status = $jumlahUserMelapor >= $kegiatan->target_laporan
            ? 'Tercapai'
            : 'Belum Tercapai';

        Evaluasi::create([
            'kegiatan_id' => $kegiatan->id,
            'bidang_id' => $kegiatan->bidang_id,
            'catatan' => $request->catatan,
            'status_pencapaian' => $status,
            'created_by' => auth()->id(),
        ]);

        $kegiatan->update([
            'status' => $status === 'Tercapai' ? 'Selesai' : 'Berjalan'
        ]);


        return redirect()->route('mentor.kegiatan.show', $kegiatan->id)
            ->with('success', 'Evaluasi berhasil dibuat.');
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

        return view('mentor.evaluasi.show', compact('evaluasi'));
    }

    /**
     * Form edit evaluasi
     */
    public function edit(Evaluasi $evaluasi)
    {
        $user = Auth::user();

        if ($evaluasi->kegiatan->bidang_id != $user->bidang_id) {
            abort(403);
        }

        return view('mentor.evaluasi.edit', compact('evaluasi'));
    }

    /**
     * Update evaluasi
     */
    public function update(Request $request, Evaluasi $evaluasi)
    {
        $request->validate([
            'catatan' => 'required|string'
        ]);

        $evaluasi->update([
            'catatan' => $request->catatan
        ]);

        return redirect()->route('mentor.evaluasi.index')
            ->with('success', 'Evaluasi berhasil diperbarui.');
    }

    /**
     * Cetak PDF
     */
    public function pdf(Evaluasi $evaluasi)
    {
        $pdf = Pdf::loadView('pdf.evaluasi', compact('evaluasi'));

        return $pdf->download('evaluasi-'.$evaluasi->id.'.pdf');
    }
}