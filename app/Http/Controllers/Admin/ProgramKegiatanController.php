<?php

namespace App\Http\Controllers\Admin;

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

        if ($user->role === 'admin') {
            $kegiatans = \App\Models\ProgramKegiatan::with('bidang')->get();
        } else {
            $kegiatans = \App\Models\ProgramKegiatan::with('bidang')
                ->where('bidang_id', $user->bidang_id)
                ->get();
        }

        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $bidangs = \App\Models\Bidang::all();
        } else {
            $bidangs = \App\Models\Bidang::where('id', $user->bidang_id)->get();
        }

        return view('admin.kegiatan.create', compact('bidangs'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nama_kegiatan'   => 'required|string|max:255',
            'jenis_kegiatan'  => 'required|string|max:255',
            'tanggal_kegiatan'=> 'required|date',
            'status'          => 'required|string',
            'bidang_id'       => 'nullable|exists:bidangs,id',
            'deskripsi'       => 'nullable|string',
            'target_laporan'  => 'required|integer|min:1',
            
        ]);

        // 🔐 Paksa bidang sesuai user jika bukan admin
        if ($user->role !== 'admin') {
            $bidangId = $user->bidang_id;
        } else {
            $bidangId = $request->bidang_id;
        }

        \App\Models\ProgramKegiatan::create([
            'nama_kegiatan'    => $request->nama_kegiatan,
            'jenis_kegiatan'   => $request->jenis_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'status'           => 'Proses',
            'bidang_id'        => $bidangId, // 🔥 WAJIB ADA
            'deskripsi'        => $request->deskripsi,
            'target_laporan'   => $request->target_laporan, 
        ]);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dibuat');
    }

    public function show(ProgramKegiatan $kegiatan)
    {
        $kegiatan->load(['bidang', 'laporans', 'evaluasi']);

        // Hitung jumlah user unik yang sudah melapor
        $jumlahUserMelapor = $kegiatan->laporans()
            ->select('user_id')
            ->distinct()
            ->count();

        $target = $kegiatan->target_laporan ?? 0;

        $statusTarget = $jumlahUserMelapor >= $target && $target > 0
            ? 'Tercapai'
            : 'Belum Tercapai';

        return view('admin.kegiatan.show', compact(
            'kegiatan',
            'jumlahUserMelapor',
            'target',
            'statusTarget'
        ));
    }

    public function edit(ProgramKegiatan $kegiatan)
    {
        $bidangs = Bidang::all();

        return view('admin.kegiatan.edit', compact('kegiatan', 'bidangs'));
    }

    public function update(Request $request, ProgramKegiatan $kegiatan)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required|date',
            'status' => 'required',
            'deskripsi' => 'nullable|string',
            'bidang_id' => 'required|exists:bidangs,id',
            'target_laporan' => 'required|integer|min:1',
        ]);

        $kegiatan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'status' => $request->status, // 🔥 INI YANG PENTING
            'deskripsi' => $request->deskripsi,
            'bidang_id' => $request->bidang_id,
            'target_laporan' => $request->target_laporan,
        ]);

        return redirect()->route('admin.kegiatan.index')
                        ->with('success','Kegiatan berhasil diupdate');
    }


    public function destroy(ProgramKegiatan $kegiatan)
    {
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Program kegiatan berhasil dihapus');
    }

    public function cetak($id)
    {
        $kegiatan = ProgramKegiatan::with('bidang')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.kegiatan', compact('kegiatan'));

        return $pdf->download('program-kegiatan-'.$kegiatan->nama_kegiatan.'.pdf');
    }
}
