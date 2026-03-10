<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramKegiatan extends Model
{
    protected $fillable = [
        'nama_kegiatan',
        'jenis_kegiatan',
        'tanggal_kegiatan',
        'status',
        'deskripsi',
        'bidang_id',
        'target_laporan',
    ];

    public function laporans()
    {
        return $this->hasMany(Laporan::class, 'kegiatan_id');
    }

    public function bidang()
    {
        return $this->belongsTo(\App\Models\Bidang::class);
    }
    
    public function evaluasi()
    {
        return $this->hasOne(\App\Models\Evaluasi::class, 'kegiatan_id');
    }

    // 🔹 Fungsi cek apakah laporan sudah mencapai target
    public function cekStatus()
    {
        $jumlahLaporan = $this->laporans()->count();

        if ($jumlahLaporan >= $this->target_laporan) {
            $this->status = 'selesai';
            $this->save();
        }
    }
}