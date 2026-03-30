<?php

namespace App\Http\Controllers\Admin;

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

        // ======================
        // DATA EVALUASI
        // ======================
        if ($user->role === 'admin') {
            $evaluasis = Evaluasi::with(['kegiatan.bidang'])
                ->latest()
                ->get();
        } else {
            $evaluasis = Evaluasi::with(['kegiatan.bidang'])
                ->whereHas('kegiatan', function ($q) use ($user) {
                    $q->where('bidang_id', $user->bidang_id);
                })
                ->latest()
                ->get();
        }

        // ======================
        // KEGIATAN SIAP EVALUASI
        // ======================
        if ($user->role === 'admin') {
            $kegiatanSiap = ProgramKegiatan::whereDoesntHave('evaluasi')->get();
        } else {
            $kegiatanSiap = ProgramKegiatan::where('bidang_id', $user->bidang_id)
                ->whereDoesntHave('evaluasi')
                ->get();
        }

        $kegiatanSiap = $kegiatanSiap->filter(function ($item) {
            return $item->laporans()
                ->distinct('user_id')
                ->count('user_id') >= $item->target_laporan;
        });

        return view('admin.evaluasi.index', compact('evaluasis', 'kegiatanSiap'));
    }

    /**
     * Form create evaluasi
     */
    public function create(ProgramKegiatan $kegiatan)
    {
        $user = auth()->user();

        if ($user->role !== 'admin' && $kegiatan->bidang_id != $user->bidang_id) {
            abort(403);
        }

        if (!in_array($user->role, ['admin', 'atasan'])) {
            abort(403);
        }

        if ($user->role !== 'admin' && $kegiatan->bidang_id != $user->bidang_id) {
            abort(403);
        }

        $jumlahUserMelapor = $kegiatan->laporans()
            ->distinct('user_id')
            ->count('user_id');

        if ($jumlahUserMelapor < $kegiatan->target_laporan) {
            return redirect()->back()
                ->with('error', 'Target belum tercapai.');
        }

        if ($kegiatan->evaluasi) {
            return redirect()->route('admin.evaluasi.show', $kegiatan->evaluasi->id);
        }

        return view('admin.evaluasi.create', compact('kegiatan', 'jumlahUserMelapor'));
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
            ->distinct('user_id')
            ->count('user_id');

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

        // Optional: ubah status kegiatan jadi Selesai
        $kegiatan->update([
            'status' => 'Selesai'
        ]);

        return redirect()->route('admin.kegiatan.show', $kegiatan->id)
            ->with('success', 'Evaluasi berhasil dibuat.');
    }

    /**
     * Detail evaluasi
     */
    public function show(Evaluasi $evaluasi)
    {
        $user = Auth::user();

        $evaluasi->load('kegiatan');

        if ($user->role !== 'admin' &&
            $evaluasi->kegiatan->bidang_id != $user->bidang_id) {
            abort(403);
        }

        return view('admin.evaluasi.show', compact('evaluasi'));
    }

    /**
     * Form edit evaluasi
     */
    public function edit(Evaluasi $evaluasi)
    {
        $user = Auth::user();

        if (!in_array($user->role, ['admin', 'atasan'])) {
            abort(403);
        }

        if ($user->role !== 'admin' &&
            $evaluasi->kegiatan->bidang_id != $user->bidang_id) {
            abort(403);
        }

        return view('admin.evaluasi.edit', compact('evaluasi'));
    }

    /**
     * Update evaluasi
     */
    public function update(Request $request, Evaluasi $evaluasi)
    {
        $user = auth()->user();

        if (!in_array($user->role, ['admin', 'atasan'])) {
            abort(403);
        }

        if ($user->role !== 'admin' &&
            $evaluasi->kegiatan->bidang_id != $user->bidang_id) {
            abort(403);
        }

        $request->validate([
            'catatan' => 'required|string'
        ]);

        $evaluasi->update([
            'catatan' => $request->catatan
        ]);

        return redirect()->route('admin.evaluasi.index')
            ->with('success', 'Evaluasi berhasil diperbarui.');
    }

    /**
     * Cetak PDF
     */
    public function pdf(Evaluasi $evaluasi)
    {
        $user = auth()->user();

        if ($user->role !== 'admin' &&
            $evaluasi->kegiatan->bidang_id != $user->bidang_id) {
            abort(403);
        }

        $pdf = Pdf::loadView('admin.evaluasi.pdf', compact('evaluasi'));

        return $pdf->download('evaluasi-'.$evaluasi->id.'.pdf');
    }
}