<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'kegiatan_id',
        'user_id',
        'isi_laporan',
        'dokumentasi',
    ];

    // relasi ke kegiatan
    public function programKegiatan()
    {
        return $this->belongsTo(ProgramKegiatan::class, 'kegiatan_id');
    }
    public function Kegiatan()
    {
        return $this->belongsTo(ProgramKegiatan::class, 'kegiatan_id');
    }

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Event otomatis ketika laporan dibuat
     */
    protected static function booted()
    {
        static::created(function ($laporan) {

            $kegiatan = $laporan->kegiatan;

            if ($kegiatan) {

                $jumlahLaporan = $kegiatan->laporans()->count();

                if ($jumlahLaporan >= $kegiatan->target_laporan) {
                    $kegiatan->status = 'selesai';
                    $kegiatan->save();
                }

            }

        });
    }
}