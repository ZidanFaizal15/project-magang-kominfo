<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\ProgramKegiatan;
use App\Models\Laporan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $jumlahKegiatan = ProgramKegiatan::where('bidang_id', $user->bidang_id)->count();

        $jumlahLaporanSaya = Laporan::where('user_id', $user->id)->count();
        

        return view('peserta.dashboard', compact(
            'jumlahKegiatan',
            'jumlahLaporanSaya'
        ));
    }
}