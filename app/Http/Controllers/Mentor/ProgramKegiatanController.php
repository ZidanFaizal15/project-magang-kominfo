<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\ProgramKegiatan;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProgramKegiatanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $kegiatans = ProgramKegiatan::with('bidang')
            ->where('bidang_id', $user->bidang_id)
            ->get();

        return view('mentor.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        $user = auth()->user();

        $bidangs = Bidang::where('id', $user->bidang_id)->get();

        return view('mentor.kegiatan.create', compact('bidangs'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nama_kegiatan'   => 'required|string|max:255',
            'jenis_kegiatan'  => 'required|string|max:255',
            'tanggal_kegiatan'=> 'required|date',
            'status'          => 'required|string',
            'deskripsi'       => 'nullable|string',
            'target_laporan'  => 'required|integer|min:1',
        ]);

        ProgramKegiatan::create([
            'nama_kegiatan'    => $request->nama_kegiatan,
            'jenis_kegiatan'   => $request->jenis_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'status'           => 'Proses',
            'bidang_id'        => $user->bidang_id,
            'deskripsi'        => $request->deskripsi,
            'target_laporan'   => $request->target_laporan,
        ]);

        return redirect()->route('mentor.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dibuat');
    }

    public function show(ProgramKegiatan $kegiatan)
    {
        $user = auth()->user();

        // batasi hanya kegiatan bidangnya
        if ($kegiatan->bidang_id != $user->bidang_id) {
            abort(403);
        }

        $kegiatan->load(['bidang', 'laporans', 'evaluasi']);

        $jumlahUserMelapor = $kegiatan->laporans()
            ->select('user_id')
            ->distinct()
            ->count();

        $target = $kegiatan->target_laporan ?? 0;

        $statusTarget = $jumlahUserMelapor >= $target && $target > 0
            ? 'Tercapai'
            : 'Belum Tercapai';

        return view('mentor.kegiatan.show', compact(
            'kegiatan',
            'jumlahUserMelapor',
            'target',
            'statusTarget'
        ));
    }

    public function edit(ProgramKegiatan $kegiatan)
    {
        $user = auth()->user();

        if ($kegiatan->bidang_id != $user->bidang_id) {
            abort(403);
        }

        $bidangs = Bidang::where('id', $user->bidang_id)->get();

        return view('mentor.kegiatan.edit', compact('kegiatan','bidangs'));
    }

    public function update(Request $request, ProgramKegiatan $kegiatan)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required|date',
            'status' => 'required',
            'deskripsi' => 'nullable|string',
            'target_laporan' => 'required|integer|min:1',
        ]);

        $kegiatan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
            'target_laporan' => $request->target_laporan,
        ]);

        return redirect()->route('mentor.kegiatan.index')
            ->with('success','Kegiatan berhasil diupdate');
    }

    public function cetak($id)
    {
        $kegiatan = ProgramKegiatan::with('bidang')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.kegiatan', compact('kegiatan'));

        return $pdf->download('program-kegiatan-'.$kegiatan->nama_kegiatan.'.pdf');
    }

    
}