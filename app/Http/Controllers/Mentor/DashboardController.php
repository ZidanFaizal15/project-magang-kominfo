<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\ProgramKegiatan;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // kegiatan dalam bidang mentor
        $kegiatan = ProgramKegiatan::where('bidang_id', $user->bidang_id)->get();

        $totalKegiatan = $kegiatan->count();

        // total laporan dari kegiatan bidang mentor
        $totalLaporan = Laporan::whereHas('kegiatan', function ($query) use ($user) {
            $query->where('bidang_id', $user->bidang_id);
        })->count();

        // kegiatan yang sudah selesai
        $kegiatanTercapai = $kegiatan->filter(function ($item) {
            return $item->laporans()->count() >= $item->target_laporan;
        })->count();

        return view('mentor.dashboard', compact(
            'totalKegiatan',
            'totalLaporan',
            'kegiatanTercapai',
            'kegiatan'
        ));
    }
}