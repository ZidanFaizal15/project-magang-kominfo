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
        $kegiatans = ProgramKegiatan::withCount('laporans')
                        ->latest()
                        ->get();

        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan'    => 'required',
            'jenis_kegiatan'   => 'required',
            'tanggal_kegiatan' => 'required|date',
            'status'           => 'required',
            'dokumentasi'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('dokumentasi')) {
            $data['dokumentasi'] = $request->file('dokumentasi')
                ->store('dokumentasi', 'public');
        }

        ProgramKegiatan::create($data);

        return redirect()
            ->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan');
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
            'status' => 'required'
        ]);

        $kegiatan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'status' => $request->status, // 🔥 INI YANG PENTING
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

    public function cetak(ProgramKegiatan $kegiatan)
    {
        $pdf = Pdf::loadView('admin.kegiatan.pdf', compact('kegiatan'));

        return $pdf->download('laporan-program-'.$kegiatan->id.'.pdf');
    }
}
