<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProgramKegiatan;
use App\Models\Laporan;
use App\Models\Evaluasi;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalUser = User::count();
        $totalKegiatan = ProgramKegiatan::count();
        $totalLaporan = Laporan::count();
        $totalEvaluasi = Evaluasi::count();

        // Data terbaru
        $kegiatanTerbaru = ProgramKegiatan::latest()->take(5)->get();
        $laporanTerbaru = Laporan::latest()->take(5)->get();
        $evaluasiTerbaru = Evaluasi::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalKegiatan',
            'totalLaporan',
            'totalEvaluasi',
            'kegiatanTerbaru',
            'laporanTerbaru',
            'evaluasiTerbaru'
        ));
    }
}