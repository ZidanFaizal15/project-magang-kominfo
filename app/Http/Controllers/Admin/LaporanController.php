<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\ProgramKegiatan;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $laporans = \App\Models\Laporan::with(['programKegiatan.bidang'])->get();
        } else {
            $laporans = \App\Models\Laporan::with(['programKegiatan.bidang'])
                ->whereHas('programKegiatan', function ($query) use ($user) {
                    $query->where('bidang_id', $user->bidang_id);
                })
                ->get();
        }

        return view('admin.laporan.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kegiatans = ProgramKegiatan::all();
        return view('admin.laporan.create', compact('kegiatans'));

        $kegiatans = ProgramKegiatan::doesntHave('laporans')->get();
        return view('admin.laporan.create', compact('kegiatans'));

        $kegiatans = ProgramKegiatan::whereDoesntHave('laporans', function ($query) {
        $query->where('user_id', Auth::id());
        })->get();

        return view('admin.laporan.create', compact('kegiatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required',
            'isi_laporan' => 'required',
            'dokumentasi' => 'nullable|image'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('dokumentasi')) {
            $data['dokumentasi'] = $request->file('dokumentasi')
                ->store('laporan','public');
        }

        Laporan::create($data);

        return redirect()->route('admin.laporan.index')
            ->with('success','Laporan berhasil dikirim');
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        return view('admin.laporan.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        $kegiatans = ProgramKegiatan::all(); // ← INI YANG KURANG

        return view('admin.laporan.edit', compact('laporan', 'kegiatans'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        if ($laporan->status == 'disetujui') {
            return back()->with('error', 'Laporan sudah disetujui dan tidak bisa diedit');
        }

        $request->validate([
            'kegiatan_id' => 'required',
            'isi_laporan' => 'required',
            'dokumentasi' => 'nullable|image'
        ]);

        $data = $request->all();

        if ($request->hasFile('dokumentasi')) {
            $data['dokumentasi'] = $request->file('dokumentasi')
                ->store('laporan','public');
        }

        $laporan->update($data);

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $laporan = Laporan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // OPTIONAL: cegah hapus kalau sudah divalidasi
        if ($laporan->status == 'disetujui') {
            return back()->with('error', 'Laporan sudah disetujui dan tidak bisa dihapus');
        }

        $laporan->delete();

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus');
    }

    public function cetak(Laporan $laporan)
    {
        $pdf = Pdf::loadView('pdf.laporan', compact('laporan'));
        return $pdf->download('laporan-'.$laporan->id.'.pdf');
    }
}
