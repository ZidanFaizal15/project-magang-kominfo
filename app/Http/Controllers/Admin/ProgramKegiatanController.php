<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKegiatan;
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
            'deskripsi'       => 'nullable|string'
            
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
            'status'           => $request->status,
            'bidang_id'        => $bidangId, // 🔥 WAJIB ADA
            'deskripsi'        => $request->deskripsi,
        ]);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dibuat');
    }


    public function show(ProgramKegiatan $kegiatan)
    {
        return view('admin.kegiatan.show', compact('kegiatan'));
    }

    public function edit(ProgramKegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, ProgramKegiatan $kegiatan)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required|date',
            'status' => 'required',
            'deskripsi' => 'nullable|string',
            'bidang_id' => 'required|exists:bidangs,id'
        ]);

        $kegiatan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'status' => $request->status, // 🔥 INI YANG PENTING
            'deskripsi' => $request->deskripsi,
            'bidang_id' => $request->bidang_id
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

        $pdf = Pdf::loadView('admin.kegiatan.pdf', compact('kegiatan'));

        return $pdf->download('program-kegiatan-'.$kegiatan->nama_kegiatan.'.pdf');
    }
}
