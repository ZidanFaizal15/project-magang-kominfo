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
        'dokumentasi',
    ];

    
    public function laporans()
    {
        return $this->hasMany(Laporan::class, 'kegiatan_id');
    }

}
