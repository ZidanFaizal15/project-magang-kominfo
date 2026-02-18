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
        $laporans = Laporan::with('kegiatan','user')->latest()->get();
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        $laporan->delete();
        return back()->with('success','Laporan dihapus');
    }

    public function cetak(Laporan $laporan)
    {
        $pdf = Pdf::loadView('admin.laporan.pdf', compact('laporan'));
        return $pdf->download('laporan-'.$laporan->id.'.pdf');
    }
}
