<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\ProgramKegiatan;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * List laporan milik pegawai
     */
    public function index()
    {
        $laporans = Laporan::with(['programKegiatan.bidang'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pegawai.laporan.index', compact('laporans'));
    }

    /**
     * Form tambah laporan
     */
    public function create()
    {
        $user = Auth::user();

        $kegiatans = ProgramKegiatan::where('bidang_id', $user->bidang_id)
            ->whereDoesntHave('laporans', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        return view('pegawai.laporan.create', compact('kegiatans'));
    }

    /**
     * Simpan laporan
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required',
            'isi_laporan' => 'required',
            'jumlah_peserta' => 'nullable|numeric',
            'dokumentasi' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('dokumentasi')) {
            $data['dokumentasi'] = $request->file('dokumentasi')
                ->store('laporan', 'public');
        }

        Laporan::create($data);

        return redirect()->route('pegawai.laporan.index')
            ->with('success', 'Laporan berhasil dikirim');
    }

    /**
     * Detail laporan
     */
    public function show(Laporan $laporan)
    {
        if ($laporan->user_id != Auth::id()) {
            abort(403);
        }

        return view('pegawai.laporan.show', compact('laporan'));
    }

    /**
     * Cetak laporan PDF
     */
    public function cetak(Laporan $laporan)
    {
        if ($laporan->user_id != Auth::id()) {
            abort(403);
        }

        $pdf = Pdf::loadView('pegawai.laporan.pdf', compact('laporan'));

        return $pdf->download('laporan-' . $laporan->id . '.pdf');
    }
}